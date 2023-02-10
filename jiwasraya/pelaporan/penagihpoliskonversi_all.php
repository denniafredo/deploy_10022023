<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "<a class=verdana10blk><b>INFORMASI POLIS AKTIF PER PENAGIH<br>SELURUH KANTOR</b></a>";	
	//echo "<hr size=1>";
	?>
<script language="javascript">
var win= null;
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}
</script>

<?
$DB = new Database($userid, $passwd, $DBName);	
	
/*
$qry="select r.prefixpenagih,r.nopenagih,x.namaklien1,s.liunpolis ".
     "from ". 
		    "$DBUser.tabel_100_klien x, ".
        "$DBUser.tabel_500_penagih r,".     
        "(select a.nopenagih,count(a.nopertanggungan) liunpolis ".
        "from ".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b ".
             "where ".
                 "a.nopenagih=b.nopenagih and ".
                 "kdpertanggungan='2' and ".
                 "b.kdrayonpenagih='$kantor' and ".
								 "a.kdstatusfile='1' ".
             "group by a.nopenagih) s ".    
     "where ".
     "r.nopenagih=s.nopenagih(+) and ".
     "r.nopenagih=x.noklien and ".
		 "r.kdstatuspenagih!='04' and ".
     "r.kdrayonpenagih='$kantor' order by x.namaklien1";
*/

      $qry="select ".
			        "z.prefixpenagih,".
              "z.nopenagih,".
              "z.kdrayonpenagih,".
							"r.namaklien1,".
							
              "x.polrptahun,".
              "x.prerptahun,".
              "w.polrpsmter,".
							"w.prerpsmter,".
              "u.polrpquartl,".
							"u.prerpquartl,".
              "t.polrpbulan,".
							"t.prerpbulan,".
              "s.polrpsklgus,".
							"s.prerpsklgus,".
            
              "x0.polrpitahun,".
							"x0.prerpitahun,".
              "w0.polrpismter,".
							"w0.prerpismter,".
              "u0.polrpiquartl,".
							"u0.prerpiquartl,".
              "t0.polrpibulan,".
							"t0.prerpibulan,".
              "s0.polrpisklgus,".
							"s0.prerpisklgus,".
            
              "x3.polusdtahun,".
							"x3.preusdtahun,".
              "w3.polusdsmter,".
							"w3.preusdsmter,".
              "u3.polusdquartl,".
							"u3.preusdquartl,".
              "t3.polusdbulan,".
							"t3.preusdbulan,".
              "s3.polusdsklgus,".
							"s3.preusdsklgus ".
              
            "from ".
						  "$DBUser.tabel_100_klien r,".
              "$DBUser.tabel_500_penagih z,".
            
              "(select ".
                "a.nopenagih,".
                "count(a.nopertanggungan) polrptahun, ".
								"sum(a.premi1) prerptahun ".
              "from ".
                "$DBUser.tabel_200_pertanggungan a,".
                "$DBUser.tabel_500_penagih b ".
              "where ".
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
                "a.kdpertanggungan='2' and ".
                "a.kdvaluta='1' and ".
            		"a.kdcarabayar in ('4','A') ".
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ".
                "a.nopenagih) x,".
              
              "(select ".
                "a.nopenagih,".
            	  "count(a.nopertanggungan) polrpsmter, ".
								"sum(a.premi1) prerpsmter ".
              "from ".
                "$DBUser.tabel_200_pertanggungan a,".
            	  "$DBUser.tabel_500_penagih b ".
              "where ".
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            	  "a.kdpertanggungan='2' and ".
                "a.kdvaluta='1' and ". 
            	  "a.kdcarabayar in ('3','H') ". 
//            	  "and b.kdrayonpenagih='$kantor' ".
              "group by ".
                "a.nopenagih) w,".
            	
              "(select ".
                "a.nopenagih,".
            	  "count(a.nopertanggungan) polrpquartl, ".
								"sum(a.premi1) prerpquartl ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            	  "$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            	  "a.kdpertanggungan='2' and ".
                "a.kdvaluta='1' and ". 
            	  "a.kdcarabayar in ('2','Q') ". 
//            	  "and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) u,".
            	
              "(select ".
                "a.nopenagih,".
            	  "count(a.nopertanggungan) polrpbulan, ".
								"sum(a.premi1) prerpbulan ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='1' and ". 
            		"a.kdcarabayar in ('1','M') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) t,".
            
              "(select ".
                "a.nopenagih,".
            		"count(a.nopertanggungan) polrpsklgus,".
								"sum(a.premi1) prerpsklgus ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='1' and ". 
            		"a.kdcarabayar in ('X','E','J') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) s,".
            
              "(select ".
                "a.nopenagih,".
            		"count(a.nopertanggungan) polrpitahun, ".
								"sum(a.premi1) prerpitahun ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='0' and ". 
            		"a.kdcarabayar in ('4','A') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) x0,".
              
              "(select ".
                "a.nopenagih,".
            		"count(a.nopertanggungan) polrpismter, ".
								"sum(a.premi1) prerpismter ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='0' and ". 
            		"a.kdcarabayar in ('3','H') ". 
//           		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) w0,".
            	
              "(select ".
                "a.nopenagih,".
            		"count(a.nopertanggungan) polrpiquartl, ".
								"sum(a.premi1) prerpiquartl ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='0' and ". 
            		"a.kdcarabayar in ('2','Q') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) u0,".
            	
              "(select ". 
                "a.nopenagih,".
            		"count(a.nopertanggungan) polrpibulan, ".
								"sum(a.premi1) prerpibulan ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='0' and ". 
            		"a.kdcarabayar in ('1','M') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) t0,".
            
              "(select ". 
                "a.nopenagih,".
            		"count(a.nopertanggungan) polrpisklgus, ".
								"sum(a.premi1) prerpisklgus ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='0' and ". 
            		"a.kdcarabayar in ('X','E','J') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) s0,".
            
              "(select ". 
                "a.nopenagih,".
            		"count(a.nopertanggungan) polusdtahun, ".
								"sum(a.premi1) preusdtahun ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='3' and ". 
            		"a.kdcarabayar in ('4','A') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) x3,".
              
              "(select ". 
                "a.nopenagih,".
            		"count(a.nopertanggungan) polusdsmter, ".
								"sum(a.premi1) preusdsmter ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='3' and ". 
              	"a.kdcarabayar in ('3','H') ". 
//              	"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) w3,".
            	
              "(select ". 
                "a.nopenagih,".
            		"count(a.nopertanggungan) polusdquartl, ".
								"sum(a.premi1) preusdquartl ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='3' and ". 
            		"a.kdcarabayar in ('2','Q') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) u3,".
            	
              "(select ". 
                "a.nopenagih,".
            		"count(a.nopertanggungan) polusdbulan, ".
								"sum(a.premi1) preusdbulan ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='3' and ". 
            		"a.kdcarabayar in ('1','M') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) t3,".
            
              "(select ". 
                "a.nopenagih,".
            		"count(a.nopertanggungan) polusdsklgus, ".
								"sum(a.premi1) preusdsklgus ".
              "from ". 
                "$DBUser.tabel_200_pertanggungan a,".
            		"$DBUser.tabel_500_penagih b ".
              "where ". 
                "a.nopenagih=b.nopenagih and ".
                "a.kdstatusfile='1' and ".
            		"a.kdpertanggungan='2' and ".
                "a.kdvaluta='3' and ". 
            		"a.kdcarabayar in ('X','E','J') ". 
//            		"and b.kdrayonpenagih='$kantor' ".
              "group by ". 
                "a.nopenagih) s3 ".
            	
            "where ". 
              "z.nopenagih=x.nopenagih(+) and ". 
              "z.nopenagih=w.nopenagih(+) and ". 
              "z.nopenagih=u.nopenagih(+) and ". 
              "z.nopenagih=t.nopenagih(+) and ". 
              "z.nopenagih=s.nopenagih(+) and ". 
            
              "z.nopenagih=x0.nopenagih(+) and ". 
              "z.nopenagih=w0.nopenagih(+) and ". 
              "z.nopenagih=u0.nopenagih(+) and ". 
              "z.nopenagih=t0.nopenagih(+) and ". 
              "z.nopenagih=s0.nopenagih(+) and ". 
            
              "z.nopenagih=x3.nopenagih(+) and ". 
              "z.nopenagih=w3.nopenagih(+) and ". 
              "z.nopenagih=u3.nopenagih(+) and ". 
              "z.nopenagih=t3.nopenagih(+) and ". 
              "z.nopenagih=s3.nopenagih(+) and ". 
            
//              "z.kdrayonpenagih='$kantor' and ". 
							"z.nopenagih=r.noklien and  ".
              "z.kdstatuspenagih<>'04' ".
            "group by ".
						  "z.prefixpenagih,".
              "z.nopenagih,".
              "z.kdrayonpenagih,".
							"r.namaklien1,".
							
              "x.polrptahun,".
              "x.prerptahun,".
              "w.polrpsmter,".
							"w.prerpsmter,".
              "u.polrpquartl,".
							"u.prerpquartl,".
              "t.polrpbulan,".
							"t.prerpbulan,".
              "s.polrpsklgus,".
							"s.prerpsklgus,".
            
              "x0.polrpitahun,".
							"x0.prerpitahun,".
              "w0.polrpismter,".
							"w0.prerpismter,".
              "u0.polrpiquartl,".
							"u0.prerpiquartl,".
              "t0.polrpibulan,".
							"t0.prerpibulan,".
              "s0.polrpisklgus,".
							"s0.prerpisklgus,".
            
              "x3.polusdtahun,".
							"x3.preusdtahun,".
              "w3.polusdsmter,".
							"w3.preusdsmter,".
              "u3.polusdquartl,".
							"u3.preusdquartl,".
              "t3.polusdbulan,".
							"t3.preusdbulan,".
              "s3.polusdsklgus,".
							"s3.preusdsklgus";
							
							
	   //echo $qry;
				  $DB->parse($qry);
					$DB->execute();
	/*
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Penagih Kantor ".$kantor."</b></font><br><br>";
					 echo "<table>";
					 echo "<tr bgcolor=#97b3b9>";
					 echo "<td class=verdana8blk align=center><b>NO.</b></td>";
					 echo "<td class=verdana8blk align=center><b>NO. PENAGIH</b></td>";
					 echo "<td class=verdana8blk align=center><b>NAMA</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML. POLIS</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomorpenagih=$arr["NOPENAGIH"];
					 $jmlpol = $arr["LIUNPOLIS"];

	           $jmlproposal = ($jmlpol=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('portopoliokantorpenagih.php?nopenagih=$nomorpenagih&vbln=$bln&vthn=$vthn','popuppage','1000','400','yes')\"><b>$jmlpol</b></a>";
  
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXPENAGIH"]."-".$arr["NOPENAGIH"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]."</td>";
					 echo "<td class=verdana8blk  align=center>".$arr["POLRPTAHUN"]."</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
		*/			 
		?>
	<table width="1700" border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#6B8FBC" id="AutoNumber1">
  <tr>
    <td rowspan="3" align="center" bgcolor="#DCF1E1"><b>
    <font size="1" face="Verdana" color="#006699">NO</font></b></td>
    <td rowspan="3" align="center" bgcolor="#DCF1E1"><b>
    <font size="1" face="Verdana" color="#006699">KODE RAYON</font></b></td>
    <td rowspan="3" align="center" bgcolor="#DCF1E1"><b>
    <font size="1" face="Verdana" color="#006699">NO.PEN AGIH</font></b></td>
    <td rowspan="3" align="center" bgcolor="#DCF1E1"><b>
    <font size="1" face="Verdana" color="#006699">NAMA</font></b></td>
    <td colspan="10" align="center" bgcolor="#F8F4E0"><b>
    <font size="1" face="Verdana" color="#006699">RUPIAH</font></b></td>
    <td colspan="10" align="center" bgcolor="#EAEEFF"><b>
    <font size="1" face="Verdana" color="#006699">RUPIAH INDEX</font></b></td>
    <td colspan="10" align="center" bgcolor="#E6F9D5"><b>
    <font size="1" face="Verdana" color="#006699">US DOLAR</font></b></td>
    <td rowspan="3" align="center" bgcolor="#EDFBFC"><b>
    <font size="1" face="Verdana" color="#006699">JML POLIS</font></b></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#F8F4E0" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">BUL</font></b></td>
    <td align="center" bgcolor="#F8F4E0" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">KWT</font></b></td>
    <td align="center" bgcolor="#F8F4E0" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">SEM</font></b></td>
    <td align="center" bgcolor="#F8F4E0" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">THN</font></b></td>
    <td align="center" bgcolor="#F8F4E0" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">SKL</font></b></td>
    <td align="center" bgcolor="#EAEEFF" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">BUL</font></b></td>
    <td align="center" bgcolor="#EAEEFF" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">KWT</font></b></td>
    <td align="center" bgcolor="#EAEEFF" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">SEM</font></b></td>
    <td align="center" bgcolor="#EAEEFF" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">THN</font></b></td>
    <td align="center" bgcolor="#EAEEFF" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">SKL</font></b></td>
    <td align="center" bgcolor="#E6F9D5" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">BUL</font></b></td>
    <td align="center" bgcolor="#E6F9D5" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">KWT</font></b></td>
    <td align="center" bgcolor="#E6F9D5" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">SEM</font></b></td>
    <td align="center" bgcolor="#E6F9D5" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">THN</font></b></td>
    <td align="center" bgcolor="#E6F9D5" colspan="2"><b>
    <font size="1" face="Verdana" color="#006699">SKL</font></b></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>POL</b></font></td>
    <td align="center" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><b>PRE</b></font></td>
  </tr>
	<? 
	$i = 1;
  while($arr=$DB->nextrow()) 
	{
   $jmlpol=$arr["POLRPBULAN"] + $arr["POLRPIBULAN"] + $arr["POLUSDBULAN"] +
	 				 $arr["POLRPQUARTL"] + $arr["POLRPIQUARTL"] + $arr["POLUSDQUARTL"] +
					 $arr["POLRPSMTER"] + $arr["POLRPISMTER"] + $arr["POLUSDSMTER"] +
					 $arr["POLRPTAHUN"] + $arr["POLRPITAHUN"] + $arr["POLUSDTAHUN"] +
					 $arr["POLRPSKLGUS"] + $arr["POLRPISKLGUS"] + $arr["POLUSDSKLGUS"] ;
   $jmlpolis = ($jmlpol=="") ? '0' : "<a href=\"#\" onclick=\"NewWindow('portopoliokantorpenagih.php?nopenagih=".$arr["NOPENAGIH"]."&vbln=$bln&vthn=$vthn','popuppage','1000','400','yes')\"><b>$jmlpol</b></a>";
	?>
  <tr>
    <td align="right"><font face="Verdana" size="1" color="#666666"><?=$i; ?></font></td>
    <td align="center"><font face="Verdana" size="1" color="#666666"><?=$arr["KDRAYONPENAGIH"]; ?></font></td>
    <td align="center"><font face="Verdana" size="1" color="#666666"><?=$arr["NOPENAGIH"]; ?></font></td>
    <td align="left"><font face="Verdana" size="1" color="#666666"><?=$arr["NAMAKLIEN1"]; ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPBULAN"]); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPBULAN"],2); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPQUARTL"]); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPQUARTL"],2); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPSMTER"]); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPSMTER"],2); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPTAHUN"]); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPTAHUN"],2); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPSKLGUS"]); ?></font></td>
    <td align="right" bgcolor="#F8F4E0">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPSKLGUS"],2); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPIBULAN"]); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPIBULAN"],2); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPIQUARTL"]); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPIQUARTL"],2); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPISMTER"]); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPISMTER"],2); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPITAHUN"]); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPITAHUN"],2); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLRPISKLGUS"]); ?></font></td>
    <td align="right" bgcolor="#EAEEFF">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PRERPISKLGUS"],2); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLUSDBULAN"]); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PREUSDBULAN"],2); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLUSDQUARTL"]); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PREUSDQUARTL"],2); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLUSDSMTER"]); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PREUSDSMTER"],2); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLUSDTAHUN"]); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PREUSDTAHUN"],2); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["POLUSDSKLGUS"]); ?></font></td>
    <td align="right" bgcolor="#E6F9D5">
    <font face="Verdana" size="1" color="#666666"><?=number_format($arr["PREUSDSKLGUS"],2); ?></font></td>
    <td align="right" bgcolor="#EDFBFC">
    <font face="Verdana" size="1" color="#666666"><?=$jmlpolis; ?></font></td>
  </tr>
 <? 
 $i++;
 }
  ?>
</table>

					 <?
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah Polis untuk melihat detail pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";	
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
 ?>
