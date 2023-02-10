<?
include "../../includes/database.php";
include "../../includes/session.php";
include "../../includes/tanggal.php";
$DB=new database($userid, $passwd, $DBName);

// Jika di approve atau di reject
if ($_GET['approve'] || $_GET['reject']) {
	$status = $approve ? 1 : null;
	$status = $reject ? 'X' : $status;
	$sql = "UPDATE $DBUser.tabel_901_pengajuan_redempt_ol SET status = '$status', user_update ='$userid', tgl_update = sysdate, user_proses ='$userid' WHERE confirmid = '$_GET[confirmid]' AND status = '0'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
}
?>

<html>
    <title>Informasi Status Redemption Online</title>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
    <style type="text/css">
        <!--
        body{
            font-family: tahoma,verdana,geneva,sans-serif;
            font-size: 12px;
        }

        td{
            font-family: tahoma,verdana,geneva,sans-serif;
            font-size: 11px;
        }

        input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
        select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
        textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

        a {
            color:#259dc5;
            text-decoration:none;
        }

        a:hover {
            color:#cc6600;
        }
        .btn-opsi {
            cursor: pointer;
            border: none;
            background-color: Transparent;
            background-repeat:no-repeat;
            outline:none;
            padding: 0px;
            font-weight: bold;
        }
        -->
    </style>
<head></head>
<body>
    <h4>Pemeriksaan Proses Redemption Online</h4>

    <form action="<? $PHP_SELF; ?>" method="get" name="memreg">
        <table cellpadding="1" cellspacing="2">
            <tr>
                <td align="left">Bulan Pengajuan</td>
                <td>:</td>
                <td><? ShowFromDate(10,"Past"); ?></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="left">&nbsp;&nbsp;&nbsp;<input name="cari" value="Periksa Status" type="submit"></td>
            </tr>
        </table>
    </form>

    <hr size="1">

    <form action="<? $PHP_SELF; ?>" method="post">
    <table border="0" width="100%" cellspacing="1" cellpadding="2">
        <tr bgcolor="#7dc2d9">
            <td align="center" height="20">No</td>
            <td align="center" width="60">Confirm ID</td>
            <td align="center" width="40">Rayon</td>
            <td align="center">No.Polis</td>
            <td align="center">Produk</td>
            <td align="center">Jenis</td>
            <td align="center">Fund</td>
            <td align="center">Jumlah</td>
            <td align="center" width="120">Tanggal</td>
            <td align="center">Penerima | No Rek | Bank | Cabang</td>
            <td align="center" width="120">Proses</td>
        </tr>
        <?php
        $where = $month == 'all' ? '' : "WHERE TO_CHAR(a.tgl_pengajuan, 'mmyyyy') = '$month$year'";
        $sql = "SELECT a.prefixpertanggungan, a.nopertanggungan, b.kdproduk, a.kode_jenis kodejenis, 
                    CASE WHEN a.kode_jenis = 'U' THEN 'Unit' WHEN a.kode_jenis = 'R' THEN 'Rupiah' END namajenis, 
                    a.kode_fund kodefund, c.namafund, jumlah, TO_CHAR(a.tgl_pengajuan, 'dd/mm/yyyy hh24:mi:ss') tglpengajuan, 
                    a.penerima, a.rekening, a.bank, a.cabang, a.status, a.user_proses userproses, a.confirmid, d.kdrayonpenagih
                FROM $DBUser.tabel_901_pengajuan_redempt_ol a
                INNER JOIN $DBUser.tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan
                    AND a.nopertanggungan = b.nopertanggungan
                LEFT OUTER JOIN $DBUser.tabel_ul_kode_fund c ON a.kode_fund = c.kdfund
                INNER JOIN $DBUser.tabel_500_penagih d ON b.nopenagih = d.nopenagih
                $where
                ORDER BY a.tgl_pengajuan";
        $DB->parse($sql);
        $DB->execute();
        $i = 1;
        while ($r=$DB->nextrow()) {
            echo "<input type='hidden' name='confirmid' value='$r[CONFIRMID]' />";
            echo "<tr bgcolor=#".($i % 2 ? "d5e0fd" : "d5e7fd").">"; ?>
                <td align="center"><?=$i?></td>
                <td align="center"><?=$r['CONFIRMID']?></td>
                <td align="center"><?=$r['KDRAYONPENAGIH']?></td>
                <td><?="$r[PREFIXPERTANGGUNGAN]-$r[NOPERTANGGUNGAN]"?></td>
                <td align="center"><?=$r['KDPRODUK']?></td>
                <td><?="($r[KODEJENIS]) $r[NAMAJENIS]"?></td>
                <td><?="($r[KODEFUND]) $r[NAMAFUND]"?></td>
                <td align="right"><?=number_format($r['JUMLAH'],2)?></td>
                <td align="center"><?=$r['TGLPENGAJUAN']?></td>
                <td><?="$r[PENERIMA] | $r[REKENING] | $r[BANK] | $r[CABANG]"?></td>
                <td align="center">
                    <? if ($r['STATUS'] == '0') {
						echo "<a href=\"#\" onclick=\"window.location.replace('inforedemponline.php?month=$month&year=$year&approve=1&confirmid=$r[CONFIRMID]')\">Approve</a> | <a href=\"#\" onclick=\"window.location.replace('inforedemponline.php?month=$month&year=$year&reject=1&confirmid=$r[CONFIRMID]')\">Reject</a>";
                    } else if ($r['STATUS'] == 'X') {
                        echo "Reject by $r[USERPROSES]";
                    } else if ($r['STATUS'] == '1') {
                        echo "Approve by $r[USERPROSES]";
                    } ?>
                </td>
            </tr>
        <?php $i++; } ?>
    </table>
    </form>
</body>
</html>