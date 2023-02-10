<HTML> 
<HEAD> 
<TITLE>password admin</TITLE> 
<link href="../jws.css" rel="stylesheet" type="text/css">
</HEAD> 

<BODY link="#0066FF" vLink="#0066FF" aLink="#0066FF" bgcolor="#fee498"> 
<?php  
$logok = FALSE;  

if (isset($login) and isset($passwd)){  
  $fp = fopen("passwdkirimfile.txt", "r");  

  while (feof($fp) == 0)  
  {  
    $line = chop(fgets($fp,1000));  
    $arr = split(",", $line);  
    if (($arr[0] == $login) and ($arr[1] == $passwd))  
    {  
       $logok = TRUE;  
       continue;  
    }  
  }  
}  

if (!$logok)  
{  
?> 
<form method="post" action="<? $PHP_SELF; ?>" name=loginform> 
  <br><br>
  <table border="0" cellspacing="2" cellpadding="2" align="center"> 
          <tr> 
            <td class="verdana10blk">Login ID</td> 
						<td> 
              <input type="text" name="login" maxlength=50 size=10 style="width: 90px; font-size: 10px"> 
            </td> 
          </tr> 
          <tr> 
					 <td class="verdana10blk">Password </td> 
            <td> 
              <input type="password" name="passwd" maxlength=50 size=10 style="width: 90px; font-size: 10px"> 
            </td> 
          </tr> 
          <tr align="right"> 
					  <td></td> 
            <td> 
              <input type="Submit" value="login" name="action"> 
            </td> 
          </tr> 
  </table> 

</form> 
<?
}
if ($logok)  
{  
 ?>  
  <script language=JavaScript> 
    window.location.href="updatetglkirimfile.php?kdkantor=<? echo $kdkantor; ?>&namafile=<? echo $namafile;?>"; 
  </script> 
<?
}  
?>  
<script language=JavaScript> 
<!-- 
if (document.loginform) { 
   document.loginform.login.focus(); 
} 
// --> 
</script> 
</BODY> 
</HTML> 

