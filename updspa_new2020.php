<?
include "../../includes/session.php";
include "../../includes/database.php";
include "../../includes/klien.php";

// $conn = ocilogon($userid,$passwd,$DBName);
$conn = ocilogon("nadm", "ifg#dbs#nadm#2020", $DBName);
$DB = new Database($userid, $passwd, $DBName);
$DB2 = new Database($userid, $passwd, $DBName);
$KL = new Klien($userid, $passwd, $noagen);
$sql = "select nolisensiagen, kdjabatanagen, kdkantor, atasan from $DBUser.tabel_400_agen where noagen='$noagen'";
// echo $sql;
$DB->parse($sql);
$DB->execute();
$arrlisensi = $DB->nextrow();
$lisensi = $arrlisensi["NOLISENSIAGEN"];
$kdjab = $arrlisensi["KDJABATANAGEN"];
$kdktr = $arrlisensi["KDKANTOR"];
$atasan = $arrlisensi["ATASAN"];
$kdjbtn = array('08', '06', '07');
$kdarea = !empty($kdarea) ? $kdarea : $kdareaoffice;
$kdup = !empty($kdup) ? $kdup : $kdunitproduksi;
$jab = !empty($jab) ? $jab : $kdjabatanagen;

if ($update == "update") {
    if (strlen(trim($pkajagen)) <= 0) {
        $pesan = "No. PKAJ Wajib dipilih. Silahkan pilih dan coba kembali.";
        //echo "param1";die;
    } else {
        //echo "param2";die;
        $KL = new Klien($userid, $passwd, $noagen);
        //$KL = New Klien ("jsadm", "jsadmoke",$noagen);
        // $nospa = '';
        // $sql = "INSERT INTO $DBUser.TABEL_417_HISTORI_JABATAN
        // 		(
        // 			noagen,
        // 			tgljabatan,
        // 			kdjabatanagen,
        // 			kdkelasagen,
        // 			uraian,
        // 			keterangan,
        // 			kdkantor,
        // 			nopkajagen,
        // 			tglpenetapan,
        // 			tglsurat,
        // 			perihal,
        // 			tglrapatmjm,
        // 			resume,
        // 			status_approval,
        // 			atasan_baru,
        // 			no_nota_asc,
        // 			tgl_nota_asc,
        // 			perihal_asc,
        // 			no_nota_spi,
        // 			tgl_nota_spi,
        // 			perihal_spi,
        // 			tgl_pengunduran_diri,
        // 			perihal_pengunduran_diri,
        // 			tgl_rekomendasi_sam,
        // 			tgl_persetujuan_rah,
        // 			no_surat_kematian,
        // 			tgl_surat_kematian,
        // 			ahli_waris,
        // 			alasan_penolakan_spa
        // 		)
        // 		select
        // 			'$noagen',
        // 			to_date('$tglsk','DD/MM/YYYY'),
        // 			'$kdjabatanagen',
        // 			'',
        // 			(SELECT NAMA_MUTASI FROM $DBUser.TABEL_400_JENIS_MUTASI_SPA where KDMUTASI = $uraianmutasi),
        // 			'$nospa',
        // 			'$preagen',
        // 			'$pkajagen',
        // 			'',
        // 			'',
        // 			'',
        // 			'',
        // 			'$resume',
        // 			1,
        // 			'$atasan_baru',
        // 			'$no_nota_asc',
        // 			to_date('$tgl_nota_asc','DD/MM/YYYY'),
        // 			'$perihal_asc',
        // 			'$no_nota_spi',
        // 			to_date('$tgl_nota_spi','DD/MM/YYYY'),
        // 			'$perihal_spi',
        // 			to_date('$tgl_pengunduran_diri','DD/MM/YYYY'),
        // 			'$perihal_pengunduran_diri',
        // 			to_date('$tgl_rekomendasi_sam','DD/MM/YYYY'),
        // 			to_date('$tgl_persetujuan_rah','DD/MM/YYYY'),
        // 			'$no_surat_kematian',
        // 			to_date('$tgl_surat_kematian','DD/MM/YYYY'),
        // 			'$hli_waris',
        // 			''
        // 		from $DBUser.tabel_400_agen
        // 		where noagen = '$noagen'
        // 		";

        $ketjabatan = strtoupper($ketjabatan);
        $uraianjabatan = strtoupper($uraianjabatan);
        $sql = "UPDATE $DBUser.tabel_417_histori_jabatan SET
            tgljabatan = to_date('$tglsk','DD/MM/YYYY'),
            kdjabatanagen = '$kdjabatanagen',
            kdkelasagen = '',
            uraian = (SELECT NAMA_MUTASI FROM $DBUser.TABEL_400_JENIS_MUTASI_SPA where KDMUTASI = $uraianmutasi),
            keterangan = '$nospa',
            kdkantor = '$preagen',
            nopkajagen = '$pkajagen',
            tglpenetapan = '',
            tglsurat = '',
            perihal = '',
            tglrapatmjm = '',
            resume = '$resume',
            status_approval = 1,
            atasan_baru = '$atasan_baru',
            no_nota_asc = '$no_nota_asc',
            tgl_nota_asc = to_date('$tgl_nota_asc','DD/MM/YYYY'),
            perihal_asc = '$perihal_asc',
            no_nota_spi = '$no_nota_spi',
            tgl_nota_spi = to_date('$tgl_nota_spi','DD/MM/YYYY'),
            perihal_spi = '$perihal_spi',
            tgl_pengunduran_diri = to_date('$tgl_pengunduran_diri','DD/MM/YYYY'),
            perihal_pengunduran_diri = '$perihal_pengunduran_diri',
            tgl_rekomendasi_sam = to_date('$tgl_rekomendasi_sam','DD/MM/YYYY'),
            tgl_persetujuan_rah = to_date('$tgl_persetujuan_rah','DD/MM/YYYY'),
            no_surat_kematian = '$no_surat_kematian',
            tgl_surat_kematian = to_date('$tgl_surat_kematian','DD/MM/YYYY'),
            ahli_waris = '$ahli_waris',
            alasan_penolakan_spa = ''
            WHERE noagen = '$noagen'";
        $update = ociparse($conn, $sql);
        if (ociexecute($update)) {
            echo "<br><div style=\"background-color:lightblue;width: 100%;\"><br><font face=\"Verdana\" size=\"2\">Berhasil melakukan perubahan riwayat jabatan.</font><br><br></div><br><br>";
        }
    }
}
?>
<html>

<head>
    <title>Jiwasraya Private Network</title>
    <link href="../jws.css" rel="stylesheet" type="text/css">
    <? include "../includes/hide.php";  ?>
    <script language="JavaScript" type="text/javascript" src="../includes/validasi.js"></script>
    <script language="JavaScript" type="text/javascript" src="../includes/highlight.js"></script>
    <script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
</head>
<script LANGUAGE="JavaScript">
    function cekPPPK() {
        var e = document.getElementById("jabatan");
        var jabatan = e.options[e.selectedIndex].text;
        var spa = document.getElementsByName("nospa1")[0].value;

        if (jabatan.indexOf("PK") > 0) {
            spa = spa.replace("SPA-", "SPAK-");
            spa = spa.replace("SPSAF-", "SPAK-");
        } else if (jabatan.indexOf("FORCE") > 0) {
            spa = spa.replace("SPA-", "SPSAF-");
            spa = spa.replace("SPAK-", "SPSAF-");
        } else {
            spa = spa.replace("SPAK-", "SPA-");
            spa = spa.replace("SPSAF-", "SPA-");
        }

        document.getElementsByName("nospa1")[0].value = spa;
    }

    function GantiCari(theForm) {
        //var kdarea=histjabatan.kdarea.value;
        var preagen = histjabatan.preagen.value;
        var agn = histjabatan.noagen.value;
        var kdmutasi = histjabatan.uraianmutasi.value;
        var kantoratasan = histjabatan.kantoratasan.value;
        window.location.replace('?noagen=' + agn + '&preagen=' + preagen + '&uraianmutasi=' + kdmutasi + '&kantoratasan=' + kantoratasan + '#awaledit');
    }

    function jnsMutasi(theForm) {

        //var kdarea=histjabatan.kdarea.value;
        var preagen = histjabatan.preagen.value;
        var agn = histjabatan.noagen.value;
        //var kdup=histjabatan.kdup.value;
        var kdmutasi = histjabatan.uraianmutasi.value;
        window.location.replace('?noagen=' + agn + '&preagen=' + preagen + '&uraianmutasi=' + kdmutasi + '#awaledit');
    }

    function CariNama() {
        var noklien = document.ntryclnthub.noklieninsurable.value;
        if (!noklien == '') {
            window.open('carinama.php?namahalaman=ntryclnthub&noklien=' + noklien + '', 'caripage', 'width=400,height=300,top=50,left=50,scrollbars=yes')
        }
    }
</script>

<body>
    <font face="Verdana" size="2"><b>Update SPA Agen</b></font><br>
    <div align="center">
        <hr size="1">
        <form name="histjabatan" method="POST" action="<? PHP_SELF; ?>">
            <table width="100%" class="tblisi">
                <tr>
                    <td class="verdana9blu">No. Agen</td>
                    <td class="verdana9blu">:</td>
                    <td>
                        <? echo $noagen . " " . $KL->nama; ?> </td>
                </tr>
                <!--inidirubah-->
                <tr>
                    <td class="verdana9blu">Agency</td>
                    <td class="verdana9blu">:</td>
                    <td>
                        <!--<input type="text" name="uraianjabatan" size="40" value="<? echo $uraianjabatan; ?>">-->
                        <select size="1" name="preagen">
                            <option></option>
                            <?
                            //inidirubah
                            $sql = "select * from $DBUser.tabel_001_kantor a, $DBUser.TABEL_001_AGENCY_KANTOR b where a.kdkantor = b.kdkantor and (SELECT NAMA_AGENCY FROM $DBUser.TABEL_001_AGENCY_KANTOR where kdkantor = '$preagen') = b.nama_agency  and a.kdkantor<>'XA' order by a.kdkantor asc";
                            $listagency = ociparse($conn, $sql);
                            ociexecute($listagency);
                            while (($arr = oci_fetch_array($listagency, OCI_BOTH)) != false) {
                                if ($arr["KDKANTOR"] == $preagen) {
                                    $pilih = 'selected';
                                } else {
                                    $pilih = '';
                                }

                                //sampesini
                                echo "<option value=" . $arr["KDKANTOR"] . " " . $pilih . ">" . $arr["KDKANTOR"] . "-" . $arr["NAMAKANTOR"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <!--sampesini-->
                <tr>
                    <td class="verdana9blu">Jenis Mutasi </td>
                    <td class="verdana9blu">: </td>
                    <td>
                        <select size="1" name="uraianmutasi" onChange="jnsMutasi(document.histjabatan)">
                            <option></option>
                            <?
                            $sql = "SELECT B.KDMUTASI, B.NAMA_MUTASI
                            FROM $DBUser.TABEL_400_SETUP_SPA_AGEN A, $DBUser.TABEL_400_JENIS_MUTASI_SPA B
                            where A.KDMUTASI = B.KDMUTASI AND A.KDJABATANAGEN = '$kdjab'
                            ORDER BY B.KDMUTASI";
                            $listmutasi = ociparse($conn, $sql);
                            ociexecute($listmutasi);
                            $pilih = '';
                            while (($row = oci_fetch_array($listmutasi, OCI_BOTH)) != false) {
                                if ($uraianmutasi == $row["KDMUTASI"]) {
                                    $pilih = 'selected';
                                } else {
                                    $pilih = '';
                                }
                                echo "<option value=" . $row["KDMUTASI"] . " " . $pilih . ">" . $row["NAMA_MUTASI"] . "</option>";
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="verdana9blu">Jabatan Baru</td>
                    <td class="verdana9blu">: </td>
                    <td> <select size="1" id="jabatan" name="kdjabatanagen" onChange="cekPPPK()">
                            <?
                            $sql = "SELECT B.KDJABATANAGEN, B.NAMAJABATANAGEN
                            FROM $DBUser.TABEL_400_SETUP_SPA_AGEN A, $DBUser.TABEL_413_JABATAN_AGEN B
                            where A.KDJABATAN_BARU = B.KDJABATANAGEN
						  	AND A.KDJABATANAGEN = '" . $kdjab . "' AND A.KDMUTASI = '" . $uraianmutasi . "'";

                            $jabatanbaru = ociparse($conn, $sql);
                            ociexecute($jabatanbaru);

                            $pilih = '';
                            while (($row = oci_fetch_array($jabatanbaru, OCI_BOTH)) != false) {
                                echo "<option value=" . $row["KDJABATANAGEN"] . " " . $pilih . ">" . $row["NAMAJABATANAGEN"] . "</option>";
                            }
                            ?>
                        </select></td>

                </tr>
                <!--inidirubah-->
                <tr>
                    <td class="verdana9blu">Kantor Atasan Langsung</td>
                    <td class="verdana9blu">:</td>
                    <td>
                        <!--<input type="text" name="uraianjabatan" size="40" value="<? echo $uraianjabatan; ?>">-->
                        <select size="1" name="kantoratasan" onChange="GantiCari(document.histjabatan)">
                            <option></option>
                            <?
                            if (isset($uraianmutasi)) {
                                $sql = "select * from $DBUser.tabel_001_kantor a, $DBUser.TABEL_001_AGENCY_KANTOR b where a.kdkantor = b.kdkantor and (SELECT NAMA_AGENCY FROM $DBUser.TABEL_001_AGENCY_KANTOR where kdkantor = '$preagen') = b.nama_agency  and a.kdkantor<>'XA' order by a.kdkantor asc";
                                $listktratasan = ociparse($conn, $sql);
                                ociexecute($listktratasan);
                            }
                            while (($arr = oci_fetch_array($listktratasan, OCI_BOTH)) != false) {
                                /*if (empty($preagen)) {
				 if($arr["KDKANTOR"]==$kdkantor){$pilih='selected';} else {$pilih='';}
				} else {
					if($arr["KDKANTOR"]==$preagen){$pilih='selected';} else {$pilih='';}
				}*/
                                if ($arr["KDKANTOR"] == $kantoratasan) {
                                    $pilih = 'selected';
                                } else {
                                    $pilih = '';
                                }

                                echo "<option value=" . $arr["KDKANTOR"] . " " . $pilih . ">" . $arr["KDKANTOR"] . "-" . $arr["NAMAKANTOR"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <!--sampesini -->
                <tr>
                    <td class="verdana9blu">Atasan Langsung</td>
                    <td class="verdana9blu">: </td>
                    <td> <select size="1" id="atasan_baru" name="atasan_baru">
                            <option value=""></option>
                            <?

                            $sql0 = "SELECT B.LISTATASAN FROM $DBUser.TABEL_400_SETUP_SPA_AGEN B WHERE B.KDJABATANAGEN = '" . $kdjab . "' AND B.KDMUTASI = '" . $uraianmutasi . "' ";
                            $listatasan = ociparse($conn, $sql0);
                            ociexecute($listatasan);
                            ocifetch($listatasan);
                            //perubahan
                            $sql = "SELECT A.NOAGEN, (SELECT NAMAKLIEN1 FROM $DBUser.tabel_100_klien where noklien = A.noagen ) as namaagen
				    FROM $DBUser.tabel_400_agen A
				    WHERE kdstatusagen = '01' AND A.kdkantor = '" . $kantoratasan . "'
				    	  AND A.KDJABATANAGEN IN (" . ociresult($listatasan, "LISTATASAN") . ")
				    	  AND A.KDJABATANAGEN <> '19'
				   ";
                            $atasanlangsung = ociparse($conn, $sql);
                            ociexecute($atasanlangsung);
                            //sampedisini
                            $pilih = '';
                            while (($row = oci_fetch_array($atasanlangsung, OCI_BOTH)) != false) {
                                if ($atasan == $row["NOAGEN"]) {
                                    $pilih = 'selected';
                                } else {
                                    $pilih = '';
                                }
                                echo "<option value=" . $row["NOAGEN"] . " " . $pilih . ">" . $row["NAMAAGEN"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <!-- <tr>
  <td class="verdana9blu">Berlaku Mulai</td>
	<td class="verdana9blu">: <input type="text" name="tglmulai" maxlength="10" size="10" value="<? echo date("m-Y"); ?>"></td>
</td> -->
                </tr>
                <tr>
                    <td class="verdana9blu">Tanggal Penetapan</td>
                    <td class="verdana9blu">: </td>
                    <td>
                        <input type="text" name="tglsk" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                    </td>
                </tr>
                <tr>
                    <td class="verdana9blu">No. PKAJ</td>
                    <td class="verdana9blu">: </td>
                    <td> <select size="1" name="pkajagen">
                            <option></option>
                            <?
                            //$sql = "select NOPKAJAGEN,to_char(TGLPKAJAGEN,'MMYYYY') TGLPKAJAG from $DBUser.tabel_400_PKAJ_AGEN where noagen='$noagen'";
                            $sql = "select a.NOPKAJAGEN,to_char(TGLPKAJAGEN,'MMYYYY') TGLPKAJAG, b.kdjabatanagen jabatan
						 from $DBUser.tabel_400_PKAJ_AGEN a
						 inner join $DBUser.tabel_400_agen b ON a.noagen = b.noagen
						 where a.noagen='$noagen'";
                            $DB->parse($sql);
                            $DB->execute();
                            while ($arr = $DB->nextrow()) {
                                if ($arr["JABATAN"] == "10" || $arr["JABATAN"] == "11" || $arr["JABATAN"] == "12" || $arr["JABATAN"] == "13") {
                                    $pkaj = "PKAJK";
                                } else if ($arr["JABATAN"] == "16") {
                                    $pkaj = "PKAJSAF";
                                } else if ($arr["JABATAN"] == "17") {
                                    $pkaj = "PKAJSAF";
                                } else {
                                    //$pkaj = "
                                    $pkaj = "PKAJ";
                                }

                                echo "<option value=" . $arr["NOPKAJAGEN"] . ">" . $arr["NOPKAJAGEN"] . "/$pkaj-" . $preagen . "." . $arr["TGLPKAJAG"] . "</option>";
                            }

                            ?>
                        </select></td>
                </tr>
                <?php //echo $sql;
                if (in_array($uraianmutasi, array("4", "5", "6"))) {

                    if ($uraianmutasi == "4") {
                ?>
                        <!-- tambahan kolom nomor nota dinas SPI -->
                        <tr>
                            <td class="verdana9blu">Nomor Nota Dinas ASC </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="no_nota_asc" size="20">
                            </td>
                        </tr>
                        <!-- tambahan kolom tgl nota dinas SPI -->
                        <tr>
                            <td class="verdana9blu"> Tanggal Nota Dinas ASC </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_nota_asc" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                        <!-- tambahan kolom perihal asc -->
                        <tr>
                            <td class="verdana9blu">Perihal Laporan Pelanggaran Agen </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="perihal_asc" size="40">
                            </td>
                        </tr>
                        <!-- tambahan kolom nomor nota dinas SPI -->
                        <tr>
                            <td class="verdana9blu">Nomor Dinas Rekomendasi Div. SPI </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="no_nota_spi" size="20">
                            </td>
                        </tr>
                        <!-- tambahan kolom tgl nota dinas SPI -->
                        <tr>
                            <td class="verdana9blu">Tanggal Nomor Dinas Rekomendasi Div. SPI </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_nota_spi" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                        <!-- tambahan kolom perihal SPI -->
                        <tr>
                            <td class="verdana9blu">Perihal rekomendasi Div. SPI </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="perihal_spi" size="40">
                            </td>
                        </tr>
                        <tr>
                            <td class="verdana9blu" valign="top">Resume Pelanggaran </td>
                            <td class="verdana9blu">: </td>
                            <td class="verdana9blu" valign="top">
                                <textarea name="resume" cols="30" rows="4"></textarea>
                            </td>
                        </tr>
                    <?
                    } else if ($uraianmutasi == "5") {
                    ?>
                        <!-- tambahan kolom tanggal pengunduran diri -->
                        <tr>
                            <td class="verdana9blu">Tgl Surat Pengajuan Pengunduran Diri </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_pengunduran_diri" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                        <!-- tambahan kolom perihal pengunduran diri -->
                        <tr>
                            <td class="verdana9blu">Perihal Pengunduran Diri </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="perihal_pengunduran_diri" size="40">
                            </td>
                        </tr>
                        <!-- tambahan kolom tanggal rekomendasi sam -->
                        <tr>
                            <td class="verdana9blu">Tanggal Surat Rekomendasi SAM </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_rekomendasi_sam" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                        <!-- tambahan kolom tgl persetujuan RAH -->
                        <tr>
                            <td class="verdana9blu">Tanggal Surat Persetujuan RAH </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_persetujuan_rah" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                    <?
                    } else if ($uraianmutasi == "6") {
                    ?>
                        <!-- tambahan kolom Nomor Surat Kematian -->
                        <tr>
                            <td class="verdana9blu">Nomor Surat Kematian </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="no_surat_kematian" size="20">
                            </td>
                        </tr>
                        <!-- tambahan kolom Tanggal Surat Kematian -->
                        <tr>
                            <td class="verdana9blu">Tanggal Surat Kematian </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_surat_kematian" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                        <!-- tambahan kolom tanggal rekomendasi sam -->
                        <tr>
                            <td class="verdana9blu">Tanggal Surat Rekomendasi SAM </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_rekomendasi_sam" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                        <!-- tambahan kolom nomor nota dinas SPI -->
                        <tr>
                            <td class="verdana9blu">Nomor Nota Dinas ASC </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="no_nota_asc" size="20">
                            </td>
                        </tr>
                        <!-- tambahan kolom tgl nota dinas SPI -->
                        <tr>
                            <td class="verdana9blu"> Tanggal Nota Dinas ASC </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="tgl_nota_asc" maxlength="10" size="10" value="<? echo date("d/m/Y"); ?>">
                            </td>
                        </tr>
                        <!-- tambahan kolom perihal asc -->
                        <tr>
                            <td class="verdana9blu">Perihal Nota Dinas ASC </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="perihal_asc" size="40">
                            </td>
                        </tr>
                        <!-- tambahan kolom ahli waris -->
                        <tr>
                            <td class="verdana9blu">Nama Ahli Waris </td>
                            <td class="verdana9blu">: </td>
                            <td>
                                <input type="text" name="ahli_waris" size="25">
                            </td>
                        </tr>
                <?
                    }
                }
                ?>
            </table>
            <hr size=1>
            <?php
            //$kdjbtn;
            $sqlPkaj = "SELECT TO_CHAR(MAX(TGLPKAJAGEN),'YYYY') AS THNPKAJ FROM $DBUser.TABEL_400_PKAJ_AGEN WHERE NOAGEN = '" . $noagen . "' ";
            $DB2->parse($sqlPkaj);
            $DB2->execute();
            $arrpkaj = $DB2->nextrow();
            //echo $arrpkaj["THNPKAJ"].$uraianmutasi;
            ?>
            <table>
                <tr>
                    <td align="center">
                        <input type="hidden" name="noagen" value=<? echo $noagen; ?>>
                        <!-- <? if (($uraianmutasi == '1' || $uraianmutasi == '2') && $arrpkaj["THNPKAJ"] != date('Y')) { ?>
				<input type="submit" name="update2" value="Update" disabled="true"> </td><tr><td>
			<? echo "<font color='red'> Tahun PKAJ Kurang dari Tahun Saat Ini.</font>";
                                } else { ?></td></tr>
				<input type="submit" name="update" value="Update" >
			<? } ?> -->
                        <input type="submit" name="update" value="update">
                    </td>
                </tr>
        </form>
        </table>
    </div>
</body>

</html>
