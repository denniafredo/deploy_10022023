<?
include "../includes/config.php";
include "../includes/connectdb.php";

$nikkadiv = $_GET['nikkadiv'];

//echo $nikkadiv;exit;

header('Connection: close');

$sqlcheck = "	select * from quiz_answer
		where quizId = 2 
		and responderSID = $nikkadiv
		and entryDate = '".date('Ymd')."' ";

//echo $sqlcheck;exit;
$res = mssql_query($sqlcheck);
$imt = mssql_num_rows($res);
;
if($imt > 0){
	echo 'Sudah menyelesaikan quiz hari ini.';exit;
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Jiwasraya Survei & Quiz</title>
<style>
</style>
<link href="http://192.168.4.22/quiz/styles/demo_style.css" rel="stylesheet" type="text/css">

<link href="http://192.168.4.22/quiz/styles/smart_wizard.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://192.168.4.22/quiz/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="http://192.168.4.22/quiz/js/jquery.smartWizard.js"></script>
<script type="text/javascript" src="http://192.168.4.22/quiz/js/jquery.popupoverlay.js"></script>
		
<script type="text/javascript">
var downloadButton = document.getElementById("download");
var counter = 30;

var id;
	function subDaily(){
		$( "form" ).submit(function( event ) {
		  //alert( "Handler for .submit() called." );
		  //event.preventDefault();
		});
	}
	
id = setInterval(function() {
    counter--;
    if(counter < 0) {
        
        clearInterval(id);
		var conf = confirm('Waktu Anda habis!');
	
		if(conf){
					$( "form" ).submit();
		};
    } else {
        $('#countdown').html('<b>' + counter.toString() + '</b>');
    }
}, 1000);

    $(document).ready(function() {

      // Initialize the plugin
     // $('#whole').popup();

    });
</script>

</head>
<body id="whole">
<form method="post" id="subquiz" action="http://192.168.4.22/quiz/takeQuizFinish.php?type=daily">
<b>Quiz harian Anda</b><hr />
<?
	$sqlminmax = "	select min(questionId) bawah, max(questionId) atas
			from dbo.quiz_question_bank
			where quizId = 2 ";
	
	
	$res = mssql_query($sqlminmax);
	while($row = mssql_fetch_array($res))
	{
		$min = $row["bawah"];
		$max = $row["atas"];
	}
	
	$qid = mt_rand($min,$max);

	$sql_s = " select * from quiz_question_bank where quizId = 2  and questionId = $qid " ;
	
	$res = mssql_query($sql_s);
	
	$arr_question = "";
	
	$x = 1;
	while($row = mssql_fetch_array($res))
	{
		$arr_question[] = array(
			'id' => $row["questionId"]
			,'questionType' => $row["questionType"]
			,'question' => $row["question"]
			,'numAnswer' => $row["numAnswer"]
			,'defaultChoice' => $row["defaultChoice"]
			,'choice' => explode('||',$row["answerChoice"])
		);
		if($x==$questionsPerpage){
			$page ++;
			$x = 1;
		} else { $x++; }

	}
	
$wq = $arr_question[0];
//var_dump($wq);
//questionType
echo $wq['question']. '<br />';
$selected = "";
		for($k=0;$k<$wq['numAnswer'];$k++){
			$l=0;
			if($wq['questionType'] == 'MULTIPLE CHOICE'){
			$l = $k+1;

			if($l==$wq['defaultChoice']){
			$selected = "CHECKED=CHECKED";
			}
				echo '<input type="radio" '.$selected.' id="qid-'.$wq['id'].'-c'.$l.'" name="multiple-qid-'.$wq['id'].'" value="c'.$l.'">';
				echo '<label for="qid-'.$wq['id'].'-c'.$l.'">';
				echo $wq['choice'][$k].'</label></input><br />';
				
			} else if($wq['questionType'] == 'ESSAY'){
			$l = $k+1;
				echo '<textarea class="text_area" cols="48" rows="2" id="qid-'.$wq['id'].'-c'.$l.'" name="essay-qid-'.$wq['id'].'-c'.$l.'"></textarea>';
			}
		}
							?>
							<input type="hidden" name="SID" value="<?=$nikkadiv?>">
							<input type="hidden" name="quizId" value="2">
							<br /><br /><div style="float:right;position:relative;top:-5px;"><input type="submit" value="KIRIM JAWABAN" /></div></form>
<hr />Sisa waktu untuk menjawab <span id="countdown">30</span> detik.
</body>
</html>
