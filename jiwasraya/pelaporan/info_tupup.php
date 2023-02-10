<?
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";

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
<?
if(isset($idel)){

if ($jns=='topup'){
$sqled = "delete $DBUser.tabel_223_transaksi_topup a where ".
      			 "a.prefixpertanggungan='$pfx' and a.nopertanggungan='$noptg' and TO_CHAR(TGLMUTASI,'DDMMYYYYHHMMSS')='$idel' ";
} else {
$sqled = "delete $DBUser.tabel_223_transaksi_switchfund a where ".
      			 "a.prefixpertanggungan='$pfx' and a.nopertanggungan='$noptg' and TO_CHAR(TGLPENGAJUAN,'DDMMYYYY')='$idel' ";
}
//echo $sqled;
	$DB->parse($sqled);
    $DB->execute();		
	$jns="topup";		 
};
?>

<table >
  <tr>
    <td align="center" class="arial10blk"><b>PENGECEKAN STATUS TOP UP SEKALIGUS KANTOR <? echo $kantor; ?></td>
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
			$jnsval = array(1=>'topup','sfund');
			$jnslab = array(1=>'Transaksi Top Up','Switching Fund');
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
			  <td align="center">Produk</td>
			  <td align="center">Tanggal<br>Pengajuan</td>
			  <td align="center">User<br>Entry</td>
			  <td align="center">Jumlah</td>
			  <td align="center">Tanggal<br>Transfer</td>
			  <td align="center">Status <br>Terakhir</td>
			  <td align="center">User <br>Aksep</td>
			  <td align="center">Tanggal<br>Aksep</td>
			  
				<!--<td align="center">Proses<br>Berikut</td>-->
			 	<td align="center">Action</td>
			 </tr>
      <?
      $bl = (strlen($bl)==1) ? "0".$bl : $bl;
      $tglhitung = (strtoupper($jns)=='GADAI') ? "tglgadai" : "tglhitung";
      $kam = ($bl=='13') ? "to_char(a.tglpengajuan,'YYYY')='".$th."' and " : "to_char(a.tglpengajuan,'MMYYYY')='".$bl.$th."' and ";
      $kim = ($bl=='13') ? "to_char(a.tglmutasi,'YYYY')='".$th."' and " : "to_char(a.tglmutasi,'MMYYYY')='".$bl.$th."' and ";
      if ($jns=='topup'){
      $sql = "select a.*, NVL(STATUS,0) AS STATUS, TO_CHAR(TGLMUTASI,'DDMMYYYYHHMMSS') AS TGLMUTASIDETIL ".
      			 "from ".
      			 "$DBUser.tabel_200_pertanggungan c, $DBUser.tabel_223_transaksi_topup a,".
      			 "$DBUser.tabel_500_penagih d ".
      			 "where ".
				 $kim.
      			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
      			 "and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
      			 "order by a.prefixpertanggungan,a.nopertanggungan ";
		} else {
		$sql="select a.*, NVL(STATUS,0) AS STATUS, TO_CHAR(TGLPENGAJUAN,'DD/MM/YYYY') AS TGLMUTASI,". 			"TO_CHAR(TGLPENGAJUAN,'DDMMYYYY') AS TGLMUTASIDETIL ".
      			 "from ".
      			 "$DBUser.tabel_200_pertanggungan c, $DBUser.TABEL_223_TRANSAKSI_SWITCHFUND a,".
      			 "$DBUser.tabel_500_penagih d ".
      			 "where ".
				 $kam.
      			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
      			 "and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
      			 "order by a.prefixpertanggungan,a.nopertanggungan ";
		};
      	//echo $sql;	 
     /* $sqa =  "select ".
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
      				"order by a.prefixpertanggungan,a.nopertanggungan ";*/
      
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
        //print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">".$PER->produk."</a></td>\n" );
		
		if ($jns=='topup'){
		print( "	<td class=verdana8blu align=\"center\">".$PER->produk."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$arr["TGLMUTASI"]."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$arr["USERMUTASI"]."</td>\n" );
		} else {
		print( "	<td class=verdana8blu align=\"center\">".$PER->produk." -> ".$arr["KDPRODUKNEW"]."</td>\n" );
		print( "	<td class=verdana8blu align=\"center\">".$arr["TGLUPDATED"]."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$arr["USERUPDATED"]."</td>\n" );
		}
        print( "	<td class=verdana8blu align=\"center\">".number_format($arr["PREMI"],2)."</td>\n" );
		print( "	<td class=verdana8blu align=\"center\">".$arr["TGLTRANSFER"]."</td>\n" );
        if ($arr["STATUS"]==0){
		$sts='SUBMIT';
//		$sts='BARU DIENTRY OLEH BO';
		}
		elseif ($arr["STATUS"]==1){
		$sts='ACCEPTED';
//		$sts='TELAH DIAKSEPTASI OLEH HO';
		}
		elseif ($arr["STATUS"]==2){
			if ($jns=='topup'){
			$sts='GOOD FUND';} else {
			$sts='SENT to CUSTODY';}
//		$sts='TELAH DIAKSEPTASI OLEH HO';
		}
		elseif ($arr["STATUS"]==3){
		$sts='(GOOD FUND) Cetak Klausul';
//		$sts='TELAH DIAKSEPTASI OLEH HO';
		};		
		
		 if ($jns=='topup'){
		print( "	<td class=verdana8blu align=\"left\">".$sts."</td>\n" );
		print( "	<td class=verdana8blu align=\"left\">".$arr["USERUPDATED"]."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$arr["TGLUPDATED"]."</td>\n" );
      	} else {
		print( "	<td class=verdana8blu align=\"center\">");
		?>
				<a href="#" onClick="window.open('../polis/cetakklausul_swithfund.php?prefixpertanggungan=<?=$arr["PREFIXPERTANGGUNGAN"];?>&nopertanggungan=<?=$arr["NOPERTANGGUNGAN"];?>&kt=<?=$kota;?>&ket=<?=$arr["KETERANGAN"];?>&tglpkaj=<?=$tglpkaj;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<font face="Arial" size="2"><?=$sts;?></font></a>

		<?
		print ("</td>\n" );
		print( "	<td class=verdana8blu align=\"left\">".$arr["USERAKSEP"]."</td>\n" );
        print( "	<td class=verdana8blu align=\"center\">".$arr["TGLAKSEP"]."</td>\n" );
		}
		if ($arr["STATUS"]!='0'){
  				 	 print( "	<td class=verdana8blu align=\"left\">".$arr["NAMASTATUS"]."</td>\n" );}
				else{
  					 echo "<td align='center'><a href=info_tupup?pfx=".$arr["PREFIXPERTANGGUNGAN"]."&noptg=".$arr["NOPERTANGGUNGAN"]."&idel=".$arr["TGLMUTASIDETIL"]."&jns=".$jns."><img border='0' src='../images/delete.gif' width='16' height='16' alt='Delete'></a></td>";
				}
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