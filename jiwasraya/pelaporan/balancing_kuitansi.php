<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DA = new Database($userid, $passwd, $DBName);
  $DB = new Database($userid, $passwd, $DBName);
  $CK = new Database($suid_CKINDO,$spass_CKINDO,$sdb_CKINDO);
	
	
	?>
	<style type="text/css">
<!-- 
td {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>


	<?
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=verdana10blu><b>BALANCING BILLING BOOKING DAN CETAK KUITANSI</b></a>";
	echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Bulan				
        print("<select name=" . $inName .  "bln>\n"); 
//				print ("<option value=0>------</option>");
        for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
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

echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Periode Booking (TGLBOOKED) </td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "    </tr>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Kantor Penagihan</td>";
echo "      <td class=\"verdana9blk\" colspan=5>";
echo "          <select name=ktr>";
echo "								<option value=\"all\" selected>-- SEMUA KANTOR --</option>";
              	$sqa = "select k.kdkantor,k.namakantor ".
              	       "from $DBUser.tabel_001_kantor k ".
              				 "order by k.kdkantor";
          		  $DB->parse($sqa);
          			$DB->execute();					 
          		  while ($art=$DB->nextrow()) {
echo "								<option value='".$art["KDKANTOR"]."'>".$art["KDKANTOR"]." - ".$art["NAMAKANTOR"]."</option>";
          			}
echo "          </select>";
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";

#--------------------------------------------------- end navigasi --------------
if($cari){

			 if ($ktr!='all'){
        	$sqa = "select k.kdkantor,k.namakantor ".
        	       "from $DBUser.tabel_001_kantor k ".
								 "where k.kdkantor='".$ktr."' ".
        				 "order by k.kdkantor";
    		  $DB->parse($sqa);
    			$DB->execute();					 
    		  while ($arr=$DB->nextrow()) {
								$namakantor=$arr["NAMAKANTOR"];
    			}					
			 		$wherektr=" where k.kdkantor='".$ktr."' ";
  		 }
			 else{
			 		$wherektr="";
					
					$namakantor="SELURUH KANTOR IFG LIFE";
			 }

			$tglDari=substr('00'.$dbln,-2)."/".$dthn;

      echo "REKAPITULASI BILLING BOOKING DAN CETAK KUITANSI<br>";
      echo $namakantor."<br>";					
      echo "PERIODE BOOKING (TGLBOOKED) ".$tglDari."<br><br>";					

?>

 <table border="1" style="border-collapse: collapse" id="table1" cellpadding="5">
 <tr>
  <td bgcolor="#3300ff" align="center" rowspan="3"><font color="#FFFFFF">No</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="3"><font color="#FFFFFF">Kantor</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="3"><font color="#FFFFFF">Valuta</font></td>
  <td bgcolor="#3300ff" align="center" colspan="6"><font color="#FFFFFF">JL-iNdO</font></td>
  <td bgcolor="#3300ff" align="center" colspan="6"><font color="#FFFFFF">CK-iNdO</font></td>
 </tr>
 <tr>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Kuitansi Belum Dicetak (Status 0)</font></td>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Kuitansi Sudah Dicetak (Status 1)</font></td>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Total</font></td> 
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Kuitansi Belum Dicetak (Status 0)</font></td>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Kuitansi Sudah Dicetak (Status 1)</font></td>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Total</font></td> 
 </tr>
 <tr>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Kuitansi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Premi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Kuitansi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Premi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Kuitansi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Premi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Kuitansi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Premi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Kuitansi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Premi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Kuitansi</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Premi</font></td>
 </tr> 
<?
// Ambil Kantor
$sqa = "select k.kdkantor,k.namakantor ".
       "from $DBUser.tabel_001_kantor k ".
			 $wherektr.
		 	 "order by k.kdkantor";
//echo $sqa;
$DB->parse($sqa);
$DB->execute();

$tot_val0_kuit=0;
$tot_val1_kuit=0;
$tot_val3_kuit=0;

$tot_val0_premi=0;
$tot_val1_premi=0;
$tot_val3_premi=0;

$i=1;

while($ark=$DB->nextrow()){
			 
    // Ambil Hasil Billing Booking JL-iNdO
    $sqj =  "SELECT ". 
            "	  ryn.kdrayonpenagih, ".
            "	  hpl.status, ". 
            "	  ptg.kdvaluta, ".
            "	  (SELECT namavaluta FROM $DBUser.tabel_304_valuta val WHERE val.kdvaluta=ptg.kdvaluta) namavaluta, ".	  	  
            "	  count(ptg.nopertanggungan) as jmlkuitansi, ".	  
            "	  sum(hpl.premitagihan) as jmlpremitagihan ".	  
            "FROM $DBUser.tabel_200_pertanggungan ptg, $DBUser.tabel_500_penagih ryn, $DBUser.tabel_300_historis_premi hpl ". 
            "WHERE ". 
            "	  ryn.nopenagih=ptg.nopenagih ".
            "	  AND ryn.kdrayonpenagih = '".$ark["KDKANTOR"]."' ".
            "	  AND ptg.kdpertanggungan = '2' ".
            "	  AND hpl.prefixpertanggungan=ptg.prefixpertanggungan ". 
            "	  AND hpl.nopertanggungan=ptg.nopertanggungan ".
            "	  AND hpl.status in ('0','1') ".
            "	  AND to_char(hpl.tglbooked,'MM/YYYY')='".$tglDari."' ".
            "GROUP BY ".
            "	  ryn.kdrayonpenagih, ".
            "	  hpl.status, ".
            "	  ptg.kdvaluta";	  
//    echo $sqj;
    $DA->parse($sqj);
    $DA->execute();
    
    $st0_val0_nama="RUPIAH DENGAN INDEKS";
    $st0_val0_kuit=0;
    $st0_val0_premi=0;

    $st0_val1_nama="RUPIAH TANPA INDEKS";
    $st0_val1_kuit=0;
    $st0_val1_premi=0;

    $st0_val3_nama="DOLLAR AMERIKA SERIKAT";
    $st0_val3_kuit=0;
    $st0_val3_premi=0;			

    $st1_val0_nama="RUPIAH DENGAN INDEKS";
    $st1_val0_kuit=0;
    $st1_val0_premi=0;

    $st1_val1_nama="RUPIAH TANPA INDEKS";
    $st1_val1_kuit=0;
    $st1_val1_premi=0;

    $st1_val3_nama="DOLLAR AMERIKA SERIKAT";
    $st1_val3_kuit=0;
    $st1_val3_premi=0;			
		
    while($ary=$DA->nextrow()){
			 if ($ary["STATUS"]=="0"&&$ary["KDVALUTA"]=="0"){
//    	    $st0_val0_nama="RUPIAH DENGAN INDEKS";
    	    $st0_val0_kuit=$ary["JMLKUITANSI"];
    	    $st0_val0_premi=$ary["JMLPREMITAGIHAN"];
    	 }
    	 if ($ary["STATUS"]=="0"&&$ary["KDVALUTA"]=="1"){
//    	    $st0_val1_nama="RUPIAH TANPA INDEKS";
    	    $st0_val1_kuit=$ary["JMLKUITANSI"];
    	    $st0_val1_premi=$ary["JMLPREMITAGIHAN"];
    	 }
    	 if ($ary["STATUS"]=="0"&&$ary["KDVALUTA"]=="3"){
//    	    $st0_val3_nama="DOLLAR AMERIKA SERIKAT";
    	    $st0_val3_kuit=$ary["JMLKUITANSI"];
    	    $st0_val3_premi=$ary["JMLPREMITAGIHAN"];			
    	 }
    	 if ($ary["STATUS"]=="1"&&$ary["KDVALUTA"]=="0"){
//    	    $st1_val0_nama="RUPIAH DENGAN INDEKS";
    	    $st1_val0_kuit=$ary["JMLKUITANSI"];
    	    $st1_val0_premi=$ary["JMLPREMITAGIHAN"];
    	 }
    	 if ($ary["STATUS"]=="1"&&$ary["KDVALUTA"]=="1"){
//    	    $st1_val1_nama="RUPIAH TANPA INDEKS";
    	    $st1_val1_kuit=$ary["JMLKUITANSI"];
    	    $st1_val1_premi=$ary["JMLPREMITAGIHAN"];
    	 }
    	 if ($ary["STATUS"]=="1"&&$ary["KDVALUTA"]=="3"){
//    	    $st1_val3_nama="DOLLAR AMERIKA SERIKAT";
    	    $st1_val3_kuit=$ary["JMLKUITANSI"];
    	    $st1_val3_premi=$ary["JMLPREMITAGIHAN"];			
    	 }

		}    

    // Ambil Hasil Billing Booking CK-iNdO
    $sqa =  "SELECT ". 
            "	  kdrayonpenagih, ".
            "	  status, ". 
            "	  kdvaluta, ".
            "	  namavaluta, ".	  	  
            "	  count(nopertanggungan) as jmlkuitansi, ".	  
            "	  sum(premitagihan) as jmlpremitagihan ".	  
            "FROM ckadm.kuitansi ". 
            "WHERE ". 
            "	  kdrayonpenagih = '".$ark["KDKANTOR"]."' ".
            "	  AND status in ('0','1') ".
            "	  AND autodebet='0' ".
            "	  AND to_char(tglbooked,'MM/YYYY')='".$tglDari."' ".
            "GROUP BY ".
            "	  kdrayonpenagih, ".
            "	  status, ". 
            "	  kdvaluta, ".
            "	  namavaluta";	  	  
//    echo $sqa;
    $CK->parse($sqa);
    $CK->execute();
    
//    $st0_val0_nama_ck="";
    $st0_val0_kuit_ck=0;
    $st0_val0_premi_ck=0;

//    $st0_val1_nama_ck="";
    $st0_val1_kuit_ck=0;
    $st0_val1_premi_ck=0;

//    $st0_val3_nama_ck="";
    $st0_val3_kuit_ck=0;
    $st0_val3_premi_ck=0;			

//		$st1_val0_nama_ck="";
    $st1_val0_kuit_ck=0;
    $st1_val0_premi_ck=0;

//    $st1_val1_nama_ck="";
    $st1_val1_kuit_ck=0;
    $st1_val1_premi_ck=0;

//    $st1_val3_nama_ck="";
    $st1_val3_kuit_ck=0;
    $st1_val3_premi_ck=0;			

    while($arr=$CK->nextrow()){
    	 if ($arr["STATUS"]=="0"&&$arr["KDVALUTA"]=="0"){
//    	    $st0_val0_nama_ck=$arr["NAMAVALUTA"];
    	    $st0_val0_kuit_ck=$arr["JMLKUITANSI"];
    	    $st0_val0_premi_ck=$arr["JMLPREMITAGIHAN"];
    	 }
    	 if ($arr["STATUS"]=="0"&&$arr["KDVALUTA"]=="1"){
//    	    $st0_val1_nama_ck=$arr["NAMAVALUTA"];
    	    $st0_val1_kuit_ck=$arr["JMLKUITANSI"];
    	    $st0_val1_premi_ck=$arr["JMLPREMITAGIHAN"];
    	 }
    	 if ($arr["STATUS"]=="0"&&$arr["KDVALUTA"]=="3"){
//    	    $st0_val3_nama_ck=$arr["NAMAVALUTA"];
    	    $st0_val3_kuit_ck=$arr["JMLKUITANSI"];
    	    $st0_val3_premi_ck=$arr["JMLPREMITAGIHAN"];			
    	 }
    	 if ($arr["STATUS"]=="1"&&$arr["KDVALUTA"]=="0"){
//    	    $st1_val0_nama_ck=$arr["NAMAVALUTA"];
    	    $st1_val0_kuit_ck=$arr["JMLKUITANSI"];
    	    $st1_val0_premi_ck=$arr["JMLPREMITAGIHAN"];
    	 }
    	 if ($arr["STATUS"]=="1"&&$arr["KDVALUTA"]=="1"){
//    	    $st1_val1_nama_ck=$arr["NAMAVALUTA"];
    	    $st1_val1_kuit_ck=$arr["JMLKUITANSI"];
    	    $st1_val1_premi_ck=$arr["JMLPREMITAGIHAN"];
    	 }
    	 if ($arr["STATUS"]=="1"&&$arr["KDVALUTA"]=="3"){
//    	    $st1_val3_nama_ck=$arr["NAMAVALUTA"];
    	    $st1_val3_kuit_ck=$arr["JMLKUITANSI"];
    	    $st1_val3_premi_ck=$arr["JMLPREMITAGIHAN"];			
    	 }

		}    

		if ($i%2){
			 $bg="#ccffff";
			 $bgf="#0000cc";		
		}
		else{
			 $bg="#ffff99";		
			 $bgf="#000000";		
		}
?>
     <tr bgcolor="#ffffcc">
      <td bgcolor=<?=$bg;?> align="right" rowspan="3"><font color=<?=$bgf;?>><?=$i;?></font></td>
      <td bgcolor=<?=$bg;?> align="left" rowspan="3"><font color=<?=$bgf;?>>(<?=$ark["KDKANTOR"].")<br>".$ark["NAMAKANTOR"];?></font></td>
      <td bgcolor=<?=$bg;?> align="center"><font color=<?=$bgf;?>><?=$st0_val0_nama;?></font></td> 

      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_premi,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val0_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val0_premi,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_kuit+$st1_val0_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_premi+$st1_val0_premi,2,",",".");?></font></td>

      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_premi_ck,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val0_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val0_premi_ck,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_kuit_ck+$st1_val0_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val0_premi_ck+$st1_val0_premi_ck,2,",",".");?></font></td>
     </tr>  

     <tr bgcolor="#ffffcc">
      <td bgcolor=<?=$bg;?> align="center"><font color=<?=$bgf;?>><?=$st0_val1_nama;?></font></td> 

      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_premi,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val1_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val1_premi,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_kuit+$st1_val1_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_premi+$st1_val1_premi,2,",",".");?></font></td>

      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_premi_ck,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val1_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val1_premi_ck,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_kuit_ck+$st1_val1_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val1_premi_ck+$st1_val1_premi_ck,2,",",".");?></font></td>
     </tr>  

     <tr bgcolor="#ffffcc">
      <td bgcolor=<?=$bg;?> align="center"><font color=<?=$bgf;?>><?=$st0_val3_nama;?></font></td> 

      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_premi,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val3_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val3_premi,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_kuit+$st1_val3_kuit,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_premi+$st1_val3_premi,2,",",".");?></font></td>

      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_premi_ck,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val3_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st1_val3_premi_ck,2,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_kuit_ck+$st1_val3_kuit_ck,0,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($st0_val3_premi_ck+$st1_val3_premi_ck,2,",",".");?></font></td>
     </tr>  
		 
<?
	$i=$i+1;
}
?>
	
</table>
<br />
<hr size="1">
<?
}
?>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
  include "../../includes/endtimer.php"; 
?>