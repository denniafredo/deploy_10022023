<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>.::Bank Assurance::.</title>

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

<link rel="stylesheet" media="screen" href="./dynCalendar.css" />
<script language="javascript" type="text/javascript" src="./dynCalendar.js"></script>
<script language="javascript" type="text/javascript" src="./browserSniffer.js"></script>

<style type="text/css">
<!-- 
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
<form id="daform" name="jsmandiri" action="./jsmandiri.php" method="POST">	
<h2><?=strtoupper($judul);?></h2>
<table  border="0" style="border-collapse: collapse" id="table1" cellpadding="3">

	<tr>
      		<td valign="bottom">PERIODE :</td>
      		<td>
					<input type="text" name="tglstart" size="8" class="field" value="<?=$tglstart;?>"> 
      		<script language="JavaScript" type="text/javascript">
                                    function exampleCallback_ISO1(date, month, year)
                                    {
                                        if (String(month).length == 1) {
                                            month = '0' + month;
                                        }
                                    
                                        if (String(date).length == 1) {
                                            date = '0' + date;
                                        }    
                                        document.forms['jsmandiri'].tglstart.value = year + '-' + month + '-' + date ;
                                    }
                                    calendar1 = new dynCalendar('calendar1', 'exampleCallback_ISO1');
                                    calendar1.setMonthCombo(true);
                                    calendar1.setYearCombo(true);
                                  </script>
																	
																	&nbsp;&nbsp; &nbsp; S/D. &nbsp;&nbsp;
																	
					<input type="text" name="tglend" size="8" class="field" value="<?=$tglend;?>" >
      	  <script language="JavaScript" type="text/javascript">
                                    function exampleCallback_ISO2(date, month, year)
                                    {
                                        if (String(month).length == 1) {
                                            month = '0' + month;
                                        }
                                    
                                        if (String(date).length == 1) {
                                            date = '0' + date;
                                        }    
                                        document.forms['jsmandiri'].tglend.value = year + '-' + month + '-' + date ;
                                    }
                                    calendar2 = new dynCalendar('calendar2', 'exampleCallback_ISO2');
                                    calendar2.setMonthCombo(true);
                                    calendar2.setYearCombo(true);
                                  </script>
							</td>
      <td ><label>
       <input type="submit" name="Ubah" value="GO">
      </label></td>
    </tr>
  </table>	<?
       
if (isset($Ubah)) {
	
// 		$query ="SELECT COUNT(*) AS POLIS, SUM(U_ASURANSI) AS U_ASURANSI, SUM(JUMLAH_UA) AS JUMLAH_UA, PRODUK FROM TB1_NASABAH ".
//		"WHERE CONVERT(CHAR,TGL_UPLOAD,103) BETWEEN '$tglstart' AND '$tglend' GROUP BY PRODUK";
//		$result = mssql_query($query);
		
		$query ="SELECT PRODUK, (SELECT COUNT(*) FROM TB1_NASABAH WHERE STATUS_APP=1 AND A.PRODUK=PRODUK AND CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tglstart' AND '$tglend') AS POLIS_A, ".
		"SUM((CASE STATUS_APP WHEN 1 THEN U_ASURANSI ELSE 0 END)) AS U_ASURANSI_A, ".
		"SUM((CASE STATUS_APP WHEN 1 THEN JUMLAH_UA ELSE 0 END)) AS JUMLAH_UA_A, ".
		"(SELECT COUNT(*) FROM TB1_NASABAH WHERE STATUS_APP=0 AND A.PRODUK=PRODUK) AS POLIS_U, ".
		"SUM((CASE STATUS_APP WHEN 0 THEN U_ASURANSI ELSE 0 END)) AS U_ASURANSI_U, ".
		"SUM((CASE STATUS_APP WHEN 0 THEN JUMLAH_UA ELSE 0 END)) AS JUMLAH_UA_U, ".
		"(SELECT COUNT(*) FROM TB1_NASABAH WHERE STATUS_APP=2 AND A.PRODUK=PRODUK) AS POLIS_R, ".
		"SUM((CASE STATUS_APP WHEN 2 THEN U_ASURANSI ELSE 0 END)) AS U_ASURANSI_R, ".
		"SUM((CASE STATUS_APP WHEN 2 THEN JUMLAH_UA ELSE 0 END)) AS JUMLAH_UA_R, ".
		"COUNT(*) AS POLIS_T, ".
		"SUM(U_ASURANSI) AS U_ASURANSI_T, ". 
		"SUM(JUMLAH_UA) AS JUMLAH_UA_T,  (
         SELECT CONVERT(varchar(500), X.DESKRIPSI)
         FROM TB1_PRODUK X
         WHERE X.PRODUK = A.PRODUK
       ) AS PRDNAME ".
		"FROM TB1_NASABAH A WHERE CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tglstart' AND '$tglend' GROUP BY PRODUK";
		$result = mssql_query($query);
		
		//echo $query;
		
		//TOTAL
		$queryT ="SELECT (SELECT COUNT(*) FROM TB1_NASABAH WHERE STATUS_APP=1 AND CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tglstart' AND '$tglend') AS POLIS_A, ".
		"SUM((CASE STATUS_APP WHEN 1 THEN U_ASURANSI ELSE 0 END)) AS U_ASURANSI_A, ".
		"SUM((CASE STATUS_APP WHEN 1 THEN JUMLAH_UA ELSE 0 END)) AS JUMLAH_UA_A, ". 
		"(SELECT COUNT(*) FROM TB1_NASABAH WHERE STATUS_APP=0 AND CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tglstart' AND '$tglend' ) AS POLIS_U, ".
		"SUM((CASE STATUS_APP WHEN 0 THEN U_ASURANSI ELSE 0 END)) AS U_ASURANSI_U, ".
		"SUM((CASE STATUS_APP WHEN 0 THEN JUMLAH_UA ELSE 0 END)) AS JUMLAH_UA_U, ". 
		"(SELECT COUNT(*) FROM TB1_NASABAH WHERE STATUS_APP=2 AND CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tglstart' AND '$tglend' ) AS POLIS_R, ".
		"SUM((CASE STATUS_APP WHEN 2 THEN U_ASURANSI ELSE 0 END)) AS U_ASURANSI_R, ".
		"SUM((CASE STATUS_APP WHEN 2 THEN JUMLAH_UA ELSE 0 END)) AS JUMLAH_UA_R, ".
		"COUNT(*) AS POLIS_T, SUM(U_ASURANSI) AS U_ASURANSI_T, SUM(JUMLAH_UA) AS JUMLAH_UA_T ".
		"FROM TB1_NASABAH A WHERE CONVERT(datetime, TGL_UPLOAD) BETWEEN '$tglstart' AND '$tglend'";
		$resultT = mssql_query($queryT);
		
		}
	else
	{
	$query ="SELECT COUNT(*) AS POLIS, SUM(U_ASURANSI) AS U_ASURANSI, SUM(JUMLAH_UA) AS JUMLAH_UA, PRODUK FROM TB1_NASABAH ".
		"WHERE PRODUK='X' GROUP BY PRODUK";
		$result = mssql_query($query);
	$queryT ="SELECT COUNT(*) AS POLIS, SUM(U_ASURANSI) AS U_ASURANSI, SUM(JUMLAH_UA) AS JUMLAH_UA, PRODUK FROM TB1_NASABAH ".
		"WHERE PRODUK='X' GROUP BY PRODUK";
		$resultT = mssql_query($queryT);

	}
	//echo $query;	
        
		?>
		
		
				</br>
        <table border="1" align=right" font="Tahoma" font-size="2" style="border-collapse: collapse" bordercolor="#C0C0C0">
			<tr>
    		<th align=center rowspan="2" bgcolor="#dddddd"><b>PRODUK</b></th>
			<th align=center rowspan="2" bgcolor="#dddddd"><b>NAMA PRODUK</b></th>
			<th align=center colspan="3" bgcolor="#dddddd"><b>UPLOAD</b></th>
			<th align=center colspan="3" bgcolor="#dddddd"><b>APPROVE</b></th>
			<th align=center colspan="3" bgcolor="#dddddd"><b>REJECT</b></th>
			<th align=center colspan="3" bgcolor="#dddddd"><b>TOTAL</b></th>
			</tr>
			<tr>
    		<th align=center bgcolor="#dddddd"><b>POLIS</b></th>
			<th align=center bgcolor="#dddddd"><b>UANG ASURANSI</b></th>
			<th align=center bgcolor="#dddddd"><b>PREMI</b></th>
			<th align=center bgcolor="#dddddd"><b>POLIS</b></th>
			<th align=center bgcolor="#dddddd"><b>UANG ASURANSI</b></th>
			<th align=center bgcolor="#dddddd"><b>PREMI</b></th>
			<th align=center bgcolor="#dddddd"><b>POLIS</b></th>
			<th align=center bgcolor="#dddddd"><b>UANG ASURANSI</b></th>
			<th align=center bgcolor="#dddddd"><b>PREMI</b></th>
			<th align=center bgcolor="#dddddd"><b>POLIS</b></th>
			<th align=center bgcolor="#dddddd"><b>UANG ASURANSI</b></th>
			<th align=center bgcolor="#dddddd"><b>PREMI</b></th>
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
        	echo "<td valign='top' nowrap><font size='2'><a target='_blank' href='http://192.168.2.23/jiwasraya/pelaporan/jsmandiri_detil.php?tgls=".$tglstart."&tgle=".$tglend."&produk=".$row["PRODUK"]."'>".$row["PRODUK"]."</a></td>";
						echo "<td align='left' valign='top' nowrap><font size='2'>".$row["PRDNAME"]."</td>";		
						echo "<td align='right' valign='top' nowrap><font size='2'>".$row["POLIS_U"]."</td>";		
					
					?>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["U_ASURANSI_U"],2);?></a></td>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["JUMLAH_UA_U"],2);?></a></td>
					<?
						echo "<td align='right' valign='top' nowrap><font size='2'>".$row["POLIS_A"]."</td>";		
					
					?>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["U_ASURANSI_A"],2);?></a></td>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["JUMLAH_UA_A"],2);?></a></td>
							<!--<td valign='top' nowrap><font size="2"><?//=$row["PRODUK"];?></a></td>-->
							<? 
							echo "<td align='right' valign='top' nowrap><font size='2'>".$row["POLIS_R"]."</td>";		
					?>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["U_ASURANSI_R"],2);?></a></td>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["JUMLAH_UA_R"],2);?></a></td>
					<?
							echo "<td align='right' valign='top' nowrap><font size='2'>".$row["POLIS_T"]."</td>";		
					?>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["U_ASURANSI_T"],2);?></a></td>
							<td align='right' valign='top' nowrap><font size="2"><?=number_format($row["JUMLAH_UA_T"],2);?></a></td>
					<?

					echo "</tr>";
				$i++;
				
				}
				
        //close the connection
        		while($rowT = mssql_fetch_array($resultT))
				{
				echo "<tr bgcolor='#dddddd'><td colspan='2'><strong>TOTAL</td>".
				"<td align='right'><strong><a target='_blank' href='http://192.168.2.23/jiwasraya/pelaporan/jsmandiri_detil_sts.php?tgls=".$tglstart."&tgle=".$tglend."&sts=0'>".$rowT["POLIS_U"]."</a></td>".
				"<td align='right'><strong>".number_format($rowT["U_ASURANSI_U"],2)."</td>".
				"<td align='right'><strong>".number_format($rowT["JUMLAH_UA_U"],2)."</td>".
				"<td align='right'><strong><a target='_blank' href='http://192.168.2.23/jiwasraya/pelaporan/jsmandiri_detil_sts.php?tgls=".$tglstart."&tgle=".$tglend."&sts=1'>".$rowT["POLIS_A"]."</td>".
				"<td align='right'><strong>".number_format($rowT["U_ASURANSI_A"],2)."</td>".
				"<td align='right'><strong>".number_format($rowT["JUMLAH_UA_A"],2)."</td>".
				"<td align='right'><strong><a target='_blank' href='http://192.168.2.23/jiwasraya/pelaporan/jsmandiri_detil_sts.php?tgls=".$tglstart."&tgle=".$tglend."&sts=2'>".$rowT["POLIS_R"]."</td>".
				"<td align='right'><strong>".number_format($rowT["U_ASURANSI_R"],2)."</td>".
				"<td align='right'><strong>".number_format($rowT["JUMLAH_UA_R"],2)."</td>".
				"<td align='right'><strong>".$rowT["POLIS_T"]."</td>".
				"<td align='right'><strong>".number_format($rowT["U_ASURANSI_T"],2)."</td>".
				"<td align='right'><strong>".number_format($rowT["JUMLAH_UA_T"],2)."</td>".
				"</tr>";				
				}
				echo "</table>";
				echo "</table></BR>";

				mssql_close($dbhandle);
				?>
				
</form>		
<div>		
</body>
</html>
