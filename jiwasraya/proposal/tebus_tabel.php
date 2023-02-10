<?
  	include "../../includes/common.php";
  	include "../../includes/database.php";
 	include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$DBX=New database($userid, $passwd, $DBName);
	header("Content-type: application/vnd-ms-excel"); 
 	header("Content-Disposition: attachment; filename=daftar_nilai_tebus.xls");

?>
<table border="1" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
	<tr class="tblhead">
		<td align="center"><b>Nomor Polis</b></font></td>
		<td align="center"><b>Basis</b></font></td>
		<td align="center"><b>JUA</b></font></td>
		<td align="center"><b>Akhir Th Ke-</b></font></td>
		<td align="center"><b>Nilai Tebus</b></font></td>
	</tr>

<?
	$sql="SELECT * FROM $DBUser.TABEL_200_PERTANGGUNGAN 
		WHERE PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN IN ('QC001267463', 'QC001267510', 'QC001267534', 'QC001267666', 'QC001268154')";
	$DBX->parse($sql);
	$DBX->execute();
	while ($arr=$DBX->nextrow()) {
		$pref 	= $arr["PREFIXPERTANGGUNGAN"];
		$noper 	= $arr["NOPERTANGGUNGAN"];
		$jua 	= $arr["JUAMAINPRODUK"];

		$sql="select c.kdbasistebus,b.kdproduk,b.namaproduk, a.kdvaluta, a.premi1, ".
				 	 "nvl((
				 	 		select jualama from 
				 	 		$DBUser.POLIS_HISTORY_JUA 
				 	 		where prefixpertanggungan='$pref' 
				 	 			and nopertanggungan='$noper'
				 	 			and tglmutasi = (
				 	 				select max(tglmutasi)
				 	 				from $DBUser.polis_history_jua
				 	 				where prefixpertanggungan = '$pref'
				 	 					and nopertanggungan='$noper'
				 	 			)
				 	  ),juamainproduk) jua ".
			     "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_202_produk b,$DBUser.tabel_247_pertanggungan_basis c ".
					 "where a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan and ".
					 "a.kdproduk=b.kdproduk and ".
			     "a.prefixpertanggungan='$pref' and a.nopertanggungan='$noper'";
	  	
		//echo $nottemp; 
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		$res=$DB->nextrow();
		$namaproduk=$res["NAMAPRODUK"];
		$kdproduk=$res["KDPRODUK"];
		$basistebus=$res["KDBASISTEBUS"];
		$kdvaluta=$res["KDVALUTA"];
		$prm=$res["PREMI1"];
		$juaasli=$res["JUA"];
		$tabel="from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_247_pertanggungan_basis b ";
		//echo $kdproduk;
	    if(substr($kdproduk,0,4)=="JSAP"){
	      	$tabeltebus = "$DBUser.tabel_231_tarif_tebus_ms"; // khusus JSAP
		}
		else{
		  $tabeltebus = "$DBUser.tabel_231_tarif_tebus"; // khusus JSAP
		}
			
		if($kdproduk=="AJSPP") {
			$sql="select 2 x, t, tarif from ".$tabeltebus." where ".
			     "(kdproduk,masa,cara,usia,kdvaluta,kdbasis)=".
					 "(select a.kdproduk,a.lamapembpremi_th,decode(a.kdcarabayar,'E','E','J','J','X','X','K','X','M','M','Q','Q','H','H','A','A',/*'1','M',*/'B'),".
					 "a.usia_th,a.kdvaluta,b.kdbasistebus||'-2' ".
					 $tabel.
					 "where a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
					 "and a.prefixpertanggungan='$pref' and a.nopertanggungan='$noper') ".
					 "and kdtarif='TEBUS' ".
					 "order by x, t";
		}
		else {
			$sql="select t, tarif from ".$tabeltebus." where ".
			     "(kdproduk,masa,cara,usia,kdvaluta,kdbasis)=".
					 "(select a.kdproduk,a.lamapembpremi_th,decode(a.kdcarabayar,'E','E','J','J','X','X','K','X','M','M','Q','Q','H','H','A','A',/*'1','M',*/'B'),".
					 "a.usia_th,a.kdvaluta,b.kdbasistebus ".
					 $tabel.
					 "where a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
					 "and a.prefixpertanggungan='$pref' and a.nopertanggungan='$noper') ".
					 "and kdtarif='TEBUS' ".//add apakah benar ?
					 "order by t";
		}
		//echo $sql."</br>";
		$DB->parse($sql);
		$DB->execute();
		$i=0;
		while ($res=$DB->nextrow()) {
			print( "<tr>" );
			if ($res["TARIF"] <> 0){
				print( "<td align=\"center\" class=verdana9>".$pref."-".$noper."</td>\n" );
				print( "<td align=\"center\" class=verdana9>".$basistebus."</td>\n" );
				print( "<td align=\"center\" class=verdana9>".number_format($jua,2)."</td>\n" );
				print( "<td align=\"center\" class=verdana9>".$res["T"]."</td>\n" );
					if ($kdvaluta=='1') {
						if (substr($kdproduk,0,4)=="JSSP" || substr($kdproduk,0,4)=="JSSH") {
						if ($kdproduk=='JSSPO4'||$kdproduk=='JSSPO5'||$kdproduk=='JSSPO6'||$kdproduk=='JSSPO9x' ){
	      					print( "<td align=\"right\" class=verdana9>".number_format($prm/1000*$res["TARIF"],0)."</td>" );
	  					 	//} elseif ($kdproduk=='JSSPO7A'||$kdproduk=='JSSPO8'||$kdproduk=='JSSPO9' || substr($kdproduk,0,4)=="JSSH" ){
						}elseif($kdproduk=='JSSPO7A'||$kdproduk=='JSSPO8'||$kdproduk=='JSSPO9' ||$kdproduk=='JSSPOA'){
	      					print( "<td align=\"right\" class=verdana9>".number_format($prm/769.23*$res["TARIF"],0)."</td>" );
	  					}else{
	      					print( "<td align=\"right\" class=verdana9>".number_format(round($juaasli/1000*$res["TARIF"],-3),0)."</td>" );
							//print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000*$res["TARIF"],-3),0)."</td>" );
							//print( "<td align=\"right\" class=verdana9>".number_format(round($res["TARIF"],-3),0)."</td>" );
					 	}
					}elseif ($kdproduk=='JSPEI5' || $kdproduk=='JSPEIP' || $kdproduk=='JSPEIPN' || $kdproduk=='JSSIA') {
						print( "<td align=\"right\" class=verdana9>".number_format($prm/1000*$res["TARIF"],0)."</td>" );
					}elseif ($kdproduk=='JSKPD'){
	      				print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000*$res["TARIF"],-3),0)."</td>" );
					}elseif ($kdproduk=='JSPNSK' || $kdproduk=='JSPNSB'){
	      				print( "<td align=\"right\" class=verdana9>".number_format(round($jua/100*$res["TARIF"],-3),0)."</td>" );
					}elseif (in_array($kdproduk,array('JSGTP'))) {
						print( "<td align=\"right\" class=verdana9>".number_format(round($juaasli/1000*$res["TARIF"],0),0)."</td>" );
					}
					else {
						//echo 'disnin'.$jua;
	      				print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000*$res["TARIF"],0),0)."</td>" );
	      			}
				} else {
					print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000*$res["TARIF"],2),2)."</td>" );
				}
			print( "</tr>" );
			}
			$i++;
		}
	}
?>
</table>