<?
	include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
	include "../../includes/dropdown_date.php";
	include "../../includes/klien.php";
	include "../../includes/kantor.php";
	$DB=new database($userid, $passwd, $DBName);
	$KL=new Klien($userid,$passwd,$nopenagih);
	$KTR=new Kantor($userid,$passwd,$kantor);
  
?>
<html>
<head>
<title>Sisa Tagihan</title>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 10px;
} 
form{
padding:0px;
margin:0px;
}
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

-->
</style>

</head>
<body topmargin="10" onLoad="window.print();window.close()">

      <? 
			if($kdgroup=="all")
			{
			?>
      <h4>DAFTAR TAGIHAN PREMI PENAGIH</h4>
			<? 
			}
			else
			{
			?>
      <h4>DAFTAR BON KUITANSI PREMI PER PENAGIH</h4>
			<? 
			}
			?>
			Nama Penagih : <?=$KL->nama;?>; 
			Group Tagihan : <?=$kdgroup;?>; 
			Jenis Kuitansi : <?=$kdkuitansi;?>;
			Jenis Valuta : <?=$kdvaluta;?>; 			 
			Status : <?=$kdstatus;?>;
			Tgl. Proses : <?=substr($tglprocess,-2)."/".substr($tglprocess,4,2)."/".substr($tglprocess,0,4);?>	
							 
			<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
				<tr bgcolor="#7dc2d9">
					<td height="20">No</td>
					<td>No.Polis</td>
					<td>No.Lama</td>
					<td>Pemegang Polis</td>
					<td>Cara Bayar</td>
					<td>Tgl.Booked</td>
					<td>Val.</td>
					<td>Premi</td>
					<td>Tgl.Seatled</td>
					<td>Tgl.Bayar</td>
					<!--<td>Idx.Awal</td>-->
					<td>Kd.Rek.</td>
					<td>Status</td>
				</tr>				
			<?
      $filtertgl = "and to_char(a.tglproses,'YYYYMMDD')='".$tglprocess."' ";

  			if($kdgroup=="all")
  			{
  			  $filtergrp = "";
  			}
  			else
  			{
  			  $filtergrp = "and nvl(b.tagihan,0)='$kdgroup' ";
  			}
				
				if($kdkuitansi=="all")
  			{
  			  $filterkdk = "";
  			}
  			else
  			{
  			  $filterkdk = "and a.kdkuitansi='$kdkuitansi' ";
  			}
			
			  if($kdstatus=="all")
  			{
  			  $filterstt = "";
  			}
  			else
  			{
				  if($kdstatus=="S")
					{
  			  $filterstt = "and c.tglseatled is not null ";
					}
					else
					{
					$filterstt = "and c.tglseatled is null ";
					}
  			}

 			if($kdvaluta=="all")
  			{
  			  $filtervaluta = "";
  			}
  			else
  			{
  			  $filtervaluta = "and b.kdvaluta='$kdvaluta' ";
  			}
				

  		$sql =	"SELECT  a.prefixpertanggungan, 
                  a.nopertanggungan,b.tagihan, 
                  b.nopol,b.kdvaluta,
                  (SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = b.nopemegangpolis) AS pemegangpolis,
                  (SELECT namacarabayar FROM $DBUser.tabel_305_cara_bayar WHERE kdcarabayar = b.kdcarabayar) AS carabayar,
                  decode(b.kdvaluta,'0','RPI','1','RP','3','USD','NONE') as notasi,
                  TO_CHAR (a.tglbooked, 'MM/YYYY') tglbooked,
									decode(b.kdvaluta,'0',a.premitagihan/b.indexawal,a.premitagihan) as premitagihan,
                  TO_CHAR (c.tglseatled, 'DD/MM/YYYY') tglseatled,
                  TO_CHAR (c.tglbayar, 'DD/MM/YYYY') tglbayar,
                  b.indexawal, 
                  a.kdrekeninglawan AS kdrekening,
                  decode(a.status,'0','B','1','S','?') as status,
                  b.nopenagih  
              FROM     
							    $DBUser.tabel_300_historis_premi c,
                  $DBUser.tabel_300_bontagihan a,
                  $DBUser.tabel_200_pertanggungan b 
              WHERE     a.prefixpertanggungan = c.prefixpertanggungan AND 
                  a.nopertanggungan = c.nopertanggungan and 
                  a.tglbooked=c.tglbooked and  
                  a.prefixpertanggungan = b.prefixpertanggungan AND 
                  a.nopertanggungan = b.nopertanggungan AND 
                  a.nopenagih = '$nopenagih' AND 
                  a.tglbooked <= TRUNC (SYSDATE) 
                  $filtertgl 
									$filtergrp 
									$filterkdk 
									$filterstt 
									$filtervaluta
              ORDER BY b.kdvaluta,b.kdcarabayar";
			//echo $sql;
		  
			$DB->parse($sql);
      $DB->execute();
      $i=1;
			while ($arr=$DB->nextrow())
  		{
			   if($arr["KDVALUTA"]=="0")
				 {
				   $premirpi = round($arr["PREMITAGIHAN"],2);
					 $jmlpremirpi += $premirpi;
					 $jrpi ++;
				 }
				 elseif($arr["KDVALUTA"]=="1")
				 {
				   $premirp = round($arr["PREMITAGIHAN"],2);
					 $jmlpremirp += $premirp;
					 $jrp ++;
				 }
				 elseif($arr["KDVALUTA"]=="3")
				 {
				   $premiusd = round($arr["PREMITAGIHAN"],2);
					 $jmlpremiusd += $premiusd;
					 $jusd ++;
				 }
			   echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
      	 echo "<td>$i</td>";
         echo "<td><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
      	 echo "<td>".$arr["NOPOL"]."</td>";
      	 echo "<td>".$arr["PEMEGANGPOLIS"]."</td>";
				 echo "<td>".$arr["CARABAYAR"]."</td>";
				 echo "<td>".$arr["TGLBOOKED"]."</td>";
				 echo "<td>".$arr["NOTASI"]."</td>";
      	 echo "<td align=right>".number_format($arr["PREMITAGIHAN"],2,",",".")."</td>";
				 echo "<td>".$arr["TGLSEATLED"]."</td>";
				 echo "<td>".$arr["TGLBAYAR"]."</td>";
				 echo "<td>".$arr["KDREKENING"]."</td>";
      	 echo "<td>".($arr["TGLSEATLED"]=="" ? "<font color=#ee0000>B</font>" : "S")."</td>";
         echo "</tr>";
         $i++; 
      }		

      ?>	
			  <tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah Indeks</td>
					<td align="right"><?=$jrpi;?></td>
					<td align="right"><?=number_format($jmlpremirpi,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>		
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah</td>
					<td align="right"><?=$jrp;?></td>
					<td align="right"><?=number_format($jmlpremirp,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>	
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Dolar</td>
					<td align="right"><?=$jusd;?></td>
					<td align="right"><?=number_format($jmlpremiusd,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>							
      </table>			
			<br />
			<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
              <tr>
							  <td colpan="3"><?=$KTR->kotamadya;?>, <?=date("d-m-Y"); ;?></td>
							</tr>
							<tr>
							  <td width="33%">Dibuat oleh,<p>&nbsp;</p>
                <p>( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) <br>
                Pegawai Adm. Oprs.</td>
                <td width="33%">Pemeriksa,<p>&nbsp;</p>
                <p>(<?=$KTR->kasieopr;?>)<br>
                Kasi Operasional</td>
                
                <td width="34%">Yang menerima,<p>&nbsp;</p>
                <p>(<?=$KL->nama;?>)<br>
                Penagih</td>
              </tr>
            </table>
						
</body>
</html>