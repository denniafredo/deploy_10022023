<?
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/common.php";
	include "../../includes/pertanggungan.php";	
	include "../../includes/klien.php";	
#--------------------------------------------------------------------------------------------
?>
<title>Kondite Polis</title>
<?
echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<a class=verdana10blk><b>INFORMASI KONDITE POLIS $jnspolis NO.PENAGIH $nopenagih TAHUN $vthn</b></a>";
	if($jnspolis=="OB"){
	  $mat=">=";
	} else {
	  $mat="<";
	}

	if($vthn=="ALL"){
		$periode="";
  }else{
		$periode="and to_char(d.mulas,'YYYY')='$vthn'";
  }
	
	$DB=new Database($userid, $passwd, $DBName);
		 $sql = "select c.prefixpertanggungan,".
		                "c.nopertanggungan,".
										"c.kdkuitansi,".
										"d.nopenagih,".
										"d.mulas,".
										"f.kdrayonpenagih ".
						"from $DBUser.tabel_300_historis_premi c,".
						        "$DBUser.tabel_200_pertanggungan d,".
										"$DBUser.tabel_500_penagih f ".
						"where c.prefixpertanggungan=d.prefixpertanggungan ".
						        "and c.nopertanggungan=d.nopertanggungan ".
										"and d.nopenagih=f.nopenagih ".
										"and f.kdrayonpenagih='$kantor' ".
										"$periode ".
										"and MONTHS_BETWEEN(c.tglbooked,d.mulas) $mat 12 ".
										"and c.tglbooked=(SELECT MAX(tglbooked) ".
										     "FROM $DBUser.tabel_300_historis_premi g ".
												 "WHERE g.prefixpertanggungan=d.prefixpertanggungan ".
												 "AND g.nopertanggungan=d.nopertanggungan ".
												 "AND g.kdkuitansi <> 'BP3') ".
						        "and d.nopenagih='$nopenagih' ".
						        "order by d.mulas";
						//echo $sql;						 
	   $DB->parse($sql);
	   $DB->execute();

		 echo "<hr size=1>";
		 echo "<div align=\"center\">";
		 $i = 0;			  
		 echo "<table>";
		 echo "<tr bgcolor=#97b3b9>";
		 echo "<td class=verdana8blk><b>No.</b></td>";
		 echo "<td class=verdana8blk><b>Pertanggungan</b></td>";
		 echo "<td class=verdana8blk><b>Nama Tertanggung</b></td>";
     echo "<td class=verdana8blk align=center><b>Tgl. Mulas</b></td>";
		 echo "<td class=verdana8blk><b>Expirasi</b></td>";
		 echo "<td class=verdana8blk><b>Stt.Med</font></b></td>";
		 echo "<td class=verdana8blk><b>Cara Bayar</b></td>";
		 echo "<td class=verdana8blk><b>Valuta</b></td>";
		 echo "<td class=verdana8blk><b>Bayar Terakhir</b></td>";
		 echo "<td class=verdana8blk><b>J U A</b></td>";
		 echo "<td class=verdana8blk><b>Premi 1</b></td>";
		 echo "<td class=verdana8blk><b>Premi 2</b></td>";
		 echo "<td class=verdana8blk><b>Status</b></td>";	 
		 echo "</tr>";

		 while($arr=$DB->nextrow()) {
		 $PER = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	   $i = 0;
		 $i = $count + 1;
		 $prefix = $arr["PREFIXPERTANGGUNGAN"];
		 $nopert = $arr["NOPERTANGGUNGAN"];
		 $namatertanggung = $arr["NAMAKLIEN"];
	
		 include ("../../includes/belang.php");

		 echo "<td class=verdana8blk>".$i."</td>";
		 echo "<td class=verdana8blk><a href=\"#\" onclick=\"window.open('../akunting/kartupremi1.php?prefix=$prefix&noper=$nopert','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$prefix."-".$nopert."</a></td>";
	   echo "<td class=verdana8blk>".$PER->namatertanggung."</td>";
		 echo "<td class=verdana8blk align=center>".$PER->mulas."</td>";
		 echo "<td class=verdana8blk align=center>".$PER->expirasi."</td>";
		 echo "<td class=verdana8blk align=center>".$PER->medstat."</td>";
		 echo "<td class=verdana8blk>".$PER->namacarabayar."</td>";
		 echo "<td class=verdana8blk>".$PER->namavaluta."</td>";   
		 echo "<td class=verdana8blk>".$PER->tgllastpayment."</td>";   
		 echo "<td class=verdana8blk align=right>".number_format($PER->jua,2)."</td>";
		 echo "<td class=verdana8blk align=right>".number_format($PER->premi1,2)."</td>";
		 echo "<td class=verdana8blk align=right>".number_format($PER->premi2,2)."</td>";
		 echo "<td class=verdana8blk>".$PER->namastatusfile."</td>";	 
		 echo "</tr>";
		 $count++;
		 }
 
echo "</table>";		 
echo "<br><a class=verdana10blk>Klik Nomor Pertanggungan untuk melihat pelunasan premi</a><br>";
echo "</div>";		 
echo "<hr size=1>";
?>
<a class=verdana10blk href="javascript:window.close();">CLOSE</a>
