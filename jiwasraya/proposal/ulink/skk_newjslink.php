<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  $noproposal=$nopertanggungan;
	$DB = New database($userid, $passwd, $DBName);
	$DB1 = New database($userid, $passwd, $DBName);
	$DB2 = New database($userid, $passwd, $DBName);
	$DB3 = New database($userid, $passwd, $DBName);
	$DB4 = New database($userid, $passwd, $DBName);
	$DB5 = New database($userid, $passwd, $DBName);	
	$DB6 = New database($userid, $passwd, $DBName);	
	$DB7 = New database($userid, $passwd, $DBName);	
	$DB8 = New database($userid, $passwd, $DBName);	
	
	$noklien=$_GET['noklien'] ? $_GET['noklien'] : $_POST['noklien'];
//	echo $noklien;
	 $disable="onClick=\"return false\" onKeyDown=\"return false\"";
  $today = date("d F Y");
  //$sqltert2="select notertanggung2 from $DBUser.tabel_200_pertanggungan where notertanggung='".$_GET['noklien']."'";
  $sqltert2="select nopemegangpolis notertanggung2 from $DBUser.tabel_200_pertanggungan where notertanggung='$noklien' and notertanggung<>nopemegangpolis";
  //echo $sqltert2;
  $DB1->parse($sqltert2);
  $DB1->execute();
  $arrtert2=$DB1->nextrow();
  $notert2=$arrtert2["NOTERTANGGUNG2"];
  if($notert2!=""){
	  $disebled=" readonly ";
  }else{
	  $disebled="";
  }
  
  $sqlcekskk1="select NOKLIEN,CEKGEJALA,CEKRAWATINAPPULIH,CEKDIAGNOSA,CEKNARKOBA,CEKRAWATINAP,CEKLUKABERAT,CEKPAPSMEAR,CEKHAID,".
  "CEKHAMIL,CEKMELAHIRKAN,CEKKEGUGURAN,CEKCAESAR,CEKKOMPLIKASIHAMIL,CEKSEHAT,CEKKERJABAIK,KETCEKKEGUGURAN FROM $DBUser.tabel_118_cek_skk where noklien='$noklien'";
  $DB7->parse($sqlcekskk1);
 // echo $sqlcekskk1;
  $DB7->execute();
  $arrcekskk=$DB7->nextrow();
  
  if($arrcekskk["CEKGEJALA"]=="Y") 
  $cekgejala="<input type=checkbox name=gejalaTtgYa id=gejalaTtgYa checked  $disable>Ya, <input type=checkbox name=gejalaTtgNo id=gejalaTtgNo  $disable>Tidak ";
  else
  $cekgejala="<input type=checkbox name=gejalaTtgYa id=gejalaTtgYa  $disable>Ya, <input type=checkbox name=gejalaTtgNo id=gejalaTtgNo checked  $disable>Tidak "; 
  
  if($arrcekskk["CEKGEJALA"]=="Y") 
  $cekgejala="<input type=checkbox name=gejalaTtgYa id=gejalaTtgYa checked  $disable>Ya, <input type=checkbox name=gejalaTtgNo id=gejalaTtgNo  $disable>Tidak ";
  else
  $cekgejala="<input type=checkbox name=gejalaTtgYa id=gejalaTtgYa  $disable>Ya, <input type=checkbox name=gejalaTtgNo id=gejalaTtgNo checked  $disable>Tidak "; 

if($arrcekskk["CEKRAWATINAPPULIH"])
  $cekrawatinappulih="<input type=checkbox name=rawatinappulihYa checked  $disable>Ya, <input type=checkbox name=rawatinappulihNo  $disable>Tidak ";
  else
  $cekrawatinappulih="<input type=checkbox name=rawatinappulihYa  $disable>Ya, <input type=checkbox name=rawatinappulihNo checked  $disable>Tidak ";
  
 
if($arrcekskk["CEKDIAGNOSA"]=="Y")
  $cekdiagnosa="<input type=checkbox name=diagnosaYa checked  $disable>Ya, <input type=checkbox name=diagnosaNo  $disable>Tidak ";
  else
  $cekdiagnosa="<input type=checkbox name=diagnosaYa  $disable>Ya, <input type=checkbox name=diagnosaNo checked  $disable>Tidak ";
  
if($arrcekskk["CEKNARKOBA"]=="Y")
  $ceknarkoba="<input type=checkbox name=narkobaYa checked  $disable>Ya, <input type=checkbox name=narkobaNo  $disable>Tidak ";
  else
  $ceknarkoba="<input type=checkbox name=narkobaYa  $disable>Ya, <input type=checkbox name=narkobaNo checked  $disable>Tidak "; 

if($arrcekskk["CEKRAWATINAP"]=="Y")
  $cekrawatinap="<input type=checkbox name=rawatinapYa checked  $disable>Ya, <input type=checkbox name=rawatinapNo  $disable>Tidak ";
  else
  $cekrawatinap="<input type=checkbox name=rawatinapYa  $disable>Ya, <input type=checkbox name=rawatinapNo checked  $disable>Tidak ";


if($arrcekskk["CEKLUKABERAT"]=="Y")
  $ceklukaberat="<input type=checkbox name=lukaberatYa checked  $disable>Ya, <input type=checkbox name=lukaberatNo  $disable>Tidak ";
  else
  $ceklukaberat="<input type=checkbox name=lukaberatYa  $disable>Ya, <input type=checkbox name=lukaberatNo checked  $disable>Tidak ";
  
if($arrcekskk["CEKPAPSMEAR"]=="Y")
  $cekpapsmear="<input type=checkbox name=papsmearYa checked  $disable>Ya, <input type=checkbox name=papsmearNo  $disable>Tidak ";
  else
  $cekpapsmear="<input type=checkbox name=papsmearYa  $disable>Ya, <input type=checkbox name=papsmearNo checked  $disable>Tidak ";
  
if($arrcekskk["CEKHAID"]=="Y")
  $cekhaid="<input type=checkbox name=haidYa checked  $disable>Ya, <input type=checkbox name=haidNo  $disable>Tidak ";
  else
  $cekhaid="<input type=checkbox name=haidYa  $disable>Ya, <input type=checkbox name=haidNo checked  $disable>Tidak ";    
  
if($arrcekskk["CEKHAMIL"]=="Y")
  $cekhamil="<input type=checkbox name=hamilYa checked  $disable>Ya, <input type=checkbox name=hamilNo  $disable>Tidak ";
  else
  $cekhamil="<input type=checkbox name=hamilYa  $disable>Ya, <input type=checkbox name=hamilNo checked  $disable>Tidak ";  
  
if($arrcekskk["CEKMELAHIRKAN"]=="Y")
  $cekmelahirkan="<input type=checkbox name=melahirkanYa checked  $disable>Ya, <input type=checkbox name=melahirkanNo  $disable>Tidak ";
  else
  $cekmelahirkan="<input type=checkbox name=melahirkanYa  $disable>Ya, <input type=checkbox name=melahirkanNo checked  $disable>Tidak ";
  
if($arrcekskk["CEKKEGUGURAN"]=="Y")
  $cekkeguguran="<input type=checkbox name=keguguranYa checked  $disable>Ya, <input type=checkbox name=keguguranNo  $disable>Tidak ";
  else
  $cekkeguguran="<input type=checkbox name=keguguranYa  $disable>Ya, <input type=checkbox name=keguguranNo checked  $disable>Tidak ";
  
if($arrcekskk["CEKCAESAR"]=="Y")
  $cekcaesar="<input type=checkbox name=caesarYa checked  $disable>Ya, <input type=checkbox name=caesarNo  $disable>Tidak ";
  else
  $cekcaesar="<input type=checkbox name=caesarYa  $disable>Ya, <input type=checkbox name=caesarNo checked  $disable>Tidak ";      
  
if($arrcekskk["CEKKOMPLIKASIHAMIL"]=="Y")
  $cekkomplikasihamil="<input type=checkbox name=komplikasihamilYa checked  $disable>Ya, <input type=checkbox name=komplikasihamilNo  $disable>Tidak ";
  else
  $cekkomplikasihamil="<input type=checkbox name=komplikasihamilYa  $disable>Ya, <input type=checkbox name=komplikasihamilNo checked  $disable>Tidak ";

if($arrcekskk["CEKSEHAT"]=="Y")
  $ceksehat="<input type=checkbox name=sehatYa checked  $disable>Ya, <input type=checkbox name=sehatNo  $disable>Tidak ";
  else
  $ceksehat="<input type=checkbox name=sehatYa  $disable>Ya, <input type=checkbox name=sehatNo checked  $disable>Tidak ";
  
if($arrcekskk["CEKKERJABAIK"]=="Y")
  $cekkerjabaik="<input type=checkbox name=kerjabaikYa checked  $disable>Ya, <input type=checkbox name=kerjabaikNo  $disable>Tidak ";
  else
  $cekkerjabaik="<input type=checkbox name=kerjabaikYa  $disable>Ya, <input type=checkbox name=kerjabaikNo checked  $disable>Tidak ";

if($arrcekskk["KETCEKKEGUGURAN"]!="")
  $ketcekkeguguran="( ".$arrcekskk["KETCEKKEGUGURAN"]." )";
  else
  $ketcekkeguguran=" ";
  
  $sqlcekskk2="select NOKLIEN,CEKGEJALA,CEKRAWATINAPPULIH,CEKDIAGNOSA,CEKNARKOBA,CEKRAWATINAP,CEKLUKABERAT,CEKPAPSMEAR,CEKHAID,".
  "CEKHAMIL,CEKMELAHIRKAN,CEKKEGUGURAN,CEKCAESAR,CEKKOMPLIKASIHAMIL,CEKSEHAT,CEKKERJABAIK,KETCEKKEGUGURAN FROM $DBUser.tabel_118_cek_skk where noklien='$notert2'";  
  //echo $sqlcekskk2;
  $DB8->parse($sqlcekskk2);
  $DB8->execute();
  $arrcekskk2=$DB8->nextrow();
  if($arrcekskk2["CEKGEJALA"]=="Y") 
  $cekgejala2="<input type=checkbox name=gejalaTtgYa2 id=gejalaTtgYa2 checked  $disable>Ya, <input type=checkbox name=gejalaTtgNo2 id=gejalaTtgNo2  $disable>Tidak ";
  else
  $cekgejala2="<input type=checkbox name=gejalaTtgYa2 id=gejalaTtgYa2  $disable>Ya, <input type=checkbox name=gejalaTtgNo2 id=gejalaTtgNo2 checked  $disable>Tidak "; 
  
  if($arrcekskk2["CEKGEJALA"]=="Y") 
  $cekgejala2="<input type=checkbox name=gejalaTtgYa2 id=gejalaTtgYa2 checked  $disable>Ya, <input type=checkbox name=gejalaTtgNo2 id=gejalaTtgNo2  $disable>Tidak ";
  else
  $cekgejala2="<input type=checkbox name=gejalaTtgYa2 id=gejalaTtgYa2  $disable>Ya, <input type=checkbox name=gejalaTtgNo2 id=gejalaTtgNo2 checked  $disable>Tidak "; 

if($arrcekskk2["CEKRAWATINAPPULIH"])
  $cekrawatinappulih2="<input type=checkbox name=rawatinappulihYa2 checked  $disable>Ya, <input type=checkbox name=rawatinappulihNo2  $disable>Tidak ";
  else
  $cekrawatinappulih2="<input type=checkbox name=rawatinappulihYa2  $disable>Ya, <input type=checkbox name=rawatinappulihNo2 checked  $disable>Tidak ";
  
 
if($arrcekskk2["CEKDIAGNOSA"]=="Y")
  $cekdiagnosa2="<input type=checkbox name=diagnosaYa2 checked  $disable>Ya, <input type=checkbox name=diagnosaNo2  $disable>Tidak ";
  else
  $cekdiagnosa2="<input type=checkbox name=diagnosaYa2  $disable>Ya, <input type=checkbox name=diagnosaNo2 checked  $disable>Tidak ";

if($arrcekskk2["CEKNARKOBA"]=="Y")
  $ceknarkoba2="<input type=checkbox name=narkobaYa2 checked  $disable>Ya, <input type=checkbox name=narkobaNo2  $disable>Tidak ";
  else
  $ceknarkoba2="<input type=checkbox name=narkobaYa2  $disable>Ya, <input type=checkbox name=narkobaNo2 checked  $disable>Tidak ";   
 
if($arrcekskk2["CEKRAWATINAP"]=="Y")
  $cekrawatinap2="<input type=checkbox name=rawatinapYa2 checked  $disable>Ya, <input type=checkbox name=rawatinapNo2  $disable>Tidak ";
  else
  $cekrawatinap2="<input type=checkbox name=rawatinapYa2  $disable>Ya, <input type=checkbox name=rawatinapNo2 checked  $disable>Tidak ";


if($arrcekskk2["CEKLUKABERAT"]=="Y")
  $ceklukaberat2="<input type=checkbox name=lukaberatYa checked  $disable>Ya, <input type=checkbox name=lukaberatNo2  $disable>Tidak ";
  else
  $ceklukaberat2="<input type=checkbox name=lukaberatYa  $disable>Ya, <input type=checkbox name=lukaberatNo2 checked  $disable>Tidak ";
  
if($arrcekskk2["CEKPAPSMEAR"]=="Y")
  $cekpapsmear2="<input type=checkbox name=papsmearYa2 checked  $disable>Ya, <input type=checkbox name=papsmearNo2  $disable>Tidak ";
  else
  $cekpapsmear2="<input type=checkbox name=papsmearYa2  $disable>Ya, <input type=checkbox name=papsmearNo2 checked  $disable>Tidak ";
  
if($arrcekskk2["CEKHAID"]=="Y")
  $cekhaid2="<input type=checkbox name=haidYa2 checked  $disable>Ya, <input type=checkbox name=haidNo2  $disable>Tidak ";
  else
  $cekhaid2="<input type=checkbox name=haidYa2  $disable>Ya, <input type=checkbox name=haidNo2 checked  $disable>Tidak ";    
  
if($arrcekskk2["CEKHAMIL"]=="Y")
  $cekhamil2="<input type=checkbox name=hamilYa2 checked  $disable>Ya, <input type=checkbox name=hamilNo2  $disable>Tidak ";
  else
  $cekhamil2="<input type=checkbox name=hamilYa2  $disable>Ya, <input type=checkbox name=hamilNo2 checked  $disable>Tidak ";  
  
if($arrcekskk2["CEKMELAHIRKAN"]=="Y")
  $cekmelahirkan2="<input type=checkbox name=melahirkanYa2 checked  $disable>Ya, <input type=checkbox name=melahirkanNo2  $disable>Tidak ";
  else
  $cekmelahirkan2="<input type=checkbox name=melahirkanYa2  $disable>Ya, <input type=checkbox name=melahirkanNo2 checked  $disable>Tidak ";
  
if($arrcekskk2["CEKKEGUGURAN"]=="Y")
  $cekkeguguran2="<input type=checkbox name=keguguranYa2 checked  $disable>Ya, <input type=checkbox name=keguguranNo2  $disable>Tidak ";
  else
  $cekkeguguran2="<input type=checkbox name=keguguranYa2  $disable>Ya, <input type=checkbox name=keguguranNo2 checked  $disable>Tidak ";
  
if($arrcekskk2["CEKCAESAR"]=="Y")
  $cekcaesar2="<input type=checkbox name=caesarYa2 checked  $disable>Ya, <input type=checkbox name=caesarNo2  $disable>Tidak ";
  else
  $cekcaesar2="<input type=checkbox name=caesarYa2  $disable>Ya, <input type=checkbox name=caesarNo2 checked  $disable>Tidak ";      
  
if($arrcekskk2["CEKKOMPLIKASIHAMIL"]=="Y")
  $cekkomplikasihamil2="<input type=checkbox name=komplikasihamilYa2 checked  $disable>Ya, <input type=checkbox name=komplikasihamilNo2  $disable>Tidak ";
  else

  $cekkomplikasihamil2="<input type=checkbox name=komplikasihamilYa2  $disable>Ya, <input type=checkbox name=komplikasihamilNo2 checked  $disable>Tidak ";
  
if($arrcekskk2["CEKSEHAT"]=="Y")
  $ceksehat2="<input type=checkbox name=sehatYa2 checked  $disable>Ya, <input type=checkbox name=sehatNo2  $disable>Tidak ";
  else
  $ceksehat2="<input type=checkbox name=sehatYa2  $disable>Ya, <input type=checkbox name=sehatNo2 checked  $disable>Tidak ";
  
if($arrcekskk2["CEKKERJABAIK"]=="Y")
  $cekkerjabaik2="<input type=checkbox name=kerjabaikYa2 checked  $disable>Ya, <input type=checkbox name=kerjabaikNo2  $disable>Tidak ";
  else
  $cekkerjabaik2="<input type=checkbox name=kerjabaikYa2  $disable>Ya, <input type=checkbox name=kerjabaikNo2 checked  $disable>Tidak ";

if($arrcekskk2["KETCEKKEGUGURAN"]!="")
  $ketcekkeguguran2="( ".$arrcekskk2["KETCEKKEGUGURAN"]." )";
  else
  $ketcekkeguguran2=" ";  

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
 <?php
 if(isset($_POST['cetak']) || $_GET['action']=="cetak"){
	 //echo "<body onLoad=\"window.print();window.close()\">";
	 echo "<body onLoad=\"OnLod()\">";
 }else{ ?>
   <body onLoad=\"OnLod()\">
<?php } ?>
    <div align="center">
      <form name="skk1" action="<? echo $PHP_SELF;?>" method="post">
        <table align="center" border="0" width="700" cellpadding="1" cellspacing="2" class="tblheadskk">
          <tr>
            <td width="100%" class="tblisiskk">
              <table border="0" width="100%"  cellpadding="0" cellspacing="0">
                <tr>
                  <td width="16%" colspan="2" class="arial10">&nbsp;</td>
                  <td width="1%" class="arial10" align="center">&nbsp;</td>
                  <td width="30%" class="verdana10blkb">&nbsp;</td>
                  <br>
                  <td width="53%" colspan="3" class="verdana8" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
                  <td width="1%" class="arial10" align="center">:</td>
                  <td width="30%" class="verdana10blkb">
                    <? echo $today;?></td>
                  <td width="53%" colspan="3" class="verdana8" align="center">&nbsp;</td>
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
                  <td width="100%" class="hijao" align="center">SURAT KETERANGAN KESEHATAN</td>
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
                  <td width="53%"><?=$arr["TERTANGGUNG1"]; ?></td>
                  <td colspan="2">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
                <tr>
                  <td width="1%"></td>
                  <td width="16%"><span class="arial10">Jenis Kelamin</span></td>
                  <td width="1%">:</td>
                  <td width="53%"><span class="arial10"> <?=$arr["JENISKELAMIN"]; ?></span></td>
                  <td colspan="2" class="arial10">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
              </table>
              <table border="1" class="verdana8" bordercolor="#000000">
                <tr><td>Calon  Tertanggung  yang ikut dalam program asuransi harus menjawab  semua pertanyaan dalam SPAJ dan SKK ini ( dan dalam pernyataan pribadi yang menyangkut kesehatan yang diajukan oleh Penanggung atau pemeriksa kesehatan ) secara lengkap dan jujur. Jika tidak, dan  mengakibatkan berubahnya keputusan Underwriting maka dapat terjadi pembatalan Polis yang telah diterbitkan. </td>
                </tr>
              </table>
              <?php echo $arrRiw2["JMLHIDUP"]; ?>
              <table width="100%" height="233" border="1" style="border-collapse:collapse">                
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
                <?php 
				$sqlRiw="select * from $DBUser.tabel_116_riwayat_kel_nul where noklien='$noklien'";				
				$DB->parse($sqlRiw);
				$DB->execute();
				while($arrRiw=$DB->nextrow()){					
				if($arrRiw["KDHUBUNGAN"]=="A"){
					?>
                <tr class="verdana8">          <td>Ayah</td>
                  <td align="center"><?php echo $arrRiw["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw["USIA"] ? $arrRiw["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="ayahDiabetTtg" id="ayahDiabetTtg" <?php echo $arrRiw["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw["DIABETES"];?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ayahHiperTtg" id="ayahHiperTtg" <?php echo $arrRiw["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"> </td>
                  <td align="center">
                    <input type="checkbox" name="ayahStrokeTtg" id="ayahStrokeTtg" <?php echo $arrRiw["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ayahKankerTtg" id="ayahKankerTtg" <?php echo $arrRiw["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <?php echo $arrRiw["KESEHATAN"]; ?></td>
                  <td align="center">
                    <?php echo $arrRiw["USIAMENINGGAL"] ? $arrRiw["USIAMENINGGAL"]." th" : " "; ?> </td>
                  <td align="center">
                    <?php echo $arrRiw["SEBABMENINGGAL"] ? $arrRiw["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw["KDHUBUNGAN"]=="U"){ ?>
                <tr class="verdana8">          <td>Ibu</td>
                  <td align="center"><?php echo $arrRiw["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw["USIA"] ? $arrRiw["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="ibuDiabetTtg" id="ibuDiabetTtg" <?php echo $arrRiw["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ibuHiperTtg" id="ibuHiperTtg" <?php echo $arrRiw["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ibuStrokeTtg" id="ibuStrokeTtg" <?php echo $arrRiw["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ibuTumorTtg" id="ibuTumorTtg" <?php echo $arrRiw["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw["USIAMENINGGAL"] ? $arrRiw["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw["SEBABMENINGGAL"] ? $arrRiw["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw["KDHUBUNGAN"]=="IS"){ ?>
                <tr class="verdana8">          <td>Istri/Suami</td>
                  <td align="center"><?php echo $arrRiw["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw["USIA"] ? $arrRiw["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="isSuDiabetTtg" <?php echo $arrRiw["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw["DIABETES"]; ?>" id="isSuDiabetTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="isSuHiperTtg" <?php echo $arrRiw["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw["HIPERTENSI"]; ?>" id="isSuHiperTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="isSuStrokeTtg" <?php echo $arrRiw["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw["JANTUNG"]; ?>" id="isSuStrokeTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="isSuKankerTtg" <?php echo $arrRiw["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw["TUMOR"]; ?>" id="isSuKankerTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw["USIAMENINGGAL"] ? $arrRiw["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw["SEBABMENINGGAL"] ? $arrRiw["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw["KDHUBUNGAN"]=="L"){ ?>
                <tr class="verdana8" >          <td>Saudara Laki-laki</td>
                  <td align="center"><?php echo $arrRiw["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw["USIA"] ? $arrRiw["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakDiabetTtg" id="sauLakDiabetTtg" <?php echo $arrRiw["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakHiperTtg" id="sauLakHiperTtg" <?php echo $arrRiw["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakStrokeTtg" id="sauLakStrokeTtg" <?php echo $arrRiw["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakKankerTtg" id="sauLakKankerTtg" <?php echo $arrRiw["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw["USIAMENINGGAL"] ? $arrRiw["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw["SEBABMENINGGAL"] ? $arrRiw["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
               <? }elseif($arrRiw["KDHUBUNGAN"]=="W"){ ?>
                <tr class="verdana8">          <td>Saudara Perempuan</td>
                  <td align="center"><?php echo $arrRiw["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw["USIA"] ? $arrRiw["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerDiabetTtg" id="sauPerDiabetTtg" <?php echo $arrRiw["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerHiperTtg" id="sauPerHiperTtg" <?php echo $arrRiw["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerStrokeTtg" id="sauPerStrokeTtg" <?php echo $arrRiw["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerKankerTtg" id="sauPerKankerTtg" <?php echo $arrRiw["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw["USIAMENINGGAL"] ? $arrRiw["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw["SEBABMENINGGAL"] ? $arrRiw["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw["KDHUBUNGAN"]=="1"){ ?>
                <tr class="verdana8">          <td>Anak Kandung</td>
                  <td align="center"><?php echo $arrRiw["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw["USIA"] ? $arrRiw["USIA"]." th" : "0 th"; ?></td>
                  <td align="center">
                    <input type="checkbox" name="anakDiabetTtg" id="anakDiabetTtg" <?php echo $arrRiw["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="anakHiperTtg" id="anakHiperTtg" <?php echo $arrRiw["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="anakaStrokeTtg" id="anakStrokeTtg" <?php echo $arrRiw["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="anakKankerTtg" id="anakKankerTtg" <?php echo $arrRiw["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw["USIAMENINGGAL"] ? $arrRiw["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw["SEBABMENINGGAL"] ? $arrRiw["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <?php 
				} 
				}?>
              </table>      <?php echo $arrRiw["USIAMENINGGAL"]; ?><br /><br />
              <? 
			  if($notert2==""){
			  }else{			   
			  ?><table width="796" height="233" border="1" style="border-collapse:collapse">                
                <tr class="verdana8">
                  <td rowspan="2" align="center"  width="206">Keluarga Tertanggung Tambahan</td>
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
                <?php 
				$sqlRiw2="select * from $DBUser.tabel_116_riwayat_kel_nul where noklien='$notert2'";				
				$DB->parse($sqlRiw2);
				$DB->execute();
				//echo $sqlRiw2;
				while($arrRiw2=$DB->nextrow()){					
				if($arrRiw2["KDHUBUNGAN"]=="A"){
					?>
                <tr class="verdana8">          <td>Ayah</td>
                  <td align="center">
                    <?php echo $arrRiw2["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw2["USIA"] ? $arrRiw2["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="ayahDiabetTtg2" id="ayahDiabetTtg2" <?php echo $arrRiw2["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw2["DIABETES"];?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ayahHiperTtg2" id="ayahHiperTtg2" <?php echo $arrRiw2["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw2["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"> </td>
                  <td align="center">
                    <input type="checkbox" name="ayahStrokeTtg2" id="ayahStrokeTtg2" <?php echo $arrRiw2["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw2["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ayahKankerTtg2" id="ayahKankerTtg2" <?php echo $arrRiw2["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw2["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw2["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw2["USIAMENINGGAL"] ? $arrRiw2["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw2["SEBABMENINGGAL"] ? $arrRiw2["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw2["KDHUBUNGAN"]=="U"){ ?>
                <tr class="verdana8">          <td>Ibu</td>
                  <td align="center">
                    <?php echo $arrRiw2["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw2["USIA"] ? $arrRiw2["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="ibuDiabetTtg2" id="ibuDiabetTtg2" <?php echo $arrRiw2["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw2["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ibuHiperTtg2" id="ibuHiperTtg2" <?php echo $arrRiw2["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw2["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ibuStrokeTtg2" id="ibuStrokeTtg2" <?php echo $arrRiw2["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw2["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="ibuTumorTtg2" id="ibuTumorTtg2" <?php echo $arrRiw2["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw2["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw2["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw2["USIAMENINGGAL"] ? $arrRiw2["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw2["SEBABMENINGGAL"] ? $arrRiw2["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw2["KDHUBUNGAN"]=="IS"){ ?>
                <tr class="verdana8">          <td>Istri/Suami</td>
                  <td align="center"><?php echo $arrRiw2["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw2["USIA"] ? $arrRiw2["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="isSuDiabetTtg2" <?php echo $arrRiw2["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw2["DIABETES"]; ?>" id="isSuDiabetTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="isSuHiperTtg2" <?php echo $arrRiw2["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw2["HIPERTENSI"]; ?>" id="isSuHiperTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="isSuStrokeTtg2" <?php echo $arrRiw2["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw2["JANTUNG"]; ?>" id="isSuStrokeTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="isSuKankerTtg2" <?php echo $arrRiw2["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw2["TUMOR"]; ?>" id="isSuKankerTtg" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw2["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw2["USIAMENINGGAL"] ? $arrRiw2["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw2["SEBABMENINGGAL"] ? $arrRiw2["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw2["KDHUBUNGAN"]=="L"){ ?>
                <tr class="verdana8" >          <td>Saudara Laki-laki</td>
                  <td align="center"><?php echo $arrRiw2["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw2["USIA"] ? $arrRiw2["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakDiabetTtg2" id="sauLakDiabetTtg2" <?php echo $arrRiw2["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw2["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakHiperTtg2" id="sauLakHiperTtg2" <?php echo $arrRiw2["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw2["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakStrokeTtg2" id="sauLakStrokeTtg2" <?php echo $arrRiw2["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw2["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauLakKankerTtg2" id="sauLakKankerTtg2" <?php echo $arrRiw2["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw2["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw2["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw2["USIAMENINGGAL"] ? $arrRiw2["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw2["SEBABMENINGGAL"] ? $arrRiw2["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
               <? }elseif($arrRiw2["KDHUBUNGAN"]=="W"){ ?>
                <tr class="verdana8">          <td>Saudara Perempuan</td>
                  <td align="center"><?php echo $arrRiw2["JMLHIDUP"]; ?> Org</td>
                  <td align="center"><?php echo $arrRiw2["USIA"] ? $arrRiw2["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerDiabetTtg2" id="sauPerDiabetTtg2" <?php echo $arrRiw2["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw2["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerHiperTtg2" id="sauPerHiperTtg2" <?php echo $arrRiw2["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw2["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerStrokeTtg2" id="sauPerStrokeTtg2" <?php echo $arrRiw2["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw2["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="sauPerKankerTtg2" id="sauPerKankerTtg2" <?php echo $arrRiw2["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw2["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw2["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw2["USIAMENINGGAL"] ? $arrRiw2["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw2["SEBABMENINGGAL"] ? $arrRiw2["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <? }elseif($arrRiw2["KDHUBUNGAN"]=="1"){ ?>
                <tr class="verdana8">          <td>Anak Kandung</td>
                  <td align="center"><?php echo $arrRiw2["JMLHIDUP"]; ?> Org</td>
                  <td align="center">
                    <?php echo $arrRiw2["USIA"] ? $arrRiw2["USIA"]." th" : " "; ?></td>
                  <td align="center">
                    <input type="checkbox" name="anakDiabetTtg2" id="anakDiabetTtg2" <?php echo $arrRiw2["DIABETES"]? "checked" : ""; ?> value="<?php echo $arrRiw2["DIABETES"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="anakHiperTtg2" id="anakHiperTtg2" <?php echo $arrRiw2["HIPERTENSI"]? "checked" : ""; ?> value="<?php echo $arrRiw2["HIPERTENSI"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="anakaStrokeTtg2" id="anakStrokeTtg2" <?php echo $arrRiw2["JANTUNG"]? "checked" : ""; ?> value="<?php echo $arrRiw2["JANTUNG"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center">
                    <input type="checkbox" name="anakKankerTtg2" id="anakKankerTtg2" <?php echo $arrRiw2["TUMOR"]? "checked" : ""; ?> value="<?php echo $arrRiw2["TUMOR"]; ?>" onClick="return false" onKeyDown="return false"></td>
                  <td align="center"><?php echo $arrRiw2["KESEHATAN"]; ?></td>
                  <td align="center"><?php echo $arrRiw2["USIAMENINGGAL"] ? $arrRiw2["USIAMENINGGAL"]." th" : " "; ?></td>
                  <td align="center"><?php echo $arrRiw2["SEBABMENINGGAL"] ? $arrRiw2["SEBABMENINGGAL"] : " - " ; ?></td>
                </tr>
                <?php 
				} 
				}?>
              </table> <?php } ?>      <br />
              <table border="1" class="verdana8" bordercolor="#000000">
                <tr><td>Jika terdapat jawaban "Ya", mohon jelaskan dengan lengkap        Diagnosanya, lama dialami, tanggal konsultasi (rawat), nama dan alamat dokter/rumah sakit/rawat inap/tempat konsultasi,        serta kondisi saat ini. </td>
                </tr>
                <tr><td>
                <? 
				$sqldiag="select diagnosa from $DBUser.tabel_118_klien_diagnosa where noklien='$noklien'";
				$DB->parse($sqldiag);
				$DB->execute();
				$arrdiag=$DB->nextrow();				
				?>
<textarea name="diagnosa" cols="100" readonly id="diagnosa"><?php echo $arrdiag["DIAGNOSA"];?></textarea></td>
                </tr>
                <tr><td>       <b>Riwayat Kesehatan Tertanggung</b>
                    <br>Beri Tanda (v) untuk pernyataan-pernyataan dibawah ini : </td>
                </tr>
                <tr>         <td>
                    <table class="verdana8">
                      <tr>
                        <td width="31" rowspan="2" align="right" valign="top">   1.  </td>
                        <td colspan="7" align="left">Apakah  Anda  pernah  mengalami  gejala-gejala, diperiksa, menderita, didiagnosa, mendapat pengobatan,         disarankan atau  menjalani  rawat  inap,  menjalani operasi,  dianjurkan untuk  mendapat nasehat medis,         telah mendapat nasehat medis, atau dirujuk ke dokter spesialis, untuk penyakit di bawah ini :</td>
                      </tr>
                      <tr>
                        <td colspan="3"><b>Calon Tertanggung Utama</b>
                          <br>
                           <?php echo $cekgejala; ?></td>
                        <td colspan="4"><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <?php echo $cekgejala2; ?></td>
                      </tr>
                      <tr>
                        <td colspan="8">Jika "Ya", mohon Calon Tertanggung memberi tanda "v" untuk setiap kelainan yang dimiliki dan mengisi KUESIONER sesuai dengan kelainan tersebut.</td>
                      </tr>
                      <tr>
                        <td colspan="8">
                        <?php
							$sqlgejala="select NOKLIEN,JANTUNG,KELENJAR,TUMOR,MAAG,MIGRAIN,REMATIK,BATUK,ANEMIA,MALARIA,".
							"NYERIDADA,EPILEPSI,DIABET,POLIO,HIPERTENSI,PSIKO,GINJAL,LAINNYA,KETLAINNYA from $DBUser.TABEL_118_GEJALA_PENYAKIT_N where noklien='$noklien'";
							$DB->parse($sqlgejala);
							$DB->execute();
							$arrgejala=$DB->nextrow();							
							
							
							$sqlgejala2="select NOKLIEN,JANTUNG,KELENJAR,TUMOR,MAAG,MIGRAIN,REMATIK,BATUK,ANEMIA,MALARIA,".
							"NYERIDADA,EPILEPSI,DIABET,POLIO,HIPERTENSI,PSIKO,GINJAL,LAINNYA,KETLAINNYA from $DBUser.TABEL_118_GEJALA_PENYAKIT_N where noklien='$notert2'";
							$DB->parse($sqlgejala2);
							$DB->execute();
							$arrgejala2=$DB->nextrow();
						?>
                          <table class="verdana8">
                            <tr>
                              <td width="1">&nbsp; </td>
                              <td width="15">&nbsp;</td>
                              <td width="51">TU&nbsp;&nbsp; TT</td>
                              <td width="335">&nbsp;</td>
                              <td width="53">TU&nbsp;&nbsp; TT</td>
                              <td width="295">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="1">&nbsp; </td>
                              <td width="15">&nbsp;</td>
                              <td width="51">
                                <input type="checkbox" name="gejalaJantungTU" id="gejalaJantungTU" <?php echo $arrgejala["JANTUNG"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                              <input type="checkbox" name="gejalaJantungTT" id="gejalaJantungTT" <?=$disebled; echo $arrgejala2["JANTUNG"]=="Y" ? "checked" : "";?> onClick="return false" onKeyDown="return false"></td>
                              <td width="335">Jantung bawaan *</td>
                              <td width="53">
                                <input type="checkbox" name="gejalaMalariaTU" id="gejalaMalariaTU" <?php echo $arrgejala["MALARIA"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                              <input type="checkbox" name="gejalaMalariaTU" id="gejalaMalariaTU" <?=$disebled; echo $arrgejala2["MALARIA"]=="Y" ? "checked" : "";?> onClick="return false" onKeyDown="return false"></td>
                              <td width="295"> Malaria</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaTyroidTU" id="gejalaTyroidTU" <?php echo $arrgejala["KELENJAR"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaTyroidTT" id="gejalaTyroidTT" <?=$disebled; echo $arrgejala2["KELENJAR"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td> Kelenjar /Thyroid</td>        <td>
                                <input type="checkbox" name="gejalaNyeriTU" id="gejalaNyeriTU" <?php echo $arrgejala["NYERIDADA"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaNyeriTT" id="gejalaNyeriTT" <?=$disebled; echo $arrgejala2["NYERIDADA"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Nyeri dada, kelainan jantung dan pembuluh darah</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaTumorTU" id="gejalaTumorTU" <?php echo $arrgejala["TUMOR"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaTumorTT" id="gejalaTumorTT" <?=$disebled; echo $arrgejala2["TUMOR"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td> Tumor/Kista/Benjolan/pembengkakan/Kanker</td>        <td>
                                <input type="checkbox" name="gejalaEpilepsiTU" id="gejalaEpilepsiTU" <?php echo $arrgejala["EPILEPSI"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaEpilepsiTT" id="gejalaEpilepsiTT" <?=$disebled; echo $arrgejala2["EPILEPSI"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Epilepsi / Ayan / Kejang / pingsan **</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaMaagTU" id="gejalaMaagTU" <?php echo $arrgejala["MAAG"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaMaagTT" id="gejalaMaagTT" <?=$disebled; echo $arrgejala2["MAAG"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td> Maag, diare dan gangguan pencernaan lainnya</td>        <td>
                                <input type="checkbox" name="gejalaKenmanTU" id="gejalaKenmanTU" <?php echo $arrgejala["DIABET"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaKenmanTT" id="gejalaKenmanTT" <?=$disebled; echo $arrgejala2["DIABET"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Kencing manis</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaVertigoTU" id="gejalaVertigoTU" <?php echo $arrgejala["MIGRAIN"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaVertigoTT" id="gejalaVertigoTT" <?=$disebled; echo $arrgejala2["MIGRAIN"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td> Sakit Kepala/Migrain/Pusing/Vertigo/Stroke</td>        <td>
                                <input type="checkbox" name="gejalaPolioTU" id="gejalaPolioTU" <?php echo $arrgejala["POLIO"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaPolioTT" id="gejalaPolioTT" <?=$disebled; echo $arrgejala2["POLIO"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Polio</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaRematikTU" id="gejalaRematikTU" <?php echo $arrgejala["REMATIK"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaRematikTT" id="gejalaRematikTT" <?=$disebled; echo $arrgejala2["REMATIK"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td> Gangguan Persendian/Rematik/Kelainan pada Otot/Sendi/Tulang</td>        <td>
                                <input type="checkbox" name="gejalaDarTingTU" id="gejalaDarTingTU" <?php echo $arrgejala["HIPERTENSI"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaDarTingTT" id="gejalaDarTingTT" <?=$disebled; echo $arrgejala2["HIPERTENSI"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Tekanan darah tinggi</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaNafasTU" id="gejalaNafasTU" <?php echo $arrgejala["BATUK"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaNafasTT" id="gejalaNafasTT" <?=$disebled; echo $arrgejala2["BATUK"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td> Gangguan Pernafasan/ batuk berkepanjangan/sesak nafas/Bronkitis/ Asthma/Batuk Darah</td>        <td>
                                <input type="checkbox" name="gejalaPsikoTU" id="gejalaPsikoTU" <?php echo $arrgejala["PSIKO"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaPsikoTT" id="gejalaPsikoTT" <?=$disebled; echo $arrgejala2["PSIKO"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Kelainan Psikologis</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaAnemiaTU" id="gejalaAnemiaTU" <?php echo $arrgejala["ANEMIA"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaAnemiaTT" id="gejalaAnemiaTT" <?=$disebled; echo $arrgejala2["ANEMIA"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td> Anemia, hemofilia atau kelainan darah lainnya</td>        <td>
                                <input type="checkbox" name="gejalaGinjalTU" id="gejalaGinjalTU" <?php echo $arrgejala["GINJAL"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaGinjalTT" id="gejalaGinjalTT" <?=$disebled; echo $arrgejala2["GINJAL"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Sakit Ginjal/ batu Ginjal/ saluran kemih/ prostat</td>
                            </tr>
                            <tr>        <td>&nbsp; </td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>
                                <input type="checkbox" name="gejalaLainnyaTU" id="gejalaLainnyaTU" <?php echo $arrgejala["LAINNYA"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false">
                                <input type="checkbox" name="gejalaLainnyaTT" id="gejalaLainnyaTT" <?=$disebled; echo $arrgejala2["LAINNYA"]=="Y" ? "checked" : ""; ?> onClick="return false" onKeyDown="return false"></td>        <td>Penyakit lain yang belum disebutkan ?</td>
                            </tr>
                          </table>       </td>
                      </tr>
                      <!-- Point 2  -->
                      <tr>
                        <td rowspan="2" align="right" valign="top">   2.  </td>
                        <td colspan="7" align="left">Apakah  Anda  pernah  mengalami gejala-gejala, diperiksa, menderita,         mendapat pengobatan, disarankan untuk rawat inap, menjalani rawat inap untuk kelainan yang disebutkan di bawah ini :</td>
                      </tr>
                      <tr>
                        <td colspan="3"><b>Calon Tertanggung Utama</b>
                          <br>
                          <?php echo $cekrawatinap; ?></td>
                        <td colspan="4"><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <?php echo $cekrawatinap2; ?></td>
                      </tr>
                      <tr>
                        <td colspan="8">Jika "Ya", mohon Calon Tertanggung memberi tanda "v" untuk setiap kelainan yang dimiliki dan mengisi KUESIONER sesuai dengan kelainan tersebut.</td>
                      </tr>
                      <tr>
                        <td colspan="8">
                          <table class="verdana8">
                          
                            <tr>         <td>&nbsp;</td>         <td>TU</td>         <td>TT</td>         <td>&nbsp;</td>
                              <td width="155">Nama Penyakit</td>
                              <td width="69">Tgl. Sakit</td>
                              <td width="148">Nama &amp; Alamat Dokter</td>
                            </tr>
                             <?php
						  if($notert2!=$noklien && $notert!="")
						  {
							   $sqlpenyakit="SELECT   a.NOKLIEN,
           a.KODEPENYAKIT,
           a.KDSTATUSSAKIT,
           a.NAMADOKTER,
           a.ALAMATDOKTER,
           a.KDMUTASI,
           TO_CHAR (a.TGLMUTASI, 'dd/mm/yyyy') AS TGLMUTASI,
           a.NAMAPENYAKITLAIN,
           a.PENYEBAB,
           b.NOKLIEN as notert2,
           b.KODEPENYAKIT as KODEPENYAKIT2,
           b.KDSTATUSSAKIT as KDSTATUSSAKIT2,
           b.NAMADOKTER as NAMADOKTER2,
           b.ALAMATDOKTER as ALAMATDOKTER2,
           b.KDMUTASI AS KDMUTASI2 ,
           TO_CHAR (b.TGLMUTASI, 'dd/mm/yyyy') as TGLMUTASI2,
           b.NAMAPENYAKITLAIN as NAMAPENYAKITLAIN2,
           b.PENYEBAB as PENYEBAB2,
           CASE a.kodepenyakit
              WHEN 'hepa' THEN 1
              WHEN 'usus' THEN 2
              WHEN 'ginjal' THEN 3
              WHEN 'jantung' THEN 4
              WHEN 'payudara' THEN 5
              WHEN 'alergi' THEN 6
              WHEN 'mata' THEN 7
              WHEN 'otak' THEN 8
              WHEN 'cedera' THEN 9
              WHEN 'hernia' THEN 10
              WHEN 'kolesterol' THEN 11
              WHEN 'urat' THEN 12
              WHEN 'endokrin' THEN 13
              WHEN 'tbc' THEN 14
              WHEN 'aids' THEN 15
              WHEN 'cacat' THEN 16
              WHEN 'lainnya' THEN 17
              ELSE 18
           END
              URUT
    FROM   $DBUser.tabel_118_klien_penyakit a, $DBUser.tabel_118_klien_penyakit b
   WHERE       a.noklien = '$noklien'
           AND b.noklien = '$notert2'
           AND a.kodepenyakit = b.kodepenyakit
ORDER BY   urut"; 
						  }else{
							  $sqlpenyakit="
  SELECT   a.NOKLIEN,
           a.KODEPENYAKIT,
           a.KDSTATUSSAKIT,
           a.NAMADOKTER,
           a.ALAMATDOKTER,
           a.KDMUTASI,
           TO_CHAR (a.TGLMUTASI, 'dd/mm/yyyy') AS TGLMUTASI,
           a.NAMAPENYAKITLAIN,
           a.PENYEBAB,          
           CASE a.kodepenyakit
              WHEN 'hepa' THEN 1
              WHEN 'usus' THEN 2
              WHEN 'ginjal' THEN 3
              WHEN 'jantung' THEN 4
              WHEN 'payudara' THEN 5
              WHEN 'alergi' THEN 6
              WHEN 'mata' THEN 7
              WHEN 'otak' THEN 8
              WHEN 'cedera' THEN 9
              WHEN 'hernia' THEN 10
              WHEN 'kolesterol' THEN 11
              WHEN 'urat' THEN 12
              WHEN 'endokrin' THEN 13
              WHEN 'tbc' THEN 14
              WHEN 'aids' THEN 15
              WHEN 'cacat' THEN 16
              WHEN 'lainnya' THEN 17
              ELSE 18
           END
              URUT
    FROM   $DBUser.tabel_118_klien_penyakit a
   WHERE       a.noklien = '$noklien'           
ORDER BY   urut
";							  
							  }
							//  echo $sqlpenyakit;
						   $DB4->parse($sqlpenyakit);
						   $DB4->execute();
						   while($arrpenyakit=$DB4->nextrow()){
						   
						   ?>
                            <tr>
                            <?php if($arrpenyakit["KODEPENYAKIT"]=="hepa" ||  $arrpenyakit["KODEPENYAKIT2"]=="hepa"){ ?> 
                            <td width="1">&nbsp; </td>
                              <td width="20" valign="top">
                                <input type="checkbox" name="hepaTU" id="hepaTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td width="38" valign="top">
                                <input type="checkbox" name="hepaTT" id="hepaTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>a. </td>
                              <td width="315" valign="top">Hepatitis A, Hepatitis B, Hepatitis C, Hepatitis D, Hepatitis E, Hati (selain Hepatitis) dan Kandung Empedu ?</td>
                              <td colspan="3" align="center" valign="middle"><table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="usus" ||  $arrpenyakit["KODEPENYAKIT2"]=="usus"){ ?> 
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="ususTU" id="ususTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="ususTT" id="ususTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>b. </td>
                              <td valign="top">Usus, Pankreas, Wasir dan Organ Pencernaan lain ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="ginjal" ||  $arrpenyakit["KODEPENYAKIT2"]=="ginjal"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="ginjalTU" id="ginjalTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="ginjalTT" id="ginjalTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>c. </td>
                              <td valign="top">Ginjal, Batu Ginjal, Saluran Kemih  dan Prostat ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="jantung" ||  $arrpenyakit["KODEPENYAKIT2"]=="jantung"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="jantungTU" id="jantungTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="jantungTT" id="jantungTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>d. </td>
                              <td valign="top"> Jantung, Demam Rheuma,  Pembuluh Darah dan Stroke ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="payudara" ||  $arrpenyakit["KODEPENYAKIT2"]=="payudara"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="payudaraTU" id="payudaraTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="payudaraTT" id="payudaraTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>e. </td>
                              <td valign="top">Payudara, Kandungan dan Indung Telur ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="alergi" ||  $arrpenyakit["KODEPENYAKIT2"]=="alergi"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="alergiTU" id="alergiTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="alergiTT" id="alergiTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>f. </td>
                              <td valign="top">Alergi, Penyakit Kulit, penyakit kelamin ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                     <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="mata" ||  $arrpenyakit["KODEPENYAKIT2"]=="mata"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="mataTU" id="mataTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="mataTT" id="mataTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>g. </td>
                              <td valign="top">Mata,Telinga,Hidung,Tenggorokan (THT), Sinus dan gangguan bicara?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="otak" ||  $arrpenyakit["KODEPENYAKIT2"]=="otak"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="otakTU" id="otakTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="otakTT" id="otakTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>h. </td>
                              <td valign="top">Otak, Syaraf, Kejang, Pingsan dan Kelumpuhan / gangguan pada anggota tubuh ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="cedera" ||  $arrpenyakit["KODEPENYAKIT2"]=="cedera"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="cederaTU" id="cederaTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="cederaTT" id="cederaTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>i. </td>
                              <td valign="top">Kecelakaan dan cedera berat berkepanjangan ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="hernia" ||  $arrpenyakit["KODEPENYAKIT2"]=="hernia"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="herniaTU" id="herniaTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="herniaTT" id="herniaTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>j. </td>
                              <td valign="top">Hernia ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                     <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>                                    
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="kolesterol" ||  $arrpenyakit["KODEPENYAKIT2"]=="kolesterol"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="kolesterolTU" id="kolesterolTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="kolesterolTT" id="kolesterolTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>k. </td>
                              <td valign="top">Kolesterol ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="urat" ||  $arrpenyakit["KODEPENYAKIT2"]=="urat"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="uratTU" id="uratTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="uratTT" id="uratTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>l. </td>
                              <td valign="top">Asam Urat ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="endokrin" ||  $arrpenyakit["KODEPENYAKIT2"]=="endokrin"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="endokrinTU" id="endokrinTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="endokrinTT" id="endokrinTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>m. </td>
                              <td valign="top">Endokrin / Hormon ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="tbc" ||  $arrpenyakit["KODEPENYAKIT2"]=="tbc"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="tbcTU" id="tbcTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="tbcTT" id="tbcTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>n. </td>
                              <td valign="top">Tuberkulosis (TBC) ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="aids" ||  $arrpenyakit["KODEPENYAKIT2"]=="aids"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="aidsTU" id="aidsTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="aidsTT" id="aidsTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>o. </td>
                              <td valign="top">AIDS & kondisi yang berhubungan dengan AIDS (demam, kelelahan, diare kronis, penurunan berat badan, sariawan yang lama sembuh,          pembengkakan getah bening atau luka di kulit berulang & berkepanjangan yang tidak diketahui penyebabnya) ?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="cacat" ||  $arrpenyakit["KODEPENYAKIT2"]=="cacat"){ ?>                             
                            <tr>        <td>&nbsp; </td>
                              <td valign="top">
                                <input type="checkbox" name="cacatTU" id="cacatTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="cacatTT" id="cacatTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>p. </td>
                              <td valign="top">Kelainan fisik, cacad bawaan atau bentuk kelainan fisik lainnya</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php }elseif($arrpenyakit["KODEPENYAKIT"]=="lainnya" ||  $arrpenyakit["KODEPENYAKIT2"]=="lainnya"){ ?>                             
                            <tr>        <td>&nbsp; </td>                            
                              <td valign="top">
                                <input type="checkbox" name="lainnyaTU" id="lainnyaTU" <?php echo $arrpenyakit["KDSTATUSSAKIT"]=="Y"? "checked" : ""; ?>></td>
                              <td valign="top">
                                <input type="checkbox" name="lainnyaTT" id="lainnyaTT" <?php echo $arrpenyakit["KDSTATUSSAKIT2"]=="Y"? "checked" : ""; ?>>q. </td>
                              <td valign="top">Penyakit lain yang belum disebutkan?</td>
                              <td colspan="3" valign="middle">
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182">
                                      <?=$arrpenyakit["NAMAPENYAKITLAIN"];?></td>
                                    <td width="78">
                                      <?=$arrpenyakit["TGLMUTASI"];?></td>
                                    <td width="247">
                                      <?=$arrpenyakit["NAMADOKTER"].", ".$arrpenyakit["ALAMATDOKTER"];?></td>
                                  </tr>
                                </table>
                                <table width="376" border="1" class="verdana8" style="border-collapse:collapse" bordercolor="#000000">
                                  <tr>
                                    <td width="182"><?=$arrpenyakit["NAMAPENYAKITLAIN2"];?></td>
                                    <td width="78"><?=$arrpenyakit["TGLMUTASI2"];?></td>
                                    <td width="247"><?=$arrpenyakit["NAMADOKTER2"].", ".$arrpenyakit["ALAMATDOKTER2"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <?php } } ?>
                          </table>        </td>
                      </tr>
                      <!-- end of point 2-->
                      <!-- Point 3-->
                      <tr>
                        <td rowspan="2" valign="top">   3.  </td>
                        <td colspan="7" align="left">Pernahkah Anda menjalani atau dianjurkan melakukan         pemeriksaan : jantung,darah, air seni, rontgen, USG, CT Scan, Biopsi, pemeriksaan penunjang atau diagnostik lainnya ? </td>
                      </tr>
                      <tr>
                        <td colspan="3"><b>Calon Tertanggung Utama</b>
                          <br>
                          <?php echo $cekdiagnosa; ?></td>
                        <td colspan="4"><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <?php echo $cekdiagnosa2; ?></td>
                      </tr>
                      <tr>
                        <td colspan="8">Apabila Calon Tertanggung menjawab "Ya" untuk pertanyaan nomor 3, mohon menjawab pertanyaan dibawah ini. (Apabila jawabannya melebihi kolom yang tersedia,         mohon menuliskan jawabannya pada "Surat pernyataan untuk SPAJ" dan dilampirkan bersama SPAJ ini).</td>
                      </tr>
                     <?php
					 $sqlperiksa="select NOKLIEN,JNSPERIKSA,to_char(TGLPERIKSA,'dd/mm/yyyy') TGLPERIKSA,HASILPERIKSA,PINJAMHASIL,LPRPERIKSA,JNSALKOHOL,AKHRMNMALKOHOL,JMLROKOK,MULAIROKOK,NAMAPENYAKIT,to_char(BLNRAWAT,'dd/mm/yyyy') BLNRAWAT,LAMARAWAT,NAMAOBAT,RMHSKTRAWAT,ALASANPERIKSA from $DBUser.tabel_118_periksa_penyakit where noklien='$noklien'";
					 //echo $sqlperiksa;
					 $DB2->parse($sqlperiksa);
					 $DB2->execute();
					 $arrperiksa=$DB2->nextrow();
					 $sqlperiksa2="select NOKLIEN,JNSPERIKSA,to_char(TGLPERIKSA,'dd/mm/yyyy') TGLPERIKSA,HASILPERIKSA,PINJAMHASIL,LPRPERIKSA,JNSALKOHOL,AKHRMNMALKOHOL,JMLROKOK,MULAIROKOK,NAMAPENYAKIT,to_char(BLNRAWAT,'dd/mm/yyyy') BLNRAWAT,LAMARAWAT,NAMAOBAT,RMHSKTRAWAT,ALASANPERIKSA from $DBUser.tabel_118_periksa_penyakit where noklien='$notert2'";
					 $DB3->parse($sqlperiksa2);
					 $DB3->execute();
					 $arrperiksa2=$DB3->nextrow();
					 
					 ?>
                      <tr>        <td>&nbsp; </td>
                        <td width="17">a.</td>
                        <td width="350">Jenis Pemeriksaan <br />
                          <b><? echo $arrperiksa["JNSPERIKSA"]?></b></td>
                        <td width="7">&nbsp;</td>
                        <td width="319">
                          <b><? echo $arrperiksa2["JNSPERIKSA"]?></b></td>
                        <td width="7">&nbsp;</td>
                        <td width="7">&nbsp;</td>
                        <td width="12">&nbsp;</td>
                      </tr>
                      <tr>        <td>&nbsp; </td>        <td>b.</td>        <td>Alasan dilakukan pemeriksaan ?<br />
                          <b><? echo $arrperiksa["ALASANPERIKSA"];?></b></td>        <td>&nbsp;</td>        <td>
                          <b><? echo $arrperiksa2["ALASANPERIKSA"];?></b></td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>
                      </tr>
                      <tr>        <td>&nbsp; </td>        <td>c.</td>        <td>Tanggal dilakukan pemeriksaan<br />
                          <b><? echo $arrperiksa["TGLPERIKSA"];?></b></td>        <td>&nbsp;</td>        <td>
                          <b><? echo $arrperiksa2["TGLPERIKSA"];?></b></td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>
                      </tr>
                      <tr>        <td>&nbsp; </td>        <td>d.</td>        <td>Bagaimana hasilnya ? <br />
                          <b><? echo $arrperiksa["HASILPERIKSA"];?></b></td>        <td>&nbsp;</td>        <td>
                          <b><? echo $arrperiksa2["HASILPERIKSA"];?></b></td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>
                      </tr>
                      <!-- end of point 3-->
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>Bila ada, mohon meminjamkan hasilnya.</td>         <td>&nbsp;</td>         <td>Ada dan dilampirkan pada SPAJ & SKK ini.</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>4.</td>
                        <td colspan="4">Apakah Anda pernah atau sedang menggunakan obat-obatan terlarang, narkoba dan bahan adiktif lainnya?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Utama</b>
                          <br>
                          <?php echo $ceknarkoba; ?></td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <?php echo $ceknarkoba2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>5.</td>
                        <td colspan="4">Apakah anda menyukai minuman yang mengandung alkohol ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Kalau &quot;Ya&quot;, jenis apa dan berapa banyak sehari?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["JNSALKOHOL"];?></b></td>         <td>&nbsp;</td>         <td>
                         <b> <? echo $arrperiksa2["JNSALKOHOL"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b. </td>         <td>Jika &quot;Tidak&quot; minum lagi sejak kapan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["AKHRMNMALKOHOL"];?></b></td>         <td>&nbsp;</td>         <td>
                         <b> <? echo $arrperiksa2["AKHRMNMALKOHOL"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>6. </td>
                        <td colspan="4">Apakah Anda Merokok?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Kalau &quot;Ya&quot; berapa batang sehari?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["JMLROKOK"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa2["JMLROKOK"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b. </td>         <td>Sejak kapan mulai merokok?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                         <b> <? echo $arrperiksa["MULAIROKOK"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa2["MULAIROKOK"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top">7.</td>
                        <td colspan="7">Apakah anda pernah memeriksakan pada dokter, dirawat dirumah sakit, sanatorium atau tempat istirahat lain karena sakit (pemulihan) atau saat ini sedang mendapat pengobatan dokter dan mendapatkan obat yang dikonsumsi secara teratur?</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Utama</b>
                          <br>
                          <?php echo $cekrawatinappulih; ?></td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <?php echo $cekrawatinappulih2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>
                        <td colspan="2">Jika anda menjawab &quot;Ya&quot; mohon diisi pertanyaan berikut :</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Nama penyakit </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["NAMAPENYAKIT"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa2["NAMAPENYAKIT"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b.</td>         <td>Kapan berobat atau dirawat (bulan dan tahun)</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["BLNRAWAT"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa2["BLNRAWAT"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>c.</td>         <td>Berapa lama dirawat</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["LAMARAWAT"]?></b></td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa2["LAMARAWAT"]?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>d.</td>         <td>Nama dan dosis obat</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["NAMAOBAT"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa2["NAMAOBAT"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>e.</td>         <td>Nama Rumah Sakit/Dokter</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa["RMHSKTRAWAT"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><? echo $arrperiksa2["RMHSKTRAWAT"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>8.</td>
                        <td colspan="2">Apakah Anda pernah mendapatkan luka berat atau dioperasi ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Utama</b>
                          <br>
                          <?php echo $ceklukaberat; ?></td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <?php echo $ceklukaberat2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>
                        <td colspan="2">Jika &quot;Ya&quot; sebutkan :</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <?php
					  if($notert2!=""){
						  $sqloperasi="select a.noklien,to_char(a.blnoperasi,'mm/yyyy') AS blnoperasi,a.namaoperasi,a.rmhsakitoperasi,a.tdksehat,
									   a.bekerjatdkbaik,b.noklien as notert2,to_char(b.blnoperasi,'mm/yyyy') as blnoperasi2,b.namaoperasi as namaoperasi2,
									   b.rmhsakitoperasi as rmhsakitoperasi2,b.tdksehat as tdksehat2,b.bekerjatdkbaik as bekerjatdkbaik2
									   from $DBUser.tabel_118_operasisht a,$DBUser.tabel_118_operasisht b where a.noklien = '$noklien' AND b.noklien = '$notert2'";

					  }else{
						  $sqloperasi="select a.noklien,to_char(a.blnoperasi,'mm/yyyy') blnoperasi,a.namaoperasi,a.rmhsakitoperasi,a.tdksehat,
									   a.bekerjatdkbaik  from $DBUser.tabel_118_operasisht a  where a.noklien = '$noklien'"; 
					  }
					  //echo $sqloperasi;
					  $DB5->parse($sqloperasi);
					  $DB5->execute();
					  $arroperasi=$DB5->nextrow();
					  ?>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Kapan dioperasi ? (Bulan dan tahun)</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["BLNOPERASI"];  ?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["BLNOPERASI2"];  ?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b.</td>         <td>Operasi apa?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["NAMAOPERASI"];  ?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["NAMAOPERASI2"];  ?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>c.</td>         <td>Nama Rumah Sakit/Dokter</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["RMHSAKITOPERASI"];  ?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["RMHSAKITOPERASI2"];  ?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>d.</td>         <td>Sekarang ini merasa sehat</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $ceksehat; ?></td>         <td>&nbsp;</td>         <td><?php echo $ceksehat2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika Tidak disebabkan karena apa?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["TDKSEHAT"];  ?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["TDKSEHAT2"];  ?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Apakah anda dapat melakukan pekerjaan dengan baik?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $cekkerjabaik; ?></td>         <td>&nbsp;</td>         <td><?php echo $cekkerjabaik2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>iii. Jika &quot;tidak&quot; sebutkan alasannya</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["BEKERJATDKBAIK"];  ?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arroperasi["BEKERJATDKBAIK2"];  ?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         
                      <td>9.</td>
                        <td colspan="7">Apakah anda memiliki hobi </td>
                      </tr>
                      <tr>
                      <td></td>
                      <td colspan="3" valign="top">
                      <table class="verdana8">
                            <tr><td>Tertanggung Utama</td></tr>
                        <?php 
						$sqlhobbi="select noklien,a.kdhobby,namahobby from ".
						"$DBUser.tabel_114_hobby a,$DBUser.tabel_100_hobby_klien b ".
						"where a.kdhobby=b.kdhobby and b.noklien='$noklien' ";
						$DB->parse($sqlhobbi);
						$DB->execute();
						while($arrhobby=$DB->nextrow()){
						?>
                        <tr> <td>- <?php echo $arrhobby["NAMAHOBBY"]; ?></td></tr>
                        <?php
						}
						?>
                      </table>
                      <td colspan="4" valign="top"> 
                      <table class="verdana8">
                            <tr><td>Tertanggung Tambahan</td></tr>
                             <?php 
						$sqlhobbi2="select noklien,a.kdhobby,namahobby from ".
						"$DBUser.tabel_114_hobby a,$DBUser.tabel_100_hobby_klien b ".
						"where a.kdhobby=b.kdhobby and b.noklien='$notert2' ";
						$DB->parse($sqlhobbi2);
						$DB->execute();
						while($arrhobby2=$DB->nextrow()){
						?>
                        <tr> <td>- <?php echo $arrhobby2["NAMAHOBBY"]; ?></td></tr>
                        <?php
						}
						?>
                      </table>
                      </td>
                      </tr>
                      
                      <?php 
						/*$sqlhobbi="select noklien,a.kdhobby,namahobby from ".
						"$DBUser.tabel_114_hobby a,$DBUser.tabel_100_hobby_klien b ".
						"where a.kdhobby=b.kdhobby and b.noklien='0010780114' ";
						$DB->parse($sqlhobbi);
						$DB->execute();
						while($arrhobby=$DB->nextrow()){
						?>
                        <tr> <td>&nbsp;</td><td><?php echo $arrhobby["NAMAHOBBY"]; ?></td></tr>
                        <?php
						}*/
						?>
                      <!--<tr>         <td>&nbsp;</td>
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
                                <input name="cekHobbi" type="checkbox" id="cekHobbi" value="NYL">
                                <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="NYL">
a.</td>
                              <td width="190">Menyelam</td>
                              <td width="64"><input name="cekHobbi" type="checkbox" id="cekHobbi" value="PJT">
                                <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="PJT">
f.</td>
                              <td width="169"> Panjat tebing</td>
                              <td width="66"><input name="cekHobbi" type="checkbox" id="cekHobbi" value="PTB">
                                <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="PTB">
k.</td>
                              <td width="163">Pertambangan</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="ORA">
                                <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="ORA">
b.</td>        <td> Olahraga air selain menyelam</td>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="MCR">
  <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="BCR">
g.</td>        <td>Microlighting</td>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="ABS">
  <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="ABS">
l.</td>        <td>Angkatan bersenjata</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="CAP">
                                <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="CAP">
c.</td>        <td> Caving dan Potholing</td>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="BMB">
  <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="BMB">
h.</td>        <td>Balap motor/mobil</td>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="NLY">
  <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="NLY">
m.</td>        <td>Nelayan</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="PAY">
                                <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="PAY">
d.</td>        <td> Terjun payung</td>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="PNB">
  <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="PNB">
i.</td>        <td>Penerbangan</td>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="KEL">
  <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="KEL">
n.</td>        <td>Kelautan</td>
                            </tr>
                            <tr>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="PRL">
                              <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="PRL">
e.</td>        <td> Paralayang</td>        <td><input name="cekHobbi" type="checkbox" id="cekHobbi" value="MGB">
  <input name="cekHobbi2" type="checkbox" id="cekHobbi2" value="MGB">
j.</td>        <td>Minyak dan gas bumi</td>        <td><input type="checkbox" name="cekHobbi" id="cekHobbi">
  <input type="checkbox" name="cekHobbi2" id="cekHobbi2">
o.</td>        <td>Lain-lain</td>
                            </tr>
                          </table></td>
                      </tr>-->
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>10.</td>
                        <td colspan="2">Khusus untuk tertanggung perempuan :</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>
                        <td colspan="3">Apakah anda pernah melakukan pap smear dengan hasil abnormal?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <?php
                      if($notert2!=""){
					      $sqlwanita="select a.noklien,a.periksapapsmear,a.hasilpapsmear,a.bulanhamil,a.jmllahir,a.berapakeguguran,
							           a.hamilkeberapa,a.caesar,a.doktercaesar,a.kondisikomplihamil,a.dokterkomplihamil,a.rawatkomplihamil,
							           b.noklien as noklien2,b.periksapapsmear as periksapapsmear2,b.hasilpapsmear as hasilpapsmear2,
							           b.bulanhamil as bulanhamil2,b.jmllahir as jmllahir2,b.berapakeguguran as berapakeguguran2,
							           b.hamilkeberapa as hamilkeberapa2,b.caesar as caesar2,b.doktercaesar as doktercaesar2,
							           b.kondisikomplihamil as kondisikomplihamil2,b.dokterkomplihamil as dokterkomplihamil2,
							           b.rawatkomplihamil as rawatkomplihamil2 from $DBUser.tabel_118_klien_wanita a,$DBUser.tabel_118_klien_wanita b 
							           where a.noklien='$noklien' and b.noklien='$notert2'";
					  }else{
						  $sqlwanita="select a.noklien,a.periksapapsmear,a.hasilpapsmear,a.bulanhamil,a.jmllahir,a.berapakeguguran,
							          a.hamilkeberapa,a.caesar,a.doktercaesar,a.kondisikomplihamil,a.dokterkomplihamil,a.rawatkomplihamil 
							          from $DBUser.tabel_118_klien_wanita a where a.noklien='$noklien'";
					  }
					  //echo $sqlwanita;
					  $DB6->parse($sqlwanita);
					  $DB6->execute();
					  
					  $arrwanita=$DB6->nextrow();
					  ?>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Utama</b>
                          <br>
                          <?php echo $cekpapsmear; ?></td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <?php echo $cekpapsmear2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot;. kapan pemeriksaan terakhir?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["PERIKSAPAPSMEAR"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["PERIKSAPAPSMEAR2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Bagaimana hasilnya?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["HASILPAPSMEAR"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["HASILPAPSMEAR2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b.</td>         <td>Apakah haid (menstruasi) anda teratur dan tidak terganggu?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>`</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $cekhaid; ?></td>         <td>&nbsp;</td>         <td><?php echo $cekhaid2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>c.</td>         <td>Apakah saat ini anda sedang hamil ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $cekhamil; ?></td>         <td>&nbsp;</td>         <td><?php echo $cekhamil2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td>Jika &quot;Ya&quot;. sudah berapa bulan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["BULANHAMIL"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["BULANHAMIL2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>d.</td>         <td>Apakah anda pernah melahirkan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="22">&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $cekmelahirkan; ?></td>         <td>&nbsp;</td>         <td><?php echo $cekmelahirkan1; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>Jika &quot;Ya&quot;. sudah berapa kali?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["JMLLAHIR"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["JMLLAHIR2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>e.</td>         <td>Apakah anda pernah keguguran</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $cekkeguguran; 						
echo  $ketcekkeguguran;
  ?>                         </td>         <td>&nbsp;</td>         <td><?php echo $cekkeguguran2; 
						echo  $ketcekkeguguran2; ?>                          </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot;. sudah berapa kali?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["BERAPAKEGUGURAN"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["BERAPAKEGUGURAN2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Pada kehamilan yang keberapa?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["HAMILKEBERAPA"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["HAMILKEBERAPA2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>f.</td>
                        <td colspan="3">Apakah anda pernah melahirkan dengan cara operasi (sectio caesarea) ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $cekcaesar; ?></td>         <td>&nbsp;</td>         <td><?php echo $cekcaesar1; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot;. kapan dan jelaskan penyebabnya?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["CAESAR"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["CAESAR2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Nama dan alamat dokter/Rumah Sakit yang merawat.</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="23">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["DOKTERCAESAR"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["DOKTERCAESAR2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>g.</td>
                        <td colspan="3">Apakah Anda pernah mengalami kesulitan/komplikasi pada saat hamil ataupun melahirkan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td><?php echo $cekkomplikasihamil; ?></td>         <td>&nbsp;</td>         <td><?php echo $cekkomplikasihamil2; ?></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>i. Jika &quot;Ya&quot; kapan dan bagaimana kondisi saat itu ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["KONDISIKOMPLIHAMIL"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["KONDISIKOMPLIHAMIL2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>ii. Nama dan alamat lengkap Dokter yang merawat ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["DOKTERKOMPLIHAMIL"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["DOKTERKOMPLIHAMIL2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>iii. Jenis Perawatan yang diberikan ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14">&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["RAWATKOMPLIHAMIL"];?></b></td>         <td>&nbsp;</td>         <td>
                          <b><?php echo $arrwanita["RAWATKOMPLIHAMIL2"];?></b></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
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
              <a href="#" onClick="window.history.go(-1)">Back</a></td>
            <td align="right">
              <input type="hidden" name="noklien" value=<? echo $arr["NOKLIEN"]; ?>>
              <input type="hidden" name="notert2" value=<? echo $notert2; ?>>
              <input type="hidden" name="proposalno" value=<? echo $noproposal; ?>>
              <input type="hidden" name="tglmutasi" value=<?=$tglmutasi;?>>
              <input type="hidden" name="jnscari" value=<?=$jnscari;?>>
             <!-- <input type="submit" name="cetak" value="Cetak">-->
              		<a href="#" onClick="window.open('skk_newjslink.php?noklien=<?=$noklien;?>&action=cetak','','width=800,height=600,top=100,left=100,scrollbars=yes');">Cetak</a></td>
          </tr>
        </table>
      </form>
  </body>
</html>
<? //} ?>