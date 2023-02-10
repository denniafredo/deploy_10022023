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

	  $Query= "select a.kdcarabayar, b.kdproduk, a.namacarabayar,c.namaproduk,c.usia_lpp,c.variabel,c.lama_min,c.lama_max ".
	          "from $DBUser.tabel_233_produk_cara_bayar b, $DBUser.tabel_305_cara_bayar a, $DBUser.tabel_202_produk c ".
			  		"where a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk ".
						"and c.status is null ".
						"order by c.kdproduk,a.namacarabayar";
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
	       "$DBUser.tabel_202_produk where status is null";
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
<link href="../../includes/newjws.css" rel="stylesheet" type="text/css">
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
<script language="JavaScript" type="text/javascript">
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
</head>
<body OnLoad="document.ntryprop.submit.disabled=true;Initial()" topmargin="0">
<div align="center">
<br>
<table border="1" cellpadding="4" style="border-collapse: collapse" bordercolor="#83B7EB" id="AutoNumber3" width="700">
	<tr>
		<td align="center" width="100%" bgcolor="#83B7EB"><b>ENTRY PROPOSAL BARU</b></td>
  </tr>
	<tr>
  	<td width="100%" bgcolor="#d9ebf4"> <!-- tempat tabel -->
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
    	<input type="hidden" name="premistd">
    	<input type="hidden" name="demit"> 
    	<input type="hidden" name="maxdemit">
    	<input type="hidden" name="risk">
    		 
    	<table border="0" width="100%" cellspacing="0" cellpadding="1">
      <tr>
       	 <td>No Tertanggung</td>
       	 <td>:</td>
       	 <td>
    		 <input type="text" readonly name="notertanggung" size="10"  maxlength="10" value="<? echo $nottg; ?>">
    		 <input type="button" value="Cari Klien" name="cari" class="buton" onclick="Klear(document.ntryprop);Cari(this.form);" onblur="javascript:TanggalMulas()" ></td>
    		 <td align="right">Prefix</td>
       	 <td>:</td>
       	 <td class="arial10blk"><? echo $kantor ?></td>
       	 <td></td>
    	</tr>
      <tr>
       	 <td width="15%">Nomor SPAJ</td>
       	 <td width="2%">:</td>
       	 <td width="25%"><input type="text" name="nosp" size="11" maxlength="11" title="Nomor SPAJ" onfocus="highlight(event)" value="<? echo $nosp; ?>"></td>
       	 <td width="20%" align="right">Tanggal SPAJ</td>
       	 <td width="2%">:</td>
       	 <td width="20%"><input type="text" name="tglsp" size="10" maxlength="10" onblur="javascript:convert_date(tglsp);" title="Tanggal Proposal" onfocus="highlight(event)" value="<? echo $tanggal; ?>"></td>
    		 <td width="16%">
    		 <!--<input type="button" value="Hari Ini"  onclick="javascript:tgl2();" onblur="TanggalMulas()" class="buton" title="Klik untuk entry tanggal hari ini">-->
    		 </td>
    	</tr>
      <?$ProdukCaraBayar->printSelectors();?>
      <tr>
       	 <td width="15%">Medical</td>
       	 <td width="2%">:</td>
       	 <td width="25%">
    		   <input type="radio" name="kdstatusmedical" value="M" title="Medical" onchange="protectMed()">Ya
    		   <input  type="radio" name="kdstatusmedical" value="N" title="non Medical" checked="checked" onblur="javascript:CekTB();">Tidak
    		 </td>
       	 <td width="20%"></td>
       	 <td width="2%"></td>
       	 <td width="20%"></td>
    		 <td width="16%"></td>
    	</tr>
      <tr>
       	 <td width="15%">Tgl Mulai Ass</td>
       	 <td width="2%">:</td>
       	 <td width="25%"><input type="text" name="mulas" size="10" maxlength="10" onblur="javascript:convert_date(mulas);HitungUsia(document.ntryprop);" onfocus="highlight(event)" value="<? echo $mulas; ?>"></td>
       	 <td width="20%" align="right">Usia</td>
       	 <td width="2%">:</td>
       	 <td width="20%" class="ver8ungu"><input type="text" name="usia_th" size="3" maxlength="3" readonly  value="<? echo $usith; ?>" onblur="javascript:CekUsiaCabar();"> tahun</td>
    		 <td width="16%" class="ver8ungu">
     		 <input type="text" name="usia_bl" size="3" maxlength="3" readonly  value="<? echo $usibl; ?>">bulan
    		 </td>
    	</tr>
      <tr>
       	 <td width="15%">Lama Premi</td>
       	 <td width="2%">:</td>
       	 <td width="25%" class="ver8ungu"><input type="text" name="lamapembpremi_th" size="2" maxlength="2"  onfocus="highlight(event)" onblur="return cek_masapremi()"  value="<? echo $lprth; ?>">tahun
    		 <input type="hidden" name="lamapembpremi_bl"  value="<? echo $lprbl; ?>">
				 <input type="hidden" name="lamapembpremi_th_default" value="<? echo $lprth; ?>">
    		 </td>
       	 <td width="20%" align="right">Akhir Pemb Premi</td>
       	 <td width="2%">:</td>
       	 <td width="20%"><input type="text" name="akhirpremi" size="10" maxlength="10" onblur="javascript:convert_date(akhirpremi);" readonly value="<? echo $akhpr; ?>"></td>
    		 <td width="16%"></td>
    	</tr>
      <tr>
       	 <td width="15%">Lama Asuransi</td>
       	 <td width="2%">:</td>
       	 <td width="25%" class="ver8ungu">
    		  <input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" readonly value="<? echo $lamth; ?>">tahun
    		  <input type="hidden" name="lamaasuransi_bl" value="<? echo $lambl; ?>">
    		 </td>
       	 <td width="20%" align="right">Akhir Ass (Expirasi)</td>
       	 <td width="2%">:</td>
       	 <td width="20%"><input type="text" name="expirasi" size="10" maxlength="10" onblur="javascript:convert_date(expirasi);" readonly value="<? echo $expir; ?>"></td>
    		 <td width="16%"></td>
    	</tr>
    	<script type="text/javascript" language="JavaScript"> 
    	<?php   
        $ProdukCaraBayar->initialize(); 
    	?> 
      </script>
      <tr>
       	 <td width="15%">Tanggal BP3</td>
       	 <td width="2%">:</td>
       	 <td colspan="2"><input type="text" name="tglbp3" size="10" maxlength="10" onblur="convert_date(tglbp3)" onfocus="highlight(event)" value="<? echo $tgbp3; ?>">&nbsp;&nbsp;(Tanggal BS/BM)</td>
       	 <td width="38%" colspan="3"><input type="checkbox" name="bpo" value="1">Setuju Gadai Polis Otomatis</td>
    	</tr>
      <tr>
       	 <td width="15%">Kode Valuta</td>
       	 <td width="2%">:</td>
       	 <td width="45%" colspan="2"><select size="1" name="kdvaluta" onchange="return IndexAwal(document.ntryprop);" onblur="return IndexAwal(document.ntryprop);" onfocus="highlight(event)" class="dropdown">
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
       <tr>
       	 <td width="15%">Nomor BP3</td>
       	 <td width="2%">:</td>
       	 <td width="25%"><input type="text" name="nobp3" size="12" maxlength="12" title="Nomor BP3" onfocus="highlight(event)" value="<? echo $nobp3; ?>"></td>
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
		 <td align="center" bgcolor="#badaeb"><b>Pemegang Polis Dan Pembayar Premi</b></td>
	</tr>	
	
  <tr>
  		 	 <td align="center" bgcolor="#d9ebf4">
            <table border="0" cellpadding="1" cellspacing="1" width="100%">
              <tr class="tblhead1">
      				 <td width="8%" align="center">Klik</td>
      				 <td width="18%" align="center">Insurable</td>
      				 <td width="28%" align="center">Nama</td>
      				 <td width="18%" align="center">Nomor Klien</td>
      				 <td width="28%" align="center">Hubungan</td>
              </tr>

              <tr>
      				 <td align="center"><input type="button"  value="..." class="buton" onclick="javascript:Pempol(this.form);"></td>
      				 <td class="verdana8">Pemegang Polis</td>
      				 <td align="center"><input type="text" name="pempolnama" size="40" readonly ></td>
      				 <td align="center"><input type="text" name="pempolno" size="10" maxlength="10" readonly></td>
      				 <td align="center"><input type="text" name="pempolhub" size="25" readonly></td>
              </tr>

              <tr>
      				 <td align="center"><input type="button"  value="..." class="buton" onclick="javascript:Pempre(this.form);"></td>
      				 <td class="verdana8">Pembayar Premi</td>
      				 <td align="center"><input type="text" name="pemprenama" size="40" readonly ></td>
      				 <td align="center"><input type="text" name="pempreno" size="10" maxlength="10" readonly></td>
      				 <td align="center"><input type="text" name="pemprehub" size="25" readonly></td>
              </tr>
            </table>		 
	</td>
	</tr>
	
	<tr>
	 <td align="center" bgcolor="#badaeb"><b>Penerima Faedah Asuransi / Beneficiary</b></td>
	</tr>	
	
	<tr>
   	 <td align="center" bgcolor="#d9ebf4">
						<table border="0" cellpadding="1" cellspacing="1" width="90%" >
              <tr>
    					 <td width="100%" colspan="5" align="center">
	   					 <input type="button" class="buton" name="kurang" value="Kurangi Data Beneficiary" onclick="javascript:BeneficiariDel();">
	 	 					 <input type="button" class="buton" name="tambah" value="Tambah Data Beneficiary" onclick="javascript:Beneficiari();"></td>
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
	</tr>

	<tr>
	 <td align="center" bgcolor="#badaeb"><b>Premi dan Uang Asuransi</b></td>
	</tr>	
	
	<tr>
	 <td bgcolor="#d9ebf4">
	 <table border="0" cellpadding="0" cellspacing="0" width="100%">
	 <tr>
   	 <td width="15%">
		   <select size="1" name="premijua" onchange="javascript:JuaPremi();" class="dropdown">
    		 <option value="jua">Entry JUA</option>
				 <option value="premi">Entry Premi</option>
       </select>
		 </td>
   	 <td width="2%">:</td>
   	 <td width="25%"><input type="text" name="nilai" size="15" maxlength="15" onblur="javascript:JuaPremi();MaxJuaPremi();" ></td>
   	 <td width="42%" colspan="3"><input type="button" name="buton" value=".." onclick="javascript:HitungJUA();" class="buton"></td>
   </tr>
   <tr>
   	 <td width="42%" colspan="3"><span id=kam style="position:relative;"></span></td>
   	 <td width="20%">Premi Setelah 5 Tahun</td>
   	 <td width="2%">:</td>
   	 <td width="20%"><input type="text" name="premi2" size="10" maxlength="10" readonly  value="<? echo $p2; ?>"></td>
	 </tr>
	 </table>
	</td>
  </tr>
  <tr>
   	 <td width="100%" align="center" bgcolor="#badaeb">
		  <input  type="button" value="Polis Lain Yg Dimiliki" name="cekpolis" onclick="return CekPolis()" class="buton">
		  <input name="submit" type="submit" value="Submit" class="buton" >
		 </td>
  </tr>
</table>

</body>
</html>