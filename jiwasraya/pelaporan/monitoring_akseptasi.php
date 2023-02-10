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
         /* print("<select name=" . $inName .  "tgl>\n"); 
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
  */
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Daftar Premi TopUp Sekaligus</title>
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
  <table>
	<tr>
  <td>
	Tahun <?=DateSelector("d"); ?> 
  </td><td>SLA</td><td>
  <?
  if($sla=="5")
	$selected5="selected";
elseif($sla=="4")
	$selected4="selected";
elseif($sla=="3")
	$selected3="selected";
  ?>
  <select name="sla">
<option value="5" <?=$selected5;?>>5</option>
<option value="4" <?=$selected4;?>>4</option>
<option value="3" <?=$selected3;?>>3</option>
</select> hari</td>
 <td colspan="4"><input type="submit" name="submit" value="Cari"</input></td>
 
 </tr>
</table>
<!--</form>-->

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
	//$tgldef .= (strlen(date('d'))==1) ? '0'.date('d') : date('d');
	//$tgldef .= "/";
	//$tgldef .= (strlen(date('m'))==1) ? '0'.date('m') : date('m');
	//$tgldef .= "/";
	$tgldef .= date('Y');

	if(!isset($_POST['dtgl'])){
	 if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	 } else {
	  $tglcari = $tgldef;
	 }
	}
	
	if($_POST['dtgl']=="all" || substr($_GET['tglcari'],0,3)=="all"){
	  $filtercari = "and to_char(a.tglmutasi,'MM/YYYY')='".substr($tglcari,-7)."' ";
		$titletglcari = "BULAN ".substr($tglcari,-7);
	} else {
	  $filtercari = "and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ";
		$titletglcari = "TANGGAL ".$tglcari;
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
<b>DAFTAR MONITORING AKSEPTASI PROPOSAL <?=$titletglcari;?> SLA <?=$sla;?> HARI</b>
<?
if ($HTTP_POST_VARS['check']) {
      	
      	$box=$HTTP_POST_VARS['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				echo "No Data Updated !";
				}
				else
				{
    				foreach ($box as $dear) {
    				$sqa="update $DBUser.tabel_223_transaksi_topup set status='1',tglupdated=sysdate,userupdated='".$userid.
					"' WHERE nopertanggungan='$dear' ".
					"and to_char(tglmutasi,'DD/MM/YYYY')='$tglcari'";
					$DB->parse($sqa);
      				$DB->execute();	
					//echo $sqa;				
        			}						
						}
				}
				?>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
    <td bgcolor="#89acd8" align="center">Kantor Cabang</td>
		<td bgcolor="#89acd8" align="center">Jumlah Proposal</td>
  </tr>
  <? 
	$sql = "SELECT   PREFIXPERTANGGUNGAN,(select namakantor from $DBUser.tabel_001_kantor where kdkantor=PREFIXPERTANGGUNGAN) kantor, COUNT ( * ) jml
			FROM   (SELECT   KDPERTANGGUNGAN,
							 PREFIXPERTANGGUNGAN,
							 NOPERTANGGUNGAN,
							 TGLAPPROVAL,
							 TGLREKAMM,
							 TGLAPPROVAL - TGLREKAMM,
							 TGLLUNAS,
							 TGLAKSEP,
							 TGLAKSEP - TGLLUNAS
					  FROM   (SELECT   NVL (
										  (SELECT   TGLREKAM
											 FROM   $DBUser.TABEL_UL_SPAJ_TEMP
											WHERE   NOSP = A.NOSP
													AND KDKANTOR = PREFIXPERTANGGUNGAN),
										  TGLREKAM
									   )
										  TGLREKAMM,
									   NVL (
										  (SELECT   TGLUNDERWRITING
											 FROM   $DBUser.TABEL_214_UNDERWRITING
											WHERE   PREFIXPERTANGGUNGAN =
													   PREFIXPERTANGGUNGAN
													AND NOPERTANGGUNGAN =
														  A.NOPERTANGGUNGAN),
										  SYSDATE
									   )
										  TGLAPPROVAL,
									   (SELECT   NVL (MAX (TGLSEATLED), SYSDATE)
										  FROM   $DBUser.TABEL_300_HISTORIS_PREMI
										 WHERE   PREFIXPERTANGGUNGAN =
													PREFIXPERTANGGUNGAN
												 AND NOPERTANGGUNGAN =
													   A.NOPERTANGGUNGAN
												 AND KDKUITANSI = 'BP3')
										  TGLLUNAS,
									   (SELECT   NVL (MAX (TGLACCEPTANCE), SYSDATE)
										  FROM   $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN
										 WHERE   PREFIXPERTANGGUNGAN =
													PREFIXPERTANGGUNGAN
												 AND NOPERTANGGUNGAN =
													   A.NOPERTANGGUNGAN)
										  TGLAKSEP,
									   A.*
								FROM   $DBUser.TABEL_200_PERTANGGUNGAN A
							   WHERE       TO_CHAR (TGLREKAM, 'YYYY') >= $tglcari
									   AND KDSTATUSFILE <> 7
									   AND KDPERTANGGUNGAN = '1')
					 WHERE   (TGLAPPROVAL - TGLREKAMM) + (TGLAKSEP - TGLLUNAS) > $sla)
		GROUP BY   PREFIXPERTANGGUNGAN order by count(*) desc";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	
	if ($arr["JML"]>=5) {
		$warna='#FF0000';
	} elseif ((($arr["JML"]<5) && ($arr["JML"]>=3))) {
		$warna='#FF7F00';
	} else {
		$warna='#007F00';
	}

  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b><font color="<?=$warna;?>"><?=$arr["PREFIXPERTANGGUNGAN"].' - '.$arr["KANTOR"];?></font></b></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<a href="#" onClick="window.open('./monitoring_akseptasi_detail.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&tglcari=<?=$tglcari;?>&sla=<?=$sla;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["JML"];?></a></td>
    
		
  </tr>
	<? 
	$i++;
	$jmltotal += $arr["PREMI"];
	}
	?>
	
</table>
</form>
<? 
if($act=="print"){} else {
?>
<? 
echo "<hr size=1>";
echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a> | ";
echo "<a href=# onclick=NewWindow('daftar_topupskg.php?act=print&tglcari=".$tglcari."&jamawal=".$jamawal."&menitawal=".$menitawal."&jamakhir=".$jamakhir."&menitakhir=".$menitakhir."','',1000,400,1)>Cetak</a>";
}
?>
</body>
</html>