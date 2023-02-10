<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>:: JS Mandiri Saving Plan ::</title>

<script language="JavaScript" type="text/javascript">
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

<script language="JavaScript"> 
function Cekbok(doc){ 
 if (doc == true)
 {
 checkedAll('daform', true);
 }
 else
 {
 checkedAll('daform', false);
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
<link rel="stylesheet" media="screen" href="../kisreas/css/dynCalendar.css" />
<script language="javascript" type="text/javascript" src="../kisreas/js/browserSniffer.js"></script>
<script language="javascript" type="text/javascript" src="../kisreas/js/dynCalendar.js"></script>
<script language="javascript" type="text/javascript" src="../kisreas/js/tip_balloon.js"></script>
<style type="text/css">
<!-- 
h2 {
 font-family: Verdana;
 font-size: 18px;
}
td {
 font-family: Verdana;
 font-size: 12px;
}
tr {
 font-family: Verdana;
 font-size: 12px;
} 
-->
</style>
<?
//include "../css/tabel.css";
include "../../includes/cDatabase.php";
//include "../../includes/menu.php";
?>

</head>
<body>
<div align="center">
<form id="daform" name="billing" action="../jsmandiri/data_pertanggungan.php" method="POST">	
<h2>DAFTAR PESERTA JS MANDIRI SAVING PLAN</h2>
	<?
 		$query ="SELECT RIGHT(('0000000000'+CONVERT(VARCHAR,ID)),10) AS POLIS, CONVERT(CHAR,TGL_UPLOAD,103) AS TANGGAL_UPLOAD, ".
		"CONVERT(CHAR,TGL_LAHIR,103) AS TANGGAL_LAHIR, * FROM TB1_NASABAH WHERE STATUS_APP='$sts' ".
		"AND CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tgls' AND '$tgle'";
		$result = mssql_query($query);
       //echo $query;		
        
		?>
		
		
				</br>
        <table border="1" font="Tahoma" font-size="2" style="border-collapse: collapse" bordercolor="#C0C0C0">
			<tr>
    		<th align=center bgcolor="#dddddd"><b>POLIS</b></th>
			<th align=center bgcolor="#dddddd"><b>TRX ID</b></th>
			<th align=center bgcolor="#dddddd"><b>NO REK</b></th>
			<th align=center bgcolor="#dddddd"><b>NAMA</b></th>
			<th align=center bgcolor="#dddddd"><b>TGL LAHIR</b></th>
			<th align=center bgcolor="#dddddd"><b>AHLI WARIS</b></th>
			<th align=center bgcolor="#dddddd"><b>ALAMAT</b></th>
			<th align=center bgcolor="#dddddd"><b>UANG ASURANSI</b></th>
			<th align=center bgcolor="#dddddd"><b>PREMI</b></th>
			<th align=center bgcolor="#dddddd"><b>PRODUK</b></th>
			<th align=center bgcolor="#dddddd"><b>TANGGAL</b></th>
			<!--<th align=center bgcolor="#F2F2F2"><b></b><input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" />CHECK</th>-->
			</tr>
				<?
				$i=1;
				while($row = mssql_fetch_array($result))
        {
          if($i%2)// fungsi mod
          	{
          	  echo "<tr bgcolor='#99CCFF'>";
          	}
          	else
          	{
          	  echo "<tr>";
						}
        	echo "<td valign='top' nowrap><a target='_blank' href='http://192.168.2.23/jiwasraya/pelaporan/jsmandiri_polis.php?id=".$row["ID"]."'><font size='2'>HO-".$row["POLIS"]."</a></td>";		
					?>
							<td valign='top' nowrap><font size="2"><?=$row["NO_TRXID"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["NO_REK"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["NAMA"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["TANGGAL_LAHIR"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["AHLI_WARIS"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["ALAMAT"];?></a></td>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["U_ASURANSI"],2);?></a></td>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["JUMLAH_UA"],2);?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["PRODUK"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["TANGGAL_UPLOAD"];?></a></td>
											<? //echo "<td valign='top' nowrap align='center'><font size='2'><input type='checkbox' name='box1[]' value=".$row["NO_PST"]."></td>";
						
        		
					
					echo "</tr>";
				$i++;
				}
				
        //close the connection
        
				
				echo "</table>";
				echo "</table></BR>";

				mssql_close($dbhandle);
				?>
				
</form>		
<div>		
</body>
</html>
