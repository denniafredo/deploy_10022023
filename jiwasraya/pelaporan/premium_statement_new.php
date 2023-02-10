<?  
  	include "../../includes/session.php"; 
  	include "../../includes/starttimer.php"; 
  	include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";



  $DB = new Database($userid, $passwd, $DBName);
	//$DBUL=New database($userid, $passwd, $DBName);
  $DBX = new Database($userid, $passwd, $DBName);
  $DBN = new Database($userid, $passwd, $DBName);
	//$DBX=new database($userid, $passwd, $DBName);
	
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Premium Statement</title>
</head>
<style type="text/css">
<!-- 
body, td, select, input {
 font-family: Verdana;
 font-size: 10px;
} 


    .myButton {
        
        -moz-box-shadow: -7px -5px 13px -3px #1564ad;
        -webkit-box-shadow: -7px -5px 13px -3px #1564ad;
        box-shadow: -7px -5px 13px -3px #1564ad;
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5));
        background:-moz-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-webkit-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-o-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-ms-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:linear-gradient(to bottom, #79bbff 5%, #378de5 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5',GradientType=0);
        
        background-color:#79bbff;
        
        -moz-border-radius:9px;
        -webkit-border-radius:9px;
        border-radius:9px;
        
        border:1px solid #337bc4;
        
        display:inline-block;
        color:#ffffff;
        font-family:Times New Roman;
        font-size:15px;
        font-weight:bold;
        padding:5px 15px;
        text-decoration:none;
        
        text-shadow:-5px 3px 11px #528ecc;
        
    }
    .myButton:hover {
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff));
        background:-moz-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-webkit-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-o-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-ms-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:linear-gradient(to bottom, #378de5 5%, #79bbff 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff',GradientType=0);
        
        background-color:#378de5;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }

-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
DAFTAR PREMIUM STATEMENT
<?
function toTglIna($tglid)
{
      $tgl = substr($tglid,-2);
			$bul = substr($tglid,5,2);
			$thn = substr($tglid,0,4);
			switch ($bul)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
			$formattanggal = $tgl." ".strtoupper($bln)." ".$thn;
			return $formattanggal;
}
#---dateadd
#$newdate = dateadd("d",3,"2006-12-12");	#  add 3 days to date
#$newdate = dateadd("s",3,"2006-12-12");	#  add 3 seconds to date
#$newdate = dateadd("m",3,"2006-12-12");	#  add 3 minutes to date
#$newdate = dateadd("h",3,"2006-12-12");	#  add 3 hours to date
#$newdate = dateadd("ww",3,"2006-12-12");	#  add 3 weeks days to date
#$newdate = dateadd("m",3,"2006-12-12");	#  add 3 months to date
#$newdate = dateadd("yyyy",3,"2006-12-12");	#  add 3 years to date
#$newdate = dateadd("d",-3,"2006-12-12");	#  subtract 3 days from date

function dateAdd($interval,$number,$dateTime) {
		
	$dateTime = (strtotime($dateTime) != -1) ? strtotime($dateTime) : $dateTime;	   
	$dateTimeArr=getdate($dateTime);
				
	$yr=$dateTimeArr[year];
	$mon=$dateTimeArr[mon];
	$day=$dateTimeArr[mday];
	$hr=$dateTimeArr[hours];
	$min=$dateTimeArr[minutes];
	$sec=$dateTimeArr[seconds];

	switch($interval) {
		case "s"://seconds
			$sec += $number; 
			break;

		case "n"://minutes
			$min += $number; 
			break;

		case "h"://hours
			$hr += $number; 
			break;

		case "d"://days
			$day += $number; 
			break;

		case "ww"://Week
			$day += ($number * 7); 
			break;

		case "m": //similar result "m" dateDiff Microsoft
			$mon += $number; 
			break;

		case "yyyy": //similar result "yyyy" dateDiff Microsoft
			$yr += $number; 
			break;

		default:
			$day += $number; 
         }	   
				
		$dateTime = mktime($hr,$min,$sec,$mon,$day,$yr);
		$dateTimeArr=getdate($dateTime);
		
		$nosecmin = 0;
		$min=$dateTimeArr[minutes];
		$sec=$dateTimeArr[seconds];

		if ($hr==0){$nosecmin += 1;}
		if ($min==0){$nosecmin += 1;}
		if ($sec==0){$nosecmin += 1;}
		
		if ($nosecmin>2){ 	return(date("Y-m-d",$dateTime));} else { 	return(date("Y-m-d G:i:s",$dateTime));}
}

#---end dateadd 
echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------

	//echo $sqx;

function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Tanggal
		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
        print("<select name=" . $inName .  "tgl>\n"); 
//				print ("<option value=0>---</option>");
        for($currentDay = 1; $currentDay<= 31;$currentDay++) 
        { 
            print("<option value=\"$currentDay\""); 
            //if(date( "j", $useDate)==$currentDay) 
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
//				print ("<option value=0>------</option>");
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
            //if(date( "n", $useDate)==$currentMonth) 
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
//        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
        for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            //if(date( "Y", $useDate)==$currentYear) 
			if($selected==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
				//print ("<option value=ALL>*</option>");
        print("</select>"); 
} 

echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
//echo "      <td class=\"verdana9blk\">Periode Entry Proposal/Transaksi</td>";
echo "      <td class=\"verdana9blk\">Periode Pembayaran</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> s/d </td> ";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("s");
echo "      </td>";

echo "      <td class=\"verdana9blk\"> </td> ";

echo "      <td class=\"verdana9blk\"> ";
echo "<select name='kdkantor'>";
    
    if($kantor == 'KP'){
      $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
                 "order by kdkantor";
            $DB->parse($sqa);
            $DB->execute(); 
            while ($arr=$DB->nextrow()) {
              echo "<option ";
                if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
                echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
            }           
       echo "<option ";
       if ($kdkantor=='all'){ echo " selected"; }
       echo " value=all> ALL </option>";
       echo "</select>";
echo "      </td>";
}else{
  $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' and kdkantor = '$kantor' ".
                 "order by kdkantor";
            $DB->parse($sqa);
            $DB->execute(); 
            while ($arr=$DB->nextrow()) {
              echo "<option readonly";
                if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
                echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
            }           
       
       echo "</select>";
echo "      </td>";
}
  			
echo "      <td class=\"verdana9blk\"> ";
//               DateSelector("s");
			echo "<select name='kdbank'>";

  			$sqa="select kdbank,namabank from $DBUser.TABEL_399_BANK
			union select '%' kdbank,'ALL' namabank from $DBUser.TABEL_399_BANK";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDBANK"]==$kdbank){ echo " selected"; }
      					echo " value=".$arr["KDBANK"].">".$arr["KDBANK"]." - ".$arr["NAMABANK"]."</option>";
  					}
  			
				
 			echo "</select>";
echo "      </td>";

echo "      <td class=\"verdana9blk\"> ";
			echo "<select name='kdcarabayar'>";

  			$sqa="select * from $DBUser.TABEL_305_CARA_BAYAR";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDCARABAYAR"]==$kdcarabayar){ echo " selected"; }
      					echo " value=".$arr["KDCARABAYAR"].">".$arr["KDCARABAYAR"]." - ".$arr["NAMACARABAYAR"]."</option>";
  					}  			
			echo "<option ";
			if ($kdcarabayar=='all'){ echo " selected"; }
			echo " value=all>--ALL--</option>";	
 			echo "</select>";
echo "      </td>";

echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";

$sqln="SELECT TO_CHAR(TANGGAL,'DD/MM/YYYY') TANGGAL, NOMOR FROM $DBUser.TABEL_999_SURAT_MATERAI WHERE TANGGAL=(SELECT MAX(TANGGAL) FROM $DBUser.TABEL_999_SURAT_MATERAI)";
	$DBN->parse($sqln);
	$DBN->execute();		
	$nomor=$DBN->nextrow();
				//echo $sqlcari;
	$tglmtr=$nomor["TANGGAL"];
	$nomtr=$nomor["NOMOR"];
	
echo "    </tr>";
echo "    <tr>";
if($kantor == 'KP'){
  echo "    <td colspan='4'>";
  echo "<input type=\"text\" name=\"tglsrt\" value='".$tglmtr."' size=\"20\">";
  echo "<input name=\"nosrt\" type=\"text\" value='".$nomtr."' size=\"50\">";
  echo "<input type=\"submit\" name=\"surat\" id=\"button\" value=\"UPDATE\">";
  echo "    </td>";
}else{

}
echo "    </tr>";
echo "  </form>";
echo "  </table>";


			
echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------

if($cari){
			$tglDari=substr('00'.$dtgl,-2)."/".substr('00'.$dbln,-2)."/".$dthn;
			$tglSampai=substr('00'.$stgl,-2)."/".substr('00'.$sbln,-2)."/".$sthn;

			$tglAwalCari=$sthn."0101";			 		 
			$tglDariCari=$dthn.substr('00'.$dbln,-2).substr('00'.$dtgl,-2);
			$tglSampaiCari=$sthn.substr('00'.$sbln,-2).substr('00'.$stgl,-2);
      echo "PERIODE PEMBAYARAN ".$tglDari." s/d ".$tglSampai."<br><br>";
	  
	  if ($kdcarabayar=='all'){
	  	$carabayar="";
	  }
	  else {
	  	$carabayar=" AND b.kdcarabayar = '$kdcarabayar' ";
	  }
	  if($kdkantor=="all")
      $kodekantor=" ";
    else
      $kodekantor=" AND f.kdkantor = '$kdkantor' ";
	  $sqlx= "SELECT b.prefixpertanggungan,b.nopertanggungan, b.prefixpertanggungan || b.nopertanggungan AS nopol,
           b.nopol AS nopollama,
           DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
           e.namaklien1,
           e.alamattagih01,
           e.alamattagih02,
           e.kodepostagih,
		   b.kdproduk,
		   b.kdcarabayar, c.kdrayonpenagih, 
		   (SELECT cb.namacarabayar from $DBUser.TABEL_305_CARA_BAYAR cb where cb.kdcarabayar=b.kdcarabayar) AS carabayar,
      (SELECT MAX(k.NAMAKOTAMADYA)
      FROM $DBUser.TABEL_109_KOTAMADYA k
      WHERE k.KDKOTAMADYA = e.KDKOTAMADYATAGIH) AS kodya
			FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
				   $DBUser.TABEL_200_PERTANGGUNGAN b,
				   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
				   $DBUser.TABEL_500_PENAGIH c,
				   $DBUser.TABEL_100_KLIEN e,
				   $DBUser.TABEL_001_KANTOR f
		   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
				   AND b.nopertanggungan = d.nopertanggungan
				   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
				   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
				   AND TO_CHAR(a.tglbooked,'MMYYYY') = TO_CHAR(d.tglbooked,'MMYYYY')
				   AND d.tglseatled BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
				   AND b.nopenagih = c.nopenagih
				   AND e.noklien = b.nopembayarpremi
				   AND c.kdrayonpenagih = f.kdkantor ".$kodekantor." AND b.autodebet = '1'
				   AND b.kdbank like '$kdbank'
				   ".$carabayar."
		GROUP BY   b.prefixpertanggungan,
				   b.nopertanggungan,
				   b.nopol,
				   b.kdvaluta,
				   b.kdproduk,
				   e.namaklien1,
				   e.alamattagih01,
				   e.alamattagih02,
				   e.kodepostagih, b.kdcarabayar, c.kdrayonpenagih, e.KDKOTAMADYATAGIH";
				   
				   
		$sql = "select
PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NOPOL,NOPOLLAMA,NOTASIVALUTA,NAMAKLIEN1,ALAMATTAGIH01,
ALAMATTAGIH02,KODEPOSTAGIH,kdproduk,KDCARABAYAR,CARABAYAR,KODYA,PREMI, KDRAYONPENAGIH,  (SELECT g.NAMAPROPINSI
                    FROM $DBUser.TABEL_108_PROPINSI g
                   WHERE KDPROPINSITAGIH = g.KDPROPINSI)
                    NAMAPROPINSI,
(SELECT max(nilaimeterai) From $DBUser.TABEL_999_BATAS_MATERAI  
 WHERE a.premi between batasbawahpremi and batasataspremi) materai  
from 
(      SELECT   b.prefixpertanggungan,
               b.nopertanggungan,
               b.prefixpertanggungan || b.nopertanggungan AS nopol,
               b.nopol AS nopollama,
               DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
               e.namaklien1,
               e.alamattagih01,
               e.alamattagih02,
			   b.kdproduk,
               e.kodepostagih,
               b.kdcarabayar, c.kdrayonpenagih,  e.KDPROPINSITAGIH,
			   
			   
			   
               (SELECT   cb.namacarabayar
                  FROM   $DBUser.TABEL_305_CARA_BAYAR cb
                 WHERE   cb.kdcarabayar = b.kdcarabayar)
                  AS carabayar,
               (SELECT   MAX (k.NAMAKOTAMADYA)
                  FROM   $DBUser.TABEL_109_KOTAMADYA k
                 WHERE   k.KDKOTAMADYA = e.KDKOTAMADYATAGIH)
                  AS kodya,
               sum(TO_NUMBER(JUMLAHTAGIHAN)/100) premi
        FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
               $DBUser.TABEL_200_PERTANGGUNGAN b,
               $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
               $DBUser.TABEL_500_PENAGIH c,
               $DBUser.TABEL_100_KLIEN e,
               $DBUser.TABEL_001_KANTOR f
			   
       WHERE       b.prefixpertanggungan = d.prefixpertanggungan
               AND b.nopertanggungan = d.nopertanggungan
               AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
               AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
               AND TO_CHAR(a.tglbooked,'MMYYYY') = TO_CHAR(d.tglbooked,'MMYYYY')
               AND d.tglseatled BETWEEN TO_DATE ('".$tglDari."', 'DD/MM/YYYY')
                                   AND  TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')
               AND b.nopenagih = c.nopenagih
               AND e.noklien = b.nopemegangpolis
               AND c.kdrayonpenagih = f.kdkantor			  
			   ".$kodekantor."
               AND b.autodebet = '1'
               AND b.kdbank LIKE '$kdbank'
			   ".$carabayar."
    GROUP BY   b.prefixpertanggungan,
               b.nopertanggungan,
               b.nopol,
               b.kdvaluta,
               e.namaklien1,
               e.alamattagih01,
               e.alamattagih02,
               e.kodepostagih,
			   b.kdproduk,
               b.kdcarabayar,
			   c.kdrayonpenagih, 
               e.KDKOTAMADYATAGIH,  e.KDPROPINSITAGIH) a                              
           where rownum < 100000";		   
	  }	
	  
	  //echo $sql;
	  //die;
//echo "<a href=# onclick=NewWindow('download_virtual_acc.php?tglDari=".$tglDari."&tglSampai=".$tglSampai."','',700,400,1)>Download XLS</a>";				
?>
<br />
<a class="myButton" href="#" onClick="window.open('./pop_ps.php?tglDari=<?=$tglDari;?>&tglSampai=<?=$tglSampai;?>&kdkantor=<?=$kdkantor;?>&kdbank=<?=$kdbank;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>&kdcarabayar=<?=$kdcarabayar;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		CETAK PREMIUM STATEMENT</a>&nbsp;<a class="myButton" href="#" onClick="window.open('./premium_statement_dl.php?tglDari=<?=$tglDari;?>&tglSampai=<?=$tglSampai;?>&kdkantor=<?=$kdkantor;?>&kdbank=<?=$kdbank;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>&kdcarabayar=<?=$kdcarabayar;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		DOWNLOAD DAFTAR PREMIUM STATEMENT</a>
<?
if (isset($surat)){
$sqln="delete from $DBUser.TABEL_999_SURAT_MATERAI WHERE TO_CHAR(TANGGAL,'DD/MM/YYYY')='$tglsrt'";
//echo $sqln;
$DBN->parse($sqln);
$DBN->execute();

$sqln="insert into $DBUser.TABEL_999_SURAT_MATERAI (tanggal,nomor) values (TO_DATE('$tglsrt','DD/MM/YYYY'),'$nosrt')";
$DBN->parse($sqln);
$DBN->execute();
//echo $sqln;
}

?>
		<br><br>   
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
	<td bgcolor="#89acd8" align="center">Kd Kantor</td>
	<td bgcolor="#89acd8" align="center">No. Polis</td>
	<td bgcolor="#89acd8" align="center">Kode Produk</td>
	<td bgcolor="#89acd8" align="center">NoPolisBaru</td>
    <td bgcolor="#89acd8" align="center">Pemegang Polis</td>
    <td bgcolor="#89acd8" align="center">Alamat</td>
    <td bgcolor="#89acd8" align="center">Kota</td>
	<td bgcolor="#89acd8" align="center">Propinsi</td>
    <td bgcolor="#89acd8" align="center">Kode Pos</td>
    <td bgcolor="#89acd8" align="center">Premi</td>
    <td bgcolor="#89acd8" align="center">Materai</td>
  </tr>
  <? 
  
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$i;?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA">
	<a href="#" onClick="window.open('./pop_ps.php?tglDari=<?=$tglDari;?>&tglSampai=<?=$tglSampai;?>&kdkantor=<?=$kdkantor;?>&kdbank=<?=$kdbank;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["NOPOLLAMA"];?></a></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KDPRODUK"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["NOPOL"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["NAMAKLIEN1"];?></td>
	<td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["ALAMATTAGIH01"].' '.$arr["ALAMATTAGIH02"];?></td>
     <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KODYA"];?></td>
	 <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["NAMAPROPINSI"];?></td>
	 
      <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KODEPOSTAGIH"];?></td>
      <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=number_format($arr["PREMI"],2,',','.');?></td>
      <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=number_format($arr["MATERAI"],2,',','.');?></td>
	<? 
	$i++;

	}
	
	?>
      </tr>
</table>