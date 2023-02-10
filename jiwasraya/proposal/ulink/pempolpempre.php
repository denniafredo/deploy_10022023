<?  
  include "./includes/database.php";
  include "./includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$notertanggung=$c;
  
	echo("<html><title>Insurable</title>");
	print( "<link href=\"./includes/jws.css\" rel=\"stylesheet\" type=\"text/css\">" );
	echo("<target=_top><body topmargin=\"0\"><div align=center>");
	echo "<table width=\"100%\"><tr>";
  echo "<td align=\"right\" class=arial8blue>F1334</td></tr>";
	echo "<tr><td align=\"center\" class=arial10bold>Insurable Tertanggung ".$notertanggung."</td>";
  echo "</tr></table>";
?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" class="tblisi">
  <tr class="tblhead">
	  <td align="center">Nomor</td>
    <td align="center">Nama</td>
		<td align="center">Hubungan</td>
  </tr>
<?
	$sql = "select namaklien1 from $DBUser.tabel_100_klien where noklien = '$c'";
	$DB->parse($sql);
	$DB->execute();
	$ary=$DB->nextrow();
	$name = $ary["NAMAKLIEN1"];
	

  $sql ="select b.noklieninsurable,a.kdhubungan, namahubungan, c.namaklien1,c.namaklien2  ".
	      " from $DBUser.tabel_100_klien c, $DBUser.tabel_113_insurable b ,$DBUser.tabel_218_kode_hubungan a ".
				" where a.kdhubungan=b.kdhubungan and b.notertanggung='$notertanggung'  ".
				" and b.noklieninsurable=c.noklien(+) ";
	//ECHO $sql;
  $DB->parse($sql);
	$DB->execute();

	
//$n =1 pempol 2 pempre
$name=ereg_replace("'","`",$name);
 
 switch ($n){
  case '1' :{
 		printf("<td class=verdana8 align=center><a href=\"#\" onclick=\"javascript:".
 		" window.opener.document.ntryprop.pempolnama.value='%s'; ".
		" window.opener.document.ntryprop.pempolno.value='%s'; ".
		" window.opener.document.ntryprop.pempolhub.value='%s'; ".
		"window.close();\" >%s</a></td><td class=verdana8>%s</td><td class=verdana8>%s</td>",$name,$notertanggung,"Diri Tertanggung",$notertanggung,"Tertanggung","Diri Tertanggung");	
		
		$i=0;
		while($arr=$DB->nextrow()) {
		$adan=ereg_replace("'","`",$arr["NAMAKLIEN1"]);
		include "./includes/belang.php";
		printf("<td class=verdana8 align=center><a href=\"#\" onclick=\"javascript:".
 		" window.opener.document.ntryprop.pempolnama.value='%s'; ".
		" window.opener.document.ntryprop.pempolno.value='%s'; ".
		" window.opener.document.ntryprop.pempolhub.value='%s'; ".
		"window.close();\" >%s</a></td><td class=verdana8>%s</td><td class=verdana8>%s</td></tr>",$adan,$arr["NOKLIENINSURABLE"],$arr["NAMAHUBUNGAN"],$arr["NOKLIENINSURABLE"],$arr["NAMAKLIEN1"],$arr["NAMAHUBUNGAN"]);	
		$i++;
		}
	 }
	 break;
	
	 case '2' : {
 		printf("<td class=verdana8 align=center><a href=\"#\" onclick=\"javascript:".
 		" window.opener.document.ntryprop.pemprenama.value='%s'; ".
		" window.opener.document.ntryprop.pempreno.value='%s'; ".
		" window.opener.document.ntryprop.pemprehub.value='%s'; ".
		"window.close();\" >%s</a></td><td class=verdana8>%s</td><td class=verdana8>%s</td>",$name,$notertanggung,"Diri Tertanggung  ",$notertanggung,"Tertanggung","Diri Tertanggung");
		
		$i=0;
		while($arr=$DB->nextrow()) {
		include "./includes/belang.php";	
    $adan=ereg_replace("'","`",$arr["NAMAKLIEN1"]);
		printf("<td class=verdana8 align=center><a href=\"#\" onclick=\"javascript:".
 		" window.opener.document.ntryprop.pemprenama.value='%s'; ".
		" window.opener.document.ntryprop.pempreno.value='%s'; ".
		" window.opener.document.ntryprop.pemprehub.value='%s'; ".
		"window.close();\" >%s</a></td><td class=verdana8>%s</td><td class=verdana8>%s</td>",$adan,$arr["NOKLIENINSURABLE"],$arr["NAMAHUBUNGAN"],$arr["NOKLIENINSURABLE"],$arr["NAMAKLIEN1"],$arr["NAMAHUBUNGAN"]);	
		$i++;
		}
	 break;
 	 }
	}
	;
	echo "<form name=ntryclnthub method=POST action=#>";
  $sqa="select a.noklieninsurable,a.kdhubungan,b.namaklien1 ".
	     "from $DBUser.tabel_100_klien b, $DBUser.tabel_113_insurable a ".
	     "where a.notertanggung='$noklien' and a.noklieninsurable=b.noklien(+)";
	//echo $sqa;
	$DB->parse($sqa);
	$DB->execute();
	$insurable=$DB->result();
	
	$sql="select kdhubungan,namahubungan from $DBUser.tabel_218_kode_hubungan";
	$DB->parse($sql);
	$DB->execute();		
	$result=$DB->result();
	
  $i=1;
	//while ($arr=$DB->nextrow()) {
		
	foreach ($insurable as $foo => $val) {
	  include "includes/belang.php";
		$noklieninsurable = $val["NOKLIENINSURABLE"];
		$kdhubungan = $val["KDHUBUNGAN"];
		$KL=new Klien($userid,$passwd,$noklieninsurable);
		echo("<td class=\"arial10\" align=\"center\">".$noklieninsurable."</td>"); 
		echo("<td class=\"arial10\" align=\"left\">".$val["NAMAKLIEN1"]."</td>"); 
		echo("<td class=\"arial10\" align=\"left\">");
		foreach($result as $coo => $data) {
  	  if ($val["KDHUBUNGAN"]==$data["KDHUBUNGAN"]) {
		    echo($data["NAMAHUBUNGAN"]);
	    } 
		}
		echo("</td>"); 
		echo("<td class=\"arial10\" align=\"center\">".$KL->Umur()." th, ".$KL->Umurbl()." bl</td>"); 
		echo("<td class=\"arial10\" align=\"center\"><input type=\"checkbox\" name=".$val["NOKLIENINSURABLE"]." value=\"ON\">&nbsp;&nbsp;");
		echo("<a href=\"#\" onclick=\"NewWindow('updclnthub.php?noklien=$noklien&noklieninsurable=$noklieninsurable&kdhubungan=$kdhubungan','updclnt',500,200,1);\">edit</a></td>");
		echo("</tr>");
		$i++;
	}
	/*echo("<tr>");
		echo("<td class=\"arial10\" align=\"center\"><input class=c type=\"text\" size=\"10\" maxlength=\"10\" name=\"noklieninsurable\" onfocus=\"highlight(event)\" onblur=\"validasi10(this.form.noklieninsurable);CariNama()\"></td>");
	echo("<td class=\"arial10\" align=\"left\"><input class=a type=\"text\" size=\"40\" maxlength=\"40\" name=\"namaklien1\"  readonly></td>");
	echo("<td class=\"arial10\" align=\"left\" class=buton><select class=a size=1 name=\"kdhubungan\" onfocus=\"highlight(event)\">");
	foreach($result as $coo => $data) {
	  $kdhubungan = $data["KDHUBUNGAN"];
	  $namahubungan = $data["NAMAHUBUNGAN"];
		echo("<option value=$kdhubungan>$namahubungan");
	}
	echo("</select></td>"); 
	echo("<td align=\"center\"></td>"); 
	echo("<td align=\"center\" ><a href=\"#\" onclick=\"NewWindow('popupclnt_link.php','popuppage',450,300,1);\">&nbsp;<img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari daftar klien\"></a></td>");
	echo("</tr>");*/
echo "<form/>";
	echo "</div>";
	echo("</body></html>");

?>