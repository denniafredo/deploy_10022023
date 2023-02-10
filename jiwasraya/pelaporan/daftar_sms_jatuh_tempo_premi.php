<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  include '../includes/koneksi.php';
  
  $DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
			
  function DateSelector($inName, $useDate=0) 
  { 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 

					/*echo "<option value=05>05</option>";
					echo "<option value=15>15</option>";
					echo "<option value=25>25</option>";*/
          //for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          //{ 
		  /*		$currentDay=05;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 
			  $currentDay=15;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 	
			  $currentDay=25;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 							
          //} 

          print("</select>"); */
		  for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</select>"); 

  
     // Bulan	
  		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
          print("<select name=" . $inName .  "bln>\n"); 
          for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
          { 
              switch($currentMonth)
              {
                case '1' : $namabulan ="JANUARI"; break ;
                case '2' : $namabulan ="FEBRUARI"; break ;
                case '3' : $namabulan ="MARET"; break ;
                case '4' : $namabulan ="APRIL"; break ;
                case '5' : $namabulan ="MEI"; break ;
                case '6' : $namabulan ="JUNI"; break ;
                case '7' : $namabulan ="JULI"; break ;
                case '8' : $namabulan ="AGUSTUS"; break ;
                case '9' : $namabulan ="SEPTEMBER"; break ;
                case '10' : $namabulan ="OKTOBER"; break ;
                case '11' : $namabulan ="NOVEMBER"; break ;
                case '12' : $namabulan ="DESEMBER"; break ;
              }
  						
              print("<option value=\"$currentMonth\""); 
  						if($selected==$currentMonth) 
              { 
                  print(" selected"); 
              } 					
              print(">$namabulan\n"); 						
          } 
          print("</select>"); 
  
  		// Tahun				
  		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate); 
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
              if($selected==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
  						
          } 
  				print("</select>"); 
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
 <script>
      function checkedAll (id, checked) {
	var el = document.getElementById(id);

	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }
 </script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Upload Autodebet</title>
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



<form action="<?=$PHP_SELF;?>" method="post" enctype="multipart/form-data" name="getpremi">
<?

?>
<table>
        <tr><!--<td >Unggah File </td><td><input type="file" name="ffilename" size="70" value=""><br /></td>-->
        <td>Nama Bank
	<select name="kdbank">
	  	<option value="M" <? if ($kdbank=="M") {echo "selected";} else { echo "";}?>>MANDIRI</option>
		<option value="N" <? if ($kdbank=="N") {echo "selected";} else { echo "";}?>>BNI</option>
        <option value="R" <? if ($kdbank=="R") {echo "selected";} else { echo "";}?>>BRI</option>
		<option value="X" <? if ($kdbank=="X") {echo "selected";} else { echo "";}?>>NON AUTODEBET</option>
		<option value="C" <? if ($kdbank=="C") {echo "selected";} else { echo "";}?>>CREDIT CARD</option>
		<option value="B" <? if ($kdbank=="B") {echo "selected";} else { echo "";}?>>BEFORE BPO</option>
       <!-- <option value="BTN" <? if ($kdbank=="BTN") {echo "selected";} else { echo "";}?>>BTN</option>
        <option value="CTB" <? if ($kdbank=="CTB") {echo "selected";} else { echo "";}?>>CITIBANK 1BILL</option>
        <option value="CBN" <? if ($kdbank=="CBN") {echo "selected";} else { echo "";}?>>BNI CREDIT CARD</option>
        <option value="POS" <? if ($kdbank=="POS") {echo "selected";} else { echo "";}?>>CITIBANK PT.POS</option>
		<option value="MD5" <? if ($kdbank=="MD5") {echo "selected";} else { echo "";}?>>MANDIRI 521</option>
		<option value="MD9" <? if ($kdbank=="MD9") {echo "selected";} else { echo "";}?>>MANDIRI 943</option>
		<option value="MD6" <? if ($kdbank=="MD6") {echo "selected";} else { echo "";}?>>MANDIRI 644</option>
		<option value="MD6" <? if ($kdbank=="BPK") {echo "selected";} else { echo "";}?>>BPD KALBAR</option>-->
	</select></td>
    <td>
	Tanggal Download<?=DateSelector("d");?> 
    <input type="submit"  name="ret" value="RETRIEVE" class="but">
  </td>
    </tr>
		<!--<tr><td></td><td><input type="submit" name="apply" value="SUBMIT" class="but"></td>
        <td colspan="2">
        <fieldset>
        <legend>Pilih Jenis</legend>
        
        <? if($radio=='') {$radio='P';} else {$radio=$radio;}?>
        <input type="radio" name="radio" id="radio" value="A" <? if($radio=='A') {echo "checked";} else {echo "";}?>> Premi & Rider
        <input type="radio" name="radio" id="radio" value="P" <? if($radio=='P') {echo "checked";} else {echo "";}?>> Premi
        <input type="radio" name="radio" id="radio" value="R" <? if($radio=='R') {echo "checked";} else {echo "";}?>> Rider
        
        <input type="submit" name="updet" value="UPDATE" class="but"></fieldset></td></tr>-->
</table>
<!--</form>-->

</div>
<? 
if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	} else {
  	$tglcari	=	 ( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
  					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
  					$_POST['dthn'];
	$tglcari = $tglcari;
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
<?
	if ($kdbank=='MDR') {
		$namabank='AUTO DEBET BANK MANDIRI';
		$namalike='MANDIRI';
		if($periode=="1"){
			$squery="to_date('26'||to_char(add_months(trunc(to_date('$tglcari','dd/mm/yyyy')),-1),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +4   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','05','BNI','07','BRI','09')";
		}elseif($periode=="2"){
			$squery="to_date('06'||to_char(trunc(to_date('$tglcari','dd/mm/yyyy')),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +14   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','15','BNI','17','BRI','19')";
		}elseif($periode=="3"){
			$squery="to_date('16'||to_char(trunc(to_date('$tglcari','dd/mm/yyyy')),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +24   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','25','BNI','27','BRI','29')";
		}
	}
	else if ($kdbank=='BNI') {
		$namabank='AUTO DEBET BANK NEGARA INDONESIA (BNI)';
		$namalike='BNI';
		if($periode=="1"){
			$squery="to_date('28'||to_char(add_months(trunc(to_date('$tglcari','dd/mm/yyyy')),-1),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +6   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','05','BNI','07','BRI','09')";
		}elseif($periode=="2"){
			$squery="to_date('08'||to_char(trunc(to_date('$tglcari','dd/mm/yyyy')),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +16   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','15','BNI','17','BRI','19')";
		}elseif($periode=="3"){
			$squery="to_date('18'||to_char(trunc(to_date('$tglcari','dd/mm/yyyy')),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +26   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','25','BNI','27','BRI','29')";
		}
	}
	else if ($kdbank=='BTN') {
		$namabank='AUTO DEBET BANK TABUNGAN NEGARA (BTN)';
		$namalike='BTN';
	}
	else if ($kdbank=='CBN') {
		$namabank='BNI CREDIT CARD';
		$namalike='BNI';
	}
	else if ($kdbank=='BRI') {
		$namabank='AUTO DEBET BANK RAKYAT INDONESIA (BRI)';
		$namalike='BRI';
		if($periode=="1"){
			$squery="to_date('30'||to_char(add_months(trunc(to_date('$tglcari','dd/mm/yyyy')),-1),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +8   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','05','BNI','07','BRI','09')";
		}elseif($periode=="2"){
			$squery="to_date('10'||to_char(trunc(to_date('$tglcari','dd/mm/yyyy')),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +18   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','15','BNI','17','BRI','19')";
		}elseif($periode=="3"){
			$squery="to_date('20'||to_char(trunc(to_date('$tglcari','dd/mm/yyyy')),'MMYYYY'),'DDMMYYYY') and TRUNC (trunc(to_date('$tglcari','dd/mm/yyyy')), 'month') +28   and a.kdbank in ('MDR') and a.kdstatusfile='1' and a.kdpertanggungan='2' and b.status not in ('X') and a.autodebet ='1') where substr(phone,1,2) in ('08','62') and kdsms not in ('CC')";
			$tglquery="decode(a.kdbank,'MDR','25','BNI','27','BRI','29')";
		}
	}
	else if ($kdbank=='BPK') {
		$namabank='AUTO DEBET BPD KALBAR';
		$namalike='BPK';
	}
	else if ($kdbank=='POS') {
		$namabank='CITIBANK PT.POS';
		$namalike='POS';
	}

if($apply)
{	$sql="delete FROM $DBUser.tabel_315_upld_autodebet a where to_char(tglproses,'dd/mm/yyyy')='$tglcari' and kdbank='$kdbank'";
     //echo $sql;
	 $DB->parse($sql);
     $DB->execute();
	 
    require "../../includes/fileupload.class.php";   
				//echo ($qupload+1).'record(s) inserted...';
    }
		else
		{ 
					  $updatefile = "";
		}
		

?>

<b>HASIL <?=$namabank;?> <br />BULAN <?=$tglcari;?></b>
  <? 
  
if ($kirim) {
	
  $sql = "select * from (select (SELECT    NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETAGIH02,nvl(PHONETETAP01,PHONETAGIH02))))
                    FROM   $DBUser.TABEL_100_KLIEN
                   WHERE   NOKLIEN = NOPEMEGANGPOLIS)
                    PHONE,'Nasabah Yth, Auto Debet '||decode(a.kdbank,'MDR','Mandiri','BNI','BNI','BRI','BRI','C.Card')||' utk tagihan premi Polis '||a.prefixpertanggungan||b.nopertanggungan||' akan dilakukan tgl '|| $tglquery ||'/'||to_char(sysdate,'mm/yyyy') ||'. Pastikan saldo rekening anda mencukupi. Info 021-1500151' message,
                    sysdate,decode(a.kdbank,'MDR','M','BNI','N','BRI','R') kdsms,'0'
from tabel_200_pertanggungan a,tabel_300_historis_premi b,tabel_001_kantor c
where a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=B.NOPERTANGGUNGAN and a.prefixpertanggungan=c.kdkantor and b.tglseatled is null
and kdkuitansi not in ('BP3') and tglbooked between $squery";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	$DB1->parse($sql);
    $DB1->execute();
	while ($arr1=$DB1->nextrow()) {
	echo '</br>'.$arr1["SMS"];
		//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arr1["PHONE"]."','".$arr1["SMS"]."')";
		 //echo $mysqlins;
		//mysql_query($mysqlins);
	}
	echo '</br>';
	}
	
if ($ret) {
  $sql = "select phone,message,tglrekam,kdsms,decode(status,'1','Terkirim','0','Belum Dikirim','Gagal') statuskirim,status,to_char(tglbooked,'dd/mm/yyyy') tglbooked from $DBUser.tabel_200_sms where to_char(tglbooked,'dd/mm/yyyy')='21/11/2015'";
  $DB->parse($sql);
  $DB->execute();
  
  $kantorcetak=$kantor1;

  	echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
	
   	?>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
	<td bgcolor="#89acd8" align="center">NO. HP</td>    
    <td bgcolor="#89acd8" align="center">TGLBOOKED</td>
    <td bgcolor="#89acd8" align="center">PESAN</td>
	<td bgcolor="#89acd8" align="center">STATUS</td>
	<td bgcolor="#89acd8" align="center">ACTION<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></td>
  	</tr>
	<?
	$i=1;
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?>.</td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PHONE"];?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLBOOKED"];?></td>
    <td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["MESSAGE"];?></td>    
	<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["STATUSKIRIM"];?></td>			
	<?
	if($arr["STATUS"]=="1" || $arr["STATUS"]=="3"){
	?>
	<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">N/A</td>		
	<?	
	}else{
	?>
	<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?
	echo "<input type='checkbox' name='box1[]' value=".$arr["PHONE"].$arr["MESSAGE"].">";
	?></td>		
	<? } ?>
  </tr>
  <?
	$i++;	}}
	?>
	<tr><td colspan="6" bgcolor="#89acd8" align="center"><? echo "<input type='submit' name='check' value='Kirim!'>";?></td>	
	</tr>
 </table> 	
<!--<input type="submit"  name="kirim" value="SEND SMS" class="but">-->
</form>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a> | <a href="#" class="verdana8blu" onClick="NewWindow('download_text_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',700,250,1);">Download ke Text</a>-->

</body>
</html>