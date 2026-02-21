function printreceipt(el){

    var data = '<input type="button" id="printpagebutton" style="display: block; width: 100%; border: none; background-color: #008B8B; color: #fff; padding: 14px 28px; font-size: 16px; cursor:pointer; text-align: center;"  value="Print Receipt" onclick="window.print()">';

    data += document.getElementById(el).innerHTML;

    myReceipt = window.open("","Print","left=150, top=130, width=400, height=400");
    myReceipt.screnX = 0;
    myReceipt.screnY = 0;
    myReceipt.document.write(data); 
    myReceipt.document.title = "Print Receipt";
    myReceipt.focus();


}


function printarea(el){

    var data = '<!DOCTYPE html>'+
'<html lang="en">'+
'<head>'+
    '<meta charset="UTF-8">'+
    '<meta name="viewport" content="width=device-width, initial-scale=1.0">'+
    '<title>Print</title>'+
    '<style>@page {'+
        'size: 80mm auto; /* width 80mm, height auto */'+
        'margin: 0;'+
    '}</style>'+
'</head>'+
'<body><br><br><center>';

    data += document.getElementById(el).innerHTML;


    data += '</center><script>window.addEventListener("load", window.print());</script></body></html>';

    myReceipt = window.open("","Print","left=150, top=130, width=1200, height=800");
    myReceipt.screnX = 0;
    myReceipt.screnY = 0;
    myReceipt.document.write(data); 
    myReceipt.document.title = "Print Page";
    myReceipt.focus();


}

