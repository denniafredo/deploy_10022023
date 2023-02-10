<?php
$color = "";
//var_dump($score);
$tscore = round($score['score'],1);

if($tscore < 50){
	$color="maroon";
}else{
	$color="teal";
}
?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Jiwasraya Quiz</title>
      <link href="https://jaim.jiwasraya.co.id/asset/css/demo_style.css?<?= rand(10000, 99999) ?>" rel="stylesheet" type="text/css">
      <link href="https://jaim.jiwasraya.co.id/asset/css/smart_wizard.css?<?= rand(10000, 99999) ?>" rel="stylesheet" type="text/css">
      <style>
		html { 
			width:100%; 
			height:100%; 
			background:url('https://jaim.jiwasraya.co.id/asset/img/backgrune.jpg') center center no-repeat;
			background-size: cover;
		}
		.parent {
			position: relative;
		}
		.child {
			position: absolute;
			top:350px;
			left: 50%;
			transform: translate(-50%, -50%);
			text-align:center;
		}
		.score1 {
			color:<?=$color?>;
			font-size:8.5em;
		}		.score2 {
			color:<?=$color?>;
			font-size:3.5em;
		}.score2 {
			color:<?=$color?>;
			font-size:3.5em;
		}.score3 {
			color:<?=$color?>;
			font-size:1.4em;
		}
      </style>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery-2.0.0.min.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery.smartWizard.js?<?= rand(10000, 99999) ?>"></script>
      <script type="text/javascript" src="https://jaim.jiwasraya.co.id/asset/js/jquery.transform.js?<?= rand(10000, 99999) ?>"></script>

	 <meta http-equiv="refresh" content="6; url=https://jaim.jiwasraya.co.id" />
   </head>
<body class="">
  <div style="" class="parent swBackground">
    <div style="" class="child">
		<span class="score3">Quiz <?=$quizname?></span><br /><br />
		<?php
		if($tscore < 50){
		?>
			<span class="score2">Score Anda</span><br />
			<span class="score1 glow"><?=$tscore?></span><br />
			<span class="score3">Maaf, Anda gagal.<br />Silahkan ulangi quiz besok.</span>
		<?
		}else if($tscore >= 50){
		?>
			<span class="score2">Score Anda</span><br />
			<span class="score1  glow"><?=$tscore?></span><br />
			<span class="score3">Selamat <br /> Anda Berhasil.</span>
		<?}?>
	</div>
  </div>
  
  	  	  <style>
.swBackground{
  background:rgba(255,255,255,0.9);
  padding:16px;
   border-radius: 25px;
   min-height:700px;
   width:700px;
}
.glow {
  font-size: 80px;
  color: <?=$color?>;
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #FF8C00, 0 0 40px #FF8C00, 0 0 50px #FF8C00, 0 0 60px #FF8C00, 0 0 70px #FF8C00;
  }
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #FFD700, 0 0 40px #FFD700, 0 0 50px #FFD700, 0 0 60px #FFD700, 0 0 70px #FFD700, 0 0 80px #FFD700;
  }
}
</style>

<script>
$('.swBackground').css('transform','translate(50%, 0)');

</script>
</body>
</html>
