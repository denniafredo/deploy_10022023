<?php
set_time_limit(10000001);
include "../../includes/common.php";
//include "../../includes/session.php";
include "../../includes/database.php";
//include "../../includes/klien.php";
//include "../../includes/pertanggungan.php";
//include "../../includes/kantor.php";
include "../../includes/tgl.php";
include "../../includes/constant.php";
//require 'Googl.class.php';
//$googl = new Googl('AIzaSyAgtL-FIFmPFYP1_MGqzCmRq21cM2_X0Aw');
// nopolis = QB 001065838
//$userid="jsadm";
$userid="JSADM";
//$passwd="jsadmoke";
$passwd="JSADMOKE";
$DB  = new database($userid, $passwd, $DBName);	
$DBx  = new database($userid, $passwd, $DBName);	
//$PWK = New Kantor($userid,$passwd,$kantor);
//$KT  = New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
$prefix=strtoupper($prefix);
//$KP  = New KantorPusat($userid,$passwd);
//echo $tglpengajuan;


// 17150

$queryxx = "SELECT c.*,to_char(TGLBOOKED,'MM/YYYY') periode,to_char(TGLBOOKED,'YYYYMM') tglcari,
				   (select NAMAKLIEN1
					from tabel_200_pertanggungan a, TABEL_100_KLIEN b 
					where a.prefixpertanggungan = C.prefixpertanggungan 
					and a.nopertanggungan = C.nopertanggungan 
					and a.NOTERTANGGUNG = b.NOKLIEN) NAMAKLIEN,
					to_char(tglseatled,'YYYYMM') tglseatled,
					(select (NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETETAP01,nvl(PHONETAGIH01,PHONETAGIH02)))))
					from tabel_200_pertanggungan a, TABEL_100_KLIEN b 
					where a.prefixpertanggungan = C.prefixpertanggungan 
					and a.nopertanggungan = C.nopertanggungan 
					and a.nopemegangpolis = b.NOKLIEN) telp  		
			/*FROM $DBUser.TABLE_KIRIM_EMAIL */ 
			/*FROM $DBUser.PENERIMA_EMAIL_TES */
			FROM $DBUser.PENERIMA_EMAIL_TES c
			WHERE /*EMAIL IS NOT NULL 
			/*and status is null 
			and */ID_BLAST = (select max(ID_BLAST) ID_BLAST from email_blast_event where  JENIS_BLAST = 'EMAIL_PREMIUM_STATEMENT' AND GRUPING = 'GRUP') 
			and jenis in ('J') 
			and url = 'invalid'
			/*and to_char(tgl_record,'mm/yyyy') = to_char(sysdate,'mm/yyyy')
			and upper(email) not in (select upper(karakter) from $DBUser.exception_sendemail) */
			and rownum < 10
			order by PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,RAYONPENAGIHAN";
//echo $queryxx;die;

$DBx->parse($queryxx);
$DBx->execute();

/*$queryzz = "insert into  $DBUser.LOG_QUERY values (to_char(sysdate,'dd/mm/yyyy hh:mi:ss'),'ini dieksekusi memelalui cron sebelum looping')";
		$DB->parse($queryzz);
		$DB->execute();*/

while ($rowxx=$DBx->nextrow()) {
	$idaudience = $rowxx['ID_AUDIENCE'];
	$idblast = $rowxx['ID_BLAST'];
	$telp = $rowxx['TELP'];
	$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
	$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];	
	$tglcari = $rowxx['TGLSEATLED'];	
	$kdkantor = $rowxx['RAYONPENAGIHAN'];
	//echo '<br><br>bef gen pdf '.$prefixpertanggungan.$nopertanggungan.$tglcari;
	//gen_pdf($prefixpertanggungan,$nopertanggungan,$tglcari,$kdkantor); //die; --> asumsi sudah terbentuk
	
		
	//$url_encode = base64_encode($tglcari.'_PST_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf');
	$nama_file = $tglcari.'_PST_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';
	//$url_api = '192.168.1.20/get_shorturl.php?namafile='.$url_encode;
	$url_api = 'https://dplk.jiwasraya.co.id/get_shorturl.php?namafile='.$nama_file;
	//var_dump($url_api);//exit;
	
	$syntax = ' curl --insecure -v  '.$url_api;
	echo $syntax;		
	$result = shell_exec($syntax);
	
	//var_dump($result);exit;					
	
	
	echo '<br><br>\n\n';
	
	$res = json_decode($result);
	
	$url_pendek = null;
	if($res->status){
		//$url_pendek = $res->url;//str_replace("https://","",$res->url);
		$url_pendek = str_replace("https://","",$res->url);
	}else{
		$url_pendek = 'invalid';
		/*$queryzz = "insert into  $DBUser.LOG_QUERY values (to_char(sysdate,'dd/mm/yyyy hh:mi:ss'),'ini dieksekusi memelalui cron pas udh invalid ditengah')";
		$DB->parse($queryzz);
		$DB->execute();*/
	}
	
	echo ' url_pendek '. $url_pendek;
	//die;
	/*$queryzz = "insert into  $DBUser.LOG_QUERY values (to_char(sysdate,'dd/mm/yyyy hh:mi:ss'),'ini dieksekusi memelalui cron setelah url pendek ')";
		$DB->parse($queryzz);
		$DB->execute();*/

	$queryll = "update $DBUser.PENERIMA_EMAIL_TES
				set no_hp = '".$telp."',url = '".$url_pendek."'
				WHERE ID_BLAST = '".$idblast."'				
				and ID_AUDIENCE = '".$idaudience."'";
	$DB->parse($queryll);
	$DB->execute();
	//echo $queryxx;die;
	
	/*$queryzz = "insert into  $DBUser.LOG_QUERY values (to_char(sysdate,'dd/mm/yyyy hh:mi:ss'),' ini dieksekusi memelalui cron setelah update idblast $idblast -> idaudience -> $idaudience')";
	$DB->parse($queryzz);
	$DB->execute();*/
	
	echo $telp;
	echo '<br><br>';
	echo $url_pendek;
	echo '<br><br>';
	if ($url_pendek == 'invalid') {
		echo 'proses berhenti karena sudah mulai invalid';
		/*$queryzz = "insert into  $DBUser.LOG_QUERY values (to_char(sysdate,'dd/mm/yyyy hh:mi:ss'),$idaudience.' ini dieksekusi memelalui cron tapi udh invalid paling bawah')";
		$DB->parse($queryzz);
		$DB->execute();*/
		break;    
	}
		
}
		
?>