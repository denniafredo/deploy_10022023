<?
$qid = 0;
if(isset($_GET['qid'])){
	$qid = $_GET['qid'];
}else{
	$qid = 1;
}
$from = date('Y-m-d', strtotime("-1 months"));
$to = date('Y-m-d');

$qdate = " and 1=1  ";
if(isset($_GET['from']) && isset($_GET['to'])){
	$from = $_GET['from'];
	$to = $_GET['to'];
	$qid =  $_GET['qid'];
	$qdate = " and entrydate between to_date('$from','yyyy-mm-dd') and to_date('$to','yyyy-mm-dd') ";
}else{
	$qdate = " and entrydate between  add_months(sysdate,-1)  and  sysdate";
}
?>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://dev.jiwasraya.co.id/jaim/js/jquery-1.11.3.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.js"></script>
 <head>
 <script>
 var $qid = <?=$qid?>;
$(document).ready(function(){
	$('#qid').on('change',function(){
		$ib = this;
		$qid = $ib;
		console.log($($ib).val());
		window.location.href = "http://dev.jiwasraya.co.id/jaim/agen-cpd.php?qid="+$($ib).val();
		
	})
	
	$('#from').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-360d'
    ,autoclose: true
});
	$('#to').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-360d'
	,autoclose: true
});
	
	$('#go').on('click',function(){
		console.log($('#from').val())
		console.log($('#to').val())
		window.location.href = "http://dev.jiwasraya.co.id/jaim/agen-cpd.php?qid="+$qid+'&from='+$('#from').val()+'&to='+$('#to').val();
	});
	
	
	$('#quizname').html($('#qid option:selected').text());
	
	
})
</script>
 </head>
 <body>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top}
.tg .tg-yw4l{vertical-align:top;font-weight:bolder;}
body{
	font-family:verdana;
}
</style>
<?php
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	$DBS = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	$sqCID = "select distinct QUIZID,QUIZNAME from JAIM_000_QUIZ@JAIM where enabled = 1 order by QUIZID";
	$DBS->parse($sqCID);
	$DBS->execute();
	
	
	echo 'Pilih Report: <select name="qid" id="qid">';
	$rows = null;
	echo '<option value="0">-- pilih --</option>';

	$sel = "";
	while($rows = $DBS->nextrow()) {
		if($rows['QUIZID'] == $qid) {$sel = "selected='selected'";} else {$sel  = "";} 
		echo '<option '.$sel.' value="'.$rows['QUIZID'].'">'.$rows['QUIZNAME'].'</option>';
	};
	echo '</select>';

	$sql = "   select distinct 
			(select prefixagen from TABEL_400_agen fee where fee.noagen = fgf.RESPONDERID) kdktr
			,responderid,(
				select namaklien1 from TABEL_100_KLIEN fe where fe.noklien = FGF.RESPONDERID 
			) nama ,(select nolisensiagen from TABEL_400_agen fee where fee.noagen = fgf.RESPONDERID) nolisensi
			,(select tglmulailisensi from TABEL_400_agen fee where fee.noagen = fgf.RESPONDERID) tglmulailisensi
			,(select tglakhirlisensi from TABEL_400_agen fee where fee.noagen = fgf.RESPONDERID) tglakhirlisensi
			, (case when (select tglakhirlisensi from TABEL_400_agen fee where fee.noagen = fgf.RESPONDERID) < sysdate 
			then 'EXPIRED' 
			else
				'OK'
			END) statuslisensi
			
			,defaultanswer,entrydate,tries from JAIM_000_QUIZ_ANSWER@JAIM fgf
			where questionid = 0
			and quizid = $qid
			$qdate 
			order by entrydate desc 
		";
	//echo $sql;exit;
	$DB->parse($sql);
	$DB->execute();
	
	$rows = null;
	while($result = $DB->nextrow()) {
		$rows[] = $result;
	};
	?><br />
<br />
	<b>LAPORAN HASIL TEST <br /><span id="quizname"></span></b>
<br />
<br />Tanggal: <br>dari <input type="text" id="from" value="<?=$from?>"> sampai <input type="text" id="to"  value="<?=$to?>">

<input type="button" id="go" value="GO">
<br />
<br />
<br />

	<?
			echo '		<table class="tg">
		  <tr>
			<th class="tg-yw4l">KANTOR</th>
			<th class="tg-yw4l">IDAGEN</th>
			
			<th class="tg-yw4l">NAMA</th>
			<th class="tg-yw4l">NOLISENSI</th>
			<th class="tg-yw4l">TGL AKHIR LISENSI</th>
			<th class="tg-yw4l">STATUS LISENSI</th>
			<th class="tg-yw4l">REASON</th>
			<th class="tg-yw4l">CORRECT</th>
			<th class="tg-yw4l">WRONG</th>
			<th class="tg-yw4l">SKOR</th>
			<th class="tg-yw4l">TGL  QUIZ</th>
		  </tr>';
		  if(count($rows) > 0)
	foreach($rows as $idx=>$row){
			$js = json_decode($row['DEFAULTANSWER']);
			
			$js->status?$js->status=TRUE:$js->status=FALSE;
			
			$col = null;$js->status?$col='navy':$col='red';
		?>

		  <tr >
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$row['KDKTR']?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$row['RESPONDERID']?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$row['NAMA']?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$row['NOLISENSI']?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$row['TGLAKHIRLISENSI']?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$row['STATUSLISENSI']?> </td>
			
			<!--td class="tg-rmb8" style="color:<?=$col?>;"><?=$js->status?></td-->
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$js->reason?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$js->correct?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$js->wrong?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=number_format($js->score,2)?></td>
			<td class="tg-rmb8" style="color:<?=$col?>;"><?=$row['ENTRYDATE']?></td>
		  </tr>

		<?
		
	}
	echo '		</table>';
	exit;
?>
</body>



