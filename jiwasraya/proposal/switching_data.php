<?php 
  include "../../includes/session.php";
  include "../../includes/database.php";
	$DB=New database($userid, $passwd, $DBName);
	
  $sql = "select ".
			 	 			"a.nopol,a.notertanggung,a.kdproduk, to_char(a.mulas,'DD/MM/YYYY') mulas,to_char(a.expirasi,'DD/MM/YYYY') expirasi, ".
							"z.namastatusfile,a.kdstatusfile,decode(a.kdvaluta,'0','Rp','1','Rp','US$') notasi,".
							"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggung) namatertanggung, ".
							"b.nomorsip,b.nilaitebus,b.isswitching,TO_CHAR (b.tglhitung, 'DD/MM/YYYY') tgltebus,c.jumlah ".
							//"(select nilaitebus from $DBUser.tabel_700_tebus where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and status <> '4' and isswitching='1') nilaitebus, ".
							//"(select to_char(tglhitung,'DD/MM/YYYY') from $DBUser.tabel_700_tebus where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and status <> '4' and isswitching='1') tgltebus ".
			 	 "from ".
				 			 "$DBUser.tabel_900_sip c,".
        			 "$DBUser.tabel_700_tebus b,".
							 "$DBUser.tabel_200_pertanggungan a, ".
							 "$DBUser.tabel_299_status_file z ".
				 "where ".
				        "a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
   							"and a.kdstatusfile=z.kdstatusfile ".
  		 	 				"and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
								"and b.status='3' ".
								"and b.nomorsip=c.nomorsip ".
								"and c.nourut='20'";
  //echo $sql;
	$DB->parse($sql);
  $DB->execute();
  $arr=$DB->nextrow();
  $nottg = $arr["NOTERTANGGUNG"];
	$kdstt = $arr["KDSTATUSFILE"];
	$hasilswitching = $arr["ISSWITCHING"];
	
	if($nottg!="")
  {
  ?>
    <table border="0" cellpadding="5" style="border-collapse: collapse" bordercolor="#C0C0C0" width="520">
				
				<tr>
					<td width="150">Nama Tertanggung</td>
					<td width="370">: <?=$arr["NAMATERTANGGUNG"];?></td>
				</tr>
				<tr>
					<td width="150">Nilai Tebus</td>
					<td width="370">: Rp. <?=number_format($arr["JUMLAH"],2,",",".");?></td>
				</tr>
				<tr>
					<td width="150">Tgl. Tebus</td>
					<td width="370">: <?=$arr["TGLTEBUS"];?></td>
				</tr>
				<tr>
					<td width="150">Portfolio Status</td>
					<td width="370">: <?=$arr["NAMASTATUSFILE"];?> [ <a href="#" onclick="window.open('../polis/polis.php?prefix=<?=$prefixpertanggungan;?>&noper=<?=$nopertanggungan;?>','','width=800,height=400,top=100,left=100,scrollbars=yes');">view</a> ]</td>
				</tr>
				<tr>
					<td width="150">
					<input type="hidden" name="nilaitebus" value="<?=$arr["JUMLAH"];?>">
					</td>
				</tr>
				
    </table>
		<?
		if(($kdstt=="X" || $kdstt=="5") && $hasilswitching=="1")
  	{
  	?>
		<input type="hidden" name="nosiptebus" value="<?=$arr["NOMORSIP"];?>">
  	<p align="center"><input type="button" class="button" value="PREV" name="cancel" onclick="window.history.back();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  	<input type="submit" value="NEXT" class="button" name="submit">	
		<?
  	}
		else
  	{
  	?>
		<br /><br />
		<font color="#ff6013">Proses tidak dapat dilanjutkan! Polis tidak melalui proses <b>TEBUS SWITCHING</b>.</font>
		<?
  	}
		?>
		
 <?
  }
	else
	{
	 echo "no data...";
	}
?>