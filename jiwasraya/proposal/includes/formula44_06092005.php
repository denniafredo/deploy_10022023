<?php
/***************************************************************************
    Begin                : Udi Aug 29, 2001
		Modification				 : Sept 13, 2001 additional variable
												   Sept 13, 2001 simplify process
												   Feb  28, 2002 Handling comparison operator
													 							 and a special NOL token to represent
																				 0 value.
													 Mar  04, 2002 Handle the Annuity rate 
    copyright            : (C) 2001 by PrimaLogic Inter Asia
    email                : udi@plitasoft.com
***************************************************************************/


class Formula extends Database {
	var $strfml;
	var $stack; 				//stack to hold the formula componen

  var $prefix;
	var $nopert;
  var $jua;
	var $masa;
	var $cb;  				 //cara bayar
	var $pt;  				 //masa pembayaran premi
	var $usia;  			 //usia tertanggung
	var $usia_bl;  			 //usia tertanggung
	var $rateup;
	var $produk;
	var $medstat;
	var $valuta;
	var $agen;
	var $add1;
	var $add2;
	var $ttg;
	var $marstat;
	var $marcatg;
	var $sex;
	var $premi1;
	var $mulas;
	var $expire;
	var $cbx;
	var $premirider;
	
	function Formula($userid="",$passwd="",$prefix="",$nopert="") {
	  $this->prefix=$prefix;
		$this->nopert=$nopert;
		$this->strfml="";
		$this->stack=array();
		Database::database($userid, $passwd, $DBName)
				
		$sql="select ".
						 "a.prefixpertanggungan, a.nopertanggungan, a.juamainproduk, a.usia_th, a.usia_bl, a.kdproduk, a.kdstatusmedical, a.kdvaluta,".
				 		 "a.kdcarabayar, a.lamaasuransi_th, a.lamapembpremi_th, a.noagen, a.notertanggung, ".
    				 "b.meritalstatus, b.jeniskelamin, a.premi1, a.premi2, a.premistd, a.nosp,  ".
    				 "to_char(b.tgllahir,'DD/MM/YYYY') tgllahir, to_char(add_months(a.expirasi,1),'DD/MM/YYYY') expbln,".
    				 "to_char(a.mulas,'DD/MM/YYYY') mulas,to_char(a.expirasi,'DD/MM/YYYY') expirasi, ".
    				 "c.kdbasispremi, c.kdbasistebus, c.kdbasisskg, c.kdbasiscwa, c.kdbasisbayar, ".
    				 "d.namacarabayar, d.kdjeniscb, nvl(a.premirider,0) premirider ".
		     "from  ".
				 		 "$DBUser.tabel_100_klien b,".
						 "$DBUser.tabel_200_temp a,".
						 "$DBUser.tabel_246_produk_basis c,".
						 "$DBUser.tabel_305_cara_bayar d ".
				 "where ".
				 		 "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$nopert' ".
				 		 "and a.notertanggung=b.noklien(+) and a.kdcarabayar=d.kdcarabayar ".
				 		 "and a.kdproduk=c.kdproduk and a.kdvaluta=c.kdvaluta ".
				 		 "and c.tglberlaku=(select max(tglberlaku) from $DBUser.tabel_246_produk_basis ".
    				  "where ".
    					//"kdbasispremi=c.kdbasispremi and kdbasistebus=c.kdbasistebus and kdbasisbayar=c.kdbasisbayar ".
    					//"and kdbasisskg=c.kdbasisskg and kdbasiscwa=c.kdbasiscwa ".
    					//"and ".
    					"kdproduk=c.kdproduk and kdvaluta=c.kdvaluta and tglberlaku <= a.mulas) ";
		//echo $sql."<br>";	
    Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		
		$this->prefix = $arr["PREFIXPERTANGGUNGAN"];
		$this->nopert = $arr["NOPERTANGGUNGAN"];
		$this->premi1 = $arr["PREMI1"];
		$this->premi2 = $arr["PREMI2"];
		$this->nosp = $arr["NOSP"];
		$this->masa = $arr["LAMAPEMBPREMI_TH"];
		$this->jua = $arr["JUAMAINPRODUK"];
		$this->usia = $arr["USIA_TH"];
		$this->usia_bl = $arr["USIA_BL"];
		$this->produk = $arr["KDPRODUK"];
		$this->medstat = $arr["KDSTATUSMEDICAL"];
		$this->valuta = $arr["KDVALUTA"];
		$this->pt = $arr["LAMAPEMBPREMI_TH"];
		$this->agen = $arr["NOAGEN"];
		$this->ttg = $arr["NOTERTANGGUNG"];
		$this->marstat = $arr["MERITALSTATUS"];
		$this->sex = $arr["JENISKELAMIN"];
		$this->cb = $arr["KDCARABAYAR"];
		$this->cabayar = $arr["KDCARABAYAR"];
		$this->mulas = $arr["MULAS"];
		$this->expire = $arr["EXPIRASI"];
		$this->expbln = $arr["EXPBLN"];
		$this->tgllahir = $arr["TGLLAHIR"];
		$this->namacarabayar = $arr["NAMACARABAYAR"];
		$this->kdjeniscb = $arr["KDJENISCB"];
		$this->premistandar = $arr["PREMISTD"];
		
		$this->kdbasispremi = $arr["KDBASISPREMI"];
		$this->kdbasistebus = $arr["KDBASISTEBUS"];
		$this->kdbasisskg = $arr["KDBASISSKG"];
		$this->kdbasiscwa = $arr["KDBASISCWA"];
		$this->kdbasisbayar = $arr["KDBASISBAYAR"];
		$this->premirider = $arr["PREMIRIDER"];
						
		//echo $this->cabayar;				
						
		$sql = "select faktorbayar ".
				   "from $DBUser.tabel_311_faktor_bayar ".
					 "where kdvaluta='$this->valuta' and kdcarabayar='$this->cb' ".
					 "and kdbasis= '$this->kdbasisbayar'";
    Database::parse($sql);
		Database::execute();
		$arz=Database::nextrow();
		$this->faktorbayar = $arz["FAKTORBAYAR"];    
    
		$sql = "select periodebayar from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefix' and nopertanggungan='$nopert' ".
				   "and kdjenisbenefit='R'";
    //echo $sql;
		Database::parse($sql);
		Database::execute();
		$arz=Database::nextrow();
		$this->extrapremipa = (($arz["PERIODEBAYAR"] >= 0) && ($arz["PERIODEBAYAR"] <= 100)) ?  $arz["PERIODEBAYAR"]  : 0;    
				
		$this->cb = ($this->cb=="1"||$this->cb=="2"||$this->cb=="3"||$this->cb=="4") ? "B" : $this->cb;		
		$this->marcatg = ($this->marstat=="K") ? 'K' : 'B';//pokoke bujangan kabeh
		$this->cbx = ($this->cb=='B') ? 1 : 2;
		
		$sql = "select periodebayar from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefix' and nopertanggungan='$nopert' ".
				   "and kdjenisbenefit='R'";
    //echo $sql;
		Database::parse($sql);
		Database::execute();
		$arz=Database::nextrow();
		$this->extrapremipa = (($arz["PERIODEBAYAR"] >= 0) && ($arz["PERIODEBAYAR"] <= 100)) ?  $arz["PERIODEBAYAR"]  : 0;    
				
		$this->cb = ($this->cb=="1"||$this->cb=="2"||$this->cb=="3"||$this->cb=="4") ? "B" : $this->cb;		
		$this->marcatg = ($this->marstat=="K") ? 'K' : 'B';//pokoke bujangan kabeh
		$this->cbx = ($this->cb=='B') ? 1 : 2;	

	}
	

	function tokparse(&$arg0, &$arg1, &$arg2) {
	  $str = $arg0;
		$tok = strtok ($str,".");
		if ($tok) {  						 //three level parsing
		  $arg0 = $tok;
      $tok = strtok (".");
			if ($tok) {
		    $arg1 = $tok;
        $tok = strtok (".");
			  if ($tok) {
		      $arg2 = $tok;
			  } else {
				  $arg2 = NULL;
				}
			} else {
				$arg1 = NULL;
			}
		}
		return;
	}
	
	function getval($DBX,$token="") {
    
		$this->tokparse($token,$adds,$addx);
/************************untuk nambah benefit nyang aneh2 disini******************/		
	
		if ($token=="JUA") {
			 $value = $this->jua;
		} elseif ($token=="MULAS") {
			 $value = $this->mulas;
		} elseif ($token=="EXPIRASI") {
			 $value = $this->expire;
		} elseif ($token=="EXPBLN") {
			 $value = $this->expbln;
		}	elseif ($token=="T_TK") {
		  $value = $this->masa - 14;	 
		}	elseif ($token=="T_SD") {
		  $value = $this->masa - 12;
		}	elseif ($token=="T_SMP") {
		  $value = $this->masa - 6;
		}	elseif ($token=="T_SMA") {
		  $value = $this->masa - 3;
		}	elseif ($token=="T_PT") {
		  $value = $this->masa;
		}	elseif ($token=="MASA") {
		  $value = $this->masa;
		}	elseif ($token=="MS_SISA") {
		  $value = $this->masa;
		}	elseif ($token=="PRMSTD")   {
		  $value = $this->premistandar;		
		}	elseif ($token=="PRMRDR")   {
		  $value = $this->premirider;		
		}	elseif ($token=="TGLLAHIR") {
		  $value = $this->tgllahir;
		}	elseif ($token=="USIA") {
		  $value = $this->usia;	
		}	elseif ($token=="PROPA") {
		  $value = $this->extrapremipa;		
		}	elseif ($token=="CBX") {
		  $value = $this->cbx;		
		}	elseif ($token=="NOL") { //this token used to substitute the value 0 
						 								 	 //function parse, to confuse to recognize value 0 in formula
		  $value = 0;		
		} elseif (! is_null($token)){
	      $this->rateup = $this->add1;
				$tokadds = $token.".".$adds;
				
    		$sql="select sqlsyntax from $DBUser.tabel_221_variabel_rumus ".
         		 "where kdvariabel='$tokadds'";
		 		//echo $sql;
				//echo $addx;
				
				Database::parse($sql);
				Database::execute();
				$arr=Database::nextrow();
				
				//if ($addx=="JUA") {
				
				$sqlsyntax = $arr["SQLSYNTAX"];
				//======================================================================
				//ditambahkan oleh agus, tanggal 16 Aguswtus 2005
				//untuk meng-handel kasus pengambilan nilai premi dari benefit yang sudah dibeli.
				//token yang dipakai adalah NILAI.PREMI.kdbenefit
				
				If (strlen($addx)> 0 ) {
					 $sqlsyntax = str_replace("#KDBENEFIT#",$addx,$sqlsyntax);
					 }
				//echo $sqlsyntax ;
				
				$sqlsyntax = str_replace("#PREFIX#",$this->prefix,$sqlsyntax);
				$sqlsyntax = str_replace("#NOPTG#",$this->nopert,$sqlsyntax);
				//======================================================================
				
				
				$sqlsyntax = str_replace("#KDPRODUK#",$this->produk,$sqlsyntax);
				$sqlsyntax = str_replace("#KDVALUTA#",$this->valuta,$sqlsyntax);
				$sqlsyntax = str_replace("#KDTARIF#",$addx,$sqlsyntax);
				$sqlsyntax = str_replace("#MARCATG#",$this->marcatg,$sqlsyntax);
				$sqlsyntax = str_replace("#MEDSTAT#",$this->medstat,$sqlsyntax);
				$sqlsyntax = str_replace("#RATEUP#",$this->rateup,$sqlsyntax);
				$sqlsyntax = str_replace("#CB#",$this->cb,$sqlsyntax);
				$sqlsyntax = str_replace("#BSPRM#",$this->kdbasispremi,$sqlsyntax);
				$sqlsyntax = str_replace("#BSSKG#",$this->kdbasisskg,$sqlsyntax);
				$sqlsyntax = str_replace("#BSCWA#",$this->kdbasiscwa,$sqlsyntax);
				$sqlsyntax = str_replace("#BSBAYAR#",$this->kdbasisbayar,$sqlsyntax);
				$sqlsyntax = str_replace("#USIA#",$this->usia,$sqlsyntax);
				$sqlsyntax = str_replace("#USIA_BL#",$this->usia_bl,$sqlsyntax);
				$sqlsyntax = str_replace("#MASA#",$this->masa,$sqlsyntax);
				$sqlsyntax = str_replace("#MS_SISA#",$this->masa,$sqlsyntax);
				$sqlsyntax = str_replace("#JUA#",$this->jua,$sqlsyntax);
				$sqlsyntax = str_replace("#PRMRDR#",$this->premirider,$sqlsyntax);
				$sqlsyntax = str_replace("#MS_TK#",($this->masa - 14),$sqlsyntax);
				$sqlsyntax = str_replace("#MS_SD#",($this->masa - 12),$sqlsyntax);
				$sqlsyntax = str_replace("#MS_SMP#",($this->masa - 6),$sqlsyntax);
				$sqlsyntax = str_replace("#MS_SMA#",($this->masa - 3),$sqlsyntax);
				$sqlsyntax = str_replace("#MS_PT#",$this->masa,$sqlsyntax);
				
				
				Database::parse($sqlsyntax);
			//echo $this->kdbasispremi;
			//echo $sqlsyntax; 
			//for tracing syntax
				Database::execute();
				$arr=Database::nextrow();

				$value = 0.001 * $arr["TARIF"];
				//echo $value;
		}
		return $value;
	}
	
	/* Parse the formula into tokens */
	function parse($str) {
    $this->strfml = $str;

	  if (strlen($str)==0){
		  return;
		}
		
		$this->stack=array();

    $tok = strtok ($str," ");
    while ($tok) {
			$puretkn = strtr($tok,")(","  ");
			$puretkn = trim($puretkn);
		  array_push($this->stack,$puretkn);
      $tok = strtok (" ");
			
			//echo " TOK:".$puretkn;
    }
		$this->stack=array_reverse($this->stack);
	}
	
	function execute($DBX) {
		$token = array_pop($this->stack);
    //echo $token;
	  if ($token=="*" || $token=="/" || $token=="+" || $token=="-" || $token=="^" || $token=="%" || $token=="DF" || $token=="DD" ||
			 $token=="==" ||$token=="!=" ||$token=="<" ||$token=="<=" || $token==">" || $token==">=" || $token=="?" ) {
			 
			 if ($token=="?") {					 //to do a comparison we have to have 3 tokens
			 		$token1 = $this->execute($DBX);
		   		$token2 = $this->execute($DBX);
		   		$token3 = $this->execute($DBX);
			 } else {	
			 		$token1 = $this->execute($DBX);
		   		$token2 = $this->execute($DBX);
			 } 
			 		
			
		   switch ($token) {
			   case "*" :
		       $result = $token1 * $token2;
					 break;
			   case "/" :
		       $result = $token1 / $token2;
					 break;
			   case "+" :
		       $result = $token1 + $token2;
					 break;
			   case "-" :
		       $result = $token1 - $token2;
					 break;
			   case "%" :
		       $result = $token1 % $token2;
					 break;
			   case "^" :
					 $result = pow($token1,$token2);
					 $result = ($token2 <= 0) ? 0 : $result; //return 0 if the power is null or negative
					 break;
         case "DF" :
				 	 if ($token2 <= 0) {
					   $result = null;
					 } else {	  
				     $sql="select to_char(add_months(to_date('$token1','DD/MM/YYYY'),$token2*12),'DD/MM/YYYY') result from dual";
					   Database::parse($sql);
					   Database::execute();
					   $arr=Database::nextrow();
					 
					   $result = $arr["RESULT"];
			     }
					 break;
         case "DD" :
				 	 if (($token1 <= 0)||($token2 <= 0)) {
					   $result = null;
					 } else {	  
				     $sql="select floor(months_between(to_date('$token1','DD/MM/YYYY'),to_date('$token2','DD/MM/YYYY'))) result from dual";
					   Database::parse($sql);
					   Database::execute();
					   $arr=Database::nextrow();
					 
					   $result = $arr["RESULT"];
			     }
					 break;
			   case "==" :
		       $result = ($token1 == $token2) ? 'TRUE' : 'FALSE';
					 break;
			   case "!=" :
		       $result = ($token1 != $token2) ? 'TRUE' : 'FALSE';
					 break;
			   case "<" :
		       $result = ($token1 < $token2) ? 'TRUE' : 'FALSE';
					 break;
			   case "<=" :
		       $result = ($token1 <= $token2) ? 'TRUE' : 'FALSE';
					 break;
			   case ">" :
		       $result = ($token1 > $token2) ? 'TRUE' : 'FALSE';
					 break;
			   case ">=" :
		       $result = ($token1 >= $token2) ? 'TRUE' : 'FALSE';
					 break; 
				 case "?"	:
				 	 $result = ($token1 == 'TRUE') ?	$token2 : $token3; 

					 break;
 		   default  :
				   $result = 0;
			 }
			 //echo $result;	  
		   return $result; 
 		} else { //tokennya angka
			 if (is_numeric($token)) {
		     return $token;
			 } else {
				 //echo $this->getval($DBX,$token);
				 return $this->getval($DBX,$token);  
			 }
		} 
	}
};
?>
