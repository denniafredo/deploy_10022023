<?
  include "../../includes/common.php";
?>

<html>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function MakeArrayday(size) {
this.length = size;
for(var i = 1; i <= size; i++) {
this[i] = "";
}
return this;
}
function MakeArraymonth(size) {
this.length = size;
for(var i = 1; i <= size; i++) {
this[i] = "";
}
return this;
}
function funClock() {
if (!document.layers && !document.all)
return;
var runTime = new Date();
var hours = runTime.getHours();
var minutes = runTime.getMinutes();
var seconds = runTime.getSeconds();
var dn = "AM";
if (hours >= 12) {
dn = "PM";
hours = hours - 12;
}
if (hours == 0) {
hours = 12;
}
if (minutes <= 9) {
minutes = "0" + minutes;
}
if (seconds <= 9) {
seconds = "0" + seconds;
}
movingtime = "<font face=Verdana size=2 color=#666666><b>"+ hours + ":" + minutes + ":" + seconds + " " + dn + "</b></font>";
if (document.layers) {
document.layers.clock.document.write(movingtime);
document.layers.clock.document.close();
}
else if (document.all) {
clock.innerHTML = movingtime;
}
setTimeout("funClock()", 1000)
}
window.onload = funClock;
//  End -->
</script>
<body link="#003366" vlink="#003366">
<link href=<? echo "http://$HTTP_HOST/jiwasraya/jws.css"; ?> rel="stylesheet" type="text/css">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11%"><img border="0" src=<? echo "http://$HTTP_HOST/jiwasraya/img/head1.gif"; ?> width="175" height="35"></td>
    <td width="89%">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" align="right">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right"><span id=clock style="position:relative;"></span></td>
								<td>&nbsp;&nbsp;&nbsp;</td>
                <td>
                  <p align="right"><font face="Verdana" size="2"><a href=<? echo "http://$HTTP_HOST/jiwasraya/logout.php"; ?> target="_parent">LOGOUT</a><!-- &nbsp; <a href=<? echo "http://$HTTP_HOST/jiwasraya"; ?> target="_parent">HOME</a> --></font></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="100%" bgcolor="#14469A"><img border="0" src="head2.gif" width="8" height="7"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
