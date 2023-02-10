<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	
	$DB=New Database($userid, $passwd, $DBName);
	?> 
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<?
  echo "<B><font face=Verdana size=2>DAFTAR AGEN KANTOR $kantor</font></B>";

         $sql= "select a.prefixagen,a.noagen,a.kdjenjangagen,a.kdpangkat,a.kdkelasagen,b.namaklien1,b.gelar from ".
						   "$DBUser.tabel_400_agen a,$DBUser.tabel_100_klien b where a.noagen=b.noklien ".
							 "and a.prefixagen='$kantor' order by b.namaklien1";
				 $DB->parse($sql);
				 $DB->execute();

	echo "<hr size=1>";
					 echo "<table>";
					 echo "<tr bgcolor=#97b3b9>";
					 echo "<td class=verdana8blk align=center>NO.</td>";
					 echo "<td class=verdana8blk align=center>NO. AGEN</td>";
					 echo "<td class=verdana8blk align=center>NAMA</td>";
					 echo "<td class=verdana8blk align=center>POLIS JATUH TEMPO</td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomoragen=$arr["NOAGEN"];
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]." ".$arr["GELAR"]."</td>";
					 echo "<td class=verdana8blk  align=center>";
					 for ($x=0; $x<count($nomoragen); $x++) {
			     $DD=New Database($userid, $passwd, $DBName);
					 $sql1 = "select count(*) res ".
						"from ".
 						  "$DBUser.tabel_223_transaksi_produk a,".
						  "$DBUser.tabel_200_pertanggungan b,".
						  "$DBUser.tabel_500_penagih c,".
						  "$DBUser.tabel_207_kode_benefit d ".
						  "where ".
						  "a.kdbenefit=d.kdbenefit and a.nopertanggungan=b.nopertanggungan ".
						  "and a.kdproduk=b.kdproduk and b.nopenagih=c.nopenagih ".
							"and b.noagen='$nomoragen' ".
						  "and  months_between(a.expirasi,sysdate)<=1 and d.kdkelompokbenefit!='D' ".
						  "and (a.status is null or a.status != '9') ".
						  "and b.kdstatusfile in ('1','4') ".
						  "order by a.prefixpertanggungan,a.nopertanggungan,a.expirasi";
							$DD->parse($sql1);
			 	      $DD->execute();
			 	      $res=$DD->nextrow();		
							$jml1 = $res["RES"];
							
							$sql2 = "select count(distinct round(a.nilaibenefit)) liune ".
              "from $DBUser.tabel_242_benefit_anuitas a,".
				      "$DBUser.tabel_200_pertanggungan b,$DBUser.tabel_500_penagih c,$DBUser.tabel_207_kode_benefit d where ".
				      "a.nopertanggungan=b.nopertanggungan and a.kdbenefit=d.kdbenefit and ".
				      "b.nopenagih=c.nopenagih and b.noagen='$nomoragen' ".
              "and months_between(a.tgljatuhtempo,sysdate)<=1 ".
				      "and status<>'1'";
	            $DD->parse($sql2);
            	$DD->execute();
		   	      $ref=$DD->nextrow();
							$jml2 = $ref["LIUNE"];
              //echo $sql2."<br>";
							$jml=$jml1 + $jml2;
						  $jmlpolis = ($jml==0) ? '-' : $jml;
							echo "<a href=infojatuhtempoklaimagen.php?noagen=$nomoragen><b>$jmlpolis</b></a>";
					 
					 }
					 
					 echo "</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
	echo "<hr size=1>";
?>