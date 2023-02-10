<?

	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date.php";


	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);

?>
<html>

<head>
<title>Jatuh Tempo Premi</title>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript"> 
function Cekbok(doc){ 
 var chk_arr =  document.getElementsByName("cetak[]");
 var chklength = chk_arr.length;             

 if (doc == true)
 {
	for(k=0;k< chklength;k++)
	{
		chk_arr[k].checked = true;
	} 
  }
 else
 {
	for(k=0;k< chklength;k++)
	{
		chk_arr[k].checked = false;
	} 
 }
	
} 
</script>

<style type="text/css">
.myButton {
        
        -moz-box-shadow: -7px -5px 13px -3px #1564ad;
        -webkit-box-shadow: -7px -5px 13px -3px #1564ad;
        box-shadow: -7px -5px 13px -3px #1564ad;
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5));
        background:-moz-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-webkit-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-o-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-ms-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:linear-gradient(to bottom, #79bbff 5%, #378de5 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5',GradientType=0);
        
        background-color:#79bbff;
        
        -moz-border-radius:9px;
        -webkit-border-radius:9px;
        border-radius:9px;
        
        border:1px solid #337bc4;
        
        display:inline-block;
        color:#ffffff;
        font-family:Times New Roman;
        font-size:15px;
        font-weight:bold;
        padding:5px 15px;
        text-decoration:none;
        
        text-shadow:-5px 3px 11px #528ecc;
        
    }
    .myButton:hover {
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff));
        background:-moz-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-webkit-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-o-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-ms-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:linear-gradient(to bottom, #378de5 5%, #79bbff 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff',GradientType=0);
        
        background-color:#378de5;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }
</style>
<body topmargin="20">
<b><font size="3">JATUH TEMPO PREMI</font></b><br>


<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
	<tr>
		<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(1,"Future");?> 
        Valuta
		<select name="kdvaluta">
  			<?	
  			$sqa="select kdvaluta,namavaluta from $DBUser.tabel_304_valuta";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDVALUTA"]==$kdvaluta){ echo " selected"; } else {echo "";}
      					echo " value=".$arr["KDVALUTA"].">(".$arr["KDVALUTA"].") ".$arr["NAMAVALUTA"]."</option>";
  					}
				?>
				<!--<option value="2" <?=$vsel;?>>(2) DOLLAR GADAI RUPIAH</option>-->
  			</select>
            Cara Bayar
            <select name="carabayar">
            <option value="B" <? if ($carabayar=='B'){ echo "selected";} else {echo "";}?>>BULANAN</option>
            <option value="K" <? if ($carabayar=='K'){ echo "selected";} else {echo "";}?>>KUARTALAN</option>
            <option value="S" <? if ($carabayar=='S'){ echo "selected";} else {echo "";}?>>SEMESTERAN</option>
            <option value="T" <? if ($carabayar=='T'){ echo "selected";} else {echo "";}?>>TAHUNAN</option>
            <option value="E" <? if ($carabayar=='E'){ echo "selected";} else {echo "";}?>>SEKALIGUS CICIL 5 KALI</option>
            <option value="J" <? if ($carabayar=='J'){ echo "selected";} else {echo "";}?>>SEKALIGUS CICIL 10 KALI</option>
            </select>
            Kantor
            <?
            echo "<select name='kdkantor'>";

  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' and kdkantor='$kantor' ".
  			     		 "order by kdkantor";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
      					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
  					}
  			
				
 			echo "</select>";
            ?>
			Filter Tagihan
            <?
            echo "<select name='tagihan'>";
			if($tagihan)
			echo "<option value='$tagihan' selected>$tagihan</option> ";  							  									
  			echo "<option value='All'>All</option> ";  							  									  			
  			echo "<option value='Lancar'>Lancar</option> ";  							  									
  			echo "<option value='Tertunggak'>Tertunggak</option> ";  							  									
 			echo "</select>";
            ?>
			Cara Bayar
            <?
            echo "<select name='cara_bayar'>";
			if($cara_bayar)
  			echo "<option value='$cara_bayar' selected>$cara_bayar</option> ";  							  									
  			echo "<option value='All'>All</option> ";  							  									
  			echo "<option value='Autodebet'>Autodebet</option> ";  							  									
  			echo "<option value='NonAutodebet'>Non Autodebet</option> ";  							  									  			
 			echo "</select>";
            ?>
            <!--Penagih
            <select name="nopenagih" onChange="GantiCari(document.cariwaktu)">
  <option value="">-- pilih --</option>
  <? 
			/*$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
			$sql	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
      			 	"from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
      	     	"where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$kantor."' ".
      				 $pskg." ".
							 //"and nvl(a.penagihautodebet,'0')='0' ".
      				 " order by b.namaklien1";
			$DB->parse($sql);
      $DB->execute();
			while ($ro=$DB->nextrow())
  		{
			  echo "<option ";
  			if ($nopenagih==$ro["NOPENAGIH"]){ echo " selected"; }
  			echo " value=".$ro["NOPENAGIH"].">".$ro["NAMAKLIEN1"]."</option>";
			} */
			?>
</select>-->
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
  $tglcari = date('Ym');
}
else
{
  $tglcari = $year.$month;
}

$sql1 = "SELECT autodebet,nopol,prefixpertanggungan,nopertanggungan,
            prefixpertanggungan || nopertanggungan nopolis,
            (SELECT   namaklien1
              FROM   $DBUser.tabel_100_klien
              WHERE   noklien = a.nopemegangpolis)
            pemegang_polis,
		        (SELECT   namaklien1
              FROM   $DBUser.tabel_100_klien
              WHERE   noklien = a.nopenagih)
            namapenagih,	
            (SELECT   kdrayonpenagih
              FROM   $DBUser.tabel_500_penagih
              WHERE   nopenagih = a.nopenagih)
            rayonpenagihan,
            kdproduk,
            TO_CHAR(mulas,'DD/MM/YYYY') MULAS,
		        TO_CHAR(sysdate,'yyyy')||TO_CHAR(mulas,'MM') blth_mulas,
            /*(to_char(sysdate,'mmyyyy')-to_char(mulas,'mmyyyy')) muless,*/
            months_between(sysdate,mulas)/12 muless,
		        expirasi,
		        /*
		        to_char(last_day(add_months(
            (SELECT MIN(tglbooked)
              FROM $DBUser.tabel_300_historis_premi hpl
              WHERE hpl.prefixpertanggungan = a.prefixpertanggungan
                     AND hpl.nopertanggungan = a.nopertanggungan
                     AND (hpl.tglseatled IS NULL)),
           (select graceperiode from $DBUser.tabel_241_grace_periode where kdproduk = a.kdproduk))),'DD/MM/YYYY') tgl_bpo, */ 		 
		        to_char(
                add_months(
                    (SELECT min(TGLBOOKED)
						          FROM $DBUser.tabel_300_historis_premi
				              WHERE prefixpertanggungan = a.prefixpertanggungan
						            AND nopertanggungan = a.nopertanggungan
				                AND TGLSEATLED is null),
					          (SELECT GRACEPERIODE
								      FROM $DBUser.TABEL_241_GRACE_PERIODE
							        WHERE kdproduk = a.kdproduk)
                ),'dd/mm/yyyy') tgl_bpo,		 		
		        (SELECT MIN(tglbooked)
              FROM $DBUser.tabel_300_historis_premi hpl
              WHERE hpl.prefixpertanggungan = a.prefixpertanggungan
                AND hpl.nopertanggungan = a.nopertanggungan
                AND (hpl.tglseatled IS NULL)) MULAI_TERTUNGGAK,
            (SELECT MAX(tglbooked)
              FROM $DBUser.tabel_300_historis_premi hpl
              WHERE hpl.prefixpertanggungan = a.prefixpertanggungan
                AND hpl.nopertanggungan = a.nopertanggungan
                AND (hpl.tglseatled IS NULL)) LAST_TERTUNGGAK,
		        case 
                when to_char(sysdate,'mm') = to_char((SELECT min(tglbooked)
                      FROM $DBUser.tabel_300_historis_premi hpl
                      WHERE hpl.prefixpertanggungan = a.prefixpertanggungan
                          AND hpl.nopertanggungan = a.nopertanggungan
                          AND (hpl.tglseatled IS NULL)),'mm') 
                then 'sama'
		            else'lain'
		        end lama_tertunggak,
            (SELECT COUNT(*)
              FROM $DBUser.tabel_300_historis_premi hpl
              WHERE hpl.prefixpertanggungan = a.prefixpertanggungan
                AND hpl.nopertanggungan = a.nopertanggungan
                AND (hpl.tglseatled IS NULL)) COUNT_TERTUNGGAK,           
            (SELECT SUM(NILAIRP)
              FROM $DBUser.tabel_300_historis_premi hpl
              WHERE hpl.prefixpertanggungan = a.prefixpertanggungan
                AND hpl.nopertanggungan = a.nopertanggungan
                AND (hpl.tglseatled IS NULL)) JML_TERTUNGGAK,		   
		        (select (NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETETAP01,nvl(PHONETAGIH01,PHONETAGIH02)))))
              from $DBUser.TABEL_100_KLIEN b 
              where b.NOKLIEN = a.nopemegangpolis ) telp,
            lamapembpremi_th,
            juamainproduk,
            premi1,
            premi2,
            (SELECT NAMACARABAYAR
              FROM $DBUser.TABEL_305_CARA_BAYAR
              WHERE kdcarabayar = a.kdcarabayar) kdcarabayar,
            (SELECT namavaluta
              FROM $DBUser.TABEL_304_VALUTA
              WHERE kdvaluta = a.kdvaluta) valuta,
            indexawal,
            (SELECT nilaibenefit
              FROM $DBUser.tabel_223_transaksi_produk
              WHERE prefixpertanggungan = a.prefixpertanggungan
                   AND nopertanggungan = a.nopertanggungan
                   AND kdbenefit = 'EXPPREMI'
                   AND nilaibenefit IS NOT NULL)
            benefitexp,
            TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp,
		        (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=a.prefixpertanggungan AND hpl.nopertanggungan=a.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
            (SELECT alamattagih01||' '||alamattagih02
                FROM $DBUser.tabel_100_klien kli
                WHERE kli.noklien = a.nopemegangpolis) ALAMAT,
		        (SELECT namakotamadya
                FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
                WHERE kli.noklien = a.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
		        TO_CHAR(a.TGLAKHIRPREMI,'DD/MM/YYYY') TGLAKHIRPREMI,
		        (select count(*) from $DBUser.HIST_CETAK_PEMBERITAHUAN_JT where periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') and prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) jml_cetak,
		        (select max(tglcetak) from $DBUser.HIST_CETAK_PEMBERITAHUAN_JT where periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') and prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) last_cetak,
		        (SELECT   usercetak
                FROM $DBUser.HIST_CETAK_PEMBERITAHUAN_JT
                WHERE periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') 
                   AND prefixpertanggungan = a.prefixpertanggungan
                   AND nopertanggungan = a.nopertanggungan
                   and tglcetak =(SELECT   MAX (tglcetak)
                                    FROM   $DBUser.HIST_CETAK_PEMBERITAHUAN_JT
                                   WHERE       periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') 
                                           AND prefixpertanggungan = a.prefixpertanggungan
                                           AND nopertanggungan = a.nopertanggungan)) last_usercetak  
          FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
          WHERE   a.nopenagih=p.nopenagih
 	          /*and a.nopenagih='$nopenagih'*/
            AND p.KDRAYONPENAGIH='$kdkantor'
		        AND a.kdpertanggungan = '2'
            AND a.kdstatusfile = '1'
            AND (a.lockmutasi !=  '11' or a.lockmutasi IS NULL)
            AND a.kdcarabayar <> 'X'
		        and (SELECT COUNT ( * )
                  FROM $DBUser.tabel_300_historis_premi hpl
                  WHERE hpl.prefixpertanggungan = a.prefixpertanggungan
                      AND hpl.nopertanggungan = a.nopertanggungan
                      AND (hpl.tglseatled IS NULL)) > 0
		        /*and a.TGLAKHIRPREMI >= TO_DATE ('".$tglcari."', 'YYYYMM')*/
		        and a.TGLAKHIRPREMI > TO_DATE ('".$tglcari."', 'YYYYMM')
		        /*AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3','JL4')*/
		        AND a.kdvaluta='$kdvaluta' ".$cara."
            AND MOD (
               MONTHS_BETWEEN (
                  TO_DATE ('".$tglcari."', 'YYYYMM'),
                  TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
               ),
               DECODE (a.kdcarabayar,
                       '1',
                       1,
                       'M',
                       1,
                       '2',
                       3,
                       'Q',
                       3,
                       '3',
                       6,
                       'H',
                       6,
                       '4',
                       12,
                       'A',
                       12,
                       'E',
                       12,
                       'J',
                       12)
            ) = 0";

$sql2 = "union  
		SELECT   distinct autodebet,nopol,
         a.prefixpertanggungan,
         a.nopertanggungan,
         a.prefixpertanggungan || a.nopertanggungan nopolis,
         (SELECT   namaklien1
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.nopemegangpolis)
            pemegang_polis,
		(SELECT   namaklien1
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.nopenagih)
            namapenagih,	
         (SELECT   kdrayonpenagih
            FROM   $DBUser.tabel_500_penagih
           WHERE   nopenagih = a.nopenagih)
            rayonpenagihan,
         kdproduk,
         TO_CHAR(mulas,'DD/MM/YYYY') MULAS,
		 TO_CHAR(sysdate,'yyyy')||TO_CHAR(mulas,'MM') blth_mulas,
         /*(to_char(sysdate,'mmyyyy')-to_char(mulas,'mmyyyy')) muless,*/
         months_between(sysdate,mulas)/12 muless,
		 expirasi,		 
         /*
		 to_char(last_day(add_months(
         (SELECT   MIN(tglbooked)
            FROM   $DBUser.tabel_300_historis_premi hpl
           WHERE       hpl.prefixpertanggungan = a.prefixpertanggungan
                   AND hpl.nopertanggungan = a.nopertanggungan
                   AND (hpl.tglseatled IS NULL)),
         (select graceperiode from $DBUser.tabel_241_grace_periode where kdproduk = a.kdproduk))),'DD/MM/YYYY') tgl_bpo, */ 		 
		 to_char(add_months((SELECT   min(TGLBOOKED)
						FROM   $DBUser.tabel_300_historis_premi
					   WHERE       prefixpertanggungan = a.prefixpertanggungan
							   AND nopertanggungan = a.nopertanggungan
							   AND TGLSEATLED is null),
					 (SELECT   GRACEPERIODE
									   FROM   $DBUser.TABEL_241_GRACE_PERIODE
							  WHERE   kdproduk = a.kdproduk)),'dd/mm/yyyy') tgl_bpo,	               
		 (SELECT   MIN(tglbooked)
            FROM   $DBUser.tabel_300_historis_premi hpl
           WHERE       hpl.prefixpertanggungan = a.prefixpertanggungan
                   AND hpl.nopertanggungan = a.nopertanggungan
                   AND  (hpl.tglseatled IS NULL)) MULAI_TERTUNGGAK,
         (SELECT   MAX(tglbooked)
            FROM   $DBUser.tabel_300_historis_premi hpl
           WHERE       hpl.prefixpertanggungan = a.prefixpertanggungan
                   AND hpl.nopertanggungan = a.nopertanggungan
                   AND  (hpl.tglseatled IS NULL)) LAST_TERTUNGGAK,
		 case when to_char(sysdate,'mm') = to_char((SELECT   min(tglbooked)
                FROM   $DBUser.tabel_300_historis_premi hpl
               WHERE       hpl.prefixpertanggungan = a.prefixpertanggungan
                       AND hpl.nopertanggungan = a.nopertanggungan
                       AND (hpl.tglseatled IS NULL)),'mm') then
				'sama'
		 else	
				'lain'
		 end lama_tertunggak,		   
         (SELECT   COUNT(*)
            FROM   $DBUser.tabel_300_historis_premi hpl
           WHERE       hpl.prefixpertanggungan = a.prefixpertanggungan
                   AND hpl.nopertanggungan = a.nopertanggungan
                   AND (hpl.tglseatled IS NULL)) COUNT_TERTUNGGAK,           
         (SELECT   SUM(NILAIRP)
            FROM   $DBUser.tabel_300_historis_premi hpl
           WHERE       hpl.prefixpertanggungan = a.prefixpertanggungan
                   AND hpl.nopertanggungan = a.nopertanggungan
                   AND NOT (hpl.tglseatled IS NULL)) JML_TERTUNGGAK,
         (select (NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETETAP01,nvl(PHONETAGIH01,PHONETAGIH02)))))
                        from $DBUser.TABEL_100_KLIEN b 
                        where b.NOKLIEN = a.nopemegangpolis ) telp,
         lamapembpremi_th,
         juamainproduk,
         premi1,
         premi2,
         (SELECT   NAMACARABAYAR
            FROM   $DBUser.TABEL_305_CARA_BAYAR
           WHERE   kdcarabayar = a.kdcarabayar) kdcarabayar,
         (SELECT   namavaluta
            FROM   $DBUser.TABEL_304_VALUTA
           WHERE   kdvaluta = a.kdvaluta) valuta,
         indexawal,
         (SELECT   nilaibenefit
            FROM   $DBUser.tabel_223_transaksi_produk
           WHERE       prefixpertanggungan = a.prefixpertanggungan
                   AND nopertanggungan = a.nopertanggungan
                   AND kdbenefit = 'EXPPREMI'
                   AND nilaibenefit IS NOT NULL)
            benefitexp,
         TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp,
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=a.prefixpertanggungan AND hpl.nopertanggungan=a.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
       (SELECT alamattagih01||' '||alamattagih02
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = a.nopemegangpolis) ALAMAT,
		(SELECT namakotamadya
          FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
         WHERE kli.noklien = a.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
		 TO_CHAR(a.TGLAKHIRPREMI,'DD/MM/YYYY') TGLAKHIRPREMI,
		 (select count(*) from $DBUser.HIST_CETAK_PEMBERITAHUAN_JT where periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') and prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) jml_cetak,
		 (select max(tglcetak) from $DBUser.HIST_CETAK_PEMBERITAHUAN_JT where periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') and prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) last_cetak,
		 (SELECT   usercetak
            FROM   $DBUser.HIST_CETAK_PEMBERITAHUAN_JT
           WHERE       periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') 
                   AND prefixpertanggungan = a.prefixpertanggungan
                   AND nopertanggungan = a.nopertanggungan
                   and tglcetak =(SELECT   MAX (tglcetak)
                                    FROM   $DBUser.HIST_CETAK_PEMBERITAHUAN_JT
                                   WHERE       periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') 
                                           AND prefixpertanggungan = a.prefixpertanggungan
                                           AND nopertanggungan = a.nopertanggungan)) last_usercetak  
   from $DBUser.TABEL_300_HISTORIS_PREMI b,$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
             WHERE       a.nopenagih = p.nopenagih                  
                     AND p.KDRAYONPENAGIH='$kdkantor'
                     AND a.kdpertanggungan = '2'
                     AND a.kdstatusfile = '1'
                     AND (a.lockmutasi !=  '11' or a.lockmutasi IS NULL)
                     AND a.kdcarabayar <> 'X'                     
                     AND a.kdvaluta='$kdvaluta' ".$cara."                    
                     and a.prefixpertanggungan = b.prefixpertanggungan
                     and a.nopertanggungan = b.nopertanggungan
                     and b.TGLSEATLED is null
                     AND MOD (
                           MONTHS_BETWEEN (
                              TO_DATE ('".$tglcari."', 'YYYYMM'),
                              TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
                           ),
                           DECODE (a.kdcarabayar,
                                   '1',
                                   1,
                                   'M',
                                   1,
                                   '2',
                                   3,
                                   'Q',
                                   3,
                                   '3',
                                   6,
                                   'H',
                                   6,
                                   '4',
                                   12,
                                   'A',
                                   12,
                                   'E',
                                   12,
                                   'J',
                                   12)
                        ) <> 0";
$sql = $sql1.$sql2;						
			 //echo $sql."<br/>";

$sqlx = "SELECT   autodebet,nopol,prefixpertanggungan,nopertanggungan,
         prefixpertanggungan || nopertanggungan nopolis,
         (SELECT   namaklien1
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.nopemegangpolis)
            pemegang_polis,
		(SELECT   namaklien1
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.nopenagih)
            namapenagih,	
         (SELECT   kdrayonpenagih
            FROM   $DBUser.tabel_500_penagih
           WHERE   nopenagih = a.nopenagih)
            rayonpenagihan,
         kdproduk,
         TO_CHAR(mulas,'DD/MM/YYYY') MULAS,
         /*(to_char(sysdate,'mmyyyy')-to_char(mulas,'mmyyyy')) muless,*/
         months_between(sysdate,mulas)/12 muless,
		 expirasi,
         lamapembpremi_th,
         juamainproduk,
         premi1,
         premi2,
         (SELECT   NAMACARABAYAR
            FROM   $DBUser.TABEL_305_CARA_BAYAR
           WHERE   kdcarabayar = a.kdcarabayar) kdcarabayar,
         (SELECT   namavaluta
            FROM   $DBUser.TABEL_304_VALUTA
           WHERE   kdvaluta = a.kdvaluta) valuta,
         indexawal,
         (SELECT   nilaibenefit
            FROM   $DBUser.tabel_223_transaksi_produk
           WHERE       prefixpertanggungan = a.prefixpertanggungan
                   AND nopertanggungan = a.nopertanggungan
                   AND kdbenefit = 'EXPPREMI'
                   AND nilaibenefit IS NOT NULL)
            benefitexp,
         TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp,
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=a.prefixpertanggungan AND hpl.nopertanggungan=a.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
		 TO_CHAR(add_months(
         (SELECT   MIN(tglbooked)
            FROM   $DBUser.tabel_300_historis_premi hpl
           WHERE       hpl.prefixpertanggungan = a.prefixpertanggungan
                   AND hpl.nopertanggungan = a.nopertanggungan
                   AND (hpl.tglseatled IS NULL)),
         (select graceperiode from $DBUser.tabel_241_grace_periode where kdproduk = a.kdproduk)),'DD/MM/YYYY') tgl_bpo,
		 (select (NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETETAP01,nvl(PHONETAGIH01,PHONETAGIH02)))))
                        from $DBUser.TABEL_100_KLIEN b 
                        where b.NOKLIEN = a.nopemegangpolis ) telp,
       (SELECT alamattagih01||' '||alamattagih02
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = a.nopemegangpolis) ALAMAT,
		(SELECT namakotamadya
          FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
         WHERE kli.noklien = a.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
		 TO_CHAR(a.TGLAKHIRPREMI,'DD/MM/YYYY') TGLAKHIRPREMI,
		 (select count(*) from $DBUser.HIST_CETAK_PEMBERITAHUAN_JT where periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') and prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) jml_cetak,
		 (select max(tglcetak) from $DBUser.HIST_CETAK_PEMBERITAHUAN_JT where periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') and prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) last_cetak,		 
		 (SELECT   usercetak
            FROM   $DBUser.HIST_CETAK_PEMBERITAHUAN_JT
           WHERE       periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') 
                   AND prefixpertanggungan = a.prefixpertanggungan
                   AND nopertanggungan = a.nopertanggungan
                   and tglcetak =(SELECT   MAX (tglcetak)
                                    FROM   $DBUser.HIST_CETAK_PEMBERITAHUAN_JT
                                   WHERE       periode = TO_DATE ('".$tglcari."01', 'YYYYMMDD') 
                                           AND prefixpertanggungan = a.prefixpertanggungan
                                           AND nopertanggungan = a.nopertanggungan)) last_usercetak  
  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
 WHERE   a.nopenagih=p.nopenagih
 	     /*and a.nopenagih='$nopenagih'*/
         /*AND p.KDRAYONPENAGIH='$kdkantor'*/
		 AND a.kdpertanggungan = '2'
         AND a.kdstatusfile = '1'
         AND (a.lockmutasi !=  '11' or a.lockmutasi IS NULL)
         AND a.kdcarabayar <> 'X'
		 /*and a.TGLAKHIRPREMI >= TO_DATE ('".$tglcari."', 'YYYYMM')*/
		 and a.TGLAKHIRPREMI > TO_DATE ('".$tglcari."', 'YYYYMM')
		 AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3','JL4')
		 /*AND a.kdvaluta='$kdvaluta' ".$cara."*/
         AND MOD (
               MONTHS_BETWEEN (
                  TO_DATE ('".$tglcari."', 'YYYYMM'),
                  TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
               ),
               DECODE (a.kdcarabayar,
                       '1',
                       1,
                       'M',
                       1,
                       '2',
                       3,
                       'Q',
                       3,
                       '3',
                       6,
                       'H',
                       6,
                       '4',
                       12,
                       'A',
                       12,
                       'E',
                       12,
                       'J',
                       12)
            ) = 0";
							 
							 
if ($kantor == 'KP'){
	$sql = $sqlx;
}
/*
$tagihan
$cara_bayar*/
$sql = " select NOPOL,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NOPOLIS,PEMEGANG_POLIS,NAMAPENAGIH,
       RAYONPENAGIHAN,KDPRODUK,MULAS,BLTH_MULAS,MULESS,EXPIRASI,TGL_BPO,MULAI_TERTUNGGAK,
       LAST_TERTUNGGAK,LAMA_TERTUNGGAK,COUNT_TERTUNGGAK,JML_TERTUNGGAK,TELP,
       LAMAPEMBPREMI_TH,JUAMAINPRODUK,PREMI1,PREMI2,KDCARABAYAR,VALUTA,INDEXAWAL,
       BENEFITEXP,TGLEXP,LUNAS,ALAMAT,KOTA,TGLAKHIRPREMI,JML_CETAK,LAST_CETAK,LAST_USERCETAK,
       autodebet
	   from ( ".$sql.")
	   where 1 = 1 ";


if($cara_bayar=='Autodebet'){
	$sql .= " and autodebet is not null ";
}else if($cara_bayar=='NonAutodebet'){
	$sql .= " and autodebet is null ";
}

if($tagihan=='Lancar'){
	$sql .= " and lama_tertunggak = 'sama' ";
}else if($tagihan=='Tertunggak'){
	$sql .= " and lama_tertunggak = 'lain' ";
}

//echo $sql;
			 
?><br>

<form name="frm" action="jatuh_tempo_premi_link_bo_n1_cetak_pdf.php" method="post" target="_blank">
<input type="submit" class="myButton" id="btnCetak" name="btnCetak" value="CETAK JATUH TEMPO PREMI SEBAGIAN">		
<input type="hidden" name="kdkantor" value="<?=$kantor;?>">
<input type="hidden" name="tglcari" value="<?=$tglcari;?>">
		<br>
<b>JATUH TEMPO PREMI</b>
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
		<td><b>No</b></td>
		<td><b>No. Polis</b></td>
		<td><b>Pemegang Polis</b></td>
		<td><b>Produk</b></td>
		<td><b>Mulas</b></td>
        <td><b>Premi</b></td>		
		<td><b>Jt. Tempo</b></td>
        <td><b>Lunas Per</b></td>		
		<td><b>Tgl BPO</b></td>
		<td><b>Akhir Bayar</b></td>
        <td><b>Tertunggakan</b></td>        
        <td><b>Jumlah Tertunggak</b></td>
        <td><b>Jumlah Premi</b></td>
        <td><b>Alamat</b></td>
        <td><b>Telp</b></td>
        <td><b>Kota</b></td>    
        <td><b>Ket Cetak</b></td>    
        <td><b>Cetak (*) <input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></b></td>       
		<!--td colspan="2"><b>Action</b></td-->
	</tr>
	<?
	//echo $sql."<br/>";
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";	
	if($kdvaluta=='1' || $kdvaluta=='3')
	$indexawal=1;
	else
	$indexawal=$row["INDEXAWAL"];
	if($row["MULESS"]<=5)  //membedakan antara premi1 dan premi2
	$premi=$row["PREMI1"]/$indexawal;	
	else
	$premi=$row["PREMI2"]/$indexawal;	
	?>
		<td><?=$i;?></td>
		<td><?=$row["NOPOLIS"];?></td>
		<td><?=$row["PEMEGANG_POLIS"]?></td>
		<td><?=$row["KDPRODUK"];?></td>
		<td><?=$row["MULAS"];?></td>        
        <td align="right"><?=number_format($premi,2,",",".");?>
        <td><?=$row["TGLEXP"];?></td>        
        <td><?=$row["LUNAS"];?></td>
		<td><?=$row["TGL_BPO"];?></td>
		<td><?=$row["TGLAKHIRPREMI"];?></td>
		<td align="center">
			<?php
			if($row["MULAI_TERTUNGGAK"]==''){
				echo 'Tidak Tertunggak';
			}else if($row["MULAI_TERTUNGGAK"]==$row["LAST_TERTUNGGAK"]){
				echo $row["MULAI_TERTUNGGAK"];
			}else{
				echo $row["MULAI_TERTUNGGAK"].' s/d '.$row["LAST_TERTUNGGAK"];
			}			
			?>
		</td>
		<td><?=$row["COUNT_TERTUNGGAK"];?></td>
		<!--td align="right">
			<?=number_format($row["JML_TERTUNGGAK"],2,",",".");?>
		</td-->
		<td align="right"><?=number_format($premi*$row["COUNT_TERTUNGGAK"],2,",",".");?>
        <td><?=$row["ALAMAT"];?></td>
        <td><?=$row["TELP"];?></td>
        <td><?=$row["KOTA"];?></td>
        <td><?php
			echo 'Jml : '.$row["JML_CETAK"].'<br>';
			echo 'Tgl : '.$row["LAST_CETAK"].'<br>';
			echo 'Oleh : '.$row["LAST_USERCETAK"];
			?>
		</td>
        <td><input type="checkbox" id="cetak" name="cetak[]" value="<?=$row["NOPOLIS"]?>#<?=$row["BLTH_MULAS"];?>"></td>
        

        <!--td><?="<a href=\"javascript:NewWindow('../pelaporan/cetakjatuhtempo_newest.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglcari=".$tglcari."&link=Y','polisinfo',815,600,'yes');\">cetak</a>";?></td-->
        <td><? //"<a href=\"javascript:NewWindow('../pelaporan/cetakinfocb.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">Info CB</a>";?>
        <!--a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KONFIRMASI_CB.pdf'>Info CB</a-->
        </td>
		
	</tr>
	<? 
	$i++;

	}
	?>
	
</table>

<p align="justify">
<b>(*) Untuk mendownload PDF, ceklist data yang ingin di download kemudian klik tombol CETAK JATUH TEMPO PREMI SEBAGIAN</b>
</p>

<br />


</form>
<?
}
?>
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>

