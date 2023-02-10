<? 
  include "../../includes/session.php";  
	include "../../includes/database.php"; 
	include "../../includes/common.php";
	echo "<link href=../jws.css rel=stylesheet type=text/css>";
	$DB = New Database($userid,$passwd,$DBName);
	$DC = New Database($userid,$passwd,$DBName);
	
	function DateSelector($inName, $useDate=0) 
 	{ 
        $monthName = array(1=> "Januari",  "Pebruari",  "Maret", 
            "April",  "Mei",  "Juni",  "Juli",  "Agustus", 
            "September",  "Oktober",  "Nopember",  "Desember"); 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
			
        print("<select name=" . $inName .  "bln>\n"); 
        for($currentMonth = 1; $currentMonth <= 12; $currentMonth++) 
        { 
            print("<option value=\""); 
            print(intval($currentMonth)); 
            print("\""); 
            if(intval(date( "m", $useDate))==$currentMonth) 
            { 
                print(" selected"); 
            } 
            print(">" . $monthName[$currentMonth] .  "\n"); 
        } 
        print("</select>"); 
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 5; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
        } 
        print("</select>"); 
  } 
?>
<html>
<head>
<title>Billing Booking</title>
</head>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
	<a class="verdana10blk\"><b>INFORMASI BILLING & BOOKING KANTOR <?echo $kantor;?></b></a>
	<hr size=1>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Periode Billing Booking</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
  <?
	if($vbln==""){
							   $DB = New Database($userid,$passwd,$DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $periode="to_char(a.tglbooked,'MMYYYY')='$thisperiode'";
	} else {
    	$bln = substr(("0".$vbln),-2);
    	$thisperiode="$bln$vthn";
    	$periode="to_char(a.tglbooked,'MMYYYY')='$thisperiode'";
	}
	switch ($bln)	{
		          case "01": $bulan = "Januari"; break;
	            case "02": $bulan = "Pebruari"; break;
	            case "03": $bulan = "Maret"; break;
		          case "04": $bulan = "April"; break;
		          case "05": $bulan = "Mei"; break;
		          case "06": $bulan = "Juni"; break;
		          case "07": $bulan = "Juli"; break;
		          case "08": $bulan = "Agustus"; break;
		          case "09": $bulan = "September"; break;
		          case "10": $bulan = "Oktober"; break;
		          case "11": $bulan = "Nopember"; break;
		          case "12": $bulan = "Desember"; break;
           }				
 ?>
 <hr size=1>
 <a class="verdana10blk"><b>Biling & Booking <?=$bulan." ".$vthn;?> Kantor <?=$kantor; ?></b></a>
 <br><br>
  <? 
    $namacarabayar=array(0=>'BULANAN','KWARTALAN','SEMESTERAN','TAHUNAN');
  	$kdkuitansi=array(0=>'BULANAN','KWARTALAN','SEMESTERAN','TAHUNAN');
  	$namavaluta = array(0=>'INDEX','RUPIAH','DOLAR');
  	$kdvaluta = array(0=>'0','1','3');
  	$kdcarabayar=array(0=>'1','2','3','4');
  ?>


<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1">
  <tr>
    <td width="20%" bgcolor="#C9DFFA" align="center" class="verdana9blk">CARA/KURS</td>
		<?
		for ($a=0; $a<count($namacarabayar); $a++) {
	   echo" <td align=center bgcolor=#C9DFFA class=verdana9blk>".$namacarabayar[$a]."</td>";
    }
		?>
  </tr>
  <tr>
    <td width="20%" bgcolor="#D8E8BB" class="verdana9blk">INDEX</td>
		<?
		for ($b=0; $b<count($kdcarabayar); $b++) {
	   echo" <td align=center align=right class=verdana9blk>";
		 
		 				  $sqlr ="select ".
                      	"count(a.nopertanggungan) jmlpolis,".
                      	"b.kdvaluta,".
                      	"c.kdrayonpenagih ".
                      "from ".
                      	"$DBUser.tabel_300_historis_premi a,".
                      	"$DBUser.tabel_200_pertanggungan b,".
                      	"$DBUser.tabel_500_penagih c ".
                      "where ".
                      	"a.prefixpertanggungan=b.prefixpertanggungan and ".
                      	"a.nopertanggungan=b.nopertanggungan and ".
                      	"b.nopenagih=c.nopenagih and ".
												"c.kdrayonpenagih='$kantor' and ".
												"b.kdvaluta='0'  and ".
												"decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4') = ".
        								"'$kdcarabayar[$b]' and ".
												$periode." ".
                      "group by ".
                      	"b.kdvaluta,".
                      	"c.kdrayonpenagih";
								 //echo $sqlr;
								 $DC->parse($sqlr);
        			 	 $DC->execute();
        			 	 $hsl=$DC->nextrow();		
        		   	
        				 $jmlpol = ($hsl["JMLPOLIS"]==0) ? "0" : "<a href=\"#\" onclick=\"NewWindow('infodetilbillbook.php?val=0&cb=$kdcarabayar[$b]&bln=$bln&thn=$vthn','detiltagihan',800,400,1)\">".$hsl["JMLPOLIS"]."</a>";
								 echo  $jmlpol;
		 echo "</td>";
    }
		?>
	</tr>

  <tr>
    <td width="20%" bgcolor="#D8E8BB" class="verdana9blk">RUPIAH</td>
		<?
		for ($c=0; $c<count($kdcarabayar); $c++) {
	   echo" <td align=center align=right class=verdana9blk>";
		 
		 				  $sqlr ="select ".
                      	"count(a.nopertanggungan) jmlpolis,".
                      	"b.kdvaluta,".
                      	"c.kdrayonpenagih ".
                      "from ".
                      	"$DBUser.tabel_300_historis_premi a,".
                      	"$DBUser.tabel_200_pertanggungan b,".
                      	"$DBUser.tabel_500_penagih c ".
                      "where ".
                      	"a.prefixpertanggungan=b.prefixpertanggungan and ".
                      	"a.nopertanggungan=b.nopertanggungan and ".
                      	"b.nopenagih=c.nopenagih and ".
												"c.kdrayonpenagih='$kantor' and ".
												"b.kdvaluta='1'  and ".
												"decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4') = ".
        								"'$kdcarabayar[$c]' and ".
												$periode." ".
                      "group by ".
                      	"b.kdvaluta,".
                      	"c.kdrayonpenagih";
								 //echo $sqlr;
								 $DC->parse($sqlr);
        			 	 $DC->execute();
        			 	 $hsl=$DC->nextrow();		
        		   	
        				 $jmlpol = ($hsl["JMLPOLIS"]==0) ? "0" : "<a href=\"#\" onclick=\"NewWindow('infodetilbillbook.php?val=1&cb=$kdcarabayar[$c]&bln=$bln&thn=$vthn','detiltagihan',800,400,1)\">".$hsl["JMLPOLIS"]."</a>";
								 echo  $jmlpol;
		 echo "</td>";
    }
		?>  </tr>

  <tr>
    <td width="20%" bgcolor="#D8E8BB" class="verdana9blk">DOLAR</td>
		<?
		for ($d=0; $d<count($kdcarabayar); $d++) {
	   echo" <td align=center align=right class=verdana9blk>";
		 
		 				  $sqlr ="select ".
                      	"count(a.nopertanggungan) jmlpolis,".
                      	"b.kdvaluta,".
                      	"c.kdrayonpenagih ".
                      "from ".
                      	"$DBUser.tabel_300_historis_premi a,".
                      	"$DBUser.tabel_200_pertanggungan b,".
                      	"$DBUser.tabel_500_penagih c ".
                      "where ".
                      	"a.prefixpertanggungan=b.prefixpertanggungan and ".
                      	"a.nopertanggungan=b.nopertanggungan and ".
                      	"b.nopenagih=c.nopenagih and ".
												"c.kdrayonpenagih='$kantor' and ".
												"b.kdvaluta='3'  and ".
												"decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4') = ".
        								"'$kdcarabayar[$d]' and ".
												$periode." ".
                      "group by ".
                      	"b.kdvaluta,".
                      	"c.kdrayonpenagih";
								 //echo $sqlr;
								 $DC->parse($sqlr);
        			 	 $DC->execute();
        			 	 $hsl=$DC->nextrow();		
        		   	
        				 $jmlpol = ($hsl["JMLPOLIS"]==0) ? "0" : "<a href=\"#\" onclick=\"NewWindow('infodetilbillbook.php?val=3&cb=$kdcarabayar[$d]&bln=$bln&thn=$vthn','detiltagihan',800,400,1)\">".$hsl["JMLPOLIS"]."</a>";
								 echo  $jmlpol;
		 echo "</td>";
    }
		?>
  </tr>
</table>
<hr size="1">
<a href="index.php" class="verdana10blk">Menu Pelaporan</a>
</body>
</html>
