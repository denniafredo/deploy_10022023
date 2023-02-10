<?
  include "../../includes/session.php";
  include "../../includes/database.php";
	include "../../includes/kantor.php";
	include "../../includes/fungsi.php";
	$DB = new database($userid, $passwd, $DBName);
	$DBS = new database($userid, $passwd, $DBName);
	$DBD = new database($userid, $passwd, $DBName);
	$DB1 = new database($userid, $passwd, $DBName);
	
	$month 		= !isset($month) ? date('m') : $month;
	$year 		= !isset($year) ? date('Y') : $year;
	$kdkantor = !isset($kdkantor) ? $kantor : $kdkantor;
	$kdvaluta = !isset($kdvaluta) ? 1 : $kdvaluta;
	
	function numberFormat($nilai)
	{
	  $output = number_format($nilai,2,",",".");
		return $output;
	}
	
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
 checkedAll('memreg', true);
 }
 else
 {
 checkedAll('memreg', false);
 }
} 
</script>
 <script>
      function checkedAll (id, checked) {
	var el = document.getElementById(id);
	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Laporan Pinjaman Polis PP</title>
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

-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

function printPage()
{
    document.getElementById('noprint1').style.visibility = 'hidden';
	document.getElementById('noprint2').style.visibility = 'hidden';
	document.getElementById('noprint1').innerHTML="";
	document.getElementById('noprint2').innerHTML="";
    if (typeof(window.print) != 'undefined') {
        window.print();
    }
    
}

-->
</script>
</head>
<? 
if($action=="cetak"){
?>	
<body onLoad="window.print();window.close()">
<? 
}
else
{
?>
<body>
<form action="<? $PHP_SELF; ?>" method="post" name="memreg">
<?


if (isset($proses)) {
//echo 'proses'.$year.$month;
	//$sqa="begin $DBUser.LAMNER ('".$kdkantor."','".$month."', '".$year."','".$inc."'); end;";
	//echo $inc;
	$sqa="begin $DBUser.LAMNER ('".$kdkantor."','".$month."', '".$year."','0'); end;";
	//echo $sqa;
	$DB->parse($sqa);
	$DB->execute();
	$sqa="begin $DBUser.LAMNER ('".$kdkantor."','".$month."', '".$year."','1'); end;";
	//echo $sqa;
	$DB->parse($sqa);
	$DB->execute();
	$sqa="begin $DBUser.LAMNER ('".$kdkantor."','".$month."', '".$year."','2'); end;";
	//echo $sqa;
	$DB->parse($sqa);
	$DB->execute();
	$sqa="begin $DBUser.LAMNER ('".$kdkantor."','".$month."', '".$year."','3'); end;";
	//echo $sqa;
	$DB->parse($sqa);
	$DB->execute();
}

if ($HTTP_POST_VARS['check']) {
      	
      	$box=$HTTP_POST_VARS['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				//echo "No Data Updated !";
				}
				else
				{
    				foreach ($box as $dear) {
    				/*$sqa="update $DBUser.tabel_404_komisi_agen set kdauthorisasi='1',tglupdated=sysdate,userupdated='".$userid.
					"' WHERE kdauthorisasi is null and nopertanggungan=substr('$dear',0,9) and kdkomisiagen=substr('$dear',10,2) and  (to_char(tglproses,'DD/MM/YYYY')='$titletglcari')";*/
					
					$sqa="BEGIN $DBUser.LAMNER_SATUAN ('".substr($dear,0,2)."', '".substr($dear,2,9)."', '".substr($dear,11,2)."', '".substr($dear,13,4)."' ); END;"; 
					$DB->parse($sqa);
      				$DB->execute();	
					//echo $sqa;	
					//echo substr($dear,21,10);				
        			}						
						}
				}

?>
<div id="noprint1">

<table cellpadding="1" cellspacing="2">
 <tr>
    <td align="left">Bulan</td>
		<td><?  ShowFromDate(10,"Past"); ?></td>
    <td>Kantor</td>
		<td><select name="kdkantor">
  			<?
  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
  			     		 "order by kdkantor";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
      					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
  					}
  			?>
  			</select></td>
		<td></td>
		
		<td>Jenis Gadai</td>
		<td>
		<select name="kdjenisgadai">
  			  <option value="0">Gadai Baru</option>
					<option value="1" <?=$kdjenisgadai==1 ? "selected":"";?>>Gadai Lama</option>
					<option value="2" <?=$kdjenisgadai==2 ? "selected":"";?>>(*) All</option>
  			</select></td>
	</tr>
	<tr>		
		<td></td>	
		<td valign="top"><!--<select name="kdstatusfile">-->
  			<?
	  			//$sqa="select kdstatusfile,namastatusfile from $DBUser.tabel_299_status_file where kdstatusfile in ('1','3','4','5','X') order by kdstatusfile";
				// if ($kantor=='KP' && $userid=='GUSTIA'){
				 	$sqa="select kdstatusfile,namastatusfile from $DBUser.tabel_299_status_file WHERE kdstatusfile in ('1','4','3','5','8','6','9','L') order by namastatusfile";//}
				 //else {
				//	$sqa="select kdstatusfile,namastatusfile from $DBUser.tabel_299_status_file WHERE kdstatusfile in ('1','4','3') order by namastatusfile";}
				$DB->parse($sqa);
				$DB->execute();
				//echo $sqa;
				if ($kdstatusfile==1) {$selek1="selected";$selek2="";} else {$selek1="";$selek2="selected";} 	
				//echo "<option $selek1 value=1>AKTIF</option>";
				//echo "<option $selek2 value=2>NON AKTIF</option>";
				//echo "<option $selek2 value=3>ALL</option>";
				?>
				<!--
                <option value="1" <?=$kdstatusfile==1 ? "selected":"";?>>AKTIF</option>
                <option value="2" <?=$kdstatusfile==2 ? "selected":"";?>>NON AKTIF</option>
				<option value="3" <?=$kdstatusfile==3 ? "selected":"";?>>(*) ALL</option>
				<option value="999" <?=$kdstatusfile==999 ? "selected":"";?>>(*) All</option>-->
				<?
				/*while ($arx=$DB->nextrow()) {
				  echo "<option ";
					if ($arx["KDSTATUSFILE"]==$kdstatusfile){ echo " selected"; }
					echo " value=".$arx["KDSTATUSFILE"].">(".$arx["KDSTATUSFILE"].") ".$arx["NAMASTATUSFILE"]."</option>";
				}*/
			?>
  			<!--</select>-->
            <fieldset>
			<legend>Status Polis</legend>
            <?
            //echo $sqa;
			while ($arx=$DB->nextrow()) {
				  echo "<label><input type='checkbox' ";
					if ($arx["KDSTATUSFILE"]==$cb1 || $arx["KDSTATUSFILE"]==$cb2 || $arx["KDSTATUSFILE"]==$cb3 || $arx["KDSTATUSFILE"]==$cb4 || $arx["KDSTATUSFILE"]==$cb5 || $arx["KDSTATUSFILE"]==$cb6 || $arx["KDSTATUSFILE"]==$cb7 || $arx["KDSTATUSFILE"]==$cb8|| $arx["KDSTATUSFILE"]==$cb9 || $arx["KDSTATUSFILE"]==$cbX || $arx["KDSTATUSFILE"]==$cbL){ echo " checked "; }
					echo " name=cb".$arx["KDSTATUSFILE"]." value=".$arx["KDSTATUSFILE"].">(".$arx["KDSTATUSFILE"].") ".$arx["NAMASTATUSFILE"]."</label></br>";
				}
			?>
            </fieldset>
            </td>
        <td></td>
        <? $incb=" in ('".$cb1."','".$cb2."','".$cb3."','".$cb4."','".$cb5."','".$cb6."','".$cb7."','".$cb8."','".$cb9."','".$cbX."','".$cbL."')";
		//echo $incb ." -- isi status polis<br>" ;?>
		<td valign="top"><!--<select name="kdstatus">-->
        <fieldset>
			<legend>Status Gadai</legend>
  			<?
	  			$sqa="select kdstatus,namastatus from $DBUser.tabel_999_kode_status where jenisstatus='GADAI' and kdstatus in ('0','1','2','3','4','5') order by kdstatus";
				$DB->parse($sqa);
				$DB->execute();	
				
				while ($arx=$DB->nextrow()) {
				 echo "<label><input type='checkbox' ";
					if ($arx["KDSTATUS"]==$cs0 || $arx["KDSTATUS"]==$cs1|| $arx["KDSTATUS"]==$cs2 || $arx["KDSTATUS"]==$cs3 || $arx["KDSTATUS"]==$cs4 || $arx["KDSTATUS"]==$cs5){ echo " checked "; }
					echo " name=cs".$arx["KDSTATUS"]." value=".$arx["KDSTATUS"].">(".$arx["KDSTATUS"].") ".$arx["NAMASTATUS"]."</label></br>";
				}
				$incs=" in ('".$cs0."','".$cs1."','".$cs2."','".$cs3."','".$cs4."','".$cs5."')";
				//echo $incs;
			?>
        </fieldset>
  			<!--</select>-->
		</td>
        <td valign="top"><fieldset>
			<legend>Valuta</legend>
  			<?
	  			$sqa="select kdvaluta,namavaluta from $DBUser.tabel_304_valuta union select '2' kdvaluta,'DOLLAR GADAI RUPIAH' namavaluta from dual";
				$DB->parse($sqa);
				$DB->execute();	
				
				while ($arx=$DB->nextrow()) {
				 echo "<label><input type='checkbox' ";
					if ($arx["KDVALUTA"]==$cv0 || $arx["KDVALUTA"]==$cv1|| $arx["KDVALUTA"]==$cv2 || $arx["KDVALUTA"]==$cv3 || $arx["KDVALUTA"]==$cv4 || $arx["KDVALUTA"]==$cv5){ echo " checked "; }
					echo " name=cv".$arx["KDVALUTA"]." value=".$arx["KDVALUTA"].">(".$arx["KDVALUTA"].") ".$arx["NAMAVALUTA"]."</label></br>";
				}
				$incv=" in ('".$cv0."','".$cv1."','".$cv2."','".$cv3."','".$cv4."','".$cv5."')";
				//$inc="".$cv0."".$cv1."".$cv2."".$cv3."".$cv4."".$cv5."";
				echo "<input type=\"hidden\" name=\"inc\" value='".$cv0."".$cv1."".$cv2."".$cv3."".$cv4."".$cv5."'/>";
				//echo $inc;
			?>
        </fieldset></td>	
	</tr>
	<tr>
		
		<td align="left"><input name="cari" value="GO" type="submit"></td>
		<td> </td><td> </td><td> </td>
        <td align="right"> <? if ($kantor=='KP') { echo "<input name='bekup' value='SNAPSHOT' type='submit'>";} else {} ?>
		</td>
		<td> </td><td> </td>
        
		<td align="right"> <? if ($kantor=='KP') { echo "<input name='proses' value='PROSES' type='submit'>";} else {} ?>
		</td>
	</tr>
	<? //$kdjenisgadai=0; ?>
	
</table>
</div>
<hr size="1">
<? } ?>
<table border="0" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#C0C0C0">
	<tr>
		<td colspan="2">PT. ASURANSI JIWA IFG<br>
		<? 
		$KTR = new Kantor($userid,$passwd,$kdkantor);
		echo $KTR->namakantor;
		?><br>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
		<p align="center"><b>LAMPIRAN NERACA PINJAMAN POLIS PERTANGGUNGAN PERORANGAN <?=$kdjenisgadai=="1" ? "(GADAI LAMA)" : "";?></b></td>
	</tr>
	<? 
	switch($kdvaluta)
	{
	  case '1' : $kdakun = 160001; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; $kdnewakun = 117110000; break;
		case '0' : $kdakun = 160002; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; $kdnewakun = 117120000; break;
		case '3' : $kdakun = 161000; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; $kdnewakun = 117130000; break;
		case '2' : $kdakun = 161001; $kdval=$kdvaluta;$kdvaluta=3; $kdvaluta2=1; $kdnewakun = 117140000; break;
//		case 'ALL' : $kdakun = "160000','160001','160002"; $kdvaluta="0','1','2','3"; $kdvaluta2="0','1','2','3"; break;
		default : $kdakun = 160001; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; break;
	}
	
	if($cv0=='0') {$kdakun = '160002/117120000 & 422.002/125.212.100 & 850.002/361.502.000'; $nmakun = '117120000';}
	if($cv1=='1') {$kdakun = '160001/117110000 & 422.001/125.211.100 & 850.001/361.501.000'; $nmakun = '117110000';}
	if($cv2=='2') {$kdakun = '161001/117140000 & 423.001/125.213.700 & 851.001/361.515.000'; $nmakun = '117140000';}
	if($cv3=='3') {$kdakun = '161000/117130000 & 423.000/125.213.100 & 851.000/361.502.000'; $nmakun = '117130000';}
//	if ($kdvaluta=='0'||$kdvaluta=='1'||$kdvaluta=='2'||$kdvaluta=='3') {
	$sql = "select akun,nama from $DBUser.tabel_802_kodeakun where akun in ('".$nmakun."')";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$aku = $DB->nextrow();
	$namaakun = $aku["NAMA"];
	?>
	<tr>
		<td width="200">KODE REKENING</td>
		<td width="90%"><?=$kdakun;?></td>
	</tr>

	<tr>
		<td>NAMA REKENING</td>
		<td><?=$namaakun;?></td>
	</tr>
<?
//	} 
//	else {
//		echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
//	}
?>

	<tr>
		<td>PER</td>
		<td>
		 <? 
		 $per = "30/".$month."/".$year;
		 echo toTglIndo($per);
		 ?>
		</td>
	</tr>
</table>
<br />

<table border="1" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#09b0ce">
	<tr>
	  <td rowspan="3" bgcolor="#7dc2d9" align="center">NO URUT</td>
	  <td rowspan="3" bgcolor="#7dc2d9" align="center">NO POLIS LAMA</td>
	  <td rowspan="3" bgcolor="#7dc2d9" align="center">NO POLIS JL-INDO</td>
	  <td rowspan="3" bgcolor="#7dc2d9" align="center">NAMA PEMEGANG POLIS</td>
	  <td rowspan="3" bgcolor="#7dc2d9" align="center">MULAI GADAI</td>
	  <td colspan="2" rowspan="2" align="center" bgcolor="#7dc2d9">SALDO AWAL TAHUN 
      <?=$year;?></td>
	  <td colspan="4" align="center" bgcolor="#7dc2d9">MUTASI BULAN INI</td>
	  <td colspan="4" bgcolor="#7dc2d9" align="center">MUTASI S/D BULAN INI</td>
	  <td colspan="2" rowspan="2" align="center" bgcolor="#7dc2d9">SALDO AKHIR</td>
      <td rowspan="3" bgcolor="#7dc2d9" align="center">STATUS</td>
      <td rowspan="3" bgcolor="#7dc2d9" align="center">STATUS GADAI</td>
      <td rowspan="3" bgcolor="#7dc2d9" align="center">ACTION</br><input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></br>
      <? if ($kantor=='KP') { echo "<input name='check' value='PROSES' type='submit'>";} else {} ?></td>
  </tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#7dc2d9">DEBET</td>
        <td colspan="2" align="center" bgcolor="#7dc2d9">KREDIT</td>
		<td colspan="2" align="center" bgcolor="#7dc2d9">DEBET</td>
		<td colspan="2" align="center" bgcolor="#7dc2d9">KREDIT</td>
	</tr>
	<tr>
		<td bgcolor="#7dc2d9" align="center">POKOK</td>
		<td bgcolor="#7dc2d9" align="center">BUNGA</td>
        <td bgcolor="#7dc2d9" align="center">POKOK PINJAMAN</td>
        <td bgcolor="#7dc2d9" align="center">TAGIHAN BUNGA</td>
        <td bgcolor="#7dc2d9" align="center">ANGSURAN POKOK</td>
        <td bgcolor="#7dc2d9" align="center">PELUNASAN BUNGA</td>
        <td align="center" bgcolor="#7dc2d9">POKOK PINJAMAN</td>
        <td align="center" bgcolor="#7dc2d9">TAGIHAN BUNGA</td>
        <td align="center" bgcolor="#7dc2d9">ANGSURAN POKOK</td>
        <td align="center" bgcolor="#7dc2d9">PELUNASAN BUNGA</td>
        <td bgcolor="#7dc2d9" align="center">POKOK</td>
		<td bgcolor="#7dc2d9" align="center">BUNGA</td>
        
	</tr>
	<?
	if($month=="01")
	{
	  $prevmonth = 12;
		$prevyear = $year-1;
	}
	else
	{
	  $prevmonth = $month - 1 ;
		$prevmonth = strlen($prevmonth)==1 ? "0".$prevmonth : $prevmonth;
		$prevyear  = $year;
	}
	//$kdjenisgadai = isset($kdjenisgadai) ? $kdjenisgadai : 0;
	$kdjenisgadainya="";
	if ($kdjenisgadai=="2") { $kdjenisgadainya=" ";} else {$kdjenisgadainya=" and nvl(d.gadailama,0) in ('$kdjenisgadai') ";}
	
	$kdvalutanya="";
	if ($kdvaluta=="0"||$kdvaluta=="1"||$kdvaluta=="2"||$kdvaluta=="3") { $kdvalutanya="and b.kdvaluta in ('$kdvaluta') and d.kdvaluta in ('$kdvaluta2')"; } //else {$kdvalutanya="and b.kdvaluta in ('1','2','3','0') and d.kdvaluta in ('1','2','3','0')";}
	
	$kdstatusnya="";
	//$kdstatusnya="and d.status!='5'";

	if (isset($bekup)) {
	//echo 'proses'.$year.$month;
		$sqa="delete from $DBUser.tabel_700_lamner_bux where tglbill = to_date('$year$month','YYYYMM') and kdkantor='$kdkantor' ".
		"and kdvaluta ".$incv." and stsgadai ".$incs." and sts ".$incb;
		//echo $sqa;
		$DBD->parse($sqa);
		$DBD->execute();
		
		$sqb="insert into $DBUser.tabel_700_lamner_bu select * from $DBUser.tabel_700_lamner where tglbill = to_date('$year$month','YYYYMM') and kdkantor='$kdkantor'";
		//echo $sqb;
		//$DB->parse($sqb);
		//$DB->execute();
	}
	$sql ="select SAB_X,TGADAI,
			MBI_BNG_DR,
			MSBI_BNG_DR,
			MSBI_BNG_KR,
			NOPOL,
			TGLBILL,
			STS,
			PREFIXPERTANGGUNGAN,
			NOPERTANGGUNGAN,
			replace(PEMPOL,'''', '`') PEMPOL,
			TGLGADAI,
			SP_AWL,
			SB_AWL,
			MBI_PK_D,
			MBI_BNG_D,
			MBI_PK_K,
			MBI_BNG_K,
			MSBI_PK_D,
			MSBI_BNG_D,
			MSBI_PK_K,
			MSBI_BNG_K,
			KDVALUTA,
			decode(STSGADAI,'3','MASA PELUNASAN','4','GADAI ULANG','5','LUNAS','') STSGADAI,
			--STSGADAI,
			KDKANTOR,
			SAK_P,
			DECODE(NVL(SAB_X,0),0,0,DECODE(SAK_B,1,0,SAK_B)) SAK_B,
			NAMASTS
			 from (select (SELECT BUNGA FROM $DBUser.TABEL_701_PELUNASAN_GADAI XX
    WHERE   prefixpertanggungan = l.prefixpertanggungan
                               AND nopertanggungan = l.nopertanggungan 
                               AND TGLBOOKED=TO_DATE ('$year$month', 'YYYYMM')
                               AND PERIODEBAYAR=(SELECT MAX(PERIODEBAYAR) FROM 
                               $DBUser.TABEL_701_PELUNASAN_GADAI
    WHERE   prefixpertanggungan = XX.prefixpertanggungan
                               AND nopertanggungan = XX.nopertanggungan 
                               AND TGLBOOKED=TO_DATE ('$year$month', 'YYYYMM')
                               )) SAB_X, to_char(tglgadai,'dd/mm/yyyy') tgadai, round(MBI_BNG_D,decode(kdvaluta,'3',2,0)) MBI_BNG_DR, round(MSBI_BNG_D,decode(kdvaluta,'3',2,0)) MSBI_BNG_DR, round(MSBI_BNG_K, decode(kdvaluta,'3',2,0)) MSBI_BNG_KR,(select nopol from $DBUser.tabel_200_pertanggungan where prefixpertanggungan=l.prefixpertanggungan and nopertanggungan=l.nopertanggungan) nopol,L.*, (NVL(SP_AWL,0)+NVL(MSBI_PK_D,0)-NVL(MSBI_PK_K,0)) SAK_P, ROUND(NVL(SB_AWL,0),decode(kdvaluta,'3',2,0))+ROUND(NVL(MSBI_BNG_D,0),decode(kdvaluta,'3',2,0))-ROUND(NVL(MSBI_BNG_K,0),decode(kdvaluta,'3',2,0)) SAK_B, (select namastatusfile from $DBUser.TABEL_299_STATUS_FILE where kdstatusfile=l.sts) namasts from $DBUser.TABEL_700_LAMNER L where tglbill=TO_DATE ('$year$month', 'YYYYMM') AND KDKANTOR='$kdkantor' and kdvaluta ".$incv." and stsgadai ".$incs." and sts ".$incb." union ".
				"select ROUND(NVL(SB_AWL,0),decode(kdvaluta,'3',2,0))+ROUND(NVL(MSBI_BNG_D,0),decode(kdvaluta,'3',2,0))-ROUND(NVL(MSBI_BNG_K,0),decode(kdvaluta,'3',2,0)) SAB_X, to_char(tglgadai,'dd/mm/yyyy') tgadai, round(DECODE(sts,'4',0,'L',0,'3',0,'1',0,MBI_BNG_D),decode(kdvaluta,'3',2,0)) MBI_BNG_DR, round(MSBI_BNG_D,decode(kdvaluta,'3',2,0)) MSBI_BNG_DR, round(MSBI_BNG_K, decode(kdvaluta,'3',2,0)) MSBI_BNG_KR,".
				"(select nopol from $DBUser.tabel_200_pertanggungan where prefixpertanggungan=x.prefixpertanggungan and nopertanggungan=x.nopertanggungan) nopol,
				TGLBILL,
										  STS,
										  PREFIXPERTANGGUNGAN,
										  NOPERTANGGUNGAN,
										  replace(PEMPOL,'''', '`') PEMPOL,
										  TGLGADAI,
										  nvl(decode(SP_AWL,'',0,SP_AWL),0),
										  nvl(decode(SB_AWL,'',0,SB_AWL),0),
										   nvl(decode(MBI_PK_D,'',0,MBI_PK_D),0),
										  DECODE(sts,'4',0,'L',0,nvl(MBI_BNG_D,0)) MBI_BNG_D,
										  MBI_PK_K,
										  MBI_BNG_K,
										  MSBI_PK_D,
										  MSBI_BNG_D,
										  MSBI_PK_K,
										  MSBI_BNG_K,
										  KDVALUTA,
										  STSGADAI,
										  KDKANTOR, (NVL(SP_AWL,0)+NVL(MSBI_PK_D,0)-NVL(MSBI_PK_K,0)) SAK_P, ROUND(NVL(SB_AWL,0),decode(kdvaluta,'3',2,0))+ROUND(NVL(MSBI_BNG_D,0),decode(kdvaluta,'3',2,0))-ROUND(NVL(MSBI_BNG_K,0),decode(kdvaluta,'3',2,0)) SAK_B, (select namastatusfile from $DBUser.TABEL_299_STATUS_FILE where kdstatusfile=x.sts) namasts from $DBUser.tabel_700_lamner x where sts IN ('1','3','4','8','L') and kdvaluta ".$incv." and stsgadai ".$incs."
			and tglbill=(select max(tglbill) from $DBUser.tabel_700_lamner where prefixpertanggungan=x.prefixpertanggungan 
			and nopertanggungan=x.nopertanggungan and tglbill < to_date('$year$month','YYYYMM')) AND NOT EXISTS (SELECT 'X' FROM $DBUser.tabel_700_lamner
										 WHERE   prefixpertanggungan =
													x.prefixpertanggungan
												 AND nopertanggungan = x.nopertanggungan
												 AND tglbill = to_date('$year$month','YYYYMM'))) ";

/*Mr. Gustia minta supaya hanya sesuai dengan yang di pilih aja AKTIF ato BPO | by : iie 07 Mei 2012 */
if(base64_encode($incb) == "IGluICgnMScsJycsJycsJycsJycsJycsJycsJycsJycp") //in ('1','','','','','','','','')
{
	$sql .= "GROUP BY TGADAI,MBI_BNG_DR,MSBI_BNG_DR,MSBI_BNG_KR,NOPOL,TGLBILL,STS,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,PEMPOL,TGLGADAI,SP_AWL,SB_AWL,MBI_PK_D,MBI_BNG_D,MBI_PK_K,MBI_BNG_K,MSBI_PK_D,MSBI_BNG_D,MSBI_PK_K,MSBI_BNG_K,KDVALUTA,STSGADAI,KDKANTOR,SAK_P,SAK_B,NAMASTS
	HAVING sts != '4' ";
}
/*end of Mr. Gustia AKTIF and BPO separetely*/

$sql .= "order by NAMASTS,tglgadai";	
	//echo $sql;
	//echo $kdvaluta; 
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {
	    /*==== Ibu Mia meminta supaya yang tagihan dan bunganya 0 gak usah ditampilkan lah kata SPI 02 Maret 2016 oleh : Fendy =====*/
		//if ($arr["SAK_P"] > 0 || $arr["SAK_B"] > 0) {
		  
		  
		if($i%2){ echo "<tr>"; } else { echo "<tr bgcolor=#c4e1f2>"; } 
		$sql = "select to_char(max(tglbooked),'MMYYYY') tglmax from $DBUser.TABEL_701_PELUNASAN_GADAI 
			    where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."'
				and to_char(tglgadai,'dd/mm/yyyy')='".$arr["TGADAI"]."'";	
		//echo $sql;
		//echo $kdvaluta; 
		$DB1->parse($sql);
		$DB1->execute();
		$arm=$DB1->nextrow();
		//echo $arm["TGLMAX"];
		
		
		if (isset($bekup)) {
		$sqd="delete from $DBUser.tabel_700_lamner_bux where tglbill = to_date('$year$month','YYYYMM') and kdkantor='$kdkantor' ".
		"and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."'";
	//echo $sqd;
		//$DBD->parse($sqd);
		//$DBD->execute();
		
//echo 'proses'.$year.$month;
		if($arr["STSGADAI"]=='MASA PELUNASAN')
		{$stsgdi='3';}
		else if ($arr["STSGADAI"]=='GADAI ULANG')
		{$stsgdi='4';}
		else
		{$stsgdi='5';}
		
		$sqi="INSERT INTO $DBUser.TABEL_700_LAMNER_BUX (TGLBILL,
                                  STS,
                                  PREFIXPERTANGGUNGAN,
                                  NOPERTANGGUNGAN,
                                  PEMPOL, TGLGADAI,
                                  SP_AWL,
                                  SB_AWL,
                                  MBI_PK_D,
                                  MBI_BNG_D,
								  MBI_PK_K,
                                  MBI_BNG_K,
                                  MSBI_PK_D,
                                  MSBI_BNG_D,
                                  MSBI_PK_K,
                                  MSBI_BNG_K,SAK_P, SAK_B,
								  MBI_BNG_DR, MSBI_BNG_DR,MSBI_BNG_KR,
                                  KDVALUTA,
                                  STSGADAI, 
                                  KDKANTOR)  VALUES   
			(to_date('$year$month','YYYYMM'),
            '".$arr["STS"]."',
            '".$arr["PREFIXPERTANGGUNGAN"]."',
            '".$arr["NOPERTANGGUNGAN"]."',
            '".$arr["PEMPOL"]."',
			to_date('".$arr["TGADAI"]."','dd/mm/yyyy'),".number_format($arr["SP_AWL"],2,'.','').",
			".number_format($arr["SB_AWL"],2,'.','').",".number_format($arr["MBI_PK_D"],2,'.','').",".number_format($arr["MBI_BNG_D"],2,'.','').",
			".number_format($arr["MBI_PK_K"],2,'.','').",".number_format($arr["MBI_BNG_K"],2,'.','').",".number_format($arr["MSBI_PK_D"],2,'.','').",
			".number_format($arr["MSBI_BNG_D"],2,'.','').",".number_format($arr["MSBI_PK_K"],2,'.','').",".number_format($arr["MSBI_BNG_K"],2,'.','').",
			".number_format($arr["SAK_P"],2,'.','').",".number_format($arr["SAK_B"],2,'.','').",
			".number_format($arr["MBI_BNG_DR"],2,'.','').",".number_format($arr["MSBI_BNG_DR"],2,'.','').",".number_format($arr["MSBI_BNG_KR"],2,'.','').",
			'".$arr["KDVALUTA"]."','$stsgdi','".$arr["KDKANTOR"]."')";
		//echo $sqi;
		$DBS->parse($sqi);
		$DBS->execute();
		}
	  ?>
		<td valign="top"><?=$i;?></td>
		<td valign="top"><?="<a href=\"javascript:NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGADAI"]."','polisinfo',800,500,'yes');\">".$arr["NOPOL"]."</a>";?></td>
        <td valign="top"><?="<a href=\"javascript:NewWindow('../akunting/kartugadai1.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGADAI"]."','polisinfo',800,500,'yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a>";?></td>
        <td valign="top"><?=$arr["PEMPOL"];?></td>
		<td valign="top"><?=$arr["TGADAI"];?></td>
        
		<td <? if($i%2){ echo "bgcolor=#E8FFE8"; } else { echo "bgcolor=#CEFFCE";} ?> valign="top" align="right"><?=idNumberFormat($arr["SP_AWL"]);?></td>

		<td valign="top" align="right"><?=idNumberFormat($arr["SB_AWL"]);?></td>

        <td <? if($i%2){ echo "bgcolor=#E8FFE8"; } else { echo "bgcolor=#CEFFCE";} ?> valign="top" align="right"><?=idNumberFormat($arr["MBI_PK_D"]);?></td>

<!--        <td valign="top" align="right"><?=idNumberFormat($arr["MBI_BNG_DR"]);?></td> -->
		<td valign="top" align="right"><?=NumberFormat($arr["MBI_BNG_DR"]);?></td>

        <td <? if($i%2){ echo "bgcolor=#E8FFE8"; } else { echo "bgcolor=#CEFFCE";} ?> valign="top" align="right"><?=idNumberFormat($arr["MBI_PK_K"]);?></td>

        <td valign="top" align="right"><?=idNumberFormat($arr["MBI_BNG_K"]);?></td>

        <td <? if($i%2){ echo "bgcolor=#E8FFE8"; } else { echo "bgcolor=#CEFFCE";} ?> valign="top" align="right"><?=idNumberFormat($arr["MSBI_PK_D"]);?></td>

        <td valign="top" align="right"><?=idNumberFormat($arr["MSBI_BNG_DR"]);?></td>

        <td <? if($i%2){ echo "bgcolor=#E8FFE8"; } else { echo "bgcolor=#CEFFCE";} ?> valign="top" align="right"><?=idNumberFormat($arr["MSBI_PK_K"]);?></td>

        <td valign="top" align="right"><?=idNumberFormat($arr["MSBI_BNG_KR"]);?></td>

        <td <? if($i%2){ echo "bgcolor=#E8FFE8"; } else { echo "bgcolor=#CEFFCE";} ?> valign="top" align="right"><?=idNumberFormat($arr["SAK_P"]);?></td>

        <td valign="top" align="right"><?=idNumberFormat($arr["SAK_B"]);?></td>

		<td valign="top"><?=$arr["NAMASTS"];?></td>
        <td valign="top"><?=$arr["STSGADAI"];?></td>
        <td valign="top" align="center"><?="<a href=\"javascript:NewWindow('../polis/cetakberitahugadai.php?prefixpertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLGADAI"]."','polisinfo',800,500,'yes');\">cetak</a>";if ($kantor=='KP') { echo "<input type='checkbox' name='box1[]' value=".$arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"].$arm["TGLMAX"].">";} else {}?></td>
    </tr>
	<?
	$i++;

	$jmlsaldopokokawaltahun += $arr["SP_AWL"];
	$jmlsaldobungaawaltahun +=$arr["SB_AWL"];
	$MBI_PK_D += $arr["MBI_PK_D"];
	$MBI_BNG_DR += $arr["MBI_BNG_DR"];
	$MBI_PK_K += $arr["MBI_PK_K"];
	$MBI_BNG_K += $arr["MBI_BNG_K"];
	$MSBI_PK_D += $arr["MSBI_PK_D"];
	$MSBI_BNG_DR += $arr["MSBI_BNG_DR"];
	$MSBI_PK_K += $arr["MSBI_PK_K"];

	$MSBI_BNG_KR += $arr["MSBI_BNG_KR"];

	$SAK_P += $arr["SAK_P"];
	$SAK_B += $arr["SAK_B"];
		//}
		/*===== End of ibu mia by : fendy =====*/
	}
	?>
	<tr bgcolor="#afd6ed">
		<td></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
        <td>TOTAL</td>
		<td align="right"><?=numberFormat($jmlsaldopokokawaltahun);?></td>
		<td align="right"><?=numberFormat($jmlsaldobungaawaltahun);?></td>
		<td align="right"><?=numberFormat($MBI_PK_D);?></td>
		<td align="right"><?=numberFormat($MBI_BNG_DR);?></td>
        <td align="right"><?=numberFormat($MBI_PK_K);?></td>
		<td align="right"><?=numberFormat($MBI_BNG_K);?></td>
		<td align="right"><?=numberFormat($MSBI_PK_D);?></td>
		<td align="right"><?=numberFormat($MSBI_BNG_DR);?></td>
		<td align="right"><?=numberFormat($MSBI_PK_K);?></td>
        <td align="right"><?=numberFormat($MSBI_BNG_KR);?></td>
        <td align="right"><?=numberFormat($SAK_P);?></td>
        <td align="right"><?=numberFormat($SAK_B);?></td>
		<td></td>
        <td></td>
        <td></td>
    </tr>
    <?
	
	$sql = "SELECT   kurs
			  FROM   $DBUser.tabel_999_kurs x
			 WHERE   x.kdvaluta = $cv3
					 AND x.tglkursberlaku =
						   (SELECT   MAX (tglkursberlaku)
							  FROM   $DBUser.tabel_999_kurs y
							 WHERE   x.kdvaluta = $cv3
									 AND y.tglkursberlaku <= LAST_DAY(to_date('$year$month','YYYYMM')))";	
	//echo $sql;
	//echo $kdvaluta; 
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	
    if ($cv3=="3") {
	?>
    <tr bgcolor="#afd6ed">
		<td></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center"><?='Kurs '.numberFormat($arr["KURS"]);?></td>
        <td>TOTAL</td>
		<td align="right"><?=numberFormat($jmlsaldopokokawaltahun*$arr["KURS"]);?></td>
		<td align="right"><?=numberFormat($jmlsaldobungaawaltahun*$arr["KURS"]);?></td>
		<td align="right"><?=numberFormat($MBI_PK_D*$arr["KURS"]);?></td>
		<td align="right"><?=numberFormat($MBI_BNG_DR*$arr["KURS"]);?></td>
        <td align="right"><?=numberFormat($MBI_PK_K*$arr["KURS"]);?></td>
		<td align="right"><?=numberFormat($MBI_BNG_K*$arr["KURS"]);?></td>
		<td align="right"><?=numberFormat($MSBI_PK_D*$arr["KURS"]);?></td>
		<td align="right"><?=numberFormat($MSBI_BNG_DR*$arr["KURS"]);?></td>
		<td align="right"><?=numberFormat($MSBI_PK_K)*$arr["KURS"];?></td>
        <td align="right"><?=numberFormat($MSBI_BNG_KR*$arr["KURS"]);?></td>
        <td align="right"><?=numberFormat($SAK_P*$arr["KURS"]);?></td>
        <td align="right"><?=numberFormat($SAK_B*$arr["KURS"]);?></td>
		<td></td><td></td>
        <td></td>
    </tr>
    <? } ?>
</table>
<br />
<? 
if($action=="cetak"){
?>	
						<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
              <tr>
							  <td><?=$KTR->kotamadya;?>, <?=toTglIndo(date("d/m/Y")); ;?></td>
								<td align="center"></td>
							</tr>
							<tr>
							  <td width="34%">Dibuat oleh,<p>&nbsp;</p>
                <p>( <?=$KTR->kasieadlog;?> )<br>
                Kasi Adm &amp Logistik</td>

								<td align="center" width="33%">Mengetahui,<p>&nbsp;</p>
                <p>( <?=$KTR->branchmanager;?> ) <br><?=$KTR->jabatanmanager;?>&nbsp;</td>
              </tr>
            </table>
<br />
<? 
}
else
{
$x= str_replace("'","+",$incs);
?>
<hr size="1">
<div id="noprint2">
<a href="#" onClick="window.location.replace('index.php')">Menu Pelaporan</a> | 

<? //"<a href=# onclick=NewWindow('lamner.php?action=cetak&year=".$year."&month=".$month."&kdkantor=".$kdkantor."&kdvaluta=".$kdval."&kdstatus=".$kdstatus."&kdstatusfile=".$kdstatusfile."','',900,400,1)><img src=../img/cetak.gif border=0 align=absmiddle> Cetak</a>";?>


<?="<a href=# onclick=printPage()><img src=../img/cetak.gif border=0 align=absmiddle> Cetak</a>";?>


<? 
}
?>
</div>
</form>
</body>
</html>
