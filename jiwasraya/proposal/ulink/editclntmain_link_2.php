<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB = new database($userid, $passwd, $DBName);
  $namaklien=stripslashes($namaklien);


$sbrDana=array(0=> "1/Gaji","2/Hasil Usaha","3/Orang Tua","4/Hasil Investasi","5/Penghasilan Suami Istri","6/Lainnya");

	$sql= "select namaklien1,jeniskelamin,tempatlahir,to_char(tgllahir,'DD/MM/YYYY') tgllahir,".
				"kdid,noid,pendapatan,".
	      "gelar,kdagama,meritalstatus,kdpekerjaan,kdhobby,tinggibadan,beratbadan ".
				"from $DBUser.tabel_100_klien ".
				"where noklien='$noklien'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arc=$DB->nextrow();
	$tgllahir = (!$tgllahir) ? $arc["TGLLAHIR"] : $tgllahir;
	$kdid = (!$kdid) ? $arc["KDID"] : $kdid;
	$noid = (!$noid) ? $arc["NOID"] : $noid;
	$jk = (!$jeniskelamin) ? $arc["JENISKELAMIN"] : $jeniskelamin;
	$namaklien1 = (!$namaklien) ? $arc["NAMAKLIEN1"] : $namaklien;
	$gelar = (!$gelar) ? $arc["GELAR"] : $gelar;
	//echo "KAMPRET".$jk;
	
?>
<html>
<head>
<title>Edit Klien</title>
<link href="../../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript">
<!--
function CekSetuju(theForm) {
 if (theForm.pempol1.checked ||  theForm.pempre.checked || theForm.tert.checked) {
  theForm.Submit.disabled=false
 } else {
  theForm.Submit.disabled=true
 }
 if(theForm.pempol1.checked &&  theForm.pempre.checked && theForm.tert.checked){
 theForm.kdhubungan.disabled=true
 } else {
  theForm.kdhubungan.disabled=false
 }
}

function OnSumbit(porm) {
if ( (isNama(porm)) && (isTempatLahir(porm)) && (isTglLahir(porm)) && (isPendapatan(porm)) && (isPekerjaan(porm)))
if (confirm("Apakah isian sudah benar ?")) {
	return true;
} else {
	return false;      
} else
	return false;
}
function isNama(porm) {
  var str = porm.namaklien1.value;
	if (str == "") {
		alert("Nama Lengkap belum terisi !!")
		porm.namaklien1.focus();
		return false;
	}
	return true;
}

function isTempatLahir(porm) {
  var str = porm.tempatlahir.value;
	if (str == "") {
		alert("Silakan isi Tempat Lahir !!")
		porm.tempatlahir.focus();
		return false;
	}
	return true;
}

function isPendapatan(porm) {
  var str = porm.pendapatan.value;
	if (str == "") {
		alert("Silakan isi Pendapatan !!")
		porm.pendapatan.focus();
		return false;
	}
	return true;
}

function isPekerjaan(porm) {
  var str = porm.kdpekerjaan.value;
	if (str == "") {
		alert("Silakan isi Pekerjaan !!")
		porm.kdpekerjaan.focus();
		return false;
	}
	return true;
}


function isTglLahir(porm) {
	var tgllahir = porm.tgllahir.value;
	var th = parseInt(tgllahir.substring(6));
	var Skg = new Date();
	var thskg = Skg.getYear();
	var tglOK = true;
	if ( (tgllahir == "") && (tglOK) ) {
		alert("Silakan isi Tanggal Lahir !!")
		porm.tgllahir.focus();
		tglOK = false;
 	} else if (( th < 1900 ) && (tglOK)) {
  	alert ('Masukkan Tahun Kelahiran Yang Benar.\nUmurnya Terlalu Tua')
	  porm.tgllahir.focus();
	  tglOK = false;
	} else if (( th > thskg ) && (tglOK)) {
  	alert ('Masukkan Tahun Kelahiran Yang Benar.\nTidak Mungkin Lahir Tahun Mendatang'+th+thskg+tglOK)
	  porm.tgllahir.focus();
	  tglOK = false;
	} else if (( th <= thskg ) && (tglOK)){
 	  tglOK= true;
	} 	
  return tglOK;
}
//-->
</script>
</head>

<body>
<a class="verdana10blk"><b>PEMELIHARAAN DATA KLIEN</b></a>
<hr size="1">
<div align="center">
  <table border="0" cellspacing="1" cellpadding="0" class="tblborder">
    <form name="klien" action="updclntmain_link.php" method="POST" onSubmit="return OnSumbit(document.klien)">
      <tr>
        <td width="100%"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="tblisi1">
          <tr>
            <td class="verdana10blk">Nomor Klien</td>
            <td class="verdana10blk"><b><? echo $noklien; ?></b></td>
            <td colspan="2"><font color="yellow"><? echo $namaklien; ?></td>
            <td align="left"><b><font color="red">
              <? $a = ($noklien) ? 'EDIT': 'ENTRY PEMEGANG POLIS';echo $a; ?></td>
          </tr>
          <tr>
            <td class="verdana10blk">Jenis Klien</td>
            <td class="verdana10blk">I &nbsp; Individual</td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk"><p align="right">Status : <b>Aktif</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%"><table width="100%" border="0" cellpadding="2"  class="tblisi" cellspacing="4">
          <tr>
            <td class="verdana10blk">Nama Lengkap</td>
            <td class="verdana10blk"><input type="text" class="c"  onfocus="highlight(event)" name="namaklien1" size="35" value="<? echo $namaklien1; ?>" maxlength="33"></td>
            <td class="verdana10blk">Gelar Akademis</td>
            <td class="verdana10blk"><input type="text" class="c"  onfocus="highlight(event)" size="5" maxlength="5" name="gelar" value="<? echo $gelar; ?>"></td>
          </tr>
          <tr>
            <td class="verdana10blk">No Id</td>
            <td class="verdana10blk"><select class="a" onFocus="highlight(event)" size="1" name="kdid">
              <option></option>
              <? 
			   $sql = "select kdid,namaid from $DBUser.tabel_104_kartu_identitas where kdid not in ('SN','IJ') ";
				 $DB->parse($sql);
				 $DB->execute();
				 while ($arr=$DB->nextrow()) {
				   if ($arr["KDID"]==$kdid) {
		         echo "<option value=".$arr["KDID"]." selected>".$arr["NAMAID"]."</option>";
				   } else {
		         echo "<option value=".$arr["KDID"].">".$arr["NAMAID"]."</option>";
					 }
				 } 
			  ?>
            </select>
              <input type="text" class="c"  onfocus="highlight(event)" name="noid" size="20" maxlength="20" value="<? echo $noid; ?>">
            <td class="verdana10blk">Berlaku S/D</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="idexpired" size="20" maxlength="20" value="" onBlur="convert_date(idexpired)"></td>
          </tr>
          <tr>
            <td class="verdana10blk">Tempat Lahir <font color="#ff3333">*</font></td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="tempatlahir" size="30" value="<? echo $arc["TEMPATLAHIR"]; ?>">
            <td class="verdana10blk">Tanggal Lahir</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="tgllahir" size="10" value="<? echo $tgllahir; ?>" onBlur="convert_date(tgllahir)">
              <font color="#ff3333"> (DD/MM/YYYY)</font></td>
          </tr>
          <tr>
            <td class="verdana10blk">Jenis Kelamin<font color="#ff3333">&nbsp; </font></td>
            <td class="verdana10blk"><? 
		    $xxx = ($jk=="L")? "checked" : "";
		    $yyy = ($jk=="P")? "checked" : "";
		    printf("<input type=\"radio\" value=\"L\" $xxx name=\"jeniskelamin\">Laki&nbsp");
        printf("<input type=\"radio\" value=\"P\" $yyy name=\"jeniskelamin\">Perempuan");
		    ?></td>
            <td class="verdana10blk">Agama</td>
            <td class="verdana10blk"><select class="c" onFocus="highlight(event)" size="1" name="kdagama">
              <option></option>
              <?  
        $query = "select kdagama,namaagama from $DBUser.tabel_102_agama";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDAGAMA"]==$arc["KDAGAMA"]) {
		       echo "<option value=".$arr["KDAGAMA"]." selected>".$arr["NAMAAGAMA"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDAGAMA"].">".$arr["NAMAAGAMA"]."</option>";
			   }
		    }
	      ?>
            </select></td>
          </tr>
          <tr>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk"><input type="hidden" name="staWN" value="WNI"></td>
            <td class="verdana10blk">Nama Ibu Kandung</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="ibuKand" size="35" value="" maxlength="33"></td>
          </tr>
          <tr>
            <td class="verdana10blk">Pendidikan Terakhir</td>
            <td class="verdana10blk"><?
		$pendidikan=array(0=> "SD","SMP","SMA","D1/D2","D3","S1","S2","S3");
		?>
              <select class="c" onFocus="highlight(event)" size="1" name="pendAkhir">
                <?
		  for ($pend=0; $pend<8; $pend++)
     {
         //$ketlain = explode('/',$sbrLain[$pend]);
         $pddk .= "<option value='".$pendidikan[$pend]."'>".$pendidikan[$pend]."</option>";            
		 
     }
	 echo $pddk;
	 
		  ?>
              </select></td>
            <td class="verdana10blk">NPWP</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="npwp" size="20" maxlength="20" value=""></td>
          </tr>
          <tr>
            <td class="verdana10blk">Status Marital</td>
            <td class="verdana10blk"><select class="c" onFocus="highlight(event)" size="1" name="meritalstatus">
              <option></option>
              <?  
        $query = "select meritalstatus,namameritalstatus from $DBUser.tabel_103_status_pernikahan";
		    $DB->parse($query);
		    $DB->execute();
	      while($arr=$DB->nextrow()) {
		     if ($arr["MERITALSTATUS"]==$arc["MERITALSTATUS"]) {
			     echo "<option value=".$arr["MERITALSTATUS"]." selected>".$arr["NAMAMERITALSTATUS"]."</option>";
		     }  else {
			     echo "<option value=".$arr["MERITALSTATUS"].">".$arr["NAMAMERITALSTATUS"]."</option>";
		     }
		    }
	      ?>
            </select></td>
            <td class="verdana10blk">Tgl. Menikah</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="tglMenikah" size="20" maxlength="20" value=""  onBlur="convert_date(tglMenikah)">
              <font color="#ff3333">(DD/MM/YYYY)</font></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td class="verdana10blk">Alamat Sesuai KTP</td>
            <td class="verdana10blk"><input name="alamatTinggalKTP" type="text" class="c" id="alamatTinggalKTP"  onFocus="highlight(event)" value="" size="40" maxlength="75"></td>
            <td class="verdana10blk">Kota/Kabupaten</td>
            <td class="verdana10blk"><select name="kdkotamadyaKTP" size="1" class="c" id="kdkotamadyaKTP" onFocus="highlight(event)">
              <option></option>
              <?  
        $query = "select kdkotamadya,namakotamadya from $DBUser.tabel_109_KOTAMADYA";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDKOTAMADYA"]==$arc["KDKOTAMADYA"]) {
		       echo "<option value=".$arr["KDKOTAMADYA"]." selected>".$arr["NAMAKOTAMADYA"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDKOTAMADYA"].">".$arr["NAMAKOTAMADYA"]."</option>";
			   }
		    }
	      ?>
            </select></td>
          </tr>
          <tr>
            <td class="verdana10blk"></td>
            <td class="verdana10blk"><input name="alamatTinggalKTP2" type="text" class="c" id="alamatTinggalKTP2"  onFocus="highlight(event)" value="" size="40" maxlength="75">
              </textarea></td>
            <td class="verdana10blk"></td>
            <td class="verdana10blk"></td>
          </tr>
          <tr>
            <td class="verdana10blk">Propinsi</td>
            <td class="verdana10blk"><select name="kdpropinsiKTP" size="1" class="c" id="kdpropinsi" onFocus="highlight(event)">
              <option></option>
              <?  
        $query = "select kdpropinsi,namapropinsi from $DBUser.tabel_108_propinsi";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDPROPINSI"]==$arc["KDPROPINSI"]) {
		       echo "<option value=".$arr["KDPROPINSI"]." selected>".$arr["NAMAPROPINSI"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDPROPINSI"].">".$arr["NAMAPROPINSI"]."</option>";
			   }
		    }
	      ?>
            </select></td>
            <td class="verdana10blk">Kode Pos</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="kdposKTP" size="20" maxlength="5" value=""></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td class="verdana10blk">Status Tempat Tinggal</td>
            <td class="verdana10blk"><select class="c" onFocus="highlight(event)" size="1" name="staTptTinggal">
              <option value="sendiri">Milik Sendiri</option>
              <option value="sewa">Sewa</option>
              <option value="lainnya">Lainnya</option>
            </select></td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr>
            <td class="verdana10blk">Alamat Tinggal Saat Ini</td>
            <td class="verdana10blk"><input name="alamatTinggal" type="text" class="c" id="alamatTinggal"  onFocus="highlight(event)" value="" size="40" maxlength="75"></td>
            <td class="verdana10blk">Kota/Kabupaten</td>
            <td class="verdana10blk"><select name="kdkotamadya" size="1" class="c" id="kdkotamadya" onFocus="highlight(event)">
              <option></option>
              <?
        $query = "select kdkotamadya,namakotamadya from $DBUser.tabel_109_KOTAMADYA";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDKOTAMADYA"]==$arc["KDKOTAMADYA"]) {
		       echo "<option value=".$arr["KDKOTAMADYA"]." selected>".$arr["NAMAKOTAMADYA"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDKOTAMADYA"].">".$arr["NAMAKOTAMADYA"]."</option>";
			   }
		    }
	      ?>
            </select></td>
          </tr>
          <tr>
            <td class="verdana10blk"></td>
            <td class="verdana10blk"><input name="alamatTinggal2" type="text" class="c" id="alamatTinggal2"  onFocus="highlight(event)" value="" size="40" maxlength="75">
              </textarea></td>
            <td class="verdana10blk"></td>
            <td class="verdana10blk"></td>
          </tr>
          <tr>
            <td class="verdana10blk">Propinsi</td>
            <td class="verdana10blk"><select name="kdpropinsi" size="1" class="c" id="kdpropinsi" onFocus="highlight(event)">
              <option></option>
              <?
        $query = "select kdpropinsi,namapropinsi from $DBUser.tabel_108_propinsi";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDPROPINSI"]==$arc["KDPROPINSI"]) {
		       echo "<option value=".$arr["KDPROPINSI"]." selected>".$arr["NAMAPROPINSI"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDPROPINSI"].">".$arr["NAMAPROPINSI"]."</option>";
			   }
		    }
	      ?>
            </select></td>
            <td class="verdana10blk">Kode Pos</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="kdpos" size="20" maxlength="5" value=""></td>
          </tr>
          <tr>
            <td class="verdana10blk">No. Telp. Rumah</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="phonetetap" size="20" maxlength="20" value=""></td>
            <td class="verdana10blk">No. Fax. Rumah</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="faxRumah" size="20" maxlength="20" value=""></td>
          </tr>
          <tr>
            <td class="verdana10blk">No. Ponsel 1</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="no_ponsel" size="20" maxlength="20" value=""></td>
            <td class="verdana10blk">No. Ponsel 2</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="no_ponsel2" size="20" maxlength="20" value=""></td>
          </tr>
          <tr>
            <td class="verdana10blk">Email</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="emailtetap" size="20" value=""></td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk">Apakah khusus korespondensi rutin bersedia disampaikan hanya dalam bentuk Email
              <input type="radio" name="tujuanEmail" id="tujuanEmail" value="Yes">
              Ya&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="tujuanEmail" id="tujuanEmail" value="No">
              Tidak </td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td class="verdana10blk">Alamat Korespondensi</td>
            <td class="verdana10blk"><input name="alamatTinggalKP" type="text" class="c" id="alamatTinggalKP"  onFocus="highlight(event)" value="" size="40" maxlength="75"></td>
            <td class="verdana10blk">Kota/Kabupaten</td>
            <td class="verdana10blk"><select name="kdkotamadyaKP" size="1" class="c" id="kdkotamadyaKP" onFocus="highlight(event)">
              <option></option>
              <?
        $query = "select kdkotamadya,namakotamadya from $DBUser.tabel_109_KOTAMADYA";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDKOTAMADYA"]==$arc["KDKOTAMADYA"]) {
		       echo "<option value=".$arr["KDKOTAMADYA"]." selected>".$arr["NAMAKOTAMADYA"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDKOTAMADYA"].">".$arr["NAMAKOTAMADYA"]."</option>";
			   }
		    }
	      ?>
            </select></td>
          </tr>
          <tr>
            <td class="verdana10blk"></td>
            <td class="verdana10blk"><input name="alamatTinggalKP2" type="text" class="c" id="alamatTinggalKP2"  onFocus="highlight(event)" value="" size="40" maxlength="75">
              </textarea></td>
            <td class="verdana10blk"></td>
            <td class="verdana10blk"></td>
          </tr>
          <tr>
            <td class="verdana10blk">Propinsi</td>
            <td class="verdana10blk"><select name="kdpropinsiKP" size="1" class="c" id="kdpropinsiKP" onFocus="highlight(event)">
              <option></option>
              <?
        $query = "select kdpropinsi,namapropinsi from $DBUser.tabel_108_propinsi";
		    $DB->parse($query);
		    $DB->execute();
    	  while($arr=$DB->nextrow()) {
		     if ($arr["KDPROPINSI"]==$arc["KDPROPINSI"]) {
		       echo "<option value=".$arr["KDPROPINSI"]." selected>".$arr["NAMAPROPINSI"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDPROPINSI"].">".$arr["NAMAPROPINSI"]."</option>";
			   }
		    }
	      ?>
            </select></td>
            <td class="verdana10blk">Kode Pos</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="kdposKP" size="20" maxlength="20" value=""></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk">Pekerjaan (jelaskan tugas dan bidang usaha)</td>
          </tr>
          <tr>
            <td class="verdana10blk">Nama Perusahaan</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="namaPers" size="30" value=""></td>
            <td class="verdana10blk">Alamat Perusahaan</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="almtPers" size="40" value=""></td>
          </tr>
          <tr valign="top">
            <td class="verdana10blk">Bidang Pekerjaan</td>
            <td class="verdana10blk"><input name="bidangkerja" type="text" class="c" id="bidangkerja"  onFocus="highlight(event)" value="" size="30"></td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr valign="top">
            <td class="verdana10blk">No. Telp. Kantor</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="telpPers" size="20" maxlength="20" value=""></td>
            <td class="verdana10blk">No. Fax. Perusahaan</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="faxPers" size="20" maxlength="20" value=""></td>
          </tr>
          <tr>
            <td class="verdana10blk">Jabatan/Pangkat/Golongan</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="jabatan" size="20" maxlength="20" value=""></td>
            <td class="verdana10blk">Pekerjaan <font color="#ff3333">* </font></td>
            <td class="verdana10blk"><select class="c" onFocus="highlight(event)" size="1" name="kdpekerjaan">
              <option></option>
              <?  
        $query = "select kdpekerjaan,namapekerjaan from $DBUser.tabel_105_pekerjaan";
		    $DB->parse($query);
		    $DB->execute();
        while($arr=$DB->nextrow()) {
		     if ($arr["KDPEKERJAAN"]==$arc["KDPEKERJAAN"]) {
		       echo "<option value=".$arr["KDPEKERJAAN"]." selected>".$arr["NAMAPEKERJAAN"]."</option>";
		     } else {
		       echo "<option value=".$arr["KDPEKERJAAN"].">".$arr["NAMAPEKERJAAN"]."</option>";
			   }
		    }
	      ?>
            </select></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td colspan="2" class="verdana10blk"><strong>Jika Usaha Sendiri (Wiraswasta)</strong></td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr>
            <td class="verdana10blk">Keterangan Usaha</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="ketUsaha" size="20" maxlength="20" value=""></td>
            <td class="verdana10blk">Bidang Usaha</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="bidUsaha" size="20" maxlength="20" value=""></td>
          </tr>
          <tr>
            <td class="verdana10blk">Nama Usaha </td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="namaUsaha" size="20" maxlength="20" value=""></td>
            <td class="verdana10blk">Alamat Usaha</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="almtUsaha" size="20" maxlength="20" value=""></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td class="verdana10blk">Sumber Dana</td>
            <td class="verdana10blk"><select name="sumberDana2">
              ";
     
          
              <? 
	 for ($kdsrc=0; $kdsrc<6; $kdsrc++)
     {
         $ketdana = explode('/',$sbrDana[$kdsrc]);
         $content .= "<option value='".$ketdana[0]."'>".$ketdana[1]."</option>";            
		 
     }
	 echo $content;
	 
     ?>
            </select>
              <!--<select class="c" onFocus="highlight(event)" size="1" name="sumberDana">
          <option>Gaji</option>
          <option>Hasil Usaha</option>
          <option>Orang Tua</option>
          <option>Hasil Investasi</option>
          <option>Penghasilan Suami/Istri</option>
          <option>Lainnya</option>
        </select>--></td>
            <td class="verdana10blk">Sumber Penghasilan Lain </td>
            <td class="verdana10blk"><select name="sumberDanaLain2">
              ";
     
          
              <? 
	 $sbrLain=array(0=> "1/Bonus","2/Komisi","3/Penjualan Aset","4/Hasil Investasi","5/Hibah","6/Warisan","7/Lainnya");
	 for ($kdlain=0; $kdlain<6; $kdlain++)
     {
         $ketlain = explode('/',$sbrLain[$kdlain]);
         $isi .= "<option value='".$ketlain[0]."'>".$ketlain[1]."</option>";            
		 
     }
	 echo $isi;
	 
     ?>
            </select>
              <!--<select class="c" onFocus="highlight(event)" size="1" name="sumberDanaLain">
          <option>Bonus</option>
          <option>Komisi</option>
          <option>Penjualan Asset</option>
          <option>Hasil Investasi</option>
          <option>Hibah</option>
          <option>Warisan</option>
          <option>Lainnya</option>-->
              </select></td>
          </tr>
          <tr>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" class="verdana10blk">Besar Pendapatan PerBulan</td>
            <td class="verdana10blk"><!--Gaji Bulanan <font color="#ff3333">* </font>--></td>
            <td class="verdana10blk"><!--<input type="text" class="c"  onfocus="highlight(event)" name="pendapatan" size="15" value="<? echo $arc["PENDAPATAN"]; ?>"><font color="#ff3333"> (Isi HANYA Numerik/Angka)</font>--></td>
          </tr>
          <tr>
            <td class="verdana10blk"><input type="radio" name="gajiPerbulan" value="<5000000" id="gajiPerbulan">
              0 s/d 5.000.000</td>
            <td class="verdana10blk"><input type="radio" name="gajiPerbulan" value="5000001-15000000" id="gajiPerbulan">
              5.000.001 s/d 15.000.001</td>
            <td class="verdana10blk"><input type="radio" name="gajiPerbulan" value="15000001-25000000" id="gajiPerbulan">
              15.000.001 s/d 25.000.000</td>
            <td class="verdana10blk"><input type="radio" name="gajiPerbulan" value="25000001-50000000" id="gajiPerbulan">
              25.000.001 s/d 50000000</td>
          </tr>
          <tr>
            <td class="verdana10blk"><input type="radio" name="gajiPerbulan" value="50000001-100000000" id="gajiPerbulan">
              50.000.001 s/d 100.000.000</td>
            <td class="verdana10blk"><input type="radio" name="gajiPerbulan" value="100000001-250000000" id="gajiPerbulan">
              100.000.001 s/d 250.000.000</td>
            <td class="verdana10blk"><input type="radio" name="gajiPerbulan" value=">250000000" id="gajiPerbulan">
              >250.000.000</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk">Alamat Surat Menyurat (<i>Diisi hanya jika berbeda dengan <br>
              alamat tempat tinggal Calon Pemegang Polis</i>)</td>
          </tr>
          <tr>
            <td class="verdana10blk" valign="top">Alamat</td>
            <td colspan="2" class="verdana10blk"><label>
              <input type="radio" name="alamatSurat" value="KANTOR" id="alamatSurat">
              Kantor</label>
              &nbsp;&nbsp;&nbsp;
              <label>
                <input type="radio" name="alamatSurat" value="RUMAH LAIN" id="alamatSurat">
                Rumah</label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="alamatSurat" value="LAINNYA" id="alamatSurat">
                Lainnya</label></td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <tr>
            <td class="verdana10blk">Nama Istri / Suami</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="suamiIstri" size="20" maxlength="20" value=""></td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
          <tr>
            <td class="verdana10blk" valign="top">Nama Kantor Atau Tempat<br />
              Bekerja Istri / Suami</td>
            <td class="verdana10blk" valign="top"><textarea name="ktrSuamiIstri" id="ktrSuamiIstri" cols="35" rows="3"></textarea></td>
            <td class="verdana10blk" valign="top">Alamat Kantor atau Tempat<br />
              Bekerja Istri / Suami</td>
            <td class="verdana10blk" valign="top"><textarea name="almKtrSuamiIstri" id="almKtrSuamiIstri" cols="35" rows="3"></textarea></td>
          </tr>
          <tr>
            <td colspan="4" class="verdana10blk"><hr></td>
          </tr>
          <!--<tr>
            <td class="verdana10blk">Apakah Anda Seorang Perokok</td>
            <td class="verdana10blk"><input type="checkbox" name="merokok" value="Ya"></td>
            <td class="verdana10blk">Jika Ya Sejak Kapan :</td>
            <td class="verdana10blk"><input type="text" class="c"  onFocus="highlight(event)" name="tglmulairokok" size="20" maxlength="20" value="">
              ,
              <input type="text" class="c"  onFocus="highlight(event)" name="rokokperhari" size="5" maxlength="20" value="">
              btg/hari</td>
          </tr>-->
          <tr>
            <td class="verdana10blk">Tinggi/Berat Badan</td>
            <td class="verdana10blk"><input type="text" class="c"  onfocus="highlight(event)" name="tinggibadan" size="3" maxlength="3" value="<? echo $arc["TINGGIBADAN"]; ?>">
              cm
              <input type="text" class="c"  onfocus="highlight(event)" name="beratbadan" size="3" maxlength="3" value="<? echo $arc["BERATBADAN"]; ?>">
              kg </td>
            <td class="verdana10blk">Merokok</td>
            <td class="verdana10blk"><label>
              <input type="radio" name="merokok" value="1" id="merokok">
              Ya</label>
              &nbsp;&nbsp;&nbsp;
              <label>
                <input type="radio" name="merokok" value="0" id="merokok">
                Tidak</label></td>
          </tr>
          <tr>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
            <td class="verdana10blk">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr class="tblisi1">
        <td width="100%"><font color="#ff3333"> &nbsp;&nbsp;)* Field Wajib Diisi </font>
          <div align="center">
            <?
    if (!$noklien) {
		  print( "<input type=\"hidden\" name=\"mode\" value=\"insert\">\n" );
		} else {
		  print( "<input type=\"hidden\" name=\"mode\" value=\"update\">\n" );
  		print( "<input type=\"hidden\" name=\"noklien\" value=\"".$noklien."\">\n" );
		}
		$sql = "select prefixpertanggungan,nopertanggungan ".
		       "from $DBUser.tabel_200_pertanggungan ".
			     "where notertanggung='$noklien' and kdpertanggungan='2' and kdstatusfile in ('1','4') ".
			     "order by prefixpertanggungan,nopertanggungan";
    $DB->parse($sql);
    $DB->execute();
    $coun=0;
    while ($ari=$DB->nextrow()) {
     $coun++;
    } 		
    //if ($coun==0) {
   /* if($_GET['mode']=="tertpempol"){
	echo "<input type=hidden name=model value=tertpempol>";
	}elseif($_GET['mode']=="pempol"){
		echo "<input type=hidden name=model value=pempol>";
	}else{
		echo "<input type=hidden name=model value=tert>";
	}  */
	$sql="select kdhubungan,namahubungan from $DBUser.tabel_218_kode_hubungan";
	$DB->parse($sql);
	$DB->execute();
	$result=$DB->result();
	?>
            <input type="submit" name="Submit" value="Submit">
          </div></td>
      </tr>
    </form>
  </table>
</div>
<hr size="1">
<a href="entryklien_ul.php"><font face="Verdana" size="2">Back</font></a>
</body>
</html>
