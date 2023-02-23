<?php
// reformat & modified by fendy 17/12/2018
include "../../includes/session.php";
include "../../includes/database.php";

/*if((date("d")!="04" ||date("d")!="14" || date("d")!="24" || date("d")!="26") && $kantor!="KP"){
		echo "<blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Divisi ARC </blink>";
		die;
	}*/

$str = (date("d"));
//$exclude_list = array("04","14","24");
$exclude_list = array("04", "14", "24");
$tglprosesSAM = '';
$exclude_wae = array(0000072931, 0000072929, 0000072930, 0000072942, 0000072936, 0000072937, 0000072934, 0000072938, 0000073139, 0000072957, 0000072958, 0000072959, 0000072960, 0000073120, 0000073360, 0000072961, 0000072925, 0000072927, 0000072924, 0000073138, 0000072926, 0000072928, 0000072916, 0000072915, 0000072917, 0000073136, 0000072918, 0000072919, 0000073284, 0000072975, 0000072974, 0000072948, 0000073145, 0000072976, 0000072950, 0000072951, 0000072949, 0000072954, 0000072952, 0000072953, 0000072955, 0000073142, 0000073356, 0000072956, 0000072970, 0000072971, 0000072972, 0000072973, 0000072977, 0000073140, 0000073358, 0000072946, 0000072947, 0000072945, 0000073144, 0000072920, 0000073137, 0000072921, 0000072923, 0000072922, 0000072940, 0000072941, 0000072939, 0000072933, 0000072964, 0000072969, 0000072963, 0000072962, 0000073143, 0000073359, 0000072965, 0000072966, 0000072967, 0000072968, 0000073141, 0000072943, 0000072944, 0000072932, 0000072935);
//if(!in_array($str, $exclude_list) && ($kantor!="LG" || $kantor!="EH" || $kantor!="BC")) {
/*if(!in_array($str, $exclude_list) && ($kantor!="KP")){
		echo "<blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Hubungi Divisi ARC </blink>";
		die;
	}*/

$DB = new Database($userid, $passwd, $DBName);
$DB1 = new Database($userid, $passwd, $DBName);
//echo $DBName;
$conn = ocilogon('nadm', 'ifg#dbs#nadm#2020', $DBName);
#$conn2 = ocilogon('nadm','ifg#dbs#nadm#2020',$DBName);

function DateSelector($inName, $useDate = 0)
{
    if ($useDate == 0) {
        $useDate = Time();
    }

    $selected    = (isset($_POST[$inName . 'tgl']) && $_POST[$inName . 'tgl'] != '') ? $_POST[$inName . 'tgl'] : date("j", $useDate);

    // Tanggal
    print("<select name=" . $inName .  "tgl>\n");
    /*echo "<option value=05>05</option>";
		echo "<option value=15>15</option>";
		echo "<option value=25>25</option>";*/
    for ($currentDay = 1; $currentDay <= 31; $currentDay++) {
        //$currentDay=15;
        print("<option value=\"$currentDay\"");
        if ($selected == $currentDay) {
            print(" selected");
        }
        print(">$currentDay</option>");

        //$currentDay=26;
        //print("<option value=\"$currentDay\"");
        //if($selected==$currentDay) {
        //	print(" selected");
        //	}
        //print(">$currentDay</option>");


    }
    print("</select>");

    // Bulan
    $selected = (isset($_POST[$inName . 'bln']) && $_POST[$inName . 'bln'] != '') ? $_POST[$inName . 'bln'] : date("n", $useDate);
    print("<select name=" . $inName .  "bln>\n");
    for ($currentMonth = 1; $currentMonth <= 12; $currentMonth++) {
        switch ($currentMonth) {
            case '1':
                $namabulan = "JANUARI";
                break;
            case '2':
                $namabulan = "FEBRUARI";
                break;
            case '3':
                $namabulan = "MARET";
                break;
            case '4':
                $namabulan = "APRIL";
                break;
            case '5':
                $namabulan = "MEI";
                break;
            case '6':
                $namabulan = "JUNI";
                break;
            case '7':
                $namabulan = "JULI";
                break;
            case '8':
                $namabulan = "AGUSTUS";
                break;
            case '9':
                $namabulan = "SEPTEMBER";
                break;
            case '10':
                $namabulan = "OKTOBER";
                break;
            case '11':
                $namabulan = "NOVEMBER";
                break;
            case '12':
                $namabulan = "DESEMBER";
                break;
        }

        print("<option value=\"$currentMonth\"");
        if ($selected == $currentMonth) {
            print(" selected");
        }

        print(">$namabulan</option>");
    }
    print("</select>");

    // Tahun
    $selected = (isset($_POST[$inName . 'thn']) && $_POST[$inName . 'thn'] != '') ? $_POST[$inName . 'thn'] : date("Y", $useDate);
    print("<select name=" . $inName .  "thn>\n");
    $startYear = date("Y", $useDate);
    for ($currentYear = 2003; $currentYear <= $startYear + 1; $currentYear++) {
        print("<option value=\"$currentYear\"");
        if ($selected == $currentYear) {
            print(" selected");
        }
        print(">$currentYear\n");
    }
    print("</select>");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>Daftar Komisi BS</title>
    <style type="text/css">
        <!--
        body {
            font-family: tahoma, verdana, geneva, sans-serif;
            font-size: 12px;
        }

        td {
            font-family: tahoma, verdana, geneva, sans-serif;
            font-size: 11px;
        }

        input {
            font-family: tahoma, verdana, geneva, sans-serif;
            font-size: 11px;
            padding: 1px;
        }

        select {
            font-family: tahoma, verdana, geneva, sans-serif;
            font-size: 11px;
            border-style: groove;
            border-width: .2em;
        }

        textarea {
            font-family: tahoma, verdana, geneva, sans-serif;
            font-size: 11px;
            border-style: groove;
            border-width: .2em;
        }

        a {
            color: #259dc5;
            text-decoration: none;
        }

        a:hover {
            color: #cc6600;
        }

        #filterbox {
            border: solid 1px #c0c0c0;
            padding: 5px;
            width: 100%;
            margin: 0 0 10px 0;
        }

        form {
            margin: 0;
            padding: 0;
        }
        -->
    </style>
    <script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
    <script language="JavaScript">
        function Cekbok(doc) {
            if (doc == true) {
                checkedAll('getpremi', true);
            } else {
                checkedAll('getpremi', false);
            }
        }

        function checkedAll(id, checked) {
            var el = document.getElementById(id);
            for (var i = 0; i < el.elements.length; i++) {
                el.elements[i].checked = checked;
            }
        }
    </script>
</head>

<?php if ($act == "print") { ?>

    <body onLoad="window.print();window.close()">
    <?php } else { ?>

        <body topmargin="10">
            <? //include "./menu.php";
            ?>
            <form name="getpremi" id="getpremi" action="<?= $PHP_SELF; ?>" method="post">
                <div id="filterbox">
                    <table>
                        <tr>
                            <td>Tanggal Mutasi <?= DateSelector("d"); ?></td>
                            <td>Kantor
                                <?
                                $kntrsql = "Select kdkantor, namakantor from $DBUser.tabel_001_kantor where status = '1' and kdkantor <> 'KN' order by kdkantor ";
                                //echo $kntrsql;
                                $sql_ktr = ociparse($conn, $kntrsql);
                                oci_execute($sql_ktr);
                                print("<select name='kantorpilihan'>");
                                while (($row = oci_fetch_array($sql_ktr, OCI_BOTH)) != false) {
                                    $dipilih = "";
                                    if ($kantorpilihan == $row[0]) {
                                        $dipilih = "selected";
                                    }
                                ?>
                                    <option value="<?= $row[0] ?>" <?= $dipilih; ?>> <?php echo $row[0] . "-" . $row[1]; ?> </option>;
                                <?
                                }
                                print("</select>");
                                ?>
                            </td>
                            <td colspan="2"><input type="submit" name="submit" value="Cari"></td>
                        </tr>
                    </table>
                </div>
            <?php }

        if (isset($_GET['tglcari'])) {
            $tglcari = $tglcari;
        } else {
            $tglcari = ((strlen($_POST['dtgl']) == 1) ? '0' . $_POST['dtgl'] : $_POST['dtgl']) . "/" .
                ((strlen($_POST['dbln']) == 1) ? '0' . $_POST['dbln'] : $_POST['dbln']) . "/" .
                $_POST['dthn'];
        }
        $tgldef .= (strlen(date('d')) == 1) ? '0' . date('d') : date('d');
        $tgldef .= "/";
        $tgldef .= (strlen(date('m')) == 1) ? '0' . date('m') : date('m');
        $tgldef .= "/";
        $tgldef .= date('Y');

        if (!isset($_POST['dtgl'])) {
            if (isset($_GET['tglcari'])) {
                $tglcari = $tglcari;
            } else {
                $tglcari = $tgldef;
            }
        }

        if ($_POST['dtgl'] == "all" || substr($_GET['tglcari'], 0, 3) == "all") {
            $filtercari = "and to_char(a.tglmutasi,'MM/YYYY')='" . substr($tglcari, -7) . "' ";
            $titletglcari = "BULAN " . substr($tglcari, -7);
        } else {
            $filtercari = "and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ";
            $titletglcari = $tglcari;
        }
            ?>

            <b>DAFTAR VALIDASI KOMISI AGEN BS<BR />
                TANGGAL <?= $titletglcari; ?></b>

            <?php if ($_POST['check']) {
                $box = $_POST['box1']; //as a normal var
                $box_count = count($box); // count how many values in array
                if (($box_count) < 1) {
                    //echo "No Data Updated !";
                } else {
                    foreach ($box as $dear) {
                        $sqa = "update $DBUser.tabel_404_pendapatan_lain_agen_tmp set kdauthorisasi='1',tglupdated=sysdate,userupdated='" . $userid .
                            "' WHERE noagen = '" . substr($dear, 0, 10) . "' and kdkomisiagen = '" . substr($dear, 10, 2) . "' and (to_char(tglproses,'DD/MM/YYYY')='" . substr($dear, 12, 10) . "') ";
                        //echo $sqa;die;
                        $DB->parse($sqa);
                        $DB->execute();
                        //echo $sqa;
                        //echo substr($dear,21,10);
                    }
                }
            }

            if ($_POST['uncheck']) {
                $box = $_POST['box1']; //as a normal var
                $box_count = count($box); // count how many values in array
                if (($box_count) < 1) {
                    //echo "No Data Updated !";
                } else {
                    foreach ($box as $dear) {
                        $sqa = "update $DBUser.tabel_404_pendapatan_lain_agen_tmp set kdauthorisasi=null,tglupdated=sysdate,userupdated='" . $userid .
                            "' WHERE noagen = '" . substr($dear, 0, 10) . "' and kdkomisiagen = '" . substr($dear, 10, 2) . "' and (to_char(tglproses,'DD/MM/YYYY')='" . substr($dear, 12, 10) . "') ";
                        //echo $sqa;die;
                        $DB->parse($sqa);
                        $DB->execute();
                        //echo $sqa;
                        //echo substr($dear,21,10);
                    }
                }
            }
            ?>

            <table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" id="AutoNumber1" width="50%">
                <tr>
                    <td bgcolor="#89acd8" align="center">No.</td>
                    <td bgcolor="#89acd8" align="center">No. Agen</td>
                    <td bgcolor="#89acd8" align="center">Jumlah Produksi</td>
                    <td bgcolor="#89acd8" align="center">Komponen Remunerasi</td>
                    <td bgcolor="#89acd8" align="center">Jumlah (RP)</td>
                    <td bgcolor="#89acd8" align="center">Tgl. Periode</td>
                    <td bgcolor="#89acd8" align="center">Check<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></td>
                </tr>
                <?php
                //echo $tglcari;
                $sql = "select a.noagen,
				to_char(tglproses,'dd/mm/yyyy') as tglproses,
				kdkomisiagen,
				kdrekening,
				nilaipendapatan,
				KDAUTHORISASI,
				KDSTATUSAGEN,
				(select nilaipendapatan from tabel_404_pendapatan_lain_agen where noagen = a.noagen and tglproses = a.tglproses and kdkomisiagen = a.kdkomisiagen and KDAUTHORISASI = '1') as NILAIVALIDASI,
				(select namakomisiagen from $DBUser.tabel_402_kode_komisi_agen where a.kdkomisiagen = kdkomisiagen) as namakomisi,
				(select sum(fyp) from $DBUser.tabel_400_produksi_lpa m where a.noagen = m.noagen and a.tglproses = m.tglperiode and JENIS_REMUNERASI = a.kdkomisiagen ) as jmlfyp
				from $DBUser.tabel_404_pendapatan_lain_agen_tmp a
				inner join $DBUser.tabel_400_agen b on a.noagen = b.noagen
				where a.kdkantor = '$kantorpilihan'
				and to_char(tglproses,'dd/mm/yyyy') = '$tglcari'
				and kdkomisiagen in ('N1', 'N2', 'N3')
				order by a.noagen, kdkomisiagen asc";
                //echo $sql;//die;
                // echo "<br />".$sql."<br />";
                // $DB->parse($sql);
                // $DB->execute();
                $list = ociparse($conn, $sql);
                ociexecute($list);
                $i = 1;
                while (($arr = oci_fetch_array($list, OCI_BOTH)) != false) {
                    $jmltoatgen[$i] = $arr["NOAGEN"];
                    if ($arr["NOAGEN"] != $jmltoatgen[($i - 1)] && $i > 1) { ?>
                        <tr bgcolor="#f5d79c">
                            <td align="right" colspan="4"><b>SUB TOTAL</b></td>
                            <td align="right"><b><?= number_format($jmltotal, 2, ",", "."); ?></b></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php $jmltotal = 0;
                    }
                    $style = '';

                    if ($arr['TGLPROSES'] != $arr['TGLUPDATED']) {
                        $style .= "<tr bgcolor=#'F8F8FF'>";
                    } else {
                        $style .= "<tr bgcolor=#" . ($i % 2 ? "ffffff" : "d5e7fd") . ">";
                    }
                    echo $style; ?>
                    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?= $i; ?></td>
                    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><a href="#" onClick="window.open('detail_produksi_lpa_remunerasi.php?noagen=<?= $arr['NOAGEN']; ?>&tglproses=<?= $arr['TGLPROSES']; ?>&kdkomisiagen=<?= $arr['KDKOMISIAGEN'] ?>','','width=900,height=700,top=100,left=100,scrollbars=yes');"><mark><?= $arr["NOAGEN"]; ?></mark></td>
                    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?= number_format($arr["JMLFYP"], 2, ",", "."); ?></td>
                    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?= $arr["NAMAKOMISI"]; ?></td>
                    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?= number_format($arr["NILAIPENDAPATAN"], 2, ",", "."); ?></td>
                    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?= $arr["TGLPROSES"]; ?><? //=$arr["TGLUPDATED"];
                                                                                                                                                                                    ?></td>
                    <?php
                    if ($arr['KDAUTHORISASI'] != '1') {
                        echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><input type='checkbox' name='box1[]' value=" . $arr["NOAGEN"] . $arr["KDKOMISIAGEN"] . $arr["TGLPROSES"] . "></td>";
                    } else if ($arr['KDSTATUSAGEN'] != '01') {
                        echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><font color='red'>Agen Sudah Tidak Aktif</font></td>";
                    } else {
                        echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><font color='green'>Approved</font><input type='checkbox' name='box1[]' value=" . $arr["NOAGEN"] . $arr["KDKOMISIAGEN"] . $arr["TGLPROSES"] . "></td>";
                    }
                    ?>

                    </tr>

                <?php
                    $jmltotal += $arr["NILAIPENDAPATAN"];
                    $jmltotalall += $arr["NILAIPENDAPATAN"];
                    $jmltotalvalidasi += $arr['NILAIVALIDASI'];
                    $i++;
                } ?>

                <tr bgcolor="#f5d79c">
                    <td align="right" colspan="4"><b>SUB TOTAL<?= $cabas; ?></b></td>
                    <td align="right"><b><?= number_format($jmltotal, 2, ",", "."); ?></b></td>
                    <td align="center"><? //echo "<input type='submit' name='check' value='Approve!'>";
                                        ?></td>
                    <td align="center"><? //echo "<input type='submit' name='check' value='Approve!'>";
                                        ?></td>
                </tr>
                <tr bgcolor="#f5d79c">
                    <td align="right" colspan="4"><b>TOTAL </b></td>
                    <td align="right"><b><?= number_format($jmltotalall, 2, ",", "."); ?></b></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr bgcolor="#f5d79c">
                    <td align="right" colspan="4"><b>TOTAL Yang Sudah Divalidasi</b></td>
                    <td align="right"><b><?= number_format($jmltotalvalidasi, 2, ",", "."); ?></b></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <?php
                if (!in_array($str, $exclude_list) && ($kantor != "KP")) {
                    echo "<tr>" . "<td colspan='10'><blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Hubungi Divisi ARC </blink></td>" . "</tr>";
                } else { ?>
                    <tr>
                        <td bgcolor="#FF9900" align="right" colspan="6"><? echo "<input type='submit' name='check' value='Approve!'>"; ?></td>
                        <td bgcolor="#FF9900" align="left"><? echo "<input type='submit' name='uncheck' value='UnApprove!'>"; ?></td>
                    </tr>
                <?php } ?>
            </table>
            </form>
        </body>

</html>
