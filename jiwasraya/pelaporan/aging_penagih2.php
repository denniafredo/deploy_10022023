<?
  include "../../includes/session.php";
  include "../../includes/database.php";	

	$DB=new database($userid, $passwd, $DBName);
	$DA=new database($userid, $passwd, $DBName);

function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Bulan				
        print("<select name=" . $inName .  "bln>\n"); 
        for($currentMonth = 3; $currentMonth <= 12;$currentMonth=$currentMonth+3) 
        { 
            switch($currentMonth)
            {
              case '1' : $namabulan ="JANUARI"; break ;
              case '2' : $namabulan ="FEBRUARI"; break ;
              case '3' : $namabulan ="MARET"; break ;
              case '4' : $namabulan ="APRIL"; break ;
              case '5' : $namabulan ="MEI"; break ;
              case '6' : $namabulan ="JUNI"; break ;
              case '7' : $namabulan ="JULI"; break ;
              case '8' : $namabulan ="AGUSTUS"; break ;
              case '9' : $namabulan ="SEPTEMBER"; break ;
              case '10' : $namabulan ="OKTOBER"; break ;
              case '11' : $namabulan ="NOVEMBER"; break ;
              case '12' : $namabulan ="DESEMBER"; break ;
            }
						
            print("<option value=\"$currentMonth\""); 
            if(date( "n", $useDate)==$currentMonth) 
            { 
                print(" selected"); 
            } 					
            print(">$namabulan\n"); 						
        } 
        print("</select>"); 

// Tahun				
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
				//print ("<option value=ALL>*</option>");
        print("</select>"); 
} 

?>
	
  <html>
  <head>
  <title>Sisa Tagihan</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<style type="text/css">
  <!-- 
  body{
   font-family: tahoma,verdana,geneva,sans-serif;
   font-size: 12px;
  }
  
  td{
   font-family: tahoma,verdana,geneva,sans-serif;
   font-size: 11px;
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
  
  h4{
  padding: 0 0 5px 0;
  margin:0;
  }
  
  .jarak {
  clear:both;
  height:1px;
  }
  -->
  </style>

  </head>
	<body>
	<?
	$prefix = strtoupper($prefix);
	$userid = strtoupper($userid);
  	
	if($_POST['nadd'])
	{
		
		$sql = "select nopenagih,kdcarabayar from $DBUser.tabel_200_pertanggungan where ".
            "prefixpertanggungan='$prefix' and nopertanggungan='$noper' ";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
 		$arr=$DB->nextrow();
		
		$nopenagih = $arr["NOPENAGIH"];
		$kdcarabayar = $arr["KDCARABAYAR"];
		
		/*
		if($noptg!="")
		{
		*/
		$sql = "insert into $DBUser.tabel_300_historis_premi (".
				 	 				 "prefixpertanggungan,nopertanggungan,".
									 "tglbooked,tglseatled,tglbayar,".
									 "premitagihan,buktisetor,kdkuitansi,kdvaluta,".
									 "nilairp,kdrekeningpremi,kdrekeninglawan,status,".
									 "tglstatus,tglrekam,userrekam) ".
					 "values (".
									 "'$prefix','$noper',".
									 "to_date('$ntglbooked','DD/MM/YYYY'),to_date('$ntglseatled','DD/MM/YYYY'),to_date('$ntglbayar','DD/MM/YYYY'),".
									 "'$npremitagihan','$nbuktisetor','$nkdkwitansi','$nkdvaluta',".
									 "'$nnilairp','$nrekpremi','$nreklawan','$nstatus',".
									 "sysdate,sysdate,'$userid')";	
		//echo $sql."<br />";	 
		$DB->parse($sql);
    $DB->execute();			
		
		//insert bontagihan
		$sql = "insert into $DBUser.tabel_300_bontagihan (".
				 	 				 "page,prefixpertanggungan,nopertanggungan,".
									 "tglproses,tglbooked,tglseatled,".
									 "kdrekeningpremi,kdkuitansi,kdvaluta,kdrekeninglawan,".
									 "premitagihan,tglrekam,userrekam,".
									 "tglmigrate,nopenagih,kdcarabayar,nilairp) ".
						"values (".
									 "'1','$prefix','$noper',".			 
									 "to_date('$ntglbooked','DD/MM/YYYY'),to_date('$ntglbooked','DD/MM/YYYY'),to_date('$ntglseatled','DD/MM/YYYY'),".
									 "'$nrekpremi','".substr($nkdkwitansi,0,2)."','$nkdvaluta','$nreklawan',".
									 "'$npremitagihan',sysdate,'$userid',".
									 "sysdate,'$nopenagih','$kdcarabayar','$nnilairp')";
		//echo $sql;
		//die;
		$DB->parse($sql);
    $DB->execute();								 
		
		/*
		}
		else
		{
		  echo "Gagal... cek tanggal akhir premi!";
		}				 
		*/						 
	}
	
	if($delpelunasan)
	{
  	for ($c=0;$c<=$coun;$c++){
      if ($cb[$c]=='on'){
				$sqa = "begin $DBUser.del_pelunasanpremi('$prefix','$noper','003','".$tglbooked[$c]."','".$userid."');end;";
      	$DB->parse($sqa);
      	$DB->execute();
				
				$sql = "delete from $DBUser.tabel_800_pembayaran ".
						 	 "where prefixpertanggungan='$prefix' ".
							 "and nopertanggungan='$noper' and to_char(tglbooked,'DD/MM/YYYY')='".$tglbooked[$c]."'";
				//echo $sql;
				$DB->parse($sql);
      	$DB->execute();			 
  	  }
  	}
	}	
	
	if($updatestatus)
	{
	  for ($c=0;$c<=$coun;$c++){
      if ($cb[$c]=='on'){
				$sttupdate = ($statuscetak[$c]=="1") ? "0" : "1";
				$sqa = "update $DBUser.tabel_300_historis_premi set ".
						 	 "status='".$sttupdate."',tglstatus=sysdate,tglupdated=sysdate,userupdated='".$userid."' ".
							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 				"and to_char(tglbooked,'DD/MM/YYYY')='".$tglbooked[$c]."' ";
      	//echo $sqa;
      	$DB->parse($sqa);
      	$DB->execute();
				
				//$tglcetak = ($sttupdate==0) ? "null" : "sysdate";
				$sql = "select to_char(tglcetak,'dd/mm/yyyy') as tglcetak from kuitansi ".
						 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and ".
							 "to_char(tglbooked,'dd/mm/yyyy')='".$tglbooked[$c]."'";
				$CK->parse($sql);
      	$CK->execute();
				$arr=$CK->nextrow();
				$tglcetak = $arr["TGLCETAK"];
				
				$sql = "delete kuitansi ".
						 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 				"and to_char(tglbooked,'DD/MM/YYYY')='".$tglbooked[$c]."' ";
				$CK->parse($sql);
      	$CK->execute();
											
				$sql = "begin kuitansi_utility.transfer_kuitansi_satuan('$prefix','$noper','".substr($tglbooked[$c],3,8)."');end;";
				//echo $sql;
				$CK->parse($sql);
      	$CK->execute();
				
				$sql = "update kuitansi set to_date(tglcetak,'dd/mm/yyyy')='".$tglcetak."' ".
						 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and ".
							 "to_char(tglbooked,'dd/mm/yyyy')='".$tglbooked[$c]."'";
				$CK->parse($sql);
      	$CK->execute();
				
  	  }
  	}
	}
	
	if($delrow)
	{
	  for ($c=0;$c<=$coun;$c++){
      if ($cb[$c]=='on'){
				
			  $sqa = "delete $DBUser.tabel_300_bontagihan ".
						 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 "and to_char(tglbooked,'DD/MM/YYYY')='".$tglbooked[$c]."' ";
      	//echo $sqa;
      	$DB->parse($sqa);
      	$DB->execute();
			
				$sqa = "delete $DBUser.tabel_300_historis_premi ".
						 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 "and to_char(tglbooked,'DD/MM/YYYY')='".$tglbooked[$c]."' ";
      	//echo $sqa;
      	$DB->parse($sqa);
      	$DB->execute();
			
				$sql = "delete kuitansi ".
						 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 				"and to_char(tglbooked,'DD/MM/YYYY')='".$tglbooked[$c]."' ";
				$CK->parse($sql);
      	$CK->execute();
				
  	  }
  	}
	}
	
	if($simpan)
	{
	      $sqa = "update $DBUser.tabel_300_historis_premi set ".
    						 	 "status='".$ustatus."',tglstatus=sysdate,tglupdated=sysdate,userupdated='".$userid."',".
    							 "tglbooked=to_date('$utglbooked','DD/MM/YYYY'),tglseatled=to_date('$utglseatled','DD/MM/YYYY'),".
									 "tglbayar=to_date('$utglbayar','DD/MM/YYYY'),".
    							 "premitagihan='$upremitagihan',buktisetor='$ubuktisetor',kdkuitansi='$ukdkuitansi',kdvaluta='$nkdvaluta',".
									 "nilairp='$unilairp',kdrekeningpremi='$urekpremi',kdrekeninglawan='$ureklawan' ".
							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 				"and to_char(tglbooked,'DD/MM/YYYY')='".$tglbookedlama."' ";
      	//echo $sqa;
      	$DB->parse($sqa);
      	$DB->execute();
	}
	?>

  <h4>DAFTAR AGING PREMI PER PENAGIH</h4>
	<table>
	<form method="POST" name="cari" action="<?=$PHP_SELF;?>">
	<tr>  
	<td> 
	Penagih 
	</td>
	<td>
			<select name="nopenagih">
			<option value="">-- pilih --</option>
			<? 
			$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
			$sql	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
      			 	"from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
      	     	"where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$kantor."' ".
      				 $pskg." ".
							 //"and nvl(a.penagihautodebet,'0')='0' ".
      				 " order by b.namaklien1";
			$DB->parse($sql);
      $DB->execute();
			while ($ro=$DB->nextrow())
  		{
			  echo "<option ";
  			if ($nopenagih==$ro["NOPENAGIH"]){ echo " selected"; $namapenagih=$ro["NAMAKLIEN1"]; }
  			echo " value=".$ro["NOPENAGIH"].">".$ro["NAMAKLIEN1"]."</option>";
			}
			?>
			</select>		
	</td>
	<td>
	Periode 
	</td>
	<td>			 
			<? DateSelector("d"); ?>
	</td>
	<td>
	Kelompok Piutang Premi</td>
	<td>		
			<select name="kdpiutang">
			<option value="">-- pilih --</option>
			<option value="A">A - Kelompok Piutang <= 4 Bulan</option>
			<option value="B">B - Kelompok Piutang >4 Bulan</option>
			</select>
	</td>
	<td><input type="submit" name="cari" value="CARI">

<!--	<td class="verdana10blk"> 
	No.Pertanggungan <input type="text" name="prefix" size="2" maxlength="2" value="<?=$prefix;?>">-
	<input type="text" name="noper" size="12" maxlength="9" value="<?=$noper;?>">
	Tahun Booking <input type="text" name="vthn" size="4" maxlength="4" value="<?=$vthn;?>">
	S/D <input type="text" name="lthn" size="4" maxlength="4" value="<?=$lthn;?>">
	<input type="submit" name="caripoliskantor" value="CARI">
-->
<!--	<? 
	if(isset($noper))
	{
	  echo "<a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$prefix."&noper=".$noper."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">Cek polis</a>";
	}
	?>
-->
	</td>
  </tr>
	</table>
  <hr size="1">

  <b>
  	Nama Penagih 			: (<?=$nopenagih;?>) <?=$namapenagih;?> <br>
  	Periode Laporan 		: <?=substr("0".$dbln,-2)."/".$dthn; $periodelaporan=substr("0".$dbln,-2)."/".$dthn;?>	<br>
  	Kelompok Piutang Premi 	: (<?=$kdpiutang;?>) <?=($kdpiutang=="A"?"Kelompok Piutang <= 4 Bulan":"Kelompok Piutang > 4 Bulan");?> <br>
  </b>
	
	<table border="1" style="border-collapse: collapse" width="100%" bordercolor="#666666" width="100%" cellspacing="1" cellpadding="2">
		<tr bgcolor="#7dc2d9">
			<td rowspan="2" align="center">No.</td>
			<td rowspan="2" align="center">Jenis Kuitansi</td>
			<td rowspan="2" align="center">Kode Cabas</td>
			<td colspan="3" align="center">Valuta Asing (VA)</td>
			<td colspan="3" align="center">Valuta Rupiah Dengan Indeks (VRDI)</td>
			<td colspan="3" align="center">Valuta Rupiah Tanpa Indeks (VRTI)</td>
			<td rowspan="2" align="center">Action</td>
			<tr bgcolor="#7dc2d9">
				<td align="center">Polis</td>
				<td align="center">Kuitansi</td>
				<td align="center">Premi</td>
				<td align="center">Polis</td>
				<td align="center">Kuitansi</td>
				<td align="center">Premi</td>
				<td align="center">Polis</td>
				<td align="center">Kuitansi</td>
				<td align="center">Premi</td>
			</tr>
		</tr>				
	<?
	
	$sql="select nopenagih,namapenagih,periodelaporan,kelompokpiutang,jnskwitansi,cabas,polisva,kuitansiva,premiva,".
			 "polisrdi,kuitansirdi,premirdi,polisrti,kuitansirti,premirti from $DBUser.tabel_500_aging_penagih ".
		   "where nopenagih='$nopenagih' and periodelaporan='$periodelaporan' and kelompokpiutang='$kdpiutang'";

	echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$i=0;

	echo $arr["polisva"];

	while ($arr=$DB->nextrow()){
//	 if($_GET['tglbooked']==$arr["TGLBOOKED"])
//	 {
?>	 
	<tr bgcolor="#d9f1ff">
		<td><?=$i;?></td>
		<td align="center">
				<select name="kdkuitansi">
				<option value="">-- pilih --</option>
				<option value="NB">NB</option>
				<option value="OB">OB</option>
				</select>				
		</td>
		<td align="center">
				<select name="kdcabas">
				<option value="">-- pilih --</option>
				<option value="KEM">KEM</option>
				<option value="END">END</option>
				<option value="KE0">KE0</option>
				<option value="SH0">SH0</option>
				<option value="AN0">AN0</option>
				<option value="LL0">LL0</option>
				</select>				
		</td>
		<td><input type=text size=12 name=va_pol value=<?=$arr["polisva"];?>></td>
		<td><input type=text size=12 name=va_kuit value=<?=$arr["kuitansiva"];?>></td>
		<td><input type=text size=12 name=va_premi value=<?=$arr["premiva"];?>></td>
		<td><input type=text size=12 name=vrdi_pol value=<?=$arr["polisrdi"];?>></td>
		<td><input type=text size=12 name=vrdi_kuit value=<?=$arr["kuitansirdi"];?>></td>
		<td><input type=text size=12 name=vrdi_premi value=<?=$arr["premirdi"];?>></td>
		<td><input type=text size=12 name=vrti_pol value=<?=$arr["polisrti"];?>></td>
		<td><input type=text size=12 name=vrti_kuit value=<?=$arr["kuitansirti"];?>></td>
		<td><input type=text size=12 name=vrti_premi value=<?=$arr["premirti"];?>></td>
		<td><input type="submit" name="nadd" value="ADD"></td>
	</tr>
<?
/*
	 }
	 else
	 {
	 include "../../includes/belang.php";
   print( " <td align=center>".($i+1)."</td>\n" );
   print( " <td align=center>".$arr["TGLBOOKED"]."</td>\n" );
   print( " <td align=center>".$arr["TGLSEATLED"]."</td>\n" );
   print( " <td align=center>".$arr["TGLBAYAR"]."</td>\n" );
   print( " <td align=right>".number_format($arr["PREMITAGIHAN"],2)."</td>\n" );
   print( "	<td align=center>".$arr["KDMATAUANG"]."</td>\n" );
   print( " <td align=center>".$arr["KDKUITANSI"]."</td>\n" );
   print( "	<td align=center>".$arr["KDREKENINGPREMI"]."</td>\n" );
   print( "	<td align=center>".$arr["KDREKENINGLAWAN"]."</td>\n" );
   print( "	<td align=left>".$arr["BUKTISETOR"]."</td>\n" );
	 print( "	<td align=center>".$arr["NOBATCH"]."</td>\n" );
	 print( "	<td align=center>".$arr["USERREKAM"]."</td>\n" );
   print( "	<td align=center>".$arr["STATUS"]."</td>\n" );
	 print "  <td align=center>";
	               echo "<input type=\"checkbox\" name=cb[$i]>";
								 print( "<input type=\"hidden\" name=\"tglseatled[]\" value=".$arr["TGLSEATLED"].">" );
                 print( "<input type=\"hidden\" name=\"tglbooked[]\" value=".$arr["TGLBOOKED"].">" );
                 print( "<input type=\"hidden\" name=\"statuscetak[]\" value=".$arr["STATUS"].">" );
                 print( "<input type=\"hidden\" name=\"nilai[]\" value=".$arr["PREMITAGIHAN"].">" );
                 echo "<a href=?prefix=$prefix&noper=$noper&tglbooked=".$arr["TGLBOOKED"]."&vthn=$vthn&lthn=$lthn>Update</a>";
	 print "  </td>";
   print( " </tr>	" );
	 }
*/
   $i++;
	 $kdvaluta = $arr["KDVALUTA"];
	 $kdkuit 	 = $arr["KDKUITANSI"];
	 $rekpremi 	 = $arr["KDREKENINGPREMI"];
	 $reklawan 	 = $arr["KDREKENINGLAWAN"];
	 $premitagihan =  $arr["PREMITAGIHAN"];
	}
	print( "<input type=\"hidden\" name=\"coun\" value=".$i.">" );
	?>
	<tr bgcolor="#d9f1ff">
		<td><?=$i;?></td>
		<td align="center">
				<select name="kdkuitansi">
				<option value="">-- pilih --</option>
				<option value="NB">NB</option>
				<option value="OB">OB</option>
				</select>				
		</td>
		<td align="center">
				<select name="kdcabas">
				<option value="">-- pilih --</option>
				<option value="KEM">KEM</option>
				<option value="END">END</option>
				<option value="KE0">KE0</option>
				<option value="SH0">SH0</option>
				<option value="AN0">AN0</option>
				<option value="LL0">LL0</option>
				</select>				
		</td>
		<td><input type=text size=12 name=va_pol value=<?=$arr["polisva"];?>></td>
		<td><input type=text size=12 name=va_kuit value=<?=$arr["kuitansiva"];?>></td>
		<td><input type=text size=12 name=va_premi value=<?=$arr["premiva"];?>></td>
		<td><input type=text size=12 name=vrdi_pol value=<?=$arr["polisrdi"];?>></td>
		<td><input type=text size=12 name=vrdi_kuit value=<?=$arr["kuitansirdi"];?>></td>
		<td><input type=text size=12 name=vrdi_premi value=<?=$arr["premirdi"];?>></td>
		<td><input type=text size=12 name=vrti_pol value=<?=$arr["polisrti"];?>></td>
		<td><input type=text size=12 name=vrti_kuit value=<?=$arr["kuitansirti"];?>></td>
		<td><input type=text size=12 name=vrti_premi value=<?=$arr["premirti"];?>></td>
		<td><input type="submit" name="nadd" value="ADD"></td>
	</tr>
<!--
	<tr bgcolor="#d9f1ff">
  	<td></td>
		<td><input type="text" name="ntglbooked" size="12" maxlength="10"></td>
		<td><input type="text" name="ntglseatled" size="12" maxlength="10"></td>
		<td><input type="text" name="ntglbayar" size="12" maxlength="10"></td>
		<td align="right"><input type="text" name="npremitagihan" value="<?=$premitagihan;?>" size="10" maxlength="10"></td>
		<td align="center"><input type="text" name="nkdvaluta" value="<?=$kdvaluta;?>" size="2" maxlength="1"></td>
		<td align="center"><input type="text" name="nkdkwitansi" value="<?=$kdkuit;?>" size="4" maxlength="3"></td>
		<td align="center"><input type="text" name="nrekpremi" value="<?=$rekpremi;?>" size="8" maxlength="6"></td>
		<td align="center"><input type="text" name="nreklawan" value="<?=$reklawan;?>" size="8" maxlength="6"></td>
		<td><input type="text" name="nbuktisetor" size="20"></td>
		<td></td>
		<td></td>
		<td><input type="text" name="nstatus" size="2" maxlength="1"></td>
		<td><input type="submit" name="nadd" value="ADD"></td>
	</tr>
-->
	<tr bgcolor="#c1c1e1">
  	<td colspan="14" align="right">
  	  User Update <input type="text" name="userupd" value="<?=$userid;?>" size="10" maxlength="8"> 
  	  <input type="submit" name="updatestatus" value="UPDATE STATUS">
  		<input type="submit" name="delpelunasan" value="DELETE PELUNASAN">
			<input type="submit" name="delrow" value="DELETE ROW">
  	</td>
	</tr>
	</form>
</table>
<br />

</body>
</html>

