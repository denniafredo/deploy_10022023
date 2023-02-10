<head>
<link rel="stylesheet" type="text/css" href="js/jquery.qtip.min.css">
<script src="js/jquery-1.11.3.js"></script>
<script src="js/jquery.table2excel.js"></script>
<script src="js/jquery.qtip.min.js"></script>
<script src="js/imagesloaded.pkg.min.js"></script>
<script>

</script>
<style>
.tooltiptext{
    display: none;
}
.tipText {
	font-family:arial;
	color:navy;
	text-decoration:none;
}
.jamText{
	font-family:arial;
	color:white;
	text-decoration:none;
	cursor: help;
}
</style>
	</head>
 <?	/*
	* API file untuk aplikasi jaim
	* method untuk data REKAP ABSEN agen
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	$value = null;
	$tglmulai = "";
	$tglselesai = "";
	$rangetgl = "";
	
	
	function isWeekend($date) {
		$weekDay = date('w', strtotime($date));
		return ($weekDay == 0 || $weekDay == 6);
	}
	
	if(isset($_GET['tglmulai']) && $_GET['tglmulai'] != ""){
		if(isset($_GET['tglselesai']) && $_GET['tglselesai'] != ""){
			$tglmulai = $_GET['tglmulai'];
			//if(!validateDate($tglmulai)) echo "Tanggal Mulai Salah!";exit;
			$tglselesai = $_GET['tglselesai'];
			//if(!validateDate($tglselesai)) echo "Tanggal Selesai Salah!";exit;
			$tglmulai = " to_date('$tglmulai','dd-mm-yyyy') ";
			$tglselesai = " to_date('$tglselesai','dd-mm-yyyy') ";
		}
	
		$rangetgl = " AND DATESERIES >= $tglmulai AND  DATESERIES <= $tglselesai ";
	}
	
	if(isset($_GET['kodekantor'])   && $_GET['kodekantor'] != ""){
		$kodekantor = $_GET['kodekantor'];
		$kdkantor = $_GET['kodekantor'];
		$kodekantor = " AND KODE_KANTOR = '".$kodekantor."'";
	}
	
	$sqlseries = "select to_char(DATESERIES,'dd-mm') DATESERIES from VIEW_DATESERIES 
		WHERE 1=1 $rangetgl
	";
	
	
	//echo $sqlseries;
	$DB->parse($sqlseries);
	$DB->execute();
	while($result = $DB->nextrow()) {
			$value['tgl'][] = $result;
			
	};
	unset ($value['tgl'][count($value['tgl'])-1]);
	//var_dump($value['tgl']);exit;
	
	$sqlcabang = " select distinct kode_kantor from view_400_agen_absen_dateseries order by kode_kantor ";
	$DB->parse($sqlcabang);
	$DB->execute();
	while($result = $DB->nextrow()) {
			$value['kodekantor'][] = $result;
	};
	
	$sqlagendata = "
		select DISTINCT NOMOR_AGEN,NAMA_AGEN,KODE_KANTOR from view_400_agen_absen_dateseries
		where 1=1 $kodekantor
		order by kode_kantor,nomor_agen
	";
	$DB->parse($sqlagendata);
	$DB->execute();
	while($result = $DB->nextrow()) {
			$value['agen'][] = $result;
	};
	
	$sql = "

		  SELECT /*+ parallel(4)*/
				tt.nomor_agen,
				 tt.nama_agen,
				 tt.kode_kantor,
				 tt.jam_kehadiran,
				 TO_CHAR(SS.DATESERIES,'DD-MM-YYYY') TANGGAL,
				 substr(tt.jam_masuk,0,5) jam_masuk,
				 substr(tt.jam_keluar,0,5) jam_keluar
			FROM VIEW_DATESERIES ss
				 LEFT JOIN (SELECT /*+ parallel(4)*/
										  a.nomor_agen,
										   (SELECT /*+ parallel(4)*/ 
												namaklien1
											  FROM tabel_100_klien
											 WHERE noklien = a.nomor_agen)
											  nama_agen,
										   (SELECT /*+ parallel(4)*/
												  prefixagen
											  FROM tabel_400_agen df
											 WHERE DF.NOAGEN = a.nomor_agen)
											  kode_kantor,
										   a.tanggal,
										   a.jam_masuk,
										   a.jam_keluar,
										   a.jam_kehadiran
									  FROM view_400_agen_absen a)  tt
					ON TT.TANGGAL = SS.DATESERIES
					WHERE 1=1
					$rangetgl
					$kodekantor
		ORDER BY dateseries ASC, kode_kantor, jam_masuk
	";
	
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();

		while($result = $DB->nextrow()) {
			$value['detail'][] = $result;
		};
	
		
		//var_dump($value['detail']);
	?>
<body style="margin:40px;" ><br /><br />
REKAP ABSENSI AGEN<hr /><br />
	<table style="max-width:800px;  font-family:tahoma; font-size:0.7em;  border:solid navy 1px;background:#FAFAFF; border-spacing: 2px;
    border-collapse: separate;"  cellpadding="2" width="100%" cellspacing="0" style="border-collapse: collapse"
	bordercolor="#C0C0C0" id="AutoNumber1">
	<form action=<?=$_SERVER["PHP_SELF"]?>><tr><td colspan=8>Pilih Cabang: 
		<select id="kdkantor" name="kodekantor"><option value="">--ALL--</option>
			<?
				$selected = "";
				foreach ($value['kodekantor'] as $kode=>$kantor){
				if($kdkantor==$kantor['KODE_KANTOR']) {$selected = "selected=selected";}else{$selected = "";};
					echo '<option '.$selected.' value='.$kantor['KODE_KANTOR'].'>'.$kantor['KODE_KANTOR'].'</option>';
				}
			
			if($_GET['tglmulai'] != ('01-'.date('m-Y'))){
				$tgm = $_GET['tglmulai'];
			}
			?>
		</select></td>
		</tr>
		<tr><td colspan=10>Tanggal: <input id="tglmulai" name="tglmulai" type="text" value="<?=$tgm?>"></input> sampai:
		<input id="tglselesai" name="tglselesai" type="text" value="<?=date('d-m-Y')?>"></input> <input type="submit" value="SUBMIT"/></td>
		<td><input type="button" id="saveExcel" value="EXPORT EXCEL"/></td></tr>
	</form>
	</table>
	<?
	//echo substr($_GET['tglselesai'],6);
	?>
	<div >
	<table id="exportContent" style="max-width:800px;  font-family:tahoma; font-size:0.7em;  border:solid navy 1px;background:#FAFAFF; border-spacing: 2px;
    border-collapse: separate;"  cellpadding="2" width="100%" cellspacing="0" style="border-collapse: collapse"
	bordercolor="#C0C0C0" id="AutoNumber1">
	<tr bgcolor="#aafaff"><td rowspan=2 bgcolor="#afafdd" align="center">No.</td><td  bgcolor="#afafdd"rowspan=2 align="center">Kantor</td>
	<td rowspan=2  bgcolor="#afafdd"align="center">NOMOR AGEN</td><td  bgcolor="#afafdd" rowspan=2 align="center">Nama</td>
	<td align="center"  bgcolor="#afafdd" colspan=<?=count($value['tgl'])?>>TANGGAL</td></tr>
	<tr bgcolor="#aafaff" >
		<? $mtgl = '';
		$ltgl = $value['tgl'];
		if (count($ltgl) > 0)
			foreach($ltgl as $dtgl=>$val){
				echo '<td bgcolor="#9a9add" width="80px" align="center">'.$val['DATESERIES'].'</td>';
				$mtgl[] = $val['DATESERIES'];
			}
		?>
	</tr>
	<?
		$warna = 1; $fff = "";
		if (count($value['agen']) > 0)
		
		foreach ($value['agen'] as $val=>$vl){
			if($warna % 2) $warnabg = "#AAFFAA";
				?>
					<tr  style="border:solid navy 1px;height:30px;" bgcolor="<?=$warnabg?>">
						<td bgcolor="<?=$warnabg?>"><?=$warna.'.'?></td>
						<td bgcolor="<?=$warnabg?>"><?=$vl['KODE_KANTOR']?></td>
						<td bgcolor="<?=$warnabg?>"><?="'".$vl['NOMOR_AGEN']?></td>
						<td bgcolor="<?=$warnabg?>"><?=$vl['NAMA_AGEN']?></td>
						<?
						for($i=0;$i<=count($mtgl)-1;$i++){
							$ada = false;
							if (count($value['detail']) > 0)
							
							foreach($value['detail'] as $detail => $det){

								$jamkluar = "";
								$tg = "";

								if($det['KODE_KANTOR']==$vl['KODE_KANTOR'] && $det['NOMOR_AGEN'] == $vl['NOMOR_AGEN'])
								{

									if($det['JAM_KELUAR']!=""){
										$jamkluar = ''.$det['JAM_KELUAR'];
									}

									if((string)$det['TANGGAL'] == $mtgl[$i].'-'.substr($_GET['tglselesai'],6)){
									
										$str =  '<td align=center  style="min-width:60px; color:white;" bgcolor="#339933"><span class="jamText hasTip-'.$vl['KODE_KANTOR'].$vl['NOMOR_AGEN'].$det['TANGGAL'].'">'.$det['JAM_MASUK'].'</span></td>';//$jamkluar.
										$fff = '
											$(".hasTip-' . $vl['KODE_KANTOR'] . $vl['NOMOR_AGEN'] . $det['TANGGAL'].'").qtip({
													content: {
														text: "<span class=tipText >JAM MASUK:'.$det['JAM_MASUK']
														.' <br /> JAM KELUAR:'.$jamkluar
														.' <br /> JAM KEHADIRAN:'.$det['JAM_KEHADIRAN']
														.'</a>"
													}
												})
											' . $fff ;
										$ada = true;
									}
								}
							}
							if (!$ada  ){
									echo '<td style="color:white;min-width:60px;" align="center" bgcolor="#ccFFcc"  >'.'</td>';//substr($mtgl[$i],0,2)
									 
							} else {
								
								echo $str;
							}
						}
						?>
					</tr>
				<?
			$warna++;
		}
	?>
	
	<script>
	$(document).ready(function() {
			$("#saveExcel").click(function(e) {
			$("#exportContent").table2excel({
					exclude: ".noExl",
					name: "ReportAbsenAgen-" + $('#kdkantor').val() + $('#tglmulai').val()+$('#tglselesai').val()+''
					}); 
			});
			<? 
			unset($value);
			echo $fff; 
			?>
	});
	</script>
	</table>
	</div>
	</body>