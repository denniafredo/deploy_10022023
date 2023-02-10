<? 
  include "../../includes/session.php";  
	include "../../includes/database.php"; 
	include "../../includes/common.php";
	echo "<link href=../jws.css rel=stylesheet type=text/css>";
	$DB = New Database($userid,$passwd,$DBName);
	$DC = New Database($userid,$passwd,$DBName);

  
 	$sqlc ="select count(kdkantor) as jktr from $DBUser.tabel_001_kantor where kdjeniskantor='2'";
	$DB->parse($sqlc);
	$DB->execute();
  $cnt=$DB->nextrow();
	$jmlktr=$cnt["JKTR"];
  //echo $jmlktr;
	
	function DateSelector($inName, $useDate=0) 
 	{ 
        $monthName = array(1=> "Januari",  "Pebruari",  "Maret", 
            "April",  "Mei",  "Juni",  "Juli",  "Agustus", 
            "September",  "Oktober",  "Nopember",  "Desember"); 
        //if date invalid or not supplied, use current time 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
			
        // make month selector 
        print("<select name=" . $inName .  "bln>\n"); 
				//echo "<option value=\"all\">ALL</option>";
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
        // make year selector 
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
<title>Untitled</title>
</head>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
	<a class="verdana10blk\"><b>HASIL BILLING & BOOKING KANTOR <?echo $kantor;?></b></a>
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
	$kdcarabayar=array(0=>'1','2','3','4');
  $namacarabayar=array(0=>'BULANAN','KWARTALAN','SEMESTERAN','TAHUNAN');
	$kdkuitansi=array(0=>'BULANAN','KWARTALAN','SEMESTERAN','TAHUNAN');
	$namavaluta = array(0=>'INDEX','RUPIAH','DOLAR');
	$kdvaluta = array(0=>'0','1','3');
	
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
    	//echo $periode;		
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
 Biling & Booking <?=$bulan." ".$vthn;?>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr>
	  <td></td>
		<?
		for ($b=0; $b<count($kdkuitansi); $b++) {
	   echo" <td align=center>".$kdkuitansi[$b]."</td>";
    }
		?>
  </tr>
  <tr>
	  <td>Kantor</td>
    <?
		for ($b=0; $b<count($kdkuitansi); $b++) {
	   echo" <td align=center>";
    
		?>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
 
      <tr>
			<?
			for ($d=0; $d<count($namavaluta); $d++) {
        echo "<td align=center>".$namavaluta[$d]."</td>";
			}
      ?>
      </tr>
 
    </table>
    <?
		echo "</td>";
		}
		?>
  </tr>
	<?
	//for ($k=0; $k<$jmlktr; $k++) {
	for ($k=0; $k<1; $k++) {
	
	$sqlk ="select namakantor,kdkantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' and ".
				 "kdkantor='$kantor'";
	$DB->parse($sqlk);
	$DB->execute();
  while($kn=$DB->nextrow()){
	  //echo "<td>".$kn["KDKANTOR"]."</td>";  
		
	
	echo "<tr>";
	echo "<td>".$kn["KDKANTOR"]."</td>";
  
  ?>
	  <?
		for ($c=0; $c<count($kdcarabayar); $c++) {
	   echo" <td align=center>";
    
		?>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
      <tr>
			<?
			for ($d=0; $d<count($kdvaluta); $d++) {
			  		 	 
							 $sqlr ="select ".
                      	"count(a.nopertanggungan) jmlpolis,".
                      	"b.kdvaluta,".
                      	//"b.kdcarabayar,".
                      	"c.kdrayonpenagih ".
                      "from ".
                      	"$DBUser.tabel_300_historis_premi a,".
                      	"$DBUser.tabel_200_pertanggungan b,".
                      	"$DBUser.tabel_500_penagih c ".
                      "where ".
                      	"a.prefixpertanggungan=b.prefixpertanggungan and ".
                      	"a.nopertanggungan=b.nopertanggungan and ".
                      	"b.nopenagih=c.nopenagih and ".
												"c.kdrayonpenagih='".$kn["KDKANTOR"]."' and ".
												//"c.kdrayonpenagih='AC' and ".
												"b.kdvaluta='$kdvaluta[$d]'  and ".
												"decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4') = ".
        								"'$kdcarabayar[$c]' and ".
												$periode." ".
                      	//"to_char(a.tglbooked,'MMYYYY')='042004' ".
                      "group by ".
                      	"b.kdvaluta,".
                      	//"b.kdcarabayar,".
                      	"c.kdrayonpenagih";
				
								 $DC->parse($sqlr);
        			 	 $DC->execute();
        			 	 $hsl=$DC->nextrow();		
        		   	 //echo $sqlr;
        				 
        				 $jmlpol = ($hsl["JMLPOLIS"]==0) ? "0" : "<a href=\"#\" onclick=\"NewWindow('infodetilbillbook.php?val=$kdvaluta[$d]&cb=$kdcarabayar[$c]&bln=$bln&thn=$vthn','detiltagihan',800,400,1)\">".$hsl["JMLPOLIS"]."</a>";
        				
        //echo "<td align=center>".$jmlpol." ".$kdvaluta[$d]." - ".$kn["KDKANTOR"]." ".$kdcarabayar[$c]." ".$kdvaluta[$d]."</td>";
			  echo "<td align=center width=\"33%\">".$jmlpol."</td>";
			
			
			}
      ?>
      </tr>
    </table>
    <?
		echo "</td>";
		}
		?>
  </tr>
	<?
	  } // while
	 }  // for punya
	?>
</table>
</body>
</html>
