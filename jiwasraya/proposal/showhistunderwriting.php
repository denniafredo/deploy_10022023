<? 
  include "../../includes/database.php";
  include "../../includes/common.php";
  include "../../includes/formula44.php";
  include "../../includes/session.php";
  $DB=New database($userid, $passwd, $DBName);
  $prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
?>

<html>
  <head>
    <title>Historis Mutasi Underwriting</title>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
    <link href="../jws.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h4><font face="verdana">HISTORIS MUTASI UNDERWRITING</font></h4>
    <table border="1" width="100%" cellspacing="1" cellpadding="2" style="font-family: 'verdana'; font-size: 12px">
      <tr bgcolor="#C2CAED" align="center">
        <td>NO</td>
        <td>STATUS</td>
        <td>KATEGORI</td>
        <td>KETERANGAN</td>
        <td>USER</td>
        <td>TANGGAL</td>
      </tr>
      <?php
        $sql="SELECT a.userrekam, 
                to_char(a.tglrekam, 'DD/MM/YYYY hh24:mi') tglrekam,
                a.kdstatusemail,
                to_char(a.tglsendemail, 'DD/MM/YYYY hh24:mi') tglsendemail,
                (SELECT to_char(tglunderwriting, 'DD/MM/YYYY hh24:mi') FROM $DBUser.TABEL_214_UNDERWRITING WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan) tglapprove,
                (SELECT userupdated FROM $DBUser.TABEL_214_UNDERWRITING WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan) userapprove
              FROM $DBUser.TABEL_200_PERTANGGUNGAN a
              WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."'
                AND NOPERTANGGUNGAN = '".$nopertanggungan."' 
              ORDER BY tglrekam asc";
        $DB->parse($sql);
        $DB->execute();
        while ($arry=$DB->nextrow()) {
          echo ("<tr>
                  <td align='center'>1</td>
                  <td>Entry SPAJ</td>
                  <td>-</td>
                  <td>-</td>
                  <td>".$arry['USERREKAM']."</td>
                  <td align='center'>".$arry['TGLREKAM']."</td>
                </tr>
          ");
          // if($arry['KDSTATUSEMAIL'] == '1' || $arry['TGLSENDEMAIL'] != NULL){
          //   echo ("
          //     <tr>
          //           <td align='center'>2</td>
          //           <td>Proposal Baru Dikirim</td>
          //           <td>-</td>
          //           <td>-</td>
          //           <td>".$arry['USERREKAM']."</td>
          //           <td align='center'>".$arry['TGLSENDEMAIL']."</td>
          //         </tr>
          //   ");
          // }else{
          //   echo "";
          // }
          
          $userapprove = $arry['USERAPPROVE'];
          $tglapprove = $arry['TGLAPPROVE'];
        }
        $sql="SELECT status, kategoripending, keterangan, userrekam, to_char(tglrekam, 'DD/MM/YYYY hh24:mi')tglrekam, tglrekam as tglrekams FROM $DBUser.TABEL_216_HISTORIS_MUTASI_UW
              WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."'
                AND NOPERTANGGUNGAN = '".$nopertanggungan."' 
              ORDER BY TGLREKAMS ASC ";
        //echo $sql;
        $DB->parse($sql);
        $DB->execute();
        $i=2;
        while ($arr=$DB->nextrow()) {
          echo ("
            <tr>
              <td width ='3%' align='center'>
                ".$i."
              </td>
              <td>
                ".$arr['STATUS']."
              </td>
              <td>
                ".$arr['KATEGORIPENDING']."
              </td>
              <td>
                ".$arr['KETERANGAN']."
              </td>
              <td>
                ".$arr['USERREKAM']."
              </td>
              <td align='center'>
                ".$arr['TGLREKAM']."
              </td>
            </tr>");
          $i++;
        }
        if($tglapprove == ''){
          echo "";
        }else{
          echo ("
            <tr>
              <td align='center'>".$i."</td>
              <td>Approved</td>
              <td>-</td>
              <td>-</td>
              <td>".$userapprove."</td>
              <td align='center'>".$tglapprove."</td>
            </tr>
          ");
        }        
      ?>
    </table>
  </body>
</html>
