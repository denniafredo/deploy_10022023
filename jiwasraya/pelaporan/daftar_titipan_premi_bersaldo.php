<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
  $DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
			
  function DateSelector($inName, $useDate=0) 
  { 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
         /* print("<select name=" . $inName .  "tgl>\n"); 

					
		  for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</select>"); */

  
     // Bulan	
  		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
        /*  print("<select name=" . $inName .  "bln>\n"); 
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
          print("</select>"); */
  
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
<!--td>Pilih Metode
	</td><td><select name="metode">
		<option value="" <? if ($metode=="") {echo "selected";} else { echo "";}?>>----------Pilih Metode----------</option>
		<option value="1" <? if ($metode=="1") {echo "selected";} else { echo "";}?>>Upload Titipan Premi</option>
		<option value="2" <? if ($metode=="2") {echo "selected";} else { echo "";}?>>Jurnal Balik Pendapatan</option>
		<option value="3" <? if ($metode=="3") {echo "selected";} else { echo "";}?>>Jurnal Balik Premi Rampung</option>
		<option value="4" <? if ($metode=="4") {echo "selected";} else { echo "";}?>>Jurnal Retur Premi</option>
	</select>  </td--><td>Tanggal Proses : <?=DateSelector("d");?> <td colspan="2"><input type="submit" name="submit" value="Cari"> </td>
</tr>
        
</table>
</form>

</div>
<? 
if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	} else{
  	$tglcari	=	 //( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
  					//( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
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
<br />
<hr />
<?

if(isset($_POST["upload"]))
{
    require "../file/upload/fileupload.class.php";
    if ($ffilename!="none"){
				    $k = $i-1;
            $mode = 1; //   1 = overwrite mode; 2 = create new with incremental extention; 3 = do nothing if exists
            $my_uploader = new uploader;
    				$my_uploader->max_filesize(600000000);
    				$my_uploader->max_image_size(3000000, 3000000);
					$my_uploader->upload("ffilename", "", ".txt");
					
    				$my_uploader->save_file("../file/upload/uploadttppremi/", $mode);
    				if ($my_uploader->error) {
						 echo  $errmeg .= "Upload file ".$my_uploader->file["name"]." ss gagal! ".$my_uploader->error . "<br>";
        		} else {
          			$file_name = $my_uploader->file['name'];
          			print($file_name . " berhasil di-upload!<br>");
								$updatefile = ",NAMA_FILE='$file_name'";						
					
//=============upload=============				
				  $fcontents = file ("../file/upload/uploadttppremi/".$file_name); 
				$qupload=@$qupload;
				  for($i=0; $i<sizeof($fcontents); $i++) { 
					  $line = trim($fcontents[$i]); 					 
					  $arrinput = explode("\t", $line); 				  					  					  
						$sql = "insert into $DBUser.tabel_309_premititipan (prefixpertanggungan,nopertanggungan,tglbayar,tglseatledtitipan,premititipan,premititipansisa,norekva,status,tglrekam,userrekam,kantorproses)  
					  values('".$arrinput[1]."','".$arrinput[2]."',to_date('".$arrinput[3]."','dd/mm/yyyy'),trunc(sysdate),'".$arrinput[4]."','".$arrinput[4]."','".$arrinput[5]."','0',sysdate,user,'".$arrinput[6]."')";					 
					  //insert into tabel_309_premititipan (prefixpertanggungan,nopertanggungan,tglbayar,tglseatledtitipan,premititipan,premititipansisa,norekva,status,tglrekam,userrekam,kantorproses) 
					  //values ('CF','001790095','', values('CF','001790095',to_date('12/07/2017','dd/mm/yyyy'),trunc(sysdate),'1000000','1000000','118000522525','0',sysdate,user,'CF');
					 // echo $sql .";<br>";
					  $DB->parse($sql);
					  $DB->execute();
					  $qupload++;					  
					
				}
				//=============upload=============					
				}				
    }
		else
		{ 
					  $updatefile = "";
		}
	$tglcari=$tglcariadd;
	$metode=$metodeproses;	
}

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
					//echo $sql."<br>";
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
					//$DB->parse($sqlpost);
					//$DB->execute();					
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
					//$DB->parse($sqlpost);
					//$DB->execute();					
					 }
					}
	$tglcari=$tglcariretur;
	$metode=$metodeproses;
}	
	
	
 
   	?>
<b>Daftar Titipan Premi Bersaldo <?=$tglcari;?></b>
  <? 

  
   	?>
<form method="POST" action="#" name="uploadtitipan">	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
	<td bgcolor="#89acd8" align="center">NOMORPOLIS</td>
	<td bgcolor="#89acd8" align="center">JENIS PRODUK</td>
	<td bgcolor="#89acd8" align="center">STATUS POLIS</td>
	<td bgcolor="#89acd8" align="center">TGL. BAYAR</td>
	<td bgcolor="#89acd8" align="center">NOMOR VA</td>
	<td bgcolor="#89acd8" align="center">PREMI TITIPAN</td>
    <td bgcolor="#89acd8" align="center">SALDO TITIPAN</td>	
	<td bgcolor="#89acd8" align="center">STATUS</td>
	<!--td bgcolor="#89acd8" align="center">ACTION <input type="checkbox" name="xxx" onClick="Cekbok(this.form.xxx.checked);" /></td-->
  	</tr>
	<?
	if($kantor!="KP"){
		$kantornya="  and kantorproses='$kantor' ";
	}else{
		$kantornya="";
	}
	$sql = "select prefixpertanggungan,nopertanggungan,to_char(tglbayar,'dd/mm/yyyy') tglbayar,to_char(tglseatledtitipan,'dd/mm/yyyy') tglseatled,".
		   "(select decode(substr(kdproduk,1,2),'JL','Unit Link','Non Unitlink') from $DBUser.tabel_200_pertanggungan where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) jenisproduk,".
		   "norekva,premititipan,nvl(premititipansisa,0)premititipansisa,buktisetor,status,status_pendapatan ".
		   //"(select status from $DBUser.tabel_309_pendapatan_lain where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and tglseatled=a.tglseatledtitipan) statusapp,".
		   //"(select status_gllink from $DBUser.tabel_309_pendapatan_lain where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and tglseatled=a.tglseatledtitipan) status_gllink ".
		   "from $DBUser.TABEL_309_PREMITITIPAN a".
		   " where status='2' and status_gllink='1' and premititipansisa>0 and kantorproses='$kantor'";
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
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"];?>-<?=$arr["NOPERTANGGUNGAN"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["JENISPRODUK"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">AKTIF</td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLBAYAR"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOREKVA"];?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMITITIPAN"];?></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMITITIPANSISA"];?></td>				
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["STATUS"];?></td>
		<!--td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
			<? 
			//if($arr["STATUS_PENDAPATAN"]=="1"){
				
			//}else{
				?>
				<input type="checkbox" name="box1[]" value="<? echo $tglcari."#".$arr["PREFIXPERTANGGUNGAN"]."#".$arr["NOPERTANGGUNGAN"]."#".$arr["PREMITITIPAN"]."#".$arr["PREMITITIPANSISA"]."#".$arr["TGLBAYAR"]."#".$arr["TGLSEATLED"]."#".$arr["NOREKVA"]; ?>">
				<?
			//}
			?>
		</td-->
  </tr>
  <?
   $totpremipend+=$arr["PREMITITIPANSISA"];
	$i++;	}
	?>
<!--tr><td colspan="7"></td><td>
<input type="hidden" name="metodeproses" value="<?=$metode;?>">
<input type="hidden" name="tglcaripend" value="<?=$tglcari; ?>">
<input type="submit" name="prosespendapatan" value="Proses Ke Pendapatan Lain-Lain">
<input type="submit" name="approvependapatan" value="Approve Pendapatan Lain-Lain">
<input type="submit" name="postpendapatan" value="Posting Jurnal Pendaparan Lain Ke GL-Link"></td></tr-->	
 </table> 	

</form>
<hr />
<!--a href="#" class="verdana8blu" onClick="NewWindow('../akunting/cetakslip_titipanpendapatan.php?tglseatled=<?=$tglcari; ?>&premititipan=<?=$totpremipend?>','Downloadexcel',600,250,1);">Cetak Memorial Pendapatan Lain-lain</a> | 
<a href="#" class="verdana8blu" onClick="NewWindow('../akunting/cetaklamptitipanpend.php?tglseatled=<?=$tglcari; ?>','Downloadexcel',600,250,1);">Cetak Lampiran Pendapatan Lain-lain</a--> 

<!--
Akhir Jurnal Balik Titipan Premi ke Pendapatan Lain-lain
-->

<!-- 
Jurnal Balik Titipan premi ke premi rampung
-->
<hr />
<? 
 ?>
<br /><a href="../submenu.php?mnuinduk=600" class="verdana8blu">Sistem Penagihan</a>
</body>
</html>