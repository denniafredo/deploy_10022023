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
					echo "<option value=all>--all--</option>";
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
          $startYear = date( "Y", $useDate)+1; 
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
<title>Daftar Jatuh Tempo Saving Plan</title>
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
<body onLoad="window.print();window.close()">
<?
} else {
?>
<body topmargin="10">

<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">


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
	
	if($_POST['dtgl']=="all" || substr($_GET['tglcari'],0,3)=="all"){
	  $filtercari = "and to_char(a.expirasi,'MM/YYYY')='".substr($tglcari,-7)."' ";
		$titletglcari = "BULAN ".substr($tglcari,-7);
	} else {
	  $filtercari = "and to_char(a.expirasi,'DD/MM/YYYY')='$tglcari' ";
		$titletglcari = "TANGGAL ".$tglcari;
	}
?>
<b>DAFTAR POLIS GADAI VS NILAI TUNAI<BR /> 
Per <?=date("m/Y");?> </b><br>
<a href="#" class="verdana8blu" onClick="NewWindow('daftar_gadaivstebus_dl.php?','Downloadexcel',600,250,1);">Dowload ke Excel</a>

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
    <td bgcolor="#89acd8" align="center">BO</td>
	<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Tgl. Gadai</td>
    <td bgcolor="#89acd8" align="center">Pokok</td>
	<td bgcolor="#89acd8" align="center">Bunga</td>
	<td bgcolor="#89acd8" align="center">Total</td>
    <td bgcolor="#89acd8" align="center">Nilai Tunai</td>
  </tr>
  <? 
	$sql = "SELECT   *
  FROM   (SELECT   KDRAYONPENAGIH,a.prefixpertanggungan,
                   a.nopertanggungan,
                   TO_CHAR(a.tglgadai,'DD/MM/YYYY') tglgadai,
                   (saldopinjaman - nvl(angsuranpokok,0)) pokok,
                   bunga,
                   NVL ( (saldopinjaman - nvl(angsuranpokok,0)), 0) + NVL (bunga, 0)
                      total,
                   DECODE (
                      kdstatusfile,
                      '1',
                      $DBUser.tebusaktif (a.prefixpertanggungan,
                                  a.nopertanggungan,
                                  TO_CHAR (SYSDATE, 'MMYYYY')),
                      $DBUser.tebusnonaktif (a.prefixpertanggungan,
                                     a.nopertanggungan,
                                     TO_CHAR (SYSDATE, 'MMYYYY'))
                   )
                      ntebus
            FROM   $DBUser.TABEL_700_GADAI a,
                   $DBUser.TABEL_200_PERTANGGUNGAN b,
                   $DBUser.TABEL_701_PELUNASAN_GADAI c,
                   $DBUser.TABEL_500_PENAGIH d
           WHERE       a.prefixpertanggungan = b.prefixpertanggungan
                   AND a.nopertanggungan = b.nopertanggungan
                   AND a.prefixpertanggungan = c.prefixpertanggungan
                   AND a.nopertanggungan = c.nopertanggungan
                   AND b.nopenagih=d.nopenagih
                   AND a.status = '3'
                   AND d.kdrayonpenagih='$kantor'
                   AND kdstatusfile IN ('1', '4', 'L')
                   AND (c.tglbooked, c.periodebayar) =
                         (SELECT   MAX (tglbooked), MAX (periodebayar)
                            FROM   $DBUser.TABEL_701_PELUNASAN_GADAI
                           WHERE   prefixpertanggungan =
                                      a.prefixpertanggungan
                                   AND nopertanggungan = a.nopertanggungan
                                   AND tglgadai = a.tglgadai)) WHERE TOTAL<NTEBUS";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDRAYONPENAGIH"];?> </td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLGADAI"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right" ><?=number_format($arr["POKOK"],2,",",".");?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["BUNGA"],2,",",".");?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["TOTAL"],2,",",".");?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["NTEBUS"],2,",",".");?></td>
  </tr>
	<? 
	$i++;
	$jmltotal += $arr["PREMI"];
	}
	?>
	<tr bgcolor="#f5d79c">
	 <td align="center" colspan="7"><b> &nbsp;<?//=$cabas;?></b></td>
	 <td align="right"><?//=number_format($jmltotal,2,",",".");?></td>
	</tr>
</table>
</form>
<? 
if($act=="print"){} else {
?>
<? 
echo "<hr size=1>";
echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
//echo "<a href=# onclick=NewWindow('daftar_topupskg.php?act=print&tglcari=".$tglcari."&jamawal=".$jamawal."&menitawal=".$menitawal."&jamakhir=".$jamakhir."&menitakhir=".$menitakhir."','',1000,400,1)>Cetak</a>";
}
?>
</body>
</html>