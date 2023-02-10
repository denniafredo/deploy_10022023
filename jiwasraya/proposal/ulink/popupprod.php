<?
  include "./includes/database.php";  
  include "./includes/session.php";  
	$DB=new database($userid, $passwd, $DBName);
	
	$sql="select kdproduk,namaproduk ".
	     "from $DBUser.tabel_202_produk order by namaproduk";
  $DB->parse($sql);
	$DB->execute();
?>
<html>
<head>
<title>Daftar Proposal</title>
<script language="JavaScript" type="text/javascript">
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}
</script>
</head>
<link href="./jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<font face="Verdana" size="2" color="#00339"><b>Kode Produk</b></font>
<hr size="1">
<?
echo "<table>";
  $i = 0;
  while($arr=$DB->nextrow()) {
	$kdproduk = $arr["KDPRODUK"];
	$namaproduk = $arr["NAMAPRODUK"];
	include "./includes/belang.php";
/*		 if ($i % 2==0) {
		 echo "<tr bgcolor=#e0e0e4>";
		 } else	{						
	   echo "<tr>";
		 }*/	
		echo "<td><font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"window.open('popbenefit.php?kdproduk=$kdproduk&namaproduk=$namaproduk','updclnt','scrollbars=yes,width=300,height=300,top=100,left=500');\">".$arr["KDPRODUK"]."</a></font></td>";
		echo "<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAPRODUK"]."</font></td>";
    echo "</tr>";
		$i++;
	}
?>
</table>
<? 
echo "<hr size=\"1\">";
echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
?>
<br><br>
</body>
</html>
