<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";

	$prefixpertanggungan = $kantor;
	$DB=new database($userid, $passwd, $DBName);
	
	$sql="select kdpertanggungan,prefixpertanggungan,kdproduk from $DBUser.tabel_200_pertanggungan ".
			 "where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' ";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$hasil		=$res["KDPERTANGGUNGAN"];
	$prefix		=$res["PREFIXPERTANGGUNGAN"];
	$kdproduk = $res["KDPRODUK"];
	
	//echo $hasil;
	
	// add by salman atas request nota intern URC PP tgl 18/juli/2013
	$sqx="select count(*) bayar from $DBUser.tabel_800_pembayaran ".
			 "where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' ";
	//echo $sql;
	$DB->parse($sqx);
	$DB->execute();
	$res=$DB->nextrow();
	$cek_bayar=$res["bayar"];
	
	if($cek_bayar==0){
		   if ($hasil=='1' && $prefix==$kantor) {
			/*$sql_acceptance = "select prefixpertanggungan,nopertanggungan,kdacceptance from ".
													"$DBUser.tabel_214_acceptance_dokumen ".
													"where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' ";*/
			$sql_acceptance = "select prefixpertanggungan,nopertanggungan, KDUNDERWRITING kdacceptance from ".
													"$DBUser.TABEL_214_UNDERWRITING ".
													"where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' ";										
			$DB->parse($sql_acceptance);
			$DB->execute();
			$found=$DB->nextrow();
			if ($found["KDACCEPTANCE"]=="1"){
				header("location:http://$HTTP_HOST/$KAMP/proposal/propmtc01.php?noproposal=".$found["PREFIXPERTANGGUNGAN"]);
				exit;	
			}else{				 
			   if ($modeopr=="update") { 
				  //echo substr($kdproduk,0,5);
					//die;
					if(substr($kdproduk,0,5)=="JL2XS"){
					header("location:http://$HTTP_HOST/$KAMP/proposal/ntryprop_jslinkmtc.php?SID=".SID."&nopertanggungan=$nopertanggungan&prefixpertanggungan=$kantor");
					} else {
					header("location:http://$HTTP_HOST/$KAMP/proposal/ntrypropmtc.php?SID=".SID."&nopertanggungan=$nopertanggungan&prefixpertanggungan=$kantor");
					}
					
					
					exit;
				 } else if ($modeopr=="query") {
					header("location:http://$HTTP_HOST/$KAMP/proposal/peliharaprop.php?nopertanggungan=$nopertanggungan");
					exit;
				 } else if ($modeopr=="drop") {
					header("location:http://$HTTP_HOST/$KAMP/proposal/peliharaprop.php?drop=1&nopertanggungan=$nopertanggungan");
					exit;
				 }
			 }
		} else {
		 if ($hasil=='2') {	
		print( "Nomor Pertanggungan ini Sudah menjadi Polis " );
		  print("<br>");
		print( "		  <font face=\"verdana\" size=\"2\"><a href=\"javascript:window.history.back();\">Back</a></font>\n" );
		 }
		
		 if ($prefix <> $kantor) {	
		print( "Nomor Pertanggungan bukan dari kantor ".$kantor."" );
		  print("<br>");
		print( "		  <font face=\"verdana\" size=\"2\"><a href=\"javascript:window.history.back();\">Back</a></font>\n" );
		 }
		
		}

	}	
	else{
		echo "Maaf sudah ada pembayaran,proposal tidak bisa diedit, untuk penjelasan silahkan hubungi bagian Underwriting URC PP";
	}
?>	
