<?php
    include "../../includes/session.php";
    include "../../includes/database.php";
    include "../../includes/kantor.php";
    include "../../includes/fungsi.php";

    $DB = new database($userid, $passwd, $DBName);

    /*===== Fungsi untuk membentuk tanggal dengan parameter berapa tahun kebelakang =====*/
    function ShowFromDate($year_interval, $YearIntervalType) {
        GLOBAL $month,$year;

        //MONTH
        echo "<select name=month>\n";
        $i=1;
        $CurrMonth=date("m");
        while ($i <= 12) {
            switch($i) {
                case 1: $namabulan = "JANUARI"; break;
                case 2: $namabulan = "PEBRUARI"; break;
                case 3: $namabulan = "MARET"; break;
                case 4: $namabulan = "APRIL"; break;
                case 5: $namabulan = "MEI"; break;
                case 6: $namabulan = "JUNI"; break;
                case 7: $namabulan = "JULI"; break;
                case 8: $namabulan = "AGUSTUS"; break;
                case 9: $namabulan = "SEPTEMBER"; break;
                case 10: $namabulan = "OKTOBER"; break;
                case 11: $namabulan = "NOVEMBER"; break;
                case 12: $namabulan = "DESEMBER"; break;
                default : $namabulan = $i;
            }

            If(IsSet($month)) {
                If($month == $i || ($i == substr($month,1,1) && (substr($month,0,1) == 0))) {
                    $n = (strlen($i)==1) ? "0$i" : "$i";
                    echo "<option value=$n selected>$namabulan\n";
                    $i++;
                }Else{
                    If($i<10) {
                        echo "<option value=0$i>$namabulan\n";
                    }Else {
                        echo "<option value=$i>$namabulan\n";
                    }
                    $i++;
                }
            }Else {
                If($i == $CurrMonth) {
                    If($i<10) {
                        echo "<option value=0$i selected>$namabulan\n";
                    }Else {
                        echo "<option value=$i selected>$namabulan\n";
                    }
                }Else {
                    If($i<10){
                        echo "<option value=0$i>$namabulan\n";
                    }Else {
                        echo "<option value=$i>$namabulan\n";
                    }
                }
                $i++;
            }
        }

        echo "<option value=all ".($month=="all" ? "selected" : "").">--ALL--</option>";
        echo "</select>\n";

        //YEAR
        echo "<select name=year>\n";
        $CurrYear=date("Y");

        If($YearIntervalType == "Past") {
            $i=$CurrYear-$year_interval+1;
            while ($i <= $CurrYear)
            {
                If($i == $year) {
                    echo "<option selected> $i\n";
                }ElseIf ($i == $CurrYear && !IsSet($year)) {
                    echo "<option selected> $i\n";
                }Else {
                    echo "<option> $i\n";
                }
                $i++;
            }
            echo "</select>\n";
        }
        If($YearIntervalType == "Future") {
            $i=$CurrYear+$year_interval;
            while ($CurrYear < $i)
            {
                if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
                $CurrYear++;
            }
            echo "</select>\n";
        }
        If($YearIntervalType == "Both") {
            $i=$CurrYear-$year_interval+1;
            while ($i < $CurrYear+$year_interval)
            {
                if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
                $i++;
            }
            echo "</select>\n";
        }
    }
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Laporan Pinjaman Polis PP</title>

        <script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>

        <style type="text/css">
            body { font-family: tahoma,verdana,geneva,sans-serif; font-size: 12px; }

            td { font-family: tahoma,verdana,geneva,sans-serif; font-size: 11px; }

            input {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
            select {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
            textarea {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

            a { color:#259dc5; text-decoration:none; }
            a:hover {  color:#cc6600; }
        </style>
    </head>
    <body>
        <form action="<? $PHP_SELF; ?>" method="post" name="memreg">
        <table cellpadding="1" cellspacing="2" border="0">
            <tr>
                <td align="left">Bulan</td>
                <td><? ShowFromDate(10,"Past"); ?></td>
                <td>Kantor</td>
                <td>
                    <?php
                    $sql = "select kdkantor,namakantor 
                            from $DBUser.tabel_001_kantor 
                            where kdjeniskantor='2'
                            order by kdkantor";
                    $DB->parse($sql);
                    $DB->execute();
                    ?>
                    <input type="hidden" name="kdkantor" value="<?=$kantor?>" />
                    <select name="kdkantor" <?=($kantor != 'KP' ? 'disabled' : null)?>>
                        <option value='all'>SELURUH KANTOR</option>
                        <?php while ($r = $DB->nextrow()) {
                            $selected = ($kantor == 'KP' && $r['KDKANTOR'] == $kdkantor) || ($kantor != 'KP' && $kantor == $r['KDKANTOR']) ? 'selected' : null; ?>
                            <option value="<?=$r['KDKANTOR']?>" <?=$selected?>><?="$r[KDKANTOR] - $r[NAMAKANTOR]"?></option>
                        <?php } ?>
                    </select>
                </td>
                <td></td>

                <td>Jenis Gadai</td>
                <td>
                    <select name="kdjenisgadai">
                        <option value="0" <?=$kdjenisgadai=='0' ? 'selected' : null;?>>(*) All</option>
                        <option value="1" <?=$kdjenisgadai=='1' ? 'selected' : null;?>>Gadai Baru</option>
                        <option value="2" <?=$kdjenisgadai=='2' ? 'selected' : null;?>>Gadai Lama</option>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td valign="top">
                    <fieldset>
                        <legend>Status Polis</legend> <?php
                        $sql = "select kdstatusfile,namastatusfile 
                                from $DBUser.tabel_299_status_file
                                WHERE kdstatusfile NOT IN ('X', '7', '2', 'A', 'B', 'C')
                                order by namastatusfile";
                        $DB->parse($sql);
                        $DB->execute();
                        $arrstatuspolis = $DB->result();
                        foreach ($arrstatuspolis as $i => $r) {
                            $checked = $r["KDSTATUSFILE"] == $cb1 || $r["KDSTATUSFILE"] == $cb2 || $r["KDSTATUSFILE"] == $cb3 || $r["KDSTATUSFILE"] == $cb4 || $r["KDSTATUSFILE"] == $cb5 || $r["KDSTATUSFILE"] == $cb6 || $r["KDSTATUSFILE"] == $cb7 || $r["KDSTATUSFILE"] == $cb8|| $r["KDSTATUSFILE"] == $cb9 || $r["KDSTATUSFILE"] == $cbX || $r["KDSTATUSFILE"] == $cbL ? 'checked' : null;
                            echo "<label><input type='checkbox' name='cb$r[KDSTATUSFILE]' value='$r[KDSTATUSFILE]' $checked>($r[KDSTATUSFILE]) $r[NAMASTATUSFILE]</label></br>";
                        } ?>
                    </fieldset>
                </td>
                <td></td>
                <td valign="top">
                    <fieldset>
                        <legend>Status Gadai</legend> <?
                        $sql = "select kdstatus, namastatus 
                                from $DBUser.tabel_999_kode_status 
                                where jenisstatus='GADAI' AND kdstatus != 'P'
                                order by kdstatus";
                        $DB->parse($sql);
                        $DB->execute();
                        $arrstatusgadai = $DB->result();
                        foreach ($arrstatusgadai as $i => $r) {
                            $checked = $r["KDSTATUS"] == $cs0 || $r["KDSTATUS"] == $cs1|| $r["KDSTATUS"] == $cs2 || $r["KDSTATUS"] == $cs3 || $r["KDSTATUS"] == $cs4 || $r["KDSTATUS"] == $cs5 ? 'checked' : null;
                            echo "<label><input type='checkbox' name='cs$r[KDSTATUS]' value='$r[KDSTATUS]' $checked>($r[KDSTATUS]) $r[NAMASTATUS]</label></br>";
                        } ?>
                    </fieldset>
                </td>
                <td valign="top">
                    <fieldset>
                        <legend>Valuta</legend> <?
                        $sql = "select kdvaluta,namavaluta 
                                from $DBUser.tabel_304_valuta 
                                union 
                                select '2' kdvaluta,'DOLLAR GADAI RUPIAH' namavaluta 
                                from dual";
                        $DB->parse($sql);
                        $DB->execute();
                        $arrvaluta = $DB->result();
                        foreach ($arrvaluta as $i => $r) {
                            $checked = $r["KDVALUTA"] == $cv0 || $r["KDVALUTA"] == $cv1 || $r["KDVALUTA"] == $cv2 || $r["KDVALUTA"] == $cv3 || $r["KDVALUTA"] == $cv4 || $r["KDVALUTA"] == $cv5 ? 'checked' : null;
                            echo "<label><input type='checkbox' name='cv$r[KDVALUTA]' value='$r[KDVALUTA]' $checked>($r[KDVALUTA]) $r[NAMAVALUTA]</label></br>";
                        } ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="7"><input name="cari" value="Tampilkan" type="submit"></td>
            </tr>
        </table>

        <hr size="1">

        <table border="0" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#C0C0C0">
            <tr>
                <td colspan="2">PT. ASURANSI JIWA IFG<br>
                    <? $KTR = new Kantor($userid,$passwd,$kantor);
                    echo $KTR->namakantor;
                    ?><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p align="center">
                        <b>LAMPIRAN NERACA PINJAMAN POLIS PERTANGGUNGAN PERORANGAN <?=$kdjenisgadai=="1" ? "(GADAI LAMA)" : "";?></b>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="200">KODE REKENING</td>
                <td width="90%">: <?
                    $korek = $cv0 == '0' ? '117120000/125212100' : null;
                    $korek .= $cv1 == '1' ? '; 117110000/125211100' : null;
                    $korek .= $cv2 == '2' ? '; 117140000/125213700' : null;
                    $korek .= $cv3 == '3' ? '; 117130000/125213100' : null;
                    echo $korek; ?>
                </td>
            </tr>
            <tr>
                <td>NAMA REKENING</td>
                <td>: <?
                    $sql = $cv0 == '0' ?
                        "SELECT '117120000', 
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '117120000') namapokok,
                            '125212100',
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '125212100') namabunga
                        FROM DUAL " : null;
                    $sql .= $cv1 == '1' ?
                        "UNION 
                        SELECT '117110000', 
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '117110000') namapokok,
                            '125211100',
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '125211100') namabunga
                        FROM DUAL " : null;
                    $sql .= $cv2 == '2' ?
                        "UNION 
                        SELECT '117140000', 
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '117140000') namapokok,
                            '125213700',
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '125213700') namabunga
                        FROM DUAL " : null;
                    $sql .= $cv3 == '3' ?
                        "UNION 
                        SELECT '117130000', 
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '117130000') namapokok,
                            '125213100',
                            (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '125213100') namabunga
                        FROM DUAL " : null;
                    $DB->parse($sql);
                    $DB->execute();
                    $narek = $DB->result();
                    $jmlrek = count($narek);
                    foreach ($narek as $i => $r) {
                        $semicolon = $i < $jmlrek-1 ? '; ' : null;
                        echo "$r[NAMAPOKOK]/$r[NAMABUNGA]$semicolon";
                    } ?>
                </td>
            </tr>
            <tr>
                <td>PER</td>
                <td>: <?=strlen($month) > 0 && strlen($year) > 0 ? toTglIndo("30/$month/$year") : null;?>
                </td>
            </tr>
        </table>

        <br />

        <table border="1" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#09b0ce">
            <tr>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">NO URUT</td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">KANTOR</td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">NO POLIS LAMA</td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">NO POLIS JL-INDO</td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">NAMA PEMEGANG POLIS</td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">MULAI GADAI</td>
                <td rowspan="2" align="center" bgcolor="#7dc2d9">REKENING</td>
                <td colspan="2" align="center" bgcolor="#7dc2d9">SALDO AKHIR <?=$month?>/<?=$year;?></td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">STATUS POLIS</td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">STATUS GADAI</td>
                <td rowspan="2" bgcolor="#7dc2d9" align="center">VALUTA</td>
            </tr>
            <tr>
                <td bgcolor="#7dc2d9" align="center">POKOK</td>
                <td bgcolor="#7dc2d9" align="center">BUNGA</td>
            </tr>
            <?
            $filterpolis = "c.kdstatusfile IN (";
            foreach ($arrstatuspolis as $i => $r) {
                $filterpolis .= $r['KDSTATUSFILE'] == ${"cb$r[KDSTATUSFILE]"} ? "'$r[KDSTATUSFILE]'," : null;
            }
            $filterpolis = substr($filterpolis, 0, strlen($filterpolis)-1).")";
            $j = 0;
            $filtergadai = "AND CASE WHEN TO_DATE (TO_CHAR (a.tglbooked, 'mmyyyy'), 'mmyyyy') <= TO_DATE (TO_CHAR (b.tglbooked, 'mmyyyy'), 'mmyyyy') AND a.tglrekam < b.tglrekam THEN b.status ELSE a.status END IN (";
            foreach ($arrstatusgadai as $i => $r) {
                $filtergadai .= $r['KDSTATUS'] == ${"cs$r[KDSTATUS]"} ? "'$r[KDSTATUS]'," : null;
                $j += $r['KDSTATUS'] == ${"cs$r[KDSTATUS]"} ? 1 : 0;
            }
            $filtergadai = $j < 6 ? substr($filtergadai, 0, strlen($filtergadai)-1).")" : "AND CASE WHEN TO_DATE (TO_CHAR (a.tglbooked, 'mmyyyy'), 'mmyyyy') <= TO_DATE (TO_CHAR (b.tglbooked, 'mmyyyy'), 'mmyyyy') AND a.tglrekam < b.tglrekam THEN b.status ELSE a.status END NOT IN ('P')";
            $k = 0;
            $filtervaluta = "AND CASE WHEN to_date(to_char(a.tglbooked,'mmyyyy'),'mmyyyy') <= to_date(to_char(b.tglbooked,'mmyyyy'),'mmyyyy') AND a.tglrekam < b.tglrekam THEN b.kdvaluta ELSE a.kdvaluta END IN (";
            foreach ($arrvaluta as $i => $r) {
                $filtervaluta .= $r['KDVALUTA'] == ${"cv$r[KDVALUTA]"} ? "'$r[KDVALUTA]'," : null;
                $k += $r['KDVALUTA'] == ${"cv$r[KDVALUTA]"} ? 1 : 0;
            }
            $filtervaluta = $k > 3 ? null : substr($filtervaluta, 0, strlen($filtervaluta)-1).")";
            $filterkantor = $kdkantor == 'all' ? null : (substr($kdkantor,-1) == 'A' ? "AND d.kdrayonpenagih IN (SELECT kdkantor FROM $DBUser.tabel_001_kantor WHERE kdkantorinduk = '$kdkantor') " : "AND d.kdrayonpenagih = '$kdkantor' ");

            $sql = "SELECT d.kdrayonpenagih, c.nopol, a.prefixpertanggungan, a.nopertanggungan, e.namaklien1, NVL(b.tglgadai, a.tglgadai) tglgadai,
                        CASE WHEN to_date(to_char(a.tglbooked,'mmyyyy'),'mmyyyy') <= to_date(to_char(b.tglbooked,'mmyyyy'),'mmyyyy') AND a.tglrekam < b.tglrekam THEN b.saldopinjaman + NVL(b.kapitalisasi, 0) - NVL(b.angsuranpokok, 0) 
                            ELSE a.saldopinjaman + NVL(a.kapitalisasi, 0) - NVL(a.angsuranpokok, 0) END pokok,
                        CASE WHEN to_date(to_char(a.tglbooked,'mmyyyy'),'mmyyyy') <= to_date(to_char(b.tglbooked,'mmyyyy'),'mmyyyy') AND a.tglrekam < b.tglrekam THEN b.bunga ELSE a.bunga END bunga,
                        c.kdstatusfile,
                        CASE WHEN to_date(to_char(a.tglbooked,'mmyyyy'),'mmyyyy') <= to_date(to_char(b.tglbooked,'mmyyyy'),'mmyyyy') AND a.tglrekam < b.tglrekam THEN b.status ELSE a.status END statusgadai, 
                        CASE WHEN to_date(to_char(a.tglbooked,'mmyyyy'),'mmyyyy') <= to_date(to_char(b.tglbooked,'mmyyyy'),'mmyyyy') AND a.tglrekam < b.tglrekam THEN b.kdvaluta ELSE a.kdvaluta END kdvaluta
                    FROM (
                        SELECT prefixpertanggungan, nopertanggungan, tglgadai, tglbooked, tglrekam, saldopinjaman, kapitalisasi, angsuranpokok, bunga, status, kdvaluta
                        FROM $DBUser.tabel_701_pelunasan_gadai
                        WHERE (prefixpertanggungan, nopertanggungan, tglrekam, tglgadai) IN (
                            SELECT prefixpertanggungan, nopertanggungan, MAX(tglrekam), MAX(tglgadai)
                            FROM $DBUser.tabel_701_pelunasan_gadai
                            WHERE to_date('$month$year','mmyyyy') >= to_date(to_char(tglrekam,'mmyyyy'),'mmyyyy')
                                AND (tglseatled IS NULL OR periodebayar = '1')
                            GROUP BY prefixpertanggungan, nopertanggungan
                        )
                    ) a
                    LEFT OUTER JOIN (
                        SELECT prefixpertanggungan, nopertanggungan, tglgadai, tglbooked, tglrekam, saldopinjaman, kapitalisasi, angsuranpokok, bunga, status, kdvaluta
                        FROM $DBUser.tabel_701_pelunasan_gadai
                        WHERE (prefixpertanggungan, nopertanggungan, tglrekam, tglgadai) IN (
                            SELECT prefixpertanggungan, nopertanggungan, MAX(tglrekam), MAX(tglgadai)
                            FROM $DBUser.tabel_701_pelunasan_gadai
                            WHERE to_date('$month$year','mmyyyy') >= to_date(to_char(tglseatled,'mmyyyy'),'mmyyyy')
                            GROUP BY prefixpertanggungan, nopertanggungan
                        )
                    ) b ON a.prefixpertanggungan = b.prefixpertanggungan AND a.nopertanggungan = b.nopertanggungan
                    INNER JOIN $DBUser.tabel_200_pertanggungan c ON a.prefixpertanggungan = c.prefixpertanggungan
                        AND a.nopertanggungan = c.nopertanggungan
                    INNER JOIN $DBUser.tabel_500_penagih d ON c.nopenagih = d.nopenagih
                    INNER JOIN $DBUser.tabel_100_klien e ON c.nopemegangpolis = e.noklien
                    WHERE $filterpolis
                        $filtergadai
                        $filtervaluta
                        $filterkantor
                    ORDER BY d.kdrayonpenagih";
//echo $sql;
            $DB->parse($sql);
            $DB->execute();
            $arrresult = $DB->result();
            foreach ($arrresult as $i => $r) {
                $i++;
                switch ($r['KDVALUTA']) {
                    case 0:
                        $rekening = "117120000 / 125212100";
                        break;
                    case 1:
                        $rekening = "117110000 / 125211100";
                        break;
                    case 2:
                        $rekening = "117140000 / 125213700";
                        break;
                    case 3:
                        $rekening = "117130000 / 125213100";
                        break;
                }
                if($i%2){ echo "<tr>"; } else { echo "<tr bgcolor=#c4e1f2>"; } ?>
                    <td align="center"><?=$i?></td>
                    <td align="center"><?=$r['KDRAYONPENAGIH']?></td>
                    <td align="center"><?=$r['NOPOL']?></td>
                    <td align="center"><a href="javascript:void:0;" onclick="NewWindow('../akunting/kartugadai1.php?prefix=<?=$r['PREFIXPERTANGGUNGAN']?>&noper=<?=$r['NOPERTANGGUNGAN']?>','popuptebus','800','600','yes');" style="color:#000;"><?="$r[PREFIXPERTANGGUNGAN]-$r[NOPERTANGGUNGAN]"?></a></td>
                    <td><?=$r['NAMAKLIEN1']?></td>
                    <td align="center"><?=$r['TGLGADAI']?></td>
                    <td align="center"><?=$rekening?></td>
                    <td align="right"><?=number_format($r['POKOK'], 2, ",", ".")?></td>
                    <td align="right"><?=number_format($r['BUNGA'], 2, ",", ".")?></td>
                    <td align="center"><?=$r['KDSTATUSFILE']?></td>
                    <td align="center"><?=$r['STATUSGADAI']?></td>
                    <td align="center"><?=$r['KDVALUTA']?></td>
                </tr>

                <? $jmlpokok += $r['POKOK'];
                $jmlbunga += $r['BUNGA'];
            } ?>
            <tr>
                <td colspan="7" bgcolor="#7dc2d9" align="center">JUMLAH</td>
                <td align="right" bgcolor="#7dc2d9"><?=number_format($jmlpokok, 2, ",", ".")?></td>
                <td align="right" bgcolor="#7dc2d9"><?=number_format($jmlbunga, 2, ",", ".")?></td>
                <td colspan="3" bgcolor="#7dc2d9" align="center"></td>
            </tr>
        </table>
    </body>
</html>