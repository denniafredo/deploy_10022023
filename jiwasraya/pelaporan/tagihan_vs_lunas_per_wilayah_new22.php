<?
//echo "<h1>mohon maaf sedang ada perbaikan,mohon ditunggu,terima kasih.</h1>";
//die;

	include "../../includes/session.php";
	//include "../../includes/common.php";
	include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date_desc.php";
	//include "../../includes/dropdown_date.php";
 

	$DB=new database($userid, $passwd, $DBName);
	//$DB1=new database($userid, $passwd, $DBName);
	//$DB2=new Database($userid,$passwd,"192.168.3.55:1521/jlindo1");
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

$sql="select max(TGL_GENERATE) TGL_GENERATE,
			 to_char(trunc(CASE WHEN '".$month.'/'.$year."' = TO_CHAR(SYSDATE,'MM/YYYY') THEN	
				SYsDATE - 1
			 ELSE
				LAST_DAY(TO_DATE('".$month.'/'.$year."','MM/YYYY')	)
			 END),'dd/mm/yyyy') KONDISI,
			 CASE WHEN '".$month.'/'.$year."' = TO_CHAR(SYSDATE,'MM/YYYY') THEN	
				'NOW'
			 ELSE
				'BEF'	
			 END PILIH
	  from $DBUser.HIST_GEN_TAGIHAN_PELUNASAN";
	  
	$DB->parse($sql);
    $DB->execute();
	
	$row=$DB->nextrow();
	//echo $sql;	
	$newfilter = $row["KONDISI"];
	$pilih = $row["PILIH"];
?>

<h4>Data Digenerate pada <?=$newfilter;?></h4>

<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<?php

if($kantor=='KN'){
	$sql="select '$kantor' kdkantor
		  from dual";
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	  
}elseif($kantor=='KP'){
	$sql="select kdkantor
		  from $DBUser.tabel_001_kantor
		  start with kdkantor = '$kantor'
		  connect by prior kdkantor = kdkantorINDUK
		  union all 
		  select 'KN' kdkantor
		  from dual";
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	  
}else{
	$sql="select kdkantor
		  from $DBUser.tabel_001_kantor
		  start with kdkantor = '$kantor'
		  connect by prior kdkantor = kdkantorINDUK ";
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	  
} 
	  
		
?>
	<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
		<tr>
			<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(2,"Both");?>				
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
  $tglcari = date('m/Y');
  $tglcarix = date('mY');
}
else
{
//  $tglcari = $year.$month;
  $tglcari = $month.'/'.$year;
  $tglcarix = $month.$year;
}
//die;
if($wilayah=='KP'){
	$filterkantorx = "
	AND KDRAYONPENAGIH IN
		( SELECT   kdkantor
			FROM   $DBUser.tabel_001_kantor
		 START WITH   kdkantor = '".$wilayah."'
		 CONNECT BY   PRIOR kdkantor =
					  kdkantorINDUK
		union all 
		select 'KN' kdkantor
		from dual)";
	$filterkantor = "";	
}else{								  
	$filterkantor = "
	AND KDRAYONPENAGIH IN
		( SELECT   kdkantor
			FROM   $DBUser.tabel_001_kantor
	  START WITH   kdkantor = '".$wilayah."'
	  CONNECT BY   PRIOR kdkantor =
					  kdkantorINDUK)";
}								  


 $sql1 = "  SELECT   SD.kdrayonpenagih,
           SD.NAMACARABAYAR,
           TM.TAG_BP TM_TAG_BP,
           TM.TAG_NB TM_TAG_NB,
           TM.TAG_OB TM_TAG_OB,
           TM.LNS_BP TM_LNS_BP,
           TM.LNS_NB TM_LNS_NB,
           TM.LNS_OB TM_LNS_OB,
           SD.TAG_BP SD_TAG_BP,
           SD.TAG_NB SD_TAG_NB,
           SD.TAG_OB SD_TAG_OB,
           SD.LNS_BP SD_LNS_BP,
           SD.LNS_NB SD_LNS_NB,
           SD.LNS_OB SD_LNS_OB
    FROM   (  SELECT   kdrayonpenagih,
                       NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP,
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,   
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   kdrayonpenagih,
                                   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tag_vs_pel_new_$tglcarix a
                           WHERE   kdstatusfile = '1'
                                   ".$filterkantor."
								   AND TO_CHAR (TGLBOOKED, 'MM/YYYY') = '".$tglcari."'
                                   /*AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY'))*/
								   AND to_char(TGLGENERATE,'DD/MM/YYYY') = '".$newfilter."'
                        GROUP BY   kdrayonpenagih, KDCARABAYAR, KDKUITANSI)
            GROUP BY   kdrayonpenagih, NAMACARABAYAR) TM,
           (  SELECT   kdrayonpenagih,
                       NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP,
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN)
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,   
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   kdrayonpenagih,
                                   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tag_vs_pel_new_$tglcarix a
                           WHERE   kdstatusfile = '1'
								   ".$filterkantor."		
								   AND TGLBOOKED <=
                                         LAST_DAY (TO_DATE ('".$tglcari."', 'MM/YYYY'))
                                   /* AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY')) */
								   AND to_char(TGLGENERATE,'DD/MM/YYYY') = '".$newfilter."'
                        GROUP BY   kdrayonpenagih, KDCARABAYAR, KDKUITANSI)
            GROUP BY   kdrayonpenagih, NAMACARABAYAR) SD
   WHERE   SD.KDRAYONPENAGIH = TM.KDRAYONPENAGIH(+)
           AND SD.NAMACARABAYAR = TM.NAMACARABAYAR(+)
ORDER BY   kdrayonpenagih, NAMACARABAYAR";
			 //echo $sql."<br/><br/>"; 
			 //die;

			 
			 
	$sql2 = "  SELECT   SD.kdrayonpenagih,
           SD.NAMACARABAYAR,
           TM.TAG_BP TM_TAG_BP,
           TM.TAG_NB TM_TAG_NB,
           TM.TAG_OB TM_TAG_OB,
           TM.LNS_BP TM_LNS_BP,
           TM.LNS_NB TM_LNS_NB,
           TM.LNS_OB TM_LNS_OB,
           SD.TAG_BP SD_TAG_BP,
           SD.TAG_NB SD_TAG_NB,
           SD.TAG_OB SD_TAG_OB,
           SD.LNS_BP SD_LNS_BP,
           SD.LNS_NB SD_LNS_NB,
           SD.LNS_OB SD_LNS_OB
    FROM   (  SELECT   kdrayonpenagih,
                       NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP,
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN)
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,   
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   kdrayonpenagih,
                                   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   kdstatusfile = '1'
                                   ".$filterkantor."
								   AND TO_CHAR (TGLBOOKED, 'MM/YYYY') = '".$tglcari."'
                                   /*AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY'))*/
                        GROUP BY   kdrayonpenagih, KDCARABAYAR, KDKUITANSI)
            GROUP BY   kdrayonpenagih, NAMACARABAYAR) TM,
           (  SELECT   kdrayonpenagih,
                       NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP,
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN)
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,   
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   kdrayonpenagih,
                                   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   kdstatusfile = '1' 
									".$filterkantor."                                   
								   AND TGLBOOKED <=
                                         LAST_DAY (TO_DATE ('".$tglcari."', 'MM/YYYY'))
                                   /*AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY'))*/
                        GROUP BY   kdrayonpenagih, KDCARABAYAR, KDKUITANSI)
            GROUP BY   kdrayonpenagih, NAMACARABAYAR) SD
   WHERE   SD.KDRAYONPENAGIH = TM.KDRAYONPENAGIH(+)
           AND SD.NAMACARABAYAR = TM.NAMACARABAYAR(+)
ORDER BY   kdrayonpenagih, NAMACARABAYAR";
			 
if ($pilih=='NOW'){
	$sql = $sql2;
	$DB->parse($sql);
    $DB->execute();
	
}else{
	$sql = $sql1;
	$DB->parse($sql);
    $DB->execute();
	
}	
//echo $pilih;
//echo $sql; die;
?>

<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center" rowspan="2"><b>No</b></td>
		<td align="center" rowspan="2"><b>Kantor</b></td>		
        <td align="center" rowspan="2"><b>Cara bayar</b></td>        
        <td align="center" colspan="3"><b>Tagihan<br>Bln Ini</b></td>
        <td align="center" colspan="3"><b>Tagihan<br>S.D.</b></td>
        <td align="center" colspan="3"><b>Pelunasan<br>Bln Ini</b></td>
        <td align="center" colspan="3"><b>Pelunasan<br>S.D.</b></td>
        <td align="center" colspan="3"><b>Saldo<br>Akhir</b></td>
		
    </tr>
    <tr bgcolor="#b1c8ed">        		
        <td align="center"><b>BP</b></td>
        <td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
		<td align="center"><b>BP</b></td>
		<td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
		<td align="center"><b>BP</b></td>
		<td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
		<td align="center"><b>BP</b></td>
		<td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
		<td align="center"><b>BP</b></td>
		<td align="center"><b>NB</b></td>
        <td align="center"><b>OB</b></td>
	</tr>
	<?
	
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td align="center"><?=$row["KDRAYONPENAGIH"];?></td>		        
        <td align="center"><?=$row["NAMACARABAYAR"];?></td>        	
        <td align="right"><?=number_format($row["TM_TAG_BP"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_TAG_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_TAG_OB"],2,",",".");?>        
		<td align="right"><?=number_format($row["SD_TAG_BP"],2,",",".");?>        
		<td align="right"><?=number_format($row["SD_TAG_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["SD_TAG_OB"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_LNS_BP"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_LNS_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["TM_LNS_OB"],2,",",".");?>        
		<td align="right"><?=number_format($row["SD_LNS_BP"],2,",",".");?>        
		<td align="right"><?=number_format($row["SD_LNS_NB"],2,",",".");?>        
        <td align="right"><?=number_format($row["SD_LNS_OB"],2,",",".");?>        
        <td align="right"><?=number_format(($row["SD_TAG_BP"])-($row["SD_LNS_BP"]),2,",",".");?>
        <td align="right"><?=number_format(($row["SD_TAG_NB"])-($row["SD_LNS_NB"]),2,",",".");?>
        <td align="right"><?=number_format(($row["SD_TAG_OB"])-($row["SD_LNS_OB"]),2,",",".");?>
	</tr>
	<? 
	$i++;

	}
$sql1 = "SELECT   SD.NAMACARABAYAR,
           TM.TAG_BP TM_TAG_BP, 
           TM.TAG_NB TM_TAG_NB,
           TM.TAG_OB TM_TAG_OB,
           TM.LNS_BP TM_LNS_BP,
           TM.LNS_NB TM_LNS_NB,
           TM.LNS_OB TM_LNS_OB,
           SD.TAG_BP SD_TAG_BP,
           SD.TAG_NB SD_TAG_NB,
           SD.TAG_OB SD_TAG_OB,
           SD.LNS_BP SD_LNS_BP,
           SD.LNS_NB SD_LNS_NB,
           SD.LNS_OB SD_LNS_OB
    FROM   (  SELECT   NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP, 
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN)
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tag_vs_pel_new_$tglcarix a
                           WHERE   kdstatusfile = '1'
                           		   $filterkantor
								   AND TO_CHAR (TGLBOOKED, 'MM/YYYY') = '".$tglcari."'  
								   /*AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY')) */
								   /* AND to_char(TGLGENERATE,'dd/mm/yyyy') = '".$newfilter."'*/
                        GROUP BY   KDCARABAYAR, KDKUITANSI)
            GROUP BY   NAMACARABAYAR) TM,
           (  SELECT   NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP,  
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN)
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tag_vs_pel_new_$tglcarix a
                           WHERE   kdstatusfile = '1'
                           		   $filterkantor
								   AND TGLBOOKED <=
                                   LAST_DAY (TO_DATE ('".$tglcari."', 'MM/YYYY')) 
                                   /*AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY')) */                                        
								   /*AND to_char(TGLGENERATE,'dd/mm/yyyy') = '".$newfilter."'                                       */
                        GROUP BY   KDCARABAYAR, KDKUITANSI)
            GROUP BY   NAMACARABAYAR) SD
   WHERE   SD.NAMACARABAYAR = TM.NAMACARABAYAR(+)
ORDER BY   SD.NAMACARABAYAR";
			 //echo $sql."<br/><br/>";
			 //die;


$sql2 = "SELECT   SD.NAMACARABAYAR,
           TM.TAG_BP TM_TAG_BP, 
           TM.TAG_NB TM_TAG_NB,
           TM.TAG_OB TM_TAG_OB,
           TM.LNS_BP TM_LNS_BP,
           TM.LNS_NB TM_LNS_NB,
           TM.LNS_OB TM_LNS_OB,
           SD.TAG_BP SD_TAG_BP,
           SD.TAG_NB SD_TAG_NB,
           SD.TAG_OB SD_TAG_OB,
           SD.LNS_BP SD_LNS_BP,
           SD.LNS_NB SD_LNS_NB,
           SD.LNS_OB SD_LNS_OB
    FROM   (  SELECT   NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP, 
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN)
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   kdstatusfile = '1'
                           		   $filterkantor
								   AND TO_CHAR (TGLBOOKED, 'MM/YYYY') = '".$tglcari."'
                                   /*AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY'))*/
                        GROUP BY   KDCARABAYAR, KDKUITANSI)
            GROUP BY   NAMACARABAYAR) TM,
           (  SELECT   NAMACARABAYAR,
                       SUM(CASE
                              WHEN KDKUITANSI = 'BP' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_BP,  
                       SUM(CASE
                              WHEN KDKUITANSI = 'NB' THEN PREMITAGIHAN
                              ELSE 0
                           END)
                          TAG_NB,
                       SUM(CASE
                              WHEN KDKUITANSI = 'OB' THEN (PREMITAGIHAN)
                              ELSE 0
                           END)
                          TAG_OB,
                       SUM (CASE WHEN KDKUITANSI = 'BP' THEN (lunas) ELSE 0 END)
                          LNS_BP,
                       SUM (CASE WHEN KDKUITANSI = 'NB' THEN (lunas) ELSE 0 END)
                          LNS_NB,
                       SUM (CASE WHEN KDKUITANSI = 'OB' THEN (lunas) ELSE 0 END)
                          LNS_OB
                FROM   (  SELECT   (SELECT   NAMACARABAYAR
                                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                                     WHERE   KDCARABAYAR = a.KDCARABAYAR)
                                      NAMACARABAYAR, /*SUM (PREMITAGIHAN) PREMITAGIHAN,*/
                                   SUM (
                                      JMLNILAIRP
                                   )
                                      PREMITAGIHAN,
                                   SUM (LUNAS) lunas,
                                   KDKUITANSI
                            FROM   $DBUser.tagihan_vs_pelunasan a
                           WHERE   kdstatusfile = '1'
                           		   $filterkantor
								   AND TGLBOOKED <=
                                         LAST_DAY (TO_DATE ('".$tglcari."', 'MM/YYYY'))
                                   /*AND TGLGENERATE = (TO_DATE ('".$newfilter."', 'DD/MM/YYYY'))*/                                         
                        GROUP BY   KDCARABAYAR, KDKUITANSI)
            GROUP BY   NAMACARABAYAR) SD
   WHERE   SD.NAMACARABAYAR = TM.NAMACARABAYAR(+)
ORDER BY   SD.NAMACARABAYAR";

if ($pilih=='NOW'){
	$sql = $sql2;
}else{
	$sql = $sql1;
}	
//echo $sql;die;
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td colspan='2'></td>		
        <td><strong><?=$row["NAMACARABAYAR"];?></strong></td>        	
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini22.php?jenis=TM_TAG&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["TM_TAG_BP"],2,",",".");?></a></strong></td>
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini22.php?jenis=TM_TAG&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["TM_TAG_NB"],2,",",".");?></a></strong></td>
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini22.php?jenis=TM_TAG&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["TM_TAG_OB"],2,",",".");?></a></strong></td>        
		<!--td align="right"><strong><?=number_format($row["SD_TAG_NB"],2,",",".");?></strong></td-->        
		<td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini22.php?jenis=SD_TAG&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["SD_TAG_BP"],2,",",".");?></a></strong></td>        
		<td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini22.php?jenis=SD_TAG&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["SD_TAG_NB"],2,",",".");?></a></strong></td>        
        <!--td align="right"><strong><?=number_format($row["SD_TAG_OB"],2,",",".");?></strong></td-->        
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini22.php?jenis=SD_TAG&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["SD_TAG_OB"],2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini22.php?jenis=TM_LNS&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["TM_LNS_BP"],2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini22.php?jenis=TM_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["TM_LNS_NB"],2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini22.php?jenis=TM_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["TM_LNS_OB"],2,",",".");?></a></strong></td>        
		<!--td align="right"><strong><?=number_format($row["SD_LNS_NB"],2,",",".");?></strong></td-->        
		<td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["SD_LNS_BP"],2,",",".");?></a></strong></td>        
		<td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["SD_LNS_NB"],2,",",".");?></a></strong></td>        
        <!--td align="right"><strong><?=number_format($row["SD_LNS_OB"],2,",",".");?></strong></td-->        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format($row["SD_LNS_OB"],2,",",".");?></a></strong></td>        

        <td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format(($row["SD_TAG_BP"])-($row["SD_LNS_BP"]),2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format(($row["SD_TAG_NB"])-($row["SD_LNS_NB"]),2,",",".");?></a></strong></td>        
        <!--td align="right"><strong><?=number_format(($row["SD_TAG_NB"])-($row["SD_LNS_NB"]),2,",",".");?></strong></td-->
        <td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=<?=$pilih;?>&month=<?=$tglcarix;?>')"><?=number_format(($row["SD_TAG_OB"])-($row["SD_LNS_OB"]),2,",",".");?></a></strong></td>                
        <!--td align="right"><strong><?=number_format(($row["SD_TAG_OB"])-($row["SD_LNS_OB"]),2,",",".");?></strong></td-->
	</tr>
	<? 
	$JML_TM_TAG_BP += $row["TM_TAG_BP"];
    $JML_TM_TAG_NB += $row["TM_TAG_NB"];
    $JML_TM_TAG_OB += $row["TM_TAG_OB"];

	$JML_SD_TAG_BP += $row["SD_TAG_BP"];
	$JML_SD_TAG_NB += $row["SD_TAG_NB"];

    $JML_SD_TAG_OB += $row["SD_TAG_OB"];
    $JML_TM_LNS_BP += $row["TM_LNS_BP"];
    $JML_TM_LNS_NB += $row["TM_LNS_NB"];
    $JML_TM_LNS_OB += $row["TM_LNS_OB"];

	$JML_SD_LNS_BP += $row["SD_LNS_BP"];
	$JML_SD_LNS_NB += $row["SD_LNS_NB"];

    $JML_SD_LNS_OB += $row["SD_LNS_OB"];

    $JML_SALDO_BP += $row["SD_TAG_BP"]-$row["SD_LNS_BP"];
    $JML_SALDO_NB += $row["SD_TAG_NB"]-$row["SD_LNS_NB"];

    $JML_SALDO_OB += $row["SD_TAG_OB"]-$row["SD_LNS_OB"];
	
	$i++;

	}
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td colspan='2'>Total</td>		
        <td><strong><?=$row["NAMACARABAYAR"];?></strong></td>        	
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini22.php?jenis=TM_TAG&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_TM_TAG_BP,2,",",".");?></a></strong></td>
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini22.php?jenis=TM_TAG&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_TM_TAG_NB,2,",",".");?></a></strong></td>
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_bln_ini22.php?jenis=TM_TAG&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_TM_TAG_OB,2,",",".");?></a></strong></td>        
		
		<td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini22.php?jenis=SD_TAG&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SD_TAG_BP,2,",",".");?></a></strong></td>        
		<td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini22.php?jenis=SD_TAG&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SD_TAG_NB,2,",",".");?></a></strong></td>        
        
        <td align="right"><strong><a href="#" onclick="popitup('detail_tagihan_sd_bln_ini22.php?jenis=SD_TAG&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SD_TAG_OB,2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini22.php?jenis=TM_LNS&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_TM_LNS_BP,2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini22.php?jenis=TM_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_TM_LNS_NB,2,",",".");?></a></strong></td>        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_bln_ini22.php?jenis=TM_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_TM_LNS_OB,2,",",".");?></a></strong></td>        
		
		<td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SD_LNS_BP,2,",",".");?></a></strong></td>        
		<td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SD_LNS_NB,2,",",".");?></a></strong></td>        
        
        <td align="right"><strong><a href="#" onclick="popitup('detail_lunas_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SD_LNS_OB,2,",",".");?></a></strong></td>        
		<?php if ($pilih=='BEF') {
		?>
			x<td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=BEFALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SALDO_BP,2,",",".");?></a></strong></td>        
		<?php 
		}else{
		?>
			<td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=BP&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SALDO_BP,2,",",".");?></a></strong></td>        
		<?php 
		}
		if ($pilih=='BEF') {
		?>	
			x<td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=BEFALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SALDO_NB,2,",",".");?></a></strong></td>        
		<?php 
		}else{
		?>
			<td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=NB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SALDO_NB,2,",",".");?></a></strong></td>        
		<?php 
		}
		if ($pilih=='BEF') {
		?>
			x<td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=BEFALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SALDO_OB,2,",",".");?></a></strong></td>                
		<?php 
		}else{
		?>
			<td align="right"><strong><a href="#" onclick="popitup('sisa_tagihan_sd_bln_ini22.php?jenis=SD_LNS&kd_kuitansi=OB&kd_carabayar=<?=$row["NAMACARABAYAR"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$newfilter;?>&blnx=<?=$tglcari;?>&pilih=ALL&month=<?=$tglcarix;?>')"><?=number_format($JML_SALDO_OB,2,",",".");?></a></strong></td>                
        <?php 
		}
		?>
	</tr>
	
</table>
<br />


</form>
<?
echo 'ini pilih '.$pilih;
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