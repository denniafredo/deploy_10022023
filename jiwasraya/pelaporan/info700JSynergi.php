<?
  include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/klien.php";
  include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";
  include "../../includes/kantor.php";

	$bln = (!$bl) ? $bln : '';
$DB = new database($userid, $passwd, $DBName);

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
<table >
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
			$awalth = 2000;
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
			//$jnsval = array(1=>'gadai','tebus','pulih','klaim');
			//$jnslab = array(1=>'Pinjaman Polis (Gadai)','Penebusan Polis','Pemulihan Pertanggungan','Klaim Asuransi');
			$jnsval = array(1=>'pulih');
			$jnslab = array(1=>'Pemulihan Pertanggungan');
	?>
  <tr>
    <td align="left" class="arial10" width="45%">Jenis Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="jns" onFocus="highlight(event)" class="c">
		 <?
		 //$jns = "pulih";
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
	<tr>
		<td colspan="3" width="100%" align="left"><input name="cari" value="Periksa Status" type="submit">
		</td>
	</tr>
	
</table>
<hr size="1">
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
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
			  <td align="center">Produk</td>
			  <td align="center">Tanggal<br>Pengajuan</td>
			  <td align="center">Tanggal<br>Perhitungan</td>
			  <td align="center">Tanggal<br>Otorisasi</td>
			  <td align="center">User <br>Rekam</td>
			  <td align="center">Tanggal<br>Rekam</td>
			  <td align="center">Status <br>Terakhir</td>
				<!--<td align="center">Proses<br>Berikut</td>-->
			 	<td align="center">Cetak<br>SIP / Surat-surat</td>
			 </tr>
      <?
	  $KTR=New kantor($userid,$passwd,$kantor);
	  
      $bl = (strlen($bl)==1) ? "0".$bl : $bl;
      $tglhitung = (strtoupper($jns)=='GADAI') ? "tglgadai" : "tglhitung";
      $kam = ($bl=='13') ? "to_char(a.tglmohon,'YYYY')='".$th."' and " : "to_char(a.tglmohon,'MMYYYY')='".$bl.$th."' and ";
      $kim = ($bl=='13') ? "to_char(a.tglpengajuan,'YYYY')='".$th."' and " : "to_char(a.tglpengajuan,'MMYYYY')='".$bl.$th."' and ";
      
      $sql = "select a.nomorsip,a.prefixpertanggungan,a.nopertanggungan,a.userrekam,b.namastatus,a.status, ".
      		 	 "to_char(a.tglmohon,'DD/MM/YYYY') tglmohon,to_char(a.".$tglhitung.",'DD/MM/YYYY') tglhitung,".
      			 "to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, ".
      		   "to_char(a.tglsip,'DD/MM/YYYY') tglsip ".
      			 "from ".
      			 "$DBUser.tabel_200_pertanggungan c, $DBUser.tabel_700_".strtolower($jns)." a,".
      			 "$DBUser.tabel_500_penagih d, $DBUser.tabel_999_kode_status b ".
      			 "where ".
      			 $kam.
      			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
      			 //"and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
				 "and c.kdproduk in ('JSR1','JSR2','JSR3','JSR4') ".
				 "and c.nopenagih=d.nopenagih and d.kdrayonpenagih ".
				 "in ( ".
				 " SELECT   kdkantor ".
				 "	FROM   $DBUser.TABEL_001_KANTOR ".
				 "	START WITH   KDKANTOR = '$kantor' ".
				 "  CONNECT BY   PRIOR KDKANTOR = KDKANTORINDUK ".
				 "  ) ".
      			 "and a.status=b.kdstatus and b.jenisstatus='".strtoupper($jns)."' ".
      			 "order by a.prefixpertanggungan,a.nopertanggungan ";
      	//echo $sql;		 
      $sqa =  "select ".
      					"a.prefixpertanggungan,a.nopertanggungan,a.userrekam,c.namastatus,nvl(a.status,'0') status, ".
        		    "a.kdklaim,b.namaklaim,to_char(a.tglpengajuan,'DD/MM/YYYY') tglmohon, ".
        				"to_char(a.tglhitung,'DD/MM/YYYY') tglhitung, ".
         				"to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,".
      					"to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, ".
      					"a.userptg,".
        				"a.useradlog ".
       				"from ".
        				"$DBUser.tabel_200_pertanggungan e, $DBUser.tabel_901_pengajuan_klaim a, ".
        				"$DBUser.tabel_500_penagih d,$DBUser.tabel_902_kode_klaim b,".
        				"$DBUser.tabel_999_kode_status c ".
      				"where ".
      				  $kim.
        				"a.kdklaim=b.kdklaim and ".
        				"a.prefixpertanggungan=e.prefixpertanggungan and a.nopertanggungan=e.nopertanggungan ".
        			  "and e.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
        			 	"and nvl(a.status,'0')=c.kdstatus and c.jenisstatus='KLAIM' ".
								"and nvl(a.klaimgroup,'0')='0' ".
      				"order by a.prefixpertanggungan,a.nopertanggungan ";
      
      $sql = ($jns=='klaim') ? $sqa : $sql; 
      $DB->parse($sql);
      $DB->execute();
      //echo $sql;
      $i=1;
      while ($arr=$DB->nextrow()) {
      $PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
      include "../../includes/belang.php"; 
      $tglmohon = (strtoupper($jns)=='KLAIM') ? substr($arr["KDKLAIM"],0,1)." ".$arr["TGLMOHON"] : $arr["TGLMOHON"];
      $tglotorisasi = (!$arr["TGLOTORISASI"]=='') ? $arr["TGLOTORISASI"] : "<font color=red>-</font>";
        print( "	<td class=verdana8blu align=\"center\" width=3%>$i</td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">&nbsp;".$PER->namapemegangpolis."</a></td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">&nbsp;".$PER->namatertanggung."</a></td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">".$PER->produk."</a></td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$tglmohon."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$arr["TGLHITUNG"]."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$tglotorisasi."</td>\n" );
        print( "	<td class=verdana8blu align=\"left\">".$arr["USERREKAM"]."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$arr["TGLREKAM"]."</td>\n" );
      	print( "	<td class=verdana8blu align=\"left\">".$arr["NAMASTATUS"]."</td>\n" );
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
      		 //$cetaksip = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2_ptg.php?prefix=$prefix&noper=$noper&kdbayar=G01GADAI')\">Cetak Surat Penyataan, Akta, Ijin Gadai</a>";
      		 break;
      	  case '1':
      		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2_ptg.php?prefix=$prefix&noper=$noper&kdbayar=G01GADAI')\">Cetak Surat Penyataan, Akta, Ijin Gadai</a>";
      		 break;
      		case '2':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=G01GADAI&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip =  "SIAP";
        	 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
        	 break;
      		case '3':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pelunasangadai.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip = '';
      		 break;
      	  case '4':
      		 $lanjut = 'S E L E S A I';
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
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuantebus2.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuantebus2_ptg.php?prefix=$prefix&noper=$noper&kdbayar=G01GADAI')\">Cetak Desisi Tebus</a>";
      		 //$cetaksip = '';
      		 break;
      		case '2':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=T01TEBUS&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip =  "SIAP";
      		 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
        	 break;
      		case '3':
      		 $lanjut = 'TEBUS SELESAI';
        	 $cetaksip = '';
      		 break;
      	 }
      	 break;
      	case 'pulih':
		
      	 switch ($status) {
      	  case '0':
      		 //$lanjut = 'TUNGGU DESISI';
			 if ($KTR->jeniskantor=='KANTOR PERWAKILAN') {
      		 	$lanjutkan = "";} else {
      		 	$lanjutkan = "<a href=\"#\" onclick=\"window.location.replace('../mutasiDPBCLNT/aktifkanPolisPemulihan.php?prefixpertanggungan=$prefix&nopertanggungan=$noper')\">KLIK DISINI</a>";}
      		 $cetaksip ='';
      		 
      		 break;
      	  case '1':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip = "<a href=# onclick=NewWindow('../polis/cetakbatalrider.php?kdsip=$jenis&prefixpertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK KLAUSUL BATAL RIDER</a>";
			 $lanjutkan = "";
      		 break;
      		case '2':
      		 $lanjut = 'TUNGGU SPP';
        	 $cetaksip = '';
      		 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
			 $lanjutkan = "";
        	 break;
      		case '3':
      		 $lanjut = 'SPP TERBIT';
        	 $cetaksip = "<a href=# onclick=NewWindow('../polis/cetakbatalrider.php?kdsip=$jenis&prefixpertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK KLAUSUL BATAL RIDER</a>";
			 $lanjutkan = "";
      		 break;
      		default:
      		 $lanjut = 'P E N D I N G';
        	 $cetaksip = '';
			 $lanjutkan = "";
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
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=".$arr["TGLMOHON"]."')\">KLIK DISINI</a>";
        	 $cetaksip = '';
      		 break;
      		case '2':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/bayar.php?kdklaim=".$arr["KDKLAIM"]."&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip =  "SIAP";
      		 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
        	 break;
      		case '3':
      		 $lanjut = 'KLAIM SELESAI';
        	 $cetaksip = '';
      		 break;
      		} 
       }	 	 
      	//print( "	<td class=verdana8blu align=\"left\">".$lanjut."</td>\n" );
        print( "	<td class=verdana8blu align=\"left\">".$lanjutkan.$cetaksip."</td>\n" );
      	print( " </tr>" );
       $i++;
      }			 
      ?>		  
			</table>
    </td>
   </tr>
</table>

<table width="100%">
  <tr>
    <td width="50%" align="left"><a href="../polisserv.php"><font face="Verdana" size="2">Menu Pemeliharaan Polis</font></a></td>
		<td width="50%" align="right"><a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a></td>
	</tr>
</table>

</td>
</tr>

</div>

</body>
</html>