<?
include "../includes/config.php";
include "../includes/connectdb.php";
header('Connection: close');

$sssid = "";


$keySid =null;
$sql = " SELECT distinct responderSID from quiz_answer where questionId != 0 
	
";
$res = mssql_query($sql);
		while($row = mssql_fetch_array($res))
		{
			if( preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i'
				,$row['responderSID'])  ){
				$keySid[] = $row['responderSID'];
			}
		}
//var_dump($keySid);
$jml_responder = count($keySid);

?>
<body style="font-family:arial;font-size:.8em;">
<h1>REKAP PER INDIVIDU RESPONDEN</h1>
<h3>Jumlah responden: <?=$jml_responder?></h3>
<?

$ansArray = null;
if(is_array($keySid) && count($keySid) > 0){
$i = 1;
/* echo '<table style="border:solid black 1px;font-family:arial;font-size:.8em;">'
 .'<tr>'
 .'<th>SID</th>'
 .'<th></th>'
 .'<th>FAKTOR</th>'
 .'<th width="24px">STS</th>'
 .'<th width="24px">TS</th>'
 .'<th width="24px">S</th>'
 .'<th width="24px">SS</th>'
 .'<th width="24px" >Total. %</th>'
. '</tr>';
 */
	foreach($keySid as $key){
		$f = file_get_contents('http://192.168.4.22/quiz/quizRecap_individu_old.php?sid='.$key);
		//echo $i.'. ';
		
		echo $f;
		
		//echo '<br /><br />';
	$i++;
	}
	//echo '</table>';
	
	//echo json_encode($ansArray);
	//map answer

}

?>
</body>