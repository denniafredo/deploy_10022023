<? 
$tglnow = date("j");
$bln = date("F");
$mon = date("m");
$thn = date("Y");
switch ($bln)	{
		case "January": $bln = "Januari"; break;
	  case "February": $bln = "Pebruari"; break;
	  case "March": $bln = "Maret"; break;
		case "April": $bln = "April"; break;
		case "May": $bln = "Mei"; break;
		case "June": $bln = "Juni"; break;
		case "July": $bln = "Juli"; break;
		case "August": $bln = "Agustus"; break;
		case "September": $bln = "September"; break;
		case "October": $bln = "Oktober"; break;
		case "November": $bln = "Nopember"; break;
		case "December": $bln = "Desember"; break;
}
$tanggal = "$tglnow $bln $thn";
$now = $tanggal;
?>
