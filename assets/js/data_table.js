function showDataTable(title, msg, date_print, col_print) {

    $("#dataTable").DataTable({
        // "scrollX": true,
        "language" : {
            "sLengthMenu": "_MENU_"
        },
        "dom": "lBfrtip",
        "order":[],
        "columnDefs":[  
            {  
                "targets":0,  
                "orderable":false,  
                "class":"text-center" 
            }, 
            {  
                "targets":1,  
                "orderable":false,  
                "class":"text-center" 
            }
        ],
        "buttons": [
            {
                "extend": "excel",
                "title": title,
                "filename": title + " - " + date_print,
                "messageTop": msg,
                "exportOptions": {
                    "columns": col_print
                }
            },
            {
                "extend": "pdf",
                "title": title,
                "filename": title + " - " + date_print,
                "messageTop": msg,
                "orientation": "portrait",
                "pageSize": "LEGAL",
                "exportOptions": {
                    "columns": col_print
                }
            },
            {
                "extend": "print",
                "title": title,
                "filename": title + " - " + date_print,
                "messageTop": msg,
                "exportOptions": {
                    "columns": col_print
                },
                "customize": function(win)
                {    
                    var css = "@page { size: landscape; }",
                        head = win.document.head || win.document.getElementsByTagName("head")[0],
                        style = win.document.createElement("style");
    
                    style.type = "text/css";
                    style.media = "print";
    
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
}