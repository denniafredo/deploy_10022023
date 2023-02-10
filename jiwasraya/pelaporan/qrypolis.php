<?php 
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";

	$DB=New Database($userid, $passwd, $DBName);
	
	$sql = "select prefixpertanggungan,nopertanggungan,notertanggung,nosp,nopertanggungan, ".
			 	 "to_char(to_date(tglsp,'DD/MM/YY'),'DD/MM/YYYY') tglsp,nobp3,kdproduk,".
				 "to_char(to_date(mulas,'DD/MM/YY'),'DD/MM/YYYY') mulas, ".
				 "to_char(to_date(expirasi,'DD/MM/YY'),'DD/MM/YYYY') expirasi, ".
				 "to_char(to_date(akhirpremi,'DD/MM/YY'),'DD/MM/YYYY') akhirpremi, ".
				 "usia_th,usia_bl,lamaasuransi_th,lamaasuransi_bl, ".
				 "lamapembpremi_th,lamapembpremi_bl,kdvaluta,juamainproduk,premi1,kdcarabayar,indexawal, ".
				 "premi2,nopenagih,kdstatusfile,noagen,kdstatusmedical,nopemegangpolis,nopembayarpremi ".
				 "from $DBUser.tabel_200_pertanggungan where nopertanggungan='$nopertanggungan' and ".
				 "prefixpertanggungan='$prefixpertanggungan'";
	//echo $sql;			 
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();

/**/

 function getnama($db,$noklieninsurable,&$nama){
	$sql = "select namaklien1 ".
			 	 "from $DBUser.tabel_100_klien  ".
				 "where noklien='$noklieninsurable' ";
	//echo $sql;
	$db->parse($sql);
	$db->execute();
	$ari=$db->nextrow();
	$nama=$ari["NAMAKLIEN1"];
 }
	
 function gethub($db,$noklieninsurable,$ttg,&$hub){
	$sql = "select c.kdhubungan,b.namahubungan ".
			 	 "from $DBUser.tabel_218_kode_hubungan b,$DBUser.tabel_113_insurable c ".
				 "where c.kdhubungan=b.kdhubungan and c.notertanggung='$ttg' and c.noklieninsurable='$noklieninsurable' ";
				 
	//echo $sql;
	$db->parse($sql);
	$db->execute();
	$arq=$db->nextrow();
	$hub=$arq["NAMAHUBUNGAN"];
	
	if (is_null($hub)){
		 $hub="Diri Tertanggung";
	}
 }

	
	$sql = "select noklien,nourut from $DBUser.tabel_219_pemegang_polis_baw ".
			   "where nopertanggungan='$nopertanggungan' and ".
				 "prefixpertanggungan='$prefixpertanggungan' order by nourut";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	
	while ($arq=$DB->nextrow()) {
	$klienno[]=$arq["NOKLIEN"];
	$urut[]=$arq["NOURUT"];
	}

	$demit= (count($klienno));

/*  add 12 Nov */
    require("chainselectors.php"); 
 
    //prepare names 
    $selectorNames = array( 
        CS_FORM=>"ntryprop",  
        CS_FIRST_SELECTOR=>"kdproduk",  
        CS_SECOND_SELECTOR=>"kdcarabayar"); 

	  $Query= "select a.kdcarabayar, b.kdproduk, a.namacarabayar,c.namaproduk,c.usia_lpp,c.variabel ".
	          "from tabel_233_produk_cara_bayar b, tabel_305_cara_bayar a, tabel_202_produk c ".
			  		"where a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk order by b.kdproduk";
	
	  $DB->parse($Query);
	  $DB->execute();
  	while ($row=$DB->nextrow())
	  { 
		//echo "$row[VARIABEL] : $row[NAMAPRODUK] : $row[KDPRODUK]<br>";
        $nama = $row[KDPRODUK]."  -->  ".$row[NAMAPRODUK];
				$selectorData[] = array(
																						 		
						CS_SOURCE_ID=>$row[KDPRODUK],   
            CS_SOURCE_LABEL=>$nama,  
            CS_TARGET_ID=>$row[KDCARABAYAR],  
            CS_TARGET_LABEL=>$row[NAMACARABAYAR]);
		}				
		
		
	  $Query= "select  kdproduk, namaproduk ,usia_lpp,variabel,lama_min,lama_max ".
	          "from  tabel_202_produk  ".
			  		"order by kdproduk";
	
	  $DB->parse($Query);
	  $DB->execute();
  	while ($row=$DB->nextrow())
	  { 	
						$addendum[] = array(
						PRODUK=>$row[KDPRODUK],
						VARIABEL=>$row[VARIABEL],
						USIA_LPP=>$row[USIA_LPP],
						LAMA_MIN=>$row[LAMA_MIN],
						LAMA_MAX=>$row[LAMA_MAX]);			
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

<script language="JavaScript" type="text/javascript">
<?php 
    $ProdukCaraBayar->printUpdateFunction(); 
?> 
</script> 
<?
	print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function Awal(){" );
  print( "document.ntryprop.notertanggung.value = '".$arr["NOTERTANGGUNG"]."';\n" );
  print( "document.ntryprop.noproposal.value = '".$arr["NOPERTANGGUNGAN"]."';\n" );
  print( "document.ntryprop.nosp.value ='".$arr["NOSP"]."';\n" );
  print( "document.ntryprop.tglsp.value ='".$arr["TGLSP"]."';\n" );
  print( "document.ntryprop.kdproduk.value ='".$arr["KDPRODUK"]."';\n" );
  print( "cek ='".$arr["KDSTATUSMEDICAL"]."';\n" );
  print( "switch (cek){\n" );
  print( "			 case 'M': {\n" );
  print( "			 			document.ntryprop.kdstatusmedical[0].checked=true;\n" );
  print( "						}\n" );
  print( "				case 'N': {\n" );
  print( "						 document.ntryprop.kdstatusmedical[1].checked=true;\n" );
  print( "						}\n" );
  print( "}						" );

  print( "document.ntryprop.mulas.value ='".$arr["MULAS"]."';\n" );
  print( "document.ntryprop.usia_th.value ='".$arr["USIA_TH"]."';\n" );
  print( "document.ntryprop.lamaasuransi_th.value ='".$arr["LAMAASURANSI_TH"]."';\n" );
  print( "document.ntryprop.lamaasuransi_bl.value ='".$arr["LAMAASURANSI_BL"]."';\n" );
  print( "document.ntryprop.expirasi.value ='".$arr["EXPIRASI"]."';\n" );
	print( "document.ntryprop.akhirpremi.value ='".$arr["AKHIRPREMI"]."';\n" );
  print( "document.ntryprop.lamapembpremi_th.value ='".$arr["LAMAPEMBPREMI_TH"]."';\n" );
  print( "document.ntryprop.lamapembpremi_bl.value ='".$arr["LAMAPEMBPREMI_BL"]."';\n" );
  print( "document.ntryprop.kdvaluta.value ='".$arr["KDVALUTA"]."';\n" );
  print( "document.ntryprop.kdcarabayar.value ='".$arr["KDCARABAYAR"]."';\n" );
  print( "document.ntryprop.indexawal.value ='".$arr["INDEXAWAL"]."';\n" );
  print( "document.ntryprop.nopenagih.value =\"".$arr["NOPENAGIH"]."\";\n" );
  print( "document.ntryprop.noagen.value =\"".$arr["NOAGEN"]."\";\n" );
  print( "document.ntryprop.pempolno.value ='".$arr["NOPEMEGANGPOLIS"]."';\n" );
	$ttg=$arr["NOTERTANGGUNG"];
	$noklieninsurable=$arr["NOPEMEGANGPOLIS"];
	getnama($DB,$noklieninsurable,$nama);
	gethub($DB,$noklieninsurable,$ttg,$hub);	
	print( "document.ntryprop.pempolnama.value ='".$nama."';\n" );
	print( "document.ntryprop.pempolhub.value ='".$hub."';\n" );
  print( "document.ntryprop.pempreno.value ='".$arr["NOPEMBAYARPREMI"]."';\n" );
	$noklieninsurable=$arr["NOPEMBAYARPREMI"];
	getnama($DB,$noklieninsurable,$nama);
	gethub($DB,$noklieninsurable,$ttg,$hub);	
	print( "document.ntryprop.pemprenama.value ='".$nama."';\n" );
	print( "document.ntryprop.pemprehub.value ='".$hub."';\n" );
  print( "document.ntryprop.nilai.value ='".$arr["JUAMAINPRODUK"]."';\n" );
	print( "document.ntryprop.premi1.value ='".$arr["PREMI1"]."';" );
  print( "document.ntryprop.premi2.value ='".$arr["PREMI2"]."';" );
  print( "document.ntryprop.kdcarabayar.options[0].selected = true;" );

  print( "}" );
  print( "//-->\n" );
  print( "</script>\n" );
?>

<?
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function CallBenef() {\n" );
  print( "for (i=1;i<=".$demit.";i++)\n" );
  print( "Beneficiari();\n" );
		
	for ($i=1; $i<= $demit; $i++) {
	$d=$i-1;
	$noklieninsurable=$klienno[$d];
	getnama($DB,$noklieninsurable,$nama);
	gethub($DB,$noklieninsurable,$ttg,$hub);	
	print( "document.ntryprop.nama".$i.".value='".$nama."';");
	print( "document.ntryprop.hubungan".$i.".value='".$hub."';");
	print( "document.ntryprop.klienno".$i.".value='".$klienno[$d]."';");
	print( "document.ntryprop.no".$i.".value='".$urut[$d]."';");
	
	}
  print( "}\n" );
  print( "//-->\n" );
  print( "</script>" );
?>

<script language="JavaScript" type="text/javascript" src="../../includes/entryprop.js"></script>

<body OnLoad="JuaPremi();Awal();CallBenef();" topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1300</font></td></tr>
</table>


<div align="center">
<table border="0" cellpadding="0" cellspacing="0" width="580">
  <tr>
    <td>
      <table border="0" cellpadding="1" cellspacing="1" width="100%">
        <tr>
          <td>
	<!-------------------------------------- start php -------------------------------->				



	<table border="2" cellpadding="2" width="580" bordercolor="#C0C0C0" height="77">
  <tr>
    <td bgcolor="#DDDDDD"  bordercolor="#FFFFFF" width="580">
	 <table cellspacing="0" cellpadding="0">
	        <tr>
          <td>

<!--HATI HATI------------------------------------------------------------------------->
<font face="Arial" size="3" color="#008080"><b>EDIT PROPOSAL</b></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?echo $nopertanggungan;  ?></b>
<!--HATI HATI------------------------------------------------------------------------->
					</td>
        </tr>
		</table>		

		</td>
  </tr>
  <tr>
    <td height="73" bordercolor="#FFFFFF" width="580">

<form name="ntryprop" method="post" action="insprop.php?<? echo $SID; ?>" onSubmit="return disableForm(this);">


	<input type="hidden" name="pariabel">
	<input type="hidden" name="usia_lpp">
	<input type="hidden" name="lama_min">
	<input type="hidden" name="lama_max">


<input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
<input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
<table border="0" width="580" cellspacing="0" cellpadding="0" height="417">

  <tr>
    															 <td width="115"  bgcolor="#DDDDDD"><font size="2" face="Arial">Prefix</font></td>
    															 <td width="1"  bgcolor="#DDDDDD"><font size="2" face="Arial"><b>:</b></font></td>
    															 <td width="256" colspan="2"  bgcolor="#DDDDDD">
                									 <font face="Arial" size="2"><B><? echo $kantor ?></B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                     No Tertanggung</font></td>
    															 <td width="12"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    															 <td width="170"  bgcolor="#DDDDDD"><input type="text" name="notertanggung" size="10" maxlength="10" onblur="javascript:validasi10(this.form.notertanggung)" class="a" title="Nomor Klien Tertanggung">
      														 <input type="button" value="Cari" name="cari" class="buton" onclick="javascript:Cari(this.form)" title="Klik untuk Mencari di Klien Data Bank"></td>
  </tr>
  <tr>
	    											 				<td width="115"  bgcolor="#DDDDDD"><font face="Arial" size="2">No SP</font></td>
    <td width="1"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td width="60"  bgcolor="#DDDDDD"><input type="text" name="nosp" size="8" maxlength="8" class="a" title="Nomor SPAJ"></td>
    <td width="172"  bgcolor="#DDDDDD"><p align="right"><font face="Arial" size="2">Tgl SP</font></p></td>
    <td width="5"  bgcolor="#DDDDDD"><b>:</b></td>
    <td width="170"  bgcolor="#DDDDDD">
		<input type="text" name="tglsp" size="10" maxlength="10" onblur="javascript:convert_date(tglsp);" class="a" title="Tanggal Proposal" >
		<input type="button" value="Hari Ini"  onclick="javascript:tgl1();" class="buton" onmouseover="window.status='Klik untuk entry tanggal hari ini';return true;" onmouseout="window.status=''" title="Klik untuk entry tanggal hari ini"></td>
  </tr>

<!-- add 12 nov by lolin -->
<?php 
    $ProdukCaraBayar->printSelectors(); 
?>

  

  <tr>
    <td width="115"  bgcolor="#DDDDDD"><font face="Arial" size="2">Medical</font></td>
    <td width="1"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td width="413" colspan="4"  bgcolor="#DDDDDD">
				<input  type="radio" name="kdstatusmedical" value="M" title="Medical"><font size="2" face="Arial">Ya

				<input  type="radio" name="kdstatusmedical" value="N" title="non Medical" checked="checked"  onblur="javascript:CekTB();">Tidak</font></td>
  </tr>
  <tr>
    <td width="115"  bgcolor="#DDDDDD"><font face="Arial" size="2">Tgl Mulai Ass.</font></td>
    <td width="1"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td width="257" colspan="2"  bgcolor="#DDDDDD">
				<input type="text" name="mulas" size="10" maxlength="10" onchange="javascript:convert_date(mulas);usai(ntryprop);" title="Tanggal Mulai Asuransi" class="a">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                <font face="Arial" size="2">Usia</font>
		</td>
    <td width="11"  bgcolor="#DDDDDD">
                <font size="2"><b>:</b></font>
		</td>
    <td width="189"  bgcolor="#DDDDDD">
                <input type="text" name="usia_th" size="3" maxlength="3"  title="Usia, dihitung otomatis" class="c" readonly>
                <font color="#008080" size="1" face="Arial">tahun</font>
								<!--<input type="button" value="Hitung Usia" onclick="javascript:usai(ntryprop);">-->
		</td>
  </tr>

	
	<tr>
    <td width="115"  bgcolor="#DDDDDD"><font face="Arial" size="2">Lama Premi</font></td>
    <td width="1"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td width="60"  bgcolor="#DDDDDD">
				<input type="text" name="lamapembpremi_th" size="2" maxlength="2" title="Lama Pembayaran Premi (Tahun)" class="a" onblur="javascript:cek_masapremi();"><font color="#008080" size="1" face="Arial">tahun</font></td>
    <td width="189"  bgcolor="#DDDDDD">
				<input type="text" name="lamapembpremi_bl" size="2" maxlength="2" title="Lama Pembayaran Premi (Bulan)" class="a" value="0" onblur="javascript:expir();hitunglamas();">
                <font size="1" face="Arial" color="#008080">&nbsp;bulan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font face="Arial" size="2">Akhir Premi</font></td>
    <td width="10"  bgcolor="#DDDDDD">
                <font size="2"><b>:</b></font></td>
    <td width="188"  bgcolor="#DDDDDD">
                <input type="text" name="akhirpremi" size="10" maxlength="10" class="c" onblur="javascript:convert_date(akhirpremi);" readonly title="Akhir Pembayaran Premi, dihitung otomatis"></td>
  </tr>
  <tr>
    <td width="115"  bgcolor="#DDDDDD"><font face="Arial" size="2">Lama Asuransi</font></td>
    <td width="1"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td width="60"  bgcolor="#DDDDDD">
				<input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" class="c" readonly><font color="#008080" size="1" face="Arial">&nbsp;tahun&nbsp;</font></td>
    <td width="189"  bgcolor="#DDDDDD">
				<input type="text" name="lamaasuransi_bl" size="2" maxlength="2"  title="Lama Asuransi (Bulan)" class="c" value="0" onblur="javascript:expirass();" readonly>
				<font size="1" face="Arial" color="#008080">&nbsp;bulan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font face="Arial" size="2">Akhir Asuransi</font></td>
    <td width="10"  bgcolor="#DDDDDD">
                <font size="2"><b>:</b></font></td>
    <td width="188"  bgcolor="#DDDDDD">
                <input type="text" name="expirasi" size="10" maxlength="10" class="c" onblur="javascript:convert_date(expirasi);" readonly title="Waktu Expirasi, dihitung otomatis"></td>
  </tr>

<script type="text/javascript" language="JavaScript"> 
<?php 
    $ProdukCaraBayar->initialize(); 
?> 
</script>




  <tr>
    <td width="115"  bgcolor="#DDDDDD"><font face="Arial" size="2">Kode Valuta</font></td>
    <td width="1"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td width="257" colspan="2"  bgcolor="#DDDDDD">
		<select size="1" name="kdvaluta"  onblur="javascript:IndexAwal(this.form);" class="d">
		<? 
		  $sql = "select kdvaluta,kdmatauang,namavaluta ".
    			       "from $DBUser.tabel_304_valuta";
			$DB->parse($sql);
			$DB->execute();
			while($arr=$DB->nextrow()){
			  echo("<option value=".$arr["KDVALUTA"].">".$arr["NAMAVALUTA"]."</option>");
			}			 
		?>
		</select>
		<td width="14"  bgcolor="#DDDDDD"></td><td width="14"  bgcolor="#DDDDDD">
	</td>
  </tr>

  <tr>
    <td width="115"  bgcolor="#DDDDDD"><font face="Arial" size="2">Kurs/Index Awal</font></td>
    <td width="1"  bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td width="256" colspan="2"  bgcolor="#DDDDDD"><input type="text" name="indexawal" size="6" readonly value="1" class="c" ></td>

    <td width="202"  colspan="2" bgcolor="#DDDDDD"><font face="Arial" size="2">Penagih</font><font size="2"><b>:</b></font>
		<input type="text" name="nopenagih" size="10" maxlength="10" readonly title="Nomor Penagih" class="c">
		<input type="button" value="..."  onclick="window.open('pnglist.php','popuppage','width=250,height=200,top=100,left=100,scrollbars=yes');" class="buton" onmouseover="window.status='Klik untuk entry data Penagih';return true;" onmouseout="window.status=' '">
    </td>
  </tr>
  <tr>
    <td width="115"  bgcolor="#DDDDDD"></td>
    <td width="1"  bgcolor="#DDDDDD"></td>
    <td width="257" colspan="2"  bgcolor="#DDDDDD">
    

		</td>

    <td width="194"  colspan="2" bgcolor="#DDDDDD">
          <font face="Arial" size="2">A  g e n </font><font size="2"><b>: </b></font>
					<input type="text" name="noagen" size="10" maxlength="10" readonly title="Nomor Agen" class="c">
			 <input type="button" value="..."  onclick="window.open('agnlist.php','popuppage','width=250,height=200,top=100,left=100,scrollbars=yes');" class="buton" onmouseover="window.status='Klik untuk entry data Agen';return true;" onmouseout="window.status=''">
		</td>
  </tr>
  <tr>
  <td width="567" height="80" colspan="6" bgcolor="#DDDDDD">
      <table border="0" cellpadding="0" cellspacing="1" width="580" bordercolor="#FFFFFF">
        <tr>
        <td width="560">
            <table border="0" cellpadding="0" cellspacing="1" height="32" width="580">
              <tr>
      				<td width="37" class="tabe" >
        			<p class="arial8blue">Klik</p>
      				</td>
      				<td width="107" class="tabe" >
        			<p class="arial8blue">Insurable</p>
      				</td>
      				<td width="157" class="tabe" >
        			<p class="arial8blue">Nama</p>
      				</td>
      				<td width="91" class="tabe" >
        			<p class="arial8blue">Klien No</p>
      				</td>
      				<td width="157" class="tabe" >
        			<p class="arial8blue">Hubungan</p>
      				</td>
              </tr>
					    <tr>
      				<td width="37" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial">
    					<input type="button"  value="..." class="buton" onclick="javascript:Pempol(this.form);" style="font-family: Arial; font-size: 8pt" onmouseover="window.status='Klik untuk input data Pemegang Polis'" onmouseout="window.status=''">	

      				</td>
      				<td width="107" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial">
    					<font face="Arial" size="2"> Pemegang Polis</font>	

      				</td>
      				<td width="157" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial">
    					<p style="margin-top: 0; margin-bottom: 0" align="center">	
							
      				<input type="text" name="pempolnama" size="20" readonly  class="c">	

      				</td>
      				<td width="91" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial" >
    					<input type="text" name="pempolno" size="10" maxlength="10" readonly class="c">	

      				</td>
      				<td width="157" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial">
    					<input type="text" name="pempolhub" size="15" readonly class="c">	

      				</td>
              </tr>
              
							<tr>
      				<td width="37" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial">
    					<input type="button" value="..."  onclick="javascript:Pempre(this.form);" class="buton" onmouseover="window.status='Klik untuk input data Pembayar Premi'" onmouseout="window.status=''">	

      				</td>
      				<td width="107" align="center" bordercolor="#FFFFFF"  class="arial10">
    					<font face="Arial" size="2">Pembayar Premi</font>	

      				</td>
      				<td width="157" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial">
    					<input type="text" name="pemprenama" size="20" readonly class="c">	

      				</td>
      				<td width="91" align="center" bordercolor="#FFFFFF"  maxlength="10" style="font-size: 10pt; font-family: Arial">
    					<input type="text" name="pempreno" size="10" readonly class="c">	

      				</td>
      				<td width="157" align="center" bordercolor="#FFFFFF"  style="font-size: 10pt; font-family: Arial">
    					<input type="text" name="pemprehub" size="15" readonly class="c">	

      				</td>
              </tr>
            </table>

			</td>
      </tr>
      </table>
  </td>
  </tr>


	<!-- input demit-->
	<input type="hidden" name="demit"> 
	<input type="hidden" name="maxdemit"> 

	<tr>
    <td width="550"  colspan="6">
    <table border="0" cellpadding="0" cellspacing="0" width="587">
      <tr>
		<td bordercolor="#FFFFFF" bgcolor="#DDDDDD" width="587" valign="top" >

  <p class="para" align="center">
	<font class="ver10teal"><b>Penerima Faedah Asuransi</b></font>
	 </p>
  <p class="para" align="center">
<!--	 Klik<a href="#" onclick="javascript:Beneficiari();"><font size="2" face="Verdana">Tambah Data</font> </a>untuk menambah data beneficiary-->
	 <input type="button" name="tambah" value=" - " onclick="javascript:BeneficiariDel();"> Klik Untuk Menambah/mengurangi Data
	 <input type="button" name="kurang" value=" + " onclick="javascript:Beneficiari();">
<!-- tabel dalam  beneficiari -->
 		 <table border="0" cellpadding="0" cellspacing="1" width="400" align="center"  bordercolor="#C0C0C0">
		 <tr>
		 <td bordercolor="#FFFFF0" bgcolor="#DDDDDD">

<!-- tabel didalamnya lagi dalam  beneficiari -->
 		 <table border="0" cellpadding="0" cellspacing="1" width="400" >
     <tr>
      	 <td width="11" class="tabe">
      	 <p class="para">^</p>
      	 </td>
				 <td width="22" class="tabe">
      	 <p class="para">No</p>
      	 </td>
      	 <td width="160" class="tabe">
         <p class="para">Nama</p>
      	 </td>
      	 <td width="100" class="tabe">
         <p class="para">Klien No</p>
      	 </td>
      	 <td width="100" class="tabe">
         <p class="para">Hubungan</p>
      	 </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret1 style="position:relative;"></span>	

      </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret2 style="position:relative;"></span>	

      </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret3 style="position:relative;"></span>
      </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret4 style="position:relative;"></span>	

      </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret5 style="position:relative;"></span>	

      </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret6 style="position:relative;"></span>	

      </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret7 style="position:relative;"></span>	

      </td>
    </tr>
    <tr>
      <td width="550" align="center" colspan="5">
   	<span id=pret8 style="position:relative;"></span>	

      </td>
    </tr>


 		</table>
<!-- tabel didalamnya lagi dalam  beneficiari -->




		 </td>
		 </tr>
		 </table>
<!-- tabel dalam  beneficiari -->
		 </td>
      </tr>
    </table>
    </td>
  </tr>
  



	<tr>
    <td width="516" height="16" colspan="6" bgcolor="#DDDDDD" align="center">
      <p  style="margin-top: 0; margin-bottom: 0"><font color="#008080" size="1" face="Arial">Jika
      nilai JUA dimasukkan maka Premi dihitung, jika Premi yang dimasukkan, maka
      JUA yang akan dihitung</font>
      <font color="#ff0080" size="2" face="Arial"><b>Premi dan Benefit harus dihitung Ulang</b></font>
      </p>
    </td>
  </tr>
 

	<tr>
    <td width="100"  bgcolor="#C0C0C0"><select size="1" name="premijua" onchange="javascript:JuaPremi();" class="d" >
    				 <option value="jua">Entry JUA</option>
						 <option value="premi">Entry Premi</option>
     </select>
    </td>
    <td width="3"  bgcolor="#C0C0C0"><b>:</b></td>
    <td width="413" colspan="4"  bgcolor="#C0C0C0">
       

		<input type="text" name="nilai" size="15" maxlength="15" onblur="javascript:JuaPremi();"  class="a">
		<input type="button" name="buton" value=".." onclick="javascript:HitungJUA();" style="font-family: Arial; font-size: 8pt">
	

		</td>
 </tr>
  



	<tr>
    <td width="100"  bgcolor="#DDDDDD"></td>
    <td width="3"  bgcolor="#DDDDDD"></td>
    <td width="252" colspan="2"  bgcolor="#DDDDDD">
		<span id=kam style="position:relative;"></span>
		



		</td>
    <td width="205" colspan="2"  bgcolor="#DDDDDD">
        <font face="Arial" size="2">Premi 2 </font><font size="2"><b>: </b></font><input type="text" name="premi2" size="10" maxlength="10" readonly  class="c">
		



		</td>
  </tr>
</table>




</td>
</tr>




<input type="hidden" name="premistd">
    <tr>
<td bordercolor="#FFFFFF"  bgcolor="#DDDDDD" >
<p align="center">
            <input  type="reset" value="Reset" class="buton"><input  type="submit" value="Submit" class="buton"> 									



 



</td>
    </tr>
</table>
					</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</div>
<hr size="1">
<a href="#" onclick="javascript:history.go(-1)">Back</a>


</body>
</html>
