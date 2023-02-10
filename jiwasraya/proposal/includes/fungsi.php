<? 
  	function GetNewPropNo($DBX)
	{
	  $query = "select max(nopertanggungan) as maxnopert ".
					   "from $DBUser.tabel_200_pertanggungan";
	  //echo $query;
		$DBX->parse($query);
		$DBX->execute();
		$arr = $DBX->nextrow();
		$maxnopert = $arr["MAXNOPERT"];
		
		if (strlen($maxnopert)==0) {
		  $maxnopert = "000000001";
		} else {
      $newnopert = $maxnopert + 1;
		  $maxnopert = str_pad($newnopert,9,"0",STR_PAD_LEFT);
		} 
		return $maxnopert;
	}		 

	function GetNewPropTemp($DBX)	{
	  $query = "select max(nopertanggungan) as maxnopert ".
					   "from $DBUser.tabel_200_temp";
	  $DBX->parse($query);
		$DBX->execute();
		$arr = $DBX->nextrow();
		$maxnopert = $arr["MAXNOPERT"];
		
		if (strlen($maxnopert)==0) {
		  $maxnopert = "000000001";
		} else {
      $newnopert = $maxnopert + 1;
		  $maxnopert = str_pad($newnopert,9,"0",STR_PAD_LEFT);
		} 
		return $maxnopert;
	}		 

function toTglIndo($tglid)
{
      $tgl = substr($tglid,0,2);
			$bul = substr($tglid,3,2);
			$thn = substr($tglid,-4);
			switch ($bul)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
			$formattanggal = $tgl." ".$bln." ".$thn;
			return $formattanggal;
}

function namaBulan($mon)
{
           switch ($mon)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
		return $bln;
}

function idNumberFormat($nilai)
{
  $output = number_format($nilai,2,",",".");
	return $output;
}

function encodedecode($as_Str_Message){
//Function : encrypt/decrypt a string message v.1.0  without a known key
//Author   : Aitor Solozabal Merino (spain)
//Email    : aitor-3@euskalnet.net
    $ln_Len_Str_Message=STRLEN($as_Str_Message);
    $ls_Str_Encrypted_Message="";
    FOR ($ln_Position = 0;$ln_Position<$ln_Len_Str_Message;$ln_Position++){
        // long code of the function to explain the algoritm
        //this function can be tailored by the programmer modifyng the formula
        //to calculate the key to use for every character in the string.
        $ln_Key_To_Use = (($ln_Len_Str_Message+$ln_Position)+1); // (+5 or *3 or ^2)
        //after that we need a module division because can´t be greater than 255
        $ln_Key_To_Use = (255+$ln_Key_To_Use) % 255;
        $ls_Byte_To_Be_Encrypted = SUBSTR($as_Str_Message, $ln_Position, 1);
        $ln_Ascii_Num_Byte_To_Encrypt = ORD($ls_Byte_To_Be_Encrypted);
        $ln_Xored_Byte = $ln_Ascii_Num_Byte_To_Encrypt ^ $ln_Key_To_Use;  //xor operation
        $ls_Encrypted_Byte = CHR($ln_Xored_Byte);
        $ls_Str_Encrypted_Message .= $ls_Encrypted_Byte;
       
        //short code of  the function once explained
        //$str_encrypted_message .= chr((ord(substr($str_message, $position, 1))) ^ ((255+(($len_str_message+$position)+1)) % 255));
    }
    RETURN $ls_Str_Encrypted_Message;
} 
//end function
?>