<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";

	$bln = (!$bl) ? $bln : '';
$DB = new Database($userid, $passwd, $DBName);
$DB2 = new Database($userid, $passwd, $DBName);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Informasi Pengajuan Tebus/Gadai/Pemulihan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table width="1000">
  <tr>
    <td align="center" class="arial10blk"><b>PENGECEKAN STATUS PENGAJUAN GADAI/TEBUS/PEMULIHAN KANTOR <? echo $kantor; ?></td>
	</tr>
  </table>
<table width="50%" cellpadding="0" cellspacing="0">
 <tr>
    <td align="left" class="arial10" width="45%">Bulan Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="bl" onFocus="highlight(event)" class="c">
		  <?
			$bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember','SEMUA');
			for ($i=1; $i<=13; $i++) {
			   if ($i==$bl || $bulan[$i]==$bln) {
				  print( "<option value=$i selected>".$bulan[$i]."</option>" );
				 } else {
				  print( "<option value=$i>".$bulan[$i]."</option>" );
				 }	
			}
			?>
		 </select>
		<select name="th" onFocus="highlight(event)" class="c">
		  <?
			$th=(!$th) ? substr($tanggal,-4) : $th;
			//$awalth = 2000;
			$awalth = 1995;
			for ($i=$awalth; $i<=substr($tanggal,-4); $i++) {
			  if ($i==$th) {
				  print( "<option value=$i selected>$i</option>" );
				} else {
				  print( "<option value=$i>$i</option>" );
				}	
			}
			
			?>
		 </select>
		</td>
	</tr> 
	<?
	  //var_dump($bulan);
			$jnsval = array(1=>'gadai','tebus','pulih','klaim');
			$jnslab = array(1=>'Pinjaman Polis (Gadai)','Penebusan Polis','Pemulihan Pertanggungan','Klaim Asuransi');
	?>
  <tr>
    <td align="left" class="arial10" width="45%">Jenis Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="jns" onFocus="highlight(event)" class="c">
		 <?
		  for ($i=1; $i<=count($jnsval); $i++) {
		   if ($jnsval[$i] == $jns) { 
			 $jenis = $jnsval[$i];
			 	print( " <option selected value=".$jnsval[$i].">".$jnslab[$i]."</option>\n" );
			 } else {
			 	print( " <option value=".$jnsval[$i].">".$jnslab[$i]."</option>\n" );
			 }	
			}
		 ?>
		 </select>
		</td>
	</tr>
	<!--tr>
    <td align="left" class="arial10" width="45%">Status Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="status" onFocus="highlight(event)" class="c">
			<option selected value='1'>Desisi</option>	
			<option value='2'>SIP</option>	
			<option value='3'>Bayar</option>	
	     </select>
		</td>
	</tr-->
	<tr>
		<td colspan="3" width="100%" align="left"><input name="cari" value="Periksa Status" type="submit">
		</td>
	</tr>
	
</table>
<hr size="1">
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="1000" align="center">
  <tr>
    <td class="tblhead" align="center"><b>DAFTAR PENGAJUAN <? echo strtoupper($jns);?> RAYON PENAGIHAN <? echo $kantor; ?></td>
	</tr>
	<tr>
    <td class="tblisi" align="center">
		  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr class="hijao">
			  <td align="center">No</td>
			  <td align="center">Nomor Polis</td>
			  <td align="center">Pemegang Polis</td>
			  <td align="center">Tertanggung</td>
			  <td align="center">Nomor Polis</td>
			  <td align="center">Produk</td>
			  <td align="center">Tanggal<br>Pengajuan</td>
			  <td align="center">Tanggal<br>Perhitungan</td>
			  <td align="center">Tanggal<br>Otorisasi</td>
			  <td align="center">User <br>Rekam</td>
			  <td align="center">Tanggal<br>Rekam</td>
			  <td align="center">Status <br>Terakhir</td>
				<td align="center">Proses<br>Berikut</td>
			 	<td align="center">Cetak<br>SIP</td>
                <td align="center">Bukti Memorial </td>
			 </tr>
<?
$bl = (strlen($bl)==1) ? "0".$bl : $bl;
$tglhitung = (strtoupper($jns)=='GADAI') ? "tglgadai" : "tglhitung";
$kam = ($bl=='13') ? "to_char(a.tglmohon,'YYYY')='".$th."' and " : "to_char(a.tglmohon,'MMYYYY')='".$bl.$th."' and ";
//$kim = ($bl=='13') ? "to_char(a.tglpengajuan,'YYYY')='".$th."' and " : "to_char(a.tglpengajuan,'MMYYYY')='".$bl.$th."' and ";
$kim = ($bl=='13') ? "to_char(a.tglrekam,'YYYY')='".$th."' and " : "to_char(a.tglrekam,'MMYYYY')='".$bl.$th."' and ";

  $sql = "select ".
    			 	 "a.nomorsip,a.prefixpertanggungan,a.nopertanggungan,a.userrekam,b.namastatus,a.status,'TEBUS' kdklaim, ".
      		 	 "to_char(a.tglmohon,'DD/MM/YYYY') tglmohon,to_char(a.".$tglhitung.",'DD/MM/YYYY') tglhitung,nvl(a.metodebayar,'TRANSFER') metodebayar,".
      			 "to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, ".
      		   "to_char(a.tglsip,'DD/MM/YYYY') tglsip ".
  			 "from ".
      			 "$DBUser.tabel_200_pertanggungan c, $DBUser.tabel_700_".strtolower($jns)." a,".
      			 "$DBUser.tabel_500_penagih d, $DBUser.tabel_999_kode_status b ".
  			 "where ".
      			 $kam.
      			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
      			 "and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
      			 "and a.status=b.kdstatus and b.jenisstatus='".strtoupper($jns)."' ".
      			 //"and a.status='".$status."' ".
  			 "order by a.status desc,a.prefixpertanggungan,a.nopertanggungan ";
	//echo $sql;		
	
	$sqa =  "select e.kdproduk,f.jenispengajuan,a.approveho,".
      		 		"a.nomorsip,a.prefixpertanggungan,a.nopertanggungan,a.userrekam,c.namastatus,nvl(a.status,'0') status, nvl(a.metodebayar,'TRANSFER') metodebayar,".
      		    "a.kdklaim,b.namaklaim,to_char(a.tglpengajuan,'DD/MM/YYYY') tglmohon,to_char(a.tglpengajuan,'yyyymmdd') tglmulai, ".
      				"to_char(a.tglhitung,'DD/MM/YYYY') tglhitung, ".
    					"to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,e.kdvaluta,".
    					"to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, a.kdklaim,".
      		    "a.userptg,".
    					"a.useradlog ".
   				"from ".
      				"$DBUser.tabel_200_pertanggungan e, ".
    					"$DBUser.tabel_901_pengajuan_klaim a, ".
      				"$DBUser.tabel_500_penagih d,".
    					"$DBUser.tabel_902_kode_klaim b,".
      				"$DBUser.tabel_999_kode_status c, ".
					"$DBUser.tabel_907_data_kecelakaan f ".
  				"where ".
    				  $kim.
      				"a.kdklaim=b.kdklaim ".
      				"and a.prefixpertanggungan=e.prefixpertanggungan and a.nopertanggungan=e.nopertanggungan ".
      			  "and e.nopenagih=d.nopenagih ".
							//"and d.kdrayonpenagih='$kantor' ".
      			 	"and nvl(a.status,'0')=c.kdstatus and c.jenisstatus='KLAIM' ".
							"and nvl(a.klaimgroup,'0') in ('0','1','X') ".
							//"and e.kdproduk not in ('JSR1','JSR2','JSR3') ".
							//"and a.status='".$status."' ".
							"and ((a.kdkantorproses is null and d.kdrayonpenagih = '$kantor') or a.kdkantorproses='$kantor') ".
					"and a.prefixpertanggungan = f.prefixpertanggungan(+) and a.nopertanggungan = f.nopertanggungan(+) and a.kdklaim = f.kd_klaim(+) and a.tglpengajuan = f.tgl_pengajuan(+) ".
					"and not exists (select 1 from $DBUser.tabel_900_klaim_pusat where prefixpertanggungan=a.prefixpertanggungan ".
					"and nopertanggungan=a.nopertanggungan and kdklaim=a.kdklaim and tglpengajuan=a.tglpengajuan and (kurs is not null and kurs >1))".
  				"order by a.status,a.prefixpertanggungan,a.nopertanggungan ";

$sql = ($jns=='klaim') ? $sqa : $sql; 
//echo $jns;
//die;
$DB->parse($sql);
$DB->execute();
//echo $sql;
$i=1;
while ($arr=$DB->nextrow()) {
	if ($arr['JENISPENGAJUAN'] != '1' && ($arr['KDPRODUK'] == 'JSR1' || $arr['KDPRODUK'] == 'JSR2' || $arr['KDPRODUK'] == 'JSR3')) continue;
		
		$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
		include "../../includes/belang.php"; 
		$tglmohon = (strtoupper($jns)=='KLAIM') ? substr($arr["KDKLAIM"],0,1)." ".$arr["TGLMOHON"] : $arr["TGLMOHON"];
		$tglotorisasi = (!$arr["TGLOTORISASI"]=='') ? $arr["TGLOTORISASI"] : "<font color=red>-</font>";
		  print( "	<td class=verdana8blu align=\"center\" width=3%>$i</td>\n" );
		  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
		  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."&tglmohon=".$arr["TGLMOHON"]."','',550,300,1);\">".$PER->namapemegangpolis."</a></td>\n" );
		  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."&tglmohon=".$arr["TGLMOHON"]."','',550,300,1);\">".$PER->namatertanggung."</a></td>\n" );
		  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."&tglmohon=".$arr["TGLMOHON"]."','',550,300,1);\">".$PER->produk."</a></td>\n" );
		  print( "	<td class=verdana8blu align=\"center\">".$tglmohon."</td>\n" );
		  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLHITUNG"]."</td>\n" );
		  print( "	<td class=verdana8blu align=\"center\">".$tglotorisasi."</td>\n" );
		  print( "	<td class=verdana8blu align=\"left\">".$arr["USERREKAM"]."</td>\n" );
		  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLREKAM"]."</td>\n" );
			print( "	<td class=verdana8blu align=\"left\">".$arr["NAMASTATUS"]."</td>\n" );
		  //print( "	<td class=verdana8blu align=\"left\">".substr($arr["NAMASTATUS"],0,72)."</td>\n" );
		  $status=$arr["STATUS"];
			$prefix=$arr["PREFIXPERTANGGUNGAN"];
			$noper =$arr["NOPERTANGGUNGAN"];
			$kdklaim=$arr["KDKLAIM"];
			switch ($jenis) {
			case 'gadai':
			 switch ($status) {
			  case '0':
				 $lanjut = 'TUNGGU DESISI';
				 $cetaksip = '';
				 break;
			  case '1':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
			 $cetaksip = '';
				 break;
				case '2':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=G01GADAI&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
			 $cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip_gadai.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
			 break;
				case '3':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pelunasangadai.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
			 $cetaksip = '';
				 break;
			  case '4':
				 $lanjut = 'S E L E S A I';
				 $cetaksip = '';
				 break;	
				case '5':
				 $lanjut = 'LUNAS';
				 $cetaksip = '';
				 break;		 
			 }
			 break;
			case 'tebus':
			 switch ($status) {
			  case '0':
				 $lanjut = 'TUNGGU DESISI';
				 $cetaksip = '';
				 break;
			  case '1':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuantebus2.php?prefix=$prefix&noper=$noper&kdbayar=T01TEBUS')\">KLIK DISINI</a>";
			 $cetaksip = '';
				 break;
				case '2':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=T01TEBUS&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
			 $cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip_tebus.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
				 //$cetaksip .=  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP2</a>";
			 break;
				case '3':
				 $lanjut = 'TEBUS SELESAI';
			 $cetaksip = '';
				 break;
				case '4':
				 $lanjut = 'SELESAI';
			 $cetaksip = '';
				 break;
			 }
			 break;
			case 'pulih':
			 switch ($status) {
			  case '0':
				 $lanjut = 'TUNGGU DESISI';
				 $cetaksip = '';
				 break;
			  case '1':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?tglhitung=".$arr["TGLHITUNG"]."&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
			 $cetaksip = '';
				 break;
				case '2':
				 $lanjut = 'TUNGGU SPP';
			 $cetaksip = '';
				 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
			 break;
				case '3':
				 $lanjut = 'SPP TERBIT';
			 $cetaksip = '';
				 break;
				
				// todak tahu proses selanjutnya --> ini untuk sementara benar apa salah
				case '4':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
			 $cetaksip = '';
				 break;
				case '5':
				 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
			 $cetaksip = '';
				 break;
				 
				default:
				 $lanjut = 'P E N D I N G';
			 $cetaksip = '';
				 break;
			 }
			 break;
			 
			 case 'klaim':
			 switch ($status) {
			  case '0':
				 $lanjut = 'TUNGGU DESISI';
				 $cetaksip = '';
				 break;
			  case '1':
				 if(substr($PER->produk,0,2)=="PA")
				 {
				   $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/prosesklaim_akdp.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=".$arr["TGLMOHON"]."')\">KLIK DISINI (AKDP)</a>";
			 }
				 else
				 {
				   if (($arr['APPROVEHO'] != '1' && ($arr['KDPRODUK'] != 'JSR1' && $arr['KDPRODUK'] != 'JSR2' && $arr['KDPRODUK'] != 'JSR3')) || ($arr['APPROVEHO'] == '1' && ($arr['KDPRODUK'] == 'JSR1' || $arr['KDPRODUK'] == 'JSR2' || $arr['KDPRODUK'] == 'JSR3'))){
					$include_list=array("AC","AE","AF","BI","MG","QB","QC","QD","QE");
					$include_klaim=array("ANUITAS","TAHAPAN","EXPIRASI","BEASISWA");
					$exclude_produk=array("ATP","DGI");
					if(in_array($kantor, $include_list) && in_array($kdklaim,$include_klaim) && $arr["KDVALUTA"]=='1' && !in_array($PER->produk,$exclude_produk) && $arr["METODEBAYAR"]=="TRANSFER"){
					//if(in_array($kantor, $include_list) && in_array($kdklaim,$include_klaim) && $arr["TGLMULAI"]>="20170306" && $arr["KDVALUTA"]=='1' && !in_array($PER->produk,$exclude_produk) && $arr["METODEBAYAR"]=="TRANSFER"){	
							$lanjut = "<a href=\"#\" onclick=\"NewWindow('../akunting/validasi_sip_klaim_cabang.php?kdsip=$kdklaim&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."&tglpengajuan=".$arr["TGLMOHON"]."','',700,400,1)\">VALIDASI PEMBAYARAN</a>";
						}else{
							$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=".$arr["TGLMOHON"]."')\">KLIK DISINI</a>";
						}
						
				 }else {
						$lanjut = "TUNGGU APPROVE HO";
				 }
			 }
				 $cetaksip = '';
				 break;
				case '2':
				$include_list=array("AC","AE","AF","BI","MG","QB","QC","QD","QE");
					$include_klaim=array("ANUITAS","TAHAPAN","EXPIRASI","BEASISWA");
					$exclude_produk=array("ATP","DGI");
					if(substr($PER->produk,0,2)=="PA")
				{
				   //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/bayar_akdp.php?kdklaim=".$arr["KDKLAIM"]."&prefix=$prefix&noper=$noper')\">KLIK DISINI (AKDP)</a>";
				   $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/bayar.php?kdklaim=".$arr["KDKLAIM"]."&prefix=$prefix&noper=$noper')\">KLIK DISINI (AKDP)</a>";
				}
				else
				{
				   //if(in_array($kantor, $include_list) && in_array($kdklaim,$include_klaim) && $arr["TGLMULAI"]>="20170306" && $arr["KDVALUTA"]=='1' && !in_array($PER->produk,$exclude_produk) && $arr["METODEBAYAR"]=="TRANSFER"){
				   if(in_array($kantor, $include_list) && in_array($kdklaim,$include_klaim) && $arr["KDVALUTA"]=='1' && !in_array($PER->produk,$exclude_produk) && $arr["METODEBAYAR"]=="TRANSFER"){
					   $lanjut="";
				   }else{
					   $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/bayar.php?kdklaim=".$arr["KDKLAIM"]."&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
				   }
				}
					
				// if($userid=="DEDI"){
				//	$cetaksip =  "<a href=# onclick=NewWindow('../akunting/validasi_sip_klaim_cabang.php?kdsip=$kdklaim&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."&tglpengajuan=".$arr["TGLMOHON"]."','',700,400,1)>VALIDASI PEMBAYARAN</a>";
				// }else{
					 //if(in_array($kantor, $include_list) && in_array($kdklaim,$include_klaim) && $arr["TGLMULAI"]>="20170306" && $arr["KDVALUTA"]=='1'  && !in_array($PER->produk,$exclude_produk) && $arr["METODEBAYAR"]=="TRANSFER"){
					 if(in_array($kantor, $include_list) && in_array($kdklaim,$include_klaim) && $arr["KDVALUTA"]=='1'  && !in_array($PER->produk,$exclude_produk) && $arr["METODEBAYAR"]=="TRANSFER"){
					  $cetaksip="";
				   }else{
					  $cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip_klaim.php?kdsip=$kdklaim&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."&tglpengajuan=".$arr["TGLMOHON"]."','',700,400,1)>CETAK SIP</a>";
				   }
				// }
			 //$cetaksip .=  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$kdklaim&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."&tglpengajuan=".$arr["TGLMOHON"]."','',700,400,1)>CETAK SIP 2</a>";

			 break;
				case '3':
				 $lanjut = 'KLAIM SELESAI';
			 $cetaksip = '';
				 break;
				} 
		 }	 	 
			print( "	<td class=verdana8blu align=\"left\">".$lanjut."</td>\n" );
		  print( "	<td class=verdana8blu align=\"left\">".$cetaksip."</td>\n" );
		  if($arr["KDKLAIM"]=="MENINGGAL" || $arr["KDKLAIM"]=="MENINGGALX" || $arr["KDKLAIM"]=="TEBUS"){
			  $hitung="select count(*) jmlrow from (SELECT   (SELECT   nama
						FROM   $DBUser.TABEL_802_KODEAKUN@GLLINK
					   WHERE   akun = a.akun)
						namaakun,
					 akun,
					 ket,
					 debet,
					 kredit
			  FROM   $DBUser.tabel_802_trvouc@GLLINK a
			 WHERE   SUBSTR (ket, 1, 11) = '$prefix$noper'
					 AND SUBSTR (notrans, 1, 1) = 'M'
					 AND SUBSTR (AKUN, 1, 1) IN (4,2)
					 and kdkantor='$kantor' and to_char(tgl_trans,'mm/yyyy')='".substr($tglotorisasi,5,7)."')";			 
		  }else{
			  $hitung="select count(*) jmlrow from (SELECT   (SELECT   nama
						FROM   $DBUser.TABEL_802_KODEAKUN@GLLINK
					   WHERE   akun = a.akun)
						namaakun,
					 akun,
					 ket,
					 debet,
					 kredit
			  FROM   $DBUser.tabel_802_trvouc@GLLINK a
			 WHERE   SUBSTR (ket, 1, 11) = '$prefix$noper'
					 AND SUBSTR (notrans, 1, 1) = 'M'
					 AND SUBSTR (AKUN, 1, 1) IN (4,2)
					 and kdkantor='$kantor' and to_char(tgl_trans,'mm/yyyy')='".substr($tglmohon,5,7)."')";			
		  }
		  
		  $hitung="SELECT count(*) JMLROW FROM $DBUser.TABEL_901_KLAIM_LOG WHERE PREFIXPERTANGGUNGAN='$prefix' and nopertanggungan='$noper' and kdklaim='".$arr["KDKLAIM"]."'";
					 //echo $hitung;
					 $DB2->parse($hitung);
					 $DB2->execute();
					 $arrjum=$DB2->nextrow();
					 $jmlrow=$arrjum["JMLROW"];
			
		  if (($arr["KDKLAIM"]=='TAHAPAN'||$arr["KDKLAIM"]=='EXPIRASI' || $jns=='tebus' ||$arr["KDKLAIM"]=='EXPIRASI' ||$arr["KDKLAIM"]=='ANUITAS' ||$arr["KDKLAIM"]=='BEASISWA' ||substr($arr["KDKLAIM"],0,9)=='MENINGGAL'||$arr['KDKLAIM']=='RAWATINAP') && $jmlrow>0){
		  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../akunting/memo_klaim_n.php?kdklaim=".$arr["KDKLAIM"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."&tglmohon=".$arr["TGLMOHON"]."','',750,300,1);\">CETAK MEMORIAL</a></td>\n" );
		  } 
		  else { 
		  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../akunting/create_memoklaim_n.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&kdklaim=".$arr["KDKLAIM"]."&tglgadai=".$arr["TGLHITUNG"]."&tglmohon=".$arr["TGLMOHON"]."&kdklaim=".$arr["KDKLAIM"]."','',750,300,1);window.location.reload();\">PROSES MEMORIAL</a></td>\n" ); 
		  }
		  
			print( " </tr>" ); //echo $jns;
		 $i++;
	
}			 
?>		  
			</table>
    </td>
   </tr>
</table>
<hr size="1">
<table width="1000">
  <tr>
    <td align="left"><a href="../akunting/mnuacc.php"><font face="Verdana" size="2">Menu Akunting</font></a></td>
		<!--<td width="50%" align="right"><a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a></td>-->
	</tr>
</table>

</td>
</tr>

</div>

</body>
</html>