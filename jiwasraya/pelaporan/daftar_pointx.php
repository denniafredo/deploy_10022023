<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  $DB=new database($userid, $passwd, $DBName);
  $DBC=new database($userid, $passwd, $DBName);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT LANGUAGE="JavaScript" SRC="js/global.js"></SCRIPT>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:1px; }
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

#filterbox{
  border: solid 1px #c0c0c0;
	padding : 5px;
	width:100%;
	margin : 0 0 10px 0;
}
form{
  margin : 0;
	padding : 0;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>

<title>Untitled Document</title>
</head>
<?
if (isset($simpan)){
$squ="insert into $DBUser.TABEL_223_TRANSAKSI_POINT (prefixpertanggungan, nopemegangpolis,
                                      nopertanggungan,
                                      berlaku,
                                      KETERANGAN,pointreward) 
									  values ('R','".$idx."','REDEEM',to_date('".$tgl."','dd/mm/yyyy'),'".$ket."','".$premi."')";
									
 //echo $squ;
 $DB->parse($squ);
 if ($DB->execute()) { echo "<font color='#00BF00'>Data Berhasil Tersimpan...</font></br>";} 
 else { echo "<font color='#FF0000'>Gagal...</font></br>";;};
 
   }
?>

<!-- onblur="self.focus()"-->
<body class="contentPage" > 
<form name="myform" action="<?=$PHP_SELF;?>" method="POST">	
<input type="hidden" name="idx" value="<?=$id;?>" />
<table>
<tr><td>Entry Data Redeem</td><td></td></tr>
    <tr><td>Pemegang Polis</td><td>
    <?
    $sql="SELECT   namaklien1 nama FROM   $DBUser.tabel_100_klien WHERE   noklien = '$idx'";
	$DB->parse($sql);
    $DB->execute();	
	$arr=$DB->nextrow();
	echo $arr["NAMA"];
	?>
    </td></tr>
    <tr><td>Tanggal</td><td><input type="text" name="tgl" /> &nbsp;dd/mm/yyyy</td></tr>
    <tr><td>Keterangan</td><td><textarea name="ket" rows="3"></textarea></td></tr>
    <tr><td>Redeem Point</td><td><input type="text" name="premi" /></td></tr>
    <tr><td></td><td><input type="submit" value="Redeem" name="simpan" /></td></tr>
</table>
<a href="javascript:window.opener.location.reload();window.close();" >Close </a>


</form>
 </body>
</html>
