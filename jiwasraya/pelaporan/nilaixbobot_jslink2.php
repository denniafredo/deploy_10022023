<? 
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";

	$DBA=New Database($userid, $passwd, $DBName); 
	$DB=New database($userid, $passwd, $DBName);
	
	$myServer   = "danareksa";
  $myUser 		= "sa";
  $myPass 		= "siar";
  $myDB				= "unitlink";
  $s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
  $d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
?>
<html>
<head>
<title>Historis Transaksi JS-LiNk</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!-- 
td {
   font-family: verdana;
	 font-size: 10px;
	 padding:2px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<table border="1" cellpadding="0" style="border-collapse: collapse" bordercolor="#BAD5F5" width="100%" id="AutoNumber3">
        <tr>
        <?
            if ($wherektr==''){
            	 $kntr="Seluruh Kantor PT Asuransi Jiwa IFG";
        		 	 $wherekntr="";
            }
            else if (substr($wherektr,1,1)=='Z'){
            	 $kntr="Se-".$wherektr;
        		 	 $wherekntr="left(a.referenceno, 1) like '".$wherektr."%' and ";
            }
            else{
            	 $kntr="Kantor ".$wherektr;
        		 	 $wherekntr="left(a.referenceno, 2)='".$wherektr."' and ";
            }
            
            if ($op=='SUB'){
            	 $judul="Historis Transaksi SUBSCRIPTION/TOP-UP<br>".$kntr."<br>Periode ".substr($tglDariCari,-2)."/".substr($tglDariCari,4,2)."/".substr($tglDariCari,0,4)." s.d ".substr($tglSampaiCari,-2)."/".substr($tglSampaiCari,4,2)."/".substr($tglSampaiCari,0,4); 
            }
            elseif ($op=='RED'){
            	 $judul="Historis Transaksi REDEMPTION<br>".$kntr."<br>Periode ".substr($tglDariCari,-2)."/".substr($tglDariCari,4,2)."/".substr($tglDariCari,0,4)." s.d ".substr($tglSampaiCari,-2)."/".substr($tglSampaiCari,4,2)."/".substr($tglSampaiCari,0,4); 
            }
        
        ?>				
          <td bgcolor="#BAD5F5"><b><?=$judul;?></b><br></td>
        </tr>
        <tr>
          <td>
          <table width="100%" cellpadding="0" cellspacing="1" border="0">
      		  <tr bgcolor="#cccccc">
              <td align=center><b>No</b></td>
            	<td align=center><b>Tgl.Transaksi</b></td>
            	<td align=center><b>Nomor Polis</b></td>
            	<td align=center><b>Nama Pemegang Polis</b></td>
            	<td align=center><b>Tgl Mulai Asuransi</b></td>
            	<td align=center><b>Nama Produk</b></td>
            	<td align=center><b>Alokasi Investasi dari Premi</b></td>
            	<td align=center><b><?=$op=="SUB" ? "Gross Top-Up" : "Gross Redemp";?></b></td>
            	<td align=center><b>Fee (%)</b></td>
							<td align=center><b><?=$op=="SUB" ? "Nett Top-Up" : "Nett Redemp";?></b></td>
							<td align=center><b>Total Investasi</b></td>
            	<td align=center><b>Nilai NAB</b></td>
            	<td align=center><b>Jml.Unit</b></td>
							<? if($op=="SUB"){?>
            	<td align=center><b>Agen</b></td>
							<td align=center><b>Komisi Agen</b></td>
							<? } ?>
          	</tr>
          	<?
          	
          	if ($op=="SUB"){
          		 $filtersubred=" and trx_type in ('S','T')";
          	}
          	else{
          		 $filtersubred=" and trx_type='R'";
          	}
                   
          	$msquery = "select id_nasabah,nomor_polis,convert(varchar,trx_date, 103)as tgltrans, trx_date,".
            					 	 "rp_nett,convert(varchar,tgl_nab, 103)as tgl_nab,".
												 "nab_beli,unit,rp_gross, ".
  											 "trx_type, premi, rp_gross, fee_agent, ".
                         "fee_premi, fee_subcription, fee_topup, fee_redemption,  nab_jual, kode_fund, tgl_proses ".
                       "from ul_transaksi ".
                       "where status='GOOD FUND' and left(nomor_polis,2)='".$wherektr."' and ".
                       "convert(varchar,trx_date, 112)>='".$tglDariCari."' and ".
                       "convert(varchar,trx_date, 112)<='".$tglSampaiCari."'".
											 $filtersubred."";
          	//echo $msquery;
          	$msresults= mssql_query($msquery);  	
           	$i=1;
           	while ($row = mssql_fetch_array($msresults)){
          	  $PER = New Pertanggungan($userid,$passwd,substr($row["nomor_polis"], 0,2),substr($row["nomor_polis"], 2,9));		 			 					 
          		if($row["trx_type"]=="S"){
							  $fee = $row["fee_subcription"];
							} elseif($row["trx_type"]=="T") {
							  $fee = $row["fee_topup"];
							} elseif($row["trx_type"]=="R")	{
							  $fee = $row["fee_redemption"];
							} else {
							  $fee = 0;
							}
							
							$sql = "select feetopup from vkomisitopup where nomor_polis = '".$row["nomor_polis"]."'";
							$res= mssql_query($sql);
							$kom = mssql_fetch_array($res);
							$komisi = $kom["feetopup"];
							
							$nilinvest = $row["premi"]+$row["rp_nett"];
							$nettop		 = $row["rp_gross"] - ($row["rp_gross"]*($fee/100));
							
                 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "dddddd").">";
                 print( " <td align=center>".$i."</td>\n" );
                 print( " <td align=center>".$row["tgltrans"]."</td>\n" );
                 print( " <td align=left><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".substr($row['nomor_polis'],0,2)."&noper=".substr($row['nomor_polis'], 2,9)."','',900,500,1)\">".substr($row['nomor_polis'], 0,2)."-".substr($row['nomor_polis'], 2,9)."</a></td>\n" );
                 print( " <td align=left>".$PER->namapemegangpolis."</td>\n" );
                 print( " <td align=left>".$PER->mulas."</td>\n" );
                 print( " <td align=left>".$PER->namaproduk."</td>\n" );
          			 print( " <td align=right>".number_format($row["premi"],2,",",".")."</td>\n" );
                 print( " <td align=right>".number_format($row["rp_gross"],2,",",".")."</td>\n" );
                 print( "	<td align=right>".number_format($fee,2,",",".")."</td>\n" );
                 print( " <td align=right>".number_format($nettop,2,",",".")."</td>\n" );
          			 print( "	<td align=right>".number_format($row["rp_nett"],4,",",".")."</td>\n" );
                 print( "	<td align=right>".number_format($row["nab_jual"],4,",",".")."</td>\n" );
                 print( " <td align=right>".number_format($row["unit"],4,",",".")."</td>\n" );
                 if ($op=="SUB"){
								 print( " <td align=left>(".$PER->noagen.") ".$PER->namaagen."</td>\n" );
          			 print( "	<td align=right>".number_format($komisi,2,",",".")."</td>\n" );
          			 }
								 print( " </tr>	" );
          
                 $totpremi += $row["premi"];
                 $totgross += $row["rp_gross"];
                 $totfee	 += $fee;
//                 $totnett	 += $row["rp_nett"];
                 $totnett	 += $nettop;
                 $totnab	 += $row["nab_jual"];
								 $totunit	 += $row["unit"];
          			 $totkomisi+= $komisi;
								 $totinvest += $row["rp_nett"];
                 $i++;
          
          	}
          ?>
           <tr bgcolor="#cccccc">
              <td align="right" colspan="6"><b>Total</b></td>
            	<td align="right"><b><?=number_format($totpremi,2,",",".");?></b></td>
            	<td align="right"><b><?=number_format($totgross,2,",",".");?></b></td>
            	<td align="right"><b></b></td>
							<td align="right"><b><?=number_format($totnett,2,",",".");?></b></td>
							<td align="right"><b><?=number_format($totinvest,4,",",".");?></b></td>
            	<td align="right"><b></b></td>
            	<td align="right"><b><?=number_format($totunit,4,",",".");?></b></td>
							<? if($op=="SUB"){?>
            	<td align="right"><b></b></td>
							<td align="right"><b><?=number_format($totkomisi,2,",",".");?></b></td>
							<? } ?>
          	</tr>
          </table>
      		</td>
        </tr>
      </table>

 <br>
 <a href="javascript:window.close()">Close</a>
</body>
</html>
