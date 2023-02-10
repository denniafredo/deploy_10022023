<?
//date funct
  function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;
	//MONTH
  echo "<select name=month>";
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
							echo "<option value=$n selected>$namabulan";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan";
              }Else {
                 echo "<option value=$i>$namabulan";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan";
                }Else {
                   echo "<option value=$i selected>$namabulan";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan";
  							}Else {
                   echo "<option value=$i>$namabulan";
                }
              }
              $i++;
        }
  }
    echo "</select>";
  
  //YEAR
    echo "<select name=year>";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $year) {
                 echo "<option selected> $i";
              }ElseIf ($i == $CurrYear && !IsSet($year)) {
                 echo "<option selected> $i";
              }Else {
                 echo "<option> $i";
              }
              $i++;
             }
         echo "</select>";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear";
                else echo "<option> $CurrYear";
              $CurrYear++;
             }
         echo "</select>";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i";
                else echo "<option> $i";
              $i++;
             }
         echo "</select>";
    }
  }
	?>