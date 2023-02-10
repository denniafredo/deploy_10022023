<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB = new Database($userid, $passwd, $DBName);
?>


<script>
var limit="5:00"

if (document.images){
	var parselimit=limit.split(":")
	parselimit=parselimit[0]*60+parselimit[1]*1
}
function beginrefresh(){
	if (!document.images)
		return
	if (parselimit==1)
		window.location.reload()
	else { 
		parselimit-=1
		curmin=Math.floor(parselimit/60)
		cursec=parselimit%60
	if (curmin!=0)
		curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
	else
		curtime=cursec+" seconds left until page refresh!"
		window.status=curtime
		setTimeout("beginrefresh()",1000)
	}
}
window.onload=beginrefresh
</script>

<link href="../jws.css" rel="stylesheet" type="text/css">
<? 
if ($submit)	{
	if (!strlen($tanya)==0) {
	 $query="select max(to_number(idqa)) as maxidqa from $DBUser.tabel_faq";
	}
	$DB->parse($query);
	$DB->execute();
	$arr = $DB->nextrow();
	$maxidqa = $arr["MAXIDQA"];
	$idqa = $maxidqa+1;		
	
	$tanya=strtoupper($tanya);
	$tanya=strip_tags(stripslashes($tanya));
	$tanya=ereg_replace("'","''",$tanya);
	$namauser=strtoupper($namauser);
	$namauser=strip_tags(stripslashes($namauser));
	$namauser=ereg_replace("'","''",$namauser);
	$sql = "insert into $DBUser.tabel_faq(idqa,userid,namauser,tglmasuk,tanya,status,kdkantor) ".
			   "values ('$idqa','$userid','$namauser',sysdate,'$tanya','0','$kantor')";
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
	echo "Pertanyaan Anda sudah masuk ke database,dengan id=$idqa. Mohon tunggu jawabannya pada menu Forum XL-iNdO<br><br>";
	echo "<a href=\"faqs.php?start=1&end=5\">Lihat Forum XL-iNdO</a>";
} else if ($add) {
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<b>TAMBAH PERTANYAAN</b>
<hr size="1">
<script LANGUAGE="JavaScript">
function submitForms() {
	if ( (isName()) && (isTanya()) )
	//if ( isName() && (isAsk())
	if (confirm) {
		return true;
	} else {
		return false;      
	} else
	return false;
}
function isName() {
	var str = document.faq.namauser.value;
	if (str == "") {
		alert("Silakan isi Nama Anda !!")
		document.faq.namauser.focus();
		return false;
	}
	return true;
}
function isTanya() {
	var str = document.faq.tanya.value;
	if (str == "") {
		alert("Silakan isi pertanyaan Anda !!")
		document.faq.tanya.focus();
		return false;
	}
	return true;
}
</script>



<div align="center">
<form method="POST" name="faq" action="<? echo $PHP_SELF;?>" onSubmit="return submitForms()">
<table border="0" bgcolor="#000080" cellspacing="1" cellpadding="4" width="600">
  <tr>
    <td width="100%" class="verdana10blk"><p align="center"><font color="#FFFFFF"><b>FORUM XL-iNdO</b></font></td>
  </tr>
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%" cellspacing="3"  class="verdana10blk">
        <tr>
          <td valign="top" align="left">User ID</td>
          <td><input type="text" name="user" class="a" readonly size="8" value="<? echo $userid; ?>">
					&nbsp;Kantor : &nbsp;<input type="text" name="ktr" class="a" readonly size="2" value="<? echo $kantor; ?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Nama</td>
          <td><input type="text" name="namauser" size="30"  class="a" readonly value="<?echo $namusr;?>"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Pertanyaan</td>
          <td><textarea rows="5" name="tanya" cols="60"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Submit" name="submit"><input type="reset" value="Reset" name="B2"><!--<input type="submit" value="Lihat FAQ" name="lihat">--></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</div>
<hr size="1">
<a href="faqs.php?start=1&end=5" class="verdana10blk">Kembali ke Forum XL-iNdO</a>
<?
} else {
?>
<body>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%">
<hr size="1">
	<a class="verdana10blk"><font color="#663366">
	<img src="../img/faqs_xlindo.gif" align="left">
	Forum ini diperuntukkan bagi pertanyaan-pertanyaan sederhana yang membutuhkan jawaban 
	cepat. Untuk pertanyaan yang melampirkan contoh-contoh screen capture 
	dan membutuhkan jawaban yang cukup kompleks pula, dapat ditujukan ke 
	alamat email <b>xlindo@jiwasraya.co.id</b>. Saran dan kritik membangun merupakan masukan yang sangat 
	berharga untuk kemajuan pengembangan aplikasi ini, terima kasih atas perhatian Anda.</font></a>
	</td>
  </tr>
	<tr>
	  <td><hr size="1"><br>
		</td>
  </tr>
</table>

	<div align="center">	
		<? 
		/*				 
		$qrs = "select * from (select rownum k,idqa,userid,namauser,".
		       "to_char(tglmasuk,'DD/MM/YYYY HH24:MI:SS') tglmasuk,".
					 "to_char(tgljawab,'DD/MM/YYYY HH24:MI:SS') tgljawab,tanya,jawab,status ".
					 "from $DBUser.tabel_faq where status='0' order by idqa desc) where ".
					 "k > 150 order by k desc";
		//echo $qrs;			 
		$DB->parse($qrs);
		$DB->execute();
		while ($ars=$DB->nextrow()) {
		 $idfaq = $ars["IDQA"];
	   $sql = "update $DBUser.tabel_faq set status='1' where idqa='$idfaq'";
		 $DB->parse($sql);
	   $DB->execute();
	   $DB->commit();
		}
		*/
		$qry = "select to_char(tglmasuk,'DD/MM/YYYY HH24:MI:SS') tglmasuk,tanya ".
					 "from $DBUser.tabel_faq where status='3'";
		$DB->parse($qry);
		$DB->execute();
		$ary=$DB->nextrow();
		$tgl = $ary["TGLMASUK"];
		$info = $ary["TANYA"];
		//echo "Tanggal : ".$tgl."<br>";
		//echo $info;
		 ?>
	<table border="0" width="800" cellspacing="1" cellpadding="0" bgcolor="#000080">
  <tr>
    <td width="100%" align="center">
       <a class="verdana10blk"><font color="#FFFFFF"><b>PENGUMUMAN DARI ADMINISTRATOR</b></font></a><br>
			 <a class="verdana8blk"><font color="#FFFFFF"><? echo "Tanggal : ".$tgl; ?></font></a>
		</td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#CADFF7">

		<table border="0" width="100%" cellspacing="6" cellpadding="6">
		    <tr>
          <td width="100%"  class="verdana8blk">
					
				  </td>
				</tr>	
        <tr>
          <td width="100%"  class="verdana8blk">
					<? echo $info; ?><br>
		       </td>
        </tr>
      </table>
		</td>
  </tr>
</table>

  <form name="add" action="<? echo $PHP_SELF; ?>" method="post">
	<a class=verdana10blk name="start">Page : </a>
			<?
		#-------------------------------------------------------------- countrow
		$sqla = "select count(*) jml from $DBUser.tabel_faq where status='0'";
		$DB->parse($sqla);
		$DB->execute();
		$ara=$DB->nextrow();
		$jml = $ara["JML"];
		
		$sqlb = "select max(idqa) maxidqa from $DBUser.tabel_faq where status='0'";
		//$sqlb = "select max(to_number(idqa)) as maxidqa from $DBUser.tabel_faq where status='0'";
		
		$DB->parse($sqlb);
		$DB->execute();
		$arb=$DB->nextrow();
		$maxid = $arb["MAXIDQA"];
		
		$perhal=5;
		$pg = ceil($jml / $perhal);
		for ($i = 1; $i <= $pg; $i++) {
		//$awal = $perhal*($i-1)+1;
		//$akhir = $perhal*$i;
		$awal = $maxid - ($perhal*$i) + 5;
		$akhir = $awal - $perhal;
		
		 if ($page==$i) {
		   print "<font type=Verdana color=#660099 size=3><b>|hal $i|</b></font> ";
     } else {
       print "<a class=verdana10blk href=\"faqs.php?lihat=$lihat&start=$akhir&end=$awal&page=$i#start\">".$i." </a>";
     } 
		 
    }
	 ?>
	<table border="0" cellspacing="1" cellpadding="2" width="800" bgcolor="#E7F5F8">
	<tr>
	 <td colspan="3"></td>
	</tr>
	 <?
		#-------------------------------------------------------------- countrow
    /*
		$query = "select * from (".
		         "select rownum k,idqa,kdkantor,userid,namauser,to_char(tglmasuk,'DD/MM/YYYY HH24:MI:SS') tglmasuk,".
						 "to_char(tgljawab,'DD/MM/YYYY HH24:MI:SS') tgljawab,tanya,jawab,status ".
						 "from $DBUser.tabel_faq where status='0' order by idqa desc) where k between $start and $end order by k desc";
	  */
		
		if(!$start){
		 $start=$maxid-5;
		 $end=$maxid;
		}
		$query = "select idqa,kdkantor,userid,namauser,to_char(tglmasuk,'DD/MM/YYYY HH24:MI:SS') tglmasuk,".
						 "to_char(tgljawab,'DD/MM/YYYY HH24:MI:SS') tgljawab,tanya,jawab,status ".
						 "from $DBUser.tabel_faq where status='0' and idqa between $start and $end order by idqa desc";
		
		$DB->parse($query);
		$DB->execute();
		//echo "<br>".$query."<br><br>";
		$i = 0;
		while ($arr=$DB->nextrow()) {
		//$i = $i + 1;
		$idqa=$arr["IDQA"];
		$user=$arr["USERID"];
		$kdkantor=$arr["KDKANTOR"];
		$namauser=$arr["NAMAUSER"];
		$tglmasuk=$arr["TGLMASUK"];
		$tgljawab=$arr["TGLJAWAB"];
		$tanya=$arr["TANYA"];
		$jawab=$arr["JAWAB"];
		
		switch($jawab) {
				case '': $jawab = "<font color=red>BELUM DIJAWAB</font>"; break;
				default: $jawab = $jawab." <font color=blue> $tgljawab </font>";		
		}
    
  print( "  <tr>\n" );
  print( "    <td width=\"8%\" class=\"verdana8blk\" valign=\"top\" align=\"left\"><b>Tanya</b></td>\n" );
  print( "    <td width=\"2%\" class=\"verdana8blk\" valign=\"top\" align=\"left\">:</td>\n" );
  print( "    <td width=\"90%\" class=\"verdana8blk\"><font size=1 color=\"#000080\">$tanya</font></td>\n" );
  print( "  </tr>\n" );
  print( "  <tr>\n" );
  print( "    <td class=\"verdana8blk\"></td>\n" );
  print( "    <td class=\"verdana8blk\"></td>\n" );
  print( "    <td class=\"verdana8blk\"><font color=red>ID:$idqa </font>USER: $user ($namauser)<font color=blue> $tglmasuk </font><font color=green>KANTOR:$kdkantor</font></td>\n" );
  print( "  </tr>\n" );
  print( "  <tr>\n" );
  print( "    <td class=\"verdana8blk\" valign=\"top\" align=\"left\"><b>Jawab</b></td>\n" );
  print( "    <td class=\"verdana8blk\" valign=\"top\" align=\"left\">:</td>\n" );
  print( "    <td class=\"verdana8blk\">$jawab </td>\n" );
  print( "  </tr>" );
	print( "  <tr>\n" );
  print( "    <td class=\"verdana10blk\" colspan=\"3\"><hr size=1></td>\n" );
  print( "  </tr>" );	
		$i++;
		}
	
		?>
	</table><a class=verdana10blk>Page : </a>
		 	<? 
	  for ($i = 1; $i <= $pg; $i++) {
		 $awal = $maxid - ($perhal*$i) + 5;
		 $akhir = $awal - $perhal;

		 if ($page==$i) {
		    print "<font type=Verdana color=#660099 size=3><b>|hal $i|</b></font> ";
     } else {
     	  print "<a class=verdana10blk href=\"faqs.php?lihat=$lihat&start=$akhir&end=$awal&page=$i#start\">".$i." </a>";
     } 
		 /*
		$awal = $perhal*($i-1)+1;
		$akhir = $perhal*$i;
		echo $awal." - ".$akhir."<br>";
		 if ($page==$i) {
		  print "<font type=Verdana color=#660099 size=3><b>|hal $i|</b></font> ";
     } else {
      print "<a class=verdana10blk href=\"faqs.php?lihat=$lihat&start=$awal&end=$akhir&page=$i#start\">".$i." </a>";
     } 
		 */
    }
	 ?>
	 <br><br>
	 <input type="submit" value="TAMBAH PERTANYAAN" name="add"><a href="faqs_passwd.php">.</a>
	<!-- <a href="admin_faqs.php?lihat=<? echo $idqa; ?>&start=1&end=5&page=1">.</a> -->
	</div>
	</form>
<a class="verdana10blk">Pencarian FAQs klik di</a> <a class="verdana10blk" href="faqssearch.php">sini</a> !
<hr size="1">
<a href="index.php" class="verdana10blk">Menu Pelaporan</a>	
</body>
<? 
}
 ?>
