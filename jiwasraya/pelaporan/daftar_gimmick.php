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
  //echo $sql;
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
  <?  ShowFromDate(10,"Past"); ?><select name="kantornya" size="1" onChange="GantiCari(document.getpremi)">
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
					 
		$sql = "select   prefixpertanggungan kantor,
           prefixpertanggungan || nopertanggungan nopol,
           (select   noid
              from   $DBUser.tabel_100_klien
             where   noklien = a.nopemegangpolis) id,
		   (select   namaklien1
              from   $DBUser.tabel_100_klien
             where   noklien = a.nopemegangpolis)
              pempol,
			(select   alamattetap01||' '||alamattetap02
              from   $DBUser.tabel_100_klien
             where   noklien = a.nopemegangpolis) alamat,
			 (select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=a.kdcarabayar) cara,
           to_char (mulas, 'dd/mm/yyyy') mulas,
		   (SELECT TO_CHAR(TGLACCEPTANCE,'DD/MM/YYYY') FROM $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN 
		   WHERE PREFIXPERTANGGUNGAN=a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN=a.NOPERTANGGUNGAN) TGLAKSEP,
           kdproduk,
           (select   namaproduk
              from   $DBUser.tabel_202_produk
             where   kdproduk = a.kdproduk)
              namaproduk,
           premi1,
           gimmick,(select to_char(tglkirim,'dd/mm/yyyy')  from $DBUser.TABEL_999_LOG_KIRIM_GIMMICK where nomor_polis=a.prefixpertanggungan||a.nopertanggungan) tglkirim,
		  (select nota from $DBUser.TABEL_999_LOG_KIRIM_GIMMICK where nomor_polis=a.prefixpertanggungan||a.nopertanggungan) nota
    from   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_999_gimmick b
   where       mulas BETWEEN to_date ('01082014', 'ddmmyyyy') AND to_date ('31122014', 'ddmmyyyy')
   		   and to_char(mulas,'mmyyyy')='$month$year'
   		   AND KDPRODUK IN ('JSPEIP',
							'JL4X',
							'JL4B',
							'JSSPO8',
							'JSSPO9',
							'JSSPO7A',
							'JSDMPP', 
							'JSP','JSPS',
							'JSSHTK',
							'JSSHTBA',
							'JSSHTT',
							'JSSHTS',
							'JSSHTB',
							'JSSHTX')
           and kdpertanggungan = '2'
           and kdstatusfile <> '7'
           and premi1 between batasbawah and batasatas
		   ".$filterktr."
order by   prefixpertanggungan, premi1";
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
	<td bgcolor="#89acd8" align="center">NO. POLIS</td>
    <td bgcolor="#89acd8" align="center">CARA</td>
    <td bgcolor="#89acd8" align="center">AKSEPTASI</td>
    <td bgcolor="#89acd8" align="center">NO. ID</td>
    <td bgcolor="#89acd8" align="center">PEMEGANG POLIS</td>
    <td bgcolor="#89acd8" align="center">ALAMAT</td>
    <td bgcolor="#89acd8" align="center">PREMI</td>
    <td bgcolor="#89acd8" align="center">MULAS</td>
	<td bgcolor="#89acd8" align="center">PRODUK</td>
    <td bgcolor="#89acd8" align="center">GIMMICK</td>
	<td bgcolor="#89acd8" align="center">TGL. KIRIM</td>
	<td bgcolor="#89acd8" align="center">NOTA KIRIM</td>
	<?php 
	if($kantor=="KP"){
	echo "<td bgcolor=#89acd8 align=center>ACTION</td>";
	}
	?>
  	</tr>
	<?
	
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KANTOR"];?></td>	
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOPOL"];?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["CARA"]);?></td>
    <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["TGLAKSEP"]);?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["ID"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PEMPOL"];?></td>
	<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["ALAMAT"]);?></td>
    <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["PREMI1"],2,",",".");?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["MULAS"]);?></td>		
		<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?='('.$arr["KDPRODUK"].') '.$arr["NAMAPRODUK"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["GIMMICK"];?></td>
	<?php 
	if($kantor=="KP"){
	if($_GET["act"]=="update" && $_GET["nopol"]==$arr["NOPOL"]){
	echo "<td><form name=updategimmick method=post action=#>";
	echo "<input type=hidden name=nopol value=".$arr["NOPOL"]."><input type=hidden name=month value=".$month.">";
	echo "<input type=hidden name=year value=".$year."><input type=hidden name=kantornya value=".$kantornya.">";
	echo "<input type=text size=8 name=tglkirim onBlur=\"convert_date(tglkirim)\" value=".$arr["TGLKIRIM"]."></td> <td><input type=text name=nd value=".$arr["NOTA"]."></td>";
	echo "<td><input type=submit name=sumbit value=UPDATE></form></td>";
	}else{
	?>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["TGLKIRIM"]);?></td>
	<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["NOTA"]);?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><a href="daftar_gimmick.php?act=update&nopol=<?=$arr["NOPOL"];?>&month=<?=$month;?>&year=<?=$year;?>&kantornya=<?=$kantornya;?>">UPDATE</a></td>	
	<?php
	}
	}else{
	?>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["TGLKIRIM"]);?></td>
		<td align="LEFT" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($arr["NOTA"]);?></td>
	<?php
	}
	?>		
  
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