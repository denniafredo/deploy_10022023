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
<SCRIPT LANGUAGE="JavaScript" SRC="js/global.js"></SCRIPT>
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
<body topmargin="10" class="contentPage" onLoad="hideAll('_menuHistory_',2);">
									
							

<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">
  <table>
	<tr>
  <td>
	Tanggal Mutasi <?=DateSelector("d"); ?> 
  </td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 
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
	  $filtercari = "and to_char(a.expirasi,'MM/YYYY') in ('".substr($tglcari,-7)."', null) ";
	  //$filtercari = "and to_char(a.expirasi,'DD/MM/YYYY')='$tglcari' ";
		$titletglcari = "TANGGAL ".$tglcari;
	}
?>
<b>DAFTAR JATUH TEMPO RIDER UNIT LINK<BR /> 
MUTASI <?=$titletglcari;?> </b>
<!--<form name="getpremi1" action="<?=//$PHP_SELF;?>" method="post">-->
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
    				$sqa="update $DBUser.tabel_223_transaksi_switchfund set status='1',tglaksep=sysdate,useraksep='".$userid.
					"' WHERE nopertanggungan='$dear' ".
					"and to_char(tglpengajuan,'DD/MM/YYYY')='$tglcari'";
					$DB->parse($sqa);
      				$DB->execute();	
					//echo $sqa;				
        			}						
						}
				}
				?>
                
                <TABLE ALIGN="CENTER" WIDTH="100%" >
										<TR ALIGN="CENTER">
											<TH width="3%" bgcolor="#7dc2d9"> + </TH>
											<TH bgcolor="#7dc2d9">TicketID</TH>
											<TH bgcolor="#7dc2d9">ComplainDate</TH>
											<TH bgcolor="#7dc2d9">Category</TH>
											<TH bgcolor="#7dc2d9">Status</TH>
											<TH bgcolor="#7dc2d9">EntryBy</TH>
											<TH bgcolor="#7dc2d9">UpdateBy</TH>
											<TH bgcolor="#7dc2d9">Action</TH>
										</TR>										

										<!-- MASTER 1 -->
										<TR>
										<TH ALIGN="CENTER" onClick="showLevel('_menuHistory_', 1, 2);">
										<IMG ID="_menuHistory_1Img" WIDTH="8" HEIGHT="8">
										</TH>
										<TD>ROW_1</TD>
										<TD>12-Sep-2012</TD>
										<TD>XXXXX</TD>
										<TD>YYYYYY</TD>
										<TD>ZZZZZ</TD>
										<TD>PPPPPP</TD>
										<TD>QQQQQQ</TD>											
										</TR>
										<!-- END OF MASTER 1 -->

											<!-- SUB DETAIL MASTER 1 -->
												<TR>	
												<TD COLSPAN="1"></TD>
												<TD COLSPAN="7">	
												<DIV ID="_menuHistory_1" style="display:none;">
												
												
													<TABLE WIDTH="100%" align="center" border="1" style="border-collapse: collapse" bordercolor="#00509f">
													<TR align="center"><TD colspan="7">HISTORIS XXX</TD></TR>
													<TR align="center">
														<TD width="15%" bgcolor="#55aaff">LastUpdateOn</TD>
														<TD width="12%" bgcolor="#55aaff">LastUpdateBy</TD>
														<TD width="10%" bgcolor="#55aaff">Status</TD>
														<TD bgcolor="#55aaff">Description</TD>
														<TD bgcolor="#55aaff">Remarks/Action</TD>
														<TD WIDTH="7%" bgcolor="#55aaff">View</TD>							
													</TR>
													
													
													<TR valign="top">
														<TD >1111</TD>
														<TD >2222</TD>
														<TD >3333</TD>
														<TD >4444</TD>
														<TD >5555</TD>
													</TR>
												
												</TABLE>
												
											
												</DIV>
												</TD>
												</TR>
											<!-- END OF SUB DETAIL MASTER 1 -->



										<!-- MASTER 2 -->
										<TR>
										<TH ALIGN="CENTER" onClick="showLevel('_menuHistory_', 2, 2);">
										<IMG ID="_menuHistory_1Img" WIDTH="8" HEIGHT="8">
										</TH>
										<TD>ROW_2</TD>
										<TD>12-Sep-2012</TD>
										<TD>GGGGG</TD>
										<TD>HHHHH</TD>
										<TD>IIIII</TD>
										<TD>JJJJJ</TD>
										<TD>KKKKK</TD>											
										</TR>
										<!-- END OF MASTER 2 -->
										

											<!-- OF SUB DETAIL MASTER 2 -->
										<TR >
										<TD COLSPAN="1"></TD>
												<TD COLSPAN="7">
												<DIV ID="_menuHistory_2" style="display:none;">
												
												
														<TABLE WIDTH="100%" align="center" border="1" style="border-collapse: collapse" bordercolor="#00509f">
													<TR align="center"><TD colspan="7">HISTORIS YYY</TD></TR>
													<TR align="center">
														<TD width="15%" bgcolor="#55aaff">LastUpdateOn</TD>
														<TD width="12%" bgcolor="#55aaff">LastUpdateBy</TD>
														<TD width="10%" bgcolor="#55aaff">Status</TD>
														<TD bgcolor="#55aaff">Description</TD>
														<TD bgcolor="#55aaff">Remarks/Action</TD>
														<TD WIDTH="7%" bgcolor="#55aaff">View</TD>							
													</TR>			
														<TR valign="top">
															<TD >6666</TD>
															<TD >7777</TD>
															<TD >8888</TD>
															<TD >9999</TD>
															<TD >0000</TD>
														</TR>													
													</TABLE>
													
													
												</DIV>
												</TD>
												</TR>
											<!-- END OF SUB DETAIL MASTER 2 -->
						</table>
                        
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
    <td bgcolor="#89acd8" align="center">+</td>
    <td bgcolor="#89acd8" align="center">BO</td>
		<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Tertanggung</td>
    <td bgcolor="#89acd8" align="center">Produk</td>
    <td bgcolor="#89acd8" align="center">Rider</td>
		<td bgcolor="#89acd8" align="center">Tgl. Mulas</td>
		<td bgcolor="#89acd8" align="center">Tgl. Expirasi</td>
    <td bgcolor="#89acd8" align="center">Premi Rider</td>
    <td bgcolor="#89acd8" align="center">Cara Bayar Rider</td>
  </tr>
  <? 
	$sqlx = "select ".
              "c.kdrayonpenagih,a.prefixpertanggungan,a.nopertanggungan,d.namaproduk,b.kdproduk,".
			  "(select count(a.kdjenisbenefit) from $DBUser.tabel_223_transaksi_produk where prefixpertanggungan=a.prefixpertanggungan 
and nopertanggungan=a.nopertanggungan and kdjenisbenefit='R' AND expirasi=a.expirasi) X,".
              "to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.userupdated, ".
              "to_char(a.expirasi,'DD/MM/YYYY') expirasi, ".
              "to_char(b.mulas,'DD/MM/YYYY') mulas, kdbenefit, ".
              "(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.notertanggung) tertanggung, ".
              "b.kdcarabayar,b.nopolswitch, a.premi, a.kdcbanuitas  ".
          "from  ".
              //"$DBUser.tabel_223_transaksi_produk a, ".
              "$DBUser.TABEL_223_TRANSAKSI_produk a, ".
              "$DBUser.tabel_200_pertanggungan b, ".
              "$DBUser.tabel_500_penagih c, ".
              "$DBUser.tabel_202_produk d ".
          "where  ".
              "a.prefixpertanggungan=b.prefixpertanggungan  ".
              "and a.nopertanggungan=b.nopertanggungan ".
              //"--and a.status='0' ".
              "and b.nopenagih=c.nopenagih ".
              "and b.kdstatusfile in ('1')  ".
              "and b.kdproduk=d.kdproduk ".
              "and b.kdpertanggungan='2' ".
			  "and c.kdrayonpenagih='$kantor' and substr(a.kdproduk,1,3) in ('JL2','JL3') AND a.KDBENEFIT NOT IN ('BNFCRIL', 'JMNKEC')".
              //"and a.kdbenefit='BNFTOPUPSG'  ".
							$filtercari.
              //"and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ".
					"order by c.kdrayonpenagih,b.mulas";
  	//echo "<br />".$sql."<br />";
	$sql = "select ".
              "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,d.namaproduk,b.kdproduk ".
			  /*"(select count(a.kdjenisbenefit) from $DBUser.tabel_223_transaksi_produk where prefixpertanggungan=a.prefixpertanggungan 
and nopertanggungan=a.nopertanggungan and kdjenisbenefit='R' AND expirasi=a.expirasi) X,".*/
              //"to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.userupdated, ".
             // "to_char(a.expirasi,'DD/MM/YYYY') expirasi, ".
             // "to_char(b.mulas,'DD/MM/YYYY') mulas, count(kdbenefit) kdbenefit, ".
              ",count(kdbenefit) kdbenefit, (select namaklien1 from $DBUser.tabel_100_klien where noklien=b.notertanggung) tertanggung ".
             // "b.kdcarabayar,b.nopolswitch, premi1 b.premi".
          "from  ".
              //"$DBUser.tabel_223_transaksi_produk a, ".
              "$DBUser.TABEL_223_TRANSAKSI_produk a, ".
              "$DBUser.tabel_200_pertanggungan b, ".
              "$DBUser.tabel_500_penagih c, ".
              "$DBUser.tabel_202_produk d ".
          "where  ".
              "a.prefixpertanggungan=b.prefixpertanggungan  ".
              "and a.nopertanggungan=b.nopertanggungan ".
              //"--and a.status='0' ".
              "and b.nopenagih=c.nopenagih ".
              "and b.kdstatusfile in ('1')  ".
              "and b.kdproduk=d.kdproduk ".
              "and b.kdpertanggungan='2' ".
			  "and c.kdrayonpenagih='$kantor' and substr(a.kdproduk,1,3) in ('JL2','JL3') AND a.KDBENEFIT NOT IN ('BNFCRIL', 'JMNKEC')".
              //"and a.kdbenefit='BNFTOPUPSG'  ".
							$filtercari.
              //"and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ".
			  "group by c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,d.namaproduk,b.kdproduk, b.notertanggung ".
					"order by c.kdrayonpenagih";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();			
		$i = 1;
		$nr=1;
   	while ($arr=$DB->nextrow()) {
	
	//$np=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td ALIGN="CENTER" onClick="showLevel('_menuHistory_', <?=$i;?>, 2);"><IMG ID="_menuHistory_1Img" WIDTH="8" HEIGHT="8"></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TERTANGGUNG"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDPRODUK"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDBENEFIT"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["MULAS"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["EXPIRASI"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=number_format($arr["PREMI"],2,",",".");?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDCBANUITAS"];?></td>
  </tr>
  <tr>
  <DIV ID="_menuHistory_<?=i;?>" style="display:none;">
												
												
														<TD>XXX</TD>
													
													
												</DIV>
	</tr>
	<?
	
	$np=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];
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
echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
//echo "<a href=# onclick=NewWindow('daftar_topupskg.php?act=print&tglcari=".$tglcari."&jamawal=".$jamawal."&menitawal=".$menitawal."&jamakhir=".$jamakhir."&menitakhir=".$menitakhir."','',1000,400,1)>Cetak</a>";
}
?>
</body>
</html>