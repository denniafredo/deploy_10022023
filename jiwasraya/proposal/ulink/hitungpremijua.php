<? 
  include "./includes/session.php";
  include "./includes/database.php";
  include "./includes/null.php";
	$DB=New database($userid, $passwd, $DBName);
	
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	$kdper = (!$kdper || $kdper=='') ? '1' : $kdper;

	$sql="delete from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' ".
			 "and nopertanggungan='$nopertanggungan'";// and kdjenisbenefit <> 'R' ";
	//echo $sql;		 
	$DB->parse($sql);
	$DB->execute();
	  
	$sql="delete from $DBUser.tabel_200_temp where prefixpertanggungan='$prefixpertanggungan' ".
			 "and nopertanggungan='$nopertanggungan'";
	//echo $sql;		 
	$DB->parse($sql);
	$DB->execute();
  
	$sql="delete from $DBUser.tabel_247_temp where prefixpertanggungan='$prefixpertanggungan' ".
			 "and nopertanggungan='$nopertanggungan'";
	//echo $sql;		 
	$DB->parse($sql);
	$DB->execute();	
		
	//echo $tglbp3."<br>";
  $tglbp3 = ($tglbp3=='NULL') ? 'NULL' : "to_date('".$tglbp3."','DD/MM/YYYY')";
	$nobp3  = ($nobp3=='NULL')? 'NULL' :  "'".$nobp3."'";
	$risk  = (is_null($risk)||strlen($risk)==0)? 'NULL' :  $risk;
	$nosp=strtoupper($nosp);
	
	//echo $tglbp3;
	$sql="insert into $DBUser.tabel_200_temp(prefixpertanggungan,kdpertanggungan,tglakhirpremi,gadaiotomatis,".
	     "notertanggung,nosp,nopertanggungan,tglsp,kdproduk,mulas,usia_th,usia_bl,tglbp3,nobp3,".                  
       "expirasi,lamaasuransi_th,lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,".
       "kdvaluta,juamainproduk,premi1,premilink,kdcarabayar,indexawal,premi2,nopenagih,kdstatusfile,".
			 "noagen,tglrekam,userrekam,tglupdated,userupdated,kdstatusmedical,nopemegangpolis,nopembayarpremi,risk)". //,notertanggung2) ".
	     "values ('$prefixpertanggungan','$kdper',to_date('$akhirpremi','DD/MM/YYYY'),'$bpo',".
			 "'$notertanggung','$nosp','$nopertanggungan',to_date('$tglsp','DD/MM/YYYY'),'$kdproduk',".
			 "to_date('$mulas','DD/MM/YYYY'),$usia_th,$usia_bl,$tglbp3,$nobp3,".
       "to_date('$expirasi','DD/MM/YYYY'),$lamaasuransi_th,$lamaasuransi_bl,$lamapembpremi_th,$lamapembpremi_bl,".
       "'$kdvaluta',$juamainproduk,$premi1,$premi1,'$kdcarabayar',$indexawal,$premi2,$nopenagih,'1',".
			 "$noagen,sysdate,user,sysdate,user,'$kdstatusmedical','$nopemegangpolis','$nopembayarpremi',$risk)"; //,'$notertanggung2')";
	//echo $sql;
	//die;
	$DB->parse($sql);
	$DB->execute();
	
	$sql="insert into $DBUser.tabel_247_temp".
			 "(prefixpertanggungan,nopertanggungan,kdbasispremi,kdbasistebus,kdbasisskg,kdbasiscwa,kdbasisbayar) ".
			 "select '$prefixpertanggungan','$nopertanggungan',a.kdbasispremi,a.kdbasistebus,a.kdbasisskg,a.kdbasiscwa,a.kdbasisbayar ".
			 "from $DBUser.tabel_246_produk_basis a ".
			 "where a.kdproduk='$kdproduk' and a.kdvaluta='$kdvaluta' ".
			 "and a.tglberlaku <= (select max(tglberlaku) from $DBUser.tabel_248_produk_basis ".
 			  "where kdbasispremi=a.kdbasispremi and kdbasistebus=a.kdbasistebus and kdbasisbayar=a.kdbasisbayar ".
					"and kdbasisskg=a.kdbasisskg and kdbasiscwa=a.kdbasiscwa ".
					"and kdproduk=a.kdproduk and kdvaluta=a.kdvaluta and tglberlaku <= to_date('$mulas','DD/MM/YYYY')) ";
	//echo $sql;		 
	$DB->parse($sql);
	$DB->execute();	
	
	if ($premijua=='premi') {
		$sql="update $DBUser.tabel_200_temp set juamainproduk=1000 ".
	 			 "where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan'";
    $DB->parse($sql);
	  $DB->execute();
	  $DB->commit();
	}
?>
<html>
<head>
<script language="JavaScript" type="text/javascript">

function Lanjutkan(){
	if (document.hpj.submit.click()) {
	 window.close();
	} 
}

</script>
</head>
<body onLoad="javascript:Lanjutkan();">
<!--<body>-->
<div align="center">
<p><b><font color="#800000">Tunggu,</font> <br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
<form action="benefit.php?<?echo $SID; ?>" method="post" name="hpj">
<p>
<input type="hidden" name="nopertanggungan" value=<? echo $nopertanggungan; ?>>
<input type="hidden" name="prefixpertanggungan" value=<? echo $prefixpertanggungan; ?>>
<input type="hidden" name="kdper" value=<? echo $kdper; ?>>
<input type="hidden" name="kdproduk" value=<? echo $kdproduk; ?>>
<input type="hidden" name="premijua" value=<? echo $premijua; ?>>
<input type="hidden" name="noproposal" value=<? echo $noproposal; ?>>
<input type="hidden" name="state" value="1">
<input type="hidden" name="vara" value=<? echo $vara; ?>>
<input type="submit" name="submit" value="." style="color: #ffffff;background-color: #ffffff;border: none;">
</p>
</form>
</div>
</body>
</html>