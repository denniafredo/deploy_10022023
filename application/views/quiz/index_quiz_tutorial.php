<?
   ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Quiz Jiwasraya</title>
      <link href="https://jaim.jiwasraya.co.id/asset/css/smart_wizard.css?<?= rand(10000, 99999) ?>" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery-2.0.0.min.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery.smartWizard.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery.transform.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/xBase64.js?<?= rand(10000, 99999) ?>"></script>
      <style>
          .lakso{
         background-image:url('https://jaim.jiwasraya.co.id/asset/img/backgrune.jpg');
         background-size: cover;
         overflow:hidden;
         height:688px;
         } 
         .stepContainer{
         overflow:visible;
         }
         body{
         margin:0px;
         padding:0px;
		 font-family:verdana;
         }
         .inpBox{
         border:0px;
         border-bottom:dashed 1px black;
         }
      </style>
   </head>
   <body  class="lakso">
      <form id="dataprib" method="GET" class="">

            <table align="center" border="0" cellpadding="0" cellspacing="0" class="swBackground">
               <tr>
                  <td>
                     <!-- Smart Wizard -->
                     <div id="wizard" class="swMain ">
                        <ul>
                           <li><a href="#step-1">
                              <label class="stepNumber">1</label>
                              <span class="stepDesc">
                              Pilih Quiz<br />
                              <small>Silakan memilih</small>
                              </span>
                              </a>
                           </li>
                           <li><a href="#step-2">
                              <label class="stepNumber">2</label>
                              <span class="stepDesc">
                              Penjelasan<br />
                              <small>Tentang Quiz</small>
                              </span>
                              </a>
                           </li>
                           </li>
                           <li><a href="#step-3">
                              <label class="stepNumber">3</label>
                              <span class="stepDesc">
                              Data<br />
                              <small>Data Diri</small>
                              </span>
                              </a>
                           </li>
                           <li><a href="#step-4">
                              <label class="stepNumber">3</label>
                              <span class="stepDesc">
                              Contoh<br />
                              <small>Contoh Pertanyaan</small>
                              </span>
                              </a>
                           </li>
                        </ul>
                        <div id="step-1" style="overflow:none;" style="overflow:hidden;">
                           <h2 class="StepTitle">Quiz yang harus diambil</h2>
                           <div style="padding:28px;">

						  <? 
						  if(count($QUIZ) > 0) {
								foreach($QUIZ as $row=>$quiz){
									echo '
										<input type="radio" name="quizid" id="quizid"  value="'.$quiz['QUIZID'].'"/>
									   <label for="quizid-'.$quiz['QUIZID'].'"><strong>'.$quiz['QUIZNAME'].'</strong><br /> 
									   '.$quiz['QUIZDESCRIPTION'].', batas waktu '.$quiz['TIMELIMIT'].' menit.
									   </label>  <br><br>
									';
								}
						  }
						  ?><p>
                              </p>
                           </div>
						   <? if(isset($expired) && is_array($expired)){ ?>
						   	<!--div>
								<div style="border:solid orange 1px;text-align:center;background:white;min-width:600px;min-height:60px;">
									<br /><span style="color:maroon;font-size:1.2em;">NOMOR LISENSI ANDA (<?=$expired['NOLISENSIAGEN']?>) SUDAH HABIS MASA BERLAKUNYA,<br /> 
									SILAHKAN MENGHUBUNGI KEAGENAN UNTUK INFORMASI LEBIH LANJUT</span>
								</div>
						   </div-->
						   <?} ?>
                        </div>
                        <div id="step-2" style="overflow:hidden;">
                           <h2 class="StepTitle">Tutorial Lisensi Keagenan PT. ASURANSI JIWASRAYA (PERSERO)</h2>
                           <div class=WordSection1>
                              <p class=MsoNormal><span lang=IN> <?=$QUIZ[0]['QUIZRULE']?></span></p>
                              <p class=MsoNormal><span lang=IN></span></p>
                              <p class=MsoNormal><span lang=IN></span></p>
                           </div>
						   
						   

						   
						   
                        </div>
                        <div id="step-3" style="overflow:hidden;">
                           <h2 class="StepTitle">DATA PRIBADI</h2>
                           <table>
                              <tr>
                                 <td>Nama </td>
                                 <td>:</td>
                                 <td><?=$NAMA?></td>
                              </tr>
                              <tr>
                                 <td>Nomor Agen</td>
                                 <td>:</td>
                                 <td><?=$USERNAME?><input type="hidden" name="IDAGEN" value="<?=$USERNAME?>"></input>
								 <script>
								 var $sid = '<?=$USERNAME?>';
								
								 </script>
								 </td>
                              </tr>
                              <tr> 
                                 <td>Kode Kantor</td>
                                 <td>:</td>
                                 <td><?=$KDKANTOR?></td>
                              </tr>
                              <tr>
                                 <td>Nama Kantor</td>
                                 <td>:</td>
                                 <td><?=$NAMAKANTOR?></td>
                              </tr>
                              <tr>
                                 <td>Nama Kantor Induk</td>
                                 <td>:</td>
                                 <td><?=$NAMAINDUK?></td>
                              </tr>
                              <tr>
                                 <td>Email</td>
                                 <td>:</td>
                                 <td<?=$EMAILKANTOR?>td>	
                              </tr>
                              <tr>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <td>&nbsp;</td>
                              </tr>
                           </table>
						   <?
						   if(count($QUIZ) > 0) {
							   foreach($QUIZ as $row=>$quiz){
								   ?>
								   <br /><br />
								   <input type="checkbox" 
								   style="display:none;" 
								   id="setuju<?=$quiz['QUIZID']?>" name="setuju<?=$quiz['QUIZID']?>">
									<b>SAYA Sudah membaca dan memahami <a href="<?=$quiz['PATHMATERI']?>" target="_blank">materi CPD <?=$quiz['QUIZSHORTNAME']?> </a></b>
								   </input>
								    <label for="setuju<?=$quiz['QUIZID']?>"></label>
								   <?
							   }
						   }
						   ?>

						   </div>
                        <div id="step-4" style="overflow:hidden;">
                           <h2 class="StepTitle">CONTOH SOAL:</h2>
                           <div class=WordSection1>
                              <br />
                              <br />
                              <br />
                              <table>
                                 <tr>
                                    <th style="font-size:1em;border-top:solid grey 2px;border-bottom:solid grey 2px;padding-top:8px;padding-bottom:8px;">No. Soal</th>
                                    <th style="font-size:1em;border-top:solid grey 2px;mid-width:500px;border-bottom:solid grey 2px;max-width:500px;padding-top:8px;padding-bottom:8px;">Pertanyaan</th>
                                    <th style="font-size:1em;border-top:solid grey 2px;padding-top:8px;border-bottom:solid grey 2px;padding-bottom:8px;">Jawaban</th>
                                 </tr>
                                 <tr style="border-bottom:solid navy 1px;">
                                    <td style="border-bottom:solid grey 1px;text-align:center;" valign="top">
                                       <span  style="font-size:1em;font-weight:bolder;">#1</span>
                                    </td>
                                    <td style="font-size:1em;min-width:500px;border-bottom:solid grey 1px;max-width:500px; " valign="top">
                                       <span  style="font-weight:bolder;">Tujuan Penemuan Kesepakatan didalam pencarian fakta adalah :</span>
                                    </td>
                                    <td style="font-weight:bolder;font-size:1em;border-bottom:solid grey 1px;min-width:250px;"><input type="radio" id="qid-1-c1" >
                                       <label style="font-wight:bolder;font-size:1em;" for="qid-1-c1">Untuk membangun kembali kebutuhan dan minat</label></input>
                                       <br /><input type="radio" id="qid-1-c2" name="multiple-qid-1" value="c2"><label style="font-wight:bolder;font-size:1em;" for="qid-1-c2">Untuk mengkonfirmasi prioritas utama</label></input><br />
                                       <input type="radio" id="qid-1-c3" name="multiple-qid-1" value="c3"><label style="font-wight:bolder;font-size:1em;" for="qid-1-c3">Untuk mengkonfirmasi  kecukupan dana</label></input><br /><input type="radio" id="qid-1-c4" name="multiple-qid-1" value="c4">
                                       <label style="font-wight:bolder;font-size:1em;" for="qid-1-c4">A, B dan C benar</label></input><br />
                                    </td>
                                 </tr>
                                 <tr style="border-bottom:solid navy 1px;">
                                    <td style="border-bottom:solid grey 1px;text-align:center;" valign="top">
                                       <span  style="font-size:1em;font-weight:bolder;">#2</span>
                                    </td>
                                    <td style="font-size:1em;min-width:500px;border-bottom:solid grey 1px;max-width:500px; " valign="top">
                                       <span  style="font-weight:bolder;">Dalam 10 langkah penjualan, langkah yang dilakukan sebelum berada di tahap Presentasi adalah :</span>
                                    </td>
                                    <td style="font-weight:bolder;font-size:1em;border-bottom:solid grey 1px;min-width:250px;">
                                       <input type="radio" id="qid-2-c1" ><label style="font-wight:bolder;font-size:1em;" for="qid-2-c1">Penyerahan Polis</label></input>
                                       <br /><input type="radio" id="qid-2-c2" name="multiple-qid-2" value="c2"><label style="font-wight:bolder;font-size:1em;" for="qid-2-c2">Underwriting</label></input><br />
                                       <input type="radio" id="qid-2-c3" name="multiple-qid-2" value="c3"><label style="font-wight:bolder;font-size:1em;" for="qid-2-c3">Pelayanan</label></input><br />
                                       <input type="radio" id="qid-2-c4" name="multiple-qid-2" value="c4"><label style="font-wight:bolder;font-size:1em;" for="qid-2-c4">Memberikan Solusi</label></input><br />
                                    </td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
         </div>
      </form>
      <!-- End SmartWizard Content -->          
      </td></tr>
      </table>
      </div>
      <script type="text/javascript">
         var dtPrib = null;
         var datas =[];
		 
		 var $tries = <?=$tries?>;
		 var idQuiz;
		 
         $(document).ready(function(){
				$("input[name='quizid']").on('click',function(){
					$obj = this;
					console.log($($obj).val())
					idQuiz = $($obj).val();
					if($('#setuju'+idQuiz).is(":hidden")){
						$('#setuju'+idQuiz).show();
					}else{
						$('#setuju'+idQuiz).hide();
					}
				})
			 
                 $('#wizard').smartWizard({
                     includeContinueButton: false
                     ,includeFinishButton: false});

                 $('.buttonNext').on('click',function (e){
                     if($('.buttonNext').hasClass('buttonDisabled')){
                         $('.buttonFinish').prop('disabled', false);
                         $('.buttonFinish').removeClass('buttonDisabled');
                     }
                 });
                 
                 $('.buttonFinish').on('click',function (e){
					 if($('#setuju'+idQuiz).prop('checked') == false){
						 alert('Harap membaca dan memahami materi CFD, dan mencentang nya.');
						 return false;
					 }
					 
					 idQuiz = $("input[name='quizid']:checked").val();                     
					 //alert("Tries : " + $tries + " | QuizId: " + idQuiz);
					 
					 
					 e.preventDefault();
         
                     datas = $("#dataprib").serializeArray();
                     
                     $.ajax({
                           method: "POST",
                           url: '/quiz/resp/'+$sid+'/'+idQuiz+'/'+$tries,
                           data: datas
                         })
                     .success(function( ret ) {
                         rets = JSON.parse(ret);
						 console.log(rets);
						 
						 
                                 if(!ret)    {
									 alert( 'Gagal Mengirim Jawaban');
									 return false;
                                 } else {
									 
									if(rets.status){
										if(rets.code==1){
											alert(rets.msg);
											window.location = "https://jaim.jiwasraya.co.id/quiz/start_quiz/" + $sid + "/" + idQuiz+ "/" + $tries;
										}else if(rets.code==2){
											window.location = "https://jaim.jiwasraya.co.id/quiz/start_quiz/" + $sid + "/" + idQuiz+ "/" + $tries;
										}else if(rets.code ==0){
											alert(rets.msg);
											window.location = "https://jaim.jiwasraya.co.id/quiz/thanks/" + $sid+'/'+idQuiz+'/'+$tries;
										}else if(rets.code ==3){
											alert(rets.msg);
											//
										}else if(rets.code ==4){
											alert(rets.msg);
											window.location = "https://jaim.jiwasraya.co.id/";
										}else if(rets.code ==11){
											$tries =rets.tries;
											alert(rets.msg + ' Pengulangan ke:' + ($tries));
											window.location = "https://jaim.jiwasraya.co.id/quiz/start_quiz/" + $sid + "/" + idQuiz +'/'+$tries+'/remedy';
										}

									}else{
										alert(rets.msg);
										window.location = "https://jaim.jiwasraya.co.id/quiz/thanks/" + $sid+'/'+idQuiz+'/'+$tries;
									}
                                 }
                         });
                 })

                 $('ul').css('transform','scale(0.7,0.6) translate(-200px, 80px)');
                 $('.content').css('transform',' translate(0px, 40px)');
                 
         });
         
         
                 
         
      </script>
      <span id="meButton" style="display:none;text-align:right;padding:16px;">
      <input type="button" id="btnSubmit" value="Mulai Quiz " style="width:150px;" disabled="disabled" class="buttonDisabled buttonFinish"/>
      </span>
	  	  <style>
.swBackground{
  background:rgba(255,255,255,0.9);
  padding:16px;
   border-radius: 25px;
}
</style>
   </body>
</html>