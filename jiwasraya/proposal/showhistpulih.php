<? 
  include "../../includes/database.php";
  include "../../includes/common.php";
  include "../../includes/session.php";
  $DB=New database($userid, $passwd, $DBName);
  $prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
?>

<html>
  <head>
    <title>Historis Mutasi Pulih</title>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
    <link href="../jws.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h4><font face="verdana">HISTORIS MUTASI PULIH</font></h4>
    <table border="1" width="100%" cellspacing="1" cellpadding="2" style="font-family: 'verdana'; font-size: 12px">
      <tr bgcolor="#C2CAED" align="center">
        <td>NO</td>
        <td>STATUS</td>
        <td>KETERANGAN</td>
        <td>USER</td>
        <td>TANGGAL</td>
      </tr>
      <?php
        $sql="SELECT status, keterangan, userrekam, to_char(tglrekam, 'DD/MM/YYYY hh24:mi')tglrekam, tglrekam as tglrekams FROM $DBUser.TABEL_716_HISTORIS_MUTASI_PUL
              WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."'
                AND NOPERTANGGUNGAN = '".$nopertanggungan."' 
              ORDER BY TGLREKAMS ASC ";
        //echo $sql;
        $DB->parse($sql);
        $DB->execute();
        $i=1;
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
      ?>
    </table>
  </body>
</html>
