<?
  include "./includes/database.php"; 
  include "./includes/session.php"; 
	include "./includes/common.php";
  include "./includes/pertanggungan.php";
	include "./includes/klien.php";
  $DB = new Database($userid, $passwd, $DBName);
	$DA = new Database($userid, $passwd, $DBName);


	$sql = "select ".
            "a.prefixpertanggungan, a.tglsp, a.mulas, a.usia_th, a.nopertanggungan, ".
          	"a.expirasi, a.lamapembpremi_bl as periode_bulan,a.nopemegangpolis, ".
          	"a.lamaasuransi_th, a.lamaasuransi_bl, ".
          	"a.juamainproduk, a.premi1, a.premi2, a.nosp,a.kdvaluta, a.kdcarabayar,".
          	"a.kdstatusmedical,a.lamapembpremi_th,a.kdproduk, ".
          	"a.tglnextbook, a.tgllastpayment, ".
          	"b.namaproduk, b.keterangan, ".
          	"c.namacarabayar, ".
          	"e.gelar gelarpp,e.alamattetap01,e.alamattetap02, ".
          	"e.kodepostetap,e.phonetetap01,e.namaklien1 as pemegangpolis,".
          	"f.gelar gelarttg,f.namaklien1 as tertanggung, ".
						"(select x.faktorbayar from $DBUser.tabel_311_faktor_bayar x  ".
						" where x.kdvaluta = a.kdvaluta and x.kdcarabayar = a.kdcarabayar and x.kdbasis = g.kdbasisbayar) faktorbayar ".
         "from ".
            "$DBUser.tabel_100_klien e, ".
          	"$DBUser.tabel_100_klien f, ".
          	"$DBUser.tabel_200_pertanggungan a, ".
				  	"$DBUser.tabel_247_pertanggungan_basis g, ".
          	"$DBUser.tabel_202_produk b, ".
          	"$DBUser.tabel_305_cara_bayar c ".
         "where ".
            "b.kdproduk=a.kdproduk and ".
            "a.notertanggung=f.noklien and ".
						"g.prefixpertanggungan(+)=a.prefixpertanggungan and ".
						"g.nopertanggungan(+)=a.nopertanggungan and ".
          	"a.nopemegangpolis=e.noklien and ".
          	"a.kdcarabayar=c.kdcarabayar and ".
          	"a.kdpertanggungan='2' and ".
          	"a.prefixpertanggungan='$prefixpertanggungan' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DA->parse($sql);
	$DA->execute();
	$today = date("j-g-Y");
	
	//echo $sql;
	
	
	$sqlx1 = "select sum(a.premi)premi1jsap ".
         "from ".
            "$DBUser.tabel_223_transaksi_produk a, ".
          	"$DBUser.tabel_200_pertanggungan b ".
          "where ".
            "b.prefixpertanggungan = a.prefixpertanggungan and ".
            "b.nopertanggungan=a.nopertanggungan and ".
            "a.kdjenisbenefit in ('U','X') and  ".						
          	"a.prefixpertanggungan='$prefixpertanggungan' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DB->parse($sqlx1);
	$DB->execute();
	$arrs=$DB->nextrow();
	$premi1jsap =$arrs["PREMI1JSAP"];
		
	$sqlx2 = "select sum(a.premi)premi2jsap ".
         "from ".
            "$DBUser.tabel_223_transaksi_produk a, ".
          	"$DBUser.tabel_200_pertanggungan b ".
          "where ".
            "b.prefixpertanggungan = a.prefixpertanggungan and ".
            "b.nopertanggungan=a.nopertanggungan and ".
            "a.kdjenisbenefit in ('U') and  ".
          	"a.prefixpertanggungan='$prefixpertanggungan' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DB->parse($sqlx2);
	$DB->execute();
	$arrr=$DB->nextrow();
	$premi2jsap =$arrr["PREMI2JSAP"];

		
	//			while($arr=$DB->nextrow()){
				$arr=$DA->nextrow();
					$lamapremi = $arr["LAMAPEMBPREMI_TH"];
					$kdproduk = $arr["KDPRODUK"];
					$kdht = substr($kdproduk,0,2);
					$kdsttmed = $arr["KDSTATUSMEDICAL"];
					$kdcabar = $arr["KDCARABAYAR"];
	        $extrapremi = 5;
	        $sisabayar = $lamapremi - $extrapremi;
				  $tglcetak = $arr["TGLCETAK"];
					$fkcb = $arr["FAKTORBAYAR"];
							
				switch ($arr["KDVALUTA"]){
				  case '0':
          $macampolis = "RUPIAH DENGAN INDEX";
					break;
					case '1':
          $macampolis = "RUPIAH TANPA INDEX";
					break;
					case '3':
          $macampolis = "US DOLLAR";
					break;
					}
				
				  if($kdproduk =="JSAP1" || $kdproduk=="JSAP2") {
				 		 						 
  					 $premi1 = $premi1jsap * $fkcb;
  					 $premi2 = $premi2jsap * $fkcb;
						 
						 //echo "$premi1 = ".$premi1jsap." * ".$fkcb;
  					 }
				  else
						{
						  $premi1 = $arr["PREMI1"];
							$premi2 = $arr["PREMI2"];
						}
						
		
								
				if(($kdcabar=="X") || ($kdcarabayar=="E") || ($kdcarabayar=="J") || ($kdsttmed=="M") || ($kdht=="HT") || ($lamapremi < 5) ){
  				  $besarnya = "".$arr["NOTASI"]." ".number_format($premi1,2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]."";
				} else {
					  $besarnya = "".$arr["NOTASI"]." ".number_format($premi1,2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]." SELAMA 5 TAHUN ".
		                    " DAN ".$arr["NOTASI"]." ".number_format($premi2,2)." UNTUK ".$sisabayar." TAHUN BERIKUTNYA ";
				}
				
		    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body topmargin="0">
<link href="../jws.css" rel="stylesheet" type="text/css">

<div style="margin-left: 0px;">

<table border="0" width="111%"  cellspacing="2" cellpadding="10">
<tr valign="top" class="sans10"><td>
<table border="0" cellpadding="2">
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td><?
$sql1="select $DBUser.polis.getnotes2('$prefixpertanggungan','$nopertanggungan') notes from dual";
$DB->parse($sql1);
$DB->execute();
$res=$DB->nextrow();
$notes = $res["NOTES"];
echo "<pre class=sans10>$notes</pre>";
?></td>
</tr>
</table>

</td>
<!===========================================>
<td>
<table border="0" width="100%" cellpadding="2">
<tr>
  <td colspan="2"></td>
  <td colspan="2"></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td colspan="2"></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td colspan="2"></td>
  <td width="38%"><? echo $prefixpertanggungan."-".$nopertanggungan;?></td>
</tr>
<tr>
  <td colspan="2"></td>
  <td></td>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td width="34%"></td>
  <td colspan="2"><? echo "<font class=\"sans10\">"; echo $arr["NOSP"].", ".$arr["TGLSP"]; ?></td>
  </tr>
<tr>
  <td colspan="2"></td>
  <td colspan="2"></td>
  <td>&nbsp;</td>
</tr>
<tr><td colspan="2"></td><td colspan="3"><font class="sans10" ><? $gelarpp=(strlen($arr["GELARPP"])==0) ? '' : ", ".$arr["GELARPP"]; echo $arr["PEMEGANGPOLIS"].$gelarpp; ?></font></td></tr>
<tr>
  <td colspan="2"></td>
  <td colspan="3"><font class="sans10">
    <? 
						$KLN = new Klien($userid,$passwd,$arr["NOPEMEGANGPOLIS"]);
						
						echo $arr["ALAMATTETAP01"]."<br>";
		        echo $arr["ALAMATTETAP02"]." ".$KLN->namakodyatetap."  ".$arr["KODEPOSTETAP"]."<br>";
		        echo "Telp. ".$arr["PHONETETAP01"]."<br>";
						?>
  </font></td>
  </tr>
<tr>
  <td width="18%">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="3"><font class="sans10" >
    <? 
						$namatertanggung = (($arr["GELARTTG"]=="")||preg_match("/\t\n\r\f/",$arr["GELARTTG"])) ? $arr["TERTANGGUNG"] : $arr["TERTANGGUNG"].", ".$arr["GELARTTG"];	
						echo $namatertanggung; ?>
  </font></td>
  <td><font class="sans10" ><? echo $arr["USIA_TH"]; ?></font></td>
</tr>
<tr>
  <td colspan="2"></td>
  <td colspan="2"><font class="sans10"><? echo "POLIS ".$macampolis; ?></font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td colspan="2"><font class="sans10"><? echo $arr["NAMAPRODUK"]; ?></font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td colspan="3"><font class="sans10" ><? echo $arr["NOTASI"]." ".number_format($arr["JUAMAINPRODUK"],2,',','.'); ?></font></td>
  </tr>
<tr>
  <td colspan="2"></td>
  <td colspan="3"><font class="sans10" >
    <? 
									 
								$cutproduk=substr($arr["NAMAPRODUK"],0,3);
								switch($cutproduk){
								 case "ANU": 
								    $judulbenefit="PENSIUN HARI TUA"; 
										//$masaasuransi= "SEUMUR HIDUP";
										$masaasuransi=$arr["MULAS"]." SAMPAI ".$arr["EXPIRASI"];
										break;
								 default: 
								    $judulbenefit="UANG ASURANSI";
										$masaasuransi=$arr["MULAS"]." SAMPAI ".$arr["EXPIRASI"];
								}
								
									  //echo $arr["MULAS"]." SAMPAI ".$arr["EXPIRASI"]; 
										echo $masaasuransi;
									?>
  </font></td>
  </tr>
<tr>
  <td colspan="2"></td>
  <td colspan="2"></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td colspan="3"><font class="sans10">
    <? 
									  echo $besarnya;
									  /*
										echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]." SELAMA 5 TAHUN ";
		                echo " DAN ".$arr["NOTASI"]." ".number_format($arr["PREMI2"],2)." UNTUK ".$sisabayar." TAHUN BERIKUTNYA";
									  */
									 ?>
  </font></td>
  </tr>
<tr>
  <td colspan="2"></td>
  <td colspan="3"><font class="sans10">
    <? 
									//echo $arr["LAMAPEMBPREMI_TH"]." TAHUN ".$arr["PERIODE_BULAN"]." BULAN"; 
									echo $arr["LAMAPEMBPREMI_TH"]==""? "-" : "".$arr["LAMAPEMBPREMI_TH"]." TAHUN "; 
									if ($arr["PERIODE_BULAN"] or $arr["PERIODE_BULAN"]<>"0"){echo $arr["PERIODE_BULAN"]." BULAN ";}
									?>
  </font></td>
  </tr>
<tr>
  <td colspan="2"></td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td colspan="5"><font face="Verdana" size="1" >
    <? 
									//---------------------------------------- penerima faedah ------------------
                	/*
									$sql = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,c.namahubungan,b.namaklien1,b.gelar ".
                			   "from $DBUser.tabel_219_pemegang_polis_baw a, $DBUser.tabel_100_klien b, ".
                				 "$DBUser.tabel_218_kode_hubungan c ".
                				 "where a.kdinsurable=c.kdhubungan and a.prefixpertanggungan='$prefixpertanggungan' ".
                				 "and a.nopertanggungan='$nopertanggungan' and a.noklien=b.noklien ".
                				 "order by a.nourut ";
                	//echo $sql;
									*/
									/* $sql  = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,c.namahubungan,".
													"n.namaklien1,n.gelar ".
                        "from ".
												  "$DBUser.tabel_100_klien n,".
                          "$DBUser.tabel_219_pemegang_polis_baw a,".
                          "$DBUser.tabel_113_insurable b, ".
                          "$DBUser.tabel_218_kode_hubungan c ".
                        "where ".
												  "a.noklien=n.noklien and ".
                          "a.prefixpertanggungan='$prefixpertanggungan' and ".
                          "a.nopertanggungan='$nopertanggungan' and ".
                          "a.noklien=b.noklieninsurable and b.kdhubungan=c.kdhubungan ".
                          //"and a.notertanggung='".$PER->notertanggung."' ".
                        "order by a.nourut";
												
										*/

										$sql  = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,  ".
      														"NVL(DECODE(A.NOTERTANGGUNG,A.NOKLIEN,'TERTANGGUNG',  ".
      		          							"DECODE(B.KDHUBUNGAN,'2',(SELECT NAMAHUBUNGAN FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
      		           							"WHERE B.KDHUBUNGAN=C.KDHUBUNGAN),(SELECT NAMAHUBUNGAN||' '||'TERTANGGUNG' FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
      		           							"WHERE B.KDHUBUNGAN=C.KDHUBUNGAN))),'') NAMAHUBUNGAN,  ".
																	"D.NAMAKLIEN1,d.gelar  ".
														"FROM  $DBUser.TABEL_219_PEMEGANG_POLIS_BAW A,  ".
  																"$DBUser.TABEL_113_INSURABLE B,  ".
  																"$DBUser.TABEL_100_KLIEN D ".
														"WHERE A.NOTERTANGGUNG=B.NOTERTANGGUNG(+) ".
														"AND A.NOKLIEN=B.NOKLIENINSURABLE(+) ".
														"AND A.NOKLIEN=D.NOKLIEN ".
														"and A.PREFIXPERTANGGUNGAN='$prefixpertanggungan'".
														"and A.NOPERTANGGUNGAN='$nopertanggungan' ".
														"ORDER BY A.NOURUT ";
														
									//echo $sql;
																					
                	$DB->parse($sql);
                	$DB->execute();
                	$i = 0;
                	while($ars=$DB->nextrow()){
                	   $nama = (strlen($ars["GELAR"])==0) ? $ars["NAMAKLIEN1"].",".$ars["GELAR"] : $ars["NAMAKLIEN1"];
                		 if ($ars["KDINSURABLE"]=='04') {
                		 	 		$hub=($ars["NOKLIEN"]==$ars["NOTERTANGGUNG"]) ? "DIRI TERTANGGUNG" : "BELUM DIDEFINISIKAN";
                		 } else {
                			 		$hub = $ars["NAMAHUBUNGAN"];
                		 }		 
                		 echo "<font class=\"sans10\" >";
                		 echo $ars["NOURUT"].". ";
                		 echo $ars["NAMAHUBUNGAN"].", ";
                		 echo $nama;
                		 
                		 echo "<br>";
                		 echo "</font>";
                		 $i++;
    							}
									?>
    </font></td>
  </tr>
</table>
</td>
</tr>
</table>
</div>
</body>
</html>
