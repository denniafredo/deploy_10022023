<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	
 if ($val=='1') {
?>
<html>
<body onload="window.opener.document.ntryprop.indexawal.value='1';window.opener.document.ntryprop.notasip.value='Rp';window.close()">
<? 
 } else {
  $sql = "select to_char(sysdate,'DD/MM/YYYY') sisdate from dual ";
	$DB->parse($sql);
	$DB->execute();
	$arx=$DB->nextrow();
  $sysdet =$arx["SISDATE"];
	$tgl = (!$tgl||$tgl=='') ? $sysdet : $tgl;
	


	$sql="select namavaluta, notasi from $DBUser.tabel_304_valuta where kdvaluta='$val'";
	$DB->parse($sql);
	$DB->execute();
	$arx=$DB->nextrow();
											
	$sql="select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=(select max(tglkursberlaku) ".
	     "from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku<=to_date('$tgl','DD/MM/YYYY') ".
	     "and kdvaluta='$val') and kdvaluta='$val'";
  //echo  $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	echo("<html><body onload=\"javascript:window.opener.document.ntryprop.indexawal.value=".$arr["KURS"].";window.opener.document.ntryprop.notasip.value='".$arx["NOTASI"]."';window.close();\">");
	printf("<a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.indexawal.value='%s';window.opener.document.ntryprop.notasip.value='%s';".						 																																											
	  		 "window.close();\" ></a><br>",$arr["KURS"],$arx["NOTASI"]);
 }				 
?>
<p><b><font color="#800000">Tunggu,</font><br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
</body>
</html>