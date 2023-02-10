<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk menambahkan kurs & nab ke tabel jaim
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	$server = '192.168.4.27';
	$user = 'sa';
	$password = 'siar';
	$dbsiar = 'siar';
	$dbulink = 'unitlink';
	$connect = mssql_connect($server, $user, $password) or die("Couldn't connect to SQL Server on $svr");
	
	/* ================================ NAB JS FIXED 93/95 ================================ */
	mssql_select_db($dbsiar, $connect) or die("Couldn't open database $dbsiar");
	
	$sql = "SELECT CONVERT(VARCHAR(10), tanggal, 103) + ' ' + CONVERT(VARCHAR(8), tanggal, 114) AS tglberlaku,
				value AS kurs, 3 AS kdvaluta
			FROM tablenab 
			WHERE tanggal IN (SELECT MAX(tanggal) FROM tablenab)";	
	
	$result = mssql_query($sql);
	$r = mssql_fetch_array($result);
	
	$sql = "SELECT *
			FROM jaim_999_nab@jaim
			WHERE kdvaluta = '3'
				AND to_char(tglberlaku, 'dd/mm/yyyy hh24:mi:ss') = '$r[tglberlaku]'";
	$DB->parse($sql);
	$DB->execute();
	
	if ($DB->nextrow() === false) {
		$sql = "INSERT INTO jaim_999_nab@jaim (kdvaluta, kurs, tglberlaku)
				VALUES ('3', $r[kurs], TO_DATE('$r[tglberlaku]', 'dd/mm/yyyy hh24:mi:ss'))";
		$DB->parse($sql);
		$DB->execute();
		$DB->commit();
	}
	
	/* ================================ NAB JUAL ================================ */
	mssql_select_db($dbulink, $connect) or die("Couldn't open database $dbulink");
	
	$sql = "SELECT CONVERT(VARCHAR(10), tgl_nab, 103) + ' ' + CONVERT(VARCHAR(8), tgl_nab, 114) AS tglberlaku,
				nab_jual as kurs, CASE WHEN kode_fund = 'JSBL' THEN 4
				WHEN kode_fund = 'JSEQ' THEN 5
				WHEN kode_fund = 'JSFX' THEN 6 END kdvaluta
			FROM ul_nab 
			WHERE tgl_nab IN (SELECT MAX(tgl_nab) FROM ul_nab)";	
	
	$result = mssql_query($sql);
	
	while ($r = mssql_fetch_array($result)) {
		$sql = "SELECT *
				FROM jaim_999_nab_jual@jaim
				WHERE kdvaluta = '$r[kdvaluta]'
					AND to_char(tglberlaku, 'dd/mm/yyyy hh24:mi:ss') = '$r[tglberlaku]'";
		$DB->parse($sql);
		$DB->execute();
		
		if ($DB->nextrow() === false) {
			$sql = "INSERT INTO jaim_999_nab_jual@jaim (kdvaluta, kurs, tglberlaku)
					VALUES ('$r[kdvaluta]', $r[kurs], TO_DATE('$r[tglberlaku]', 'dd/mm/yyyy hh24:mi:ss'))";
			$DB->parse($sql);
			$DB->execute();
			$DB->commit();
		}
	}
	
	/* ================================ NAB BELI ================================ */
	mssql_select_db($dbulink, $connect) or die("Couldn't open database $dbulink");
	
	$sql = "SELECT CONVERT(VARCHAR(10), tgl_nab, 103) + ' ' + CONVERT(VARCHAR(8), tgl_nab, 114) AS tglberlaku,
				nab_beli as kurs, CASE WHEN kode_fund = 'JSBL' THEN 4
				WHEN kode_fund = 'JSEQ' THEN 5
				WHEN kode_fund = 'JSFX' THEN 6 END kdvaluta
			FROM ul_nab 
			WHERE tgl_nab IN (SELECT MAX(tgl_nab) FROM ul_nab)";	
	
	$result = mssql_query($sql);
	
	while ($r = mssql_fetch_array($result)) {
		$sql = "SELECT *
				FROM jaim_999_nab_beli@jaim
				WHERE kdvaluta = '$r[kdvaluta]'
					AND to_char(tglberlaku, 'dd/mm/yyyy hh24:mi:ss') = '$r[tglberlaku]'";
		$DB->parse($sql);
		$DB->execute();
		
		if ($DB->nextrow() === false) {
			$sql = "INSERT INTO jaim_999_nab_beli@jaim (kdvaluta, kurs, tglberlaku)
					VALUES ('$r[kdvaluta]', $r[kurs], TO_DATE('$r[tglberlaku]', 'dd/mm/yyyy hh24:mi:ss'))";
			$DB->parse($sql);
			$DB->execute();
			$DB->commit();
		}
	}