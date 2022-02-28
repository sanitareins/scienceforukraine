"use strict";

var CustomEvent = function ( event, params ) {
    params = params || { bubbles: false, cancelable: false, detail: undefined };
    var evt = document.createEvent( 'CustomEvent' );
    evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
    return evt;
};
CustomEvent.prototype = window.Event.prototype;

/**
 */
function initOsmMap (container)
{
    var fullScreen = L.DomUtil.create('div', 'leaflet-bar leaflet-control fullscreen');
    fullScreen.style.backgroundColor = 'white';
    fullScreen.style.textAlign = 'center';
    fullScreen.title = 'Pilnekrāns';
    
    
    var initHeight = container.getBoundingClientRect().height;
    var initWidth = container.getBoundingClientRect().width;
    
    var a = document.createElement('a');

    let svg = '<svg class="bi" width="16" height="16" fill="currentColor">';
    svg += '<use xlink:href="assets/bootstrap-icons.svg#arrows-fullscreen"/>';
    svg += '</svg>';

    a.innerHTML = svg;

    fullScreen.appendChild(a);
    fullScreen.onclick = function(event)
    {
        event.preventDefault();
        
        event.target.classList.toggle("fullscreen");
        
        var style = container.style;
        if (event.target.classList.toggle("contains"))
        {
            style.height = '100%';
            style.width = '100%';
            style.position = "absolute";
            style.top = "0";
            style.left = "0";
            style["z-index"] = "200";
            // container.style = style;
            
            console.log(style);
            console.log(container);
            
            window.scroll(0,0);
        } else 
        {
            style.height = initHeight + "px";
            style.width = initWidth + "px";
            style.position = 'relative';
            style.top = style.left = 'inherit';
        }
       
        
        map.invalidateSize(true);
        
        setTimeout(function() {
            map.setView(map.getCenter(), map.getZoom());
        }, 1);

    }

    var map = L.map(container).setView([56.9498528, 24.033401], 13);

    var fullScreenControl = L.Control.extend({
        options: {
            position: 'topleft'
        },
        onAdd: function () {return fullScreen;}
    });
    
    map.addControl(new fullScreenControl());

    L.tileLayer('https://tiles.garamantas.lv/?x={x}&y={y}&z={z}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
    }).addTo(map);
    
    var event = new CustomEvent("map-loaded", {
        detail: {
            targetId: container.id,
            targetMap: map
        }                
    });

    document.dispatchEvent(event);
}

document.addEventListener("DOMContentLoaded", () => {
    // console.log("init osm map");
    document.querySelectorAll("div.osm-map").forEach(function (div) {
        initOsmMap(div);
    });
});
