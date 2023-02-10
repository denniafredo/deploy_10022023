<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	
	$DB=new Database($userid, $passwd, $DBName);	

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS BERDASARKAN NAMA KLIEN YANG MIRIP</B></font><br>";
  echo "<hr size=1>";
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js" ></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

<script LANGUAGE="JavaScript">
function submitForms() {
var minLength = 3; 
 if (document.clntmtc.nama.value.length < minLength) {
        alert('Nama minimal ' + minLength + ' karakter. Coba lagi!');
        return false;
 }
 else {
        return true;
 }
}
</script>

<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
	<table border="0" cellspacing="5">
	<form method="POST" name="clntmtc" action="<? $PHP_SELF; ?>"  onSubmit="return submitForms();">
        <tr>
          <td><font face="Arial" size="2">Metode Pencarian</font></td>
				  <td>
					<? 
					if($metodecari=="ttg")
					{
					  $a="selected";
					} 
					elseif($metodecari=="pmp")
					{
					  $b="selected";
					}			
					?>
					<select name="metodecari" size="1">
					  <option value="ttg" <?=$a;?>>TERTANGGUNG</option>
						<option value="pmp" <?=$b;?>>PEMEGANG POLIS</option>
					</select>					</td>
					<td></td>
				</tr>
        <tr>
          <td><font face="Arial" size="2">Masukkan Nama</font></td>
				  <td><input type="text" name="nama" size="35" maxlength="20" onfocus="highlight(event)" class="c" value="<?echo strtoupper($nama);?>"></td>
					<td>&nbsp;</td>
				</tr>
        <tr>
          <td><font face="Arial" size="2">Masukkan Tgl Lahir</font></td>
          <td><input type="text" name="tgllhr" size="35" maxlength="10" onfocus="highlight(event)" class="c" value="<?echo strtoupper($tgllhr);?>" />dd/mm/yyyy</td>
          <td><input type="submit" name="cari" value="LANJUT" /></td>
        </tr>
	</form>			
  </table>
	<?
	echo "<div align=center>";
	if ($cari){
	        $nama = strtoupper($nama);
					$nama = strip_tags(stripslashes($nama));
	        $nama = ereg_replace("'","''",$nama);
				  
					if($metodecari=="ttg"){
					   $headercol="Tertanggung";
					   $getnama="and a.notertanggung=b.noklien ";
					   $headercol2="Pemegang Polis";
					} else {
					   $headercol="Pemegang Polis";
					   $getnama="and a.nopemegangpolis=b.noklien ";
					   $headercol2="Tertanggung";
					}
					
					if($tgllhr==""){       // Tambahan oleh Dedi Z 19/07/2011 
						$xxx=" ";
						}else{
						$xxx="and to_char(b.tgllahir,'dd/mm/yyyy')='$tgllhr'";
						}
/*
						$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,a.nopol,".
					       "a.kdstatusmedical,to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,".
								 "replace(b.namaklien1,'$nama','<font color=red>".$nama."</font>') namaklien1,".
								 "to_char(b.tgllahir,'DD/MM/YYYY') tgllahir,".
								 "a.userupdated, d.namacarabayar,c.kdrayonpenagih, ".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') valuta,".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
								 "to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas,e.namastatusfile ".
	               "from ".
								 "$DBUser.tabel_100_klien b,".
								 "$DBUser.tabel_200_pertanggungan a, ".
								 "$DBUser.tabel_500_penagih c, ".
								 "$DBUser.tabel_305_cara_bayar d, ".
								 "$DBUser.tabel_299_status_file e ".
			           "where ".
								 "b.namaklien1 like '$nama%' ".
								 "".$getnama." ".
								 //"and a.notertanggung=b.noklien ".
								 //"and a.nopemegangpolis=b.noklien ".
								 "and a.nopenagih=c.nopenagih ".
			           "and a.kdpertanggungan='2' ".
								 "and d.kdcarabayar=a.kdcarabayar ".
								 "and e.kdstatusfile=a.kdstatusfile ".
								 "and notertanggung is not null ".
								 //"and c.kdrayonpenagih='$kantor' ".
								 //"and a.notertanggung in (select noklien from $DBUser.tabel_100_klien ".
								 //"where namaklien1 like '$nama%') ".
								 "order by a.prefixpertanggungan,a.nopertanggungan";
					*/	
					
					//====================== wita phone 25/02/2015
					if ($kantor=="KP") {
					$status="";} else {
					$status=" and kdstatusfile in ('1','4') ";
					}
					//======================		 
						$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,a.nopol,".
					       "a.kdstatusmedical,to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,".
								 "replace(b.namaklien1,'$nama','<font color=red>".$nama."</font>') namaklien1,".
								 "c.namaklien1 namatertanggung,d.namaklien1 namapemegangpolis,".
								 "to_char(b.tgllahir,'DD/MM/YYYY') tgllahir,".
								 "a.userupdated, (SELECT namacarabayar FROM $DBUser.tabel_305_cara_bayar WHERE kdcarabayar=a.kdcarabayar) namacarabayar, (SELECT kdrayonpenagih FROM $DBUser.tabel_500_penagih WHERE nopenagih=a.nopenagih) kdrayonpenagih, ".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') valuta,".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
								 "to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
								 "(SELECT TO_CHAR (MAX(tglbooked), 'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan AND tglseatled IS NOT NULL) maxtglbooked,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas, (SELECT namastatusfile FROM $DBUser.tabel_299_status_file WHERE kdstatusfile=a.kdstatusfile) namastatusfile, ".
								 "(SELECT nilaibenefit FROM $DBUser.tabel_223_transaksi_produk WHERE prefixpertanggungan=a.prefixpertanggungan AND nopertanggungan=a.nopertanggungan and kdbenefit='CI') UACI, ".
								 "(SELECT nilaibenefit FROM $DBUser.tabel_223_transaksi_produk WHERE prefixpertanggungan=a.prefixpertanggungan AND nopertanggungan=a.nopertanggungan and kdbenefit='TERM') UATERM ".
	               "from ".
								 "$DBUser.tabel_100_klien b,".
								 "$DBUser.tabel_200_pertanggungan a ".
								 "INNER JOIN $DBUser.tabel_100_klien c ON a.notertanggung = c.noklien ".
								 "INNER JOIN $DBUser.tabel_100_klien d ON a.nopemegangpolis = d.noklien ".
			           "where ".
								 "b.namaklien1 like '%$nama%' ".
								 "".$getnama." ".$status.
								 //"and a.notertanggung=b.noklien ".
								 //"and a.nopemegangpolis=b.noklien ".
			           "and a.kdpertanggungan='2' $xxx".
								 //"and to_char(b.tgllahir,'dd/mm/yyyy')='$tgllhr'".
								 //"and notertanggung is not null ".
								 //"and c.kdrayonpenagih='$kantor' ".
								 //"and a.notertanggung in (select noklien from $DBUser.tabel_100_klien ".
								 //"where namaklien1 like '$nama%') ".
								 "order by a.prefixpertanggungan,a.nopertanggungan";

				//	echo $sql;
					//DIE;
          $DB->parse($sql);
					$DB->execute();
	         echo "<hr size=1>";
					 echo "<table>";
					    echo("<tr class=\"hijao\">");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Polis Lama</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>$headercol</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl. Lahir $headercol</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>$headercol2</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tagihan Terlunasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Stt.Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A CI</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A TERM</b></font></td>");
   						echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Rayon</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($sendemail)
							{
							 case "": $sendemail="<font color=red>BELUM</font>"; break;
							 default : $sendemail; break; 
							}
							$nama=$arr["NAMAKLIEN1"];
		          $nama=str_replace("'","`",$nama);
							
							include "../../includes/belang.php";	 
							echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["NOPOL"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$nama."</font></td>");
					 		echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLLAHIR"]."</font></td>");
							echo("<td align=left><font face=\"Verdana\" size=\"1\">".($metodecari=="ttg"?$arr["NAMAPEMEGANGPOLIS"]:$arr["NAMATERTANGGUNG"])."</font></td>");
					 		echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MAXTGLBOOKED"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          			echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");
		          			echo("<td><font face=\"Verdana\" size=\"1\">".$arr["VALUTA"]."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["UACI"],2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["UATERM"],2)."</font></td>");
              				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDRAYONPENAGIH"]."</font></td>");
  							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMASTATUSFILE"]."</font></td>");
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
			  } else {	 
			  }
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
