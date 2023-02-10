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
        <td>Kanwil</td>
        <td>Kd Kantor</td>
        <td>No Agen</td>
        <td>Nama Agen</td>
        <td>Jabatan</td>
        <td>Area Office</td>
        <td>Unit Produksi</td>
        <td>Nama Prospek</td>
        <td>Alamat Prospek</td>
        <td>Kota Prospek</td>
        <td>No Telp Prospek</td>
        <td>Usia Prospek</td>
        <td>No Proposal</td>
        <td>Produk Proposal</td>
        <td>Cara Bayar</td>
        <td>Premi</td>
        <td>Status Proposal</td>
        <td>Tgl Rekam Proposal</td>
    </tr>

    <?php foreach($rekap as $i => $v) { ?>
        <tr>
            <td><?=$v['KDWILAYAH']?></td>
            <td><?=$v['KDKANTOR']?></td>
            <td class="text"><?="$v[NOAGEN]"?></td>
            <td><?=$v['NAMAKLIEN1']?></td>
            <td><?=$v['NAMAJABATANAGEN']?></td>
            <td><?=$v['NAMAAREAOFFICE']?></td>
            <td><?=$v['NAMAUNITPRODUKSI']?></td>
            <td><?=$v['NAMA']?></td>
            <td><?=$v['ALAMAT']?></td>
            <td><?=$v['KOTA']?></td>
            <td><?="$v[TELP] / $v[HP]"?></td>
            <td><?=$v['USIA_TH']?></td>
            <td><?=$v['NO_PROPOSAL']?></td>
            <td><?=$v['NAMA_PRODUK']?></td>
            <td><?=$v['CARA_BAYAR']?></td>
            <td><?=$v['JUMLAH_PREMI']?></td>
            <td><?=$v['NAMASTATUS']?></td>
            <td><?=$v['TGLREKAM']?></td>
        </tr>
    <?php } ?>
</table>