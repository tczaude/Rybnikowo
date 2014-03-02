	 function getRandomNum(lbound, ubound) {
	 return (Math.floor(Math.random() * (ubound - lbound)) + lbound);
	 }
	 function getRandomChar() {
	 var numberChars = "0123456789";
	 var lowerChars = "abcdefghijklmnopqrstuvwxyz";
	 var upperChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	 var charSet = '';
	 charSet += numberChars;
	 charSet += lowerChars;
	 charSet += upperChars;
	 return charSet.charAt(getRandomNum(0, charSet.length));
	 }
	 function getPassword(length,name) {
	 var rc = "";
	 if (length > 0)
	 rc = rc + getRandomChar();
	 for (var idx = 1; idx < length; ++idx) {
	 rc = rc + getRandomChar();
	 }
	 var pass = document.getElementById(name);
	 pass.value = rc;
	 //return rc;
	 }
