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



<form action="<?=$PHP_SELF;?>" method="post" enctype="multipart/form-data" name="getcal">
<?

?>
<table>
        <tr><!--<td >Unggah File </td><td><input type="file" name="ffilename" size="70" value=""><br /></td>-->
        <td>Nama Bank
	<select name="kdbank">
	  	<option value="MDR" <? if ($kdbank=="MDR") {echo "selected";} else { echo "";}?>>MANDIRI</option>
		<option value="BNI" <? if ($kdbank=="BNI") {echo "selected";} else { echo "";}?>>BNI</option>
        <option value="BRI" <? if ($kdbank=="BRI") {echo "selected";} else { echo "";}?>>BRI</option>
        <option value="BTN" <? if ($kdbank=="BTN") {echo "selected";} else { echo "";}?>>BTN</option>
        <option value="CTB" <? if ($kdbank=="CTB") {echo "selected";} else { echo "";}?>>CITIBANK 1BILL</option>
        <option value="CBN" <? if ($kdbank=="CBN") {echo "selected";} else { echo "";}?>>BNI CREDIT CARD</option>
        <option value="POS" <? if ($kdbank=="POS") {echo "selected";} else { echo "";}?>>CITIBANK PT.POS</option>
		<option value="MD5" <? if ($kdbank=="MD5") {echo "selected";} else { echo "";}?>>MANDIRI 521</option>
		<option value="MD9" <? if ($kdbank=="MD9") {echo "selected";} else { echo "";}?>>MANDIRI 943</option>
		<option value="MD6" <? if ($kdbank=="MD6") {echo "selected";} else { echo "";}?>>MANDIRI 644</option>
		<option value="BPK" <? if ($kdbank=="BPK") {echo "selected";} else { echo "";}?>>BPD KALBAR</option>
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
	}
	else if ($kdbank=='BNI') {
		$namabank='AUTO DEBET BANK NEGARA INDONESIA (BNI)';
		$namalike='BNI';
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
		$namalike='BNI';
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
    if ($ffilename!="none"){
				    $k = $i-1;
            $mode = 1; //   1 = overwrite mode; 2 = create new with incremental extention; 3 = do nothing if exists
            $my_uploader = new uploader;
    				$my_uploader->max_filesize(600000000);
    				$my_uploader->max_image_size(3000000, 3000000);
					
					set_time_limit(600); //ren add time limit
					
					$my_uploader->upload("ffilename", "", ".txt");
					
    				$my_uploader->save_file("../file/files/", $mode);
    				if ($my_uploader->error) {
						 echo  $errmeg .= "Upload file gagal! ".$my_uploader->error . "<br>";
        		} else {
          			$file_name = $my_uploader->file['name'];
          			print($file_name . " berhasil di-upload!<br>");
								$updatefile = ",NAMA_FILE='$file_name'";
								
        		//=============upload=============
				//echo $_FILES[ffilename][name];
				  $fcontents = file ("../file/files/".$_FILES[ffilename][name]); 
				  # expects the csv file to be in the same dir as this script
				  $sqa="select max(id)+1 mid from $DBUser.TABEL_315_UPLD_AUTODEBET where kdbank='$kdbank'";
				  //echo $sqa;
				  $DB->parse($sqa);
      			  $DB->execute();
				  $ar=$DB->nextrow();	
				  
				  for($i=0; $i<sizeof($fcontents); $i++) { 
					  $line = trim($fcontents[$i]); 
					  $arr = explode(",", $line); 
					  //echo str_replace("","xx",implode("','", str_replace("'","`",$arr)));
					  //$arr = explode("\t", $line); 
					  //$arr = explode(";", $line); 
					  #if your data is comma separated
					  # instead of tab separated, 
					  # change the '\t' above to ',' 
					  //echo "'x".implode("','", str_replace("'","`",$arr)) ."x'</br>";
					  if (("'x".implode("','", str_replace("'","`",$arr)) ."x'")=="'xx'") {$sql="";} else {
					  	 $sql = "insert into $DBUser.TABEL_315_UPLD_AUTODEBET (kdbank,id,status,tglproses,peserta_text) values ('$kdbank','".($ar['MID']+$i)."','0',TO_DATE('".$tglcari."','DD/MM/YYYY'),'". 
								  implode(" ", str_replace(",",".",str_replace("'","`",$arr))) ."')";}
					  //mysql_query($sql);
					  //echo $sql ."<br>";
					   //echo implode(" ", str_replace("'","`",str_replace(",",".",$arr)))."</ br>";

					   $DB->parse($sql);
      			  	   $DB->execute();
					   $qupload++;
					  //if(mysql_error()) {
					  //   echo mysql_error() ."<br>\n";
					  //} 
				}
				//=============upload=============
				}
				//echo ($qupload+1).'record(s) inserted...';
    }
		else
		{ 
					  $updatefile = "";
		}
		
}
?>

<b>HASIL <?=$namabank;?> <br />BULAN <?=$tglcari;?></b>
  <? 
  
if ($kirim) { // di edit oleh fendy sesuai permintaan atar tanggal 10 februari 2016 /* XXXXXX */
  $sql = "SELECT   DECODE(FLAG_SMS,'1','SENT',NULL) FSMS,TO_CHAR(TGLBOOKED,'MMYYYY') BOOKED,NOPOLIS,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,
         JUMLAHTAGIHAN / 100 JUMLAHTAGIHAN,
         /*NVL (NO_PONSEL, PHONETETAP02) PHONE,*/
		 NVL(NVL(NVL(NVL (NO_PONSEL, PHONETAGIH02), PHONETAGIH01), PHONETETAP02), PHONETETAP01) PHONE,
		 'Pemegang Polis Yth, terimakasih pembayaran polis anda no. '||NVL(B.NOPOLBARU, B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN)||'/'||TO_CHAR(TGLBOOKED,'MMYYYY')||' sebesar Rp '||(JUMLAHTAGIHAN / 100)|| ' telah berhasil terdebet tgl $tglcari. Untuk info hub.1500176' SMS
  FROM   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET A,
         $DBUser.TABEL_200_PERTANGGUNGAN B,
         $DBUser.TABEL_100_KLIEN C
 WHERE       A.NOPOLIS = B.PREFIXPERTANGGUNGAN || B.NOPERTANGGUNGAN
         AND NOPEMEGANGPOLIS = NOKLIEN
         AND to_char(A.tglrekam,'dd/mm/yyyy')='$tglcari' and A.kdbank='$kdbank' and A.statuspembayaran='2'";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	$DB1->parse($sql);
    $DB1->execute();
	while ($arr1=$DB1->nextrow()) {
		//echo '</br>'.$arr1["SMS"];
		//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arr1["PHONE"]."','".$arr1["SMS"]."')";
		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arr1["PHONE"]."','".$arr1["SMS"]."','NOTIFIKASI SUKSES DEBET','".$arr1["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arr1["NOPOLIS"]."')";
		 //echo $mysqlins;
		//mysql_query($mysqlins);
		
		if (mysql_query($mysqlins)) echo '</br>Sukses : '.$arr1["SMS"];
		
		$update="update $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET set flag_sms='1' where TO_CHAR(TGLBOOKED,'MMYYYY')='".$arr1["BOOKED"]."' and NOPOLIS='".$arr1["NOPOLIS"]."'";
		$DB->parse($update);
      	$DB->execute();
	}
	echo '</br>';
	}
	
if ($ret) { // di edit oleh fendy sesuai permintaan atar tanggal 10 februari 2016 /* XXXXXX */
  $sql = "SELECT   DECODE(FLAG_SMS,'1','SENT',NULL) FSMS, TO_CHAR(TGLBOOKED,'MMYYYY') BOOKED,NOPOLIS,
         JUMLAHTAGIHAN / 100 JUMLAHTAGIHAN,
         /*NVL (NO_PONSEL, PHONETETAP02) PHONE,*/
		 NVL(NVL(NVL(NVL (NO_PONSEL, PHONETAGIH02), PHONETAGIH01), PHONETETAP02), PHONETETAP01) PHONE,
		 'Pemegang Polis Yth, terimakasih pembayaran polis anda no. '|| NVL(B.NOPOLBARU, B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN) ||'/'||TO_CHAR(TGLBOOKED,'MMYYYY')||' sebesar Rp '||(JUMLAHTAGIHAN / 100)|| ' telah berhasil terdebet tgl $tglcari. Untuk info hub.1500176' SMS
  FROM   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET A,
         $DBUser.TABEL_200_PERTANGGUNGAN B,
         $DBUser.TABEL_100_KLIEN C
 WHERE       A.NOPOLIS = B.PREFIXPERTANGGUNGAN || B.NOPERTANGGUNGAN
         AND NOPEMEGANGPOLIS = NOKLIEN
         AND to_char(A.tglrekam,'dd/mm/yyyy')='$tglcari' and A.kdbank='$kdbank' and A.statuspembayaran='2'";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
	
   	?>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
	<td bgcolor="#89acd8" align="center">NOPOL</td>
    <td bgcolor="#89acd8" align="center">JML DEBET</td>
    <td bgcolor="#89acd8" align="center">BOOKED</td>
    <td bgcolor="#89acd8" align="center">PHONE</td>
	<td bgcolor="#89acd8" align="center">SMS</td>
    <td bgcolor="#89acd8" align="center">STATUS</td>
  	</tr>
	<?
	
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOPOLIS"];?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["JUMLAHTAGIHAN"];?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BOOKED"];?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PHONE"];?></td>
	<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SMS"];?></td>
    <td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["FSMS"];?></td>			
  </tr>
  <?
	$i++;	}}
	?>
	
 </table> 	
<input type="submit"  name="kirim" value="SEND SMS" class="but">
</form>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a> | <a href="#" class="verdana8blu" onClick="NewWindow('download_text_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',700,250,1);">Download ke Text</a>-->

</body>
</html>