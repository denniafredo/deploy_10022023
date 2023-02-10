<?
include "../../includes/session.php";
include "../../includes/common.php";
include "../../includes/database.php";
include "../../includes/dropdown_date1.php";
include "../../includes/klien.php";
	include "../../includes/kantor.php";
	$DB=new database($userid, $passwd, $DBName);
	$DBS=new Database("CKADM","CKADM","CKADM");
	$CK=new Database("CKADM","CKADM","CKADM");
	$KL=new Klien($userid,$passwd,$nopenagih);
	$KTR=new Kantor($userid,$passwd,$kantor);
?>

<html>

<head>
<title>Sisa Tagihan</title>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

form{
padding:0px;
margin:0px;
}
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

h4{
padding: 0 0 5px 0;
margin:0;
}

.jarak {
clear:both;
height:1px;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript">
	 function GantiCari(theForm) {
			var np=theForm.nopenagih.value;
      window.location.replace('tagihan_penagih.php?nopenagih='+np+'#awaledit');
   }
    function cariThnProses(theForm) {
			var np=theForm.nopenagih.value;
			var year=theForm.year.value;
      window.location.replace('tagihan_penagih.php?nopenagih='+np+'&tahun='+year+'#awaledit');
   }
    function cariTglProses(theForm) {
			var np=theForm.nopenagih.value;
			var year=theForm.year.value;			
			var month=theForm.month.value;
      window.location.replace('tagihan_penagih.php?nopenagih='+np+'&tahun='+year+'&bulan='+month+'#awaledit');
   }
</script>
</head>

<?php		  
if ($_POST['cari']){
	$sql = "SELECT rowid kwt_rowid,kuitansi.premidasar,   
         kuitansi.premihitungan,   
         kuitansi.jmlpremi,   
         kuitansi.komisipng,   
         kuitansi.namacarabayar,   
         kuitansi.prefixpertanggungan,   
         kuitansi.kdpertanggungan,   
         kuitansi.notertanggung,   
         kuitansi.nosp,   
         kuitansi.nopol NOPOL,   
         kuitansi.nopertanggungan,   
         kuitansi.tglsp,   
         kuitansi.nobp3,   
         kuitansi.kdproduk,   
         kuitansi.mulas,   
         kuitansi.usia_th,   
         kuitansi.usia_bl,   
         kuitansi.expirasi,   
         kuitansi.lamaasuransi_th,   
         kuitansi.lamaasuransi_bl,   
         kuitansi.lamapembpremi_th,   
         kuitansi.lamapembpremi_bl,   
         kuitansi.kdvaluta,   
         kuitansi.namavaluta,   
         kuitansi.juamainproduk,   
         kuitansi.premi1,   
         kuitansi.kdcarabayar,   
         kuitansi.indexawal,   
         kuitansi.premi2,   
         kuitansi.nopenagih,   
         kuitansi.namapenagih,   
         kuitansi.kdstatusfile,   
         kuitansi.noagen,   
         kuitansi.namaagen,   
         kuitansi.kdstatusmedical,   
         kuitansi.nopemegangpolis,   
         kuitansi.nopembayarpremi,   
         kuitansi.tglnextbook,   
         kuitansi.tgllastpayment,   
         kuitansi.kdstatusemail,   
         kuitansi.kdkordinator,   
         kuitansi.gadaiotomatis,   
         kuitansi.tglakhirpremi,   
         kuitansi.namapemegangpolis,   
         kuitansi.premitagihan,   
         kuitansi.tglbooked,   
         kuitansi.kdrekeningpremi,   
         kuitansi.kdrekeninglawan,   
         kuitansi.alamatpemegangpolis,   
         kuitansi.alamattagih,   
         kuitansi.alamattagih2,   
         kuitansi.kdcabas,   
         kuitansi.alamat01,   
         kuitansi.alamat02,
         kuitansi.namakantor,   
         kuitansi.materai,   
         kuitansi.namakotamadya,   
         kuitansi.namapropinsi,   
         kuitansi.kdstatuspenagih,   
         kuitansi.kdrayonpenagih,   
         kuitansi.komisicb,   
         kuitansi.komisipenutup,   
         kuitansi.notasi,   
         kuitansi.kdkuitansi,   
         kuitansi.phone01,   
         kuitansi.phone02,   
         kuitansi.phone03,   
         kuitansi.phone04,   
         kuitansi.thnkomisi,   
         kuitansi.tglcetak,   
         kuitansi.tagihan,   
         kuitansi.status,   
         kuitansi.hp_rowid,
			kuitansi.autodebet 
FROM ckadm.kuitansi   
WHERE kuitansi.kdrayonpenagih IN ( SELECT kdkantor FROM ckadm.kantor
						  START WITH kdkantor='$kantor'
						  CONNECT BY PRIOR kdkantor=kdkantorinduk)
	AND kuitansi.tglbooked = TO_DATE('$bulan','MM/YYYY')
	AND kuitansi.kdkuitansi LIKE '%$kdkwt%'
	AND kuitansi.nopenagih LIKE '%$penagih'";
	echo $sql;
	$DBS->parse($sql);
	$DBS->execute();
	while($arr=$DBS->nextrow()){
		echo "<br>".$arr['NOPOL'];
		echo "<br>".$arr[0];
		echo "<br>".$arr[1];
		echo "<br>".$arr[2];
		echo "<br>".$arr[3];
		echo "<br>".$arr[4];
		echo "<br>".$arr[5];
		echo "<br>".$arr[6];
		}
}
?>



<? 

	?>
<body topmargin="10">
<form action="<?=$PHP_SELF;?>" name="cariwaktu" method="post">
  <table>			
<tr>

<td>
			Penagih</td>
<td><select name="penagih" id="penagih" onChange="GantiCari(document.cariwaktu)">
  <option value="">%</option>
  <? 
			$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
			$sql	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
      			 	"from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
      	     	"where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$kantor."' ".
      				 $pskg." ".
							 //"and nvl(a.penagihautodebet,'0')='0' ".
      				 " order by b.namaklien1";
			$DB->parse($sql);
           $DB->execute();
			while ($ro=$DB->nextrow())
  		{
			  echo "<option ";
  			if ($nopenagih==$ro["NOPENAGIH"]){ echo " selected"; }
  			echo " value=".$ro["NOPENAGIH"].">".$ro["NAMAKLIEN1"]."</option>";
			}
			?>
</select></td>

<td>Bulan</td>
<td><input name="bulan" type="text" id="bulan" size="8" maxlength="8"></td>

<td>Jenis Kuitansi</td>
<td><select name="kdkwt" id="kdkwt">
  <? 
			if($kdkuitansi=="NB"){
			  $vnb = "selected";
			} elseif($kdkuitansi=="OB") {
			  $vob = "selected";
			}
			?>
  <option value="all" selected>--All--</option>
  <option value="NB" <?=$vnb;?>>NB</option>
  <option value="OB" <?=$vob;?>>OB</option>
</select></td>

<td>
			<input type="submit" name="cari" value="SUBMIT"/></td>
</tr>
</table>

</form>
		  <hr size="1">
<?php
if ($_POST['cari']){
		while($arr=$DBS->nextrow()){
		echo "<br>".$arr['KWT_ROWID'];
		echo "<br>".$arr[1];
		echo "<br>".$arr[2];
		echo "<br>".$arr[3];
		echo "<br>".$arr[4];
		echo "<br>".$arr[5];
		echo "<br>".$arr[6];
		}
}
?>
		  <hr size="1">
		  <a href="../mainmenu.php">Menu Utama </a>
</body>
</html>