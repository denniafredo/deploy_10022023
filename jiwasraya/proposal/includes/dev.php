<?
	function endec($as_Str_Message){
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
       	}
		RETURN $ls_Str_Encrypted_Message;
	} 
	$DBUser			= endec($DBUser);
	
	$suid  			= endec($suid);
	$spass  		= endec($spass);
	$sdb  			= endec($sdb);
	
	$DBName  		= endec($DBName);
	$DBInfo  		= endec($DBInfo);
	$DBName22  		= endec($DBName22);
	$DBName9  		= endec($DBName9);
	$DBName9  		= endec($DBName9);

	$suid_DPLK  	= endec($suid_DPLK);
	$spass_DPLK  	= endec($spass_DPLK);
	$sdb_DPLK  		= endec($sdb_DPLK);

	$suid_GLLINK08  = endec($suid_GLLINK08);
	$spass_GLLINK08 = endec($spass_GLLINK08);
	$sdb_GLLINK08  	= endec($sdb_GLLINK08);

	$suid_GLLINK  	= endec($suid_GLLINK);
	$spass_GLLINK  	= endec($spass_GLLINK);
	$sdb_GLLINK  	= endec($sdb_GLLINK);

	$suid_CKINDO  	= endec($suid_CKINDO);
	$spass_CKINDO  	= endec($spass_CKINDO);
	$sdb_CKINDO  	= endec($sdb_CKINDO);
?>