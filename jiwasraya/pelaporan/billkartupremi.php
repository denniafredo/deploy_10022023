<?
  include "../../includes/database.php";	
  include "../../includes/session.php";

	$DB=new database($userid, $passwd, $DBName);

   function DateSelector($inName, $useDate=0) 
   { 
		      if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
		      // make year selector 
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate); 
					
          for($currentYear = $startYear - 30; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
              if(date( "Y", $useDate)==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
          } 
					echo "<option value=ALL>SEMUA</option>";
          print("</select>"); 
    } 
	 
	 function YearSelector($inName, $useDate=0) 
   { 
		      if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
		      // make year selector 
          print("<select name=" . $inName .  "thn>\n"); 
          //$startYear = date( "Y", $useDate); 
					$startYear = date("Y"); 
					$startYear = $startYear+1;
					
          for($currentYear = $startYear - 30; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
              if(date( "Y", $useDate)==$currentYear) 
              //if($lthn==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
          } 
					echo "<option value=ALL>SEMUA</option>";
          print("</select>"); 
    } 

if(isset($_POST['bill'])){

	//$sql="begin $DBUser.POLIS.BILLINGRANGE ( '".$_POST['prefix']."', '".$_POST['noper']."', '".$_POST['dari']."', '".$_POST['sampai']."', '$userid' ); end;";
	
	$sql="begin $DBUser.P_BILL_RANGE_SATUAN ( '".$_POST['prefix']."', '".$_POST['noper']."', to_date('".$_POST['dari']."','ddmmyyyy'), to_date('".$_POST['sampai']."','ddmmyyyy'), '$userid' ); end;";
	$DB->parse($sql);
	$DB->execute();
	
	echo $sql;
}

if(isset($_POST['jurnal'])){

	
	$sql="begin $DBUser.GEN_JURNAL_LANJUTAN ( '".$_POST['prefix']."', '".$_POST['noper']."', to_date('".$_POST['dari']."','ddmmyyyy'), to_date('".$_POST['sampai']."','ddmmyyyy')); end;";
	$DB->parse($sql);
	$DB->execute();
	
	echo $sql;
}
?>
	
  <html>
  <head>
  <title>Kartu Premi</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
  </head>
	<body>
	<div align="center">
	<table width="100%">
	<form name="carihispremi" method="post" action="<? $PHP_SELF ?>">
	<tr bgcolor="#ccffcc">  
	<td class="verdana10blk">No. Polis <input size="2"type="text" name="prefix" value="<? echo $_POST['prefix']?>"><input value="<? echo $_POST['noper']?>" size="12" type="text" name="noper"> Tahun Booking <?  DateSelector("v"); ?>	
	S/D <?  YearSelector("l"); ?>
	<input type="submit" name="caripoliskantor" value="CARI">
	</td>
    </tr>
    <tr>
    <td class="verdana10blk">
    <fieldset class="verdana10blk"><legend>Billing</legend>
    <input type="text" size="10" value="ddmmyyyy" name="dari"> s/d <input type="text" size="10" value="ddmmyyyy" name="sampai">

    <input type="submit" name="bill" value="BILLING">&nbsp;&nbsp;

    <!-- <input type="submit" name="jurnal" value="JURNAL"> -->

    </fieldset>
    </td>
  </tr>
	</form>
	</table>
	<?
	$cthn = date('Y');
	if(!$vthn){
    $yearselect= "and to_char(a.tglbooked,'YYYY')='$cthn' ";
		$titlepage="Historis Pelunasan Premi Tahun $cthn";
		//$yearselect='';
		//$titlepage="Historis Pelunasan Premi Semua Tahun";
	} elseif($vthn=="ALL" || $lthn=="ALL"){
	  $yearselect='';
		$titlepage="Historis Pelunasan Premi Semua Tahun";
	} elseif($vthn > $lthn){
	  $yearselect= "and to_char(a.tglbooked,'YYYY') between '$lthn' and '$vthn' ";
	  $titlepage="Historis Pelunasan Premi Tahun $lthn S/D $vthn";
	} else {
	  $yearselect= "and to_char(a.tglbooked,'YYYY') between '$vthn' and '$lthn' ";
		$titlepage="Historis Pelunasan Premi Tahun $vthn S/D $lthn";
	}
	echo "<a class=verdana10blk><b>".$titlepage."</b></a>";
	?>
<table width="100%" class="tblborder" cellpadding="0" cellspacing="1">
 <tr>
 <td  class="tblhead">
  <table  class="tblisi" border="0" width="100%" cellpadding="0" cellspacing="1">
   <tr class=hijao>
    <td align=center>No</td>
  	<td align=center>Tanggal<br>Booked</td>
  	<td align=center>Tanggal<br>Settled</td>
  	<td align=center>Tanggal<br>Bayar</td>
  	<td align=center>Premi</td>
		<td align=center>Valuta</td>
  	<td align=center>Kode<br>Kwt</td>
		<td align=center>Rekening<br>Premi</td>
  	<td align=center>Rekening<br>Lawan</td>
		<td align=center>Bukti Setor</td>
		<td align=center>Batch</td>
		<td align=center>Kasir</td>
    <td align=center>S</td>
	</tr>
	<?

	$sql="select a.premitagihan, to_char(a.tglbooked,'DD/MM/YYYY') tglbooked, a.buktisetor,".
			 "a.kdrekeningpremi,a.kdrekeninglawan,a.status, to_char(a.tglbayar,'DD/MM/YYYY') tglbayar, ". 
			 "to_char(a.tglseatled,'DD/MM/YYYY') tglseatled, a.kdkuitansi, b.kdmatauang, ".
			 "c.indexawal,a.kdvaluta,".
			 "case when substr(a.buktisetor,1,2) = 'BS' then nvl((select MAX(kdbatch) from $DBUser.tabel_800_pembayaran where ".
			   "tglbooked=a.tglbooked and prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdpembayaran<>'100'),(select MAX(kdbatch) from $DBUser.tabel_800_pembayaran where ".
			   "prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and nomorbs = a.buktisetor)) else
                null
           end nobatch, ".
			 "case when substr(a.buktisetor,1,2) = 'BS' then nvl((select max(userrekam) from $DBUser.tabel_800_pembayaran where ".
			   "tglbooked=a.tglbooked and prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdpembayaran<>'100'),(select max(userrekam) from $DBUser.tabel_800_pembayaran where ".
			   "prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and nomorbs = a.buktisetor)) else
                null
           end userrekam ". //tambahan oleh dedi 22/02/2011 untuk filter selain pelunasan gadai
				
			 "from $DBUser.tabel_300_historis_premi a, $DBUser.tabel_304_valuta b, ".
			 			 "$DBUser.tabel_200_pertanggungan c ".
		   "where ".
			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
			 "and a.nopertanggungan='$noper' and a.prefixpertanggungan='$prefix' ".
			 "and a.kdvaluta=b.kdvaluta ".
			 $yearselect." ".
			 "order by a.tglbooked ";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	
	$i=1;
	while ($arr=$DB->nextrow()){
   include "../../includes/belang.php";
	 $premitagihan = $arr["KDVALUTA"]==0 ? $arr["PREMITAGIHAN"]/$arr["INDEXAWAL"] : $arr["PREMITAGIHAN"]; 
   print( " <td align=center class=arial8>".$i."</td>\n" );
   print( " <td align=center class=arial8>".$arr["TGLBOOKED"]."</td>\n" );
   print( " <td align=center class=arial8>".$arr["TGLSEATLED"]."</td>\n" );
   print( " <td align=center class=arial8>".$arr["TGLBAYAR"]."</td>\n" );
   print( " <td align=right class=arial8>".number_format($premitagihan,2)."</td>\n" );
   print( "	<td align=center class=arial8>".$arr["KDMATAUANG"]."</td>\n" );
   print( " <td align=center class=arial8>".$arr["KDKUITANSI"]."</td>\n" );
   print( "	<td align=center class=arial8>".$arr["KDREKENINGPREMI"]."</td>\n" );
   print( "	<td align=center class=arial8>".$arr["KDREKENINGLAWAN"]."</td>\n" );
   print( "	<td align=left class=arial8>".$arr["BUKTISETOR"]."</td>\n" );
	 print( "	<td align=center class=arial8>".$arr["NOBATCH"]."</td>\n" );
	 print( "	<td align=center class=arial8>".$arr["USERREKAM"]."</td>\n" );
   print( "	<td align=center class=arial8>".$arr["STATUS"]."</td>\n" ); 
   print( " </tr>	" );
   $i++;
	}
	?>
 </td>
 </tr>
</table>

 </td>
 </tr>
</table>
</div>
<a href="#" class="verdana10blk" onClick="window.open('cetakkartu.php?prefix=<?echo $prefix;?>&noper=<?echo $noper;?>&vthn=<?=$vthn;?>&lthn=<?=$lthn;?>')">Cetak</a>

</body>
</html>

