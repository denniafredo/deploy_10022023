<?php 

require_once 'includes/config.php';
require_once 'includes/database.php';
	
	$r	= isset($_GET['r']) ? $_GET['r'] : '';
	$p	= isset($_GET['p']) ? $_GET['p'] : '';
	$p1	= isset($_GET['p1']) ? $_GET['p1'] : '';
	$p2 = isset($_GET['p2']) ? $_GET['p2'] : '';
	$p3 = isset($_GET['p3']) ? $_GET['p3'] : '';
	$p4 = isset($_GET['p4']) ? $_GET['p4'] : '';
	$p5 = isset($_GET['p5']) ? $_GET['p5'] : '';
	$p6 = isset($_GET['p6']) ? $_GET['p6'] : '';
	$p7 = isset($_GET['p7']) ? $_GET['p7'] : '';
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	$DB2 = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	if($p2 != null && $p3 != null) {
		$tgl = "and tglproses between TO_DATE('$p2', 'DD/MM/YYYY') AND TO_DATE('$p3', 'DD/MM/YYYY') ";
	} else {
		$tgl = "";
	}

	$sql2 ="select d.noagen, 
			a.prefixpertanggungan||'-'||a.nopertanggungan as nopolis, 
			to_char(tglbooked,'dd/mm/yyyy') tglbooked, 
			to_char(tglseatled,'dd/mm/yyyy') tglseatled, 
			to_char(tglmulas,'dd/mm/yyyy') tglmulas, 
			to_char(tglproses,'dd/mm/yyyy') tglperiode,
			fyp, 
			jenis_remunerasi,
			jenis_produksi,
			d.nilaipendapatan,
			(select namaproduk from TABEL_202_PRODUK where kdproduk = c.kdproduk) as namaproduk,
			(select namaklien1 from tabel_100_klien where noklien = d.noagen) as namaagen,
			(select NAMAKANTOR from tabel_001_kantor where kdkantor = (select kdkantor from tabel_400_agen b where d.noagen = b.noagen)) as namakantor,
			(select namakomisiagen from tabel_402_kode_komisi_agen where d.kdkomisiagen = kdkomisiagen) as namakomisi,
			(case 
				when JENIS_PRODUKSI = '1' then 'PREMI'
				when JENIS_PRODUKSI = '2' then 'TOPUP SEKALIGUS'
				else ''
			end) as nama_produksi
			from tabel_400_produksi_lpa a
			right join tabel_200_pertanggungan c on c.prefixpertanggungan||c.nopertanggungan = a.prefixpertanggungan||a.nopertanggungan
			right join tabel_404_pendapatan_lain_agen d on a.noagen = d.noagen and a.jenis_remunerasi = d.kdkomisiagen and a.tglperiode = d.TGLPROSES and KDAUTHORISASI = '1'
			where d.noagen = '$p7'
			and d.kdkomisiagen NOT IN ('F4')
			and d.KDAUTHORISASI = '1'
			$tgl
			order by jenis_remunerasi asc, jenis_produksi asc ";
	//echo $sql2;die;
	
		$DB->parse($sql2);
		$DB->execute();
		
		echo json_encode($DB->result());

?>
