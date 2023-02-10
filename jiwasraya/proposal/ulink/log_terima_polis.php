<?
  include "./includes/database.php"; 
  include "./includes/session.php"; 
  include "./includes/common.php";
  include "./includes/pertanggungan.php";	
  include "./includes/duit.php";
  include "./includes/koneksi.php";
  include "dateselect.php";
  
  $DB = new database($userid, $passwd, $DBName);
if(isset($_POST['submit'])){
  $tgl=(strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'];
  $bln=(strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'];
  $thn=(strlen($_POST['dthn'])==1) ? '0'.$_POST['dthn'] : $_POST['dthn'];
  $tglcari=$tgl."/".$bln."/".$thn;
//  echo $tglcari;
}

if (isset($_POST['terima'])) {
      	
      	$box=$box1; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {
						$nomorpolis = $dear;
						$sql1="update $DBUser.tabel_ul_log_kirim_polis set tglterima=sysdate,userterima=user where nomor_polis='$nomorpolis' and tglterima is null";
						//echo $sql1."<br>";					
						$DB->parse($sql1);
						$DB->execute();
					}								
				}
	$tglcari=$_POST['tglcaripol'];
	//echo $tglcari;		
}

?>
<link href="./jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js" ></script>
<script language="JavaScript" type="text/JavaScript"> 
function Cekbok(doc){ 
 if (doc == true)
 {
 checkedAll('getpolis', true);
 }
 else
 {
 checkedAll('getpolis', false);
 }
} 
</script>
 <script>
      function checkedAll (id, checked) {
	var el = document.getElementById(id);

	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }
</script> 
<body onLoad="javascript:placeFocus()">
<font face="Verdana" size="2"><b>LOG TERIMA POLIS</b><br>
<!--Kantor : <? echo $kantor; ?>-->
<br />
<form name="tglcari" method="post" action="#">
Tanggal Proses Pengiriman 
  <?=DateSelector("d"); ?> 
<input type="submit" name="submit" value="Cari"></input>
</form>
<br><br>
<form name="getpolis" action="<?=$PHP_SELF;?>" method="post">

  <table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
    
    <tr>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.
      POLIS</b></font></td>
    <td bgcolor="#C2CAED" colspan="4" align="center">
      <p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
    <td rowspan="2" align="center" bgcolor="#C2CAED"><font face="Verdana" size="1"><b>ALAMAT KIRIM</b></font></td>
    <!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>-->
    <td bgcolor="#C2CAED" rowspan="2" align="center"><b><font size="1" face="Verdana">TGL. PROSES</font></b></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><b><font size="1" face="Verdana">TGL. KIRIM</font></b></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>USER TERIMA</b></font></td>
		<!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>DOK.SAE</b></font></td> -->
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>ACTION<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></b></font></td>
   </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
    </tr>
	<?
  //------------------------------------------------------ Non Medical ------------------
/*
AND (select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran h ".
    						 "where  a.prefixpertanggungan = h.prefixpertanggungan ".
    						 "AND a.nopertanggungan = h.nopertanggungan ".
								 "and h.kdpembayaran in ('001','002','005') ) >= 0
*/


	$sql= "SELECT   a.prefixpertanggungan,
         a.nopertanggungan,
         b.nomor_polis,
         (SELECT   namaklien1 || ' ' || namaklien2
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.notertanggung)
            namatertanggung,
         (SELECT   namaklien1 || ' ' || namaklien2
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.nopemegangpolis)
            namapemegangpolis,
         (SELECT      alamattetap01
                   || ' '
                   || alamattetap02
                   || ', '
                   || (SELECT   namakotamadya
                         FROM   $DBUser.TABEL_109_KOTAMADYA
                        WHERE   kdkotamadya = x.kdkotamadyatetap)
                   || ', '
                   || (SELECT   namapropinsi
                         FROM   $DBUser.TABEL_108_PROPINSI
                        WHERE   kdpropinsi = x.kdpropinsitetap)
            FROM   $DBUser.tabel_100_klien x
           WHERE   noklien = a.nopemegangpolis)
            alamatkirim,
         c.namalogkirim,
         to_char(b.tglrekam,'dd/mm/yyyy') tglrekam,
		 to_char(b.tglkirim,'dd/mm/yyyy') tglkirim,
         b.userterima,
         b.ket
  FROM   $DBUser.tabel_200_pertanggungan a,
         $DBUser.tabel_ul_log_kirim_polis b,
         $DBUser.TABEL_UL_KODE_LOG c
 WHERE       a.prefixpertanggungan = SUBSTR (b.nomor_polis, 1, 2)
         AND a.nopertanggungan = SUBSTR (b.nomor_polis, 4, 9)
		 AND to_char(b.tglrekam,'dd/mm/yyyy')='$tglcari'
         AND b.kodelog = c.kodelog ".
    				"ORDER BY b.nomor_polis ";
		//echo $sql;		
	$DB->parse($sql);
	$DB->execute();
$i=1;
	while($arr=$DB->nextrow()){
	
	 ?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?>.</font></td>
    <td bgcolor="#FFFFFF" align="left"><font face="Verdana" size="1"><?=$arr["NOMOR_POLIS"];?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPEMEGANGPOLIS"];?></font></td>
     <td bgcolor="#FFFFFF" align="center">&nbsp;</td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATERTANGGUNG"];?></font></td>
     <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF" align="left"><font face="Verdana" size="1"><? echo $arr["ALAMATKIRIM"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLREKAM"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLKIRIM"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["USERTERIMA"]; ?></font></td>
    <!-- <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"> --> 
			 
			 
		
    <td bgcolor="#FFFFFF" align="center"><input type="checkbox" name="box1[]" value="<?=$arr["NOMOR_POLIS"];?>"></td>
</tr>
	<? 
	$i++;
	} 
	
?>
 <tr>
    <td bgcolor="#FFFFFF" align="center" colspan="10"><font face="Verdana" size="1">&nbsp;</font></td>
 
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"> 
    <input type="hidden" name="tglcaripol" value="<?=$tglcari;?>" />
    <input name="terima" type="submit" value="Terima" /></font></td>
</tr>
</table>
</form>





<hr size="1">
<table>
<? 

//mysql_close($connSae);
//}
 ?>
<tr>
<td><font face="verdana" size="2"><a href="../../submenu.php?mnuinduk=150">Back</a></font></td>
<td><!--<font face="verdana" size="2"><a href="emailterkirim.php">&nbsp;&nbsp;&nbsp;&nbsp;Check Pengiriman Email</a>--></td>
</tr>
</table>

</body>