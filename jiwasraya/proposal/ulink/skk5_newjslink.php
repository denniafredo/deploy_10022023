<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  $noproposal=$nopertanggungan;
	$DB = New database($userid, $passwd, $DBName);
	$DB1 = New database($userid, $passwd, $DBName);
	$DB3 = New database($userid, $passwd, $DBName);
	$DB4 = New database($userid, $passwd, $DBName);

$sqlcek="update $DBUser.tabel_118_cek_skk set ceklukaberat='".$_POST['lukaberat']."',ceksehat='".$_POST['sehat']."',cekkerjabaik='".$_POST['kerjabaik']."' where noklien='".$_POST['noklien']."'";
$DB3->parse($sqlcek);
$DB3->execute();
$sqlcek2="update $DBUser.tabel_118_cek_skk set ceklukaberat='".$_POST['lukaberat2']."',ceksehat='".$_POST['sehat2']."',cekkerjabaik='".$_POST['kerjabaik2']."' where noklien='".$_POST['notert2']."'";
$DB4->parse($sqlcek2);
$DB4->execute();

 $sqlklien="insert into $DBUser.tabel_118_operasisht (noklien,blnoperasi,namaoperasi,rmhsakitoperasi,tdksehat,bekerjatdkbaik) values 
 ('".$_POST['noklien']."',to_date('01/".$_POST['blnOperasi']."','dd/mm/yyyy'),'".$_POST['namaOperasi']."','".$_POST['rmhSakitOperasi']."','".$_POST['tdkSehat']."','".$_POST['bekerjaTdkBaik']."')";
 //echo $sqlklien;
 $DB->parse($sqlklien);
  $DB->execute();
 $sqltert2="insert into $DBUser.tabel_118_operasisht (noklien,blnoperasi,namaoperasi,rmhsakitoperasi,tdksehat,bekerjatdkbaik) values 
 ('".$_POST['notert2']."',to_date('01/".$_POST['blnOperasi2']."','dd/mm/yyyy'),'".$_POST['namaOperasi2']."','".$_POST['rmhSakitOperasi2']."','".$_POST['tdkSehat2']."','".$_POST['bekerjaTdkBaik2']."')";
 $DB->parse($sqltert2);
  $DB->execute();
 
 $box=$cekHobbi; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {									
					$ket = $dear;
					$sql="insert into $DBUser.tabel_100_hobby_klien (noklien,kdhobby) values('".$_POST['noklien']."','".$ket."')";
						  //echo $sql."<br>";
						  //die;
					$DB->parse($sql);
					$DB->execute();
					}							
					}
 
 $box2=$cekHobbi2; 
      	$box_count2=count($box2);
      	if (($box_count2)<1)
				{
				}
				else
				{
    				foreach ($box2 as $dear2) {
					$ket2 = $dear2;
					$sql2="insert into $DBUser.tabel_100_hobby_klien (noklien,kdhobby) values('".$_POST['notert2']."','".$ket2."')";
						  //echo $sql1."<br>";
						  //die;
					$DB->parse($sql2);
					$DB->execute();
					}							
					}
 
  $today = date("d F Y");
  $sqltert2="select notertanggung2 from $DBUser.tabel_200_pertanggungan where notertanggung='".$_POST['noklien']."'";
 // echo $sqltert2;
  $DB1->parse($sqltert2);
  $DB1->execute();
  $arrtert2=$DB1->nextrow();
  //$notert2=$arrtert2["NOTERTANGGUNG2"];
$noklien=$_POST['noklien'] ? $_POST['noklien'] : $_GET['noklien'] ;
$notert2=$_POST['notert2'] ? $_POST['notert2'] : $_GET['notert2'] ;
  if($notert2==""){
	//  $disebled="disabled";
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
      <form name="skk1" action="skk6_newjslink.php" method="post">
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
                      <tr>         <td>10.</td>
                        <td colspan="2">Khusus untuk tertanggung perempuan :</td>         <td width="7">&nbsp;</td>         <td width="319">&nbsp;</td>         <td width="7">&nbsp;</td>         <td width="7">&nbsp;</td>         <td width="12">&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td width="17">a.</td>
                        <td colspan="3">Apakah anda pernah melakukan pap smear dengan hasil abnormal?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td width="350"><b>Calon Tertanggung Utama</b>
                          <br>
                          <input type="checkbox" name="papsmear" id="papsmear" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <input type="checkbox" name="papsmear2" id="papsmear2">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot;. kapan pemeriksaan terakhir?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="periksaPapSmear" id="periksaPapSmear"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="periksaPapSmear2" id="periksaPapSmear2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Bagaimana hasilnya?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="hasilPapSmear" id="hasilPapSmear"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="hasilPapSmear2" id="hasilPapSmear2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b.</td>         <td>Apakah haid (menstruasi) anda teratur dan tidak terganggu?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>`</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="haid" id="haid" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="haid2" id="haid2" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>c.</td>         <td>Apakah saat ini anda sedang hamil ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="hamil" id="hamil" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="hamil2" id="hamil2" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td>Jika &quot;Ya&quot;. sudah berapa bulan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="bulanHamil" id="bulanHamil"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="bulanHamil2" id="bulanHamil2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>d.</td>         <td>Apakah anda pernah melahirkan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="melahirkan" id="melahirkan" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="melahirkan2" id="melahirkan2" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>Jika &quot;Ya&quot;. sudah berapa kali?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="jmlLahir" id="jmlLahir"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="jmlLahir2" id="jmlLahir2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>e.</td>         <td>Apakah anda pernah keguguran</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="keguguran" id="keguguran" value="Y">           Ya,
                          <input type="checkbox">           Tidak
                          <input type="text" name="bulanGugur" id="malariaTU47"></td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="keguguran2" id="keguguran2">           Ya,
                          <input type="checkbox">           Tidak
                          <input type="text" name="bulanGugur2" id="malariaTU48"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot;. sudah berapa kali?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="berapaKeguguran" id="berapaKeguguran"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="berapaKeguguran2" id="berapaKeguguran2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Pada kehamilan yang keberapa?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="hamilKeberapa" id="hamilKeberapa"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="hamilKeberapa2" id="hamilKeberapa2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>f.</td>
                        <td colspan="3">Apakah anda pernah melahirkan dengan cara operasi (sectio caesarea) ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="caesar" id="caesar" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="caesar2" id="caesar2">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot;. kapan dan jelaskan penyebabnya?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="caesar" id="caesar"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="caesar2" id="caesar2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Nama dan alamat dokter/Rumah Sakit yang merawat.</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="dokterCaesar" id="dokterCaesar"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="dokterCaesar2" id="dokterCaesar2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>g.</td>
                        <td colspan="3">Apakah Anda pernah mengalami kesulitan/komplikasi pada saat hamil ataupun melahirkan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="komplikasihamil" id="komplikasihamil" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>
                          <input type="checkbox" name="komplikasihamil2" id="komplikasihamil2">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot; kapan dan bagaimana kondisi saat itu ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="kondisiKompliHamil" id="kondisiKompliHamil"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="kondisiKompliHamil2" id="kondisiKompliHamil2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Nama dan alamat lengkap Dokter yang merawat ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="dokterKompliHamil" id="dokterKompliHamil"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="dokterKompliHamil2" id="dokterKompliHamil2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>iii. Jenis Perawatan yang diberikan ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="rawatKompliHamil" id="rawatKompliHamil"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="rawatKompliHamil2" id="rawatKompliHamil2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
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