<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/tanggal.php";

$DB=new Database($userid, $passwd, $DBName);

?>
<html>
<head>
<title>Penagihan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js" ></script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table cellpadding="1" cellspacing="10" width="600" border="0">
  <tr class="tblhead">
    <td width="100%" align="center">
		<table width="600" cellpadding="1" cellspacing="1" border="0" class="tblisi">
  	<tr>
    		<td align="left" class="arial10">Nomor Penagih <font face="Verdana" color="red" size="1">(Kosongkan Untuk Tagihan Per Kantor)</td>
				<td>:</td>
				<td colspan="2"><input class="c" type="text" name="noklien" size="10" maxlength="10"  value="<? echo $noklien;?>" onfocus="highlight(event)">
		     <a href="#" onclick="NewWindow('../proposal/pnglist.php?a=ntryclnthub&b=noklien','',500,300,1)"><img src="../img/jswindow.gif" alt="Daftar Klien" border="0"></a>
				</td>
	  
		</tr>
  	<tr>
				<td align="left" class="arial10" width="70%">Bulan/Tahun Jatuh Tempo <font face="Verdana" color="red" size="1">(format MMYYYY)</td>
				<td width="1%">:</td>
				<td><input class="c" type="text" name="blnjatuh" size="6" maxlength="6" value="<? echo $blnjatuh;?>"  onfocus="highlight(event)"></td>
	      <td></td>
		</tr>
  	<tr>
				<td align="left" class="arial10" width="70%">Jumlah Tidak Ditampilkan <font face="Verdana" color="red" size="1">(Agar lebih cepat)</td>
				<td width="1%">:</td>
			<?
			if ($cb=='ON') {
			?>	
				<td><input class="c" type="checkbox" checked name="cb" value="ON" onfocus="highlight(event)"></td>
	    <? } else { ?>
				<td><input class="c" type="checkbox" name="cb" value="ON" onfocus="highlight(event)"></td>
	    <? } ?>
			  <td><input name="buton" type="submit" value="Submit"></td>
		</tr>		
		<tr class="tblhead1">
		 <td colspan="4">Masukkan Parameter Diatas. Klik Jumlah Untuk Melihat Detil</td>
		</tr>
		</table>
		</td>
  </tr>
	

	
	<tr class="tblhead">
	<td>
	<table border="0" cellpadding="1" cellspacing="1" width="600" class="tblhead">
	  <tr>
     <td width="100%" colspan="7" align="center" class="arial12whtb">DAFTAR JATUH TEMPO TAGIHAN PREMI UNTUK BULAN  <? echo substr($blnjatuh,0,2)."/".substr($blnjatuh,2); ?></td>
    </tr>	
    <tr class="tblhead1">
  	  <td align=center width=14% rowspan="2" class="tblhead"></td>
  	  <td align=center width=14% rowspan="2">VALUTA</td>
  	  <td align=center width=14% rowspan="2">CARA BAYAR</td>
  	  <td align=center width=14% colspan="2">KUITANSI BELUM LUNAS</td>
			<td align=center width=14% rowspan="2">KUITANSI LUNAS</td>
  	  <td align=center width=14% rowspan="2">T O T A L</td>
  	</tr>
	  <tr class="tblhead">
  	  <td align=center width=14%><font size=1>SUDAH<br>DICETAK</td>
  	  <td align=center width=14%><font size=1>BELUM<br>DICETAK</td>
  	</tr>
		
				
<?
if ($blnjatuh) {
	$kuitansi = array(0=>'NB','OB');
	$kdvaluta = array(0=>'0','1','3');
	$namavaluta = array(0=>'RUPIAH IDX','RUPIAH','DOLLAR AS');
	$kdcarabayar=array(0=>'1','2','3','4');
  $namacarabayar=array(0=>'BULANAN','KWARTALAN','SEMESTERAN','TAHUNAN');
  
	
	$png=($noklien) ? "and b.nopenagih='$noklien' " : "and b.nopenagih in (select nopenagih from $DBUser.tabel_500_penagih where kdrayonpenagih='$kantor') ";
  //$png=($noklien) ? "and b.nopenagih='$noklien' " : "";

  
	/******************pengulangan per kuitansi***************************/
  for ($z=0; $z<count($kuitansi); $z++) {	
	
   print( "		<tr>\n" );
   print( "		<td colspan=7>\n" );
   print( "		<table width=100% border=0 cellspacing=0 cellpadding=0>\n" );
   print( "		<tr>\n" );
   print( "		<td>\n" );
		
		  print( "	<tr>\n" );
  	  print( "	 <td  width=14% rowspan=5><font size=6 color=white>$kuitansi[$z]</td>\n" );
  	  print( "	 <td width=14%></td>\n" );
  	  print( "	 <td width=14%></td>\n" );
  	  print( "	 <td width=14%></td>\n" );
  	  print( "	 <td width=14%></td>\n" );
  	  print( "	 <td width=14%></td>\n" );
			print( "	 <td width=14%></td>\n" );
			print( "	</tr>\n" );
  
		  
	  for ($a=0; $a<count($kdvaluta); $a++) {
		/******************pengulangan per valuta***************************/
  	 print( "<tr>\n" );
  	 print( " <td colspan=6>\n" );
  	 print( "	<table width=100% class=tblisi border=0 cellspacing=1 cellpadding=0>\n" );
  	 
		  print( "	<tr class=hijao>\n" );
  	  print( "	 <td  width=14% rowspan=5 width=20%><font size=3>$namavaluta[$a]</td>\n" );
  	  print( "	 <td width=14%></td>\n" );
  	  print( "	 <td width=14%></td>\n" );
  	  print( "	 <td width=14%></td>\n" );
			print( "	 <td width=14%></td>\n" );
  	  print( "	 <td width=14%></td>\n" );
  	  
		 for ($b=0; $b<count($kdcarabayar); $b++) {
		  
			
  	  $sql = "select count(a.nopertanggungan) jml ".
					   "from $DBUser.tabel_300_historis_premi a,  $DBUser.tabel_200_pertanggungan b ".
					 	 "where a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
						 "and a.tglbooked=to_date('$blnjatuh','MMYYYY') ".
						 $png.
						 "and b.kdvaluta='$kdvaluta[$a]' ".
						 "and b.kdstatusfile='1' and b.kdpertanggungan='2' ".
						 "and decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4')='$kdcarabayar[$b]' ".
						 "and a.kdkuitansi like '$kuitansi[$z]%' ";
						 							
			//echo $sql;
			$DB->parse($sql);
			//echo $cb;
			($cb=='ON') ? '' : $DB->execute();
			$arr=$DB->nextrow();
			$jml = 	(int)$arr["JML"];
  	  
			$sqa = $sql. "and a.tglseatled is not null";						
			//echo $sqa;
			$DB->parse($sqa);
			($cb=='ON') ? '' : $DB->execute();
			$arr=$DB->nextrow();
			$lns = 	(int)$arr["JML"];
			
			$sql = $sql."and  nvl(a.status,'0') <> '0' and a.tglseatled is null";							
			//echo $sql;
			$DB->parse($sql);
			($cb=='ON') ? '' : $DB->execute();
			$arr=$DB->nextrow();
			$ctk = (int)$arr["JML"];
			
			$blm = $jml - $ctk  - $lns;
			
			$ctk = ($ctk==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien&ctk=1','detiltagihan',800,400,1)\">".$ctk."</a>";
			$blm = ($blm==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien&ctk=0','detiltagihan',800,400,1)\">".$blm."</a>";
			$lns = ($lns==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien&lns=1','detiltagihan',800,400,1)\">".$lns."</a>";
			$jml = ($jml==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien','detiltagihan',800,400,1)\">".$jml."</a>";
			
			$ctk = (!$ctk=='&nbsp;' || !$cb=='ON') ? $ctk : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien&ctk=1','detiltagihan',800,400,1)\">C</a>";
			$blm = (!$blm=='&nbsp;' || !$cb=='ON') ? $blm : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien&ctk=0','detiltagihan',800,400,1)\">B</a>";
			$lns = (!$lns=='&nbsp;' || !$cb=='ON') ? $lns : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien&lns=1','detiltagihan',800,400,1)\">L</a>";
			$jml = (!$jml=='&nbsp;' || !$cb=='ON') ? $jml : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiltagihan.php?bt=1&kwt=$kuitansi[$z]&val=$kdvaluta[$a]&cb=$kdcarabayar[$b]&jt=$blnjatuh&np=$noklien','detiltagihan',800,400,1)\">J</a>";
				 
			print( "	<tr class=hijao>\n" );
			print( "	 <td>".$namacarabayar[$b]."</td>\n" );
  	  print( "	 <td align=right>".$ctk."</td>\n" );
  	  print( "	 <td align=right>".$blm."</td>\n" );
  	  print( "	 <td align=right>".$lns."</td>\n" );
  	  print( "	 <td align=right>".$jml."</td>\n" );
  	  print( "  </tr>\n" );
  	 }
		  print( "	</table>\n" );
  	 print( " </td>\n" );
  	 print( "</tr>\n" );
		}	
	  /*    end per valuta    */
		


  print( "</td>\n" );
  print( "</tr>\n" );
  print( "</table>\n" );
	
	print( "</td>\n" );
  print( "</tr>\n" );
  	
	/*    end per kwt    */
	}	
		
}

?>
  </table>
  </td>
	</tr>
	
	<tr>
	 <td class="arial10wht"><hr size="1">
	 </td>
	</tr>
	 
</table>

<table width="600"> 
  <tr>
  	<td width="50%" class="arial10" align="left"><a href="#" onclick="window.history.go(-1)">Back</a></td>
	  <td width="50%" class="arial10" align="right"><a href="../pelaporan/index.php">Menu Pelaporan</a></td>
	</tr>
</table>
</form>
</div>
</body>
</html>
