<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  include "../../includes/dropdown_date.php";
  $DB=new database($DBUser, $DBPass, $DBName);
  $DBD=new database($DBUser, $DBPass, $DBName);

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=report_obr.xls");

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
        <td>No</td>    
    		<td>Rayon RAH</td>
        <td>Rayon</td>
        <td>Nama SAM</td>
        <td>Kantor</td>
        <td>Proposal</td>
        <td>Waiting</td>
        <td>Pending</td>
    		<td>Approve</td>
    		<td>Bayar</td>
        <td>Potensi Premi</td>
      	<td>Potensi ANP</td>
      	<td>Lunas</td>
      	<td>ANP Lunas</td>
      	<td>ANP Belum Lunas</td>
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
      $i = 1;
      $total_proposal       = 0;
      $total_pending        = 0;
      $total_waiting        = 0;
      $total_approve        = 0;
      $total_bayar          = 0;
      $total_potensi_premi  = 0;
      $total_potensi_anp    = 0;
      $total_lunas          = 0;
      $total_anp_lunas      = 0;
      $total_anp_belum_lunas= 0;

      $sql_d = "SELECT  
                  SUBSTR(C.JABATAN_TTD, 0, 5) AS RAYON,
                  A.KDKANTOR,
                  'SAM ' || SUBSTR(A.NAMAKANTOR, 23) KANTOR, 
                  B.NO_SAM,
                  (SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN = B.NO_SAM) NM_SAM,
                  (
                      SELECT 
                          SUM 
                              (CASE
                                  WHEN X.KDSTATUSFILE = '7' AND Y.NOPERTANGGUNGAN IS NULL THEN 0
                                  ELSE 1
                              END)
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X
                      LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL Y ON Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR  
                          AND X.KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(X.TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                  ) PROPOSAL,
                  (
                      SELECT 
                          COUNT(NOPOL) 
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
                          AND KDPERTANGGUNGAN = '1' 
                          AND KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                          AND KDSTATUSFILE != '7'
                          AND SUSPEND IS NULL
                          AND KETERANGAN IS NULL
                          AND PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN NOT IN (SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN FROM $DBUser.TABEL_214_APPROVAL_PROPOSAL)
                  ) WAITING,
                  (
                      SELECT 
                          COUNT(NOPOL) 
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
                          AND KDPERTANGGUNGAN = '1' 
                          AND KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                          AND SUSPEND = '1'
                          AND KETERANGAN IS NOT NULL
                          AND KDSTATUSFILE != '7'
                  ) PENDING,
                  (
                      SELECT 
                          COUNT(X.NOPOL) 
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X, $DBUser.TABEL_214_APPROVAL_PROPOSAL Y
                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR
                          AND X.PREFIXPERTANGGUNGAN = Y.PREFIXPERTANGGUNGAN AND X.NOPERTANGGUNGAN = Y.NOPERTANGGUNGAN 
                          AND X.KDPERTANGGUNGAN = '1' 
                          AND X.KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(X.TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                          --AND X.KDSTATUSFILE != '7'
                  ) APPROVE,
                  (
                      SELECT 
                          COUNT(NOPOL) 
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
                          AND KDPERTANGGUNGAN = '2' 
                          AND KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                          --AND KDSTATUSFILE != '7'
                  ) BAYAR,
                  (
                      SELECT 
                          SUM 
                              (CASE
                                  WHEN X.KDSTATUSFILE = '7' AND Y.NOPERTANGGUNGAN IS NULL THEN 0
                                  ELSE PREMI1
                              END)
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X
                      LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL Y ON Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR  
                          AND X.KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(X.TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                  ) POTENSI_PREMI,
                  (
                      SELECT
                          SUM 
                              (CASE
                                  WHEN X.KDSTATUSFILE = '7' AND Y.NOPERTANGGUNGAN IS NULL THEN 0
                                  ELSE (CASE
                                            WHEN X.KDCARABAYAR = 'M' THEN X.PREMI1 * 12
                                            WHEN X.KDCARABAYAR = 'Q' OR X.KDCARABAYAR = 'K' THEN X.PREMI1 * 4
                                            WHEN X.KDCARABAYAR = 'H' THEN X.PREMI1 * 2
                                            WHEN X.KDCARABAYAR = 'A' THEN X.PREMI1 * 1
                                            WHEN X.KDCARABAYAR = 'X' THEN X.PREMI1 * 0.1
                                        END)
                              END)
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X
                      LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL Y ON Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR  
                          AND X.KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(X.TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                  ) POTENSI_ANP,
                  (
                      SELECT 
                          SUM(PREMI1) 
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
                          AND KDPERTANGGUNGAN = '2' 
                          AND KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                          --AND KDSTATUSFILE != '7'
                  ) LUNAS,
                  (
                      SELECT 
                          SUM(
                              CASE
                                  WHEN KDCARABAYAR = 'M' THEN PREMI1 * 12
                                  WHEN KDCARABAYAR = 'Q' OR KDCARABAYAR = 'K' THEN PREMI1 * 4
                                  WHEN KDCARABAYAR = 'H' THEN PREMI1 * 2
                                  WHEN KDCARABAYAR = 'A' THEN PREMI1 * 1
                                  WHEN KDCARABAYAR = 'X' THEN PREMI1 * 0.1
                              END
                         )
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
                          AND KDPERTANGGUNGAN = '2'
                          AND KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                          --AND KDSTATUSFILE != '7'
                  ) ANP_LUNAS,
                  (
                      SELECT
                          SUM 
                              (CASE
                                  WHEN X.KDSTATUSFILE = '7' AND Y.NOPERTANGGUNGAN IS NULL THEN 0
                                  ELSE (CASE
                                            WHEN X.KDCARABAYAR = 'M' THEN X.PREMI1 * 12
                                            WHEN X.KDCARABAYAR = 'Q' OR X.KDCARABAYAR = 'K' THEN X.PREMI1 * 4
                                            WHEN X.KDCARABAYAR = 'H' THEN X.PREMI1 * 2
                                            WHEN X.KDCARABAYAR = 'A' THEN X.PREMI1 * 1
                                            WHEN X.KDCARABAYAR = 'X' THEN X.PREMI1 * 0.1
                                        END)
                              END)
                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X
                      LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL Y ON Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR
                          AND X.KDPERTANGGUNGAN = '1'  
                          AND X.KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(X.TGLSENDEMAIL, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY')
                  ) ANP_BELUMLUNAS
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
      <td><?=$arr_d["RAYON"];?></td>
      <td><?=$arr_d["KDKANTOR"];?></td>
      <td align="left"><?=$arr_d["NM_SAM"];?></td>
      <td align="left"><?=$arr_d["KANTOR"];?></td>
      <td><?=$arr_d["PROPOSAL"];?></td>
      <td><?=$arr_d["WAITING"];?></td>
      <td><?=$arr_d["PENDING"];?></td>
      <td><?=$arr_d["APPROVE"];?></td>
      <td><?=$arr_d["BAYAR"];?></td>
      <td align="right"><?php echo(number_format($arr_d["POTENSI_PREMI"],0,',','.'));?></td>
      <td align="right"><?php echo(number_format($arr_d["POTENSI_ANP"],0,',','.'));?></td>
      <td align="right"><?php echo(number_format($arr_d["LUNAS"],0,',','.'));?></td>
      <td align="right"><?php echo(number_format($arr_d["ANP_LUNAS"],0,',','.'));?></td>
      <td align="right"><?php echo(number_format($arr_d["ANP_BELUMLUNAS"],0,',','.'));?></td>
    </tr>
  <?php
        $i++;
        $total_proposal       = $total_proposal + $arr_d["PROPOSAL"];
        $total_pending        = $total_pending + $arr_d["PENDING"];
        $total_waiting        = $total_waiting  + $arr_d["WAITING"];
        $total_approve        = $total_approve  + $arr_d["APPROVE"];
        $total_bayar          = $total_bayar + $arr_d["BAYAR"];
        $total_potensi_premi  = $total_potensi_premi + $arr_d["POTENSI_PREMI"];
        $total_potensi_anp    = $total_potensi_anp + $arr_d["POTENSI_ANP"];
        $total_lunas          = $total_lunas + $arr_d["LUNAS"];
        $total_anp_lunas      = $total_anp_lunas + $arr_d["ANP_LUNAS"];
        $total_anp_belum_lunas= $total_anp_belum_lunas + $arr_d["ANP_BELUMLUNAS"];
      }
  ?>
    <tr style="background-color: yellow" align="center">
      <td colspan="5"><?=$rayon;?> TOTAL</td>
      <td><?=$total_proposal;?></td>
      <td><?=$total_waiting;?></td>
      <td><?=$total_pending;?></td>
      <td><?=$total_approve;?></td>
      <td><?=$total_bayar;?></td>
      <td align="right"><?php echo(number_format($total_potensi_premi,0,',','.'));?></td>
      <td align="right"><?php echo(number_format($total_potensi_anp,0,',','.'));?></td>
      <td align="right"><?php echo(number_format($total_lunas,0,',','.'));?></td>
      <td align="right"><?php echo(number_format($total_anp_lunas,0,',','.'));?></td>
      <td align="right"><?php echo(number_format($total_anp_belum_lunas,0,',','.'));?></td>
    </tr>
  <?php
    }
 	?>
  </body>
</html>