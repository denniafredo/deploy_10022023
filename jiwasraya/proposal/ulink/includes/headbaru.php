<?
  include "common.php";
	include "session.php"; 
	include "database.php"; 
	$DB = New Database($userid,$passwd,$DBName);
?>
<html>
<head>
<title>Header XL-iNdO</title>
<style type="text/css">
.top_container{
	background:url(../images/bg_header.gif); height:65px; width:auto; position:relative;
}
.top_container .banner{
	background:url(../images/header_img.jpg); height:65px; /*border:#FFFFFF solid 1px; */width:800px;
	position:absolute; left:0px; top:0px; z-index:0;
}
.topright{
	/*border:#66FF33 solid 1px;*/ padding:0px; margin-right:15px;
	position:absolute; right:15px; top:0px; z-index:0;
}
.topright a, .topright a:link, .topright a:visited{
	font-family:Tahoma, Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#D7D7D7; text-decoration:none;
}
.topright a:hover{
	text-decoration:underline; color:#FFFFFF;
}
.top_container .bar_containner{
	width:100%; height:20px;
	position:absolute; top:45px; left:0px;
	font-family:Tahoma, Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#F9F9F9;
	padding:2px 20px 2px 20px;
}
.bar_containner ul{
	padding:0px; margin:0px; list-style:none;
}
.bar_containner li{
	float:left; margin-left:10px;
}
.bar_containner li.separate{
	width:60px;
}
.bar_containner span{
	margin-right:50px; position:relative;
}
.bar_containner img{
	border:none; padding:0px; margin:0px; height:18px; width:18px; 
}
.topright img{
	border:none; padding:0px; margin:5px 0px 0px 10px; height:14px; width:14px;
}
.quickjump{
	position:absolute; right:50px; font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px; color:#CCCCCC;
}
.quickjump select{
	font-family:Verdana, Arial, Helvetica, sans-serif; /*font-size:14px;*/
}
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
<!--<link href=<? echo "http://$HTTP_HOST/$KAMP/jws.css"; ?> rel="stylesheet" type="text/css">-->

<div class="top_container">
	<div class="banner">&nbsp;</div>
	<div class="topright">
		<font face="Verdana" size="1" color="#FFFFFF"><span id=clock style="position:relative;"></span></font>
		<a href="<? echo "http://$HTTP_HOST/inc/logout.php"; ?>" target="_parent"><img src="../images/home.png" /> Home</a>
		<a href="<? echo "http://$HTTP_HOST"; ?>" target="_parent"><img src="../images/logout.png" /> Logout</a></div>
	<div class="bar_containner">
		<ul>
			<!--<li><img src="../images/office.png" /><li>-->
			<li><b>Office</b> : <?=$kantor?></li>
			<li class="separate">&nbsp;</li>
			<!--<li><img src="../images/user.png" /></li>-->
			<li><b>User</b> : <?=$namusr?></li>
			<li class="separate">&nbsp;</li>
			<!--<li><img src="../images/office.png" /><li>-->
			<li><b>Modul</b> : <?=$namamodul?></li>
		</ul>
		<div class="quickjump">
			Quick jump : 
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
		</div>
	</div>
</div>
</body>
</html>