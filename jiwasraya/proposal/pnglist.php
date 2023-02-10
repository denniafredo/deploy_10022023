<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	$formname=(!$a) ? "ntryprop" : $a;	
	$fieldname=(!$b) ? "nopenagih" : $b;
	$ktrasal=(!$x) ? $kantor : $x;

	if($modeshow=="all")
	{ 
	  $pskg = "";
	}
	else
	{
  	$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
  	//$pskg = ($skg=='1') ? "and a.penagihskg='1' " : " ";
	}

		$DB=New database($userid, $passwd, $DBName);
		$DBxxx=New database($userid, $passwd, $DBName);
		
?>	
  <html><title>Penagih List</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
	<script language="JavaScript" type="text/javascript">
	<!--
  function OnSumbit(theForm) {
	 var a = theForm.nama.value;
	 if (a.length < 3) {
	  if (confirm('Masukkan 3 Hurup Pertama Yang Ingin Dicari\nKlik OK Untuk Semuanya')) {
		 theForm.nama.value='ALL';
		 return true;
		} else {
		 theForm.nama.focus();
		 return false;
		}  
	 } else {
	  return true;
	 }	
	} 
	//-->
	</script>				
	<body topmargin="0">
	<div align=center>
	<form name="porm" method="post" action="<?echo $PHP_SELF;?>" onSubmit="return OnSumbit(document.porm)">
  <table width="100%" cellpadding="1" cellspacing="1" >
	 <tr class="tblisi"><td class="arial10">Nama Penagih <font size=1 color=red>(min 3 karakter): &nbsp;
	 <input type="text" class="c" name="nama" size="10" onFocus="highlight(event)" value="<?echo strtoupper($nama);?>">
	 <input type="submit" name="submit" value="Cari" class="buton">
	 <input type="hidden" name="a" value="<?echo $a;?>">
	 <input type="hidden" name="b" value="<?echo $b;?>">
	 <input type="hidden" name="skg" value="<?echo $skg;?>">
	 <input type="hidden" name="mutasi" value="<?echo $mutasi;?>">
	 </td>
	</tr>
  </table>
	<b><font face="Verdana" size="2">Daftar Premium Collector Kantor <?echo $ktrasal;?></b></font><br>
<?
  if (!$nama) {
	 $dannama = '';
	} elseif ($nama=='ALL') {
	 $dannama = '';
	} else{ 
   $dannama = "and b.namaklien1 like '".strtoupper($nama)."%' "; 
  }
	
	$ad = ($o==1) ? 'asc' : 'desc';
	$f = (!$f) ? '1' : $f;
	
	if($modeshow=="all") {
		if(isset($incautodebet))
		{
		  $pngautodb = "";
		}
		else
		{
			$pngautodb = "and nvl(a.penagihautodebet,'0')='0' ";
		}
	} else {	
		if(isset($incautodebet))
		{
		  $pngautodb = "and b.namaklien1 LIKE 'PENAGIH AUTODEBET%' ";
		}
		else
		{
			if (substr($prd,0,3)=='JL2' || substr($prd,0,3)=='JL3') {
				$pngautodb="and b.namaklien1 LIKE 'PENAGIH KHUSUS%' ";
			} else {
				$pngautodb = "and nvl(a.penagihautodebet,'0')='0' and not(b.namaklien1 LIKE 'PENAGIH KHUSUS%') ";
				//$pngautodb = "and nvl(a.penagihautodebet,'0')='0' and (b.namaklien1 LIKE 'PENAGIH%') ";
			}
		}
	}

	$con=ocilogon($DBUser, $DBPass, $DBName);
	
	$sqld=ociparse($con,"select kdkantor from $DBUser.tabel_888_userid where userid='".$userid."' and decrypt(password)='".$passwd."'");
	ociexecute($sqld);
	ocifetch($sqld);
	$tes=ociresult($sqld,"KDKANTOR");
	if ($tes!='KP'){
  	 //$autodebet="and b.namaklien1 not like '%AUTODEBET%' ";
	 //$off="and namaklien1 not like 'PENAGIH%' ";
  	}
	
	//echo 'x'.$tes.$kantor.$teslagi["KDKANTOR"];
	$sql="select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
			 "from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
	     "where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$ktrasal."' $off ".
				 $dannama.$pskg." ".
				 $pngautodb.$autodebet.
				 //"and nvl(a.penagihautodebet,'0')='0' ".
				 "and b.namaklien1 like 'PENAGIH%' ".
				 " order by $f ".
				 $ad;			 
	//echo $sql;
	
	//and b.namaklien1 not like 'PENAGIH TERMINAL%'
	
	$DB->parse($sql);
	$DB->execute();

?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" class="tblisi">
  <tr class="hijao">
<?
 $o = (int)!((boolean)$o);
    print( "<td align=\"center\"><a href=\"$PHP_SELF?skg=$skg&a=$a&b=$b&nama=$nama&f=1&o=$o\">Nomor</a></td>\n" );
    print( "<td align=\"center\"><a href=\"$PHP_SELF?skg=$skg&a=$a&b=$b&nama=$nama&f=2&o=$o\">Nama</a></td>\n" );
    print( "<td align=\"center\"><a href=\"$PHP_SELF?skg=$skg&a=$a&b=$b&nama=$nama&f=3&o=$o\">Asal</a></td>\n" );

?>
		<!--<td align=center>Asal</td>-->
    <td align=center>Rayon</td>
  </tr>
<?
	$i=0;
	while($arr=$DB->nextrow()) {
	  include "../../includes/belang.php";
		$nama = (strlen($arr["GELAR"])==0 || preg_match("/^[0-9]/",substr($arr["GELAR"],0,1))) ? $arr["NAMAKLIEN1"] : $arr["NAMAKLIEN1"].",".$arr["GELAR"];
		$nama = ereg_replace("'","`",$nama);	
		
		if($mutasi=="penagih") 
		{
		  $a="<td class=arial10ungu align=center>".
				 "<a href=\"#\" onclick=\"javascript:".
				 "window.opener.document.".$formname.".".$fieldname.".value='".$arr["NOPENAGIH"]."';".
				 "window.opener.document.".$formname.".namabaru.value='".$nama."';".
				 "window.close();\" >".$arr["NOPENAGIH"]."</a></td>".
    		 "<td  class=arial10ungu>".$nama."</td>".
    		 "<td  class=arial10ungu align=center>".$arr["PREFIXPENAGIH"]."</td>".
    		 "<td  class=arial10ungu align=center>".$arr["KDRAYONPENAGIH"]."</td>".
    		 "</tr>";
		} else {
		  $a="<td class=arial10ungu align=center>".
				 "<a href=\"#\" onclick=\"javascript:".
				 "window.opener.document.".$formname.".".$fieldname.".value='".$arr["NOPENAGIH"]."';".
				 "window.close();\" >".$arr["NOPENAGIH"]."</a></td>".
    		 "<td  class=arial10ungu>".$nama."</td>".
    		 "<td  class=arial10ungu align=center>".$arr["PREFIXPENAGIH"]."</td>".
    		 "<td  class=arial10ungu align=center>".$arr["KDRAYONPENAGIH"]."</td>".
    		 "</tr>";
		}
		echo($a);
		$i++;
	}
?>
</table>
</form>
</div>
</body>
</html>