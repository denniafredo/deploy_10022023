<html>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body onload="browserversion()">
<a class=verdana10blk><b>INFORMASI BROWSER PC ANDA</b></a>
<hr size="1">
<table border="0">
<script type="text/javascript">
document.write("<tr><td class=verdana10blk>BROWSER </td><td class=verdana10blk>")
document.write(navigator.appName + "</td></tr>")
document.write("<tr><td class=verdana10blk>BROWSERVERSION </td><td class=verdana10blk>")
document.write(navigator.appVersion + "</td></tr>")
document.write("<tr><td class=verdana10blk>CODE </td><td class=verdana10blk>")
document.write(navigator.appCodeName + "</td></tr>")
document.write("<tr><td class=verdana10blk>PLATFORM </td><td class=verdana10blk>")
document.write(navigator.platform + "</td></tr>")
//document.write("REFERRER: ")
//document.write(document.referrer + "<br>")
document.write("<tr><td class=verdana10blk>SCREEN RESOLUTION </td><td class=verdana10blk>")
document.write(screen.width + "*")
document.write(screen.height + "</td></tr>")
document.write("<tr><td class=verdana10blk>AVAILABLE VIEW AREA </td><td class=verdana10blk>")
document.write(window.screen.availWidth + "*")
document.write(window.screen.availHeight + "</td></tr>")
document.write("<tr><td class=verdana10blk>COLOR DEPTH </td><td class=verdana10blk>")
document.write(window.screen.colorDepth + "</td></tr></table>")

function browserversion()
{
txt="Versi browser Anda tidak diketahui"
browser=navigator.appVersion
if (browser.indexOf("2.")>-1)
{
txt="Browser Anda masih dari jaman batu"
}
if (browser.indexOf("3.")>-1)
{
txt="Anda Seharusnya meng-update Browser Anda."
}
if (browser.indexOf("4.")>-1)
{
txt="Browser Anda cukup baik"
}
document.forms[0].message.value=txt
}
</script>

<form>
<input type="text" name="message" size="50">
</form>
<a class=verdana10blk>Gunakan Internet Explorer 6.0 (<b>MSIE 6.0</b>)
atau versi yang lebih tinggi<br>
untuk mendapatkan tampilan terbaik dari aplikasi XL-iNdO
</a>
<br><br>
<hr size="1">
<a class=verdana10blk href="/jiwasraya/mnuutama.php">Menu Utama</a>

</body>
</html>
