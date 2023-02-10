<?
include "../includes/config.php";
include "../includes/connectdb.php";
header('Connection: close');

$sssid = "";

if(isset($_GET['sid']) && $_GET['sid'] != ''){
	$sssid = $_GET['sid'];
}

$keySid =null;
$sql = " SELECT distinct responderSID from quiz_answer where questionId != 0 
	and responderSID = '$sssid'
";
$res = mssql_query($sql);
		while($row = mssql_fetch_array($res))
		{
			if( preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i'
				,$row['responderSID'])  ){
				$keySid[] = $row['responderSID'];
			}
		}

$jml_responder = count($keySid);
//var_dump($keySid);
$ansArray = null;
if(is_array($keySid) && count($keySid) > 0){
	foreach($keySid as $key){
		$sql = " SELECT questionId,quizId,c1,c2,c3,c4
					from quiz_answer 
				where responderSID = '".trim($key)."'";

		$res = mssql_query($sql);
		 $i = 0;
		while($row = mssql_fetch_array($res))
		{
			$ansArray[$key][$i]['questionId'] = $row['questionId'];
			$ansArray[$key][$i]['quizId'] = $row['quizId'];
			$ansArray[$key][$i]['C1'] = $row['c1'];
			$ansArray[$key][$i]['C2'] = $row['c2'];
			$ansArray[$key][$i]['C3'] = $row['c3'];
			$ansArray[$key][$i]['C4'] = $row['c4'];
		 $i++;
		}
	}
	
	//echo json_encode($ansArray);
	//map answer

}

function max_val($arr){
	$ctemp = 0;
	foreach($arr as $k=>$v)
	{
		if( $v >= $ctemp) {
			$ctemp = $v;
			$found_item = $v;
		};
	}
	return $found_item;
}
$sql = " select distinct customAppgroup from quiz_question_bank where customAppgroup is not null and quizId = 1";
		$res = mssql_query($sql);
		while($row = mssql_fetch_array($res))
		{
			$questionGroup[] = $row['customAppgroup'];
		}
		
$groupAndQuestionIdArray = null;
//echo json_encode($questionGroup);
$sql = " select 
		 quizId
		 ,questionId
		 ,questionType
		 ,question
		 ,numAnswer
		 ,answerChoice
		 ,customAppgroup
		 from dbo.quiz_question_bank where quizId = 1 and questionType = 'MULTIPLE CHOICE' 
		 order by customAppgroup
 ";
 
		$res = mssql_query($sql);
		$i = 0;
		while($row = mssql_fetch_array($res))
		{
			$questionBankArray[$i]['quizId'] = $row['quizId'];
			$questionBankArray[$i]['questionId'] = $row['questionId'];
			$questionBankArray[$i]['questionType'] = $row['questionType'];
			$questionBankArray[$i]['question'] = $row['question'];
			$questionBankArray[$i]['numAnswer'] = $row['numAnswer'];
			$questionBankArray[$i]['answerChoice'] = $row['answerChoice'];
			$questionBankArray[$i]['customAppgroup'] = strtoupper($row['customAppgroup']);
			$groupAndQuestionIdArray[strtoupper($row['customAppgroup'])][$i] = $row['questionId'];
		$i++;
		}
//echo json_encode($questionBankArray);

//Sangat Tidak Setuju||Tidak Setuju||Setuju||Sangat Setuju
$arrAnswerOpt = null;
$sql = " SELECT distinct  CONVERT(VARCHAR(512), answerChoice) ANSWERCHOICE   
	from quiz_question_bank where quizId = 1 and questionType = 'MULTIPLE CHOICE' ";
	
$res = mssql_query($sql);
	while($row = mssql_fetch_array($res))
	{
		$arrAnswerOpt = explode('||',$row['ANSWERCHOICE']);
	}

	$i = 1;
	foreach($arrAnswerOpt as $ansString){
		$mapAnswer['C'.$i] = $ansString;
	$i++;
	}
	
	$mapBobot = null;
	
	$i = 0;
	$k = 1;
	foreach($arrAnswerOpt as $ansString){
		$mapBobot['C'.$k] += $i;
	 $i++;
	 $k++;
	}
	
//var_dump($mapAnswer);
$aspekMap = array(
	'A'=>'Keterikatan Karyawan'
	,'B'=>'Kepuasan Karyawan'
);

$aspekMapDetil = array(
	'A1' => 'Jenjang Karir',
	'A2' => 'Job Desc Jelas',
	'A3' => 'Kepemimpinan',
	'A4' => 'Budaya Kerja',
	'A5' => 'JHT',
	'B1' => 'Gaji/Penghasilan',
	'B2' => 'Kesejahteraan',
	'B3' => 'Pelatihan',
	'B4' => 'Fasilitas Kerja',
	'B5' => 'Interaktif Sosial'
);

$arrCounter = null;
foreach(array_keys($mapAnswer) as $ke){
	$arrCounter[$ke] = 0; //..ini total keseluruhan
}

$arrCountPerQid = null;
foreach(array_keys($mapAnswer) as $ke){
	$arrCountPerQid[$ke] = 0;
}

if(is_array($ansArray) && count($ansArray) > 0)
foreach($ansArray as $ansCounter => $anss){
	$i = 1;
	foreach($anss as $ans => $vals){
		foreach(array_keys($arrCounter) as $kye){
			if($vals[$kye]=='1'){
				$arrCounter[$kye]++;
				$arrCountPerQid[$i][$kye]++;
			};
		}
	 $i++;
	}
}

//mencari t.jawaban x bobot berdasar g
$groupArray = null;

$groupOfAnswerWithBobot = null;
$groupOfAnswerSUM = null;
$groupOfAnswerPercent = null;

foreach(array_keys($aspekMap) as $aspek){ //A .. . B
	foreach(array_keys($aspekMapDetil) as $rr ){
		$rrr = substr($rr,0,1);
		$sss = substr($rr,1,1);
		if( $rrr == $aspek){
			foreach($groupAndQuestionIdArray[$aspek.$sss] as $qidd){
			$bobotxanswer = 0;
			$groupOfAnswerSUM[$aspek.$sss][$qidd] = 0;
				foreach( $mapBobot as $kbobot => $bobot ){
					$ct = $arrCountPerQid[$qidd][$kbobot];
					$bobotxanswer = (int)$bobot * (int)$ct;
					$groupOfAnswerWithBobot[$aspek.$sss][$qidd][$kbobot] = $bobotxanswer;
					$groupOfAnswerSUM[$aspek.$sss][$qidd] += $bobotxanswer;
				}
			}
		}
	}
} 

$max_bobot = max_val($mapBobot);

$jumlahQidDlmAspek = null;
$sumPercent = null;


foreach($groupOfAnswerSUM as $sumgroup => $sums){
	try{
		foreach($sums as $qid => $vl){
			$percent = @round( (($vl / ($max_bobot * $jml_responder) ) * 100 ),2) ;
			$groupOfAnswerPercent[$sumgroup][$qid] = $percent;
			
			foreach( $aspekMap as $aspek => $vl){
				if($aspek == substr($sumgroup,0,1) ){
					$sumPercent[$aspek] += $percent;
					$jumlahQidDlmAspek[$aspek] ++;
				}
			}
		}
	} catch (Exception $e){
		
	}

}

$avgPerAspek = null;
foreach($sumPercent as $gg => $hh){
	$avgPerAspek[$gg] = round( ($sumPercent[$gg]/( $jumlahQidDlmAspek[$gg] * 100 )) * 100,2);
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Jiwasraya Survei & Quiz REKAP</title>
<link href="styles/demo_style.css" rel="stylesheet" type="text/css">
<link href="styles/smart_wizard.css" rel="stylesheet" type="text/css">

<style>



.ct1 {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #00007f;
	
	-moz-border-radius-bottomleft:2px;
	-webkit-border-bottom-left-radius:2px;
	border-bottom-left-radius:2px;
	
	-moz-border-radius-bottomright:2px;
	-webkit-border-bottom-right-radius:2px;
	border-bottom-right-radius:2px;
	
	-moz-border-radius-topright:2px;
	-webkit-border-top-right-radius:2px;
	border-top-right-radius:2px;
	
	-moz-border-radius-topleft:2px;
	-webkit-border-top-left-radius:2px;
	border-top-left-radius:2px;
}.ct1 table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.ct1 tr:last-child td:last-child {
	-moz-border-radius-bottomright:2px;
	-webkit-border-bottom-right-radius:2px;
	border-bottom-right-radius:2px;
}
.ct1 table tr:first-child td:first-child {
	-moz-border-radius-topleft:2px;
	-webkit-border-top-left-radius:2px;
	border-top-left-radius:2px;
}
.ct1 table tr:first-child td:last-child {
	-moz-border-radius-topright:2px;
	-webkit-border-top-right-radius:2px;
	border-top-right-radius:2px;
}.ct1 tr:last-child td:first-child{
	-moz-border-radius-bottomleft:2px;
	-webkit-border-bottom-left-radius:2px;
	border-bottom-left-radius:2px;
}.ct1 tr:hover td{
	background-color:#d3e9ff;
		

}
.ct1 td{
	vertical-align:middle;
	
	background-color:#aad4ff;

	border:1px solid #00007f;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:8px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.ct1 tr:last-child td{
	border-width:0px 1px 0px 0px;
}.ct1 tr td:last-child{
	border-width:0px 0px 1px 0px;
}.ct1 tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.ct1 tr:first-child td{
		background:-o-linear-gradient(bottom, #0057af 5%, #0057af 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0057af), color-stop(1, #0057af) );
	background:-moz-linear-gradient( center top, #0057af 5%, #0057af 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#0057af", endColorstr="#0057af");	background: -o-linear-gradient(top,#0057af,0057af);

	background-color:#0057af;
	border:0px solid #00007f;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.ct1 tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #0057af 5%, #0057af 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0057af), color-stop(1, #0057af) );
	background:-moz-linear-gradient( center top, #0057af 5%, #0057af 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#0057af", endColorstr="#0057af");	background: -o-linear-gradient(top,#0057af,0057af);

	background-color:#0057af;
}
.ct1 tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.ct1 tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}





.CSSTableGenerator {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#aad4ff; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:right;
	padding:7px;
	font-size:15px;
	font-family:Verdana;
	font-weight:normal;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #003f7f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#003f7f");	background: -o-linear-gradient(top,#005fbf,003f7f);

	background-color:#005fbf;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:17px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #003f7f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#003f7f");	background: -o-linear-gradient(top,#005fbf,003f7f);

	background-color:#005fbf;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>

<script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="js/jquery.smartWizard.js"></script>

</head-->

<!--body>


<?
//show table
if(is_array($questionBankArray) && count($questionBankArray) >0)
{
?>
<h2>REKAP QUISIONER SDM</h2-->
<!--Jumlah Responden = <b style="font-size:1.4em;"><?=$jml_responder?></b-->
<!--b style="font-size:1em;">RESPONDEN SID: <?=$sssid?></b-->
<!--table class="ct1" style="border:solid black 1px;display:none;width:788px;">
<tr>
	<th>Skor</th><th>Nilai</th>
</tr>
<tr>
	<td><=25%</td><td>sangat buruk</td>
</tr>
<tr>
	<td>>25-50%</td><td>buruk</td>
</tr>
<tr>
	<td>>50-75%</td><td>baik</td>
</tr>
<tr>
<td>>75%</td><td>sangat baik</td>
</tr>
</table-->
<!--table border=0 class="CSSTableGenerator" style="border:solid black 1px;font-family:arial;font-size:.8em;"-->
<!--tr>
	<th rowspan=2>Faktor</th>	
	<th rowspan=2>Aspek</th>	
	<th rowspan=2>Pertanyaan</th>	
	<th colspan=<?=count(array_keys($mapAnswer))?>>Jawaban</th>	
	<th rowspan=2>Persentase (%)</th>
	<th rowspan=2>Norma</th>
</tr-->
<!--tr>
<?
	foreach($mapAnswer as $mapp){
		echo '<th>'.$mapp.'</th>';
	}
?>
</tr-->

<?


//var_dump($arrCountPerQid);
//var_dump($arrCounter);

foreach ($aspekMap as $masterAspek => $aspektext){
	$totPerAspekArray = null;

	foreach($questionBankArray as $arrQues){
		if($masterAspek == substr($arrQues['customAppgroup'],0,1)){ 
			echo '<!--tr>';
			echo '<td style="text-align:left;">'.$aspekMap[substr($arrQues['customAppgroup'],0,1)] .'</td>';
			echo '<td style="text-align:left;">'.$aspekMapDetil[$arrQues['customAppgroup']] .'</td>'; //substr($arrQues['customAppgroup'],1,1) .'-'.
			echo '<td style="text-align:left;">'.$arrQues['question'].'</td>';//$arrQues['questionId'].'-'.

			foreach($mapAnswer as $mapp => $val){
				$x1 = (int)$arrCountPerQid[$arrQues['questionId']][$mapp];
				$totPerAspekArray[$mapp] +=	$x1;
				echo '<td align="center">'.$x1.'</td>';
			}
			echo '<td>';
				echo $groupOfAnswerPercent[$arrQues['customAppgroup']][$arrQues['questionId']];
			echo '</td>';			
			
				$tc = $groupOfAnswerPercent[$arrQues['customAppgroup']][$arrQues['questionId']];
			
				if (substr($arrQues['customAppgroup'],0,1) == 'A') {
					echo '<td>';
					if($tc > 75){
						echo 'SANGAT ENGAGE';
					} else if($tc > 50 && $tc <= 75){
						echo 'ENGAGE';
					} else if($tc <= 50 && $tc > 25){
						echo 'TIDAK ENGAGE';
					} else if($tc <= 25 ){
						echo 'SANGAT TIDAK ENGAGE';
					}
					echo '</td>';
				}
				else if (substr($arrQues['customAppgroup'],0,1) == 'B') {
					echo '<td>';
					if($tc > 75){
						echo 'SANGAT PUAS';
					} else if($tc > 50 && $tc <= 75){
						echo 'PUAS';
					} else if($tc <= 50 && $tc > 25){
						echo 'TIDAK PUAS';
					} else if($tc <= 25 ){
						echo 'SANGAT TIDAK PUAS';
					}
					echo '</td>';
				}
			
			echo '</tr-->';
		
		}
	}
	
	echo '<tr>';
	echo '<td colspan=2 style="background-color:white;">'.$sssid.'</td>';
		echo '<td colspan=1 style="background-color:white;">';
		echo '<b style="font-size:.8em;">'.strtoupper($aspektext).'</b>';
		echo '</td>';
		
		foreach($totPerAspekArray as $mm => $vv){
			echo '<td align="center" style="font-weight:bolder;background-color:white;">'.$vv.'</td>';
		}
		echo '<td style="font-weight:bolder;background-color:white;">'.$avgPerAspek[$masterAspek].'</td>';
				
		$tc = $avgPerAspek[$masterAspek];
		
		if ($masterAspek == 'A') {
			echo '<td style="font-weight:bolder;background-color:white;">';
			if($tc > 75){
				echo 'SANGAT ENGAGE';
			} else if($tc > 50 && $tc <= 75){
				echo 'ENGAGE';
			} else if($tc <= 50 && $tc > 25){
				echo 'TIDAK ENGAGE';
			} else if($tc <= 25 ){
				echo 'SANGAT TIDAK ENGAGE';
			}

			echo '</td>';
		}
		else if ($masterAspek == 'B') {
			echo '<td style="font-weight:bolder;background-color:white;">';
			if($tc > 75){
				echo 'SANGAT PUAS';
			} else if($tc > 50 && $tc <= 75){
				echo 'PUAS';
			} else if($tc <= 50 && $tc > 25){
				echo 'TIDAK PUAS';
			} else if($tc <= 25 ){
				echo 'SANGAT TIDAK PUAS';
			}

			echo '</td>';
		}
		
	echo '</tr>';

}

echo '<!--tr>';
	echo '<th colspan = "3" align="center">TOTAL KESELURUHAN</th>';
	foreach(array_keys($mapAnswer) as $ke){
		echo '<td align="center"><b>' . $arrCounter[$ke] . '</b></td>';
	}
	echo '<td>';
	echo '</td>';
	echo '<td>';
	echo '</td>';

echo '</tr-->';

echo '<!--tr>';

	$cstr = '';
	foreach($avgPerAspek as $dd => $ee){
		//$cstr .= $dd . "=" . $ee . '<br />';
		$cstr .= 'Tingkat '. $aspekMap[$dd] ." = " . $ee . '<br />' ;
	}
	echo '<td colspan = "9" >';
		echo '<b> ' . $cstr.'</b>';
	echo '</td>';
echo '</tr-->'
?>
<!--/table-->
<?
}//show table
?>


<!--/body>

</html-->