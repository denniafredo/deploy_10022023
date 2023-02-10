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
				 <td align="center" colspan="2">ANP per CABANG</td>
			</tr>

			<tr>
				 <td align="center" colspan="2">
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					 <tr class="hijao">
					  <td align="center">No</td>
						<td align="center">Kantor</td>
						<td align="center">Premi</td>
						<td align="center">ANP</td>
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
  $sqa = "select prefixpertanggungan kdkantor, sum(anp) ANP, count(*) polis, sum(premi1) premi from (
SELECT   decode(a.kdcarabayar,'1',12,'2',4,'3',2,'4',1,'X',0.1,'M',12,'Q',4,'H',2,'A',1,0.1) fANP,
decode(a.kdcarabayar,'1',12,'2',4,'3',2,'4',1,'X',0.1,'M',12,'Q',4,'H',2,'A',1,0.1)*a.premi1 ANP, a.* ".
         "from $DBUser.tabel_200_pertanggungan a ".
  			 "where ".$wherektr.$wherevaluta.$whereproduk.$wherepertanggungan.
  			 "to_char(".$fieldtgl.",'YYYYMMDD')>='".$_GET["tglDariCari"]."' and to_char(".$fieldtgl.",'YYYYMMDD')<='".$_GET["tglSampaiCari"]."'".
			 ") group by prefixpertanggungan
order  by prefixpertanggungan";

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
  			 	
		include "../../includes/belang.php";	
    	print( "<td class=arial8 align=\"center\">".$i."</td>\n" );
		print( "<td class=arial8 align=\"center\">".$arr["KDKANTOR"]."</td>\n" );
		print( "<td class=arial8 align=\"right\">".number_format($arr["PREMI"],2)."</td>\n" );
		print( "<td class=arial8 align=\"right\">".number_format($arr["ANP"],2)."</td>\n" );
		print( "</tr>\n" );
		$i++;
  }
?>
				
    		 	 </table>
    		</td>	 
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


</div>
<br>

<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
			<tr class="tblhead">
				 <td align="center" colspan="2">ANP per PRODUK</td>
			</tr>

			<tr>
				 <td align="center" colspan="2">
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					 <tr class="hijao">
					  <td align="center">No</td>
						<td align="center">Kantor</td>
						<td align="center">Premi</td>
						<td align="center">ANP</td>
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
  $sqa = "select KDPRODUK kdkantor, sum(anp) ANP, count(*) polis, sum(premi1) premi from (
SELECT   decode(a.kdcarabayar,'1',12,'2',4,'3',2,'4',1,'X',0.1,'M',12,'Q',4,'H',2,'A',1,0.1) fANP,
decode(a.kdcarabayar,'1',12,'2',4,'3',2,'4',1,'X',0.1,'M',12,'Q',4,'H',2,'A',1,0.1)*a.premi1 ANP, a.* ".
         "from $DBUser.tabel_200_pertanggungan a ".
  			 "where ".$wherektr.$wherevaluta.$whereproduk.$wherepertanggungan.
  			 "to_char(".$fieldtgl.",'YYYYMMDD')>='".$_GET["tglDariCari"]."' and to_char(".$fieldtgl.",'YYYYMMDD')<='".$_GET["tglSampaiCari"]."'".
			 ") group by KDPRODUK
order  by KDPRODUK";

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
  			 	
		include "../../includes/belang.php";	
    	print( "<td class=arial8 align=\"center\">".$i."</td>\n" );
		print( "<td class=arial8 align=\"center\">".$arr["KDKANTOR"]."</td>\n" );
		print( "<td class=arial8 align=\"right\">".number_format($arr["PREMI"],2)."</td>\n" );
		print( "<td class=arial8 align=\"right\">".number_format($arr["ANP"],2)."</td>\n" );
		print( "</tr>\n" );
		$i++;
  }
?>
				
    		 	 </table>
    		</td>	 
    </tr>
	</table>
<? 
	 echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; 
?>
</body>
</html>
