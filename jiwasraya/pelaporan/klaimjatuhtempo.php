<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/tanggal.php";

$DA=new Database($userid, $passwd, $DBName);
$DB=new Database($userid, $passwd, $DBName);

?>
<html>
<head>
<title>Penagihan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table cellpadding="1" cellspacing="10" width="600" border="0">
  <tr class="tblhead">
    <td width="100%" align="center">
		<table width="600" cellpadding="1" cellspacing="1" border="0" class="tblisi">
  	<tr>
    		<td align="left" class="arial10">Nomor Penagih <font face="Verdana" color="red" size="1">(Kosongkan Untuk Klaim Per Kantor)</td>
				<td>:</td>
				<td colspan="2"><input class="c" onFocus="highlight(event)" type="text" name="nopenagih" size="10" maxlength="10"  value="<? echo $nopenagih;?>" onBlur="validasi10(this.form.nopenagih)">
		     <a href="#" onClick="NewWindow('../proposal/pnglist.php?a=ntryclnthub&b=nopenagih','',500,300,1)"><img src="../img/jswindow.gif" alt="Daftar Penagih" border="0"></a>
				</td>
		</tr>
  	<tr>
    		<td align="left" class="arial10">Nomor Agen <font face="Verdana" color="red" size="1">(Kosongkan Untuk Klaim Per Kantor)</td>
				<td>:</td>
				<td colspan="2"><input class="c" onFocus="highlight(event)" type="text" name="noagen" size="10" maxlength="10"  value="<? echo $noagen;?>" onBlur="validasi10(this.form.noagen)">
		     <a href="#" onClick="NewWindow('../proposal/agnlist.php?a=ntryclnthub&b=noagen','',500,300,1)"><img src="../img/jswindow.gif" alt="Daftar Agen" border="0"></a>
				</td>
		</tr>
  	<tr>
				<td align="left" class="arial10" width="70%">Bulan/Tahun Jatuh Tempo <font face="Verdana" color="red" size="1">(format MMYYYY)</td>
				<td width="1%">:</td>
				<td><input class="c" type="text" name="blnjatuh" size="6" maxlength="6" value="<? echo $blnjatuh;?>"  onfocus="highlight(event)"></td>
	      <td><input class="buton" name="buton" type="submit" value="Submit"></td>
		</tr>
		<tr class="tblisi1">
		 <td colspan="4">Masukkan Parameter Diatas. Klik Jumlah Untuk Melihat Detil</td>
		</tr>
		</table>
		</td>
  </tr>
	
<tr><td>Penarikan data jatuh tempo cukup berat, mohon bersabar :)</td></tr>
	
	<tr class="tblhead">
	<td>
	<table border="0" cellpadding="1" cellspacing="1" width="600" class="tblisi1">
	  <tr class="tblhead">
     <td width="100%" colspan="4" align="center" class="arial12whtb">DAFTAR JATUH TEMPO KLAIM UNTUK BULAN  <? echo substr($blnjatuh,0,2)."/".substr($blnjatuh,2); ?></td>
    </tr>	
    <tr>
  	  <td align=center width=34% rowspan="2"  bgcolor="#3300ff">JENIS KLAIM</td>
  	  <td align=center width=14% colspan="2"  bgcolor="#3300ff">KLAIM ASURANSI</td>
		  <td align=center width=14% rowspan="2"  bgcolor="#3300ff">T O T A L</td>
  	</tr>
	  <tr class="tblhead">
  	  <td align=center width=14%><font size=1>BELUM</td>
  	  <td align=center width=14%><font size=1>SUDAH</td>
  	</tr>
		
				
<?
if ($blnjatuh) {
	
	$png=($nopenagih) ? "and a.nopenagih='$nopenagih' " : '';
  $agn=($noagen) ? "and a.noagen='$noagen' " : '';
	$png1=($nopenagih) ? "and h.nopenagih='$nopenagih' " : '';
  $agn1=($noagen) ? "and h.noagen='$noagen' " : '';
  
  $sql = "select kdklaim, namaklaim, kelompok ".
			   "from $DBUser.tabel_902_kode_klaim ".
				 "where kelompok is not null and kelompok <> 'D' ".
			   "order by kdklaim ";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$i=0;
	
	while($arr=$DB->nextrow()){
		$namaklaim = $arr["NAMAKLAIM"];	
		$klp = $arr["KELOMPOK"];
		
	  $sqa = "select count(kdbenefit) jml ".
			     "from ".
					 "(select a.nopertanggungan,c.kdbenefit from $DBUser.tabel_223_transaksi_produk c,".
					 "$DBUser.tabel_200_pertanggungan a, ".
					 "$DBUser.tabel_500_penagih b, $DBUser.tabel_207_kode_benefit d ".
				 	 "where a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' and ".
					 "a.kdpertanggungan = '2' and a.kdstatusfile='1' ".
					 "and nvl(c.status,'0') in ('0','7') ". 
					 $png.$agn.
					 "and a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
					 					 
					 "and substr(a.kdproduk,1,2) <> 'PA' ".
					 
					 "and c.kdbenefit=d.kdbenefit ".
					 "and d.kdkelompokbenefit='$klp' ".
					 "and to_char(c.expirasi,'MMYYYY')='$blnjatuh' ".
					  "union ".
					 "select h.nopertanggungan,e.kdbenefit ".
					 "from $DBUser.tabel_200_pertanggungan h,$DBUser.tabel_242_benefit_anuitas e, ".
					 "$DBUser.tabel_500_penagih i, $DBUser.tabel_207_kode_benefit f ".
					 "where h.nopenagih=i.nopenagih and i.kdrayonpenagih='$kantor' and ".
					 "h.kdpertanggungan = '2' and h.kdstatusfile='1' ".
					 "and nvl(e.status,'0') in ('0','7') ". 
					 $png1.$agn1.
					 "and  e.kdbenefit=f.kdbenefit ".
					 "and h.prefixpertanggungan=e.prefixpertanggungan and h.nopertanggungan=e.nopertanggungan ".					 
					 "and substr(h.kdproduk,1,2) <> 'PA' ".
					 
					 "and to_char(e.tgljatuhtempo,'MMYYYY')='$blnjatuh' ".
					 "and f.kdkelompokbenefit='$klp') ";
			//echo $sqa."<br>";			
			$DA->parse($sqa);
			$DA->execute();
			$arr=$DA->nextrow();
			$jml = 	$arr["JML"];
			
	  $sqa = "select count(nopertanggungan) jml ".
			     "from ".
					 "(select a.nopertanggungan from $DBUser.tabel_223_transaksi_produk c,".
					 "$DBUser.tabel_200_pertanggungan a,  ".
					 "$DBUser.tabel_500_penagih b, $DBUser.tabel_207_kode_benefit d ".
				 	 "where a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' and ".
					 "a.kdpertanggungan = '2' and a.kdstatusfile='1' ".
					 $png.$agn.
					 "and a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
					 "and substr(a.kdproduk,1,2) <> 'PA' ".
					 "and c.kdbenefit=d.kdbenefit ".
					 "and d.kdkelompokbenefit='$klp' ".
					 "and to_char(c.expirasi,'MMYYYY')='$blnjatuh' ".
					 "and nvl(c.status,'0')='8' ".
					  "union ".
					 "select h.nopertanggungan ".
					 "from $DBUser.tabel_200_pertanggungan h,$DBUser.tabel_242_benefit_anuitas e, ".
					 "$DBUser.tabel_500_penagih i, $DBUser.tabel_207_kode_benefit f ".
					 "where h.nopenagih=i.nopenagih and i.kdrayonpenagih='$kantor' and ".
					 "h.kdpertanggungan = '2' and h.kdstatusfile='1' ".
					 $png1.$agn1.
					 "and  e.kdbenefit=f.kdbenefit ".
					 "and h.prefixpertanggungan=e.prefixpertanggungan and h.nopertanggungan=e.nopertanggungan ".
					 "and substr(h.kdproduk,1,2) <> 'PA' ".
					 "and to_char(e.tgljatuhtempo,'MMYYYY')='$blnjatuh' ".
					 "and f.kdkelompokbenefit='$klp' ".
					 "and nvl(e.status,'0')='1') ";  	  

			//echo $sqa."<br>";			
			$DA->parse($sqa);
			$DA->execute();
			$arr=$DA->nextrow();
			$sdh = 	$arr["JML"];
			$blm = (int) $jml - (int) $sdh;
			
			$blm = ($blm==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiljtklaim.php?nopenagih=$nopenagih&noagen=$noagen&blnjatuh=$blnjatuh&klp=$klp&blm=y&rec=$blm','detiljt',900,400,1)\">".$blm."</a>";
			$sdh = ($sdh==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiljtklaim.php?nopenagih=$nopenagih&noagen=$noagen&blnjatuh=$blnjatuh&klp=$klp&blm=n&rec=$sdh','detiljt',900,400,1)\">".$sdh."</a>";
			$jml = ($jml==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiljtklaim.php?nopenagih=$nopenagih&noagen=$noagen&blnjatuh=$blnjatuh&klp=$klp&rec=$jml','detiljt',900,400,1)\">".$jml."</a>";
				 
			print( "	<tr class=hijao>\n" );
  	  print( "	 <td>$namaklaim</td>\n" );
  	  print( "	 <td align=right>".$blm."</td>\n" );
  	  print( "	 <td align=right>".$sdh."</td>\n" );
  	  print( "	 <td align=right>".$jml."</td>\n" );
  	  print( "  </tr>\n" );
  	
	 $i++;
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
  	<td width="50%" class="arial10" align="left"><a href="#" onClick="window.history.go(-1)">Back</a></td>
	  <td width="50%" class="arial10" align="right"><a href="../pelaporan/index.php">Menu Pelaporan</a></td>
	</tr>
</table>
</form>
</div>
</body>
</html>
