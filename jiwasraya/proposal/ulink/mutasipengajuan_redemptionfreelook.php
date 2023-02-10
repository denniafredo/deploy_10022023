<? 
  include "./includes/common.php";
  include "./includes/session.php";
	include "./includes/database.php";
	include "./includes/pertanggungan.php";
	$DB2=New database($userid, $passwd, $DBName);
  $DB3=New database($userid, $passwd, $DBName);
	$PER=New Pertanggungan($userid,$passwd,$prefix,$noper);

?>

<html>
<head>
<title>Historis Transaksi JS-LiNk</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./includes/bootstrap.min.css">
<script language="JavaScript" type="text/javascript" src="./includes/jq.js"></script>

<style type="text/css">
 
td {
 font-family: verdana;
 font-size: 10;
 padding: 2px;
} 

</style>

<body>
	<table border="1" cellpadding="0" style="border-collapse: collapse" bordercolor="#BAD5F5" width="100%" id="AutoNumber3" class="verdana8">
        <tr>
          <td bgcolor="#BAD5F5" height="15"><b>Historis Pengajuan Redemption</b><br></td>
        </tr>
         <tr>
          <td colspan="8" align="center" class="tblisi">
      		 <table width="100%" cellpadding="0" cellspacing="1" class="verdana8"><!-- tabel 2-->

      				<tr>
          		<td width="18%">Nomor Polis</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $prefix."-".$noper?></td>
        			<td width="18%">&nbsp&nbsp </td>
      				<td width="2%">&nbsp&nbsp </td>
      				<td width="30%">&nbsp&nbsp </td>				
      				</tr> 

      				<tr>
          		<td width="18%">Tertanggung</td>  
      		    <td width="2%">:</td>
      				<td width="30%"><b><? echo $PER->namatertanggung?></td>
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
        			<td width="18%">&nbsp&nbsp </td>
      				<td width="2%">&nbsp&nbsp </td>
      				<td width="30%">&nbsp&nbsp </td>				
      				</tr>
			
      		 </table>
      		</td>
         </tr>

        <tr>
          <td>
          <?
          $sql = "SELECT * FROM  $DBUser.TABEL_UL_OPSI_FUND WHERE PREFIXPERTANGGUNGAN='$prefix' AND NOPERTANGGUNGAN='$noper'";
					$DB2->parse($sql);
    			$DB2->execute();

					while ($row1=$DB2->nextrow()) {	
		  		?>

          <table width="100%" cellpadding="0" cellspacing="1" border="0">
					<tr>
						<td colspan="10"><?=$row1["KDFUND"];?></td></tr>
                <tr bgcolor="#cccccc">
          	<td rowspan="1" align="center">Tanggal Pengajuan</td>
          	<td rowspan="1" align="center">Kode Jenis</td>
          	<td rowspan="1" align="center">Jumlah</td>
          	<td rowspan="1" align="center">Status</td>
          	<td rowspan="1" align="center">Penerima</td>		
          	<td rowspan="1" align="center">Rekening</td>
          	<td rowspan="1" align="center">Nama Bank</td>
          	<td rowspan="1" colspan="2" align="center">Cabang</td>
          </tr>
          	
          	<?
            
            $kdfund = $row1["KDFUND"];

						$msquery = "select * from $DBUser.TABEL_UL_PENGAJUAN_REDFREELOOK where prefixpertanggungan = '$prefix' AND nopertanggungan = '$noper' AND kdfund = '$kdfund' order by tgl_pengajuan";



						// echo $msquery;
    				
    				$DB3->parse($msquery);
    				$DB3->execute();
            $i=1;
    				$jmlunit=0;
            while ($row=$DB3->nextrow()) {

    				 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "dddddd").">";
                 print( " <td align=center>".$row["TGL_PENGAJUAN"]."</td>\n" );
                 print( " <td align=center>".$row["KDFUND"]."</td>\n" );
                 print( " <td align=center>".$row["JUMLAH"]."</td>\n" );
                 print( " <td align=center>".$row["STATUS"]."</td>\n" );
                 print( " <td align=center>".str_replace("`", "'", $row["PENERIMA"])."</td>\n" );
                 print( " <td align=center>".$row["REKENING"]."</td>\n" );
                 print( " <td align=center>".$row["BANK"]."</td>\n" );
                 print( " <td align=center>".$row["CABANG"]."</td>\n</tr>" );
								 $i++;
          	}

          	?>

           </td>
           </tr>				 
          </table>
      		</td>
        </tr> 
      </table>
      
<?php } ?>

 <br>

    			<div class="col-sm text-center">
            <a href="mutasiredempfreelook.php"><u>Close </u></a>
          </div>


</body>
</html>
