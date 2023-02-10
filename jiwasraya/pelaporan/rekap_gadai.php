<?  
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
  $DB = new Database($userid, $passwd, $DBName);
	?>
	<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
	<?
	
	if(!isset($kdkantor))
	{
	    $kdkantor = $kantor;
	    $filter = "and c.kdrayonpenagih='$kdkantor' ";
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
		  $filter = "and c.kdrayonpenagih='$kdkantor' ";
			$judul  = "KANTOR $kdkantor";
		}
	}
	
	if(!isset($kdstatus) || $kdstatus=="all")
	{
	 $filterstt = "";
	}
	else
	{
	  $filterstt = "and d.status='$kdstatus' ";
	}
	
#---------------------------------------------- start navigasi -----------------

echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\"> ";
echo "         Kantor <select size=1 name=kdkantor>";
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

echo "      <td class=\"verdana9blk\"> ";
echo "         <select size=1 name=kdstatus>";
echo "				 <option value=all>SEMUA STATUS</option>";
               $sql="select kdstatus,namastatus from $DBUser.tabel_999_kode_status ".
							 			"where jenisstatus='GADAI' and kdstatus<>'5' order by kdstatus";
							 $DB->parse($sql);
							 $DB->execute();	
							 while($ro=$DB->nextrow()){
							       echo "<option ";
    								 if ($ro["KDSTATUS"]==$kdstatus){ echo " selected"; }
    								 echo " value=".$ro["KDSTATUS"].">".$ro["NAMASTATUS"]."</option>";
							 }
							 
echo "         </select>";							 	
echo "      </td>";

echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------
   $sql ="select ".
	 						"a.prefixpertanggungan,a.nopertanggungan,a.lamagadai,a.pokokpinjaman,a.sisapolalama,a.bungapolalama,".
							"b.nopol,b.kdvaluta,c.kdrayonpenagih,d.tglmohon,to_char(d.tglgadai,'DD/MM/YYYY') as tgl_gadai,d.status, ".
							"(select namaklien1 from $DBUser.tabel_100_klien where noklien= b.notertanggung) as namattg, ".
							"(select namastatus from $DBUser.tabel_999_kode_status where kdstatus=a.status and jenisstatus='GADAI') as namastatus ".
          "from ".
              "$DBUser.tabel_700_gadai a, ".
              "$DBUser.tabel_200_pertanggungan b, ".
              "$DBUser.tabel_500_penagih c, ".
              "$DBUser.tabel_700_gadai d ".
          "where ". 
              "a.prefixpertanggungan=b.prefixpertanggungan ". 
              "and a.nopertanggungan=b.nopertanggungan  ".
              "and a.prefixpertanggungan=d.prefixpertanggungan ". 
              "and a.nopertanggungan=d.nopertanggungan  ".
              "and b.kdstatusfile='1' ".
              "and b.nopenagih=c.nopenagih ".  
              $filter .
							$filterstt .
              "and d.status!='5' ".
					"order by d.tglgadai desc";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();	
	

?>	
<b>REKAPITULASI POLIS GADAI <?=$judul;?></b>
<table border="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="2" bordercolor="#A3B3F3">
	<tr>
		<td bgcolor="#C0C8F8"><b>No.</b></td>
		<td bgcolor="#C0C8F8"><b>No. Polis</b></td>
		<td bgcolor="#C0C8F8"><b>No.Polis Lama</b></td>
		<td bgcolor="#C0C8F8"><b>Nama Tertanggung</b></td>
		<td bgcolor="#C0C8F8"><b>Tgl.Gadai</b></td>
		<td bgcolor="#C0C8F8" align="right"><b>Lama (Bln)</b></td>
		<td bgcolor="#C0C8F8"><b>Valuta</b></td>
		<td bgcolor="#C0C8F8" align="right"><b>Pokok Pinjm.</b></td>
		<td bgcolor="#C0C8F8" align="right"><b>Gadai Lama</b></td>
		<td bgcolor="#C0C8F8" align="right"><b>Bunga G. Lama</b></td>
		<td bgcolor="#C0C8F8"><b>Status</b></td>
	</tr>
	<? 
	$i=1;
	while($row=$DB->nextrow()){
	echo ($i%2)? "<tr>" : "<tr bgcolor=#CEE7FF>";
	?>
		<td><?=$i;?></td>
		<td><?="<a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$row["PREFIXPERTANGGUNGAN"]."&noper=".$row["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"]."</a>";?></td>
		<td><?=$row["NOPOL"];?></td>
		<td><?=$row["NAMATTG"];?></td>
		<td><?=$row["TGL_GADAI"];?></td>
		<td align="right"><?=$row["LAMAGADAI"];?></td>
		<td><?=$row["KDVALUTA"];?></td>
		<td align="right"><?=number_format($row["POKOKPINJAMAN"],2,",",".");?></td>
		<td align="right"><?=$row["SISAPOLALAMA"]=="" ? "" : number_format($row["SISAPOLALAMA"],2,",",".");?></td>
		<td align="right"><?=$row["BUNGAPOLALAMA"]=="" ? "" : number_format($row["BUNGAPOLALAMA"],2,",",".");?></td>
		<td><?=substr($row["NAMASTATUS"],0,18);?>...</td>
	</tr>
	<?
	$i++; 
	}
	?>
</table>
<br />
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
