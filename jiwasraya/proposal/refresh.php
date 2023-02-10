<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Reload..</title>
</head>
<body>
Tunggu !<br />
sedang proses...
<?
print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
				 print( "<!--\n" );
				 print( "window.opener.location.replace('benefit1.php');" );
				 print( "window.close();" );
				 print( "//-->\n" );
				 print( "</script>\n" );
?>
</body>
</html>
