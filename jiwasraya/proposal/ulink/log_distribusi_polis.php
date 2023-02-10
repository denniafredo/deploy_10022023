<?
  include "./includes/database.php"; 
  include "./includes/session.php"; 
  include "./includes/common.php";
  include "./includes/pertanggungan.php";	
  include "./includes/duit.php";
  include "./includes/koneksi.php";
  
  $DB = new database($userid, $passwd, $DBName);

if(strlen($_GET['nomor_polis'])==12){
$sqlcek="select count(*) jumlah from $DBUser.tabel_200_pertanggungan where prefixpertanggungan='".substr($_GET['nomor_polis'],0,2)."' ".
"and nopertanggungan='".substr($_GET['nomor_polis'],3,9)."'";
//echo $sqlcek;
	 $DB->parse($sqlcek);
	 $DB->execute();
	 $arr=$DB->nextrow();
	 $jml=$arr["JUMLAH"];
	 if($jml==1){
		 $sql="insert into $DBUser.TABEL_UL_LOG_KIRIM_POLIS  (nomor_polis,kodelog,tglrekam,userrekam) values ".
 	 		  "('".$_GET['nomor_polis']."',1,sysdate,user)";
 	 		  echo $sql;
		 $DB->parse($sql);
		 $DB->execute();
		 $warning=" ";
	 }else{
	  //echo $sql;
		 $warning="Nomor Polis Ini Tidak ada dalam Portofolio Polis";
	 }
}
?>
<link href="./jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js" ></script>
<script language="JavaScript" type="text/JavaScript"> 
var x=12;//nr characters 
function submitT(t,f){ 
if(t.value.length>=x){ 
f.submit() 
} 
}

function placeFocus() {
    if (document.forms.length > 0) {
    	 var field = document.forms[0];
       for (i = 0; i < field.length; i++) {
          if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
             document.forms[0].elements[i].focus();
             break;
          }
       }
    }
  } 
</script> 
<body onLoad="javascript:placeFocus()">
<font face="Verdana" size="2"><b>LOG DISTRIBUSI POLIS</b><br>
Kantor : <? echo $kantor; ?>


<br><br>

  <table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
    
    <tr>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.
      POLIS</b></font></td>
    <td bgcolor="#C2CAED" colspan="4" align="center">
      <p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
    <td rowspan="2" align="center" bgcolor="#C2CAED"><font face="Verdana" size="1"><b>ALAMAT KIRIM</b></font></td>
    <!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>-->
    <td bgcolor="#C2CAED" rowspan="2" align="center"><b><font size="1" face="Verdana">TGL. CETAK</font></b></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><b><font size="1" face="Verdana">TGL. PROSES</font></b></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><b><font size="1" face="Verdana">TGL. KIRIM</font></b></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><b><font size="1" face="Verdana">TGL. TERIMA</font></b></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>USER PROSES</b></font></td>
		<!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>DOK.SAE</b></font></td> -->
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>KET</b></font></td>
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
         to_char(a.tglcetak,'dd/mm/yyyy') tglcetak,
		 c.namalogkirim,
         to_char(b.tglrekam,'dd/mm/yyyy') tglrekam,
		 to_char(b.tglkirim,'dd/mm/yyyy') tglkirim,
		 to_char(b.tglterima,'dd/mm/yyyy') tglterima,
         b.userrekam,
         b.ket
  FROM   $DBUser.tabel_200_pertanggungan a,
         $DBUser.tabel_ul_log_kirim_polis b,
         $DBUser.TABEL_UL_KODE_LOG c
 WHERE       a.prefixpertanggungan = SUBSTR (b.nomor_polis, 1, 2)
         AND a.nopertanggungan = SUBSTR (b.nomor_polis, 4, 9)
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
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLCETAK"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLREKAM"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLKIRIM"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLTERIMA"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["USERREKAM"]; ?></font></td>
    <!-- <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"> --> 
			 
			 
		
    <td bgcolor="#FFFFFF" align="center">&nbsp;</td>
</tr>
	<? 
	$i++;
	} 
	
?>
 <form action="#" method="get" name="inputbarcode">
 <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1">&nbsp;</font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><input name="nomor_polis" type="text" onKeyUp="submitT(this,this.form)"> </font></td>
    <td bgcolor="#FFFFFF" colspan="11"><font face="Verdana" size="1">&nbsp;</font></td>
</tr>
</form>
</table>




<script language="javascript">
function checkifempty(){
if (document.xxx.cek.value=='')
document.xxx.sendemail.disabled=true
else
document.xxx.sendemail.disabled=false
}
if (document.all)
setInterval("checkifempty()",100)
</script>
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