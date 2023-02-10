<?
  include "./includes/database.php";	
  include "./includes/session.php";
	include "./includes/klien.php";
	include "./includes/pertanggungan.php";
//	include "../../includes/oradb.class.php";

	
	$DB=new database($userid, $passwd, $DBName);
	$DA=new database($userid, $passwd, $DBName);
	$PER=new Pertanggungan($userid,$passwd,$prefix,$noper);
	$KL=New Klien ($userid,$passwd,$PER->notertanggung);

$jenis = (!$j) ? 'Polis' : 'Proposal';
?>

	
  <html>
  <head>
  <title><?echo $jenis. " Nomor ".$prefix."-".$noper;?></title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="./includes/window.js" ></script>
  </head>
	<body>
	<div align="center">
<table class="tblborder" width="100%" cellpadding="1" cellspacing="0"><!-- tabel 0-->
 <tr>
 <td>
  <table class="tblhead" width="100%" cellpadding="1" cellspacing="0"><!-- tabel 1-->
	 <tr>
    <td  align="center" class="arial12bluen"><? echo strtoupper($jenis)." NOMOR "./*$prefix."-".$noper." / ".$PER->nopol*/$PER->nopolbaru;?></td>
   </tr>
	 
	 <tr>
    <td  align="center" class="tblhead1">Identitas Tertanggung</td>
   </tr>
	 	 
   <tr>
    <td align="center" class="tblisi">
		 <table  class="verdana8" width="95%" cellpadding="0" cellspacing="1"><!-- tabel 2-->
				<tr>
    		<td width="23%">Nomor Klien</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->notertanggung;?></td>
				<td width="23%">Nama</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $KL->nama;?></td>
    		</tr>
				
				<tr>
  			<td width="23%">Alamat Tetap</td>
				<td width="2%">:</td>
				<td colspan="4"><? echo $KL->alamat;?></td>				
				</tr>
				
				<tr>
  			<td width="23%">Alamat Tagih</td>
				<td width="2%">:</td>
				<td colspan="4"><? echo $KL->alamattagih;?></td>				
				</tr>
							
				<tr>
    		<td width="23%">Identitas</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $KL->identitas;?></td>
  			<td width="23%">Pekerjaan</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $KL->pekerjaan;?></td>				
				</tr>
				
				<tr>
    		<td width="23%">Jenis Kelamin</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $KL->namajk;?></td>
  			<td width="23%">Tempat Lahir</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $KL->tempatlahir;?></td>				
				</tr>

				<tr>
    		<td width="23%">Status Pernikahan</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $KL->meritalstatus;?></td>
  			<td width="23%">Tanggal Lahir</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $KL->tgllahir;?></td>				
				</tr>

				
				<tr>
    		<td width="23%">Tanggal Pernikahan</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $KL->tglkawin;?></td>
  			<td width="23%">Agama</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $KL->agama;?></td>				
				</tr>
				
				<tr>
    		<td width="23%">Usia Saat Ini</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $KL->usia;?> tahun</td>
  			<td width="23%">Status Saat Ini</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $KL->namastatus;?></td>				
				</tr>
																										 
		 </table><!-- tabel 2-->
		</td>
   </tr>

	 <tr class="tblhead">
    <td  align="center" class="tblhead1">Ketentuan Polis</td>
   </tr>
	 	 
   <tr>
    <td  class="tblisi" align="center">
		 <table class="verdana8" width="95%" cellpadding="0" cellspacing="1"><!-- tabel 2-->
				<tr>
    		<td width="23%">Tanggal SPAJ</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->tglsp;?></td>
  			<td width="23%">Nomor SPAJ</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->nosp;?></td>				
				</tr>
							
				<tr>
    		<td width="23%">Mulai Asuransi</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->mulas;?></td>
  			<td width="23%">Produk</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->produk." - ".$PER->namaproduk;?></td>				
				</tr>
								
				<tr>
				<td width="23%">Cabang Asuransi</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->cabas;?></td>
				<td width="23%">Jumlah Uang Asuransi</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->notasi." ".number_format($PER->jua,2);?></td>				
				</tr>
				<tr>
    		<td width="23%">Usia Saat Masuk</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->usia." tahun, ".$PER->usia_bl." bulan";?></td>
  			<td width="23%">Taltup</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->taltup;?></td>				
				</tr>
												
				<tr>
    		<td width="23%">Lama Asuransi</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->lamaasuransi." tahun, ".$PER->lamaasuransi_bl." bulan";?></td>
  			<td width="23%">Lama Pembayaran Premi</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->lamapremi." tahun, ".$PER->lamapremi_bl." bulan";?></td>				
				</tr>
								
				<tr>
    		<td width="23%">Expirasi</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->expirasi;?></td>
				<td width="23%">Akhir Bayar Premi</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->akhirpremi;?></td>
				</tr>
				
				<tr>
    		<td width="23%">Valuta</td>
    		<td width="2%">:</td>
				<td width="25%"><? echo $PER->namavaluta;?></td>
  			<td width="23%">Index Awal</td>
				<td width="2%">:</td>
				<td width="25%"><? echo number_format($PER->indexawal,2);?></td>
				</tr>

				<tr>
    		<td width="23%">Medical Status</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->statusmedical;?></td>
  			<td width="23%">Premi Standar</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->notasi." ".number_format($PER->premistandar,2);?></td>				
				</tr>	
								
				<tr>
    		<td width="23%">Premi 5 Tahun Pertama</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->notasi." ".number_format($PER->premi1,2);?></td>
  			<td width="23%">Premi Setelah 5 Tahun</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->notasi." ".number_format($PER->premi2,2);?></td>				
				</tr>
				
				<tr>
    		<td width="23%">Alamat Email</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->emailpemegangpolis;?></td>
  			<td width="23%">Cara Bayar</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->namacarabayar;?></td>				
				</tr> 
				
				<tr>
    		<td width="23%">Pemegang Polis</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->namapemegangpolis;?></td>
  			<td width="23%">Pembayar Premi</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->namapembayarpremi;?></td>				
				</tr>
				
				<tr>
    		<td width="23%">Agen</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->namaagen;?></td>
  			<td width="23%">Penagih</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->namapenagih;?></td>				
				</tr>
				
				<tr>
    		<td width="23%">Nomor BP3</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->nobp3;?></td>
  			<td width="23%">Tanggal BP3</td>
				<td width="2%">:</td>
				<td width="25%"><? echo substr($PER->tglbp3,0,10);?></td>				
				</tr>
				
				<tr>
    		<td width="23%">Status Polis Saat Ini</td>  
		    <td width="2%">:</td>
<!--
				<td width="25%"><font size=2 color=red><b><? //echo $PER->namastatusfile;?> 
-->
				<td width="25%"><font size=2 color=red><b><? echo $PER->namastatusfile;?> 
				<? 
				$sql = "select prefixpertanggungan,nopertanggungan ".
						 	 "from $DBUser.tabel_700_gadai where prefixpertanggungan='".$prefix."' and nopertanggungan='".$noper."' ".
							 "and status='3'";
				$DB->parse($sql);
				$DB->execute();
				$gdi=$DB->nextrow();
				$nopolgadai = $gdi["NOPERTANGGUNGAN"]; 
				if($nopolgadai!="")
				{
//				  echo "<font color=#0000d9> - (TERGADAI)</font>";
				  echo "<font color=black> - (TERGADAI)</font>";
				}
				?>
				</td>
  			<td width="23%">Resiko</td>
				<td width="2%">:</td>
				<td width="25%"><? echo "Rp ".number_format($PER->risk,2);?></td>				
				</tr>
			<tr>
  			<td width="23%">Keterangan Polis</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->keterangan;?></td>				
			</tr>

				<tr>
    		<td width="23%">Pembayaran Terakhir</td>  
		    <td width="2%">:</td>
				<td width="25%"><? echo $PER->tgllastpayment;?></td>
  			<td width="23%">Usia Polis Saat Ini</td>
				<td width="2%">:</td>
				<td width="25%"><? echo $PER->UsiaPolis();?></td>				
				</tr>
        <?
          if (!is_null($PER->lockmutasi)||$PER->lockmutasi <>'') {
          	 print( "				<tr class=\"arial9\">\n" );
          	 print( "    		<td width=\"23%\">Mutasi Dalam Proses</td>  \n" );
          	 print( "		    <td width=\"2%\">:</td>\n" );
          	 print( "				<td width=\"25%\"><b><font size=2 color=red>".$PER->namalockmutasi."</td>\n" );
          	 print( "  			<td width=\"23%\"></td>\n" );
          	 print( "				<td width=\"2%\"></td>\n" );
          	 print( "				<td width=\"25%\"></td>\n" );
          	 print( "				</tr>\n" );
        	
        	}
        ?>
														 
		 </table><!-- tabel 2-->
		</td>
   </tr>
	 
     <? if(substr($PER->produk,0,3)=="JL4"){ ?>
  
  <tr class="tblhead">
    <td  align="center" class="tblhead1">Porsi Fund</td>
    <td colspan="3" class="verdana8blk">:</td>
  </tr> 
  <tr>
    <td colspan="4">
		 <table align="center" width="95%" cellpadding="0" cellspacing="1" border="0" class="tblhead1">
		  <tr>
			<td>
			<table align="center" width="100%" cellpadding="0" cellspacing="1" border="0" class="tblisi">
		  <tr class="hijao">
			 <td align="center">No</td>
			 <td align="C">Jenis Fund</td>
			 <td align="left">Nama Fund</td>
             <td align="left">Porsi Fund</td>			 
		  </tr>
	<? 
	$sql = "select b.kdfund,b.namafund,a.porsi ||'%' porsi from $DBUser.tabel_ul_opsi_fund a,$DBUser.tabel_ul_kode_fund b where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' and 
a.kdfund=b.kdfund";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		
		$i=1;
		while ($arr=$DB->nextrow()) {
  	include "./includes/belang.php";
		   print( "<td class=\"verdana8blu\" align=\"center\">".$i."</td>" );
  		 print( "<td class=\"verdana8blu\" align=\"center\">".$arr["KDFUND"]."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$arr["NAMAFUND"]."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$arr["PORSI"]."</td>" );			 
			 
		   print( "</tr>" );
			
		  $i++;
		}		 
	?>	
			 </table>
     </td>    	
		 </table>
     </td>
	<tr>
    <? } ?>
    
	 <tr class="tblhead">
    <td  align="center" class="tblhead1">Benefit dan Premi</td>
   </tr>
	 
	 <tr>
	  <td class="tblisi" align="center">
		 <table width="95%" cellpadding="1" cellspacing="1" border="0">
		  <tr class="hijao">
			 <td align="center">No</td>
			 <td align="center">Nama Benefit</td>
			 <td align="center">J</td>
			 <td align="center">K</td>
			 <td align="center">Nilai Benefit</td>
			 <td align="center">P r e m i</td>
			 <td align="center">Jatuh Tempo</td>
			 <td align="center">Tgl Klaim</td>
			</tr>
		<? 
		$sql = "select a.kdbenefit,b.namabenefit,a.kdjenisbenefit,a.nilaibenefit,b.kdkelompokbenefit, ".
				   "to_char(a.expirasi,'DD/MM/YYYY') expirasi, a.premi ".
					 "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_207_kode_benefit b ".
					 "where a.kdbenefit=b.kdbenefit and a.prefixpertanggungan='$prefix' and ".
					 "a.nopertanggungan='$noper' and a.kdbenefit not in ('COA','TTPPREM')  order by a.expirasi";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		
		$i=1;$prmthn=0;
		while ($arr=$DB->nextrow()) {
  	  include "./includes/belang.php";
			 $nb=($arr["NILAIBENEFIT"]==0) ? "" : number_format($arr["NILAIBENEFIT"],2);
			 $np=($arr["PREMI"]==0) ? "" : number_format($arr["PREMI"],2);
			 
		   print( "<td class=\"verdana8\" align=\"center\">$i</td>" );
  		 //print( "<td class=\"verdana8\" align=\"left\">".$arr["KDBENEFIT"]."</td>" );
			 print( "<td class=\"verdana8\" align=\"left\">".$arr["NAMABENEFIT"]."</td>" );
			 print( "<td class=\"verdana8\" align=\"center\">".$arr["KDJENISBENEFIT"]."</td>" );
			 print( "<td class=\"verdana8\" align=\"center\">".$arr["KDKELOMPOKBENEFIT"]."</td>" );
			 print( "<td class=\"verdana8\" align=\"right\">".$nb."</td>" );
			 print( "<td class=\"verdana8\" align=\"right\">".$np."</td>" );
			 print( "<td class=\"verdana8\" align=\"center\">".$arr["EXPIRASI"]."</td>" );
			 print( "<td class=\"verdana8\" align=\"center\">".$arr["TGLSP"]."</td>" );
		   print( "</tr>" );

			$i++;
      if($arr["KDJENISBENEFIT"]=="R")      
      $prmthn= $prmthn;
      else                
			$prmthn+= $arr["PREMI"];
		}
		?>	
		  <tr class="tblisi1">
			 <td colspan="5" align="center">Premi Tahunan</td>
			 <td align="right"><? echo $PER->notasi." ".number_format($prmthn,2); ?></td>
			 <td colspan="2" align="right"></td>
			 </tr>			
		 </table>
  	</td>
   </tr>
		 
	 <tr class="tblhead">
    <td  align="center" class="tblhead1">Beneficiary</td>
   </tr>

	 <tr>
	  <td  class="tblisi" align="center">
		 <table width="95%" cellpadding="0" cellspacing="1" border="0">
		  <tr>
			 <td class="hijao" align="center">No</td>
			 <td class="hijao" align="left">Nomor Klien</td>
			 <td class="hijao" align="left">Nama Klien</td>
			 <td class="hijao" align="left">Hubungan</td>
		  </tr>
	<? 
	$sql = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,c.namahubungan ".
			   "from $DBUser.tabel_219_pemegang_polis_baw a, ".
				 "$DBUser.tabel_218_kode_hubungan c ".
				 "where a.kdinsurable=c.kdhubungan and a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
				 "and a.notertanggung='".$PER->notertanggung."' ".
				 "order by a.nourut ";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		
		$i=1;
		while ($arr=$DB->nextrow()) {
  	  include "./includes/belang.php";
			$KL=New Klien($userid,$passwd,$arr["NOKLIEN"]);
			if ($arr["KDINSURABLE"]=='04') {
			 $hub=($arr["NOKLIEN"]==$PER->notertanggung) ? "DIRI TERTANGGUNG" : "BELUM DIDEFINISIKAN";
			} else {
			 $hub = $arr["NAMAHUBUNGAN"];
			}
		   print( "<td class=\"verdana8blu\" align=\"center\">".$arr["NOURUT"]."</td>" );
  		 print( "<td class=\"verdana8blu\" align=\"center\">".$arr["NOKLIEN"]."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$KL->nama."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$hub."</td>" );
		   print( "</tr>" );
			
		  $i++;
		}		 
	?>	
	    	
		 </table>
  	</td>
   </tr>
		 
	 <tr class="tblhead">
    <td  align="center" class="tblisi1">&nbsp;</td>
   </tr>
	 	 	 
	</table><!-- tabel 1-->
  </td>
 </tr>
 
 <tr>
  <td align="center" class="arial10wht">
<?if (!$j) {?>	
	<input type="button" class="buton" name="cetakanpolis" value="Cetakan Polis" onClick="NewWindow('../pelaporan/show_polis.php?prefix=<?echo $prefix;?>&nopertanggungan=<?echo $noper;?>','',720,600,1)">
	<input type="button" class="buton" name="mutasipolis" value="Mutasi Polis" onClick="NewWindow('../polis/mutasi.php?prefix=<?echo $prefix;?>&noper=<?echo $noper;?>','',800,600,1)">
	<input type="button" class="buton" name="kartupremi" value="Kartu Premi" onClick="NewWindow('../akunting/kartupremi1.php?prefix=<?echo $prefix;?>&noper=<?echo $noper;?>','',700,500,1)">
	<input type="button" class="buton" name="kartugadai" value="Kartu Gadai" onClick="NewWindow('../akunting/kartugadai1.php?prefix=<?echo $prefix;?>&noper=<?echo $noper;?>','',700,500,1)">
	<!--<input type="button" class="buton" name="cetakbk" value="Cetak BK" onclick="NewWindow('cetakanbk.php?prefixpertanggungan=<?echo $prefix;?>&nopertanggungan=<?echo $noper;?>','',650,500,1)">-->
	<input type="button" class="buton" name="cetakutk" value="Ucp.T.Kasih" onClick="NewWindow('ucapan_terimakasih.php?prefixpertanggungan=<?echo $prefix;?>&nopertanggungan=<?echo $noper;?>','',650,500,1)">
	<!--<input type="button" class="buton" name="cetaktt" value="T.Terima" onclick="NewWindow('tanda_terima.php?prefixpertanggungan=<?echo $prefix;?>&nopertanggungan=<?echo $noper;?>','',650,500,1)">-->
<?}?>	
	<input type="button" class="buton" name="komisiagen" value="Komisi Agen" onClick="NewWindow('../proposal/popupkom.php?prefix=<?echo $prefix;?>&noper=<?echo $noper;?>','',500,300,1)">
	<input type="button" class="buton" name="nilaitebus" value="Nilai Tebus" onClick="NewWindow('../proposal/tebus.php?kdproduk=<?echo $PER->produk;?>&jua=<?echo $PER->jua;?>&nottemp=1&pref=<?echo $prefix;?>&noper=<?echo $noper;?>','',300,300,1)">
	<input type="button" class="buton" name="histduplikat" value="Hist Cetak Polis" onClick="NewWindow('../proposal/hist_duplikat.php?pref=<?echo $prefix;?>&noper=<?echo $noper;?>','name','600','300','yes');return false" style="font-size: 8pt">

		<?
// Tambahan oleh Ari per 04/12/2007 untuk Produk JS-LiNk (JL0/JL1) / Astha Plus (ATP) / Dwiguna Idaman (DGI) 
			 if (substr($PER->produk,0,3)=='JL0'||substr($PER->produk,0,3)=='JL1'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"Transaksi JS-Link\" onclick=\"NewWindow('../polis/mutasi_jslink.php?noper=$noper&prefix=$prefix','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } else if (substr($PER->produk,0,3)=='JL2'||substr($PER->produk,0,3)=='JL3'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"Trans. New Js-Link\" onclick=\"NewWindow('../polis/mutasi_jslink2.php?noper=$noper&prefix=$prefix','popupmutasi','950','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 }
			 else if (substr($PER->produk,0,3)=='ATP'||substr($PER->produk,0,3)=='DGI'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"Transaksi DPLK\" onclick=\"NewWindow('../polis/mutasi_atp.php?noper=$noper&prefix=$prefix','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } 
		?>

		<? 
		// Tambahan dari Ari 08/08/2011
		$polisbaru_smart="$prefix-$noper"; printf("<input type=\"button\" name=\"docpolis\" value=\"DOKUMEN\" onclick=\"NewWindow('https://sae-aws.ifg-life.id/smart_ifglife/list.php?no_polis1=".base64_encode(base64_encode($polisbaru_smart))."','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">"); 
		?>
	<input type="button" class="buton" name="spajolpdf" value="SPAJ-OL" onClick="NewWindow('http://192.168.2.23:8081/jlindo_api/generate_pdf.php?noPol=<?echo $prefix.$noper;?>','name','600','300','yes');return false" style="font-size: 8pt">

	</td>
 </tr>

</table><!-- tabel 0-->
</div>
</body>
</html>
