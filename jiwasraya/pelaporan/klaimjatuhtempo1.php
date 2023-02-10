<?
/***************************************************************************
    Begin                : Udi Aug 29, 2001
		Last Modification		 : Oct ,26 by Lolin 
    copyright            : (C) 2002 by PrimaLogic Inter Asia
    email                : udi@plitasoft.com
***************************************************************************/

  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/tanggal.php";

$DA=new Database($userid, $passwd, $DBName);
$DB=new Database($userid, $passwd, $DBName);

?>
<html>
<head>
<title>Klaim JAtuh Tempo</title>
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
				<td colspan="2"><input class="c" onfocus="highlight(event)" type="text" name="nopenagih" size="10" maxlength="10"  value="<? echo $nopenagih;?>" onblur="validasi10(this.form.nopenagih)">
		     <a href="#" onclick="NewWindow('../proposal/pnglist.php?a=ntryclnthub&b=nopenagih','',500,300,1)"><img src="../img/jswindow.gif" alt="Daftar Penagih" border="0"></a>
				</td>
		</tr>
  	<tr>
    		<td align="left" class="arial10">Nomor Agen <font face="Verdana" color="red" size="1">(Kosongkan Untuk Klaim Per Kantor)</td>
				<td>:</td>
				<td colspan="2"><input class="c" onfocus="highlight(event)" type="text" name="noagen" size="10" maxlength="10"  value="<? echo $noagen;?>" onblur="validasi10(this.form.noagen)">
		     <a href="#" onclick="NewWindow('../proposal/agnlist.php?a=ntryclnthub&b=noagen','',500,300,1)"><img src="../img/jswindow.gif" alt="Daftar Agen" border="0"></a>
				</td>
		</tr>
  	<tr>
				<td align="left" class="arial10" width="70%">Bulan/Tahun Jatuh Tempo <font face="Verdana" color="red" size="1">(format MMYYYY)</td>
				<td width="1%">:</td>
				<td><input class="c" type="text" name="blnjatuh" size="6" maxlength="6" value="<? echo $blnjatuh;?>"  onfocus="highlight(event)"></td>
	      <td><input class="buton" name="buton" type="submit" value="Submit"></td>
		</tr>
		<tr class="tblhead1">
		 <td colspan="4">Masukkan Parameter Diatas. Klik Jumlah Untuk Melihat Detil</td>
		</tr>
		</table>
		</td>
  </tr>
	

	
	<tr class="tblhead">
	<td>
	<table border="0" cellpadding="1" cellspacing="1" width="600" class="tblhead1">
	  <tr class="tblhead">
     <td width="100%" colspan="4" align="center" class="arial12whtb">DAFTAR JATUH TEMPO KLAIM UNTUK BULAN  <? echo substr($blnjatuh,0,2)."/".substr($blnjatuh,2); ?></td>
    </tr>	
    <tr class="tblhead">
  	  <td align=center width=34% rowspan="2">JENIS KLAIM</td>
  	  <td align=center width=14% colspan="2">KLAIM ASURANSI</td>
		  <td align=center width=14% rowspan="2">T O T A L</td>
  	</tr>
	  <tr>
  	  <td align=center width=14%><font size=1>BELUM</td>
  	  <td align=center width=14%><font size=1>SUDAH</td>
  	</tr>
		
				
<?
if ($blnjatuh) {
	
	$png=(!$nopenagih||$nopenagih=='') ? "and a.nopenagih in (select nopenagih from $DBUser.tabel_500_penagih where  kdrayonpenagih='$kantor') " : "and a.nopenagih='$nopenagih' ";
  $agn=(!$noagen||$noagen=='') ? "" : "and a.noagen='$noagen' ";
  
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
	
		$sqa = "select sum(a.jml) jml, sum(a.sdh) sdh ".
				   "from $DBUser.klaimjt a ".
					 "where to_char(a.tglbooked,'MMYYYY')='$blnjatuh' ".
					 "and a.kdkelompokbenefit='$klp' ".
					 $png.$agn.	 
					 "";
			//echo $sqa."<br>";			
			$DA->parse($sqa);
			$DA->execute();
			$arr=$DA->nextrow();
			$jml = 	$arr["JML"];
			$sdh = 	$arr["SDH"];
			$blm = (int) $jml - (int) $sdh;
			
			$blm = ($blm==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiljtklaim.php?nopenagih=$nopenagih&noagen=$noagen&blnjatuh=$blnjatuh&klp=$klp&blm=y','detiljt',900,400,1)\">".$blm."</a>";
			$sdh = ($sdh==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiljtklaim.php?nopenagih=$nopenagih&noagen=$noagen&blnjatuh=$blnjatuh&klp=$klp&blm=n','detiljt',900,400,1)\">".$sdh."</a>";
			$jml = ($jml==0) ? '&nbsp;' : "<a href=\"#\" onclick=\"NewWindow('../pelaporan/detiljtklaim.php?nopenagih=$nopenagih&noagen=$noagen&blnjatuh=$blnjatuh&klp=$klp','detiljt',900,400,1)\">".$jml."</a>";
				 
			include "../../includes/belang.php";
  	  print( "	 <td class=arial10>$namaklaim</td>\n" );
  	  print( "	 <td class=arial10 align=right>".$blm."</td>\n" );
  	  print( "	 <td class=arial10 align=right>".$sdh."</td>\n" );
  	  print( "	 <td class=arial10 align=right>".$jml."</td>\n" );
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
  	<td width="50%" class="arial10" align="left"><a href="#" onclick="window.history.go(-1)">Back</a></td>
	  <td width="50%" class="arial10" align="right"><a href="../pelaporan/index.php">Menu Pelaporan</a></td>
	</tr>
</table>
</form>
</div>
</body>
</html>
