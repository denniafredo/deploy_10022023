<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=rekap.xls");
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
?>

<style type="text/css">
    .num {
        mso-number-format:General;
    }
    .text{
        mso-number-format:"\@";/*force text*/
    }
</style>

<table border="1">
    <tr>
        <td>Kd Kantor</td>
        <td>Kd Area Office</td>
        <td>Area Office</td>
        <td>Target Polis</td>
        <td>Target Premi</td>
        <td>Realisasi Polis</td>
        <td>Realisasi Premi X</td>
        <td>Realisasi Premi B</td>
        <td>Realisasi Premi BL</td>
        <td>Realisasi Premi Topup</td>
    </tr>

    <?php foreach($rekap as $i => $v) { ?>
        <tr>
            <td><?=$v['KDKANTOR']?></td>
            <td><?=$v['KDAREAOFFICE']?></td>
            <td><?=$v['NAMAAREAOFFICE']?></td>
            <td><?=$v['TRGPOLISNBPPORG']?></td>
            <td><?=$v['TRGPREMINBPPORG']?></td>
            <td><?=$v['REALISASI_POLIS']?></td>
            <td><?=$v['REALISASI_PREMIX']?></td>
            <td><?=$v['REALISASI_PREMIB']?></td>
            <td><?=$v['REALISASI_PREMIBL']?></td>
            <td><?=$v['REALISASI_PREMITOPUP']?></td>
        </tr>
    <?php } ?>
</table>