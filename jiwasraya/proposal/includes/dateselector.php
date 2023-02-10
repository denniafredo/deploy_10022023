<?
function DateSelector($inName, $useDate=0) {
	$monthName=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
	//if date invalid or not supplied, use current time 
	if ($useDate==0) { 
		$useDate=Time(); 
	} 
	//make day selector 
	print("<select name=".$inName."tgl>\n"); 
	for($currentDay=1; $currentDay<=31; $currentDay++) { 
		print("<option value=\"$currentDay\""); 
		if (intval(date("d", $useDate))==$currentDay) { 
			print("selected"); 
		} 
		print(">$currentDay\n"); 
	} 
	print("</select>");
	// make month selector 
	print("<select name=".$inName."bln>\n"); 
	for ($currentMonth=1; $currentMonth<=12; $currentMonth++) { 
		print("<option value=\""); 
		print(intval($currentMonth)); 
		print("\""); 
		if (intval(date("m", $useDate))==$currentMonth) {
			print("selected"); 
		} 
		print(">".$monthName[$currentMonth]."\n"); 
	}
	print("</select>"); 
	// make year selector 
	print("<select name=".$inName."thn>\n"); 
	$startYear=date("Y", $useDate); 
	for ($currentYear=$startYear-3; $currentYear<=$startYear+5; $currentYear++) { 
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) {
			print("selected"); 
		} 
		print(">$currentYear\n"); 
	}
	print("</select>"); 
}
?>
