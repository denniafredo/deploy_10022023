<?php
 include "./includes/session.php";
 include "./includes/database.php";
 include "./includes/klien.php";
 include "./includes/pertanggungan.php";
 include "./includes/tgl.php"; 	
 include "./includes/sendemail.php";
 $DB  = New database($userid, $passwd, $DBName);	 
 //$prefixpertanggungan = $kantor;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Mutasi Pertanggungan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<body>
<a class="verdana10blk"><b>MUTASI SWITCHING FUND</b></a>
<hr size=1>
<? 
if ($Submit) {
 #----------------------------------------------------------------------- sendmail mutasi jua
		 
		 $sql = "insert into $DBUser.TABEL_UL_TRANSAKSI_SWITCHFUND ".
		 		"(prefixpertanggungan, nopertanggungan, kdfund, kdfundnew,".
				"tglpengajuan, tglproses, status, tglupdated, userupdated,".
				"tglcetak, usercetak, tglaksep, useraksep, unit, biaya)".
						"values (".
						    "'$prefix','$noper','$kdfund','$kdfundnew',".
							"to_date('$tglpengajuan','DD/MM/YYYY'),sysdate, 0,sysdate,user,".
							"null,null,null,null,(select sum(decode(trx_type,'R',-1,1)*nvl(unit,0)) unit from $DBUser.tabel_ul_transaksi
 							where nomor_polis in ('".$prefix.$noper."') and substr(kode_fund,5,2)='$kdfund'),$bia)";

		 //echo $sql;
		 $DB->parse($sql);
	   if($DB->execute())
		 {
		   echo "Berhasil.. data perubahan disimpan.";
		 }
		 else
		 {
		   echo "<font color=#ff0000>Gagal.. mungkin sudah ada TOP-UP Sekaligus</font>";
		 }
		 ?>
		 <br />
		 Lihat detail polis 
		 <?
		 echo "<a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$prefix."&noper=".$noper."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$prefix."-".$noper."</a>";

		 echo "<br />";
		 echo "Lihat <a href='../pelaporan/info_tupupxxx.php'>Status Transaksi Switching Fund</a>";

		 /*
		 
		 $query = "select prefixpertanggungan,nopertanggungan from $DBUser.tabel_603_mutasi_pert ".
		          "where prefixpertanggungan='$prefix' and nopertanggungan='$nopertanggungan' and ".
							"kdmutasi='06' and status is null";
		 $DB->parse($query);
	   $DB->execute();
	   $arq=$DB->nextrow();
     $nopert = $arq["NOPERTANGGUNGAN"];
		 
		 if (!$nopert) {
		 	 include ('sendmailpremi.php');
		 } else {
		 echo "Sudah pernah diusulkan perubahan Premi namun belum diproses oleh Kantor Pusat.";
		 }
		 */
		 
 } 
 else 
 {
		 $sql = "select a.prefixpertanggungan,a.nopertanggungan,b.kdrayonpenagih,c.namaklien1,d.namaklien1 tertanggung,b.nopenagih, ".
		 		"(SELECT   decode(COUNT ( * ),0,0,1,0,1)
   				FROM   $DBUser.TABEL_UL_TRANSAKSI_SWITCHFUND
  				WHERE       TO_CHAR (tglpengajuan, 'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
          		AND prefixpertanggungan = a.prefixpertanggungan
          		AND nopertanggungan = a.nopertanggungan) kena ".
				     "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b, $DBUser.tabel_100_klien c, $DBUser.tabel_100_klien d ".
			       "where b.kdrayonpenagih='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' and a.kdpertanggungan='2' ".
				     "and c.noklien=b.nopenagih and a.nopenagih=b.nopenagih and a.notertanggung=d.noklien order by a.nopertanggungan";
     //echo $sql;
	   $DB->parse($sql);
	   $DB->execute();
	   $arx=$DB->nextrow();
       $prefix = $arx["PREFIXPERTANGGUNGAN"];
	   $biaya = $arx["KENA"];
	   $PER	= New Pertanggungan($userid,$passwd,$prefix,$nopertanggungan);
		 //echo "<br />Prefix = ".$prefix;
		 if ($prefix == "X") { 
			  echo "<font face=\"Verdana\" size=\"2\">Nomor Polis $nopertanggungan bukan dari kantor $kantor</font>";   
     } 
		 else 
		 {
        echo "<div align=\"center\">";
        echo "<form name=\"cekjua\" action=\"$PHP_SELF\" method=\"post\" onSubmit=\"return checkbox_checker();\">";
        ?>
          <table border="0" width="600" bgcolor="#006699" cellspacing="1" cellpadding="6">
            <tr>
              <td align="center" bgcolor="#627EB5" class="verdana9wht"><b><?echo "NO. POLIS : ".$prefix." - ".$nopertanggungan; ?></b></td>
            </tr>
            <tr>
              <td align="center" bgcolor="#627EB5" class="verdana9wht"><input type="text" name="prefixpertanggungan" class="c" size="2" maxlength="2" onFocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
                <input type="text" name="nopertanggungan" class="c" size="9" maxlength="9" onBlur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>"></td>
            </tr>
            <tr>
              <td align="center" bgcolor="#627EB5" class="verdana9wht"><? echo "<input type=\"submit\" value=\"Submit\" name=\"insert\">";?></td>
            </tr>
        
            <tr>
              <td width="100%" bgcolor="#DAE2EF">
                <?
                echo "  <table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"2\">";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Tertanggung</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->namatertanggung."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Pemegang Polis</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->namapemegangpolis."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Produk</td>";
                echo "      <td class=\"verdana9blk\">: (".$PER->produk.") ".$PER->namaproduk."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Mulai Asuransi</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->mulas."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Cara Bayar</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->kdcarabayar."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">JUA</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->notasi." ".number_format($PER->jua,2)."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Premi 1</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->notasi." ".number_format($PER->premi1,2)."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Premi 2</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->notasi." ".number_format($PER->premi2,2)."</td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Jenis Fund</td>";
                echo "      <td class=\"verdana9blk\">: ";
				?>
				<select size="1" name="kdfund">
					<option value="">---pilih fund asal---</option>
					<?
					$sql = "select * from $DBUser.TABEL_UL_OPSI_FUND A, $DBUser.TABEL_UL_KODE_FUND B where A.KDFUND=B.KDFUND AND prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
					$DB->parse($sql);
        			$DB->execute();
        	while($row = $DB->nextrow())
					{
					  echo "<option value=".$row["KDFUND"].">".$row["KDFUND"]." - ".$row["NAMAFUND"]."</option>";
					}
					?>
					</select>
                
                <select size="1" name="kdfundnew">
					<option value="">---pilih fund tujuan---</option>
					<?
					$sql = "select * from $DBUser.TABEL_UL_OPSI_FUND A, $DBUser.TABEL_UL_KODE_FUND B where A.KDFUND=B.KDFUND AND prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
					$DB->parse($sql);
        			$DB->execute();
        	while($row = $DB->nextrow())
					{
					  echo "<option value=".$row["KDFUND"].">".$row["KDFUND"]." - ".$row["NAMAFUND"]."</option>";
					}
					?>
					</select>
				<?
				echo "</td>";
                echo "    </tr>";

                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Tgl. Pengajuan (DD/MM/YYYY)</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=tglpengajuan size=10  onBlur=\"convert_date(tgltransfer)\">";             
                echo "      </td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Status</td>";
                echo "      <td class=\"verdana9blk\">: <b>".$PER->statusfile."</b></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Biaya</td>";
                echo "      <td class=\"verdana9blk\">: <b>".$biaya." %</b></td>";
                echo "    </tr>";
                echo "  </table>";
        				echo "<input type=\"hidden\" value=\"$prefix\" name=\"prefix\">";
                echo "<input type=\"hidden\" value=\"$nopertanggungan\" name=\"noper\">";
								echo "<input type=\"hidden\" value=\"$PER->produk\" name=\"kdproduk\">";
								echo "<input type=\"hidden\" value=\"$biaya\" name=\"bia\">";
								?>
                </td>
            </tr>
        
            <? 
        		if($PER->statusfile!="AKTIF"||substr($PER->produk,0,3)!="JL4"){
					if(substr($PER->produk,0,3)!="JL4"){
        		?>
        		<tr>
              <td align="center" bgcolor="#E4E4E4" class="verdana10redb">MUTASI TIDAK DAPAT DIPROSES. POLIS SEDANG TIDAK AKTIF/PRODUK BUKAN JENIS UNIT LINK</td>
            </tr>
        		<? 
				} else {?>
            <tr>
              <td align="center" bgcolor="#E4E4E4"><?echo "<input type=\"submit\" value=\"SUBMIT\" name=\"Submit\" style=\"font-size: 8pt; font-family: Verdana\">"; ?></td>
            </tr>
        		<? }
				} else {?>
            <tr>
              <td align="center" bgcolor="#E4E4E4"><?echo "<input type=\"submit\" value=\"SUBMIT\" name=\"Submit\" style=\"font-size: 8pt; font-family: Verdana\">"; ?></td>
            </tr>
        		<? } ?>
        </table>
        <?
        echo "</div>";
        echo "</form>";
        }
}
?>
<hr size="1">
<font face="verdana" size="2"><a href="../../submenu.php?mnuinduk=150">Back</a></font>
</body>
</html>