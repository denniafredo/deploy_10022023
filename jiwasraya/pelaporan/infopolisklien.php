<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/monthselector.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	
	$DB=new database($userid, $passwd, $DBName);	

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS KLIEN</B></font><br>";
  echo "<hr size=1>";
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js" ></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>	
	<script language="JavaScript" type="text/javascript">
  <!--
 	
	function CariNama() {
	var noklien=document.clntmtc.noklien.value;
	if (!noklien=='') {
		window.open('../klien/carinama.php?namahalaman=clntmtc&noklien='+noklien+'','caripage','width=400,height=300,top=100,left=100,scrollbars=yes')
	}
}
</script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
	<table border="0" cellspacing="5">
	<form method="POST" name="clntmtc" action="<? $PHP_SELF; ?>">
        <tr>
          <td><font face="Verdana" size="2">Masukkan Nomor Klien</font></td>
          <td>: 
					  <input type="text" name="noklien" size="12" maxlength="10" onblur="javascript:validasi10(this.form.noklien);CariNama();" class="c" onfocus="highlight(event)" value="<?echo $noklien;?>">
						<a href="#" onclick="NewWindow('../klien/popupclntmtc.php','popuppage','420','300','yes')">
						<img src="../img/jswindow.gif" border="0" alt="cari daftar agen"></a>		
					</td>
				</tr>
				<tr>
          <td><font face="Arial" size="2">Nama</font></td>
				  <td>: <input type="text" name="namaklien1" size="35" maxlength="30" readonly class="c"></td>
				</tr>
				<tr>
          <td><font face="Arial" size="2">Klien sebagai</font></td>
				  <td>: 
					<? 
					switch($jenisklien)
					{
					  case 'ttg' : $o1="selected"; $sebagai = "Tertanggung"; break;
						case 'pmp' : $o2="selected"; $sebagai = "Pemegang Polis"; break;
						case 'pnb' : $o3="selected"; $sebagai = "Penerima Benefit"; break;
					}
					?>
					<select name="jenisklien">
					  <option value="ttg" <?=$o1;?>>Tertanggung</option>
						<option value="pmp" <?=$o2;?>>Pemegang Polis</option>
						<option value="pnb" <?=$o3;?>>Penerima Benefit</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="cari" value="LANJUT"></td>
				</tr>
	</form>			
  </table>
	<?
	if(!$noklien){
	} else {
		$qry= "select noklien,namaklien1,decode(jeniskelamin,'L','LAKI','PEREMPUAN') jeniskelamin,".
		     "tempatlahir,to_char(tgllahir,'DD/MM/YYYY') tgllahir,kdid,noid,pendapatan,gelar,".
	       "decode(kdagama,'1','ISLAM','2','PROTESTAN','3','KATHOLIK','4','HINDU','5','BUDHA','6','KONGHUTJU','LAIN-LAIN') agama,".
				 "decode(meritalstatus,'L','LAJANG','K','KAWIN','J','JANDA','DUDA') statuskawin,".
				 "kdpekerjaan,kdhobby,tinggibadan,beratbadan,alamattetap01,phonetetap01,kodepostetap,".
				 "kdkotamadyatetap,kdpropinsitetap ".
				 "from $DBUser.tabel_100_klien ".
				 "where noklien='$noklien'";
				 $DB->parse($qry);
				 $DB->execute();
				 $ars=$DB->nextrow();
				 $namaklien=$ars["NAMAKLIEN1"];	
				 $pangkatpenagih=$ars["NAMAPANGKATPENAGIH"];
	echo "<hr size=1>";
  ?>
	<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="700">
  <tr>
    <td class=verdana9blk>Nomor Klien</td>
    <td class=verdana9blk>: <? echo $ars["NOKLIEN"]; ?></td>
    <td class=verdana9blk>Agama</td>
    <td class=verdana9blk>: <? echo $ars["AGAMA"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Nama </td>
    <td class=verdana9blk>: <? echo $ars["NAMAKLIEN1"]; ?></td>
    <td class=verdana9blk>Status Marital</td>
    <td class=verdana9blk>: <? echo $ars["STATUSKAWIN"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Jenis Kelamin</td>
    <td class=verdana9blk>: <? echo $ars["JENISKELAMIN"]; ?></td>
    <td class=verdana9blk>Alamat</td>
    <td class=verdana9blk>: <? echo $ars["ALAMATTETAP01"]." ".$ars["ALAMATTETAP02"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Tempat/Tgl. Lahir</td>
    <td class=verdana9blk>: <? echo $ars["TEMPATLAHIR"]." / ".$ars["TGLLAHIR"]; ?></td>
    <td class=verdana9blk>Klien Sebagai</td>
    <td class=verdana9blk>: <?=$sebagai;?></td>
  </tr>
</table>

	<?
	echo "<hr size=1>";
	echo "<div align=center>";
	if($jenisklien=="ttg")
	{
				 $sql  = "select ".
				 			 	 		"a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       		"a.kdstatusmedical,".
					       		"to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,a.userupdated, ".
								 		"a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from  ".
								 	  "$DBUser.tabel_200_pertanggungan a ".
			           "where ".
    			   				"a.notertanggung='$noklien' ".
      							"and a.kdpertanggungan='2' ".
    								//"and a.notertanggung is not null ".
								 "order by a.prefixpertanggungan,a.nopertanggungan desc";
  } 
	elseif($jenisklien=="pmp")
	{
	       $sql  = "select ".
				 			 	 		"a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       		"a.kdstatusmedical,".
					       		"to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,a.userupdated, ".
								 		"a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from  ".
								 	  "$DBUser.tabel_200_pertanggungan a ".
			           "where ".
    			   				"a.nopemegangpolis='$noklien' ".
      							"and a.kdpertanggungan='2' ".
    								//"and a.nopemegangpolis is not null ".
								 "order by a.prefixpertanggungan,a.nopertanggungan desc";
	
	}
	elseif($jenisklien=="pnb")
	{
	      $sql  = "select ".
                   "a.prefixpertanggungan,a.nopertanggungan,".
                   "b.kdproduk,b.kdstatusmedical,".
                   "b.premi1,b.juamainproduk,".
                   "to_char(b.mulas,'DD/MM/YYYY') mulas ".
                "from ".
                	 "$DBUser.tabel_219_pemegang_polis_baw a,".
                	 "$DBUser.tabel_200_pertanggungan b ".
                "where ".
                  "a.prefixpertanggungan=b.prefixpertanggungan ".
                  "and a.nopertanggungan=b.nopertanggungan ".
                  "and a.noklien='$noklien' ".
                  "and b.kdpertanggungan='2'";
	}
	//echo $sql;
					$DB->parse($sql);
					$DB->execute();

					 echo "<table>";
					    echo("<tr class=\"hijao\">");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Pemegang Polis</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Stt.Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 1</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 2</font></b></td>");
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
							
							include "../../includes/belang.php";	 
							$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namapemegangpolis."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namaproduk."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$PER->expirasi."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namacarabayar."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namavaluta."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->jua,2)."</font></td>");
		      		echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi1,2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi2,2)."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namastatusfile."</font></td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
			}
			
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>