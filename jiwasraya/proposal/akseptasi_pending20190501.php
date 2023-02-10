<?php
include "../../includes/session.php";
include "../../includes/database.php";
$DB = New database($userid, $passwd, $DBName);

if ($submit) {
    $sql = "UPDATE $DBUser.tabel_200_pertanggungan SET suspend = 1, keterangan = '$keterangan'
            WHERE prefixpertanggungan = '$prefixpertanggungan'
                AND nopertanggungan = '$nopertanggungan'";
    $DB->parse($sql);
    $DB->execute();
	
	$sql = "INSERT INTO $DBUser.tabel_600_historis_mutasi_pert (tglmutasi, prefixpertanggungan,
				nopertanggungan, kdmutasi, keteranganmutasi, userupdated)
			VALUES (sysdate, '$prefixpertanggungan', '$nopertanggungan', '42', '$keterangan', '$userid')";
	$DB->parse($sql);
    $DB->execute();
	
	$sql = "DELETE FROM $DBUser.tabel_600_historis_mutasi_pert
			WHERE prefixpertanggungan = '$prefixpertanggungan'
				AND nopertanggungan = '$nopertanggungan'
				AND kdmutasi = '26'
				AND TO_CHAR(tglmutasi,'ddmmyyyy') = TO_CHAR(sysdate,'ddmmyyyy')";
	$DB->parse($sql);
    $DB->execute();
	
	echo "<script type='text/javascript'>
		window.opener.location.reload(false);
		window.close();
	</script>";
}

$sql = "SELECT keterangan
        FROM $DBUser.tabel_200_pertanggungan
        WHERE prefixpertanggungan = '$prefixpertanggungan'
            AND nopertanggungan = '$nopertanggungan'";
$DB->parse($sql);
$DB->execute();
$r = $DB->nextrow();
?>

<html>
<head>
    <link type="text/css" href="../../includes/jws.css" rel="stylesheet" />
    <link type="text/css" href="../jquery/demos.css" rel="stylesheet" />
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
    <title>Tunda Proposal <?="$prefixpertanggungan-$nopertanggungan"?></title>
</head>

<body>
    <font face="Verdana" size="2"><b>TUNDA PROPOSAL <?="$prefixpertanggungan-$nopertanggungan"?></b></font><br>
    <hr size=1>

    <form name="prop" action="<?=$PHP_SELF?>" method="get">
        <input type="hidden" name="prefixpertanggungan" value="<?=$prefixpertanggungan?>" />
        <input type="hidden" name="nopertanggungan" value="<?=$nopertanggungan?>" />
        <table border="0" width="600" bgcolor="#006699" cellspacing="0" cellpadding="6" style='border:1px solid #006699;'>
            <tr>
                <td align="center" bgcolor="#627EB5">
                    <font face="Verdana" size="2" color="#fff"><b>ALASAN PROPOSAL DI PENDING</b></font>
                </td>
            </tr>
            <tr>
                <td bgcolor="#DAE2EF">
                    <textarea name="keterangan" rows="5" style="width:100%;" maxlength="150" placeholder="Maksimal 150 karakter" <?=$disable==1?'disabled':null;?>><?=$r['KETERANGAN']?></textarea>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#E4E4E4">
                    <?php if ($disable != '1') { ?>
						<input type="submit" value="SUBMIT" name="submit" style="font-size: 8pt; font-family: Verdana"> 
					<?php } ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
