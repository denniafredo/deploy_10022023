<?
 function PilihBulan($inName, $useDate=0) 
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
        print("<select name=" . $inName .  "bulan>\n"); 
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
        print("<select name=" . $inName .  "tahun>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 3; $currentYear <= $startYear+5;$currentYear++) 
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