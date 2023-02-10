<? 
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/formula44.php";
	
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	$FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);

	$sql = "select a.nosp,a.noagen,a.lamapembpremi_th,b.namaproduk,".
			   "a.indexawal,a.notertanggung,a.juamainproduk, ".
				 "a.kdproduk,a.kdcarabayar,a.kdstatusmedical,a.usia_th,a.lamaasuransi_th,a.kdvaluta ".
	       "from $DBUser.tabel_200_temp a, $DBUser.tabel_202_produk b ".
			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
				 "and a.nopertanggungan='$nopertanggungan' and a.kdproduk=b.kdproduk";
  $DB->parse($sql);
	$DB->execute();
  $prd=$DB->nextrow();
	
	$namaproduk=$prd["NAMAPRODUK"];
	$noagen=$prd["NOAGEN"];
	$nosp=$prd["NOSP"];
	$kdvaluta=$prd["KDVALUTA"];
	$pt=$prd["LAMAPEMBPREMI_TH"];
	$medical=$prd["KDSTATUSMEDICAL"];
	$nottg=$prd["NOTERTANGGUNG"];
	$usia=$prd["USIA_TH"];
	$masa=$prd["LAMAASURANSI_TH"];
	$jua=$prd["JUAMAINPRODUK"];
	
	$sql = "select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
	     	 "where tglkursberlaku<=sysdate and kdvaluta='$kdvaluta') ".
	     	 "and kdvaluta='$kdvaluta'";	
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$idx = $res["KURS"];
 
  $indexawal = ($indexawal==''||strlen($indexawal)==0) ? $idx : $indexawal;					 		
  $juadlrp=$jua*$indexawal;
	
	// cari resiko pekerjaan :
	$sql="select faktorresiko/1000 resiko ".
			 "from $DBUser.tabel_229_resiko_produk ".
			 "where kdproduk='$kdproduk' and kdvaluta='$kdvaluta' and usia=$usia and masa=$masa ";
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$fakrnow=($res["RESIKO"]==0) ? 1 : $res["RESIKO"];
	$rskg = $fakrnow*$juadlrp;
	
  /*******************************************************run once*******************************/
  if ($state) { //perubahan produk hapus isi 223temp kecuali 'R'
  	$sql="begin $DBUser.delbnft('$prefixpertanggungan','$nopertanggungan'); end;";
  	//echo $sql;
  	$DB->parse($sql);
   	$DB->execute();
   	$DB->commit();
  	
  	if ($FM->medstat=='M' or $FM->cabayar=='X') { // or $FM->cabayar=='E'					
  		$sql="begin	$DBUser.insbnftnxtra('$prefixpertanggungan','$nopertanggungan','$kdproduk');end;";		
  	} else {
  		$sql="begin	$DBUser.insbnft('$prefixpertanggungan','$nopertanggungan','$kdproduk');end;";			
  	}	
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
    /*******************************************************run many******************************************/
  } else {	
  	  $state=0;
    	if($propmtc12insert=="Insert") { //insert additional produk
    		if (strlen($periodebayar)==0) $periodebayar="null";
    	  if (strlen($periodebenefit)==0) $periodebenefit="null";
    
    	  // tambahan untuk cashplan
    		if($kdbenefit=="CP1" || $kdbenefit=="CP2" || $kdbenefit=="CP3"){
    		  $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and substr(kdbenefit,1,3)='$kdbenefit'";
    		
    		} else {
    		  $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
    		   		   "values ('$prefixpertanggungan','$nopertanggungan','$kdproduk','$kdbenefit',$periodebayar,$periodebenefit,'R')";
    		}
        $DB->parse($sql);
    		$DB->execute();
      	$DB->commit();
    		
      } else if($del=="X") {
    	   $sql="delete from  $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' ".
    		 			"and nopertanggungan='$nopertanggungan' and kdjenisbenefit='R' and kdbenefit='$kdbnfx'";
        $DB->parse($sql);
    		$DB->execute();
      	$DB->commit();	
    	} else if($propmtc12lanjut=="Lanjut") {
    		/*-------------------------------------------------------premia atawa jua-------------------------------------------------- */
    		switch ($premijua) {
    		  case 'jua' : {
    	  		header("location:simulasi_benefit1.php?vara=$vara&premijua=$premijua&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper");//asli propmtc14
    			} break;
    			case 'premi' : {
    			  header("location:simulasi_benefit2.php?vara=$vara&premijua=$premijua&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper");//asli propmtc14
    			} break;
    		}				
    		exit;
    	} 
  } 

  /*-----------------------------------tampilin daftar benefit--------------------------------------------------------------------*/
	$cabayar=$FM->cabayar;
	$cabar = $FM->namacarabayar;

	$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,".
			 "b.namabenefit,a.nilaibenefit,".
			 "a.premi,a.kdjenisbenefit ".
	     "from $DBUser.tabel_223_temp a,$DBUser.tabel_207_kode_benefit b ". //watch the fuck temp
			 "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
			 "and a.kdbenefit=b.kdbenefit(+) and a.kdproduk='$kdproduk' ";
			 
			 //echo $sql;
  		 $DB->parse($sql);
			 $DB->execute();

?>
<html>
<head>
<title>Benefit Produk</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<input type="hidden" name="kdproduk" value="<? echo $kdproduk; ?>">
</head>

<body onload="document.propbnft.propmtc12insert.disabled=true">
<form name="propbnft" method="POST" action="<? PHP_SELF; ?>">

   <b>Daftar Benefit</b>
   <hr size="1">
   <table width="100%" cellpadding="1" cellspacing="0">
    <tr>
     <td>Kode Produk</td>
  	 <td>: <? echo $kdproduk . " - ".$namaproduk; ?> </td>
     <td>Lama Pembayaran Premi</td>
  	 <td>: <? echo $pt; ?> tahun secara <? echo $cabar; ?></td>
    </tr>
    <tr>
     <td>Basis Premi</td>
  	 <td>: <? echo $FM->kdbasispremi ?> </td>
     <td>Basis Bayar</td>
  	 <td>: <? echo $FM->kdbasisbayar ?> </td>
    </tr>  
   </table>
  <hr size=1>

 	<table border=0 width="100%">
	<tr align=center bgcolor="#ccffcc">
	 <td>No</td>
	 <td>Kode</td>
	 <td>Nama Benefit</td>
	 <td>Jenis</td>
	</tr>
	<? 
	$i = 1;
  while ($arr=$DB->nextrow()) {
	 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "dddddd").">";
	 if ($arr["KDJENISBENEFIT"]=='R') {
	  print ("<input type=\"hidden\" name=\"kdbnfx\" value=\"".$arr["KDBENEFIT"]."\">\n" );
  	print( "<input type=\"hidden\" name=\"kdper\" value=\"".$kdper."\">\n" );
  	print( "<input type=\"hidden\" name=\"kdproduk\" value=\"".$arr["KDPRODUK"]."\">\n" );
  	print( "<input type=\"hidden\" name=\"mode\" value=\"insert\">\n" );
  	print( "<input type=\"hidden\" name=\"vara\" value=\"".$vara."\">\n" );
  	print( "<input type=\"hidden\" name=\"prefixpertanggungan\" value=\"".$prefixpertanggungan."\">\n" );
  	print( "<input type=\"hidden\" name=\"nopertanggungan\" value=\"".$nopertanggungan."\">" );
		echo "<td align=center><input name=del type=submit value=X class=buton></td>";
	 } else {
		print  ("<td align=center>$i</td>\n" );
	 }	
		print  ("<td>".$arr["KDBENEFIT"]."</td>\n" );
		print  ("<td>".$arr["NAMABENEFIT"]."</td>\n" );
		print  ("<td align=center>".$arr["KDJENISBENEFIT"]."</td>\n" );
	  print  ("</tr>\n" );
		$i ++;
	} 
	echo "<tr>";
	echo "<td>$no</td>";
	echo "<td><input type=\"hidden\" name=\"premijua\" value=$premijua>";
	echo "<input type=\"text\" name=\"kdbenefit\" size=\"10\"   readonly></td>";
	echo "<td><input type=\"text\" name=\"namabenefit\" size=\"20\" readonly> Tambah Benefit » ";
	printf("<a href=\"#\" onclick=\"NewWindow('popupjam1.php?medical=%s".
				 "&nopertanggungan=%s&kdproduk=%s&kdbenefit=%s','popupjamtambahan',300,300,1)\">".
				 "<img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari jaminan tambahan\"></a>".
				 "</td>",$medical,$nopertanggungan,$kdproduk,"%");
	echo "<td align=\"center\"></td>";
	echo "</tr>";
	
	echo "</table>";
	?>

  <table width="100%">
  <tr>
  	<td align="right">
  	 <input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
  	 <input type="hidden" name="kdper" value="<? echo $kdper; ?>">
  	 <input type="hidden" name="kdproduk" value="<? echo $kdproduk; ?>">
  	 <input type="hidden" name="mode" value="insert">
  	 <input type="hidden" name="vara" value="<?echo $vara;?>">
  	 <input type="hidden" name="prefixpertanggungan" value="<? echo $prefixpertanggungan; ?>">
  	 <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
     <input type="submit" name="propmtc12insert" value="Insert">
     <input type="submit" name="propmtc12lanjut" value="Lanjut">
  	</td> 
   </tr> 
   </table>
  </form>
</body>
</html>
