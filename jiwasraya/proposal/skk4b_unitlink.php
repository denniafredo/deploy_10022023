<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	$DB=New database($userid, $passwd, $DBName);	
  $today = date("d F Y"); 



$sql="select ". 
          "a.notertanggung, ".
					"b.namaklien1,".
					"b.jeniskelamin,".
					"decode(b.jeniskelamin,'L','Laki-laki','Perempuan') namajk ".
		 "from ".
		      "$DBUser.tabel_200_pertanggungan a,".
					"$DBUser.tabel_100_klien b ".
     "where ".
		      "b.noklien=a.notertanggung and ". 
		      "a.prefixpertanggungan='$kantor' and a.nopertanggungan='$noproposal'";
$DB->parse($sql);
$DB->execute();
$ttg=$DB->nextrow();
$noklien=$ttg["NOTERTANGGUNG"];
$namaklien=$ttg["NAMAKLIEN1"];
$jnskelamin=$ttg["JENISKELAMIN"];


if($submit)
{
 $sql = "update $DBUser.tabel_119_ket_kesehatan set statusskk='1' ".
        "where noklien='$noklien' ";
 //echo $sql;
 $DB->parse($sql);
 $DB->execute();
 
 echo "<script language=\"JavaScript\" type=\"text/javascript\">";
 echo "window.location.replace('../mnuptgbaru.php');";
 echo "</script>";	
}

?>
<html>
<head>
<title>Data Kesehatan Lanjutan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<body>
<div align="center">
<form name="formisianskk" method="post" action=<? echo $PHP_SELF; ?>>
<input type="hidden" name="noklien" value=<? echo $noklien; ?>>
<table align="center" border="0" width="700" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%"  cellpadding="0" cellspacing="0">
        <tr>
				  <td width="16%" colspan="2" class="arial10">Nomor Proposal</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><?echo $kantor." - ".$noproposal;?></td><br>
				  <td width="53%" colspan="3" class="verdana8" align="center"></td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><?echo $today;?></td>
        	<td width="53%" colspan="3" class="verdana8" align="center"></td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tertanggung</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb" align="left"><?=$namaklien;?></td>
          <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>
        <tr>
          <td width="16%" colspan="2" class="arial10">Jenis Kelamin</td>
					<td width="1%"class="arial10" align="center">:</td>
          <td width="30%"class="verdana10blkb" align="left"><?=$ttg["NAMAJK"];?></td>
         <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>				
      </table>
      <table border="0" width="100%">
        <tr>
          <td width="100%" class="hijao" align="center">RIWAYAT KESEHATAN TERTANGGUNG</td>
			  </tr>
        <tr>
          <td width="100%" class="verdana8" align="center">Anda Telah Selesai Mengisi Surat Keterangan Kesehatan, 
					<h4>Silakan klik tombol <b>SELESAI</b> supaya proposal Unit Link dapat diakseptasi</h4>
					<b>Terima Kasih!</b></td>
        </tr>				
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="5%" class="c" align="center">Kode</td>
					<td width="45%" class="c" align="center">Pertanyaan</td>
					<td width="50%" class="c" align="center">Jawaban</td>
				</tr>
        <?
        $sql="select a.kditem, a.namaitem, b.kdstatus, b.keterangan ".
              		 	 "from $DBUser.tabel_999_item_kesehatan a, $DBUser.tabel_119_ket_kesehatan b ".
              			 "where a.kelompok='U' and a.kditem=b.kditem(+) and b.noklien(+)='$noklien' ".
        						 "and substr(a.kditem,2,1) > '2' ".
              		 	 "order by a.kditem";
        //echo $sql;
        $DB->parse ($sql);
        $DB->execute();
        $i=1;
        while ($arr=$DB->nextrow()) {
        	include "../../includes/belang.php";
        	if (strlen($arr["KDITEM"])==2) {
        		$kelas="arial10bold";
        		$col=2;
        		$align="right";
        		$ket='';
        	} else if (strlen($arr["KDITEM"])==3) {
        		$kelas="arial10";
        		$col='';
        		$align="center";
        		$ket=": ".$arr["KDSTATUS"];
        	} else if (strlen($arr["KDITEM"])==4) {
        		$kelas="arial10";
        		$col='';
        		$align="right";
        		$ket=": ".$arr["KETERANGAN"];
        	}
        	
        	if(substr($arr["KDITEM"],0,2)=="*9")
        	{
        				  $nomor = "10";
        	} else {
        				  $nomor = substr($arr["KDITEM"],-1);
        	}
        				
        	echo "<td width=\"5%\" class=\"$kelas\" valign=top align=\"$align\">".(strlen($arr["KDITEM"])==2 ? "".$nomor."" : "")."&nbsp;&nbsp;</td>";
        	echo "<td width=\"45%\" class=\"$kelas\" colspan=\"$col\">".(strlen($arr["KDITEM"])==4 ? "".substr($arr["KDITEM"],-1).".&nbsp;&nbsp;" : "")."".$arr["NAMAITEM"]."</td>";
        	echo "<td width=\"50%\" class=\"$kelas\">$ket</td>";
        	echo "</tr>";
        $i++;
        }
        ?>
			</table><p>&nbsp;</p>
    </td>
  </tr>
</table>
<table width="700" border="0">
	<tr>
  	<td align="left" class="arial10"><a href="#" onClick="window.history.go(-1)">Back</a></td>
	  <td align="right">
		  <!--
			<input type="button" name="button" value="Selesai" onclick="window.location.replace('../mnuptgbaru.php')">
			-->
			<input type="button" onClick="<?="window.open('skk_print.php?no_proposal=$noproposal&ul=1', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,fullscreen=yes');"?>;" value="CETAK" >
			<input type="submit" name="submit" value="SELESAI">
			<input type="hidden" name="noproposal" value="<?=$noproposal;?>">
		</td>
  </tr>
  <tr>
	</tr>
</table>
</form>
</body>
</html>
