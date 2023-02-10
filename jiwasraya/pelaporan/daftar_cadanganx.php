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
$squ="insert into $DBUser.TABEL_CADANGAN_PREMI_ACT (ID,
                                      TGLACT,
                                      KATEGORI,
                                      EKSEKUSI,
                                      KETERANGAN,PREMITRANSAKSI) 
									  values ('".$idx."',to_date('".$tgl."','dd/mm/yyyy'),'".$kategori."','".$eksekusi."','".$ket."','".$premi."')";
									
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
<tr><td>Entry Data Follow Up</td><td></td></tr>
<tr valign="top">
    <td>Kategori</td><td>
    <select name="kategori">
    <option value="HAMPIR 100%">HAMPIR 100%</option>
    <option value="DIATAS 70%">DIATAS 70%</option>
    <option value="ANTARA 50% sd 100%">ANTARA 50% sd 100%</option>
    <option value="DIBAWAH 50%">DIBAWAH 50%</option>
    </select>
    </td></tr>
    <tr><td>Eksekusi</td><td>
    <select name="eksekusi">
    <option value="BARU">BARU</option>
    <option value="CLOSING">CLOSING</option>
    <option value="GAGAL">GAGAL</option>
    </select>
    </td></tr>
    <tr><td>Tanggal</td><td><input type="text" name="tgl" /> &nbsp;dd/mm/yyyy</td></tr>
    <tr><td>Keterangan</td><td><textarea name="ket" rows="3"></textarea></td></tr>
    <tr><td>Premi Transaksi</td><td><input type="text" name="premi" /></td></tr>
    <tr><td></td><td><input type="submit" value="Save" name="simpan" /></td></tr>
</table>
<a href="javascript:window.opener.location.reload();window.close();" >Close </a>


</form>
 </body>
</html>
