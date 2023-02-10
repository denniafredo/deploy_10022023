<?
    include "../../includes/session.php";
    include "../../includes/database.php";
  $DB = new Database($userid,$passwd,$DBName);
if (isset($_POST[submit])) {
	$query="select $DBUser.no_agen.nextval as maxnoklien from dual";
	$DB->parse($query);
	$DB->execute();
	$arr = $DB->nextrow();
	$maxnoklien = $arr["MAXNOKLIEN"];
	$newnoklien = $maxnoklien;
	$noklienbaru = str_pad($newnoklien,10,"0",STR_PAD_LEFT);
  	$noagen = $noklienbaru;


$direktori = 'dokumen_lpa/'.$noagen;
//$direktori = 'dokumen_lpa/0000074754';

if (!file_exists($direktori)) {
    mkdir($direktori, 0777, true);
}

//cek fotoagen
		$lokasifoto=$_FILES['fotoagen']['tmp_name'];
		//$namafoto=$_FILES['fotoagen']['name'];
		$extfoto=pathinfo($_FILES['fotoagen']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['fotoagen']['name']) ){
			$namafoto=$noagen."_foto.".$extfoto;
		} else {
			$namafoto=null;
		}
		$namafoto=$noagen."_foto.".$extfoto;
		$ukuranfoto=$_FILES['fotoagen']['size'];
		$direktori_foto="$direktori/$namafoto";

//cek ID agen		
		$lokasifileid=$_FILES['fileid']['tmp_name'];
		//$namafileid=$_FILES['fileid']['name'];
		$extfileid=pathinfo($_FILES['fileid']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['fileid']['name']) ){
			$namafileid=$noagen."_id.".$extfileid;
		} else {
			$namafileid=null;
		}
	
		$ukuranfileid=$_FILES['fileid']['size'];
		$direktori_fileid="$direktori/$namafileid";

//cek file rekening agen
		$lokasifile=$_FILES['filerek']['tmp_name'];
		//$namafile=$_FILES['filerek']['name'];
		$extfile=pathinfo($_FILES['filerek']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['filerek']['name']) ){
			$namafile=$noagen."_rekening.".$extfile;
		} else {
			$namafile=null;
		}
		//$namafile=$noagen."_rekening.".$extfile;
		$ukuranfile=$_FILES['filerek']['size'];
		$direktori_file="$direktori/$namafile";	
	
//cek file npwp agen
		$lokasifilenpwp = $_FILES['filenpwp']['tmp_name'];
		$extfilenpwp=pathinfo($_FILES['filenpwp']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['filenpwp']['name']) ){
			$namafilenpwp=$noagen."_npwp.".$extfilenpwp;
		} else {
			$namafilenpwp=null;
		}
	
		$ukuranfilenpwp=$_FILES['filenpwp']['size'];
		$direktori_filenpwp="$direktori/$namafilenpwp";	
			

//cek file Pernyataan BAST/Kepatuhan Kepemilikan Tab	
		$lokasifilebast = $_FILES['filebast']['tmp_name'];
		$extfilebast=pathinfo($_FILES['filebast']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['filebast']['name']) ){
			$namafilebast=$noagen."_pernyataan_bast_atau_kepatuhan_kemepikikan_tab.".$extfilebast;
		} else {
			$namafilebast=null;
		}
		
		$ukuranfilebast=$_FILES['filebast']['size'];
		$direktori_filebast="$direktori/$namafilebast";
		
//cek file Pernyataan Anggota Keluarga		
		$lokasifileak = $_FILES['fileak']['tmp_name'];
		$extfileak=pathinfo($_FILES['fileak']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['fileak']['name']) ){
			$namafileak=$noagen."_pernyataan_anggota_keluarga.".$extfileak;
		} else {
			$namafileak=null;
		}
		
		$ukuranfileak=$_FILES['fileak']['size'];
		$direktori_fileak="$direktori/$namafileak";

//cek file resign
		$lokasifileresign = $_FILES['fileresign']['tmp_name'];
		$extfileresign=pathinfo($_FILES['fileresign']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['fileresign']['name']) ){
			$namafileresign=$noagen."_resign.".$extfileresign;
		} else {
			$namafileresign=null;
		}
	
		$ukuranfileresign=$_FILES['fileresign']['size'];
		$direktori_fileresign="$direktori/$namafileresign";
		
//cek file pernyataan penghasilan
		$lokasifilepenghasilan = $_FILES['filepenghasilan']['tmp_name'];
		$extfilepenghasilan=pathinfo($_FILES['filepenghasilan']['name'], PATHINFO_EXTENSION);
		if(!empty($_FILES['filepenghasilan']['name']) ){
			$namafilepenghasilan=$noagen."_pernyataan_penghasilan.".$extfilepenghasilan;
		} else {
			$namafilepenghasilan=null;
		}
		
		$ukuranfilepenghasilan=$_FILES['filenpenghasilan']['size'];
		$direktori_filepenghasilan="$direktori/$namafilepenghasilan"; 


if($ukuranfoto<500000)
									 {									
									    if(move_uploaded_file($lokasifoto,"$direktori_foto")){
										
										}
										//echo $lokasifoto.$direktori_foto;
									 } 
									 else
									 {
									    echo "update foto gagal silahkan tutup jendela ini <br>dan pastikan ukuran file tidak lebih dari 500 kb  dan Nama File UNIK!!!";
									 }							


if($ukuranfileid<500000)
									 {									
									    if(move_uploaded_file($lokasifileid,"$direktori_fileid")){
																		
										}
										//echo $lokasifileid.$direktorifile_id;
									 } 
									 else
									 {
									    echo "<div align=center><span style='color:red'>Input file ID Agen Gagal !!!</span> Pastikan Ukuran File Tidak Lebih Dari 500 kb!!!  dan Nama File UNIK</div>";
									 }

if($ukuranfile<500000)
									 {									
									    if(move_uploaded_file($lokasifile,"$direktori_file")){

										}
										//echo $lokasifile.$direktori_file;
									 } 
									 else
									 {
									    echo "<div align=center><span style='color:red'>Input file Rekening Agen Gagal!!!</span><br> Pastikan Ukuran File Tidak Lebih Dari 500 kb dan Nama File UNIK!!!</div>";
								 }
//upload terbaru
if($ukuranfilenpwp<500000)
									 {									
									    if(move_uploaded_file($lokasifilenpwp,"$direktori_filenpwp")){

										}
										
									 } 
									 else
									 {
									    echo "<div align=center><span style='color:red'>Input file NPWP Agen Gagal!!!</span><br> Pastikan Ukuran File Tidak Lebih Dari 500 kb dan Nama File UNIK!!!</div>";
								 }
								 
if($ukuranfilebast<500000)
									 {									
									    if(move_uploaded_file($lokasifilebast,"$direktori_filebast")){

										}
										
									 } 
									 else
									 {
									    echo "<div align=center><span style='color:red'>Input file Pernyataan BAST/Kepatuhan Kepemilikan Tab Agen Gagal!!!</span><br> Pastikan Ukuran File Tidak Lebih Dari 500 kb dan Nama File UNIK!!!</div>";
								 }

if($ukuranfileak<500000)
									 {									
									    if(move_uploaded_file($lokasifileak,"$direktori_fileak")){

										}
										
									 } 
									 else
									 {
									    echo "<div align=center><span style='color:red'>Input file Pernyataan Anggota Keluarga Agen Gagal!!!</span><br> Pastikan Ukuran File Tidak Lebih Dari 500 kb dan Nama File UNIK!!!</div>";
								 }

if($ukuranfileresign<500000)
									 {									
									    if(move_uploaded_file($lokasifileresign,"$direktori_fileresign")){

										}
										
									 } 
									 else
									 {
									    echo "<div align=center><span style='color:red'>Input file Resign Agen Gagal!!!</span><br> Pastikan Ukuran File Tidak Lebih Dari 500 kb dan Nama File UNIK!!!</div>";
								 }

if($ukuranfilepenghasilan<500000)
									 {									
									    if(move_uploaded_file($lokasifilepenghasilan,"$direktori_filepenghasilan")){

										}
										
									 } 
									 else
									 {
									    echo "<div align=center><span style='color:red'>Input file Pernyataan Penghasilan Agen Gagal!!!</span><br> Pastikan Ukuran File Tidak Lebih Dari 500 kb dan Nama File UNIK!!!</div>";
								 }
								 
								 
								 								 
if($namafoto!="" && $namafileid !=="" && $namafile!=="" && $noagenrekruiter!=""){
 	
	$namaklien=strtoupper($namaklien);
	$norekening=str_pad($kdcabbri.$kdprodbri.$norekening,15,"0",STR_PAD_LEFT);//untuk memenuhi kebutuhan Div. Keagenan Rekening BRI 15 digit
	
    if($tptlhr=="" ||$tgllahir=="" || $kdagama=="" ||$kdjabatanagen=="" ||$namabank=="" || $alamat01=="" || $noidentitas=="" /*||$stsorganik==""*/ || $nohp=="" || $noagenrekruiter==""){
	echo "Gagal ...<br><br>";	
	}else{
	 $ins = "insert into $DBUser.tabel_100_klien(kdklien,noklien,namaklien1,".
		       "userrekam,tglupdated,userupdated,tempatlahir,tgllahir,alamattetap01,alamattetap02,phonetetap01,noid,kdagama,jeniskelamin,emailtetap) ".
		       "values ('L','$noklienbaru','".str_replace("'","''",$namaklien)."',user,sysdate,user,'$tptlhr',to_date('$tgllahir','dd/mm/yyyy'),'$alamat01','$alamat02','$nohp','$noidentitas','$kdagama','$jeniskelamin','$email')";	   
			  
		//echo $ins;
		$DB->parse($ins);
		$DB->execute();
	    $DB->commit();  
		
	    $query2="select kdkantor as kantor_rekruter from $DBUser.tabel_400_agen where noagen = '".$noagenrekruiter."' ";
	 
	  	$DB->parse($query2);
		$DB->execute();
		$arr2 = $DB->nextrow();
		$kantorrekruter = $arr2["KANTOR_REKRUTER"];

		$sql = "insert into $DBUser.tabel_400_agen(noagen,prefixagen,kdpangkat,kdkelasagen,kdjenjangagen,kdstatusagen, ".
		"kdareaoffice,kdunitproduksi,noskagen,tglskagen,norekening,namabank,tglrekam,userrekam,tglupdated,".
		"userupdated,kdkantor,kdjabatanagen,kddistribusi,statusorganik,tglpenetapan,nopkajagen,".
		"namasdr,alamatsdr,notelpsdr,namarekr,noagenrekr,kdjabatanrekr,fotoagen,bukurekagen,ktpagen,kdptkp,atasan,atasan_lama,kdsam,npwp,spernyataan,FILE_NPWP,FILE_BAST,FILE_KK,FILE_SURAT_RESIGN,FILE_PERNYATAAN_PENGHASILAN) ".
		       "values ('$noklienbaru','$prefixagen','00','K1','LL','01', ". // jenjang agen otomatis LL Agen Latihan Lapangan status 01=aktif
				   "'$kdao','$kdunitproduksi','$noskagen',to_date('$tglskagen','DD/MM/YYYY'),'$norekening','$namabank',sysdate, ".
				   "user,sysdate,user,'$prefixagen','$kdjabatanagen','BOS','$stsorganik',to_date('$tglpenetapan','DD/MM/YYYY'),'',".
				   "'$namasaudara','$almtsaudara',".
				   "'$notlpsaudara','$namarekruiter','$noagenrekruiter','$kdjabrekruiter','$namafoto','$namafile','$namafileid','$kdptkp','$noagenatasan','$noagenatasan','$kdsam',
				   '$nonpwp','$sp','$namafilenpwp','$namafilebast','$namafileak','$namafileresign','$namafilepenghasilan')";

				   //echo $sql;
				   //die;
		$DB->parse($sql);
		if ($DB->execute()) {
			/*
			// Tambahan Bypass
			if(in_array($kdjabatanagen, array("10", "11", "12", "13"))){
				$sql100="select NAMAKLIEN1,NAMAKLIEN2 from $DBUser.TABEL_100_KLIEN where NOKLIEN = '".$noklienbaru."' ";
	 
				$DB->parse($sql100);
				$DB->execute();
				$result100 = $DB->nextrow();
				
				$sqlInserGlindo = "INSERT INTO pkadm.agen
				(NOAGEN,NAMAAGEN,KDKANTOR,KDPANGKAT,KDKELASAGEN,KDUNITPRODUKSI,KDAREAOFFICE,KDSTATUSAGEN,NOSKAGEN,TGLSKAGEN,NOREKENING,NAMABANK,KDJABATANAGEN)
				VALUES
				('{$noklienbaru}','{$result100['NAMAKLIEN1']} {$result100['NAMAKLIEN2']}','{$prefixagen}','00','K1','$kdunitproduksi','$kdao','01',
				'$noskagen',to_date('$tglskagen','DD/MM/YYYY'),'$norekening','$namabank','$kdjabatanagen');";
				$DB->parse($sqlInserGlindo);
				$DB->execute();
			}
			
				// Added into jaim user account
				$sql900="SELECT NVL(MAX(IDUSER), 0)+1 as NOURUT FROM JAIM.JAIM_900_USER";
	 
				$DB->parse($sql900);
				$DB->execute();
				$result900 = $DB->nextrow();
				
				$sqlDual = "SELECT  lpad(jaim.dec2hex(floor(dbms_random.value(1000000000,100000000000))),8,'0') as TOKEN FROM DUAL";
				$DB->parse($sqlDual);
				$DB->execute();
				$resultToken = $DB->nextrow();
				
				if($kdjabatanagen == '29'){
					$sqlInsJaim = "INSERT INTO jaim_900_user@jaim
					(IDUSER, KDROLE, USERNAME, PASSWORD, MOBILETOKEN)
					VALUES
					('{$result900['NOURUT']}', 29, '{$noklienbaru}', '{$noklienbaru}', '{$resultToken['TOKEN']}')";
				}elseif(in_array($kdjabatanagen, array('31','32','33','34','35','36','37','38'))){
					$sqlInsJaim = "INSERT INTO jaim_900_user@jaim
					(IDUSER, KDROLE, USERNAME, PASSWORD, MOBILETOKEN)
					VALUES
					('{$result900['NOURUT']}', {$kdjabatanagen}, '{$noklienbaru}', '{$noklienbaru}', '{$resultToken['TOKEN']}')";
				}else{
					$sqlInsJaim = "INSERT INTO jaim_900_user@jaim
					(IDUSER, KDROLE, USERNAME, PASSWORD, MOBILETOKEN)
					VALUES
					('{$result900['NOURUT']}', 1, '{$noklienbaru}', '{$noklienbaru}', '{$resultToken['TOKEN']}')";
				}
				
				$DB->parse($sqlInsJaim);
				$DB->execute();
				
				
				// End Added into jaim user account
			// End Bypass
			*/
		   echo "<a class=verdana10blk><b>ENTRY AGEN</b></a>";
       echo "<hr size=1>";
       echo "<br><a class=verdana10blk>Entry Agen Nomor: <font color=red><b>$prefixagen-$noagen $namaklien $kantorrekruter</b></font> Sukses... </a><br><br>";
    	 
			 print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
       //print( "window.location.replace('biodataagen_new.php?noagen=$noagen');" );
       print( "</script>\n" );
		}
		else
		{
		   echo "<font color='red'>Gagal ... <br>$DB->errorstring</font><br><br>";
		}
		//var_dump($DB);
		
		if ($DB->errormessage) {
			echo "<b>ERROR ".$DB->errorstring."<br />".$DB->errorstring."</b>";
		}
	}
	
	 }
	} else {
 
?>
<html>
<head>
<!--<meta http-equiv="refresh" content="1500;url=http://192.168.2.23/jiwasraya/agen/ntryagen_new_2019.php" />-->
<title>ENTRY AGEN</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../includes/jquery-1.7.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/validasi.js"></script>
<script type="text/javascript">

function penghasilan() {
  var x = document.getElementById("ppenghasilan").value;
  var fileinputpenghasilan = document.getElementById("inputfilepenghasilan");
  
  console.log(x);
  if (x == 1)
  {

	  fileinputpenghasilan.style.display = "block";
  } else {

	  fileinputpenghasilan.style.display = "none";
  }
	 
}


function popup(){
	var strnoagenatasan = document.agen.noagenatasan.value;
	var strnoagenrekruiter = document.agen.noagenrekruiter.value;	
	var strjabrekruiter = document.agen.kdjabrekruiter.value;	
	
	return NewWindow('agnatasanlist_new_2019.php?a=porm&r=be&rekruter='+strnoagenrekruiter+'&jabrekruiter='+strjabrekruiter+'&atasan='+strnoagenatasan+'','popuppage','500','300','yes');
}

function isNamaAgen() {
var kdagen = document.agen.prefixagen.value; 
var str = document.agen.namaklien.value;
var strtptlhr = document.agen.tptlhr.value;	
var strtgllahir = document.agen.tgllahir.value;	
var strkdagama = document.agen.kdagama.value;	
var strnorekbank = document.agen.norekening.value;	
var strkdjabatanagen = document.agen.kdjabatanagen.value;	
var strnamabank = document.agen.namabank.value;	
var stralamat01 = document.agen.alamat01.value;	
var strnoidentitas = document.agen.noidentitas.value;
var strstsorganik = document.agen.stsorganik.value;		
var strtglpenetapan = document.agen.tglpenetapan.value;	
var strnohp = document.agen.nohp.value;	
var strnoagenrekruiter = document.agen.noagenrekruiter.value;	
var stremail = document.agen.email.value;
var strfotoagen = document.agen.fotoagen.value;
var strfilerek = document.agen.filerek.value;
var strstsptkp = document.agen.stsptkp.value;
var strnpwp = document.agen.filenpwp.value;
var strfileak = document.agen.fileak.value;
var strfilebast = document.agen.filebast.value;
var strfileresign = document.agen.fileresign.value;
var strfilepenghasilan = document.agen.filepenghasilan.value;
var strpernyataanpenghasilan = document.agen.sp.value;

	if(strnpwp == "")
	{
		alert("File Npwp Masih Kosong !!")
  		document.agen.filenpwp.focus();
 	 	return false;
	}
	
	if(strfileak == "")
	{
		alert("File Pernyataan Anggota Keluarga Masih Kosong !!")
  		document.agen.filenpwp.focus();
 	 	return false;
	}
	
	if(strfilebast == "")
	{
		alert("File Pernyataan BAST/Kepatuhan Kepemilikan Tab Masih Kosong !!")
  		document.agen.filenpwp.focus();
 	 	return false;
	}
	if (strpernyataanpenghasilan == '1') {
		if(strfileresign == "")
		{
			alert("File Resign Masih Kosong !!")
			document.agen.filenpwp.focus();
			return false;
		}
	}
	
	if(strfilepenghasilan == "")
	{
		alert("File Penghasilan Masih Kosong !!")
  		document.agen.filenpwp.focus();
 	 	return false;
	}
	
 	if (strnoagenrekruiter == "")
	{ 	
		if(strkdjabatanagen=="16" || strkdjabatanagen=="13" || kdagen.substr(1,1)=="A"){
		//	return true;	
		}else{
			alert("Rekruiter Agen Masih Kosong !!!" + kdagen.substr(1,1))
			document.agen.noagenrekruiter.focus();
			return false;	
		}
		
	}
		
	if (str == "") {
  		alert("Silakan Isi Nama Agen !!")
  		document.agen.namaklien.focus();
 	 	return false;
 	} 
	
	if (strfotoagen == "") {
  		alert("Silakan Isi Foto Agen !!")
  		document.agen.fotoagen.focus();
 	 	return false;
 	} 
	
	if (strtptlhr == "")
	{ 	
		alert("Tempat Lahir Masih Kosong !!!")
		document.agen.tptlhr.focus();
		return false;
	}

	if (strtgllahir == "")
	{ 	
		alert("tanggal Lahir Kosong!!!")
		document.agen.tgllahir.focus();
		return false;
	}

	if (strkdagama == "")
	{ 	
		alert("Agama Kosong !!!")
		document.agen.kdagama.focus();
		return false;
	}
	
	if (strnoidentitas == "")
	{ 	
		alert("Nomor Identitas Masih Kosong !!!")
		document.agen.noidentitas.focus();
		return false;
	}
	
	if (strnorekbank == "")
	{ 	
		alert("Nomor Rekening Masih Kosong !!!")
		document.agen.norekening.focus();
		return false;
	}
	
	if (strfilerek == "")
	{ 	
		alert("Nomor Rekening Masih Kosong !!!")
		document.agen.filerek.focus();
		return false;
	}

	if (strkdjabatanagen == "")
	{ 	
		alert("Jabatan Agen Masih Kosong !!!")
		document.agen.kdjabatanagen.focus();
		return false;
	}

	if (strnamabank == "")
	{ 	
		alert("Nama Bank Masih Kosong !!!")
		document.agen.namabank.focus();
		return false;
	}

	
	if (stralamat01 == "")
	{ 	
		alert("Alamat Masih Kosong !!!")
		document.agen.alamat01.focus();
		return false;
	}

	
	if (strstsorganik == "")
	{ 	
		alert("Status Organik Masih Kosong !!!")
		document.agen.stsorganik.focus();
		return false;
	}

					
	if (strnohp == "")
	{ 	
		alert("Nomor HP Agen Masih Kosong !!!")
		document.agen.nohp.focus();
		return false;
	}	
	
	if (strstsptkp == "")
	{ 	
		alert("Status PTKP Agen Masih Kosong !!!")
		document.agen.stsptkp.focus();
		return false;
	}
	
	
	if (stremail == "")
	{
		alert("E-Mail Masih Kosong !!!")
		document.agen.email.focus();
		return false;
	}
	else
	{
		if ((stremail.indexOf ('@',0) == -1) || (stremail.indexOf ('.',0) == -1))
		{
			alert("Menulis E-Mail Kurang Tepat !!!")
			document.agen.email.focus();
			return false;
		}
	}
//return true; 
  
 }
 


function Cari(theForm){
 var n=theForm.namaklien.value;
 if (!n==''){
  NewWindow('../proposal/agnlist.php','',500,300,1)
 }
}

function stsPegawai(theForm) {
			
			var stspeg=theForm.stsorganik.value;
      window.location.replace('ntryagen_new_2019.php?stspeg='+stspeg+'#awaledit');
   }


    $(document).ready(function () {
        $("#kdao").change(function() {
            $.ajax({
                type: "post",
                dataType: "html",
                url: "ajax_unit_produksi.php",
                data: "kdkantor=<?=$kantor?>&kdareaoffice="+this.value,
                success: function(data) {
                    $("#kdup").html(data);
                }
            });
        });
    });
	
	

function validasifoto(){
    var inputFile = document.getElementById('fotoagen');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}

function validasiktp(){
    var inputFile = document.getElementById('fileid');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasirekening(){
    var inputFile = document.getElementById('filerek');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasiak(){
    var inputFile = document.getElementById('fileak');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasinpwp(){
    var inputFile = document.getElementById('filenpwp');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasipenghasilan(){
    var inputFile = document.getElementById('filepenghasilan');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasibast(){
    var inputFile = document.getElementById('filebast');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasiresign(){
    var inputFile = document.getElementById('fileresign');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
</script>

</head>

<body>
<!--
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1320</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Entry Agen</b></font>
<hr size="1">
-->
<form method="POST" name="agen" action="#" onSubmit="return isNamaAgen()" enctype="multipart/form-data">
<table border="0" width="100%" cellspacing="1" cellpadding="2" class="tblhead">
  <tr>
    <td class="arial12whtb">ENTRY REKRUITER</td>
  </tr>
  <tr>
  <td width="100%" class="tblisi">
<? if($_GET[stspeg]!='1'){
	?> <table border="0" width="100%" cellspacing="5" class="verdana9">
  <tr>
			<?php 
			$sql = "select a.noagen,namaklien1,namajabatanagen,a.kdjabatanagen,a.kdsam from $DBUser.tabel_400_agen a, $DBUser.tabel_100_klien b, $DBUser.tabel_413_jabatan_agen c 
					where a.noagen = b.noklien and a.kdjabatanagen = c.kdjabatanagen and a.kdjabatanagen = '30'";
			//echo $sql;
			$DB->parse($sql);
			$DB->execute();
			$arc=$DB->nextrow();
			
			?>
			<td width="20%">Nomor Agen Rekruter</font></td>
            <td width="30%"><input type="text" class='c' name="noagenrekruiter" value="<?= $arc['NOAGEN'];?>" size="15" readonly>
			<input type="hidden" value="<?= $arc['KDJABATANAGEN'];?>" name="kdjabrekruiter" readonly> </td>
			<td width="20%"></td>
            <td width="30%"></td>
        </tr><tr>
			<td width="20%">Nama</font></td>
            <td width="30%"><input type="text" class='c' name="namarekruiter" value="<?= $arc['NAMAKLIEN1'];?>" size="30" readonly>
			<input type="hidden" value="<?= $arc['KDSAM'];?>" name="kdsam" />
			<input type="hidden" value="" name="kdunitproduksi" />
			<input type="hidden" value="" name="kdao" /></td>
			<td width="20%"></td>
            <td width="30%"></td>
        </tr>		
		<tr>
			<td width="20%">Jabatan</font></td>
            <td width="30%"><input type="text" class='c' value="<?= $arc['NAMAJABATANAGEN'];?>" name="jabrekruiter" size="30" readonly> </td>
            <td width="20%"></td>
            <td width="30%"></td>
        </tr>
  </table>
  <? }else{
 echo "<input type=hidden name=kdjabrekruiter value=10><input type=hidden name=namarekruiter value=NA><input type=hidden name=noagenrekruiter value=NA><input type=hidden name=jabrekruiter value=NA>";
  }?></td></tr>
  <tr>
    <td class="arial12whtb">ENTRY ATASAN</td>
  </tr>
  <tr>
  	<td width="100%" class="tblisi">
  		<table border="0" width="100%" cellspacing="5" class="verdana9">
		  	<tr>
				<td width="20%">Nomor Agen Atasan </font></td>
	            <td width="30%"><input type="text" class='c' name="noagenatasan" value="<?= $arc['NOAGEN'];?>" size="15" readonly>
				<input type="hidden" value="<?= $arc['KDJABATANAGEN'];?>" name="kdjabatasan" readonly> 
	            </td>
				<td width="20%"></td>
	            <td width="30%"></td>
        	</tr><tr>
				<td width="20%">Nama</font></td>
	            <td width="30%"><input type="text" class='c' name="namaatasan" value="<?= $arc['NAMAKLIEN1'];?>" size="30" readonly>
				<input type="hidden" value="<?= $arc['KDSAM'];?>" name="kdsam1" />
				<input type="hidden" value="" name="kdunitproduksi1" />
				<input type="hidden" value="" name="kdao1" /></td>
				<td width="20%"></td>
	            <td width="30%"></td>
        	</tr>		
			<tr>
				<td width="20%">Jabatan</font></td>
	            <td width="30%"><input type="text" class='c' value="<?= $arc['NAMAJABATANAGEN'];?>" name="jabatasan" size="30" readonly> </td>
	            <td width="20%"></td>
	            <td width="30%"></td>
        	</tr>
		</table>
  	</td>
  </tr>
  <tr>
    <td class="arial12whtb">ENTRY AGEN</td>
  </tr>
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%" cellspacing="5" class="verdana9">
			<tr>
          <!-- <td width="20%">&nbsp;</td> -->
          <td width="20%">Kode Kantor</font></td>
          <td width="30%"><span style="color:#FF0000"><!-- <input type="text" class="a" readonly name="prefixagen" size="5" value="<? echo $kantor; ?>" readonly> -->
            <!--input class="buton" type="button" name="cari" onClick="Cari(document.agen)" value="Lihat Agen Kantor <?echo $kantor;?>"-->
          <select class="c" onFocus="highlight(event)" size="1" name="prefixagen" required>
					 <? 
		   	   	$sql = "select * from $DBUser.TABEL_001_KANTOR where status = 1";
		  		$DB->parse($sql);
		  		$DB->execute();
					while ($arr=$DB->nextrow()) {				   
				        echo "<option value='".$arr["KDKANTOR"]."'>".$arr["KDKANTOR"]."-".$arr["NAMAKANTOR"]."</option>";
					} 
		    	 ?>
            </select>  	
          *</span></td>
          <td width="20%"></td>
          <td width="30%"><!--select size="1" name="kdsam" >
				<option value=''></option>
					 <? 
		   	   $sql = "select * from $DBUser.TABEL_410_SENIOR_AGEN_OFFICE  where status is null and kdkantor='$kantor'";
		  		 $DB->parse($sql);
		  		 $DB->execute();
					 while ($arr=$DB->nextrow()) {				   
		         echo "<option value='".$arr["KDSAM"]."'>".$arr["NAMASAMOFFICE"]."</option>";
								   } 
		    	 ?>
            </select--></td>
        </tr><tr>
          <td width="20%">Nama Agen</font></td>
          <td width="30%"><input type="text" class="c" name="namaklien" size="50" value="<?echo $namaklien;?>" required>  <span style="color:#FF0000" >*</span> 
			</td>
          <td width="20%">Input File Foto Agen <span style="color:#FF0000" >*</span></td>
          <td width="30%"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="fotoagen" id="fotoagen" onchange="return validasifoto()" required>
            <span class="verdana9blu">Maks. 500 Kb!</span> </td>
        </tr>
			 <tr>
          <td width="20%">Tempat Lahir</td>
          <td width="30%"><span style="color:#FF0000">
            <input type="text" class="c" name="tptlhr" size="20" required>
*</span></td>
          <td width="20%">Tanggal Lahir</td>
          <td width="30%"><span style="color:#FF0000">
            <input type="text" class='c' name="tgllahir" size="20" onBlur="javascript:convert_date(tglpenetapan)" required>
*</span> (DD/MM/YYYY)</td>
        </tr>
			<tr>
          <td width="20%">Agama</td>
          <td width="30%"><span style="color:#FF0000">
            <select class="c" onFocus="highlight(event)" size="1" name="kdagama" required>
              <option></option>
              <?  
        $query = "select kdagama,namaagama from $DBUser.tabel_102_agama";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDAGAMA"]==$arc["KDAGAMA"]) {
		       echo "<option value=".$arr["KDAGAMA"]." selected>".$arr["NAMAAGAMA"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDAGAMA"].">".$arr["NAMAAGAMA"]."</option>";
			   }
		    }
	      ?>
            </select>
*</span></td>
          <td width="20%">Jenis Kelamin</td>
          <td width="30%">
            <? 
		    $xxx = ($jeniskelamin=="L")? "checked" : "";
		    $yyy = ($jeniskelamin=="P")? "checked" : "";
		    printf("<input required type=\"radio\" value=\"L\" $xxx name=\"jeniskelamin\">Laki&nbsp");
        printf("<input type=\"radio\" value=\"P\" $yyy name=\"jeniskelamin\">Perempuan");
		    ?><!--input type="text" class='c' name="jnsKelamin" size="20" onBlur="javascript:convert_date(tglpenetapan)"-->
		<span style="color:#FF0000">*</span></td>
        </tr>	
        <tr>
          <td width="20%">No. Identitas</td>
          <td width="30%"><input type="number" onkeydown="return event.keyCode !== 69" class="c" name="noidentitas" size="20" onBlur="javascript:convert_date(tglskagen)" maxlength="20" required>
            <span style="color:#FF0000">*</span></td>
          <td width="20%">Input File ID Agen <span style="color:#FF0000">*</span></td>
          <td width="30%"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="fileid" id="fileid" onchange="return validasiktp()" required>
            <span class="verdana9blu">Maks. 500 Kb!</span></td>
        </tr>
        
        <tr>
          <td width="20%">No. Rekening Bank</td>
          <td width="30%"><select class="c" size="1" name="kdcabbri">
					 <? 
					 $sql = "select * from $DBUser.tabel_399_bri order by kdbank asc";
		  		 $DB->parse($sql);
		  		 $DB->execute();
			      while ($arr=$DB->nextrow()) {
		         echo "<option value=".$arr["KDBANK"].">".$arr["KDBANK"]."-".$arr["KOTA"]."</option>";
			   	 } 
		    	 ?>
            </select><input type="text" class="c" name="kdprodbri" size="1" value="01" readonly><input type="text" class="c" name="norekening" size="9" maxlength="9" onFocus="highlight(event)" onBlur="javascript:validasix(this.form.norekening);">
            </td>
          <td width="20%">Input File Rekening</td>
          <td width="30%"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="filerek" id="filerek" onchange="return validasirekening()">
            <span class="verdana9blu">Maks. 500 Kb!</span></td>
        
				</tr>
        <tr>
				  <td width="20%">Jabatan Agen</font></td>
          <td width="30%"><select class="c" size="1" name="kdjabatanagen">
					 <? 
					 $sql = "select * from $DBUser.tabel_413_jabatan_agen where kdjabatanagen IN ('31','32','33','34','35','36','37','38')";
		  		 $DB->parse($sql);
		  		 $DB->execute();
			      while ($arr=$DB->nextrow()) {
		         echo "<option value=".$arr["KDJABATANAGEN"].">".$arr["NAMAJABATANAGEN"]."</option>";
			   	 } 
		    	 ?>
            </select>
            <span style="color:#FF0000">*</span></td>
					
          <td width="20%">Nama Bank</font></td>
          <!--<td width="30%"><input type="text" class="c" name="namabank" size="20"></td>-->
					<td ><select size="1" name="namabank">
					 <? 
		   	   $sql = "select * from $DBUser.tabel_399_bank where kdbank in ('002')";
		  		 $DB->parse($sql);
		  		 $DB->execute();
					 while ($arr=$DB->nextrow()) {
				   if ($arr["ALIAS"]==$arc["NAMABANK"]) {
		         echo "<option value=".$arr["ALIAS"]." selected>".$arr["NAMABANK"]."</option>";
				   } else {
		         echo "<option value=".$arr["ALIAS"].">".$arr["NAMABANK"]."</option>";
					 }
				   } 		
		    	 ?>
            </select>
		    <span style="color:#FF0000">*</span></td>
        </tr>
        <tr>
		  <td width="20%">Tanggal Penetapan Agen</td>
          <td width="30%"><input type="text" class='c' name="tglpenetapan" size="20" onBlur="javascript:convert_date(tglpenetapan)">
(DD/MM/YYYY)</td>
          <td width="20%">Alamat</td>
          <td width="30%"><input type="text" class="c" name="alamat01" size="30" maxlength="30" required>
            <span style="color:#FF0000">*</span></td>
        </tr>
        <tr>
          <td width="20%">&nbsp;</td>
          <td width="30%">&nbsp;</td>
          <td width="20%">&nbsp;</td>
          <td width="30%"><input type="text" class="c" name="alamat02" size="30" maxlength="30">
            <span style="color:#FF0000">*</span></td>
        </tr>
        <tr>
					
		  <td width="20%">NPWP</font></td>
          <td ><input type="number" onkeydown="return event.keyCode !== 69" name="nonpwp" size="20" placeholder="07.966.623.6-952.000" maxlength="20"></td>
		  <td width="20%">Input File NPWP</td>
          <td width="30%"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="filenpwp" id="filenpwp" onchange="return validasinpwp()"> <span class="verdana9blu">Maks. 500 Kb!</span></td>
          
        </tr>
		<tr>
			<td width="20%"><!--Status Pegawai-->Surat Pernyataan Penghasilan</font></td>
            <td width="30%">
				<select size="1" name="sp" id="ppenghasilan" onchange="penghasilan()">
					<option value="1" selected="">ADA</option>
					<option value="0">TIDAK ADA</option>
		        </select>
				<!--select size="1" name="stsorganik" onChange="stsPegawai(document.agen)" style="display:none;">
					<?
					if($arc["STATUSORGANIK"]==1 || $_GET[stspeg]=='1'){
					echo "<option value='1' selected>ORGANIK</option>";
					echo "<option value='0'>NON ORGANIK</option>";} else {
					echo "<option value='1'>ORGANIK</option>";
					echo "<option value='0' selected>NON ORGANIK</option>";}
					?>
					</select>
              <span style="color:#FF0000;display:none;">*</span--> </td>
			<td width="20%">No. HP</td>
            <td width="30%"><input type="number" onkeydown="return event.keyCode !== 69" class='c' name="nohp" size="20" maxlength="20" required>
            <span style="color:#FF0000">*</span></td>
        </tr>
		<tr>
			<td width="20%">Status PTKP</td>
            <td width="30%"><select size="1" name="stsptkp">
          <? 
		   	   $sql = "select * from $DBUser.TABEL_400_PTKP order by keterangan";
		  		 $DB->parse($sql);
		  		 $DB->execute();
					 while ($arr=$DB->nextrow()) {
				   
		         echo "<option value=".$arr["KDPTKP"].">".$arr["KETERANGAN"]."</option>";
									   } 
		    	 ?>
        </select></td>
			<td width="20%">Email</td>
            <td width="30%"><input type="text" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address" name="email" /></td>
        </tr>
        <tr>
		  <td width="20%">Input File Surat Pernyataan BAST/Kepatuhan Kepemilikan Tab</td>
          <td width="30%"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="filebast" id="filebast" onchange="return validasibast()"> <span class="verdana9blu">Maks. 500 Kb!</span></td>
		   <td width="20%">Input File Surat Pernyataan Anggota Keluarga <span style="color:#FF0000">*</span></td></td>
          <td width="30%"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="fileak" id="fileak" onchange="return validasiak()" required> <span class="verdana9blu">Maks. 500 Kb!</span></td>
		 </tr>
		  <tr>
		   <td width="20%">Input File Surat Resign</td>
          <td width="30%"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="fileresign" id="fileresign" onchange="return validasiresign()"> <span class="verdana9blu">Maks. 500 Kb!</span></td>
		
			<td  width="20%" >Input File Surat Pernyataan Penghasilan <span style="color:#FF0000">*</span></td></td>
			<td id="inputfilepenghasilan"><input type="file" accept=".jpg,.jpeg,.png,.pdf" name="filepenghasilan" id="filepenghasilan" onchange="return validasipenghasilan()" required><span class="verdana9blu">Maks. 500 Kb!</span></td>

		</tr>
				
      </table>
    </td>
  </tr>
  <!--tr>
    <td class="arial12whtb">LISENSI KEAGENAN</td>
  </tr>
  <tr>
   <td width="100%" class="tblisi">
    <table border="0" width="100%" cellspacing="5" class="verdana9">
     <tr>
			<td width="20%">Nomor Lisensi</font></td>
            <td width="30%"><input type="text" class='c' name="nolisensi" size="15"></td>
			<td width="20%"></td>
            <td width="30%"></td>
	 </tr>
	 <tr>
			<td width="20%">Berlaku Mulai</font></td>
            <td width="40%"><input type="text" class='c' name="tglmulailisensi" size="12"> s.d <input type="text" class='c' name="tglakhirlisensi" size="12">. (format tanggal dd/mm/yyyy)</td>
			<td width="10%"></td>
            <td width="30%"></td>
	 </tr>		 
	</table>
   </td>
  </tr-->
	<tr>
    <td class="arial12whtb">SAUDARA YANG DAPAT DIHUBUNGI DALAM KEADAAN DARURAT</td>
  </tr>
  <tr>
   <td width="100%" class="tblisi">
   <table border="0" width="100%" cellspacing="5" class="verdana9">   	
		<tr>
			<td width="20%">Nama</font></td>
            <td width="30%"><input type="text" class='c' name="namasaudara" size="30"></td>
			<td width="20%"></td>
            <td width="30%"></td>
        </tr>
		<tr>
			<td width="20%">Alamat</font></td>
            <td width="30%"><input type="text" class='c' name="almtsaudara" size="50"></td>
			<td width="20%"></td>
            <td width="30%"></td>
        </tr>
		<tr>
			<td width="20%">Nomor Telepon</font></td>
            <td width="30%"><input type="numnber" onkeydown="return event.keyCode !== 69" class='c' name="notlpsaudara" size="15"></td>
			<td width="20%"></td>
            <td width="30%"></td>
        </tr>
   </table>
   </td>
   </tr>   
  <tr>
    <td width="100%" bgcolor="#E5E5E5">
		  <input type="hidden" name="mode" value="insert">
          <span style="color:#FF0000">*) Field ini harus diisi untuk memenuhi kebutuhan data. </span>
<p align="right"><input type="submit" value="Submit" name="submit"><input type="reset" value="Reset" name="B2"></td>
  </tr>
</table>
</form>

<br>
<? 
}
?>
<a href="../mainmenu.php"><font face="Verdana" size="2">Main Menu</font></a> | 
<a href="../mnukeagenan.php"><font face="Verdana" size="2">Menu Keagenan</font></a>

</body>

</html>
