<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";

	$prefixpertanggungan = $kantor;
	$DB=new database($userid, $passwd, $DBName);
	
	$sql="select kdpertanggungan,prefixpertanggungan,kdproduk,kdstatusemail,nopertanggungan from $DBUser.tabel_200_pertanggungan ".
			 "where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' and substr(kdproduk,1,3)='JL4'";
	echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$hasil		=$res["KDPERTANGGUNGAN"];
	$prefix		=$res["PREFIXPERTANGGUNGAN"];
	$kdproduk = $res["KDPRODUK"];
	$kdapproved = $res["KDSTATUSEMAIL"];
	
	//echo $hasil;
   if ($hasil=='1' && $prefix==$kantor) {
		//cek udah email
		$sql_email = "select kdstatusemail, keterangan from ".
												"$DBUser.tabel_200_pertanggungan ".
												"where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' and substr(kdproduk,1,3)='JL4'";
												//echo $sql_mail;
//												die;
		$DB->parse($sql_email);
		$DB->execute();
		$foundemail=$DB->nextrow();
		if ($foundemail["KDSTATUSEMAIL"]=="1" && $foundemail["KETERANGAN"]==""){
			header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/propmtc01_link.php?noproposal=".$prefix);
			exit;	
		}
		//end cek email   
   
   		$sql_acceptance = "select prefixpertanggungan,nopertanggungan,kdacceptance from ".
												"$DBUser.tabel_214_acceptance_dokumen ".
												"where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' ";
												echo $sql_acceptance;
												//die;
		$DB->parse($sql_acceptance);
		$DB->execute();
		$found=$DB->nextrow();
		if ($found["KDACCEPTANCE"]=="1"){
			header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/propmtc01_link.php?noproposal=".$found["PREFIXPERTANGGUNGAN"]);
			exit;	
		}else{				 
		   if ($modeopr=="update") { 
			  //echo substr($kdproduk,0,5);
				//die;
				header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/ntrypropmtc_ulink.php?SID=".SID."&nopertanggungan=$nopertanggungan&prefixpertanggungan=$kantor");
				
				exit;
			 } else if ($modeopr=="query") {
				header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/peliharaprop.php?nopertanggungan=$nopertanggungan");
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
?>	
