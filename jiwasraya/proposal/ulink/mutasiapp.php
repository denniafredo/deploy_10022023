<?php
 include "./includes/session.php";
 include "./includes/database.php";
 include "./includes/klien.php";
 include "./includes/pertanggungan.php";
 include "./includes/tgl.php"; 	
 include "./includes/sendemail.php";
 $DB  = New database($userid, $passwd, $DBName);
 $DX  = New database($userid, $passwd, $DBName);	
 $PER	=	New Pertanggungan($userid,$passwd,$prefix,$noper); 
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
<script language="JavaScript" type="text/javascript">
function loadcek(theForm, thevalue){
var jml=thevalue;
var prd=substr(cekjua.kdproduk.value,1,5);
if ((prd=='JL2XS') || (prd=='JL3XS')) {} else {
if((jml)<1000000) { var konfirmasi=alert('Jumlah Top Up Minimal 1.000.000')
				if (konfirmasi){
					//cekjua.premitopupskg.readOnly = true;
					//cekjua.premitopupskg.focus();
					//cekjua.Submit.disabled=true;
				}
				else {cekjua.premitopupskg.focus();}
			;}
}			
			
}
</script>
</head>
<body>
<a class="verdana10blk"><b>MUTASI APPORTIONMENT</b></a>
<hr size=1>

<? 
if ($Submit) {
 #----------------------------------------------------------------------- sendmail mutasi jua
		for ($i=1; $i<=$jmlf; $i++)
		{
			 $sql = "insert into $DBUser.TABEL_UL_TRANSAKSI_TOPUP (".
									"prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,".
									"premi,jenis,tglmutasi,usermutasi,tgltransfer,KDFUND)".
							"values (".
								"'$prefix','$noper','$kdproduk','BNFTOPUPSG',".
								${$kd[$i-1]}.",'TA',sysdate,user,to_date('$tgltransfer','DD/MM/YYYY'),'".$kd[$i-1]."')";
			 //echo ${$kd[$i-1]}.'</br>';
			 //echo ${'p'.$kd[$i-1]}.'</br>';
			 //echo ${'FF'}.'</br>';
			 //--echo $sql.'</BR></BR>';
			 //--$DX->parse($sql);
			 //--$DX->execute();
			 //--$DX->commit;
			 $sql = "insert into $DBUser.TABEL_UL_TRANSAKSI_APPORTION (".
										 "PREFIXPERTANGGUNGAN,
                                     	  NOPERTANGGUNGAN,
                                     	  KDFUND,
                                          PORSILAMA,
                                          PORSIBARU,
                                          TGLEFEKTIF,
                                          STATUS,
                                          TGLREKAM,
                                          USERREKAM,
                                          TGLMUTASI,
                                          USERMUTASI, UNIT, TOPUP, BIAYA)".
							"values (".
								"'$prefix','$noper','".$kd[$i-1]."',".
								${'pl'.$kd[$i-1]}.",".${'pb'.$kd[$i-1]}.",to_date('$tgltransfer','DD/MM/YYYY'),'0',sysdate,user,null,null,
								(select sum(decode(trx_type,'R',-1,1)*nvl(unit,0)) unit from $DBUser.tabel_ul_transaksi
 							where nomor_polis in ('".$prefix.$noper."') and substr(kode_fund,5,2)='".$kd[$i-1]."'),".${$kd[$i-1]}.",$bia)";
			 //echo $sql.'</BR></br>';
			 $DX->parse($sql);
			 $DX->execute();
			 $DX->commit;
		  /* if($DB->execute())
			 {
			   echo "Berhasil.. Top-up sekaligus sudah ditambahkan.";
			 }
			 else
			 {
			   echo "<font color=#ff0000>Gagal.. mungkin sudah ada TOP-UP Sekaligus</font>";
			 }*/
		 
		 }
		 ?>
		 <br />
		 Lihat detail polis 
		 <?
		 echo "<a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$prefix."&noper=".$noper."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$prefix."-".$noper."</a>";

		 echo "<br />";
		 echo "Lihat <a href='../pelaporan/info_tupup.php'>Status Transaksi Apportionment</a>";

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
		 		"NVL((SELECT   decode(COUNT ( NOPERTANGGUNGAN ),0,0,1,0,1)
   				FROM   $DBUser.TABEL_UL_TRANSAKSI_APPORTION
  				WHERE       TO_CHAR (tglefektif, 'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
          		AND prefixpertanggungan = a.prefixpertanggungan
          		AND nopertanggungan = a.nopertanggungan GROUP BY NOPERTANGGUNGAN),0) kena ".
				     "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b, $DBUser.tabel_100_klien c, $DBUser.tabel_100_klien d ".
			       "where b.kdrayonpenagih='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' and a.kdpertanggungan='2' ".
				     "and c.noklien=b.nopenagih and a.nopenagih=b.nopenagih and a.notertanggung=d.noklien order by a.nopertanggungan";
     echo $sql;
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
              <td align="center" bgcolor="#627EB5" class="verdana9wht"><b><?echo "NO. POLIS : ".$prefixpertanggungan." - ".$nopertanggungan; ?></b></td>
            </tr>
        
            <tr>
              <td width="100%" bgcolor="#DAE2EF">
                <?
                echo "  <table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"2\">";
                ?>
				<tr>
                <td class="verdana10blk" width="30%">Nomor Polis</td><td>: 
                <input type="text" name="prefixpertanggungan" class="c" size="2" maxlength="2" onFocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
                <input type="text" name="nopertanggungan" class="c" size="9" maxlength="9" onBlur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>">
                </td>
                <td align="left"></td>
                </tr>
                <tr>
                <td class="verdana10blk" width="30%">
                <td align="left"><? echo "<input type=\"submit\" value=\"Submit\" name=\"insert\">";?></td>
                </tr>
				<?
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
                echo "      <td class=\"verdana9blk\">: ".$PER->namacarabayar."</td>";
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
                echo "      <td class=\"verdana9blk\">Tgl. Pembayaran Terakhir</td>";
                echo "      <td class=\"verdana9blk\">: ".$PER->bayarterakhir."</td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Biaya</td>";
                echo "      <td class=\"verdana9blk\">: <b>".$biaya." %</b></td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Komposisi & Top Up</td>";
                //echo "      <td class=\"verdana9blk\">: $notasi <input type=\"text\" size=\"20\" name=\"premitopupskg\" onfocus=\"highlight(event)\" onblur=\"return loadcek(document.cekjua)\"></td>";
                echo "    </tr>";
				$sql = "select * from $DBUser.TABEL_UL_OPSI_FUND A, $DBUser.TABEL_UL_KODE_FUND B where A.KDFUND=B.KDFUND AND prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";


  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
echo "  <table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"1\">";
echo "<tr bgcolor=#627EB5><td>Nama Fund</td><td>Kode</td><td>Porsi Lama</td><td>Porsi Baru</td><td>Top Up</td></tr>";
while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	echo "<td class=verdana9blk>".$arr["NAMAFUND"]."</td>";
	echo "<td class=verdana9blk>: ".$arr["KDFUND"]."</td>";
	echo "<td class=verdana9blk><input type=\"text\" size=\"4\" readonly=\"readonly\" name=pl".$arr["KDFUND"]." onfocus=\"highlight(event)\" value='".$arr["PORSI"]."'>%</td>";
	echo "<td class=verdana9blk><input type=\"text\" size=\"4\" name=pb".$arr["KDFUND"]." onfocus=\"highlight(event)\" onblur=\"return loadcek(document.cekjua,this.form.".$arr["KDFUND"].")\">%</td>";
	echo "<td class=verdana9blk><input type=\"text\" size=\"20\" name=".$arr["KDFUND"]." onfocus=\"highlight(event)\" onblur=\"return loadcek(document.cekjua,this.form.".$arr["KDFUND"].")\"></td>";
	echo "</tr>";
	echo "<input type='hidden' name='jmlf' value='".$i."'>";
	echo "<input type='hidden' name='kd[]' value='".$arr["KDFUND"]."'>";
	$i++;
	}
//echo "</table>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Tgl. Transfer (DD/MM/YYYY)</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=tgltransfer size=10  onBlur=\"convert_date(tgltransfer)\">";              
                echo "      </td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Status</td>";
                echo "      <td class=\"verdana9blk\">: <b>".$PER->statusfile."</b></td>";
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
			$sqllunas="select months_between(sysdate, to_date('".$PER->bookterakhir."','dd/mm/yyyy')) gapbln, ".$PER->grace." gp from dual"; 
			$DB->parse($sqllunas);
	   		$DB->execute();
	   		$argp=$DB->nextrow();
     		
			//echo $sqllunas;
			
			//echo 'x'.$PER->statusfile;
        		//if($PER->statusfile!='AKTIF'||substr($PER->produk,0,3)!="JL2"){
				if($PER->statusfile!="AKTIF"){
					if(substr($PER->produk,0,3)!="JL4"){
					?>
					<tr>
				  <td align="center" bgcolor="#E4E4E4" class="verdana10redb">MUTASI TIDAK DAPAT DIPROSES. POLIS SEDANG TIDAK AKTIF/PRODUK BUKAN JENIS UNIT LINK</td>
				</tr>
					<? 
					}
					else if ($argp["GAPBLN"]>$argp["GP"]) {
					?>
					<tr>
				  <td align="center" bgcolor="#E4E4E4" class="verdana10redb">MUTASI TIDAK DAPAT DIPROSES. PELUNASAN TERKAHIR MELEBIHI GRACE PERIOD</td>
				</tr>
					<?
					}
					 else {?>
                <tr>
                  <!--<td align="center" bgcolor="#E4E4E4"><?echo "<input type=\"submit\" value=\"SUBMIT\" name=\"Submit\" style=\"font-size: 8pt; font-family: Verdana\">"; ?></td> -->
                  <td align="center" bgcolor="#E4E4E4" class="verdana10redb">MUTASI TIDAK DAPAT DIPROSES. POLIS TIDAK AKTIF</td>
                </tr>
                    <? }
				} else {
					if((substr($PER->produk,0,3)!="JL4")){
					?>
					<tr>
				  <td align="center" bgcolor="#E4E4E4" class="verdana10redb">MUTASI TIDAK DAPAT DIPROSES. POLIS SEDANG TIDAK AKTIF/PRODUK BUKAN JENIS UNIT LINK</td>
				</tr>
					<? 
					}
					else if ($argp["GAPBLN"]>$argp["GP"]) {
					?>
					<tr>
				  <td align="center" bgcolor="#E4E4E4" class="verdana10redb">MUTASI TIDAK DAPAT DIPROSES. PELUNASAN TERKAHIR MELEBIHI GRACE PERIOD</td>
				</tr>
					<?
					}
					 else {
				?>
            <tr>
              <td align="center" bgcolor="#E4E4E4"><?echo "<input type=\"submit\" value=\"SUBMIT\" name=\"Submit\" style=\"font-size: 8pt; font-family: Verdana\">"; ?></td>
            </tr>
        		<? }
				
				} ?>
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