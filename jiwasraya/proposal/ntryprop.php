<?php
  include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/roleptg.php";
  include "../../includes/database.php";
	
	$DB=New database($userid, $passwd, $DBName);

  function GetNewPropTemp($DBX)	{
    srand ((double) microtime() * 1000000);
    $randval = rand();
  	$maxnopert=substr($randval,0,9);
  	return (string)$maxnopert;
  }
	
	$nopert=GetNewPropTemp($DB);
	
	//echo $nopert;
  
	  require("chainselectors.php"); 
    //prepare names 
    $selectorNames = array( 
        CS_FORM=>"ntryprop",  
        CS_FIRST_SELECTOR=>"kdproduk",  
        CS_SECOND_SELECTOR=>"kdcarabayar"); 
		
/*----- Tambahan oleh Ari 24/06/2008 sesuai Nota Intern Divisi URC tgl 23/06/2008 Perihal Izin Entry Proposal ----------*/
/*----- Tambahan oleh Ari 01/07/2008 sesuai Nota Intern Divisi URC tgl 30/06/2008 Perihal Pembukaan Aplikasi JL-iNdO untuk Produk Multiguna ----------*/
/*----- Tambahan oleh Ari 02/07/2008 sesuai Nota Intern Divisi URC tgl 02/07/2008 Perihal Pembukaan Aplikasi ----------*/
/*----- Tambahan oleh Ari 22/07/2008 sesuai Nota Intern Divisi URC tgl 21/07/2008 Perihal Izin Entry Proposal ----------*/
//	if ($kantor=='EH'||$kantor=='LF'||$kantor=='PD'){
//	if ($kantor=='QC'){
//	if ($kantor=='BG'){
//	if ($kantor=='EH'){
//		$stat="and (c.status is null or b.kdproduk in ('MG0','ADB','ADX','ADK','ADS','ADT','ATP')) ";
//		$stats="status is null or kdproduk in ('MG0','ADB','ADX','ADK','ADS','ADT','ATP') ";
//		$stat="and (c.status is null or b.kdproduk in ('ADB','ADS','ADK','ADT','ADX')) ";
//		$stats="status is null or kdproduk in ('ADB','ADS','ADK','ADT','ADX') ";

//	if ($kantor=='PD'){
//		$stat="and (c.status is null or b.kdproduk in ('DM0')) ";
//		$stats="status is null or kdproduk in ('DM0') ";
//	}
//	else{
		$stat="and c.status is null ";
		$stats="status is null" ;
//	}
/*----- End of Tambahan oleh Ari 24/06/2008 sesuai Nota Intern Divisi URC tgl 23/06/2008 Perihal Izin Entry Proposal ----------*/
			
	  	  $Query= "select ".
								"a.kdcarabayar, b.kdproduk, a.namacarabayar,".
								"c.namaproduk, c.keterangan, c.usia_lpp,c.variabel,".
								"c.lama_min,c.lama_max, decode(c.kdproduk||namacarabayar,'PABTAHUNAN',' ROLLOVER','PAATAHUNAN',' ROLLOVER')  roll ".
	          "from ".
								"$DBUser.tabel_233_produk_cara_bayar b, ".
								"$DBUser.tabel_305_cara_bayar a, ".
								"$DBUser.tabel_202_produk c, ".
								"$DBUser.tabel_202_produk_kantor d ".
			  		"where ".
						    "c.kdproduk=d.kdproduk and d.kdkantor='$kantor' and ".
								"a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk ".
								$stat.
						"order by c.kdproduk,a.namacarabayar";
						//echo $Query;
		$DB->parse($Query);
	  $DB->execute();
  	while ($row=$DB->nextrow()) {
	    $nama = $row[KDPRODUK]."  --  ".$row[NAMAPRODUK].' '.$row[KETERANGAN];
			$selectorData[] = array(																 		
				CS_SOURCE_ID=>$row[KDPRODUK],   
        CS_SOURCE_LABEL=>$nama,  
				CS_TARGET_ID=>$row[KDCARABAYAR],  
				CS_TARGET_LABEL=>$row[NAMACARABAYAR].$row[ROLL]
			);
		}				
	$Query="select kdproduk,namaproduk,usia_lpp,variabel,lama_min,lama_max from ".
	       "$DBUser.tabel_202_produk where ".$stats;
		   //echo $Query;
  $DB->parse($Query);
  $DB->execute();
 	while ($raw=$DB->nextrow()) {
		$addendum[] = array(
		PRODUK=>$raw[KDPRODUK],
		VARIABEL=>$raw[VARIABEL],
		USIA_LPP=>$raw[USIA_LPP],
		LAMA_MIN=>$raw[LAMA_MIN],
		LAMA_MAX=>$raw[LAMA_MAX]
		);			
	}
	//instantiate class 
	$ProdukCaraBayar = new chainedSelectors($selectorNames,$selectorData,$addendum); 
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? 
	$sql="select to_char(sysdate,'DD/MM/YYYY') tanggal from dual";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$res = $DB->nextrow();
	$tanggal= $res["TANGGAL"];
  echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  echo "function tgl2(){";
  echo "document.ntryprop.tglsp.value='".$res["TANGGAL"]."';";
  echo "}";
  echo "</script>";
	
	$idxaw=(!$idxaw) ? '1' : $idxaw;
?>
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/entryprop.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/jquery.min.js" ></script>
<script language="JavaScript" type="text/javascript">
	function getdataespaj(nospajol) {
		if (window.console) console.log('mulai getdataespaj');
		$("#pesan").text('');
		$.ajax({
			type : 'post',
			url : 'ajaxntryproposal.php',	
			data : 'nospaj='+nospajol,
			beforeSend: function() { $("#loaderspaj").show(); },
			success : function (data) {
				var r = $.parseJSON(data);
				if (window.console) console.log(data);
				$("#loaderspaj").hide();
				$("#pesan").text(r.pesan);
				$("input[name='notertanggung']").val(r.noklien);
				$("select[name='kdproduk']").val(r.jenisasuransi);
				updatekdcarabayar();
				$("select[name='kdcarabayar']").val(r.carabayar);
				$("input[name='mulas']").val(r.mulas);
				$("input[name='nilai']").val(r.premi);
				JuaPremi();
				$("input[name='juamainprodukaims']").val(r.uangasuransi); //$("input[name='juamainproduk']").val(r.uangasuransi);
				$("#btnLihatPos").click(function() { NewWindow('<?="$HTTP_HOST_AIM/simulasi/cetak?buildid="?>' + r.buildid,'popuppage',600,400,1); });
				$("#btnLihatEspaj").click(function() { NewWindow('<?="$HTTP_HOST_AIM/spajonline/cetak?bid="?>' + r.buildid,'popuppage',600,400,1); });
			}
		});
	}
	
	function getdataklien(nospajol) {
		$("#pesan").text('');
		$.ajax({
			type : 'post',
			url : 'ajaxntryproposal.php',
			data : 'klien=1&nospaj='+nospajol,
			beforeSend : function() { $("#loaderspaj").show(); },
			success : function (data) {
				var r = $.parseJSON(data);
				$("#loaderspaj").hide();
				$("#pesan").text(r.pesan);
				$("input[name='notertanggung']").val(r.noklien);
				if (window.console) console.log(data);
			}
		});
	}
<?php
  $ProdukCaraBayar->printUpdateFunction(); 
?> 
</script> 
<?
  echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  print( "<!--\n" );
  print( "\n" );
  print ( "function Initial(){ \n" );
  print ( " document.ntryprop.buton.disabled=true;\n" );
  print ( " document.ntryprop.cekpolis.disabled=true;\n" );
  if ($gotom=='1') {
 	 print( "document.ntryprop.bpo.checked ='TRUE';\n" );
	}
  print( "document.ntryprop.nilai.value ='".$jua."';\n" );
  print( "cek ='".$kdmed."';\n" );
  print( "switch (cek){\n" );
  print( "			 case 'M': {\n" );
  print( "			 			document.ntryprop.kdstatusmedical[0].checked=true;\n" );
  print( "						} break;\n" );
  print( "				case 'N': {\n" );
  print( "						 document.ntryprop.kdstatusmedical[1].checked=true;\n" );
  print( "						} break;\n" );
  print( "};\n	" );
  print ( "}" );
	
	echo "function protectMed(){ \n";
  //echo " alert('test');\n";
	echo " document.ntryprop.buton.disabled=true;\n";
	echo "}";
	
	print( "//-->\n" );
  echo "</script>";
?>
<script language="JavaScript" type="text/javascript">
<!--
function loadcekagen(theForm){
	/*var polis=theForm.pertanggungan.value;
	if (!polis =='') { 
		var prefix=polis.substring(0,2);
		var noper=polis.substring(3);*/
		//NewWindow('../loadcek.php?prefix='+prefix+'&noper='+noper+'','',700,600,1)
		var agen=ntryprop.noagen.value;
		NewWindow('./loadcekagen.php?noagen='+agen+'','',300,300,1)
	//}
}

function CekAutoDebet(theForm) {
 var kbank = theForm.kdbank.value;
 if (theForm.autodebet.checked) {
  theForm.kdbank.disabled=false
	theForm.norekening.disabled=false
 } else {
  theForm.kdbank.disabled=true
	theForm.norekening.disabled=true
	theForm.nopenagih.value='';
 }
}

function GetPenagihAutoDebet(theForm) {
 var kbank = theForm.kdbank.value;
 NewWindow('penagih_autodebet.php?kdbank='+kbank+'','pvpage',300,300,1);
}

function ValDigitAutoDebet(field) {
  var isi = field.value;
  if (isi == '1190002197521'){
								alert(isi+" Merupakan rekening PT Asuransi Jiwa IFG!! Mohon untuk tidak digunakan")
								field.focus	();
								return false
						}	
  else if (field.value.length > 0){
 		for (var i=0; i < field.value.length; i++){
				 var digit = field.value.charAt(i)
				 if (digit < "0" || digit > "9"){
				 		if (digit ==  "."){
							  alert("Jangan memasukkan titik")
							  field.focus();
							  return false
						}	else {
								alert(digit+" bukan merupakan angka. Mohon masukkan angka saja tanpa spasi")
								field.focus();
								return false
						}
					} 
		}
  }
	return true			
}
//-->
</script>

</head>
<!--<body OnLoad="document.ntryprop.submit.disabled=true;Initial();document.ntryprop.kdbank.disabled=true;document.ntryprop.norekening.disabled=true;" 
topmargin="0"> bank digunakan untuk rek kredit transfer manfaat bulanan savingplan--> 
<body OnLoad="document.ntryprop.submit.disabled=true;Initial();" 
topmargin="0">
<div align="center">
<br>
<table border="1" cellpadding="1" cellspacing="1" width="900" class="tblborder">
	<tr>
		<td class="tblhead" align="center" width="100%">ENTRY PROPOSAL BARU</td>
  </tr>
	<tr>
	
	<td width="100%"> <!-- tempat tabel -->
	<? $tomorrow = date('d/m/Y',mktime()+86400); ?>
  <form name="ntryprop" method="post" action="insprop.php?<? echo $SID; ?>" onSubmit="return OnSumbit(document.ntryprop);disableForm(this);">
	<input type="hidden" name="mode" value="baru">
	<input type="hidden" name="vara" value="0">
	<input type="hidden" name="pariabel">
	<input type="hidden" name="usia_lpp">
	<input type="hidden" name="lama_min">
	<input type="hidden" name="lama_max">
	<input type="hidden" name="notasip">
	<input type="hidden" name="kdper" value="1">
	<input type="hidden" name="prefixpertanggungan" value="<?echo $kantor;?>">
	<input type="hidden" name="nopertanggungan" value="<? echo $nopert; ?>">
	<input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
	<input type="hidden" name="tomorrow" value="<?=$tomorrow;?>">
	<input type="hidden" name="premistd">
	<input type="hidden" name="demit"> 
	<input type="hidden" name="maxdemit">
	<input type="hidden" name="risk">
	
	<table border="0" width="100%" cellspacing="0" cellpadding="1" class="tblisi">
	
	<tr bgcolor="#ffff91">
   	 <td class="arial10"><b>Jenis Polis Baru</b></td>
   	 <td class="arial10" style="display:none;">:</td>
   	 <td class="arial10" colspan="5" style="display:none;"> 
		 <!--input type="radio" id="taltupn" name="taltup" value="0" > NB
		 <input type="radio" id="taltupy" name="taltup" value="1"> TALTUP-->
		 <input type="checkbox" id="taltup" name="taltup" value="1"> Taltup
		 </td>
	</tr>
	
  <tr>
   	 <td width="15%" class="arial10">Nomor SPAJ</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="32%" class="arial10">
		<input type="text" readonly name="nosp" size="11" maxlength="11" class="c" title="Nomor SPAJ" onFocus="highlight(event)" value="<? echo $nosp; ?>">&nbsp;
		<input type="hidden" id="nospx" name="nospx" value="<? echo $nosp; ?>">
		<input type="button" value="Cari SPAJ"  onclick="Klear(document.ntryprop);NewWindow('ulink/spajlist.php','popuppage',800,600,1);" class="buton">
		<input type="button" value="Lihat POS" id="btnLihatPos" class="buton">
		<input type="button" value="Lihat ESPAJ" id="btnLihatEspaj" class="buton" />
		<img id='loaderspaj' src="../../includes/loader.gif" alt="Loading" height="16" width="16" style='display:none;'> 
		<span id='pesan' style='font-size:11px;font-family:verdana;'></span>
	</td>
   	 <td width="15%" class="arial10" align="right">Tanggal SPAJ</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="tglsp" size="10" maxlength="10" onBlur="javascript:convert_date(tglsp);CekAwalMulas(document.ntryprop);" class="c" title="Tanggal Proposal" onFocus="highlight(event)" value="<? echo $tanggal; ?>"></td>
		 <td width="16%" class="arial10">
		 <!--<input type="button" value="Hari Ini"  onclick="javascript:tgl2();" onblur="TanggalMulas()" class="buton" title="Klik untuk entry tanggal hari ini">-->
		 </td>
	</tr>
  <tr>
   	 <td class="arial10">No Tertanggung</td>
   	 <td class="arial10">:</td>
   	 <td class="arial10">
		 <input type="text" readonly name="notertanggung" size="10"  maxlength="10" class="a" value="<? echo $nottg; ?>">
		 <input type="button" value="Cari Klien" name="cari" class="buton" onClick="Cari(this.form);" onBlur="javascript:TanggalMulas()" ></td>
		 <td class="arial10" align="right">Prefix</td>
   	 <td class="arial10">:</td>
   	 <td class="arial10blk"><? echo $kantor ?></td>
   	 <td class="arial10"></td>
	</tr>
  <?$ProdukCaraBayar->printSelectors();?>
  <tr>
   	 <td width="15%" class="arial10">Medical</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10">
		   <input type="radio" name="kdstatusmedical" value="M" title="Medical" onChange="protectMed()">Ya
		   <input  type="radio" name="kdstatusmedical" value="N" title="non Medical" checked="checked" onBlur="javascript:CekTB();">Tidak
		 </td>
   	 <td width="20%" class="arial10"></td>
   	 <td width="2%" class="arial10"></td>
   	 <td width="20%" class="arial10"></td>
		 <td width="16%" class="arial10"></td>
	</tr>
  <tr>
   	 <td width="15%" class="arial10">Tgl Mulai Ass</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="mulas" size="10" maxlength="10" onBlur="javascript:convert_date(mulas);HitungUsia(document.ntryprop);CekAwalMulas(document.ntryprop);" class="c" onFocus="highlight(event)" value="<? echo $mulas; ?>"></td>
   	 <td width="20%" class="arial10" align="right">Usia</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="ver8ungu"><input type="text" name="usia_th" size="3" maxlength="3" class="a" readonly  value="<? echo $usith; ?>" onBlur="javascript:CekUsiaCabar();"> tahun</td>
		 <td width="16%" class="ver8ungu">
 		 <input type="text" name="usia_bl" size="3" maxlength="3" class="a" readonly  value="<? echo $usibl; ?>">bulan
		 </td>
	</tr>
  <tr>
   	 <td width="15%" class="arial10">Lama Premi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="ver8ungu"><input type="text" name="lamapembpremi_th" size="2" maxlength="2"  onfocus="highlight(event)" class="c" onBlur="return cek_masapremi()" value="<? echo $lprth; ?>">tahun
		 <input type="hidden" name="lamapembpremi_bl"  value="<? echo $lprbl; ?>">
		 <input type="hidden" name="lamapembpremi_th_default" value="<? echo $lprth; ?>">
		 <!--tahun<input type="text" name="lamapembpremi_bl" size="2" maxlength="2" class="c" value="0" readonly>-->
		 </td>
   	 <td width="20%" class="arial10" align="right">Akhir Pemb Premi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="akhirpremi" size="10" maxlength="10" class="a" onBlur="javascript:convert_date(akhirpremi);" readonly value="<? echo $akhpr; ?>"></td>
		 <td width="16%" class="arial10"></td>
	</tr>
  <tr>
   	 <td width="15%" class="arial10">Lama Asuransi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="ver8ungu">
		  <input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" class="a" readonly value="<? echo $lamth; ?>">tahun
		  <input type="hidden" name="lamaasuransi_bl" value="<? echo $lambl; ?>">
		 	<!-- <input type="text" name="lamaasuransi_bl" size="2" maxlength="2" class="c" value="0" readonly>-->
		 </td>
   	 <td width="20%" class="arial10" align="right">Akhir Ass (Expirasi)</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="expirasi" size="10" maxlength="10" class="a" onBlur="javascript:convert_date(expirasi);" readonly value="<? echo $expir; ?>"></td>
		 <td width="16%" class="arial10"></td>
	</tr>
	<script type="text/javascript" language="JavaScript"> 
	<?php
    $ProdukCaraBayar->initialize(); 
	?> 
  </script>
  <!--tr>
   	 <td width="15%" class="arial10">Tanggal BP3</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td class="arial10" colspan="2"--><input type="hidden" name="tglbp3" size="10" maxlength="10" class="c" onBlur="convert_date(tglbp3)" onFocus="highlight(event)" value="<? echo $tgbp3; ?>">&nbsp;&nbsp;(Tanggal BS/BM)<!--/td>
   	 <td width="38%" class="a" colspan="3"--><input type="checkbox" name="bpo" value="1" style="display:none;"><!--Setuju Gadai Polis Otomatis</td>
	</tr-->
  <tr>
   	 <td width="15%" class="arial10">Kode Valuta</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="45%" colspan="2" class="arial10"><select size="1" name="kdvaluta" onChange="return IndexAwal(document.ntryprop);" onBlur="return IndexAwal(document.ntryprop);" onFocus="highlight(event)" class="c">
      <?
        $sql = "select a.kdvaluta,b.namavaluta from $DBUser.tabel_234_produk_valuta a, $DBUser.tabel_304_valuta b ".
      			   "where a.kdvaluta=b.kdvaluta and a.kdproduk=(select min(kdproduk) from $DBUser.tabel_202_produk) ";
      	//$sql = "select a.kdvaluta,b.namavaluta from $DBUser.tabel_234_produk_valuta a, $DBUser.tabel_304_valuta b ".
      	//		   "where a.kdvaluta=b.kdvaluta and a.kdproduk=(select min(kdproduk) from $DBUser.tabel_202_produk) ";      	
		$DB->parse($sql);
      	$DB->execute();
      	while($arr=$DB->nextrow()){
      	  echo("<option value=".$arr["KDVALUTA"].">".$arr["NAMAVALUTA"]."</option>");
      	}			 
      ?>
		</select></td>
   	 <td width="2%" class="arial10"></td>
   	 <td width="20%" class="arial10"></td>
		 <td width="16%" class="arial10"></td>
	</tr>
  <!-- autodebet start -->
	<tr>
   	 <td colspan="7" class="arial10">
		 <fieldset style="padding: 5px;"> <!--<legend>Auto Debet</legend>-->
		 <b><center>Untuk cara pembayaran melalui Autodebet, agar menghubungi Bagian Inkaso HO untuk pendaftarannya. Terima Kasih.</center></b>

<!-- Untuk sementara 08/12/2009, Field Autodebet ditutup berdasarkan kesepakatan verbal dengan P Hasyimi
		   <input type="checkbox" name="autodebet" value="1" onClick="CekAutoDebet(document.ntryprop)"> Auto Debet? &nbsp;&nbsp;&nbsp;&nbsp;
			 No. Rekening 
			 <select size="1" name="kdbank" class="c" onChange="GetPenagihAutoDebet(document.ntryprop)">
			  <option>--pilih--</option>
			  <?
        $sql = "select kdbank,namabank from $DBUser.tabel_399_bank where kdbank<>'POS' order by namabank";
      	$DB->parse($sql);
      	$DB->execute();
      	while($arr=$DB->nextrow()){
      	  echo("<option value=".$arr["KDBANK"].">".$arr["NAMABANK"]."</option>");
      	}			 
      ?>
			 </select>
			 <input type="text" name="norekening" onBlur="ValDigitAutoDebet(this.form.norekening)" size="15" maxlength="19">
-->

		 </fieldset>	
		 </td>
	</tr>
	<!-- end outodebet -->

	<tr>
   	 <td width="15%" class="arial10"><!--Nomor BP3--></td>
   	 <td width="2%" class="arial10"><!--:--></td>
   	 <td width="25%" class="arial10"><input type="hidden" name="nobp3" size="12" maxlength="12" title="Nomor BP3" class="c" onFocus="highlight(event)" value="<? echo $nobp3; ?>"></td>
   	 <td width="20%" class="arial10" align="right">Nomor Agen</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10">
		  <!--<input type="text" name="noagen" size="10" maxlength="10" readonly title="Nomor Agen" class="a" value="<? echo $noagn; ?>">-->
		  <input type="text" name="noagen" size="10" maxlength="10" title="Nomor Agen" class="a" value="<? echo $noagn; ?>">
		 </td>
		 <td width="16%" class="arial10">
		 	<input type="button" value="Cari  A g e n"  onclick="PopaAgen()" class="buton">
            <!--<input type="button" value="Cari  A g e n"  onclick="NewWindow('agnlist.php','popuppage',600,400,1);" class="buton">-->
		 </td>
	</tr>
  <tr>
 	 	 <td width="15%" class="arial10">Kurs/Index Awal</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="indexawal" size="6" readonly value="1" class="a" value="<? echo $idxaw; ?>"></td>
   	 <td width="20%" class="arial10" align="right">Penagih</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10">
		  <input type="text" name="nopenagih" size="10" maxlength="10" readonly class="a" value="<? echo $nopng; ?>">
		 </td>
		 <td width="16%" class="arial10">
		 	<input type="button" value="Cari Penagih"  onclick="PopPenagihProp()" class="buton">
            <!--<input type="button" value="Cari Penagih"  onclick="NewWindow('pnglistprop.php?prd=<?=$kdproduk;?>','popuppage',600,400,1);" class="buton">-->
		 </td>
	</tr>
</table>
	</td>
	</tr>
	
	<tr>	
		 <td class="tblhead" align="center">Pemegang Polis Dan Pembayar Premi</td>
	</tr>	
	
  <tr class="tblisi">
  		 	 <td align="center">
            <table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
              <tr class="tblhead1">
      				 <td width="8%" align="center">Klik</td>
      				 <td width="18%" align="center">Insurable</td>
      				 <td width="28%" align="center">Nama</td>
      				 <td width="18%" align="center">Nomor Klien</td>
      				 <td width="28%" align="center">Hubungan</td>
              </tr>

              <tr>
      				 <td align="center"><input type="button"  value="..." class="buton" onClick="javascript:Pempol(this.form);"></td>
      				 <td class="verdana8">Pemegang Polis</td>
      				 <td align="center"><input type="text" name="pempolnama" size="40" readonly  class="a"></td>
      				 <td align="center"><input type="text" name="pempolno" size="10" maxlength="10" readonly class="a"></td>
      				 <td align="center"><input type="text" name="pempolhub" size="25" readonly class="a"></td>
              </tr>

              <tr>
      				 <td align="center"><input type="button"  value="..." class="buton" onClick="javascript:Pempre(this.form);"></td>
      				 <td class="verdana8">Pembayar Premi</td>
      				 <td align="center"><input type="text" name="pemprenama" size="40" readonly  class="a"></td>
      				 <td align="center"><input type="text" name="pempreno" size="10" maxlength="10" readonly class="a"></td>
      				 <td align="center"><input type="text" name="pemprehub" size="25" readonly class="a"></td>
              </tr>
            </table>		 
	</td>
	</tr>
	
	<tr>
	 <td class="tblhead" align="center">Penerima Faedah Asuransi / Beneficiary</td>
	</tr>	
	
	<tr class="tblisi">
   	 <td align="center">
         <table border="0" cellpadding="1" cellspacing="1" width="90%"  class="tblisi">
             <tr>
    					 <td width="100%" colspan="5" align="center" class="arial10">
						 <input type="button" class="buton" name="kurang" value="Kurangi Data Beneficiary" onClick="javascript:BeneficiariHapus();">
						 <input type="button" class="buton" name="tambah" value="Tambah Data Beneficiary" onClick="javascript:BeneficiariTambah();"></td>
							</tr>	

              <tr class="tblhead1">
      				 <td width="6%" align="center">Klik</td>
      				 <td width="6%" align="center">Nomor</td>
      				 <td width="41%" align="center">Nama</td>
      				 <td width="14%" align="center">Nomor Klien</td>
      				 <td width="32%" align="center">Hubungan</td>
              </tr>
			  <tr id="pret1" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=1&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no1" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno1" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan1" readonly class="a" style="width:100%"></td>
				</tr>
				<tr id="pret2" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=2&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no2" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama2" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno2" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan2" readonly class="a" style="width:100%"></td>
				</tr>
				<tr id="pret3" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=3&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no3" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama3" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno3" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan3" readonly class="a" style="width:100%"></td>
				</tr>
				<tr id="pret4" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=4&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no4" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama4" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno4" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan4" readonly class="a" style="width:100%"></td>
				</tr>
				<tr id="pret5" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=5&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no5" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama5" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno5" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan5" readonly class="a" style="width:100%"></td>
				</tr>
				<tr id="pret6" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=6&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no6" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama6" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno6" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan6" readonly class="a" style="width:100%"></td>
				</tr>
				<tr id="pret7" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=7&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no7" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama7" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno7" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan7" readonly class="a" style="width:100%"></td>
				</tr>
				<tr id="pret8" style="display:none">
					<td align="center"><input class="buton" type="button" value="Cari" onclick="NewWindow('../proposal/insurable.php?n=8&c='+document.ntryprop.notertanggung.value,'popuppage',600,400,1);" onmouseover="window.status='Klik untuk menambah data beneficiary'" onmouseout="window.status=''" /></td>
					<td><input type="text" name="no8" maxlength="1" size="1" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="nama8" readonly class="a" style="width:100%"></td>
					<td><input type="text" name="klienno8" maxlength="10" readonly class="a"  style="width:100%"></td>
					<td><input type="text" name="hubungan8" readonly class="a" style="width:100%"></td>
				</tr>
							<!--tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret1 style="position:relative;"></span></td>
							</tr>	
							<tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret2 style="position:relative;"></span></td>
							</tr>	
							<tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret3 style="position:relative;"></span></td>
							</tr>	
							<tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret4 style="position:relative;"></span></td>
							</tr>	
							<tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret5 style="position:relative;"></span></td>
							</tr>	
							<tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret6 style="position:relative;"></span></td>
							</tr>	
							<tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret7 style="position:relative;"></span></td>
							</tr>	
							<tr>
    					 <td width="100%" colspan="5" align="center"><span id=pret8 style="position:relative;"></span></td>
							</tr-->	

				</table>
		 </td>				
	<tr>
	
	<tr>
	 <td class="tblhead" align="center">Premi dan Uang Asuransi</td>
	</tr>	
	
	<tr>
	<td>
	 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tblisi">
	 <tr>
	 <td colspan="4"><div id="ketnilai"><div>
	 </td>
	 </tr>
	 <tr>
   	 <td width="15%" class="arial10">
		   <select size="1" name="premijua" onChange="javascript:JuaPremi();" class="c">
    		 <option value="jua">Entry JUA</option>
				 <option value="premi" selected>Entry Premi</option>
       </select>
		 </td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="nilai" size="15" maxlength="15" onBlur="javascript:JuaPremi();MaxJuaPremi();"  class="c"></td>
   	 <td width="42%" colspan="3" class="arial10"><input type="button" name="buton" value=".." onClick="javascript:HitungJUA();" class="buton"></td>
   </tr>
   <tr>
   	 <td width="42%" colspan="3" class="arial10"><span id=kam style="position:relative;"></span></td>
   	 <td width="20%" class="arial10">Premi Setelah 5 Tahun</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="premi2" size="10" maxlength="10" readonly  class="a" value="<? echo $p2; ?>"></td>
	 </tr>
	 </table>
	</td>
  </tr>
	
	<tr>
	 <td class="tblhead" align="center">Informasi lainnya</td>
	</tr>	
	
	<tr class="tblisi">
   	 <td>
	 No. Rekening 
			 <!--<select size="1" name="kdbank" class="c" onChange="GetPenagihAutoDebet(document.ntryprop)">-->
             <select size="1" name="kdbank" class="c">
			  <option value=''>--pilih--</option>
			  <?
        $sql = "select kdbank,namabank from $DBUser.tabel_399_bank where kdbank<>'POS' and kdstatus='1' order by namabank";
      	$DB->parse($sql);
      	$DB->execute();
      	while($arr=$DB->nextrow()){
      	  echo("<option value=".$arr["KDBANK"].">".$arr["NAMABANK"]."</option>");
      	}			 
      ?>
			 </select>
			 <input type="text" name="norekening" onBlur="ValDigitAutoDebet(this.form.norekening)" size="15" maxlength="19"><br/>
		 <font face="arial" size="2">
		 <input type="checkbox" name="premiumholiday" value="1"> Setuju Premium Holiday?   
		 Tgl. Transfer <input type="text" name="tgltransfer" size="10" maxlength="10" class="c" onBlur="convert_date(tgltransfer);cektransfer();return cek_masapremi();"> 
		 Jumlah Transfer <input type="text" name="jmltransfer" size="15" maxlength="15" class="c" onBlur="cektransfer();javascript:convert_date(document.ntryprop.akhirpremi);javascript:convert_date(document.ntryprop.expirasi);"> 
		 </font>
		 </td>
	</td>
	
  <tr>
   	 <td width="100%" class="tblhead" align="center">
		  <input  type="button" value="Polis Lain Yg Dimiliki" name="cekpolis" onClick="return CekPolis()" class="buton">
		  <input name="submit" type="submit" value="Submit" class="buton" >
		 </td>
  </tr>
</table>
<? 
/*   $hostname  = "localhost"; 
  $username	 = "jwslanun"; 
  $password	 = "bulunpek53"; 
  $dbname		 = "jwslanun";  */ 
  $hostname  = "localhost"; 
  $username	 = "root"; 
  $password	 = "bulunpekpepitu"; 
  $dbname		 = "jwslanun";
  @mysql_connect($hostname, $username, $password) or die("Couldn't connect to server"); 
  @mysql_select_db($dbname) or die("Unable to select database"); 
  	
  include_once ("../../includes/usersOnline.class.php");
  $visitors_online = new usersOnline($userid,$kantor);
	
include "footer.php"; ?>
</body>
</html>