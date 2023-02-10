<?
   include "../../includes/session.php";
   include "../../includes/database.php";

   //$conn = ocilogon($userid,$passwd,$DBName);
   $conn = ocilogon($DBUser, $DBPass, $DBName);
        
   $nama_hari = array(1=>"Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");   
   
   $x= mktime(0, 0, 0, $row["BLN"], $row["TGL"],  $row["THN"]);
   $namahari=date("l", $x);
   if ($namahari == "Sunday") $namahari = "Minggu";
   else if ($namahari == "Monday") $namahari = "Senin";
   else if ($namahari == "Tuesday") $namahari = "Selasa";
   else if ($namahari == "Wednesday") $namahari = "Rabu";
   else if ($namahari == "Thursday") $namahari = "Kamis";
   else if ($namahari == "Friday") $namahari = "Jumat";
   else if ($namahari == "Saturday") $namahari = "Sabtu";
   
   $nama_bulan = array(1=>"JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");   
   
   $DBX=new Database($userid,$passwd,$DBName);
   $sqlt="select $DBUser.terbilang (".$row["THN"].") bilangan from dual";
   $DBX->parse($sqlt);
   $DBX->execute();
   $arrt=$DBX->nextrow();
   $tahun=ucwords(strtolower(str_replace('RUPIAH','',$arrt["BILANGAN"])));
   
   $sqltgl="select $DBUser.terbilang (".$row["TGL"].") bilangan from dual";
   $DBX->parse($sqltgl);
   $DBX->execute();
   $arrtgl=$DBX->nextrow();
   $tanggal=ucwords(strtolower(str_replace('RUPIAH','',$arrtgl["BILANGAN"])));

   $sqlDetail = "SELECT  A.NOAGEN,
	                     A.NOPKAJAGEN,
	                     A.URAIAN,
						 (select NAMA_TTD FROM TABEL_400_PENANDATANGANAN_PKAJ WHERE a.kdkantor = kode_kantor and jabatan_agen = A.KDJABATANAGEN) NAMA_TTD,
	                     TO_CHAR(A.TGLJABATAN,'DDMMYYYY') AS TGLBERLAKU,
						 TO_CHAR(A.TGL_APPROVAL,'DDMMYYYY') AS TGLAPPROVE,
	                     (SELECT H.NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN H WHERE A.NOAGEN = H.NOKLIEN) AS NAMAAGEN,
                       (SELECT KDKANTOR FROM $DBUser.TABEL_001_AGENCY_KANTOR WHERE KDKANTOR = (SELECT KDKANTOR FROM $DBUser.TABEL_400_AGEN WHERE NOAGEN = C.NOAGEN ) ) AS KDKANTORAGENCY,
                       (SELECT NAMA_AGENCY FROM $DBUser.TABEL_001_AGENCY_KANTOR A WHERE KDKANTOR = (SELECT KDKANTOR FROM $DBUser.TABEL_400_AGEN WHERE NOAGEN = C.NOAGEN) ) AS NAMAAGENCY,
	                     B.TGLPKAJAGEN,
	                     A.TGLPENETAPAN,
	                     (SELECT F.NAMAJABATANAGEN FROM $DBUser.TABEL_413_JABATAN_AGEN F WHERE A.KDJABATANAGEN = F.KDJABATANAGEN) AS JABATAN_BARU,
	                     (SELECT E.NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN E WHERE A.ATASAN_BARU = E.NOKLIEN) AS ATASAN_BARU,
	                     (SELECT M.NAMAKANTOR FROM $DBUser.TABEL_001_KANTOR M WHERE A.KDKANTOR = M.KDKANTOR) AS KANTOR,
	                     (SELECT X.NAMAJABATANAGEN FROM $DBUser.TABEL_413_JABATAN_AGEN X WHERE X.KDJABATANAGEN = ( SELECT O.KDJABATANAGEN FROM $DBUser.TABEL_417_HISTORI_JABATAN O
	                                                                                                             WHERE O.TGLJABATAN = (SELECT MAX(P.TGLJABATAN) FROM $DBUser.TABEL_417_HISTORI_JABATAN P
	                                                                                                                                 WHERE P.NOAGEN = A.NOAGEN 
                                                                                                                                         AND P.TGLJABATAN < A.TGLJABATAN
                                                                                                                                         AND (P.STATUS_APPROVAL = '2' OR P.STATUS_APPROVAL IS NULL)
	                                                                                                                                 )
	                                                                                                                  AND O.NOAGEN = A.NOAGEN
	                                                                                                                  AND ROWNUM <=1
	                                                                                                           )
	                     ) AS JABATAN_LAMA,
	                     (SELECT Y.NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN Y WHERE C.ATASAN_LAMA = Y.NOKLIEN) AS ATASAN_LAMA,
	                     A.KDKANTOR,
	                     A.KDJABATANAGEN,
                       (SELECT NAMAPEJABAT FROM $DBUser.tabel_002_pejabat WHERE KDKANTOR = A.KDKANTOR AND KDORGANISASI = '160') AS ASMEN,
                       (SELECT NAMAJABATAN FROM $DBUser.tabel_002_pejabat WHERE KDKANTOR = A.KDKANTOR AND KDORGANISASI = '160') AS JABATANASMEN,
                       (SELECT NAMA_TTD FROM $DBUser.TABEL_400_PENANDATANGANAN_PKAJ WHERE KODE_KANTOR = A.KDKANTOR AND JABATAN_AGEN = A.KDJABATANAGEN) AS NAMA_RAH,
                       (SELECT NAMA_TTD FROM $DBUser.TABEL_400_PENANDATANGANAN_PKAJ 
                          WHERE 
                          KODE_KANTOR = A.KDKANTOR AND JABATAN_AGEN =
                                                                      ( SELECT O.KDJABATANAGEN FROM $DBUser.TABEL_417_HISTORI_JABATAN O
                                                                         WHERE O.TGLJABATAN = (SELECT MAX(P.TGLJABATAN) FROM $DBUser.TABEL_417_HISTORI_JABATAN P
                                                                                               WHERE P.NOAGEN = A.NOAGEN 
                                                                                                     AND P.TGLJABATAN < A.TGLJABATAN
                                                                                                     AND (P.STATUS_APPROVAL = '2' OR P.STATUS_APPROVAL IS NULL)
                                                                                               )
                                                                              AND O.NOAGEN = A.NOAGEN
                                                                              AND ROWNUM <=1
                                                                       )
                       ) AS NAMA_RAH_2, 
                       (SELECT JABATAN_TTD FROM $DBUser.TABEL_400_PENANDATANGANAN_PKAJ WHERE KODE_KANTOR = A.KDKANTOR AND JABATAN_AGEN = A.KDJABATANAGEN) AS JABATAN_RAH,
                       (SELECT JABATAN_TTD FROM $DBUser.TABEL_400_PENANDATANGANAN_PKAJ WHERE KODE_KANTOR = A.KDKANTOR AND JABATAN_AGEN = ( SELECT O.KDJABATANAGEN FROM $DBUser.TABEL_417_HISTORI_JABATAN O
                                                                                                                                         WHERE O.TGLJABATAN = (SELECT MAX(P.TGLJABATAN) FROM $DBUser.TABEL_417_HISTORI_JABATAN P
                                                                                                                                                               WHERE P.NOAGEN = A.NOAGEN 
                                                                                                                                                                     AND P.TGLJABATAN < A.TGLJABATAN
                                                                                                                                                                     AND (P.STATUS_APPROVAL = '2' OR P.STATUS_APPROVAL IS NULL)
                                                                                                                                                               )
                                                                                                                                              AND O.NOAGEN = A.NOAGEN
                                                                                                                                              AND ROWNUM <=1
                                                                                                                                       )
                        ) AS JABATAN_RAH_2
              	FROM $DBUser.TABEL_417_HISTORI_JABATAN A, $DBUser.TABEL_400_PKAJ_AGEN B, $DBUser.TABEL_400_AGEN C
              	WHERE 
					A.KETERANGAN = '".$_GET['ket']."'
                    AND 
					TO_CHAR(A.TGLJABATAN,'DDMMYYYY') = '".$_GET['tgljabatan']."'
                    AND A.NOAGEN = '".$_GET['noagen']."'
                    AND B.NOAGEN = A.NOAGEN
                    AND B.NOPKAJAGEN = A.NOPKAJAGEN
                    AND A.NOAGEN = C.NOAGEN
             	";
   //echo($sqlDetail);
    $detail=ociparse($conn, $sqlDetail);
    ociexecute($detail);
    ocifetch($detail);
    $bln='';
    $tglberlaku = ociresult($detail,"TGLBERLAKU");
	$tglapprove = ociresult($detail,"TGLAPPROVE");
	
	$kodeJab = "BAS";
	if(in_array(ociresult($detail,"KDJABATANAGEN"), array("32","33","34","35"))){
		$typeJab = str_replace("BS", ucfirst(strtolower("BANCASSURANCE SPECIALIST")), ociresult($detail,"JABATAN_BARU"));
	}elseif(in_array(ociresult($detail,"KDJABATANAGEN"), array("36","37","38"))){
		$typeJab = str_replace("BAM", ucfirst(strtolower("BANCASSURANCE AREA MANAGER")), ociresult($detail,"JABATAN_BARU"));
	}else{
		$kodeJab = "WST";
		$typeJab = str_replace("WS", ucfirst(strtolower("WORKSITE SPECIALIST")), ociresult($detail,"JABATAN_BARU"));
	}
	
	$typeJab = ucwords(strtolower($typeJab));
	
	
	switch (ociresult($detail,"KDJABATANAGEN")) {
        case '32':
            $targetJab = "Rp30.000.000";
            break;
        case '33':
            $targetJab = "Rp60.000.000";
            break;
        case '34':
            $targetJab = "Rp80.000.000";
            break;
        case '35':
            $targetJab = "Rp100.000.000";
            break;
        case '36':
            $targetJab = "Rp500.000.000";
            break;
        case '37':
            $targetJab = "Rp700.000.000";
            break;
        case '38':
            $targetJab = "Rp900.000.000";
            break;
        default:
            $targetJab = "Rp72.000.000";
            break;
    }
	
    $sqlagency = "SELECT NAMAKANTOR, A.KDKANTOR FROM $DBUser.TABEL_001_AGENCY_KANTOR A, $DBUser.TABEL_001_KANTOR B, $DBUser.TABEL_400_AGEN C
          WHERE    a.kdkantor = B.kdkantor
          AND (SELECT NAMA_AGENCY
          FROM $DBUser.TABEL_001_AGENCY_KANTOR
          WHERE kdkantor = (SELECT KDKANTOR FROM $DBUser.TABEL_400_AGEN WHERE NOAGEN = '".$_GET['noagen']."')) = A.nama_agency
          GROUP BY A.KDKANTOR, NAMAKANTOR";
  
  $agencykantor=ociparse($conn, $sqlagency);
    ociexecute($agencykantor);
  
  $sqlagency2 = "SELECT NAMAKANTOR, A.KDKANTOR FROM $DBUser.TABEL_001_AGENCY_KANTOR A, $DBUser.TABEL_001_KANTOR B, $DBUser.TABEL_400_AGEN C
          WHERE    a.kdkantor = B.kdkantor
          AND (SELECT NAMA_AGENCY
          FROM $DBUser.TABEL_001_AGENCY_KANTOR
          WHERE kdkantor = (SELECT KDKANTOR FROM $DBUser.TABEL_400_AGEN WHERE NOAGEN = '".$_GET['noagen']."')) = A.nama_agency
          GROUP BY A.KDKANTOR, NAMAKANTOR";
  
  $agencykantor2=ociparse($conn, $sqlagency2);
    ociexecute($agencykantor2);
?>
<style>

ul.dashed {
  list-style-type: none;
}
ul.dashed > li:before {
  content: "- ";
}
</style>
<table style="width: 1001px;">
<tbody>
<tr>
<td style="width: 1033px;" colspan="6">
<p style="text-align: center;"><strong>SURAT PENETAPAN</strong></p>
<p style="text-align: center;"><strong>PT ASURANSI JIWA IFG</strong></p>
<p style="text-align: center;"><strong>NOMOR :&nbsp; </strong><strong><?=$_GET["ket"];?></strong></p>
</td>
</tr>
<tr>
<td style="width: 1033px;" colspan="6">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="width: 26px;vertical-align:top;">
<p>1.</p>
</td>
<td style="width: 1007px;" colspan="5">
<p>Berdasarkan </p>
</td>
</tr>
<!-- <tr>
<td style="width: 26px;vertical-align:top;">
<p></p>
</td>
<td style="width: 26px;vertical-align:top;">
<p>a.</p>
</td>
<td style="width: 1007px;" colspan="5">
<p>Keputusan Direksi PT Asuransi Jiwa IFG Nomor tanggal <? if(substr($_GET["tglpkaj"],3,1) == 0) {$bln = substr($_GET["tglpkaj"],4,1);}else{$bln = substr($_GET["tglpkaj"],3,2);} echo substr($_GET["tglpkaj"],0,2)." ".ucwords(strtolower($nama_bulan[$bln]))." ".substr($_GET["tglpkaj"],-4);?> tentang Pedoman Sistem Kemitraan Alternative Distribution PT Asuransi Jiwa IFG; </p>
</td>
</tr>
<tr>
<td style="width: 26px;vertical-align:top;">
<p></p>
</td>
<td style="width: 26px;vertical-align:top;">
<p>b.</p>
</td>
<td style="width: 1007px;" colspan="5">
<p>Perjanjian Keagenan Asuransi Jiwa (PKAJ) nomor  <?=$_GET["nopkaj"];?>/IFGL/LPA/<?=substr($_GET["tglpkaj"],3,2);?><?=substr($_GET["tglpkaj"],-2)?> tanggal <? if(substr($_GET["tglpkaj"],3,1) == 0) {$bln = substr($_GET["tglpkaj"],4,1);}else{$bln = substr($_GET["tglpkaj"],3,2);} echo substr($_GET["tglpkaj"],0,2)." ".ucwords(strtolower($nama_bulan[$bln]))." ".substr($_GET["tglpkaj"],-4);?> dan atas nama <?=ucwords(strtolower(ociresult($detail,"NAMAAGEN")));?>.</p>
</td>
</tr> -->

<tr>
<td style="width: 26px;vertical-align:top;">
<p></p>
</td>
<td style="width: 1007px;" colspan="5">
<p>Perjanjian Keagenan Asuransi Jiwa (PKAJ) nomor  <?=$_GET["nopkaj"];?>/IFGL/<?= $kodeJab ?>/<?=substr($_GET["tglpkaj"],3,2);?><?=substr($_GET["tglpkaj"],-2)?> tanggal <? if(substr($_GET["tglpkaj"],3,1) == 0) {$bln = substr($_GET["tglpkaj"],4,1);}else{$bln = substr($_GET["tglpkaj"],3,2);} echo substr($_GET["tglpkaj"],0,2)." ".ucwords(strtolower($nama_bulan[$bln]))." ".substr($_GET["tglpkaj"],-4);?> dan atas nama <?=ucwords(strtolower(ociresult($detail,"NAMAAGEN")));?>.</p>
</td>
</tr> 

<tr>
<td style="width: 1033px;" colspan="6">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="width: 26px;">
<p>2.</p>
</td>
<td style="width: 1007px;" colspan="5">
<p>Dengan Mempertimbangkan :</p>
</td>
</tr>
<tr>
<td style="width: 26px;">
<p></p>
</td>
<td style="width: 26px;">
<p>a.</p>
</td>
<td style="width: 1007px;" colspan="5">
<p>Hasil seleksi terhadap yang bersangkutan;</p>
</td>
</tr>
<tr>
<td style="width: 26px;">
<p></p>
</td>
<td style="width: 26px;">
<p>b.</p>
</td>
<td style="width: 1007px;" colspan="5">
<p>Hasil evaluasi terhadap yang bersangkutan.</p>
</td>
</tr>
<tr>
<td style="width: 1033px;" colspan="6">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="width: 1033px;" colspan="6">
<p>Dengan ini PT Asuransi Jiwa IFG menetapkan :</p>
</td>
</tr>
<tr>
<td style="width: 1033px;" colspan="6">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="width: 36px;" colspan="2">
<p>a.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Nama Lengkap </p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p><?=ucwords(strtolower(ociresult($detail,"NAMAAGEN")));?> </p>
</td>
</tr>
<tr>
<td style="width: 36px;" colspan="2">
<p>b.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Nomor Agen</p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p><?=$_GET["noagen"];?></p>
</td>
</tr>


<tr>
<td style="width: 1033px;" colspan="6">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="width: 1033px;" colspan="6">
<p>Ditetapkan menjadi :</p>
</td>
</tr>
<tr>
<td style="width: 36px;" colspan="2">
<p>a.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Jabatan</p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p><?= $typeJab ?> </p>
</td>
</tr>
<tr>
<td style="width: 36px;" colspan="2">
<p>b.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Kantor Representatif</p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p><?=ucwords(strtolower(ociresult($detail,"KANTOR")));?></p>
</td>
</tr>
<tr>
<td style="width: 36px;" colspan="2">
<p>c.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Sifat Penetapan</p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p><?=ucwords(strtolower(ociresult($detail,"URAIAN")));?></p>
</td>
</tr>

<tr>
<td style="width: 36px;" colspan="2">
<p>d.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Mulai berlaku sejak</p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p><? if(substr($tglberlaku,2,1) == 0) {$bln = substr($tglberlaku,3,1);}else{$bln = substr($tglberlaku,2,2);} echo substr($tglberlaku,0,2)." ".ucwords(strtolower($nama_bulan[$bln]))." ".substr($tglberlaku,-4);?></p>
</td>
</tr>

<tr>
<td style="width: 36px;" colspan="2">
<p>e.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Target</p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p>APE <?= $targetJab ?>,- per bulan</p>
</td>
</tr>

<tr>
<td style="width: 36px;" colspan="2">
<p>f.</p>
</td>
<td style="width: 171px;" colspan="2">
<p>Masa Evaluasi</p>
</td>
<td style="width: 10px;">
<p>:</p>
</td>
<td style="width: 816px;">
<p>Evaluasi dilakukan secara kuantitatif dan kualitatif atas kinerja <?= $typeJab ?> setiap kuartal</p>
</td>
</tr>

<tr>
<td style="width: 1033px;" colspan="6">
<p>&nbsp;</p>
<p>Adapun hak dan kewajiban <?= $typeJab ?> dalam Surat Penetapan (SPA) ini tertuang pada ketentuan Perusahaan yang berlaku.</p>
<p>&nbsp;</p>
<p>Demikian Surat Penetapan (SPA) ini dibuat dengan ketentuan akan diadakan perubahan sebagaimana mestinya apabila di kemudian hari ternyata terdapat kekeliruan, serta sebagai landasan kemitraan terhadap PT Asuransi Jiwa IFG dan merupakan bagian yang tidak terpisahkan dari Perjanjian Keagenan Asuransi Jiwa (PKAJ).</p>
</td>
</tr>
<tr>
<td style="width: 1033px;" colspan="6">&nbsp;</td>
</tr>
</table>
<table>
<tr>
  <td>
  <p><strong>J</strong><strong>AKARTA</strong><strong>,&nbsp;</strong><strong><? if(substr($tglapprove,2,1) == 0) {$bln = substr($tglapprove,3,1);}else{$bln = substr($tglapprove,2,2);} echo substr($tglapprove,0,2)." ".ucwords(strtolower($nama_bulan[$bln]))." ".substr($tglapprove,-4);?></strong></p>
  <p><strong>PT. ASURANSI JIWA IFG</strong>&nbsp;&nbsp;</p>
  <p style="text-align: left;"><strong>&nbsp;</strong><img src="https://chart.googleapis.com/chart?chs=130x130&cht=qr&chl=<?=ociresult($detail,'NAMA_RAH');?>&choe=UTF-8&chld=H|0" /></p>
  <p style="text-align: left;"><strong><?=ociresult($detail,'NAMA_TTD');?><br /> <?= strtoupper(ociresult($detail,'JABATAN_RAH')) ;?></strong></p>
  </td>

</tr>
</tbody>
</table>
