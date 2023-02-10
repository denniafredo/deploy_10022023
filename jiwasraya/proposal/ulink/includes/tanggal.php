<?
	$DB=new database($userid, $passwd, $DBName);

	$sql="select to_char(sysdate,'HH:MI:SS') detiknow, to_char(sysdate,'DD/MM/YYYY') now from dual";
  $DB->parse($sql);
	$DB->execute();
	$w=$DB->nextrow();
	$now = $w["NOW"];
	$detiknow=$w["DETIKNOW"];
	$tanggal=$now;


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
	echo "<option value=all ".($month=="all" ? "selected" : "").">--ALL--</option>";
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
