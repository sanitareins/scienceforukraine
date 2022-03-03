document.addEventListener("DOMContentLoaded", function () {

    const table = new Tabulator("#institution-table", {
        data: mapData,
        columns: [
            {
                title: 'Institution',
                field: 'institution'
            },
            {
                title: 'Country',
                field: 'country'
            },
            {
                title: 'Contacts',
                field: 'contact-column',
                formatter:"html"
            },
            {
                title: 'Research focus',
                field: 'research-focus'
            },
            {
                title: 'Description',
                field: 'description'
            }
        ]
    });
    
    function filterTable (filters)
    {
        console.log(filters, table);
        
        table.setFilter (filters);
    }
    
    document.querySelectorAll("nav button").forEach (function (button) {
        
        button.addEventListener("click", function (event) {
            // console.log ("test click");
            const button = event.target;

            button.classList.toggle("btn-light");
    
            var filters = [];
            document.querySelectorAll ("nav button.btn-light").forEach((button) => {
                filters.push({
                    field: button.getAttribute('data-field'),
                    type: '=',
                    value: 'Yes'
                });
            });
            
            filterTable(filters);
        });
        
        
    });
});
