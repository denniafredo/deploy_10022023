<?  
  include "../../includes/database.php";
  include "../../includes/common.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
  include "../../includes/session.php";
	include "../../includes/duit.php";
	
	$DB=New database($userid, $passwd, $DBName);
  $DA=New database($userid, $passwd, $DBName);
	
if ($setuju=='Lanjut'){
	$risk = (is_null($risk)||strlen($risk)==0) ? 0 : $risk;
	  
	switch ($mode){
		case 'edit':
		 $sql="update $DBUser.tabel_200_temp set kdstatusmedical='M' ".
		      "where nopertanggungan='$noper' and prefixpertanggungan='$kantor' ";
		 $DB->parse($sql);
		 $DB->execute();
		 echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  	 //echo "window.opener.document.ntryprop.cekpolis.disabled=true;";
  	 echo "window.opener.document.ntryprop.buton.disabled=false;";
  	 echo "window.opener.document.ntryprop.risk.value=$risk;";
  	 echo "window.close();";
  	 echo "</script>";
		 break;
		 
		case 'baru':
	   echo "<script language=\"JavaScript\" type=\"text/javascript\">";
		 //echo "window.opener.document.ntryprop.cekpolis.disabled=true;";
		 echo "window.opener.document.ntryprop.buton.disabled=false;";
		 echo "window.opener.document.ntryprop.risk.value=$risk;";
  	 echo "window.close();";
		 echo "</script>";
		 break; 
	}	 

} else {
?>
<html><head><title>Daftar Polis </title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
 function Tutup(){
  this.window.close(); 
 }
</script>
<?	
	echo "<script language=\"JavaScript\" type=\"text/javascript\">";
	echo "function Setuju() {";
  //print( "alert (\"Premi Medical Harus Dihitung Ulang\");\n" );
	//echo "window.opener.document.ntryprop.kdstatusmedical.readOnly;";
	echo "window.opener.document.ntryprop.kdstatusmedical[0].checked=true;";
	echo "window.opener.document.ntryprop.buton.disabled=false;";

switch($premijua){
	case 'jua':
	echo "window.opener.document.ntryprop.submit.disabled=true;";
  break;
	case 'premi':
	  switch ($vara){
			case '0':
				echo "window.opener.document.ntryprop.submit.disabled=true;";
			break;
			case '1':
		  	echo "window.opener.document.ntryprop.submit.disabled=true;";
			break;
			case '2':
				echo "window.opener.document.ntryprop.submit.disabled=false;";
				echo "window.opener.document.ntryprop.cekpolis.disabled=false;";
			break;
		}		 
	break;
}	
	echo "window.opener.document.ntryprop.cekpolis.disabled=true;";
	echo "Tutup();";
	echo "}";
	echo "</script>";
	echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  print( "\n" );
	echo "function TidakSetuju () {";
	echo "alert(\"Edit Proposal\");";
  print( "\n" );
  echo "Tutup();";
  echo "}";
  print( "//-->\n" );
  echo "</script>";

  echo "</head><body topmargin=\"0\">";
	echo "<div align=center><br>";
	echo "<b><font face=\"Verdana\" size=\"2\">Daftar Polis yang dimiliki Oleh Tertanggung ".$tertanggung."</b></font><br>";
	$sql = "select to_char(sysdate,'DDMMYYYY') now from dual";
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();
	$tgl = $arr["NOW"];

 $sql = "select namaproduk,decode(substr(namaproduk,0,7),'ANUITAS',1,0) jnsprd ".
 			  "from $DBUser.tabel_202_produk where kdproduk='$kdproduk'";
 $DB->parse($sql);
 $DB->execute();
 $arr=$DB->nextrow();
 $namaproduk = $arr["NAMAPRODUK"];
 $jnsprd = $arr["JNSPRD"];
 
 $sql="select a.kdstatusfile,a.kdproduk,a.juamainproduk, a.prefixpertanggungan,a.nopertanggungan, ".
			 "a.kdstatusmedical,a.kdvaluta,b.namavaluta,b.notasi,to_char(to_date(a.mulas,'DD/MM/YY'),'DD-MM-YYYY') mulas ".
			 "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_304_valuta b ".
	     "where a.kdpertanggungan='2' and a.notertanggung='$tertanggung' and a.kdvaluta=b.kdvaluta ".
			 "order by a.mulas desc";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();

$KLN=New Klien($userid,$passwd,$tertanggung);
//echo "Nilai resiko : ".$KLN->nilairesiko;
?>
<form name="porm" action="<?echo $PHP_SELF;?>" method="post">
<input name="mode" type="hidden" value="<?echo $mode;?>">

<table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblborder">
 <tr>	
 <td class="tblisi">
	<table border="0" width="100%" cellpadding="1" cellspacing="1">
  <tr class="hijao">
    <td align="center" colspan="2">Nomor Polis</td>
    <td align="center" rowspan="2">Status</td>
    <td align="center" rowspan="2">Mulai</td>
    <td align="center" rowspan="2">Produk</td>
		<td align="center" rowspan="2">Valuta</td>
		<td align="center" rowspan="2">J U A </td>
		<td align="center" rowspan="2">Premi1</td>
		<td align="center" colspan="2">Kurs</td>
		<td align="center" rowspan="2">JUA Resiko (Rp)</td>
		<td align="center" rowspan="2">Med</td>
  	<td align="center" colspan="2">Nilai Tebus</td>
  </tr>
  <tr class="hijao">
    <td align="center" >Lama</td>
    <td align="center" >Baru</td>
    <td align="center" >Awal</td>
		<td align="center" >Skrg</td>
		<td align="center" >Dl Valuta</td>
  	<td align="center" >Rupiah</td>
  </tr>	
<?
	$i=0;$jml=0;
	
	while($arr=$DB->nextrow()) {
    include "../../includes/belang.php";
		$PER=New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
		$sql = "select $DBUser.polis.nilaitebus('".$arr["PREFIXPERTANGGUNGAN"]."','".$arr["NOPERTANGGUNGAN"]."','".$tgl."') ntebus from dual";
		//echo $sql;
		$DA->parse($sql);
		$DA->execute();
		$arx=$DA->nextrow();
		$nt = $arx["NTEBUS"];
		$TR = New Transaksi($userid,$passwd);
		$kurus = $TR->Kurs($PER->valuta);
		if ($arr["KDSTATUSFILE"]=='1') {
	   $ntrp = ($PER->valuta=='0')? $nt/$PER->indexawal * $kurus : $nt * $kurus;
		 $juarp = ($PER->valuta=='0')? $PER->jua/$PER->indexawal * $kurus : $PER->jua * $kurus;
		} else {
		 $ntrp=0;
		 $juarp=0;
		}
		$sql = "select faktorresiko from $DBUser.tabel_229_resiko_produk ".
				   "where kdproduk='".$PER->produk."' and kdvaluta='".$PER->valuta."' and ".
					 "usia=".$PER->usia." and masa=".$PER->lamapremi." and bk='*' ";
		//echo $sql."<br>";
	  $DA->parse($sql);
		$DA->execute();
		$arx=$DA->nextrow();
		$fakres = $arx["FAKTORRESIKO"];
		//echo KAMPRET.$fakres;
		$juarp = ($PER->kdcarabayar=='X') ? 0 : $juarp * $fakres / 1000;	
		$sta = ($PER->kdstatusfile=='1') ? "<font size=1 face=Verdana color=green>" :  "<font size=1 face=Verdana color=red>";		 
		$nm = ($PER->medstat=='M') ? "<font size=2 face=Verdana color=green><b>M" : "<font size=2 face=Verdana color=blue><b>N";  
		$a="<td class=verdana8 align=center>".$PER->nopol."</td>".
       "<td class=verdana8 align=center><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>".
		   "<td class=verdana8>$sta".$PER->namastatusfile."</td>".
       "<td class=verdana8 align=center>".$PER->mulas."</td>".
       "<td class=verdana8 align=center>".$PER->produk."</td>".
       "<td class=verdana8 align=center>".$PER->notasi."</td>".
       "<td class=verdana8 align=right>".number_format($PER->jua,2)."</td>".
       "<td class=verdana8 align=right>".number_format($PER->premi1,2)."</td>".
       "<td class=verdana8 align=right>".number_format($PER->indexawal,2)."</td>".
       "<td class=verdana8 align=right>".number_format($kurus,2)."</td>".
       "<td class=verdana8 align=right>".number_format($juarp,0)."</td>".
       "<td class=verdana8 align=center>".$nm."</td>".
       "<td class=verdana8 align=right>".number_format($nt,2)."</td>".
       "<td class=verdana8 align=right>".number_format($ntrp,0)."</td>".
       "</tr>";
	  echo($a);
		$jml +=$juarp;
		$jml1 +=$ntrp;
		$i++;	
	}
	
	
 
	$sql="select faktorresiko/1000 resiko ".
			 "from $DBUser.tabel_229_resiko_produk ".
			 "where kdproduk='$kdproduk' and kdvaluta='$kdvaluta' and usia=$usia and masa=$masa ";
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$fakrnow=($res["RESIKO"]==0) ? 1 : $res["RESIKO"];
/***********************************************************************************************/
	
	if ($fakrnow==1) {
	 //echo "<font color=red face=Verdana><b>FAKTOR RESIKO TIDAK ADA</b><br><font size=1>".$sql."<br>";
	}
	
	$sql = "select decode(meritalstatus,'K','B','B') bk ".
			   "from $DBUser.tabel_100_klien where noklien='$tertanggung'";
	
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
  $bk	=$res["BK"];
	
	$sql = "select kdbasispremi ".
				  "from $DBUser.tabel_246_produk_basis c where c.kdproduk='$kdproduk' ".
					"and c.kdvaluta='$kdvaluta' and c.kdproduk='$kdproduk' ".
					"and c.tglberlaku=(select max(tglberlaku) ".
					 "from $DBUser.tabel_246_produk_basis ".
				   "where kdproduk=c.kdproduk and kdvaluta=c.kdvaluta and ".
					 "tglberlaku <= to_date('$mulas','DD/MM/YYYY'))";
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$basis = $res["KDBASISPREMI"];
	
	$sql = "select kdjeniscb from $DBUser.tabel_305_cara_bayar where kdcarabayar='$cb'";
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$jnscb = $res["KDJENISCB"];
	

	if ($jnsprd) {					 
	 $sql = "SELECT $DBUser.tarif.an('$kdproduk','$kdvaluta','STD','$bk',$usia,$usiabl,'$jnscb','$basis')/1000 tarif ".
		  	  "FROM dual";
	} else {
	 $sql = "SELECT $DBUser.tarif.std('$kdproduk','$kdvaluta','STD',$masa,$usia,'$cb','$basis')/1000 tarif ".
		  	  "FROM dual";
	}			 
//echo $sql;

	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$tarifpremiskg=$res["TARIF"];

	$sql="select resikoawal from $DBUser.tabel_226_batas_resiko ".
			 "where $usia>=batasbawah and $usia<=batasatas ";
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$batasresiko=$res["RESIKOAWAL"];
		
		$sql="select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
	     	 "where tglkursberlaku<=sysdate and kdvaluta='$kdvaluta') ".
	     	 "and kdvaluta='$kdvaluta'";	
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$idx = $res["KURS"];
 
 $indexawal = ($indexawal==''||strlen($indexawal)==0) ? $idx : $indexawal;					 		
 $juadlrp=$jua*$indexawal; //jua dalam rupiah
 		
		
$sr   = $jml-$jml1;
$rskg = $fakrnow*$juadlrp;
$premiskg = (!$p1 == 0) ? $p1 : $tarifpremiskg*$juadlrp;			

//echo $kdvaluta."|".$jua."|".$indexawal."|".$tarifpremiskg."|".$premiskg."|".$juadlrp;
?>	
  <tr class="verdana10">
   <td colspan="9" align="right">Jumlah</td>
   <td align="right"><?echo number_format($jml,0);?></td>
   <td align="right" colspan="3"><?echo number_format($jml1,2);?></td>
  </tr>
 </table>
 </td>
 </tr>
 <tr>	
 <td class="tblisi1">
	<table border="0" width="100%" cellpadding="1" cellspacing="1" class="verdana9">
	<tr>
   <td align="left" width="20%">Selisih / Sisa Resiko (Rp)</td>
   <td align="right" width="1%">:</td>
   <td align="right" width="29%"><?echo number_format($sr,2);?></td>
   <td align="center" colspan="3"></td>
  </tr>
	<tr>
   <td align="left">Resiko Saat Ini (Rp)</td>
   <td align="right">:</td>
	 <? 
	 $hargaresiko=$rskg*$KLN->nilairesiko;
	 $resikoall=$rskg+$hargaresiko;
	 ?>
   <td align="right"><?echo number_format($rskg,2);?></td>
   <td align="center"><font color=blue>	<? $namasm = ($kdstatusmedical=='M') ? 'PROPOSAL MEDICAL' : 'PROPOSAL NON MEDICAL'; echo $namasm;?></td>
	</tr>	
	<tr>
   <td align="left">Jumlah Resiko (Rp)</td>
   <td align="right">:</td>
   <td align="right"><?echo number_format($sr+$rskg,2);?></td>
   <td align="center"></td>
	</tr>		
<?
 
 if ($cb=='X') {
 } else {
  $premiskg =  0 ;
 }
  $restot= ($jnsprd) ? $sr+$rskg+$premiskg : $sr+$rskg-$premiskg;
 
//echo $cb."|".$sr."|".$rskg."|".$restot;

if ($cb=='X') {
?>
	<tr>
   <td align="left">Premi Sekaligus (Rp)</td>
   <td align="right">:</td>
   <td align="right"><?echo number_format($premiskg,2);?></td>
   <td align="center"></td>
	</tr>	
	<tr>
   <td align="left">Resiko Total</td>
   <td align="right">:</td>
   <td align="right"><?echo number_format($restot,2);?></td>
   <td align="center"></td>
	</tr>
	<input type="hidden" name="risk" value="<?echo $restot;?>">
<?
 }	
 
 if ($kdstatusmedical=='N') {//nonmedical yang kepaksa jadi medical  
//echo $kdproduk;
	if ( ($restot > $batasresiko) && !($kdproduk == 'PAA' || $kdproduk == 'PAB') ) {
		$tombol=true; 
		$msg = "Proposal Harus Medical, Klik Lanjut Jika Setuju";
	} else {
		$tombol=false;
	  $msg =  "Klik Lanjut untuk melanjutkan ";
	}

 } else { // medical 
		$tombol=false;
	  $msg =  "Klik Lanjut untuk melanjutkan ";
 }	
?>
	
	<tr>
   <td align="left">Batas Resiko Medical</td>
   <td align="right">:</td>
   <td align="right"><?echo number_format($batasresiko,2);?></td>
   <td align="center" class="verdana9barak"><?echo $msg;?></td>
	</tr>	
 </table>
 </td>
 </tr>

 <td align="center" class="tblhead">
	<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr>
    <? if ($tombol) { ?>
		<td align="center"><input type="button" name="tidaksetuju" value="Edit" onclick="javascript:TidakSetuju()"></td>
    <td align="center"><input type="button" name="setuju" value="Setuju" onclick="javascript:Setuju()"></td>
 		<? } else { ?>
		<td align="center"><input type="submit" name="setuju" value="Lanjut"</td>
    <? } ?>		
  </tr>
 </table>
 </td>
 </tr>
</table>
</form>
</div>
</body>
</html>
<? } ?>		
