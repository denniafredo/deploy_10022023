<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  include "../../includes/pertanggungan.php";
	include "../../includes/klien.php";
  $DB = new Database($userid, $passwd, $DBName);
	$DA = new Database($userid, $passwd, $DBName);

	$sql = "select ".
            "a.nopolbaru, a.prefixpertanggungan, a.tglsp, a.mulas, a.usia_th, a.nopertanggungan, ".
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
          	"a.prefixpertanggungan='$prefix' and ".
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
          	"a.prefixpertanggungan='$prefix' and ".
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
          	"a.prefixpertanggungan='$prefix' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DB->parse($sqlx2);
	$DB->execute();
	$arrr=$DB->nextrow();
	$premi2jsap =$arrr["PREMI2JSAP"];

		//echo $sqlx2;
			                       
?>
<html>
<title>Cetakan Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<div align="center">
  <center>
  <table border="0" width="700" bgcolor="#6666FF" cellspacing="8" cellpadding="10">
    <tr>
		<td width="100%" bgcolor="#251E6A">
		    <? 
			
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
				} else if ($premi2 > 0) { echo "$kdcarabayar";
					  $besarnya = "".$arr["NOTASI"]." ".number_format($premi1,2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]." SELAMA 5 TAHUN ".
		                    " DAN ".$arr["NOTASI"]." ".number_format($premi2,2)." UNTUK ".$sisabayar." TAHUN BERIKUTNYA ";
				}
				else {
					$besarnya = "".$arr["NOTASI"]." ".number_format($premi1,2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]." SELAMA 5 TAHUN";
				}
				
		    ?>
        <table border="0" width="100%" cellpadding="5">
          <tr>
            <td width="16%"></td>
            <td width="64%">
              <p align="center"><b><font face="Arial" size="4" color="#3399FF">PT ASURANSI
              JIWA IFG</font></b><b><font size="2" face="Verdana"><br>
              </font><font face="Verdana" size="1" color="#3399FF">BERKEDUDUKAN DI JAKARTA<br>
              (SELANJUTNYA DISEBUT PERUSAHAAN)</font></b></td>
            <td width="20%">
              <table border="0" width="100%" bgcolor="#3399FF" cellspacing="1" cellpadding="3">
                <tr>
                  <td width="100%" bgcolor="#251E6A">
                    <p align="center"><font face="Verdana" size="1" color="#3399FF"><b>NOMOR
                    POLIS<br>
                    </b>
										<? 
										echo ($arr['NOPOLBARU'] ? $arr['NOPOLBARU'] : $prefix."-".$nopertanggungan)
										//echo $arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]; 
										?></font></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

        <table border="0" width="100%">
          <tr>
            <td width="100%" colspan="3"></td>
          </tr>
          <tr>
            <td width="100%" colspan="3">
              <p align="left"><font face="Verdana" size="1" color="#3399FF">BERDASARKAN SURAT
              PERMINTAAN ASURANSI JIWA NOMOR <? echo $arr["NOSP"].", ".$arr["TGLSP"]; ?> DARI</font></td>
          </tr>
          <tr>
            <td width="10%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>NAMA</b></font></td>
            <td width="2%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
            <td width="88%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><? $gelarpp=(strlen($arr["GELARPP"])==0) ? '' : ", ".$arr["GELARPP"]; echo $arr["PEMEGANGPOLIS"].$gelarpp; ?></font></td>
          </tr>
          <tr>
            <td width="10%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>ALAMAT</b></font></td>
            <td width="2%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
            <td width="88%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">
						<? 
						$KLN = new Klien($userid,$passwd,$arr["NOPEMEGANGPOLIS"]);
						
						echo $arr["ALAMATTETAP01"]."<br>";
		        echo $arr["ALAMATTETAP02"]." ".$KLN->namakodyatetap."  ".$arr["KODEPOSTETAP"]."<br>";
		        echo "Telp. ".$arr["PHONETETAP01"]."<br>";
						?></font></td>
          </tr>
          <tr>
            <td width="100%" colspan="3">
              <p align="center"><font face="Verdana" size="1" color="#3399FF"><b>(SELANJUTNYA
              DISEBUT PEMEGANG POLIS)</b></font></td>
          </tr> 
          <tr>
            <td width="100%" colspan="3"><font face="Verdana" size="1" color="#3399FF">DENGAN
              INI PERUSAHAAN DAN PEMEGANG POLIS MENGADAKAN PERJANJIAN ASURANSI
              ATAS JIWA :</font></td>
          </tr>
          <tr>
            <td width="10%"><font face="Verdana" size="1" color="#3399FF"><b>NAMA</b></font></td>
            <td width="2%"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
            <td width="88%"><font face="Verdana" size="1" color="#3399FF"><? 
						$namatertanggung = (($arr["GELARTTG"]=="")||preg_match("/\t\n\r\f/",$arr["GELARTTG"])) ? $arr["TERTANGGUNG"] : $arr["TERTANGGUNG"].", ".$arr["GELARTTG"];	
						echo $namatertanggung; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <b> UMUR :</b> <? echo $arr["USIA_TH"]; ?>&nbsp; TAHUN</font></td>
          </tr>
          <tr>
            <td width="100%" colspan="3">
              <p align="center"><font face="Verdana" size="1" color="#3399FF"><b>(SELANJUTNYA
              DISEBUT TERTANGGUNG)</b></font></td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Verdana" size="1" color="#3399FF">MENURUT
              KETENTUAN-KETENTUAN SEBAGAI BERIKUT :</font></td>
          </tr>
          <tr>
            <td width="100%" colspan="3">
              <table border="0" width="100%">
                <tr>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>1.</b></font></td>
                  <td width="24%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>MACAM POLIS</b></font></td>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
                  <td width="70%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><? echo "POLIS ".$macampolis; ?></font></td>
                </tr>
                <tr>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>2.</b></font></td>
                  <td width="24%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>MACAM ASURANSI</b></font></td>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
                  <td width="70%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><? echo $arr["NAMAPRODUK"]; ?></font></td>
                </tr>
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
								 ?>
                <tr>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>3.</b></font></td>
                  <td width="24%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b><? echo $judulbenefit; ?></b></font></td>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
                  <td width="70%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><? echo $arr["NOTASI"]." ".number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
                </tr>
                <tr>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>4.</b></font></td>
                  <td width="24%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>MASA ASURANSI</b></font></td>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
                  <td width="70%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">
									<? 
									  //echo $arr["MULAS"]." SAMPAI ".$arr["EXPIRASI"]; 
										echo $masaasuransi;
									?>
									</font></td>
                </tr>
                <tr>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>5.</b></font></td>
                  <td width="24%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>PREMI</b></font></td>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
                  <td width="70%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">&nbsp;</font></td>
                </tr>
                <tr>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">&nbsp;</font></td>
                  <td width="24%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">a)
                    BESARNYA</font></td>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
                  <td width="70%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">
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
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">&nbsp;</font></td>
                  <td width="24%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">b)
                    LAMA PEMBAYARAN</font></td>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>:</b></font></td>
                  <td width="70%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF">
									<? 
									//echo $arr["LAMAPEMBPREMI_TH"]." TAHUN ".$arr["PERIODE_BULAN"]." BULAN"; 
									echo $arr["LAMAPEMBPREMI_TH"]==""? "-" : "".$arr["LAMAPEMBPREMI_TH"]." TAHUN "; 
									if ($arr["PERIODE_BULAN"] or $arr["PERIODE_BULAN"]<>"0"){echo $arr["PERIODE_BULAN"]." BULAN ";}
									?>
                    </font></td>
                </tr>
								<? 
						//		}
								 ?>
                <tr>
                  <td width="3%" valign="top" align="left"></td>
                  <td width="24%" valign="top" align="left"></td>
                  <td width="3%" valign="top" align="left"></td>
									<td width="3%" valign="top" align="left"></td>
                </tr>
                <tr>
                  <td width="3%" valign="top" align="left"><font face="Verdana" size="1" color="#3399FF"><b>6.</b></font></td>
                  <td width="97%" valign="top" align="left" colspan="3"><font face="Verdana" size="1" color="#3399FF"><b>PENERIMA
                    FAEDAH MENURUT URUTAN :</b></font></td>
                </tr>
                <tr>
                  <td width="3%" valign="top" align="left"></td>
                  <td width="97%" valign="top" align="left" colspan="3"><font face="Verdana" size="1" color="#3399FF">
									<? 
									//---------------------------------------- penerima faedah ------------------
                	/*
									$sql = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,c.namahubungan,b.namaklien1,b.gelar ".
                			   "from $DBUser.tabel_219_pemegang_polis_baw a, $DBUser.tabel_100_klien b, ".
                				 "$DBUser.tabel_218_kode_hubungan c ".
                				 "where a.kdinsurable=c.kdhubungan and a.prefixpertanggungan='$prefix' ".
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
                          "a.prefixpertanggungan='$prefix' and ".
                          "a.nopertanggungan='$nopertanggungan' and ".
                          "a.noklien=b.noklieninsurable and b.kdhubungan=c.kdhubungan ".
                          //"and a.notertanggung='".$PER->notertanggung."' ".
                        "order by a.nourut";
												
										*/

										$sql  = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,  ".
      														"NVL(DECODE(A.NOTERTANGGUNG,A.NOKLIEN,'TERTANGGUNG',  ".
      		          							"DECODE(B.KDHUBUNGAN,'A2',(SELECT NAMAHUBUNGAN FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
      		           							"WHERE B.KDHUBUNGAN=C.KDHUBUNGAN),(SELECT NAMAHUBUNGAN||' '||'TERTANGGUNG' FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
      		           							"WHERE B.KDHUBUNGAN=C.KDHUBUNGAN))),'') NAMAHUBUNGAN,  ".
																	"D.NAMAKLIEN1,d.gelar  ".
														"FROM  $DBUser.TABEL_219_PEMEGANG_POLIS_BAW A,  ".
  																"$DBUser.TABEL_113_INSURABLE B,  ".
  																"$DBUser.TABEL_100_KLIEN D ".
														"WHERE A.NOTERTANGGUNG=B.NOTERTANGGUNG(+) ".
														"AND A.NOKLIEN=B.NOKLIENINSURABLE(+) ".
														"AND A.NOKLIEN=D.NOKLIEN ".
														"and A.PREFIXPERTANGGUNGAN='$prefix'".
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
                		 echo "<font face=\"Verdana\" size=\"1\" color=\"#3399FF\">";
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
          <tr>
            <td width="100%" colspan="3"></td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Verdana" size="1" color="#3399FF">PERJANJIAN
              ASURANSI INI BERLAKU SESUAI DENGAN SYARAT-SYARAT UMUM POLIS
              ASURANSI JIWA PERORANGAN DAN KETENTUAN-KETENTUAN LAIN YANG
              TERCANTUM DALAM RUANG CATATAN DAN ATAU LAMPIRAN-LAMPIRAN POLIS
              YANG MENJADI BAGIAN MUTLAK YANG TIDAK DAPAT DIPISAHKAN DARI POLIS
              INI</font></td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Verdana" size="1">&nbsp;</font></td>
          </tr>
        </center>
        <tr>
          <td width="100%" colspan="3">
            <p align="left"><font face="Verdana" size="1" color="#3399FF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						JAKARTA,&nbsp;<? echo $tglcetak; ?></font>
						</td> 
        </tr>
        <center>
        <tr>
          <td width="100%" colspan="3">
            <table border="0" width="100%">
              <tr>
                <td width="33%"></td>
                <td width="18%"></td>
                <td width="49%">
                  <p align="center"><font face="Verdana" size="1" color="#3399FF"><b>PT ASURANSI
                  JIWA IFG<br>
                  DIREKSI</b></font></p>
                  <!--<p align="center"><font face="Verdana" size="1" color="#3399FF"><u>INDRA CATARYA SITUMEANG, M.Sc, FSAI<br>
                  </u>DIREKTUR</font>--></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="100%" colspan="3"></td>
        </tr>
        </table>
      </td>
    </tr>
  </table>
  </center>
  <br>
	<div align="center">
  <center>
  <table border="0" width="700" bgcolor="#6666FF" cellspacing="8" cellpadding="10">
    <tr>
      <center>
      <td width="100%" bgcolor="#251E6A">
        <table border="0" width="100%">
          <tr>
            <td width="100%">
              <p align="center"><font face="Verdana" size="2" color="#3399FF"><b>KETENTUAN-KETENTUAN KHUSUS </b></font></td>
          </tr>
          <tr>
            <td width="100%"></td>
          </tr>
          <tr>
            <td width="100%" align="left">
        		<?
          	// catatan polis // tergantung dari isi tabel tabel_247_pertanggungan_basis
						$sql1="select $DBUser.polis.getnotes2('$prefix','$nopertanggungan') notes from dual";
        		//echo $sql1;
						$DB->parse($sql1);
        	  $DB->execute();
        		$res=$DB->nextrow();
           		 $notes = $res["NOTES"];
        		/*if($nopertanggungan=="001912311"){
					echo "<pre class=sans8><font color=#3399FF>

I.  KETENTUAN PEMBAYARAN UANG ASURANSI :
    1. PEMBAYARAN MANFAAT ASURANSI TIAP BULAN MULAI :                           
       - BULAN 11/2012 SAMPAI 10/2013 SEBESAR 1,299,990.00####                  
       - BULAN 11/2013 SAMPAI 10/2014 SEBESAR 1,310,400.00####                  
       - BULAN 11/2014 SAMPAI 10/2015 SEBESAR 1,320,870.00####                  
       - BULAN 11/2015 SAMPAI 10/2016 SEBESAR 1,331,460.00####                  
       - BULAN 11/2016 SAMPAI 10/2017 SEBESAR 1,342,110.00####                  
                                                                                
    2. PADA AKHIR MASA ASURANSI DIBAYARKAN SEKALIGUS SEBESAR :                  
       Rp.312,193,530.00##                                                      
                                                                                
    3. SELAIN FAEDAH DI ATAS DIJAMIN PULA PEMBAYARAN SEKALIGUS SEBESAR          
       Rp.75,000,000.00###,                                                     
       JIKA TERTANGGUNG MENINGGAL DUNIA DI DALAM MASA ASURANSI.                 
                                                                                
II. MENYIMPANG  DARI  SYARAT-SYARAT  UMUM  POLIS  ASURANSI JIWA  PERORANGAN     
   SEBAGAIMANA DIATUR PADA :                                                    
   1. PASAL 13, BAHWA PELAKSANAAN PENEBUSAN POLIS DAPAT DILAKUKAN 1 (SATU)      
      TAHUN SETELAH POLIS BERLAKU.                                              
   2. PASAL 14, BAHWA PINJAMAN POLIS TIDAK DIPERKENANKAN                        
   3. PENGAJUAN  PENEBUSAN YANG  TIDAK TEPAT PADA ULANG TAHUN POLIS, NILAI      

NOTES                                                                           
--------------------------------------------------------------------------------
      TEBUSNYA AKAN DIHITUNG BERDASARKAN NILAI TEBUS PADA SAAT ULANG TAHUN      
      POLIS TERAKHIR.                                                           
                                                                                
III.NILAI TEBUS :                                                               
</pre>";
				}else{*/
				
					echo "<pre class=sans8><font color=#3399FF>$notes</pre>";
				//}
						?>
						</td>
          </tr>
        </center><center>
        <tr>
          <td width="100%" align="left">
					  <?
					  //-------------------------------  start nilai tebus ----------
        	  $sql1="select $DBUser.polis.gettebus2('$prefix','$nopertanggungan') tebus from dual"; 
        		 //$sql1="select $DBUser.polis.gettebus('$prefix','$nopertanggungan') tebus from dual";
				$DB->parse($sql1);
				
        	  $DB->execute();
        		$res=$DB->nextrow();
            $tebus = $res["TEBUS"];
						echo "<pre class=sans8><font color=#3399FF>$tebus</pre>";
						?>
					</td>
        </tr>
        </table>
      </td>
      </center>
    </tr>
  </table>
  </center>
</div>
</div>
<hr size="1">
<a href="#" onClick="javascript:window.close();"><font face="Verdana" size="1">CLOSE</font></a>
 </body>
 </html>

