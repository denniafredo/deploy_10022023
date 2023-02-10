<?
include "../../includes/msdb_connect.php";
/*
$myServer   = "danareksa";
$myUser 		= "sa";
$myPass 		= "siar";
$myDB				= "siar";
$s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
$d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
 */          
$nopol = "BC001581740";

/*						
$sqa = "SELECT *, convert(varchar,TGL_TRANSAKSI_PLUS_TERAKHIR,103) as TGL_TRANSAKSI_PLUS_TERAKHIR, 
        convert(varchar,TGL_TRANSAKSI_MINUS_TERAKHIR,103) as TGL_TRANSAKSI_MINUS_TERAKHIR, 
        convert(varchar,TRANSAKSI_TERAKHIR,103) as TRANSAKSI_TERAKHIR FROM vSelisihSaldo 
        where nopol like '$nopol%'
        ORDER BY SELISIH DESC";
*/			
$sqa = "select SaldoUnit from vselisihsaldo where nopol like '$nopol%'";
echo $sqa;
echo "<br />";
echo "<br />";

$res= mssql_query($sqa);
$row = mssql_fetch_array($res);
$totalunit = $row["SaldoUnit"];
echo "total unit = ".$totalunit;

echo "<br />";
$msqry = "select convert(varchar, tanggal, 103) as tglmax,value as nilainab from tablenab where tanggal in (select max(tanggal) from tablenab) order by tanggal desc, productId desc";
        $res= mssql_query($msqry);
    		$row = mssql_fetch_array($res);
				$nilainab = $row["nilainab"];
				$tglnab = $row["tglmax"];

echo "nilai NAB ($tglnab) = ".$nilainab;

echo "<br />";
$npengembangan = number_format(($totalunit * $nilainab),2,",",".");
//$npengembangan = ceil(($totalunit * $nilainab),2);


echo "Total pengambangan dana = total unit * NAB = ".$npengembangan;
?>