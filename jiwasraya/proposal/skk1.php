<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 

  $noproposal=$nopertanggungan;
	$DB = New database($userid, $passwd, $DBName);	
  $today = date("d F Y");
	//$PER = New Pertanggungan($userid,$passwd,$kantor,$noproposal);

if ($submit=='Lanjut') {
	$alamatkerja=strtoupper($alamatkerja); 
	$alamattetap01=strtoupper($alamattetap01);
  $qry="update $DBUser.tabel_100_klien set kdpekerjaanlama='$kdpekerjaanlama',alamatkerja='$alamatkerja',".
	     "kdgantipekerjaan='$kdgantipekerjaan',tglkawin=to_date('$tglkawin','DD/MM/YYYY') ".
		   "where noklien='$noklien'";
	$DB->parse($qry);
  $DB->execute();
  $DB->commit;
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "window.location.replace('skk2.php?noproposal=".$proposalno."&tglmutasi=".$tglmutasi."&jnscari=".$jnscari."');\n" );
  print( "</script> \n" );
} 
else 
{

  $sql ="select a.noklien,a.namaklien1 pemegangpolis,a.tempatlahir,a.kdpekerjaan,a.alamattetap01,a.alamatkerja, ".
			 "decode(a.jeniskelamin,'L','LAKI-LAKI','P','PEREMPUAN') jeniskelamin,a.tinggibadan,a.beratbadan, ".
			 "a.meritalstatus, decode(a.meritalstatus,'D','DDUDA','J','JANDA','L','LAJANG','K','KAWIN') namameritalstatus, ".
       "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir,to_char(a.tglkawin,'DD/MM/YYYY') nganten, ".
			 "c.namapekerjaan,a.kdpekerjaanlama,a.kdgantipekerjaan,d.namaid,a.noid,a.kdid, ".
			 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.notertanggung) tertanggung, b.nopolbaru, b.nopertanggungan ".
       "from ".
			 "$DBUser.tabel_100_klien a, $DBUser.tabel_200_pertanggungan b, ".
			 "$DBUser.tabel_105_pekerjaan c, $DBUser.tabel_104_kartu_identitas d ".
		   "where a.noklien=b.notertanggung and a.kdpekerjaan=c.kdpekerjaan(+) and a.kdid=d.kdid(+) and ".
		   "((b.prefixpertanggungan='$kantor' and b.nopertanggungan='$noproposal') OR b.nopolbaru = '$nopolbaru')";
  //echo $sql;
	$DB->parse($sql);
  $DB->execute();
  $arr=$DB->nextrow();
	
?>
<html>
<head>
<title>Data Pribadi Tertanggung</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<?
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "function OnLod(){\n" );
	$sql="select kdpekerjaan,namapekerjaan from $DBUser.tabel_105_pekerjaan order by namapekerjaan";
	$DB->parse($sql);
	$DB->execute();
	$i=0;
	while($data=$DB->nextrow()){
	  if ($arr["KDPEKERJAANLAMA"]==$data["KDPEKERJAAN"]) {												
	    print("document.skk1.kdpekerjaanlama.options[".$i."].selected='true';\n" );
	  }
  	$i++;
  }	
  if ($arr["KDGANTIPEKERJAAN"]) {
	  print("document.skk1.kdgantipekerjaan[0].checked='true';\n" );
  }
	print("document.skk1.alamatkerja.value='".$arr["ALAMATKERJA"]."';\n" );
  print( "}\n" );
  print( "</script>" );
?>
</head>
<body onLoad="OnLod()">
<div align="center">
<form name="skk1" action="<? echo $PHP_SELF;?>" method="post">
<table align="center" border="0" width="700" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%"  cellpadding="0" cellspacing="0">
        <tr>
				  <td width="16%" colspan="2" class="arial10">Nomor Proposal</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><!--?echo $kantor." - ".$noproposal;?--><?=$arr['NOPOLBARU']?></td><br>
				  <td width="53%" colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar,</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><?echo $today;?></td>
        	<td width="53%" colspan="3" class="verdana8" align="center">Beri Tanda V Pada Kolom Yang Sesuai.</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tertanggung</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb" align="left">
					<?	
					 echo $arr["TERTANGGUNG"];
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $PER->notertanggung." - ".$KLIEN->nama; 
						?></td>
          <td width="16%" class="arial8ab"></td>
					<td width="35%"></td>
					<td width="2%" class="arial8ab"></td>
        </tr>
      </table>
      <table border="0" width="100%">
        <tr>
          <td width="100%" class="hijao" align="center">J A T I D I R I</td>
        </tr>
        </table>
      <table border="0" width="100%">
        <tr class="hijau">
          <td width="2%"></td>
          <td width="98%" class="arial10" colspan="4">Saya Yang Bertanda-tangan di Bawah Ini :</td>
        </tr>
        <tr>
          <td width="2%"></td>
          <td width="4%">-</td>
          <td width="43%" class="arial10">Nama Lengkap</td>
          <td width="2%">:</td>
          <td width="49%"><input type="text" class="a" name="namaklien1"  size="45" readonly value=<? echo $arr["PEMEGANGPOLIS"] ?>></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Jenis Kelamin</td>
          <td width="%">:</td>
          <td width="%"><input type="text" class="a" name="jeniskelamin" size="45" readonly value=<? echo $arr["JENISKELAMIN"] ?>></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Status Pernikahan</td>
          <td width="%">:</td>
          <td width="%"><input type="text" class="a" name="meritalstatus"  size="45" readonly value=<? echo $arr["NAMAMERITALSTATUS"] ?>></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Tanggal Nikah</td>
          <td width="%">:</td>
          <td width="%">
						<input type="text" class="c" name="tglkawin" onFocus="highlight(event)" onBlur="convert_date(tglkawin)" size="10" maxlength="10" value=<? echo $arr["NGANTEN"]?>><font face="arial" size="4" color="#ff0000">*</font>&nbsp;&nbsp;
						<font class="verdana9barak">(Format Tanggal DD/MM/YYYY) !!</font></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Tanggal dan Tempat Lahir</td>
          <td width="%">:</td>
          <td width="%">
						<input type="text" class="a" name="tgllahir" size="10"  readonly value=<? echo $arr["TGLLAHIR"] ?>>&nbsp;&nbsp;di&nbsp;
						<input type="text" class="a" name="tempatlahir" size="25"  readonly value=<? echo $arr["TEMPATLAHIR"] ?>>
					</td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Pekerjaan Sekarang</td>
          <td width="%">:</td>
          <td width="%"><input type="text" class="a" name="namapekerjaan" size="45" readonly value=<? echo $arr["NAMAPEKERJAAN"] ?>></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Pekerjaan Sebelumnya</td>
          <td width="%">:</td>
          <td width="%">
						<select class="a" size="1" name="kdpekerjaanlama" onFocus="highlight(event)">
            <?
            $sql="select kdpekerjaan, namapekerjaan from $DBUser.tabel_105_pekerjaan order by namapekerjaan";
            $DB->parse($sql);
            $DB->execute();
            while($data=$DB->nextrow()){
              echo "<option value=".$data["KDPEKERJAAN"].">".$data["NAMAPEKERJAAN"]."</option>";
            }
            ?>
          	</select><font face="arial" size="4" color="#ff0000">*</font></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Pernahkan Saudara Berganti Pekerjaan Karena Alasan Kesehatan?</td>
          <td width="%">:</td>
          <td width="%">
						<input type="radio" value="1" name="kdgantipekerjaan">&nbsp;&nbsp;<font face="verdana" size="2">Pernah</face>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" value="0" checked name="kdgantipekerjaan">&nbsp;&nbsp;<font face="verdana" size="2">Tidak</font></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Berat & Tinggi Badan</td>
          <td width="%">:</td>
          <td width="%" class="arial10">
					  <input type="text" class="a" name="beratbadan" size="2" readonly value=<? echo $arr["BERATBADAN"]?>>
						&nbsp;Kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  <input type="text" class="a" name="tinggibadan" size="2" readonly value=<? echo $arr["TINGGIBADAN"]?>>
						&nbsp;Cm
					</td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Tempat Tinggal</td>
          <td width="%">:</td>
          <td width="%"><input class="a" type="text" name="alamattetap01" size="45" readonly value=<? echo $arr["ALAMATTETAP01"] ?>></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Tempat Bekerja</td>
          <td width="%">:</td>
          <td width="%"><input class="c" type="text" name="alamatkerja" onFocus="highlight(event)" size="45" maxlength="50" value=<? echo $arr["ALAMATKERJA"]?>><font face="arial" size="4" color="#ff0000">*</font></td>
        </tr>
        <tr>
          <td width="%"></td>
          <td width="%">-</td>
          <td width="%" class="arial10">Identitas Diri</td>
          <td width="%">:</td>
          <td width="%" class="arial10">
						<input type="text" class="a" name="namaid" size="8" readonly value=<? echo $arr["NAMAID"] ?>>&nbsp;&nbsp;Nomor&nbsp;:&nbsp;
						<input type="text" class="a" name="noid" readonly value=<? echo $arr["NOID"] ?>>
					</td>
				</tr>
       </table>
      <p></p>	
    </td>
  </tr>
</table>
<table width="700" align="center">
  <tr>
	  <td align="left" class="arial10"><a href="#" onClick="window.history.go(-1)">Back</a></td>
    <td align="right">
		  <input type="text" name="noklien" value=<? echo $arr["NOKLIEN"]; ?>>
			<input type="hidden" name="proposalno" value=<? echo $arr['NOPERTANGGUNGAN']; ?>>
			<input type="hidden" name="tglmutasi" value=<?=$tglmutasi;?>>
			<input type="hidden" name="jnscari" value=<?=$jnscari;?>>
			<input type="submit" name="submit" value="Lanjut">
		</td>
  </tr>
</table>
</form>
</body>
</html>
<?}?>
