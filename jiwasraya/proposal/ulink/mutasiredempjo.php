<?php
 include "./includes/session.php";
 include "./includes/database.php";
 include "./includes/klien.php";
 include "./includes/pertanggungan.php";
 include "./includes/tgl.php"; 	
 include "./includes/sendemail.php";
 $DB  = New Database($userid,$passwd,DBName);	 
 $DBU  = New database($userid, $passwd, $DBName);												   
 //$prefixpertanggungan = $kantor;
//$myServer = "192.168.4.27";
$myServer = "192.168.4.27\IFGUL";
$myUser = "ifg";
$myPass = "siar";
$myDB = "UNITLINK"; 

//connection to the database
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer"); 

//select a database to work with
$selected = mssql_select_db($myDB, $dbhandle)
  or die("Couldn't open database $myDB"); 

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
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}

function loadcek(theForm){
	/*var polis=theForm.pertanggungan.value;
	if (!polis =='') { 
		var prefix=polis.substring(0,2);
		var noper=polis.substring(3);*/
		//NewWindow('../loadcek.php?prefix='+prefix+'&noper='+noper+'','',700,600,1)
		var jml=cekjua.jumlah.value;
		var jmlawal=cekjua.jumunit.value;
		var jmlrp=cekjua.jumrp.value;
		var jmlnab=cekjua.jumnab.value;
		if(cekjua.kdredemption.value=='U' || cekjua.kdredemption.value=='UE'){
			if((jmlawal-jml)<=1000) { var konfirmasi=confirm('Sisa Jumlah Unit kurang dari 1000, Lanjukan dengan tebus?')
				if (konfirmasi){
					cekjua.jumlah.value=jmlawal;
					cekjua.jumlah.readOnly = true;
					cekjua.tglpengajuan.focus();
				}
				else {cekjua.jumlah.focus();}
			;}
			
			/*if((jml)<1000) { var konfirmasi=alert('Jumlah Unit Minimal 1000')
				if (konfirmasi){
					cekjua.jumlah.value=jmlawal;
					cekjua.jumlah.readOnly = true;
					cekjua.jumlah.focus();
					cekjua.Submit.disabled=true;
				}
				else {cekjua.jumlah.focus();}
			;}*/
		}
		else if(cekjua.kdredemption.value=='R' || cekjua.kdredemption.value=='RE'){
			if((jmlrp-jml)<=2000000) { var konfirmasi=confirm('Sisa Jumlah Unit kurang dari 1000, Lanjukan dengan tebus?')
				if (konfirmasi){
					cekjua.jumlah.value=jmlawal;
					cekjua.jumlah.readOnly = true;
					cekjua.tglpengajuan.focus();
					cekjua.kdredemption.selectedIndex=1;
				}
				else {cekjua.jumlah.focus();}
			;}
			
			/*if((jml/jmlnab)<1000) { var konfirmasi=alert('Jumlah Unit Minimal 1000')
				if (konfirmasi){
					cekjua.jumlah.value=jmlawal;
					cekjua.jumlah.readOnly = true;
					cekjua.jumlah.focus();
					cekjua.kdredemption.selectedIndex=1;
				}
				else {cekjua.jumlah.focus();}
			;}*/
		}
		else {
		alert('pilih jenis redemption!');
		}
		//NewWindow('./loadcekstock.php?jum='+jml+'','',300,300,1)
	//}
}enablejml
function enablejml(theForm){
cekjua.jumlah.readOnly = false;
cekjua.jumlah.value=0;
cekjua.jumlah.focus();
}

function enabledcek(theForm){
	if(cekjua.tglpengajuan.value==''){
		alert('Isi tanggal Pengajuan!');}
	else if(cekjua.jumlah.value<=0){
		alert('Isi Nilai Redempton!');
		cekjua.jumlah.focus();
	}
	else if(cekjua.kdredemption.value==''){
		alert('pilih jenis redemption!');
	}
	else{
	cekjua.Submit.disabled=false;}
}
</script>

</head>
<body>
<a class="verdana10blk"><b>MUTASI REDEMPTION POLIS</b></a>
<hr size=1>
<? 
if ($Submit) {
 #----------------------------------------------------------------------- sendmail mutasi jua
		 
   for ($i=1; $i<=$jmlf; $i++)
		{
			if (${$kd[$i-1]} > 0) {						  
		 $sql = "insert into nadm.TABEL_UL_PENGAJUAN_REDEMPTION ".
            "(prefixpertanggungan, nopertanggungan, tgl_pengajuan, ".
            " kode_jenis, jumlah, user_update, tgl_update, status,penerima,rekening,bank,cabang, kdfund ".
            ")".
			"values (".
			"'$prefix','$noper',".
			"to_date('$tglpengajuan','DD/MM/YYYY'),'$kdredemption',REPLACE('".${$kd[$i-1]}.			 
			
		//echo $sql;
		 $DB->parse($sql);
		 $DB->execute();
			 $DB->commit;
												 
		}}
	   
	   if($DB->execute())
		 {
		   echo "Berhasil.. data redemption disimpan.";
		 }
		 else
		 {
		   echo "<font color=#ff0000>Gagal.. mungkin sudah ada pengajuan redemption</font>";
		 }
		 ?>
		 <br />
		 Lihat detail polis 
		 <?
		 echo "<a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$prefix."&noper=".$noper."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$prefix."-".$noper."</a>";

		 echo "<br />";
		 //echo "Lihat <a href='../pelaporan/info_tupup.php'>Status Transaksi Top-Up Sekaligus</a>";

		 /*
		 
		 $query = "select prefixpertanggungan,nopertanggungan from nadm.tabel_603_mutasi_pert ".
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
		 $sql = "select a.prefixpertanggungan,a.nopertanggungan,b.kdrayonpenagih,c.namaklien1,d.namaklien1 tertanggung,b.nopenagih ".
				     "from nadm.tabel_200_pertanggungan a, nadm.tabel_500_penagih b, nadm.tabel_100_klien c, nadm.tabel_100_klien d ".
			       "where b.kdrayonpenagih='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' and a.kdpertanggungan='2' ".
				     "AND a.kdstatusfile in ('1','3','4','L') ".
					 "and c.noklien=b.nopenagih and a.nopenagih=b.nopenagih and a.notertanggung=d.noklien order by a.nopertanggungan";
     //echo $sql;
		 $DB->parse($sql);
	   $DB->execute();
	   $arx=$DB->nextrow();
     $prefix = $arx["PREFIXPERTANGGUNGAN"];
		 $PER	= New Pertanggungan($userid,$passwd,$prefix,$nopertanggungan);
		
		 if ($prefix == "X") { 
			  echo "<font face=\"Verdana\" size=\"2\">Nomor Polis $nopertanggungan bukan dari kantor $kantor atau status polis tidak aktif</font>";   
     } 
		 else 
		 {
        echo "<div align=\"center\">";
        echo "<form name=\"cekjua\" action=\"$PHP_SELF\" method=\"post\" onSubmit=\"return checkbox_checker();\">";
        ?>
          <table border="0" width="600" bgcolor="#ED1C24" cellspacing="1" cellpadding="6">
            <tr>
              <td align="center" bgcolor="#ED1C24" class="verdana9wht"><b><?echo "NO. POLIS : ".$prefix." - ".$nopertanggungan; ?></b></td>
            </tr>
        
            <tr>
              <td width="100%" bgcolor="#e5e5e5">
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
                echo "      <td class=\"verdana9blk\">Saldo Unit</td>";
                echo "      <td class=\"verdana9blk\">: ".number_format($jmlunit,4)."</td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">NAB</td>";
                echo "      <td class=\"verdana9blk\">: ".$rowunit["NAB"]."</td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Dalam Rupiah</td>";
                echo "      <td class=\"verdana9blk\">: ".number_format(($rowunit["NAB"]*$jmlunit),2)."</td>";
                echo "    </tr>";
				//=================
				$qunit="SELECT   NOMOR_POLIS, SUM (UNIT
                             * CASE TRX_TYPE
                                  WHEN 'S' THEN 1
                                  WHEN 'T' THEN 1
                                  WHEN 'R' THEN -1
                                  WHEN 'C' THEN -1
                               END)
						SALDO, SUBSTR (KODE_FUND, 5, 2) FUND, (SELECT NAMAFUND FROM $DBUser.TABEL_UL_KODE_FUND where kdfund=SUBSTR (b.KODE_FUND, 5, 2)) NAMAFUND,(select nab_jual from $DBUser.TABEL_ul_nab where kode_fund=SUBSTR (b.KODE_FUND, 5, 2) ".
									"and tgl_nab in (select max(tgl_nab) from $DBUser.TABEL_ul_nab where kode_fund=SUBSTR (b.KODE_FUND, 5, 2))) NAB
						FROM   $DBUser.TABEL_UL_TRANSAKSI b
					    WHERE       NOMOR_POLIS = '$prefix$nopertanggungan'
							   AND STATUS = 'GOOD FUND'
							   AND ST_PROSES <> 'X'
					    GROUP BY   NOMOR_POLIS, KODE_FUND";
						//echo $qunit;
					//$runit = mssql_query($qunit);
					//$rowunit = mssql_fetch_array($runit);
					//$jmlunit=$rowunit["UNIT"];
					$DBU->parse($qunit);
					$DBU->execute();
				echo "    <tr><td colspan='2'>";
				echo "<table width='100%'>";	
				echo "<tr><td align='center' class=verdana9blk><b>Keterangan</b></td><td align='center' class=verdana9blk><b>Unit</b></td>".
				"<td align='center' class=verdana9blk><b>NAB</b></td><td align='center' class=verdana9blk><b>Rupiah</b></td></tr>";
				while ($aru=$DBU->nextrow()) {
					echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
					echo "<td class=verdana9blk>".$aru["NAMAFUND"]."</td>";
					echo "<td align='center' class=verdana9blk>".$aru["SALDO"]."</td>";
					echo "<td align='center' class=verdana9blk>".$aru["NAB"]."</td>";
					echo "<td align='right' class=verdana9blk>".number_format($aru["SALDO"]*$aru["NAB"],2,',','.')."
						<input type='hidden' id='jumlahRP' value = '".$aru["SALDO"]*$aru["NAB"]."'>
					</td>";
					//echo "<td class=verdana9blk align=center>".$arr["PORSI"]."</td>";
					echo "</tr>";
					
					$i++;
					}
				echo "</td></tr>";	
				echo "</table>";	   
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Jenis Redemption</td>";
                echo "      <td class=\"verdana9blk\">: ";
				?>
				<input type="hidden" name="jumunit" value="<?=$jmlunit;?>" >
				<input type="hidden" name="jumrp" value="<?=$rowunit["NAB"]*$jmlunit;?>" >
				<input type="hidden" name="jumnab" value="<?=$rowunit["NAB"];?>" >
				<select size="1" name="kdredemption" onChange="return enablejml(document.cekjua)">
					<option value="">---Jenis Redemption---</option>
					<?
					  echo "<option value='U'>DALAM UNIT</option>";
					  //echo "<option value='U'>DALAM UNIT (EKSPIRASI)</option>";
					  echo "<option value='R'>DALAM RUPIAH</option>";
					  //echo "<option value='RE'>DALAM RUPIAH (EKSPIRASI)</option>";
					?>
					</select>
				<?
				echo "</td>";
                echo "    </tr>";

                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Jumlah</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=jumlah size=15 onblur=\"return loadcek(document.cekjua)\">";             
                echo "      UNIT(9999,9999) RUPIAH (999999,99)</td>";
                echo "    </tr>";

				echo "</td>";
                echo "    </tr>";

                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Tgl. Pengajuan (DD/MM/YYYY)</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=tglpengajuan size=10  onBlur=\"convert_date(tglpengajuan);enabledcek(document.cekjua)\">";             
                echo "      </td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Status</td>";
                echo "      <td class=\"verdana9blk\">: <b>".$PER->statusfile."</b></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Nama Penerima</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=penerima size=50 >";             
                echo "      </td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">No. Rekening</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=rekening size=30 >";             
                echo "      </td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Nama Bank</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=bank size=20 >";             
                echo "      </td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Cabang</td>";
                echo "      <td class=\"verdana9blk\">: <input type=text name=cabang size=50 >";             
                echo "      </td>";
                echo "    </tr>";
				
                //echo "    <tr>";
                echo "  </table>";
        				echo "<input type=\"hidden\" value=\"$prefix\" name=\"prefix\">";
                echo "<input type=\"hidden\" value=\"$nopertanggungan\" name=\"noper\">";
								echo "<input type=\"hidden\" value=\"$PER->produk\" name=\"kdproduk\">";
								?>
                </td>
            </tr>
        
            <? 
        		if (($PER->statusfile!="AKTIF" && $PER->statusfile!="EKSPIRASI") || substr($PER->produk,0,3)!="JL2"){
					if((substr($PER->produk,0,3)!="JL3" && substr($PER->produk,0,3)!="JL2") || ($PER->statusfile!="EKSPIRASI" && $PER->statusfile!="BPO (LOCKED)" && $PER->statusfile!="AKTIF" && $PER->statusfile!="BPO")){
        		?>
        		<tr>
              <td align="center" bgcolor="#E4E4E4" class="verdana10redb"><?=$PER->statusfile;?> MUTASI TIDAK DAPAT DIPROSES. POLIS SEDANG TIDAK AKTIF/PRODUK BUKAN JENIS UNIT LINK</td>
            </tr>
        		<? 
				} else {?>
            <tr>
              <td align="center" bgcolor="#E4E4E4"><?echo "<input type=\"submit\" value=\"SUBMIT\" name=\"Submit\" style=\"font-size: 8pt; font-family: Verdana\">"; ?></td>
            </tr>
        		<? }
				} else {?>
            <tr>
              <td align="center" bgcolor="#E4E4E4"><?echo "<input type=\"submit\" value=\"SUBMIT\" name=\"Submit\" style=\"font-size: 8pt; font-family: Verdana\" disabled=\"true\">"; ?></td>
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
<a href="../../../jiwasraya/mainmenu.php"> <font face="Verdana" size="2">Menu Utama</font></a>&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="../../../jiwasraya/submenu.php?mnuinduk=150"> <font face="Verdana" size="2">All New Unit Link</font></a>
</body>
</html>