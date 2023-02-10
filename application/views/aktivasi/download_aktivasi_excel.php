<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=rekapaktivasi.xls");
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
        <td>No Aktivasi</td>
        <td>Kd Kantor</td>
        <td>Kd Area Office</td>
        <td>Area Office</td>
        <td>Jenis Kegiatan</td>
        <td>Deskripsi Kegiatan</td>
        <td>Tempat Kegiatan</td>
        <td>Waktu Pelaksanaan Awal</td>
        <td>Waktu Pelaksanaan Akhir</td>
        <td>Potensi Premi Berkala</td>
        <td>Potensi Premi Sekaligus</td>
        <td>No Agen</td>
        <td>Nama Agen</td>
        <td>No SPAJ</td>
        <td>Tgl SPAJ</td>
        <td>Nama Calon PP</td>
        <td>Premi SPAJ</td>
        <td>No Polis</td>
        <td>Pemegang Polis</td>
        <td>Kode Produk</td>
        <td>Tgl Akseptasi</td>
        <td>Premi BP3</td>
    </tr>

    <?php
    $totalpremispaj = 0;
    $totalpremipolis = 0;
    $nosp = null;
    foreach($aktivasi as $i => $v) {
        // Membuang data spaj yang duplikasi
        $nosp = ($i > 0) ? ($aktivasi[$i]['NOSP'] != $aktivasi[$i-1]['NOSP'] ? $v['NOSP'] : null) : $v['NOSP'];
        $tglsp = ($i > 0) ? ($aktivasi[$i]['TGLSPAJ'] != $aktivasi[$i-1]['TGLSPAJ'] ? $v['TGLSPAJ'] : null) : $v['TGLSPAJ'];
        $pempolsp = ($i > 0) ? ($aktivasi[$i]['NAMAPEMPOLSP'] != $aktivasi[$i-1]['NAMAPEMPOLSP'] ? $v['NAMAPEMPOLSP'] : null) : $v['NAMAPEMPOLSP'];
        $premisp = ($i > 0) ? ($aktivasi[$i]['PREMISP'] != $aktivasi[$i-1]['PREMISP'] ? $v['PREMISP'] : null) : $v['PREMISP'];
        $totalpremispaj += str_replace(',','.',$premisp);
        $totalpremipolis += str_replace(',','.',$v['NILAIRP']);
        ?>
        <tr>
            <td><?=$v['NOAKTIVASI']?></td>
            <td align="center"><?=$v['KDKANTOR']?></td>
            <td align="center"><?=$v['KDAREAOFFICE']?></td>
            <td><?=$v['NAMAAREAOFFICE']?></td>
            <td><?=$v['JNSKEGIATAN']?></td>
            <td><?=$v['DESKRIPSIKEGIATAN']?></td>
            <td><?=$v['TEMPATKEGIATAN']?></td>
            <td align="center"><?=$v['WKTUPELAKSANAANAWAL']?></td>
            <td align="center"><?=$v['WKTUPELAKSANAANAKHIR']?></td>
            <td align="right"><?=$v['POTENSIPREMIBERKALA']?></td>
            <td align="right"><?=$v['POTENSIPREMISEKALIGUS']?></td>
            <td><?=$v['NOAGEN']?></td>
            <td><?=$v['NAMAAGEN']?></td>
            <td><?=strlen($nosp) > 0 ? "'$nosp" : $nosp?></td>
            <td align="center"><?=$tglsp?></td>
            <td><?=$pempolsp?></td>
            <td align="right"><?=$premisp?></td>
            <td><?=(!empty($v['NOPERTANGGUNGAN']) ? "$v[PREFIXPERTANGGUNGAN]-$v[NOPERTANGGUNGAN]" : null)?></td>
            <td><?=$v['NAMAPEMEGANGPOLIS']?></td>
            <td><?=$v['KDPRODUK']?></td>
            <td align="center"><?=$v['TGLACCEPTANCE']?></td>
            <td align="right"><?=$v['NILAIRP']?></td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="14">Total</td>
        <td><?=$totalpremispaj?></td>
        <td colspan="3"></td>
        <td><?=$totalpremipolis?></td>
    </tr>
</table>