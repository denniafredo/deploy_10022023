<?php
    include "../../includes/session.php";
    include "../../includes/database.php";
    include "../../includes/fungsi.php";
    //include "mysqldatabase.php";

    $DB = New database($userid, $passwd, $DBName);

    $jmldata = 20;
    $p = !empty($_GET['p']) ? $_GET['p'] : 1;
    $formname=(!$a) ? "ntryprop" : $a;

    $sql = "SELECT kdkantor, namakantor FROM $DBUser.tabel_001_kantor WHERE kdjeniskantor='2' AND kdkantor = '$kantor' ORDER BY kdkantor";
    $DB->parse($sql);
    $DB->execute();
    $arrkantor = $DB->nextrow();
?>

<html>
<head>
    <title>SPAJ List</title>
    <link href="../.../includes/jws2005.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../includes/font-awesome/css/font-awesome.min.css" media="all" />
    <style type="text/css">
        table.detail tr th {
            font: 11px Verdana, sans-serif;
            font-weight: bold;
            padding: 5px 0;
            border: 1px solid #fff;
            background-color: #f89aa4;
        }
        table.detail tr td {
            border: 1px solid #f89aa4;
        }
        .btn-opsi {
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #6b00c7;
            color: #db4545;
            background-color: Transparent;
            background-repeat:no-repeat;
            outline:none;
            padding: 4px 1px;
        }
    </style>
    </style>
    <script language="JavaScript" type="text/javascript" src="../../includes/jquery.min.js" ></script>
    <script type='text/javascript'>
        $(document).ready(function () {
            $("input[name='kode_booking']").focus();
        });
    </script>
</head>
<body>
    <form id="porm" name="porm" method="get" action="<?echo $PHP_SELF;?>">
    <table width="100%" cellpadding="4" cellspacing="0" >
        <tr bgcolor="#f89aa4">
            <td>Kode Booking : &nbsp;
                <input type="text" name="kode_booking" size="8" value="<?echo strtoupper($kode_booking);?>">

                Rayon
                <select name=kdkantor class=select2>
                    <option value="<?=$arrkantor['KDKANTOR']?>"><?="$arrkantor[KDKANTOR] - $arrkantor[NAMAKANTOR]"?></option>
                </select>
            </td>
        </tr>
    </table>
    </form>
    <br>

    <table width="100%" style='border-top:1px solid #f89aa4;'>
        <tr>
            <td align='center'><b>DAFTAR PENGAJUAN POLIS KANTOR  <?="$arrkantor[KDKANTOR] - $arrkantor[NAMAKANTOR]"?></b></td>
        </tr>
    </table>

    <table class="detail" width="100%" cellpadding="2" cellspacing="0">
        <tr>
            <th align="center" width='30px'><b>No</b></td>
            <th align="center" width='100px'><b>Kode Booking</b></td>
            <th align="center" width='120px'><b>Tanggal Booking</b></td>
            <th align="center"><b>Nama CPP</b></td>
            <th align="center" width="150px"><b>KTP</b></td>
            <th align="center"><b>TTL</b></td>
            <th align="center" width="100px"><b>Jenis Kelamin</b></td>
            <th align="center" width='120px'><b>HP</b></td>
            <th align="center"><b>Alamat</b></td>
            <th align="center"><b>Premi</b></td>
            <th align="center" width="40px"><b>Opsi</b></td>
        </tr>
        <?php
        if ($kantor == 'KN') {
            $offset = ($p - 1) * $jmldata;

            /* Direct konek ke database mysql
            $sql = "SELECT a.kode_booking, date_format(a.tanggal_booking, '%d/%m/%Y') AS tanggal_booking, b.nama_lengkap, 
                        b.no_identitas, b.tempat_lhir, date_format(b.tanggal_lhir, '%d/%m/%Y') AS tanggal_lhir, b.jenkel, 
                        b.no_telp, b.alamat, a.nilai_premi, '0000000000' AS no_agen, concat('N', a.kode_booking) no_spaj
                    FROM polis a
                    INNER JOIN nasabah b ON a.id_nasabah = b.id
                    ORDER BY a.create_at DESC
                    LIMIT $offset, $jmldata";
            $hasil = mysql_query($sql);
            $i=0;
            while ($r = mysql_fetch_array ($hasil)) { $i++;?>
                <tr>
                    <td align="center"><?=$i+$offset?></td>
                    <td><?=$r['kode_booking']?></td>
                    <td align="center"><?=$r['tanggal_booking']?></td>
                    <td><?=$r['nama_lengkap']?></td>
                    <td align="center"><?=$r['no_identitas']?></td>
                    <td><?="$r[tempat_lhir], $r[tanggal_lhir]"?></td>
                    <td align="center"><?=$r['jenkel']?></td>
                    <td><?=$r['no_telp']?></td>
                    <td><?=$r['alamat']?></td>
                    <td align="right"><?=idNumberFormat($r['nilai_premi'], 0)?></td>
                    <td align="center">
                        <button type="button" class="btn-opsi" title="Proses" onclick="javascript:window.opener.document.<?=$formname?>.nosp.value='<?=$r['no_spaj']?>'; javascript:window.opener.document.<?=$formname?>.noagen.value='<?=$r['no_agen']?>';window.opener.cekbentukdataklien('<?=$r['no_spaj']?>');window.close();"><i class="fa fa-hand-grab-o fa-lg"></i></button>
                    </td>
                </tr>
            <?php }*/

            // Get data from API
            $data = json_decode(file_get_contents("http://elife.jiwasraya.co.id/jsmobileapi/spaj.php?r=1&p=$p&p2=$kode_booking&p3=$jmldata"), true);
            foreach ($data as $i => $r) { ?>
                <tr>
                    <td align="center"><?=$i+1+$offset?></td>
                    <td><?=$r['kode_booking']?></td>
                    <td align="center"><?=$r['tanggal_booking']?></td>
                    <td><?=$r['nama_lengkap']?></td>
                    <td align="center"><?=$r['no_identitas']?></td>
                    <td><?="$r[tempat_lhir], $r[tanggal_lhir]"?></td>
                    <td align="center"><?=$r['jenkel']?></td>
                    <td><?=$r['no_telp']?></td>
                    <td><?=$r['alamat']?></td>
                    <td align="right"><?=idNumberFormat($r['nilai_premi'], 0)?></td>
                    <td align="center">
                        <button type="button" class="btn-opsi" title="Proses" onclick="javascript:window.opener.document.<?=$formname?>.nosp.value='<?=$r['no_spaj']?>'; javascript:window.opener.document.<?=$formname?>.noagen.value='<?=$r['no_agen']?>';window.opener.cekbentukdataklien('<?=$r['no_spaj']?>');window.close();"><i class="fa fa-hand-grab-o fa-lg"></i></button>
                    </td>
                </tr>
            <?php }


            /* Direct connect ke database
            $sql = "SELECT COUNT(a.kode_booking) AS total
                    FROM polis a
                    INNER JOIN nasabah b ON a.id_nasabah = b.id";
            $hasil = mysql_query($sql);
            $r = mysql_fetch_array($hasil);*/

            // Get all data from API
            $r = json_decode(file_get_contents("http://elife.jiwasraya.co.id/jsmobileapi/spaj.php?r=2&p2=$kode_booking"), true);
            $makspage = ceil($r['total']/$jmldata);
            ?>

            <!-- Pagination -->
            <tr bgcolor="#f89aa4">
                <th colspan="11">
                    <a href="popup_elife.php?p=1" class="btn-opsi" style="padding:2px 5px;"><i class="fa fa-angle-double-left fa-lg"></i></a>
                    <?php
                    if (($p <=5 && $makspage <= 5) || $makspage <= 8) {
                        for ($i=1;$i<=$makspage;$i++) {
                            if ($i==$p) { ?>
                                <a href="javascript:void(0);" class="btn-opsi" style="padding:2px 6px;text-decoration:none;background-color:#fff;cursor:default;"><?=$i?></a>
                            <?php } else { ?>
                                <a href="popup_elife.php?p=<?=$i?>" class="btn-opsi" style="padding:2px 6px;text-decoration:none;"><?=$i?></a>
                            <?php }
                        }
                    } else if ($p <= 5 && $makspage > 8) {
                          for ($i=1;$i<=9;$i++) {
                              if ($i==$p) { ?>
                                <a href="javascript:void(0);" class="btn-opsi" style="padding:2px 6px;text-decoration:none;background-color:#fff;cursor:default;"><?=$i?></a>
                            <?php } else { ?>
                                <a href="popup_elife.php?p=<?=$i?>" class="btn-opsi" style="padding:2px 6px;text-decoration:none;"><?=$i?></a>
                            <?php }
                        }
                    } else if ($p >= $makspage-4) {
                        for ($i=$makspage-8;$i<=$makspage;$i++) {
                            if ($i==$p) { ?>
                                <a href="javascript:void(0);" class="btn-opsi" style="padding:2px 6px;text-decoration:none;background-color:#fff;cursor:default;"><?=$i?></a>
                            <?php } else { ?>
                                <a href="popup_elife.php?p=<?=$i?>" class="btn-opsi" style="padding:2px 6px;text-decoration:none;"><?=$i?></a>
                            <?php }
                        }
                    } else {
                        for ($i=$p-4;$i<=$p+4;$i++) {
                            if ($i==$p) { ?>
                                <a href="javascript:void(0);" class="btn-opsi" style="padding:2px 6px;text-decoration:none;background-color:#fff;cursor:default;"><?=$i?></a>
                            <?php } else { ?>
                                <a href="popup_elife.php?p=<?=$i?>" class="btn-opsi" style="padding:2px 6px;text-decoration:none;"><?=$i?></a>
                            <?php }
                        }
                    }
                    ?>
                    <a href="popup_elife.php?p=<?=$makspage?>" class="btn-opsi" style="padding:2px 5px;"><i class="fa fa-angle-double-right fa-lg"></i></a>
                </th>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
