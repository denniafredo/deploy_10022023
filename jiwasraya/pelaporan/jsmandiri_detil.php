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

<?
//include "../css/tabel.css";
include "../../includes/cDatabase.php";
//include "../../includes/menu.php";
?>

</head>
<body>
<div align="center">
<form id="daform" name="billing" action="../jsmandiri/data_pertanggungan.php" method="POST">	
<h2><?=strtoupper($judul);?></h2>
	<?
 		$query ="SELECT RIGHT(('0000000000'+CONVERT(VARCHAR,ID)),10) AS POLIS, CONVERT(CHAR,TGL_UPLOAD,103) AS TANGGAL_UPLOAD, ".
		"* FROM TB1_NASABAH WHERE PRODUK='$produk' ".
		"AND CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tgls' AND '$tgle'";
		$result = mssql_query($query);
       //echo $query;		
        
		?>
		
		
				</br>
        <table border="1" font="Tahoma" font-size="2" style="border-collapse: collapse" bordercolor="#C0C0C0">
			<tr>
    		<th align=center bgcolor="#F2F2F2"><b>POLIS</b></th>
			<th align=center bgcolor="#F2F2F2"><b>NAMA</b></th>
			<th align=center bgcolor="#F2F2F2"><b>ALAMAT</b></th>
			<th align=center bgcolor="#F2F2F2"><b>UANG ASURANSI</b></th>
			<th align=center bgcolor="#F2F2F2"><b>PREMI</b></th>
			<th align=center bgcolor="#F2F2F2"><b>PRODUK</b></th>
			<th align=center bgcolor="#F2F2F2"><b>TANGGAL</b></th>
			<!--<th align=center bgcolor="#F2F2F2"><b></b><input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" />CHECK</th>-->
			</tr>
				<?
				$i=1;
				while($row = mssql_fetch_array($result))
        {
          if($i%2)// fungsi mod
          	{
          	  echo "<tr class='alt'>";
          	}
          	else
          	{
          	  echo "<tr>";
						}
        	echo "<td valign='top' nowrap><font size='2'>".$row["POLIS"]."</td>";		
					?>
							<td valign='top' nowrap><font size="2"><?=$row["NAMA"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=$row["ALAMAT"];?></a></td>
							<td valign='top' nowrap><font size="2"><?=number_format($row["U_ASURANSI"],2);?></a></td>
							<td valign='top' nowrap><font size="2"><?=number_format($row["JUMLAH_UA"],2);?></a></td>
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
