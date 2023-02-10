<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php"; 
  $DB=new Database($userid, $passwd, $DBName);

echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
if ($idqa) {
#--------------------------------- Mulai Jawab Pertanyaan --------------------------------
echo "<div align=\"center\">";
$ary="select idqa, userid, namauser, tglmasuk, tanya, jawab, status ".
		 "from $DBUser.tabel_faq where idqa='$idqa' ";
$DB->parse($ary);
$DB->execute();
$arr=$DB->nextrow();
?>
<form method="POST" name="jawaban" action="<? echo $PHP_SELF;?>">
<table border="0" bgcolor="#000080" cellspacing="1" cellpadding="4" width="700">
<tr>
<td width="100%"><p align="center"><font color="#FFFFFF"><b>FAQs</b></font></td>
  </tr>
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%" cellspacing="3" class="verdana10blk">
			  <tr>
          <td valign="top" align="left" class="verdana10blk">IDQA</td>
          <td><input type="text" class="a" readonly name="id" size="5" value="<? echo $arr["IDQA"]; ?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">User ID</td>
          <td><input type="text" class="a" readonly name="userid" size="5" value="<? echo $arr["USERID"]; ?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Nama</td>
          <td><input type="text" class="a" readonly name="namauser" size="30" value="<? echo $arr["NAMAUSER"]; ?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Pertanyaan</td>
          <td><textarea rows="5" class="a" readonly name="tanya" cols="70"><? echo $arr["TANYA"]; ?></textarea></td>
        </tr>
				<tr>
          <td valign="top" align="left" class="verdana10blk">Jawaban</td>
          <td><textarea rows="5" name="jawaban" cols="70"><? echo $arr["JAWAB"]; ?></textarea></td>
        </tr>
				<tr>
          <td valign="top" align="left" class="verdana10blk">Status</td>
          <td class="verdana10blk"><select size="1" name="status">
						<option value="0">0</option>
						<option value="1">1</option>
						</select>&nbsp;&nbsp;( 0 = Tampil; 1 = Jadi Arsip )
					</td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Submit" name="jawab"></td>
        </tr>
      </table>
		</td>
	</tr>
</table>
<input type="hidden" name="awal" value="<?echo $awal;?>">
<input type="hidden" name="akhir" value="<?echo $akhir;?>">
</form>
<a class="verdana10blk" href="javascript:history.back();">Back</a>
<?
#--------------------------------- Akhir Jawab Pertanyaan --------------------------------

} else if ($arsip) {
#--------------------------------- Mulai Hapus Pertanyaan --------------------------------

echo "Pertanyaan sudah diarsip .....<br><br>";
	$sql="update $DBUser.tabel_faq set status='1' where idqa='$arsip'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
echo "<a href=\"admin_faqs.php\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";


#--------------------------------- Akhir Hapus Pertanyaan --------------------------------

} else if ($hapus) {
#--------------------------------- Mulai Hapus Pertanyaan --------------------------------
echo "Pertanyaan sudah dihapus .....<br><br>";
	$sql="delete $DBUser.tabel_faq where idqa='$hapus'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
echo "<a href=\"admin_faqs.php\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";
#--------------------------------- Akhir Hapus Pertanyaan --------------------------------
} else if ($jawab) {
  //$jawaban=strtoupper($jawaban);
	$sql="update $DBUser.tabel_faq set jawab='$jawaban',status='$status',tgljawab=sysdate where idqa='$id'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
	echo "Pertanyaan sudah terjawab....<br><br>";
//  echo "<a href=\"admin_faqs.php?start=$awal&end=$akhir\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";
  echo "<a href=\"admin_faqs.php\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";
} else {
?>
<font face="verdana" size="2">LIST PERTANYAAN</font>
<hr size="1">
<div align="center">
<form name="jawab" action="<? echo $PHP_SELF; ?>" method="post">
<a class=verdana10blk>Page : </a>
<?	
$abc="select count(*) jml from $DBUser.tabel_faq where status='0'";
$DB->parse($abc);
$DB->execute();
$ara=$DB->nextrow();
$jml=$ara["JML"];

		$sqlb = "select max(idqa) maxidqa from $DBUser.tabel_faq where status='0'";
		$DB->parse($sqlb);
		$DB->execute();
		$arb=$DB->nextrow();
		$maxid = $arb["MAXIDQA"];
		
$perhal=5;
$pg=ceil($jml/$perhal);
for ($i=1; $i<=$pg; $i++) {
		$awal = $maxid - ($perhal*$i) + 5;
		$akhir = $awal - $perhal;
		
		 if ($page==$i) {
		   print "<font type=Verdana color=#660099 size=3><b>|hal $i|</b></font> ";
     } else {
       print "<a class=verdana10blk href=\"admin_faqs.php?lihat=$lihat&start=$akhir&end=$awal&page=$i#start\">".$i." </a>";
     } 
	/*
	$awal=$perhal*($i-1)+1;
	$akhir=$perhal*$i;
	if ($page==$i) {
	  print "<font type=Verdana color=#660099><b>$i</b></font> ";
	} else {
		print "<a class=verdana10blk href=\"admin_faqs.php?lihat=$lihat&start=$awal&end=$akhir&page=$i\">".$i." </a>";
	} 
	*/
}

		if(!$start){
		 $start=$maxid-5;
		 $end=$maxid;
		}
		
$sql="select rownum k, idqa, userid, namauser, tglmasuk, tanya, jawab, status ".
		 "from $DBUser.tabel_faq where status='0' and idqa between $start and $end order by idqa desc";
//echo $sql;

$DB->parse($sql);
$DB->execute();
?>
<table border="0" cellspacing="1" cellpadding="2" width="800">
  <tr>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>No.</b></font></td>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>IDQA</b></font></td>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>Tanggal</b></font></td>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>User</b></font></td>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>Nama</b></font></td>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>Pertanyaan</b></font></td>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>Jawaban</b></font></td>
		<td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>Arsip</b></font></td>
    <td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>Hapus</b></font></td>
  </tr>
<?
$i=0;
while ($arr=$DB->nextrow()) {
	$i=$i+1;
	$idqa=$arr["IDQA"];
	$user=$arr["USERID"];
	$namauser=$arr["NAMAUSER"];
	$tglmasuk=$arr["TGLMASUK"];
	$tanya=$arr["TANYA"];
	$jawab=$arr["JAWAB"];
	switch ($jawab){
		case "": $status="<a href=\"admin_faqs.php?idqa=$idqa&awal=$awal&akhir=$akhir\">JAWAB</a>"; break;
		default : $status="<a href=\"admin_faqs.php?idqa=$idqa&awal=$awal&akhir=$akhir\">UPDATE</a>"; 
	}
	echo "<tr>";
  echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\">$i</font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\">$idqa</font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\">$tglmasuk</font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\">$user</font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\">$namauser</font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\">$tanya</font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\">$status</font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\"><a href=\"admin_faqs.php?arsip=$idqa\">ARSIP</a></font></td>";
	echo "<td bgcolor=\"#E7F5F8\"><font size=\"1\" face=\"Verdana\"><a href=\"admin_faqs.php?hapus=$idqa\">HAPUS</a></font></td>";
	echo "</tr>";
}
$i++;
echo "</table><a class=\"verdana10blk\">Page : </a>";
for ($i=1; $i<=$pg; $i++) {
		$awal = $maxid - ($perhal*$i) + 5;
		$akhir = $awal - $perhal;
		
		 if ($page==$i) {
		   print "<font type=Verdana color=#660099 size=3><b>|hal $i|</b></font> ";
     } else {
       print "<a class=verdana10blk href=\"admin_faqs.php?lihat=$lihat&start=$akhir&end=$awal&page=$i#start\">".$i." </a>";
     } 
  /*
	$awal=$perhal*($i-1)+1;
	$akhir=$perhal*$i;
	if ($page==$i) {
		echo "<font type=Verdana color=#660099><b>$i&nbsp;</b></font>";
	} else {
		echo "<a class=verdana10blk href=\"admin_faqs.php?lihat=$lihat&start=$awal&end=$akhir&page=$i\">".$i." </a>";
	}
	*/
}

echo "</form>";
echo "<a class=\"verdana8blk\" href=\"info_admin_faqs.php\">| UPDATE INFORMASI TERBARU |</a>&nbsp;<a class=\"verdana8blk\" href=\"arsip_faqs.php?start=1&end=5\"> ARSIP FAQs |</a>";
echo "</div>";
echo "<hr size=\"1\">";
echo "<a href=\"faqs.php\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";
}
?>
