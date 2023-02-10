<? 
  include "includes/session.php";
  include "includes/roleptg.php";
  include "includes/database.php";
	include "includes/propmtc.php";
	include "includes/starttimer.php";
	
	 // $DB=new database($userid, $passwd, $DBName);
		$ary ="select prefixpertanggungan,nopertanggungan,kdstatusemail,kdbank from $DBUser.tabel_200_pertanggungan where ".
		      "nopertanggungan='$nopertanggungan'";
    $DB->parse($ary);
    $DB->execute();
    $arr=$DB->nextrow();
		$statusemail=$arr["KDSTATUSEMAIL"];
		$p=$arr["PREFIXPERTANGGUNGAN"];
		$n=$arr["NOPERTANGGUNGAN"];
		$kb=$arr["KDBANK"];
		
if(!$statusemail=="0"){
 ?>
 <SCRIPT LANGUAGE="JavaScript">
 <!--
  function doFlash() {
    setInterval("txtDiv.filters.glow.enabled = !txtDiv.filters.glow.enabled", 700);
  }
 // -->
 </SCRIPT>
 </head>
 <BODY onLoad="doFlash()">
 <div align=center>
 <?
 echo "<br><br><font face=verdana size=2>";
 echo "Proposal nomor : ".
      "<DIV ID=txtDiv STYLE=\"width:400; filter:glow(color=gold, strength=2, enabled=0)\"><b>$p-$n</b></div> sudah pernah dikirim ke RO.<br>";
 echo "Silakan hubungi RO Saudara untuk mengupdate proposal ini.<br><br>";
 echo "<a href=\"#\" onclick=\"window.history.go(-1);\">Back</a></font>";
 ?>
 </div>
 </body>
 <?
}else{    
?>
<script language="JavaScript" type="text/javascript">
<!--
function CekAutoDebet(theForm) {
 if (theForm.autodebet.checked) {
  theForm.kdbank.disabled=false
	theForm.norekening.disabled=false
	NewWindow('penagih_autodebet.php','pvpage',300,300,1);
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

<body OnLoad="JuaPremi();Awal();selectkdcarabayar();updatekdcarabayar();CallBenef();GantiProduk();" topmargin="0">
<div align="center">
<br>

<table border="0" cellpadding="1" cellspacing="1" width="700" class="tblhead">
  <tr>
	 <td class="tblhead" align="center" width="100%">EDIT PROPOSAL No : <?echo $nopertanggungan;  ?></td>
  </tr>
  
	<tr>
  <td width="100%" > <!-- tempat tabel -->

<form name="ntryprop" method="post" action="insprop.php?<? echo $SID; ?>" onSubmit="return OnSumbit(document.ntryprop);disableForm(this);">
	<input type="hidden" name="vara" value="0">		
	<input type="hidden" name="notasip">		
	<input type="hidden" name="pariabel">
	<input type="hidden" name="mode" value="edit">
	<input type="hidden" name="usia_lpp">
	<input type="hidden" name="lama_min">
	<input type="hidden" name="lama_max">
	<input type="hidden" name="cabar">
	<input type="hidden" name="kdper" value="1">
	<input type="hidden" name="prefixpertanggungan" value="<?echo $kantor;?>">	
  <input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
	<input type="hidden" name="demit"> 
	<input type="hidden" name="maxdemit"> 
	<input type="hidden" name="premistd">
	<input type="hidden" name="risk">	
  									
<?
	if ($nopertanggungan<>''){
	  print( "<input type=\"hidden\" name=\"nopertanggungan\" value=\"".$nopertanggungan."\">" );
	} else {
	  if ($noprop<>''){  
			 print( "<input type=\"hidden\" name=\"nopertanggungan\" value=\"".$noprop."\">" );
	  }
	}
?>
	<table border="0" width="100%" cellspacing="1" cellpadding="1" class="tblisi">
  <tr>
   	 <td class="arial10">No Tertanggung</td>
   	 <td class="arial10">:</td>
   	 <td class="arial10">
		 <input type="text" readonly name="notertanggung" size="10" maxlength="10"  onblur="javascript:validasi10(this.form.notertanggung);nottgOK();" class="a">
		 <input type="button" value="Cari Klien" name="cari" class="buton" onClick="Klear(document.ntryprop);Cari(this.form)"></td>
		 <td class="arial10" align="right">Proposal No</td>
   	 <td class="arial10">:</td>
   	 <td class="arial10"><b><? echo $kantor."-".$nopertanggungan ?></td>
 		 <td class="arial10"></td>
	</tr>

  <tr>
   	 <td width="15%" class="arial10">Nomor SPAJ</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="nosp" size="11" maxlength="11" class="c" title="Nomor SPAJ" onFocus="highlight(event)"></td>
   	 <td width="20%" class="arial10" align="right">Tanggal SPAJ</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="tglsp" size="10" maxlength="10" onBlur="javascript:convert_date(tglsp);" class="c" title="Tanggal Proposal" onFocus="highlight(event)"></td>
		 <td width="16%" class="arial10">
		 <!--<input type="button" value="Hari Ini"  onclick="javascript:tgl2();" onblur="TanggalMulas()" class="buton" title="Klik untuk entry tanggal hari ini">-->
		 </td>
	</tr>
	
	<tr>
	 <td colspan="7">
	<?php 
    $ProdukCaraBayar->printSelectors(); 
	?>
	 </td>
	</tr>
	
  <tr>
   	 <td width="15%" class="arial10">Medical</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input  type="radio" name="kdstatusmedical" value="M" title="Medical">Ya
		 <input  type="radio" name="kdstatusmedical" value="N" title="non Medical" onBlur="javascript:CekTB();">Tidak</td>
   	 <td width="20%" class="arial10"></td>
   	 <td width="2%" class="arial10"></td>
   	 <td width="20%" class="arial10"></td>
		 <td width="16%" class="arial10"></td>
	</tr>
	
  <tr>
   	 <td width="15%" class="arial10">Tgl Mulai Ass</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="mulas" size="10" maxlength="10" onBlur="convert_date(mulas); return usai(ntryprop);"  onchange="javascript:convert_date(mulas);usai(ntryprop);" class="c" onFocus="highlight(event)"></td>
   	 <td width="20%" class="arial10" align="right">Usia</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="ver8ungu"><input type="text" name="usia_th" size="3" maxlength="3" class="a" readonly> tahun</td>
		 <td width="16%" class="arial10">
 		 <input type="text" name="usia_bl" size="2" maxlength="2" class="a" value="0" readonly>bulan
		 </td>
	</tr>

  <tr>
   	 <td width="15%" class="arial10">Lama Premi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="ver8ungu"><input type="text" name="lamapembpremi_th" size="2" maxlength="2"  onfocus="highlight(event)" class="c" onBlur="return cek_masapremi()">tahun
		 <input type="hidden" name="lamapembpremi_bl">
		 <!--tahun<input type="text" name="lamapembpremi_bl" size="2" maxlength="2" class="c" value="0" readonly>-->
		 </td>
   	 <td width="20%" class="arial10" align="right">Akhir Pemb Premi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="akhirpremi" size="10" maxlength="10" class="a" onBlur="javascript:convert_date(akhirpremi);" readonly></td>
		 <td width="16%" class="arial10"></td>
	</tr>

  <tr>
   	 <td width="15%" class="arial10">Lama Asuransi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="ver8ungu">
		  <input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" class="a" readonly>tahun
		  <input type="hidden" name="lamaasuransi_bl">
			<input type="hidden" name="lamapembpremi_th_default">
		 <!-- <input type="text" name="lamaasuransi_bl" size="2" maxlength="2" class="c" value="0" readonly>-->
		 </td>
   	 <td width="20%" class="arial10" align="right">Akhir Ass (Expirasi)</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="expirasi" size="10" maxlength="10" class="a" onBlur="javascript:convert_date(expirasi);" readonly></td>
		 <td width="16%" class="arial10"></td>
	</tr>

	<script type="text/javascript" language="JavaScript"> 
	<?php  
    $ProdukCaraBayar->initialize(); 
	?> 
  </script>
	 <tr>
   	 <td width="15%" class="arial10">Tanggal BP3</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td class="arial10" colspan="2"><input type="text" name="tglbp3" size="10" maxlength="10" class="c" onBlur="convert_date(tglbp3)" onFocus="highlight(event)">&nbsp;&nbsp;(Tanggal BS/BM)</td>
   	 <td width="38%" class="a" colspan="3"><input type="checkbox" name="bpo" value="1">Setuju Gadai Polis Otomatis</td>
	</tr>	
  <tr>
   	 <td width="15%" class="arial10">Kode Valuta</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="45%" colspan="2" class="arial10">
		 <select size="1" name="kdvaluta" onChange="return IndexAwal(document.ntryprop);" onBlur="return IndexAwal(document.ntryprop);" onFocus="highlight(event)" class="c">
    <?
    	$sql = "select kdjeniscb from $DBUser.tabel_305_cara_bayar ".
    		   	 "where kdcarabayar='$cabar'";
    	$DB->parse($sql);
    	$DB->execute();
    	$arr=$DB->nextrow();
    	$kdjeniscb = $arr["KDJENISCB"];

      $sql = "select kdvaluta,namavaluta from $DBUser.tabel_304_valuta b ".
     			   "where kdvaluta in (select kdvaluta from $DBUser.tabel_233_produk_cb_val ".
    					"where 	kdproduk='$kdpro' and cara=decode('$cabar','M','M','Q','Q','H','H','A','A','$kdjeniscb')) ";
    	//echo $sql;			 
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
	<!-- auto debet -->
	<tr>
 	 	 <td colspan="7" class="arial10">
		 <fieldset style="padding: 5px;"> <!--<legend>Auto Debet</legend>-->
		   <input type="checkbox" name="autodebet" value="1" onClick="CekAutoDebet(document.ntryprop)"> Auto Debet? &nbsp;&nbsp;&nbsp;&nbsp;
			 No. Rekening 
			 <select size="1" name="kdbank" class="c" onChange="GetPenagihAutoDebet(document.ntryprop)">
			  <?
        $sql = "select kdbank,namabank from $DBUser.tabel_399_bank order by namabank";
      	$DB->parse($sql);
      	$DB->execute();
      	while($arr=$DB->nextrow()){
				  if($kb==$arr["KDBANK"])
					{
      	   echo("<option value=".$arr["KDBANK"]." selected>".$arr["NAMABANK"]."</option>");
      	  }
					else
					{
					 echo("<option value=".$arr["KDBANK"].">".$arr["NAMABANK"]."</option>");
					}
				}			 
      ?>
			 </select>
			 <input type="text" name="norekening" onBlur="ValDigitAutoDebet(this.form.norekening)" size="20" maxlength="19">
		 </fieldset>	
		 </td>
	</tr>
  <tr>
   	 <td width="15%" class="arial10">Nomor BP3</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="nobp3" size="12" maxlength="12" title="Nomor BP3" class="c" onFocus="highlight(event)"></td>
   	 <td width="20%" class="arial10" align="right">Nomor Agen</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10">
		  <input type="text" name="noagen" size="10" maxlength="10" readonly title="Nomor Agen" class="a">
		 </td>
		 <td width="16%" class="arial10">
		 	<input type="button" value="Cari  A g e n"  onclick="NewWindow('agnlist.php','popuppage',600,400,1);" class="buton">
		 </td>
	</tr>
  <tr>
 	 	 <td width="15%" class="arial10">Kurs/Index Awal</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="indexawal" size="6" readonly value="1" class="a" ></td>
   	 <td width="20%" class="arial10" align="right">Penagih</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10">
		  <input type="text" name="nopenagih" size="10" maxlength="10" readonly class="a">
		 </td>
		 <td width="16%" class="arial10">
		 	<input type="button" value="Cari Penagih" onClick="PopPenagih()" class="buton">
		 </td>
	</tr>
	</table>
	
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
	   					 <input type="button" class="buton" name="kurang" value="Kurangi Data Beneficiary" onClick="javascript:BeneficiariDel();">
	 	 					 <input type="button" class="buton" name="tambah" value="Tambah Data Beneficiary" onClick="javascript:Beneficiari();"></td>
							</tr>	

              <tr class="tblhead1">
      				 <td width="6%" align="center">Klik</td>
      				 <td width="6%" align="center">Nomor</td>
      				 <td width="41%" align="center">Nama</td>
      				 <td width="14%" align="center">Nomor Klien</td>
      				 <td width="32%" align="center">Hubungan</td>
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
	 <td class="tblhead" align="center">Premi dan Uang Asuransi</td>
	</tr>	

	<tr>
	<td width="100%">
	 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tblisi">
   <tr>
   	 <td width="15%" class="arial10">
		   <select size="1" name="premijua" onChange="javascript:JuaPremi();" class="c">
    				 <option value="jua">Entry JUA</option>
						 <option value="premi">Entry Premi</option>
       </select>
		 </td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="nilai" size="15" maxlength="15" onBlur="javascript:JuaPremi();"  class="c"></td>
   	 <td width="42%" colspan="3" class="arial10"><input type="button" name="buton" value=".." onClick="javascript:HitungJUA();" class="buton"></td>
   </tr>

   <tr>
   	 <td width="42%" colspan="3" class="arial10"><span id=kam style="position:relative;"></span></td>
		 <td width="20%" class="arial10">Premi Setelah 5 Tahun</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10" align="left"><input type="text" name="premi2" size="10" maxlength="10" readonly  class="a"></td>
	 </tr>
	 </table> 
	</td>
  </tr>
	
  <tr>
   	 <td width="100%" class="tblhead" align="center">
		  <input  type="button" value="Polis Lain Yg Dimiliki" name="cekpolis" onClick="return CekPolis()" class="buton">
		  <input name="submit" type="submit" value="Submit" class="buton">
		 </td>
  </tr>
	
</table>

<? include "footer.php"; ?>
</body>
</html>
<? }
  include "includes/endtimer.php"; 
?>