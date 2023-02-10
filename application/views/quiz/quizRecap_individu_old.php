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

?>

<?
//show table
if(is_array($questionBankArray) && count($questionBankArray) >0)
{
?>
<h2>REKAP QUISIONER SDM</h2-->
<!--Jumlah Responden = <b style="font-size:1.4em;"><?=$jml_responder?></b-->

<br />

<table border=0 class="CSSTableGenerator" style="border:solid black 1px;font-family:arial;font-size:.8em;">
<tr>
	<th rowspan=2>Faktor</th>	
	<th rowspan=2>Aspek</th>	
	<th rowspan=2>Pertanyaan</th>	
	<th colspan=<?=count(array_keys($mapAnswer))?>>Jawaban</th>	
	<th rowspan=2>Persentase (%)</th>
	<th rowspan=2>Norma</th>
</tr>
<tr>
<?
	foreach($mapAnswer as $mapp){
		echo '<th>'.$mapp.'</th>';
	}
?>
</tr>

<?


//var_dump($arrCountPerQid);
//var_dump($arrCounter);

foreach ($aspekMap as $masterAspek => $aspektext){
	$totPerAspekArray = null;

	foreach($questionBankArray as $arrQues){
		if($masterAspek == substr($arrQues['customAppgroup'],0,1)){ 
			echo '<tr>';
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
			
			echo '</tr>';
		
		}
	}
	
		if($aspektext == 'Kepuasan Karyawan'){
					$sssql = "   select * from dbo.quiz_answer where responderSID = '".$sssid."' and questionId in (41,42) ";
				$resfr = mssql_query($sssql);
				$ii = 41;
			while($row = mssql_fetch_array($resfr))
			{
				echo '<tr bgcolor="#fafaca">';
					echo '<td >';
					echo 'Essay ';
					echo '</td>';		
					echo '<td colspan=8>';
					echo $row['c1'].'<br>';
					echo '</td>';
				echo '</tr>';
				$ii++;
			}
		}

		
		

	
	
	echo '<tr>';
	echo '<td colspan=2 style="background-color:pink;">Total</td>';
		echo '<td colspan=1 style="background-color:pink;">';
		echo '<b style="font-size:.8em;">'.strtoupper($aspektext).'</b>';
		echo '</td>';
		
		foreach($totPerAspekArray as $mm => $vv){
			echo '<td align="center" style="font-weight:bolder;background-color:pink;">'.$vv.'</td>';
		}
		echo '<td style="font-weight:bolder;background-color:pink;">'.$avgPerAspek[$masterAspek].'</td>';
				
		$tc = $avgPerAspek[$masterAspek];
		
		if ($masterAspek == 'A') {
			echo '<td style="font-weight:bolder;background-color:pink;">';
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
			echo '<td style="font-weight:bolder;background-color:pink;">';
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

echo '<tr>';

	$cstr = '';
	foreach($avgPerAspek as $dd => $ee){
		//$cstr .= $dd . "=" . $ee . '<br />';
		$cstr .= 'Tingkat '. $aspekMap[$dd] ." = " . $ee . '<br />' ;
	}
	echo '<td colspan = "9" >';
		echo '<b> ' . $cstr.'</b>';
	echo '</td>';
echo '</tr>'
?>
</table>
<?
}//show table
?>
