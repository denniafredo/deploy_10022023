<?
/*
  include "../../includes/database.php";	
  	include "../../includes/common.php";
		include "../../includes/fungsi.php";
  //include "../../includes/session.php";
	//include "../../includes/klien.php";
	//include "../../includes/pertanggungan.php";
	//include "../../includes/oradb.class.php";
*/


	include "../../includes/session.php"; 
  	include "../../includes/starttimer.php"; 
  	include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

	



	$DB=new Database($userid, $passwd, $DBName);	
//	$DB=new database($userid, $passwd, $DBName);


	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS BERDASARKAN NAMA KLIEN YANG MIRIP</B></font><br>";
  echo "<hr size=1>";
?>

	
  <html>
  <head>
  <title><?echo "DAFTAR POLIS BERDASARKAN NAMA KLIEN YANG MIRIP";?></title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
  </head>
	<body>
	<div align="center">
<?



						$sql1 = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,a.nopol,".
					       "a.kdstatusmedical,to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,".
								 "b.namaklien1,".
								 "to_char(b.tgllahir,'DD/MM/YYYY') tgllahir,".
								 "a.userupdated, (SELECT namacarabayar FROM $DBUser.tabel_305_cara_bayar WHERE kdcarabayar=a.kdcarabayar) namacarabayar, (SELECT kdrayonpenagih FROM $DBUser.tabel_500_penagih WHERE nopenagih=a.nopenagih) kdrayonpenagih, ".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') valuta,".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
								 "to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas, (SELECT namastatusfile FROM $DBUser.tabel_299_status_file WHERE kdstatusfile=a.kdstatusfile) namastatusfile, ".
								 "(SELECT nilaibenefit FROM $DBUser.tabel_223_transaksi_produk WHERE prefixpertanggungan=a.prefixpertanggungan AND nopertanggungan=a.nopertanggungan and kdbenefit='CI') UACI, ".
								 "(SELECT nilaibenefit FROM $DBUser.tabel_223_transaksi_produk WHERE prefixpertanggungan=a.prefixpertanggungan AND nopertanggungan=a.nopertanggungan and kdbenefit='TERM') UATERM ".
	               "from ".
								 "$DBUser.tabel_100_klien b,".
								 "$DBUser.tabel_200_pertanggungan a, ".
								 "(select y.namaklien1, to_char(y.tgllahir,'YYYYMMDD') tgllahir from $DBUser.tabel_100_klien y, $DBUser.tabel_200_pertanggungan z ".
								 "where z.prefixpertanggungan='$prefix' and z.nopertanggungan='$noper' and y.noklien=z.notertanggung) x ".
			           "where ".
								 "b.namaklien1 like '%'||x.namaklien1||'%' ".
								 "and a.notertanggung=b.noklien and to_char(b.tgllahir,'YYYYMMDD')=x.tgllahir ".
			           "and a.kdpertanggungan='2' ".
								 "order by a.prefixpertanggungan,a.nopertanggungan ";

					//var_dump($sql1);
					//echo $sql1;
					//DIE;
        
			 echo "<hr size=1>";
					 echo "<table>";
					    echo("<tr class=\"hijao\">");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Polis Lama</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b></b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl. Lahir </b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
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
							  $DB->parse($sql1);
					$DB->execute();
							while($arr1=$DB->nextrow()) 
							{
								echo "---<br>";
							}
						
/*
							while($arr=$DB->nextrow()) 
							{
								//echo "<br>-------12<br>";
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
					 		echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
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
		   */

?>


</div>

</body>
</html>
