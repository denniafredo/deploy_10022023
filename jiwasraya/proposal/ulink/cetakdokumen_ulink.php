<?php 
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/session.php";
	$DB=New Database($userid, $passwd, $DBName);
?>
		<script language="JavaScript">			 
		function GantiCari(theForm) {
      var jenisdok=theForm.jnsdokumen.value;
			var prefix=theForm.prefix.value;
			var noper=theForm.noper.value;
      window.location.replace('cetakdokumen_ulink.php?jnsdokumen='+jenisdok+'&prefix='+prefix+'&noper='+noper+'');
    }

		function goToURL() { window.location = "../../mnuptgbaru.php"; }
    </script>
		<link href="../jws.css" rel="stylesheet" type="text/css">
		<!--<body onload="document.dokumen.submit.disabled=true;">-->
		<body>
		<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<center>
  <table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber2">
   
	  <tr>
      <td width="100%" bgcolor="#006699">
      <p align="center"><b><font color="#FFFFFF" size="2" face="Verdana">CETAK DOKUMEN</font></b></td>
    </tr>
    <tr>
      <td width="100%" bgcolor="#CCEEFF">
			<form name="dokumen" action="<? $PHP_SELF;?>" method="POST">
      <table border="0" cellpadding="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber3" cellspacing="4">
        <tr>
          <td align="right"><font size="2" face="Verdana">No. Polis</font></td>
          <td><font face="Verdana">
					<input type="text" name="prefix" size="4" value="<?=$prefix;?>" maxlength="2" onBlur="javascript:this.value=this.value.toUpperCase();"></font>
					<font size="2" face="Verdana">-</font><font face="Verdana">
					<input type="text" name="noper"  value="<?=$noper;?>" size="10" maxlength="9" onBlur="validasi9(this.form.noper);"></font></td>
        </tr>
        <tr>
          <td align="right"><font size="2" face="Verdana">Dokumen</font></td>
          <td><font face="Verdana">
					<? 
				  switch ($jnsdokumen) {
  				  case "BK": $bk="selected"; 
								 			 $vkd="kdcetakbk"; 
											 $vtgl="tglcetakbk";
											 $vusr="usercetakbk";
											 $btn="Berita Keputusan"; break;
  				  case "TT": $tt="selected"; 
											 $vkd="kdcetaktterima"; 
											 $vtgl="tglcetaktterima";
											 $vusr="usercetaktterima";
											 $btn="Tanda Terima"; break;
				  case "DS": $ds="selected"; 
											 $vkd="kdcetakdesisi"; 
											 $vtgl="tglcetakdesisi";
											 $vusr="usercetakdesisi";
											 $btn="Desisi Polis"; break;
				  case "CP": $cp="selected"; 
											 $vkd="kdcetakpolis"; 
											 $vtgl="tglcetakpolis";
											 $vusr="usercetakpolis";
											 $btn="	Polis"; break;							 
				  }
					?>
					<select size="1" name="jnsdokumen" onChange="GantiCari(document.dokumen)">
          <option>Pilih Dokumen</option>
          <option value="BK" <?=$bk;?>>BERITA KEPUTUSAN</option>
          <option value="TT" <?=$tt;?>>TANDA TERIMA</option>
					<option value="DS" <?=$ds;?>>DESISI POLIS</option>
					<option value="CP" <?=$cp;?>>CETAK POLIS</option>
          </select></font></td>
        </tr>
				<?php 
				if($prefix!="" && $noper!="" && $jnsdokumen!=""){
				$sql = "select prefixpertanggungan,nopertanggungan,".
						   "$vkd,to_char($vtgl,'DD/MM/YYYY') as tglcetak,$vusr from $DBUser.tabel_214_acceptance_dokumen ".
						   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper'";
//							   echo $sql;
							 $DB->parse($sql);
							 $DB->execute();
							 $w=$DB->nextrow();
							 $noptg=$w["NOPERTANGGUNGAN"];
							 $kdcetak = $w["".strtoupper($vkd).""];
							 $tglcetak = $w["TGLCETAK"];
							 $usrcetak = $w["".strtoupper($vusr).""];
							 //echo $sql."<br>";
							 //echo $kdcetak."<br>";
						if(!$noptg){
						  echo "Polis tidak ditemukan..";
						} else {
						  if($kdcetak!=""){
							  echo "<tr><td colspan=2 class=verdana10blk><h4>Sudah pernah dicetak <br>tanggal $tglcetak oleh $usrcetak</h4></td></tr>";
								echo "<tr><td colspan=2 class=verdana10blk><a href=../mnuptgbaru.php> Menu Pert. Baru</a> | ".
										 "<a href=cetakdokumen.php> Cetak Dokumen Lain</a></td></tr>";
							} else {
          				?>
									<tr>
									</tr>
									<td colspan="2" class="verdana10blk">
									<font color="#ff6600" size="3"><b>PERHATIAN !</b></font><br>
									Dokumen hanya bisa dicetak satu kali.<br>
									Menekan tombol cetak berarti Anda sudah melakukan pencetakan <?=$btn;?>.<br><br>
									Persiapan :<br>
									<li>Mohon siapkan kertas dengan logo dan printer.
									<li>Setting ukuran font(text size) Browser Anda. (Klik View->Text Size->Medium)
									<li>Kosongkan nilai header dan footer pada Page Setup Browser Anda <br>(Klik File->Page Setup->Headers & Footers)
									<br>Mencetak diluar seting diatas kemungkinan menyebabkan cetakan menjadi 2 halaman.
									<br><br>
									Apakah Anda yakin mencetak dokumen <b><?=$btn;?></b> ?
									</td>
                  <tr>
                    <td colspan="2">
										<? 
										if($jnsdokumen=="BK"){
										 ?>
										<input type="button" name="batal" value="TIDAK. CETAK NANTI AJA" onClick="goToURL()">
										<input type="button" name="cetak" value="YA. CETAK SEKARANG" onClick="NewWindow('../cetakanbk.php?prefixpertanggungan=<? echo $prefix; ?>&nopertanggungan=<? echo $noper; ?>','',650,500,1)">
										<? } elseif($jnsdokumen=="TT") { ?>
										<input type="button" name="batal" value="TIDAK. CETAK NANTI AJA" onClick="goToURL()">
										<input type="button" name="cetak" value="YA. CETAK SEKARANG" onClick="NewWindow('../tanda_terima.php?prefixpertanggungan=<? echo $prefix; ?>&nopertanggungan=<? echo $noper; ?>','',650,500,1)">
										<? } elseif($jnsdokumen=="CP") { ?>
										<input type="button" name="batal" value="TIDAK. CETAK NANTI AJA" onClick="goToURL()">
										<input type="button" name="cetak" value="YA. CETAK SEKARANG" onClick="NewWindow('test.cetak.polis.linkNEW.php?prefix=<? echo $prefix; ?>&nopertanggungan=<? echo $noper; ?>','',650,500,1)">
										<? }else { 
											
										$sql =  "select kdacceptance from $DBUser.tabel_214_acceptance_dokumen ".
                    				 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper'";
                    //				 echo $sql;
                    $DB->parse($sql);
                    $DB->execute();
										$acc=$DB->nextrow();
		 								$kdakseptasi	= $acc["KDACCEPTANCE"];
										if($kdakseptasi=="1"){
										?>
										<input type="button" name="batal" value="TIDAK. CETAK NANTI AJA" onClick="goToURL()">
										<input type="button" name="cetak" value="YA. CETAK SEKARANG" onClick="NewWindow('../cetakan_desisi.php?prefixpertanggungan=<?echo $prefix;?>&nopertanggungan=<?echo $noper;?>','',800,500,1)">
										<?
										} else {
										 echo "Polis belum diakseptasi....";
										}
										}?>
										</td>
                  </tr>

          				<?php
				      }
				   }
				} else {
				?>
				<tr>
          <td colspan="2">Pilih Polis dan Dokumen</td>
        </tr>
				<?
				}
				 ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
				</form>
      </table>
      </td>
    </tr>
  </table>
  </center>
	</body>
