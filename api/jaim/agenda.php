<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data dashboard
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	$r	= isset($_GET['r']) ? $_GET['r'] : '';
	$p	= isset($_GET['p']) ? $_GET['p'] : '';
	$p2 = isset($_GET['p2']) ? $_GET['p2'] : '';
	$p3 = isset($_GET['p3']) ? $_GET['p3'] : '';
	$p4 = isset($_GET['p4']) ? $_GET['p4'] : '';
	$p5 = isset($_GET['p5']) ? $_GET['p5'] : '';
	$p6 = isset($_GET['p6']) ? $_GET['p6'] : '';
	$p7 = isset($_GET['p7']) ? $_GET['p7'] : '';
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	/*===== tarik data kurs transaksi =====*/
	if (strcasecmp($r, '100') == 0) {
		$sql = "SELECT TO_CHAR(TGLKURSBERLAKU, 'DD/MM/YYYY') TGLBERLAKU, KURS, 
					KDVALUTA, DECODE(KDVALUTA, '0', 'Indeks', 'X', 'Indeks NAB', 'US$') VALUTA
				FROM TABEL_999_KURS_TRANSAKSI a
				WHERE TGLKURSBERLAKU = (SELECT MAX(TGLKURSBERLAKU) FROM TABEL_999_KURS_TRANSAKSI WHERE KDVALUTA = a.KDVALUTA) AND KDVALUTA != '1'
				ORDER BY KDVALUTA";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data kurs js fixed =====*/
	else if (strcasecmp($r, '101') == 0) {
		$svr = "192.168.4.27";
		$usr = "sa";
		$pwd = "siar";
		$db = "siar";
		
		$connect = mssql_connect($svr, $usr, $pwd) or die("Couldn't connect to SQL Server on $svr");
		mssql_select_db($db, $connect) or die("Couldn't open database $db");
		
		$sql = "SELECT convert(varchar, tanggal, 103) AS TGLBERLAKU, tanggal, value AS KURS, 'JSFIXED93/95' AS VALUTA
				FROM tablenab 
				WHERE tanggal IN (SELECT MAX(tanggal) FROM tablenab)";
		
		$result = mssql_query($sql);
		
		echo json_encode(mssql_fetch_array($result));
		//echo $sql;
	}
	
	
	/*===== tarik data kurs nab jual =====*/
	else if (strcasecmp($r, '102') == 0) {
		$svr = "192.168.4.27";
		$usr = "sa";
		$pwd = "siar";
		$db = "unitlink";
		
		$connect = mssql_connect($svr, $usr, $pwd) or die("Couldn't connect to SQL Server on $svr");
		mssql_select_db($db, $connect) or die("Couldn't open database $db");
		
		$sql = "SELECT kode_fund AS VALUTA, convert(varchar, tgl_nab, 103) AS TGLBERLAKU, nab_jual AS KURS
				FROM ul_nab 
				WHERE tgl_nab IN (SELECT MAX(tgl_nab) FROM ul_nab)";
		
		$result = mssql_query($sql);
		while($v = mssql_fetch_array($result)) {
			$data[] = $v;
		}
		
		echo json_encode($data);
		//echo $sql;
	}
	
	
	/*===== tarik data kurs nab beli =====*/
	else if (strcasecmp($r, '103') == 0) {
		$svr = "192.168.4.27";
		$usr = "sa";
		$pwd = "siar";
		$db = "unitlink";
		
		$connect = mssql_connect($svr, $usr, $pwd) or die("Couldn't connect to SQL Server on $svr");
		mssql_select_db($db, $connect) or die("Couldn't open database $db");
		
		$sql = "SELECT kode_fund AS VALUTA, convert(varchar, tgl_nab, 103) AS TGLBERLAKU, nab_beli AS KURS
				FROM ul_nab 
				WHERE tgl_nab IN (SELECT MAX(tgl_nab) FROM ul_nab)";
		
		$result = mssql_query($sql);
		while($v = mssql_fetch_array($result)) {
			$data[] = $v;
		}
		
		echo json_encode($data);
		//echo $sql;
	}
	
	
	/*===== tarik data kurs nab js new =====*/
	else if (strcasecmp($r, '104') == 0) {
		$sql = "SELECT 'JS' || DECODE(KODE_FUND,'EF','LE','BF','LB','FF','LPT','LPU') VALUTA, kode_fund, 
					TO_CHAR(tgl_nab,'DD/MM/YYYY') TGLBERLAKU, nab_jual KURS 
				FROM tabel_ul_nab
				WHERE tgl_nab IN (SELECT MAX(tgl_nab) FROM tabel_ul_nab) ";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data kampus =====*/
	else if (strcasecmp($r, '105') == 0) {
		$sql = "SELECT a.nama, a.deskripsi, a.gambar, b.namakantor, c.namaareaoffice
				FROM jaim_000_kampus@jaim a
				INNER JOIN tabel_001_kantor b ON a.kdkantor = b.kdkantor
				INNER JOIN tabel_410_area_office c ON a.kdkantor = c.kdkantor AND a.kdareaoffice = c.kdareaoffice
				WHERE a.kdstatus = 1
				ORDER BY a.urutan ";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	/*===== tarik data rekrut =====*/
	if ($r == '0') {
		echo file_get_contents("http://192.168.10.43/fgd/sesi");
	}
	else if ($r == '1') {
		echo file_get_contents("http://192.168.10.43/fgd/geni?noagen=$p");
	}
	else if ($r == '2') {
		echo file_get_contents("http://192.168.10.43/fgd/antos?noagen=$p&kdkelas=$p2");
	}
?>