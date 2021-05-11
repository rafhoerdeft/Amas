var protocol = window.location.protocol;
var host = window.location.hostname;

function showDataTable(link) {
    $("#data_barang_jasa").DataTable({
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
                "width": "10",
                "orderable":false,  
                "class":"text-center" 
            }, 
            // {  
            //     "targets":3,  
            //     "orderable":false,  
            //     "class":"text-center" 
            // },
            // {  
            //     "targets":3,  
            //     "class":"text-right" 
            // },
            {  
                "targets":3,  
                "width": "25",
                "class":"text-center" 
            },
            {  
                "targets":4,  
                "width": "50",
                "class":"text-center" 
            },
            {  
                "targets":5,  
                "width": "100"
            },
            {  
                "targets":6,  
                "width": "75"
            },
            {  
                "targets":7,  
                "width": "75"
            },
            {  
                "targets":8,  
                "width": "50",
                "class":"text-center" 
            },
            {  
                "targets":9,  
                "class":"text-right" 
            },
            {  
                "targets":10,  
                "class":"text-right" 
            },
            {  
                "targets":11,  
                "class":"text-right" 
            }
        ],  
        "pageLength": 10
    }).on('draw.dt', function (row, data, index) {
        $('tr td:nth-child(12)').each(function (){
            var cek_sisa = $(this).text();
            if (cek_sisa == '0') {
                $(this).parent().addClass('row_kosong');
                $(this).parent().children().eq(1).find('input').attr('disabled', true);
            }
        })
        
        cekChangePage();
        activeIcheck();
    });
}
