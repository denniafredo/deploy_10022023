<?
//
include "../../includes/session.php";  
	//include "./includes/database.php"; 
	//include "./includes/common.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Entry Polis</title>
<style type="text/css">
<!-- 
body {
  font-family: Verdana;
	font-size: 12px;
} 

td {
	font-size: 12px;
} 

.button{
  width: 100px;
	padding : 4px 4px 4px 4px;
}
-->
</style>
</head>
<body>
<?   

if(isset($submit))
{
  if($polistype=="newentry")
	{
	   echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  	 echo "window.location.replace('ntryprop.php');";
  	 echo "</script>";
	}
	else
	{
	   echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  	 echo "window.location.replace('switch_polis.php');";
  	 echo "</script>";
	}
}
?>
<div align="center">
<form name="ntrybaru" action="<?=$PHP_SELF;?>" method="post">
	<table border="1" cellpadding="15" style="border-collapse: collapse" bordercolor="#C0C0C0" cellspacing="0">
		<tr>
			<td bgcolor="#C0C0C0">
			<p align="center"><b>ENTRY PROPOSAL</b></td>
		</tr>
		<tr>
			<td>
			<table border="0" cellpadding="10" style="border-collapse: collapse" bordercolor="#C0C0C0" width="259">
				<tr>
					<td>
					<p align="left">
					<input type="radio" value="newentry" checked name="polistype"> 
					New Entry</p>
					<? //echo '$kantor '.$kantor;
					if (date("d/m/Y")=='30/10/2013' && ($kantor == 'NC'||$kantor == 'NC')){
					?>
					<p align="left">
					<input type="radio" value="switching" name="polistype"> 
					Switching Polis</p>
					<?
					}
					?></td>
				</tr>
			</table>
			<p align="center"><input type="button" class="button" value="CANCEL" name="batal" onClick="window.history.back();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" class="button" value="NEXT" name="submit"></td>
		</tr>
	</table>
</div>
</form>
</body>
</html>
