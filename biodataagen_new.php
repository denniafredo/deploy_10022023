<?
include "../../includes/session.php";
include "../../includes/database.php";
include "../includes/pertanggungan.php";
$DB = new Database($userid, $passwd, $DBName);
$DB1 = new Database($userid, $passwd, $DBName);
$conn = ocilogon("nadm", "ifg#dbs#nadm#2020", $DBName);

$sqlk = "select kdkantor from $DBUser.tabel_888_userid where userid='$userid'";
//	echo $sqlk;
$DB1->parse($sqlk);
$DB1->execute();
$arrrr = $DB1->nextrow();
$kantornya = $arrrr["KDKANTOR"];
//echo $kantornya;
//$noagen="0000002464";


#-------------------------------------Delete Foto Agen--------------------------------------
if ($act == "hapusfoto") {
    $localDir = "./fotoagen/";
    $maxWidth = 140;
    $maxHeight = 160;

    if (list($width, $height, $type, $attr) = @getimagesize($localDir . "$noagen.jpg")) {

        $xRatio = $maxWidth / $width;
        $yRatio = $maxHeight / $height;

        if (($width <= $maxWidth) && ($height <= $maxHeight)) {
            $newWidth = $width;
            $newHeight = $height;
        } else if (($xRatio * $height) < $maxHeight) {
            $newHeight = ceil($xRatio * $height);
            $newWidth = $maxWidth;
        } else {
            $newWidth = ceil($yRatio * $width);
            $newHeight = $maxHeight;
        }
        $adafoto = 1;
    } else {
        $adafoto = 0;
    }

    if ($adafoto == 1) {
        unlink("fotoagen/$noagen.jpg");
    }
}
#---------------------------------------update profile agen ----------------------------------
if (isset($update)) {
    if ($nodplk == "Proses Pengajuan") {
        $nodplk = "X";
    }
    if ($kantor == 'KP') {
        $sql = "update $DBUser.tabel_400_agen set " . //,kdpangkat='$kdpangkat'
            "statusorganik='$stsorganik', " .
            "kdkelasagen='$kdkelasagen',kdstatusagen='$kdstatusagen',statuskarir='$statuskarir',kddistribusi='$kddistribusi',npwp='$nonpwp',kdptkp='$kdptkp'," .
            //"kdkelasagen='$kdkelasagen',kdstatusagen='$kdstatusagen',kddistribusi='$kddistribusi',npwp='$nonpwp',".//kdjenjangagen='$kdjenjangagen', ".
            "kdareaoffice='$kdareaoffice',kdunitproduksi='$kdunitproduksi',noskagen='$noskagen',nolisensiagen='$nolisensiagen'," .
            "tglskagen=to_date('$tglskagen','DD/MM/YYYY'),tglmulailisensi=to_date('$tglmulailisensi','DD/MM/YYYY')," .
            "tglakhirlisensi=to_date('$tglakhirlisensi','DD/MM/YYYY')," .
            "norekening='$norekening',namabank='$namabank',nodplk='$nodplk',tglupdated=sysdate, spernyataan='$sp',PAKTA='$pakta'," .
            "userupdated=user,kdkantor=(SELECT A.KDKANTOR FROM $DBUser.tabel_400_agen A WHERE A.NOAGEN = '$noagen'),kdjabatanagen='$kdjabatanagen', bankcabang='$cabang', atasan_lama = atasan, atasan = '$atasan'
				where noagen='$noagen'";
        // $DB->parse($sql);
        // $DB->execute();
        // $DB->commit();
    } else {
        $sql = "update $DBUser.tabel_400_agen set " . //,kdpangkat='$kdpangkat'
            "statusorganik='$stsorganik', " .
            "kdkelasagen='$kdkelasagen',kdstatusagen='$kdstatusagen',statuskarir='$statuskarir',kddistribusi='$kddistribusi',npwp='$nonpwp',kdptkp='$kdptkp'," .
            //"kdkelasagen='$kdkelasagen',kdstatusagen='$kdstatusagen',kddistribusi='$kddistribusi',npwp='$nonpwp',".//kdjenjangagen='$kdjenjangagen', ".
            "kdareaoffice='$kdareaoffice',kdunitproduksi='$kdunitproduksi',noskagen='$noskagen',nolisensiagen='$nolisensiagen'," .
            "tglskagen=to_date('$tglskagen','DD/MM/YYYY'),tglmulailisensi=to_date('$tglmulailisensi','DD/MM/YYYY')," .
            "tglakhirlisensi=to_date('$tglakhirlisensi','DD/MM/YYYY')," .
            "norekening='$norekening',namabank='$namabank',nodplk='$nodplk',tglupdated=sysdate, spernyataan='$sp',PAKTA='$pakta'," .
            "userupdated=user,kdkantor=(SELECT A.KDKANTOR FROM $DBUser.tabel_400_agen A WHERE A.NOAGEN = '$noagen'),kdjabatanagen='$kdjabatanagen', bankcabang='$cabang'
						where noagen='$noagen'";
    }
    $upbiodata = ociparse($conn, $sql);
    ociexecute($upbiodata);
    //echo $sql;
    $sqlagn = "update $DBUser.tabel_100_klien set namaklien1='$nmagen',alamattetap01='$alamattetap01',alamattetap02='$alamattetap02'," .
        "noid='$noidagn', no_ponsel='$telponagn',phonetetap01='$telponagn', emailtetap='$email', jeniskelamin='$jk', tempatlahir='$tptlhr', tgllahir=to_date('$tglagen','DD/MM/YYYY') where noklien='$noagen'";
    $DB->parse($sqlagn);
    $DB->execute();
    $DB->commit();

    $sqleditpkaj = " UPDATE $DBUser.TABEL_400_PKAJ_AGEN SET NOTELPONAGEN = '$telponagn'
					WHERE NOAGEN = '$noagen' AND NOPKAJAGEN IN ( SELECT Z.NOPKAJAGEN
																 FROM (SELECT  a.NOAGEN,
																			    a.NOPKAJAGEN,
																			    /*(CASE WHEN c.NOPKAJAGEN IS NOT NULL THEN 'DONE' ELSE 'PENDING' END)*/
																				(CASE a.STATUS WHEN '0' THEN 'PENDING' WHEN '1' THEN 'DONE' END)
																			    STATUS
																    FROM         $DBUser.tabel_400_pkaj_agen a
																    LEFT OUTER JOIN
																        $DBUser.tabel_417_histori_jabatan b
																    ON a.NOPKAJAGEN = b.NOPKAJAGEN
																        AND (b.NOAGEN, b.NOPKAJAGEN, b.TGLPENETAPAN) IN
																                (  SELECT   NOAGEN, NOPKAJAGEN, MAX (TGLJABATAN)
																                        FROM   $DBUser.tabel_417_histori_jabatan
																                    WHERE   NOAGEN = '$noagen'
																                    GROUP BY   NOAGEN, NOPKAJAGEN)
																    LEFT OUTER JOIN
																        tabel_400_pkaj_agen c
																    ON a.NOPKAJAGEN = c.NOPKAJAGEN
																        AND c.NOAGEN = '$noagen'
																		WHERE   a.NOAGEN = '$noagen'
																		ORDER BY a.tglpkajagen DESC
																	   ) Z
																WHERE Z.STATUS = 'PENDING')
					";
    $updtelppkaj = ociparse($conn, $sqleditpkaj);
    ociexecute($updtelppkaj);

    echo "Data Berhasil diUpdate <br/>";
    //ECHO $sqlagn;
}
#---------------------------------------akhir update profile agen ------------------------------


#---------------------------------------insert data keluarga agen-----------------------------
if (isset($saveriwkel)) {
    $act = "";

    $namakel = strtoupper($namakel);
    $sql = "insert into $DBUser.tabel_420_keluarga_agen " .
        "(noagen,nama,hubungan,tempat_lahir,tgl_lahir) " .
        "values ('$noagen','$namakel','$hubkel','$tptlhrkel',to_date('$tglahirkel','DD/MM/YYYY'))";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapusrk") {
    $sql = "delete from $DBUser.tabel_420_keluarga_agen " .
        "where noagen='$noagen' and " .
        "tgl_lahir=to_date('$tgllahir','DD/MM/YYYY')";
    $DB->parse($sql);
    $DB->execute();
}
if (isset($updateriwkel)) {

    for ($i = 0; $i < $jum; $i++) {
        $sql = "UPDATE $DBUser.tabel_420_keluarga_agen SET nama='$namakel[$i]', hubungan='$hubkel[$i]', tempat_lahir='$tptlhrkel[$i]',tgl_lahir=to_date('$tglahirkel[$i]','DD/MM/YYYY') WHERE noagen='$noag[$i]' and tgl_lahir=to_date('$tgllahirold[$i]','DD/MM/YYYY')";
        $DB->parse($sql);
        $DB->execute();
    }
}
#-----------------------------------akhir insert data keluarga agen---------------------------

#---------------------------------------insert data Pendidikan Formal----------------------------
if (isset($savedikform)) {
    $act = "";
    switch ($kdjnspend) {
        case "01":
            $uraian = "SEKOLAH DASAR";
            break;
        case "02":
            $uraian = "SEKOLAH MENENGAH PERTAMA";
            break;
        case "03":
            $uraian = "SEKOLAH MENENGAH UMUM";
            break;
        case "04":
            $uraian = "PERGURUAN TINGGI";
            break;
    }
    $ketpendform = strtoupper($ketpendform);
    $uraian = strtoupper($uraian);
    $sql = "insert into $DBUser.tabel_414_histori_pendidikan" .
        "(noagen,tglmulai,kdkategoripendidikan,kdjenispendidikan,uraian,keterangan) " .
        "values ('$noagen',to_date('$tglmulaidikform','DD/MM/YYYY'),'01','$kdjnspend','$uraian','$ketpendform')";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapuspf") {
    $sql = "delete from $DBUser.tabel_414_histori_pendidikan " .
        "where noagen='$noagen' and kdkategoripendidikan='$kkp' and " .
        "kdjenispendidikan='$kjp'";
    $DB->parse($sql);
    $DB->execute();
}
#-----------------------------------akhir insert data Pendidikan Formal----------------------------



#---------------------------------------insert data Pendidikan Internal----------------------------
if (isset($savedikintr)) {
    $act = "";
    $ketpendintr = strtoupper($ketpendintr);
    $uraian = strtoupper($uraian);
    $sql = "insert into $DBUser.tabel_414_histori_pendidikan" .
        "(noagen,tglmulai,kdkategoripendidikan,kdjenispendidikan,uraian,keterangan) " .
        "values ('$noagen',to_date('$tglmulaidikintr','DD/MM/YYYY'),'02','99','$uraipendintr','$ketpendintr')";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapuspi") {
    $sql = "delete from $DBUser.tabel_414_histori_pendidikan " .
        "where noagen='$noagen' and kdkategoripendidikan='$kkp' and " .
        "kdjenispendidikan='$kjp' and tglmulai=to_date('$tgl','DD/MM/YYYY')";
    $DB->parse($sql);
    $DB->execute();
}
if (isset($updatedikintr)) {
    for ($i = 0; $i < $jum; $i++) {
        $sql = "update $DBUser.tabel_414_histori_pendidikan " .
            "set tglmulai=to_date('$tglmulaidikintr[$i]','DD/MM/YYYY'), " .
            "uraian='$uraiandikintr[$i]',keterangan='$ketdikintr[$i]' " .
            "where noagen='$noag[$i]' and kdkategoripendidikan='02' and " .
            "kdjenispendidikan='99' and tglmulai=to_date('$tglmulaidikintrold[$i]','DD/MM/YYYY')";
        $DB->parse($sql);
        $DB->execute();
        $DB->commit();
    }
}

#-----------------------------------akhir insert data Pendidikan internal--------------------------

#---------------------------------------insert data Pendidikan External----------------------------
if (isset($savedikextr)) {
    $act = "";
    $ketpendextr = strtoupper($ketpendextr);
    $uraian = strtoupper($uraian);
    $sql = "insert into $DBUser.tabel_414_histori_pendidikan" .
        "(noagen,tglmulai,kdkategoripendidikan,kdjenispendidikan,uraian,keterangan) " .
        "values ('$noagen',to_date('$tglmulaidikextr','DD/MM/YYYY'),'03','99','$uraipendextr','$ketpendextr')";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapuspe") {
    $sql = "delete from $DBUser.tabel_414_histori_pendidikan " .
        "where noagen='$noagen' and kdkategoripendidikan='$kkp' and " .
        "kdjenispendidikan='$kjp' and tglmulai=to_date('$tgl','DD/MM/YYYY')";
    $DB->parse($sql);
    $DB->execute();
}
if (isset($updatedikextr)) {
    for ($i = 0; $i < $jum; $i++) {
        $sql = "update $DBUser.tabel_414_histori_pendidikan " .
            "set tglmulai=to_date('$tglmulaidikextr[$i]','DD/MM/YYYY'), " .
            "uraian='$uraiandikextr[$i]',keterangan='$ketpendextr[$i]' " .
            "where noagen='$noag[$i]' and kdkategoripendidikan='03' and " .
            "kdjenispendidikan='99' and tglmulai=to_date('$tglmulaidikextrold[$i]','DD/MM/YYYY')";
        $DB->parse($sql);
        $DB->execute();
        $DB->commit();
    }
}
#-----------------------------------akhir insert data Pendidikan external--------------------------

#---------------------------------------insert data pelatihan Internal----------------------------
if (isset($savepelintr)) {
    $act = "";
    $ketpelintr = strtoupper($ketpelintr);
    $uraian = strtoupper($uraian);
    $sql = "insert into $DBUser.tabel_414_histori_pendidikan" .
        "(noagen,tglmulai,kdkategoripendidikan,kdjenispendidikan,uraian,keterangan) " .
        "values ('$noagen',to_date('$tglmulaipelintr','DD/MM/YYYY'),'04','$kdjnspel','$uraian','$ketpelintr')";
    //echo $sql;
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapuspe") {
    $sql = "delete from $DBUser.tabel_414_histori_pendidikan " .
        "where noagen='$noagen' and kdkategoripendidikan='$kkp' and " .
        "kdjenispendidikan='$kjp' and tglmulai=to_date('$tgl','DD/MM/YYYY')";
    $DB->parse($sql);
    $DB->execute();
}
if (isset($updatepelintr)) {
    for ($i = 0; $i < $jum; $i++) {
        $sql = "update $DBUser.tabel_414_histori_pendidikan " .
            "set tglmulai=to_date('$tglmulaipelintr[$i]','DD/MM/YYYY'), " .
            "kdjenispendidikan='$uraipelintr[$i]',keterangan='$ketpelintr[$i]' " .
            "where noagen='$noag[$i]' and kdkategoripendidikan='04' and " .
            "kdjenispendidikan='$uraipelintrold[$i]' and tglmulai=to_date('$tglmulaipelintrold[$i]','DD/MM/YYYY')";
        // echo $sql;
        $DB->parse($sql);
        $DB->execute();
        $DB->commit();
    }
}
#-----------------------------------akhir insert data pelatihan internal--------------------------

#---------------------------------------insert data Pengalaman kerja-------------------------------
if (isset($savepengker)) {
    $ketpengker = strtoupper($ketpengker);
    $uraipengker = strtoupper($uraipengker);
    $sql = "insert into $DBUser.tabel_415_histori_kerja" .
        "(noagen,tglmulai,uraian,keterangan) " .
        "values ('$noagen',to_date('$tglmulaipengker','DD/MM/YYYY'),'$uraipengker','$ketpengker')";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapuspk") {
    $sql = "delete from $DBUser.tabel_415_histori_kerja " .
        "where noagen='$noagen' and tglmulai=to_date('$tglk','DD/MM/YYYY')";
    $DB->parse($sql);
    $DB->execute();
}
if (isset($updatepengker)) {
    for ($i = 0; $i < $jum; $i++) {
        $ketpengker[$i] = strtoupper($ketpengker[$i]);
        $uraipengker[$i] = strtoupper($uraipengker[$i]);
        $sql = "update $DBUser.tabel_415_histori_kerja " .
            "set tglmulai=to_date('$tglmulaipengker[$i]','DD/MM/YYYY'), " .
            "uraian='$uraipengker[$i]',keterangan='$ketpengker[$i]' " .
            "where noagen='$noagen' and tglmulai=to_date('$tglmulaipengkerold[$i]','DD/MM/YYYY')";
        //echo $sql;
        $DB->parse($sql);
        $DB->execute();
        $DB->commit();
    }
}
#---------------------------------------akhir insert data Pengalaman kerja-------------------------------

#---------------------------------------insert data jasa-------------------------------------------------
if (isset($savejasa)) {
    $ketjasa = strtoupper($ketjasa);
    $uraijasa = strtoupper($uraijasa);
    $sql = "insert into $DBUser.tabel_416_histori_jasa" .
        "(noagen,kdjenisjasa,tgljasa,uraian,keterangan) " .
        "values ('$noagen','1',to_date('$tglmulaijasa','DD/MM/YYYY'),'$uraijasa','$ketjasa')";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapusj") {
    $sql = "delete from $DBUser.tabel_416_histori_jasa " .
        "where noagen='$noagen' and kdjenisjasa='$kjj' and " .
        "tgljasa=to_date('$tglj','DD/MM/YYYY')";
    $DB->parse($sql);
    $DB->execute();
}
if (isset($updatejasa)) {
    for ($i = 0; $i < $jum; $i++) {
        $ketjasa[$i] = strtoupper($ketjasa[$i]);
        $uraijasa[$i] = strtoupper($uraijasa[$i]);
        $sql = "update $DBUser.tabel_416_histori_jasa " .
            "set tgljasa=to_date('$tglmulaijasa[$i]','DD/MM/YYYY'), " .
            "uraian='$uraijasa[$i]',keterangan='$ketjasa[$i]' " .
            "where noagen='$noag[$i]' and kdjenisjasa='1' and " .
            "tgljasa=to_date('$tglmulaijasaold[$i]','DD/MM/YYYY')";
        //echo $sql;
        $DB->parse($sql);
        $DB->execute();
        $DB->commit();
    }
}
#---------------------------------------akhir insert data jasa--------------------------------------------

#---------------------------------------insert data sanksi-------------------------------------------------
if (isset($savesanksi)) {
    $ketsanksi = strtoupper($ketsanksi);
    $uraisanksi = strtoupper($uraisanksi);
    $sql = "insert into $DBUser.tabel_416_histori_jasa" .
        "(noagen,kdjenisjasa,tgljasa,uraian,keterangan) " .
        "values ('$noagen','0',to_date('$tglmulaisanksi','DD/MM/YYYY'),'$uraisanksi','$ketsanksi')";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit();
}
if ($act == "hapuss") {
    $sql = "delete from $DBUser.tabel_416_histori_jasa " .
        "where noagen='$noagen' and kdjenisjasa='$kjs' and " .
        "tgljasa=to_date('$tgls','DD/MM/YYYY')";
    $DB->parse($sql);
    $DB->execute();
}
if (isset($updatesanksi)) {
    for ($i = 0; $i < $jum; $i++) {
        $ketsanksi[$i] = strtoupper($ketsanksi[$i]);
        $uraisanksi[$i] = strtoupper($uraisanksi[$i]);
        $sql = "update $DBUser.tabel_416_histori_jasa " .
            "set tgljasa=to_date('$tglmulaisanksi[$i]','DD/MM/YYYY'), " .
            "uraian='$uraisanksi[$i]',keterangan='$ketsanksi[$i]' " .
            "where noagen='$noag[$i]' and kdjenisjasa='0' and " .
            "tgljasa=to_date('$tglmulaisanksiold[$i]','DD/MM/YYYY')";
        //echo $sql;
        $DB->parse($sql);
        $DB->execute();
        $DB->commit();
    }
}
#---------------------------------------akhir insert data sanksi------------------------------------------------


#-------------------------------------- insert data riwayat jabatan agen------- --------------------------------
if ($insjabatan) {
    $ketjabatan = strtoupper($ketjabatan);
    $uraianjabatan = strtoupper($uraianjabatan);
    $sql = "insert into $DBUser.tabel_417_histori_jabatan" .
        "(noagen,tgljabatan,kdjabatanagen,kdkelasagen,uraian,keterangan, kdkantor, kdareaoffice,kdunitproduksi,nopkajagen,tglpenetapan) " .
        "values ('$noagen',to_date('$tgljabatan','DD/MM/YYYY'),'$kdjabatanagen','$kdkelasagen','$uraianjabatan','$ketjabatan'," .
        "'$ktrbo','$ktrao','$kdup','$nopkaj',to_date('$tglpenetapan','DD/MM/YYYY'))";
      $DB->parse($sql);
      $DB->execute();
    //   $DB->commit();
    // echo $sql;
}
if ($act == "hapusriwjab") {
    $sql = "select keterangan
			from $DBUser.tabel_417_histori_jabatan
			where noagen='$noagen' and kdjabatanagen='$kja' and trunc(tgljabatan)=to_date('$tgljab','dd/mm/yyyy')
				";
    $DB->parse($sql);
    $DB->execute();
    $arr = $DB->nextrow();

    if ($kantornya == 'KP' or ($kantornya != 'KP' && empty($arr['KETERANGAN']))) {
        $sql = "delete from $DBUser.tabel_417_histori_jabatan " .
            "where noagen='$noagen' and kdjabatanagen='$kja' and " .
            "trunc(tgljabatan)=to_date('$tgljab','DD/MM/YYYY')";
        $DB->parse($sql);
        $DB->execute();
    } else {
        echo "Hanya divisi keagenan yang dapat menghapus Jabatan ini.";
        exit;
    }
}
if (isset($updateriwjab)) {
}
#-------------------------------------- akhir insert data riwayat jabatan agen  --------------------------------

$sql = "select " .
    "a.noklien," .
    "b.STATUS_JOIN_TEAM, to_char(b.TGLJOINTEAM,'dd/mm/yyyy') as TGLJOINTEAM," .
    "a.namaklien1," .
    "a.kdagama," .
    "a.gelar," .
    "decode(a.jeniskelamin,'L','LAKI','PEREMPUAN') jnskelamin," .
    "decode(a.meritalstatus,'D','DUDA','K','KAWIN','J','JANDA','LAJANG') meritalstatus," .
    "a.tempatlahir," .
    "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir," .
    "to_char(b.tglrekam,'DD/MM/YYYY') tglrekam," .
    "a.alamattetap01,a.alamattetap02," .
    "a.kdkotamadyatetap," .
    "g.namabank," .
    "b.bankcabang," .
    "b.kdjabatanagen," .
    "a.phonetetap01," .
    "a.jeniskelamin," .
    "b.prefixagen," .
    "to_char(b.tglmulailisensi,'DD-MM-YYYY') tglmulailisensi,to_char(b.tglakhirlisensi,'DD-MM-YYYY') tglakhirlisensi,b.nolisensiagen," .
    "b.namasdr,b.alamatsdr,b.notelpsdr,b.namarekr,b.noagenrekr," .
    "b.kdjabatanrekr,b.hubungansdr," .
    "b.kdkelasagen," .
    "b.kdptkp," .
    "b.kdpangkat," .
    "b.kdunitproduksi," .
    "b.kdareaoffice," .
    "b.fotoagen," .
    "b.bukurekagen," .
    "b.ktpagen," .
    "b.noskagen," .
    "decode(b.statuskarir,'1','KARIR','0','NON KARIR','N/A') statuskarir," .
    "b.kdkantor," .
    "b.tglskagen,decode(spernyataan,'0','TIDAK ADA','ADA') spernyataan,decode(NVL(PAKTA,0),'0','TIDAK ADA','ADA') PAKTA," .
    "c.namaagama," .
    "(select namaareaoffice from $DBUser.tabel_410_area_office d where d.kdareaoffice=b.kdareaoffice and d.kdkantor=b.kdkantor) as namaareaoffice," .
    "e.namapangkat," .
    "h.namastatusagen," .
    "f.namajabatanagen,b.npwp,b.kddistribusi,b.norekening,b.nodplk, " .
    "DECODE(NVL(b.statusorganik,0),0,'NON ORGANIK','ORGANIK') statusorganik " .
    //"(select trgpreminbpp from ".
    //"$DBUser.tabel_418_histori_target_agen where noagen=b.noagen) as targetpremiakhir ".
    "from " .
    "$DBUser.tabel_100_klien a," .
    "$DBUser.tabel_400_agen b," .
    "$DBUser.tabel_102_agama c," .
    // "$DBUser.tabel_410_area_office d,".
    "$DBUser.tabel_406_kode_pangkat_agen e," .
    "$DBUser.tabel_399_bank g," .
    "$DBUser.tabel_409_status_agen h," .
    "$DBUser.tabel_413_jabatan_agen f " .
    //"$DBUser.tabel_418_histori_target_agen g ".
    "where " .
    "a.noklien=b.noagen and " .
    "a.kdagama=c.kdagama(+) and " .
    // "d.kdareaoffice=b.kdareaoffice(+) and ".
    // "d.kdkantor=b.kdkantor and ".
    "b.kdpangkat=e.kdpangkat and " .
    "b.kdjabatanagen=f.kdjabatanagen and " .
    "b.namabank=g.kdbank(+) and " .
    "b.kdstatusagen=h.kdstatusagen and " .
    //"b.noagen=g.noagen(+) and ".
    "a.noklien='$noagen'";
//echo $sql."<br><br>";
// $DB->parse($sql);
//  $DB->execute();
// $arr=$DB->nextrow();
$detail = oci_parse($conn, $sql);
ociexecute($detail);
$arr = oci_fetch_array($detail, OCI_BOTH);
$prefixagen = $arr["PREFIXAGEN"];
$qry = "select namaklien1, to_char(tgllahir,'DD/MM/YYYY') tgllahir, noid,phonetetap01, emailtetap from $DBUser.tabel_100_klien where noklien='$noagen'";
//echo $qry;
$DB->parse($qry);
$DB->execute();
$ass = $DB->nextrow();
$namaagen = $ass["NAMAKLIEN1"];
$tgllhr = $ass["TGLLAHIR"];
$noid = $ass["NOID"];
$phone = $ass["PHONETETAP01"];
$email = $ass["EMAILTETAP"];


//echo $qry;


#----------------------------------------------------------------------------------------------
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../includes/jquery-1.7.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
<script language="JavaScript">
    function GantiCari(theForm) {

        var tgl = theForm.tgljabatan.value;
        var ur = theForm.uraianjabatan.value;
        var ao = theForm.kdarea.value;
        var kls = theForm.kdkelasagen.value;
        var jbt = theForm.kdjabatanagen.value;
        var bo = theForm.kdkantorX.value;
        var agn = theForm.agn.value;
        var addriwjab = theForm.addriwjab.value;
        window.location.replace('?noagen=' + agn + '&ktrbo=' + bo + '&ktrao=' + ao + '&kelas=' + kls + '&urai=' + ur + '&act=' + addriwjab + '&jab=' + jbt + '&tahun=' + tgl + '#awaledit');
    }

    $(document).ready(function() {
        $("#kdao").change(function() {
            $.ajax({
                type: "post",
                dataType: "html",
                url: "ajax_unit_produksi.php",
                data: "kdkantor=<?= $kantor ?>&kdareaoffice=" + this.value,
                success: function(data) {
                    $("#kdup").html(data);
                }
            });
        });
    });
</script>
<a class="verdana10blu"><b>BIODATA PERSONALIA AGEN</b></a>
<hr size="1" />
<div align="center">
    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#006699" width="800" id="AutoNumber1">
        <tr>
            <td width="100%" bgcolor="#6CABCA" class="verdana10wht">
                <p align="center"><b>BIODATA AGEN DENGAN NO. AGEN <? echo $arr["PREFIXAGEN"] . "-" . $noagen; ?></span>
            </td>
        </tr>
        <tr>
            <td width="100%" bgcolor="#DAF3EC" class="verdana9blu"><b>IDENTITAS</b>
                <? if ($act == "editbio") {
                    $qry = "select namaklien1, tempatlahir, to_char(tgllahir,'DD/MM/YYYY') tgllahir, jeniskelamin, noid,phonetetap01, emailtetap,alamattetap01,alamattetap02 from $DBUser.tabel_100_klien where noklien='$noagen'";
                    $DB->parse($qry);
                    $DB->execute();
                    $ass = $DB->nextrow();
                    $tptlhr = $ass["TEMPATLAHIR"];
                    $namaagen = $ass["NAMAKLIEN1"];
                    $tgllhr = $ass["TGLLAHIR"];
                    $jk = $ass["JENISKELAMIN"];
                    $noid = $ass["NOID"];
                    $phone = $ass["PHONETETAP01"];
                    $email = $ass["EMAILTETAP"];
                    $sql = "select a.noagen,a.atasan,a.prefixagen,a.kdpangkat,a.kdkelasagen,a.kdjenjangagen,a.kdstatusagen," .
                        "a.kdjabatanagen,NVL(a.statusorganik,0) statusorganik,NVL(spernyataan,0) spernyataan,NVL(pakta,0) pakta, " .
                        "a.kdareaoffice,b.namaareaoffice,a.kdunitproduksi,a.noskagen,to_char(a.tglskagen,'DD/MM/YYYY') tglskagen," .
                        "a.norekening,a.namabank,a.tglrekam,a.userrekam,a.statuskarir, " .
                        "a.kddistribusi,a.npwp,a.nodplk,a.tglupdated,a.userupdated," .
                        "a.kdkantor,a.bankcabang,a.kdptkp,a.nolisensiagen,to_char(a.tglmulailisensi,'DD/MM/YYYY') tglmulailisensi,to_char(a.tglakhirlisensi,'DD/MM/YYYY') tglakhirlisensi,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, fotoagen,bukurekagen,ktpagen,statuskarir" .
                        " from $DBUser.tabel_400_agen a" .
                        " left outer join $DBUser.tabel_410_area_office b ON a.kdkantor = b.kdkantor AND a.kdareaoffice = b.kdareaoffice " .
                        " where a.noagen='$noagen'";
                    //echo $sql;
                    $DB->parse($sql);
                    $DB->execute();
                    $arc = $DB->nextrow();
                    //print_r($arc);
                    //echo $qry;
                    //echo $namaagen;
                ?>

                    <script>
                        function kantor(theForm) {
                            var agn = agen.noagen.value;
                            var kantorpilihan = agen.kantorpilihan.value;
                            var editbio = 'editbio';
                            window.location.replace('?act=' + editbio + '&noagen=' + agn + '&kantorpilihan=' + kantorpilihan + '#awaledit');
                        }
                    </script>
                    <center>
                        <table border="0" cellpadding="3" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber8" width="100%">
                            <form method="POST" name="agen" action="biodataagen_new.php">

                                <tr>

                                    <td width="18%" valign="top" class="verdana8blu">Nama Agen </td>
                                    <td width="35%" class="verdana8blu"><b><input type="hidden" name="prefixagen" size="3" value="<? echo $kantor; ?>" readonly>
                                            <input type="hidden" name="noagen" size="12" maxlength="10" value="<? echo $arc["NOAGEN"]; ?>" readonly><input type="text" name="nmagen" size="25" value="<? echo $namaagen; ?>"></b></td>
                                    <td width="15%" valign="top" class="verdana8blu">Tgl Lahir </td>
                                    <td width="32%" class="verdana8blu"><input type="text" name="tptlhr" size="20" value="<? echo $tptlhr; ?>">, <input type="text" name="tglagen" size="8" value="<? echo $tgllhr; ?>"></td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Email</td>
                                    <td class="verdana8blu"><input type="text" name="email" size="20" value="<? echo $email; ?>"></td>
                                    <td class="verdana8blu" valign="top">Area Office </td>
                                    <td class="verdana8blu">
                                        <? if ($kantornya == "KP") {
                                            $disabled = $userid != 'BAG_KP' ? "disabled='true'" : '';
                                        ?><select size="1" id="kdao" name="kdareaoffice" <?= $disabled ?>>
                                                <option value=''></option>
                                                <?
                                                $sql = "select * from $DBUser.tabel_410_area_office  where status is null and kdkantor='$kantor'";
                                                $DB->parse($sql);
                                                $DB->execute();
                                                while ($arr = $DB->nextrow()) {
                                                    if ($arr["KDAREAOFFICE"] == $arc["KDAREAOFFICE"]) {
                                                        echo "<option value='" . $arr["KDAREAOFFICE"] . "' selected>" . $arr["NAMAAREAOFFICE"] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $arr["KDAREAOFFICE"] . "'>" . $arr["NAMAAREAOFFICE"] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        <? } else {
                                            /*$sql = "select * from $DBUser.tabel_410_area_office  where status is null and kdkantor='$kantor' and kdareaoffice='".$arc["KDAREAOFFICE"]."'";
		  		 $DB->parse($sql);
		  		 $DB->execute();
				 $arr=$DB->nextrow();
			echo $arr["NAMAAREAOFFICE"];
			echo " <input type=hidden name=kdareaoffice value='".$arc["KDAREAOFFICE"]."' />";*/
                                            echo "$arc[NAMAAREAOFFICE]<input type='hidden' name='kdareaoffice' value='$arc[KDAREAOFFICE]' />";
                                        } ?>
                                    </td>
                                </tr>
                                <tr>

                                    <?php
                                    $sqlktratasan = "SELECT kdkantor from $DBUser.tabel_400_agen where noagen = '" . $arc["ATASAN"] . "'";
                                    $atasanktr = ociparse($conn, $sqlktratasan);
                                    ociexecute($atasanktr);
                                    ocifetch($atasanktr);
                                    $ktratasan2 = ociresult($atasanktr, "KDKANTOR");
                                    //print_r($ktratasan2);
                                    ?>
                                    <td class="verdana8blu" valign="top">Kode Kantor Atasan</td>
                                    <td class="verdana8blu">
                                        <select size="1" id="kantorpilihan" onChange="kantor(document.agen)" name="kantorpilihan" <? if ($kantor != 'KP') {
                                                                                                                                        echo 'disabled';
                                                                                                                                    } ?>>
                                            <?php
                                            $kntrsql = "Select kdkantor, namakantor from $DBUser.tabel_001_kantor order by kdkantor ";
                                            //echo $kntrsql;die;
                                            $kantoratasan = ociparse($conn, $kntrsql);
                                            ociexecute($kantoratasan);
                                            $pilih = '';
                                            while (($row = oci_fetch_array($kantoratasan, OCI_BOTH)) != false) {

                                                if (empty($kantorpilihan)) {
                                                    if ($row["KDKANTOR"] == $ktratasan2) {
                                                        $pilih = 'selected';
                                                    } else {
                                                        $pilih = '';
                                                    }
                                                } else {
                                                    if ($kantorpilihan == $row["KDKANTOR"]) {
                                                        $pilih = 'selected';
                                                    } else {
                                                        $pilih = '';
                                                    }
                                                }
                                                echo "<option value=" . $row["KDKANTOR"] . " " . $pilih . ">" . $row["KDKANTOR"] . "-" . $row["NAMAKANTOR"] . "</option>";
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="verdana8blu" valign="top">Atasan</td>
                                    <td class="verdana8blu"><select size="1" id="atasan" name="atasan" <? if ($kantor != 'KP') {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                            <?
                                            if (isset($kantorpilihan)) {
                                                $sql = "SELECT A.NOAGEN, (SELECT NAMAKLIEN1 FROM $DBUser.tabel_100_klien where noklien = A.noagen ) as namaagen
				    FROM $DBUser.tabel_400_agen A
				    WHERE kdstatusagen = '01' AND A.kdkantor = '$kantorpilihan'
				    	  AND A.KDJABATANAGEN IN ('24','25','26')
				    	  AND A.KDJABATANAGEN <> '19'
				   	UNION ALL
				   	SELECT A.NOAGEN, (SELECT NAMAKLIEN1 FROM $DBUser.tabel_100_klien where noklien = A.noagen ) as namaagen
				    FROM $DBUser.tabel_400_agen A, $DBUser.tabel_400_sam_kantor_merge B
				    WHERE kdstatusagen = '01' AND A.noagen = B.no_sam
				    	  AND B.kode_kantor = '$kantorpilihan'
				   	Order by namaagen
				   ";
                                            } else {
                                                $sql = "SELECT A.NOAGEN, (SELECT NAMAKLIEN1 FROM $DBUser.tabel_100_klien where noklien = A.noagen ) as namaagen
				    FROM $DBUser.tabel_400_agen A
				    WHERE kdstatusagen = '01' AND A.kdkantor = '$ktratasan2'
				    	  AND A.KDJABATANAGEN IN ('24','25','26')
				    	  AND A.KDJABATANAGEN <> '19'
				   	UNION ALL
				   	SELECT A.NOAGEN, (SELECT NAMAKLIEN1 FROM $DBUser.tabel_100_klien where noklien = A.noagen ) as namaagen
				    FROM $DBUser.tabel_400_agen A, $DBUser.tabel_400_sam_kantor_merge B
				    WHERE kdstatusagen = '01' AND A.noagen = B.no_sam
				    	  AND B.kode_kantor = '$ktratasan2'
				   	Order by namaagen
				   ";
                                            }
                                            $atasanlangsung = ociparse($conn, $sql);
                                            ociexecute($atasanlangsung);
                                            $pilih = '';
                                            while (($row = oci_fetch_array($atasanlangsung, OCI_BOTH)) != false) {
                                                if ($row["NOAGEN"] == $arc["ATASAN"]) {
                                                    $pilih = 'selected';
                                                } else {
                                                    $pilih = '';
                                                }
                                                echo "<option value=" . $row["NOAGEN"] . " " . $pilih . ">" . $row["NAMAAGEN"] . "</option>";
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">No. ID </td>
                                    <td class="verdana8blu" valign="top"><input type="text" name="noidagn" size="25" value="<? echo $noid; ?>"></td>
                                    <td class="verdana8blu" valign="top">No. Rekening </td>
                                    <td class="verdana8blu">
                                        <?
                                        // $conn = ocilogon($userid, $passwd, $DBName);
                                        $sqlrek1 = "select statusrek from $DBUser.tabel_400_agen where noagen='" . $arc["NOAGEN"] . "'";
                                        $sqlrek = ociparse($conn, $sqlrek1);
                                        ociexecute($sqlrek);
                                        ocifetch($sqlrek);
                                        if (ociresult($sqlrek, "STATUSREK") < 2) {
                                        ?>
                                            <input type="text" name="norekening" size="20" value="<? echo $arc["NOREKENING"]; ?>">
                                        <?
                                        } else {
                                        ?>
                                            <input type="text" name="norekening" size="20" value="<? echo $arc["NOREKENING"]; ?>" readonly>
                                            <input type="text" name="alamattetap02" maxlength="30" size="40" value="<? echo $ass["ALAMATTETAP02"]; ?>" />
                                        <? } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">No. Telepon </td>
                                    <td class="verdana8blu"><input type="text" name="telponagn" size="25" value="<? echo $phone; ?>"></td>
                                    <td class="verdana8blu" valign="top">Nama Bank </td>
                                    <td class="verdana8blu"><select size="1" name="namabank">
                                            <?
                                            $sql = "select * from $DBUser.tabel_399_bank where norekening is not null and kdbank='BRI'";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {

                                                if ($arr["KDBANK"] == $arc["NAMABANK"]) {
                                                    echo "<option value=" . $arr["KDBANK"] . " selected>" . $arr["NAMABANK"] . "</option>";
                                                } else {
                                                    echo "<option value=" . $arr["KDBANK"] . ">" . $arr["NAMABANK"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Kelas Agen </td>
                                    <td class="verdana8blu">
                                        <select size="1" name="kdkelasagen">
                                            <?
                                            $sql = "select * from $DBUser.tabel_408_kode_kelas_agen";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($arr["KDKELASAGEN"] == $arc["KDKELASAGEN"]) {
                                                    echo "<option value=" . $arr["KDKELASAGEN"] . " selected>" . $arr["NAMAKELASAGEN"] . "</option>";
                                                } else {
                                                    echo "<option value=" . $arr["KDKELASAGEN"] . ">" . $arr["NAMAKELASAGEN"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" valign="top">Cabang Bank </td>
                                    <td class="verdana8blu"><input type="text" name="cabang" size="25" value="<? echo $arc["BANKCABANG"]; ?>" onBlur="javascript:convert_date(tglskagen)"></td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Jabatan</td>
                                    <td class="verdana8blu"><?

                                                            if ($kantornya == "KP") {
                                                            ?><select size="1" name="kdjabatanagen">
                                                <?
                                                                $sql = "select * from $DBUser.tabel_413_jabatan_agen";
                                                                $DB->parse($sql);
                                                                $DB->execute();
                                                                while ($arr = $DB->nextrow()) {
                                                                    if ($arr["KDJABATANAGEN"] == $arc["KDJABATANAGEN"]) {
                                                                        echo "<option value=" . $arr["KDJABATANAGEN"] . " selected>" . $arr["NAMAJABATANAGEN"] . "</option>";
                                                                    } else {
                                                                        echo "<option value=" . $arr["KDJABATANAGEN"] . ">" . $arr["NAMAJABATANAGEN"] . "</option>";
                                                                    }
                                                                }
                                                ?>
                                            </select><? } else {
                                                                $sql = "select * from $DBUser.tabel_413_jabatan_agen where kdjabatanagen='" . $arc["KDJABATANAGEN"] . "'";
                                                                $DB->parse($sql);
                                                                $DB->execute();
                                                                $arr = $DB->nextrow();
                                                                echo $arr["NAMAJABATANAGEN"];
                                                                echo "<input type=hidden name=kdjabatanagen value=" . $arc["KDJABATANAGEN"] . " />";
                                                            }
                                                        ?>
                                    </td>
                                    <td class="verdana8blu" valign="top">No. SPA </td>
                                    <td class="verdana8blu"><input type="text" name="noskagen" size="20" value="<? echo $arc["NOSKAGEN"]; ?>" <? if ($kantornya != 'KP') { ?> readonly <? } ?>>
                                        <input type="text" name="tglskagen" size="10" value="<? echo $arc["TGLSKAGEN"]; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Karir Keagenan</td>
                                    <td class="verdana8blu"><select size="1" name="statuskarir">

                                            <?
                                            if ($arr["STATUSKARIR"] == 1) {
                                                echo "<option value='1' selected>KARIR</option>";
                                                echo "<option value='0'>NON KARIR</option>";
                                            } else {
                                                echo "<option value='1'>KARIR</option>";
                                                echo "<option value='0' selected>NON KARIR</option>";
                                            }
                                            ?>
                                        </select></td>
                                    <td class="verdana8blu" valign="top">&nbsp;</td>
                                    <td class="verdana8blu">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Status Agen </td>
                                    <td class="verdana8blu"><? //echo $kantor.$arc["KDSTATUSAGEN"];
                                                            if (($kantor <> 'KP') && ($arc["KDSTATUSAGEN"] == '02')) {
                                                                $stsagen = " where kdstatusagen not in ('01')";
                                                            } else {
                                                                $stsagen = "";
                                                            }

                                                            // jika bukan kantor KP maka buat temporary variabel untuk membuka disable select kdstatusagen
                                                            echo $kantor != 'KP' ? "<input type='hidden' name='kdstatusagen' value='$arc[KDSTATUSAGEN]' />" : ""
                                                            ?>
                                        <select size="1" name="kdstatusagen" <? if ($kantornya != 'KP') { ?> disabled <? } ?>>
                                            <?
                                            $sql = "select * from $DBUser.tabel_409_status_agen" . $stsagen;
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($arr["KDSTATUSAGEN"] == $arc["KDSTATUSAGEN"]) {
                                                    echo "<option value=" . $arr["KDSTATUSAGEN"] . " selected>" . $arr["NAMASTATUSAGEN"] . "</option>";
                                                } else {
                                                    echo "<option value=" . $arr["KDSTATUSAGEN"] . ">" . $arr["NAMASTATUSAGEN"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" valign="top">Unit Produksi </td>
                                    <td class="verdana8blu"><? if ($kantornya == "KP") {
                                                                $disabled = $userid != 'BAG_KP' ? "disabled='true'" : ''; ?><select id="kdup" class="c" size="1" name="kdunitproduksi" <?= $disabled ?>>
                                                <option value=""></option>
                                                <?
                                                                $sql = "select kdunitproduksi,namaunitproduksi,kdareaoffice, " .
                                                                    "(select namaareaoffice from $DBUser.tabel_410_area_office where " .
                                                                    "kdkantor='$kantor' and kdareaoffice=a.kdareaoffice) as area from " .
                                                                    "$DBUser.tabel_410_kode_unit_produksi a " .
                                                                    "where status is null and kdkantor='$kantor' and kdareaoffice = '$arc[KDAREAOFFICE]'" .
                                                                    "order by kdareaoffice";
                                                                //echo $sql;
                                                                $DB->parse($sql);
                                                                $DB->execute();
                                                                while ($art = $DB->nextrow()) {
                                                                    if ($art["KDUNITPRODUKSI"] == $arc["KDUNITPRODUKSI"] && $art["KDAREAOFFICE"] == $arc["KDAREAOFFICE"]) {
                                                                        echo "<option value='" . $art["KDUNITPRODUKSI"] . "' selected>" . $art["NAMAUNITPRODUKSI"] . "</option>";
                                                                    } else {
                                                                        echo "<option value='" . $art["KDUNITPRODUKSI"] . "'>" . $art["NAMAUNITPRODUKSI"] . "</option>";
                                                                    }
                                                                }

                                                ?>
                                            </select>
                                        <? } else {
                                                                /*$sql = "select kdunitproduksi,namaunitproduksi,kdareaoffice, ".
			   "(select namaareaoffice from $DBUser.tabel_410_area_office where ".
			   "kdkantor='$kantor' and kdareaoffice=a.kdareaoffice) as area from ".
					 			  "$DBUser.tabel_410_kode_unit_produksi a ".
									"where status is null and kdkantor='$kantor' and kdareaoffice='".$arc["KDAREAOFFICE"]."' and kdunitproduksi='".$arc["KDUNITPRODUKSI"]."'";
		  		// echo $sql;
				 $DB->parse($sql);
		  		 $DB->execute();
				 $art=$DB->nextrow();
			echo $art["AREA"]." - ".$art["NAMAUNITPRODUKSI"];
			echo "<input type=hidden name=kdunitproduksi value='".$arc["KDUNITPRODUKSI"]."' />";*/
                                                                echo "<input type='hidden' name='kdunitproduksi' value='$arc[KDUNITPRODUKSI]' />";
                                                            } ?></td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Saluran Distribusi</td>
                                    <td class="verdana8blu"><select size="1" name="kddistribusi">
                                            <?
                                            $sql = "select * from $DBUser.TABEL_409_STS_DISTRIBUSI_AGEN";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($arr["KDDISTRIBUSI"] == $arc["KDDISTRIBUSI"]) {
                                                    echo "<option value=" . $arr["KDDISTRIBUSI"] . " selected>" . $arr["NAMADISTRIBUSI"] . "</option>";
                                                } else {
                                                    echo "<option value=" . $arr["KDDISTRIBUSI"] . ">" . $arr["NAMADISTRIBUSI"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select></td>
                                    <td class="verdana8blu" valign="top">NPWP</td>
                                    <td class="verdana8blu">
                                        <?php $numtgl = (int)date('md'); ?>
                                        <input type="text" name="nonpwp" size="20" value="<? echo $arc["NPWP"]; ?>" <?php if ($arc["KDJABATANAGEN"] == "29" || $numtgl < 116) {
                                                                                                                        echo "";
                                                                                                                    } else {
                                                                                                                        echo "readonly";
                                                                                                                    } ?>>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">No. DPLK</td>
                                    <td class="verdana8blu"><input type="text" name="nodplk" size="20" value="<? if ($arc["NODPLK"] == "X") {
                                                                                                                    echo "Proses Pengajuan";
                                                                                                                } else {
                                                                                                                    echo $arc["NODPLK"];
                                                                                                                } ?>"></td>
                                    <td class="verdana8blu" valign="top">Status Pegawai</td>
                                    <td class="verdana8blu"><select size="1" name="stsorganik">
                                            <?
                                            if ($arc["STATUSORGANIK"] == 1) {
                                                echo "<option value='1' selected>ORGANIK</option>";
                                                echo "<option value='0'>NON ORGANIK</option>";
                                            } else {
                                                echo "<option value='1'>ORGANIK</option>";
                                                echo "<option value='0' selected>NON ORGANIK</option>";
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Status PTKP *) </td>
                                    <td class="verdana8blu">
                                        <!-- If select disabled then add value variable sp to text input by fendy 04012022 -->
                                        <input type="hidden" name="kdptkp" value="<?= $arc["KDPTKP"] ?>" />
                                        <select size="1" name="kdptkp" <?php if ($arc["KDJABATANAGEN"] == "29" || $numtgl < 116) {
                                                                            echo "";
                                                                        } else {
                                                                            echo "disabled";
                                                                        } ?>>
                                            <?
                                            $sql = "select * from $DBUser.TABEL_400_PTKP order by kdptkp";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($arr["KDPTKP"] == $arc["KDPTKP"]) {
                                                    echo "<option value=" . $arr["KDPTKP"] . " selected>" . $arr["KETERANGAN"] . "</option>";
                                                } else {
                                                    echo "<option value=" . $arr["KDPTKP"] . ">" . $arr["KETERANGAN"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" valign="top">Jenis Kelamin </td>
                                    <td class="verdana8blu" valign="top"><select size="1" name="jk">
                                            <? if ($jk == 'L') { ?>
                                                <option value='L' selected>LAKI-LAKI</option>
                                                <option value='P'>PEREMPUAN</option>
                                            <? } elseif ($jk == 'P') {    ?>
                                                <option value='P' selected>PEREMPUAN</option>
                                                <option value='L'>LAKI-LAKI</option>
                                            <? } elseif ($jk == '') {    ?>
                                                <option value=''>BELUM ADA</option>
                                                <option value='P'>PEREMPUAN</option>
                                                <option value='L'>LAKI-LAKI</option>
                                            <? } ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Alamat Agen</td>
                                    <td class="verdana8blu"><input type="text" name="alamattetap01" maxlength="30" size="40" value="<? echo $ass["ALAMATTETAP01"]; ?>" /><br /><input type="text" name="alamattetap02" maxlength="30" size="40" value="<? echo $ass["ALAMATTETAP02"]; ?>" /></td>
                                    <td valign="top" class="verdana8blu">Surat Pernyataan Penghasilan</td>
                                    <td class="verdana8blu" valign="top">
                                        <!-- If select disabled then add value variable sp to text input by fendy 04012022 -->
                                        <input type="hidden" name="sp" value="<?= $arc["SPERNYATAAN"] ?>" />
                                        <select size="1" name="sp" <?php if ($numtgl < 116) {
                                                                        echo "";
                                                                    } else {
                                                                        echo "disabled";
                                                                    } ?>>
                                            <? if ($arc["SPERNYATAAN"] == '1') { ?>
                                                <option value='1' selected>ADA</option>
                                                <option value='0'>TIDAK ADA</option>
                                            <? } elseif ($arc["SPERNYATAAN"] == '0') {    ?>
                                                <option value='0' selected>TIDAK ADA</option>
                                                <option value='1'>ADA</option>
                                            <? } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">Tanggal Rekam</td>
                                    <td class="verdana8blu"><? echo $arc["TGLREKAM"]; ?></td>
                                    <!--<td valign="top" class="verdana8blu">Surat Pakta Integritas</td>
	    <td class="verdana8blu" valign="top"><select size="1" name="pakta">
		<? if ($arc["PAKTA"] == '1') { ?>
					<option value='1' selected>ADA</option>
					<option value='0'>TIDAK ADA</option>
		<? } elseif ($arc["PAKTA"] == '0') {    ?>
					<option value='0' selected>TIDAK ADA</option>
					<option value='1'>ADA</option>
		<? } ?>
        </select></td>-->
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">No. Lisensi Agen </td>
                                    <?
                                    $exclude_list = array("BAG_KP", "SUMITRA", "IMEL_BA", "FENDY");
                                    //if ($userid<>"ERNES_KP" || $userid<>"SYARI_KP"|| $userid<>"IMEL_BA"){$disabled=" disabled ";} else {$disabled="";}
                                    //if (!in_array($userid, $exclude_list)){$disabled=" readonly='readonly' ";} else {$disabled="";}
                                    $disabled = in_array($modul, array('ALL', 'MKL', 'ITC')) ? "" : " readonly='readonly' ";
                                    ?>

                                    <td colspan="3" valign="top" class="verdana8blu"><input <?= $disabled; ?> type="text" name="nolisensiagen" size="25" value="<? echo $arc["NOLISENSIAGEN"]; ?>" />
                                        Berlaku Mulai
                                        <input <?= $disabled; ?> type="text" name="tglmulailisensi" size="8" value="<? echo $arc["TGLMULAILISENSI"]; ?>" />
                                        s.d
                                        <input <?= $disabled; ?> type="text" name="tglakhirlisensi" size="8" value="<? echo $arc["TGLAKHIRLISENSI"]; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="verdana8blu" valign="top">&nbsp;</td>
                                    <td class="verdana8blu">&nbsp;</td>
                                    <td class="verdana8blu" valign="top">&nbsp;</td>
                                    <td class="verdana8blu" valign="top" align="right"><input type="submit" value="UPDATE" name="update" />
                                        <? echo "<input type=\"button\" name=\"tariftebus\" value=\"CETAK KARTU\" onclick=\"NewWindow('konfirmgelar.php?noagen=$noagen','cetak','690','280','yes');return true;\">"; ?>
                                        <input type="hidden" name="mode" value="update" />
                                        <input type="hidden" name="noagen2" size="12" maxlength="10" value="<? echo $arc["NOAGEN"]; ?>" />
                                    </td>
                                </tr>
                            </form>
                        </table>
                        *)<span style="color:#FF0000">Untuk Untuk cetak kartu,silahkan gunakan browser Google Chrome, foto akan kosong jika menggunakan Internet Explorer </span>
                        *)<span style="color:#FF0000">Untuk Agen dengan jenis kelamin perempuan <u>yang mempunyai NPWP</u>, Status PTKP <strong>Bujangan</strong>, untuk agen yang <u>tidak punya NPWP</u> Status PTKP <strong>Tanpa NPWP</strong> </span>
                    </center>
                <? } else { ?>
                    <table border="0" cellpadding="3" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber8" width="100%">
                        <tr>
                            <td class="verdana8blu" valign="top" width="188" rowspan="9">
                                <p>
                                    <?
                                    $maxWidth = 140;
                                    $maxHeight = 160;
                                    if ($arr["FOTOAGEN"] == "") {
                                        echo "<img src='./fotoagen/no_picture.gif' class=imgcontent border=0>";
                                    } else if ($arr["KDJABATANAGEN"] == "29") {
                                        echo "<img class=imgcontent src='./dokumen_lpa/" . $arr['NOKLIEN'] . "/" . $arr["FOTOAGEN"] . "' width='$maxWidth' height='$maxHeight' border=0>";
                                    } else {
                                        echo "<img class=imgcontent src='./fotoagen/" . $arr["FOTOAGEN"] . "' width='$maxWidth' height='$maxHeight' border=0>";
                                    }

                                    ?>


                                <p><a href="#" onclick="NewWindow('updfoto_new.php?noklien=<?= $noagen; ?>&noagen=<?= $noagen; ?>','updclnt',280,380,1);">[Edit Foto]</a></p>
                            </td>
                            <td class="verdana8blu" valign="top">Nama Agen </td>
                            <td class="verdana8blu"><b><? echo $arr["NAMAKLIEN1"];
                                                        //echo $ktrbo.$ktrao.$kdup.$nopkaj.$tglpenetapan;
                                                        ?></b></td>
                            <td class="verdana8blu" valign="top">Tgl Lahir </td>
                            <td class="verdana8blu"><? echo $arr["TEMPATLAHIR"] . ", " . $arr["TGLLAHIR"]; ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">Email</td>
                            <td class="verdana8blu"><? echo $email; ?></td>
                            <!-- <td class="verdana8blu" valign="top">Area Office </td>
        <td class="verdana8blu"><? echo $arr["NAMAAREAOFFICE"]; ?></td> -->
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">No. ID </td>
                            <td class="verdana8blu"><a href="#" class="verdana8blu" onclick="NewWindow('updidagen_new.php?noklien=<?= $noagen; ?>&noagen=<?= $noagen; ?>','updclnt',400,440,1);"><? echo $noid; ?></a></td>
                            <td class="verdana8blu" valign="top">No. Rekening </td>
                            <td class="verdana8blu"><a href="#" class="verdana8blu" onclick="NewWindow('updrekagen_new.php?noklien=<?= $noagen; ?>&noagen=<?= $noagen; ?>','updclnt',600,500,1);"><? echo $arr["NOREKENING"]; ?> </a></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">No. Telepon </td>
                            <td class="verdana8blu"><? echo $arr["PHONETETAP01"]; ?></td>
                            <td class="verdana8blu" valign="top">Nama Bank </td>
                            <td class="verdana8blu"><? echo $arr["NAMABANK"]; ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">Kelas Agen </td>
                            <td class="verdana8blu"><?
                                                    $kdklsagen = $arr["KDKELASAGEN"];
                                                    $sql5 = "select * from $DBUser.tabel_408_kode_kelas_agen where kdkelasagen='$kdklsagen'";
                                                    $DB->parse($sql5);
                                                    $DB->execute();
                                                    $arp = $DB->nextrow();
                                                    echo $arp["NAMAKELASAGEN"];
                                                    ?> </td>
                            <td class="verdana8blu" valign="top">Cabang Bank </td>
                            <td class="verdana8blu"><? echo $arr["BANKCABANG"]; ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">Jabatan</td>
                            <td class="verdana8blu"><? echo $arr["NAMAJABATANAGEN"]; ?></td>
                            <td class="verdana8blu" valign="top">Karir Keagenan</td>
                            <td class="verdana8blu"><? echo $arr["STATUSKARIR"]; ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">No. SPA </td>
                            <td class="verdana8blu"><? echo $arr["NOSKAGEN"];
                                                    echo " " . $arr["TGLSKAGEN"];  ?></td>
                            <td class="verdana8blu" valign="top">Status Agen </td>
                            <td class="verdana8blu"><? echo $arr["NAMASTATUSAGEN"]; ?></td>
                        </tr>
                        <tr>
                            <!-- <td class="verdana8blu" valign="top">Unit Produksi </td>
        <td class="verdana8blu"><?
                                $sql = "select kdunitproduksi,namaunitproduksi, " .
                                    "(select namaareaoffice from $DBUser.tabel_410_area_office where " .
                                    "kdkantor='" . $arr["KDKANTOR"] . "' and kdareaoffice='a.kdareaoffice') as area from " .
                                    "$DBUser.tabel_410_kode_unit_produksi a " .
                                    "where status is null and kdkantor='" . $arr["KDKANTOR"] . "' and kdunitproduksi='" . $arr["KDUNITPRODUKSI"] . "' and kdareaoffice='" . $arr["KDAREAOFFICE"] . "'";
                                //echo $sql;
                                $DB->parse($sql);
                                $DB->execute();
                                $art = $DB->nextrow();
                                echo $art["AREA"] . '-' . $art["NAMAUNITPRODUKSI"];
                                ?></td> -->
                            <td class="verdana8blu" valign="top">Atasan </td>
                            <td class="verdana8blu">
                                <?
                                $sql = "SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN = (SELECT ATASAN FROM $DBUser.TABEL_400_AGEN WHERE NOAGEN='$noagen')";
                                $atsn = ociparse($conn, $sql);
                                ociexecute($atsn);
                                ocifetch($atsn);

                                echo (ociresult($atsn, "NAMAKLIEN1"));
                                ?>
                            </td>
                            <td class="verdana8blu" valign="top">Saluran Distribusi</td>
                            <td class="verdana8blu"><? echo $arr["KDDISTRIBUSI"]; ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">NPWP</td>
                            <td class="verdana8blu"><? echo $arr["NPWP"]; ?></td>
                            <td class="verdana8blu" valign="top">No. DPLK</td>
                            <td class="verdana8blu"><? echo $arr["NODPLK"]; ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">&nbsp;</td>
                            <td class="verdana8blu" valign="top">Status Pegawai</td>
                            <td class="verdana8blu"><? echo $arr["STATUSORGANIK"]; ?></td>
                            <td class="verdana8blu" valign="top">Status PTKP </td>
                            <td class="verdana8blu"><?
                                                    $sql = "select * from $DBUser.TABEL_400_PTKP where KDPTKP='" . $arr["KDPTKP"] . "'";
                                                    $DB->parse($sql);
                                                    $DB->execute();
                                                    $ark = $DB->nextrow();
                                                    echo $ark["KETERANGAN"];
                                                    ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">&nbsp;</td>
                            <td class="verdana8blu" valign="top">Jenis Kelamin</td>
                            <td class="verdana8blu"><?
                                                    if ($arr["JENISKELAMIN"] == 'L') {
                                                        echo "LAKI-LAKI";
                                                    } elseif ($arr["JENISKELAMIN"] == 'P') {
                                                        echo "PEREMPUAN";
                                                    } else {
                                                        echo "BELUM ADA";
                                                    }
                                                    ?></td>
                            <td class="verdana8blu" valign="top">Surat Pernyataan Penghasilan</td>
                            <td class="verdana8blu"><?= $arr["SPERNYATAAN"]; ?></td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">&nbsp;</td>
                            <td class="verdana8blu" valign="top">Surat Pakta Integritas</td>
                            <td colspan="3" class="verdana8blu"><?
                                                                echo $arr["PAKTA"];
                                                                ?> </td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">&nbsp;</td>
                            <td class="verdana8blu" valign="top">Alamat Agen</td>
                            <td colspan="3" class="verdana8blu"><?
                                                                echo $arr["ALAMATTETAP01"] . " " . $arr["ALAMATTETAP02"];
                                                                ?> </td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">&nbsp;</td>
                            <td class="verdana8blu" valign="top">No. Lisensi Agen </td>
                            <?
                            if ($arr["NOLISENSIAGEN"] == "") {
                            ?>
                                <td colspan="3" class="verdana8blu"><b>-</b> </td>
                            <?
                            } else {
                            ?>
                                <td colspan="3" class="verdana8blu"><b>
                                        <?= $arr["NOLISENSIAGEN"]; ?>
                                    </b> Berlaku Mulai <b>
                                        <?= $arr["TGLMULAILISENSI"]; ?>
                                    </b> s.d <b>
                                        <?= $arr["TGLAKHIRLISENSI"]; ?>
                                    </b></td>
                            <? } ?>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">&nbsp;</td>
                            <td class="verdana8blu" valign="top">Tanggal Rekam</td>
                            <td colspan="3" class="verdana8blu"><?
                                                                echo $arr["TGLREKAM"];
                                                                ?> </td>
                        </tr>
                        <tr>
                            <td class="verdana8blu" valign="top">&nbsp;</td>
                            <td class="verdana8blu" valign="top">Status Join Team</td>
                            <td colspan="3" class="verdana8blu"><b><?
                                                                    if ($arr["STATUS_JOIN_TEAM"] == '1') {
                                                                        echo "Join Team " . $arr["TGLJOINTEAM"];
                                                                    } else {
                                                                        echo "Tidak Join Team " . $arr["TGLJOINTEAM"];
                                                                    }
                                                                    ?></b></td>
                        </tr>
                    </table>
                <?php } ?>
                <a href="biodataagen_new.php?act=editbio&noagen=<? echo $noagen; ?>">edit</a>
            </td>
        </tr>

        <tr>
            <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
                <br>
                <b>RIWAYAT KELUARGA</b>
                <form action="#" method="post" name="formriwkel">
                    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                        <tr>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">NO</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">NAMA</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">HUBUNGAN</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">TEMPAT LAHIR</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">TGL. LAHIR</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select nama,hubungan,tempat_lahir,to_char(tgl_lahir,'DD/MM/YYYY') as tgl_lahir " .
                            "from $DBUser.tabel_420_keluarga_agen " .
                            "where noagen='$noagen' order by nama";
                        //echo $sql;
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {

                            $nama            = $arf["NAMA"];
                            $hubungan = $arf["HUBUNGAN"];
                            $tplahir     = $arf["TEMPAT_LAHIR"];
                            $tglahir  = $arf["TGL_LAHIR"];
                        ?>
                            <tr>
                                <td class="verdana8blu" valign="top"><? echo $i; ?></td>
                                <td class="verdana8blu" valign="top"><?
                                                                        if ($act == "editriwkel") {
                                                                            echo "<input type=hidden name=noag[] id=noag[] value='" . $noagen . "'><input type=text name=namakel[] id=namakel[] value='" . $nama . "'>";
                                                                        } else {
                                                                            echo $nama;
                                                                        }
                                                                        ?></td>
                                <td class="verdana8blu" valign="top"><?
                                                                        if ($act == "editriwkel") {
                                                                            echo "<input type=text name=hubkel[] id=hubkel[] value='" . $hubungan . "'>";
                                                                        } else {
                                                                            echo $hubungan;
                                                                        }
                                                                        ?></td>
                                <td class="verdana8blu" valign="top"><?
                                                                        if ($act == "editriwkel") {
                                                                            echo "<input type=text name=tptlhrkel[] id=tptlhrkel[] value='" . $tplahir . "'>";
                                                                        } else {
                                                                            echo $tplahir;
                                                                        }
                                                                        ?></td>
                                <td class="verdana8blu" valign="top"><?
                                                                        if ($act == "editriwkel") {
                                                                            echo "<input type=hidden name=tgllahirold[] id=tgllahirold[] value='" . $tglahir . "'><input type=text name=tglahirkel[] id=tglahirkel[] value='" . $tglahir . "'>";
                                                                        } else {
                                                                            echo $tglahir;
                                                                        }
                                                                        ?></td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapusrk&noagen=<? echo $noagen; ?>&tgllahir=<? echo $tglahir; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Anggota Keluarga Dengan Nama  <? echo $nama; ?> ?')">Delete</a></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }

                        if ($_GET['act'] == "addriwkel") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden id=noagen name=noagen value=$noagen><input type=text name=namakel id=namakel></td><td class=verdana8blu valign=top><input type=text name=hubkel id=hubkel></td><td class=verdana8blu valign=top><input type=text name=tptlhrkel id=tptlhrkel></td><td class=verdana8blu valign=top><input type=text name=tglahirkel id=tglahirkel><input type=submit name=saveriwkel value=Save></td></tr>";
                        } elseif ($act == "editriwkel") {
                            echo "<tr><td colspan=5><input type=hidden name=noagen id=noagen value='" . $noagen . "'><input type=hidden name=jum id=jum value='" . $jum . "'><input type=submit name=updateriwkel value=Update></td></tr>";
                        }
                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=addriwkel&noagen=<? echo $noagen; ?>">add</a> <a href="biodataagen_new.php?act=editriwkel&noagen=<? echo $noagen; ?>">edit</a>
            </td>
        </tr>

        <tr>
            <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
                <b>JENJANG PENDIDIKAN</b><br>
                <br><b>Pendidikan Formal</b>
                <form action="#" method="post" name="formdikfor">
                    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber2">
                        <tr>
                            <td width="20" bgcolor="#D2E7B4" align="center" class="verdana8blu">NO</td>
                            <td width="100" bgcolor="#D2E7B4" align="center" class="verdana8blu">TANGGAL</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">JENIS PENDIDIKAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">KETERANGAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select to_char(a.tglmulai,'DD/MM/YYYY') tglmulai,a.uraian,a.keterangan," .
                            "a.kdjenispendidikan,a.kdkategoripendidikan," .
                            "b.namajenispendidikan " .
                            "from " .
                            "$DBUser.tabel_414_histori_pendidikan a," .
                            "$DBUser.tabel_999_jenis_pendidikan b " .
                            "where " .
                            "a.kdjenispendidikan=b.kdjenispendidikan and " .
                            "kdkategoripendidikan = '01' and noagen='$noagen' order by a.tglmulai";
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {
                            $kdkategoripend = $arf["KDKATEGORIPENDIDIKAN"];
                            $kdjenispend = $arf["KDJENISPENDIDIKAN"];
                            $tglmulai = $arf["TGLMULAI"];
                            $ketpend = $arf["KETERANGAN"];
                            $uraipend = $arf["URAIAN"]
                        ?>
                            <tr>
                                <td class="verdana8blu" valign="top"><? echo $i; ?></td>
                                <td class="verdana8blu" valign="top" align="center"><?
                                                                                    if ($act == "editdikform") {
                                                                                        echo "<input type=hidden name=noag[] id=noag[] value=$noagen><input type=hidden name=tglmulaidikformold[] id=tglmulaidikformold[] value='" . $tglmulai . "'><input type=text name=tglmulaidikform[] id=tglmulaidikform[] value='" . $tglmulai . "'>";
                                                                                    } else {
                                                                                        echo $tglmulai;
                                                                                    }
                                                                                    ?></td>
                                <td class="verdana8blu" valign="top"><?
                                                                        if ($act == "editdikform") {
                                                                        ?>
                                        <select name=uraipendformold[] id=uraipendformold[] size="1">

                                            <?

                                                                            //echo "<input type=hidden name=uraipendformold[] id=uraipendformold[] value='".$uraipend."'><input type=text name=uraipendform[] id=uraipendform[] value='".$uraipend."'>";
                                                                            $sql1 = "select * from $DBUser.tabel_999_jenis_pendidikan where kdjenispendidikan in ('01','02','03','04')";
                                                                            $DB->parse($sql1);
                                                                            $DB->execute();
                                                                            while ($arr = $DB->nextrow()) {
                                                                                if ($arr["KDJENISPENDIDIKAN"] == $arf["KDJENISPENDIDIKAN"]) {
                                                                                    echo "<option value=" . $arr["KDJENISPENDIDIKAN"] . " selected>" . $arr["NAMAJENISPENDIDIKAN"] . "</option>";
                                                                                } else {
                                                                                    echo "<option value=" . $arr["KDJENISPENDIDIKAN"] . ">" . $arr["NAMAJENISPENDIDIKAN"] . "</option>";
                                                                                }
                                                                            }
                                            ?>
                                        </select>
                                    <?
                                                                        } else {
                                                                            echo $uraipend;
                                                                        }
                                    ?>
                                </td>
                                <td class="verdana8blu" valign="top" align="center"><?
                                                                                    if ($act == "editdikform") {
                                                                                        echo "<input type=hidden name=ketpendold[] id=ketpendold[] value='" . $ketpend . "'><input type=text name=ketpend[] id=ketpend[] value='" . $ketpend . "'>";
                                                                                    } else {
                                                                                        echo $ketpend;
                                                                                    }
                                                                                    ?></td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapuspf&noagen=<? echo $noagen; ?>&kkp=<? echo $kdkategoripend; ?>&kjp=<? echo $kdjenispend; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini ?')">Delete</a>
                                    <? echo (" <a href=\"#\" class=\"verdana8blu\" onclick=\"NewWindow('updpendagen_d3d1.php?noklien=$noagen&noagen=$noagen&kdjenispendidikan=$kdjenispend&kdkategoripendidikan=$kdkategoripend&tglmulai=$tglmulai&ketpend=$ketpend&uraian=$uraipend','updclnt',500,250,1);\">Edit</a>");
                                    ?></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }
                        if ($_GET['act'] == "adddikform") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden name=noagen id=noagen value=$noagen><input type=text name=tglmulaidikform id=tglmulaidikform> </td><td class=verdana8blu valign=top><select size=1 name=kdjnspend><option></option>";
                            $sql = "select * from $DBUser.tabel_999_jenis_pendidikan where kdjenispendidikan in ('01','02','03','04')";
                            $DB->parse($sql);
                            $DB->execute();
                            while ($arr = $DB->nextrow()) {
                                echo "<option value=" . $arr["KDJENISPENDIDIKAN"] . ">" . $arr["NAMAJENISPENDIDIKAN"] . "</option>";
                            }

                            echo "</select>
		</td><td class=verdana8blu valign=top><input type=text name=ketpendform id=ketpendform><input type=submit name=savedikform value=Save></td></tr>";
                        } elseif ($act == "editdikform") {
                            echo "<tr><td colspan=4><input type=hidden name=noagen id=noagen value=$noagen><input type=submit name=updatedikform value=Update></td></tr>";
                        }
                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=adddikform&noagen=<? echo $noagen; ?>">add</a>

                <br><b>Pendidikan Intern</b>
                <form action="#" method="post" name="formdikintr">
                    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber3">
                        <tr>
                            <td width="20" bgcolor="#D2E7B4" align="center" class="verdana8blu">NO</td>
                            <td width="100" bgcolor="#D2E7B4" align="center" class="verdana8blu">TANGGAL</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">JENIS PENDIDIKAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">KETERANGAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select to_char(a.tglmulai,'DD/MM/YYYY') tglmulai,a.uraian,a.keterangan," .
                            "a.kdjenispendidikan,a.kdkategoripendidikan," .
                            "b.namajenispendidikan " .
                            "from " .
                            "$DBUser.tabel_414_histori_pendidikan a," .
                            "$DBUser.tabel_999_jenis_pendidikan b " .
                            "where " .
                            "a.kdjenispendidikan=b.kdjenispendidikan and " .
                            "kdkategoripendidikan = '02' and noagen='$noagen' order by a.tglmulai";
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {
                            $kdkategoripend = $arf["KDKATEGORIPENDIDIKAN"];
                            $kdjenispend = $arf["KDJENISPENDIDIKAN"];
                            $tglmulai = $arf["TGLMULAI"];
                            $ketpend = $arf["KETERANGAN"];
                            $uraian = $arf["URAIAN"];
                        ?>
                            <tr>
                                <td class="verdana8blu" valign="top"><? echo $i; ?></td>
                                <td class="verdana8blu" valign="top" align="center">
                                    <?
                                    if ($act == "editdikintr") {
                                        echo "<input type=hidden name=tglmulaidikintrold[] id=tglmulaidikintrold[] value='" . $tglmulai . "'><input type=hidden name=noag[] id=noag[] value='" . $noagen . "'><input type=text name=tglmulaidikintr[] id=tglmulaidikintr[] value='" . $tglmulai . "'>";
                                    } else {
                                        echo $tglmulai;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top">
                                    <?
                                    if ($act == "editdikintr") {
                                        echo "<input type=text name=uraiandikintr[] id=uraiandikintr[] value='" . $uraian . "'>";
                                    } else {
                                        echo $uraian;
                                    }
                                    ?></td>
                                <td class="verdana8blu" valign="top" align="center">
                                    <?
                                    if ($act == "editdikintr") {
                                        echo "<input type=text name=ketdikintr[] id=ketdikintr[] value='" . $ketpend . "'>";
                                    } else {
                                        echo $ketpend;
                                    }
                                    ?></td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapuspi&noagen=<? echo $noagen; ?>&tgl=<? echo $tglmulai ?>&kkp=<? echo $kdkategoripend; ?>&kjp=<? echo $kdjenispend; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini  <? echo $nama; ?> ?')">Delete</a></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }
                        if ($_GET['act'] == "adddikintr") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden name=noagen id=noagen value=$noagen><input type=text name=tglmulaidikintr id=tglmulaidikintr> </td><td class=verdana8blu valign=top><input type=text name=uraipendintr id=uraipendintr></td><td class=verdana8blu valign=top><input type=text name=ketpendintr id=ketpendintr><input type=submit name=savedikintr value=Save></td></tr>";
                        } elseif ($act == "editdikintr") {
                            echo "<tr><td colspan=4><input type=hidden name=noagen id=noagen value='" . $noagen . "'><input type=hidden name=jum id=jum value='" . $jum . "'><input type=submit name=updatedikintr value=Update></td></tr>";
                        }

                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=adddikintr&noagen=<? echo $noagen; ?>">add</a> <a href="biodataagen_new.php?act=editdikintr&noagen=<? echo $noagen; ?>">edit</a>
                <br>
                <b>Pendidikan Extern</b>
                <form action="#" method="post" name="formdikextr">
                    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber3">
                        <tr>
                            <td width="20" bgcolor="#D2E7B4" align="center" class="verdana8blu">NO</td>
                            <td width="100" bgcolor="#D2E7B4" align="center" class="verdana8blu">TANGGAL</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">JENIS PENDIDIKAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">KETERANGAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select to_char(a.tglmulai,'DD/MM/YYYY') tglmulai,a.uraian,a.keterangan," .
                            "a.kdjenispendidikan,a.kdkategoripendidikan," .
                            "b.namajenispendidikan " .
                            "from " .
                            "$DBUser.tabel_414_histori_pendidikan a," .
                            "$DBUser.tabel_999_jenis_pendidikan b " .
                            "where " .
                            "a.kdjenispendidikan=b.kdjenispendidikan and " .
                            "kdkategoripendidikan = '03' and noagen='$noagen' order by a.tglmulai";
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {
                            $kdkategoripend = $arf["KDKATEGORIPENDIDIKAN"];
                            $kdjenispend = $arf["KDJENISPENDIDIKAN"];
                            $tglmulai = $arf["TGLMULAI"];
                            $ketpend = $arf["KETERANGAN"];
                            $uraian = $arf["URAIAN"];
                        ?>
                            <tr>
                                <td class="verdana8blu" valign="top"><? echo $i; ?></td>
                                <td class="verdana8blu" valign="top" align="center">
                                    <?
                                    if ($act == "editdikextr") {
                                        echo "<input type=hidden name=tglmulaidikextrold[] id=tglmulaidikextrold[] value='" . $tglmulai . "'><input type=hidden name=noag[] id=noag[] value='" . $noagen . "'><input type=text name=tglmulaidikextr[] id=tglmulaidikextr[] value='" . $tglmulai . "'>";
                                    } else {
                                        echo $tglmulai;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top">
                                    <?
                                    if ($act == "editdikextr") {
                                        echo "<input type=text name=uraiandikextr[] id=uraiandikextr[] value='" . $uraian . "'>";
                                    } else {
                                        echo $uraian;
                                    }


                                    ?> </td>
                                <td class="verdana8blu" valign="top" align="center">
                                    <?
                                    if ($act == "editdikextr") {
                                        echo "<input type=text name=ketpendextr[] id=ketpendextr[] value='" . $ketpend . "'>";
                                    } else {
                                        echo $ketpend;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapuspe&noagen=<? echo $noagen; ?>&tgl=<? echo $tglmulai ?>&kkp=<? echo $kdkategoripend; ?>&kjp=<? echo $kdjenispend; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini ?')">Delete</a></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }
                        if ($_GET['act'] == "adddikextr") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden name=noagen id=noagen value=$noagen><input type=text name=tglmulaidikextr id=tglmulaidikextr> </td><td class=verdana8blu valign=top><input type=text name=uraipendextr id=uraipendextr></td><td class=verdana8blu valign=top><input type=text name=ketpendextr id=ketpendextr><input type=submit name=savedikextr value=Save></td></tr>";
                        } elseif ($act == "editdikextr") {
                            echo "<tr><td colspan=4><input type=hidden name=noagen id=noagen value='" . $noagen . "'><input type=hidden name=jum id=jum value='" . $jum . "'><input type=submit name=updatedikextr value=Update></td></tr>";
                        }
                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=adddikextr&noagen=<? echo $noagen; ?>">add</a> <a href="biodataagen_new.php?act=editdikextr&noagen=<? echo $noagen; ?>">edit</a>
            </td>
        </tr>

        <!-- Pelatihan Internal-->
        <tr>
            <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
                <b>PELATIHAN INTERNAL</b>
                <form action="#" method="post" name="formdikextr">
                    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber3">
                        <tr>
                            <td width="20" bgcolor="#D2E7B4" align="center" class="verdana8blu">NO</td>
                            <td width="100" bgcolor="#D2E7B4" align="center" class="verdana8blu">TANGGAL</td>
                            <td bgcolor="#D2E7B4" align="center" class="verdana8blu">JENIS PELATIHAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">KETERANGAN</td>
                            <td width="120" bgcolor="#D2E7B4" align="center" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select to_char(a.tglmulai,'DD/MM/YYYY') tglmulai,a.uraian,a.keterangan," .
                            "a.kdjenispendidikan,a.kdkategoripendidikan," .
                            "b.namajenispendidikan " .
                            "from " .
                            "$DBUser.tabel_414_histori_pendidikan a," .
                            "$DBUser.tabel_999_jenis_pendidikan b " .
                            "where " .
                            "a.kdjenispendidikan=b.kdjenispendidikan and " .
                            "kdkategoripendidikan = '04' and noagen='$noagen' order by a.tglmulai";
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {
                            $kdkategoripel = $arf["KDKATEGORIPENDIDIKAN"];
                            $kdjenispel = $arf["KDJENISPENDIDIKAN"];
                            $namajenispel = $arf["NAMAJENISPENDIDIKAN"];
                            $tglmulai = $arf["TGLMULAI"];
                            $ketpel = $arf["KETERANGAN"];
                            $uraian = $arf["URAIAN"];
                        ?>
                            <tr>
                                <td class="verdana8blu" valign="top"><? echo $i; ?></td>
                                <td class="verdana8blu" valign="top" align="center">
                                    <?
                                    if ($act == "editpelintr") {
                                        echo "<input type=hidden name=tglmulaipelintrold[] id=tglmulaipelintrold[] value='" . $tglmulai . "'><input type=hidden name=noag[] id=noag[] value='" . $noagen . "'><input type=text name=tglmulaipelintr[] id=tglmulaipelintr[] value='" . $tglmulai . "'>";
                                    } else {
                                        echo $tglmulai;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top">
                                    <?

                                    if ($act == "editpelintr") {
                                    ?>
                                        <select name=uraipelintr[] id=uraipelintr[] size="1">

                                            <?


                                            $sql1 = "select * from $DBUser.tabel_999_jenis_pendidikan where kdjenispendidikan like 'I%'";
                                            $DB->parse($sql1);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($arr["KDJENISPENDIDIKAN"] == $kdjenispel) {
                                                    echo "<option value=" . $arr["KDJENISPENDIDIKAN"] . " selected>" . $arr["NAMAJENISPENDIDIKAN"] . "</option>";
                                                } else {
                                                    echo "<option value=" . $arr["KDJENISPENDIDIKAN"] . ">" . $arr["NAMAJENISPENDIDIKAN"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    <?
                                    } else {
                                        echo $namajenispel;
                                    }
                                    ?>
                                </td>
                                <td class="verdana8blu" valign="top" align="center">
                                    <?
                                    if ($act == "editpelintr") {
                                        echo "<input type=text name=ketpelintr[] id=ketpelintr[] value='" . $ketpel . "'>";
                                    } else {
                                        echo $ketpel;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapuspe&noagen=<? echo $noagen; ?>&tgl=<? echo $tglmulai ?>&kkp=<? echo $kdkategoripel; ?>&kjp=<? echo $kdjenispel; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini ?')">Delete</a></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }
                        if ($_GET['act'] == "addpelintr") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden name=noagen id=noagen value=$noagen><input type=text name=tglmulaipelintr id=tglmulaipelintr> </td><td class=verdana8blu valign=top><select size=1 name=kdjnspel><option></option>";
                            $sql = "select * from $DBUser.tabel_999_jenis_pendidikan where kdjenispendidikan like 'I%'";
                            $DB->parse($sql);
                            $DB->execute();
                            while ($arr = $DB->nextrow()) {
                                echo "<option value=" . $arr["KDJENISPENDIDIKAN"] . ">" . $arr["NAMAJENISPENDIDIKAN"] . "</option>";
                            }

                            echo "</select>
		</td><td class=verdana8blu valign=top><input type=text name=ketpelintr id=ketpelintr><input type=submit name=savepelintr value=Save></td></tr>";
                        } elseif ($act == "editpelintr") {
                            echo "<input type=hidden name=uraipelintrold[] id=uraipelintrold[] value='" . $kdjenispel . "'>";
                            echo "<tr><td colspan=4><input type=hidden name=noagen id=noagen value='" . $noagen . "'><input type=hidden name=jum id=jum value='" . $jum . "'><input type=submit name=updatepelintr value=Update></td></tr>";
                        }
                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=addpelintr&noagen=<? echo $noagen; ?>">add</a> <a href="biodataagen_new.php?act=editpelintr&noagen=<? echo $noagen; ?>">edit</a>
            </td>
        </tr>
        <!--Akhir Pelatihan Internal-->

        <tr>
            <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
                <br>
                <b>PENGALAMAN KERJA</b>
                <form action="#" method="post" name="formkerja">
                    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber6">
                        <tr>
                            <td width="20" align="center" bgcolor="#D2E7B4" class="verdana8blu">NO</td>
                            <td width="100" align="center" bgcolor="#D2E7B4" class="verdana8blu">TANGGAL</td>
                            <td width="350" align="center" bgcolor="#D2E7B4" class="verdana8blu">URAIAN</td>
                            <td align="center" bgcolor="#D2E7B4" class="verdana8blu">KETERANGAN</td>
                            <td align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select to_char(a.tglmulai,'DD/MM/YYYY') tglmulai,a.uraian,a.keterangan " .
                            "from $DBUser.tabel_415_histori_kerja a where noagen='$noagen' order by a.tglmulai";
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {
                            $tglmulai = $arf["TGLMULAI"];
                            $keterangan = $arf["KETERANGAN"];
                            $uraian = $arf["URAIAN"];
                        ?>
                            <tr>
                                <td class="verdana8blu">
                                    <?
                                    echo $i;
                                    ?> </td>
                                <td class="verdana8blu" align="center">
                                    <?
                                    if ($act == "editpengker") {
                                        echo "<input type=hidden name=tglmulaipengkerold[] id=tglmulaipengkerold[] value='" . $tglmulai . "'><input type=hidden name=noag[] id=noag[] value='" . $noagen . "'><input type=text name=tglmulaipengker[] id=tglmulaipengker[] value='" . $tglmulai . "'>";
                                    } else {
                                        echo $tglmulai;
                                    }
                                    ?> </td>
                                <td class="verdana8blu">
                                    <?
                                    if ($act == "editpengker") {
                                        echo "<input type=text name=uraipengker[] id=uraipengker[] value='" . $uraian . "'>";
                                    } else {
                                        echo $uraian;
                                    }
                                    ?> </td>
                                <td class="verdana8blu">
                                    <?
                                    if ($act == "editpengker") {
                                        echo "<input type=text name=ketpengker[] id=ketpengker[] value='" . $keterangan . "'>";
                                    } else {
                                        echo $keterangan;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapuspk&noagen=<? echo $noagen; ?>&tglk=<? echo $tglmulai ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini ?')">Delete</a></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }
                        if ($_GET['act'] == "addpengker") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden name=noagen id=noagen value=$noagen><input type=text name=tglmulaipengker id=tglmulaipengker></td><td class=verdana8blu valign=top><input type=text name=uraipengker id=uraipengker></td><td class=verdana8blu valign=top><input type=text name=ketpengker id=ketpengker><input type=submit name=savepengker value=Save></td></tr>";
                        } elseif ($act == "editpengker") {
                            echo "<tr><td colspan=4><input type=hidden name=noagen id=noagen value=$noagen><input type=hidden name=jum id=jum value=$jum><input type=submit name=updatepengker value=Update></td></tr>";
                        }
                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=addpengker&noagen=<? echo $noagen; ?>">add</a> <a href="biodataagen_new.php?act=editpengker&noagen=<? echo $noagen; ?>">edit</a>
        </tr>
        <tr>
            <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
                <br>
                <b>JASA DAN SANKSI</b> <br>
                <br><b>Tanda Jasa</b>
                <form action="#" method="post" name="formjasa">
                    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber6">
                        <tr>
                            <td width="20" align="center" bgcolor="#D2E7B4" class="verdana8blu">NO</td>
                            <td width="100" align="center" bgcolor="#D2E7B4" class="verdana8blu">TANGGAL</td>
                            <td width="350" align="center" bgcolor="#D2E7B4" class="verdana8blu">URAIAN</td>
                            <td align="center" bgcolor="#D2E7B4" class="verdana8blu">KETERANGAN</td>
                            <td align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select to_char(tgljasa,'DD/MM/YYYY') tgljasa,kdjenisjasa,uraian,keterangan " .
                            "from $DBUser.tabel_416_histori_jasa where noagen='$noagen' " .
                            "and kdjenisjasa='1' order by tgljasa";
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {
                            $tgljasa = $arf["TGLJASA"];
                            $keterangan = $arf["KETERANGAN"];
                            $uraian = $arf["URAIAN"];
                            $kdjenisjasa = $arf["KDJENISJASA"];
                        ?>
                            <tr>
                                <td class="verdana8blu"><? echo $i; ?></td>
                                <td class="verdana8blu" align="center">
                                    <?
                                    if ($act == "editjasa") {
                                        echo "<input type=hidden name=tglmulaijasaold[] id=tglmulaijasaold[] value='" . $tgljasa . "'><input type=hidden name=noag[] id=noag[] value='" . $noagen . "'><input type=text name=tglmulaijasa[] id=tglmulaijasa[] value='" . $tgljasa . "'>";
                                    } else {
                                        echo $tgljasa;
                                    }
                                    ?> </td>
                                <td class="verdana8blu">
                                    <?
                                    if ($act == "editjasa") {
                                        echo "<input type=text name=uraijasa[] id=uraijasa[] value='" . $uraian . "'>";
                                    } else {
                                        echo $uraian;
                                    }
                                    ?> </td>
                                <td class="verdana8blu">
                                    <?
                                    if ($act == "editjasa") {
                                        echo "<input type=text name=ketjasa[] id=ketjasa[] value='" . $keterangan . "'>";
                                    } else {
                                        echo $keterangan;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapusj&noagen=<? echo $noagen; ?>&tglj=<? echo $tgljasa ?>&kjj=<? echo $kdjenisjasa; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini ?')">Delete</a></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }
                        if ($_GET['act'] == "addjasa") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden name=noagen id=noagen value=$noagen><input type=text name=tglmulaijasa id=tglmulaijasa></td><td class=verdana8blu valign=top><input type=text name=uraijasa id=uraijasa></td><td class=verdana8blu valign=top><input type=text name=ketjasa id=ketjasa><input type=submit name=savejasa value=Save></td></tr>";
                        } elseif ($act == "editjasa") {
                            echo "<tr><td colspan=4><input type=hidden name=noagen id=noagen value=$noagen><input type=hidden name=jum id=jum value=$jum><input type=submit name=updatejasa value=Update></td></tr>";
                        }
                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=addjasa&noagen=<? echo $noagen; ?>">add</a> <a href="biodataagen_new.php?act=editjasa&noagen=<? echo $noagen; ?>">edit</a>
                <br>
                <b>Sanksi</b>
                <form action="#" method="post" name="formsanksi">
                    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber6">
                        <tr>
                            <td width="20" align="center" bgcolor="#D2E7B4" class="verdana8blu">NO</td>
                            <td width="100" align="center" bgcolor="#D2E7B4" class="verdana8blu">TANGGAL</td>
                            <td width="350" align="center" bgcolor="#D2E7B4" class="verdana8blu">URAIAN</td>
                            <td align="center" bgcolor="#D2E7B4" class="verdana8blu">KETERANGAN</td>
                            <td align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>
                        </tr>
                        <?
                        $sql = "select to_char(tgljasa,'DD/MM/YYYY') tgljasa,kdjenisjasa,uraian,keterangan " .
                            "from $DBUser.tabel_416_histori_jasa where noagen='$noagen' " .
                            "and kdjenisjasa='0' order by tgljasa";
                        $DB->parse($sql);
                        $DB->execute();
                        $i = 1;
                        while ($arf = $DB->nextrow()) {
                            $tgljasa = $arf["TGLJASA"];
                            $keterangan = $arf["KETERANGAN"];
                            $uraian = $arf["URAIAN"];
                            $kdjenisjasa = $arf["KDJENISJASA"];
                        ?>
                            <tr>
                                <td class="verdana8blu"><? echo $i; ?></td>
                                <td class="verdana8blu" align="center">
                                    <?
                                    if ($act == "editsanksi") {
                                        echo "<input type=hidden name=tglmulaisanksiold[] id=tglmulaisanksiold[] value='" . $tgljasa . "'><input type=hidden name=noag[] id=noag[] value='" . $noagen . "'><input type=text name=tglmulaisanksi[] id=tglmulaisanksi[] value='" . $tgljasa . "'>";
                                    } else {
                                        echo $tgljasa;
                                    }
                                    ?> </td>
                                <td class="verdana8blu">
                                    <?
                                    if ($act == "editsanksi") {
                                        echo "<input type=text name=uraisanksi[] id=uraisanksi[] value='" . $uraian . "'>";
                                    } else {
                                        echo $uraian;
                                    }
                                    ?> </td>
                                <td class="verdana8blu">
                                    <?
                                    if ($act == "editsanksi") {
                                        echo "<input type=text name=ketsanksi[] id=ketsanksi[] value='" . $keterangan . "'>";
                                    } else {
                                        echo $keterangan;
                                    }
                                    ?> </td>
                                <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapuss&noagen=<? echo $noagen; ?>&tgls=<? echo $tgljasa ?>&kjs=<? echo $kdjenisjasa; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini ?')">Delete</a></td>
                            </tr>
                        <?
                            $i++;
                            $jum = $i - 1;
                        }
                        if ($_GET['act'] == "addsanksi") {
                            echo "<tr><td class=verdana8blu valign=top></td><td class=verdana8blu valign=top><input type=hidden id=noagen name=noagen value=$noagen><input type=text name=tglmulaisanksi id=tglmulaisanksi></td><td class=verdana8blu valign=top><input type=text name=uraisanksi id=uraisanksi></td><td class=verdana8blu valign=top><input type=text name=ketsanksi id=ketsanksi><input type=submit name=savesanksi value=Save></td></tr>";
                        } elseif ($act == "editsanksi") {
                            echo "<tr><td colspan=4><input type=hidden id=noagen name=noagen value=$noagen><input type=hidden id=jum name=jum value=$jum><input type=submit name=updatesanksi value=Update></td></tr>";
                        }
                        ?>
                    </table>
                </form>
                <a href="biodataagen_new.php?act=addsanksi&noagen=<? echo $noagen; ?>">add</a> <a href="biodataagen_new.php?act=editsanksi&noagen=<? echo $noagen; ?>">edit</a>
            </td>
        </tr>
        <tr>
            <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
                <br>
                <b>RIWAYAT JABATAN</b>
                <?
                if ($act == "addriwjab") {
                ?>
                    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                        <form action="<? $PHP_SELF; ?>" name="histjabatan" method="post">
                            <tr>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">NO</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">TANGGAL</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">JABATAN</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">KELAS</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">JENIS MUTASI</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">KANTOR</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">AREA</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">UP</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">PKAJ</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">NOMOR SK/SPA</td>
                                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">TGL. SK/SPA</td>
                            </tr>
                            <?
                            $sql = "select to_char(a.tgljabatan,'DD/MM/YYYY') tgljabatan,a.kdkantor kdkantor," .
                                "a.uraian,a.keterangan,a.kdjabatanagen,a.kdkelasagen," .
                                "b.namajabatanagen,c.namakelasagen,to_char(a.tglpenetapan,'DD/MM/YYYY') tglpenetapan, " .
                                "(select namakantor from $DBUser.tabel_001_kantor where kdkantor=a.kdkantor) namakantorbo," .
                                "(select namaareaoffice from $DBUser.TABEL_410_AREA_OFFICE where kdkantor=a.kdkantor and kdareaoffice=a.kdareaoffice) namakantorao," .
                                "(select namaunitproduksi from $DBUser.TABEL_410_KODE_UNIT_PRODUKSI where kdkantor=a.kdkantor and kdareaoffice='a.kdareaoffice' and kdunitproduksi='a.kdunitproduksi') namakantorup, nopkajagen " .
                                "from " .
                                "$DBUser.tabel_417_histori_jabatan a," .
                                "$DBUser.tabel_413_jabatan_agen b," .
                                "$DBUser.tabel_408_kode_kelas_agen c " .
                                "where " .
                                "a.kdjabatanagen=b.kdjabatanagen(+) and a.kdkelasagen=c.kdkelasagen(+) and " .
                                "a.noagen='$noagen' order by a.tgljabatan";
                            $DB->parse($sql);
                            $DB->execute();
                            $i = 1;
                            while ($arf = $DB->nextrow()) {
                                $tgljabatan = $arf["TGLJABATAN"];
                                $jabatanagen = $arf["NAMAJABATANAGEN"];
                                $kelasagen = $arf["NAMAKELASAGEN"];
                                $kdjabatanagen = $arf["KDJABATANAGEN"];
                                $kdkelasagen = $arf["KDKELASAGEN"];
                                $uraian = $arf["URAIAN"];
                                $keterangan = $arf["KETERANGAN"];
                                $jab = $arf["KDJABATANAGEN"];
                                $ktrbo = $arf["KDKANTOR"];
                                $namakantorbo = $arf["NAMAKANTORBO"];
                                $namakantorao = $arf["NAMAKANTORAO"];
                                $namakantorup = $arf["NAMAKANTORUP"];
                            ?>
                                <tr>
                                    <td class="verdana8blu" valign="top"><? echo $i; ?></td>
                                    <td class="verdana8blu" valign="top" align="center"><? echo $arf["TGLJABATAN"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["NAMAJABATANAGEN"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["NAMAKELASAGEN"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["URAIAN"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["NAMAKANTORBO"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["NAMAKANTORAO"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["NAMAKANTORUP"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["NOPKAJAGEN"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["KETERANGAN"]; ?></td>
                                    <td class="verdana8blu" valign="top"><? echo $arf["TGLPENETAPAN"]; ?></td>
                                <?

                                echo "</tr>";
                                $i++;
                            }
                                ?>
                                <tr>
                                    <td class="verdana8blu"><? echo $i; ?></td>
                                    <td class="verdana8blu" align="center">
                                        <input type="text" name="tgljabatan" maxlength="10" size="10" onblur="javascript:convert_date(tgljabatan)" value="<?= $tahun; ?>">
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <select size="1" name="kdjabatanagen">
                                            <option></option>
                                            <?
                                            $sql = "select kdjabatanagen from $DBUser.TABEL_400_AGEN where noagen='$noagen'";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            $ara = $DB->nextrow();
                                            $kodeJabatanBS = array('32', '33', '34', '35', '36', '37', '38');
                                            if ($ara['KDJABATANAGEN'] == '31') {
                                                $sql = "select * from $DBUser.tabel_413_jabatan_agen where kdjabatanagen='31'";
                                            } elseif (in_array($ara['KDJABATANAGEN'], $kodeJabatanBS)) {
                                                $sql = "select * from $DBUser.tabel_413_jabatan_agen where kdjabatanagen in ('32', '33', '34', '35', '36', '37', '38')";
                                            } else {
                                                $sql = "select * from $DBUser.tabel_413_jabatan_agen where kdjabatanagen='09'";
                                            }
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($ara['KDJABATANAGEN'] == $arr["KDJABATANAGEN"]) {
                                                    $pilih = 'selected';
                                                } else {
                                                    $pilih = '';
                                                }
                                                echo "<option value=" . $arr["KDJABATANAGEN"] . " " . $pilih . ">" . $arr["NAMAJABATANAGEN"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <select size="1" name="kdkelasagen">
                                            <option></option>
                                            <?
                                            $sql = "select * from $DBUser.tabel_408_kode_kelas_agen";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($kelas == $arr["KDKELASAGEN"]) {
                                                    $pilih = 'selected';
                                                } else {
                                                    $pilih = '';
                                                }
                                                echo "<option value=" . $arr["KDKELASAGEN"] . " " . $pilih . ">" . $arr["NAMAKELASAGEN"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <!--<input type="text" name="uraianjabatan" size="25" align="center">-->
                                        <select size="1" name="uraianjabatan">
                                            <option></option>
                                            <?
                                            if ($urai == 'PROMOSI') {
                                                $pro = 'selected';
                                            }
                                            if ($urai == 'DEGRADASI') {
                                                $deg = 'selected';
                                            }
                                            if ($urai == 'PENANGGUHAN') {
                                                $pen = 'selected';
                                            }
                                            ?>
                                            <option VALUE="PROMOSI" <?= $pro; ?>>PROMOSI</option>
                                            <option VALUE="DEGRADASI" <?= $deg; ?>>DEGRADASI</option>
                                            <option VALUE="PENANGGUHAN" <?= $pen; ?>>PENANGGUHAN</option>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <select size="1" name="kdkantorX" onchange="GantiCari(document.histjabatan)">
                                            <option></option>
                                            <?
                                            $sql = "select * from $DBUser.tabel_001_kantor WHERE kdjeniskantor='2' order by kdkantor asc";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($ktrbo == $arr["KDKANTOR"]) {
                                                    $pilih = 'selected';
                                                } else {
                                                    $pilih = '';
                                                }
                                                echo "<option value=" . $arr["KDKANTOR"] . " " . $pilih . ">" . $arr["NAMAKANTOR"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="agn" value="<?= $noagen; ?>" />
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <select size="1" name="kdarea" onchange="GantiCari(document.histjabatan)">
                                            <option></option>
                                            <?
                                            $sql = "select * from $DBUser.TABEL_410_AREA_OFFICE where kdkantor='$ktrbo' and status IS NULL ORDER BY kdareaoffice";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                if ($ktrao == $arr["KDAREAOFFICE"]) {
                                                    $pilihao = 'selected';
                                                } else {
                                                    $pilihao = '';
                                                }
                                                echo "<option value='" . $arr["KDAREAOFFICE"] . "' " . $pilihao . ">" . $arr["NAMAAREAOFFICE"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <select size="1" name="kdup">
                                            <option></option>
                                            <?
                                            $sql = "select * from $DBUser.TABEL_410_KODE_UNIT_PRODUKSI where kdkantor='$ktrbo' and kdareaoffice='$ktrao' " .
                                                "and status IS NULL ORDER BY kdunitproduksi";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                echo "<option value=" . $arr["KDUNITPRODUKSI"] . ">" . $arr["NAMAUNITPRODUKSI"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <select size="1" name="nopkaj">
                                            <option></option>
                                            <?
                                            $sql = "SELECT nopkajagen,to_char(tglpkajagen,'DD-MM-YYYY') tglpkajagen, kdkantor,to_char(tglpkajagen,'MMYYYY') BLN " .
                                                "FROM $DBUser.tabel_400_pkaj_agen where noagen='$noagen' and kdkantor='$kantor' order by tglpkajagen asc";
                                            $DB->parse($sql);
                                            $DB->execute();
                                            while ($arr = $DB->nextrow()) {
                                                echo "<option value=" . $arr["NOPKAJAGEN"] . ">" . $arr["NOPKAJAGEN"] . '/PKAJ-' .
                                                    $arr["KDKANTOR"] . '-' . $arr["BLN"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <?
                                        //echo  $sql;
                                        ?>
                                    </td>
                                    <td class="verdana8blu" align="center">
                                        <input type="text" name="ketjabatan" size="10" align="center">
                                    </td>
            </td>
            <td class="verdana8blu" align="center">
                <input type="text" name="tglpenetapan" size="10" align="center"><input type="submit" value="INSERT" name="insjabatan" style="font-size: 8pt">
            </td><br />
            <input type="hidden" name="addriwjab" value="<? echo $act; ?>" />
            <input type="hidden" name="noagen" value="<? echo $noagen; ?>">
            </form>
        </tr>
    </table>
<?
                } else {
?>
    <form action="#" method="post" name="formriwjab">
        <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
            <tr>
                <td width="20" bgcolor="#D2E7B4" align="center" class="verdana8blu">NO</td>
                <td width="100" bgcolor="#D2E7B4" align="center" class="verdana8blu">TANGGAL</td>
                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">JABATAN</td>
                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">KELAS</td>
                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">URAIAN</td>
                <td bgcolor="#D2E7B4" align="center" class="verdana8blu">KETERANGAN</td>
                <td align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>
            </tr>
            <?
                    $sql = "select to_char(a.tgljabatan,'DD/MM/YYYY') tgljabatan," .
                        "a.uraian,a.keterangan,a.kdjabatanagen,a.kdkelasagen," .
                        "b.namajabatanagen,c.namakelasagen " .
                        "from " .
                        "$DBUser.tabel_417_histori_jabatan a," .
                        "$DBUser.tabel_413_jabatan_agen b," .
                        "$DBUser.tabel_408_kode_kelas_agen c " .
                        "where " .
                        "a.kdjabatanagen=b.kdjabatanagen(+) and a.kdkelasagen=c.kdkelasagen(+) and " .
                        "a.noagen='$noagen' order by a.tgljabatan";
                    // echo $sql;
                    $DB->parse($sql);
                    $DB->execute();
                    $i = 1;
                    while ($arf = $DB->nextrow()) {
                        $tgljabatan = $arf["TGLJABATAN"];
                        $jabatanagen = $arf["NAMAJABATANAGEN"];
                        $kelasagen = $arf["NAMAKELASAGEN"];
                        $kdjabatanagen = $arf["KDJABATANAGEN"];
                        $kdkelasagen = $arf["KDKELASAGEN"];
                        $uraian = $arf["URAIAN"];
                        $ktrbo = $arf["KDKANTOR"];
                        $keterangan = $arf["KETERANGAN"];
            ?>
                <tr>
                    <td class="verdana8blu" valign="top"><? echo $i; ?></td>
                    <td class="verdana8blu" valign="top" align="center">

                        <?
                        if ($act == "editriwjab") {
                            echo "<input type=text name=tgljab[] id=tgljab value='" . $tgljabatan . "'>";
                        } else {
                            echo $tgljabatan;
                        }
                        ?> </td>
                    <td class="verdana8blu" valign="top">
                        <?
                        if ($act == "editriwjab") {
                            echo "<input type=text name=jabagen[] id=jabagen value='" . $jabatanagen . "'>";
                        } else {
                            echo $jabatanagen;
                        }
                        ?> </td>
                    <td class="verdana8blu" valign="top">
                        <?
                        if ($act == "editriwjab") {
                            echo "<input type=text name=kelasagen[] id=kelasagen value='" . $kelasagen . "'>";
                        } else {
                            echo $kelasagen;
                        }
                        ?> </td>
                    <td class="verdana8blu" valign="top">
                        <?
                        if ($act == "editriwjab") {
                            echo "<input type=text name=uraijab[] id=uraijab value='" . $uraian . "'>";
                        } else {
                            echo $uraian;
                        }
                        ?> </td>
                    <td class="verdana8blu" valign="top">
                        <?
                        if ($act == "editriwjab") {
                            echo "<input type=text name=ketjab[] id=ketjab value='" . $keterangan . "'>";
                        } else {
                            echo $keterangan;
                        }
                        ?> </td>
                    <? if ($kantornya == 'KP') { ?>
                        <td class="verdana8blu" valign="top"><a href="biodataagen_new.php?act=hapusriwjab&noagen=<? echo $noagen; ?>&kja=<? echo $kdjabatanagen ?>&kka=<? echo $kdkelasagen; ?>&tgljab=<? echo $tgljabatan; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data Ini  <? echo $nama; ?> ?')">Delete</a>
                            <?
                            //echo(" <a href=\"#\" class=\"verdana8blu\" onclick=\"NewWindow('updjabatanagend3d1.php?noklien=$noagen&noagen=$noagen&kdjabatanagen=$kdjabatanagen&kdkelasagen=$kdkelasagen&tgljabatan=$tgljabatan&uraianjabatan=$uraian&ketjabatan=$keterangan&bo=$prefixagen','updclnt',500,250,1);\">Edit</a>");
                            // echo(" <a href=\"#\" class=\"verdana8blu\" onclick=\"NewWindow('updjabatanagen_d3d1.php?noklien=$noagen&noagen=$noagen&kdjabatanagen=$kdjabatanagen&kdjabatanagenold=$kdjabatanagen&kdkelasagen=$kdkelasagen&kdkelasagenold=$kdkelasagen&tgljabatan=$tgljabatan&tgljabatanold=$tgljabatan&uraianjabatan=$uraian&ketjabatan=$keterangan&kdkantorX=$prefixagen&namamutasi=$uraian','updclnt',500,250,1);\">Edit</a>");
                            $kodeJabatanWSBS = array('31', '32', '33', '34', '35', '36', '37', '38');
                            if (in_array($kdjabatanagen, $kodeJabatanWSBS)) {
                                echo (" <a href=\"#\" class=\"verdana8blu\" onclick=\"NewWindow('updspa_new_lpa.php?&noagen=$noagen&preagen=$prefixagen&kdjabatanagen=$kdjabatanagen','updclnt',500,250,1);\">Edit</a>");
                            } else {
                                echo (" <a href=\"#\" class=\"verdana8blu\" onclick=\"NewWindow('updspa_new2020_edit.php?&noagen=$noagen&preagen=$prefixagen&kdjabatanagen=$kdjabatanagen','updclnt',500,250,1);\">Edit</a>");
                            }
                            ?>
                        <? } ?>
                        </td>
                </tr>
            <?
                        $i++;
                        $jum = $i - 1;
                    }
            ?>
        </table>
    </form>
<? } ?>
<a href="biodataagen_new.php?act=addriwjab&noagen=<? echo $noagen; ?>">add</a></td>
</tr>

<tr>
    <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
        <br>
        <b>SAUDARA YANG DAPAT DIHUBUNGI</b>
        <form action="#" method="post" name="lisensiagen">
            <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                <tr>
                    <td width="18%" align="center" bgcolor="#D2E7B4" class="verdana8blu">NAMA</td>
                    <td width="15%" align="center" bgcolor="#D2E7B4" class="verdana8blu">HUBUNGAN</td>
                    <td width="36%" align="center" bgcolor="#D2E7B4" class="verdana8blu">ALAMAT</td>
                    <td width="16%" align="center" bgcolor="#D2E7B4" class="verdana8blu">NO. TELEPON </td>
                    <td width="15%" align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>
                </tr>
                <tr>
                    <td class="verdana8blu" valign="top"><?= $arr["NAMASDR"]; ?>&nbsp;</td>
                    <td class="verdana8blu" valign="top" align="center"><?= $arr["HUBUNGANSDR"]; ?></td>
                    <td class="verdana8blu" valign="top"><?= $arr["ALAMATSDR"]; ?></td>
                    <td class="verdana8blu" valign="top" align="center"><?= $arr["NOTELPSDR"]; ?></td>
                    <td class="verdana8blu" valign="top" align="center"><!--<a href="biodataagen_d3d1.php?act=hapuslisensi&noagen=<? echo $noagen; ?>&tgllahir=<? echo $tglahir; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data ini?')">Delete</a>-->
                        <? echo (" <a href=\"#\" class=\"verdana8blu\" onclick=\"NewWindow('updsdragen.php?noklien=$noagen&noagen=$noagen','updclnt',600,250,1);\">Edit</a>");
                        ?></td>
                </tr>
            </table>
        </form>
        <!--<a href="biodataagen_d3d1.php?act=addlisensi&noagen=<? echo $noagen; ?>">add</a>--> <br />
    </td>
</tr>
<tr>
    <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
        <br>
        <b>INFORMASI REKRUITER</b>
        <form action="#" method="post" name="lisensiagen">
            <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                <tr>
                    <td width="27%" align="center" bgcolor="#D2E7B4" class="verdana8blu">NAMA </td>
                    <td width="33%" align="center" bgcolor="#D2E7B4" class="verdana8blu">NOMOR AGEN </td>
                    <td width="30%" align="center" bgcolor="#D2E7B4" class="verdana8blu">JABATAN </td>
                    <!--<td width="10%" align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>-->
                </tr>
                <tr>
                    <td class="verdana8blu" valign="top"><?= $arr["NAMAREKR"]; ?></td>
                    <td class="verdana8blu" valign="top" align="center"><?= $arr["NOAGENREKR"]; ?></td>
                    <td valign="top" class="verdana8blu" align="center">

                        <?
                        $sqljr = "select * from $DBUser.tabel_413_jabatan_agen where KDJABATANAGEN='" . $arr["KDJABATANREKR"] . "'";
                        $DB->parse($sqljr);
                        $DB->execute();
                        $arrjr = $DB->nextrow();
                        echo $arrjr["NAMAJABATANAGEN"];
                        ?> </td>
                    <!--<td class="verdana8blu" valign="top" align="center"><!--<a href="biodataagen_d3d1.php?act=hapusrekr&noagen=<? echo $noagen; ?>&tgllahir=<? echo $tglahir; ?>" OnClick="return confirm('Apakah Anda Benar - Benar Akan Menghapus Data ini ?')">Delete</a>-->
                    <? //echo(" <a href=\"#\" class=\"verdana8blu\" onclick=\"NewWindow('updrekragen.php?noklien=$noagen&noagen=$noagen&kdjabatanrekr=$arrjr[KDJABATANAGEN]','updclnt',500,250,1);\">Edit</a>");
                    ?>
    </td>
</tr>
</table>
</form>
<?php $sqljabatan = "select KDJABATANAGEN FROM $DBUser.tabel_400_agen where noagen = '$noagen'";
$DB->parse($sqljabatan);
$DB->execute();
$jbtnagn = $DB->nextrow();
if ($jbtnagn['KDJABATANAGEN'] == '29') {
?>

    <tr>
        <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
            <br>
            <b>INFORMASI Dokumen AGEN LPA</b>
            <form action="#" method="post" name="lisensiagen">
                <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                    <tr>
                        <td align="center" bgcolor="#D2E7B4" class="verdana8blu">NAMA FILE </td>
                        <td align="center" bgcolor="#D2E7B4" class="verdana8blu">Isi File</td>
                        <td " align=" center" bgcolor="#D2E7B4" class="verdana8blu">Status </td>
                        <td align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>
                    </tr>
                    <?
                    $sqljr = "select FILE_NPWP,FILE_BAST,FILE_KK,FILE_SURAT_RESIGN,FILE_PERNYATAAN_PENGHASILAN,FOTOAGEN,KTPAGEN,BUKUREKAGEN from $DBUser.tabel_400_agen where noagen='$noagen'";
                    $DB->parse($sqljr);
                    $DB->execute();
                    $ext = $DB->nextrow();
                    ?>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File KTP</td>
                        <?php if ($ext['KTPAGEN'] == null or $ext['KTPAGEN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['KTPAGEN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['KTPAGEN'] == null or $ext['KTPAGEN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>
                        <td rowspan="7" valign="center" class="verdana8blu" align="center"><a href="#" onclick="NewWindow('updfile.php?noklien=<?= $noagen; ?>&noagen=<?= $noagen; ?>','updclnt',700,1200,1);">Edit File</a></td>
                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File NPWP</td>
                        <?php if ($ext['FILE_NPWP'] == null or $ext['FILE_NPWP'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_NPWP']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_NPWP'] == null or $ext['FILE_NPWP'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Halaman depan buku rekening</td>
                        <?php if ($ext['BUKUREKAGEN'] == null or $ext['BUKUREKAGEN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['BUKUREKAGEN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['BUKUREKAGEN'] == null or $ext['BUKUREKAGEN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Pernyataan BAST/Kepatuhan Kepemilikan Tab</td>
                        <?php if ($ext['FILE_BAST'] == null or $ext['FILE_BAST'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_BAST']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_BAST'] == null or $ext['FILE_BAST'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Pernyataan Anggota Keluarga</td>
                        <?php if ($ext['FILE_KK'] == null or $ext['FILE_KK'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_KK']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_KK'] == null or $ext['FILE_KK'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Resign</td>
                        <?php if ($ext['FILE_SURAT_RESIGN'] == null or $ext['FILE_SURAT_RESIGN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_SURAT_RESIGN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_SURAT_RESIGN'] == null or $ext['FILE_SURAT_RESIGN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Pernyataan Penghasilan</td>
                        <?php if ($ext['FILE_PERNYATAAN_PENGHASILAN'] == null or $ext['FILE_PERNYATAAN_PENGHASILAN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_PERNYATAAN_PENGHASILAN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_PERNYATAAN_PENGHASILAN'] == null or $ext['FILE_PERNYATAAN_PENGHASILAN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
        <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
            <br>
            <b>INFORMASI Biaya AGEN LPA</b>
            <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                <!-- biaya agen LPA -->
                <tr>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu"> Nama Biaya </td>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu"> Nominal Biaya </td>
                </tr>


                <?php

                $sql = "select nama_biaya, a.jumlah
					from tabel_400_mapping_lisensi_lpa a
					inner join tabel_400_setup_lisensi b on a.idkomponen = b.idkomponen
					where a.noagen = '$noagen'";
                //echo $sql;//die;
                $list = ociparse($conn, $sql);
                ociexecute($list);
                $i = 1;
                while (($arr = oci_fetch_array($list, OCI_BOTH)) != false) {
                    $jumlah += $arr['JUMLAH'];
                ?>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center"> <?= $arr['NAMA_BIAYA']; ?></td>
                        <td class="verdana8blu" valign="top" align="center"> <?= $arr['JUMLAH']; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu">Total</td>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu"> <?= "Rp. " . number_format($jumlah, 2, ",", ".") ?> </td>
                </tr>
                <tr>
                    <td colspan='2' class="verdana8blu" valign="top" align="center"> <a href="#" onclick="NewWindow('biaya_lisensi_lpa.php?noagen=<?= $noagen; ?>','updclnt',700,1200,1);">Tambah/Edit Biaya</a> </td>
                </tr>

            </table>
        </td>
    </tr>
<?php } ?>

<?php
$kodeJabatanWSBS = array('31', '32', '33', '34', '35', '36', '37', '38');
$jabatanAgen = $jbtnagn['KDJABATANAGEN'] == '31' ? 'WS' : 'BS';

if (in_array($jbtnagn['KDJABATANAGEN'], $kodeJabatanWSBS)) {
?>
    <tr>
        <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
            <br>
            <b>INFORMASI Dokumen AGEN <?= $jabatanAgen ?></b>
            <form action="#" method="post" name="lisensiagen">
                <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                    <tr>
                        <td align="center" bgcolor="#D2E7B4" class="verdana8blu">NAMA FILE </td>
                        <td align="center" bgcolor="#D2E7B4" class="verdana8blu">Isi File</td>
                        <td align="center" bgcolor="#D2E7B4" class="verdana8blu">Status </td>
                        <td align="center" bgcolor="#D2E7B4" class="verdana8blu">ACTION</td>
                    </tr>
                    <?
                    $sqljr = "select FILE_NPWP,FILE_BAST,FILE_KK,FILE_SURAT_RESIGN,FILE_PERNYATAAN_PENGHASILAN,FOTOAGEN,KTPAGEN,BUKUREKAGEN from $DBUser.tabel_400_agen where noagen='$noagen'";
                    $DB->parse($sqljr);
                    $DB->execute();
                    $ext = $DB->nextrow();
                    ?>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File KTP</td>
                        <?php if ($ext['KTPAGEN'] == null or $ext['KTPAGEN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['KTPAGEN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['KTPAGEN'] == null or $ext['KTPAGEN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>
                        <td rowspan="7" valign="center" class="verdana8blu" align="center"><a href="#" onclick="NewWindow('updfile.php?noklien=<?= $noagen; ?>&noagen=<?= $noagen; ?>','updclnt',700,1200,1);">Edit File</a></td>
                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File NPWP</td>
                        <?php if ($ext['FILE_NPWP'] == null or $ext['FILE_NPWP'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_NPWP']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_NPWP'] == null or $ext['FILE_NPWP'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Halaman depan buku rekening</td>
                        <?php if ($ext['BUKUREKAGEN'] == null or $ext['BUKUREKAGEN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['BUKUREKAGEN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['BUKUREKAGEN'] == null or $ext['BUKUREKAGEN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Pernyataan BAST/Kepatuhan Kepemilikan Tab</td>
                        <?php if ($ext['FILE_BAST'] == null or $ext['FILE_BAST'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_BAST']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_BAST'] == null or $ext['FILE_BAST'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Pernyataan Anggota Keluarga</td>
                        <?php if ($ext['FILE_KK'] == null or $ext['FILE_KK'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_KK']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_KK'] == null or $ext['FILE_KK'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Resign</td>
                        <?php if ($ext['FILE_SURAT_RESIGN'] == null or $ext['FILE_SURAT_RESIGN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_SURAT_RESIGN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_SURAT_RESIGN'] == null or $ext['FILE_SURAT_RESIGN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center">File Surat Pernyataan Penghasilan</td>
                        <?php if ($ext['FILE_PERNYATAAN_PENGHASILAN'] == null or $ext['FILE_PERNYATAAN_PENGHASILAN'] == '') { ?>
                            <td class="verdana8blu" valign="top" align="center">File Tidak Ada</td>
                        <?php } else { ?>
                            <td class="verdana8blu" valign="top" align="center"><a href="./dokumen_lpa/<?= $noagen . '/' . $ext['FILE_PERNYATAAN_PENGHASILAN']; ?>" download>Lihat File</td>
                        <?php } ?>
                        <td valign="top" class="verdana8blu" align="center"><?php if ($ext['FILE_PERNYATAAN_PENGHASILAN'] == null or $ext['FILE_PERNYATAAN_PENGHASILAN'] == '') {
                                                                                echo "File Belom Di Upload";
                                                                            } else {
                                                                                echo "File Telah Diupload";
                                                                            } ?></td>

                    </tr>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
        <td width="100%" bgcolor="#B8E4E2" class="verdana9blu">
            <br>
            <b>INFORMASI Biaya AGEN <?= $jabatanAgen ?></b>
            <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6CABCA" width="100%" id="AutoNumber5">
                <!-- biaya agen LPA -->
                <tr>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu"> Nama Biaya </td>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu"> Nominal Biaya </td>
                </tr>


                <?php

                $sql = "select nama_biaya, a.jumlah
					from tabel_400_mapping_lisensi_lpa a
					inner join tabel_400_setup_lisensi b on a.idkomponen = b.idkomponen
					where a.noagen = '$noagen'";
                //echo $sql;//die;
                $list = ociparse($conn, $sql);
                ociexecute($list);
                $i = 1;
                while (($arr = oci_fetch_array($list, OCI_BOTH)) != false) {
                    $jumlah += $arr['JUMLAH'];
                ?>
                    <tr>
                        <td class="verdana8blu" valign="top" align="center"> <?= $arr['NAMA_BIAYA']; ?></td>
                        <td class="verdana8blu" valign="top" align="center"> <?= $arr['JUMLAH']; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu">Total</td>
                    <td align="center" bgcolor="#D2E7B4" class="verdana8blu"> <?= "Rp. " . number_format($jumlah, 2, ",", ".") ?> </td>
                </tr>
                <tr>
                    <td colspan='2' class="verdana8blu" valign="top" align="center"> <a href="#" onclick="NewWindow('biaya_lisensi_lpa.php?noagen=<?= $noagen; ?>','updclnt',700,1200,1);">Tambah/Edit Biaya</a> </td>
                </tr>

            </table>
        </td>
    </tr>
<?php
}
?>
</table>
</td>
</tr>
</table>
<br>
</div>
<hr size="1">
<a class="verdana10blk" href="caribiodataagen.php">Back</a>&nbsp;&nbsp;
<a class="verdana10blk" href="../mnukeagenan">Menu Keagenan</a>
