<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
	$DB = new Database($userid, $passwd, $DBName);
  echo "<link href=\"../jwsclass.css\" rel=\"stylesheet\" type=\"text/css\">";
if($Submit){

	if($jnscari=="NTOO"){
	  $nopertanggungan = $nopert;
	}
	
				$sql = "select s.*,x.namaklien1 as namapenagih,y.namaklien1 as namaagen,".
					       "d.namacarabayar from ".
					       "(select ".
                 "a.nopol,a.prefixpertanggungan,a.nopertanggungan,".
                 "a.notertanggung,a.juamainproduk,a.premi1,premi2,".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
								 "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,".
                 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.kdstatusfile,".
                 "to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
                 "a.lamaasuransi_th,b.namaklien1 as namattg ".
                 "from ".
                 "$DBUser.tabel_200_pertanggungan a,".
                 "$DBUser.tabel_100_klien b, ".
								 "$DBUser.tabel_500_penagih c ".
								 "where ".
								 "c.kdrayonpenagih='$kantor' and ".
								 "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$nopertanggungan' and ".
                 "a.notertanggung=b.noklien and ".
								 "a.nopenagih=c.nopenagih) s,".
								 "$DBUser.tabel_305_cara_bayar d,".
								 "$DBUser.tabel_100_klien x,".
								 "$DBUser.tabel_100_klien y ".
								 "where ".
								 "s.kdcarabayar=d.kdcarabayar and ".
								 "s.nopenagih=x.noklien and ".
								 "s.noagen=y.noklien(+) order by s.nopertanggungan";	
 
	//echo $sql."<br><br>";
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();
	$namattg = $arr["NAMATTG"];
	$kdproduk = $arr["KDPRODUK"];
	$nopenagih = $arr["NOPENAGIH"];
	$namapenagih = $arr["NAMAPENAGIH"];
	$noagen = $arr["NOAGEN"];
	$namaagen = $arr["NAMAAGEN"];
	$kdstatusfile = $arr["KDSTATUSFILE"];
	
	echo "<b>UPDATE PERTANGGUNGAN NOMOR : ".$prefix."-".$nopertanggungan." ".$namattg."</b>";
	echo "<hr size=1>";
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
   <input type="hidden" value="<? echo $prefix; ?>" name="prefix">
	 <input type="hidden" value="<? echo $nopertanggungan; ?>" name="nopertanggungan">
	 <input type="hidden" value="<? echo $namattg; ?>" name="namattg">
   <input type="submit" value="UPDATE" name="update">
</p>
</form>
<hr size="1">
<a class="verdana10blk" href="updatekonversisatuan.php">BACK</a>
<?
} else if ($update){
  $sql = "update $DBUser.tabel_200_pertanggungan set ".
	       "nopenagih='$nopenagihbaru',".
				 "noagen='$noagenbaru',".
				 "kdproduk='$kdprodukbaru',".
				 "kdstatusfile='$kdstatusfile', ".
				 "tglupdated=sysdate,userupdated='$userid' ".
	       "where ".
				 "nopertanggungan='$nopertanggungan'";
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
  $DB->commit();
  echo "<b>UPDATE PERTANGGUNGAN NOMOR : ".$prefix."-".$nopertanggungan." ".$namattg."</b>";
	echo "<hr size=1>";
	echo "<br><br>Update sukses..<br><br> ";
	echo "<hr size=1>";
	echo "<a class=verdana10blk href=\"updatekonversisatuan.php\">Update Polis Lain</a>";
	echo "&nbsp;&nbsp;&nbsp;<a class=\"verdana10blk\" href=\"portopoliokantor?lihat=$lihat&start=1&end=200&page=1\">Halaman Data Konversi</a>";
} else {

?>

<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<script LANGUAGE="JavaScript">

function submitForms() {
	if (isKlien())
	if (confirm) { 
		return true;
	} else {
		return false;      
	} else
	return false;
}
function isKlien() {
	var str=document.clntmtc.nopertanggungan.value;
	if (str=="") {
		alert("Isi Nomor Pertanggungan !!")
		document.clntmtc.nopertanggungan.focus();
		return false;
	}
	return true;
}
function CariNama() {
  var prefix=document.clntmtc.prefix.value;
	var nopert=document.clntmtc.nopert.value;
	var jeniscari=document.clntmtc.pencarian.value;
	if (!nopert=='') {
		window.open('carinomorbaru.php?prefix='+prefix+'&nopert='+nopert+'&jnscari='+jeniscari+'','caripage','width=400,height=300,top=100,left=100,scrollbars=yes')
	}
}

function GantiCari(theForm) {
var jeniscari=theForm.jnscari.value;
window.location.replace('updatekonversisatuan.php?jnscari='+jeniscari+'');
}

</script>
<font face="Verdana" size="2"><b>PENCARIAN NOMOR POLIS KANTOR <? echo $kantor; ?></font></b>
<hr size=1>
<? 
if(!$jnscari){
 $jnscari="OTON";
}
 ?>
		<div align="center">
		<table border="0" width="450">
		<form name="clntmtc" method="POST" action="<? $PHP_SELF; ?>" onSubmit="return submitForms()">
			<tr bgcolor="#d3f0c6">
  			<td colspan="2"  align="right">Pilih Jenis Pencarian&nbsp;&nbsp;
				 <select name="jnscari" class="c" onfocus="highlight(event)" onchange="GantiCari(document.clntmtc)"  style="font-family: Verdana; font-size: 10px">
				<?

		    $xx = ($jnscari=="OTON")? "selected" : "";
		    $yy = ($jnscari=="NTOO")? "selected" : "";
				  echo "<option value=\"OTON\" $xx>NOMOR POLIS LAMA KONVERSI KE NOMOR BARU</option>";
					echo "<option value=\"NTOO\" $yy>NOMOR POLIS BARU KONVERSI KE NOMOR LAMA</option>";
						
				?>
				</select></td>
			</tr>
			<tr>
			  <td colspan="2" align="center"></td>
			</tr>
			<? 
			if ($jnscari=="OTON"){
			 ?>
			<tr>
				<td><font face="Arial" size="2">Masukkan Nomor Pertanggungan Lama</font></td>
				<td>: 
					<input type="text" name="nopert" size="16" maxlength="15" onfocus="highlight(event)" onblur="CariNama();">
			 </td>
			</tr>
			<tr>
				<td><font face="Arial" size="2">Nomor Pertanggungan Baru</font></td>
				<td>: 
				<input type="text" name="prefix" size="3" maxlength="2" readonly>
				<input type="text" name="nopertanggungan" size="9" maxlength="9" readonly></td>
			</tr>
		  
			<? } else { ?>
			
			<tr>
				<td><font face="Arial" size="2">Masukkan Nomor Pertanggungan Baru</font> <font color="red">*</font></td>
				<td>: 
				<input type="text" name="prefix" size="3" maxlength="2">
				<input type="text" name="nopert" size="9" maxlength="9"  onblur="javascript:validasi(this.form.nopert);CariNama();"></td>
			</tr>
			<tr>
				<td><font face="Arial" size="2">Nomor Pertanggungan Lama</font></td>
				<td>: 
					<input type="text" name="nopertanggungan" size="16" maxlength="15" onfocus="highlight(event)"  readonly>
			 </td>
			</tr>
			<? 
			$note = "<hr size=\"1\"><font color=red>*</font> Prefix pertanggungan harus diisi";
			} ?>
			<tr>
			  <td colspan="2"><? echo $note; ?></td>
			</tr>
			<tr bgcolor="#cee0ff">
			  <td colspan="2" align="center">
					<input type="hidden" value="<? echo $jnscari ?>" name="pencarian">
					<input type="submit" value="UPDATE POLIS" name="Submit" class="button1">
					<? 
					//printf("<input type=\"button\" name=\"caripolis\" value=\"LIHAT KETENTUAN POLIS\" onclick=\"javascript:window.open('ketentuanpolis.php?prefix=%s&nopertanggungan=%s&jnscari=%s','poppolis','width=800,height=400,top=50,left=50,scrollbars=yes');\">",$prefix,$prefixpertanggungan,$jnscari);
					 ?>
				</td>
			</tr> 
			</form>
		</table>
		</div>
<hr size="1">
<a href="../pelaporan/index.php">Menu Manajemen Informasi</a>
&nbsp;&nbsp;&nbsp;<a class="verdana10blk" href="portopoliokantor?lihat=$lihat&start=1&end=200&page=1">Halaman Data Konversi</a>
<? 
}
?>