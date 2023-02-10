<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
	
function DateSelector($inName, $useDate=0) { 
	$monthName=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
	if ($useDate==0) { 
		$useDate=Time(); 
	} 
	//make day selector 
	print("<select name=".$inName."tgl>\n"); 
	echo "<option value=\"ALL\">ALL</option>";
	for ($currentDay=1; $currentDay<=31; $currentDay++) { 
		print("<option value=\"$currentDay\""); 
		if (intval(date("d", $useDate))==$currentDay) { 
			print(" selected"); 
		} 
		print(">$currentDay\n"); 
	} 
	print("</select>");  
	// make month selector 
	print("<select name=".$inName."bln>\n");
	//echo "<option value=\"ALL\">ALL</option>";
	for ($currentMonth=1; $currentMonth<=12; $currentMonth++) { 
		print("<option value=\""); 
		print(intval($currentMonth)); 
		print("\""); 
		if (intval(date("m", $useDate))==$currentMonth) { 
			print(" selected");
		} 
		print(">".$monthName[$currentMonth]."\n"); 
	} 
	print("</select>"); 
	// make year selector 
	print("<select name=".$inName."thn>\n"); 
	$startYear=date("Y", $useDate); 
	for ($currentYear=$startYear-3; $currentYear<=$startYear+5;$currentYear++) {
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	} 
	print("</select>"); 
} 

?> 
<link href="../jws.css" rel="stylesheet" type="text/css">
<font face="Verdana" size="2"><b>Pencarian XL-iNdO FAQs</b></font><br>
<form name="date" action="<? PHP_SEFT ?>"> 
<font face="Verdana" size="2">Userid</font> 
<input type="text" name="usr" size="10">
<font face="Verdana" size="2">Kantor</font> 
<select name="kdkantor" onfocus="highlight(event)" class="c" onchange="return getPenagih(document.chry);">
		<?
		  $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' order by kdkantor";
		  $DB->parse($sqa);
			$DB->execute();					 
		  while ($arr=$DB->nextrow()) {
			  if ($arr["KDKANTOR"]==$kantor) {
		       print( "<option value=".$arr["KDKANTOR"]." selected>".$arr["KDKANTOR"]."</option>" );
		    } else {
				   print( "<option value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]."</option>" );
				}
			}
		?>		
</select>
<font face="Verdana" size="2">Tanggal :  <?php DateSelector("v"); ?></font> 
<input type="submit" value="CARI" name="cari">
<input type="hidden" value="1" name="on">
</form> 
<!------------------------------ End date selector ----------------------------->
<? 

$vtgl="0".$vtgl;
$vtgl=substr($vtgl,-2);
$vbln="0".$vbln;
$vbln=substr($vbln,-2);
$usr=strtoupper($usr);

if ($vtgl=="LL"){
   $tanggal="to_char(tglmasuk,'MMYYYY')='$vbln$vthn'";
} else {
   $tanggal="to_char(tglmasuk,'DDMMYYYY')='$vtgl$vbln$vthn'";
}
switch($usr){
  case "": $usernya=''; break;
	default :$usernya="userid='".$usr."' and ";
}
 
if(!$vtgl){ 

} else {
 echo "<hr size=1>";
 $tglcari=($vtgl=="LL")? "Bulan " : "Tanggal $vtgl/";
 echo "<a class=\"verdana10blk\">Pencarian >> $usr Kantor : $kdkantor $tglcari$vbln/$vthn</a>";
 echo "<br><br>";

 ?>
	<table border="0" cellspacing="1" cellpadding="2" width="800" bgcolor="#E7F5F8">
	<tr>
	 <td colspan="3"></td>
	</tr>
	 <?
		#-------------------------------------------------------------- countrow
  	$query = "select idqa,kdkantor,userid,namauser,".
		         "to_char(tglmasuk,'DD/MM/YYYY HH24:MI:SS') tglmasuk,tanya,jawab,status ".
						 "from $DBUser.tabel_faq where ".
						 "$tanggal and ".
						 "".$usernya."".
						 "kdkantor='$kdkantor' and ".
						 "status='0' order by idqa desc";
		$DB->parse($query);
		$DB->execute();
		$i = 0;
		while ($arr=$DB->nextrow()) {
		//$i = $i + 1;
		$idqa=$arr["IDQA"];
		$user=$arr["USERID"];
		$kdkantor=$arr["KDKANTOR"];
		$namauser=$arr["NAMAUSER"];
		$tglmasuk=$arr["TGLMASUK"];
		$tanya=$arr["TANYA"];
		$jawab=$arr["JAWAB"];
		
		switch($jawab) {
				case '': $jawab = "<font color=red>BELUM DIJAWAB</font>"; break;
				default: $jawab = $jawab;		
		}
    
  print( "  <tr>\n" );
  print( "    <td width=\"8%\" class=\"verdana8blk\" valign=\"top\" align=\"left\"><b>Tanya</b></td>\n" );
  print( "    <td width=\"2%\" class=\"verdana8blk\" valign=\"top\" align=\"left\">:</td>\n" );
  print( "    <td width=\"90%\" class=\"verdana8blk\"><font color=\"#000080\">$tanya</font></td>\n" );
  print( "  </tr>\n" );
  print( "  <tr>\n" );
  print( "    <td class=\"verdana8blk\"></td>\n" );
  print( "    <td class=\"verdana8blk\"></td>\n" );
  print( "    <td class=\"verdana8blk\"><font color=red>$namauser $tglmasuk  ID:$idqa USERID:$user KANTOR:$kdkantor</font></td>\n" );
  print( "  </tr>\n" );
  print( "  <tr>\n" );
  print( "    <td class=\"verdana8blk\" valign=\"top\" align=\"left\"><b>Jawab</b></td>\n" );
  print( "    <td class=\"verdana8blk\" valign=\"top\" align=\"left\">:</td>\n" );
  print( "    <td class=\"verdana8blk\">$jawab</td>\n" );
  print( "  </tr>" );
	print( "  <tr>\n" );
  print( "    <td class=\"verdana10blk\" colspan=\"3\"><hr size=1></td>\n" );
  print( "  </tr>" );	
		$i++;
		}
	
		?>
</table>
 <? } ?>
<hr size="1">
<a href="faqs.php?lihat=&start=1&end=5&page=1" class="verdana10blk">Kembali ke XL-iNdO FAQs</a>	

