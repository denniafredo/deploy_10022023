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
<b>DAFTAR PENERIMAAN PREMI TOPUP SEKALIGUS<BR /> 
MUTASI <?=$titletglcari;?> </b>
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
    <td bgcolor="#89acd8" align="center">BO</td>
		<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Tertanggung</td>
    <td bgcolor="#89acd8" align="center">Produk</td>
    <td bgcolor="#89acd8" align="center">Cara Bayar</td>
    <td bgcolor="#89acd8" align="center">Lunas Terakhir</td>
    <td bgcolor="#89acd8" align="center">Premi TopUp Skg. (Rp)</td>
		<td bgcolor="#89acd8" align="center">Tgl. Mutasi</td>
    <td bgcolor="#89acd8" align="center">Tgl. Transfer</td>
		<td bgcolor="#89acd8" align="center">Tgl. Mulas</td>
		<td bgcolor="#89acd8" align="center">Polis Switching</td>
    <td bgcolor="#89acd8" align="center">User</td>
	<td bgcolor="#89acd8" align="center">Check<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></td>
  </tr>
  <? 
	$sql = "select ".
              "c.kdrayonpenagih,a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,d.namaproduk,".
							"a.premi, ".
              "to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.usermutasi, ".
              "to_char(a.tgltransfer,'DD/MM/YYYY') tgltransfer, ".
              "to_char(b.tgltransfer,'DD/MM/YYYY') tgltransfer2, ".
			  "(select to_char(max(tglbooked),'DD/MM/YYYY') from $DBUser.TABEL_300_historis_premi where 
			  prefixpertanggungan=b.prefixpertanggungan and nopertanggungan=b.nopertanggungan and tglseatled is not null) lunas,".
			  "(select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=b.kdcarabayar) cara,".
              "to_char(b.mulas,'DD/MM/YYYY') mulas, ".
              "(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.notertanggung) tertanggung, ".
              "b.kdcarabayar,b.nopolswitch  ".
          "from  ".
              //"$DBUser.tabel_223_transaksi_produk a, ".
              "$DBUser.tabel_223_transaksi_topup a, ".
              "$DBUser.tabel_200_pertanggungan b, ".
              "$DBUser.tabel_500_penagih c, ".
              "$DBUser.tabel_202_produk d ".
          "where  ".
              "a.prefixpertanggungan=b.prefixpertanggungan  ".
              "and a.nopertanggungan=b.nopertanggungan ".
              "and a.status is null ".
              "and b.nopenagih=c.nopenagih ".
              "and b.kdstatusfile in ('1','4')  ".
              "and a.kdproduk=d.kdproduk ".
              "and b.kdpertanggungan='2' ".
              "and a.kdbenefit='BNFTOPUPSG'  ".
							$filtercari.
              //"and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ".
					"order by c.kdrayonpenagih,b.mulas";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TERTANGGUNG"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDPRODUK"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["CARA"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["LUNAS"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMI"],2,",",".");?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLMUTASI"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLTRANSFER"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["MULAS"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOPOLSWITCH"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["USERMUTASI"];?></td>
		<?
		echo "<td style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><input type='checkbox' name='box1[]' value=".$arr["NOPERTANGGUNGAN"]."></td>";
		?>
  </tr>
	<? 
	$i++;
	$jmltotal += $arr["PREMI"];
	}
	?>
	<tr bgcolor="#f5d79c">
	 <td align="center" colspan="7"><b>JUMLAH <?=$cabas;?></b></td>
	 <td align="right"><?=number_format($jmltotal,2,",",".");?></td>
	 <td align="right" colspan="6"><? if ($jabatan=="LINK"){
	 echo "<input type='submit' name='check' value='Update'>";}?></td>
	</tr>
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