<?php
include "../../includes/session.php";
include "../../includes/database.php";
$DB = New database($userid, $passwd, $DBName);

$sql = "SELECT b.namadokumen, CASE WHEN a.status = '0' THEN 'X' WHEN a.status = '1' THEN 'V' END status
        FROM $DBUser.tabel_704_cek_dok_spaj a
        INNER JOIN $DBUser.tabel_903_dokumen_klaim b ON a.kddokumen = b.kddokumen
        WHERE nospa = '$nosp'";
$DB->parse($sql);
$DB->execute();
?>

<html>
<head>
    <link type="text/css" href="../../includes/jws.css" rel="stylesheet" />
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
    <title>Daftar Dokumen</title>
</head>
<body>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
    <tr>
        <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO</b></font></td>
        <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>DOKUMEN</b></font></td>
        <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>ADA</b></font></td>
    </tr>

    <?php
    $i = 0;
    while ($arr = $DB->nextrow()) {
        $bgclear = $i%2 == 0 ? null : "bgcolor='#fff'"; ?>
        <tr>
            <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$i+1;?></font></td>
            <td <?=$bgclear?> align="left"><font face="Verdana" size="1"><?=$arr['NAMADOKUMEN'];?></font></td>
            <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$arr['STATUS'];?></font></td>
        </tr>
        <?php $i++;
    } ?>
</table>
</body>
</html>
