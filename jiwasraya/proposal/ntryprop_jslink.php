<? 
  include "../../includes/session.php";
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
//	}
//	else{
		$stat="and c.status is null ";
		$stats="status is null" ;
//	}
/*----- End of Tambahan oleh Ari 24/06/2008 sesuai Nota Intern Divisi URC tgl 23/06/2008 Perihal Izin Entry Proposal ----------*/
			
	  	  $Query= "select ".
								"a.kdcarabayar, b.kdproduk, a.namacarabayar,".
								"c.namaproduk,c.usia_lpp,c.variabel,".
								"c.lama_min,c.lama_max ".
	          "from ".
								"$DBUser.tabel_233_produk_cara_bayar b, ".
								"$DBUser.tabel_305_cara_bayar a, ".
								"$DBUser.tabel_202_produk c, ".
								"$DBUser.tabel_202_produk_kantor d ".
			  		"where ".
						    "substr(c.kdproduk,1,3)='JL2' and ".
						    "c.kdproduk=d.kdproduk and d.kdkantor='$kantor' and ".
								"a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk ".
								$stat.
						"order by c.kdproduk,a.namacarabayar";
		//echo $Query;
		$DB->parse($Query);
	  $DB->execute();
  	while ($row=$DB->nextrow()) {
	    $nama = $row[KDPRODUK]."  --  ".$row[NAMAPRODUK];
			$selectorData[] = array(																 		
				CS_SOURCE_ID=>$row[KDPRODUK],   
        CS_SOURCE_LABEL=>$nama,  
				CS_TARGET_ID=>$row[KDCARABAYAR],  
				CS_TARGET_LABEL=>$row[NAMACARABAYAR]
			);
		}				
	$Query="select kdproduk,namaproduk,usia_lpp,variabel,lama_min,lama_max from ".
	       "$DBUser.tabel_202_produk where substr(kdproduk,1,3)='JL2' and ".$stats;
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
//kd	$ProdukCaraBayar = new chainedSelectors($selectorNames,$selectorData,$addendum);
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<style type="text/css">
<!-- 
body {
  font-family: Verdana;
	font-size: 12px;
} 

td {
	font-size: 12px;
} 

select {
	font-size: 12px;
} 

input {
	font-size: 12px;
} 

.button{
  width: 100px;
	padding : 4px 4px 4px 4px;
}

.tblframe{
	background-color: #dddddd;
	border: solid 1px  #c0c0c0;
}
.tblhead{
	background-color: #c0c0c0;
  height:25px;
}

.tblframe td{
  padding:2px;
}

.tblisi td{
  padding:1px;
}

.a{
 margin:4px;
}

a{
 text-decoration:none;
 color: #0072a8;
 font-size:11px;
}

a:hover{
 color: #b9dcff;
}
-->
</style>
<? 
	$sql="select to_char(sysdate,'DD/MM/YYYY') tanggal from dual";
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
<script language="JavaScript" type="text/javascript">
<?php
//kd  $ProdukCaraBayar->printUpdateFunction(); 
?> 
</script> 
<?
  echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  print( "<!--\n" );
  print( "\n" );
  print ( "function Initial(){ \n" );
  //print ( " document.ntryprop.buton.disabled=true;\n" );
  print ( " document.ntryprop.cekpolis.disabled=true;\n" );
  if ($gotom=='1') {
 	 print( "document.ntryprop.bpo.checked ='TRUE';\n" );
	}
  //print( "document.ntryprop.nilai.value ='".$jua."';\n" );
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
  if (field.value.length > 0){
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
<body OnLoad="document.ntryprop.nosp.focus(); document.ntryprop.premijua.value='premi'; JuaPremi(); document.ntryprop.submit.disabled=true;Initial();document.ntryprop.kdbank.disabled=true;document.ntryprop.norekening.disabled=true;" topmargin="0">
<?
    $sql = "select kdproduk,namaproduk,usia_lpp,variabel,lama_min,lama_max from ".
	       		"$DBUser.tabel_202_produk where kdproduk='".$kdproduk."'";
    $DB->parse($sql);
    $DB->execute();
    $raw=$DB->nextrow();
		$kdproduk = $raw["KDPRODUK"];
		$namaproduk = $raw["NAMAPRODUK"];
		$pariabel = $raw["VARIABEL"];
		$usia_lpp = $raw["USIA_LPP"];
		$lama_min = $raw["LAMA_MIN"];
		$lama_max = $raw["LAMA_MAX"];
?>
<div align="center">
<br>
<table border="0" cellpadding="1" cellspacing="1" width="90%" class="tblframe">
	<tr>
		<td class="tblhead" align="center" width="100%"><b>ENTRY PROPOSAL JS.LINK (SWITCHING)</b></td>
  </tr>
	<tr>
	
	<td width="100%">  
        <form name="ntryprop" method="post" action="insprop.php?<? echo $SID; ?>" onSubmit="return OnSumbit(document.ntryprop);disableForm(this);">
      	<input type="hidden" name="mode" value="baru">
      	<input type="hidden" name="vara" value="0">
      	<input type="hidden" name="pariabel" value="<?=$pariabel;?>">
      	<input type="hidden" name="usia_lpp" value="<?=$usia_lpp;?>">
      	<input type="hidden" name="lama_min" value="<?=$lama_min;?>">
      	<input type="hidden" name="lama_max" value="<?=$lama_max;?>">
      	<input type="hidden" name="notasip">
      	<input type="hidden" name="kdper" value="1">
      	<input type="hidden" name="prefixpertanggungan" value="<?echo $kantor;?>">
      	<input type="hidden" name="nopertanggungan" value="<? echo $nopert; ?>">
      	<input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
      	<input type="hidden" name="premistd">
      	<input type="hidden" name="demit"> 
      	<input type="hidden" name="maxdemit">
      	<input type="hidden" name="risk">
				<input type="hidden" name="nosiptebus" value="<?=$nosiptebus; ?>">
				<input type="hidden" name="prefix" value="<?=$prefix; ?>">
				<input type="hidden" name="noper" value="<?=$noper; ?>">
						 
      	<table border="0" width="100%" cellspacing="0" cellpadding="1" class="tblisi">
        <tr>
         	 <td>No Tertanggung</td>
         	 <td>:</td>
         	 <td colspan="4">
      		 <input type="text" readonly name="notertanggung" size="10"  maxlength="10" value="<? echo $nottg; ?>">
      		 <? 
      		 $sql = "select namaklien1 from $DBUser.tabel_100_klien where noklien='$nottg'";
      		 $DB->parse($sql);
           $DB->execute();
      		 $nkl=$DB->nextrow();
      		 echo $nkl["NAMAKLIEN1"];
      		 ?>
         	 <td class="arial10blk">Prefix :<? echo $kantor ?></td>
      	</tr>
        <tr>
         	 <td width="15%">Nomor SPAJ</td>
         	 <td width="2%">:</td>
         	 <td width="25%"><input type="text" name="nosp" size="11" maxlength="11" title="Nomor SPAJ" onFocus="highlight(event)"  onBlur="javascript:TanggalMulas()" value="<? echo $nosp; ?>"></td>
         	 <td width="20%" align="right">Tanggal SPAJ</td>
         	 <td width="2%">:</td>
         	 <td width="20%"><input type="text" name="tglsp" size="10" maxlength="10" onBlur="javascript:convert_date(tglsp);CekAwalMulas(document.ntryprop);" title="Tanggal Proposal" onFocus="highlight(event)" value="<? echo $tanggal; ?>"></td>
      		 <td width="16%">
      		 </td>
      	</tr>
        <?//$ProdukCaraBayar->printSelectors();?>
        <tr>
         	 <td width="15%">Produk</td>
         	 <td width="2%">:</td>
         	 <td width="25%" colspan="5">
      		 <input type="hidden" name="kdproduk" value="<?=$kdproduk;?>">
      		 <? 
      		 echo $kdproduk." - ".$namaproduk;
      		 ?>
      		 </td>
      	</tr>
      	<tr>
         	 <td width="15%">Cara Bayar</td>
         	 <td width="2%">:</td>
         	 <td width="25%" colspan="5">
      		 <select name="kdcarabayar" onFocus="highlight(event)" onBlur="ProdukValuta(this.form)" >
      		 <? 
      		 $sql = "select a.kdcarabayar, a.namacarabayar ".
                     "from $DBUser.tabel_233_produk_cara_bayar b,".
                         "$DBUser.tabel_305_cara_bayar a ".
                   "where b.kdproduk = '".$kdproduk."' ".
                     "and a.kdcarabayar = b.kdcarabayar ".
                		 "order by  a.namacarabayar";
      		 //echo $sql;
      		 $DB->parse($sql);
           $DB->execute();
      		 while($arr=$DB->nextrow()){
            	  echo "<option value=".$arr["KDCARABAYAR"].">".$arr["NAMACARABAYAR"]."</option>";
           }		
      		 ?>
      		 </select>
      		 </td>
      	</tr>
      	
        <tr>
         	 <td width="15%">Medical</td>
         	 <td width="2%">:</td>
         	 <td width="25%">
      		   <input type="radio" name="kdstatusmedical" value="M" title="Medical" onChange="protectMed()">Ya
      		   <input  type="radio" name="kdstatusmedical" value="N" title="non Medical" checked="checked" onBlur="javascript:CekTB();">Tidak
      		 </td>
         	 <td width="20%"></td>
         	 <td width="2%"></td>
         	 <td width="20%"></td>
      		 <td width="16%"></td>
      	</tr>
        <tr>
         	 <td width="15%">Tgl Mulai Ass</td>
         	 <td width="2%">:</td>
         	 <td width="25%"><input type="text" name="mulas" size="10" maxlength="10" onBlur="javascript:convert_date(mulas);HitungUsia(document.ntryprop);CekAwalMulas(document.ntryprop);" onFocus="highlight(event)" value="<? echo $mulas; ?>"></td>
         	 <td width="20%" align="right">Usia</td>
         	 <td width="2%">:</td>
         	 <td width="20%" class="ver8ungu"><input type="text" name="usia_th" size="3" maxlength="3" readonly  value="<? echo $usith; ?>" onBlur="javascript:CekUsiaCabar();"> tahun</td>
      		 <td width="16%" class="ver8ungu">
       		 <input type="text" name="usia_bl" size="3" maxlength="3" readonly  value="<? echo $usibl; ?>">bulan
      		 </td>
      	</tr>
        <tr>
         	 <td width="15%">Lama Premi</td>
         	 <td width="2%">:</td>
         	 <td width="25%" class="ver8ungu"><input type="text" name="lamapembpremi_th" size="2" maxlength="2"  onfocus="highlight(event)" onBlur="return cek_masapremi()"  value="<? echo $lprth; ?>"> tahun
      		 <input type="hidden" name="lamapembpremi_bl"  value="<? echo $lprbl; ?>">
      		 <input type="hidden" name="lamapembpremi_th_default" value="<? echo $lprth; ?>">
      		 </td>
         	 <td width="20%" align="right">Akhir Pemb Premi</td>
         	 <td width="2%">:</td>
         	 <td width="20%"><input type="text" name="akhirpremi" size="10" maxlength="10" onBlur="javascript:convert_date(akhirpremi);" readonly value="<? echo $akhpr; ?>"></td>
      		 <td width="16%"></td>
      	</tr>
        <tr>
         	 <td width="15%">Lama Asuransi</td>
         	 <td width="2%">:</td>
         	 <td width="25%" class="ver8ungu">
      		  <input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" readonly value="<? echo $lamth; ?>"> tahun
      		  <input type="hidden" name="lamaasuransi_bl" value="<? echo $lambl; ?>">
      		 </td>
         	 <td width="20%" align="right">Akhir Ass (Expirasi)</td>
         	 <td width="2%">:</td>
         	 <td width="20%"><input type="text" name="expirasi" size="10" maxlength="10" onBlur="javascript:convert_date(expirasi);" readonly value="<? echo $expir; ?>"></td>
      		 <td width="16%"></td>
      	</tr>
      	<script type="text/javascript" language="JavaScript"> 
      	<?php
        //kd  $ProdukCaraBayar->initialize(); 
      	?> 
        </script>
        <tr>
         	 <td width="15%">Tanggal BP3</td>
         	 <td width="2%">:</td>
         	 <td colspan="2"><input type="text" name="tglbp3" size="10" maxlength="10" onBlur="convert_date(tglbp3)" onFocus="highlight(event)" value="<? echo $tgbp3; ?>">&nbsp;&nbsp;(Tanggal BS/BM)</td>
         	 <td width="38%" colspan="3"><input type="checkbox" name="bpo" value="1">Setuju Gadai Polis Otomatis</td>
      	</tr>
        <tr>
         	 <td width="15%">Kode Valuta</td>
         	 <td width="2%">:</td>
         	 <td width="45%" colspan="2"><select size="1" name="kdvaluta" onChange="return IndexAwal(document.ntryprop);" onBlur="return IndexAwal(document.ntryprop);" onFocus="highlight(event)">
            <?
              $sql = "select a.kdvaluta,b.namavaluta from $DBUser.tabel_234_produk_valuta a, $DBUser.tabel_304_valuta b ".
            			   "where a.kdvaluta=b.kdvaluta and a.kdproduk=(select min(kdproduk) from $DBUser.tabel_202_produk) ";
            	$DB->parse($sql);
            	$DB->execute();
            	while($arr=$DB->nextrow()){
            	  echo("<option value=".$arr["KDVALUTA"].">".$arr["NAMAVALUTA"]."</option>");
            	}			 
            ?>
      		</select></td>
         	 <td width="2%"></td>
         	 <td width="20%"></td>
      		 <td width="16%"></td>
      	</tr>
      	
        <!-- autodebet start -->
      	<tr>
         	 <td colspan="7">
      		 <fieldset style="padding: 5px;"> <!--<legend>Auto Debet</legend>-->
      		   <input type="checkbox" name="autodebet" value="1" onClick="CekAutoDebet(document.ntryprop)"> Auto Debet? &nbsp;&nbsp;&nbsp;&nbsp;
      			 No. Rekening 
      			 <select size="1" name="kdbank" onChange="GetPenagihAutoDebet(document.ntryprop)">
      			  <option>--pilih--</option>
      			  <?
              $sql = "select kdbank,namabank from $DBUser.tabel_399_bank order by namabank";
            	$DB->parse($sql);
            	$DB->execute();
            	while($arr=$DB->nextrow()){
            	  echo("<option value=".$arr["KDBANK"].">".$arr["NAMABANK"]."</option>");
            	}			 
            ?>
      			 </select>
      			 <input type="text" name="norekening" onBlur="ValDigitAutoDebet(this.form.norekening)" size="15" maxlength="19">
      		 </fieldset>	
      		 </td>
      	</tr>
      	<!-- end outodebet -->
      	
      	<tr>
         	 <td width="15%">Nomor BP3</td>
         	 <td width="2%">:</td>
         	 <td width="25%"><input type="text" name="nobp3" size="12" maxlength="12" title="Nomor BP3" onFocus="highlight(event)" value="<? echo $nobp3; ?>"></td>
         	 <td width="20%" align="right">Nomor Agen</td>
         	 <td width="2%">:</td>
         	 <td width="20%">
      		  <input type="text" name="noagen" size="10" maxlength="10" readonly title="Nomor Agen" value="<? echo $noagn; ?>">
      		 </td>
      		 <td width="16%">
      		 	<input type="button" value="Cari  A g e n"  onclick="NewWindow('agnlist.php','popuppage',600,400,1);" class="buton">
      		 </td>
      	</tr>
        <tr>
       	 	 <td width="15%">Kurs/Index Awal</td>
         	 <td width="2%">:</td>
         	 <td width="25%"><input type="text" name="indexawal" size="6" readonly value="1" value="<? echo $idxaw; ?>"></td>
         	 <td width="20%" align="right">Penagih</td>
         	 <td width="2%">:</td>
         	 <td width="20%">
      		  <input type="text" name="nopenagih" size="10" maxlength="10" readonly value="<? echo $nopng; ?>">
      		 </td>
      		 <td width="16%">
      		 	<input type="button" value="Cari Penagih"  onclick="PopPenagih()" class="buton">
      		 </td>
      	</tr>
      </table>

	</td>
	</tr>
	
	<tr>	
		 <td class="tblhead"><b>Pemegang Polis Dan Pembayar Premi</b></td>
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
      				 <td align="center"><input type="text" name="pempolnama" size="40" readonly ></td>
      				 <td align="center"><input type="text" name="pempolno" size="10" maxlength="10" readonly></td>
      				 <td align="center"><input type="text" name="pempolhub" size="25" readonly></td>
              </tr>

              <tr>
      				 <td align="center"><input type="button"  value="..." class="buton" onClick="javascript:Pempre(this.form);"></td>
      				 <td class="verdana8">Pembayar Premi</td>
      				 <td align="center"><input type="text" name="pemprenama" size="40" readonly ></td>
      				 <td align="center"><input type="text" name="pempreno" size="10" maxlength="10" readonly></td>
      				 <td align="center"><input type="text" name="pemprehub" size="25" readonly></td>
              </tr>
            </table>		 
	</td>
	</tr>
	
	<tr>
	 <td class="tblhead"><b>Penerima Faedah Asuransi / Beneficiary</b></td>
	</tr>	
	
	<tr class="tblisi">
   	 <td align="center">
         <table border="0" cellpadding="1" cellspacing="1" class="tblisi">
             <tr>
    					 <td colspan="5" align="center">
	   					 <input type="button" class="buton" name="kurang" value="Kurangi Data Beneficiary" onClick="javascript:BeneficiariDel();">
	 	 					 <input type="button" class="buton" name="tambah" value="Tambah Data Beneficiary" onClick="javascript:Beneficiari();"></td>
							</tr>	

              <tr class="tblhead1">
      				 <td align="center">Klik</td>
      				 <td align="center">Nomor</td>
      				 <td align="center">Nama</td>
      				 <td align="center">Nomor Klien</td>
      				 <td align="center">Hubungan</td>
              </tr>
							<tr>
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
							</tr>	
							
				</table>
		 </td>				
	<tr>
	
	<tr>
	 <td class="tblhead"><b>Premi dan Uang Asuransi</b></td>
	</tr>	
	
	<tr>
	<td>

    	 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tblisi">
    	 <tr>
       	 <td>
				   <input type="hidden" name="premijua" value="premi">
					 <input type="hidden" name="nilai" value="<?=$ntbs;?>">
					 Premi : Rp. <?=number_format($ntbs,2,',','.');?>
					 <input type="button" name="buton" value="HITUNG JUA" onClick="javascript:HitungJUA();" class="buton">
					 <!--
    		   <select size="1" name="premijua" onChange="javascript:JuaPremi();">
        		 <option value="jua">Entry JUA</option>
    				 <option value="premi">Entry Premi</option>
           </select>
    			 : 
					 <input type="text" name="nilai" size="15" value="<?=$ntbs;?>" maxlength="15" onBlur="javascript:JuaPremi();MaxJuaPremi();" >
    		   <input type="button" name="buton" value=".." onClick="javascript:HitungJUA();" class="buton">
    		   -->
				 </td>
    
       	 <td>
    		 <span id=kam style="position:relative;"></span>
       	 Premi Setelah 5 Tahun : <input type="text" name="premi2" size="20" maxlength="10" readonly  value="<? echo $p2; ?>">
    		 </td>
    	 </tr>
    	 </table>
	 
	</td>
  </tr>
  <tr>
   	 <td width="100%" class="tblhead" align="center">
		  <input  type="button" value="Polis Lain Yg Dimiliki" name="cekpolis" onClick="return CekPolis()" class="buton">
		  <input name="submit" type="submit" value="Submit" class="buton" >
		 </td>
  </tr>
</table>
<? include "footer.php"; ?>
</body>
</html>