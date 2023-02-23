<?
	include "../../includes/session.php";
	include "../../includes/database.php";
  $DB = new Database($userid,$passwd,$DBName);
  $DB2 = new Database($userid,$passwd,$DBName);
 /*if((date("d")!="04" ||date("d")!="14" || date("d")!="24" || date("d")!="26") && $kantor!="KP"){
echo "<blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Divisi ARC </blink>";
  die;
  }*/

$str = (date("d"));
$exclude_list = array("104","114","124");
if(!in_array($str, $exclude_list) && ($kantor!="KP")){
//if(!in_array($str, $exclude_list) && !in_array($str, $exclude_ktr)){
//if(!in_array($str, $exclude_list) && !in_array($str, $exclude_ktr)){
    //echo "<blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Hubungi Divisi ARC </blink>";
 // die;
}


?>
<html>
<head>
<title>Remunerasi</title>
<script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/highlight.js"></script>
<link href="../jws.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<script language="JavaScript">
function Cekbok(doc){
 if (doc == true)
 {
 checkedAll('porm', true);
 }
 else
 {
 checkedAll('porm', false);
 }
}
</script>


<script type="text/javascript">
function blinkIt() {
 if (!document.all) return;
 else {
   for(i=0;i<document.all.tags('blink').length;i++){
      s=document.all.tags('blink')[i];
      s.style.visibility=(s.style.visibility=='visible')?'hidden':'visible';
   }
 }
}

</script>

</head>
<body  onload="setInterval('blinkIt()',300)">
<?
//============
function DateSelector($inName, $useDate=0)
  {
          if($useDate == 0)
          {
              $useDate = Time();
          }
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n");

					/*echo "<option value=05>05</option>";
					echo "<option value=15>15</option>";
					echo "<option value=25>25</option>";*/
          //for($currentDay = 1; $currentDay<= 31;$currentDay++)
          //{
		  		$currentDay=04;
              print("<option value=\"$currentDay\"");
  						if($selected==$currentDay)
              {
                  print(" selected");
              }
              print(">$currentDay\n");
			  $currentDay=14;
              print("<option value=\"$currentDay\"");
  						if($selected==$currentDay)
              {
                  print(" selected");
              }
              print(">$currentDay\n");
			  $currentDay=24;
              print("<option value=\"$currentDay\"");
  						if($selected==$currentDay)
              {
                  print(" selected");
              }
              print(">$currentDay\n");
          //}

          print("</select>");


     // Bulan
  		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);
          print("<select name=" . $inName .  "bln id= 'dbln'>\n");
          for($currentMonth = 1; $currentMonth <= 12;$currentMonth++)
          {
              switch($currentMonth)
              {
                case '1' : $namabulan ="JANUARI"; break ;
                case '2' : $namabulan ="FEBRUARI"; break ;
                case '3' : $namabulan ="MARET"; break ;
                case '4' : $namabulan ="APRIL"; break ;
                case '5' : $namabulan ="MEI"; break ;
                case '6' : $namabulan ="JUNI"; break ;
                case '7' : $namabulan ="JULI"; break ;
                case '8' : $namabulan ="AGUSTUS"; break ;
                case '9' : $namabulan ="SEPTEMBER"; break ;
                case '10' : $namabulan ="OKTOBER"; break ;
                case '11' : $namabulan ="NOVEMBER"; break ;
                case '12' : $namabulan ="DESEMBER"; break ;
              }

              print("<option value=\"$currentMonth\"");
  						if($selected==$currentMonth)
              {
                  print(" selected");
              }
              print(">$namabulan\n");
          }
          print("</select>");

  		// Tahun
  		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);
          print("<select name=" . $inName .  "thn>\n");
          $startYear = date( "Y", $useDate);
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++)
          {
              print("<option value=\"$currentYear\"");
              if($selected==$currentYear)
              {
                  print(" selected");
              }
              print(">$currentYear\n");

          }
  				print("</select>");
  }
  //====================
?>
<form method="POST" name="porm" action="pendapatanagen.php">

<font face="Verdana" size="2"><b>REMUNERASI AGEN</b></font>
<hr size="1">
<?
if ($kantor=='XLF') {
echo "Temporary Closed...";} else {
 if($kantor=='KP'){
 	echo "<a href='./daftar_komisi_kp.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI KOMISI & REMUNERASI AGEN (Sentralisasi KP) <blink> Klik Disini</b></font> </a></blink></br></br> ";
 	echo "<a href='./daftar_komisi_lpa.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI KOMISI & REMUNERASI AGEN LPA <blink> Klik Disini</b></font> </a></blink></br></br> ";
 	echo "<a href='./daftar_komisi_ws.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI KOMISI & REMUNERASI AGEN WS <blink> Klik Disini</b></font> </a></blink></br></br> ";
 	echo "<a href='./daftar_komisi_bs.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI KOMISI & REMUNERASI AGEN BS <blink> Klik Disini</b></font> </a></blink></br></br> ";
 	echo "<a href='./validasi_success_fee.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI SUCCESS FEE <blink> Klik Disini</b></font> </a></blink></br></br> ";
 	echo "<a href='./validasi_pendapatanlain.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI Pendapatan Lain <blink> Klik Disini</b></font> </a></blink></br></br> ";
 }else{
 echo "<a href='./daftar_komisi.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI KOMISI & REMUNERASI AGEN<blink> Klik Disini</b></font> </a></blink></br></br> ";
}
  echo "<a href='./daftar_komis_tagih.php'><font color='#FF6633' face='Verdana' size='2'><b>VALIDASI KOMISI PENAGIHAN LANJUTAN<blink> Klik Disini</b></font> </a></blink></br></br> ";}

if ($_POST['btdel']) {

      	$box=$_POST['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				//echo "No Data Updated !";
				}
				else
				{
    				foreach ($box as $dear) {
    				//echo "XXXX".$dear;
        			$sql = "DELETE FROM $DBUser.TABEL_404_PENDAPATAN_LAIN_AGEN  WHERE NOAGEN=substr('$dear',0,10)".
					" AND KDKOMISIAGEN=substr('$dear',11,2) AND TO_CHAR(TGLUPDATED,'DD/MM/YYYY')=substr('$dear',13,10)";
					$DB->parse($sql);
      				$DB->execute();
					//echo $sql;
					}
						}
				}

if ($_POST['btsave']) {

      	$box=$_POST['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				//echo "No Data Updated !";
				}
				else
				{
					//print_r($box);
    				foreach ($box as $dear) {
    				//echo "XXXX".$dear;
	        			$sql = "UPDATE $DBUser.TABEL_404_PENDAPATAN_LAIN_AGEN  SET KDAUTHORISASI='1' WHERE NOAGEN=substr('$dear',0,10)".
						" AND KDKOMISIAGEN=substr('$dear',11,2) AND TO_CHAR(TGLPROSES,'DD/MM/YYYY')=substr('$dear',13,10)";
						//echo $sql;
						$DB->parse($sql);
	      				$DB->execute();
					//echo $sql;
					}
						}
				}
if($_POST['btmanajerial']){
	$noagen = $_POST['btmanajerial'];
}
if ($btadd=="ADD"){
       $sql = "insert into $DBUser.TABEL_404_PENDAPATAN_LAIN_AGEN  ".
 	 			"(noagen, kdkomisiagen, tglproses,nilaipendapatan,nokontrak,kdkantor,userrekam,tglrekam,userupdated,tglupdated) ".
				"values ".
				"('$noagen','$kdkomisi',TO_DATE('$tanggalkomisi','DD/MM/YYYY'),ROUND($nilaikomisi,0),'$nokontrak','$kantor','$userid',sysdate,'$userid',TO_DATE('$tanggalkomisi','DD/MM/YYYY'))";
			//echo  $sql;

			if($kdkomisi=="76" && $nokontrak=="")
			{
				$gagalpk="<blink>GAGAL...!!! Pastikan Nomor Kontrak Terisi untuk Entry Komisi PK.!!! </blink><br><br>";
			}else{
echo $sql;
			$DB->parse($sql);
			 if($DB->execute())
			 {
			 	$DB->commit();
			 }
			 else
			 {
			  	echo "gagal.. <br><br>";
			 }
			 //echo $sql;
			}
    }


	if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	} else {
  	$tglcari	=	 ( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
  					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
  					$_POST['dthn'];
	}
	$tgldef .= (strlen(date('d'))==1) ? '0'.date('d') : date('d');
	$tgldef .= "/";
	$tgldef .= (strlen(date('m'))==1) ? '0'.date('m') : date('m');
	$tgldef .= "/";
	$tgldef .= date('Y');

	if(!isset($_POST['dtgl'])){
	 if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	 } else {
	  $tglcari = $tgldef;
	 }
	}

	if($_POST['dtgl']=="all" || substr($_GET['tglcari'],0,3)=="all"){
	  $filtercari = "and to_char(a.tglmutasi,'MM/YYYY')='".substr($tglcari,-7)."' ";
		$titletglcari = "BULAN ".substr($tglcari,-7);
	} else {
	  $filtercari = "and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ";
		$titletglcari = $tglcari;
	}
?>
<table border="0" cellspacing="0" width="100%" class="tblhead">
  <tr>
   <td>
<table border="0" cellspacing="5" class="tblisi" width="100%">
        <tr>
          <td width="20%"><font face="Verdana" size="2">Masukkan Nomor Agen</font></td>
          <td width="20%"><input type="text" class="a" name="noagen" size="10" maxlength="10" onFocus="highlight(event)" onBlur="javascript:validasi10(this.form.noagen);" value="<? echo $noagen; ?>">
						<a href="#" onClick="NewWindow('../proposal/agnlistr.php?a=porm','popuppage','420','300','yes')"><img src="../img/jswindow.gif" border="0" alt="cari daftar agen"></a>		</td>
          <td>
					<input type="submit" name="update" value="LANJUT"></td>
		  </tr>
		  <tr><td colspan="3" width="20%"><font face="Verdana" size="2">Tanggal Proses <?=DateSelector("d"); ?>
		  <input type="submit" name="refreshDataManajerialBonus" value="Refresh Data"></td></tr>
</table>
   </td>
	</tr>
</table>
<?
	$tahunProses = $_POST['dthn'];;
	$tahun = date('Y');
	$bulan_proses = $_POST['dbln'];
	$tgl_proses = $_POST['dtgl'];

	if($tgl_proses < 10){
		$tgl_proses='0'.$tgl_proses;
	}else{
		$tgl_proses= $tgl_proses;
	}

	if($bulan_proses == 1){
		$bulan_produksi = 12;
		$tahun =  date('Y') - 1;
	}else{
		$bulan_produksi = $_POST['dbln']-1;
	}

	if($bulan_produksi < 10){
		$bulan='0'.$bulan_produksi;
	}else{
		$bulan= $bulan_produksi;
	}

	if($bulan_proses < 10){
		$bulanProses='0'.$bulan_proses;
	}else{
		$bulanProses= $bulan_proses;
	}

	if($bulan == '08' || $bulan == '09' || $bulan == '07'){
		$tabel_agen = "$DBUser.tabel_400_agen";
		$filterPeriode = '';
	}else{
		$tabel_agen = "$DBUser.tabel_400_log_mutasi_agen";
		$filterPeriode = "and periode = '".$bulan.$tahun."' ";
	}

	$sql = "
			SELECT b.NOAGEN,
			       (SELECT namaklien1 FROM $DBUser.tabel_100_klien z WHERE z.noklien = a.noagen)NAMAAGEN,
			       a.kdjabatanagen,
			       b.kdauthorisasi,
			       b.tglproses,
			       (SELECT namajabatanagen FROM $DBUser.tabel_413_jabatan_agen z WHERE z.kdjabatanagen = a.kdjabatanagen)NAMAJABATAN,
			       a.kdjabatanagen,
			       CASE
				       WHEN a.kdjabatanagen = '02' THEN
				       (
				         (SELECT   NVL(SUM(DECODE (kdcarabayar,
				                              'X', 0.3 * premi1 ,
				                              'E', 0.3 * premi1 ,
				                              'J', 0.3 * premi1 ,
				                              premi1)),0)
				          FROM  $DBUser.tabel_200_pertanggungan b, $DBUser.tabel_400_agen d
				          WHERE  b.noagen = d.noagen
				                   AND b.noagen IN
				                        (SELECT   noagen
				                           FROM   $tabel_agen
				                          WHERE   kdkantor =
				                                     a.kdkantor
				                                  AND kdareaoffice =
				                                        a.kdareaoffice
				                                  AND kdstatusagen =
				                                        '01'
				                                  AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
				                  AND TO_CHAR (mulas, 'mmyyyy') = '".$bulan.$tahun."'
				                  AND kdpertanggungan = '2'
				                  and b.kdproduk not in ('JSSP5')
				                  AND kdstatusfile IN ('1', '4'))
				          + (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                                FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK tpr, $DBUser.tabel_200_pertanggungan b
                                WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                       AND tpr.nopertanggungan = b.nopertanggungan
                                       AND b.noagen IN
	                                                (SELECT   noagen
	                                                   FROM   $tabel_agen
	                                                  WHERE   kdkantor =
	                                                             a.kdkantor
	                                                          AND kdareaoffice =
	                                                                a.kdareaoffice
	                                                          AND kdstatusagen =
	                                                                '01'
	                                                          AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
                                       AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                       AND TO_CHAR (tpr.tglmutasi, 'mmyyyy') = '".$bulan.$tahun."'
                                       AND tpr.kdproduk not in ('JL4BL')
                                       AND b.kdpertanggungan = '2'
                                       and b.kdproduk not in ('JSSP5')
                                  	   AND b.kdstatusfile IN ('1', '4')
                          	)
                          + (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                                FROM   $DBUser.TABEL_223_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                                WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                       AND tpr.nopertanggungan = b.nopertanggungan
                                       AND b.noagen IN
	                                                (SELECT   noagen
	                                                   FROM   $tabel_agen
	                                                  WHERE   kdkantor =
	                                                             a.kdkantor
	                                                          AND kdareaoffice =
	                                                                a.kdareaoffice
	                                                          AND kdstatusagen =
	                                                                '01'
	                                                          AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
                                       AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                       AND status = '2'
                                       AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                       AND tpr.kdproduk not in ('JL4BL')
                                       AND b.kdpertanggungan = '2'
                                       and b.kdproduk not in ('JSSP5')
                                  	   AND b.kdstatusfile IN ('1', '4')
                             )
                          + (SELECT  NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                                FROM   $DBUser.TABEL_UL_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                                WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                       AND tpr.nopertanggungan = b.nopertanggungan
                                       AND b.noagen IN
	                                                (SELECT   noagen
	                                                   FROM   $tabel_agen
	                                                  WHERE   kdkantor =
	                                                             a.kdkantor
	                                                          AND kdareaoffice =
	                                                                a.kdareaoffice
	                                                          AND kdstatusagen =
	                                                                '01'
	                                                          AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
                                       AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                       AND status = '2'
                                       AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                       AND tpr.kdproduk not in ('JL4BL')
                                       AND b.kdpertanggungan = '2'
                                       and b.kdproduk not in ('JSSP5')
                                  	   AND b.kdstatusfile IN ('1', '4')
                             )
				          + (SELECT   NVL(SUM (NVL (NILAIRP, PREMITAGIHAN)),0)
			                      FROM   $DBUser.TABEL_300_HISTORIS_PREMI b, $DBUser.tabel_200_pertanggungan c
			                      WHERE       b.prefixpertanggungan = c.prefixpertanggungan
			                              AND b.nopertanggungan = c.nopertanggungan
			                              AND b.kdkuitansi='NB1'
			                              AND c.noagen IN
					                                 (SELECT   noagen
					                                    FROM   $tabel_agen
					                                   WHERE   kdkantor = a.kdkantor
					                                           AND kdareaoffice = a.kdareaoffice
					                                           AND kdstatusagen = '01'
					                                           AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
			                              AND TO_CHAR (tglseatled, 'mmyyyy') = '".$bulan.$tahun."'
			                              AND c.KDSTATUSFILE IN ('1', '4') AND c.KDPERTANGGUNGAN = '2' and c.kdproduk not in ('JSSP5') )
				            )
				        WHEN a.kdjabatanagen = '05' THEN
				        (
				            (SELECT NVL(SUM(DECODE (kdcarabayar,
				                                      'X', 0.3 * premi1 ,
				                                      'E', 0.3 * premi1 ,
				                                      'J', 0.3 * premi1 ,
				                                      premi1)),0)
				                   FROM   $DBUser.tabel_200_pertanggungan b, $DBUser.tabel_400_agen d
				                   WHERE   b.noagen = d.noagen
				                             AND b.noagen IN
				                                (SELECT   noagen
				                                   FROM   $tabel_agen
				                                  WHERE   kdkantor =
				                                             a.kdkantor
				                                          AND kdareaoffice =
				                                                a.kdareaoffice
				                                          AND kdunitproduksi =
				                                                a.kdunitproduksi
				                                          AND kdstatusagen =
				                                                '01'
				                                          AND KDJABATANAGEN IN('00','18','05','09') $filterPeriode)
				                          AND TO_CHAR (mulas, 'mmyyyy') = '".$bulan.$tahun."'
				                          AND kdpertanggungan = '2'
				                          and b.kdproduk not in ('JSSP5')
				                          AND kdstatusfile IN ('1', '4'))
				            + (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                                FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK tpr, $DBUser.tabel_200_pertanggungan b
                                WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                       AND tpr.nopertanggungan = b.nopertanggungan
                                       AND b.noagen IN
	                                                (SELECT   noagen
	                                                   FROM   $tabel_agen
	                                                  WHERE   kdkantor =
	                                                             a.kdkantor
	                                                          AND kdareaoffice =
	                                                                a.kdareaoffice
	                                                          AND kdunitproduksi =
                                                        			a.kdunitproduksi
	                                                          AND kdstatusagen =
	                                                                '01'
	                                                          AND kdjabatanagen IN ('00','18','05','09') $filterPeriode)
                                       AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                       AND TO_CHAR (tpr.tglmutasi, 'mmyyyy') = '".$bulan.$tahun."'
                                       AND tpr.kdproduk not in ('JL4BL')
                                       AND b.kdpertanggungan = '2'
                                       and b.kdproduk not in ('JSSP5')
                                  	   AND b.kdstatusfile IN ('1', '4')
                              )
                          	+ (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                                FROM   $DBUser.TABEL_223_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                                WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                       AND tpr.nopertanggungan = b.nopertanggungan
                                       AND b.noagen IN
	                                                (SELECT   noagen
	                                                   FROM   $tabel_agen
	                                                  WHERE   kdkantor =
	                                                             a.kdkantor
	                                                          AND kdareaoffice =
	                                                                a.kdareaoffice
	                                                          AND kdunitproduksi =
                                                        			a.kdunitproduksi
	                                                          AND kdstatusagen =
	                                                                '01'
	                                                          AND kdjabatanagen IN ('00','18','05','09') $filterPeriode)
                                       AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                       AND status = '2'
                                       AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                       AND tpr.kdproduk not in ('JL4BL')
                                       AND b.kdpertanggungan = '2'
                                       and b.kdproduk not in ('JSSP5')
                                  	   AND b.kdstatusfile IN ('1', '4')
                             )
                          	+ (SELECT  NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                                FROM   $DBUser.TABEL_UL_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                                WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                       AND tpr.nopertanggungan = b.nopertanggungan
                                       AND b.noagen IN
	                                                (SELECT   noagen
	                                                   FROM   $tabel_agen
	                                                  WHERE   kdkantor =
	                                                             a.kdkantor
	                                                          AND kdareaoffice =
	                                                                a.kdareaoffice
	                                                          AND kdunitproduksi =
                                                        			a.kdunitproduksi
	                                                          AND kdstatusagen =
	                                                                '01'
	                                                          AND kdjabatanagen IN ('00','18','05','09') $filterPeriode)
                                       AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                       AND status = '2'
                                       AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                       AND tpr.kdproduk not in ('JL4BL')
                                       AND b.kdpertanggungan = '2'
                                       and b.kdproduk not in ('JSSP5')
                                  	   AND b.kdstatusfile IN ('1', '4')
                             )
				            + (SELECT   NVL(SUM (NVL (NILAIRP, PREMITAGIHAN)),0)
		                              FROM   $DBUser.TABEL_300_HISTORIS_PREMI b, $DBUser.tabel_200_pertanggungan c
		                              WHERE       b.prefixpertanggungan = c.prefixpertanggungan
		                                      AND b.nopertanggungan = c.nopertanggungan
		                                      AND b.kdkuitansi='NB1'
		                                      AND c.noagen IN
		                                         (SELECT   noagen
		                                            FROM   $tabel_agen
		                                           WHERE   kdkantor = a.kdkantor
		                                                   AND kdareaoffice = a.kdareaoffice
		                                                   AND kdunitproduksi = a.kdunitproduksi
		                                                   AND kdstatusagen = '01'
		                                                   AND KDJABATANAGEN IN('00','18','05','09') $filterPeriode)
		                                      AND TO_CHAR (tglseatled, 'mmyyyy') = '".$bulan.$tahun."'
		                                      AND c.KDSTATUSFILE IN ('1', '4') AND c.KDPERTANGGUNGAN = '2' and c.kdproduk not in ('JSSP5'))
				        )
			        END
			        as premi,
			        B.NILAIPENDAPATAN as bantuan
			FROM $DBUser.TABEL_404_PENDAPATAN_LAIN_AGEN b, $tabel_agen a
			WHERE b.KDKOMISIAGEN = '71'
			      AND TO_CHAR(b.TGLPROSES,'dd/mm/yyyy') ='".$tgl_proses."/".$bulanProses."/".$tahunProses."'
			      AND a.noagen = b.noagen
			      AND b.kdkantor = '$kantor'
			      $filterPeriode
		   ";
		   //echo $sql;

	$DB2->parse($sql);
	$DB2->execute();
	$i = 1;
	echo "<br><b>DAFTAR AGEN YANG MENDAPAT BANTUAN MANAJERIAL</b><br>";
	echo "<table border=0 cellspacing=4 cellpadding=0 width=1000><tr>";
	echo "<tr bgcolor=#0066CC >";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>NO</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>NO AGEN</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>NAMA AGEN</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>JABATAN</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>PREMI</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>BANTUAN</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>TGL PROSES</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>STATUS</font></span></div></td>";
	echo "</tr>";
   	while ($bantuan=$DB2->nextrow()) {
   		if($bantuan["KDAUTHORISASI"] == 1){
   			$statusApprove = "Sudah Divalidasi";
   			$color = '#F2FBEF';
   		}else{
   			$statusApprove = "Belum Divalidasi";
   			$color = '#ff6666';
   		}
		echo "<tr>";
	  	echo "<td bgcolor=#F2FBEF align=center>".$i."</td>";
	  	echo "<td><input type='submit' name='btmanajerial' value='".$bantuan["NOAGEN"]."'></td>";
		echo "<td bgcolor=#F2FBEF>".$bantuan["NAMAAGEN"]."</td>";
		echo "<td bgcolor=#F2FBEF>".$bantuan["NAMAJABATAN"]."</td>";
		echo "<td bgcolor=#F2FBEF align=right>".number_format($bantuan["PREMI"],2,",",".")."</td>";
		echo "<td bgcolor=#F2FBEF align=right>".number_format($bantuan["BANTUAN"],2,",",".")."</td>";
		echo "<td bgcolor=#F2FBEF align=center>".$bantuan["TGLPROSES"]."</td>";
		echo "<td bgcolor=".$color.">".$statusApprove."</td>";
		echo "</tr>";
		$i++;
	}
	echo "</table>";

	// --- BONUS PRODUKSI ------ //
	$sql = "
			SELECT b.NOAGEN,
		       (SELECT namaklien1
		          FROM $DBUser.tabel_100_klien z
		         WHERE z.noklien = a.noagen)
		          NAMAAGEN,
		       a.kdjabatanagen,
		       b.kdauthorisasi,
		       b.tglproses,
		       (SELECT namajabatanagen
		          FROM $DBUser.tabel_413_jabatan_agen z
		         WHERE z.kdjabatanagen = a.kdjabatanagen)
		          NAMAJABATAN,
		       a.kdjabatanagen,
		       CASE
		          WHEN a.kdjabatanagen = '02'
		          THEN
		             (SELECT   NVL(SUM(DECODE (kdcarabayar,
		                                   'X', 0.3 * premi1,
		                                   'E', 0.3 * premi1,
		                                   'J', 0.3 * premi1,
		                                   premi1)
		                       	   ),0)
		               FROM   $DBUser.tabel_200_pertanggungan b, $DBUser.tabel_400_agen d
		               WHERE  b.noagen=d.noagen
		                      AND b.noagen IN
		                                 (SELECT   noagen
		                                    FROM   $tabel_agen
		                                   WHERE   kdkantor = a.kdkantor
		                                           AND kdareaoffice =
		                                                 a.kdareaoffice
		                                           AND kdstatusagen =
		                                                 '01'
		                                           AND KDJABATANAGEN IN('00','18','05','09','02') $filterPeriode)
		                       AND TO_CHAR (mulas, 'mmyyyy') = '".$bulan.$tahun."'
		                       AND kdpertanggungan = '2'
		                       and b.kdproduk not in ('JSSP5')
		                       AND kdstatusfile IN ('1', '4') )
		              + (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
	                        FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK tpr, $DBUser.tabel_200_pertanggungan b
	                        WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
	                               AND tpr.nopertanggungan = b.nopertanggungan
	                               AND b.noagen IN
	                                            (SELECT   noagen
	                                               FROM   $tabel_agen
	                                              WHERE   kdkantor =
	                                                         a.kdkantor
	                                                      AND kdareaoffice =
	                                                            a.kdareaoffice
	                                                      AND kdstatusagen =
	                                                            '01'
	                                                      AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
	                               AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
	                               AND TO_CHAR (tpr.tglmutasi, 'mmyyyy') = '".$bulan.$tahun."'
	                               AND tpr.kdproduk not in ('JL4BL')
	                               AND b.kdpertanggungan = '2'
	                               and b.kdproduk not in ('JSSP5')
	                          	   AND b.kdstatusfile IN ('1', '4')
                  	  )
                      + (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                            FROM   $DBUser.TABEL_223_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                            WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                   AND tpr.nopertanggungan = b.nopertanggungan
                                   AND b.noagen IN
                                                (SELECT   noagen
                                                   FROM   $tabel_agen
                                                  WHERE   kdkantor =
                                                             a.kdkantor
                                                          AND kdareaoffice =
                                                                a.kdareaoffice
                                                          AND kdstatusagen =
                                                                '01'
                                                          AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
                                   AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                   AND status = '2'
                                   AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                   AND tpr.kdproduk not in ('JL4BL')
                                   AND b.kdpertanggungan = '2'
                                   and b.kdproduk not in ('JSSP5')
                              	   AND b.kdstatusfile IN ('1', '4')
                         )
                      + (SELECT  NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                            FROM   $DBUser.TABEL_UL_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                            WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                   AND tpr.nopertanggungan = b.nopertanggungan
                                   AND b.noagen IN
                                                (SELECT   noagen
                                                   FROM   $tabel_agen
                                                  WHERE   kdkantor =
                                                             a.kdkantor
                                                          AND kdareaoffice =
                                                                a.kdareaoffice
                                                          AND kdstatusagen =
                                                                '01'
                                                          AND kdjabatanagen IN ('00','18','05','02','09') $filterPeriode)
                                   AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                   AND status = '2'
                                   AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                   AND tpr.kdproduk not in ('JL4BL')
                                   AND b.kdpertanggungan = '2'
                                   and b.kdproduk not in ('JSSP5')
                              	   AND b.kdstatusfile IN ('1', '4')
                         )
		              + (SELECT   NVL (SUM (NVL (NILAIRP, PREMITAGIHAN)),0)
                          FROM   $DBUser.TABEL_300_HISTORIS_PREMI b, $DBUser.tabel_200_pertanggungan c
                          WHERE       b.prefixpertanggungan = c.prefixpertanggungan
                                  AND b.nopertanggungan = c.nopertanggungan
                                  AND c.noagen IN
                                                (SELECT  noagen
                                                  FROM   $tabel_agen
                                                  WHERE   kdkantor =
                                                             a.kdkantor
                                                          AND kdareaoffice =
                                                                a.kdareaoffice
                                                          AND kdstatusagen =
                                                                '01'
                                                          AND KDJABATANAGEN IN('00','18','05','02','09') $filterPeriode)
                                  AND b.kdkuitansi='NB1'
                                  AND TO_CHAR (tglseatled, 'mmyyyy') =  '".$bulan.$tahun."'
                                  AND c.KDSTATUSFILE IN ('1','4') AND c.KDPERTANGGUNGAN = '2' and c.kdproduk not in ('JSSP5') )
		          WHEN a.kdjabatanagen = '05'
		          THEN
		             (SELECT   NVL(SUM(DECODE (kdcarabayar,
		                                   'X', 0.3 * premi1,
		                                   'E', 0.3 * premi1,
		                                   'J', 0.3 * premi1,
		                                   premi1)
		                       		),0)
		               FROM   $DBUser.tabel_200_pertanggungan b, $DBUser.tabel_400_agen d
		               WHERE  b.noagen=d.noagen
		                      AND b.noagen IN
		                                 (SELECT  noagen
		                                   FROM   $tabel_agen
		                                   WHERE   kdkantor = a.kdkantor
		                                           AND kdareaoffice =
		                                                 a.kdareaoffice
		                                           AND kdunitproduksi= a.kdunitproduksi
		                                           AND kdstatusagen =
		                                                 '01'
		                                           AND KDJABATANAGEN IN('00','18','05','09') $filterPeriode)
		                       AND TO_CHAR (mulas, 'mmyyyy') = '".$bulan.$tahun."'
		                       AND kdpertanggungan = '2'
		                       and b.kdproduk not in ('JSSP5')
		                       AND kdstatusfile IN ('1', '4') )
		              + (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
	                        FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK tpr, $DBUser.tabel_200_pertanggungan b
	                        WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
	                               AND tpr.nopertanggungan = b.nopertanggungan
	                               AND b.noagen IN
	                                            (SELECT   noagen
	                                               FROM   $tabel_agen
	                                              WHERE   kdkantor =
	                                                         a.kdkantor
	                                                      AND kdareaoffice =
	                                                            a.kdareaoffice
	                                                      AND kdunitproduksi =
	                                                			a.kdunitproduksi
	                                                      AND kdstatusagen =
	                                                            '01'
	                                                      AND kdjabatanagen IN ('00','18','05','09') $filterPeriode)
	                               AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
	                               AND TO_CHAR (tpr.tglmutasi, 'mmyyyy') = '".$bulan.$tahun."'
	                               AND tpr.kdproduk not in ('JL4BL')
	                               AND b.kdpertanggungan = '2'
	                               and b.kdproduk not in ('JSSP5')
	                          	   AND b.kdstatusfile IN ('1', '4')
	                	)
          	  		+ (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                        FROM   $DBUser.TABEL_223_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                        WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                               AND tpr.nopertanggungan = b.nopertanggungan
                               AND b.noagen IN
                                            (SELECT   noagen
                                               FROM   $tabel_agen
                                              WHERE   kdkantor =
                                                         a.kdkantor
                                                      AND kdareaoffice =
                                                            a.kdareaoffice
                                                      AND kdunitproduksi =
                                                			a.kdunitproduksi
                                                      AND kdstatusagen =
                                                            '01'
                                                      AND kdjabatanagen IN ('00','18','05','09') $filterPeriode)
                               AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                               AND status = '2'
                               AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                               AND tpr.kdproduk not in ('JL4BL')
                               AND b.kdpertanggungan = '2'
                               and b.kdproduk not in ('JSSP5')
                          	   AND b.kdstatusfile IN ('1', '4')
                      )
                  	+ (SELECT  NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                        FROM   $DBUser.TABEL_UL_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                        WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                               AND tpr.nopertanggungan = b.nopertanggungan
                               AND b.noagen IN
                                            (SELECT   noagen
                                               FROM   $tabel_agen
                                              WHERE   kdkantor =
                                                         a.kdkantor
                                                      AND kdareaoffice =
                                                            a.kdareaoffice
                                                      AND kdunitproduksi =
                                                			a.kdunitproduksi
                                                      AND kdstatusagen =
                                                            '01'
                                                      AND kdjabatanagen IN ('00','18','05','09') $filterPeriode)
                               AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                               AND status = '2'
                               AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                               AND tpr.kdproduk not in ('JL4BL')
                               AND b.kdpertanggungan = '2'
                               and b.kdproduk not in ('JSSP5')
                          	   AND b.kdstatusfile IN ('1', '4')
                       )
		              + (SELECT   NVL (SUM (NVL (NILAIRP, PREMITAGIHAN)),0)
		                          FROM   $DBUser.TABEL_300_HISTORIS_PREMI b, $DBUser.tabel_200_pertanggungan c
		                          WHERE       b.prefixpertanggungan = c.prefixpertanggungan
		                                  AND b.nopertanggungan = c.nopertanggungan
		                                  AND c.noagen IN
		                                                (SELECT   noagen
		                                                   FROM   $tabel_agen
		                                                   WHERE   kdkantor = a.kdkantor
		                                                           AND kdareaoffice =
		                                                                 a.kdareaoffice
		                                                           AND kdunitproduksi= a.kdunitproduksi
		                                                           AND kdstatusagen =
		                                                                 '01'
		                                                           AND KDJABATANAGEN IN('00','18','05','09') $filterPeriode
		                                                 )
		                                  AND b.kdkuitansi='NB1'
		                                  AND TO_CHAR (tglseatled, 'mmyyyy') =  '".$bulan.$tahun."'
		                                  AND c.KDSTATUSFILE IN ('1','4') AND c.KDPERTANGGUNGAN = '2' and c.kdproduk not in ('JSSP5'))
		          WHEN a.kdjabatanagen = '00'
		          	THEN
	             		(SELECT NVL(SUM(DECODE (kdcarabayar,
	                                   'X', 0.3 * premi1,
	                                   'E', 0.3 * premi1,
	                                   'J', 0.3 * premi1,
	                                   premi1)
	                       			),0)
			               FROM   $DBUser.tabel_200_pertanggungan b
			               WHERE   noagen = a.noagen
			                       AND TO_CHAR (mulas, 'mmyyyy') = '".$bulan.$tahun."'
			                       AND kdpertanggungan = '2'
			                       AND kdstatusfile IN ('1', '4') )
		              	+ (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                            FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK tpr, $DBUser.tabel_200_pertanggungan b
                            WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                   AND tpr.nopertanggungan = b.nopertanggungan
                                   AND b.noagen = a.noagen
                                   AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                   AND TO_CHAR (tpr.tglmutasi, 'mmyyyy') = '".$bulan.$tahun."'
                                   AND tpr.kdproduk not in ('JL4BL')
                                   AND b.kdpertanggungan = '2'
                                   and b.kdproduk not in ('JSSP5')
                              	   AND b.kdstatusfile IN ('1', '4')
                    	)
              	  		+ (SELECT NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                            FROM   $DBUser.TABEL_223_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                            WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                   AND tpr.nopertanggungan = b.nopertanggungan
                                   AND b.noagen = a.noagen
                                   AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                   AND status = '2'
                                   AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                   AND tpr.kdproduk not in ('JL4BL')
                                   AND b.kdpertanggungan = '2'
                                   and b.kdproduk not in ('JSSP5')
                              	   AND b.kdstatusfile IN ('1', '4')
                          )
                      	+ (SELECT  NVL (SUM ( (DECODE(kdbenefit,'BNFTOPUPSG',0.3,1)) * NVL(premi,0) ), 0)
                            FROM   $DBUser.TABEL_UL_TRANSAKSI_TOPUP tpr, $DBUser.tabel_200_pertanggungan b
                            WHERE  tpr.prefixpertanggungan = b.prefixpertanggungan
                                   AND tpr.nopertanggungan = b.nopertanggungan
                                   AND b.noagen = a.noagen
                                   AND tpr.kdbenefit IN('BNFTOPUPSG','BNFTOPUP')
                                   AND status = '2'
                                   AND TO_CHAR (tpr.tgltransfer, 'mmyyyy') = '".$bulan.$tahun."'
                                   AND tpr.kdproduk not in ('JL4BL')
                                   AND b.kdpertanggungan = '2'
                                   and b.kdproduk not in ('JSSP5')
                              	   AND b.kdstatusfile IN ('1', '4')
                          )
		              	+ (SELECT   NVL (SUM (NVL (NILAIRP, PREMITAGIHAN)),0)
		                          FROM   $DBUser.TABEL_300_HISTORIS_PREMI b, $DBUser.tabel_200_pertanggungan c
		                          WHERE       b.prefixpertanggungan = c.prefixpertanggungan
		                                  AND b.nopertanggungan = c.nopertanggungan
		                                  AND c.noagen = a.noagen
		                                  AND b.kdkuitansi='NB1'
		                                  AND TO_CHAR (tglseatled, 'mmyyyy') =  '".$bulan.$tahun."'
		                                  AND c.KDSTATUSFILE IN ('1','4') AND c.KDPERTANGGUNGAN = '2' and c.kdproduk not in ('JSSP5'))
		       END
		          AS premi,
		       B.NILAIPENDAPATAN AS BONUS
		  	FROM $DBUser.TABEL_404_PENDAPATAN_LAIN_AGEN b, $tabel_agen a
		 	WHERE  b.KDKOMISIAGEN = '04'
		       AND TO_CHAR (b.TGLPROSES, 'dd/mm/yyyy') = '".$tgl_proses."/".$bulanProses."/".$tahunProses."'
		       AND a.noagen = b.noagen
		       AND b.kdkantor = '$kantor'
		       $filterPeriode
		";
	//echo $sql;
	$DB2->parse($sql);
	$DB2->execute();
	$i = 1;
	echo "<br><b>DAFTAR AGEN YANG MENDAPAT BONUS PRODUKSI</b><br>";
	echo "<table border=0 cellspacing=4 cellpadding=0 width=1000><tr>";
	echo "<tr bgcolor=#0066CC >";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>NO</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>NO AGEN</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>NAMA AGEN</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>JABATAN</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>PREMI</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>BONUS</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>TGL PROSES</font></span></div></td>";
	echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>STATUS</font></span></div></td>";
	echo "</tr>";
   	while ($bonus=$DB2->nextrow()) {
   		if($bonus["KDAUTHORISASI"] == 1){
   			$statusApproveBonus = "Sudah Divalidasi";
   			$color = '#F2FBEF';
   		}else{
   			$statusApproveBonus = "Belum Divalidasi";
   			$color = '#ff6666';
   		}
		echo "<tr>";
	  	echo "<td bgcolor=#F2FBEF align=center>".$i."</td>";
	  	echo "<td><input type='submit' name='btmanajerial' value='".$bonus["NOAGEN"]."'></td>";
		echo "<td bgcolor=#F2FBEF>".$bonus["NAMAAGEN"]."</td>";
		echo "<td bgcolor=#F2FBEF>".$bonus["NAMAJABATAN"]."</td>";
		echo "<td bgcolor=#F2FBEF align=right>".number_format($bonus["PREMI"],2,",",".")."</td>";
		echo "<td bgcolor=#F2FBEF align=right>".number_format($bonus["BONUS"],2,",",".")."</td>";
		echo "<td bgcolor=#F2FBEF align=center>".$bonus["TGLPROSES"]."</td>";
		echo "<td bgcolor=".$color.">".$statusApproveBonus."</td>";
		echo "</tr>";
		$i++;
	}
	echo "</table>";
?>
<?//=$titletglcari;?>
<?
include('../includes/agen.class.php');
//$pgw->kantor;
$agn = New Agen($userid,$passwd,$noagen);


$sql="select count(*) ada from $DBUser.TABEL_405_PAJAK_KOMISI_AGEN where kdkantor='$kantor' and tglupdated>=to_date('$titletglcari','DD/MM/YYYY')";
$DB->parse($sql);
$DB->execute();
$cek=$DB->nextrow();
IF ($cek["ADA"]>0 && $cek["ADA"]<0){
echo "<h3>Silahkan Pilih Tanggal Lain....(Telah ada proses remunerasi pada tanggal tsb)</h3>"; die; };

 echo "<br><b>ADD REMUNERASI AGEN - ";echo $agn->namaagen; echo "</b><br>";
       echo "<table border=0 cellspacing=4 cellpadding=0 width=750>";
       //echo "<form action='".$PHP_SELF."' method='post'>";
			 echo "<tr bgcolor=#0066CC >";
			 echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>KETERANGAN</font></span></div></td>";
			 echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>NOMOR KONTRAK/POLIS</font></span></div></td>";
			 echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>JUMLAH PENDAPATAN</font></span></div></td>";

			 echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>TANGGAL</font></span></div></td>";
			 echo "<td bgcolor=#0066CC><div align=center><span class=style1><font face=Arial size=2>ACTION</font></span></div></td>";
			 echo "</tr>";
			 echo "<td> <select name=kdkomisi size=1> ";

$exclude_ktr = array("AA","AC","AE","AF","QB","QC","QD","QE","MG","BI");
					if(in_array($kantor, $exclude_ktr))
						 $sql = "select * from $DBUser.TABEL_402_KODE_KOMISI_AGEN WHERE KODE='L' order by NAMAKOMISIAGEN";
					 else
						 $sql = "select * from $DBUser.TABEL_402_KODE_KOMISI_AGEN WHERE KODE='L' and kdkomisiagen <> '41' order by NAMAKOMISIAGEN";
///echo $sql;
  					 $DB->parse($sql);
  					 $DB->execute();
				   //echo "<option value='000' >KOMISI PP</option>";
  				   while($ar1=$DB->nextrow()) {
  					 	 echo "<option value=".$ar1["KDKOMISIAGEN"]." $selected>".$ar1["NAMAKOMISIAGEN"]."</option>";
  					 }
  					 echo "</select></td>";

			echo "<td ><input name='nokontrak' size=20 value='".$ar1["NOKONTRAK"]."' ></td>";
			echo "<td ><input name='nilaikomisi' size=20 value='".$ar1["TRGPOLISNBPPORG"]."' ></td>";
			echo "<td ><input readonly name='tanggalkomisi' size=20 value='".$titletglcari."' ></td>";
			echo "<td><input type='submit' name='btadd' value='ADD'>&nbsp;<input type='reset' name='btreset' value='RESET'></td>";
			echo "</tr>";
		  echo "</table>";

 echo $gagalpk;
 ?>

 <font color="#FF0000">Note : Bantuan Manajerial hanya dibayarkan bagi manajer agen yang sudah berlisensi saja</font>
</br>
 <? echo "<br><b>DAFTAR REMUNERASI YANG AKAN DIBAYARKAN</b><br>";?>
<table border="0" width="750" bgcolor="#C0C0C0" cellspacing="1" cellpadding="2">
		<tr>
      	<td bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">KETERANGAN</font></span></div></td>
        <td bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">JUMLAH REMUNERASI</font></span></div></td>
		<td bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">TANGGAL</font></span></div></td>
		<td bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">ACTION</font></span></div></td>
        </tr>

		<?
$sqlX="SELECT SUM(KOMISIAGENRP) tkom, TO_CHAR(MAX(TGLPROSES),'DD/MM/YYYY') TGLPROSES FROM $DBUser.TABEL_404_KOMISI_AGEN WHERE noagen='$noagen' and kdkomisiagen!='10' and kdauthorisasi='2' and to_char(tglupdated,'DD/MM/YYYY')='$titletglcari'";
$DB->parse($sqlX);
$DB->execute();
$arcom=$DB->nextrow();
//echo $sqlX;
//echo $arcom["TKOM"];
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		KOMISI</td>
		<td style="border-right-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		  <div align="right">
		    <?=number_format($arcom["TKOM"],2,",",".");?>
	      </div></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<?=$arcom["TGLPROSES"];?></td>
		<? //echo "<td align='center'><a href=pendapatanagen.php?mod=ubah&org=up&tah=$tahun&ktrbo=$kantor&noagen=".$arc["NOAGEN"]."&&ktrup=".$ar2["KDUNITPRODUKSI"]."><img border='0' src='../images/edit.gif' width='16' height='16' alt='Update'></a></td>";?>
		 <? echo "<td align='center'></td>";?>
		 </tr>
<?
$sql="select a.kdkomisiagen kdkomisiagen,namakomisiagen, nilaipendapatan, kdauthorisasi,to_char(tglupdated,'DD/MM/YYYY') tglupdated,".
"to_char(tglproses,'DD/MM/YYYY') tglproses,noagen from $DBUser.TABEL_404_PENDAPATAN_LAIN_AGEN a, $DBUser.TABEL_402_KODE_KOMISI_AGEN b where
a.kdkomisiagen=b.kdkomisiagen and noagen='$noagen' and to_char(tglproses,'DD/MM/YYYY')='$titletglcari'";
$DB->parse($sql);
$DB->execute();
//echo $sql.'</br>';
//echo $tglcari;
$i = 1;
   	while ($arc=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<?=$arc["NAMAKOMISIAGEN"];?></td>
		<td style="border-right-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<div align="right"><?=number_format($arc["NILAIPENDAPATAN"],2,",",".");?></div></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<?=$arc["TGLPROSES"];?></td>
		<?
		if ( $arc["KDAUTHORISASI"]=='1') {
		echo "<td></td>";}
		else{
		echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><input type='checkbox' name='box1[]' value=".$arc["NOAGEN"].$arc["KDKOMISIAGEN"].$arc["TGLPROSES"]."></td>";
		}
		?>

		 </tr>
<?	$i++;}
echo "<tr><td></td><td align='center'><input type='submit' name='btsave' value='SUBMIT'><td></td><td align='center'><input type='submit' name='btdel' value='DEL'></td></tr>";?>

</table>

</form>
<hr size="1">
<font face="Verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</font>
</body>
</html>
