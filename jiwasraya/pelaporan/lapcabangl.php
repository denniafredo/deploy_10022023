<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
  include "../../includes/pertanggungan.php"; 
  include "../../includes/kantor.php"; 
  include "../../includes/tgl.php"; 

  $DB = new Database($userid, $passwd, $DBName);
  $PWK= New Kantor($userid,$passwd,$kantor);
	$KT = New Kantor($userid,$passwd,$PWK->kdkantorinduk);
	$emailpengirim = $PWK->emailxlindo;
	$KP= New KantorPusat($userid,$passwd);
	
if ($submit) {

	$j=1; $k=1; $noprop = "(";
	for ($a=1; $a<=($m+$n); $a++) {
	 if (!$cb[$a]=='' && $medstat[$a]=='M') {
	  $isinm .=  $j."\t".$cb[$a]."\t\t".$pempol[$a]."\n";
		$noprop .= "'".$cb[$a]."',";
		$j++;
	 }
	 if (!$cb[$a]=='' && $medstat[$a]=='N') {
	  $isinn .=  $k."\t".$cb[$a]."\t\t".$pempol[$a]."\n";
		$noprop .= "'".$cb[$a]."',";
		$k++;
	 }	 
	}  
	$noprop = substr($noprop,0,-1).")";
	//echo $noprop;  
		
	   $mailn = $KT->emailxlindo;
				$isin .= "Kepada Yth.\nKEPALA BAGIAN PERTANGGUNGAN\n".$KT->namakantor."\ndi Tempat \n\n";
				$isin .= "Perihal : Permohonan Akseptasi \n\n";
		    $isin .= "Berikut ini kami sampaikan daftar proposal untuk \ndapat segera diproses akseptasinya, sebagai berikut :\n\n";
	 	    $isin .= "No.\tNomor Proposal \tNama Pemegang Polis\n";
        $isin .= "-----------------------------------------------\n";
	      $isin .= "$isinn";
				$isin .= "-----------------------------------------------\n\n";
	      $isin .= "Demikian kami sampaikan atas perhatiannya \nkami ucapkan terima kasih.\n\n\n";
			  $isin .= $PWK->kotamadya.", ".$tanggal."\n";
		    $isin .= "Kepala Perwakilan\n";
			  $isin .= $PWK->kepala;
  			mail($mailn,"Proposal Alert ($kantor/$tanggal)",$isin,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());	
		 $isin='';
		 $mailm = $KP->emailopr;
				$isin .= "Kepada Yth.\nKEPALA BAGIAN UNDERWRITING PERTANGGUNGAN PERORANGAN KANTOR PUSAT\ndi Tempat \n\n";
				$isin .= "Perihal : Permohonan Akseptasi Proposal Medical\n\n";
		    $isin .= "Berikut ini kami sampaikan daftar proposal untuk \ndapat segera diproses akseptasinya, sebagai berikut :\n\n";
	 	    $isin .= "No.\tNomor Proposal \tNama Pemegang Polis\n";
        $isin .= "-----------------------------------------------\n";
	      $isin .= "$isinm";
				$isin .= "-----------------------------------------------\n\n";
	      $isin .= "Demikian kami sampaikan atas perhatiannya \nkami ucapkan terima kasih.\n\n\n";
			  $isin .= $PWK->kotamadya.", ".$tanggal."\n";
		    $isin .= "Kepala Perwakilan\n";
			  $isin .= $PWK->kepala;
  			mail($mailm,"Proposal Alert ($kantor/$tanggal)",$isin,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());	
				
					 $sql   = "update $DBUser.tabel_200_pertanggungan set ".
	                  "kdstatusemail='1',tglsendemail=sysdate where nopertanggungan in $noprop and ".
							      "kdpertanggungan='1' and kdstatusemail is null";
           $DB->parse($sql);
           $DB->execute();	
				
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>
<div align="center">
<table width="80%" class="sans8" cellpadding="0" cellspacing="1" border="0" >
<tr><td colspan="2" align="center">Pengiriman Email Proposal Baru Kantor : <?echo $kantor;?> Tanggal <?echo $tanggal;?></td></tr>
<tr><td align="center">NON MEDICAL</td><td align="center">MEDICAL</td></tr>
<tr><td align="center">Tujuan <?echo $mailn;?></td><td align="center">Tujuan <?echo $mailm;?></td></tr>
<tr><td colspan="2" align="center"><hr size="1"></td></tr>
<tr valign="top"><td align="left"><pre><?echo $isinn;?></pre></td><td align="left"><pre><?echo $isinm;?></pre></td></tr>
</table>
<hr size="1">
<table width="100%">
<tr class="arial10">
 <td><a href="../mnuptgbaru.php">Menu Pertanggungan Baru</a></td>
 <td align="right"><a href="emailterkirim.php">Check Pengiriman Email</a></td>
</tr>
</table>
<?
} else { 
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript" type="text/javascript">
<!--
function set(n) 
{
   temp = document.xxx.elements.length  ;              
   for (i=0; i < temp; i++)	{   
	   document.xxx.elements[i].checked=n;
	 }
}
function ButonOK (theForm) {
   temp = theForm.elements.length  ;              
   for (i=0; i < temp; i++)	{   
	   if (theForm.elements[i].checked==true) {
		   theForm.submit.disabled=false;
		 } 
	 }
}
//-->
</script>
</head>
<? include "../../includes/hide.php";  ?>
<body onload="document.xxx.submit.disabled=true">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F5100</td></tr>
<tr><td class="arial10blk">PEMBERITAHUAN PROPOSAL MELALUI EMAIL</td></tr>
<tr><td class="arial10">Kantor : <?echo $kantor." ".$namakantor; ?></td></tr>
</table>

<hr size="1">
<form name="xxx" method="POST" action="<?echo $PHP_SELF;?>">

<table border="0" width="100%" cellspacing="1" cellpadding="0" class="tblisi">
  <tr class="hijao">
    <td  rowspan="2" align="center" width="2%">NO.</td>
    <td  rowspan="2" align="center" width="10%">NOMOR POLIS</td>
    <td  colspan="2" align="center" width="30%"><font color=green>N  A  M  A</td>
    <td  rowspan="2" align="center" width="3%"><font color=green>VAL</td>
    <td  align="center" width="10%"><font color=green>JUMLAH UANG</td>
    <td  align="center" width="3%"><font color=green>MACAM</td>
    <td  align="center" width="5%"><font color=green>MULAI</td>
    <td  align="center" width="2%"><font color=green>MASA</td>
    <td  rowspan="2" align="center" width="2%">STATUS MEDICAL</td>
		<td  rowspan="2" align="center" width="15%">PREMI DIBAYAR DALAM RUPIAH</td>
		<td  rowspan="2" align="center" width="3%"><a href="#" onclick="set(1)">CEK</a></td>
   </tr>
  <tr class="hijao">
    <td  align="center">PEMEGANG POLIS</td>
    <td  align="center">TERTANGGUNG</td>
		<td  align="center" colspan="4">A  S  U  R  A  N  S  I</td>
  </tr>
<?
		$sql= "select a.prefixpertanggungan,a.nopertanggungan,".
	        "a.kdstatusmedical,f.nilairp ".
					"from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi f ".
					"where a.kdstatusemail is null and a.nopertanggungan=f.nopertanggungan and ".
					"a.prefixpertanggungan=f.prefixpertanggungan and ".
        	"a.premi1 = f.premitagihan and f.kdkuitansi='BP3' and ".
					"a.premi1 != 0 and a.prefixpertanggungan='$kantor' and a.kdstatusmedical='N' and ".
					"a.kdpertanggungan='1' and a.userrekam='$userid' ".
	         "union ".
				  "select b.prefixpertanggungan,b.nopertanggungan,b.kdstatusmedical,0 ".
					"from $DBUser.tabel_200_pertanggungan b ".
          "where ".
					       "(select count(*) from $DBUser.tabel_212_dok_cek_uw c ".
                 "where c.kdstatusunderwriting='0' ".
                 "and c.prefixpertanggungan=b.prefixpertanggungan ".
                 "and c.nopertanggungan=b.nopertanggungan) = 0 ".
          "and b.prefixpertanggungan='$kantor' and b.kdstatusemail is null and ".
					"b.kdpertanggungan='1' ".
          "and (b.userrekam='$userid' or b.userrekam='$kantor) ".
					"order by nopertanggungan ";
//echo $sql;
	$DB->parse($sql);
	$DB->execute();

	$i = 1; $m=0; $n=0; 
	while($arr=$DB->nextrow()){
	 include "../../includes/belang.php";
	 $prefix=$arr["PREFIXPERTANGGUNGAN"];
	 $noper=$arr["NOPERTANGGUNGAN"];
	 $PER = New Pertanggungan ($userid,$passwd,$prefix,$noper);
	 if ($arr["KDSTATUSMEDICAL"]=='M') {
	  $statusmedical =  "<font color=blue><b>M" ;
		$m++;
	 } else {
	  $statusmedical =  "<font color=green><b>N"; 
		$n++;
	 }	
	 
	 $nilairp = ($arr["NILAIRP"]==0) ? '' : number_format($arr["NILAIRP"],2);
	 ?>
    <td class="arial8" align="center"><? echo $i;?></td>
    <td class="arial8" align="center"><a href="#" onclick="NewWindow('../akunting/kartupremi1.php?prefix=<?echo $prefix;?>&noper=<?echo $noper;?>','',700,500,1)"><? echo $PER->label; ?></a></td>
    <td class="arial8"><? echo $PER->namapemegangpolis; ?></td>
    <td class="arial8"><? echo $PER->namatertanggung; ?></td>
    <td class="arial8" align="center"><? echo $PER->notasi; ?></td>
    <td class="arial8" align="right"><? echo number_format($PER->jua,2); ?></td>
    <td class="arial8" align="center"><? echo $PER->produk; ?></td>
    <td class="arial8" align="center"><? echo $PER->mules; ?></td>
    <td class="arial8" align="center"><? echo $PER->lamaasuransi; ?></td>
    <td class="arial8" align="center"><? echo $statusmedical; ?></td>
    <td class="arial8" align="right"><? echo $nilairp; ?></td>
    <td class="arial8" align="center"><? echo "<input type=\"checkbox\" name=\"cb[$i]\" value=\"".$arr["NOPERTANGGUNGAN"]."\" onclick=\"ButonOK(document.xxx)\">".
		"<input type=\"hidden\" name=\"medstat[$i]\" value=\"".$PER->medstat."\">".
		"<input type=\"hidden\" name=\"pempol[$i]\" value=\"".$PER->namapemegangpolis."\">"; ?></td>
   </tr>
	 <? 
	 $i++;
	} 
	?>
	<!--------------------------------- end medical ----------------->
</table>

<table border="0" width="100%" cellspacing="1" cellpadding="2">
  <tr>
    <td align="right">
		<input type="hidden" name="m" value="<?echo $m;?>">
		<input type="hidden" name="n" value="<?echo $n;?>">
		<input type="submit" value="Kirim Email" name="submit">
		</td>
	</tr>
</table>
</form>

<hr size="1">
<table width="100%">
<tr class="arial10">
 <td><a href="../mnuptgbaru.php">Menu Pertanggungan Baru</a></td>
 <td align="right"><a href="emailterkirim.php">Check Pengiriman Email</a></td>
</tr>
</table>

<?}?>