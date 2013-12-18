function confirmDelete(pURL,pMessage)
{
	if((confirm(pMessage)))
	{
		alert(pURL);
		window.location=pURL;
	}
}

function addCommas(nStr)
{

	nStr = nStr.toFixed(2);
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}


 function urlEncode(inputString, encodeAllCharacter){
       var outputString = '';
       if (inputString != null){
         for (var i = 0; i < inputString.length; i++ ){
            var charCode = inputString.charCodeAt(i);
            var tempText = "";
            if (charCode < 128) {
                if (encodeAllCharacter)
                {
                  var hexVal = charCode.toString(16);
                  outputString += '%' + ( hexVal.length < 2 ? '0' : '' ) + hexVal.toUpperCase();  
                } else {
                  outputString += String.fromCharCode(charCode);
                }
                            
            } else if((charCode > 127) && (charCode < 2048)) {
                tempText += String.fromCharCode((charCode >> 6) | 192);
                tempText += String.fromCharCode((charCode & 63) | 128);
                outputString += escape(tempText);
            } else {
                tempText += String.fromCharCode((charCode >> 12) | 224);
                tempText += String.fromCharCode(((charCode >> 6) & 63) | 128);
                tempText += String.fromCharCode((charCode & 63) | 128);
                outputString += escape(tempText);
            }
         }
       }
       return outputString;
    }