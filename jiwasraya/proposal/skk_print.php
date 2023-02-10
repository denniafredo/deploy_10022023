<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	//include "../../includes/pertanggungan.php"; 
	//include "../../includes/klien.php";
  $DB=New database($userid, $passwd, $DBName);	

	//$PER=New Pertanggungan($userid,$passwd,$kantor,$noproposal);
	//$KL=new Klien($userid,$passwd,$PER->notertanggung);
  $today = date("d F Y"); 

	$kantor = (!$_GET['prefix']) ? $kantor : $prefix;
 	$noproposal = $_GET['no_proposal'];
	$ul			= $_GET['ul'];
	
$sql="select ". 
          "a.notertanggung,a.kdproduk,substr(a.kdproduk,1,3) as kproduk, ".
					"b.namaklien1,".
					"decode(b.jeniskelamin,'L','Laki-laki','Perempuan') namajk, a.nopolbaru ".
		 "from ".
		      "$DBUser.tabel_200_pertanggungan a,".
					"$DBUser.tabel_100_klien b ".
     "where ".
		      "b.noklien=a.notertanggung and ". 
		      "a.prefixpertanggungan='$kantor' and a.nopertanggungan='$noproposal'";
//echo $sql;
$DB->parse($sql);
$DB->execute();
$ttg=$DB->nextrow();
$nomorttg=$ttg["NOTERTANGGUNG"];
$jslink = substr($ttg["KDPRODUK"],0,3);
$noklien=$ttg["NOTERTANGGUNG"];
$namaklien=$ttg["NAMAKLIEN1"];
$kproduk=$ttg["KPRODUK"];

?>
<html>
<head>
<title>Data Keluarga</title>
<!--<link href="../jws.css" rel="stylesheet" type="text/css">-->
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
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body onLoad="window.print();">
<!--      <input type="image" alt="Print" title="Print" src="../img/data_print.gif" onClick="window.print();" />
-->	  
	<b>SURAT KETERANGAN KESEHATAN</b>
	<table border="0" width="350" cellpadding="0" cellspacing="0">
	    <tr>
				  <td>Nomor Proposal</td>
				  <td align="center">:</td>
          <td><!--?echo $kantor." - ".$noproposal;?--><?=$ttg['NOPOLBARU']?></td><br>
				</tr>
        <tr>
					<td>Tanggal Entry</td>
					<td align="center">:</td>
          <td><?echo $today;?></td>
				</tr>
        <tr>
					<td>Tertanggung</td>
					<td align="center">:</td>
          <td align="left"><?=$ttg["NAMAKLIEN1"]; ?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
					<td align="center">:</td>
          <td align="left"><?=$ttg["NAMAJK"]; ?></td>
        </tr>				
      </table>
			<br />
      <table border="0" width="100%">
        <tr>
          <td>R I W A Y A T&nbsp;&nbsp;&nbsp;&nbsp;K E L U A R G A</td>
        </tr>
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
			
			<table border="1" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right" rowspan="2" ><b>No</td>
          <td align="center" rowspan="2" ><b>KELUARGA</td>
					<td align="center" colspan="4" ><b>MASIH HIDUP</td>
        	<td align="center" colspan="6" ><b>SUDAH MENINGGAL</td>
			  </tr>
				<tr>
					<td align="center">JML</td>
					<td align="left">KESEHATAN</td>
					<td align="center" colspan="2">UMUR</td>
					<td align="center" >JML</td>
					<td align="center" colspan="2">UMUR</td>
			  	<td align="left">SEBAB</td>
					<td align="center">TAHUN</td>
					<td align="center">LAMA SAKIT</td>
        </tr>
        <?
        	$sql="select ".
									"to_char(a.tglmeninggal,'DD/MM/YYYY') mati,a.sebabmeninggal,a.kdhubungan,b.namahubungan,a.jmlhidup,a.jmlmeninggal, ".
        			 		"a.keadaankesehatan,a.lamasakit,c.umurhidup1,c.umurhidup2,c.umurhidup3,c.umurhidup4,c.umurhidup5,c.umurhidup6, ".
        			 		"c.umurmati1,c.umurmati2,c.umurmati3,c.umurmati4,c.umurmati5,c.umurmati6 ".
        			 "from ".
							 		"$DBUser.tabel_116_riwayat_keluarga a,".
									"$DBUser.tabel_218_kode_hubungan b,".
									"$DBUser.tabel_117_umur_keluarga c ".
        			 "where ".
							 		"a.noklien='$nomorttg' ".
									"and a.kdhubungan=b.kdhubungan and a.noklien=c.noklien ".
									"and a.kdhubungan=c.kdhubungan";
          //echo $sql;
        	$DB->parse($sql);
        	$DB->execute();
        	$i=1;
        	while ($arz=$DB->nextrow()) {
        	$seda=substr($arz["MATI"],-4);
        	$hari =($arz["LAMASAKIT"]==0) ? '' : $arz["LAMASAKIT"]." hari";
            include "../../includes/belang.php";
        		echo "<td align=\"center\" class=\"arial10\">".$i.".</td>";
        		echo "<td align=\"left\" class=\"arial10\">".$arz["NAMAHUBUNGAN"]."&nbsp;</td>";
        		echo "<td align=\"center\" class=\"arial10blue\">".$arz["JMLHIDUP"]."&nbsp;</td>";
        		echo "<td align=\"left\" class=\"arial10\">".$arz["KEADAANKESEHATAN"]."&nbsp;</td>";
        		echo "<td align=\"center\" colspan=\"2\" class=\"arial10\">".$arz["UMURHIDUP1"]." ".$arz["UMURHIDUP2"]." ".$arz["UMURHIDUP3"]." ".$arz["UMURHIDUP4"]." ".$arz["UMURHIDUP5"]." ".$arz["UMURHIDUP6"]."&nbsp;</td>";
        		echo "<td align=\"center\" class=\"arial10blue\">".$arz["JMLMENINGGAL"]."&nbsp;</td>";
        		echo "<td align=\"center\" colspan=\"2\" class=\"arial10\">".$arz["UMURMATI1"]." ".$arz["UMURMATI2"]." ".$arz["UMURMATI3"]." ".$arz["UMURMATI4"]." ".$arz["UMURMATI5"]." ".$arz["UMURMATI6"]."&nbsp;</td>";
        		echo "<td align=\"left\" class=\"arial10\">".$arz["SEBABMENINGGAL"]."&nbsp;</td>";
        		echo "<td align=\"center\" class=\"arial10\">$seda&nbsp;</td>";
        		echo "<td align=\"center\" class=\"arial10\">".$hari."&nbsp;</td>";
        		echo "</tr>";
        		$i++;
        	}
        ?>
 		</table>
		
		<? 
		if($jslink == "JL2"){
		 $sql = "select adapengidap,namapengidap,jenispenyakit,usia from ".
		 				"$DBUser.tabel_116_penyakit_keturuan where noklien='$nomorttg'";
		 //echo $sql;
	   $DB->parse($sql);
		 $DB->execute();
     $row=$DB->nextrow();
	 
	 if ($ul==1){
    ?>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr valign="top">
      <td>a.</td>
		  <td>Apakah ada diantara ayah, ibu atau saudara kandung (hidup atau meninggal) 
          yang pernah menderita Diabetes, sakit jantung, tekanan darah tinggi, stroke, 
          sakit ginjal, kelainan mental, Hepatitis, kanker atau penyakit keturunan 
          lainnya? 
					<b><?=($row["ADAPENGIDAP"]=="Y" ? "Ya" : "Tidak");?></b>
    </tr>
		<tr>
		  <td valign="top">b.</td>
			<td>Jika ya, mohon dijelaskan :<br />
				  <table border="0" width="500">
          	<tr>
          		<td>Siapa</td>
          		<td>Jenis Penyakit</td>
          		<td>Usia</td>
          	</tr>
          	<tr>
          		<td><?=$row["NAMAPENGIDAP"];?></td>
          		<td><?=$row["JENISPENYAKIT"];?></td>
          		<td><?=$row["USIA"];?></td>
          	</tr>
          </table>
	  </td>	
		</tr>
  </table>
	<? } 
	
	}?>
	
	
	<!------------------------- skk 3b------------------->
  <br /><!--<br />-->
	<table border="0" width="100%">
        <tr>
          <td>R I W A Y A T&nbsp;&nbsp;&nbsp;&nbsp;K E S E H A T A N&nbsp;&nbsp;&nbsp;&nbsp;T E R T A N G G U N G</td>
			  </tr>
        <tr>
          <td><hr size="1"></td>
        </tr>
  </table>
  <table border="1" width="100%" cellpadding="0" cellspacing="0">
        <tr class="hijao">
					<td width="4%" align="right">No.</td>
					<td width="5%" align="center">Kode</td>
					<td width="18%" align="left">Nama Penyakit</td>
					<!--<td width="1%" align="center" style="border-left:none">&nbsp;</td>-->
					<td width="5%" align="center">Ket.</td>
					<td width="29%" align="left" >Nama Dokter</td>
					<td width="32%" align="left">Alamat Dokter</td>
				</tr>
      <?
		
      $sql="select ".
      					 "a.kodepenyakit, a.namapenyakit, ".
								 "b.kdstatussakit, b.namadokter, b.alamatdokter, ".
                 "decode(b.kdstatussakit,'Y','Ya','N','Tidak') statussakit,b.namapenyakitlain ".
      		 "from ".
					 			 "$DBUser.tabel_999_jenis_penyakit a, ".
								 "$DBUser.tabel_118_klien_penyakit b ".
      		 "where ".
					 			 "a.kodepenyakit=b.kodepenyakit(+) ".
								 "and b.noklien(+)='$noklien' ".
      		 "order by a.kodepenyakit";
			//echo $sql;
			$DB->parse ($sql);
      $DB->execute();
      $i=1;
      while ($arr=$DB->nextrow()) {
      	if ($arr["KDSTATUSSAKIT"]=='Y') {
      		include "../../includes/belang.php";
      		echo "<td width=\"4%\" class=\"arial10\" align=\"right\">".$i.".</td>";
      		echo "<td width=\"5%\" class=\"ver8ungu\" align=\"center\">".$arr["KODEPENYAKIT"]."&nbsp;</td>";
      		echo "<td width=\"18%\" class=\"ver8ungu\" align=\"left\">".$arr["NAMAPENYAKIT"]." ".($arr["KODEPENYAKIT"]==99 ? "<br /><i>(".$arr["NAMAPENYAKITLAIN"].")</i>" : "")."&nbsp;</td>";
      		//echo "<td width=\"1%\" class=\"ver8ungu\" align=\"center\">:&nbsp;</td>";
      		echo "<td width=\"5%\" class=\"arial8ab\" align=\"center\">".$arr["STATUSSAKIT"]."&nbsp;</td>";
      		echo "<td width=\"29%\" class=\"ver8ungu\" align=\"left\">".$arr["NAMADOKTER"]."&nbsp;</td>";
      		echo "<td width=\"32%\" class=\"ver8ungu\" align=\"left\">".$arr["ALAMATDOKTER"]."&nbsp;</td>";
      		echo "</tr>";
      	$i++;
      	}
      }
    /*  echo "<tr><td colspan=\"7\"> </td></tr>";*/
      
			$i=$i-1;
	  echo '</table>';
      if ($i==0) {
      	echo "<table border=0  width=100%><tr><td colspan=\"7\">Tidak Ada Penyakit, Tertanggung Sehat Jasmani!</td></tr></table>";
      }	else {
      	echo "<table border=0  width=100%><tr><td colspan=\"7\">Tertanggung Pernah Menderita $i Jenis Penyakit!!!</td></tr></table>";
      }
	
			echo '<br />';
			
			
			if ($ul==1) {?>
			<!------------------------------- skk3 unit link----------------->
			<!--table border="1" width="100%" cellpadding="2" cellspacing="0">
				<tr class="hijao">
					<td>Kode</td>
					<td>Nama Penyakit</td>
					<td>Keterangan</td>
					<td>Nama Penyakit</td>
					<td>Tgl. Sakit</td>
					<td>Nama Dokter</td>
					<td>Alamat Dokter</td>
				</tr-->
				<? 
				/*$sql = "select a.kditem, a.namaitem, b.kdstatus, b.keterangan,b.namadokter,b.alamatdokter,
							to_char(b.tglmutasi,'DD/MM/YYYY') as tglsakit 
						from $DBUser.tabel_999_item_kesehatan a, $DBUser.tabel_119_ket_kesehatan b 
						where a.kelompok='U' and a.kditem=b.kditem(+) and b.noklien(+)='$noklien' 
							and substr(a.kditem,0,2)='#2' 
							and a.kditem<>'#2' 
						order by a.kditem";
				$DB->parse ($sql);
				$DB->execute();
				//echo $sql; 
				
				$i=1;
				while ($arr=$DB->nextrow()) {
					include "../../includes/belang.php";	 
					echo "<td class=\"arial10\" align=\"center\" valign=top>".substr($arr["KDITEM"],2,1).".&nbsp;</td>";
					echo "<td class=\"arial10\" align=\"left\" width=400>".$arr["NAMAITEM"]."&nbsp;</td>";
					//	echo "<td class=\"arial8\" align=\"right\">:&nbsp;</td>";
					echo "<td class=\"arial8ab\" align=\"center\" nowrap>".($arr["KDSTATUS"]=='Y' ? "Ya" : "Tidak")."&nbsp;</td>";
					echo "<td class=\"arial8ab\" align=\"left\">".$arr["KETERANGAN"]."&nbsp;</td>";
					echo "<td class=\"arial8ab\" align=\"left\">".$arr["TGLSAKIT"]."&nbsp;</td>";
					echo "<td class=\"arial8ab\" align=\"left\">".$arr["NAMADOKTER"]."&nbsp;</td>";
					echo "<td class=\"arial8ab\" align=\"left\">".$arr["ALAMATDOKTER"]."&nbsp;</td>";
					echo "</tr>";
					$i++;
				}*/ ?>
			<!--/table-->
			<br />
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">Kode</td>
					<td width="45%" align="center">Pertanyaan</td>
					<td width="50%" align="center">Jawaban</td>
				</tr>
				<?
				$sql = "select a.kditem, a.namaitem, b.kdstatus, b.keterangan 
						from $DBUser.tabel_999_item_kesehatan a, $DBUser.tabel_119_ket_kesehatan b 
						where a.kelompok='U' and a.kditem=b.kditem and b.noklien='$noklien' 
							and substr(a.kditem,2,1) > '2' 
						order by a.kditem";
				//echo $sql;
				$DB->parse ($sql);
				$DB->execute();
				$i=1;
				while ($arr=$DB->nextrow()) {
					include "../../includes/belang.php";
					if (strlen($arr["KDITEM"])==2) {
						$kelas="arial10bold";
						$col=2;
						$align="right";
						$ket='';
					} else if (strlen($arr["KDITEM"])==3) {
						$kelas="arial10";
						$col='';
						$align="center";
						$ket=": ".($arr["KDSTATUS"]=="Y" ? "Ya": ($arr["KDSTATUS"]=='N' ? "Tidak" : $arr["KDSTATUS"]))."";
					} else if (strlen($arr["KDITEM"])==4) {
						$kelas="arial10";
						$col='';
						$align="right";
						$ket=": ".$arr["KETERANGAN"];
					}
					
					if(substr($arr["KDITEM"],0,2)=="*9") {
						$nomor = "10";
					} else {
						$nomor = substr($arr["KDITEM"],-1);
					}
        				
					echo "<td width=\"5%\" class=\"$kelas\" valign=top align=\"$align\">".(strlen($arr["KDITEM"])==2 ? "".$nomor."" : "")."&nbsp;&nbsp;</td>";
					echo "<td width=\"45%\" class=\"$kelas\" colspan=\"$col\">".(strlen($arr["KDITEM"])==4 ? "".substr($arr["KDITEM"],-1).".&nbsp;&nbsp;" : "")."".$arr["NAMAITEM"]."</td>";
					echo "<td width=\"50%\" class=\"$kelas\">$ket</td>";
					echo "</tr>";
					$i++;
				} ?>
			</table>
			<!---------------------------- skk4 unitlink---------------------------->
			
			<!---------------------------- skk4 tradisional ---------------------------->
			<? } else { ?>
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="5%" class="c" align="center">Kode</td>
					<td width="45%" class="c" align="center">Pertanyaan</td>
					<td width="50%" class="c" align="center">Jawaban</td>
				</tr>
				<?
				//if ($KLIEN->jeniskelamin=='L') {
				if ($jnskelamin=='L') {
				  $pria="and substr(b.kditem,0,1) in ('1','2','3')";
				} else {
				  $pria='';
				}
				$sql ="select distinct(b.kditem),(a.keterangan||decode(a.kdstatus,'Y','Ya','N','Tidak')) ket,b.namaitem ".
						 "from $DBUser.tabel_119_ket_kesehatan a, $DBUser.tabel_999_item_kesehatan b ".
						 "where a.kditem(+)=b.kditem and a.noklien(+)='$noklien' and ".
						 "a.keterangan||a.kdstatus is NOT NULL and a.keterangan||a.kdstatus!='N' ".
						 /*"union ".
						 "select distinct(b.kditem),(a.keterangan||decode(a.kdstatus,'Y','Ya','N','Tidak')) ket,b.namaitem ".
						 "from $DBUser.tabel_119_ket_kesehatan a, $DBUser.tabel_999_item_kesehatan b ".
						 "where a.kditem(+)=b.kditem and a.noklien(+)='$noklien' and ".
						 "b.kditem in ('1','2','3','4') ".
						 $pria.*/
						 "order by kditem ";
//				echo $sql;
				$DB->parse ($sql);
				$DB->execute();
				$i=1;
				while ($arr=$DB->nextrow()) {
					include "../../includes/belang.php";
					if (strlen($arr["KDITEM"])==1) {
						$kelas="arial10bold";
						$col=2;
						$align="left";
						$ket='';
					} else if (strlen($arr["KDITEM"])==2) {
						$kelas="arial10";
						$col='';
						$align="center";
						$ket=": ".$arr["KET"];
					} else if (strlen($arr["KDITEM"])==3) {
						$kelas="arial10";
						$col='';
						$align="right";
						$ket=": ".$arr["KET"];
					}
					echo "<td width=\"5%\" class=\"$kelas\" align=\"$align\">".$arr["KDITEM"]."&nbsp;&nbsp;</td>";
					echo "<td width=\"45%\" class=\"$kelas\" colspan=\"$col\">".$arr["NAMAITEM"]."&nbsp;</td>";
					echo "<td width=\"50%\" class=\"$kelas\">$ket&nbsp;</td>";
					echo "</tr>";
				$i++;
				}
				?>
							</table><p>&nbsp;</p>
					</td>
				  </tr>
				</table>
		<?
		}
		?>

</body>
</html>
