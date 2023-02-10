<?
echo "Quisoner telah berakhir.";exit;
include "../includes/config.php";
include "../includes/connectdb.php";



header('Connection: close');

if(isset($_GET['act']) && $_GET['act'] =="saveDataPribadi"){
	$data = $_POST;
	$six = $data['sid'];
	unset($data['1']);
	unset($data['sid']);
	
	$j = json_encode($data);
	$sql = "insert into quiz_answer (quizid,questionId,responderSID,c1,entryDate) values (1,0,'".$six."','".base64_encode($j)."','".date('Ymd')."') ";
echo json_encode(mssql_query($sql));
exit;
}

$SID = "";




$sql_get_sid = " SELECT  CONVERT(varchar(255), NEWID()) SID  " ;
$res = mssql_query($sql_get_sid);
		while($row = mssql_fetch_array($res))
		{
			$SID = $row["SID"];
		}
$jmlSoal = 0;
$sql_get_jum_soal = " SELECT  count(0) JMLSOAL from quiz_question_bank WHERE quizId = 1 " ;
$res = mssql_query($sql_get_jum_soal);
		while($row = mssql_fetch_array($res))
		{
			$jmlSoal = $row["JMLSOAL"];
		}

$quizTitle = "";
$sql_title = " SELECT QUIZNAME,QUIZDESCRIPTION FROM [quiz] where quizId=1 ";
$res = mssql_query($sql_title);
		while($row = mssql_fetch_array($res))
		{
			$quizTitle = $row["QUIZNAME"];
		}

		
$questionsPerpage = 4;

$jml_page = ceil($jmlSoal/$questionsPerpage);



	$sql_s = " select * from quiz_question_bank where quizId = 1  " ;
	
	$res = mssql_query($sql_s);
	
	$arr_question = "";
	
	$x = 1;
	$page = 1;
	while($row = mssql_fetch_array($res))
	{
		$arr_question['page-'.$page][] = array(
			'id' => $row["questionId"]
			,'questionType' => $row["questionType"]
			,'question' => $row["question"]
			,'numAnswer' => $row["numAnswer"]
			,'choice' => explode('||',$row["answerChoice"])
		);
		if($x==$questionsPerpage){
			$page ++;
			$x = 1;
		} else { $x++; }

	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Jiwasraya Survei & Quiz</title>
<link href="styles/demo_style.css" rel="stylesheet" type="text/css">

<link href="styles/smart_wizard.css" rel="stylesheet" type="text/css">
<style>
.lakso{
	background-image:url('images/laksos2.png');
	background-size: cover;
	max-height:600px;
	overflow:hidden;
}
.stepContainer{
	overflow:hidden;

}
</style>


<script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="js/jquery.smartWizard.js"></script>
<script type="text/javascript" src="js/jquery.transform.js"></script>



</head>
<body class="lakso">

<!--div class="demoHead" style="min-height:65px;">   
    <div style="float:left;">
      <h1>JIWASRAYA (PERSERO)</h1>
      <h2>Survey SDM</h2>
    </div>
</div-->
<div id="me" class="">
<center ><form id="qForm" >
	<div id="wizardQuiz" class="swMain swBackground" style="min-height:400px;width:100%;">
	<input type="hidden" name="SID" value="<?=$SID?>" />
	<input type="hidden" name="quizId" value="1" />
  			<ul>
				<? for($i=1;$i<$jml_page+1;$i++){  ?>
					<li><a href="#step-<?=$i?>">
						<label class="stepNumber"><?=$i?></label>
						<span class="stepDesc">
						   Halaman #<?=$i?><br />
						   <small>Survei</small>
						</span>
						</a>
					</li>
				<? } ?>
  			</ul>

			<? for($i=1;$i<$jml_page+1;$i++){  ?>
			 <div id="step-<?=$i?>" style="overflow:hidden;max-height:400px;">	
				<h2 class="StepTitle"><?=$quizTitle?></h2>
				<table>
					<tr>
						<th style="font-size:1.4em;border-top:solid grey 2px;border-bottom:solid grey 2px;padding-top:8px;padding-bottom:8px;">No. Soal</th>
						<th style="font-size:1.4em;border-top:solid grey 2px;mid-width:700px;border-bottom:solid grey 2px;max-width:700px;padding-top:8px;padding-bottom:8px;">Pertanyaan</th>
						<th style="font-size:1.4em;border-top:solid grey 2px;padding-top:8px;border-bottom:solid grey 2px;padding-bottom:8px;">Jawaban</th>
					</tr>
					
					<?foreach($arr_question['page-'.$i] as $qs => $wq){?>
						<tr style="border-bottom:solid navy 1px;">
							<td style="border-bottom:solid grey 2px;text-align:center;" valign="top">
							<span  style="font-size:1.4em;font-weight:bolder;">#<?=$wq['id']?></span></td>
							<td style="font-size:1.4em;min-width:750px;border-bottom:solid grey 2px;max-width:700px; " valign="top">
								<span  style="font-weight:bolder;"><?=$wq['question'].''?></span></td>
							<td style="font-weight:bolder;font-size:1.18em;border-bottom:solid grey 2px;min-width:250px;"><? //questionType
								for($k=0;$k<$wq['numAnswer'];$k++){
									$l=0;
									if($wq['questionType'] == 'MULTIPLE CHOICE'){
									$l = $k+1;
										echo '<input type="radio" id="qid-'.$wq['id'].'-c'.$l.'" name="multiple-qid-'.$wq['id'].'" value="c'.$l.'">';
										echo '<label style="font-wight:bolder;font-size:1em;" for="qid-'.$wq['id'].'-c'.$l.'">';
										echo $wq['choice'][$k].'</label></input><br />';
									} else if($wq['questionType'] == 'ESSAY'){
									$l = $k+1;
										echo '<textarea cols="48" rows="6" id="qid-'.$wq['id'].'-c'.$l.'" name="essay-qid-'.$wq['id'].'-c'.$l.'"></textarea>';
									}
								}
							?></td>
						</tr>
					<?}?>
				</table>
				
			</div>
			<? } ?>

	</div>



	</form>
</center>
    </div>		
	
	<script type="text/javascript">
			var datas = {};
			var rets = {};
			
var SID = '<?=$_GET['sid']?>';


var unsaved = false;

$(":input").change(function(){ //trigers change in all input fields including text type
    unsaved = true;
});


window.onbeforeunload = unloadPage;

function unloadPage(){ 
    if(unsaved){
        return "Anda akan keluar dari halaman ini! Apakah Anda yakin?";
    }
}


    $(document).ready(function(){
	
	

    	// Smart Wizard 	
  		$('#wizardQuiz').smartWizard({
			includeContinueButton: false
			,includeFinishButton: false}
		);
		
		$('#btnSubmit').click(function (event){
			event.preventDefault();
			$("#qForm").serializeArray().map(function(x){datas[x.name] = x.value;}); 
				console.log(datas);
				
				var cttext = 0;
				$('textarea').each(function(){
						if($(this).val()!=''){
							cttext = cttext+1
						} 
					}
				);
				
				var jmljawab = Object.keys(datas).length;
				if(cttext == 0){
					jmljawab = jmljawab-4;
				}else{
					jmljawab = jmljawab-cttext;
				}
				
				var jmlsoal = <?=$jmlSoal?>;
				if((jmljawab) < jmlsoal){
					alert('Anda belum menjawab seluruh pertanyaan! \n\n(menjawab '+jmljawab+' dari '+jmlsoal+' pertanyaan)\n\n');
					return false;
				}else{
				
							if(confirm('Yakin akan submit jawaban?')){

				$.ajax({
					  method: "POST",
					  url: 'http://192.168.4.22/quiz/takeQuizFinish.php',
					  data: datas
					})
				.success(function( ret ) {
				rets = ret;
						if(!ret)	{
								alert( 'GAGAL Mengirim quesioner');
								return false;
						}else{
						alert( 'SUKSES Mengirim quesioner');
							window.location.replace("http://192.168.4.22/quiz/takeQuizThanks.php");
						}
				});

			}else{
			
				return false;
			}
				}
			

			//alert('a');
			//window.location.replace("http://192.168.4.22/quiz/takeQuizFinish.php");
		})

		$('#me').css('transform','scale(0.8,0.9) translate(-120px, -50px)');
		$('ul').css('transform','scale(0.7,0.6) translate(-300px, -20px)');
		$('.stepContainer').css('transform','scale(1.2,1) translate(120px, -60px)');
	});
</script>
		<span id="meButton" style="display:none;text-align:right;padding:16px;">
			<input type="button" id="btnSubmit" value=" KIRIM " class="buttonFinish"/>
		</span>
</body>
<style>
.swBackground{
	  opacity: 0.5;
  filter: alpha(opacity=50); /* For IE8 and earlier */
  background:white;
}
</style>
</html>