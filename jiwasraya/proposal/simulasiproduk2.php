<? 
  include "../../includes/session.php";
  include "../../includes/database.php";
	$DB=New database($userid, $passwd, $DBName);

  function GetNewPropTemp($DBX)	{
    srand ((double) microtime() * 1000000);
    $randval = rand();
  	$maxnopert=substr($randval,0,9);
  	return (string)$maxnopert;
  }
	$nopert=GetNewPropTemp($DB);
	
    require("chainselectors_simulasi.php"); 
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
		
  	$sql="select to_char(sysdate,'DD/MM/YYYY') tanggal from dual";
  	$DB->parse($sql);
  	$DB->execute();
  	$res = $DB->nextrow();
  	$tanggal= $res["TANGGAL"];
		
  	$idxaw=(!$idxaw) ? '1' : $idxaw;
?>
<? //include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/entryprop_simulasi.js"></script>
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
	echo " document.ntryprop.buton.disabled=true;\n";
	echo "}";
	
	print( "//-->\n" );
  echo "</script>";
?>

<!--<body OnLoad="document.ntryprop.submit.disabled=true;Initial()" topmargin="0">-->
<body>
<div align="center">

	SIMULASI PRODUK
	<form name="ntryprop" method="post" action="insprop.php?<? echo $SID; ?>" onSubmit="disableForm(this);">
	
	<table border="0" cellspacing="0" cellpadding="1">
	<?$ProdukCaraBayar->printSelectors();?>
  <tr>
   	 <td>Medical</td>
   	 <td>:</td>
   	 <td>
		   <input type="radio" name="kdstatusmedical" value="M" title="Medical" onchange="protectMed()">Ya
		   <input  type="radio" name="kdstatusmedical" value="N" title="non Medical" checked="checked" onblur="javascript:CekTB();">Tidak
		 </td>
	</tr>
  <tr>
   	 <td>Tgl Mulai Asuransi</td>
   	 <td>:</td>
   	 <td>
		   <input type="text" name="mulas" size="10" maxlength="10" onblur="javascript:convert_date(mulas);">
		 </td>
	</tr>
	
	<tr>
   	 <td>Usia</td>
   	 <td>:</td>
   	 <td>
		   <input type="text" name="usia_th" size="3" maxlength="3" onblur="javascript:CekUsiaCabar();"> tahun
		 </td>
	</tr>
  <tr>
   	 <td>Lama Premi</td>
   	 <td>:</td>
   	 <td><input type="text" name="lamapembpremi_th" size="2" maxlength="2"  onfocus="highlight(event)" onblur="return cek_masapremi()"  value="<? echo $lprth; ?>"> tahun
		 </td>
	</tr>

	<tr>
   	 <td>Lama Asuransi</td>
   	 <td>:</td>
   	 <td><input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" readonly value="<? echo $lamth; ?>"> tahun</td>
	</tr>
	<script type="text/javascript" language="JavaScript"> 
	<?php  
    $ProdukCaraBayar->initialize(); 
	?> 
  </script>

  <tr>
   	 <td>Kode Valuta</td>
   	 <td>:</td>
   	 <td><select size="1" name="kdvaluta" onchange="return IndexAwal(document.ntryprop);" onblur="return IndexAwal(document.ntryprop);" onfocus="highlight(event)">
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
	</tr>
 
  <tr>
 	 	 <td>Kurs/Index Awal</td>
   	 <td>:</td>
   	 <td><input type="text" name="indexawal" size="6" readonly value="1" value="<? echo $idxaw; ?>"></td>
	</tr>
  

	<tr>
 	 	 <td>Premi/Uang Asuransi</td>
   	 <td>:</td>
   	 <td>
		   <select size="1" name="premijua" onchange="javascript:JuaPremi();">
    		 <option value="jua">Entry JUA</option>
				 <option value="premi">Entry Premi</option>
       </select>
		   <input type="text" name="nilai" size="15" maxlength="15" onblur="javascript:JuaPremi();CekPolis();" >
		 </td>
	</tr>
	
	<tr>
	   <td></td>
   	 <td></td>
   	 <td><span id=kam style="position:relative;"></span></td>
	</tr>
	
	<tr>
 	 	 <td></td>
   	 <td></td>
   	 <td>Premi Setelah 5 Tahun : <input type="text" name="premi2" size="10" maxlength="10" readonly  value="<? echo $p2; ?>"></td>
	</tr>
	
  <tr>
 	 	 <td></td>
   	 <td></td>
   	 <td>
		 	<input type="hidden" name="notertanggung" value="0007651368">
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
    	<input type="hidden" name="tglbp3">
    	<input type="hidden" name="bpo">
    	<input type="hidden" name="nobp3" value="123">
    	<input type="hidden" name="noagen" value="0000040149">
    	<input type="hidden" name="nopenagih" value="0000052011">
    	<input type="hidden" name="akhirpremi" value="<? echo $akhpr; ?>">
    	<input type="hidden" name="expirasi" value="<? echo $expir; ?>">
    	<input type="hidden" name="nosp">
    	<input type="hidden" name="pempolnama">
    	<input type="hidden" name="pempolno">
    	<input type="hidden" name="pempolhub">
    	<input type="hidden" name="pemprenama">
    	<input type="hidden" name="pempreno">
    	<input type="hidden" name="pemprehub">
    	<input type="hidden" name="usia_bl"> 
    	<input type="hidden" name="lamapembpremi_bl"  value="<? echo $lprbl; ?>">
    	<input type="hidden" name="lamaasuransi_bl" value="<? echo $lambl; ?>">
			<input type="hidden" name="tglsp" value="<? echo $tanggal; ?>">

			<input type="button" value="Cek Batas Medical" name="cekpolis" onclick="return CekPolis()" class="buton">
			<input type="button" name="buton" value=".." onclick="javascript:HitungJUA();" class="buton">
			<input name="submit" type="submit" value="Submit" class="buton" >
		 </td>
	</tr>
	
 </table>
</form>
</body>
