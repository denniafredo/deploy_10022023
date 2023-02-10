<?
  include "../../includes/common.php";
	include "../../includes/session.php";
  include "../../includes/database.php";
	include "../../includes/kantor.php";
	$KT=New Kantor($userid,$passwd,$kantor);
	$DB = New Database($userid, $passwd, $DBName);
  $DA=New Database("jsadm","jsadmku",$DBInfo);
	 
?>
<html>
<head>
<title>List Pengguna</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>

<body link="#003366" vlink="#003366" topmargin="0">
<font color="#003366" face="Verdana" size="2"><b>User List Aplikasi XL-iNdO</b></font>
<hr size="1" color="#6F81BF">
<div align="center">
<form name="porm" action="<? echo $PHP_SELF; ?>" method="post" onsubmit="return IsFormComplete(document.porm);">
  <center>
  <table border="0" class="tblhead" cellspacing="1" cellpadding="2">
    <tr>
      <td  align="center">DAFTAR PENGGUNA / USER KANTOR <? echo $kantor; ?></td>
		</tr>
		<tr>
      <td  align="center">
        <table border="0" class="tblisi" cellpadding="1" cellspacing="1">
         <tr class="hijao">
				  <td align="center">No</td>
					<td align="center">Kd. Kantor</td>
					<td align="center">User ID</td>
					<td align="center">Name</td>
					<td align="center">Modul</td>
					<td align="center">Jabatan</td>
					<td align="center">Created</td>
				 </tr>
<?
  $sql = "select a.userid,a.namauser,a.kdkantor,a.jabatan,c.namamodul ".
	  	   "from $DBUser.tabel_888_userid a,$DBUser.tabel_888_modul_bkp c, ".
				 "$DBUser.tabel_888_user_modul b ".
		     "where a.kdjenisuser='03' and b.kdmodul=c.kdmodul and a.kddivisi=b.kddivisi ".
				 "and a.kdkantor='$kantor' ".
			   "and a.kdkantor=b.kdkantor ".
				 "and NVL(status,0)!='X' ".
				 "and a.userid=b.userid order by a.kdkantor,a.userid";
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {
	 include "../../includes/belang.php";
   $sqa = "select to_char(created,'DD/MM/YYYY') created from all_users ".
	    	  "where username='".$arr["USERID"]."'";
					//echo $sqa;
	 $DA->parse($sqa);
	 $DA->execute();
	 $ari=$DA->nextrow();
	 $namauser=$arr["NAMAUSER"];
	 $namauser=str_replace("'","`",$namauser);				
	  print( "<td class=arial9 align=\"center\">$i</td>\n" );
		print( "<td class=arial9 align=\"center\">".$arr["KDKANTOR"]."</td>\n" );
    print( "<td class=arial9 align=\"left\">".$arr["USERID"]."</td>\n" );
    print( "<td class=ver8ungu align=\"left\"><a href=\"#\" onclick=\"NewWindow('loginperuser.php?users=$namauser','popuppage','700','510','yes');\">".$arr["NAMAUSER"]."</a></td>\n" );
    print( "<td class=arial9 align=\"left\">".$arr["NAMAMODUL"]."</td>\n" );
		print( "<td class=arial9 align=\"left\">".$arr["JABATAN"]."</td>\n" );
    print( "<td class=arial9 align=\"center\">".$ari["CREATED"]."</td>\n" );
		print( "</tr>" );
	 $i++;			 	 
	}
			 
?>				
				</table>
      </td>
    </tr>
		<tr>
      <td  align="left"><font size=1>Klik Nama User Untuk Melihat History Login User Yang Bersangkutan</td>
		</tr>
  </table>
  </center>
</form>

</div>
<br>
<hr size="1" color="#6F81BF">
<a href="index.php"><font face="Verdana" size="2">Back</font></a>

</body>
</html>	