<? 
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";

	$DBA=New Database($userid, $passwd, $DBName); 
	$DB=New database($userid, $passwd, $DBName);
?>
<html>
<head>
<title>Historis Transaksi JS-LiNk</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
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
    	 $judul="Historis Transaksi SUBSCRIPTION<br>".$kntr."<br>Periode ".substr($tglDariCari,-2)."/".substr($tglDariCari,4,2)."/".substr($tglDariCari,0,4)." s.d ".substr($tglSampaiCari,-2)."/".substr($tglSampaiCari,4,2)."/".substr($tglSampaiCari,0,4); 
    }
    elseif ($op=='TOP'){
    	 $judul="Historis Transaksi TOP-UP<br>".$kntr."<br>Periode ".substr($tglDariCari,-2)."/".substr($tglDariCari,4,2)."/".substr($tglDariCari,0,4)." s.d ".substr($tglSampaiCari,-2)."/".substr($tglSampaiCari,4,2)."/".substr($tglSampaiCari,0,4); 
    }
    elseif ($op=='RED'){
    	 $judul="Historis Transaksi REDEMPTION<br>".$kntr."<br>Periode ".substr($tglDariCari,-2)."/".substr($tglDariCari,4,2)."/".substr($tglDariCari,0,4)." s.d ".substr($tglSampaiCari,-2)."/".substr($tglSampaiCari,4,2)."/".substr($tglSampaiCari,0,4); 
    }

?>				
          <td class="verdana10blk" bgcolor="#BAD5F5"><b><?=$judul;?></b><br></td>
        </tr>
        <tr>
          <td>
          <table width="100%" cellpadding="0" cellspacing="1" border="0">
      		  <tr bgcolor="#cccccc">
              <td class="verdana10blk" align=center><b>No</b></td>
            	<td class="verdana10blk" align=center><b>Tgl.Transaksi</b></td>
            	<td class="verdana10blk" align=center><b>Nomor Polis</b></td>
            	<td class="verdana10blk" align=center><b>Nama Pemegang Polis</b></td>
            	<td class="verdana10blk" align=center><b>Tgl Mulai Asuransi</b></td>
            	<td class="verdana10blk" align=center><b>Nama Produk</b></td>
<?
   if ($op=='SUB'||$op=='TOP'){
?>				
            	<td class="verdana10blk" align=center><b>Nilai Investasi<br>(Gross)</b></td>
            	<td class="verdana10blk" align=center><b>Transaction Fee</b></td>
							<td class="verdana10blk" align=center><b>Nilai Investasi<br>(Nett)</b></td>
<?
   }
?>
            	<td class="verdana10blk" align=center><b>Tgl.NAB</b></td>
          		<td class="verdana10blk" align=center><b>Nilai NAB</b></td>
            	<td class="verdana10blk" align=center><b>Jml.Unit</b></td>
<?
   if ($op=='RED'){
?>				
							<td class="verdana10blk" align=center><b>Uang Diterima<br>(Gross)</b></td>
            	<td class="verdana10blk" align=center><b>Transaction Fee</b></td>
							<td class="verdana10blk" align=center><b>Uang Diterima<br>(Nett)</b></td>
<?
   }
?>
            	<td class="verdana10blk" align=center><b>Agen</b></td>
<?
   if ($op=='SUB'){
	 		echo "<td class='verdana10blk' align=center><b>Komisi Agen</b></td>";
	 }
?>				

          		<!--<td align=center>Bukti Setor</td>-->
          	</tr>
<?
	$myServer   = "danareksa";
  $myUser 		= "sa";
  $myPass 		= "siar";
  $myDB				= "siar";
  $s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
  $d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");

	if ($wherektr==''){
		 $wherektr="";
	}
	else{
		 $wherektr="left(a.referenceno, 2)='".$wherektr."' and ";
	}
            
  $msquery = "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "0 as jenistransaksi, a.jmldipesan as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, ".
             "a.nilainab, a.jmlunit/a.nilainab as jmlunit, 0 as redemption ".
             "from vpemesananhistory a, tableNasabah b ".
						 "where ".$wherekntr." ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglDariCari."' and ".						  				 
					   "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglDariCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  				 
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "union ".
             "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "1 as jenistransaksi, 0 as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, nilainab, ".
             "-1 * a.jmlunit, a.jmljualrpapproved as redemption ".
             "from vpenjualanhistory a, TableNasabah b ".
						 "where ".$wherektr." ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglDariCari."' and ".						  				 
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglDariCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  				 
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "order by right(a.referenceno, 6), jenistransaksi desc";

	//echo $msquery;
	$msresults= mssql_query($msquery);
			 	  	
 	$i=1;
	$jmlinvestasi=0;
	$jmlunit=0;
	$jmlgross=0;
	$jmlfee=0;
	$jmlkomisi=0;
 	while ($row = mssql_fetch_array($msresults)){
	  $ok=0;
		$fee=0;
		// Subcription atau TopUp
    if($row["jenistransaksi"]==0){
			 if ($row["refNo"]==$row["refID"]){
			    if ($op=='SUB'){
		   			 $ok=1;
					}
			 }
			 else{																																
			    if ($op=='TOP'){
		   			 $ok=1;
					}
			 }																																
    }
		// Redemption
    elseif($row["jenistransaksi"]==1){
       if ($op=='RED'){
		      $ok=1;
			 }  		
    }

		if ($ok==1){
       $PER = New Pertanggungan($userid,$passwd,substr($row["refNo"], 0,2),substr($row["refNo"], 2,9));		 			 					 

			 // Komisi
        $sqy = "select komisiagen from $DBUser.tabel_404_temp ".
        	   	 "where prefixpertanggungan='".substr($row["refNo"], 0,2)."' and nopertanggungan='".substr($row["refNo"], 2,9)."' ";
//				echo $sqy;
        $DBA->parse($sqy);
        $DBA->execute();
        $ary=$DBA->nextrow();
        $komisi = $ary["KOMISIAGEN"];

			 // Fee
			 if ($PER->produk=='JL0'){
			 		if ($op=='SUB'){
						 $fee=5/95*($row["nilaiinvestasi"]);
					}
			 		elseif ($op=='TOP'){
						 $tglkonf=substr($row["datenab"],-4).substr($row["datenab"],3,2).substr($row["datenab"],0,2);
						 $tglmulas= substr($PER->mulas,-4).substr($PER->mulas,3,2).substr($PER->mulas,0,2);

						 if ($tglkonf-$tglmulas < '20000'){
						 		if ($tglkonf=='20080404'||$tglkonf=='20080407'){
									  $fee=0;
								}						 						 						 
						 		else{
										$fee=2/100*$row["nilaiinvestasi"];
								}
						 }
						 else{
						 		$fee=0;
						 }						 
					}
			 		elseif ($op=='RED'){
						 $tglkonf=substr($row["datenab"],-4).substr($row["datenab"],3,2).substr($row["datenab"],0,2);
						 $tglmulas= substr($PER->mulas,-4).substr($PER->mulas,3,2).substr($PER->mulas,0,2);
						 			
						 if ($tglkonf-$tglmulas < '20000'){						 						 						 
						 		if ($tglkonf=='20080404'||$tglkonf=='20080407'){
									  $fee=0;
								}						 						 						 
						 		else{
										$fee=2/100*$row["redemption"];
								}
						 }
						 else{
						 		$fee=0;
						 }
					}
			 }
			 elseif ($PER->produk=='JL1'){
			 		if ($op=='SUB'){
						 $fee=7/93*($row["nilaiinvestasi"]);
					}
			 		elseif ($op=='TOP'){
						 $tglkonf=substr($row["datenab"],-4).substr($row["datenab"],3,2).substr($row["datenab"],0,2);
						 $tglmulas= substr($PER->mulas,-4).substr($PER->mulas,3,2).substr($PER->mulas,0,2);

						 if ($tglkonf-$tglmulas < '20000'){
						 		if ($tglkonf=='20080404'||$tglkonf=='20080407'){
									  $fee=0;
								}						 						 						 
						 		else{
										$fee=2/100*$row["nilaiinvestasi"];
								}
						 }
						 else{
						 		$fee=0;
						 }						 
					}
			 		elseif ($op=='RED'){
						 $tglkonf=substr($row["datenab"],-4).substr($row["datenab"],3,2).substr($row["datenab"],0,2);
						 $tglmulas= substr($PER->mulas,-4).substr($PER->mulas,3,2).substr($PER->mulas,0,2);
						 			
						 if ($tglkonf-$tglmulas < '20000'){						 						 						 
						 		if ($tglkonf=='20080404'||$tglkonf=='20080407'){
									  $fee=0;
								}						 						 						 
						 		else{
										$fee=2/100*$row["redemption"];
								}
						 }
						 else{
						 		$fee=0;
						 }
					}
			 }
			 
       echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "dddddd").">";
       print( " <td class='verdana10blk' align=center>".$i."</td>\n" );
       print( " <td class='verdana10blk' align=center>".$row["tgl"]."</td>\n" );
       print( " <td class='verdana10blk' align=left><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".substr($row['refNo'],0,2)."&noper=".substr($row['refNo'], 2,9)."','',800,500,1)\">".substr($row['refNo'], 0,2)."-".substr($row['refNo'], 2,9)."</a></td>\n" );
       print( " <td class='verdana10blk' align=left>".$PER->namapemegangpolis."</td>\n" );
       print( " <td class='verdana10blk' align=left>".$PER->mulas."</td>\n" );
       print( " <td class='verdana10blk' align=left>".$PER->namaproduk."</td>\n" );

			 if ($op=='SUB'||$op=='TOP'){
  			 print( " <td class='verdana10blk' align=right>".number_format($fee+$row["nilaiinvestasi"],2,",",".")."</td>\n" );
         print( "	<td class='verdana10blk' align=right>".number_format($fee,2,",",".")."</td>\n" );
         print( " <td class='verdana10blk' align=right>".number_format($row["nilaiinvestasi"],2,",",".")."</td>\n" );
			 }			 
       print( " <td class='verdana10blk' align=right>".$row["datenab"]."</td>\n" );
       print( "	<td class='verdana10blk' align=right>".number_format($row["nilainab"],4,",",".")."</td>\n" );
       print( " <td class='verdana10blk' align=right>".number_format($row["jmlunit"],4,",",".")."</td>\n" );
			 if ($op=='RED'){
       	 print( "	<td class='verdana10blk' align=right>".number_format($row["redemption"],2,",",".")."</td>\n" );			 
         print( "	<td class='verdana10blk' align=right>".number_format($fee,2,",",".")."</td>\n" );
       	 print( "	<td class='verdana10blk' align=right>".number_format($row["redemption"]-$fee,2,",",".")."</td>\n" );			 
			 }
       print( " <td class='verdana10blk' align=left>(".$PER->noagen.") ".$PER->namaagen."</td>\n" );
			 if ($op=='SUB'){
       		print( "	<td class='verdana10blk' align=right>".number_format($komisi,2,",",".")."</td>\n" );
			 }
       print( " </tr>	" );

       $jmlinvestasi=$jmlinvestasi+$row["nilaiinvestasi"];
       $jmlunit=$jmlunit+$row["jmlunit"];
       $jmlgross=$jmlgross+$row["redemption"];
       $jmlfee=$jmlfee+$fee;
       $jmlkomisi=$jmlkomisi+$komisi;

       $i++;
		}

	}

  echo "<tr bgcolor=#BAD5F5>";
  if ($op=='SUB'||$op=='TOP'){
    print( " <td class='verdana10blk' colspan='6' align=center><b>T O T A L</b></td>\n" );
    print( "	<td class='verdana10blk' align=right><b>".number_format($jmlfee+$jmlinvestasi,2,",",".")."</b></td>\n" );
    print( "	<td class='verdana10blk' align=right><b>".number_format($jmlfee,2,",",".")."</b></td>\n" );
    print( " <td class='verdana10blk' align=right><b>".number_format($jmlinvestasi,2,",",".")."</b></td>\n" );
    print( " <td class='verdana10blk' align=right colspan='2'></td>\n" );
    print( " <td class='verdana10blk' align=right><b>".number_format($jmlunit,4,",",".")."</b></td>\n" );
  }
	elseif ($op=='RED'){
    print( " <td class='verdana10blk' colspan='8' align=center><b>T O T A L</b></td>\n" );
    print( " <td class='verdana10blk' align=right><b>".number_format($jmlunit,4,",",".")."</b></td>\n" );
    print( "	<td class='verdana10blk' align=right><b>".number_format($jmlgross,2,",",".")."</b></td>\n" );
    print( "	<td class='verdana10blk' align=right><b>".number_format($jmlfee,2,",",".")."</b></td>\n" );
    print( " <td class='verdana10blk' align=right><b>".number_format($jmlgross-$jmlfee,2,",",".")."</b></td>\n" );
    print( " <td class='verdana10blk' align=right colspan=2></td>\n " );
  }
  print( " <td class='verdana10blk' align=left></td>\n" );
  if ($op=='SUB'){
    print( "	<td class='verdana10blk' align=right><b>".number_format($jmlkomisi,2,",",".")."</b></td>\n" );
  }

  print( " </tr>	" );
  echo "<br>";		

?>
           </td>
           </tr>
          </table>
      		</td>
        </tr>
      </table>

 <br>
<? echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; ?>
</body>
</html>
