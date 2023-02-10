<?php 
error_reporting(0);
@ob_start();
$bdata="";
$height="50";
$scale="2";
$bgcolor="#FFFFFF";
$color="#000000";
$file="";
$type="png";


?>
<HTML>
<HEAD>
<TITLE>Barcode Generator</TITLE>
<STYLE>
<!--

body,td{
	font-family:verdana;
	font-size:12px;
	font-weight:normal;
	color:#000066;
}
input {
	border:1px solid #336699;
}
.note{
	font-size:10px;
	color:#CC0000;
}
-->
</STYLE>
<script language="JavaScript" type="text/javascript">
function Lanjutkan(){
 document.porm.Genrate.click();
}
</script>
</HEAD>

<body onLoad="javascript:Lanjutkan();" style="color: #ffffff;">
<TABLE style='border:1px solid #330066'>
<TR>
	
	<TD>
	<TABLE style='border:1px solid #990000'>
	<form name='porm' action='' method='POST'>


        <input type="hidden" name="encode" value="CODE128" />
        <input name='bdata' value='<?=$prefix."-".$nopertanggungan?>'>
        <input name='height' value="50"></TD>
		<input name='scale' value="2">'>
        <input name='bgcolor' value="#FFFFFF">
        <input name='color' value="#000000">
        <input name='type' value="png">
        <input name='file' value="<?=$prefix."-".$nopertanggungan?>">
	
		
        <input type="submit" name='Genrate' value='Submit'>
	
	</form>
	</TABLE>
	</TD>
	<TD height="100%"><TABLE style='border:1px solid #336666;width:300px;height:100%;'>
	<TR>
		<TD align='center'>
		<?php
		if(isset($_POST['Genrate']))
		{
			if(empty($_POST['file']))
			{
				foreach($_POST as $key=>$value)
					$qstr.=$key."=".urlencode($value)."&";
				echo "<img src='barcode.php?$qstr'>";
			}
			else
			{
				include("barcode.php");
				echo "<img src='".$_POST['file'].".".$_POST['type']."'>";
			}
		//header('location:../test.cetak.polis.link2.php?prefix='.$arr["PREFIXPERTANGGUNGAN"].'&nopertanggungan='.$arr["NOPERTANGGUNGAN"]);
		}
		?>
		</TD>
	</TR>
	</TABLE></TD>
</TR>
</TABLE>
</BODY>
</HTML>
