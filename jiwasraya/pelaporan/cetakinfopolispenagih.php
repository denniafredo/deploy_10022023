<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	
	
	$DB=new Database($userid, $passwd, $DBName);	

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS PENAGIH</B></font><br>";
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<title>Cetak Info Polis Per Penagih</title>
	<body onload="window.print();window.close()">
  <?
	$qry = "select a.prefixpenagih,a.nopenagih,".
	       "decode(a.kdstatuspenagih,'01','TARGET TERCAPAI','02','TARGET TIDAK TERCAPAI','03','AKTIF','NON AKTIF') statuspenagih,".
	       "b.namaklien1,c.namapangkatpenagih,d.namakelaspenagih,e.namajenjangpenagih,".
				 "f.namajabatanpenagih,g.namarayonpenagih ".
				 "from $DBUser.tabel_500_penagih a,$DBUser.tabel_100_klien b,$DBUser.tabel_505_kode_pangkat_penagih c,".
				 "$DBUser.tabel_506_kode_kelas_penagih d,$DBUser.tabel_507_kode_jenjang_penagih e,".
				 "$DBUser.tabel_512_jabatan_penagih f,$DBUser.tabel_502_rayon_penagih g ".
				 "where ".
				 "a.nopenagih=b.noklien and a.kdpangkatpenagih=c.kdpangkatpenagih and ".
				 "a.kdkelaspenagih=d.kdkelaspenagih and a.kdjenjangpenagih=e.kdjenjangpenagih and ".
				 "a.kdjabatanpenagih=f.kdjabatanpenagih(+) and a.kdrayonpenagih=g.kdrayonpenagih and ".
				 "a.nopenagih='$nopenagih' and a.kdrayonpenagih='$kantor'";

				 $DB->parse($qry);
				 $DB->execute();
				 $ars=$DB->nextrow();
				 $namapenagih=$ars["NAMAKLIEN1"];	
				 $pangkatpenagih=$ars["NAMAPANGKATPENAGIH"];
  if(!$namapenagih){
	 echo "<hr size=1>";
	 echo "<font color=red>Penagih nomor $nopenagih bukan penagih kantor $kantor";
	} else {
	echo "<hr size=1>";
  ?>
	<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="700">
  <tr>
    <td class="sans8">Nomor Penagih</td>
    <td class="sans8">: <? echo $ars["NOPENAGIH"]; ?></td>
    <td class="sans8">Jenjang</td>
    <td class="sans8">: <? echo $ars["NAMAJENJANGPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class="sans8">Nama </td>
    <td class="sans8">: <? echo $ars["NAMAKLIEN1"]; ?></td>
    <td class="sans8">Jabatan</td>
    <td class="sans8">: <? echo $ars["NAMAJABATANPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class="sans8">Pangkat</td>
    <td class="sans8">: <? echo $ars["NAMAPANGKATPENAGIH"]; ?></td>
    <td class="sans8">Rayon Penagih</td>
    <td class="sans8">: <? echo $ars["NAMARAYONPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class="sans8">Kelas</td>
    <td class="sans8">: <? echo $ars["NAMAKELASPENAGIH"]; ?></td>
    <td class="sans8">Status</td>
    <td class="sans8">: <? echo $ars["STATUSPENAGIH"]; ?></td>
  </tr>
</table>

	<?
	echo "<hr size=1>";
  if($vbln==""){
	  $thisperiode="$vthn";
		$periode="to_char(a.mulas,'yyyy')='$thisperiode'";
  }else{
		$bln = substr(("0".$vbln),-2);
	  $thisperiode="$bln$vthn";
		$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
  }
	echo "<div align=center>";
	
				  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       "a.kdstatusmedical,".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi,".
					       "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,b.namaklien1,b.gelar,a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b ".
			           "where a.notertanggung=b.noklien(+) ".
			           "and a.nopenagih='$nopenagih' and a.kdpertanggungan='2' ".
								 "and notertanggung is not null and $periode ".
								 "order by a.nopertanggungan desc";
					$DB->parse($sql);
					$DB->execute();
					  switch ($bln)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
					 echo "<a class=verdana10blk><b>Daftar Polis Periode $bln $vthn</b></a><br><br>";
					 					 echo "<table>";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td class=sans8 align=center><b>No</b></td>");
							echo("<td class=sans8 align=center><b>No.Pert.</b></td>");
							echo("<td class=sans8 align=center><b>Tertanggung</b></td>");
					    echo("<td class=sans8 align=center><b>Produk</b></td>");
							echo("<td class=sans8 align=center><b>Mulai</b></td>");
							echo("<td class=sans8 align=center><b>Expirasi</b></td>");
							echo("<td class=sans8 align=center><b>Stt.Med</b></td>");
							echo("<td class=sans8 align=center><b>Cara Bayar</b></td>");
							echo("<td class=sans8 align=center><b>Val</b></td>");
							echo("<td class=sans8 align=center><b>J U A</b></td>");
							echo("<td class=sans8 align=center><b>Premi 1</b></td>");
							echo("<td class=sans8 align=center><b>Premi 2</b></td>");
							echo("<td class=sans8 align=center><b>Status</b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($sendemail)
							{
							 case "": $sendemail="BELUM"; break;
							 default : $sendemail; break; 
							}
							
							echo "<tr>"; 
							$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
              echo("<td class=sans8>".$i."</td>");
						  echo("<td class=sans8 align=center>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>");
		          echo("<td class=sans8>".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</td>");
					 		echo("<td class=sans8>".$arr["KDPRODUK"]."</td>");
							echo("<td class=sans8 align=center>".$arr["MULAS"]."</td>");
							echo("<td class=sans8 align=center>".$PER->expirasi."</td>");
							echo("<td class=sans8 align=center>".$arr["KDSTATUSMEDICAL"]."</td>");
		          echo("<td class=sans8>".$PER->namacarabayar."</td>");
		          echo("<td class=sans8>".$arr["NOTASI"]."</td>");      
							echo("<td class=sans8 align=right>".number_format($PER->jua,2)."</td>");
		      		echo("<td class=sans8 align=right>".number_format($PER->premi1,2)."</td>");
							echo("<td class=sans8 align=right>".number_format($PER->premi2,2)."</td>");
							echo("<td class=sans8>".$PER->namastatusfile."</td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
				}
					 echo "</div>";
					 echo "<hr size=1>";
					 ?>
	 </body>