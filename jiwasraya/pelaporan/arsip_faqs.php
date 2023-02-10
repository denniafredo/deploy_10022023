<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB = new Database($userid, $passwd, $DBName);

echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
if ($idqa) {
#------------------------------- Mulai Jawab Pertanyaan -----------------------------------
	echo "<div align=\"center\">";
	$qry ="select idqa,userid,namauser,tglmasuk,tanya,jawab,status ".
			 "from $DBUser.tabel_faq where idqa='$idqa'";
	$DB->parse($query);
	$DB->execute();
	$arr = $DB->nextrow();
?>
<form method="POST" name="jawaban" action="<? echo $PHP_SELF;?>">
<table border="0" bgcolor="#000080" cellspacing="1" cellpadding="4" width="700">
  <tr>
    <td width="100%"><p align="center"><font color="#FFFFFF"><b>FAQs</b></font></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#FFFFFF">
      <table border="0" width="100%" cellspacing="3">
			  <tr>
          <td valign="top" align="left" class="verdana10blk">IDQA</td>
          <td><input type="text" name="id" size="5" value="<? echo $arr["IDQA"]; ?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">User ID</td>
          <td><input type="text" name="userid" size="5" value="<? echo $kantor ?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Nama</td>
          <td><input type="text" name="namauser" size="30" value="<? echo $arr["NAMAUSER"]; ?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Pertanyaan</td>
          <td><textarea rows="5" name="tanya" cols="70"><? echo $arr["TANYA"]; ?></textarea></td>
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
</form>
<a class="verdana10blk" href="javascript:history.back();">Back</a>
<?
#--------------------------------- Akhir Jawab Pertanyaan ---------------------------------
} else if ($upload) {
#--------------------------------- Mulai Hapus Pertanyaan ---------------------------------
echo "Pertanyaan sudah diupload .....<br><br>";	
	$sql="update $DBUser.tabel_faq set status='0' where idqa='$upload'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
echo "<a href=\"arsip_faqs.php?start=1&end=5\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";
#--------------------------------- Akhir Hapus Pertanyaan ---------------------------------
} else if ($hapus) {
#--------------------------------- Mulai Hapus Pertanyaan ---------------------------------
echo "Pertanyaan sudah dihapus .....<br><br>";	
	$sql="delete $DBUser.tabel_faq where idqa='$hapus'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
echo "<a href=\"arsip_faqs.php?start=1&end=5\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";
#--------------------------------- Akhir Hapus Pertanyaan ---------------------------------
} else if ($jawab) {
  $jawaban=strtoupper($jawaban);
	$jawaban=strip_tags(stripslashes($jawaban));
	$jawaban=ereg_replace("'","''",$jawaban);
	$sql="update $DBUser.tabel_faq set jawab='$jawaban',status='$status' where idqa='$id'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
	echo "Pertanyaan sudah terjawab....<br><br>";
  echo "<a href=\"arsip_faqs.php?start=1&end=5\" class=\"verdana10blk\">Back to Forum XL-iNdO</a>";
} else {
	echo "<font face=\"verdana\" size=\"2\">ARSIP FAQs</font>";
	echo "<hr size=\"1\">";
	echo "<div align=\"center\">";
	echo "<form name=\"jawab\" action=\"$PHP_SELF\" method=\"post\">";
	echo "<a class=\"verdana10blk\">Page : </a>";
	$sqla="select count(*) jml from $DBUser.tabel_faq where status='1'";
	$DB->parse($sqla);
	$DB->execute();
	$ara=$DB->nextrow();
	$jml=$ara["JML"];
	$perhal=5;
	$pg=ceil($jml/$perhal);
	for ($i=1; $i<=$pg; $i++) {
		$awal=$perhal*($i-1)+1;
		$akhir=$perhal*$i;
		if ($page==$i) {
			print "<font type=Verdana color=#660099><b>$i</b></font> ";
		} else {
			print "<a class=verdana10blk href=\"arsip_faqs.php?lihat=$lihat&start=$awal&end=$akhir&page=$i\">".$i." </a>";
		} 
	}
	$sql ="select * from (".
			 "select rownum k,idqa,userid,namauser,tglmasuk,tanya,jawab,status ".
			 "from $DBUser.tabel_faq where status='1' order by idqa desc) ".
			 "where k between $start and $end";
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
		<td bgcolor="#000080"><font color="#FFFFFF" face="Verdana" size="1"><b>Upload</b></font></td>
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
			case "": $status="<a href=\"arsip_faqs.php?idqa=$idqa\">JAWAB</a>"; break;
			default : $status="<a href=\"arsip_faqs.php?idqa=$idqa\">UPDATE</a>"; 
		}
?>
	<tr>
    <td bgcolor="#E7F5F8"><font size="1" face="Verdana"><? echo $i; ?></font></td>
		<td bgcolor="#E7F5F8"><font size="1" face="Verdana"><? echo $idqa; ?></font></td>
    <td bgcolor="#E7F5F8"><font size="1" face="Verdana"><? echo $tglmasuk; ?></font></td>
    <td bgcolor="#E7F5F8"><font size="1" face="Verdana"><? echo $user; ?></font></td>
    <td bgcolor="#E7F5F8"><font size="1" face="Verdana"><? echo $namauser; ?></font></td>
    <td bgcolor="#E7F5F8"><font size="1" face="Verdana"><? echo $tanya; ?></font></td>
		<td bgcolor="#E7F5F8"><font size="1" face="Verdana"><? echo $jawab; ?></font></td>
		<td bgcolor="#E7F5F8"><font size="1" face="Verdana"><a href="arsip_faqs.php?upload=<? echo $idqa; ?>">UPLOAD</a></font></td>		
		<td bgcolor="#E7F5F8"><font size="1" face="Verdana"><a href="arsip_faqs.php?hapus=<? echo $idqa; ?>">HAPUS</a></font></td>
  </tr>
<?
	}
	$i++;
echo "</table><a class=\"verdana10blk\">Page : </a>";
	for ($i=1; $i<=$pg; $i++) {
		$awal=$perhal*($i-1)+1;
		$akhir=$perhal*$i;
		if ($page==$i) {
			print "<font type=\"Verdana\" color=\"#660099\"><b>$i</b></font>";
		} else {
			print "<a class=\"verdana10blk\" href=\"arsip_faqs.php?lihat=$lihat&start=$awal&end=$akhir&page=$i\">".$i." </a>";
		}
	}
echo "</form>";
echo "</div>";
echo "<hr size=\"1\">";
echo "<a href=\"faqs.php?start=1&end=5\" class=\"verdana10blk\">Back to Forum XL-iNdO  |</a>&nbsp;<a href=\"admin_faqs.php?start=1&end=5\" class=\"verdana10blk\">Back to Admin FAQs</a>";
}
?>
