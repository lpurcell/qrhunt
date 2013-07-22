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
