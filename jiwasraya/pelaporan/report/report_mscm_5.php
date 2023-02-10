<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  include "../../includes/dropdown_date.php";
  $DB   = new database($DBUser, $DBPass, $DBName);
  $DBD  = new database($DBUser, $DBPass, $DBName);
  $DBL  = new database($DBUser, $DBPass, $DBName);

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=report_mscm_5.xls");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Daftar Jatuh Tempo BPO Polis</title>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
  </head>
  <body>
		<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
      <tr bgcolor="#89acd8" align="center">
        <td rowspan="2">NO</td>    
        <td rowspan="2">RAYON</td>
        <td rowspan="2">NAMA SAM</td>
        <td rowspan="2">KANTOR</td>
        <td colspan="3">JAN</td>
        <td colspan="3">FEB</td>
        <td colspan="3">MAR</td>
        <td colspan="3">APR</td>
        <td colspan="3">MEI</td>
        <td colspan="3">JUNI</td>
        <td colspan="3">JULI</td>
        <td colspan="3">AGT</td>
        <td colspan="3">SPT</td>
        <td colspan="3">OKT</td>
        <td colspan="3">NOV</td>
        <td colspan="3">DES</td>
      </tr>
      <tr bgcolor="#89acd8" align="center">
        <?php
          $months = array('01','02','03','04','05','06','07','08','09','10','11','12');
          foreach ($months as $bln) {
            echo "
              <td>AVG #RIDERS</td>
              <td>AVG #SUM ASSURED</td>
              <td>AVG #AGE</td>
            ";
          }
        ?>
      </tr>
      
  <?
    $sql = "SELECT DISTINCT(JABATAN_TTD) AS RAYON
            FROM $DBUser.TABEL_400_PENANDATANGANAN_PKAJ
            WHERE JABATAN_AGEN = '00'
            ORDER BY RAYON DESC";
  	$DB->parse($sql);
    $DB->execute();
   	while ($arr=$DB->nextrow()) {
      $rayon = $arr["RAYON"];
      echo "
        <tr align='center' style='background-color: yellow'>
          <td colspan='4'>".$rayon."</td>
        </tr>
      ";

      $i = 1;
      $sql_d = "SELECT  
                  SUBSTR(C.JABATAN_TTD, 0, 5) AS RAYON,
                  A.KDKANTOR,
                  'SAM ' || SUBSTR(A.NAMAKANTOR, 23) KANTOR, 
                  B.NO_SAM,
                  (SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN = B.NO_SAM) NM_SAM
              FROM $DBUser.TABEL_001_KANTOR A, 
                  $DBUser.TABEL_400_SAM_KANTOR_MERGE B,
                  $DBUser.TABEL_400_PENANDATANGANAN_PKAJ C
              WHERE A.KDKANTOR = B.KODE_KANTOR
                  AND C.KODE_KANTOR = A.KDKANTOR
                  AND A.KDJENISKANTOR = '2' 
                  AND A.KDKANTOR NOT IN ('KM', 'KN')
                  AND C.JABATAN_AGEN = '00'
                  AND C.JABATAN_TTD = '".$rayon."'
              ORDER BY C.JABATAN_TTD, NM_SAM, A.KDKANTOR ASC";
      $DBD->parse($sql_d);
      $DBD->execute();
      while ($arr_d=$DBD->nextrow()){
  ?>
    <tr align="center">
      <td><?=$i;?></td>
      <td><?=$arr_d["KDKANTOR"];?></td>
      <td align="left"><?=$arr_d["NM_SAM"];?></td>
      <td align="left"><?=$arr_d["KANTOR"];?></td>

      <?php
        $carikantor = $arr_d["KDKANTOR"];

        /* Inisialisasi untuk total polis, ANP dan AVG */
        $total_polis  = 0;
        $total_anp    = 0;

        $months = array('01','02','03','04','05','06','07','08','09','10','11','12');
        foreach ($months as $bln) {

          $sql_l = "SELECT 
                      COUNT(X.NOPOL) POLIS,
                      SUM(
                          (
                            SELECT COUNT(KDBENEFIT)
                            FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK
                            WHERE PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN 
                                AND NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                                AND KDJENISBENEFIT = 'R'
                                AND PREMI IS NOT NULL
                          )
                      )RIDER,
                      SUM(
                          (
                            SELECT SUM(NILAIBENEFIT)
                            FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK
                            WHERE PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN 
                                AND NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                                AND KDJENISBENEFIT = 'R'
                          )
                      )JUA_RIDER,
                      SUM(
                          (
                            SELECT MONTHS_BETWEEN(SYSDATE, TGLLAHIR)/12
                            FROM $DBUser.TABEL_100_KLIEN
                            WHERE NOKLIEN = X.NOPEMEGANGPOLIS
                          )
                      )AGE
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN X,
                          $DBUser.TABEL_500_PENAGIH Y,
                          $DBUser.TABEL_400_AGEN Z
                    WHERE X.NOPENAGIH = Y.NOPENAGIH
                        AND Y.KDRAYONPENAGIH = '".$carikantor."'
                        AND Z.NOAGEN = X.NOAGEN
                        AND Z.KDJABATANAGEN NOT IN ('21', '22')
                        AND X.KDPERTANGGUNGAN ='2' 
                        AND X.KDSTATUSEMAIL = '1' 
                        AND TO_CHAR(X.MULAS, 'MM/YYYY') = '".$bln."/2020'
                        AND X.KDSTATUSFILE NOT IN ('7', 'X', 'C')
                        AND X.KDPRODUK in ('JL4BLN','JL4XN')";
          $DBL->parse($sql_l);
          $DBL->execute();
          while ($arr_l=$DBL->nextrow()){
            if($arr_l["POLIS"] > 0){
              if($arr_l["RIDER"] > 0){
                $avg_rider = $arr_l["RIDER"] / $arr_l["POLIS"];
                $avg_jua_rider = $arr_l["JUA_RIDER"] / $arr_l["POLIS"];
              }else{
                $avg_rider = 0;
                $avg_jua_rider = 0;
              }

              $avg_age = $arr_l["AGE"] / $arr_l["POLIS"];
            }else{
              $avg_rider = 0;
              $avg_jua_rider = 0;
              $avg_age = 0;
            }

            echo "
                  <td>".number_format($avg_rider,2)."</td>
                  <td align='right'>".number_format($avg_jua_rider,0,',','.')."</td>
                  <td>".number_format($avg_age,0)."</td>
                ";
          }
        }
      ?>
    </tr>
  <?php
        $i++;
      }
  ?>
  <?php
    }
 	?>
  </body>
</html>