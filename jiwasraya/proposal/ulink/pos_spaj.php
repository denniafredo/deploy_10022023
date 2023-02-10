<?php
	include "./includes/session.php";
	include "./includes/database.php";
	include "./includes/klien.php";
	include "./includes/pertanggungan.php";
	include "./includes/tgl.php"; 	
	include "./includes/sendemail.php";
	include './includes/koneksi.php';
	
	$DB = New database($userid, $passwd, $DBName);
?>
<html>
	<head>
		<link type="text/css" href="./includes/jws.css" rel="stylesheet" />
		<link type="text/css" href="./jquery/ui.all.css" rel="stylesheet" />
		<link type="text/css" href="./jquery/demos.css" rel="stylesheet" />
		<style type="text/css">
			input, textarea {
				font-family: verdana;
				font-size: 12px;
			}
			input.readonly, textarea.readonly {
				background-color: #CCC5C4;
			}
			::-webkit-input-placeholder { /* WebKit, Blink, Edge */
				color: #7FB2F0;
			}
			:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
				color: #7FB2F0;
				opacity: 1;
			}
			::-moz-placeholder { /* Mozilla Firefox 19+ */
				color: #7FB2F0;
				opacity: 1;
			}
			:-ms-input-placeholder { /* Internet Explorer 10-11 */
				color: #7FB2F0;
			}
			.nominal {
				text-align:right;
			}
		</style>
		
		<script language="JavaScript" type="text/javascript" src="./includes/window.js"></script>
		<script language="JavaScript" type="text/javascript" src="./includes/validasi.js"></script>
		<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
		<script language="JavaScript" type="text/javascript" src="./jquery/jquery-1.7.2.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="./jquery/jquery.formatter.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="./jquery/jquery.autonumeric.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('.tanggal').formatter({ 'pattern': '{{99}}/{{99}}/{{9999}}' });
				$('.hp').formatter({ 'pattern': '{{9999999999999}}' });
				$('.nominal').autoNumeric('init', { aSep: '.', aDec: ',', mDec: '0', vMax: '999999999999999999999' });
				
				$("#btnproposalpos").click(function() {
					var noagen = $("input[name='noagen']").val();
					
					if (noagen.length > 0) {
						NewWindow('../proposalpos.php?id='+noagen,'popuppage','800','300','yes')
					} else {
						alert('Silahkan pilih no agen terlebih dahulu!');
					}
				});
				
				$("input[name='nospaj']").focusout(function() { enable_submit(); });
				$("input[name='tglspaj']").focusout(function() { enable_submit(); });
			});
			
			function enable_submit() {
				var noagen = $("input[name='noagen']").val();
				var bid = $("input[name='buildid']").val();
				var nama = $("input[name='nama']").val();
				var hp = $("input[name='hp']").val();
				var nospaj = $("input[name='nospaj']").val();
				var tglspaj = $("input[name='tglspaj']").val();
				var premi = $("input[name='premi']").val();
				var dokleng = $("#lya").is(':checked');
				
				if (noagen.length > 0 && bid.length > 0 && nama.length > 0 && hp.length > 0 && nospaj.length > 0 && tglspaj.length > 0 && premi.length > 0 && dokleng) {
					document.getElementById('Submit').disabled = false;
				} else {
					document.getElementById('Submit').disabled = true;
				}
			}
		</script>
		
		<title>Mutasi Pertanggungan</title>
		
	</head>
	
	<body>
		<a class="verdana10blk"><b>SPAJ - SURAT KONFIRMASI</b></a>
		<hr size=1>
		
		<?php
			if ($Submit && strlen($noagen) > 0 && strlen($buildid) > 0 && strlen($nama) > 0 && strlen($hp) > 0 && strlen($nospaj) > 0 && strlen($tglspaj) > 0 && $lengkap) {
				$sql = "SELECT COUNT(nosp) jml FROM $DBUser.tabel_ul_spaj_temp WHERE nosp = '$nospaj'";
				$DB->parse($sql);
				$DB->execute();
				$arr = $DB->nextrow();
				$jml = $arr['JML'];
				
				$premi = str_replace(".", "", $premi);
				$topup = str_replace(".", "", $topup);
				if (!$jml) {
					$sql = "INSERT INTO smsjiwasraya (phone, message) 
							VALUES('$hp', 'Yth. Bpk/Ibu ".strtoupper($nama).", terimakasih atas kepercayaan Anda kpd kami. SPAJ Anda No. $nospaj akan kami proses lebih lanjut. Utk info hub 021-1500151')";
					mysql_query($sql);
					
					
					$sql = "INSERT INTO $DBUser.tabel_ul_spaj_temp
								(nosp, tglsp, noagen, taltup, premi, kdkantor, namapempol, alamat, hp, topup,
								noref, namaref, bankcabang, buildid)
							VALUES
								('$nospaj', TO_DATE('$tglspaj', 'dd/mm/yyyy'), '$noagen', '$taltup', '$premi', 
								'$kantor', UPPER('$nama'), UPPER('$alamat'), '$hp', '$topup', '$noref', '$namaref', 
								'$namacab', '$buildid')";
					$DB->parse($sql);
					$DB->execute();
					$DB->commit;
				}
				
				$sql = "SELECT nosp, to_char(tglsp,'dd/mm/yyyy') tglsp, noagen, premi, buildid,
							namapempol, alamat, hp, topup, taltup, noref, namaref, bankcabang, cif
						FROM $DBUser.tabel_ul_spaj_temp
						WHERE nosp = '$nospaj'";
				$DB->parse($sql);
				$DB->execute();
				$r = $DB->nextrow();
			} else if ($Submit) {
				echo "<font size='2' style='color:red;'>Silahkan periksa kembali kolom* (Wajib diisi)</font><br>";
			}
		?>
		
		<div align="center">
			<form name="spaj" action="<?=$PHP_SELF?>" method="post" onSubmit="return checkbox_checker();">
				<table border="0" width="600" bgcolor="#006699" cellspacing="0" cellpadding="6" style='border:1px solid #006699;'>
					<tr>
						<td align="center" bgcolor="#627EB5" class="verdana9wht" colspan="3">
							<b><?="Surat Permintaan Asuransi Jiwa ($prefixpertanggungan)"; ?></b>
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk" style="border:none;">
							No Agen*
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<a href="javascript:void(0);" onClick="NewWindow('../agenlistpos.php?a=spaj','popuppage','800','300','yes')"><img height="20" src="./images/find.png" style="margin-right:5px;float:left;" alt="cari daftar agen"></a>
							<input readonly type="text" size="10" name="noagen" VALUE="<?=$r['NOAGEN']?>" class="readonly" style="float:left;">
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Build ID PoS*
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<a href="javascript:void(0);" id="btnproposalpos"><img height="20" src="./images/find.png" style="margin-right:5px;float:left;" alt="cari daftar agen"></a>
							<input readonly type="text" size="15" name="buildid" VALUE="<?=$r['BUILDID']?>" class="readonly" style="float:left;">
						</td>
					</tr>
					<tr>
						<td width="150" bgcolor="#DAE2EF" class="verdana9blk">
							Nama Pemegang Polis*
						</td>
						<td width="10" bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<input type="text" name="nama" maxlength="50" VALUE="<?=$r['NAMAPEMPOL']?>" placeholder="Maksimal 50 karakter" style="width:99%;">
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Alamat Pemegang Polis
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<textarea name="alamat" rows="5" style="width:99%;" maxlength="150" placeholder="Maksimal 150 karakter"><?=$r['ALAMAT']?></textarea>
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Telepon Seluler (HP)*
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<input type="text" name="hp" VALUE="<?=$r['HP']?>" class="hp" placeholder="Angka maksimal 13 karakter">
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							No. SPAJ*
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<input type="text" name="nospaj" maxlength="11" VALUE="<?=$r['NOSP']?>" placeholder="Maksimal 11 karakter">
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Tgl. SPAJ*
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<input type="text" size="12" name="tglspaj" VALUE="<?=$r['TGLSP']?>" class="tanggal" placeholder="dd/mm/yyyy">
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Premi*
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<input type="text" name="premi" VALUE="<?=number_format($r['PREMI'], 0, ",", ".")?>" class="nominal">
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Top Up
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<input type="text" name="topup" VALUE="<?=number_format($r['TOPUP'], 0, ",", ".")?>" class="nominal readonly" readonly>
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Dokumen Lengkap?
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<?php $lya = count($r) > 0 ? 'checked' : null; $ltidak = count($r) == 0 ? 'checked' : null; ?>
							<input type="radio" id='lya' name="lengkap" id="lya" value="1" onclick="enable_submit()" <?=$lya?> /><label for="lya">Ya</label>
							<input type="radio" name="lengkap" id="ltidak" value="0" onclick="enable_submit()" <?=$ltidak?> /><label for="ltidak">Tidak</label>
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Taltup?
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<?php $btya = $r['TALTUP'] == 1 ? 'checked' : null; $bttidak = count($r) == 0 || $r['TALTUP'] == 0 ? 'checked' : null; ?>
							<input type="radio" name="taltup" id="btya" value="1" <?=$btya?> /><label for="btya">Ya</label>
							<input type="radio" name="taltup" id="bttidak" value="0" <?=$bttidak?> /><label for="bttidak">Tidak</label>
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							No. | Nama Referensi**
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<input type="text" size="10" name="noref" VALUE="<?=$r['NOREF']?>">
							<input type="text" size="37" name="namaref" VALUE="<?=$r['NAMAREF']?>">
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							Cabang Bank**
						</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">:</td>
						<td bgcolor="#DAE2EF" class="verdana9blk">
							<select class="c" size="1" name="namacab">
								<option value="">-- Silahkan Pilih --</option>
								<?php $sql = "SELECT * FROM $DBUser.tabel_399_bank_cabang WHERE kdbank='BTN' ORDER BY namacabangbank";
								$DB->parse($sql);
								$DB->execute();
								while ($arr=$DB->nextrow()) { $selected = $r['NAMACABANGBANK'] == $arr['NAMACABANGBANK'] ? 'selected' : null; ?>
									<option value="<?=$arr["NAMACABANGBANK"]?>" <?=$selected?>><?=$arr["NAMACABANGBANK"]?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td bgcolor="#DAE2EF" colspan="3">
							<font size='0.5' >
								* Wajib Diisi<br>
								** Khusus Bancassurance InBranch
							</font>
						</td>
					</tr>
					<tr>
						<td bgcolor="#E4E4E4" colspan="3" style='border-top:1px solid #006699;' align="center">
							<input type="submit" value="SUBMIT" name="Submit" id="Submit" disabled style="font-size: 8pt; font-family: Verdana">
						</td>
					</tr>
					<tr>
						<td bgcolor="#E4E4E4" colspan="3" style='border-top:1px solid #006699;' align="center">
							<a href="javascript:void(0);" onClick="NewWindow('./cetakinfok.php?sp=<?=$r['NOSP'];?>','popuppage','620','500','yes')"><img src="./images/cetak.png" border="0" alt="Cetak Surat"></a>&nbsp;
							<a href="javascript:void(0);" onClick="NewWindow('./daftar_proposal.php?sp=<?=$r['NOSP'];?>','popuppage','620','500','yes')"><img src="./images/proposal.png" border="0" alt="Cetak Daftar"></a>
						</td>
					</tr>
				</table>
			</form>
		</div>
		
		<hr size="1">
		<a href="../../submenu.php?mnuinduk=200"><font face="Verdana" size="2">Pertanggungan Baru</font></a>
	</body>
</html>