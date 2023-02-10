<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  $noproposal=$nopertanggungan;
	$DB = New database($userid, $passwd, $DBName);
	$DB1 = New database($userid, $passwd, $DBName);
	$DB3 = New database($userid, $passwd, $DBName);
	$DB4 = New database($userid, $passwd, $DBName);
  $today = date("d F Y");
  
$sqlcek="update $DBUser.tabel_118_cek_skk set cekdiagnosa='".$_POST['diagnosa']."',ceknarkoba='".$_POST['narkoba']."',cekrawatinappulih='".$_POST['rawatinappulih']."' where noklien='".$_POST['noklien']."'";
$DB3->parse($sqlcek);
$DB3->execute();
$sqlcek2="update $DBUser.tabel_118_cek_skk set cekdiagnosa='".$_POST['diagnosa2']."',ceknarkoba='".$_POST['narkoba2']."',cekrawatinappulih='".$_POST['rawatinappulih2']."' where noklien='".$_POST['notert2']."'";
$DB4->parse($sqlcek2);
$DB4->execute();

  
  $sqlklien="insert into $DBUser.tabel_118_periksa_penyakit (noklien,jnsperiksa,alasanperiksa,tglperiksa,hasilperiksa,pinjamhasil,lprperiksa,jnsalkohol,akhrmnmalkohol,jmlrokok,mulairokok,namapenyakit,blnrawat,lamarawat,namaobat,rmhsktrawat) values
('".$_POST['noklien']."','".$_POST['jenisPemerikasaan']."','".$_POST['alasanPemerikasaan']."',to_date('".$_POST['tglPemeriksaan']."','DD/MM/YYYY'),'".$_POST['hasilPemeriksaan']."',
'".$_POST['pinjamPeriksa']."','".$_POST['lampirPeriksa']."','".$_POST['alkohol']."','".$_POST['tglTdkAlkohol']."','".$_POST['merokok']."','".$_POST['tglmerokok']."',
'".$_POST['penyakit']."',to_date('".$_POST['blnRawat']."','MM/YYYY'),'".$_POST['lamaDirawat']."','".$_POST['namaObat']."','".$_POST['rmhSakitRawat']."')";
$DB->parse($sqlklien);
  $DB->execute();
//echo $sqlklien;
$sqltert2="insert into $DBUser.tabel_118_periksa_penyakit (noklien,jnsperiksa,alasanperiksa,tglperiksa,hasilperiksa,pinjamhasil,lprperiksa,jnsalkohol,akhrmnmalkohol,jmlrokok,mulairokok,namapenyakit,blnrawat,lamarawat,namaobat,rmhsktrawat) values
('".$_POST['notert2']."','".$_POST['jenisPemerikasaan2']."','".$_POST['alasanPemerikasaan2']."',to_date('".$_POST['tglPemeriksaan2']."','DD/MM/YYYY'),'".$_POST['hasilPemeriksaan2']."',
'".$_POST['pinjamPeriksa2']."','".$_POST['lampirPeriksa2']."','".$_POST['alkohol2']."','".$_POST['tglTdkAlkohol2']."','".$_POST['merokok2']."','".$_POST['tglmerokok2']."',
'".$_POST['penyakit2']."',to_date('".$_POST['blnRawat']."','MM/YYYY'),'".$_POST['lamaDirawat2']."','".$_POST['namaObat2']."','".$_POST['rmhSakitRawat2']."')";
  $DB->parse($sqltert2);
  $DB->execute();
 //echo  $sqlklien;
  //echo  $sqltert2;
  /*$sqltert2="select notertanggung2 from $DBUser.tabel_200_pertanggungan where notertanggung='".$_POST['noklien']."'";
  echo $sqltert2;
  $DB1->parse($sqltert2);
  $DB1->execute();
  $arrtert2=$DB1->nextrow();
  $notert2=$arrtert2["NOTERTANGGUNG2"];*/
$noklien=$_POST['noklien'] ? $_POST['noklien'] : $_GET['noklien'] ;
$notert2=$_POST['notert2'] ? $_POST['notert2'] : $_GET['notert2'] ;
  if($notert2!=""){
//	  $disebled="disabled";
  }else{
//	  $disebled="";
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
      <form name="skk1" action="skk5_newjslink.php" method="post">
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
              <br /><br />
              <br />
              <table border="1" class="verdana8" bordercolor="#000000">
                
                <tr><td>       <b>Riwayat Kesehatan Tertanggung</b>
                    <br>Beri Tanda (v) untuk pernyataan-pernyataan dibawah ini : </td>
                </tr>
                <tr>         <td>
                    <table class="verdana8">
                      <!-- Point 2  -->                      <!-- end of point 2-->
                      <!-- Point 3-->                      <!-- end of point 3-->
                      <tr>         <td>8.</td>
                        <td colspan="2">Apakah Anda pernah mendapatkan luka berat atau dioperasi ?</td>         <td width="7">&nbsp;</td>         <td width="319">&nbsp;</td>         <td width="7">&nbsp;</td>         <td width="7">&nbsp;</td>         <td width="12">&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td width="17">&nbsp;</td>         <td width="350"><b>Calon Tertanggung Utama</b>
                          <br>
                          <input type="checkbox" name="lukaberat" id="lukaberat" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <input type="checkbox" name="lukaberat2" id="lukaberat2" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>
                        <td colspan="2">Jika &quot;Ya&quot; sebutkan :</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Kapan dioperasi ? (Bulan dan tahun)</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="blnOperasi" id="blnOperasi">
                          MM/YYYY</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="blnOperasi2" id="blnOperasi2">
                          MM/YYYY</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b.</td>         <td>Operasi apa?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="namaOperasi" id="namaOperasi"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="namaOperasi2" id="namaOperasi2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>c.</td>         <td>Nama Rumah Sakit/Dokter</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="rmhSakitOperasi" id="rmhSakitOperasi"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="rmhSakitOperasi2" id="rmhSakitOperasi2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>d.</td>         <td>Sekarang ini merasa sehat</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="sehat" id="sehat" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="sehat2" id="sehat2" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika Tidak disebabkan karena apa?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="tdkSehat" id="tdkSehat"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="tdkSehat2" id="tdkSehat2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Apakah anda dapat melakukan pekerjaan dengan baik?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="kerjabaik" id="kerjabaik" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="kerjabaik2" id="kerjabaik2" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>iii. Jika &quot;tidak&quot; sebutkan alasannya</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="bekerjaTdkBaik" id="bekerjaTdkBaik"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="bekerjaTdkBaik2" id="bekerjaTdkBaik2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>9.</td>
                        <td colspan="7">Apakah anda memiliki hobi </td>
                      </tr>
                      <tr>         <td>&nbsp;</td>
                        <td colspan="7">
                          <table class="verdana8">
                            <tr>
                              <td width="63">TU&nbsp;&nbsp; TT</td>
                              <td width="190">&nbsp;</td>
                              <td width="64">TU&nbsp;&nbsp; TT</td>
                              <td width="169">&nbsp;</td>
                              <td width="66">TU&nbsp;&nbsp; TT</td>
                              <td width="163">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="63">
                                <input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="NYL">
                                <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="NYL">
a.</td>
                              <td width="190">Menyelam</td>
                              <td width="64"><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="PJT">
                                <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="PJT">
f.</td>
                              <td width="169"> Panjat tebing</td>
                              <td width="66"><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="PTB">
                                <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="PTB">
k.</td>
                              <td width="163">Pertambangan</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="ORA">
                                <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="ORA">
b.</td>        <td> Olahraga air selain menyelam</td>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="MCR">
  <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="BCR">
g.</td>        <td>Microlighting</td>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="ABS">
  <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="ABS">
l.</td>        <td>Angkatan bersenjata</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="CAP">
                                <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="CAP">
c.</td>        <td> Caving dan Potholing</td>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="BMB">
  <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="BMB">
h.</td>        <td>Balap motor/mobil</td>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="NLY">
  <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="NLY">
m.</td>        <td>Nelayan</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="PAY">
                                <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="PAY">
d.</td>        <td> Terjun payung</td>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="PNB">
  <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="PNB">
i.</td>        <td>Penerbangan</td>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="KEL">
  <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="KEL">
n.</td>        <td>Kelautan</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="PRL">
                              <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="PRL">
e.</td>        <td> Paralayang</td>        <td><input name="cekHobbi[]" type="checkbox" id="cekHobbi[]" value="MGB">
  <input name="cekHobbi2[]" type="checkbox" id="cekHobbi2[]" value="MGB">
j.</td>        <td>Minyak dan gas bumi</td>        <td><input type="checkbox" name="cekHobbi[]" id="cekHobbi[]" value="LAI">
  <input type="checkbox" name="cekHobbi2[]" id="cekHobbi2[]" value="LAI">
o.</td>        <td>Lain-lain</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>    </td>
          </tr>
        </table>
        <table width="700" align="center">
          <tr>
            <td align="left" class="arial10">
              <!--<a href="#" onClick="window.history.go(-1)">Back</a>--></td>
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