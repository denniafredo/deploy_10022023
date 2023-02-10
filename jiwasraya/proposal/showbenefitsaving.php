<? 
  include "../../includes/database.php";
  include "../../includes/common.php";
  include "../../includes/formula44.php";
  include "../../includes/session.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";
  include "../../includes/kantor.php";
  	$KTR=New Kantor($userid,$passwd,$kantor);
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	$PER=new Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
    $KLN=New Klien($userid,$passwd,$PER->notertanggung);
	$sql="select a.*,to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,decode(a.JENIS,'T','TOP UP','R','REDEMPTION','X','TAHAPAN','S','SALDO') JENIS,to_char(a.tglTRANSFER,'DD/MM/YYYY') mutasi ".
       "from $DBUser.tabel_223_transaksi_saving a where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ORDER BY a.tgltransfer";
	//echo $sql;		 
	$DB->parse($sql);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<title>Benefit Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table width="100%" cellpadding="0" cellspacing="1" class="verdana8"><!-- tabel 2-->

      				<tr>
          		<td width="18%">Nomor Polis</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $prefixpertanggungan."-".$nopertanggungan;?></td>
        			<td width="18%">&nbsp&nbsp </td>
      				<td width="2%">&nbsp&nbsp </td>
      				<td width="30%">&nbsp&nbsp </td>				
      				</tr> 

      				<tr>
          		<td width="18%">Tertanggung</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->namatertanggung;?></td>
        			<td width="18%">Cara Bayar</td>
      				<td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->namacarabayar;?></td>				
      				</tr> 
      				
      				<tr>
          		<td width="18%">Pemegang Polis</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->namapemegangpolis;?></td>
        			<td width="18%">Pembayar Premi</td>
      				<td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->namapembayarpremi;?></td>				
      				</tr>

      				<tr>
          		<td width="18%">Mulai Asuransi</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->mulas;?></td>
        			<td width="18%">Produk</td>
      				<td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->namaproduk;?></td>				
      				</tr>
      								
      				<tr>
          		<td width="18%">Expirasi</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->expirasi;?></td>
        			<td width="18%">Jumlah Uang Asuransi</td>
      				<td width="2%">:</td>
      				<td width="30%"><b><? $jua = ($PER->kdstatusfile=='4') ? $PER->juaoriginal : $PER->jua; echo number_format($jua,2);?></td>				
      				</tr>
      				
      				<tr>
          		<td width="18%">Akhir Bayar Premi</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->akhirpremi;?></td>
        			<td width="18%">Lama Asuransi</td>
      				<td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->lamaasuransi." tahun";?></td>				
      				</tr>
      				
      				<tr>
          		<td width="18%">Valuta</td>
          		<td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->namavaluta;?></td>
        			<td width="18%">Index Awal</td>
      				<td width="2%">:</td>
      				<td width="30%"><b><? echo number_format($PER->indexawal,2);?></td>
      				</tr>
      				
      				<tr>
          		<td width="18%">Status Polis Saat Ini</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? $status = ($PER->kdstatusfile=='4') ? $PER->namastatusfile." mulai ".$PER->tglbpo : $PER->namastatusfile ; echo $status;?></td>
        			<td width="18%">Alamat</td>
      				<td width="2%">:</td>
      				<td width="30%"><b><? echo $KLN->alamat; ?></b></td>				
      				</tr>
			
      		 </table>
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht"><td align="center"><b>Laporan Transaksi Polis Nomor <? echo $prefixpertanggungan."-".$nopertanggungan;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
	<tr class="hijao" align=center>
	<td>No.</td>
	<td>Tanggal</td>
    <td>Desisi</td>
	<td>Nilai</td>
    <td>Saldo</td>
	<td>Jenis</td>
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "../../includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td class=verdana9><a href=\"#\" onclick=\"NewWindow('./saving.php?jua=".$arr["SALDO"]."&pref=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["MUTASI"]."</a></td>";
		echo "<td class=verdana9 align='center'><a href=# onclick=NewWindow('../polis/cetakizin_klaim_redsaving.php?&kdklaim=R&tglpengajuan=".$arr["TGLMUTASI"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>".$arr["NOIZIN"]."</a></td>";
		echo "<td class=verdana9>".number_format($arr["NILAIBENEFIT"],2)."</td>";
		echo "<td align='right' class=verdana9>".number_format($arr["SALDO"],2)."</td>";		
		echo "<td class=verdana9>".$arr["JENIS"]."</td>";
        echo "</tr>";
		$jmlpremi = $jmlpremi + $arr["PREMI"]; 
		$jmlbenefit = $jmlbenefit + $hasilbenefit; 
		$i++;
	} //foreach
	
	$sql="select a.premistd,b.faktorbayar,c.namacarabayar ".
			 "from $DBUser.tabel_311_faktor_bayar b,$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar c ".
			 "where a.kdvaluta=b.kdvaluta and a.kdcarabayar=b.kdcarabayar and c.kdcarabayar=b.kdcarabayar ".
			 "and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$fb=$DB->nextrow();
	$faktorbayar=$fb["FAKTORBAYAR"]; 
			 
	//echo "<tr class=tblhead1><td colspan=4 align=right class=arial10wht>Premi Standar Tahunan</td>";
	//echo "<td align=right class=arial10wht>".number_format($fb["PREMISTD"],2)."</td>";
	//echo "<td align=right class=arial10wht colspan=3></td>";
	//echo "<tr class=tblisi1><td colspan=4 align=right class=verdana9>Premi ".$fb["NAMACARABAYAR"]."</td>";
	//echo "<td align=right class=verdana9><b>".number_format(($jmlpremi*$faktorbayar),2)."</td>";
	//echo "<td align=right class=arial10wht colspan=3></td>";
	echo "</table>";
?>
</td>
</tr>
</table>
</td>
</tr>
</table>

<table width="100%">
<tr>
  <td>
	  <font face="verdana" size="2">
		<br />
        CATATAN :<br /><br />
</font>
	  <ol>
	    <li><font face="verdana" size="2">Pembayaran melalui transfer harap ditujukan ke rekening PT Asuransi PT Asuransi Jiwa IFG.</font></li>
	    <li><font face="verdana" size="2">Pada saat Bapak/Ibu membayar Premi, pastikan nomor polis Bapak/Ibu tertulis dengan benar dan setiap transaksi hanya untuk satu Polis saja.</font></li>
	    <li><font face="verdana" size="2">Agar pembayaran Bapak/Ibu dapat lebih cepat diidentifikasi mohon mengkonfirmasikannya dan mengirimkan bukti transfer melalui telpon dan faksimiili ke nomor <?=$KTR->phone01.' / '.$KTR->phone02;?></font></li>
	    <li><font face="verdana" size="2">Demikian informasi dari Kami, apabila terdapat hal-hal yang kurang jelas dan ingin mengetahui lebih lanjut, Bapak/Ibu dapat menghubungi PT Asuransi Jiwa IFG <?=ucwords($KTR->namakantor);?></font></li>
	    <li><font face="verdana" size="2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</font></li>
	    </ol>	</td>
</tr> 
<tr>
  <td>
	  <font face="verdana" size="2"><a href="javascript:window.close();">Close</a></font>
	</td>
</tr> 
</table>
</form>
</body>
</html>
