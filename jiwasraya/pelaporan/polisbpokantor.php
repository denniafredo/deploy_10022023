<?  
  include "../../includes/session.php"; 
  include "../../includes/database.php";  
	include "../../includes/common.php";
	include "../../includes/kantor.php";
	include "../../includes/fungsi.php";
	$DB=new Database($userid, $passwd, $DBName);	
	if(!isset($kdkantor)) {$kdkantor=$kantor;}
	$KTR = new Kantor($userid,$passwd,$kdkantor);	
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $month,$year;
    	 //MONTH
       echo "<select name=month>";
       $i=1;
       $CurrMonth=date("m");
       while ($i <= 12)
       {
  		 				switch($i)
  						{
  							  case 1: $namabulan = "JANUARI"; break;
  								case 2: $namabulan = "PEBRUARI"; break;
									case 3: $namabulan = "MARET"; break;
									case 4: $namabulan = "APRIL"; break;
									case 5: $namabulan = "MEI"; break;
									case 6: $namabulan = "JUNI"; break;
									case 7: $namabulan = "JULI"; break;
									case 8: $namabulan = "AGUSTUS"; break;
  								case 9: $namabulan = "SEPTEMBER"; break;
  								case 10: $namabulan = "OKTOBER"; break;
									case 11: $namabulan = "NOVEMBER"; break;
									case 12: $namabulan = "DESEMBER"; break;
  								default : $namabulan = $i;
  						}
  		 
        If(IsSet($month)) {
           If($month2 == $i || ($i == substr($month,1,1) && (substr($month,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulan";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan";
              }Else {
                 echo "<option value=$i>$namabulan";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan";
                }Else {
                   echo "<option value=$i selected>$namabulan";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan";
  							}Else {
                   echo "<option value=$i>$namabulan";
                }
              }
              $i++;
        }
    }
		$sel = $month=="ALL"? "selected" : "";
		echo "<option value=ALL ".$sel.">--ALL--</option>";
    echo "</select>";
  
	//YEAR
    echo "<select name=year>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $year) {
                 echo "<option selected> $i\n";
              }ElseIf ($i == $CurrYear && !IsSet($year)) {
                 echo "<option selected> $i\n";
              }Else {
                 echo "<option> $i\n";
              }
              $i++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
              $CurrYear++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
              $i++;
             }
         echo "</select>\n";
    }
  }
	?>
	<table cellpadding="1" cellspacing="2">
  <form action="<? $PHP_SELF; ?>" method="post" name="memreg">
   <tr>
<!--      <td align="left">Bulan </td>-->
			<td>
<?
			$sel1="";$sel2="";
			if($jenis=='proses'){$sel1="selected";}
			elseif($jenis=='jatuhtempo'){$sel2="selected";}
			else {$sel1="selected";}
?>
			<select name="jenis">
							<option value="proses" <?=$sel1;?>>PROSES EKSEKUSI BPO</option>
							<option value="jatuhtempo" <?=$sel2;?>>JATUH TEMPO BPO</option>
			</select>

  		&nbsp;BULAN
  		<? ShowFromDate(10,"Past"); ?> 
			<select name="kdkantor">
		  <?
		  $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' order by kdkantor";
		  $DB->parse($sqa);
			$DB->execute();					 
		  while ($arr=$DB->nextrow()) {
				echo "<option ";
				if($kdkantor==$arr["KDKANTOR"]) { echo "selected"; }
				echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
			}
			echo "<option>--ALL--</option>";
			?>		
			</td>
			</tr>
			<tr>
			<td>TERURUT BERDASARKAN
<?
			$sel3="";$sel4="";$sel5="";$sel6="";$sel7="";
			if($urut=='nopol'){$sel3="selected";}
			elseif($urut=='bayarterakhir'){$sel4="selected";}
			elseif($urut=='mulas'){$sel5="selected";}
			elseif($urut=='tglbpo'){$sel6="selected";}
			elseif($urut=='tglproses'){$sel7="selected";}
			elseif($urut=='namaagen'){$sel8="selected";}
			else {$sel3="selected";}
?>
			<select name="urut">
							<option value="nopol" <?=$sel3;?>>NOMOR POLIS</option>
							<option value="bayarterakhir" <?=$sel4;?>>TGL BAYAR TERAKHIR</option>
							<option value="mulas" <?=$sel5;?>>TGL MULAI ASURANSI</option>
							<option value="tglbpo" <?=$sel6;?>>TGL BPO BY SYSTEM</option>
							<option value="tglproses" <?=$sel7;?>>TGL PROSES BPO</option>
							<option value="namaagen" <?=$sel8;?>>NAMA AGEN</option>
			</select>

  		<input name="cari" value="GO" type="submit">
  		</td>
  	</tr> 
  	</form>
  </table>
	<?
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<hr size=1>";

	echo "<div align=center>";
	        
					if(!isset($month)) { $month = date('m'); $year  = date('Y');}
					
					if($month=="ALL")
					{
					  $filter = "  "; 
						//$filter = " and to_char(a.tglbpo,'YYYY')='$year' "; 
					}
					else {
					  
						if ($jenis=="jatuhtempo"){ 
					  	 $filter = " and to_char(a.tglbpo,'YYYYMM')='$year$month' ";
						}
						else{
							 $filter = " and to_char(e.tglmutasi,'YYYYMM')='$year$month' ";
						} 

						if ($urut=="nopol"){$urut = "a.prefixpertanggungan,a.nopertanggungan";}
						elseif ($urut=="bayarterakhir"){$urut = "to_char(a.tgllastpayment,'YYYYMMDD')";}
						elseif ($urut=="mulas"){$urut = "to_char(a.mulas,'YYYYMMDD')";}
						elseif ($urut=="tglbpo"){$urut = "to_char(a.tglbpo,'YYYYMMDD')";}
						elseif ($urut=="tglproses"){$urut = "to_char(e.tglmutasi,'YYYYMMDD')";}
						elseif ($urut=="namaagen"){$urut = "agenpenutup";}
						
					}
				
				if($kdkantor<>'--ALL--'){
					$filter_kantor = " and c.kdrayonpenagih='$kdkantor' ";	
				}	
				
				  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
						     "a.kdstatusmedical,to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
							 "to_char(a.tglbpo,'DD/MM/YYYY') tglbpo,b.namaklien1,b.gelar,".
							 "b.alamattetap01 || ' ' || b.alamattetap02 || ' ' || f.namakotamadya || ' ' || g.namapropinsi as alamat,".
							 "a.userupdated,a.nopenagih,
							 (select to_char(max(tglbooked),'DD/MM/YYYY') 
							  from $DBUser.tabel_300_historis_premi 
							  where prefixpertanggungan=a.prefixpertanggungan
							  and nopertanggungan=a.nopertanggungan 
							  and tglseatled is not null) lastpayment, ".
							 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
							 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) agenpenutup,".
							 "(select no_ponsel from $DBUser.tabel_100_klien where noklien=a.noagen) tlpagenpenutup, ".
							 "to_char(a.mulas,'DD/MM/YYYY') mulas,to_char(MAX(e.tglmutasi),'DD/MM/YYYY') tglproses,d.namacarabayar ".
						 "from ".
						 "$DBUser.tabel_100_klien b,".
						 "$DBUser.tabel_200_pertanggungan a, ".
						 "$DBUser.tabel_500_penagih c,".
						 "$DBUser.polis_history_status e,".
						 "$DBUser.tabel_305_cara_bayar d, ".
						 "$DBUser.tabel_109_kotamadya f, ".
						 "$DBUser.tabel_108_propinsi g ".
						 "where a.notertanggung=b.noklien(+) and a.nopenagih=c.nopenagih ".
						     "and e.prefixpertanggungan=a.prefixpertanggungan ". 
							 "and e.nopertanggungan=a.nopertanggungan ".
							 "and a.kdcarabayar=d.kdcarabayar(+) ".
							 "AND b.kdkotamadyatetap = f.kdkotamadya(+) ".
							 "AND b.kdpropinsitetap = g.kdpropinsi(+) ".
							 /*"and c.kdrayonpenagih='$kdkantor' and a.kdpertanggungan='2' ".*/
							 " and a.kdpertanggungan='2' ".
							 $filter_kantor.
							 "and notertanggung is not null and a.kdstatusfile='4' ".
							 $filter.
						 "GROUP BY a.prefixpertanggungan, a.nopertanggungan, a.kdproduk, a.kdstatusmedical, ".
						 "a.expirasi, a.tglbpo, b.namaklien1, b.gelar, b.alamattetap01, b.alamattetap02, ".
						 "f.namakotamadya,g.namapropinsi, a.userupdated, a.nopenagih, a.tgllastpayment, ".
						 "a.premi1, a.noagen,a.juamainproduk, a.tglupdated, a.mulas, d.namacarabayar, nopol ".
						 "order by ".$urut.",a.prefixpertanggungan,a.nopertanggungan";
					//echo $sql."<br><br>";			 
					$DB->parse($sql);
					$DB->execute();
					?>
					<H3>DAFTAR POLIS BEBAS PREMI OTOMATIS (BPO)<br />
					<?=$KTR->namakantor;?><br />
					Bulan : <?=namaBulan($month);?> <?=$year;?>
					</H3>
					<?
						  echo "<table width=100%>";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center height=20><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Alamat</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Jml. Premi</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Bayar Terakhir</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Nama Agen</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Telp. Agen</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Penagih</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl. Jatuh Tempo BPO By System</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl. Proses BPO</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($sendemail)
							{
							 case "": $sendemail="<font color=red>BELUM</font>"; break;
							 default : $sendemail; break; 
							}
							
							include "../../includes/belang.php";	 
	            echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">$arr[ALAMAT]</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arr["PREMI1"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["LASTPAYMENT"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["AGENPENUTUP"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TLPAGENPENUTUP"]."</font></td>");
              echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOPENAGIH"]."</font></td>");
              echo("<td><font face=\"Verdana\" size=\"1\">".$arr["TGLBPO"]."</font></td>");
              echo("<td><font face=\"Verdana\" size=\"1\">".$arr["TGLPROSES"]."</font></td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
     
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>