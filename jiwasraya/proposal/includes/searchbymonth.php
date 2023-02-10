<?php
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
				print("<option value=ALL>ALL</option>");
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

	<hr size=1 color="#c0c0c0">
	<table>
	<form name="carisesuatu" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk"><?=$searchname;?></td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="cari" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<hr size=1 color="#c0c0c0">
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
			$methodcari="MMYYYY";
			//$blnsearch= "to_char(a.tglbooked,'$methodcari')='$thisperiode' and ";
			$blnsearchx=$thisperiode;
			$jnscari="BL";
	} else if($vbln=="ALL"){ 
	    $thisperiode="$vthn";
			$methodcari="YYYY";
			//$blnsearch= "to_char(a.tglbooked,'YYYY')='$thisperiode' and ";
			$blnsearchx=$thisperiode;
			$jnscari="TH";
	} else {
    	$bln = substr(("0".$vbln),-2);
    	$thisperiode="$bln$vthn";
			$methodcari="MMYYYY";
			//$blnsearch= "to_char(a.tglbooked,'MMYYYY')='$thisperiode' and ";
 			$blnsearchx=$thisperiode;
			$jnscari="BL";
 }
	switch ($bln)	{
		          case "01": $bulan = "JANUARI"; break;
	            case "02": $bulan = "PEBRUARI"; break;
	            case "03": $bulan = "MARET"; break;
		          case "04": $bulan = "APRIL"; break;
		          case "05": $bulan = "MEI"; break;
		          case "06": $bulan = "JUNI"; break;
		          case "07": $bulan = "JULI"; break;
		          case "08": $bulan = "AGUSTUS"; break;
		          case "09": $bulan = "SEPTEMBER"; break;
		          case "10": $bulan = "OKTOBER"; break;
		          case "11": $bulan = "NOPEMBAR"; break;
		          case "12": $bulan = "DESEMBER"; break;
           }				
 ?>