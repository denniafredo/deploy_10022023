<?
	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date.php";
	//include "../../includes/dropdown_date.php";
 

	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
?>
<html>

<head>
<title>Tagihan Pelunasan</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<!--b><font size="3">TAGIHAN VS PELUNASAN</font></b-->
<h2>TAGIHAN VS PELUNASAN</h2>

<?php

$sql="select max(TGL_GENERATE) TGL_GENERATE
	  from $DBUser.HIST_GEN_TAGIHAN_PELUNASAN";
	  
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	
	$row=$DB->nextrow()
?>

<h4>Data Digenerate pada <?=$row["TGL_GENERATE"];?></h4>

<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<?php

$sql="select kdkantor
	  from $DBUser.tabel_001_kantor
	  start with kdkantor = '$kantor'
	  connect by prior kdkantor = kdkantorINDUK ";
	  
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	
?>
	<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
		<tr>
			<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(5,"Future");?>				
				<select name='wilayah'>
				<?php
				while ($row=$DB->nextrow()) {				
				?>					
					<option><?=$row["KDKANTOR"];?></option>		        					
				<? 
				$i++;

				}
				?>					
				</select>
				<input type="submit" name="submit" value="GO" class="but">
				<? //echo $sqa;?>
				</td>
		</tr>
	</table>
<?
if ($carabayar=='B') {$cara=" and a.kdcarabayar in ('1','M') ";}
elseif ($carabayar=='K') {$cara=" and a.kdcarabayar in ('2','Q') ";}
elseif ($carabayar=='S') {$cara=" and a.kdcarabayar in ('3','H') ";}
elseif ($carabayar=='T') {$cara=" and a.kdcarabayar in ('4','A') ";}
elseif ($carabayar=='E') {$cara=" and a.kdcarabayar in ('E') ";}
elseif ($carabayar=='J') {$cara=" and a.kdcarabayar in ('J') ";}
?>
</form>
<?
if ($submit){
//$conn=ocilogon("JSADM","JSADMABC","GLABC"); 
//echo $day;
if(!isset($month))
{
//  $tglcari = date('Ymd');
//  $tglcari = date('Ym');
  $tglcari = date('m/Y');
}
else
{
//  $tglcari = $year.$month;
  $tglcari = $month.'/'.$year;
}
						  
$sql="
  SELECT   SD.kdrayonpenagih,           
           SD.NAMACARABAYAR,
           TM.TAG_NB TM_TAG_NB,
           TM.TAG_OB TM_TAG_OB,
           TM.LNS_NB TM_LNS_NB,
           TM.LNS_OB TM_LNS_OB,
           SD.TAG_NB SD_TAG_NB,
           SD.TAG_OB SD_TAG_OB,
           SD.LNS_NB SD_LNS_NB,
           SD.LNS_OB SD_LNS_OB
    FROM   (  SELECT   kdrayonpenagih,                       
                       NAMACARABAYAR,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN ELSE 0 END)
                          TAG_NB,
                       SUM (
                          CASE WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN) ELSE 0 END
                       )
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   kdrayonpenagih,                                   
                                   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR,
                                   /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (JMLNILAIRP) PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   KDRAYONPENAGIH IN
                                         (select kdkantor
										  from $DBUser.tabel_001_kantor
										  start with kdkantor = '".$wilayah."'
										  connect by prior kdkantor = kdkantorINDUK)
                                   AND kdstatusfile = '1'
								   AND TO_CHAR (TGLBOOKED, 'MM/YYYY') = '".$tglcari."'
                        GROUP BY   kdrayonpenagih,                                   
                                   KDCARABAYAR,
                                   KDKUITANSI)
            GROUP BY   kdrayonpenagih, NAMACARABAYAR) TM,
           (  SELECT   kdrayonpenagih,                       
                       NAMACARABAYAR,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN ELSE 0 END)
                          TAG_NB,
                       SUM (
                          CASE WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN) ELSE 0 END
                       )
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   kdrayonpenagih,
                                   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR,
                                   /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (JMLNILAIRP) PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   KDRAYONPENAGIH IN
                                         (select kdkantor
										  from $DBUser.tabel_001_kantor
										  start with kdkantor = '".$wilayah."'
										  connect by prior kdkantor = kdkantorINDUK)
                                   AND kdstatusfile = '1'
								   AND TGLBOOKED <=
                                         LAST_DAY (TO_DATE ('".$tglcari."', 'MM/YYYY'))
                        GROUP BY   kdrayonpenagih,
                                   KDCARABAYAR,
                                   KDKUITANSI)
            GROUP BY   kdrayonpenagih, NAMACARABAYAR) SD
   WHERE       SD.KDRAYONPENAGIH = TM.KDRAYONPENAGIH(+)
           AND SD.NAMACARABAYAR = TM.NAMACARABAYAR(+)
ORDER BY   kdrayonpenagih,  NAMACARABAYAR";
			 echo $sql."<br/><br/>"; 
			 die;
?>

<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center" rowspan="2"><b>No</b></td>
		<td align="center" rowspan="2"><b>Kantor</b></td>		
        <td align="center" rowspan="2"><b>Cara bayar</b></td>        
        <td align="center" colspan="2"><b>Tagihan<br>Bln Ini</b></td>
        <td align="center" colspan="2"><b>Tagihan<br>S.D.</b></td>
        <td align="center" colspan="2"><b>Pelunasan<br>Bln Ini</b></td>
        <td align="center" colspan="2"><b>Pelunasan<br>S.D.</b></td>
        <td align="center" colspan="2"><b>Saldo<br>Akhir</b></td>
		
    </tr>
    <tr bgcolor="#b1c8ed">        		
        <td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
		<td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
		<td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td><td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td><td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
	</tr>
	<?
	
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td align="center"><?=$row["KDRAYONPENAGIH"];?></td>		        
        <td align="center"><?=$row["NAMACARABAYAR"];?></td>        	
        <td align="right"><?=number_format($row["TM_TAG_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_TAG_OB"],2,",",".");?>        
		<td align="right"><?=number_format($row["SD_TAG_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["SD_TAG_OB"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_LNS_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_LNS_OB"],2,",",".");?>        
		<td align="right"><?=number_format($row["SD_LNS_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["SD_LNS_OB"],2,",",".");?>        
        <td align="right"><?=number_format(($row["SD_TAG_NB"])-($row["SD_LNS_NB"]),2,",",".");?>
        <td align="right"><?=number_format(($row["SD_TAG_OB"])-($row["SD_LNS_OB"]),2,",",".");?>
	</tr>
	<? 
	$i++;

	}
$sql="
  SELECT   SD.NAMACARABAYAR,
           TM.TAG_NB TM_TAG_NB,
           TM.TAG_OB TM_TAG_OB,
           TM.LNS_NB TM_LNS_NB,
           TM.LNS_OB TM_LNS_OB,
           SD.TAG_NB SD_TAG_NB,
           SD.TAG_OB SD_TAG_OB,
           SD.LNS_NB SD_LNS_NB,
           SD.LNS_OB SD_LNS_OB
    FROM   (  SELECT   NAMACARABAYAR,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN ELSE 0 END)
                          TAG_NB,
                       SUM (
                          CASE WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN) ELSE 0 END
                       )
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR,
                                   /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (JMLNILAIRP) PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   KDRAYONPENAGIH IN
                                         (select kdkantor
										  from $DBUser.tabel_001_kantor
										  start with kdkantor = '".$wilayah."'
										  connect by prior kdkantor = kdkantorINDUK)
                                   and kdstatusfile = '1'
								   AND TO_CHAR (TGLBOOKED, 'MM/YYYY') = '".$tglcari."'
                        GROUP BY   KDCARABAYAR, KDKUITANSI)
            GROUP BY   NAMACARABAYAR) TM,
           (  SELECT   NAMACARABAYAR,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN ELSE 0 END)
                          TAG_NB,
                       SUM (
                          CASE WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN) ELSE 0 END
                       )
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR,
                                   /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (JMLNILAIRP) PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   KDRAYONPENAGIH IN
                                         (select kdkantor
										  from $DBUser.tabel_001_kantor
										  start with kdkantor = '".$wilayah."'
										  connect by prior kdkantor = kdkantorINDUK)
                                   and kdstatusfile = '1'
								   AND TGLBOOKED <=
                                         LAST_DAY (TO_DATE ('".$tglcari."', 'MM/YYYY'))
                        GROUP BY   KDCARABAYAR, KDKUITANSI)
            GROUP BY   NAMACARABAYAR) SD
   WHERE   SD.NAMACARABAYAR = TM.NAMACARABAYAR(+)
   ORDER BY   SD.NAMACARABAYAR";
			 //echo $sql."<br/><br/>";
			 //die;
	
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td colspan='2'></td>		
        <td><strong><?=$row["NAMACARABAYAR"];?></strong></td>        	
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini.php?jenis=TM_TAG&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["TM_TAG_NB"],2,",",".");?></a></strong></td>
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini.php?jenis=TM_TAG&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["TM_TAG_OB"],2,",",".");?></a></strong></td>        
		<!--td align="right"><strong><?=number_format($row["SD_TAG_NB"],2,",",".");?></strong></td-->        
		<td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini.php?jenis=SD_TAG&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["SD_TAG_NB"],2,",",".");?></a></strong></td>        
        <!--td align="right"><strong><?=number_format($row["SD_TAG_OB"],2,",",".");?></strong></td-->        
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini.php?jenis=SD_TAG&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["SD_TAG_OB"],2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini.php?jenis=TM_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["TM_LNS_NB"],2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini.php?jenis=TM_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["TM_LNS_OB"],2,",",".");?></a></strong></td>        
		<!--td align="right"><strong><?=number_format($row["SD_LNS_NB"],2,",",".");?></strong></td-->        
		<td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini.php?jenis=SD_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["SD_LNS_NB"],2,",",".");?></a></strong></td>        
        <!--td align="right"><strong><?=number_format($row["SD_LNS_OB"],2,",",".");?></strong></td-->        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini.php?jenis=SD_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format($row["SD_LNS_OB"],2,",",".");?></a></strong></td>        

        <td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini.php?jenis=SD_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format(($row["SD_TAG_NB"])-($row["SD_LNS_NB"]),2,",",".");?></a></strong></td>        
        <!--td align="right"><strong><?=number_format(($row["SD_TAG_NB"])-($row["SD_LNS_NB"]),2,",",".");?></strong></td-->
        <td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini.php?jenis=SD_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=number_format(($row["SD_TAG_OB"])-($row["SD_LNS_OB"]),2,",",".");?></a></strong></td>                
        <!--td align="right"><strong><?=number_format(($row["SD_TAG_OB"])-($row["SD_LNS_OB"]),2,",",".");?></strong></td-->
	</tr>
	<? 
	$i++;

	}
	?>
	
</table>
<br />


</form>
<?
}
?>
<script language="JavaScript" type="text/javascript">
	<!--
	function popitup(url) {
		newwindow=window.open(url,'name','height=850,width=1200, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,');
		if (window.focus) {newwindow.focus()}
		return false;
	}
</script>	
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>