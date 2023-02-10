<?php
	include "../../includes/session.php";
	include "../../includes/roleptg.php";
	include "../../includes/database.php";
	
	$DB=New database($userid, $passwd, $DBName);
	
	$sql = "SELECT to_char(sysdate, 'dd/mm/yyyy') tanggal FROM DUAL";
	$DB->parse($sql);
	$DB->execute();
	$r = $DB->nextrow();
	$tanggal = $r['TANGGAL'];
	
	$sql = "SELECT a.kdproduk, a.namaproduk, a.keterangan
			FROM $DBUser.tabel_202_produk a
			INNER JOIN $DBUser.tabel_202_produk_kantor b ON a.kdproduk = b.kdproduk
			WHERE b.kdkantor = '$kantor'
				AND status IS NULL
				AND a.kdproduk IN ('JSR1', 'JSR2', 'JSR3')
			ORDER BY a.kdproduk";
	$DB->parse($sql);
	$DB->execute();
	$produk = $DB->result();
	
	$sql = "SELECT kdbank, namabank 
			FROM $DBUser.tabel_399_bank 
			WHERE kdbank <> 'POS' 
			ORDER BY namabank";
	$DB->parse($sql);
	$DB->execute();
	$bank = $DB->result();
?>
<html>
<head>
	<title>PT Asuransi Jiwa IFG Private Network</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<link href="../../includes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style type='text/css'>
		table.tblisi tr td {
			font-family:arial;
			font-size:10pt;
			text-align:left;
		}
		table.tblisi tr td.right {
			text-align:right;
		}
	</style>
	<script language="JavaScript" type="text/javascript" src="../../includes/jquery.min.js" ></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/entryprop.js"></script>
</head>
<body topmargin="0">
<div align="center">
<br>
<table border="0" cellpadding="1" cellspacing="1" width="800" class="tblborder">
	<tr>
		<td class="tblhead" align="center" width="100%">ENTRY PROPOSAL BARU</td>
	</tr>
	<tr>
		<td width="100%">
			<form name="ntryprop" method="post" action="insprop.php?<? echo $SID; ?>" onSubmit="return OnSumbit(document.ntryprop);disableForm(this);">
			<table border="0" width="100%" cellspacing="0" cellpadding="1" class="tblisi">
				<tr bgcolor="#ffff91">
					<td><b>Jenis Polis Baru</b></td>
					<td>:</td>
					<td colspan="5">
						<input type="checkbox" id="taltup" name="taltup" value="1" onClick="return false"> Taltup
					</td>
				</tr>
				<tr>
					<td width="15%">Nomor SPAJ</td>
					<td width="2%">:</td>
					<td width="25%">
						<input type="text" readonly name="nosp" size="11" maxlength="11" class="c" title="Nomor SPAJ" onFocus="highlight(event)" value="<? echo $nosp; ?>">
						<input type="button" value="No.SPAJ"  onclick="NewWindow('ulink/spajol.php','popuppage',600,400,1);" class="buton">
					</td>
					<td width="20%" class="right">Prefix</td>
					<td width="2%">:</td>
					<td width="20%"><?=$kantor?></td>
					<td width="16%"></td>
				</tr>
				<tr>
					<td>No Tertanggung</td>
					<td>:</td>
					<td>
						<input type="text" readonly name="notertanggung" size="11"  maxlength="10" class="a" value="<? echo $nottg; ?>">
						<input type="button" value="Cari Klien" name="cari" class="buton" onClick="Klear(document.ntryprop);Cari(this.form);" onBlur="javascript:TanggalMulas()" >
					</td>
					<td class="right">Tanggal SPAJ</td>
					<td>:</td>
					<td><input type="text" name="tglsp" size="10" maxlength="10" onBlur="javascript:convert_date(tglsp);CekAwalMulas(document.ntryprop);" class="c" title="Tanggal Proposal" onFocus="highlight(event)" value="<?=$tanggal?>"></td>
					<td></td>
				</tr>
				<tr>
					<td>Kode Produk</td>
					<td>:</td>
					<td colspan="5" >
						<img src="../img/jswindow.gif" border="0" alt="lihat produk" style="cursor:pointer;" onClick="openWin('popupprod.php');">
						<select name="produk" class="c" onfocus="highlight(event)" title="Produk Asuransi">
							<option value="">-- Silahkan Pilih --</option>
							<?php foreach ($produk as $i => $v) {
								echo "<option value='$v[KDPRODUK]'>$v[KDPRODUK] -- $v[NAMAPRODUK] $v[KETERANGAN]</option>";
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Cara Bayar</td>
					<td>:</td>
					<td colspan="5">
						<select name="carabayar" class="c" onfocus="highlight(event)">
						</select>
					</td>
				</tr>
				<tr>
					<td>Medical</td>
					<td>:</td>
					<td colspan="5">
						<input type="radio" name="kdstatusmedical" value="M" title="Medical">Ya
						<input type="radio" name="kdstatusmedical" value="N" title="non Medical" checked="checked">Tidak
					</td>
				</tr>
				<tr>
					<td>Tgl Mulai Ass</td>
					<td>:</td>
					<td><input type="text" name="mulas" size="10" maxlength="10" class="c" onFocus="highlight(event)" value="01/<?=date('m/Y')?>"></td>
					<td class="right">Usia</td>
					<td>:</td>
					<td><input type="text" name="usia_th" size="3" maxlength="3" class="a" readonly  value="<? echo $usith; ?>" onBlur="javascript:CekUsiaCabar();"> tahun</td>
					<td><input type="text" name="usia_bl" size="3" maxlength="3" class="a" readonly  value="<? echo $usibl; ?>"> bulan</td>
				</tr>
				<tr>
					<td>Lama Premi</td>
					<td>:</td>
					<td><input type="text" name="lamapembpremi_th" size="2" maxlength="2"  onfocus="highlight(event)" class="c" onBlur="return cek_masapremi()" value="<? echo $lprth; ?>"> tahun
						<input type="hidden" name="lamapembpremi_bl"  value="<? echo $lprbl; ?>">
						<input type="hidden" name="lamapembpremi_th_default" value="<? echo $lprth; ?>">
					</td>
					<td class="right">Akhir Pemb Premi</td>
					<td>:</td>
					<td colspan="2"><input type="text" name="akhirpremi" size="10" maxlength="10" class="a" onBlur="javascript:convert_date(akhirpremi);" readonly value="<? echo $akhpr; ?>"></td>
				</tr>
				<tr>
					<td>Lama Asuransi</td>
					<td>:</td>
					<td>
						<input type="text" name="lamaasuransi_th" size="2" maxlength="2" title="Lama Asuransi (Tahun)" class="a" readonly value="<? echo $lamth; ?>"> tahun
						<input type="hidden" name="lamaasuransi_bl" value="<? echo $lambl; ?>">
					</td>
					<td class="right">Akhir Ass (Expirasi)</td>
					<td>:</td>
					<td colspan="2"><input type="text" name="expirasi" size="10" maxlength="10" class="a" onBlur="javascript:convert_date(expirasi);" readonly value="<? echo $expir; ?>"></td>
				</tr>
				<tr>
					<td>Tanggal BP3</td>
					<td>:</td>
					<td class="arial10" colspan="2"><input type="text" name="tglbp3" size="10" maxlength="10" class="c" onBlur="convert_date(tglbp3)" onFocus="highlight(event)" value="<? echo $tgbp3; ?>">&nbsp;&nbsp;(Tanggal BS/BM)</td>
					<td class="a" colspan="4" style="font-size:9pt;"><input type="checkbox" name="bpo" value="1">Setuju Gadai Polis Otomatis</td>
				</tr>
				<tr>
					<td width="15%" class="arial10">Kode Valuta</td>
					<td width="2%" class="arial10">:</td>
					<td colspan="2" class="arial10">
						<select name="kdvaluta" onFocus="highlight(event)" class="c">
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="7" class="arial10">
						<fieldset style="padding: 5px;">
							<b><center>Untuk cara pembayaran melalui Autodebet, agar menghubungi Bagian Inkaso HO untuk pendaftarannya. Terima Kasih.</center></b>
						</fieldset>	
					</td>
				</tr>
				<tr>
					<td>Nomor BP3</td>
					<td>:</td>
					<td><input type="text" name="nobp3" size="12" maxlength="12" title="Nomor BP3" class="c" onFocus="highlight(event)" value="<? echo $nobp3; ?>"></td>
					<td class="right">Nomor Agen</td>
					<td>:</td>
					<td class="arial10">
						<input type="text" name="noagen" size="10" maxlength="10" title="Nomor Agen" class="a" value="<? echo $noagn; ?>">
					</td>
					<td >
						<input type="button" value="Cari  A g e n"  onclick="PopaAgen()" class="buton">
					</td>
				</tr>
				<tr>
					<td>Kurs/Index Awal</td>
					<td>:</td>
					<td><input type="text" name="indexawal" size="6" readonly value="1" class="a" value="<? echo $idxaw; ?>"></td>
					<td class="right">Penagih</td>
					<td>:</td>
					<td><input type="text" name="nopenagih" size="10" maxlength="10" readonly class="a" value="<? echo $nopng; ?>"></td>
					<td><input type="button" value="Cari Penagih"  onclick="PopPenagihProp()" class="buton"></td>
				</tr>
			</table>
		</td>
	</tr>
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
					<td align="center"><input type="button"  value="..." class="buton" onClick="javascript:Pempol(this.form);"></td>
					<td>Pemegang Polis</td>
					<td align="center"><input type="text" name="pempolnama" size="40" readonly  class="a"></td>
					<td align="center"><input type="text" name="pempolno" size="10" maxlength="10" readonly class="a"></td>
					<td align="center"><input type="text" name="pempolhub" size="25" readonly class="a"></td>
				</tr>
				<tr>
					<td align="center"><input type="button"  value="..." class="buton" onClick="javascript:Pempre(this.form);"></td>
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
			<table id="tbBeneficiary" border="0" cellpadding="1" cellspacing="1" width="90%" class="tblisi">
				<tr>
					<td colspan="5" style='text-align:center;'>
						<input type="button" class="buton" name="tambah" value="Tambah Data Beneficiary" />
					</td>
				</tr>
				<tr class="tblhead1">
					<td width="6%" align="center">Klik</td>
					<td width="6%" align="center">Nomor</td>
					<td width="41%" align="center">Nama</td>
					<td width="14%" align="center">Nomor Klien</td>
					<td width="32%" align="center">Hubungan</td>
				</tr>
				<tbody>
				</tbody>
			</table>
		</td>				
	<tr>
	<tr>
		<td class="tblhead" align="center">Premi dan Uang Asuransi</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="1" cellspacing="0" width="100%" class="tblisi">
				<tr>
					<td colspan="6"><div id="ketnilai"><div></td>
				</tr>
				<tr>
					<td width="20%">
						<select name="premijua" onChange="javascript:JuaPremi();" class="c">
							<option value="jua">Entry JUA</option>
							<option value="premi">Entry Premi</option>
						</select>
					</td>
					<td width="2%">:</td>
					<td colspan="4">
						<input type="text" name="nilai" size="15" maxlength="15" onBlur="javascript:JuaPremi();MaxJuaPremi();"  class="c">
						<input type="button" value="Polis Lain Yg Dimiliki" name="cekpolis" onClick="return CekPolis()" class="buton">
						<input type="button" name="buton" value="Hitung" onClick="javascript:HitungJUA();" class="buton">
					</td>
				</tr>
				<tr>
					<td><span id='prmjua'>Premi 5 Tahun Pertama</span></td>
					<td>:</td>
					<td width="25%" class="arial10"><input type="text" name="premi1" maxlength="13" readonly class="a"></td>
					<td width="20%" class="right">Premi Setelah 5 Tahun</td>
					<td width="2%">:</td>
					<td width="31%"><input type="text" name="premi2" size="10" maxlength="10" readonly  class="a" value="<? echo $p2; ?>"></td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td class="tblhead" align="center">Informasi lainnya</td>
	</tr>
	<tr class="tblisi">
		<td style='text-align:left;'>No. Rekening 
			<select size="1" name="kdbank" class="c" onChange="GetPenagihAutoDebet(document.ntryprop)">
				<option>-- Silahkan Pilih --</option>
				<?php foreach ($bank as $i => $v) {
					echo "<option value='$v[KDBANK]'>$v[NAMABANK]</option>";
				} ?>
			</select>
			<input type="text" name="norekening" onBlur="ValDigitAutoDebet(this.form.norekening)" size="15" maxlength="19">
			<br/>
			<font face="arial" size="2">
				<input type="checkbox" name="premiumholiday" value="1"> Setuju Premium Holiday? 
				Tgl. Transfer <input type="text" name="tgltransfer" size="10" maxlength="10" class="c" onBlur="convert_date(tgltransfer);cektransfer();return cek_masapremi();"> 
				Jumlah Transfer <input type="text" name="jmltransfer" size="15" maxlength="15" class="c" onBlur="cektransfer();javascript:convert_date(document.ntryprop.akhirpremi);javascript:convert_date(document.ntryprop.expirasi);"> 
			</font>
		</td>
	</tr>
	<tr>
		<td class="tblhead">
			<input name="submit" type="submit" value="Submit" class="buton" >
		</td>
	</tr>
</table>
</div>
</body>
<script type='text/javascript'>
	$(document).ready(function () {
		$("select[name='produk']").change(function() {
			$.ajax({
				type : 'post',
				url : "ajaxcarabayar.php",
				data : "kdproduk="+this.value,
				success : function (data) {
					$("select[name='carabayar']").html(data);
				}
			});
			
			$.ajax({
				type: 'post',
				url: "ajaxvaluta.php",
				data: "kdproduk="+this.value,
				success: function (data) {
					$("select[name='kdvaluta']").html(data);
				}
			});
		});
		
		$("select[name='premijua']").change(function() {
			if (this.value == 'jua') {
				$("#prmjua").text('Premi 5 Tahun Pertama');
				$("input[name='cekpolis']").show();
			} else if (this.value == 'premi') {
				$("#prmjua").text('JUA');
				$("input[name='cekpolis']").hide();
			}
		});
	});
	
	function openWin(url) {
        var w  = window.screen.availWidth * 90 / 100, h = window.screen.availHeight * 60 / 100;
        var l  = (screen.width/2)-(w/2), t = (screen.height/2)-(h/2);
        window.open(url, "", "width="+w+", height="+h+", directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no, scrollbars=yes, left="+l+", top="+t);
    }
</script>
</html>