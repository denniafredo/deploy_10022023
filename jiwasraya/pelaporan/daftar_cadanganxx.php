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
$squ="insert into $DBUser.TABEL_CADANGAN_PREMI (KDKANTOR,
                                  PROSPEK,
                                  BISNIS,
                                  PST,
                                  PRODUK,
                                  PRODUKPLAN,
                                  PREMI,
                                  KATEGORI,
                                  ASUMSITUTUP,
                                  KENDALA,
                                  STATUS,
                                  CORE,
                                  EKSEKUSI,
                                  PREMITRANSAKSI,
                                  ID) values ('".$kantor."','".$namaprospek."','".$bisnis."','".$peserta."','".$produk."','".$plan."','".$premiawl."','".$kategori."',to_date('".$asumsi."','dd/mm/yyyy'),'".$kendala."','".$status."','".$core."','".$eksekusi."','".$premi."',$DBUser.no_cadprm.nextval)";
									
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
    <tr><td colspan="2"><b>Entry Data Cadangan</b></td></tr>
    <tr><td>Nama Prospek</td><td><input type="text" name="namaprospek" size="60"/></td></tr>
    <tr><td>Bisnis</td><td><select name="bisnis">
    <option value="NEW">NEW</option>
    <option value="RENEW">RENEW</option>
    </select></td></tr>
    <tr><td>Peserta</td><td><input type="text" name="peserta" size="10" /></td></tr>
    <tr><td>Produk</td><td><select name="produk">
    <option value="ASKRED">ASKRED</option>
    <option value="PA">PA</option>
    <option value="DWIGUNA">DWIGUNA</option>
    <option value="THT/JHT">THT/JHT</option>
    <option value="ASKES">ASKES</option>
    <option value="PROKESPEN">PROKESPEN</option>
    </select></td></tr>
    <tr><td>Plan</td><td><input type="text" name="plan" size="60" /></td></tr>
    <tr><td>Premi</td><td><input type="text" name="premiawl" /></td></tr>
    <tr valign="top">
    <td>Kategori</td><td>
    <select name="kategori">
    <option value="HAMPIR 100%">HAMPIR 100%</option>
    <option value="DIATAS 70%">DIATAS 70%</option>
    <option value="ANTARA 50% sd 100%">ANTARA 50% sd 100%</option>
    <option value="DIBAWAH 50%">DIBAWAH 50%</option>
    </select>
    </td></tr>
    <tr><td>Asumsi Penutupan</td><td><input type="text" name="asumsi" /> dd/mm/yyyy</td></tr>
    <tr><td>Kendala& Support</td><td><textarea name="kendala" rows="3" cols="50"></textarea></td></tr>
    <tr><td>Status</td><td>
    <select name="status">
    <option value="BUMN/BUMND">BUMN/BUMD</option>
    <option value="NON BUMN/NON BUMN">NON BUMN/NON BUMD</option>
    </select>
    </td></tr>
    <tr><td>Core Business</td><td>
    <select name="core">
    <option value="INSTITUSI KEUANGAN">INSTITUSI KEUANGAN</option>
    <option value="MINYAK TAMBANG">MINYAK TAMBANG</option>
    <option value="KEHUTANAN, KELAUTAN, TANI, TERNAK">KEHUTANAN, KELAUTAN, TANI, TERNAK</option>
    <option value="INFRASTRUKTUR/INDUSTRI BERAT">INFRASTRUKTUR/INDUSTRI BERAT</option>
    <option value="MAKANAN/MINUMAN KIMIA">MAKANAN/MINUMAN KIMIA</option>
    <option value="PENDIDIKAN KESEHATAN">PENDIDIKAN KESEHATAN</option>
    <option value="PROPERSTI REAL ESTATE">PROPERSTI REAL ESTATE</option>
    <option value="TRADING, KOMUNIKASI, KOMPUTER">TRADING, KOMUNIKASI, KOMPUTER</option>
    <option value="LAINNYA">LAINNYA</option>
    </select>
    </td></tr>
    <tr><td>Eksekusi</td><td>
    <select name="eksekusi">
    <option value="BARU">BARU</option>
    <option value="CLOSING">CLOSING</option>
    <option value="GAGAL">GAGAL</option>
    </select>
    </td></tr>
    <tr><td>Premi Transaksi</td><td><input type="text" name="premi" /></td></tr>
    <tr><td></td><td><input type="submit" value="Save" name="simpan" /></td></tr>
</table>
<a href="javascript:window.opener.location.reload();window.close();" >Close </a>


</form>
 </body>
</html>
