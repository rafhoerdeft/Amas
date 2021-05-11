var protocol = window.location.protocol;
var host = window.location.hostname;

function showDataTable(link,jenis) {

    var tahun       = $('#tahun option:selected').text();
    var bulan       = $('#bulan option:selected').text();
    var jenis_ijin  = $('#jenis_ijin option:selected').text();
    var status      = $('#status option:selected').text();

    var info = ((bulan == 'Semua Bulan')?'':bulan + ' ') + tahun;
    var msg  =  "Jenis Izin: " + jenis_ijin + " / Status: " + status;

    if (jenis=='11') {
        var cols = [  
            {  
                "width": "10",
                "targets":0,  
                "orderable":false,  
                "class":"text-center" 
            }, 
            {  
                "targets":1,  
                "orderable":false,  
                "class": 'no-wrap'
            },
            {  
                "targets":2,
                "orderable":false,
                "class": 'no-wrap'
            }, 
            {  
                "targets":3,
                "orderable":false,
                "class": 'no-wrap'
            },  
            {  
                "targets":4,
                "orderable":false,
                "class": 'no-wrap'
            },  
            {  
                "width": "150",
                "targets":5,
                "orderable":false
            },
            {  
                "width": "150",
                "targets":6,
                "orderable":false
            },
            {  
                "width": "50",
                "targets":7,
                "orderable":false,
                "class":"text-center" 
            },  
            {  
                "width": "50",
                "targets":8,
                "orderable":false,
                "class": 'no-wrap',
            },
            {  
                "width": "70",
                "targets":9,
                "orderable":false
            },  
            {  
                "width": "100",
                "targets":10,
                "orderable":false
            },
            {  
                "width": "100",
                "targets":11,
                "orderable":false
            },
            {  
                "width": "100",
                "targets":12,
                "orderable":false
            },  
            {  
                "width": "50",
                "targets":13,
                "orderable":false
            },
            {  
                "width": "150",
                "targets":14,
                "orderable":false
            }
        ];
    } else {
        var cols = [  
            {  
                "width": "10",
                "targets":0,  
                "orderable":false,  
                "class":"text-center" 
            }, 
            {  
                "targets":1,  
                "orderable":false,  
                "class": 'no-wrap'
            },
            {  
                "targets":2,
                "orderable":false,   
                "class": 'no-wrap'
            }, 
            {  
                "targets":3,
                "orderable":false,  
                "class": 'no-wrap'
            },  
            {  
                "targets":4,
                "orderable":false,  
                "class": 'no-wrap'
            },  
            {  
                "width": "150",
                "targets":5,
                "orderable":false
            },
            {  
                "width": "150",
                "targets":6,
                "orderable":false
            },
            {  
                "width": "50",
                "targets":7,
                "orderable":false,
                "class":"text-center" 
            },  
            {  
                "width": "50",
                "targets":8,
                "orderable":false,
                "class": 'no-wrap' 
            }
        ];
    }
    

    $("#dataijin").DataTable({
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
            // "success":function(data){
            //    console.log(data);
            //   }
        },  
        "columnDefs": cols,
        "pageLength": 10,
        // "lengthMenu": [10, 25, 50, 100],
        "language" : {
            "sLengthMenu": "_MENU_"
        },
        "dom": 'lBfrtip',
        "buttons": [
            // 'copy', 
            // 'csv', 
            {
                "extend": 'excel',
                "title": 'Data perizinan - ' + info,
                "messageTop": msg,
            },
            {
                "extend": 'pdf',
                "title": 'Data perizinan - ' + info,
                "messageTop": msg,
                "orientation": 'landscape',
                "pageSize": 'LEGAL'
            },
            {
                "extend": 'print',
                "title": 'Data perizinan - ' + info,
                "messageTop": msg,
                "customize": function(win)
                {    
                    var css = '@page { size: landscape; }',
                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                        style = win.document.createElement('style');
    
                    style.type = 'text/css';
                    style.media = 'print';
    
                    if (style.styleSheet)
                    {
                    style.styleSheet.cssText = css;
                    }
                    else
                    {
                    style.appendChild(win.document.createTextNode(css));
                    }
    
                    head.appendChild(style);
                }
            }
        ]
    });
    

    //Tanpa merubah form search bar
    // ==========================================
    // $(document).ready( function () {    
    //     $('.dataTables_filter input')
    //         .off()
    //         .on('keypress', function(e) {
    //         var keycode = e.keyCode || e.which;
    //             if(keycode == 13) {
    //                 $('#dataijin').DataTable().search(this.value.trim(), false, false).draw();
    //             }
    //         });        
    // });
      
}
