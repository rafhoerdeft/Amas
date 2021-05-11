var protocol = window.location.protocol;
var host = window.location.hostname;

function showDataTable(link) {
    $("#data_histori").DataTable({
        "processing": true,
        "serverSide": true,
        "searching": true,
        "scrollX": true,
        "order":[],  
        "ajax":{  
            "url": link,  
            "type": "POST",
            "beforeSend": function () {
                $(".loading-page").show();
            },
            "complete": function () {
                $(".loading-page").hide();
            },
        },  
        "columnDefs":[  
            {  
                "targets":0,  
                "width": "10",
                "orderable":false,  
                "class":"text-center" 
            }, 
            {  
                "targets":1,  
                "width": "10",
                "orderable":false,  
                "class":"text-center" 
            }, 
            {  
                "targets":2,  
                "width": "50",
                "class":"text-center" 
            }, 
            {  
                "targets":3,  
                "width": "50",
                "class":"text-center" 
            },
            {  
                "targets":4,  
                "width": "100"
            },
            {  
                "targets":5,  
                "width": "100"
            },
            {  
                "targets":6,  
                "width": "150"
            },
            {  
                "targets":7,  
                "width": "150"
            },
            {  
                "targets":8,  
                "class":"text-center" 
            },
            {  
                "targets":9,  
                "class":"text-center" 
            },
            {  
                "targets":10,  
                "class":"text-center" 
            }, 
            {  
                "targets":11,  
                "width": "100"
            }, 
            {  
                "targets":12,  
                "width": "150"
            },
            {  
                "targets":13,  
                "width": "80"
            }, 
            {  
                "targets":14,  
                "width": "80"
            }, 
            {  
                "targets":15,  
                "width": "150"
            },
            {  
                "targets":16,  
                "width": "100"
            }
        ],  
        "pageLength": 10
    }).on('draw.dt', function () {        
        cekChangePage();
        activeIcheck();
    });
}
