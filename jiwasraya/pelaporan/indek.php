<?php 
include './includes/koneksi.php';
include "../../includes/database.php";
include "../../includes/session.php";
	
$DB=New database($userid, $passwd, $DBName);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SMS_Blast</title>
<style type="text/css">
<!-- 
 
td { 
 font-size: 12px;
 font-family: verdana;
 } 
-->
</style>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php 
if (isset($_POST[updet])) 
{
$update="update $DBUser.TABEL_SMS_KLIEN set id='".$_POST[pilih]."'";
//echo $update;
$DB->parse($update);
$DB->execute();
}
?>
<form name="sms" action="indek.php" method="post" >

<table class="data" width="70%" cellpadding="3" cellspacing="0">
<tr>
<td valign="top">
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Messages Sending</li>
    <li class="TabbedPanelsTab" tabindex="0">Messages Templates</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <select name="pilih" id="select">
    <option value="x">--template--</option>
    <?php
    $sql = "SELECT * FROM $DBUser.TABEL_SMS_TEMPLATE";
        $DB->parse($sql);
        $DB->execute();
    while($ar=$DB->nextrow()) {
    echo "<option value='".$ar["ID"]."'>".$ar["KETERANGAN"]."</option>";
    }
    ?>
    </select><input type="submit" name="updet" value="SET TEMPLATE" />
    
    <!--oracle-->
    
    <table class="data" border="1" width="500" cellpadding="3" cellspacing="0">
    <TR align="center"><TD colspan="7">SOURCE</TD></TR>
    <TR align="center">
    <TD bgcolor="#FFE4C4">Phone</TD>
    <TD bgcolor="#FFE4C4">Text</TD>					
    </TR>
	<?php			
    $sql = "SELECT phone, $DBUser.SMSTEXT(PHONE) TXT FROM $DBUser.TABEL_SMS_KLIEN";
        //echo $sql;
        $DB->parse($sql);
        $DB->execute();
	$i=0;	
    while($arr=$DB->nextrow()) {
    if (isset($_POST['kirim_x'])) { 
    $mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arr["PHONE"]."','".$arr["TXT"]."')";
    mysql_query($mysqlins);
    }
    else {};
    
    echo "<tr bgcolor=".($i%2 ? "#FDF5E6" : "#FFFAF0").">";
    echo "<td>".$arr["PHONE"]."</td>";
    echo "<td>".$arr["TXT"]."</td>";
    echo "</tr>";
	$i++;
    }
	
    ?>
    </table>
    </div>
    <div class="TabbedPanelsContent">
	<table class="data" border="1" width="500" cellpadding="3" cellspacing="0">
    <TR   align="center"><TD colspan="7">TEMPLATES</TD></TR>
    <TR align="center">
    <TD bgcolor="#FFE4C4">ID</TD>
    <TD bgcolor="#FFE4C4">Text</TD>
    <TD bgcolor="#FFE4C4">Description</TD>					
    </TR>
	<?php			
    $sql = "SELECT * FROM $DBUser.TABEL_SMS_TEMPLATE";
                     //echo $sql;
        $DB->parse($sql);
        $DB->execute();
    $i=0;
	while($arr=$DB->nextrow()) {
    echo "<tr bgcolor=".($i%2 ? "#FDF5E6" : "#FFFAF0").">";
    echo "<td>".$arr["ID"]."</td>";
    echo "<td>".$arr["SMSTEMPLATE"]."</td>";
	echo "<td>".$arr["KETERANGAN"]."</td>";
    echo "</tr>";
	$i++;
    }
    ?>
    </table>
    </div>
<!--oracle-->
</td>
<td>
<input type="image" name="kirim" src="send.jpg" height="75" width="75"  />
</td>
<td valign="top">
<!--mysql-->

<div id="TabbedPanels2" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">    
    <li class="TabbedPanelsTab" tabindex="0">Messages Sent</li>
    <li class="TabbedPanelsTab" tabindex="0">Send To</li>
    <li class="TabbedPanelsTab" tabindex="0">Failed</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <table border="1" class="data" width="500" cellpadding="3" cellspacing="0">
    <TR align="center"><TD colspan="7">SEND TO</TD></TR>
    <TR align="center">
    <TD bgcolor="#FFE4C4">Phone</TD>
    <TD bgcolor="#FFE4C4">Message</TD>					
    </TR>
    <?php
	$dataPerPage = 10;

	if(isset($_GET['page']))
	{
		$noPage = $_GET['page'];
	} 
	else $noPage = 1;
	
	$offset = ($noPage - 1) * $dataPerPage;
	
	// query SQL untuk menampilkan data perhalaman sesuai offset				
    $qteam = "select PHONE, MESSAGE, FLAG from smsjiwasraya WHERE FLAG NOT IN ('0','2') order by datesent desc LIMIT $offset, $dataPerPage";
	//echo $qteam;
    $rteam = mysql_query($qteam);  
	$i=0;
    while($rowteam = mysql_fetch_array($rteam)){
    echo "<tr bgcolor=".($i%2 ? "#FDF5E6" : "#FFFAF0").">";
    echo "<td>$rowteam[PHONE]</td>";
    echo "<td>$rowteam[MESSAGE]</td>";
    //echo "<td>$rowteam[FLAG]</td>";
    echo "</tr>";
    $i++;
	}
    ?>
    </table>
    <?php
	$query   = "SELECT COUNT(*) AS jumData from smsjiwasraya where FLAG NOT IN ('0','2')";
	$hasil  = mysql_query($query);
	$data     = mysql_fetch_array($hasil);
	
	$jumData = $data['jumData'];
	
	// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
	
	$jumPage = ceil($jumData/$dataPerPage);
	
	// menampilkan link previous
	
	if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage-1)."'>&lt;&lt; Prev</a>";
	
	// memunculkan nomor halaman dan linknya
	
	for($page = 1; $page <= $jumPage; $page++)
	{
			 if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
			 {   
				if (($showPage == 1) && ($page != 2))  echo "..."; 
				if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
				if ($page == $noPage) echo " <b>".$page."</b> ";
				else echo " <a href='".$_SERVER['PHP_SELF']."?page=".$page."'>".$page."</a> ";
				$showPage = $page;          
			 }
	}
	
	// menampilkan link next
	
	if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage+1)."'>Next &gt;&gt;</a>";
    
	?>
    </div>
    <div class="TabbedPanelsContent">
    <table border="1" class="data" width="500" cellpadding="3" cellspacing="0">
    <TR align="center"><TD colspan="7">SEND TO</TD></TR>
    <TR align="center">
    <TD bgcolor="#FFE4C4">Phone</TD>
    <TD bgcolor="#FFE4C4">Message</TD>					
    </TR>
    <?php			
    $qteam = "select PHONE, MESSAGE, FLAG from smsjiwasraya WHERE FLAG='2'";
    $rteam = mysql_query($qteam);  
    while($rowteam = mysql_fetch_array($rteam)){
    echo "<tr>";
    echo "<td>$rowteam[PHONE]</td>";
    echo "<td>$rowteam[MESSAGE]</td>";
    //echo "<td>$rowteam[FLAG]</td>";
    echo "</tr>";
    }
    ?>
    </table>
    </div>
    <div class="TabbedPanelsContent">
    <table border="1" class="data" width="500" cellpadding="2" cellspacing="0">
    <TR align="center"><TD colspan="7">SEND TO</TD></TR>
    <TR align="center">
    <TD bgcolor="#FFE4C4">Phone</TD>
    <TD bgcolor="#FFE4C4">Message</TD>					
    </TR>
    <?php
		
    $qteam = "select PHONE, MESSAGE, FLAG from smsjiwasraya WHERE FLAG='0'";
    $rteam = mysql_query($qteam);  
    while($rowteam = mysql_fetch_array($rteam)){
    echo "<tr>";
    echo "<td>$rowteam[PHONE]</td>";
    echo "<td>$rowteam[MESSAGE]</td>";
    //echo "<td>$rowteam[FLAG]</td>";
    echo "</tr>";
    }
    ?>
    </table>
    
    </div>
  </div>
</div>
<!-------------upload-------------->
    <?
		if($apply)
{	
    require "../../includes/fileupload.class.php";
    if ($ffilename!="none"){
				    $k = $i-1;
            $mode = 1; //   1 = overwrite mode; 2 = create new with incremental extention; 3 = do nothing if exists
            $my_uploader = new uploader;
    				$my_uploader->max_filesize(600000000);
    				$my_uploader->max_image_size(3000000, 3000000);
			$my_uploader->upload("ffilename", "", ".txt");
					
    				$my_uploader->save_file("../file/files/", $mode);
    				if ($my_uploader->error) {
						 echo  $errmeg .= "Upload file gagal! ".$my_uploader->error . "<br>";
        		} else {
          			$file_name = $my_uploader->file['name'];
          			print($file_name . " berhasil di-upload!<br>");
								$updatefile = ",NAMA_FILE='$file_name'";
								
        		//=============upload=============
				//echo $_FILES[ffilename][name];
				  $fcontents = file ("../file/files/".$_FILES[ffilename][name]); 
				  # expects the csv file to be in the same dir as this script
				  $sqa="select max(id)+1 mid from $DBUser.TABEL_315_UPLD_AUTODEBET where kdbank='$kdbank'";
				  //echo $sqa;
				  $DB->parse($sqa);
      			  $DB->execute();
				  $ar=$DB->nextrow();	
				  
				  for($i=0; $i<sizeof($fcontents); $i++) { 
					  $line = trim($fcontents[$i]); 
					  $arr = explode(",", $line); 
					  //echo str_replace("","xx",implode("','", str_replace("'","`",$arr)));
					  //$arr = explode("\t", $line); 
					  //$arr = explode(";", $line); 
					  #if your data is comma separated
					  # instead of tab separated, 
					  # change the '\t' above to ',' 
					  //echo "'x".implode("','", str_replace("'","`",$arr)) ."x'</br>";
					  if (("'x".implode("','", str_replace("'","`",$arr)) ."x'")=="'xx'") {$sql="";} else {
					  	 $sql = "insert into $DBUser.TABEL_315_UPLD_AUTODEBET (kdbank,id,status,tglproses,peserta_text) values ('$kdbank','".($ar['MID']+$i)."','0',TO_DATE('".$tglcari."','DD/MM/YYYY'),'". 
								  implode(" ", str_replace(",",".",str_replace("'","`",$arr))) ."')";}
					  //mysql_query($sql);
					  //echo $sql ."<br>";
					   //echo implode(" ", str_replace("'","`",str_replace(",",".",$arr)))."</ br>";

					   //$DB->parse($sql);
      			  	   //$DB->execute();
					   $qupload++;
					  //if(mysql_error()) {
					  //   echo mysql_error() ."<br>\n";
					  //} 
				}
				//=============upload=============
				}
				//echo ($qupload+1).'record(s) inserted...';
    }
		else
		{ 
					  $updatefile = "";
		}
		
}
	?>
    <table>
        <tr><td >Unggah File </td><td><input type="file" name="ffilename" size="50" value=""><br /></td></tr>
		<tr><td></td><td><input type="submit" name="apply" value="SUBMIT" class="but"></td></tr>
 	</table>
    <!-------------upload-------------->
<!--mysql-->
</td></tr>
</table>
</form>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");
//-->
</script>
</body>
</html>
