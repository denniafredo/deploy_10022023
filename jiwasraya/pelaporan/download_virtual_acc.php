<?  

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=virtual_account.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");	
  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DB = new Database($userid, $passwd, $DBName);
	//$DBUL=New database($userid, $passwd, $DBName);
  $DBX = new Database($userid, $passwd, $DBName);
	//$DBX=new database($userid, $passwd, $DBName);
	

	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Virtual Account</title>
</head>
<style type="text/css">
<!-- 
body, td, select, input {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
DAFTAR VIRTUAL ACCOUNT
<?
	  
	  $sql= " SELECT (select kdproduk from $DBUser.tabel_200_pertanggungan where prefixpertanggungan=A.prefixpertanggungan and nopertanggungan=A.nopertanggungan) produk, A.*, TO_CHAR(TGLREKAM,'DD/MM/YYYY') TGLREKAM FROM $DBUser.TABEL_100_KLIEN_ACCOUNT A where trunc(tglrekam) between to_date('".$tglDari."','DD/MM/YYYY') and to_date('".$tglSampai."','DD/MM/YYYY') AND JENIS='VA' AND STATUS='0'";	

 //echo "PERIODE AKSEPTASI ".$tglDari." s/d ".$tglSampai."<br><br>";
	 if($kdstatuspolis=='1'){
	  
	  $sql="select a.kdproduk produk,b.*,TO_CHAR (b.TGLREKAM, 'DD/MM/YYYY') TGLREKAM from  $DBUser.TABEL_200_pertanggungan A,
$DBUser.TABEL_100_KLIEN_ACCOUNT b  where a.nopertanggungan=b.nopertanggungan and a.prefixpertanggungan=b.prefixpertanggungan
and  TRUNC (b.tglrekam) BETWEEN TO_DATE ('".$tglDari."', 'DD/MM/YYYY')
                              AND  TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')
         AND b.JENIS = 'VA'
         AND b.STATUS = '0'  
		 AND b.KDBANK='BNI'		 
         and a.kdpertanggungan ='".$statuspolis."'
		 and a.kdstatusfile ='".$kdstatuspolis."'
		 ";
		 }else{
		$sql="select A.TGLBPO,a.kdproduk produk,b.*,TO_CHAR (b.TGLREKAM, 'DD/MM/YYYY') TGLREKAM from  $DBUser.TABEL_200_pertanggungan A,
$DBUser.TABEL_100_KLIEN_ACCOUNT b,$DBUser.polis_history_status c  where a.nopertanggungan=b.nopertanggungan and a.prefixpertanggungan=b.prefixpertanggungan
and  TRUNC (c.TGLMUTASI) BETWEEN TO_DATE ('".$tglDari."', 'DD/MM/YYYY')
                              AND  TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')
         AND b.JENIS = 'VA'
         AND b.STATUS = '0'  
		 AND b.KDBANK='BNI'	
		 and a.nopertanggungan = c.nopertanggungan
         AND a.prefixpertanggungan = c.prefixpertanggungan	
         and a.kdpertanggungan ='".$statuspolis."'
		 and a.kdstatusfile ='".$kdstatuspolis."'
		 ";		
	}
   
 
    //echo $sql;				
?>


<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
    <td bgcolor="#89acd8" align="center">BO</td>
		<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Bank</td>
    <td bgcolor="#89acd8" align="center">Account</td>
    <td bgcolor="#89acd8" align="center">Tanggal</td>
    <td bgcolor="#89acd8" align="center">Keterangan</td>
    <td bgcolor="#89acd8" align="center">Produk</td>
  </tr>
  <? 
  
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
		$ket = explode('-', $arr['KETERANGAN']);
		$keterangan = $ket[0].'-IFGLIFE-'.$ket[1];
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KDBANK"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA">&nbsp;<?=$arr["NOACCOUNT"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["TGLREKAM"];?></td>
        <td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$keterangan;?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["PRODUK"];?></td>

	<? 
	$i++;

	}
	
	?>
      </tr>
</table>