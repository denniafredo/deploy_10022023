<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  $DB=new database($userid, $passwd, $DBName);
			
  function DateSelector($inName, $useDate=0) 
  { 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Pembayaran Polis Switching</title>
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
<? 
if($act=="print"){
?>
<body onload="window.print();window.close()">
<?
} else {
?>
<body topmargin="10">

<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">
  <table>
	<tr>
  <td>
	<? 
	if(!isset($_POST['jamawal'])){
	  $jamawal    = "08"; 
		$menitawal  = "00";
		$jamakhir   = "11"; 
		$menitakhir = "00";
	}
	?>
	   Tanggal <?=DateSelector("d"); ?> 
     Jam <input type="text" name="jamawal" value="<?=$jamawal;?>" size="3" />:<input type="text" name="menitawal" value="<?=$menitawal;?>" size="3" />
     s/d <input type="text" name="jamakhir" value="<?=$jamakhir;?>" size="3" />:<input type="text" name="menitakhir" value="<?=$menitakhir;?>" size="3" /> 
	</td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 </tr>
</table>
</form>
</div>
<? 
}
?>
<?
  if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	} else {
  	$tglcari	=	 ( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
  					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
  					$_POST['dthn'];
	}
	$tgldef .= (strlen(date('d'))==1) ? '0'.date('d') : date('d');
	$tgldef .= "/";
	$tgldef .= (strlen(date('m'))==1) ? '0'.date('m') : date('m');
	$tgldef .= "/";
	$tgldef .= date('Y');

	if(!isset($_POST['dtgl'])){
	 if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	 } else {
	  $tglcari = $tgldef;
	 }
	}
?>
<b>DAFTAR REKAPITULASI PEMBAYARAN SWITCHING POLIS PP.<BR /> 
TANGGAL <?=$tglcari;?> JAM <?=$jamawal.":".$menitawal;?> S/D <?=$jamakhir.":".$menitakhir;?> </b>

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
    <td bgcolor="#89acd8" align="center">BRANCH OFFICE</td>
		<td bgcolor="#89acd8" align="center">NILAI SWITCHING</td>
    <td bgcolor="#89acd8" align="center">JML. POLIS</td>
  </tr>
  <? 
  $sql = "select ".
			 	 			" e.kdrayonpenagih,".
      				"(select namakantor from $DBUser.tabel_001_kantor where kdkantor=e.kdrayonpenagih) as namakantor,".
      				"sum(b.jumlah) as jmlpremi,count(a.nopertanggungan) as jmlpolis ".
         "from ".
              "$DBUser.tabel_900_sip b,".
              "$DBUser.tabel_800_pembayaran_keluar a,".
              "$DBUser.tabel_700_tebus c,".
              "$DBUser.tabel_200_pertanggungan d,  ".
							"$DBUser.tabel_500_penagih e ".
         "where ".
              "a.prefixpertanggungan=c.prefixpertanggungan ".
              "and a.nopertanggungan=c.nopertanggungan ".
              "and c.isswitching='1' ".
              "and a.prefixpertanggungan=d.prefixpertanggungan ".
              "and a.nopertanggungan=d.nopertanggungan ".
							"and d.nopenagih=e.nopenagih ".
              "and a.nomorsip=b.nomorsip ".
              "and a.kdpembayaran='T01' ".
              "and b.rekening1 in ('282000','148250000') ".
							"and c.status='3' ".
              "and to_char(a.tglseatled,'DD/MM/YYYY HH24:MI') ".
							"between '$tglcari $jamawal:$menitawal' and '$tglcari $jamakhir:$menitakhir' ".
							"group by e.kdrayonpenagih";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?> - <?=$arr["NAMAKANTOR"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["JMLPREMI"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$arr["JMLPOLIS"];?></td>
	</tr>
	<? 
	$i++;
	$jmltotal += $arr["JMLPREMI"];
	$jmlpolis += $arr["JMLPOLIS"];
	}
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td><b>JUMLAH <?=$cabas;?></b></td>
	 <td align="right"><?=number_format($jmltotal,2,",",".");?></td>
	 <td align="right"><?=$jmlpolis;?></td>
	</tr>
</table>

<? 
if($act=="print"){} else {
?>
<? 
echo "<hr size=1>";
echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a> | ";
echo "<a href=# onclick=NewWindow('pembayaran_switching_rekap.php?act=print&tglcari=".$tglcari."&jamawal=".$jamawal."&menitawal=".$menitawal."&jamakhir=".$jamakhir."&menitakhir=".$menitakhir."','',1000,400,1)>Cetak</a> | ";
echo "<a href=# onclick=NewWindow('pembayaran_switching_sip.php?act=print&tglcari=".$tglcari."&jamawal=".$jamawal."&menitawal=".$menitawal."&jamakhir=".$jamakhir."&menitakhir=".$menitakhir."&jmlpremi=".$jmltotal."','',1000,400,1)>Cetak SIP</a>";
}
?>
</body>
</html>