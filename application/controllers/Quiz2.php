<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quiz2 extends CI_Controller {

    function __construct() {
        parent::__construct();
		check_session_user();
        check_kuesioner();
        $this->url = base_url('quiz');
    }

	function lisensi(){
		$data = null;
		$quiz = $this->db->query('select * from JAIM_000_QUIZ where enabled = 1 and quizid = 4 order by quizid')->result_array();
		
		$data['quiz'] = $quiz;
		
		//$this->load->view('quiz/__head',$data);
		$this->load->view('quiz/lisensi_tutorial',$data);
		//$this->load->view('quiz/__bottom',$data);
	}
	
	function bscore($idagen,$tries=FALSE){
		$quizid = 1;
		$p = $this->__scoring2($idagen,$quizid,$tries);
		
		echo json_encode($p);
	}
	
	function index(){
		if(isset($_GET['a'])){
			$qid = $_GET['a'];
		}else{
			$qid = 0;
		}
		$data['USERNAME'] = $this->session->USERNAME;
		$data['NAMA'] = $this->session->NAMALENGKAP;
		$data['KDKANTOR'] = $this->session->KDKANTOR;
		$data['NAMAKANTOR'] = $this->session->NAMAKANTOR;
		$data['EMAILKANTOR'] = $this->session->EMAILKANTOR;
		$data['NAMAINDUK'] = $this->session->NAMAINDUK;
		$quiz = $this->db->query(' select * from JAIM_000_QUIZ where enabled = 1 and quizid = 4 order by quizid')->result_array();
		
		if(!is_numeric($qid)){
			$qid = 0;
		}
		
		$data['QUIZ'] = $quiz;
		$tries = 1;
		
		$idagen = $this->session->USERNAME;
		
		$rs = " select max(tries) tries from JAIM_000_QUIZ_ANSWER where 
			responderid = '$idagen' 
			and questionid = 0 
			and quizid = $qid  
			group by quizid ";
			
		$re = $this->db->query($rs)->result_array();
		if($re){
			$re = $re[0];
			$tries = $re['TRIES'];
		}else{
			$re=FALSE;
		}
		
		$sql = " select * from JAIM_000_QUIZ_ANSWER where responderid = '$idagen' and questionid = 0 and quizid=$qid and tries = $tries ";
		$res = $this->db->query($sql)->result_array();
		if(isset($res[0])){
			$statusQuizPeserta = $res[0]['DEFAULTANSWER'];
			
			$statusQuizPeserta = json_decode($statusQuizPeserta,TRUE);
				if($statusQuizPeserta['code'] == 3){
					
					$sql = " select max(tries) tries from JAIM_000_QUIZ_ANSWER where  quizid = $qid  and questionid = 0
							and responderid = '$idagen' group by responderid";
						$try = $this->db->query($sql)->result_array();
						
						if(is_array($try) && count($try)>0){
							$tries = $try[0]['TRIES'];
						}
				}
		}
		
		$data['tries'] = $tries;
		$data['quizid'] = $qid;
		
		$sqlExp = "select ffr.*,(case when tglakhirlisensi < sysdate then 'EXPIRED'
				else 'OK'
				END
			) STATUSLISENSI from jsadm.tabel_400_agen@JLINDO ffr
			where noagen =  '$idagen' ";
		$res = $this->db->query($sqlExp)->result_array();
		
		$expired = FALSE;
		if(isset($res[0])){
			$t = $res[0];
			
			if($t['STATUSLISENSI'] == 'EXPIRED'){
				$expired = array(
					'TGLAKHIRLISENSI' =>$t['TGLAKHIRLISENSI']
					,'NOLISENSIAGEN' => $t['NOLISENSIAGEN']
				);
			}
		}
		$data['expired'] = $expired;
		$this->load->view('quiz/index_quiz_tutorial',$data);
	}

	function thanks($idagen,$qid,$tries){
		$ss="";
		if($tries){
			$ss = " and tries = $tries ";
		}
		
		$sql = " select aa.*,(
			select quizname from JAIM_000_QUIZ where quizid = $qid
		) quizname from JAIM_000_QUIZ_ANSWER aa where responderid = '$idagen' and questionid = 0 and quizid = $qid  $ss ";
		$res = $this->db->query($sql)->result_array();
		
		$sts = $res[0]['DEFAULTANSWER'];
		$sts = json_decode($sts,TRUE);

		$data['score'] = $sts;
		$data['quizname'] = $res[0]['QUIZNAME'];
		$data['nama_lengkap'] = ucwords(strtolower($this->session->NAMALENGKAP));
		
		$this->load->view('quiz/score',$data);
	}
	
	function submit($idagen,$qid,$tries=FALSE){
		$inp = $this->input->post(); 
		$try = "";
		if($tries){
			$try = " and tries = $tries";
		}else{
			if(isset($inp['tries'])) $try = " and tries = ".$inp['tries'];
		}
		
		$sql = " select * from JAIM_000_QUIZ_ANSWER where responderid = '$idagen' and questionid = 0 and quizid = $qid $try ";
		
		$res = $this->db->query($sql)->result_array();
		
	
		
		$result = array(
			'status'	=>FALSE,
			'msg'	=>'Error ocurred.'
		);

		
		
		if(isset($res[0])){

			
			$statusQuizPeserta = $res[0]['DEFAULTANSWER'];
			
			$statusQuizPeserta = json_decode($statusQuizPeserta,TRUE);
			if($statusQuizPeserta['code'] == 1){
				
				$result = $this->__save_answer($inp,$idagen);
				
			}else if($statusQuizPeserta['code'] == 11){
				
				$result = $this->__save_answer($inp,$idagen,$tries);
			}
		}
		
		echo json_encode($result);
	}
	
	function __save_answer($inp,$idagen,$tries=FALSE){
	
	$quizId = $inp['quizId'];
	$jmlSoal = $inp['jmlSoal'];
	if(!$tries){
		$tries = 1;
	}
	$SID = $idagen;
	$sqlins = null;
	
	unset($inp['SID']);
	unset($inp['quizId']);
	unset($inp['jmlSoal']);
	unset($inp['tries']);

	
	
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		
	
	if(count($inp) < $jmlSoal){
		$ct = count($inp);
		$delta = $jmlSoal - $ct;

		$i = 1;
		$int_noanswer = 9000;
		
		for($i;$i<=$delta;$i++){
			$inp['unanswer-qid-'.$int_noanswer++] = null;
		}
	}
	
	foreach($inp as $re => $val){
			if(preg_match("/multiple-/i",$re)){
					$vals = "";
					$question_id = explode('-',$re);
					$sql = " select defaultchoice from JAIM_000_QUIZ_QUESTION_BANK  where questionid = ".$question_id[2]." and quizid = $quizId ";
					$kunciJawaban = $this->db->query($sql)->result_array();
					$kunciJawaban = $kunciJawaban[0]['DEFAULTCHOICE'];
			
				
					$cols = ' (quizid,questionId,responderID,'.$val.',entryDate,ipaddress,defaultanswer,tries) ';
					$vals = " VALUES($quizId,".$question_id[2].",'".$SID."','1',sysdate,'".$ip."','$kunciJawaban',$tries) ";
					
					$sqlins[] = " insert into JAIM_000_QUIZ_ANSWER  ".$cols. $vals . " ";
					
				} else if (preg_match("/essay-/i",$re)){
				$question_id = explode('-',$re);
					$rea = explode('-',$re);
					$cols = ' (quizid,questionId,responderID,'.$rea[3].',entryDate,ipaddress,tries) ';
					$vals = " VALUES($quizId,".$question_id[2].",'".$SID."','".$val."',sysdate,'".$ip."',$tries) ";
					$sqlins[] = " insert into JAIM_000_QUIZ_ANSWER  ".$cols. $vals . " ";
				}else if(preg_match("/unanswer-/i",$re)){
					$question_id = explode('-',$re);
					$sql = " select defaultchoice from JAIM_000_QUIZ_QUESTION_BANK  where questionid = ".$question_id[2]." and quizid = $quizId ";
					$kunciJawaban = $this->db->query($sql)->result_array();
					$kunciJawaban = $kunciJawaban[0]['DEFAULTCHOICE'];
					
					
					$cols = ' (quizid,questionId,responderID,entryDate,ipaddress,defaultanswer,tries) ';
					$vals="";
					$vals = " VALUES($quizId,".$question_id[2].",'".$SID."',sysdate,'".$ip."','$kunciJawaban',$tries) ";
					
					$sqlins[] = " insert into JAIM_000_QUIZ_ANSWER  ".$cols. $vals . " ";
				}else{
					
				}
				
			} 

			
			
			$result = TRUE;
			foreach($sqlins as $k=>$l){
				$sql = $l;
				$result = $this->db->query($sql) && $result;
			}
			
			if($result){
				$scoring = $this->__scoring($SID,$quizId,$tries);

				$score = ((int)$scoring['num_correct']/count($inp) ) * 100;
	
				if($score < 50 ){
					$array = array(
						'status'=>TRUE,
						'code'=>3,
						'score'=>$score,
						'correct'=>$scoring['num_correct'],
						'wrong'=>$scoring['num_wrong'],
						'reason'=>'Remedy quiz.'
					);
				}else if($score >= 50){
					$array = array(
						'status'=>TRUE,
						'code'=>0,
						'score'=>$score,
						'correct'=>$scoring['num_correct'],
						'wrong'=>$scoring['num_wrong'],
						'reason'=>'Finished quiz.'
					);
				}

				$arr = json_encode($array);

				$sql = " update JAIM_000_QUIZ_ANSWER set defaultanswer = '$arr', entrydate = sysdate where 
							questionId =0 and quizId = $quizId and responderID = '$SID' and tries = $tries ";
				$this->db->query($sql);
				
				$result = array(
					'status'=>TRUE,
					'code'=>0,
					'msg'=>'Answers successully saved.',
					'score'=>$score,
					'correct'=>$scoring['num_correct'],
					'wrong'=>$scoring['num_wrong'],
					'reason'=>'Finished quiz.'
				);
			}else{
				$result = array(
					'status'=>FALSE,
					'code'=>1,
					'msg'=>'Error saving answer!'
				);
			}
			
			echo json_encode($result);
	}
	
	function __scoring2($idagen,$quizid,$tries){
		$sql = " select * from JAIM_000_QUIZ_ANSWER where responderID = '$idagen' 
			and quizId = $quizid and questionid != 0 
			and tries = $tries ";
			//echo $sql;
		$res = $this->db->query($sql)->result_array();
		
		$hit = null;
		$anscount = null;
		$correct = 0;
		
		foreach ($res as $re=>$rs){
			$ssql = " select numanswer,DEFAULTCHOICE from JAIM_000_QUIZ_QUESTION_BANK where 
				quizId = $quizid and questionId = ".$rs['QUESTIONID'];
			$resss = $this->db->query($ssql)->result_array();

			$numans = $resss[0]['NUMANSWER'];
			$numans = (int)$numans-1;
			$keyanswer = $resss[0]['DEFAULTCHOICE'];
			$keyanswer = $keyanswer;

			if( $numans > 0){
				$i=0;
				for($i;$i<=$numans;$i++){
					$ans = $rs['C'.$i];

					if( $ans == '1'){
						$stans = (($i+1) == $keyanswer);
							if($stans) {
								$correct = $correct+1;
							}
						$hit[] = array(
							'questionId'	=> $rs['QUESTIONID'],
							'keyanswer'	=> $keyanswer,
							'answer'	=> 'C'.$i,
							'status_answer'	=> $stans
						);
					}
				}
			}
		}
		$hit['num_correct'] = $correct;
		$hit['num_wrong'] = count($res) - $correct;
		return  $hit;
	}
		
	function __scoring($idagen,$quizid,$tries){
		$sql = " select * from JAIM_000_QUIZ_ANSWER where responderID = '$idagen' 
			and quizId = $quizid and questionid != 0 
			and tries = $tries ";
			
		$res = $this->db->query($sql)->result_array();
		
		$hit = null;
		$anscount = null;
		$correct = 0;
		
		foreach ($res as $re=>$rs){
			$ssql = " select numanswer,DEFAULTCHOICE from JAIM_000_QUIZ_QUESTION_BANK where 
				quizId = $quizid and questionId = ".$rs['QUESTIONID'];
			$resss = $this->db->query($ssql)->result_array();

			$numans = $resss[0]['NUMANSWER'];
			$numans = (int)$numans-1;
			$keyanswer = $resss[0]['DEFAULTCHOICE'];
			$keyanswer = (int)$keyanswer;

			if( $numans > 0){
				$i=0;
				
				for($i;$i<=$numans;$i++){
					$ans = $rs['C'.$i];

					if( $ans == '1'){
						$stans = ( ($i+1) == $keyanswer);
							if($stans) {
								$correct = $correct+1;
							}
						$hit[] = array(
							'questionId'	=> $rs['QUESTIONID'],
							'keyanswer'	=> $keyanswer,
							'answer'	=> 'C'.$i,
							'status_answer'	=> $stans
						);
					}
				}
			}
		}
		$hit['num_correct'] = $correct;
		$hit['num_wrong'] = count($res) - $correct;
		return  $hit;
	}
	
	function resp($idagen,$qid,$tries=FALSE){
		
		$inp = $this->input->post(); 
		
		$ss = '';
		if($tries){
			$ss = " and tries = $tries ";
		}else{
			$ss = " and tries = 1 ";
		}
		
		$sql = " select * from JAIM_000_QUIZ_ANSWER where responderid = '$idagen' and questionid = 0 and quizid = $qid $ss ";

		$res = $this->db->query($sql)->result_array();
		$result = array(
			'status'	=>FALSE,
			'msg'	=>'Error ocurred.'
		);
		
		$rs = " select * from JAIM_000_QUIZ where quizid = $qid";
		$quizis = $this->db->query($rs)->result_array();
		$quizis = $quizis[0];

		
		if(isset($res[0])){
			$statusQuizPeserta = $res[0]['DEFAULTANSWER'];
			$statusQuizPeserta = json_decode($statusQuizPeserta,TRUE);
			
			if($statusQuizPeserta['code'] == 1){ //unfinished reset data
				$result = array(
					'status'	=>TRUE,
					'code'=>$statusQuizPeserta['code'],
					'msg'	=>$statusQuizPeserta['reason'] . ' Anda harus mengulang quiz '. $quizis['QUIZSHORTNAME'].' dari awal. Data sebelumnya akan dihapus.'
				);

				$sql = " delete from JAIM_000_QUIZ_ANSWER where responderid =  '".$idagen."'
						and quizid = ".$inp["quizid"]." and questionid != 0 ";
				$res = $this->db->query($sql);
				
			}else if($statusQuizPeserta['code'] == 0){ //finished complete
				$result = array(
					'status'	=>FALSE,
					'code' => $statusQuizPeserta['code'],
					'msg'	=>$statusQuizPeserta['reason'] . ' Anda telah lulus quiz '. $quizis['QUIZSHORTNAME'].'. Terima kasih.'
				);
			}else if($statusQuizPeserta['code'] == 2){
				$result = array(
					'status'	=>TRUE,
					'code' => 2,
					'msg'	=>$idagen.' INITIALIZED'
				);
			}else if($statusQuizPeserta['code'] == 3){
				$result = array(
					'status'	=>TRUE,
					'code' => 3,
					'msg'	=>$idagen.', Anda wajib mengulang quiz '. $quizis['QUIZSHORTNAME']
					.' karena skor Anda masih kurang dari 50. Silahkan mengerjakan quiz saat tombol OK dibawah ini ditekan.'
				);

				$sql = " select to_char(max(entrydate),'yyyy-mm-dd hh24:mi:ss') lastwork ,tries
						from JAIM_000_QUIZ_ANSWER where responderid = '$idagen' and quizid = $qid
						group by responderid,tries ";
						
				$t =  $this->db->query($sql)->result_array();
				
				$dif = null;
				
				if(is_array($t) && count($t) > 0){
					$tries = $t[0]['TRIES'];
					$tries = (int)$tries;
					
					$date1=date_create($t[0]['LASTWORK']);
					$date2=date_create(date('Y-m-d H:i:s'));

					$diff=date_diff($date1,$date2);
					
					$dif = $diff->days;
				}

				if($dif >= 1){
					$tries = $tries+1;
					
						$array = array(
							'status'=>FALSE,
							'code'=>11,
							'reason'=>'Unfinished Remedy Quiz.'
						);
						
						$arr = json_encode($array);
						
						$sql = " insert into JAIM_000_QUIZ_ANSWER 
								(quizid,responderid,questionid,defaultanswer,entrydate,tries) values 
								(".$inp["quizid"].",'$idagen',0,'$arr',sysdate,$tries) ";
						if($this->db->query($sql)){
							//header('https://jaim.jiwasraya.co.id/quiz/start_quiz/' . $idagen . '/remedy/' . $tries);
							$result = array(
								'status'	=>TRUE,
								'code' => 11,
								'tries' => $tries,
								'msg'	=>$idagen.', silahkan tekan tombol OK untuk melakukan remedy quiz '. $quizis['QUIZSHORTNAME']
							);
						}else{
							$result = array(
								'status'	=>FALSE,
								'msg'	=>'Error ocurred when flaging Remedy.'
							);
						}
				}else{
					$result = array(
						'status'	=>TRUE,
						'code' => 4,
						'msg'	=>$idagen.' Maaf Anda belum berhak mengikuti remedy quiz '. $quizis['QUIZSHORTNAME'].', silahkan menunggu 24 Jam setelah Anda menyelesaikan quiz sebelumnya.'
					);
				}
			}if($statusQuizPeserta['code'] == 11){
							$result = array(
								'status'	=>TRUE,
								'code' => 11,
								'tries' => $tries,
								'msg'	=>$idagen.' Tekan tombol OK untuk melakukan remedy quiz '. $quizis['QUIZSHORTNAME'].''
							);
			}
			
		}else{

			$array = array(
				'status'=>FALSE,
				'code'=>1,
				'reason'=>'Unfinished quiz.'
			);
			
			$arr = json_encode($array);
			
			$sql = " insert into JAIM_000_QUIZ_ANSWER 
					(quizid,responderid,questionid,defaultanswer,entrydate,tries) values 
					(".$inp["quizid"].",'$idagen',0,'$arr',sysdate,$tries) ";
			if($this->db->query($sql)){
				$result = array(
					'status'	=>TRUE,
					'code' => 2,
					'msg'	=>$idagen.' INITIALIZED'
				);

			}
		}
		echo json_encode($result);
	}
	
	function start_quiz($idagen, $idQuiz,$tries=1, $remedy = FALSE){

		if($remedy=='remedy'){
			$sql = " select max(tries) tries from JAIM_000_QUIZ_ANSWER 
				where responderid = '$idagen' 
					and quizid = $idQuiz 
					and questionid = 0 ";
		}		
		
		$quiz = $this->db->query("select * from JAIM_000_QUIZ where quizid = ".$idQuiz." and enabled = 1 ")->result_array();

		$jmlSoal = $quiz[0]['NUMQUESTION'];
		$quizTitle = $quiz[0]['QUIZNAME'];
		$lamaPengerjaan = $quiz[0]['TIMELIMIT'];
		
		$data['lamaPengerjaan'] = $lamaPengerjaan;
		$data['quizTitle'] = $quizTitle;
		$data['sid'] = $idagen;
		$data['quizId'] = $idQuiz;
		$data['jmlSoal'] = $jmlSoal;
		$questionsPerpage = 3;
		$jml_page = ceil($jmlSoal/$questionsPerpage);
		$data['jml_page'] = $jml_page;

		$randomize = "";
		
		$sel  = " select MIN(QUESTIONID) MIN, MAX(QUESTIONID) MAX	
		from JAIM_000_QUIZ_QUESTION_BANK where QUIZID = $idQuiz ";
		
		$quiz = $this->db->query($sel)->result_array();

		$arr = $this->__rand(null,$jmlSoal,$quiz[0]['MIN'],$quiz[0]['MAX']);
		shuffle($arr);
		$in = implode(',',$this->__rand(null,$jmlSoal,$quiz[0]['MIN'],$quiz[0]['MAX']));

		$randomize = "  and questionid in (	$in	) ";

		$sql_s = " select * from JAIM_000_QUIZ_QUESTION_BANK where quizId = ".$idQuiz." $randomize " ;
		
		$arQuiz = $this->db->query($sql_s)->result_array();
	
		$arr_question = null;
	
		$x = 1;
		$page = 1;
		
		//var_dump(count($arQuiz));
		
		foreach($arQuiz as $ro => $co)
		{
			$arr_question['page-'.$page][] = array(
				'QUESTIONID' => $co["QUESTIONID"]
				,'QUESTIONTYPE' => $co["QUESTIONTYPE"]
				,'QUESTION' => $co["QUESTION"]
				,'NUMANSWER' => $co["NUMANSWER"]
				,'ANSWERCHOICE' => explode('||',$co["ANSWERCHOICE"])
			);
			if($x==$questionsPerpage){
				$page ++;
				$x = 1;
			} else { $x++; }

		}

		$data['arr_question'] = $arr_question;
		$data['tries'] = $tries;
		$data['idQuiz'] = $idQuiz;

		$this->load->view('quiz/start',$data);
	}
	
		
	function __rand($seed1_arr=null,$cnt_rand,$min,$max){
		
		$random = null;
		$random_hist = null;
			if($seed1_arr==null){
				$i=1;
				$k = 1;
				
				$prand =  array();
				$randhist = array();

				for($k;$k<=$cnt_rand;$k++){
					$v = rand($min,$max);
					
					if(!in_array($v,$randhist)){
						$prand[] = $randhist[] = $v;
					}
				}
										if(count($prand) < $cnt_rand && count($prand) >0){
							$j = 1;
							$t = $cnt_rand - count($prand);
							for($j;$j<=$t;$j++){
								$v = rand($min,$max);
								
								if(!in_array($v,$randhist)){
									$prand[] = $randhist[] = $v;
								}
							}
						}
												if(count($prand) < $cnt_rand && count($prand) >0){
							$j = 1;
							$t = $cnt_rand - count($prand);
							for($j;$j<=$t;$j++){
								$v = rand($min,$max);
								
								if(!in_array($v,$randhist)){
									$prand[] = $randhist[] = $v;
								}
							}
						}
												if(count($prand) < $cnt_rand && count($prand) >0){
							$j = 1;
							$t = $cnt_rand - count($prand);
							for($j;$j<=$t;$j++){
								$v = rand($min,$max);
								
								if(!in_array($v,$randhist)){
									$prand[] = $randhist[] = $v;
								}
							}
						}
												if(count($prand) < $cnt_rand && count($prand) >0){
							$j = 1;
							$t = $cnt_rand - count($prand);
							for($j;$j<=$t;$j++){
								$v = rand($min,$max);
								
								if(!in_array($v,$randhist)){
									$prand[] = $randhist[] = $v;
								}
							}
						}
			}
		$random=	$prand ;
		return $random;
	}
	
}

