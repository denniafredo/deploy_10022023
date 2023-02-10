<? 
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	
echo "<title>UPDATE DATA HASIL KONVERSI</title>";
echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<body bgcolor=#dbfcba>";
echo "<a class=\"verdana10blk\"><b>UPDATE PERTANGGUNGAN</b></a>";
echo "<hr size=1>";
echo "<a class=\"verdana10blk\"><b>".$prefix."-".$noper." ".$namattg."</b></a>";
echo "<hr size=1>";

if($update){
  $DB = new Database($userid, $passwd, $DBName);
 	//$DB=New Database("JSADM","JSADM","JSDB10");
  $sql = "update $DBUser.tabel_200_pertanggungan set ".
	       "nopenagih='$nopenagihbaru',".
				 "noagen='$noagenbaru',".
				 "kdproduk='$kdprodukbaru',".
				 "kdstatusfile='$kdstatusfile', ".
				 "tglupdated=sysdate,userupdated='$userid' ".
	       "where ".
				 "nopertanggungan='$noper'";
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
  $DB->commit();
		
		print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
		print( "<!--\n" );
		print( "window.opener.location.replace('portopoliokantor.php?lihat=&start=1&end=200&page=1');" );
		print( "window.close();" );
		print( "//-->\n" );
		print( "</script>\n" );
		
	echo "<a class=\"verdana10blk\">Telah ter-update ....</a><br>";
	echo "<a class=\"verdana10blk\">Silakan refresh halaman utama untuk melihat perubahannya.</a><br><br>";
	echo "<a class=\"verdana10blk\" href=\"javascript:window.close();\">CLOSE</a>";

} else { 

 ?>
<form name="updatekonversi" method="POST" action="<? $PHP_SELF; ?>">
 <table border="0" cellpadding="2">
  <tr>
    <td class="verdana10blk">Produk</td>
    <td><input type="text" name="kdprodukbaru" size="12" maxlength="10" value="<?echo $kdproduk;?>" readonly></td>
    <td>
		<? if($kdproduk=="XXX"){ ?>
		<a href="#" onclick="window.open('produkkonversi.php','popuppage','scrollbars=yes,width=420,height=300,top=100,left=100');"><img src="../img/jswindow.gif" alt="Daftar Produk" name="getproduk" border="0"></a>
		<? } else {} ?>
		</td>
    <td></td>
  </tr>
  <tr>
    <td class="verdana10blk">Penagih</td>
    <td><input type="text" name="nopenagihbaru" size="12" maxlength="10" value="<?echo $nopenagih;?>"></td>
    <td><input type="text" name="namapenagihbaru" size="35" value="<?echo $namapenagih;?>" readonly></td>
    <td><a href="#" onclick="window.open('penagihkonversi.php','popuppage','scrollbars=yes,width=420,height=300,top=100,left=100');"><img src="../img/jswindow.gif" alt="Daftar Penagih" border="0"></a></td>
  </tr>
  <tr>
    <td class="verdana10blk">Agen</td>
    <td><input type="text" name="noagenbaru" size="12" maxlength="10" value="<?echo $noagen;?>"></td>
    <td><input type="text" name="namaagenbaru" size="35" value="<?echo $namaagen;?>" readonly></td>
    <td><a href="#" onclick="window.open('agenkonversi.php','popuppage','scrollbars=yes,width=420,height=300,top=100,left=100');"><img src="../img/jswindow.gif" alt="Daftar Agen" border="0"></a></td>
  </tr>
  <tr>
    <td class="verdana10blk">Status</td>
		<? 
		$st1 = ($kdstatusfile=="1")? "selected" : "";
		$st2 = ($kdstatusfile=="2")? "selected" : "";
		$st3 = ($kdstatusfile=="3")? "selected" : "";
		$st4 = ($kdstatusfile=="4")? "selected" : "";
		$st5 = ($kdstatusfile=="5")? "selected" : "";
		$st6 = ($kdstatusfile=="6")? "selected" : "";
		$st7 = ($kdstatusfile=="7")? "selected" : "";
			
    echo "<td><select size=\"1\" name=\"kdstatusfile\">";
    echo "<option value=\"1\" $st1>AKTIF</option>";
    echo "<option value=\"2\" $st2>NON-AKTIF</option>";
    echo "<option value=\"3\" $st3>EKSPIRASI</option>";
    echo "<option value=\"4\" $st4>BPO</option>";
		echo "<option value=\"5\" $st5>TEBUS</option>";
    echo "<option value=\"6\" $st6>KLAIM</option>";
		echo "<option value=\"7\" $st7>DELETE</option>";
    echo "</select></td>";
		?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>
<p>
   <input type="hidden" value="<? echo $noper; ?>" name="noper">
   <input type="submit" value="UPDATE" name="update">
   <input type="submit" value="BATAL" name="batal" onclick="javascrpt:window.close();">
</p>
</form>
<? } ?>
</body>