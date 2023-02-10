<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
  $DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
			
  
  function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;

  //MONTH
  echo "<select name=month>\n";
  $i=1;
  $CurrMonth=date("m");
  while ($i <= 12)
       {
  		 				switch($i)
  						{
  							  case 1: $namabulan = "JANUARI"; break;
  								case 2: $namabulan = "PEBRUARI"; break;
									case 3: $namabulan = "MARET"; break;
									case 4: $namabulan = "APRIL"; break;
									case 5: $namabulan = "MEI"; break;
									case 6: $namabulan = "JUNI"; break;
									case 7: $namabulan = "JULI"; break;
									case 8: $namabulan = "AGUSTUS"; break;
  								case 9: $namabulan = "SEPTEMBER"; break;
  								case 10: $namabulan = "OKTOBER"; break;
									case 11: $namabulan = "NOVEMBER"; break;
									case 12: $namabulan = "DESEMBER"; break;
  								default : $namabulan = $i;
  						}
  		 
        If(IsSet($month)) {
           If($month == $i || ($i == substr($month,1,1) && (substr($month,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulan\n";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan\n";
              }Else {
                 echo "<option value=$i>$namabulan\n";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan\n";
                }Else {
                   echo "<option value=$i selected>$namabulan\n";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan\n";
  							}Else {
                   echo "<option value=$i>$namabulan\n";
                }
              }
              $i++;
        }
  }
   echo "<option value=all ".($month=="all" ? "selected" : "").">--ALL--</option>";
	echo "</select>\n";
  
  //YEAR
    echo "<select name=year>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $year) {
                 echo "<option selected> $i\n";
              }ElseIf ($i == $CurrYear && !IsSet($year)) {
                 echo "<option selected> $i\n";
              }Else {
                 echo "<option> $i\n";
              }
              $i++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
              $CurrYear++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
              $i++;
             }
         echo "</select>\n";
    }
  }
?>
<script language="JavaScript"> 
function Cekbok(doc){ 
 if (doc == true)
 {
 checkedAll('getpremi', true);
 }
 else
 {
 checkedAll('getpremi', false);
 }
} 
</script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Admin Titipan Premi</title>
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
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:1px; }
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

#filterbox{
  border: solid 1px #c0c0c0;
	padding : 5px;
	width:100%;
	margin : 0 0 10px 0;
}
form{
  margin : 0;
	padding : 0;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>

<body topmargin="10">
<? //include "./menu.php"; ?></br></br>
<div id="filterbox">



<form action="<?=$PHP_SELF;?>" method="post" enctype="multipart/form-data" name="getcal">
<?
if(isset($metodeproses)){
	$metode=$metodeproses;
}
?>
<table>
<tr>
<td>
	Bulan Proses : <?  ShowFromDate(10,"Past"); ?> <td colspan="2"><input type="submit" name="submit" value="Cari"> </td>
</tr>
        
</table>
</form>

</div>
<? 
if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	} else{
  	$tglcari	=	 ( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
  					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
  					$_POST['dthn'];
	$tglcari = $tglcari;
	}


  ?>
<br />
<hr />
<?
if(isset($addTitipanPremi)){
	$sqladd="insert into $DBUser.tabel_309_premititipan (prefixpertanggungan,nopertanggungan,tglbayar,tglseatledtitipan,premititipan,premititipansisa,norekva,status,tglrekam,userrekam,kantorproses)
		  values('$prefixpert','$nopert',to_date('$tglbayar','dd/mm/yyyy'),trunc(sysdate),'$premititipan','$premititipan','$buktibayar','0',sysdate,user,'$kantor')";
	 //echo $sql."<br>";
	 $DB->parse($sqladd);
     $DB->execute();
	$tglcari=$tglcariadd;
	$metode=$metodeproses;
}

if(isset($approvetitipanpremi)){
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					//echo $dear;
					$ket = explode('#',$dear);	
					$sqlappu="update $DBUser.tabel_309_premititipan set status='1' where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]'";
					echo $sql."<br>";
					$DB->parse($sqlappu);
					$DB->execute();					
					 }
					}
	$tglcari=$tglcariadd;
	$metode=$metodeproses;
}



if(isset($postingtitipanpremi)){
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					//echo $dear;
					$ket = explode('#',$dear);	
					$sqlappu="update $DBUser.tabel_309_premititipan set status='2',status_gllink='1',tgl_gllink=sysdate where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]'";
					echo $sql."<br>";
					$DB->parse($sqlappu);
					$DB->execute();					
					 }
					}
	$tglcari=$tglcariadd;
	$metode=$metodeproses;
}

if(isset($prosespendapatan)){
	//echo "pendapatanlain2";
	
	//$arr["KDKANTOR"]."/".$tglcari."/".$arr["PREFIXPERTANGGUNGAN"]."/".$arr["NOPERTANGGUNGAN"]."/".$arr["PREMITITIPAN"]
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					echo $dear;
					$ket = explode('#',$dear);					
					$sql1="insert into $DBUser.TABEL_309_PREMITITIPAN_TRANS (kdkantor,prefixpertanggungan,nopertanggungan,tglseatledtitipan,tgltrans,premititipan,kdtransaksi,saldo,dk,userrekam,tglrekam,status_gllink,status) ".
						  " values('$kantor','$ket[1]','$ket[2]',to_date('$ket[6]','dd/mm/yyyy'),trunc(sysdate),'$ket[3]','1','$ket[4]' ,'D',user,sysdate,'0','0')";						  
						  //echo $sql1."<br>";
					$DB->parse($sql1);
					$DB->execute();
					$sqlupdate="update $DBUser.tabel_309_premititipan set status_pendapatan='1' where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]'";
					//echo $sqlupdate;
					$DB1->parse($sqlupdate);					
					$DB1->execute();
					 }
					}							

$tglcari=$tglcaripend;
$metode=$metodeproses;
} 

if(isset($approvependapatan)){
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					//echo $dear;
					$ket = explode('#',$dear);	
					$sqlappu="update $DBUser.TABEL_309_PREMITITIPAN_TRANS set status='1' where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]' and kdtransaksi='1'";
					//echo $sqlappu."<br>";
					$DB->parse($sqlappu);
					$DB->execute();					
					 }
					}
	$tglcari=$tglcaripend;
	$metode=$metodeproses;
}

if(isset($postpendapatan)){
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					//echo $dear;
					$ket = explode('#',$dear);	
					$sqlpost="update $DBUser.TABEL_309_PREMITITIPAN_TRANS set status_gllink='1',tgl_gllink=sysdate where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]' and kdtransaksi='1'";
					echo $sqlpost."<br>";
					$DB->parse($sqlpost);
					$DB->execute();					
					 }
					}
	$tglcari=$tglcaripend;
	$metode=$metodeproses;
}

if(isset($prosesretur)){
	//echo "pendapatanlain2";
	
	//$arr["KDKANTOR"]."/".$tglcari."/".$arr["PREFIXPERTANGGUNGAN"]."/".$arr["NOPERTANGGUNGAN"]."/".$arr["PREMITITIPAN"]
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					//echo $dear;
					$ket = explode('#',$dear);					
					$sql1="insert into $DBUser.TABEL_309_PREMITITIPAN_TRANS (kdkantor,prefixpertanggungan,nopertanggungan,tglseatledtitipan,tgltrans,premititipan,kdtransaksi,saldo,dk,userrekam,tglrekam,status_gllink,status) ".
						  " values('$kantor','$ket[1]','$ket[2]',to_date('$ket[6]','dd/mm/yyyy'),trunc(sysdate),'$ket[3]','3','$ket[4]' ,'D',user,sysdate,'0','0')";					  
						  echo $sql1."<br>";
					$DB->parse($sql1);
					$DB->execute();
					$sqlupdate="update $DBUser.tabel_309_premititipan set status_retur='1' where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]'";
					//echo $sqlupdate;
					$DB1->parse($sqlupdate);					
					$DB1->execute();
					 }
					}							

$tglcari=$tglcariretur;
$metode=$metodeproses;
} 

if(isset($approveretur)){
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					//echo $dear;
					$ket = explode('#',$dear);	
					$sqlappu="update $DBUser.TABEL_309_PREMITITIPAN_TRANS set status='1' where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]' and kdtransaksi='3'";
					echo $sqlappu."<br>";
					$DB->parse($sqlappu);
					$DB->execute();					
					 }
					}
	$tglcari=$tglcariretur;
	$metode=$metodeproses;
}

if(isset($postretur)){
	$box=$_POST['box1']; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {					
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					//echo $dear;
					$ket = explode('#',$dear);	
					$sqlpost="update $DBUser.TABEL_309_PREMITITIPAN_TRANS set status_gllink='1',tgl_gllink=sysdate where prefixpertanggungan='$ket[1]' and nopertanggungan='$ket[2]' and to_char(tglseatledtitipan,'dd/mm/yyyy')='$ket[6]' and kdtransaksi='3'";
					echo $sqlpost."<br>";
					$DB->parse($sqlpost);
					$DB->execute();					
					 }
					}
	$tglcari=$tglcariretur;
	$metode=$metodeproses;
}	
	
	
	
  
   	?>
<b>Detail Lampiran Neraca Titipan Premi <?=$month."/".$year;?></b>
  <? 

  
   	?>
<form method="POST" action="#" name="uploadtitipan">	<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center" rowspan="2">NO.</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">TGL. TRANSAKSI</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">KETERANGAN</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">AKUN</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">SALDO AWAL</td>
	<td bgcolor="#89acd8" align="center" colspan="2">MUTASI S/D BULAN LALU</td>
	<td bgcolor="#89acd8" align="center" colspan="2">MUTASI BULAN INI</td>
    <td bgcolor="#89acd8" align="center" colspan="2">MUTASI S/D BULAN INI</td>	
	<td bgcolor="#89acd8" align="center" rowspan="2">SALDO AKHIR</td>	
	<td bgcolor="#89acd8" align="center" rowspan="2">JENIS TRANSAKSI</td>	
  	</tr>
	<tr>
	<td bgcolor="#89acd8" align="center">DEBET</td>
	<td bgcolor="#89acd8" align="center">KREDIT</td>
	<td bgcolor="#89acd8" align="center">DEBET</td>
	<td bgcolor="#89acd8" align="center">KREDIT</td>
	<td bgcolor="#89acd8" align="center">DEBET</td>
	<td bgcolor="#89acd8" align="center">KREDIT</td>
	</tr>
	<?
	$bulancari = $year.$month;
	$sql = "SELECT   a.prefixpertanggungan,a.nopertanggungan,(select kdrayonpenagih from $DBUser.tabel_500_penagih x,$DBUser.tabel_200_pertanggungan y where prefixpertanggungan = a.prefixpertanggungan
                      AND nopertanggungan = a.nopertanggungan and x.nopenagih=y.nopenagih)kdkantor,
         (select namatransaksi from $DBUser.TABEL_309_KODE_TITIPAN_PREMI where kdtransaksi=a.kdtransaksi) transaksi,to_char(tgltrans,'dd/mm/yyyy')tgltransaksi,
         DECODE (
            kdtransaksi,
            '0',
            '241100000',
            '1',
            '721200000',
            '2',
            (SELECT   kdrekeninglawan
               FROM   $DBUser.tabel_300_historis_premi
              WHERE       prefixpertanggungan = a.prefixpertanggungan
                      AND nopertanggungan = a.nopertanggungan
                      AND tglbooked = a.tglbooked),
            '3',
            (select decode(kdvaluta,'1','341020000','341050000') from $DBUser.tabel_200_pertanggungan where prefixpertanggungan = a.prefixpertanggungan
                      AND nopertanggungan = a.nopertanggungan)
         )
            akun,
         0 la_debet,
         0 la_kredit,
         0 aw_debet,
         0 aw_kredit,
         DECODE (dk, 'D', premititipan, 0) mutasidebet,
         DECODE (dk, 'K', premititipan, 0) mutasikredit,
         0 + DECODE (dk, 'D', premititipan, 0) ak_debet,
         0 + DECODE (dk, 'K', premititipan, 0) ak_kredit          
  FROM   $DBUser.TABEL_309_PREMITITIPAN_TRANS a ".
   "  where TRUNC (tgltrans,'month') = TO_DATE ('$bulancari', 'yyyymm')";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?>.</td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLTRANSAKSI"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["AKUN"];?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["LA_KREDIT"]-$arr["LA_DEBET"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AW_DEBET"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AW_KREDIT"],2,",",".");?></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["MUTASIDEBET"],2,",",".");?></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["MUTASIKREDIT"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AK_DEBET"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AK_KREDIT"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AK_KREDIT"]-$arr["AK_DEBET"],2,",",".");?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TRANSAKSI"];?></td>
  </tr>
  <?
   $totsa+=$arr["LA_KREDIT"]-$arr["LA_DEBET"];
   $totawdebet+=$arr["AW_DEBET"];
   $totawkredit+=$arr["AW_KREDIT"];
   $totmudebet+=$arr["MUTASI_DEBET"];
   $totmukredit+=$arr["MUTASI_KREDIT"];
   $totakdebet+=$arr["AK_DEBET"];
   $totakkredit+=$arr["AK_KREDIT"];
   $totsak+=$arr["AK_KREDIT"]-$arr["AK_DEBET"];
	$i++;	}
	?>
	<tr bgcolor="#f5d79c">
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	</td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totsa,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totawdebet,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totawkredit,2,",",".");?></b></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totmudebet,2,",",".");?></b></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totmukredit,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totakdebet,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totakkredit,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format( $totsak,2,",",".");?></b></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
  </tr>

 </table> 	

</form>
<hr />
<a href="#" class="verdana8blu" onClick="NewWindow('../akunting/cetakslip_titipanpendapatan.php?tglseatled=<?=$tglcari; ?>&premititipan=<?=$totpremipend?>','Downloadexcel',600,250,1);">Cetak Detail Lampiran Neraca</a> 
<hr />

<br /><a href="../submenu.php?mnuinduk=600" class="verdana8blu">Menu Penagihan</a>
</body>
</html>