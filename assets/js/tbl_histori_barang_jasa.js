var protocol = window.location.protocol;
var host = window.location.hostname;

function showDataTable(link) {
    $("#data_histori_barang_jasa").DataTable({
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
                "width": "70"
            },
            {  
                "targets":6,  
                "width": "70"
            },
            {  
                "targets":7,  
                "class":"text-center" 
            },
            {  
                "targets":8,  
                "class":"text-right" 
            }, 
            {  
                "targets":9,  
                "width": "150"
            }, 
            {  
                "targets":10,  
                "width": "80"
            },
            {  
                "targets":11,  
                "width": "80"
            }, 
            {  
                "targets":12,  
                "width": "80"
            }, 
            {  
                "targets":13,  
                "width": "150"
            },
            {  
                "targets":14,  
                "width": "100"
            }
        ],  
        "pageLength": 10
    }).on('draw.dt', function () {        
        cekChangePage();
        activeIcheck();
    });
}
