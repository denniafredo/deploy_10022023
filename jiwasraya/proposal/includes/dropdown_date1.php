<?
/************************************************
  ** Fungsi Date DropDown
  **
  ** Author.: berber [ berber@weber-sites.com ]
  ** ver....: v1.00
  **
  ** desc...: This function is used to add a date dropdown
  ** in a form. It will print the Year, Month and Day and
  ** will choose the current date as default.
  ** The function accepts two parameters :
  **
  **    $year_interval - How many years to show in the year dropdown.
  **    $YearIntervalType -
  **        - Past : Show only past years till this year.
  **        - Future : Show only future years from this year.
  **        - Both : Show both past and future years.
  ** The function also accepts 3 optional global parameters
  ** that may come from the script and override the current
  ** date.
  ************************************************/
  
  function ShowFromDate($year_interval,$YearIntervalType,$nowmonth,$nowyear) {
  GLOBAL $day,$month,$year;
  

  //YEAR
  //echo $nowyear;
    echo "<select name=year class=pilih9 onChange=\"cariThnProses(document.cariwaktu)\">\n";
    $CurrYear=date("Y");
	$year1=$nowyear;
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $year) {
                 echo "<option value=$i selected> $i\n";
              }/*ElseIf ($i == $CurrYear && !IsSet($year)) {
                 echo "<option value=$i selected> $i\n";
              }*/elseif ($i == $year1) {
                 echo "<option value=$i selected> $i\n";
              }Else {
                 echo "<option value=$i> $i\n";
              }
              $i++;
             }
         echo "</select>\n";
    }
   /* If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear){
			   echo "<option value=$i selected> $CurrYear\n";
			   }elseif($year==$year1){
			   echo "<option value=$year1 selected> $year1\n";
			   }else{
			    echo "<option value=$i> $CurrYear\n";
				}
              $CurrYear++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear){
			   echo "<option value=$i selected> $i\n";
			   }elseif($i==$year1){
			   echo "<option value=$year1 selected> $year1\n";
			   }else{
			    echo "<option value=$i> $i\n";
				}
              $i++;
             }
         echo "</select>\n";
    }*/



    //MONTH
	$now=$nowmonth+0;	
  echo "<select name=month class=pilih9 onChange=\"cariTglProses(document.cariwaktu)\">\n";
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
              If($i==$now) {
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
  
  //DAY
 /* echo "<select name=day class=pilih9>\n";
  $i=1;
  $CurrDay=date("d");
  If(!IsSet($day)) $day=$CurrDay;
  while ($i <= 31)
        {
         If(IsSet($day)) {
           If($day == $i || ($i == substr($day,1,1) && (substr($day,0,1) == 0))) {
                    echo"<option selected> $day\n";
                    $i++;
           }Else{
                  If($i<10) {			  
                     echo "<option> 0$i\n";
                  }Else {
                     echo "<option> $i\n";
                  }
                  $i++;
           }
         }Else {
                If($i == $CurrDay)
                  If($i<10) {
                     echo "<option selected> 0$i\n";
                  }Else {
                     echo"<option selected> $i\n";
                  }
                Else {
                  If($i<10) {
                     echo "<option> 0$i\n";
                  }Else {
                     echo "<option> $i\n";
                  }
                }
                $i++;
         }
        }
  echo "</select>\n";
  */
  }
	?>