<?
   $SID = "";
   
   ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Jiwasraya Quiz</title>
      <link href="https://jaim.jiwasraya.co.id/asset/css/demo_style.css?<?= rand(10000, 99999) ?>" rel="stylesheet" type="text/css">
      <link href="https://jaim.jiwasraya.co.id/asset/css/smart_wizard.css?<?= rand(10000, 99999) ?>" rel="stylesheet" type="text/css">
      <style>
         .lakso{
			 background-image:url('https://jaim.jiwasraya.co.id/asset/img/backgrune.jpg');
			 background-size: cover;
			 max-height:600px;
			 overflow:auto;
         }         
		 .lakso:before{
			background-image:url('https://jaim.jiwasraya.co.id/asset/img/backgrune.jpg');
			background-size: cover;
			max-height:600px;
			overflow:auto;
			-webkit-filter: blur(5px);
			-moz-filter: blur(5px);
			-o-filter: blur(5px);
			-ms-filter: blur(5px);
			filter: blur(5px);
         }
      </style>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery-2.0.0.min.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery.smartWizard.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery.transform.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/xBase64.js?<?= rand(10000, 99999) ?>"></script>

   </head>
   <body class="lakso">
      <!--div class="demoHead" style="min-height:65px;">   
         <div style="float:left;">
           <h1>JIWASRAYA (PERSERO)</h1>
           <h2>Survey SDM</h2>
         </div>
         </div-->
      <div id="me" class="">
         <div id="timer" style="float:right;">
		 Waktu Pengerjaan  
            <div id="minutes"></div>
            <div id="seconds"></div>
         </div>
         <center >
            <form id="qForm" >
               <div id="wizardQuiz" class="swMain swBackground" style="min-height:400px;width:100%;">
                  <input type="hidden" name="SID" value="<?=$sid?>" />
                  <input type="hidden" name="quizId" value="<?=$quizId?>" />
                  <input type="hidden" name="tries" value="<?=$tries?>" />
                  <ul>
                     <? for($i=1;$i<$jml_page+1;$i++){  ?>
                     <li><a href="#step-<?=$i?>">
                        <label class="stepNumber"><?=$i?></label>
                        <span class="stepDesc">
                        Halaman #<?=$i?><br />
                        <small>Quiz</small>
                        </span>
                        </a>
                     </li>
                     <? } ?>
                  </ul>
                  <? 
                     $ss = 1;
                     for($i=1;$i<$jml_page+1;$i++){ 
                     
                     ?>
                  <div id="step-<?=$i?>" style="overflow:auto;max-height:400px;">
                     <h2 class="StepTitle"><?=$quizTitle?></h2>
                     <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;border:0;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;
						  -o-transition:.8s;
						  -ms-transition:.8s;
						  -moz-transition:.8s;
						  -webkit-transition:.8s;
						  transition:.8s;
						  }
                        .tg td:hover{background:#ccFFcc;}
                        label:hover{background:#ccFFcc;cursor:pointer;}
                        .tg tr:hover{background:#fdfdfd;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
                        .tg .tg-yw4l{vertical-align:middle}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}
                     </style>
                     <?foreach($arr_question['page-'.$i] as $qs => $wq){                           ?>
                     <div class="tg-wrap">
                        <table class="tg" style="table-layout: fixed; width: 900px">
                           <colgroup>
                              <col style="width: 30px">
                              <col style="width: 60px">
                              <col style="width: 500px">
                              <col style="width: 60px">
                              <col style="width: 500px">
                           </colgroup>
                           <tr>
                              <th class="" rowspan="3" style=" vertical-align: top;"><?=$ss?>.</th>
                              <th class="tg-yw4l" colspan="4"><b><?=$wq['QUESTION']?></b></th>
                           </tr>
                           <?
                              $numAns = (int)$wq['NUMANSWER'];
                              $nrow = $numAns / 2;
                              
                              $jk=0;
                              $keyABCD = null;
                              
                              $alphas = range('A', 'Z');
                              
                              $jj=1;  $pp=0;
                              $qq=0;  $rr=0;
                              
                              for($jj; $jj<=$nrow; $jj++){
                              echo '<tr>';
                              echo '<td class="tg-yw4l" style="vertical-align:top;text-align:center;"><input type="radio" id="qid-'.$wq['QUESTIONID'].'-c'.$rr.'"
                              	name="multiple-qid-'.$wq['QUESTIONID'].'" value="c'.$rr.'" style="display:inline;" />'.$alphas[$pp++] . '</td>';
                              echo '<td class="tg-yw4l" style="vertical-align:top;"><label style="font-wight:bolder;font-size:1em;" for="qid-'.$wq['QUESTIONID'].'-c'.$rr.'"> '.$wq['ANSWERCHOICE'][$qq++].'</label></td>';$rr++;
                              
                              echo '<td class="tg-yw4l" style="vertical-align:top;text-align:center;"><input type="radio" id="qid-'.$wq['QUESTIONID'].'-c'.$rr.'" 
                              	name="multiple-qid-'.$wq['QUESTIONID'].'" value="c'.$rr.'" style="display:inline;" />'.$alphas[$pp++] . '</td>';
                              echo '<label style="font-wight:bolder;font-size:1em;" for="qid-'.$wq['QUESTIONID'].'-c'.$rr.'">';
                              echo '<td class="tg-yw4l" style="vertical-align:top;"><label style="font-wight:bolder;font-size:1em;" for="qid-'.$wq['QUESTIONID'].'-c'.$rr.'"> '.$wq['ANSWERCHOICE'][$qq++].'</label></td>';$rr++;
                              echo '</tr>';
                              }
                              
                              ?>
                        </table>
                     </div>
                     <?
                        $ss++;
                        }?>
						<input type="hidden" name="jmlSoal" value="<?=$jmlSoal?>;" />
                  </div>
                  <? } ?>
               </div>
            </form>
         </center>
      </div>
      <script type="text/javascript">
         var datas = {};
         var rets = {};
         var $sid = '<?=$sid?>';
         var SID = 'aaaabbbbcccc';
         var tries = <?=$tries?>;
         var idQuiz = <?=$idQuiz?>;
         
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
         
         	$('#wizardQuiz').smartWizard({
         includeContinueButton: false, includeFinishButton: false}
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
/*          	if(cttext == 0){
         		jmljawab = jmljawab-4;
         	}else{
         		jmljawab = jmljawab-cttext;
         	} */
         	
         	var jmlsoal = <?=$jmlSoal?>;
         	if((jmljawab) < jmlsoal){
         		alert('Anda belum menjawab seluruh pertanyaan! \n\n(menjawab '+jmljawab+' dari '+jmlsoal+' pertanyaan)\n\n');
         		return false;
         	}else{
         	
         if(confirm('Yakin akan submit jawaban?')){
         
			 $.ajax({
				 method: "POST",
				 url: 'https://jaim.jiwasraya.co.id/quiz/submit/'+$sid+'/'+idQuiz+'/'+tries,
				 data: datas
			 })
			 .success(function( ret ) {
			 rets = ret;
			 console.log(rets);
			 
 			 if(!ret)	{
				alert( 'GAGAL Mengirim quiz');
			 return false;
			 }else{
				 alert( 'SUKSES Mengirim quiz');
				 window.location = "https://jaim.jiwasraya.co.id/quiz/thanks/" + $sid +'/'+idQuiz+'/'+tries;
			 } 
			 });
         
         }else{
         
			return false;
         }
         	}
         
         
         //alert('a');
         //window.location.replace("http://192.168.4.22/quiz/takeQuizFinish.php");
         });
         $('ul').css('transform','scale(0.6,0.6) translate(-460px, 0px)');
         /*          $('#me').css('transform','scale(0.8,0.9) translate(0px, -50px)');
         
         $('.page-tbl').css('transform','scale(0.8,0.8) translate(-160px, -50px)');
         $('.actionBar').css('transform','scale(1.2,1.2) translate(0px, 80px)');
         $('.stepContainer').css('transform','scale(1.2,1) translate(0px, 30px)');  */
         $(".actionBar").append($('#timer'));
         
         
         });
		 
		 var lamaPengerjaan = <?=$lamaPengerjaan?>;
         var d = new Date();
         var newDate = dateAdd(d, 'minute', lamaPengerjaan);
         
         function makeTimer() {
			 var endTime = newDate;			
			 endTime = (Date.parse(endTime) / 1000);
			 
			 var now = new Date();
			 now = (Date.parse(now) / 1000);
			 
			 var timeLeft = endTime - now;
			 
			 var days = Math.floor(timeLeft / 86400); 
			 var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
			 var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
			 var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
			 
			 if (hours < "10") { hours = "0" + hours; }
			 if (minutes < "10") { minutes = "0" + minutes; }
			 if (seconds < "10") { seconds = "0" + seconds; }
			 
			 $("#days").html(days + "<span>Days</span>");
			 $("#hours").html(hours + "<span>Hours</span>");
			 $("#minutes").html(minutes + "<span>menit</span>");
			 $("#seconds").html(seconds + "<span> detik</span>");		
         
			if((hours == 0 && minutes == 0 && seconds == 0)){
				alert("Waktu habis!");
				if(confirm("Waktu habis!")){
					alert("SELAMAT");
					return false;
				}
			}
         }
         
         function dateAdd(date, interval, units) {
         var ret = new Date(date);
         var checkRollover = function() { if(ret.getDate() != date.getDate()) ret.setDate(0);};
         switch(interval.toLowerCase()) {
         case 'year'   :  ret.setFullYear(ret.getFullYear() + units); checkRollover();  break;
         case 'quarter':  ret.setMonth(ret.getMonth() + 3*units); checkRollover();  break;
         case 'month'  :  ret.setMonth(ret.getMonth() + units); checkRollover();  break;
         case 'week'   :  ret.setDate(ret.getDate() + 7*units);  break;
         case 'day'    :  ret.setDate(ret.getDate() + units);  break;
         case 'hour'   :  ret.setTime(ret.getTime() + units*3600000);  break;
         case 'minute' :  ret.setTime(ret.getTime() + units*60000);  break;
         case 'second' :  ret.setTime(ret.getTime() + units*1000);  break;
         default       :  ret = undefined;  break;
         }
         return ret;
         }
         
         setInterval(function() { makeTimer(); }, 1000);
      </script>
      <span id="meButton" style="display:none;text-align:right;padding:16px;">
      <input type="button" id="btnSubmit" value=" KIRIM " class="buttonFinish"/>
      </span>
      <style>
         .stepContainer{
         overflow-y:auto;
         }
         @import url(https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,900,700italic,700,600italic,600,400italic);
         #days {
         font-size: 30px;
         color: #db4844;
         display: inline-block;
         }
         #hours {
         font-size: 30px;
         color: #f07c22;
         display: inline-block;
         }
         #minutes {
         font-size: 30px;
         color: #f6da74;
         display: inline-block;
         }
         #seconds {
         font-size: 18px;
         color: #abcd58;display: inline-block;
         }
      </style>
	  <style>
.swBackground{
  background:rgba(255,255,255,0.9);
  padding:16px;
   border-radius: 25px;
}
</style>
   </body>
</html>