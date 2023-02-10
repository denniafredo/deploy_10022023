<?php
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	$DB=new Database($userid,$passwd,$DBName);
	echo "<link href=../jws.css rel=stylesheet type=text/css>";
	$periode="022004";
	//$kantor="AC";
	
	$vbln = substr(("0".$vbln),-2);

	if($vbln=="ll"){
	   $periode = "to_char(x.mulas,'YYYY')='$vthn' and ";
	   //$periode = "x.mulas between to_date('$vthn','YYYY') and to_date('$vthn','YYYY') and ";
	} elseif($vbln=="0"){
	   $qry = "select to_char(sysdate,'MMYYYY') as bulantahun from dual";
		 $DB->parse($qry);
 		 $DB->execute();
		 $b=$DB->nextrow();
		 $perd = $b["BULANTAHUN"];
	   $vbln = substr($perd,0,2);
		 $vthn = substr($perd,-4);
		 //$periode = "x.mulas between to_date('$perd','MMYYYY') and to_date('$perd','MMYYYY') and ";
		 $periode = "to_char(x.mulas,'MMYYYY')='$perd' and ";
	} else {
	   //$periode = "x.mulas between to_date('$vbln$vthn','MMYYYY') and to_date('$vbln$vthn','MMYYYY') and ";
		 $periode = "to_char(x.mulas,'MMYYYY')='$vbln$vthn' and ";
	}
	
	
  $sql = "select ".
            "p.namaproduk,".
            "p.kdproduk,".
            "a.polis,a.jua,a.premi,".
            "a1.polisblk,a1.juablk,a1.premiblk,".
            "a2.polisskg,a2.juaskg,a2.premiskg,".
						
            "b.polisrpi,b.juarpi,b.premirpi,".
            "b1.polisrpiblk,b1.juarpiblk,b1.premirpiblk,".
            "b2.polisrpiskg,b2.juarpiskg,b2.premirpiskg,".
						
            "c.polisusd,c.juausd,c.premiusd,".
            "c1.polisusdblk,c1.juausdblk,c1.premiusdblk,".
            "c2.polisusdskg,c2.juausdskg,c2.premiusdskg ". 
        "from ".
        	"$DBUser.tabel_202_produk p,".
        	"(select x.kdproduk,count(x.nopertanggungan) polis,sum(x.juamainproduk) jua,sum(x.premi1) premi ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ".
					 "".$periode."". 
        	 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='1' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) a, ".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisblk,sum(x.juamainproduk) juablk,sum(x.premi1) premiblk ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='1' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdcarabayar not in ('X','E','J') and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) a1, ".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisskg,sum(x.juamainproduk) juaskg,sum(x.premi1) premiskg ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='1' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdcarabayar in ('X','E','J') and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) a2, ".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisrpi,sum(x.juamainproduk) juarpi,sum(x.premi1) premirpi ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='0' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) b,".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisrpiblk,sum(x.juamainproduk) juarpiblk,sum(x.premi1) premirpiblk ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='0' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdcarabayar not in ('X','E','J') and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) b1, ".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisrpiskg,sum(x.juamainproduk) juarpiskg,sum(x.premi1) premirpiskg ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='0' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdcarabayar in ('X','E','J') and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) b2, ".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisusd,sum(x.juamainproduk) juausd,sum(x.premi1) premiusd ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='3' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) c,".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisusdblk,sum(x.juamainproduk) juausdblk,sum(x.premi1) premiusdblk ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='3' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdcarabayar not in ('X','E','J') and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) c1, ".
        
        	"(select x.kdproduk,count(x.nopertanggungan) polisusdskg,sum(x.juamainproduk) juausdskg,sum(x.premi1) premiusdskg ".
        	 "from $DBUser.tabel_200_pertanggungan x,$DBUser.tabel_500_penagih y ".
        	 "where ".
        	 "x.nopenagih=y.nopenagih and y.kdrayonpenagih ='$kantor' and ". 
        	 "".$periode."".
					 //"x.mulas between to_date('$periode','MMYYYY') and to_date('$periode','MMYYYY') and ". 
        	 "x.kdvaluta='3' and ". 
        	 "x.kdpertanggungan='2' and ". 
        	 "x.kdcarabayar in ('X','E','J') and ". 
        	 "x.kdstatusfile='1' ".
        	 "group by x.kdproduk) c2  ".
        "where ".
        	"p.kdproduk=a.kdproduk(+)  and ". 
        	"p.kdproduk=a1.kdproduk(+)  and ".
        	"p.kdproduk=a2.kdproduk(+)  and ".
        	"p.kdproduk=b.kdproduk(+)  and ". 
        	"p.kdproduk=b1.kdproduk(+)  and ". 
        	"p.kdproduk=b2.kdproduk(+)  and ". 
        	"p.kdproduk=c.kdproduk(+) and ". 
        	"p.kdproduk=c1.kdproduk(+) and ".
        	"p.kdproduk=c2.kdproduk(+) ".
        "order by p.namaproduk";
 $DB->parse($sql);
 $DB->execute();

 //echo "<br><br>".$sql."<br><br>";
 switch ($vbln)	{
		          case "01": $bulan = "Januari"; break;
	            case "02": $bulan = "Pebruari"; break;
	            case "03": $bulan = "Maret"; break;
		          case "04": $bulan = "April"; break;
		          case "05": $bulan = "Mei"; break;
		          case "06": $bulan = "Juni"; break;
		          case "07": $bulan = "Juli"; break;
		          case "08": $bulan = "Agustus"; break;
		          case "09": $bulan = "September"; break;
		          case "10": $bulan = "Oktober"; break;
		          case "11": $bulan = "Nopember"; break;
		          case "12": $bulan = "Desember"; break;
 }
 	
echo "<a class=verdana10blk>Rekapitulasi Macam Asuransi Per Bulan Kantor $kantor <br>";
echo "Produksi <b>".$bulan." ".$vthn."</a></b><br><br>";
 ?>	
	<table border="0" width="100%" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber2">
   <form name="getpeserta" method="POST" action="<? $PHP_SELF;?>">
	      <tr>
          <td class="verdana9blk">Pilih Bulan <?  DateSelector("v"); ?>
							<input type="submit" name="submit" value="CARI" class="button">
					</td>
					<td ></td>
	      </tr>
  </table>

<table border="1" cellpadding="2" style="border-collapse: collapse" bordercolor="#A0B4D3" width="100%" id="AutoNumber1">
  <tr>
    <td class="verdana8blk" rowspan="3" bgcolor="#D5F0F9">No.</td>
    <td class="verdana8blk" rowspan="3" bgcolor="#D5F0F9">Produk</td>
    <td class="verdana8blk" colspan="12" align="center" bgcolor="#D5F0F9">Rupiah</td>
    <td class="verdana8blk" colspan="12" align="center" bgcolor="#D5F0F9">Rupiah Index</td>
    <td class="verdana8blk" colspan="12" align="center" bgcolor="#D5F0F9">US Dollar</td>
  </tr>
  <tr>
    <td class="verdana8blk" colspan="6" align="center" bgcolor="#D5F0F9">Premi</td>
    <td class="verdana8blk" colspan="6" align="center" bgcolor="#D5F0F9">JUA</td>
    <td class="verdana8blk" colspan="6" align="center" bgcolor="#D5F0F9">Premi</td>
    <td class="verdana8blk" colspan="6" align="center" bgcolor="#D5F0F9">JUA</td>
    <td class="verdana8blk" colspan="6" align="center" bgcolor="#D5F0F9">Premi</td>
    <td class="verdana8blk" colspan="6" align="center" bgcolor="#D5F0F9">JUA</td>
  </tr>
  <tr>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Berkala</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Sekaligus</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Total</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Berkala</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Sekaligus</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Total</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Berkala</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Sekaligus</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Total</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Berkala</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Sekaligus</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Total</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Berkala</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Sekaligus</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Total</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Berkala</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Sekaligus</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Total</td>
    <td class="verdana8blk" align="center" bgcolor="#D5F0F9">Polis</td>
  </tr>
	<? 
	$i=1;
	while($arr=$DB->nextrow()) {
  	$premirpblk = $arr["PREMIBLK"];
  	$premirpskg = $arr["PREMISKG"];
		$premirp = $arr["PREMI"];
		
		$premirpiblk = $arr["PREMIRPIBLK"];
  	$premirpiskg = $arr["PREMIRPISKG"];
		$premirpi = $arr["PREMIRPI"];
		
		$premiusdblk = $arr["PREMIUSDBLK"];
  	$premiusdskg = $arr["PREMIUSDSKG"];
		$premiusd = $arr["PREMIUSD"];
		
		$juarpblk = $arr["JUABLK"];
		$juarpskg = $arr["JUASKG"];
		$juarp 		= $arr["JUA"];
		
		$juarpiblk = $arr["JUARPIBLK"];
		$juarpiskg = $arr["JUARPISKG"];
		$juarpi 		= $arr["JUARPI"];
		
		$juausdblk = $arr["JUAUSDBLK"];
		$juausdskg = $arr["JUAUSDSKG"];
		$juausd 		= $arr["JUAUSD"];
		
		$polisrpblk = $arr["POLISBLK"];
  	$polisrpskg = $arr["POLISSKG"];
		$polisrp 		= $arr["POLIS"];
		
		$polisrpiblk = $arr["POLISRPIBLK"];
  	$polisrpiskg = $arr["POLISRPISKG"];
		$polisrpi 	 = $arr["POLISRPI"];

		$polisusdblk = $arr["POLISUSDBLK"];
  	$polisusdskg = $arr["POLISUSDSKG"];
		$polisusd 	 = $arr["POLISUSD"];		
  	
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "dddddd").">";
	?>
    <td class="verdana8blk" valign="top" align="right"><?=$i;?></td>
    <td class="verdana8blk" valign="top"><?=$arr["NAMAPRODUK"];?></td>
		
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMIBLK"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISBLK"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMISKG"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISSKG"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMI"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLIS"];?></td>
    
		<td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUABLK"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISBLK"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUASKG"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISSKG"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUA"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLIS"];?></td>
    
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMIRPIBLK"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISRPIBLK"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMIRPISKG"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISRPISKG"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMIRPI"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISRPI"];?></td>
    
		<td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUARPIBLK"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISRPIBLK"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUARPISKG"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISRPISKG"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUARPI"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISRPI"];?></td>

	  <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMIUSDBLK"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISUSDBLK"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMIUSDSKG"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISUSDSKG"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["PREMIUSD"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISUSD"];?></td>
    
		<td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUAUSDBLK"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISUSDBLK"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUAUSDSKG"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISUSDSKG"];?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($arr["JUAUSD"],2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$arr["POLISUSD"];?></td>
  </tr>
	<? 
	$i++;
	$jmlpremirpblk += $premirpblk;
	$jmlpremirpskg += $premirpskg;
	$jmlpremirp += $premirp;
	
	$jmlpremirpiblk += $premirpiblk;
	$jmlpremirpiskg += $premirpiskg;
	$jmlpremirpi 		+= $premirpi;

	$jmlpremiusdblk += $premiusdblk;
	$jmlpremiusdskg += $premiusdskg;
	$jmlpremiusd 		+= $premiusd;
	
	$jmljuarpblk += $juarpblk;
	$jmljuarpskg +=	$juarpskg;
	$jmljuarp +=	$juarp;
	
	$jmljuarpiblk += $juarpiblk;
	$jmljuarpiskg +=	$juarpiskg;
	$jmljuarpi +=	$juarpi;

	$jmljuausdblk += $juausdblk;
	$jmljuausdskg +=	$juausdskg;
	$jmljuausd +=	$juausd;
		
	$jmlpolisrpblk += $polisrpblk;
	$jmlpolisrpskg += $polisrpskg;
	$jmlpolisrp += $polisrp;
	
	$jmlpolisrpiblk += $polisrpiblk;
	$jmlpolisrpiskg += $polisrpiskg;
	$jmlpolisrpi += $polisrpi;
		
	$jmlpolisusdblk += $polisusdblk;
	$jmlpolisusdskg += $polisusdskg;
	$jmlpolisusd += $polisusd;
	}
	?>
	  <tr>
    <td class="verdana8blk" valign="top" align="center" colspan="2">Jumlah</td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremirpblk,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpblk;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremirpskg,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpskg;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremirp,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrp;?></td>
		
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuarpblk,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpblk;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuarpskg,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpskg;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuarp,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrp;?></td>

    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremirpiblk,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpiblk;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremirpiskg,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpiskg;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremirpi,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpi;?></td>
		
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuarpiblk,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpiblk;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuarpiskg,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpiskg;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuarpi,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisrpi;?></td>

    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremiusdblk,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisusdblk;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremiusdskg,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisusdskg;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmlpremiusd,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisusd;?></td>
		
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuausdblk,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisusdblk;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuausdskg,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisusdskg;?></td>
    <td class="verdana8blk" valign="top" align="right"><?=number_format($jmljuausd,2);?></td>
    <td class="verdana8blk" valign="top" align="right"><?=$jmlpolisusd;?></td>

  </tr>
</table>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
