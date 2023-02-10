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
<b>Rekap Lampiran Neraca Titipan Premi <?=$month."/".$year;?></b>
  <? 

  
   	?>
<form method="POST" action="#" name="uploadtitipan">	<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center" rowspan="2">NO.</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">KETERANGAN</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">AKUN</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">SALDO AWAL</td>
	<td bgcolor="#89acd8" align="center" colspan="2">MUTASI S/D BULAN LALU</td>
	<td bgcolor="#89acd8" align="center" colspan="2">MUTASI BULAN INI</td>
    <td bgcolor="#89acd8" align="center" colspan="2">MUTASI S/D BULAN INI</td>	
	<td bgcolor="#89acd8" align="center" rowspan="2">SALDO AKHIR</td>	
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
	$sql = "select kdkantor,akun,la_kredit-la_debet saldoawal,aw_debet,aw_kredit,mutasi_debet,mutasi_kredit,ak_debet,ak_kredit,ak_kredit-ak_debet saldoakhir from  $DBUser.tabel_309_rekap_premititipan ".
		   " where TRUNC (tgl_trans,'month') = TO_DATE ('$bulancari', 'yyyymm')";
  $kantorcetak=$kantor1;

  //	echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?>.</td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">Kantor Cabang <?=$arr["KDKANTOR"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["AKUN"];?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["SALDOAWAL"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AW_DEBET"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AW_KREDIT"],2,",",".");?></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["MUTASI_DEBET"],2,",",".");?></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["MUTASI_KREDIT"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AK_DEBET"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["AK_KREDIT"],2,",",".");?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["SALDOAKHIR"],2,",",".");?></td>
  </tr>
  <?
   $totsa+=$arr["SALDOAWAL"];
   $totawdebet+=$arr["AW_DEBET"];
   $totawkredit+=$arr["AW_KREDIT"];
   $totmudebet+=$arr["MUTASI_DEBET"];
   $totmukredit+=$arr["MUTASI_KREDIT"];
   $totakdebet+=$arr["AK_DEBET"];
   $totakkredit+=$arr["AK_KREDIT"];
   $totsak+=$arr["SALDOAKHIR"];
   
	$i++;	}
	?>
<tr bgcolor="#f5d79c">
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	</td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
				<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totsa,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totawdebet,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totawkredit,2,",",".");?></b></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totmudebet,2,",",".");?></b></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totmukredit,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totakdebet,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format($totakkredit,2,",",".");?></b></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=number_format( $totsak,2,",",".");?></b></td>
		
  </tr>
 </table> 	

</form>
<hr />
<a href="#" class="verdana8blu" onClick="NewWindow('../akunting/cetakslip_titipanpendapatan.php?tglseatled=<?=$tglcari; ?>&premititipan=<?=$totpremipend?>','Downloadexcel',600,250,1);">Cetak Rekap Lampiran Neraca Titipan</a> 
<hr />

<br /><a href="../submenu.php?mnuinduk=600" class="verdana8blu">Menu Penagihan</a>
</body>
</html>