<?
ob_start();
  include "../../includes/session.php";
  include "../../includes/database.php";
  $noproposal=$proposalno;
	$DB = New database($userid, $passwd, $DBName);
	$DB1 = New database($userid, $passwd, $DBName);
  $today = date("d F Y");
  $sqlAyah="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['noklien']."','".$_POST['ayahT']."','".$_POST['jmlAyahTtg1'].
	   "','".$_POST['usiaAyahTtg']."','".$_POST['ayahDiabetTtg']."','".$_POST['ayahHiperTtg']."','".$_POST['ayahStrokeTtg']."','".$_POST['ayahKankerTtg'].
	   "','".$_POST['ayahSehatTtg']."','".$_POST['usiaMeninggalAyahTtg']."','".$_POST['sebabMeninggalAyahTtg']."','','".$_POST['noklien']."')";
  $sqlibu="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['noklien']."','".$_POST['ibuT']."','".$_POST['jmlIbuTtg'].
	   "','".$_POST['usiaIbuTtg']."','".$_POST['ibuDiabetTtg']."','".$_POST['ibuHiperTtg']."','".$_POST['ibuStrokeTtg']."','".$_POST['ibuKankerTtg'].
	   "','".$_POST['ibuSehatTtg']."','".$_POST['usiaMeninggalIbuTtg']."','".$_POST['sebabMeninggalIbuTtg']."','','".$_POST['noklien']."')";
  $sqlis="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['noklien']."','".$_POST['IsSuT']."','".$_POST['jmlIsSuTtg'].
	   "','".$_POST['usiaIsSuTtg']."','".$_POST['IsSuDiabetTtg']."','".$_POST['IsSuHiperTtg']."','".$_POST['IsSuStrokeTtg']."','".$_POST['IsSuKankerTtg'].
	   "','".$_POST['IsSuSehatTtg']."','".$_POST['usiaMeninggalIsSuTtg']."','".$_POST['sebabMeninggalIsSuTtg']."','','".$_POST['noklien']."')";
  $sqllaki="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['noklien']."','".$_POST['lakiT']."','".$_POST['jmlSauLakTtg'].
	   "','".$_POST['usiaSauLakTtg']."','".$_POST['SauLakDiabetTtg']."','".$_POST['SauLakHiperTtg']."','".$_POST['SauLakStrokeTtg']."','".$_POST['SauLakKankerTtg'].
	   "','".$_POST['SauLakSehatTtg']."','".$_POST['usiaMeninggalSauLakTtg']."','".$_POST['sebabMeninggalSauLakTtg']."','','".$_POST['noklien']."')";   
  $sqlperempuan="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['noklien']."','".$_POST['perempuanT']."','".$_POST['jmlSauPerTtg'].
	   "','".$_POST['usiaSauPerTtg']."','".$_POST['SauPerDiabetTtg']."','".$_POST['SauPerHiperTtg']."','".$_POST['SauPerStrokeTtg']."','".$_POST['SauPerKankerTtg'].
	   "','".$_POST['SauPerSehatTtg']."','".$_POST['usiaMeninggalSauPerTtg']."','".$_POST['sebabMeninggalSauPerTtg']."','','".$_POST['noklien']."')";
  $sqlanak="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['noklien']."','".$_POST['anakT']."','".$_POST['jmlAnakTtg'].
	   "','".$_POST['usiaAnakTtg']."','".$_POST['AnakDiabetTtg']."','".$_POST['AnakHiperTtg']."','".$_POST['AnakStrokeTtg']."','".$_POST['AnakKankerTtg'].
	   "','".$_POST['AnakSehatTtg']."','".$_POST['usiaMeninggalAnakTtg']."','".$_POST['sebabMeninggalAnakTtg']."','','".$_POST['noklien']."')";
  $sqlAyahT2="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['notert2']."','".$_POST['ayahT']."','".$_POST['jmlAyahTtg2'].
	   "','".$_POST['usiaAyahTtg2']."','".$_POST['ayahDiabetTtg2']."','".$_POST['ayahHiperTtg2']."','".$_POST['ayahStrokeTtg2']."','".$_POST['ayahKankerTtg2'].
	   "','".$_POST['ayahSehatTtg2']."','".$_POST['usiaMeninggalAyahTtg2']."','".$_POST['sebabMeninggalAyahTtg2']."','','".$_POST['noklien']."')";
  $sqlibuT2="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['notert2']."','".$_POST['ibuT']."','".$_POST['jmlIbuTtg2'].
	   "','".$_POST['usiaIbuTtg2']."','".$_POST['ibuDiabetTtg2']."','".$_POST['ibuHiperTtg2']."','".$_POST['ibuStrokeTtg2']."','".$_POST['ibuKankerTtg2'].
	   "','".$_POST['ibuSehatTtg2']."','".$_POST['usiaMeninggalIbuTtg2']."','".$_POST['sebabMeninggalIbuTtg2']."','','".$_POST['noklien']."')";
  $sqlisT2="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['notert2']."','".$_POST['IsSuT']."','".$_POST['jmlIsSuTtg2'].
	   "','".$_POST['usiaIsSuTtg2']."','".$_POST['IsSuDiabetTtg2']."','".$_POST['IsSuHiperTtg2']."','".$_POST['IsSuStrokeTtg2']."','".$_POST['IsSuKankerTtg2'].
	   "','".$_POST['IsSuSehatTtg2']."','".$_POST['usiaMeninggalIsSuTtg2']."','".$_POST['sebabMeninggalIsSuTtg2']."','','".$_POST['noklien']."')";
  $sqllakiT2="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['notert2']."','".$_POST['lakiT']."','".$_POST['jmlSauLakTtg2'].
	   "','".$_POST['usiaSauLakTtg2']."','".$_POST['SauLakDiabetTtg2']."','".$_POST['SauLakHiperTtg2']."','".$_POST['SauLakStrokeTtg2']."','".$_POST['SauLakKankerTtg2'].
	   "','".$_POST['SauLakSehatTtg2']."','".$_POST['usiaMeninggalSauLakTtg2']."','".$_POST['sebabMeninggalSauLakTtg2']."','','".$_POST['noklien']."')";   
  $sqlperempuanT2="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['notert2']."','".$_POST['perempuanT']."','".$_POST['jmlSauPerTtg2'].
	   "','".$_POST['usiaSauPerTtg2']."','".$_POST['SauPerDiabetTtg2']."','".$_POST['SauPerHiperTtg2']."','".$_POST['SauPerStrokeTtg2']."','".$_POST['SauPerKankerTtg2'].
	   "','".$_POST['SauPerSehatTtg2']."','".$_POST['usiaMeninggalSauPerTtg2']."','".$_POST['sebabMeninggalSauPerTtg2']."','','".$_POST['noklien']."')";
  $sqlanakT2="insert into $DBUser.tabel_116_riwayat_kel_nul (NOKLIEN,KDHUBUNGAN,JMLHIDUP,USIA,DIABETES,HIPERTENSI,JANTUNG,TUMOR,KESEHATAN,".
  	   "USIAMENINGGAL,SEBABMENINGGAL,KETERANGAN,NOKLIENTU) values ('".$_POST['notert2']."','".$_POST['anakT']."','".$_POST['jmlAnakTtg2'].
	   "','".$_POST['usiaAnakTtg2']."','".$_POST['AnakDiabetTtg2']."','".$_POST['AnakHiperTtg2']."','".$_POST['AnakStrokeTtg2']."','".$_POST['AnakKankerTtg2'].
	   "','".$_POST['AnakSehatTtg2']."','".$_POST['usiaMeninggalAnakTtg2']."','".$_POST['sebabMeninggalAnakTtg2']."','','".$_POST['noklien']."')";
//echo $sqlAyah;
  $DB->parse($sqlAyah);
  $DB->execute();
  $DB->parse($sqlibu);
  $DB->execute();
  $DB->parse($sqlis);
  $DB->execute();
  $DB->parse($sqllaki);
  $DB->execute();
  $DB->parse($sqlperempuan);
  $DB->execute();
  $DB->parse($sqlanak);
  $DB->execute();
  
  //echo $sqlAyahT2;
 // echo $sqlibuT2;
  //echo $sqlisT2;
  //echo $sqllakiT2;
  //echo $sqlperempuanT2;
 // echo $sqlanakT2;
  $DB->parse($sqlAyahT2);
  $DB->execute();
  $DB->parse($sqlibuT2);
  $DB->execute();
  $DB->parse($sqlisT2);
  $DB->execute();
  $DB->parse($sqllakiT2);
  $DB->execute();
  $DB->parse($sqlperempuanT2);
  $DB->execute();
  $DB->parse($sqlanakT2);
  $DB->execute();

  $sqldiagnosa="insert into $DBUser.tabel_118_klien_diagnosa (noklien,diagnosa) values ('".$_POST['noklien']."','".$_POST['diagnosa']."')";
 // echo $sqldiagnosa;
  $DB->parse($sqldiagnosa);
  $DB->execute();

$noklien=$_POST['noklien'] ? $_POST['noklien'] : $_GET['noklien'] ;
$notert2=$_POST['notert2'] ? $_POST['notert2'] : $_GET['noklien'] ;
 /* $sqltert2="select notertanggung2 from $DBUser.tabel_200_pertanggungan where notertanggung='".$_GET['noklien']."'";
  echo $sqltert2;
  $DB1->parse($sqltert2);
  $DB1->execute();
  $arrtert2=$DB1->nextrow();
  $notert2=$arrtert2["NOTERTANGGUNG2"];*/
  if($notert2==""){
//	  $disebled="disabled";
  }else{
	//  $disebled="";
  }
 
  $sql ="select a.noklien,a.namaklien1 tertanggung1,a.tempatlahir,a.kdpekerjaan,a.alamattetap01,a.alamatkerja, ".
			 "decode(a.jeniskelamin,'L','LAKI-LAKI','P','PEREMPUAN') jeniskelamin,a.tinggibadan,a.beratbadan, ".
			 "a.meritalstatus, decode(a.meritalstatus,'D','DUDA','J','JANDA','L','LAJANG','K','KAWIN') namameritalstatus, ".
       "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir,to_char(a.tglkawin,'DD/MM/YYYY') nganten, ".
			 "c.namapekerjaan,a.kdpekerjaanlama,a.kdgantipekerjaan,d.namaid,a.noid,a.kdid, ".
			 "(select namaklien1 from $DBUser.tabel_100_klien where noklien='".$noklien."') tertanggung1 ".
       "from ".
			 "$DBUser.tabel_100_klien a,  ".
			 "$DBUser.tabel_105_pekerjaan c, $DBUser.tabel_104_kartu_identitas d ".
		   "where a.noklien='".$noklien."' and a.kdpekerjaan=c.kdpekerjaan(+) and a.kdid=d.kdid(+)";
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
 /* print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
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
  print( "</script>" );*/
    ?>
  </head>
  <body onLoad="OnLod()">
    <div align="center">
      <form name="skk1" action="skk3_newjslink.php" method="post">
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
					 echo $noklien;
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
                  <td width="16%">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="53%">&nbsp;</td>
                  <td colspan="2" class="arial10">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
              </table>
              <br /><br />
              <br />
              <table border="1" class="verdana8" bordercolor="#000000">
                
                <tr><td>       <b>Riwayat Kesehatan Tertanggung</b>
                    <br>Beri Tanda (v) untuk pernyataan-pernyataan dibawah ini : </td>
                </tr>
                <tr>         <td>
                    <table class="verdana8">
                      <tr>
                        <td width="31" rowspan="2" align="right" valign="top">.  </td>
                        <td colspan="5" align="left">Apakah  Anda  pernah  mengalami  gejala-gejala, diperiksa, menderita, didiagnosa, mendapat pengobatan,         disarankan atau  menjalani  rawat  inap,  menjalani operasi,  dianjurkan untuk  mendapat nasehat medis,         telah mendapat nasehat medis, atau dirujuk ke dokter spesialis, untuk penyakit di bawah ini :</td>
                      </tr>
                      <tr>
                        <td width="374"><b>Calon Tertanggung Utama</b>
                          <br>
                          <input type="checkbox" name="gejalaTtgYa" id="gejalaTtgYa" value="Y">Ya,
                          <input type="checkbox" name="gejalaTtgNo" id="gejalaTtgNo">Tidak </td>
                        <td width="345" colspan="2"><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <input type="checkbox" name="gejalaTtg2Ya" id="gejalaTtg2Ya" <?=$disebled; ?>>Ya,
                          <input type="checkbox" name="gejalaTtg2No" id="gejalaTtg2No" <?=$disebled; ?>>Tidak </td>
                      </tr>
                      <tr>
                        <td colspan="6">Jika "Ya", mohon Calon Tertanggung memberi tanda "v" untuk setiap kelainan yang dimiliki dan mengisi KUESIONER sesuai dengan kelainan tersebut.</td>
                      </tr>
                      <tr>
                        <td colspan="6">
                          <table class="verdana8">
                            <tr>
                              <td width="1">&nbsp; </td>
                              <td width="10">&nbsp;</td>
                              <td width="53">TU&nbsp;&nbsp; TT</td>
                              <td width="418">&nbsp;</td>
                              <td width="44">TU&nbsp;&nbsp; TT</td>
                              <td width="222">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="1">&nbsp; </td>
                              <td width="10">&nbsp;</td>
                              <td width="53">
                                <input type="checkbox" name="jantungT1" id="jantungT1" value="Y">
                              <input type="checkbox" name="jantungT2" id="jantungT2" <?=$disebled; ?> value="Y"></td>
                              <td width="418">Jantung bawaan *</td>
                              <td width="44">
                                <input type="checkbox" name="malaria" id="malaria" value="Y">
                              <input type="checkbox" name="malariaT2" id="malariaT2" <?=$disebled; ?> value="Y"></td>
                              <td width="222"> Malaria</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="kelenjar" id="kelenjar" value="Y">
                                <input type="checkbox" name="kelenjarT2" id="kelenjarT2" <?=$disebled; ?> value="Y"></td>        <td> Kelenjar /Thyroid</td>        <td>
                                <input type="checkbox" name="nyeridada" id="nyeridada" value="Y">
                                <input type="checkbox" name="nyeridadaT2" id="nyeridadaT2" <?=$disebled; ?> value="Y"></td>        <td>Nyeri dada, kelainan jantung dan pembuluh darah</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="tumor" id="tumor" value="Y">
                                <input type="checkbox" name="tumorT2" id="tumorT2" <?=$disebled; ?> value="Y"></td>        <td> Tumor/Kista/Benjolan/pembengkakan/Kanker</td>        <td>
                                <input type="checkbox" name="epilepsi" id="epilepsi" value="Y">
                                <input type="checkbox" name="epilepsiT2" id="epilepsiT2" <?=$disebled; ?> value="Y"></td>        <td>Epilepsi / Ayan / Kejang / pingsan **</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="maag" id="maag" value="Y">
                                <input type="checkbox" name="maagT2" id="maagT2" <?=$disebled; ?> value="Y"></td>        <td> Maag, diare dan gangguan pencernaan lainnya</td>        <td>
                                <input type="checkbox" name="diabet" id="diabet" value="Y">
                                <input type="checkbox" name="diabetT2" id="diabetT2" <?=$disebled; ?> value="Y"></td>        <td>Kencing manis</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="migrain" id="migrain" value="Y">
                                <input type="checkbox" name="migrainT2" id="migrainT2" <?=$disebled; ?> value="Y"></td>        <td> Sakit Kepala/Migrain/Pusing/Vertigo/Stroke</td>        <td>
                                <input type="checkbox" name="polio" id="polio]" value="Y">
                                <input type="checkbox" name="polioT2" id="polioT2" <?=$disebled; ?> value="Y"></td>        <td>Polio</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="rematik" id="rematik" value="Y">
                                <input type="checkbox" name="rematikT2" id="rematikT2" <?=$disebled; ?>  value="Y"></td>        <td> Gangguan Persendian/Rematik/Kelainan pada Otot/Sendi/Tulang</td>        <td>
                                <input type="checkbox" name="hipertensi" id="hipertensi" value="Y">
                                <input type="checkbox" name="hipertensiT2" id="hipertensiT2" <?=$disebled; ?> value="Y"></td>        <td>Tekanan darah tinggi</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="batuk" id="batuk" value="Y">
                                <input type="checkbox" name="batukT2" id="batukT2" <?=$disebled; ?> value="Y"></td>        <td> Gangguan Pernafasan/ batuk berkepanjangan/sesak nafas/Bronkitis/ Asthma/Batuk Darah</td>        <td>
                                <input type="checkbox" name="psiko" id="psiko" value="Y">
                                <input type="checkbox" name="psikoT2" id="psikoT2" <?=$disebled; ?> value="Y"></td>        <td>Kelainan Psikologis</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="anemia" id="anemia" value="Y">
                                <input type="checkbox" name="anemiaT2" id="anemiaT2" <?=$disebled; ?> value="Y"></td>        <td> Anemia, hemofilia atau kelainan darah lainnya</td>        <td>
                                <input type="checkbox" name="ginjalT1" id="ginjalT1" value="Y">
                                <input type="checkbox" name="ginjalT2" id="ginjalT2" <?=$disebled; ?> value="Y"></td>        <td>Sakit Ginjal/ batu Ginjal/ saluran kemih/ prostat</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="lainnyaT1" id="lainnyaT1" value="Y">
                                <input type="checkbox" name="lainnyaT2" id="lainnyaT2" <?=$disebled; ?> value="Y"></td>        <td>Penyakit lain yang belum disebutkan ?</td>
                            </tr>
                          </table>       </td>
                      </tr>
                      <!-- Point 2  -->
                      <tr>
                        <td rowspan="2" align="right" valign="top">   2.  </td>
                        <td colspan="5" align="left">Apakah  Anda  pernah  mengalami gejala-gejala, diperiksa, menderita,         mendapat pengobatan, disarankan untuk rawat inap, menjalani rawat inap untuk kelainan yang disebutkan di bawah ini :</td>
                      </tr>
                      <tr>
                        <td><b>Calon Tertanggung Utama</b>
                          <br>
                          <input type="checkbox" name="rawatinap" id="rawatinap" value="Y">Ya,
                          <input type="checkbox">Tidak </td>
                        <td colspan="2"><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <input type="checkbox" name="rawatinap2" id="rawatinap2" <?=$disebled; ?>>Ya,
                          <input type="checkbox" name="" id="" <?=$disebled; ?>>Tidak </td>
                      </tr>
                      <tr>
                        <td colspan="6">Jika "Ya", mohon Calon Tertanggung memberi tanda "v" untuk setiap kelainan yang dimiliki dan mengisi KUESIONER sesuai dengan kelainan tersebut.</td>
                      </tr>
                      <tr>
                        <td colspan="6">
                          <table class="verdana8">
                            <tr>         <td>&nbsp;</td>         <td>TU</td>         <td>TT</td>         <td>&nbsp;</td>
                              <td width="155">Nama Penyakit</td>
                              <td width="69">Tgl. Sakit</td>
                              <td width="148">Nama &amp; Alamat Dokter</td>
                            </tr>
                            <tr>
                              <td width="1">&nbsp; </td>
                              <td width="20" valign="top">
                                <input type="checkbox" name="hepaTU" id="hepaTU" value="Y"></td>
                              <td width="38" valign="top">
                                <input type="checkbox" name="hepaTT" id="hepaTT" value="Y" <?=$disebled; ?>>a. </td>
                              <td width="315" valign="top">Hepatitis A, Hepatitis B, Hepatitis C, Hepatitis D, Hepatitis E, Hati (selain Hepatitis) dan Kandung Empedu ?</td>
                              <td colspan="3"  valign="middle"><table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="hepa"><input type="hidden" name="namahepa" value="hepa"></td>
                                    <td width="78">
                                      <input type="text" name="tglHepa" size="10" id="tglHepa" onBlur="javascript:convert_date(tglHepa);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatHepa" id="dokterAlamatHepa"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="hepa2" id="hepa2"><input type="hidden" name="namahepa2" value="hepa"></td>
                                    <td width="78">
                                      <input type="text" name="tglHepa2" size="10" id="tglHepa2" onBlur="javascript:convert_date(tglHepa2);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatHepa2" id="dokterAlamatHepa2"></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="ususTU" id="ususTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="ususTT" id="ususTT" value="Y" <?=$disebled; ?>>b. </td>
                              <td valign="top">Usus, Pankreas, Wasir dan Organ Pencernaan lain ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="usus" id="usus"><input type="hidden" name="namausus" value="usus"></td>
                                    <td width="78">
                                      <input type="text" name="tglUsus" size="10" id="tglUsus" onBlur="javascript:convert_date(tglUsus);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatUsus" id="dokterAlamatUsus"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="usus2" id="usus2"><input type="hidden" name="namausus2" value="usus"></td>
                                    <td width="78"><input type="text" name="tglUsus2" size="10" id="tglUsus2" onBlur="javascript:convert_date(tglUsus2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatUsus2" id="dokterAlamatUsus2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="ginjalTU" id="ginjalTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="ginjalTT" id="ginjalTT" value="Y" <?=$disebled; ?>>c. </td>
                              <td valign="top">Ginjal, Batu Ginjal, Saluran Kemih  dan Prostat ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="ginjal" id="ginjal"><input type="hidden" name="namaginjal" value="ginjal"></td>
                                    <td width="78">
                                      <input type="text" name="tglGinjal" size="10" id="tglGinjal" onBlur="javascript:convert_date(tglGinjal);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatGinjal" id="dokterAlamatGinjal"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="ginjal2" id="ginjal2"><input type="hidden" name="namaginjal2" value="ginjal"></td>
                                    <td width="78"><input type="text" name="tglGinjal2" size="10" id="tglGinjal2" onBlur="javascript:convert_date(tglGinjal2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatGinjal2" id="dokterAlamatGinjal2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="jantungTU" id="jantungTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="jantungTT" id="jantungTT" value="Y"<?=$disebled; ?>>d. </td>
                              <td valign="top"> Jantung, Demam Rheuma,  Pembuluh Darah dan Stroke ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="jantung" id="jantung"><input type="hidden" name="namajantung" value="jantung"></td>
                                    <td width="78">
                                      <input type="text" name="tglJantung" size="10" id="tglJantung" onBlur="javascript:convert_date(tglJantung);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatJantung" id="dokterAlamatJantung"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="jantung2" id="jantung2"><input type="hidden" name="namajantung2" value="jantung"></td>
                                    <td width="78"><input type="text" name="tglJantung2" size="10" id="tglJantung2" onBlur="javascript:convert_date(tglJantung2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatJantung2" id="dokterAlamatJantung2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="payudaraTU" id="payudaraTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="payudaraTT" id="payudaraTT" value="Y"<?=$disebled; ?>>e. </td>
                              <td valign="top">Payudara, Kandungan dan Indung Telur ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="payudara" id="payudara"><input type="hidden" name="namapayudara" value="payudara"></td>
                                    <td width="78">
                                      <input type="text" name="tglPayudara" size="10" id="tglPayudara" onBlur="javascript:convert_date(tglPayudara);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatPayudara" id="dokterAlamatPayudara"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="payudara2" id="payudara2"><input type="hidden" name="namapayudara2" value="payudara"></td>
                                    <td width="78"><input type="text" name="tglPayudara2" size="10" id="tglPayudara2" onBlur="javascript:convert_date(tglPayudara2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatPayudara2" id="dokterAlamatPayudara2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="alergiTU" id="alergiTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="alergiTT" id="alergiTT" value="Y"<?=$disebled; ?>>f. </td>
                              <td valign="top">Alergi, Penyakit Kulit, penyakit kelamin ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="alergi" id="alergi"><input type="hidden" name="namaalergi" value="alergi"></td>
                                    <td width="78">
                                      <input type="text" name="tglAlergi" size="10" id="tglAlergi" onBlur="javascript:convert_date(tglAlergi);"></td>
                                    <td width="247">
                                      <input type="text" name="dokteralamatAlergi" id="dokteralamatAlergi"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="alergi2" id="alergi2"><input type="hidden" name="namaalergi2" value="alergi"></td>
                                    <td width="78"><input type="text" name="tglAlergi2" size="10" id="tglAlergi2" onBlur="javascript:convert_date(tglAlergi2);"></td>
                                    <td width="247"><input type="text" name="dokteralamatAlergi2" id="dokteralamatAlergi2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="mataTU" id="mataTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="mataTT" id="mataTT" value="Y" <?=$disebled; ?>>g. </td>
                              <td valign="top">Mata,Telinga,Hidung,Tenggorokan (THT), Sinus dan gangguan bicara?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="mata" id="mata"><input type="hidden" name="namamata" value="mata"></td>
                                    <td width="78">
                                      <input type="text" name="tglmata" size="10" id="tglmata" onBlur="javascript:convert_date(tglmata);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatMata" id="dokterAlamatMata"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="mata2" id="mata2"><input type="hidden" name="namamata2" value="mata"></td>
                                    <td width="78"><input type="text" name="tglmata2" size="10" id="tglmata2" onBlur="javascript:convert_date(tglmata2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatMata2" id="dokterAlamatMata2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="otakTU" id="otakTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="otakTT" id="otakTT" value="Y"<?=$disebled; ?>>h. </td>
                              <td valign="top">Otak, Syaraf, Kejang, Pingsan dan Kelumpuhan / gangguan pada anggota tubuh ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="otak" id="otak"><input type="hidden" name="namaotak" value="otak"></td>
                                    <td width="78">
                                      <input type="text" name="tglOtak" size="10" id="tglOtak" onBlur="javascript:convert_date(tglOtak);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatOtak" id="dokterAlamatOtak"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="otak2" id="otak2"><input type="hidden" name="namaotak2" value="otak"></td>
                                    <td width="78"><input type="text" name="tglOtak2" size="10" id="tglOtak2" onBlur="javascript:convert_date(tglOtak2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatOtak2" id="dokterAlamatOtak2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="cederaTU" id="cederaTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="cederaTT" id="cederaTT" value="Y" <?=$disebled; ?>>i. </td>
                              <td valign="top">Kecelakaan dan cedera berat berkepanjangan ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="cedera" id="cedera"><input type="hidden" name="namacedera" value="cedera"></td>
                                    <td width="78">
                                      <input type="text" name="tglCedera" size="10" id="tglCedera" onBlur="javascript:convert_date(tglCedera);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatCedera" id="dokterAlamatCedera"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="cedera2" id="cedera2"><input type="hidden" name="namacedera2" value="cedera"></td>
                                    <td width="78"><input type="text" name="tglCedera2" size="10" id="tglCedera2" onBlur="javascript:convert_date(tglCedera2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatCedera2" id="dokterAlamatCedera2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="herniaTU" id="herniaTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="herniaTT" id="herniaTT" value="Y" <?=$disebled; ?>>j. </td>
                              <td valign="top">Hernia ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="hernia" id="hernia"><input type="hidden" name="namahernia" value="hernia"></td>
                                    <td width="78">
                                      <input type="text" name="tglHernia" size="10" id="tglHernia" onBlur="javascript:convert_date(tglHernia);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatHernia" id="dokterAlamatHernia"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="hernia2" id="hernia2"><input type="hidden" name="namahernia2" value="hernia"></td>
                                    <td width="78"><input type="text" name="tglHernia2" size="10" id="tglHernia2" onBlur="javascript:convert_date(tglHernia2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatHernia2" id="dokterAlamatHernia2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="kolesterolTU" id="kolesterolTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="kolesterolTT" id="kolesterolTT" value="Y" <?=$disebled; ?>>k. </td>
                              <td valign="top">Kolesterol ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="kolesterol" id="kolesterol"><input type="hidden" name="namakolesterol" value="kolesterol"></td>
                                    <td width="78">
                                      <input type="text" name="tglKolesterol" size="10" id="tglKolesterol" onBlur="javascript:convert_date(tglKolesterol);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatKolesterol" id="dokterAlamatKolesterol"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="kolesterol2" id="kolesterol2"><input type="hidden" name="namakolesterol2" value="kolesterol"></td>
                                    <td width="78"><input type="text" name="tglKolesterol2" size="10" id="tglKolesterol2" onBlur="javascript:convert_date(tglKolesterol2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatKolesterol2" id="dokterAlamatKolesterol2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="uratTU" id="uratTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="uratTT" id="uratTT" value="Y" <?=$disebled; ?>>l. </td>
                              <td valign="top">Asam Urat ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="urat" id="urat"><input type="hidden" name="namaurat" value="urat"></td>
                                    <td width="78">
                                      <input type="text" name="tglUrat" size="10" id="tglUrat" onBlur="javascript:convert_date(tglUrat);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatUrat" id="dokterAlamatUrat"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="urat2" id="urat2"><input type="hidden" name="namaurat2" value="urat"></td>
                                    <td width="78"><input type="text" name="tglUrat2" size="10" id="tglUrat2" onBlur="javascript:convert_date(tglUrat);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatUrat2" id="dokterAlamatUrat2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="endokrinTU" id="endokrinTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="endokrinTT" id="endokrinTT"  value="Y" <?=$disebled; ?>>m. </td>
                              <td valign="top">Endokrin / Hormon ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="endokrin" id="endokrin"><input type="hidden" name="namaendokrin" value="endokrin"></td>
                                    <td width="78">
                                      <input type="text" name="tglEndokrin" size="10" id="tglEndokrin" onBlur="javascript:convert_date(tglEndokrin);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatEndokrin" id="dokterAlamatEndokrin"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="endokrin2" id="endokrin2"><input type="hidden" name="namaendokrin2" value="endokrin"></td>
                                    <td width="78"><input type="text" name="tglEndokrin2" size="10" id="tglEndokrin2" onBlur="javascript:convert_date(tglEndokrin2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatEndokrin2" id="dokterAlamatEndokrin2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="tbcTU" id="tbcTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="tbcTT" id="tbcTT" value="Y" <?=$disebled; ?>>n. </td>
                              <td valign="top">Tuberkulosis (TBC) ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="tbc" id="tbc"><input type="hidden" name="namatbc" value="tbc"></td>
                                    <td width="78">
                                      <input type="text" name="tglTbc" size="10" id="tglTbc" onBlur="javascript:convert_date(tglTbc);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatTbc" id="dokterAlamatTbc"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="tbc2" id="tbc2"><input type="hidden" name="namatbc2" value="tbc"></td>
                                    <td width="78"><input type="text" name="tglTbc2" size="10" id="tglTbc2" onBlur="javascript:convert_date(tglTbc2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatTbc2" id="dokterAlamatTbc2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="aidsTU" id="aidsTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="aidsTT" id="aidsTT" value="Y" <?=$disebled; ?>>o. </td>
                              <td valign="top">AIDS & kondisi yang berhubungan dengan AIDS (demam, kelelahan, diare kronis, penurunan berat badan, sariawan yang lama sembuh,          pembengkakan getah bening atau luka di kulit berulang & berkepanjangan yang tidak diketahui penyebabnya) ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="aids" id="aids"><input type="hidden" name="namaaids" value="aids"></td>
                                    <td width="78">
                                      <input type="text" name="tglAids" size="10" id="tglAids" onBlur="javascript:convert_date(tglAids);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatAids" id="dokterAlamatAids"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="aids2" id="aids2"><input type="hidden" name="namaaids2" value="aids"></td>
                                    <td width="78"><input type="text" name="tglAids2" size="10" id="tglAids2" onBlur="javascript:convert_date(tglAids2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatAids2" id="dokterAlamatAids2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="cacatTU" id="cacatTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="cacatTT" id="cacatTT" value="Y" <?=$disebled; ?>>p. </td>
                              <td valign="top">Kelainan fisik, cacad bawaan atau bentuk kelainan fisik lainnya</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="cacat" id="cacat"><input type="hidden" name="namacacat" value="cacat"></td>
                                    <td width="78">
                                      <input type="text" name="tglCacat" size="10" id="tglCacat" onBlur="javascript:convert_date(tglCacat);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatCacat" id="dokterAlamatCacat"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="cacat2" id="cacat2"><input type="hidden" name="namacacat2" value="cacat"></td>
                                    <td width="78"><input type="text" name="tglCacat2" size="10" id="tglCacat2" onBlur="javascript:convert_date(tglCacat2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatCacat2" id="dokterAlamatCacat2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="lainnyaTU" id="lainnyaTU" value="Y"></td>
                              <td valign="top">
                                <input type="checkbox" name="lainnyaTT" id="lainnyaTT" value="Y" <?=$disebled; ?>>q. </td>
                              <td valign="top">Penyakit lain yang belum disebutkan?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <input type="text" name="lainnya" id="lainnya"><input type="hidden" name="namalainnya" value="lainnya"></td>
                                    <td width="78">
                                      <input type="text" name="tglLainnya" size="10" id="tglLainnya" onBlur="javascript:convert_date(tglLainnya);"></td>
                                    <td width="247">
                                      <input type="text" name="dokterAlamatLainnya" id="dokterAlamatLainnya"></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><input type="text" name="lainnya2" id="lainnya2"><input type="hidden" name="namalainnya2" value="lainnya"></td>
                                    <td width="78"><input type="text" name="tglLainnya2" size="10" id="tglLainnya2" onBlur="javascript:convert_date(tglLainnya2);"></td>
                                    <td width="247"><input type="text" name="dokterAlamatLainnya2" id="dokterAlamatLainnya2"></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>        </td>
                      </tr>
                      <!-- end of point 2-->
                      <!-- Point 3-->                      <!-- end of point 3-->
                    </table></td>
                </tr>
              </table>    </td>
          </tr>
        </table>
        <table width="700" align="center">
          <tr>
            <td align="left" class="arial10">
             <!-- <a href="#" onClick="window.history.go(-1)">Back</a>--></td>
            <td align="right">
              <input type="hidden" name="noklien" value=<? echo $noklien; ?>>
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
<? //} ?>