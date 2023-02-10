<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  include "../../includes/tanggal.php";
  
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
  if($_POST['sumbit']){
  $sql="select count(*) jumlahpol from $DBUser.TABEL_999_LOG_KIRIM_GIMMICK where nomor_polis='$nopol'";
  echo $sql;
  $DB->parse($sql);
  $DB->execute();
  $arr=$DB->nextrow();
  $jumlah=$arr["JUMLAHPOL"];
  if($jumlah>0){
  $sql1="update $DBUser.TABEL_999_LOG_KIRIM_GIMMICK set tglkirim=to_date('$tglkirim','dd/mm/yyyy'),nota='$nd' where nomor_polis='$nopol'";
  }else{
  $sql1="insert into $DBUser.TABEL_999_LOG_KIRIM_GIMMICK (nomor_polis,kodelog,tglrekam,userrekam,tglkirim,userkirim,nota) values ".
		"('$nopol','1',sysdate,user,to_date('$tglkirim','dd/mm/yyyy'),user,'$nd')";
  }
  //echo $sql1;
  $DB->parse($sql1);
  $DB->execute();
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
<script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Daftar Gimmick</title>
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



<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">
<?

if ($kantor=='KP') {$pilihktr="";} else {$pilihkantor=" and kdkantor='$kantor' ";}
?>
  <table>
	<tr>
  
  <td>
  <?  //ShowFromDate(10,"Past"); ?><select name="kantornya" size="1" onChange="GantiCari(document.getpremi)">
  <!--<option value="KP">SELURUH KANTOR</option>-->
    <? 
  $conn=ocilogon($DBUser, $DBPass, $DBName);  
  $sqlktr1="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor in ('0','2') ".$pilihkantor." order by kdkantor ASC";
  $sqlktr=ociparse($conn,$sqlktr1);
  ociexecute($sqlktr);
  while(ocifetch($sqlktr)){
  //$DB->parse($sqlktr);
  //$DB->execute();				
   //	while ($arrktr=$DB->nextrow()) {
   if(ociresult($sqlktr,"KDKANTOR")==$kantornya)
   {
	echo "<option value=".ociresult($sqlktr,"KDKANTOR")." selected>".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
	else
	{
	echo "<option value=".ociresult($sqlktr,"KDKANTOR").">".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
   }
 //  echo "<option value='all'>all</option>";
  ?>
  </select>
    <?
  //echo $sqlktr;	
?></td>
 
 <td colspan="2"><input type="submit" name="submit" value="Cari"></input></td>
 
 </tr>
</table>
<!--</form>-->

</div>
<? 


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

  <? 
//echo $kantornya;
//echo $month."/".$year;
if ($kantornya=='KP') {
	$filterktr="";
} else {
	$filterktr=" AND PREFIXPERTANGGUNGAN IN 
		   (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor = '$kantornya'
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk) ";}
					 
		$sql = "SELECT XX.*,(SELECT KDKANTOR FROM $DBUser.TABEL_400_AGEN WHERE NOAGEN=XX.NOAGEN) KANTOR,
		(select kdproduk from $DBUser.tabel_200_pertanggungan where prefixpertanggungan||nopertanggungan = XX.nopol) produk FROM (SELECT   NOAGEN,
           (SELECT   namaklien1
              FROM   $DBUser.tabel_100_klien
             WHERE   noklien = noagen)
              nama,
           MULASX MULAS,
           NOPOL,
           SUM (PREMI1) PREMI,
           SUM (POIN) POIN
    FROM   (SELECT   prefixpertanggungan kantor,
                     prefixpertanggungan || nopertanggungan nopol,
                     (SELECT   namaklien1
                        FROM   $DBUser.tabel_100_klien
                       WHERE   noklien = a.nopemegangpolis)
                        pempol,
                     (SELECT   alamattetap01 || ' ' || alamattetap02
                        FROM   $DBUser.tabel_100_klien
                       WHERE   noklien = a.nopemegangpolis)
                        alamat,
                     (SELECT   namacarabayar
                        FROM   $DBUser.TABEL_305_CARA_BAYAR
                       WHERE   kdcarabayar = a.kdcarabayar)
                        cara,
                     TO_CHAR (mulas, 'dd/mm/yyyy') mulas,
                     (SELECT   TO_CHAR (TGLACCEPTANCE, 'DD/MM/YYYY')
                        FROM   $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN
                       WHERE   PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
                               AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN)
                        TGLAKSEP,
                     kdproduk,
                     (SELECT   namaproduk
                        FROM   $DBUser.tabel_202_produk
                       WHERE   kdproduk = a.kdproduk)
                        namaproduk,
                     NOAGEN,
                     premi1,
                     CASE
                        WHEN KDPRODUK IN ('JL4', 'JSPEIP')
                        THEN
                           FLOOR (PREMI1 * 0.1 / 1000000)
                        WHEN KDPRODUK IN ('AI0','AIP','AEP','ASP')
						THEN
							FLOOR(PREMI1*0.3/5000000)
						ELSE
                           FLOOR(PREMI1
                                 / DECODE (KDCARABAYAR, 'X', 5000000, 1000000))
                     END
                        POIN,
                     TO_CHAR (mulas, 'mmyyyy') MULASX
              FROM   $DBUser.tabel_200_pertanggungan a ".
			  //"WHERE   mulas >= TO_DATE ('01082014', 'ddmmyyyy') --and to_char(mulas,'mmyyyy')='102014' ". 
			  "WHERE   mulas between TO_DATE ('01082014', 'ddmmyyyy') and TO_DATE ('31122014', 'ddmmyyyy') ". //dirubah perhitungan dimulai 1 Agt s/d 31 Des 2014
			  "AND kdpertanggungan = '2' AND kdstatusfile <> '7'
					 ".$filterktr."
                     AND KDPRODUK IN
                              ('JSPEIP',
                               'JL4X',
                               'JL4B',
                               'JSSPO8',
                               'JSSPO9',
                               'JSSPO7A',
                               'JSDMPP',
                               'JSP',
                               'JSPS',
                               'JSSHTK',
                               'JSSHTBA',
                               'JSSHTT',
                               'JSSHTS',
                               'JSSHTB',
                               'JSSHTX',
							   'AI0','AIP','AEP','ASP')
							   UNION
                         SELECT   prefixpertanggungan kantor,
				 prefixpertanggungan || nopertanggungan nopol,
				 (SELECT   namaklien1
					FROM   $DBUser.tabel_100_klien
				   WHERE   noklien = a.nopemegangpolis)
					pempol,
				 (SELECT   alamattetap01 || ' ' || alamattetap02
					FROM   $DBUser.tabel_100_klien
				   WHERE   noklien = a.nopemegangpolis)
					alamat,
				 (SELECT   namacarabayar
					FROM   $DBUser.TABEL_305_CARA_BAYAR
				   WHERE   kdcarabayar = a.kdcarabayar)
					cara,
				 TO_CHAR (mulas, 'dd/mm/yyyy') mulas,
				 (SELECT   TO_CHAR (TGLACCEPTANCE, 'DD/MM/YYYY')
					FROM   $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN
				   WHERE   PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
						   AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN)
					TGLAKSEP,
				 kdproduk,
				 (SELECT   namaproduk
					FROM   $DBUser.tabel_202_produk
				   WHERE   kdproduk = a.kdproduk)
					namaproduk,
				 B.NOAGENREKR NOAGEN,
				 premi1,
				 10 POIN,
				 TO_CHAR (mulas, 'mmyyyy') MULASX
		  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.TABEL_400_AGEN b
		 WHERE   mulas BETWEEN TO_DATE ('01082014', 'ddmmyyyy')
						   AND  TO_DATE ('31122014', 'ddmmyyyy')
				 AND kdpertanggungan = '2'
				 AND kdstatusfile <> '7'
				 ".$filterktr."
				 AND KDPRODUK IN
						  ('JSPEIP',
						   'JL4X',
						   'JL4B',
						   'JSSPO8',
						   'JSSPO9',
						   'JSSPO7A',
						   'JSDMPP',
						   'JSP',
						   'JSPS',
						   'JSSHTK',
						   'JSSHTBA',
						   'JSSHTT',
						   'JSSHTS',
						   'JSSHTB',
						   'JSSHTX',
						   'AI0',
						   'AIP',
						   'AEP',
						   'ASP')
				 AND PREMI1 > 2000000
				 AND kdcarabayar NOT IN ('X', 'J', 'E')
				 AND A.NOAGEN = B.NOAGEN
				 and noagenrekr is not null
									   )
GROUP BY   ROLLUP (NOAGEN, MULASX, NOPOL)) XX";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
   	?>
    <B>DAFTAR GIMMICK</B>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
    <td bgcolor="#89acd8" align="center">KANTOR</td>
    <td bgcolor="#89acd8" align="center">NO AGEN</td>
    <td bgcolor="#89acd8" align="center">NAMA AGEN</td>
    <td bgcolor="#89acd8" align="center">BULAN</td>
    <td bgcolor="#89acd8" align="center">NO. POLIS</td>
    <td bgcolor="#89acd8" align="center">PRODUK</td>
    <td bgcolor="#89acd8" align="center">PREMI</td>
    <td bgcolor="#89acd8" align="center">POINT</td>
	<?php 
	if($kantor=="KP"){
	//echo "<td bgcolor=#89acd8 align=center>ACTION</td>";
	}
	?>
  	</tr>
	<?
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	
	$pointrekrut="SELECT SUM(JML) JML FROM (SELECT   10 JML
					FROM   $DBUser.tabel_200_pertanggungan
				   WHERE   NOAGEN IN (SELECT   NOAGEN
										FROM   $DBUser.TABEL_400_AGEN
									   WHERE   NOAGENREKR = '".$arr["NOAGEN"]."')
						   AND mulas BETWEEN TO_DATE ('01082014', 'ddmmyyyy')
										 AND  TO_DATE ('31122014', 'ddmmyyyy')
						   AND kdpertanggungan = '2'
						   AND kdstatusfile <> '7'
						   AND PREMI1 > 2000000
						   and kdcarabayar not in ('X','J','E')
				GROUP BY   NOAGEN)";
	//$DB1->parse($pointrekrut);
    //$DB1->execute();
	//$rek=$DB1->nextrow();				
	?>
    
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?></td>
    <? if($arr["MULAS"]!="" && $arr["NOPOL"]=="") {
	?>
    <td colspan="3" align="left" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><b>SUB TOTAL POINT <?=$arr["NAMA"];?></b></td>
    <?
	}
	elseif($arr["MULAS"]=="" && $arr["NOPOL"]=="") {
	?>
    <td colspan="3" align="left" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" bgcolor="#FFBF55"><b>GRAND TOTAL POINT <?=$arr["NAMA"];?></b></td>
    <?
	} else { ?>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KANTOR"];?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOAGEN"];?></td>	
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMA"];?></td>
    <?
    	}
	?>
     
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["MULAS"]);?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["NOPOL"]);?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["PRODUK"]);?></td>
    <td align="right" style="border-right-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["PREMI"],2,",",".");?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?
	if($arr["MULAS"]=="" && $arr["NOPOL"]=="" && $rek["JML"]>0)
	{echo $arr["POIN"].'+'.$rek["JML"].'='.($arr["POIN"]+$rek["JML"]);} else {
	echo $arr["POIN"];}?></td>	
  
  </tr>
  <?
	$i++;	}
	?>
	
 </table> 	

</form>
<hr>
<a href="../submenu.php?mnuinduk=150">Back</a>
</body>
</html>