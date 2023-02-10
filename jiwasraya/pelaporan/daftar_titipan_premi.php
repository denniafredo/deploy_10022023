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
 checkedAll('uploadtitipan', true);
 }
 else
 {
 checkedAll('uploadtitipan', false);
 }
}
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
<td>Tanggal Proses : <?=DateSelector("d");?> <td colspan="2"><input type="submit" name="submit" value="Cari"> </td><td>Kategori Produk :</td><td>
<select name="kategori"><option value="link">Link</option><option value="nonlink">Non Link</option></select></td>
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
	 echo $sqladd."<br>";
	 //die;
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
	
	
	
if($tglcari!=""){ 
?>

        
        
        
        
<form method="POST" action="#" name="uploadtitipan" enctype="multipart/form-data">	
 
 
<b>Daftar Titipan Premi Bulan <?=$tglcari;?></b>
  

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
	<td bgcolor="#89acd8" align="center">NOMORPOLIS</td>
	<td bgcolor="#89acd8" align="center">RAYON PENAGIH</td>
	<td bgcolor="#89acd8" align="center">NAMA PEMEGANG POLIS</td>
	<td bgcolor="#89acd8" align="center">STATUS POLIS</td>
	<td bgcolor="#89acd8" align="center">TGL. AKHIR PREMI</td>
	<td bgcolor="#89acd8" align="center">PREMI</td>
	<td bgcolor="#89acd8" align="center">RIDER</td>
	<td bgcolor="#89acd8" align="center">TOTAL PREMI</td>
	<td bgcolor="#89acd8" align="center">PREMI TITIPAN</td>
	<td bgcolor="#89acd8" align="center">SALDO PREMI TITIPAN</td>
	<td bgcolor="#89acd8" align="center">TGL. BAYAR</td>
	<td bgcolor="#89acd8" align="center">CARA BAYAR</td>
	<td bgcolor="#89acd8" align="center">TGL LUNAS TERAKHIR</td>
	<td bgcolor="#89acd8" align="center">TERTUNGGAK PER</td>
    <td bgcolor="#89acd8" align="center">NO. HP</td>
	<td bgcolor="#89acd8" align="center">ACTION <input type="checkbox" name="xxx" onClick="Cekbok(this.form.xxx.checked);" /></td>
  	</tr>	
	<?
	if($kategori=="link" && $kantor=="KP")
		$kategoriprod=" AND substr(b.kdproduk,1,3) in ('JL4','JL3','JL2')";
	elseif($kategori=="nonlink" && $kantor=="KP")
		$kategoriprod=" AND substr(b.kdproduk,1,3) not in ('JL4','JL3','JL2') ";
	else
		$kategoriprod=" AND substr(b.kdproduk,1,3) not in ('JL4','JL3','JL2') AND c.kdrayonpenagih='$kantor' ";
	$sql = "select a.prefixpertanggungan,a.nopertanggungan,kdrayonpenagih,
(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopemegangpolis) namapempol,premititipan,premititipansisa,
(select no_ponsel from $DBUser.tabel_100_klien where noklien=b.nopemegangpolis) nohp,
(select namastatusfile from $DBUser.tabel_299_status_file where kdstatusfile=b.kdstatusfile)statusfile,to_char(b.tglakhirpremi,'dd/mm/yyyy') tglakhirpremi,
(select sum(decode(kdvaluta,'1',premitagihan,'3',
premitagihan*(select kurs from $DBUser.tabel_999_kurs where to_char(tglkursberlaku,'mmyyyy')=to_char(sysdate,'mmyyyy') and kdvaluta='3'),
'0',(premitagihan/b.indexawal)*(select kurs from $DBUser.tabel_999_kurs where to_char(tglkursberlaku,'mmyyyy')=to_char(sysdate,'mmyyyy') and kdvaluta='0'))) 
from $DBUser.tabel_300_historis_premi where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and 
tglbooked>=tgllastpayment and tglseatled is null) premi,
(select sum(nilairp) from $DBUser.tabel_300_historis_rider where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and 
tglbooked>=tgllastpayment and tglseatled is null)premirider,
to_char(tglbayar,'dd/mm/yyyy')tglbayar,
(select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=b.kdcarabayar) carabayar,
(select max(tglbayar) from $DBUser.tabel_300_historis_premi where prefixpertanggungan=b.prefixpertanggungan and nopertanggungan=b.nopertanggungan
and tglseatled is not null and status <>'X' )lunasterakhir,
(select min(tglbooked) from $DBUser.tabel_300_historis_premi where prefixpertanggungan=b.prefixpertanggungan and nopertanggungan=b.nopertanggungan
and tglseatled is null ) mulaitunggak,
to_char(a.tglbayar,'dd/mm/yyyy') tglbayar,to_char(a.tglseatledtitipan,'dd/mm/yyyy') tglseatled,a.norekva,
    premititipan,nvl(premititipansisa,0)premititipansisa,a.buktisetor,a.status,a.status_pendapatan,
    (select namastatusfile from $DBUser.tabel_299_status_file where kdstatusfile=b.kdstatusfile)statusfile 
    from $DBUser.TABEL_309_PREMITITIPAN a,$DBUser.tabel_200_pertanggungan b,$DBUser.tabel_500_penagih c where a.nopertanggungan=b.nopertanggungan and a.premititipansisa>0
    and a.prefixpertanggungan=b.prefixpertanggungan and b.nopenagih=c.nopenagih ".$kategoriprod." and to_char(tglseatledtitipan,'mm/yyyy')='".substr($tglcari,3,7)."'";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
	//die;
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
	if($_GET['act']=='del'){
	$sql1="delete from $DBUser.tabel_309_premititipan where prefixpertanggungan='".$_GET['pref']."' and nopertanggungan='".$_GET['nopert']."' and to_char(tglseatledtitipan,'dd/mm/yyyy')='".$_GET['tglseatled']."' ";
	$DB1->parse($sql1);
	$DB1->execute();
	//echo $sql;
	}
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
	
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?>.</td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"];?>-<?=$arr["NOPERTANGGUNGAN"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAPEMPOL"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["STATUSFILE"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLAKHIRPREMI"];?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMI"];?></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMIRIDER"];?></td>		
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMIRIDER"]+$arr["PREMI"];?></td>		
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMITITIPAN"];?></td>		
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMITITIPANSISA"];?></td>		
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLBAYAR"];?></td>		
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["CARABAYAR"];?></td>		
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["LUNASTERAKHIR"];?></td>		
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["MULAITUNGGAK"];?></td>		
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOHP"];?></td>		
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<a href="#" onClick="NewWindow('../polis/prosespremirampung2.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"]; ?>&noper=<?=$arr["NOPERTANGGUNGAN"]; ?>&tglmohon=<?=$arr["TGLBAYAR"];?>&premititipan=<?=$arr["PREMITITIPANSISA"]; ?>','',800,600,1)"> Pelunasan Premi dan Rider</a> | 
		<a href="#" onClick="NewWindow('../akunting/cetakslippremirampung.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"]; ?>&noper=<?=$arr["NOPERTANGGUNGAN"]; ?>&tglmohon=<?=$arr["TGLBAYAR"];?>&premititipan=<?=$arr["PREMITITIPANSISA"]; ?>','',800,600,1)"> Cetak SLIP Premi dan Rider</a> | 
		<a href="#" onClick="NewWindow('../polis/prosespremirampung1.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"]; ?>&noper=<?=$arr["NOPERTANGGUNGAN"]; ?>&tglmohon=<?=$arr["TGLBAYAR"];?>&premititipan=<?=$arr["PREMITITIPANSISA"]; ?>','',800,600,1)"> Pelunasan Rider</a> | 
		<a href="#" onClick="NewWindow('../akunting/cetakslippremirampung.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"]; ?>&noper=<?=$arr["NOPERTANGGUNGAN"]; ?>&tglmohon=<?=$arr["TGLBAYAR"];?>&premititipan=<?=$arr["PREMITITIPANSISA"]; ?>','',800,600,1)"> Cetak SLIP Premi Rider</a> |
		<a href="#" onClick="NewWindow('retur_titipan_premi.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>&tglseatled=<?=$tglcari; ?>&premititipan=<?=$arr["PREMITITIPANSISA"];?>&tgltrans=<?=$arr["TGLTRANS"];?>','Downloadexcel',1200,300,1);">Retur Titipan Premi</a> | 	
		<a href="#" onClick="NewWindow('sip_retur_titipan_premi.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>&tglseatled=<?=$tglcari; ?>&premititipan=<?=$arr["PREMITITIPANSISA"];?>&tgltrans=<?=$arr["TGLTRANS"];?>','Downloadexcel',1200,300,1);">SIP Retur Titipan Premi</a>  	
		<!--a href="#" onClick="NewWindow('../akunting/cetaksipreturpremi.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>&tglseatled=<?=$tglcari; ?>&premititipan=<?=$arr["PREMITITIPANSISA"];?>&tgltrans=<?=$arr["TGLTRANS"];?>','Downloadexcel',600,250,1);">Cetak Sip Retur</a-->  	
		</td>
		</tr>
  <?
    $totaltitipanpremi+=$arr["PREMITITIPAN"];
	$i++;	}
	?>
	<!--tr>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" colspan="3"><b>Total Premi Titipan</b> </td>		
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><?=$totaltitipanpremi; ?></b></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" colspan="2">			
	</tr> 
	<tr>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><input type="text" name="prefixpert" size="1" maxlength="2">-<input type="text" name="nopert" size="9"></td>
		<td>&nbsp;</td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><input type="text" name="tglbayar" maxlength="10"></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><input type="text" name="buktibayar"></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><input type="text" name="premititipan"></td>				
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
			<input type="hidden" name="metodeproses" value="<?=$metode;?>"><input type="hidden" name="tglcariadd" value="<?=$tglcari; ?>"><input type="submit" name="addTitipanPremi" value="Tambah Data"></td>
	</tr> 
<tr><td colspan="6"></td><td><input type="submit" name="approvetitipanpremi" value="Approve Titipan Premi"><input type="submit" name="postingtitipanpremi" value="Posting Titipan Premi Ke GL-Link"></td></tr-->		
 </table> 	

</form>

<a href="#" class="verdana8blu" onClick="NewWindow('../akunting/cetakslip_titipanpremi.php?tglseatled=<?=$tglcari; ?>&premititipan=<?=$totaltitipanpremi?>','Downloadexcel',600,250,1);">Cetak Slip Titipan Premi</a> | 
<a href="#" class="verdana8blu" onClick="NewWindow('../akunting/cetakrekaptitipanpremi.php?tglseatled=<?=$tglcari; ?>','Downloadexcel',600,250,1);">Cetak Rekap Titipan Premi</a> | 
<a href="#" class="verdana8blu" onClick="NewWindow('../akunting/cetaklamptitipanpremi.php?tglseatled=<?=$tglcari; ?>','Downloadexcel',600,250,1);">Cetak Lampiran Titipan Premi</a> | 

<!-- 
Jurnal Balik Titipan Premi ke Pendapatan Lain-lain
-->
<hr />
<? 
} ?>
<br /><a href="../submenu.php?mnuinduk=600" class="verdana8blu">Sistem Penagihan</a>
</body>
</html>