<?
  include "common.php";
	include "session.php"; 
	include "database.php"; 
	$DB = New Database($userid,$passwd,$DBName);
?>
<html>
<head>
<title>Header XL-iNdO</title>
<style>
<!--
.itemBorder { border: 1px solid black }
.itemText { text-decoration: none; color: #FFFFFF; font: 11px Arial, Helvetica }

.crazyBorder { border: 2px outset #663399 }
.crazyText { text-decoration: none; color: #FFCC99; font: 10px Arial, Helvetica }

.leakBorder { border: 1px outset #663399 }
.leakText { text-decoration: none; color: #FFFFFF; font: 10px Verdana, Helvetica }
-->
</style>
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
movingtime = "<font face=Verdana size=1 color=#ffffff>"+ hours + ":" + minutes + ":" + seconds + " " + dn + "</font>";
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
<base target="middle">
</head>

<body marginwidth="0" marginheight="0" style="margin: 0">
<link href=<? echo "http://$HTTP_HOST/$KAMP/jws.css"; ?> rel="stylesheet" type="text/css">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" bgcolor="#576DD5">
      <table border="0" width="100%" cellspacing="1">
        <tr>
          <td width="100%"><img border="0" src=<? echo "http://$HTTP_HOST/$KAMP/img/private.gif"; ?>></td>
        </tr>
      </table>
    </td>
    <td width="80%" bgcolor="#576DD5" valign="top" align="right">
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="62%" align=right><font face="Verdana" size="1" color="#FFFFFF"><? //echo $userid."-".$kantor; ?></font></td>
          <td width="11%" valign="top" align="right"><font size="2" face="Verdana"><img border="0" src=<? echo "http://$HTTP_HOST/jiwasraya/img/chamber.gif"; ?>></font></td>
          <td width="27%" bgcolor="#000000">
            <table border="0" width="100%" cellspacing="1">
              <tr>
                <td width="35%" align="right"><font face="Verdana" size="1" color="#FFFFFF"><span id=clock style="position:relative;"></span></font></td>
                <td width="65%">
                  <p align="center">  <a href=<? echo "http://$HTTP_HOST/inc/logout.php"; ?> target="_parent"><font face="Verdana" size="1" color="#FFFFFF">LOGOUT </font></a> <a href=<? echo "http://$HTTP_HOST"; ?> target="_parent"><font face="Verdana" size="1" color="#FFFFFF">HOME</font></a></td>
              </tr>
            </table>
          </td>
        </tr>
				<tr>
          <td width="62%"></td>
          <td width="11%" valign="top" align="right"></td>
          <td width="27%" bgcolor="#576DD5" valign="middle">
            <p align="center">
						<!--
						<embed width="150" height="25" src=<?// echo "http://$HTTP_HOST/$KAMP/img/jlindoflash.swf"; ?>>
						-->
					</td>
        </tr>
      </table>
    </td>
  </tr>
	<tr>
		<td height="18" class="verdana8blu" colspan="2" width="70%" style="border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" bgcolor="#B4E1E9" bordercolor="#000000">
  	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1">
    <tr>
      <td class="verdana8blu"><b>&nbsp;&nbsp;Office :</b> <?//=$namakantor?> <?=$kantor?></td>
      <td class="verdana8blu"><b>User :</b> <?=$namusr?></td>
      <td class="verdana8blu"><b>Modul :</b> <?=$namamodul?></td>
      <td class="verdana8blu" align="right" valign="top"><b>Quick Jump :</b>
			<?
				$sql="select a.kdmodul,b.mnuid,c.mnutext,c.mnuimage ".
			 	     "from ".
				        "$DBUser.wuser_role a,".
								"$DBUser.wrole_modul b,".
								"$DBUser.wmodul c ".
	       		 "where ".
						    "a.kdmodul=b.kdmodul and ".
								"b.mnuid=c.mnuid and ".
				        "a.userid='$userid' and mnulevel='0'"; 
				//echo $sql;
        $DB->parse($sql);
	      $DB->execute();
				while($arm=$DB->nextrow()){
				   $valoption.="<option value=\"http://$HTTP_HOST/$KAMP/submenu.php?mnuinduk=".$arm["MNUID"]."\">".$arm["MNUTEXT"]."</option>";
				}
      ?>
			<select ONCHANGE="dropdown(this);" size="1" style="font-size: 0.8em; color:#0000b3; font-family: Verdana; background-color: #B4E1E9">
				<?=$valoption;?>
			</select>
			<script language="javascript">
			function dropdown(drop)
			{
			 		var d = drop.options[drop.selectedIndex].value;
					parent.frames.middle.location.href = d;
					drop.selectedindex = 0;
			}
			</script>
		  </td>
			</tr>
  	</table>
		</td>
	</tr>
</table>
</body>
</html>
