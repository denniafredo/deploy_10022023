<?php
include "../../includes/database.php";
include "../../includes/klien.php";
include "../../includes/pertanggungan.php";
include "../../includes/session.php";
include "../../includes/duit.php";

$DB=new database($userid, $passwd, $DBName);

//validasi benefit
//echo $kode;
$sql = "SELECT b.no_peserta, e.nama_orang, TO_CHAR(b.tgl_keluar_ri,'dd/mm/yyyy') tgl_keluar_ri,
            NVL(f.nama_provider, b.nama_provider) nama_provider, m.nama_kelas, SUM(a.diajukan) diajukan,
            SUM(a.disetujui) disetujui, SUM(a.piutang) piutang, b.keterangan
        FROM hc_rekam_medis_detail@askes a
        INNER JOIN hc_rekam_medis@askes b ON a.no_rekam_medis = b.no_rekam_medis
        INNER JOIN hc_master_rekam_medis@askes c ON b.no_master_rekam_medis = c.no_master_rekam_medis
        INNER JOIN hc_tertanggung@askes d ON b.no_spa = d.no_spa AND b.no_peserta = d.no_peserta
        INNER JOIN hc_orang@askes e ON d.id_orang = e.id_orang
        LEFT OUTER JOIN hc_provider@askes f ON b.kd_provider = f.kd_provider
        INNER JOIN hc_polis@askes g ON b.no_spa = g.no_spa
        LEFT OUTER JOIN hc_mutasi_peserta@askes h ON b.no_spa = h.no_spa AND b.no_peserta = h.no_peserta
         AND DECODE(b.tgl_masuk_ri, to_date('01/01/1970','dd/mm/yyyy'), b.tgl_keluar_ri, null, b.tgl_keluar_ri, b.tgl_masuk_ri) BETWEEN h.tgl_awal AND h.tgl_akhir
        LEFT OUTER JOIN hc_mutasi_peserta@askes i ON b.no_spa = i.no_spa AND b.no_peserta = i.no_peserta
         AND g.tgl_akhir_polis BETWEEN i.tgl_awal AND i.tgl_akhir
        INNER JOIN hc_registrasi_klaim@askes j ON c.no_registrasi = j.no_registrasi
        INNER JOIN hc_registrasi_klaim_detail@askes k ON b.no_registrasi_klaim_detail = k.no_registrasi_klaim_detail
         AND c.no_registrasi = k.no_registrasi
        LEFT OUTER JOIN hc_plan_benefit_spa@askes l ON b.no_spa = l.no_spa AND NVL(h.kd_plan, i.kd_plan) = l.kd_plan
         AND NVL(j.kd_klaim_benefit, k.kd_klaim_benefit) = l.kd_benefit
        LEFT OUTER JOIN hc_kelas_rs@askes m ON l.kd_kelas = m.kd_kelas
        WHERE c.no_registrasi = '$noreg'
        GROUP BY b.no_peserta, e.nama_orang, b.tgl_keluar_ri, f.nama_provider, b.nama_provider, m.nama_kelas, b.keterangan, b.no_registrasi_klaim_detail
        ORDER BY b.no_registrasi_klaim_detail";
$DB->parse($sql);
$DB->execute();
$arr=$DB->nextrow();
//echo $sql;
//die;

if(!$arr){
    echo "<script language='javascript'>alert('Proses tidak dapat dilanjutkan, silahkan verifikasi manfaat ke bagian askes terlebih dahulu');</script>";
    //echo "Polis $prefix-$noper tidak memiliki benefit $kode, sudah pernah diklaim sebelumnya atau polis sudah expirasi";
    //echo "<br /><br /><a href=javascript:window.close()>Close</a>";
    die;
} else {}



$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kode'";
$DB->parse($sql);
$DB->execute();
$arr=$DB->nextrow();
$klp=$arr["KELOMPOK"];

function Klik($userid,$passwd,$prefix,$noper,$klpbnf,&$htm)
{
    $DA = new database($userid, $passwd, $DBName);
    $PERT = New Pertanggungan($userid,$passwd,$prefix,$noper);

    //switch ($klpbnf) {
    // default:

    $sql="select to_char(min(tglb),'DD/MM/YYYY') tglbooked from ( ".
        "select min(a.tgljatuhtempo) tglb ".
        "from $DBUser.tabel_242_benefit_anuitas a,$DBUser.tabel_207_kode_benefit d ".
        "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
        "and a.kdbenefit=d.kdbenefit and d.kdkelompokbenefit='$klpbnf' and a.status='7' ".
        "union ".
        "select min(b.expirasi) tglb ".
        "from $DBUser.tabel_223_transaksi_produk b,$DBUser.tabel_207_kode_benefit c ".
        "where b.prefixpertanggungan='$prefix' and b.nopertanggungan='$noper' ".
        "and b.kdbenefit=c.kdbenefit and c.kdkelompokbenefit='$klpbnf' and ".
        "nvl(b.status,'0') in ('0','7') ".
        " ) ";
    //echo $sql;
    $DA->parse($sql);
    $DA->execute();
    $arr=$DA->nextrow();
    $tglbooked=$arr["TGLBOOKED"];
    //echo $tglbooked;
    //  $tglb = "window.opener.document.propmtc.tglbooked.value='$tglbooked';\n";
    /*
    break;
     case 'D':

        $sql = "select prefixpertanggungan,nopertanggungan ".
               "from $DBUser.tabel_200_pertanggungan ".
                        "where notertanggung='$PERT->notertanggung' and ".
                       "kdpertanggungan='2' and kdstatusfile in ('1','4') and ".
                       "prefixpertanggungan <> '$prefix' and nopertanggungan <> '$noper' ".
                        "order by prefixpertanggungan,nopertanggungan";
        $DA->parse($sql);
        $DA->execute();
        $coun=0; $pol='';
        while ($ari=$DA->nextrow()) {
                      $coun++;
                    $pol .=$ari["PREFIXPERTANGGUNGAN"]."-".$ari["NOPERTANGGUNGAN"].";";
        }
        //echo $coun;

        if (!$coun==0) {
         $tglb .="window.opener.document.propmtc.ket.value='TERTANGGUNG MEMILIKI $coun POLIS LAIN, $pol';\n";
        } else {
         $tglb .="window.opener.document.propmtc.ket.value='TERTANGGUNG TIDAK MEMILIKI POLIS LAIN.';\n";
        }
        break;
    }
       */

    $htm =	"parent.document.propmtc.prefix.value='$prefix';\n".
        "parent.document.propmtc.noper.value='$noper';\n".
        "parent.document.propmtc.tertanggung.value='".$PERT->namatertanggung."';\n".
        "parent.document.propmtc.pemegangpolis.value='".$PERT->namapemegangpolis."';\n".
        "parent.document.propmtc.valuta.value='".$PERT->namavaluta."';\n".
        "parent.document.propmtc.premi1.value='".number_format($PERT->premi1,2)."';\n".
        "\n";

}

$prefix	= strtoupper($prefix);
$sql = 	"select a.prefixpertanggungan,a.nopertanggungan ".
    "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
    "where ".
    "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' and ".
    "a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' ".
    "and a.kdpertanggungan = '2' ";
//echo $sql;
$DB->parse($sql);
$DB->execute();

if (!($ari=$DB->nextrow()))
{
    echo "<script language='javascript'>alert('Proses Gagal! Polis bukan milik rayon Anda');</script>";
    die;
    /*
    $sql = "select ".
                "to_char(tglpengajuan,'DD/MM/YYYY') tglpengajuan ".
            "from $DBUser.tabel_901_pengajuan_klaim ".
            "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
            "and kdklaim='$kode' ";
             //echo $sql;
    $DB->parse($sql);
    $DB->execute();
    if (!$arr=$DB->nextrow()) {
            echo "<script language='javascript'>alert('Proses Gagal! Polis bukan milik rayon Anda');</script>";

    } else {
            $tglklaim=$arr["TGLPENGAJUAN"];
            echo "<script language='javascript'>alert('Proses Gagal! Klaim sudah pernah diajukan');</script>";
            die ;
    }
    */
} else {
    Klik($userid,$passwd,$prefix,$noper,$klp,&$htm);
    print ("<body onload=\"".$htm."\"></body>");
}
?>