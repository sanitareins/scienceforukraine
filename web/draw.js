/**
 * Create layers for each filter variation
 * cache  data in scienceLayers
 *
 * @see scienceLayers
 * @returns void
 */
function drawMarkers (filters)
{
    const filterLayerName = filters.join("_");
    
    const layerGroup = L.layerGroup();
    
    scienceLayers.forEach ((layerObject) => {
        layerObject.layerGroup.remove();
    });
    
    const foundLayer = scienceLayers.find((layerObyect) => {
        return layerObyect.filterName == filterLayerName;
    });
    
    if (foundLayer)
    {
        foundLayer.layerGroup.addTo (scienceMap);
        return;
    }
    
    mapData.forEach((poinData) => {        
        var addMarker = true;
        if (poinData.researchers != "Yes" && filters.find( (v) => { return v=='researchers'; } ) )
        {
            addMarker = false;
        }
        if (poinData.students != "Yes" && filters.find( (v) => { return v=='students'; } ) )
        {
            addMarker = false;
        }
        if (poinData.accommodation != "Yes" && filters.find( (v) => { return v=='accommodation'; } ) )
        {
            addMarker = false;
        }
        if (poinData.funding != "Yes" && filters.find( (v) => { return v=='funding'; } ) )
        {
            addMarker = false;
        }
        
        if (addMarker)
        {
            const marker = L.marker([poinData.lat, poinData.lng])
            .bindTooltip(poinData.institution)
            .bindPopup(poinData.popup_data);
        
            layerGroup.addLayer(marker);
        }
    });
    
    layerGroup.addTo (scienceMap);
    
    scienceLayers.push ({
        filterName: filterLayerName,
        layerGroup: layerGroup
    });
}

/**
 * Html click Event when clicked filter button
 *
 * @returns void
 */
function eventFilter(event)
{
    const button = event.target;

    button.classList.toggle("btn-light");

    var filters = [];
    document.querySelectorAll ("nav button.btn-light").forEach((button) => {
        filters.push(button.innerText.toLowerCase());
    });
    
    drawMarkers(filters);
}

var scienceMap;
var scienceLayers = [];

document.addEventListener("map-loaded", function (e) {
    if (e.detail.targetId != 'example-map')
    {
        return false;
    }
    
    document.querySelectorAll ("nav button").forEach((bltton) => {
        bltton.addEventListener("click", eventFilter);
    });

    scienceMap = e.detail.targetMap;

    // draw firs layer without filter    
    drawMarkers([]);

    var bounds = L.latLngBounds();

    mapData.forEach((poinData) => {
        bounds.extend([poinData.lat, poinData.lng]);
    });

    scienceMap.fitBounds(bounds);
});