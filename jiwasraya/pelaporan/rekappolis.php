<?
  include "../../includes/session.php";
  include "../../includes/starttimer.php";
  include "../../includes/database.php";
	include "../../includes/common.php";

  $DB = new Database($userid, $passwd, $DBName);
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=verdana10blu><b>REKAPITULASI MACAM ASURANSI PERTANGGUNGAN PERORANGAN</b></a>";
	echo "<hr size=1>";

	if(!isset($kdkantor))
	{
	    $kdkantor = $kantor;
	    $filter = "y.kdrayonpenagih='$kdkantor' and ";
			$judul  = "KANTOR $kdkantor";

	}
	else
	{
	  if($kdkantor=="all")
		{
		  $filter = "";
			$judul  = "SEMUA KANTOR";
		}
		else
		{
		  $filter = "y.kdrayonpenagih='$kdkantor' and ";
			$judul  = "KANTOR $kdkantor";
		}
	}

	if(!isset($kdstatus))
	{
	    $filterstatus = "and x.kdstatusfile='1' ";
			$judulstatus = "POLIS AKTIF";
	}
	else {
	    if($kdstatus=="1")
			{
			  $filterstatus = "and x.kdstatusfile='1' ";
				$judulstatus = "POLIS AKTIF";
			} elseif($kdstatus=="a"){
			  $filterstatus = "and x.kdstatusfile<>'1' and x.kdstatusfile<>'4' ";
				$judulstatus = "POLIS NON AKTIF";
			}
			//Tambahan Oleh Dedi 5/2/2010
			elseif($kdstatus=="bpo")
			{
			 $filterstatus = " and x.kdstatusfile='4' ";
			  $judulstatus = "POLIS BPO";
			}
			//End of tambahan oleh dedi 5/2/2010
			else {
			  $filterstatus = "";
				$judulstatus = "SEMUA POLIS";
			}

	}

	if(!isset($kdcarabayar))
	{
	    $filterkdcarabayar = " ";
			$judulstatus = "POLIS AKTIF";
	}
	else {
	    if($kdcarabayar=="B")
			{
			  $filterkdcarabayar = "and x.kdcarabayar not in ('X','E','J') ";
				$judulstatus = "POLIS AKTIF";
			} elseif($kdcarabayar=="X"){
			  $filterkdcarabayar = "and x.kdcarabayar in ('X','E','J') ";
				$judulstatus = "POLIS NON AKTIF";
			}
			else {
			  $filterstatus = "";
				$judulstatus = "SEMUA POLIS";
			}

	}
#---------------------------------------------- start navigasi -----------------
function DateSelector($inName, $useDate=0)
{
        if($useDate == 0)
        {
            $useDate = Time();
        }
        print("<select name=" . $inName .  "thn>\n");
        $startYear = date( "Y", $useDate);
        for($currentYear = $startYear - 5; $currentYear <= $startYear+0;$currentYear++)
        {
            print("<option value=\"$currentYear\"");
            if(date( "Y", $useDate)==$currentYear)
            {
                print(" selected");
            }
            print(">$currentYear\n");

        }
				print ("<option value=ALL>*</option>");
        print("</select>");
}
echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Masa Produksi</td>";
echo "      <td>";
echo "          <select size=1 name=masa>";
//echo "               <option value=\"pilih\">-- P I L I H --</option>";
echo "               <option value=\"thn1\">1 Tahun</option>";
echo "               <option value=\"kwt1\">Triwulan 1</option>";
echo "               <option value=\"kwt2\">Triwulan 2</option>";
echo "               <option value=\"kwt3\">Triwulan 3</option>";
echo "               <option value=\"kwt4\">Triwulan 4</option>";
echo "               <option value=\"smt1\">Semester 1</option>";
echo "               <option value=\"smt2\">Semester 2</option>";
                     $i=1;
                       while ($i <= 12)
                  		 {
                  		    switch($i)
                          {
                            case '1' : $namabulan = "Januari"; break;
                          	case '2' : $namabulan = "Februari"; break;
                          	case '3' : $namabulan = "Maret"; break;
                          	case '4' : $namabulan = "April"; break;
                          	case '5' : $namabulan = "Mei"; break;
                          	case '6' : $namabulan = "Juni"; break;
                          	case '7' : $namabulan = "Juli"; break;
                          	case '8' : $namabulan = "Agustus"; break;
                          	case '9' : $namabulan = "September"; break;
                          	case '10' : $namabulan = "Oktober"; break;
                          	case '11' : $namabulan = "November"; break;
                          	case '12' : $namabulan = "Desember"; break;
                          	default  : $namabulan = "tidak didefinisikan";
                          }
                  				echo "<option ";
                  				if($masa=="m$i"){ echo "selected";}
                  			  echo " value=m$i>$namabulan</option>";
                  				$i++;
                  		 }
echo "          </select>";
echo "      </td>";
echo "      <td class=\"verdana9blk\">Th.Mulas ";
               DateSelector("v");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
echo "         <select size=1 name=kdkantor>";
echo "				 <option value=all>SEMUA KANTOR</option>";
               $sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' order by kdkantor";
							 $DB->parse($sql);
							 $DB->execute();
							 while($ro=$DB->nextrow()){
							       echo "<option ";
    								 if ($ro["KDKANTOR"]==$kdkantor){ echo " selected"; }
    								 echo " value=".$ro["KDKANTOR"].">".$ro["KDKANTOR"]." - ".$ro["NAMAKANTOR"]."</option>";
							 }

echo "         </select>";
echo "      </td>";

switch ($kdstatus)
{
  case "1" : $s1 = "selected"; break;
	case "a" : $s2 = "selected"; break;
	case "all" : $s3 = "selected"; break;

//ditambah oleh dedi 5/2/2010
	case "bpo" : $s4 = "selected"; break;
//End of tambahan oleh dedi

	default : $s1 = "selected";
}
echo "      <td class=\"verdana9blk\">Status ";
echo "         <select size=1 name=kdstatus>";
echo "				 <option value=1 $s1>AKTIF</option>";
echo "				 <option value=a $s2>NON AKTIF</option>";
echo "				 <option value=all $s3>ALL</option>";

//ditambah oleh dedi 5/2/2010
echo "				 <option value=bpo $s4>BPO</option>";
//End of tambahan oleh dedi


echo "				 </select>";
echo "      </td>";

// tambahan cara bayar
switch ($kdcarabayar)
{
  case "B" : $c1 = "selected"; break;
	case "X" : $c2 = "selected"; break;
	case "all" : $c3 = "selected"; break;

	default : $c3 = "selected";
}
echo "      <td class=\"verdana9blk\">Cara Bayar ";
echo "         <select size=1 name=kdcarabayar>";
echo "				 <option value=B $c1>BERKALA</option>";
echo "				 <option value=X $c2>SEKALIGUS</option>";
echo "				 <option value=all $c3>ALL</option>";
echo "				 </select>";
echo "      </td>";
// end of tambahan cara bayar

echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------
if($masa=="pilih"){
  echo "<font color=red>Pilih Masa Produksi..</font><br><br>";
} else if($cari){

	$kdvaluta = array(0=>'0','1','3');
	$namavaluta = array(0=>'RUPIAH IDX','RUPIAH','DOLLAR AS');

	switch($masa){
		  case "kwt1" : $blnstart="01"; $blnend="03"; $blntitlestart="JANUARI"; $blntitleend="MARET"; break;
			case "kwt2" : $blnstart="04"; $blnend="06"; $blntitlestart="APRIL"; $blntitleend="JUNI"; break;
			case "kwt3" : $blnstart="07"; $blnend="09"; $blntitlestart="JULI"; $blntitleend="SEPTEMBER"; break;
			case "kwt4" : $blnstart="10"; $blnend="12"; $blntitlestart="OKTOBER"; $blntitleend="DESEMBER"; break;
			case "smt1" : $blnstart="01"; $blnend="06"; $blntitlestart="JANUARI"; $blntitleend="JUNI"; break;
			case "smt2" : $blnstart="07"; $blnend="12"; $blntitlestart="JULI"; $blntitleend="DESEMBER"; break;
			case "thn1" : $blnstart="01"; $blnend="12"; $blntitlestart="JANUARI"; $blntitleend="DESEMBER"; break;
	}

  echo "<div align=center>";

	if($vthn=="ALL"){
	  $periode="";
	  echo "<a class=verdana10blu><b>PRODUKSI SEMUA POLIS $judul</b></a><br><br>";
	}
	elseif(substr($masa,0,1)=="m")
	{

	  $blnx = substr($masa,1,2);
		switch($blnx)
    {
                            case '1' : $namabulan = "Januari"; break;
                          	case '2' : $namabulan = "Februari"; break;
                          	case '3' : $namabulan = "Maret"; break;
                          	case '4' : $namabulan = "April"; break;
                          	case '5' : $namabulan = "Mei"; break;
                          	case '6' : $namabulan = "Juni"; break;
                          	case '7' : $namabulan = "Juli"; break;
                          	case '8' : $namabulan = "Agustus"; break;
                          	case '9' : $namabulan = "September"; break;
                          	case '10' : $namabulan = "Oktober"; break;
                          	case '11' : $namabulan = "November"; break;
                          	case '12' : $namabulan = "Desember"; break;
                          	default  : $namabulan = "tidak didefinisikan";
    }
		$blnx = strlen($blnx)==1 ? "0".$blnx : $blnx;
	  $periode="to_char(x.mulas,'YYYYMM')= '$vthn$blnx' and ";
	  echo "<a class=verdana10blu>PRODUKSI BULAN <b>".strtoupper($namabulan)." ".$vthn."</b> $judulstatus $judul</a><br><br>";
	}
	else
	{
//	  $periode="x.mulas between to_date('$blnstart$vthn','MMYYYY') and to_date('$blnend$vthn','MMYYYY') and ";
	  $periode="to_char(x.mulas,'YYYYMM') between '$vthn$blnstart' and '$vthn$blnend' and ";
	  echo "<a class=verdana10blu>PRODUKSI BULAN <b>$blntitlestart $vthn</b> S/D <b>$blntitleend $vthn</b> $judulstatus $judul</a><br><br>";
	}
	//echo "<a class=verdana10blu>PRODUKSI BULAN <b>$blntitlestart $vthn</b> S/D <b>$blntitleend $vthn</b></a><br>";
  echo "</div>";

	echo "<table border=0 cellspacing=0 cellpadding=0 width=2000>";
	echo "<tr>";



	for ($a=0; $a<count($kdvaluta); $a++) {
		echo "<td valign=\"top\">";
	  $sql="select a.prefixpertanggungan,p.namaproduk,".
	               "p.kdproduk,".
								 "a.polis,".
								 "a.pempol,".
								 "a.jua,".
								 "a.premi, ".
// Tambahan oleh Ari 04/02/2008
					 		 	 "a.komisibp3, ".
								 "a.komisi1, ".
								 "a.premilink ".
// End of Tambahan oleh Ari 04/02/2008
				 "from $DBUser.tabel_202_produk p,".


				 "(SELECT x.kdproduk,count(x.nopertanggungan) as polis,".
         			"count(DISTINCT x.nopemegangpolis) pempol,".
                   "sum(x.premi1) as premi,".
                   "sum(x.juamainproduk) as jua,x.prefixpertanggungan,".
                   "SUM ((SELECT   SUM (premi) AS kampret ".
                   "FROM $DBUser.tabel_223_transaksi_produk ".
                   "WHERE prefixpertanggungan = x.prefixpertanggungan ".
                   "AND nopertanggungan = x.nopertanggungan ".
                   "AND kdbenefit IN ('DEATHMA') ".
                   "GROUP BY prefixpertanggungan, nopertanggungan)) premilink,".
                   "sum ((select SUM(komisiagen) as kbp3  from $DBUser.tabel_404_temp where ".
                       "prefixpertanggungan=x.prefixpertanggungan and nopertanggungan=x.nopertanggungan and ".
                       "kdkomisiagen IN ('02') ".
                       "and thnkomisi = '1'  group by prefixpertanggungan,nopertanggungan ".
                   "))komisibp3, ".

                   "sum ((select SUM(komisiagen) as kk  from $DBUser.tabel_404_temp where ".
                       "prefixpertanggungan=x.prefixpertanggungan and nopertanggungan=x.nopertanggungan and ".
                       "kdkomisiagen IN ('03', '01') ".
                       "and thnkomisi = '1'  group by prefixpertanggungan,nopertanggungan ".
                   "))komisi1 ".

              "FROM $DBUser.tabel_200_pertanggungan x,".
                   "$DBUser.tabel_500_penagih y ".

              "WHERE x.nopenagih = y.nopenagih and ".
						   $filter.
               //AND y.kdrayonpenagih = 'AC'
							 $periode." ".
               //AND x.mulas BETWEEN TO_DATE ('012008', 'MMYYYY') AND TO_DATE ('122008', 'MMYYYY')
               //"x.kdvaluta='1' ".
							 "x.kdvaluta='$kdvaluta[$a]' ".
               "and x.kdpertanggungan = '2' ".
							 $filterstatus.
							 $filterkdcarabayar. 
               //AND x.kdstatusfile = '1'
    				  "group by x.prefixpertanggungan,x.kdproduk) a ".
				 "where ".
				     "a.kdproduk(+)=p.kdproduk ".
						 //"and nvl(p.status,0)<>'X' ". // semua produk
				 "order by p.kdproduk";
	//echo $sql;
	//die;
	$DB->parse($sql);
	$DB->execute();

	if($a=="0"){
			$valutatitle = "<td class=verdana8blk align=center bgcolor=#96cbcb></td><td class=verdana8blk align=center bgcolor=#96cbcb></td><td class=verdana8blk align=center colspan=6 bgcolor=#b4d7e0><b>".$namavaluta[$a]."</b></td>";
	    $produktitle = "<td class=verdana8blk align=center bgcolor=#96cbcb><b>RAYON</b></td><td class=verdana8blk width=250 align=center bgcolor=#96cbcb><B>PRODUK</B></td><td class=verdana8blk align=center bgcolor=#82d7ff><b>POLIS</b><td class=verdana8blk align=center bgcolor=#82d7ff><b>PEMPOL</b></td><td class=verdana8blk align=center bgcolor=#9ce29a><b>JUA</b></td><td class=verdana8blk align=center bgcolor=#fee498><b>PREMI</b></td><td class=verdana8blk align=center bgcolor=#ccccff><b>KOMISI BP3</b></td><td class=verdana8blk align=center bgcolor=#ccccff><b>KOMISI PENUTUPAN I</b></td>";
  } else {
	 		$valutatitle = "<td class=verdana8blk align=center colspan=8 bgcolor=#b4d7e0><b>".$namavaluta[$a]."</b></td>";
	    $produktitle = "<td class=verdana8blk align=center bgcolor=#fee498><b>RAYON</b></td><td class=verdana8blk width=250 align=center bgcolor=#96cbcb><B>PRODUK</B></td><td class=verdana8blk align=center bgcolor=#82d7ff><b>POLIS</b></td><td class=verdana8blk align=center bgcolor=#82d7ff><b>PEMPOL</b></td><td class=verdana8blk align=center bgcolor=#9ce29a><b>JUA</b></td><td class=verdana8blk align=center bgcolor=#fee498><b>PREMI</b></td><td class=verdana8blk align=center bgcolor=#ccccff><b>KOMISI BP3</b></td><td class=verdana8blk align=center bgcolor=#ccccff><b>KOMISI PENUTUPAN I</b></td>";
	}

	echo "<table border=1 cellspacing=0 style=\"border-collapse: collapse\" bordercolor=\"#C0C0C0\" width=\"100%\" id=\"AutoNumber1\">";
  echo "<tr>";  
	       echo $valutatitle;
	echo "</tr>";
	echo "<tr>";	
	       echo $produktitle;
	echo "</tr>";

	while($ars=$DB->nextrow()){

	 if($a=="0"){
	    $kdproduk = $ars["NAMAPRODUK"];
		$prev = $ars["PREFIXPERTANGGUNGAN"];
			$kolomproduk="<td class=verdana8blk align=right bgcolor=#9ce29a><b>".$prev."</b></td><td class=verdana8blk  width=250 bgcolor=#d0e8e8>".$kdproduk."</td>";
	 } else {
	    //$kdproduk="0";
		$kdproduk = $ars["NAMAPRODUK"];
		$prev = $ars["PREFIXPERTANGGUNGAN"];
			$kolomproduk="<td class=verdana8blk align=center bgcolor=#9ce29a>".$prev."</td><td class=verdana8blk  width=250 bgcolor=#d0e8e8>".$kdproduk."</td>";
	 }

	 $polis[$a] = $ars["POLIS"];
	 if(!$polis[$a]){
	   $polis[$a]="0";
	 }
	 $jua[$a] = $ars["JUA"];
	 if(!$jua[$a]){
	   $jua[$a]="0";
	 }
	 $premi[$a] = $ars["PREMI"];
	 if(!$premi[$a]){
	   $premi[$a]="0";
	 }
     $pempol[$a] = $ars["PEMPOL"];
	 if(!$pempol[$a]){
	   $pempol[$a]="0";
	 }
     $komisibp3[$a] = $ars["KOMISIBP3"];
	 if(!$komisibp3[$a]){
	   $komisibp3[$a]="0";
	 }
     $komisi1[$a] = $ars["KOMISI1"];
	 if(!$komisi1[$a]){
	   $komisi1[$a]="0";
	 }
	 //====
	 $kode[$a] = $ars["KDPRODUK"];
	 $premilink[$a] = $ars["PREMILINK"];
	 if(!$premilink[$a]){
	   $premilink[$a]="0";
	 }

	 echo "<tr>";
	 if(substr($kode[$a],0,3)=="JL2") {
	    echo $kolomproduk."<td class=verdana8blk align=right bgcolor=#e1f5ff>".$polis[$a]."</td><td class=verdana8blk align=right bgcolor=#e1f5ff>".$pempol[$a]."</td><td class=verdana8blk align=right bgcolor=#defdd9>".number_format($jua[$a],2,",",".")."</td><td class=verdana8blk align=right bgcolor=#fff5d7>".number_format($premilink[$a],2,",",".")."</td><td class=verdana8blk align=right bgcolor=#ffccff>".number_format($komisibp3[$a],2,",",".")."</td><td class=verdana8blk align=right bgcolor=#ffccff>".number_format($komisi1[$a],2,",",".")."</td>";
	 }
	 else {
	 			echo $kolomproduk."<td class=verdana8blk align=right bgcolor=#e1f5ff>".$polis[$a]."</td><td class=verdana8blk align=right bgcolor=#e1f5ff>".$pempol[$a]."</td><td class=verdana8blk align=right bgcolor=#defdd9>".number_format($jua[$a],2,",",".")."</td><td class=verdana8blk align=right bgcolor=#fff5d7>".number_format($premi[$a],2,",",".")."</td><td class=verdana8blk align=right bgcolor=#ffccff>".number_format($komisibp3[$a],2,",",".")."</td><td class=verdana8blk align=right bgcolor=#ffccff>".number_format($komisi1[$a],2,",",".")."</td>";
	 }
	 echo "</tr>";

	$jmlpolis[$a]+=$polis[$a];
	$jmljua[$a]+=$jua[$a];
	$jmlpremi[$a]+=$premi[$a];
	$jmlpempol[$a]+=$pempol[$a];
	$jmlkomisibp3[$a]+=$komisibp3[$a];
	$jmlkomisi1[$a]+=$komisi1[$a];
	}


	if($a=="0"){
	  $jmlproduk = "<td class=verdana8blk align=right bgcolor=#82d7ff><b></b></td><td class=verdana8blk width=250 align=center bgcolor=#96cbcb><B>JUMLAH</B></td><td class=verdana8blk align=right bgcolor=#82d7ff><b>".$jmlpolis[$a]."</b></td><td class=verdana8blk align=right bgcolor=#82d7ff><b>".$jmlpempol[$a]."</b></td><td class=verdana8blk align=right bgcolor=#9ce29a><b>".number_format($jmljua[$a],2,",",".")."</b></td><td class=verdana8blk align=right bgcolor=#fee498><b>".number_format($jmlpremi[$a],2,",",".")."</b></td><td class=verdana8blk align=right bgcolor=#ccccff><b>".number_format($jmlkomisibp3[$a],2,",",".")."</b></td><td class=verdana8blk align=right bgcolor=#ccccff><b>".number_format($jmlkomisi1[$a],2,",",".")."</b></td>";
	} else {
      $jmlproduk = "<td class=verdana8blk align=right bgcolor=#82d7ff><b></b><td class=verdana8blk align=center bgcolor=#fee498><b>".$prev."</b></td><td class=verdana8blk align=right bgcolor=#82d7ff><b>".$jmlpolis[$a]."</b></td><td class=verdana8blk align=right bgcolor=#82d7ff><b>".$jmlpempol[$a]."</b></td><td class=verdana8blk align=right bgcolor=#9ce29a><b>".number_format($jmljua[$a],2,",",".")."</b></td><td class=verdana8blk align=right bgcolor=#fee498><b>".number_format($jmlpremi[$a],2,",",".")."</b></td><td class=verdana8blk align=right bgcolor=#ccccff><b>".number_format($jmlkomisibp3[$a],2,",",".")."</b></td><td class=verdana8blk align=right bgcolor=#ccccff><b>".number_format($jmlkomisi1[$a],2,",",".")."</b></td>";
	}
	echo "<tr>";
	    echo $jmlproduk;
	echo "</tr>";
	echo "</table>";

	echo "</td>";
}
$totalpolis=$jmlpolis[0] + $jmlpolis[1] + $jmlpolis[2];
echo "</tr>";
echo "</table>";
echo "<a class=verdana10blu>Total Polis Terjual = <b>".$totalpolis."</b></a>";
echo "<hr size=1>";
} else {
//echo "klik cari";
}
?>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<?
  include "../../includes/endtimer.php";
 ?>
