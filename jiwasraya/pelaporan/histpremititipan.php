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
<br />
<hr />
<? 
$sql = "SELECT nopolbaru FROM $DBUser.tabel_200_pertanggungan WHERE prefixpertanggungan = '$prefix' AND nopertanggungan = '$noper'";
$DB->parse($sql);
$DB->execute();
$r = $DB->nextrow();
?>
<b>Historis Titipan Premi Polis <?=($r['NOPOLBARU']?$r['NOPOLBARU']:$prefix.$noper) ?> <?=$tglcari;?></b>
  
<form method="POST" action="#" name="uploadtitipan">	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
	<td bgcolor="#89acd8" align="center">NOMORPOLIS</td>	
	<td bgcolor="#89acd8" align="center">TGL. SEATLED</td>	
	<td bgcolor="#89acd8" align="center">PREMI TITIPAN</td>
    <td bgcolor="#89acd8" align="center">SALDO TITIPAN</td>	
	<td bgcolor="#89acd8" align="center">JENIS TRANSAKSI</td>
	<!--td bgcolor="#89acd8" align="center">ACTION <input type="checkbox" name="xxx" onClick="Cekbok(this.form.xxx.checked);" /></td-->
  	</tr>
	<?
	$sql = "SELECT   prefixpertanggungan,
         nopertanggungan,
         TO_CHAR (tglbayar, 'dd/mm/yyyy') tgltrans,
         TO_CHAR (tglseatledtitipan, 'dd/mm/yyyy') tglseatled,
         premititipan,
         'ENTRY TITIPAN' jenistransaksi,
         NVL (premititipansisa, 0) saldo,
         status
  FROM   $DBUser.TABEL_309_PREMITITIPAN a
  where prefixpertanggungan='$prefix' and nopertanggungan='$noper'
  union         
SELECT   prefixpertanggungan,
         nopertanggungan,
         TO_CHAR (tgltrans, 'dd/mm/yyyy') tgltrans,
         TO_CHAR (tglseatledtitipan, 'dd/mm/yyyy') tglseatled,
         premititipan,
         (SELECT   namatransaksi
            FROM   $DBUser.tabel_309_kode_titipan_premi
           WHERE   kdtransaksi = a.kdtransaksi)
            jenistransaksi,
         NVL (saldo, 0) saldo,
         status
  FROM   $DBUser.TABEL_309_PREMITITIPAN_trans a
 WHERE   prefixpertanggungan='$prefix' and nopertanggungan='$noper'";
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
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLTRANS"];?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREMITITIPAN"];?></td>				
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SALDO"];?></td>				
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["JENISTRANSAKSI"];?></td>


  </tr>
  <?
   $totpremipend+=$arr["PREMITITIPANSISA"];
	$i++;	}
	?>
 </table> 	

</form>
<hr />

 </body>
</html>