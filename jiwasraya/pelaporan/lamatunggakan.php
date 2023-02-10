<?
include ("../../includes/common.php");
include ("../../includes/session.php");
include ("../../includes/database.php");
include ("../../includes/kantor.php");
$DB = New Database($userid,$passwd,$DBName);
$DC = New Database($userid,$passwd,$DBName);
$DD = New Database($userid,$passwd,$DBName);
?>
<table>
    <form name="date" action="<?=$PHP_SELF;?>"> 
    <tr>
    <td class="verdana10blk">Branch Office  
		<select name="kdkantor" onfocus="highlight(event)" class="c">
    <option>-- pilih branch office --</option>
		<?
		  $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor ".
			     "where kdjeniskantor='2' order by kdkantor";
		  $DB->parse($sqa);
			$DB->execute();					 
		  while ($arr=$DB->nextrow()) {
			 if ($arr["KDKANTOR"]==$kdkantor) {
			  print( "<option selected value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]."-".$arr["NAMAKANTOR"]."</option>" );
		   } else { 
				print( "<option value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]."-".$arr["NAMAKANTOR"]."</option>" );
		   }
			}
		?>	
		</select>
		
		<input type="submit" value="GO" name="cari">
		</td>
		
    </form> 
    </tr>
  </table>
	<hr size="1">
			<? 
			if(!$kdkantor)
			{
			  $kdkantor=$kantor;
			}
			?>
			Daftar Tunggakan Premi Kantor <?=$kdkantor;?>
			<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" id="AutoNumber1">
					<tr>
            <td class="verdana7blk" class="verdana7blk" bgcolor="#C4EBF7" rowspan="2"><b>CARA BAYAR</b></td>
						<td class="verdana7blk" bgcolor="#C4EBF7" colspan="4">
            <p align="center"><b>TUNGGAKAN (Bulan)</b></td>
          </tr>
					<tr bgcolor="#C4EBF7">
					
					<?php
          for($n=1; $n<5; ++$n) {
					  echo "<td class=verdana7blk align=center>".$n."</td>";
          }
					?>
					</tr>
					
					<? 
					$sqa= "select namacarabayar from $DBUser.tabel_305_cara_bayar ".
								"where kdcarabayar not in ('B','X','E','J','Q') group by namacarabayar";
					$DB->parse($sqa);
					$DB->execute();				
          //$arr = $DB->nextrow();
					$v=1;
					while ($arr = $DB->nextrow()) {		
					$kdcarabayar=$arr["KDCARABAYAR"];					
					if($v%2){
						echo "<tr bgcolor=#dddddd>";
					} else {
					  echo "<tr>";
					}
					$v++;
					echo "<td class=verdana7blk width=200>".$arr["NAMACARABAYAR"]."</td>";
					
					for($i=1; $i<5; ++$i) {
					  echo "<td class=verdana7blk align=right>";
									$sqa= "select ". 	
                          	"s.namacarabayar,".
                          	"months_between(to_date('012005','mmyyyy'),tglbooked) lamatunggakan,".
                          	"count(1) jml ".
                          "from  $DBUser.tabel_200_pertanggungan a,".
                          	"(select x.prefixpertanggungan, x.nopertanggungan, min(tglbooked) as tglbooked, ".
                          	    "sum(premitagihan) jumlahpremi ".
                           		"from ".
                          		  "$DBUser.tabel_300_historis_premi x,".
                                "$DBUser.tabel_200_pertanggungan z,".
                          			"$DBUser.tabel_500_penagih r ".
                           		"where x.prefixpertanggungan=z.prefixpertanggungan ".
                          		"and   x.nopertanggungan=z.nopertanggungan ".
                          	  "and z.kdpertanggungan='2' ".
                          		"and x.tglseatled is null ".
                          		"and x.status ='1' ".
                          		"and z.kdstatusfile='1' ".
                          		"and z.nopenagih = r.nopenagih ".
                          		"and r.kdrayonpenagih ='$kdkantor' ".
                          		"group by x.prefixpertanggungan, x.nopertanggungan) b,".
                          	"$DBUser.tabel_500_penagih m,".
                          	"$DBUser.tabel_241_grace_periode c,".
                          	"$DBUser.tabel_305_cara_bayar s ".
                          "where ".
                            "a.prefixpertanggungan=b.prefixpertanggungan ".
                            "and a.kdcarabayar=s.kdcarabayar ".
                            "and months_between(to_date('012005','mmyyyy'),tglbooked) <=4 ".
                            "and months_between(to_date('012005','mmyyyy'),tglbooked) >0 ".
                            "and a.nopertanggungan=b.nopertanggungan ".
                            "and a.nopenagih = m.nopenagih ".
                            "and a.kdproduk=c.kdproduk ".
                            "and m.kdrayonpenagih ='$kdkantor' ".
                            "and months_between(to_date('012005','mmyyyy'),tglbooked) = $i  ".
                            "and s.namacarabayar='".$arr["NAMACARABAYAR"]."' ".
                          "group by months_between(to_date('012005','mmyyyy'),tglbooked),s.namacarabayar";
												$DD->parse($sqa);
												$DD->execute();	
												$agn = $DD->nextrow();
												$jmlagen=($agn["JML"]=='' ? 0 : "".$agn["JML"]."");
						//echo $sqa;
						echo $jmlagen;
						echo "</td>";
						$totagn+=$jmlagen;
					}
					?> 
					</tr>
					<? 
					}
					?>
					<!--
					<tr>
					<td class="verdana7blk"><b>JUMLAH</b></td>
					-->
					<? 
					/*
					for($m=1; $m<5; ++$m) {
					  echo "<td class=verdana7blk align=right>";
						
						echo $totagn;
						echo "</td>";
          }
					*/
					?>
					<!--
					</tr>
					-->
			</table>
		<br><br>
		Jumlah Polis aktif dan Non Aktif Kantor <?=$kdkantor; ?><br>
		<?
		 $sql ="select ".
              "n.namacarabayar, ".
              "x.jmlpolisaktif,y.jmlpolisnonaktif ".
            "from ".
              "$DBUser.tabel_305_cara_bayar n,".
            "(select ".
               "c.namacarabayar,".
               "count(a.nopertanggungan) as jmlpolisaktif ".
            "from ".
               "$DBUser.tabel_200_pertanggungan a,".
               "$DBUser.tabel_500_penagih b,".
               "$DBUser.tabel_305_cara_bayar c ".
            "where ".
               "a.nopenagih=b.nopenagih and ".
               "a.kdcarabayar=c.kdcarabayar and ".
               "b.kdrayonpenagih='$kdkantor' and ".
               "a.kdcarabayar not in ('X','E','J','Q') and ".
               "a.kdstatusfile='1' ".
            "group by ".
               "c.namacarabayar) x,".
            "(select ".
               "c.namacarabayar,".
               "count(a.nopertanggungan) as jmlpolisnonaktif ".
            "from ".
               "$DBUser.tabel_200_pertanggungan a,".
               "$DBUser.tabel_500_penagih b,".
               "$DBUser.tabel_305_cara_bayar c ".
            "where ".
               "a.nopenagih=b.nopenagih and ".
               "a.kdcarabayar=c.kdcarabayar and ".
               "b.kdrayonpenagih='$kdkantor' and ".
               "a.kdcarabayar not in ('X','E','J','Q') and ".
               "a.kdstatusfile!='1' ".
            "group by ".
               "c.namacarabayar) y ".
            "where ".
              "n.namacarabayar=x.namacarabayar and ".
              "n.namacarabayar=y.namacarabayar ".
            "group by n.namacarabayar,x.jmlpolisaktif,y.jmlpolisnonaktif ".
						"order by n.namacarabayar";
					$DB->parse($sql);
					$DB->execute();				
          //$arr = $DB->nextrow();
					$v=1;
					?>
					<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" id="AutoNumber1">
            <tr>
              <td bgcolor="#DCF5F5">Cara Bayar</td>
              <td bgcolor="#DCF5F5">Aktif</td>
              <td bgcolor="#DCF5F5">Non Aktif</td>
            </tr>
            <?
						while ($ars = $DB->nextrow()) {
					  ?>
					  <tr>
              <td><?=$ars["NAMACARABAYAR"];?></td>
              <td align="right"><?=$ars["JMLPOLISAKTIF"];?></td>
              <td align="right"><?=$ars["JMLPOLISNONAKTIF"];?></td>
            </tr>
  				  <?		
  					}
  					?>
						<tr>
              <td>SEKALIGUS</td>
              <td align="right">
							<? 
							$sql = "select ".
                         "count(a.nopertanggungan) as jmlskgaktif ".
                      "from ".
                         "$DBUser.tabel_200_pertanggungan a,".
                         "$DBUser.tabel_500_penagih b,".
                         "$DBUser.tabel_305_cara_bayar c ".
                      "where ".
                         "a.nopenagih=b.nopenagih and ".
                         "a.kdcarabayar=c.kdcarabayar and ".
                         "b.kdrayonpenagih='$kdkantor' and ".
                         "a.kdcarabayar  in ('X','E','J') and ".
                         "a.kdstatusfile='1'";
							$DB->parse($sql);
							$DB->execute();	
							$art = $DB->nextrow();
							echo $art["JMLSKGAKTIF"];
							?>
							</td>
              <td align="right">
							<?
							$sql = "select ".
                         "count(a.nopertanggungan) as jmlskgnonaktif ".
                      "from ".
                         "$DBUser.tabel_200_pertanggungan a,".
                         "$DBUser.tabel_500_penagih b,".
                         "$DBUser.tabel_305_cara_bayar c ".
                      "where ".
                         "a.nopenagih=b.nopenagih and ".
                         "a.kdcarabayar=c.kdcarabayar and ".
                         "b.kdrayonpenagih='$kdkantor' and ".
                         "a.kdcarabayar  in ('X','E','J') and ".
                         "a.kdstatusfile!='1'";
							$DB->parse($sql);
							$DB->execute();	
							$art = $DB->nextrow();
							echo $art["JMLSKGNONAKTIF"];
							?>
							</td>
            </tr>
          </table>
