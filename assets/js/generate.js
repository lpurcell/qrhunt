/**
 * Created with JetBrains PhpStorm.
 * User: mgates2
 * Date: 7/6/13
 * Time: 9:07 PM
 * To change this template use File | Settings | File Templates.
 */
/** Missouri Western State University **/



//generate a single code
var generate = function() {
    var generatedCode = randomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

    //set text field value
    document.getElementById('QRField').value= generatedCode;
}

var generateForPDF = function(participants, event) {
    var doc = new jsPDF();
    var count = 0;
    var value = '';
    var nameHeight = 10;
    var idHeight = 20;
    var codeHeight = 30;
    var imgHeight=0;
    var labelCount = 0;

    for (var i=0; i<participants.length; i++) {
        for (var key in participants[i]) {
            for(var vals in participants[i][key]){
                value += participants[i][key][vals];
            }
            count += 1;
            switch(count)
            {
                case 1:
                    var id = value;
                    break;
                case 2:
                    var fname = value;
                    break;
                case 3:
                    var lname = value;
                    break;
                case 4:
                    var qrcode = value;
                default:
                    break;
            }
            if(count > 4) {
                count = 0;
            }
            value = '';
        }

        //Generate the image - returns as gif
        var qrImage = create_qrcode(("qrhunt.org/qrhunt/index.php/participant/" + qrcode),10,'H');

        //convert image to jpeg
        var canvas = document.getElementById("myCanvas");
        canvas.height = 130;
        canvas.width = 130;
        var ctx = canvas.getContext("2d");
        var img = new Image();
        img.src = qrImage;
        ctx.drawImage(img,0,0);
        var newImg = canvas.toDataURL("image/jpeg");

        //format the PDF

        doc.addImage(newImg,'JPEG',0,imgHeight,40,40);
        doc.text(40,nameHeight, "Name: " + fname + " " + lname);
        doc.text(40,codeHeight, "QR Code:" + qrcode);
        doc.text(40, idHeight, "Participant: " + id);


        //update position for next label
        nameHeight+=40;
        idHeight+=40;
        codeHeight+=40;
        imgHeight+=40;
        labelCount+=1;

        //if six labels have been printed, reset for next page
        if(labelCount == 6) {
            doc.addPage();
            labelCount = 0;
            nameHeight = 10;
            idHeight = 20;
            codeHeight = 30;
            imgHeight=0;
        }

    }

    //write the document
    doc.output('dataurlnewwindow');
    document.getElementById("myCanvas").remove();

}

//generate multiple codes
var generateMult = function() {
    //declare variables
    var textField;
    var Num = document.getElementById('NoOfCodes').value;
    var br = document.createElement('br');

    //make sure div is empty
    document.getElementById('emptyFormDiv').innerHTML = "";

    //create form
    var form = document.createElement("form");
    form.setAttribute('method', 'post');
    form.setAttribute('action', '');

    //add submit button to form
    var subForm = document.createElement("input");
    subForm.setAttribute('type',"submit");
    subForm.setAttribute('value',"Submit");
    form.appendChild(subForm);
    form.appendChild(br);

    //generate codes
    for (var i = 0; i < Num; i++ ) {
        var generatedCode = randomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

        textField = document.createElement("input");
        textField.setAttribute('type', 'text');
        textField.setAttribute('value',generatedCode);
        form.appendChild(textField);
    }

    //add form to page
    document.getElementById('emptyFormDiv').appendChild(form);
}

function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
}

var draw_qrcode = function draw_qrcode(text, typeNumber, errorCorrectLevel) {
    document.getElementById('QRField').value=(document.write(create_qrcode(text, typeNumber, errorCorrectLevel)));
};

var create_qrcode = function(text, typeNumber, errorCorrectLevel, table) {

    var qr = qrcode(typeNumber || 4, errorCorrectLevel || 'M');
    qr.addData(text);
    qr.make();

//	return qr.createTableTag();

    return qr.createImgTag();
};

var update_qrcode = function() {
    var text = document.getElementById('QRField').value.
        replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
    document.getElementById('codeArea').innerHTML = create_qrcode(("qrhunt.org/qrhunt/index.php/participant/" + text),10,'H');
};