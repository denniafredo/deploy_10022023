<?
  include "../../includes/session.php";
  include "../../includes/database.php";

	if($_GET['act']=="ulang")
	{
		$DBdel = New database($userid, $passwd, $DBName);
		$sql1="delete from $DBUser.tabel_118_cek_skk where noklien in ('$noklien')";
		$DBdel->parse($sql1);
		$DBdel->execute();
		$sql2="delete from $DBUser.tabel_118_klien_diagnosa where noklien in ('$noklien')";
		$DBdel->parse($sql2);
		$DBdel->execute();
		$sql3="delete from $DBUser.tabel_116_riwayat_kel_nul where noklien in ('$noklien')";
		$DBdel->parse($sql3);
		$DBdel->execute();
		$sql4="delete from $DBUser.tabel_118_gejala_penyakit where noklien in ('$noklien')";
		$DBdel->parse($sql4);
		$DBdel->execute();
		$sql5="delete from $DBUser.tabel_118_klien_penyakit where noklien in ('$noklien')";
		$DBdel->parse($sql5);
		$DBdel->execute();
		$sql6="delete from $DBUser.tabel_118_periksa_penyakit where noklien in ('$noklien')";
		$DBdel->parse($sql6);
		$DBdel->execute();
		$sql7="delete from $DBUser.tabel_118_operasisht where noklien in ('$noklien')";
		$DBdel->parse($sql7);
		$DBdel->execute();
		$sql8="delete from $DBUser.tabel_100_hobby_klien where noklien in ('$noklien')";
		$DBdel->parse($sql8);
		$DBdel->execute();
		$sql9="delete from $DBUser.tabel_118_klien_wanita where noklien in ('$noklien')";
		$DBdel->parse($sql9);
		$DBdel->execute();
	}
  $noproposal=$nopertanggungan;
	$DB = New database($userid, $passwd, $DBName);
	$DB1 = New database($userid, $passwd, $DBName);
	$sqlcek="select count(*) jml from  $DBUser.tabel_118_cek_skk where noklien='$noklien'";
	$DB->parse($sqlcek);
    $DB->execute();
    $arrcek=$DB->nextrow();
	if($arrcek["JML"]>0){
	?>
    Klien ini sudah mempunyai .<a class="arial10" href="skk_newjslink.php?<? echo "noklien=$noklien"; ?>">SKK</a></td>
	<?php	//echo "Klien ini sudah mempunyai SKK.";
	}else{
  
  
  $today = date("d F Y");
  $noklien=$_GET['noklien'];
  $sqltert2="select nopemegangpolis notertanggung2 from $DBUser.tabel_200_pertanggungan where notertanggung='".$_GET['noklien']."' and nopemegangpolis<>notertanggung";
 // echo $sqltert2;
  $DB1->parse($sqltert2);
  $DB1->execute();
  $arrtert2=$DB1->nextrow();
  $notert2=$arrtert2["NOTERTANGGUNG2"];
  if($notert2!=""){
	if($_GET['act']=="ulang")
	{
		$DBdel2 = New database($userid, $passwd, $DBName);
		$sql1="delete from $DBUser.tabel_118_cek_skk where noklien in ('$notert2')";
		$DBdel2->parse($sql1);
		$DBdel2->execute();
		$sql2="delete from $DBUser.tabel_118_klien_diagnosa where noklien in ('$notert2')";
		$DBdel2->parse($sql2);
		$DBdel2->execute();
		$sql3="delete from $DBUser.tabel_116_riwayat_kel_nul where noklien in ('$notert2')";
		$DBdel2->parse($sql3);
		$DBdel2->execute();
		$sql4="delete from $DBUser.tabel_118_gejala_penyakit where noklien in ('$notert2')";
		$DBdel2->parse($sql4);
		$DBdel2->execute();
		$sql5="delete from $DBUser.tabel_118_klien_penyakit where noklien in ('$notert2')";
		$DBdel2->parse($sql5);
		$DBdel2->execute();
		$sql6="delete from $DBUser.tabel_118_periksa_penyakit where noklien in ('$notert2')";
		$DBdel2->parse($sql6);
		$DBdel2->execute();
		$sql7="delete from $DBUser.tabel_118_operasisht where noklien in ('$notert2')";
		$DBdel2->parse($sql7);
		$DBdel2->execute();
		$sql8="delete from $DBUser.tabel_100_hobby_klien where noklien in ('$notert2')";
		$DBdel2->parse($sql8);
		$DBdel2->execute();
		$sql9="delete from $DBUser.tabel_118_klien_wanita where noklien in ('$notert2')";
		$DBdel2->parse($sql9);
		$DBdel2->execute();
	}
	//  $disebled="disabled";
  }else{
	//  $disebled="";
  }
 // echo $notert2;
	//$PER = New Pertanggungan($userid,$passwd,$kantor,$noproposal);
/*if ($submit=='Lanjut') {
	$alamatkerja=strtoupper($alamatkerja);
	$alamattetap01=strtoupper($alamattetap01);
  $qry="update $DBUser.tabel_100_klien set kdpekerjaanlama='$kdpekerjaanlama',alamatkerja='$alamatkerja',".
	     "kdgantipekerjaan='$kdgantipekerjaan',tglkawin=to_date('$tglkawin','DD/MM/YYYY') ".
		   "where noklien='$noklien'";
	$DB->parse($qry);
  $DB->execute();
  $DB->commit;
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "window.location.replace('skk2.php?noproposal=".$proposalno."&tglmutasi=".$tglmutasi."&jnscari=".$jnscari."');\n" );
  print( "</script> \n" );
}
else
{*/
  $sql ="select a.noklien,a.namaklien1 tertanggung1,a.tempatlahir,a.kdpekerjaan,a.alamattetap01,a.alamatkerja, ".
			 "decode(a.jeniskelamin,'L','LAKI-LAKI','P','PEREMPUAN') jeniskelamin,a.tinggibadan,a.beratbadan, ".
			 "a.meritalstatus, decode(a.meritalstatus,'D','DUDA','J','JANDA','L','LAJANG','K','KAWIN') namameritalstatus, ".
       "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir,to_char(a.tglkawin,'DD/MM/YYYY') nganten, ".
			 "c.namapekerjaan,a.kdpekerjaanlama,a.kdgantipekerjaan,d.namaid,a.noid,a.kdid, ".
			 "(select namaklien1 from $DBUser.tabel_100_klien where noklien='".$_GET['noklien']."') tertanggung1 ".
       "from ".
			 "$DBUser.tabel_100_klien a,  ".
			 "$DBUser.tabel_105_pekerjaan c, $DBUser.tabel_104_kartu_identitas d ".
		   "where a.noklien='".$_GET['noklien']."' and a.kdpekerjaan=c.kdpekerjaan(+) and a.kdid=d.kdid(+)";
  //echo $sql;
	$DB->parse($sql);
  $DB->execute();
  $arr=$DB->nextrow();
?>
<html>
  <head>
    <title>Data Pribadi Tertanggung
    </title>
    <link href="../../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<?
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "function OnLod(){\n" );
	$sql="select kdpekerjaan,namapekerjaan from $DBUser.tabel_105_pekerjaan order by namapekerjaan";
	$DB->parse($sql);
	$DB->execute();
	$i=0;
	while($data=$DB->nextrow()){
	  if ($arr["KDPEKERJAANLAMA"]==$data["KDPEKERJAAN"]) {
	    print("document.skk1.kdpekerjaanlama.options[".$i."].selected='true';\n" );
	  }
  	$i++;
  }
  if ($arr["KDGANTIPEKERJAAN"]) {
	  print("document.skk1.kdgantipekerjaan[0].checked='true';\n" );
  }
	print("document.skk1.alamatkerja.value='".$arr["ALAMATKERJA"]."';\n" );
  print( "}\n" );
  print( "</script>" );
    ?>
  </head>
  <body onLoad="OnLod()">
    <div align="center">
      <form name="skk1" action="skk2_newjslink.php" method="post">
        <table align="center" border="0" width="800" cellpadding="1" cellspacing="2" class="tblhead">
          <tr>
            <td width="100%" class="tblisi">
              <table border="0" width="100%"  cellpadding="0" cellspacing="0">
                <tr>
                  <td width="16%" colspan="2" class="arial10">&nbsp;</td>
                  <td width="1%" class="arial10" align="center">&nbsp;</td>
                  <td width="30%" class="verdana10blkb">&nbsp;</td>
                  <br>
                  <td width="53%" colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar,</td>
                </tr>
                <tr>
                  <td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
                  <td width="1%" class="arial10" align="center">:</td>
                  <td width="30%" class="verdana10blkb">
                    <? echo $today;?></td>
                  <td width="53%" colspan="3" class="verdana8" align="center">Beri Tanda V Pada Kolom Yang Sesuai.</td>
                </tr>
                <tr>
                  <td width="16%" colspan="2" class="arial10">Tertanggung</td>
                  <td width="1%" class="arial10" align="center">:</td>
                  <td width="30%" class="verdana10blkb" align="left">
<?
					 echo $arr["TERTANGGUNG1"];
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $PER->notertanggung." - ".$KLIEN->nama;
                    						?></td>
                  <td width="16%" class="arial8ab"></td>
                  <td width="35%"></td>
                  <td width="2%" class="arial8ab"></td>
                </tr>
              </table>
              <table border="0" width="100%">
                <tr>
                  <td width="100%" class="hijao" align="center">J A T I D I R I</td>
                </tr>
              </table>
              <table border="0" width="100%">
                <tr class="hijau">
                  <td width="1%"></td>
                  <td class="arial10" colspan="7">Saya Yang Bertanda-tangan di Bawah Ini :</td>
                </tr>
                <tr>
                  <td width="1%"></td>
                  <td width="16%"><span class="arial10">Nama Lengkap</span></td>
                  <td width="1%">:</td>
                  <td width="53%"><input type="text" class="a" name="namaklien1"  size="45" readonly value="<?=$arr["TERTANGGUNG1"]; ?>"></td>
                  <td colspan="2">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
                <tr>
                  <td width="1%"></td>
                  <td width="16%"><span class="arial10">Jenis Kelamin</span></td>
                  <td width="1%">:</td>
                  <td width="53%"><span class="arial10"> <input type="text" class="a" name="jeniskelamin" size="45" readonly value="<?=$arr["JENISKELAMIN"]; ?>"></span></td>
                  <td colspan="2" class="arial10">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
              </table>
              <table border="1" class="verdana8" bordercolor="#000000">
                <tr><td>Calon  Tertanggung  yang ikut dalam program asuransi harus menjawab  semua pertanyaan dalam SPAJ dan SKK ini ( dan dalam pernyataan pribadi yang menyangkut kesehatan yang diajukan oleh Penanggung atau pemeriksa kesehatan ) secara lengkap dan jujur. Jika tidak, dan  mengakibatkan berubahnya keputusan Underwriting maka dapat terjadi pembatalan Polis yang telah diterbitkan. </td>
                </tr>
              </table>
              <table width="796" height="233" border="1" style="border-collapse:collapse">
                <tr class="verdana8">
                  <td rowspan="2" align="center"  width="206">Keluarga Tertanggung Utama</td>
                  <td colspan="7" align="center">Masih Hidup</td>
                  <td colspan="2" align="center">Sudah Meninggal</td>
                </tr>
                <tr class="verdana8">
                  <td width="53" align="center">Jumlah</td>
                  <td width="32" align="center">Usia</td>
                  <td width="60" align="center">Diabetes</td>
                  <td width="72" align="center">Hipertensi</td>
                  <td width="63" align="center">Jantung/<br />            Stroke</td>
                  <td width="52" align="center">Tumor/<br />            kanker</td>
                  <td width="79" align="center">Kondisi<br />            Kesehatan</td>
                  <td width="31" align="center">Usia</td>
                  <td width="84" align="center">Sebab<br />            Meninnggal</td>
                </tr>
                <tr class="verdana8">          <td>Ayah
                  <input type="hidden" name="ayahT" id="ayahT" value="A"></td>
                  <td align="center">
                    <input type="text" name="jmlAyahTtg1" id="jmlAyahTtg1" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaAyahTtg" id="usiaAyahTtg" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahDiabetTtg" id="ayahDiabetTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahHiperTtg" id="ayahHiperTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahStrokeTtg" id="ayahStrokeTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahKankerTtg" id="ayahKankerTtg"></td>
                  <td align="center">
                    <input type="text" name="ayahSehatTtg" id="ayahSehatTtg"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalAyahTtg" id="usiaMeninggalAyahTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalAyahTtg" id="sebabMeninggalAyahTtg" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Ibu
                  <input type="hidden" name="ibuT" id="ibuT" value="U"></td>
                  <td align="center">
                    <input type="text" name="jmlIbuTtg" id="jmlIbuTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaIbuTtg" id="usiaIbuTtg" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuDiabetTtg" id="ibuDiabetTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuHiperTtg" id="ibuHiperTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuStrokeTtg" id="ibuStrokeTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuTumorTtg" id="ibuTumorTtg"></td>
                  <td align="center">
                    <input type="text" name="ibuSehatTtg" id="ibuSehatTtg"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalIbuTtg" id="usiaMeninggalIbuTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalIbuTtg" id="sebabMeninggalIbuTtg" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Istri/Suami
                  <input type="hidden" name="IsSuT" id="IsSuT" value="IS"></td>
                  <td align="center">
                    <input type="text" name="jmlIsSuTtg" id="jmlIsSuTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaIsSuTtg" id="usiaIsSuTtg" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="IsSuDiabetTtg" id="IsSuDiabetTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="IsSuHiperTtg" id="IsSuHiperTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="IsSuStrokeTtg" id="IsSuStrokeTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="IsSuKankerTtg" id="IsSuKankerTtg"></td>
                  <td align="center">
                    <input type="text" name="IsSuSehatTtg" id="IsSuSehatTtg"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalIsSuTtg" id="usiaMeninggalIsSuTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalIsSuTtg" id="sebabMeninggalIsSuTtg" size="3"></td>
                </tr>
                <tr class="verdana8" >          <td>Saudara Laki-laki
                  <input type="hidden" name="lakiT" id="lakiT" value="L"></td>
                  <td align="center">
                    <input type="text" name="jmlSauLakTtg" id="jmlSauLakTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaSauLakTtg" id="usiaSauLakTtg" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakDiabetTtg" id="SauLakDiabetTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakHiperTtg" id="SauLakHiperTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakStrokeTtg" id="SauLakStrokeTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakKankerTtg" id="SauLakKankerTtg"></td>
                  <td align="center">
                    <input type="text" name="SauLakSehatTtg" id="SauLakSehatDiabetSTtg"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalSauLakTtg" id="usiaMeninggalSauLakTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalSauLakTtg" id="sebabMeninggalAyahTtg" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Saudara Perempuan
                  <input type="hidden" name="perempuanT" id="perempuanT" value="W"></td>
                  <td align="center">
                    <input type="text" name="jmlSauPerTtg" id="jmlSauPerTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaSauPerTtg" id="usiaSauPerTtg" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerDiabetTtg" id="SauPerDiabetTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerHiperTtg" id="SauPerHiperTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerStrokeTtg" id="SauPerStrokeTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerKankerTtg" id="SauPerKankerTtg"></td>
                  <td align="center">
                    <input type="text" name="SauPerSehatTtg" id="SauPerSehatTtg"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalSauperTtg" id="usiaMeninggalSauperTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalSauperTtg" id="sebabMeninggalSauperTtg" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Anak Kandung
                  <input type="hidden" name="anakT" id="anakT" value="1"></td>
                  <td align="center">
                    <input type="text" name="jmlAnakTtg" id="jmlAnakTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaAnakTtg" id="usiaAnakTtg" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="AnakDiabetTtg" id="AnakDiabetTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="AnakHiperTtg" id="AnakHiperTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="AnakStrokeTtg" id="AnakStrokeTtg"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="AnakKankerTtg" id="AnakKankerTtg"></td>
                  <td align="center">
                    <input type="text" name="AnakSehatTtg" id="AnakSehatTtg"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalAnakTtg" id="usiaMeninggalAnakTtg" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalAnakTtg" id="sebabMeninggalAnakTtg" size="3"></td>
                </tr>
              </table>      <br /><br />
              <? 
			  if($notert2==""){
			  }else{
			  ?><table width="796" height="233" border="1" style="border-collapse:collapse">
                <tr class="verdana8">
                  <td width="206" rowspan="2" align="center">Keluarga Tertanggung Tambahan</td>
                  <td colspan="7" align="center">Masih Hidup</td>
                  <td colspan="2" align="center">Sudah Meninggal</td>
                </tr>
                <tr class="verdana8">
                  <td width="53" align="center">Jumlah</td>
                  <td width="32" align="center">Usia</td>
                  <td width="60" align="center">Diabetes</td>
                  <td width="72" align="center">Hipertensi</td>
                  <td width="63" align="center">Jantung/<br />            Stroke</td>
                  <td width="52" align="center">Tumor/<br />            kanker</td>
                  <td width="79" align="center">Kondisi<br />            Kesehatan</td>
                  <td width="31" align="center">Usia</td>
                  <td width="84" align="center">Sebab<br />            Meninnggal</td>
                </tr>
                <tr class="verdana8">          <td>Ayah
                  <input type="hidden" name="ayahT2" id="ayahT2" value="A"></td>
                  <td align="center">
                    <input type="text" name="jmlAyahTtg2" id="jmlAyahTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaAyahTtg2" id="usiaAyahTtg2" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahDiabetTtg2" id="ayahDiabetTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahHiperTtg2" id="ayahHiperTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahStrokeTtg2" id="ayahStrokeTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ayahDiabetTtg2" id="ayahDiabetTtg3"></td>
                  <td align="center">
                    <input type="text" name="ayahSehatTtg2" id="ayahDiabetTtg6"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalAyahTtg2" id="usiaMeninggalAyahTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalAyahTtg2" id="sebabMeninggalAyahTtg2" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Ibu
                  <input type="hidden" name="ibuT2" id="ibuT2" value="U"></td>
                  <td align="center">
                    <input type="text" name="jmlIbuTtg2" id="jmlIbuTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaIbuTtg2" id="usiaIbuTtg2" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuDiabetTtg2" id="ibuDiabetTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuHiperTtg2" id="ibuHiperTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuStrokeTtg2" id="ibuStrokeTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="ibuTumorTtg2" id="ibuTumorTtg2"></td>
                  <td align="center">
                    <input type="text" name="ibuSehatTtg2" id="ibuSehatTtg2"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalIbuTtg2" id="usiaMeninggalIbuTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalIbuTtg2" id="sebabMeninggalIbuTtg2" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Istri/Suami
                  <input type="hidden" name="issuT2" id="issuT2" value="IS"></td>
                  <td align="center">
                    <input type="text" name="jmlIsSuTtg2" id="jmlIsSuTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaIsSuTtg2" id="usiaIsSuTtg2" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="isSuDiabetTtg2" id="isSuDiabetTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="isSuHiperTtg2" id="isSuHiperTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="isSuStrokeTtg2" id="isSuStrokeTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="isSuKankerTtg2" id="isSuKankerTtg2"></td>
                  <td align="center">
                    <input type="text" name="isSuSehatTtg2" id="isSuSehatTtg2"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalIsSuTtg2" id="usiaMeninggalIsSuTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalIsSuTtg2" id="sebabMeninggalIsSuTtg2" size="3"></td>
                </tr>
                <tr class="verdana8" >          <td>Saudara Laki-laki
                  <input type="hidden" name="lakiT2" id="lakiT2" value="L"></td>
                  <td align="center">
                    <input type="text" name="jmlSauLakTtg2" id="jmlSauLakTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaSauLakTtg2" id="usiaSauLakTtg2" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakDiabetTtg2" id="SauLakDiabetTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakHiperTtg2" id="SauLakHiperTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakStrokeTtg2" id="SauLakStrokeTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauLakKankerTtg2" id="SauLakKankerTtg2"></td>
                  <td align="center">
                    <input type="text" name="SauLakSehatDiabetSTtg" id="SauLakSehatDiabetSTtg2"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalSauLakTtg2" id="usiaMeninggalSauLakTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalAyahTtg2" id="sebabMeninggalAyahTtg2" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Saudara Perempuan
                  <input type="hidden" name="perempuanT2" id="perempuanT2" value="W"></td>
                  <td align="center">
                    <input type="text" name="jmlSauPerTtg2" id="jmlSauPerTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaSauPerTtg2" id="usiaSauPerTtg2" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerDiabetTtg2" id="SauPerDiabetTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerHiperTtg2" id="SauPerHiperTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerStrokeTtg2" id="SauPerStrokeTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="SauPerKankerTtg2" id="SauPerKankerTtg2"></td>
                  <td align="center">
                    <input type="text" name="SauPerSehatTtg2" id="SauPerSehatTtg2"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalSauperTtg2" id="usiaMeninggalSauperTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalSauperTtg2" id="sebabMeninggalSauperTtg2" size="3"></td>
                </tr>
                <tr class="verdana8">          <td>Anak Kandung
                  <input type="hidden" name="anakT2" id="anakT2" value="1"></td>
                  <td align="center">
                    <input type="text" name="jmlAnakTtg2" id="jmlAnakTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="usiaAnakTtg2" id="usiaAnakTtg2" size="3"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="anakDiabetTtg2" id="anakDiabetTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="anakHiperTtg2" id="anakHiperTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="anakStrokeTtg" id="anakStrokeTtg2"></td>
                  <td align="center">
                    <input type="checkbox" value="Y" name="anakKankerTtg2" id="anakKankerTtg2"></td>
                  <td align="center">
                    <input type="text" name="anakSehatTtg2" id="anakSehatTtg2"></td>
                  <td align="center">
                    <input type="text" name="usiaMeninggalAnakTtg2" id="usiaMeninggalAnakTtg2" size="3"></td>
                  <td align="center">
                    <input type="text" name="sebabMeninggalAnakTtg2" id="sebabMeninggalAnakTtg2" size="3"></td>
                </tr>
              </table><? } ?>       <br />
              <table border="1" class="verdana8" bordercolor="#000000">
                <tr>
                  <td>Jika terdapat jawaban "Ya", mohon jelaskan dengan lengkap        Diagnosanya, lama dialami, tanggal konsultasi (rawat), nama dan alamat dokter/rumah sakit/rawat inap/tempat konsultasi,        serta kondisi saat ini. </td>
                </tr>
                <tr>
                  <td><textarea name="diagnosa" id="diagnosa" cols="100"></textarea></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td class="tblisi">&nbsp;</td>
          </tr>
          
                
        </table>
        <table width="700" align="center">
          <tr>
            <td align="left" class="arial10">
              <a href="#" onClick="window.history.go(-1)">Back</a></td>
            <td align="right">
              <input type="hidden" name="noklien" value=<? echo $arr["NOKLIEN"]; ?>>
              <input type="hidden" name="notert2" value=<? echo $notert2; ?>>
              <input type="hidden" name="proposalno" value=<? echo $noproposal; ?>>
              <input type="hidden" name="tglmutasi" value=<?=$tglmutasi;?>>
              <input type="hidden" name="jnscari" value=<?=$jnscari;?>>
              
            <input type="submit" name="submit" value="Lanjut">		</td>
          </tr>
          
        </table>
      </form>
  </body>
</html>
<? }//} ?>