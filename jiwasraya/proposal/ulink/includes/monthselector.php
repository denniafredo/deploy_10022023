<?
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
				echo "<option value=\"all\">ALL</option>";
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
				
		//added by khulafa 21-09-08
		$aboveYear=$startYear+5;
	    if ($aboveYear<date("Y")) $startYear = date( "Y", Time());
		//========================
		
        for($currentYear = $startYear - 10; $currentYear <= $startYear+5;$currentYear++) 
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
  
  
 function DateSelectorX($inName, $useDate=0) 
 { 
        $monthName = array(1=> "Januari",  "Pebruari",  "Maret", 
            "April",  "Mei",  "Juni",  "Juli",  "Agustus", 
            "September",  "Oktober",  "Nopember",  "Desember"); 
        //if date invalid or not supplied, use current time 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Tanggal
        print("<select name=" . $inName .  "tgl>\n"); 
		print ("<option value=0>---</option>");
        for($currentDay = 1; $currentDay<= 31;$currentDay++) 
        { 
            print("<option value=\"$currentDay\""); 
            if(date( "j", $useDate)==$currentDay) 
            { 
                print(" selected"); 
            } 					
            print(">$currentDay\n"); 						
        } 
        print("</select>"); 
		
        // make month selector 
        print("<select name=" . $inName .  "bln>\n"); 
				echo "<option value=\"all\">ALL</option>";
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
				
		//added by khulafa 21-09-08
		$aboveYear=$startYear+5;
	    if ($aboveYear<date("Y")) $startYear = date( "Y", Time());
		//========================
		
        for($currentYear = $startYear - 10; $currentYear <= $startYear+5;$currentYear++) 
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