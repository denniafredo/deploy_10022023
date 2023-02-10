<? 
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";
	include "../../includes/pertanggungan.php";
	
?>

<html>
<head>
<title>Detail Polis Pertanggungan Perorangan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<div align="center">
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
			<tr class="tblhead">
				 <td align="center" colspan="2">DETAIL POLIS PERTANGGUNGAN PERORANGAN</td>
			</tr>

			<tr>
				 <td align="center" colspan="2">
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					 <tr class="hijao">
					  <td align="center" rowspan="2">No</td>
						<td align="center" colspan="2">Nomor Polis</td>
						<td align="center" rowspan="2">Pemegang Polis/<br>Tertanggung</td>
						<td align="center" rowspan="2">Produk</td>
						<td align="center" rowspan="2">Status Medical</td>
						<td align="center" rowspan="2">Valuta</td>
						<td align="center" rowspan="2">Cara Bayar</td>
						<td align="center" rowspan="2">Mulai Asuransi</td>
						<td align="center" rowspan="2">Expirasi</td>
						<td align="center" rowspan="2">JUA</td>
						<td align="center" rowspan="2">Premi</td>
						<td align="center" rowspan="2">Kurs</td>
						<td align="center" rowspan="2">Agen</td>
						<td align="center" rowspan="2">Penagih</td>
						<td align="center" rowspan="2">Status Saat Ini</td>
					 </tr>
					 <tr class="hijao">
					  <td align="center" width="10%">Lama</td>
						<td align="center" width="10%">Baru</td>
					 </tr>					 
<?
	$i=1;
  $DB = new Database($userid, $passwd, $DBName);

// Kondisi Kantor
	if ($_GET["wherektr"]==''){
		 $wherektr="";
	}
	else if (substr($_GET["wherektr"],1,1)=='Z'){
		 $wherektr="prefixpertanggungan like '".substr($wherektr,0,1)."%' and ";	
	}
	else{
		 $wherektr="prefixpertanggungan='".$wherektr."' and ";	
	}

// Kondisi Valuta
	if ($_GET["wherevaluta"]==''){
		 $wherevaluta="";	
	}
	else{
		 $wherevaluta="kdvaluta=".$wherevaluta." and ";		
	}

// Kondisi Produk
	if ($_GET["whereproduk"]==''){
		 $whereproduk="";
	}
	else{
		 $whereproduk="kdproduk like '".$whereproduk."%' and ";	
	}
	
// Kondisi Kode Pertanggungan
	if ($_GET["wherepertanggungan"]==''){
		 $wherepertanggungan="kdpertanggungan='2' and ";
	}
	else{
		 $wherepertanggungan="";
	}

// Kondisi Field Tanggal yang akan dibuatkan perbandingan
	if ($_GET["fieldtgl"]==''){
		 $fieldtgl="mulas";
	}
			
  // Periode Tgl Dari s/d Tgl Sampai
  $sqa = "select * ".
         "from $DBUser.tabel_200_pertanggungan ".
  			 "where ".$wherektr.$wherevaluta.$whereproduk.$wherepertanggungan.
  			 "to_char(".$fieldtgl.",'YYYYMMDD')>='".$_GET["tglDariCari"]."' and to_char(".$fieldtgl.",'YYYYMMDD')<='".$_GET["tglSampaiCari"]."'";

  //echo $sqa;
  $DB->parse($sqa);
  $DB->execute();
  
  $polisvrdi1=0;
  $polisvrti1=0;
  $polisva1=0;
  $juavrdi1=0;
  $juavrti1=0;
  $juava1=0;
  $premivrdi1=0;
  $premivrti1=0;
  $premiva1=0;
  
  while($arr=$DB->nextrow()){
  	if ($arr["KDVALUTA"]=='0'){
  		 $polisvrdi1=$polisvrdi1+1;
  		 $juavrdi1=$juavrdi1+$arr["JUAMAINPRODUK"];
  		 $premivrdi1=$premivrdi1+$arr["PREMI1"];
  	}
  	elseif ($arr["KDVALUTA"]=='1'){
  		 $polisvrti1=$polisvrti1+1;
  		 $juavrti1=$juavrti1+$arr["JUAMAINPRODUK"];
  		 $premivrti1=$premivrti1+$arr["PREMI1"];
  	}
  	elseif ($arr["KDVALUTA"]=='3'){
  		 $polisva1=$polisva1+1;
  		 $juava1=$juava1+$arr["JUAMAINPRODUK"];
  		 $premiva1=$premiva1+$arr["PREMI1"];
  	}

	 	$PER = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);		 			 	
		include "../../includes/belang.php";	
    print( "<td class=arial8 align=\"right\">$i</td>\n" );
    print( "<td class=arial8 align=\"center\">".$PER->nopol."</td>\n" );
    print( "<td class=arial8 align=\"center\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$PER->label."</a></td>\n" );
    print( "<td class=arial8 align=\"left\">".$PER->namapemegangpolis."/<br>".$PER->namatertanggung."</td>\n" );
    print( "<td class=arial8 align=\"center\">".$PER->namaproduk."</td>\n" );
    print( "<td class=arial8 align=\"center\">".$PER->medstat."</td>\n" );
    print( "<td class=arial8 align=\"center\">".$PER->namavaluta."</td>\n" );
    print( "<td class=arial8 align=\"center\">".$PER->namacarabayar."</td>\n" );
    print( "<td class=arial8 align=\"center\">".$PER->mulas."</td>\n" );
    print( "<td class=arial8 align=\"center\">".$PER->expirasi."</td>\n" );
    print( "<td class=arial8 align=\"right\">".number_format($PER->jua,2)."</td>\n" );
    print( "<td class=arial8 align=\"right\">".number_format($PER->premi1,2)."</td>\n" );
    print( "<td class=arial8 align=\"right\">".number_format($PER->indexawal,2)."</td>\n" );
    print( "<td class=arial8 align=\"center\">(".$PER->noagen.") ".$PER->namaagen."</td>\n" );
    print( "<td class=arial8 align=\"center\">(".$PER->nopenagih.") ".$PER->namapenagih."</td>\n" );
    print( "<td align=\"center\" class=arial8>".$PER->namastatusfile."\n" );
    print( "</tr>\n" );
		$i++;
  }
?>
				
    		 	 </table>
    		</td>	 
    </tr>
    <tr class="arial8wht" colspan="2">
    		<td align="left" >Klik Nomor Polis untuk melihat Detail Polis </td>
    </tr>
	</table>	 
<!--
<table width="100%">
	<tr>
    <td width="50%" class="arial10" align="left"><a href="#" onclick="window.print()">Print</a></td>
		<td width="50%" class="arial10" align="right"><a href="#" onclick="window.close()">Close</a></td>
	</tr>
</table>
-->

<br>
<table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="hijao">
		 <td align="center" colspan="4">RESUME POLIS PERTANGGUNGAN PERORANGAN</td>
	</tr>
  <tr class="hijao">
    <td align="center" class="arial10" rowspan="2">Valuta</td>
		<td align="center" class="arial10" colspan="3">Jumlah</td>
	</tr>
  <tr class="hijao">
		<td align="center" class="arial10">Polis</td>
		<td align="center" class="arial10">Uang Asuransi</td>
		<td align="center" class="arial10">Premi</td>
	</tr>
<?$i=2;?>	
<?include "../../includes/belang.php";?>	
		<td class="arial10"><b>Rupiah Dengan Index (VRDI)</b></td>
		<td align="right" class="arial10"><?=number_format($polisvrdi1,0);?></td>
		<td align="right" class="arial10"><?=number_format($juavrdi1,2);?></td>
		<td align="right" class="arial10"><?=number_format($premivrdi1,2);?></td>
	</tr>
<?$i=2;?>
<?include "../../includes/belang.php";?>	
		<td class="arial10"><b>Rupiah Tanpa Index (VRTI)</b></td>
		<td align="right" class="arial10"><?=number_format($polisvrti1,0);?></td>
		<td align="right" class="arial10"><?=number_format($juavrti1,2);?></td>
		<td align="right" class="arial10"><?=number_format($premivrti1,2);?></td>
	</tr>
<?$i=2;?>
<?include "../../includes/belang.php";?>	
		<td class="arial10"><b>Dollar AS/Asing (VA)</b></td>
		<td align="right" class="arial10"><?=number_format($polisva1,0);?></td>
		<td align="right" class="arial10"><?=number_format($juava1,2);?></td>
		<td align="right" class="arial10"><?=number_format($premiva1,2);?></td>
	</tr>
</table>

</div>
<br>
<? 
	 echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; 
?>
</body>
</html>
