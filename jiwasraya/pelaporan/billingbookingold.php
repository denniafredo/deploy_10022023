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
<title>Untitled</title>
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
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr>
	  
		<?
		for ($b=0; $b<count($kdkuitansi); $b++) {
	   echo" <td align=center bgcolor=#a0f3b9 class=verdana9blk bgcolor=#a7e4".$b."".$b.">".$kdkuitansi[$b]."</td>";
    }
		?>
  </tr>
  <tr>
	  
    <?
		for ($b=0; $b<count($kdkuitansi); $b++) {
	   echo" <td align=center>";
    
		?>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
      <tr>
			<?
			for ($d=0; $d<count($namavaluta); $d++) {
			  switch($d){
				  case "0" : $bg="#99ccff"; break;
					case "1" : $bg="#ccffff"; break;
					case "2" : $bg="#ccccff"; break;
				}

        echo "<td align=center width=\"33%\" bgcolor=$bg class=verdana9blk>".$namavaluta[$d]."</td>";
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
	echo "<tr>";
	
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
												"b.kdvaluta='$kdvaluta[$d]'  and ".
												"decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4') = ".
        								"'$kdcarabayar[$c]' and ".
												$periode." ".
                      "group by ".
                      	"b.kdvaluta,".
                      	"c.kdrayonpenagih";
				
								 $DC->parse($sqlr);
        			 	 $DC->execute();
        			 	 $hsl=$DC->nextrow();		
        		   	
        				 $jmlpol = ($hsl["JMLPOLIS"]==0) ? "0" : "<a href=\"#\" onclick=\"NewWindow('infodetilbillbook.php?val=$kdvaluta[$d]&cb=$kdcarabayar[$c]&bln=$bln&thn=$vthn','detiltagihan',800,400,1)\">".$hsl["JMLPOLIS"]."</a>";
        switch($d){
				  case "0" : $bg="#99ccff"; break;
					case "1" : $bg="#ccffff"; break;
					case "2" : $bg="#ccccff"; break;
				}
				echo "<td align=center width=\"33%\" bgcolor=$bg class=verdana9blk>".$jmlpol."</td>";
			
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
<hr size="1">
<a href="index.php" class="verdana10blk">Menu Pelaporan</a>
</body>
</html>
