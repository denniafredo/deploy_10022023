<? 
  include "../../includes/session.php";
  include "../../includes/roleptg.php";
  include "../../includes/database.php";


	$DB=New database($userid, $passwd, $DBName);

	$sql = "select a.kdproduk,a.prefixpertanggungan,a.tglbp3,a.notertanggung from $DBUser.tabel_200_pertanggungan a ".
			 	 "where a.nopertanggungan='$noproposal'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arri = $DB->nextrow();
	$kp=$arri["KDPRODUK"];
	if ($arri["PREFIXPERTANGGUNGAN"]<>$kantor){
	 print ("<font face=Verdana size=3><b>Nomor Proposal ".$noproposal." bukan dari kantor ".$kantor."</b></font><br>");
   print( "Anda tidak berhak melakukan Update terhadap Proposal ini <br>" );
   print( "<a href=\"#\" onclick=\"javascript:history.go(-1)\"><font size=\"2\" face=\"Verdana\">Back</font></a>\n" );
	 die;
	}
	if (!is_null($arri["NOTERTANGGUNG"])){
	 print ("<font face=Verdana size=3><b>Proposal ".$noproposal." Sudah Dientry</b></font><br>");
   print( "Silakan ke Menu Update<br>" );
   print( "<a href=\"#\" onclick=\"javascript:history.go(-1)\"><font size=\"2\" face=\"Verdana\">Back</font></a>\n" );
	die;
	}
	
	function GetNewPropTemp($DBX)	{
	  $query = "select max(nopertanggungan) as maxnopert from $DBUser.tabel_200_temp";
	  $DBX->parse($query);
		$DBX->execute();
		$arr = $DBX->nextrow();
		$maxnopert = $arr["MAXNOPERT"];
		
		if (strlen($maxnopert)==0) {
		  $maxnopert = "900000001";
		} else {
			$newnopert = $maxnopert + 1;
	  $maxnopert = str_pad($newnopert,9,"0",STR_PAD_LEFT);
		} 
		return $maxnopert;
		}		 
	$nopert=GetNewPropTemp($DB);
	//echo $nopert;
/*  add 12 Nov */
    require("chainselectors.php"); 
 
    //prepare names 
    $selectorNames = array( 
        CS_FORM=>"ntryprop",  
        CS_FIRST_SELECTOR=>"kdproduk",  
        CS_SECOND_SELECTOR=>"kdcarabayar"); 

	  $Query= "select a.kdcarabayar, b.kdproduk, a.namacarabayar,c.namaproduk,c.usia_lpp,c.variabel,c.lama_min,c.lama_max ".
	          "from $DBUser.tabel_233_produk_cara_bayar b, $DBUser.tabel_305_cara_bayar a, $DBUser.tabel_202_produk c ".
			  		"where a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk ".
						"and b.kdproduk='$kp' ".
						"order by c.kdproduk,a.namacarabayar ";
		//echo $Query;				
	  $DB->parse($Query);
	  $DB->execute();
  	while ($row=$DB->nextrow())
	  { 
		    $nama = $row[KDPRODUK]."  --  ".$row[NAMAPRODUK];
				$selectorData[] = array(																 		
						CS_SOURCE_ID=>$row[KDPRODUK],   
            CS_SOURCE_LABEL=>$nama,  
            CS_TARGET_ID=>$row[KDCARABAYAR],  
            CS_TARGET_LABEL=>$row[NAMACARABAYAR]);
		}				
	
	  $Query= "select  kdproduk, namaproduk ,usia_lpp,variabel,lama_min,lama_max ".
	          "from  $DBUser.tabel_202_produk ";
						"and kdproduk='$kp' ";
	  $DB->parse($Query);
	  $DB->execute();
  	while ($raw=$DB->nextrow())
	  { 	
						$addendum[] = array(
						PRODUK=>$raw[KDPRODUK],
						VARIABEL=>$raw[VARIABEL],
						USIA_LPP=>$raw[USIA_LPP],
						LAMA_MIN=>$raw[LAMA_MIN],
						LAMA_MAX=>$raw[LAMA_MAX]);			
		}
    //instantiate class 
    $ProdukCaraBayar = new chainedSelectors($selectorNames,$selectorData,$addendum); 

//--------------------------------------------------------------------------------------------------//
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/entryprop.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<? 
	$sql="select to_char(sysdate,'DD/MM/YYYY') tanggal from dual";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$res = $DB->nextrow();
	$tanggal= $res["TANGGAL"];

	print( "</script>" );
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function UbahTertanggung(){\n" );
  print( "document.ntryprop.pempolnama.value='';\n" );
  print( "document.ntryprop.pempolno.value='';\n" );
  print( "document.ntryprop.pempolhub.value='';\n" );
  print( "document.ntryprop.pemprenama.value='';\n" );
  print( "document.ntryprop.pempreno.value='';\n" );
  print( "document.ntryprop.pemprehub.value='';\n" );
  print( "document.ntryprop.mulas.value='';\n" );
	print( "document.ntryprop.usia_th.value='';\n" );
  print( "document.ntryprop.lamapembpremi_th.value='';\n" );
  print( "document.ntryprop.lamaasuransi_th.value='';\n" );
 for ($i=1;$i<=$demit;$i++) {
  print( "  document.ntryprop.kurang.click();\n" );
 }

  print( "}\n" );
  print( "//-->\n" );
  print( "</script>\n" );
?>
<script language="JavaScript" type="text/javascript">
<?php 
    $ProdukCaraBayar->printUpdateFunction(); 
?> 
</script> 
<script language="JavaScript" type="text/javascript">
<!--
function GantiProduk(){
Initial();
}
//-->
</script>
<?
if ($noproposal<>''){
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "\n" );
	print( "function Initial(){\n" );
	
  $sql = "select kdproduk,noagen,to_char(tglbp3,'DD/MM/YYYY') tglbp3 from $DBUser.tabel_200_pertanggungan ".
			   "where nopertanggungan='$noproposal' and prefixpertanggungan='$kantor'";
				 
  $DB->parse($sql);
  $DB->execute();
	$res=$DB->nextrow();
	$nomoragen=$res["NOAGEN"];
	$bp3=$res["TGLBP3"];
	$kp = $res["KDPRODUK"];
	
	$sql = "select kdproduk,namaproduk,usia_lpp,variabel,lama_min,lama_max ".
	       "from  $DBUser.tabel_202_produk ".
				 "where kdproduk='$kp' ";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();
	$res=$DB->nextrow();
	 printf( "document.ntryprop.noagen.value='".$nomoragen."';\n" );
	 printf( "document.ntryprop.tglbp3.value='".$bp3."';\n" );
	 printf( "document.ntryprop.pariabel.value='".$res["VARIABEL"]."';\n" );
	 printf( "document.ntryprop.usia_lpp.value='".$res["USIA_LPP"]."';\n" );
	 printf( "document.ntryprop.lama_min.value='".$res["LAMA_MIN"]."';\n" );
	 printf( "document.ntryprop.lama_max.value='".$res["LAMA_MAX"]."';\n" );
	 if (!is_null($nomoragen)) {
	  printf( "document.ntryprop.klikagen.disabled=true;\n" );
   }
  print( "}" );
	print( "//-->\n" );
  print( "</script>\n" );
} 

	
?>

<body OnLoad="document.ntryprop.submit.disabled=true;Initial()" topmargin="0">
<div align="center">
<table width="100%">
<tr>
 <td align="right"><font face="Verdana" size="1" color="#0033CC">F1300</font></td>
</tr>
</table>

<table border="0" cellpadding="1" cellspacing="1" width="700" class="tblhead">
  <tr>
	 <td class="tblhead" align="center" width="100%">ENTRY PROPOSAL BARU, BP3 TELAH DIBAYAR TERLEBIH DAHULU</td>
  </tr>
  
	<tr>
  <td width="100%" class="tblisi"> <!-- tempat tabel -->

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
	<input type="hidden" name="demit"> 
	<input type="hidden" name="maxdemit">
	<input type="hidden" name="premistd">	  
	<input type="hidden" name="risk">

	<table border="0" width="100%" cellspacing="1" cellpadding="1">
  <tr>
   	 <td class="arial10">No Tertanggung</td>
   	 <td class="arial10">:</td>
   	 <td class="arial10"><input type="text" readonly name="notertanggung" size="10" maxlength="10" class="a">
		 <input type="button" value="Cari Klien" name="cari" class="buton" onclick="Klear(document.ntryprop);Cari(this.form)" onblur="javascript:TanggalMulas()" ></td>
		 <td class="arial10" align="right">Proposal No</td>
   	 <td class="arial10">:</td>
   	 <td class="arial10"><b><? echo $kantor."-".$noproposal; ?></td>
		 <td class="arial10"></td>
		 
	</tr>

  <tr>
   	 <td width="15%" class="arial10">Nomor SPAJ</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="nosp" size="11" maxlength="11" class="c" title="Nomor SPAJ" onfocus="highlight(event)"></td>
   	 <td width="20%" class="arial10" align="right">Tanggal SPAJ</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="tglsp" size="10" maxlength="10" onblur="javascript:convert_date(tglsp);" class="c" value="<? echo $tanggal; ?>" onfocus="highlight(event)"></td>
		 <td width="16%" class="arial10">
		 <!--<input type="button" value="Hari Ini"  onclick="javascript:tgl2();" onblur="TanggalMulas()" class="buton" title="Klik untuk entry tanggal hari ini">-->
		 </td>
	</tr>
	

	<?php 
    $ProdukCaraBayar->printSelectors(); 
	?>

	
  <tr>
   	 <td width="15%" class="arial10">Medical</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input  type="radio" name="kdstatusmedical" value="M" title="Medical">Ya
		 <input  type="radio" name="kdstatusmedical" value="N" title="non Medical" checked="checked" onblur="javascript:CekTB();">Tidak</td>
   	 <td width="20%" class="arial10"></td>
   	 <td width="2%" class="arial10"></td>
   	 <td width="20%" class="arial10"></td>
		 <td width="16%" class="arial10"></td>
	</tr>
	
  <tr>
   	 <td width="15%" class="arial10">Tgl Mulai Ass</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="mulas" size="10" maxlength="10" onblur="javascript:convert_date(mulas);HitungUsia(document.ntryprop);" class="c" onfocus="highlight(event)"></td>
   	 <td width="20%" class="arial10" align="right">Usia</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="ver8ungu"><input type="text" name="usia_th" size="3" maxlength="3" class="a" readonly>
		 tahun
		 </td>
		 <td width="16%" class="ver8ungu">
 		 <input type="text" name="usia_bl" size="3" maxlength="3" class="a" readonly>bulan
		 </td>
	</tr>

  <tr>
   	 <td width="15%" class="arial10">Lama Premi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="ver8ungu"><input type="text" name="lamapembpremi_th" size="2" maxlength="2"  onfocus="highlight(event)" class="c" onblur="return cek_masapremi()">tahun
		 <input type="hidden" name="lamapembpremi_bl">
		 </td>
   	 <td width="20%" class="arial10" align="right">Akhir Pemb Premi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="akhirpremi" size="10" maxlength="10" class="a" onblur="javascript:convert_date(akhirpremi);" readonly></td>
		 <td width="16%" class="arial10"></td>
	</tr>

  <tr>
   	 <td width="15%" class="arial10">Lama Asuransi</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="ver8ungu">
		  <input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" class="a" readonly>tahun
		  <input type="hidden" name="lamaasuransi_bl">
			<input type="hidden" name="lamapembpremi_th_default">
		 </td>
   	 <td width="20%" class="arial10" align="right">Akhir Ass (Expirasi)</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="expirasi" size="10" maxlength="10" class="a" onblur="javascript:convert_date(expirasi);" readonly></td>
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
   	 <td class="arial10" colspan="2"><input type="text" readonly name="tglbp3" size="10" maxlength="10" class="a" onblur="convert_date(tglbp3)" onfocus="highlight(event)">&nbsp;&nbsp;(Tanggal BS/BM)</td>
   	 <td width="38%" class="a" colspan="3"><input type="checkbox" name="bpo" value="1">Setuju Gadai Polis Otomatis</td>
	</tr>	
  <tr>
   	 <td width="15%" class="arial10">Kode Valuta</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="45%" colspan="2" class="arial10"><select size="1" name="kdvaluta" onchange="return IndexAwal(document.ntryprop);" onblur="return IndexAwal(document.ntryprop);" onfocus="highlight(event)" class="d">
<?
	$sql = "select distinct a.kdvaluta,b.namavaluta ".
			   "from $DBUser.tabel_233_produk_cb_val a, $DBUser.tabel_304_valuta b ".
			   "where a.kdvaluta=b.kdvaluta and a.kdproduk='$kp' ";

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
   <tr>
   	 <td width="15%" class="arial10">Nomor BP3</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="nobp3" size="12" maxlength="12" title="Nomor BP3" class="a" onfocus="highlight(event)"></td>
   	 <td width="20%" class="arial10" align="right">Nomor Agen</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10">
		  <input type="text" name="noagen" size="10" maxlength="10" readonly title="Nomor Agen" class="a">
		 </td>
		 <td width="16%" class="arial10">
		 	<input type="button" value="Cari  A g e n" name="klikagen" onclick="NewWindow('agnlist.php','popuppage',600,400,1);" class="buton">
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
		 	<input type="button" value="Cari Penagih"  onclick="PopPenagih()" class="buton">
		 </td>
	</tr>
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
      				 <td align="center"><input type="button"  value="..." class="buton" onclick="javascript:Pempol(this.form);"></td>
      				 <td class="verdana8">Pemegang Polis</td>
      				 <td align="center"><input type="text" name="pempolnama" size="40" readonly  class="a"></td>
      				 <td align="center"><input type="text" name="pempolno" size="10" maxlength="10" readonly class="a"></td>
      				 <td align="center"><input type="text" name="pempolhub" size="25" readonly class="a"></td>
              </tr>

              <tr>
      				 <td align="center"><input type="button"  value="..." class="buton" onclick="javascript:Pempre(this.form);"></td>
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
	<tr>

	<tr>
	 <td class="tblhead" align="center">Premi dan Uang Asuransi</td>
	</tr>	

	<tr bgcolor="#99ccff">
	<td width="100%">
	 <table border="0" cellpadding="0" cellspacing="0">
   <tr>
   	 <td width="15%" class="arial10">
		   <select size="1" name="premijua" onchange="javascript:JuaPremi();" class="d">
    				 <option value="jua">Entry JUA</option>
						 <option value="premi">Entry Premi</option>
       </select>
		 </td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="25%" class="arial10"><input type="text" name="nilai" size="15" maxlength="15" onblur="javascript:JuaPremi();"  class="c"></td>
   	 <td width="42%" colspan="3" class="arial10"><input type="button" name="buton" value=".." onclick="javascript:HitungJUA();" class="buton"></td>
   </tr>

   <tr>
   	 <td width="42%" colspan="3" class="arial10"><span id=kam style="position:relative;"></span></td>
   	 <td width="20%" class="arial10">Premi Setelah 5 Tahun</td>
   	 <td width="2%" class="arial10">:</td>
   	 <td width="20%" class="arial10"><input type="text" name="premi2" size="10" maxlength="10" readonly  class="a"></td>
	 </tr>
	 </table> 
	</td>
  </tr>
	
  <tr>
   	 <td width="100%" class="tblhead" align="center">
		  <input  type="button" value="Polis Lain Yg Dimiliki" name="cekpolis" onclick="return CekPolis()" class="buton">
		  <input name="submit" type="submit" value="Submit" class="buton">
		 </td>
  </tr>
	
</table>
<? include "footer.php"; ?>
</body>
</html>
