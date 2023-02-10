<?
  include "./includes/database.php"; 
  include "./includes/session.php"; 
  include "./includes/common.php";
  include "./includes/pertanggungan.php";	
  include "./includes/duit.php";
  //include "./includes/koneksi.php";
  
  $DA = new database($userid, $passwd, $DBName);
  $DB = new database($userid, $passwd, $DBName);
  $DC = new database($userid, $passwd, $DBName);
  $DU = new database($userid, $passwd, $DBName);
  $DX = new database($userid, $passwd, $DBName);
  $DXX = new database($userid, $passwd, $DBName);
  $DSMS = new database($userid, $passwd, $DBName);
  //echo $jnsusr.$modul;


/*--------------------------------------------------
Author : Iie Sumitra
Date   : 19 Jul 2013
Desc   : tambahan untuk cek jumlah dokumen ke SAE 
*/
define("HOSIE","MTkyLjE2OC4yLjY=");
define("USRIE", "cm9vdA==");
define("PWDIE","YWRtMW5kYXRhYmFzZXNtNFJU"); 
define("DBNIE","aml3YXNyYXlhX2RvY21hbmFnZXJkYg==");

/*
$connSae = mysql_connect(base64_decode(HOSIE), base64_decode(USRIE), base64_decode(PWDIE));
if (!$connSae) die ("Gagal Melakukan Koneksi ke SAE");
mysql_select_db(base64_decode(DBNIE),$connSae) or die ("Database Tidak Diketemukan di Server SAE");
*/


if(isset($_POST['rijek']))
{
	$cheklist = $_POST['cheklist'];
	//echo "<font face=\"Verdana\">Daftar kirim email yang sukses : </font><br><font face=\"Verdana\" size=1 color=blue><b>";
	$x=1;
	for($i=0; $i<sizeof($cheklist); $i++)
	{
		$NoPolis = $cheklist[$i];
		$sqlUpd = "UPDATE $DBUser.TABEL_200_pertanggungan set kdstatusemail=null
				   where prefixpertanggungan='".substr(".$NoPolis.",1,2)."' and nopertanggungan='".substr(".$NoPolis.",3,9)."'";
		$DB->parse($sqlUpd);
		$DB->execute();
		//echo $sqlUpd;
		//echo 'reject';
		//echo $x.". ".$NoPolis."<br>";
		$x++;
	}
	echo "</b></font><hr><br><br>";

}


		
if(isset($_POST['sendemail'])){
	
	$sqlxx="SELECT   *
  			FROM   $DBUser.TABEL_UL_UPLOAD_AKSEP a
 			WHERE   NOT EXISTS
            (SELECT   'x'
             FROM   $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN
             WHERE   prefixpertanggungan = SUBSTR (a.nomor_polis, 1, 2)
             AND nopertanggungan = SUBSTR (a.nomor_polis, 3, 9))";
	//echo $sqlxx;
	$DX->parse($sqlxx);
	$DX->execute();

	while($arrxx=$DX->nextrow()){
	$sqlUpdx = "INSERT INTO $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN (PREFIXPERTANGGUNGAN,
                                          NOPERTANGGUNGAN,
                                          KDACCEPTANCE,
                                          TGLACCEPTANCE,
                                          USERUPDATED)
				  VALUES   (substr('".$arrxx["NOMOR_POLIS"]."',1,2),
							substr('".$arrxx["NOMOR_POLIS"]."',3,9),
							1,
							sysdate,
							'$userid')";
	
	echo $sqlUpdx.'</br>';
	$DXX->parse($sqlUpdx);
	$DXX->execute();	
	}
	
	//$sqa="delete from $DBUser.TABEL_UL_UPLOAD_AKSEP";
	//$DB->parse($sqa);
    //$DB->execute();
	//echo $sqa;			  
//if($_POST['sbmt'] == '1')
{
	$cheklist = $_POST['cheklist'];
	//echo "<font face=\"Verdana\">Daftar kirim email yang sukses : </font><br><font face=\"Verdana\" size=1 color=blue><b>";
	$x=1;
	for($i=0; $i<sizeof($cheklist); $i++)
	{
		echo $cheklist[$i];
		$NoPolis = $cheklist[$i];
		
		$sqlUpd = "INSERT INTO $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN (PREFIXPERTANGGUNGAN,
                                          NOPERTANGGUNGAN,
                                          KDACCEPTANCE,
                                          TGLACCEPTANCE,
                                          USERUPDATED)
				  VALUES   ('".substr(".$NoPolis.",1,2)."',
							'".substr(".$NoPolis.",3,9)."',
							1,
							sysdate,
							'$userid')";
							//echo $sqlUpd;
		$DB->parse($sqlUpd);
		$DB->execute();
		
		//================SMS SENDING================
		$sms="SELECT   A.PREFIXPERTANGGUNGAN || A.NOPERTANGGUNGAN NOPOLIS,A.PREFIXPERTANGGUNGAN,
				 NOACCOUNT,
				 (SELECT   SUM (NILAIRP)
					FROM   $DBUser.TABEL_300_HISTORIS_PREMI
				   WHERE       prefixpertanggungan = b.prefixpertanggungan
						   AND nopertanggungan = b.nopertanggungan
						   AND KDKUITANSI = 'BP3')
				 + (SELECT   SUM (NILAI)
					  FROM   $DBUser.TABEL_300_TAGIHAN_PERTAMA
					 WHERE       prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND JENIS = 'B')
					PREMI,
				 (SELECT   TO_CHAR (EXPIREDDATE, 'DD/MM/YYYY') EXPDATE
					FROM   $DBUser.TABEL_300_TAGIHAN_PERTAMA
				   WHERE       prefixpertanggungan = b.prefixpertanggungan
						   AND nopertanggungan = b.nopertanggungan
						   AND JENIS = 'B')
					EXPDATE,
				 REGEXP_REPLACE((SELECT    NVL(NO_PONSEL, PHONETETAP02)
					FROM   $DBUser.TABEL_100_KLIEN
				   WHERE   NOKLIEN = NOPEMEGANGPOLIS),'[^0-9]+', '')
					PHONE,
				 (SELECT   NAMAKLIEN1
					FROM   $DBUser.TABEL_100_KLIEN
				   WHERE   NOKLIEN = NOPEMEGANGPOLIS)
					NAMA,c.kdproduk,nosp,
					(select alamat01 || ' ' || alamat02 from $DBUser.tabel_001_kantor where kdkantor =c.prefixpertanggungan) alamatkantor,
					(select phone01 from $DBUser.tabel_001_kantor where kdkantor =c.prefixpertanggungan) tlpkantor
					(select namakantor from $DBUser.tabel_001_kantor where kdkantor =c.prefixpertanggungan) namakantor
		  FROM   $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN a,
				 $DBUser.TABEL_100_KLIEN_ACCOUNT b,
				 $DBUser.TABEL_200_PERTANGGUNGAN c
		 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
				 AND a.nopertanggungan = b.nopertanggungan
				 AND a.prefixpertanggungan = c.prefixpertanggungan
				 AND a.nopertanggungan = c.nopertanggungan
				 AND a.prefixpertanggungan = '".substr(".$NoPolis.",1,2)."'
				 AND a.nopertanggungan = '".substr(".$NoPolis.",3,9)."'
				 AND b.kdbank = 'BNI'";
		//echo $sms;
		$DSMS->parse($sms);
		$DSMS->execute();
		$arsms=$DSMS->nextrow();
		if($arsms["KDPRODUK"]=="JL4BA"){ //Untuk produk kerjasama dengan AAP (JS-Promapan) Nomor HP diganti dengan nomor PT. AAP.
		//$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", selamat bergabung dgn IFGLIFE. Polis ".$arsms["NOPOLIS"].
		//	 " akan kami sampaikan melalui agen penutup max 10 hari kerja. Utk info hub 021-1500151";			 
		$msg="Terima kasih, Polis PT Asuransi Jiwa IFG ".$arsms["NOSP"]." sudah siap dan dapat diambil dengan menukarkan Form SPAJ di 
		".$arsms["NAMAKANTORCABANG"]." ".$arsms["ALAMATKANTOR"]." ".$arsms["TLPKANTOR"].".";			 
		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('081212524247','".$msg."')";
		}else{
		$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", selamat bergabung dgn PT Asuransi Jiwa IFG. Polis ".$arsms["NOPOLIS"].
			 " akan kami sampaikan melalui agen penutup max 10 hari kerja. Utk info hub 021-1500151";			 	
			 
		//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arsms["PHONE"]."','".$msg."')";
		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONE"]."','".$msg."','NOTIFIKASI SELAMAT BERGABUNG PEMPOL BARU','".$arsms["PREFIXPERTANGGUNGAN"]."','UNDERWRITING','".$arsms["NOPOLIS"]."')";
		}
		 //echo $mysqlins;
			mysql_query($mysqlins);
		//================SMS SENDING================
		
		//echo $DB->error;
		//echo $sqlUpd;
		//$conn = ocilogon($userid, $passwd, "JSDB");
  //$query="DELETE FROM $DBUser.SLIP_DUMMY where kdbatch='$batchs' and kdkantor='$kantor'";
  //$sql= ociparse($conn, $sqlUpd);
  //ociexecute($sql);
		//echo 'aksep';
		//echo $x.". ".$NoPolis."<br>";
		$x++;
	}
	echo "</b></font><hr><br><br>";

}
}
/*------------------------------------end Of Iie Sumitra:19Jul2013--------------*/



?>
<link href="./jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js" ></script>
<script language="JavaScript"> 
function Cekbok(doc){ 
 if (doc == true)
 {
 checkedAll('xxx', true);
 }
 else
 {
 checkedAll('xxx', false);
 }
} 
</script>
 <script>
      function checkedAll (id, checked) {
	var el = document.getElementById(id);

	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }
</script>
<? include "./includes/hide.php";  ?>
<font face="Verdana" size="2"><b>DAFTAR AKSEPTASI POLIS</b><br>
Kantor : <?echo $kantor; ?>
<?
if($apply)
{	$sql="delete FROM $DBUser.tabel_315_upld_autodebet a where to_char(tglproses,'dd/mm/yyyy')='$tglcari' and kdbank='$kdbank'";
     //echo $sql;
	 $DB->parse($sql);
     $DB->execute();
	 
    require "../../includes/fileupload.class.php";
    if ($ffilename!="none"){
				    $k = $i-1;
            $mode = 1; //   1 = overwrite mode; 2 = create new with incremental extention; 3 = do nothing if exists
            $my_uploader = new uploader;
    				$my_uploader->max_filesize(600000000);
    				$my_uploader->max_image_size(3000000, 3000000);
			$my_uploader->upload("ffilename", "", ".txt");
					
    				$my_uploader->save_file("../../file/files/", $mode);
    				if ($my_uploader->error) {
						 echo  $errmeg .= "Upload file gagal! ".$my_uploader->error . "<br>";
        		} else {
          			$file_name = $my_uploader->file['name'];
          			print('</br>'.$file_name . " berhasil di-upload!<br>");
								$updatefile = ",NAMA_FILE='$file_name'";
								
        		//=============upload=============
				//echo $_FILES[ffilename][name];
				  $fcontents = file ("../../file/files/".$_FILES[ffilename][name]); 
				  # expects the csv file to be in the same dir as this script
				  $sqa="delete from $DBUser.TABEL_UL_UPLOAD_AKSEP";
				  //echo $sqa;
				  $DB->parse($sqa);
      			  $DB->execute();
				  //$ar=$DB->nextrow();	
				  
				  for($i=0; $i<sizeof($fcontents); $i++) { 
					  $line = trim($fcontents[$i]); 
					  $arr = explode(",", $line); 
					  //echo str_replace("","xx",implode("','", str_replace("'","`",$arr)));
					  //$arr = explode("\t", $line); 
					  //$arr = explode(";", $line); 
					  #if your data is comma separated
					  # instead of tab separated, 
					  # change the '\t' above to ',' 
					  //echo "'x".implode("','", str_replace("'","`",$arr)) ."x'</br>";
					  if (("'x".implode("','", str_replace("'","`",$arr)) ."x'")=="'xx'") {$sql="";} else {
					  	 $sql = "insert into $DBUser.TABEL_UL_UPLOAD_AKSEP (nomor_polis) values ('". 
								  implode(" ", str_replace(",",".",str_replace("'","`",$arr))) ."')";}
					  //mysql_query($sql);
					  //echo $sql ."<br>";
					  //echo implode(" ", str_replace("'","`",str_replace(",",".",$arr)))."</ br>";

					   $DB->parse($sql);
      			  	   $DB->execute();
					   $qupload++;
					  //if(mysql_error()) {
					  //   echo mysql_error() ."<br>\n";
					  //} 
				}
				//=============upload=============
				}
				//echo ($qupload+1).'record(s) inserted...';
    }
		else
		{ 
					  $updatefile = "";
		}
		
}
?>
<!--
<li><b>Perhatikan Syarat agar portofolio bisa dikirim emailnya antara lain:<br></b>
Penagih TIDAK KOSONG, untuk Polis Non Medical, sudah dilunasi, untuk Polis Medical, Data Keterangan Kesehatan Sudah Lengkap -->

<!--
<font color="red"><b>Catatan :</b></font><br>
Bentuk pengiriman data proposal yang dilakukan dengan benar, minimal pada tanggal 5 setiap 
bulan, <b>Kolom Transaksi Produk</b> untuk <b>Poposal Medical</b> dan <b>Non Medical</b> 
pada </a><a class="verdana8blu" href="showendbillingkantor.php">halaman Produksi Bulanan</a> 
<a class="verdana8blu">harus kosong.
</a> -->
<br><br>
<form name="xxx" method="POST" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>">

Unggah File&nbsp;<input type="file" name="ffilename" size="70" value=""></ br></ br>
<input type="submit" name="apply" value="SUBMIT" class="but">
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">

  <tr>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.
      POLIS</b></font></td>
    <td bgcolor="#C2CAED" colspan="4" align="center">
      <p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>JML UANG ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MAC ASS</b></font></td>
    <td bgcolor="#C2CAED" colspan="6" align="center"><p align="center"><font face="Verdana" size="1"><b>FUND</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MULAI ASS</b></font></td>
    <!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>-->
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MASA ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MED</b></font></td>
	
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CARA BAYAR</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>PREMI BKL<br>(Rp)</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOP UP BKL<br>(Rp)</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOTAL PREMI<br>(Rp)</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOP UP SKG.<br>(Rp)</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA CI</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA TERM</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA TPD</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA WPCI</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA WPTPD</b></font></td>	
	
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TGL KONF.</b></font></td>
		<!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>DOK.SAE</b></font></td> -->
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CHECK <input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></b></font></td>
   </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
    
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>FF</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>EF</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>BF</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>MM</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>G75</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>G85</b></font></td>
  </tr>
	<?
  //------------------------------------------------------ Non Medical ------------------
/*
AND (select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran h ".
    						 "where  a.prefixpertanggungan = h.prefixpertanggungan ".
    						 "AND a.nopertanggungan = h.nopertanggungan ".
								 "and h.kdpembayaran in ('001','002','005') ) >= 0
*/
if($kantor=='KN'){
$wherebancas= " and a.prefixpertanggungan='KN' ";} else {$wherebancas="";};

	$sql= "select ".
    				"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk,".
    	      "a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,usia_th,".
    				"a.lamaasuransi_th,a.premi1,".
						"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    				"NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    				 "where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    				 "a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    				 "having sum(nilaipembayaran) > 0),0) nilaipembayaran, ".
					 "(SELECT   COUNT(*) 
              FROM   $DBUser.tabel_300_historis_premi
             WHERE       prefixpertanggungan = a.prefixpertanggungan
                     AND nopertanggungan = a.nopertanggungan
                     AND kdkuitansi IN ('BP3') AND TGLSEATLED IS NOT NULL) bayarbp3,".
					  "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPU') topupbkl, ".
					 "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='CI') ci, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='TI') ti, ".
					 "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='PBD') PBD, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='SPBD') spd, to_char(tglsendemail,'DD/MM/YYYY HH:MM') tglemail,".
					 "(SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'FF')
					  FF,
				   (SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'BF')
					  BF,
					(SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'EF')
					  EF,
					 (SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'MM')
					  MM,
					  NVL (
					(SELECT porsi
					   FROM $DBUser.TABEL_UL_OPSI_FUND
					  WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IG'),
					0)
					IG,
				   NVL (
					(SELECT porsi
					   FROM $DBUser.TABEL_UL_OPSI_FUND
					  WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IH'),
					0)
					IH,".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					 "decode(nopemegangpolis,notertanggung,usia_th,round(months_between (mulas,(select tgllahir from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis))/12)) usiapp, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt,
					  (SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					   nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUP') topupbkl, 
					  (SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					   nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, 
					  (SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					   nopertanggungan=a.nopertanggungan and substr(kdbenefit,1,2)='CI') ci, 
					  (SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					   nopertanggungan=a.nopertanggungan and kdbenefit='TI') ti, 
					 (SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					   nopertanggungan=a.nopertanggungan and kdbenefit='WPCI51') WPCI, 
					 (SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					   nopertanggungan=a.nopertanggungan and kdbenefit='TPD') TPD,
					 (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar = a.KDCARABAYAR) cara_bayar ".
				"from ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"where ".
    				"a.kdstatusemail='1' ".
					"AND substr(a.kdproduk,1,3) in ('JL4') ".
    				"AND a.nopenagih is not null ".
    				"AND a.premi1 != '0' ".
    				//"AND a.prefixpertanggungan = '$kantor' ".
    				"AND a.kdstatusmedical in ('M','N') ".
    				"AND a.kdpertanggungan = '1' ".
    				"AND a.kdstatusfile = '1' ".
					$wherebancas.
					" and not exists (select 'x' from $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ".
				 "AND EXISTS
                 (SELECT   'x'
                    FROM   $DBUser.TABEL_300_HISTORIS_PREMI 
                   WHERE   prefixpertanggungan = a.prefixpertanggungan
                           AND nopertanggungan = a.nopertanggungan
                           and kdkuitansi='BP3' and tglseatled is not null) ".
    				"ORDER BY a.prefixpertanggungan, a.nopertanggungan ";
				 //" and exists (select 'x' ".
	   		 	 //"from $DBUser.tabel_800_pembayaran ".
	  		 	 //"where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
	  			 //"and  kdpembayaran in ('002','005','001')) ".
    			//	"ORDER BY a.prefixpertanggungan, a.nopertanggungan ";
		//echo $sql;		
	$DB->parse($sql);
	$DB->execute();

	while($arr=$DB->nextrow()){
	   $i = 0;
		 $i = $count + 1;
  
	switch ($arr["KDSTATUSMEDICAL"]) {
	   case 'N' :  $statusmedical = "<font color=blue><b>N</b></font>"; break;
	}
	$premi = $arr["PREMI1"];
	$biayapolis = $arr["BIAYAPOLIS"];
	$biayamaterai = $arr["BIAYAMATERAI"];
	$jumlahbayar = $premi + $biayapolis + $biayamaterai;
	$nopertn = $arr["NOPERTANGGUNGAN"];
	
	#----------------------------[ START CEK PELUNASAN PREMI ]----------------------------
	
	 $PERT = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	 $DU   = New Duit ($userid,$passwd);
	 $TR   = New Transaksi ($userid,$passwd);
	/* $sqlx = "select sum(nilaipembayaran) totalbayar,sum(premi) premisb,".
	 			   "sum(biayamaterai) sumbm,sum(biayapolis) sumbp ".
	   		 	 "from $DBUser.tabel_800_pembayaran ".
	  		 	 "where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' ".
	  			 "and  kdpembayaran in ('002','005','001')";*/
	 $sqlx = "select decode(tglseatled,null,0,1) totalbayar ".
	   		 	 "from $DBUser.tabel_300_historis_premi ".
	  		 	 "where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' ".
	  			 "and  kdkuitansi in ('BP3')";
	 //echo $sqlx;
	 //$DC->parse($sqlx);
	 //$DC->execute();
	 //$arx=$DC->nextrow();
	
	#----------------------------[ START CEK UPLOAD ]----------------------------
	 $sqlx = "select * ".
	   		 	 "from $DBUser.TABEL_UL_UPLOAD_AKSEP ".
	  		 	 "where nomor_polis='".$arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"]."'";
	 //echo $sqlx;
	 $DA->parse($sqlx);
	 $DA->execute();
	 $aru=$DA->nextrow();
	#*******************************premi**********************************
	
	$suspend=$arx["TOTALBAYAR"];
	$sumbm=$arx["SUMBM"];
	$sumbp=$arx["SUMBP"];
	$premisb=$arx["PREMISB"];
	$premi = $PERT->premi1-$premisb; //kekurangan premi
	
	$tglbp3 = ($PERT->tglbp3=='') ? $PERT->sysdate : $PERT->tglbp3;
	$kursbayar = $TR->Kurs($PERT->valuta,$tglbp3);
	$nilairp = ($PERT->valuta=='0') ? $PERT->premi1  : $PERT->premi1 * $TR->Kurs($PERT->valuta,$tglbp3);
//	echo "Ari ".$nilairp." - ".$PERT->premi1." - ".$TR->Kurs($PERT->valuta,$tglbp3);
	
	$biayapolis = $DU->BeaPolis($PERT->produk,$PERT->sysdate);
	
	$materai= $DU->MatreAktaPolis() + $DU->Matre($nilairp);
		  
	//$total = $nilairp + $biayapolis + $materai;
	$total = $nilairp;
	$grandtotal = $total - $suspend;
	
	$juarp = ($PERT->valuta=='0') ? $PERT->jua  : $PERT->jua * $TR->Kurs($PERT->valuta,$tglbp3);
	
	#----------------------------[ END CEK PELUNASAN PREMI ]----------------------------
	
	 ?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('./polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPP"];?><?// echo $arr["PMGPOL"]; ?></font></td>
     <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["USIAPP"]; ?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATT"];?></font></td>
     <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["USIA_TH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["FF"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["EF"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["BF"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MM"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["IG"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["IH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <!--<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["USIA_TH"]; ?></font></td>-->
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; $grandtotal;?></font></td>
	
    <!--td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["PREMI1"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TOPUPBKL"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TOPUP"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["CI"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TI"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["PBD"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["SPD"],2); ?></font></td-->
	
	<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["CARA_BAYAR"]; ?></font></td>
	<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["PREMI1"]-$arr["TOPUPBKL"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TOPUPBKL"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["PREMI1"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TOPUP"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["CI"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TI"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TPD"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["WPCI"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["WPTPD"],0,',','.'); ?></font></td>
	
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLEMAIL"]; ?></font></td>
    <!-- <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"> --> <? 
	
    $numrowsDocSae = 0;

/*ga jadi karena berat loading nya : 23 jul 2013/ iie*/
	/*
	  $query = "select DISTINCT a.type_id from t_dokumen a where a.type_id in ('SPAJ','PROPOSAL SPAJ','BP3','BUKTI TRANSFER') AND  a.no_polis = '".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."'";
	$result = mysql_query($query);
	$numrowsDocSae = mysql_num_rows($result);
	 
	 echo $numrowsDocSae;
	 
	 */
	 ?><!--</font></td> -->
		<? 
			
				$cebox = "<input type=\"checkbox\" id=\"cek\" name=\"cheklist[]\" value=".$arr['PREFIXPERTANGGUNGAN'].$arr['NOPERTANGGUNGAN'].">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]; 
			
			 // jika ada kekurangan premi
			 /*if(round($arr["NILAIPEMBAYARAN"],2)>=round($total,2)){
			 	  $catatan = $cebox;
			 } else {
			    $catatan = "<font color=red>BP3 KURANG </font>";
			 }*/
			 
			 //if(round($arr["NILAIPEMBAYARAN"]*1,2) < round($total*1,2)){				
				 
			 if(round($arr["BAYARBP3"]) < 1){
			 	$catatanx = "<font color=red>BP3 KURANG/BLM BAYAR </font>";  
				//echo 'kampret';
			 } 
			 else if(($aru["NOMOR_POLIS"])<>''){
			 	$catatanx = "<font color=red>Ready to Accept </font>";  
				//echo $aru["NOMOR_POLIS"];
				
			 }
			 else {
			    $catatanx = $cebox;
				
				//echo 'kampret ok';
			 }
			 
			 if($arr["TOPUPBKL"]==0 && substr($arr["KDPRODUK"], 0, 4)<>'JL4X'){
				$catatanx = "<font color=red>TOPUP BERKALA TIDAK BOLEH 0</font>";  
			 }
			 
			 if($arr["CARA_BAYAR"]=='BULANAN'){
				if($arr["PREMI1"] < 350000){
					$catatanx = "<font color=red>TOTAL PREMI TIDAK BOLEH KURANG DARI 350.000</font>";  	
				}									
			 }elseif($arr["CARA_BAYAR"]=='TAHUNAN'){
				if($arr["PREMI1"] < 4200000){
					$catatanx = "<font color=red>TOTAL PREMI TIDAK BOLEH KURANG DARI 4.200.000</font>";  	
				}
			 }
			 //echo $nilairp;
			 // echo $PERT->premi1; 
			 //echo $TR->Kurs($PERT->valuta,$tglbp3);
			 //echo $PERT->valuta;
			 //echo $tglbp3;
			 
			 
			 // jika jua kurang dari jua minimal produk
			 // permintaan sesuai kerjasama
		   
			 if($modul=="ALL"||$modul=='ITC'){
			      $catatan = $cebox;
       } else {
    			 if($arr["JUAMINIMAL"]!=""){
      			 if($juarp>=$arr["JUAMINIMAL"]){
      			    $catatan = $cebox;
      			 } else {
      			    $catatan = "<font color=red>* JUA < Rp.".number_format($arr["JUAMINIMAL"],0).".-</font>";
      			 }
    			 }
			 }
			 
			 
		?>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $catatanx; ?></font></td>
</tr>
	<? 
	$count++;
	} 
	
?>
</table>

<table border="0" width="100%" cellspacing="1" cellpadding="2">
  <tr>
	  <td class="verdana10blk"></td>
    <td align="right">
		<input type="hidden" value="<? echo $statusmedical; ?>" name="cek"> 
		<? 
		 if ($nopertm == "") {
		 } else {
		 ?>
		<input type="hidden" value="M" name="medical"> 
		<? 
		 } 
		 if ($nopertn == "") {
		 } else {
		 ?>
		<input type="hidden" value="N" name="nonmedical">
		<? } ?>
		<input type="hidden" value="1" name="sbmt">
	    <input type="submit" value="Akseptasi" name="sendemail">
		<input type="submit" value="Reject" name="rijek">
        <!--
		<font face="Verdana" size="1" color="red">
		<b>Proses kirim email ke HO untuk proposal Medical dan proses underwriting untuk proposal Non medical 
	  </b>
		</font>
		<input type="submit" value="Proses" name="sendemail">
		-->
		</td>
	</tr>
	</form>
</table>

<script language="javascript">
function checkifempty(){
if (document.xxx.cek.value=='')
document.xxx.sendemail.disabled=true
else
document.xxx.sendemail.disabled=false
}
if (document.all)
setInterval("checkifempty()",100)
</script>
<hr size="1">
<table>
<? 

//mysql_close($connSae);
//}
 ?>
<tr>
<td><font face="verdana" size="2"><a href="../../submenu.php?mnuinduk=150">Back</a></font></td>
<td><!--<font face="verdana" size="2"><a href="emailterkirim.php">&nbsp;&nbsp;&nbsp;&nbsp;Check Pengiriman Email</a>--></font></td>
</tr>
</table>

