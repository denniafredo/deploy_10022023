<?
    include "../includes/common.php";
    include "../includes/session.php";
	include "../includes/database.php";
	include "../includes/klien.php";
	include "../includes/pertanggungan.php";
	include "../includes/kantor.php";
	include "../includes/tgl.php";
	include "../includes/constant.php";
	
	// nopolis = QB 001065838
	
	$DB  = new database($userid, $passwd, $DBName);
	$PWK = New Kantor($userid,$passwd,$kantor);
	$KT  = New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
	$prefix=strtoupper($prefix);
	$KP  = New KantorPusat($userid,$passwd);
	//echo $tglpengajuan;

	$sql = "select kelompok,namaklaim from $DBUser.tabel_902_kode_klaim where kdklaim='$jnsklaim'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	$namaklaim=	$arr["NAMAKLAIM"];
	
if ($submit) {
  print( "<html>\n" );
  print( "<head>\n" );
  print( "<title>Pengajuan Klaim Tanggal ".$tanggal."</title>\n" );
  print( "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">\n" );
  print( "</head>" );
  print( "<body>" );
	print( "<div align=center>" );

  
  	$meninggal=(!$tglmeninggal) ? 'NULL' : "to_date('$tglmeninggal','DD/MM/YYYY')";
	$booked=(!$tglbooked) ? 'NULL' : "to_date('$tglbooked','DD/MM/YYYY')";
	$sebabmeninggal=substr(strtoupper($sebabmeninggal),0,50);
	$namadokter=substr(strtoupper($namadokter),0,30);
	$alamatdokter=substr(strtoupper($alamatdokter),0,40);
	
	$prefix = substr($pertanggungan,0,2);
	$noper = substr($pertanggungan,3); 
	$PER=New Pertanggungan($userid,$passwd,$prefix,$noper);
	$kdproduk=$PER->produk; 
	$tb=(int)(substr($tglbooked,6,4).substr($tglbooked,3,2).substr($tglbooked,0,2));
  	$ts=(int)(substr($PER->sysdate,6,4).substr($PER->sysdate,3,2).substr($PER->sysdate,0,2));

  	// mencari no ijin gadai
	$sql = "select max(nourut) as maxurut from $DBUser.tabel_901_pengajuan_klaim";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$maxurut = $arr["MAXURUT"];

	if (strlen($maxurut)==0) {
		$nourut = "1";
	} else {
		$nourut = $maxurut + 1;
	}
	$noizinbaru = str_pad($nourut,3,"0",STR_PAD_LEFT);
	$noizinci = $noizinbaru."/CI/".$kantor.substr($tglpengajuan,2,8);
	//echo $noizinci;
	
	if ($klp=='D') {
		 $status = '0' ;
		 $tglpengajuan=$PER->sysdate;
	
		 //=========================================================================
		 //Revised By Agus on January 06 2005
		 
		 //Lakukan perhitungan terhadap nilai benefit meninggalnya.
		 //get benefit's formula..
		 
		 $sqlp = "select c.rumus, a.kdbenefit ".
		 			 	 "from $DBUser.tabel_206_produk_benefit A, ".
						 "$DBUser.TABEL_207_KODE_BENEFIT B, ".
						 "$DBUser.TABEL_224_RUMUS C ".
						 "where A.KDBENEFIT = B.KDBENEFIT ".
						 "AND A.KDPRODUK='$kdproduk' AND B.KDKELOMPOKBENEFIT='D' ".
						 "AND A.KDRUMUSBENEFIT=C.KDRUMUS ";
			$DB->parse($sqlp);
		  $DB->execute();
		  $arr=$DB->nextrow();
		  $rumusan=$arr["RUMUS"];
			$benefit=$arr["KDBENEFIT"];
			
		 //Ambil nilai rumusan dengan memanggil fungsi formula!!
		 		 
		  $sqlg = "select $DBUser.formula.runy('$prefix','$noper','$tglpengajuan','$rumusan') nilaibenefit from dual ";
			
			$DB->parse($sqlg);
		  $DB->execute();
		  $arr=$DB->nextrow();
		  $nilaibnf=$arr["NILAIBENEFIT"];

			//echo $nilaibnf;
			
			//Update nilai benefit meninggal pada tabel_223_transaksi_produk
			$sql="Update $DBUser.tabel_223_transaksi_produk set nilaibenefit =$nilaibnf  ". 
						"where prefixpertanggungan ='$prefix' and nopertanggungan ='$noper' ".
						"and kdbenefit ='$benefit' " ;
				 
		  $DB->parse($sql);
		  $DB->execute();
			
		 //=========================================================================
		 
	} else {
		 $status = '0';
		 //$status = '1'; // awal status sebelum tgl 25 april
		 //$tglpengajuan =($tb < $ts) ? $tglbooked : $PER->sysdate;
	}	 
	//echo $tglpengajuan;
	
	if($cekbnf=="ON") { // jika tidak punya benefit meninggal
	   // ubah status pertanggungan menjadi KLAIM agan gak kena billing
		 $sql =   "insert into $DBUser.tabel_901_pengajuan_klaim ".
							"(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,userfo,tglfo,".
							"userrekam,tglrekam,nilaibenefit,status,tglmeninggal,sebabmeninggal,namadokter,alamatdokter,tglbooked,pemohon,noizin,kdkantorproses) ".
							"values ('$prefix','$noper','$jnsklaim',to_date('$tglpengajuan','DD/MM/YYYY'),user,sysdate, ".
							"user,sysdate,NULL,'4',$meninggal,'$sebabmeninggal','$namadokter','$alamatdokter',$booked,'$pemohon','$noizinci',''$kantor')";
	
	   //$note= "Polis ini tidak memiliki Benefit Meninggal. Lanjutkan proses untuk menghentikan pembayaran premi.";
		 
	} else {
		 $sql =   "insert into $DBUser.tabel_901_pengajuan_klaim ".
							"(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,userfo,tglfo,".
							"userrekam,tglrekam,nilaibenefit,status,tglmeninggal,sebabmeninggal,namadokter,alamatdokter,tglbooked,pemohon,noizin,kdkantorproses) ".
							"values ('$prefix','$noper','$jnsklaim',to_date('$tglpengajuan','DD/MM/YYYY'),user,sysdate, ".
							"user,sysdate,NULL,'$status',$meninggal,'$sebabmeninggal','$namadokter','$alamatdokter',$booked,'$pemohon','$noizinci','$kantor')";
	
	   $note= "Proses Dilanjutkan Dengan Perhitungan Benefit di HO";
	//echo $sql; 
	}
	$DB->parse($sql);
	if ($DB->execute()) {
	
				if ($klp=='D') { //kelompok meninggal
		
				 print( "  <table width=\"100%\">\n" );
   			 print( "   <tr>\n" );
   			 //print( "    <td width=\"20%\" align=\"left\"><a href=\"#\" onclick=\"window.location.replace('hitungklaim_rider.php?prefix=$prefix&noper=$noper&kdklaim=$jnsklaim&tglpengajuan=$tglpengajuan&tglkejadian=$tglkejadian".
				                               //"&sebabmeninggal=$sebabkejadian&namadokter=$namadokter&alamatdokter=$alamatrs&cekbnf=$cekbnf&pemohon=$pemohon')\"><font face=Arial size=2>Lanjut</font></a></td>\n" );
   			 print( "		<td width=\"80%\" align=\"right\"><font face=Verdana size=2 color=#ff3366><b>$note</font></td>\n" );
   			 print( "	 </tr>\n" );
   			 print( "	</table>	" );
		 		}	else { // selain meninggal
				 //benefit itu harus dimasukkan disini	
				 print( "  <table width=\"100%\">\n" );
   			 print( "   <tr>\n" );
   			 //print( "    <td width=\"20%\" align=\"left\"><a href=\"#\" onclick=\"window.location.replace('hitungklaim_rider.php?prefix=$prefix&noper=$noper&kdklaim=$jnsklaim&tglpengajuan=$tglpengajuan')\"><font face=Arial size=2>Lanjut</font></a></td>\n" );
   			 print( "		<td width=\"80%\" align=\"right\"><font face=Verdana size=2 color=#ff3366><b>Proses Dilanjutkan Dengan Perhitungan Benefit di HO</font></td>\n" );
   			 print( "	 </tr>\n" );
   			 print( "	</table>	" );
		    }
				// masukkan data klaim kecelakaan
				$sql = "insert into $DBUser.tabel_907_data_kecelakaan ".
						 	 "(prefixpertanggungan,nopertanggungan,kd_klaim,".
							 "tgl_pengajuan,tgl_kejadian,sebab_kejadian,".
							 "nama_rs,alamat_rs,nama_dokter,".
							 "tgl_mulai_rawat,tgl_akhir_rawat,".
							 "nama_pemohon,alamat_pemohon,tgl_rekam,user_rekam) ".
							 "values ('$prefix','$noper','$jnsklaim',".
							 "to_date('$tglpengajuan','DD/MM/YYYY'),to_date('$tglkejadian','DD/MM/YYYY'),'$sebabkejadian',".
							 "'$namars','$alamatrs','$namadokter',".
							 "to_date('$tglawal','DD/MM/YYYY'),to_date('$tglakhir','DD/MM/YYYY'),".
							 "'$pemohon','$alamatpemohon',sysdate,user)";
				$DB->parse($sql);
 				$DB->execute();
				//echo $sql;
				
	} else { //insert fail
		 
				 $sql = "select to_char(max(tglpengajuan),'DD/MM/YYYY') tglpengajuan from $DBUser.tabel_901_pengajuan_klaim ".
				 			  "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$jnsklaim' ";
				 //echo $sql;
				 $DB->parse($sql);
				 $DB->execute();
				 if ($arr=$DB->nextrow()) {
				  $tglklaim=$arr["TGLPENGAJUAN"];
   			  print( "  <table width=\"600\">\n" );
   			  print( "   <tr class=arial10>\n" );
   			  print( "    <td width=\"20%\" align=\"left\"><a href=\"#\" onclick=\"window.location.replace('".$PHP_SELF."')\">Back</a></td>\n" );
   			  print( "		<td width=\"80%\" align=\"right\"><b>Proses Tidak Dapat Dilanjutkan</font><br>Klaim $jnsklaim Terakhir diajukan tanggal $tglklaim</td>\n" );
   			  print( "	 </tr>\n" );
   			  print( "	</table>	" ); 
				 }	
 	}
				
} else {

	$sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
  	$DB->parse($sql);
	$DB->execute();
	$w=$DB->nextrow();
	$tanggal = $w["NOW"];
?>

<html>
<head>
<title>Pengajuan Klaim Tanggal </title>

<style type="text/css">
<!--

body {
	background-color: #FFFFFF;
	font-family: Verdana, Arial, Serif;
	font-size: 10px;
	color: #000000;
	margin-left: 0px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
}

table {
	font-family: verdana;
	font-size: 12px;
}

.button {
	font-size: 11px;
	color: #FFFFFF;
	background-color: #99cccc;
	border: solid 0px;
}

.select {
	font-family: Verdana, Arial, Serif;
	font-size: 11px;
	color: #336699;
	background-color: #FFFFFF;
}

-->
</style>

<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript" type="text/javascript">
<!--

function KartuPremi(theForm){
  var polis=theForm.pertanggungan.value;
   if (!polis =='') { 
    var prefix=polis.substring(0,2);
		var noper=polis.substring(3);
	  NewWindow('../akunting/kartupremi1.php?prefix='+prefix+'&noper='+noper+'','kartupremi',700,600,1)
  	return true;
	 }	
}
function KartuGadai(theForm){
  var polis=theForm.pertanggungan.value;
   if (!polis =='') { 
    var prefix=polis.substring(0,2);
		var noper=polis.substring(3);
	  NewWindow('../akunting/kartugadai1.php?prefix='+prefix+'&noper='+noper+'','kartugadai',700,600,1)
  	return true;
	 }	
}
function Polis(theForm){
  var polis=theForm.pertanggungan.value;
   if (!polis =='') { 
    var prefix=polis.substring(0,2);
		var noper=polis.substring(3);
	  NewWindow('polis.php?prefix='+prefix+'&noper='+noper+'','polis',700,600,1)
  	return true;
	 }	
}

function GantiKlaim(theForm) {
var prefix=theForm.prefix.value;
var noper=theForm.noper.value;
var kdklaim=theForm.jnsklaim.value;
prefix=prefix.toUpperCase();
if (kdklaim=='RAWATINAP'){
window.location.replace('pengajuanklaim_cashplan.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
} else if (kdklaim=='JSHC'){
window.location.replace('pengajuanklaim_hospitalcare.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
} else{
window.location.replace('pengajuanklaim_rider.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
}
}

function OpenWin(prefix,noper) {
var kdklaim=document.propmtc.jnsklaim.value;
NewWindow('loadpengajuan_rider.php?prefix='+prefix+'&noper='+noper+'&kode='+kdklaim+'','',700,400,1)
}

function CariPolis () {
prefix = document.propmtc.prefix.value;
noper = document.propmtc.noper.value;

loadOK = true;
 if ( prefix == '' && loadOK) {
  alert('Masukkan Prefix Pertanggungan atau \nKlik Pilih Polis');
	document.propmtc.prefix.focus();
	loadOK = false;
 }
 if ( ( noper == '' || noper=='000000000') && loadOK ) {
  alert('Masukkan Nomor Pertanggungan');
	document.propmtc.prefix.focus();
	loadOK = false;
 }
 if (loadOK) {  
   OpenWin(prefix,noper);
 }
 return loadOK
}
function OnSumbit(theForm) {
var pert=theForm.pertanggungan.value;
 if (pert =='') {
  alert ('Nomor Polis Kosong, Masukkan Nomor Polis Yang Benar Atau Cari Dari Popup');
 	theForm.prefix.focus();
	return false;
 } else {
  return true
 }
}

function PilihAo(theForm) {
 var polis=theForm.pertanggungan.value;
		NewWindow('loadinsurable.php?nopertanggungan='+polis+'','popupcari',500,200,1);
}
//-->
</script>
<?
	$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	
 if ($klp=='D') {
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function KonverDate(theForm) {\n" );
  print( " tglmati=theForm.tglmeninggal.value;\n" );
  print( " if (!tglmati=='') {\n" );
  print( "  convert_date(theForm.tglmeninggal);\n" );
  print( "	return true;\n" );
  print( " } else {\n" );
  print( "  alert('Tanggal Meninggal Wajib Diisi');\n" );
  print( "	theForm.tglmeninggal.focus();\n" );
  print( "	return false;\n" );
  print( " }		\n" );
  print( "}\n" );
  print( "//-->\n" );
  print( "</script>\n" );
 }
?>
</script>

</head>
<body>

<div align="center">
<form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>"  onsubmit="return OnSumbit(document.propmtc)">

<table bgcolor="#e5e5e5" border="1" width="95%" align="center" cellpadding="2" style="border-collapse: collapse" bordercolor="#a4a4a4" id="AutoNumber1" cellspacing="0">
  <tr>
    <td width="100%" height="25" bgcolor="#fac67e" align="center"><b>PENGAJUAN KLAIM RIDER <?=$kdklaim?> NEW UNIT LINK</b></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
      <tr>
        <td>Klaim Diajukan</td>
        <td>: 
  				<select name="jnsklaim" class="select" onFocus="highlight(event)" onChange="GantiKlaim(document.propmtc)">
  				<?
  				switch($kdklaim)
  				{
  				  //case "MENINGGAL": $m="selected"; break;
  				//	case "CACAT": $k="selected"; break;
  					case "RAWATINAP": $r="selected"; break;
					case "RTI": $a="selected"; break;
					case "TPD": $b="selected"; break;
					case "CI53": $c="selected"; break;
					case "PBCI": $c="selected"; break;
					case "ADDB": $d="selected"; break;
					//case "HCCP": $e="selected"; break;
					case "SDB": $f="selected"; break;
					case "STPD": $g="selected"; break;
					case "PDB": $h="selected"; break;
					case "PTPD": $i="selected"; break;
					case "WPTPD": $j="selected"; break;
					case "WPCI": $k="selected"; break;
					case "JSHC": $l="selected"; break;
					case "ADB": $m="selected"; break;
  				}
  				  
  				  //echo "<option value=CACAT $k>KLAIM CACAT TETAP</option>";
  				  //echo "<option value=MENINGGAL $m>KLAIM MENINGGAL DUNIA</option>";
				  echo "<option value=RTI $a>RIDER TERM INSURANCE</option>";
				  echo "<option value=TPD $b>RIDER TPD</option>";
				  echo "<option value=CI53 $c>RIDER CI 53</option>";
				  echo "<option value=PBCI $c>RIDER PAYOR CI</option>";
				  echo "<option value=ADDB $d>RIDER ADDB</option>";
				  //echo "<option value=HCCP $e>HCCP</option>";
				  echo "<option value=SDB $f>SPOUSE DEATH BENEFIT</option>";
				  echo "<option value=STPD $g>SPOUSE TPD</option>";
				  echo "<option value=PDB $h>PAYOR DEATH BENEFIT</option>";
				  echo "<option value=PTPD $i>PAYOR TPD</option>";
				  echo "<option value=RAWATINAP $r>HCCP</option>";
				  echo "<option value=WPTPD $j>WAIVER TPD</option>";
				  echo "<option value=WPCI $k>WAIVER CI</option>";
				  echo "<option value=JSHC $l>HOSPITAL CARE</option>";
				  echo "<option value=ADB $m>RIDER ADB</option>";
  				?>
  				</select>
				</td>
        <td>Tanggal Pengajuan</td>
        <td>: <input type="text" name="tglpengajuan" size="20" readonly value="<? echo $tanggal;?>"></td>
      </tr>
      <tr>
        <td>Nomor Polis</td>
        <td>: <input type="text" name="prefix" size="3" maxlength="2" value="<? echo $prefix;?>" onBlur="javascript:this.value=this.value.toUpperCase();">-<input type="text" name="noper" size="16" onBlur="validasi9(this.form.noper);return CariPolis()" value="<? echo $noper;?>"></td>
        <td>Pertanggungan Nomor</td>
        <td>: <input type="text" name="pertanggungan" size="20"> 
				</td>
      </tr>
      <tr>
        <td colspan="4"><hr color="#c0c0c0" size="1"></td>
      </tr>
      <tr>
        <td>Tertanggung</td>
        <td>: <input type="text" name="tertanggung" size="36"></td>
        <td>Produk</td>
        <td>: <input type="text" name="produk" size="20"></td>
      </tr>
      <tr>
        <td>Pemegang Polis</td>
        <td>: <input type="text" name="pemegangpolis" size="36"></td>
        <td>JUA</td>
        <td>: <input type="text" name="jua" size="20"></td>
      </tr>
      <tr>
        <td>Valuta</td>
        <td>: <input type="text" name="valuta" size="20"></td>
        <td>Index Awal</td>
        <td>: <input type="text" name="indexawal" size="20"></td>
      </tr>
      <tr>
        <td>Premi 5 Tahun Pertama</td>
        <td>: <input type="text" name="premi1" size="20"></td>
        <td>Resiko Awal</td>
        <td>: <input type="text" name="resikoawal" size="20"></td>
      </tr>
      <tr>
        <td colspan="4"><hr color="#c0c0c0" size="1"></td>
      </tr>
			<? 
			if($klp=='D')
			{
			  $tit = "Meninggal";
			}
			else
			{
			  $tit = "Kecelakaan";
			}
			?>
     <!-- <tr>
        <td>Tanggal <?=$tit;?></td>
        <td colspan="3">: <input type="text" name="tglkejadian" size="20" onBlur="javascript:convert_date(tglkejadian)"> (DD/MM/YYYY)</td>
      </tr>
      <tr>
        <td>Sebab <?=$tit;?></td>
        <td colspan="3">: <input type="text" name="sebabkejadian" size="55"></td>
      </tr>
      <tr>
        <td>Nama Rumah Sakit</td>
        <td colspan="3">: <input type="text" name="namars" size="55"></td>
      </tr>
      <tr>
        <td>Alamat Rumah Sakit</td>
        <td colspan="3">: <input type="text" name="alamatrs" size="55"></td>
      </tr>
      <tr>
        <td>Nama Dokter</td>
        <td colspan="3">: <input type="text" name="namadokter" size="36"></td>
      </tr>
			<? 
			if($klp=='D')
			{
			?>
      <tr>
        <td>Nama Pemohon</td>
        <td colspan="3">: <input type="text" name="pemohon" size="36"></td>
      </tr>
			<tr>
        <td>Alamat Pemohon</td>
        <td colspan="3">: <input type="text" name="alamatpemohon" size="55"></td>
      </tr>
			<tr>
        <td></td>
        <td colspan="3">
				<textarea cols="30" rows="1" name="ket"  style="width: 100%; border: 0px solid #99ccff; background:#e5e5e5"></textarea>
				</td>
      </tr>
			<? 
			}
			else
			{
			?>
      <tr>
        <td>Tanggal Rawat Inap</td>
        <td colspan="3">: <input type="text" name="tglawal" size="14" onBlur="javascript:convert_date(tglawal)"> S/D
        <input type="text" name="tglakhir" size="16" onBlur="javascript:convert_date(tglakhir)"> (DD/MM/YYYY)</td>
      </tr>
			<? 
			}
			?>
			
			<tr>
        <td colspan="4"><hr color="#c0c0c0" size="1"></td>
      </tr>-->
			<tr>
        <td colspan="4" align="center">
  				<input type="hidden" name="cekbnf">
					<input type="hidden" name="premi2">
					<input type="submit" name="submit" value="Proses">
				</td>
      </tr>
    </table>
    </td>
  </tr>

	</form>
</table>


<table width="800">
  <tr>
    <td width="50%" class="arial10" align="left"><font face="verdana" size="2"><a href="../../../submenu.php?mnuinduk=150">Back</a></font></td>
		<td width="50%" class="arial10" align="right"></td>
	</tr>
</table>


</div>
</body>
</html>
<?}?>