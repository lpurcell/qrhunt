/**
 * Created with JetBrains PhpStorm.
 * User: mgates2
 * Date: 7/6/13
 * Time: 9:07 PM
 * To change this template use File | Settings | File Templates.
 */
/** Missouri Western State University **/


var generate = function() {
    var generatedCode = randomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

    //set text field value
    document.getElementById('QRField').value= generatedCode;

    update_qrcode();
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
