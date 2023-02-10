<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/kantor.php";
	include "../../includes/tanggal.php";

$DB=new Database($userid, $passwd, $DBName);
$KL = new Klien ($userid,$passwd,$nopenagih);
$namaklien1=stripslashes($namaklien1);
$namaklien1=($namaklien1=='') ? $KL->nama : $namaklien1;

?>
<html>
<head>
<title>Penagihan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript" type="text/javascript">

<!--
function CariNama (){
 var noklien=document.ntryclnthub.noklien.value;
 if (!noklien==''){
  window.open('../klien/carinama.php?noklien='+noklien+'','caripage','width=400,height=300,top=100,left=100,scrollbars=yes')
 }
}
//-->

function PilihPenagih() {
var kantorbaru = document.premitagih.kdkantor.value;
		NewWindow('poppenagih.php?kdkantor='+kantorbaru+'','popupcari',500,200,1);
}
</script>
</head>
<body>
<a class="verdana10blk"><b>INFO PREMI TAGIHAN NB/OB</b></a>
<hr size="1">
<? 
 if(!$nopenagih){
    $nomorpenagih="";
		$ambilpenagih="";
 } else {
    $nomorpenagih="Penagih $namaklien1";
		$ambilpenagih="b.nopenagih='$nopenagih' and ";
 }
 
				$ktrdepan=substr($kdkantor,0,1);
        $ktrblk=substr($kdkantor,-1);
 				if($ktrblk=="A"){
				  $judulkantor="$kdkantor REGIONAL OFFICE";
				  $pasangkantor="a.kdrayonpenagih like '$ktrdepan%' and ";
					$pasangpenagih="";
				} else if($ktrblk=="P") {
				  $judulkantor="HEAD OFFICE";
				  $pasangkantor="";
					$pasangpenagih="";
				} else {  
				  $judulkantor="$kdkantor BRANCH OFFICE";
				  $pasangkantor="a.kdrayonpenagih='$kdkantor' and ";
				  $pasangpenagih=$ambilpenagih;
				}
	
	$bln=substr($blnproses,0,2);
	$thn=substr($blnproses,-4);
						switch ($bln)	{
		          case "01": $blnn = "Januari"; break;
	            case "02": $blnn = "Pebruari"; break;
	            case "03": $blnn = "Maret"; break;
		          case "04": $blnn = "April"; break;
		          case "05": $blnn = "Mei"; break;
		          case "06": $blnn = "Juni"; break;
		          case "07": $blnn = "Juli"; break;
		          case "08": $blnn = "Agustus"; break;
		          case "09": $blnn = "September"; break;
		          case "10": $blnn = "Oktober"; break;
		          case "11": $blnn = "Nopember"; break;
		          case "12": $blnn = "Desember"; break;
           }
 ?>
<div align="center">
<table cellpadding="1" cellspacing="1" width="100%" border="0">
<form method="POST" name="premitagih" action="<? echo $PHP_SELF;?>">
  <tr>
    <td width="100%">
<table cellpadding="1" cellspacing="1" border="0">
	<tr>
    <td align="left" class="verdana10blk">Kode Kantor</td>
		<td>:</td>
		<td><input class="a" type="text" name="kdkantor" size="3" maxlength="2" value="<? echo $kdkantor; ?>"  onChange="javascript:this.value=this.value.toUpperCase();"></td>
	</tr>
		<tr>
    <td align="left" class="verdana10blk">Nomor Penagih</td>
		<td>:</td>
		<td class="verdana10blk"><input class="a" type="text" name="nopenagih" size="10" maxlength="10"  value="<? echo $nopenagih;?>">
		<a href="#" onclick="PilihPenagih()"><img src="../img/jswindow.gif" alt="Daftar Klien" border="0"></a>
		(Jangan diisi jika mencari premi seluruh penagih)
		</td>
	</tr>
	<tr>
    <td align="left" class="verdana10blk">Bulan (MMYYYY)</td>
		<td>:</td>
		<td><input class="a" type="text" name="blnproses" size="8" maxlength="6" value="<? echo $blnproses; ?>">
		<input name="buton" type="submit" value="Submit" class="buton">
		</td>
	</tr>
</table>
		</td>
  </tr>
	<tr class="tblhead">
    <td width="100%" align="center" class="arial12whtb">JUMLAH PREMI TAGIHAN <? echo $judulkantor; ?></td>
  </tr>
	<tr class="tblhead1">
    <td width="100%" align="center" class="arial10wht"><? echo $nomorpenagih; ?> Bulan  <? echo $blnn." ".$thn; ?></td>
  </tr>
	<tr class="tblhead">
	 <td>
<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi1">
	<?
	$penagih = array();
	$kdcarabayar=array(0=>'1','2','3','4');
  $namacarabayar=array(0=>'BULANAN','KWARTALAN','SEMESTERAN','TAHUNAN');
	$kdkuitansi=array(0=>'NB','OB');
	$kdvaluta = array(0=>'0','1','3');
	
	//if (!$noklien=='') {
	// $penagih = $noklien;			 	
	  print( "<tr class=hijao>\n" );
	  for ($b=0; $b<count($kdkuitansi); $b++) {
	   print( " <td align=center>Kuitansi <b>".$kdkuitansi[$b]."</td>\n" );
    }
		print( "</tr>\n" );
		for ($c=0; $c<count($kdcarabayar); $c++) {
		 print( "<tr>\n" );
     for ($b=0; $b<count($kdkuitansi); $b++) {
	    print( " <td ><table width=100% border=0 class=tblisi cellspacing=1 cellpadding=1>");
			print( "   <tr>\n" );
	  	print( "    <td class=verdana10><b>".$namacarabayar[$c]."</td>" );
    	$notasi = array(0=>'Rp(I)','Rp','US$');
			 for ($e=0; $e<count($notasi); $e++) {
				   print( " <td  align=center class=verdana10>$notasi[$e]</td>" );
    	 }
			print( "   </tr>\n" );
	  	print( "   <tr>\n" );
	  	print( "    <td></td>\n" );
     	 for ($d=0; $d<count($kdvaluta); $d++) {

			  $sql ="select sum(premitagihan) res ".
			   		  "from ".
										"$DBUser.tabel_300_bontagihan b, ".
										"$DBUser.tabel_500_penagih a ".
				 			"where ".
				 						 "b.kdkuitansi like '$kdkuitansi[$b]%' and ".
										 "b.tglbooked <= trunc(sysdate) and ".
				 						 "decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4') = ".
										 "'$kdcarabayar[$c]' and ".
										 "a.nopenagih=b.nopenagih and ".
										 "$pasangpenagih".
										 "$pasangkantor".
										 "b.kdvaluta='$kdvaluta[$d]'  and ".
										 "to_char(b.tglbooked,'MMYYYY')='$blnproses' ";
				 //echo $sql;
		   	 //die;
         $DB->parse($sql);
			 	 $DB->execute();
			 	 $res=$DB->nextrow();		

				 
				 $jml = ($res["RES"]==0) ? "0" : "<a href=\"#\" onclick=\"NewWindow('detilinfotagihan.php?np=$nopenagih&kwt=$kdkuitansi[$b]&val=$kdvaluta[$d]&cb=$kdcarabayar[$c]&tglproses=$blnproses&bln=$bln&thn=$thn&namapenagih=$namaklien1&kdkantor=$kdkantor','detiltagihan',800,400,1)\">".number_format($res["RES"],2)."</a>";
				 print( "    <td class=verdana10blk width=25% align=center><b>$jml</td>\n" );
        }
		  print( "   </tr>\n" );
	  	print( "   </table>");
			print( " </td>\n" );
	  	}
		 print( "</tr>\n" );
	   }
	// } 	 	 
?>
	</td>
 </tr>		
</table>
  </td>
	</tr>
	<tr class="tblborder">
	 <td class="arial10wht">
	  Klik Jumlah Untuk Melihat List Polis Jatuh Tempo
	 </td>
	</tr>
</form>
</table>
</div>
<hr size="1">
<a href="index.php" class="verdana10blk">Menu Pelaporan</a>
</body>
</html>
