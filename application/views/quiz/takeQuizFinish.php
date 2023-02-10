<?
echo "Quisoner telah berakhir.";exit;
include "../includes/config.php";
include "../includes/connectdb.php";

header('Connection: close');

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$data = $_POST;
$quizId = $data['quizId'];
$SID = $data['SID'];



foreach($data as $re => $val){
	if(preg_match("/multiple-/i",$re)){
	$question_id = explode('-',$re);
		//echo $re.'-'.$val.'<br />';
		$cols = ' (quizid,questionId,responderSID,'.$val.',entryDate,ip_address) ';
		$vals = " VALUES($quizId,".$question_id[2].",'".$SID."','1','".date('Ymd')."','".$ip."') ";
		
		$sqlins[] = " insert into quiz_answer  ".$cols. $vals . "; ";
		
	} else if (preg_match("/essay-/i",$re)){
	$question_id = explode('-',$re);
		$rea = explode('-',$re);
		$cols = ' (quizid,questionId,responderSID,'.$rea[3].',entryDate,ip_address) ';
		$vals = " VALUES($quizId,".$question_id[2].",'".$SID."','".$val."','".date('Ymd')."','".$ip."') ";
		$sqlins[] = " insert into quiz_answer  ".$cols. $vals . "; ";
	}else{
		//no answered
		$question_id = explode('-',$re);
		$cols = ' (quizid,questionId,responderSID,'.',entryDate,ip_address) ';
		$vals = " VALUES($quizId,".$question_id[2].",'".$SID."','".date('Ymd')."','".$ip."') ";
		
		$sqlins[] = " insert into quiz_answer  ".$cols. $vals . "; ";
	}
	
}

$result = "";
$result = true;


if($_GET['type']=='daily'){
	echo '<body style="padding:58px;">Terimakasih sudah menjawab.';
	echo ' <META http-equiv="refresh" content="1;URL=http://192.168.4.22/hcadministration/fotoquiz.php"> </body>';
}
//echo $sqlins[0];
if ( $_GET['type']=='daily'){
	@mssql_query($sqlins[0]);$result = true;
	exit;
}else{
	foreach ($sqlins as $i=>$sql) {
		//echo $sql . ' - ';
		$result = @mssql_query($sql) && $result;
	}
}
$res = array();
if($result){
	$res = array(
		'status' => true
		,'message' => "Submit Success!"
	) ;
}else{
		$res = array(
		'status' => false
		,'message' => "Gagal Submit!"
	) ;
}

echo trim(json_encode($res),'"');

/*
$sql_ins = 
insert into quiz_answer (quizid,responderSID,)
values($data["quizId"),'$data["SID")',
*/
?>