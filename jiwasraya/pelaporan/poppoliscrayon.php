<?
  include "../../includes/session.php";
	include "../../includes/database.php";  
	include "../../includes/common.php";
  include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/atozsortnama.php";
	include "../../includes/alamat.php";
	
	$DB=new Database($userid, $passwd, $DBName);	

$pempol = (!$pempol) ? '0' : '1';

/*-----------------------------------------------------------------------------------------------*/	
function Klik($pempol,$kantor,$userid,$passwd,$prefix,$noper,&$htm){
 $PERT=New Pertanggungan($userid,$passwd,$prefix,$noper);
 $ygmaugantialamat = ($pempol) ? $PERT->nopemegangpolis : $PERT->nopembayarpremi;
 $ALM=New AlamatTagih($userid,$passwd,$ygmaugantialamat); 	
 $htm	="window.opener.document.chry.prefix.value='".$prefix."';\n".
			 "window.opener.document.chry.nomorpolis.value='".$noper."';\n".
			 "window.opener.document.chry.alamat1lama.value='".$ALM->alamat01."';\n".
			 "window.opener.document.chry.alamat2lama.value='".$ALM->alamat02."';\n".
			 "window.opener.document.chry.kodeposlama.value='".$ALM->kodepos."';\n".
			 "window.opener.document.chry.kodyalama.value='".$ALM->kotamadya."';\n".
			 "window.opener.document.chry.propinsilama.value='".$ALM->propinsi."';\n".
			 "window.opener.document.chry.phone1lama.value='".$ALM->phone01."';\n".
			 "window.opener.document.chry.phone2lama.value='".$ALM->phone02."';\n".
			 "window.opener.document.chry.emaillama.value='".$ALM->email."';\n".
			 "window.opener.document.chry.namatertanggung.value='".$PERT->namatertanggung."';\n".
			 "window.opener.document.chry.namapemegangpolis.value='".$PERT->namapemegangpolis."';\n".
			 "window.opener.document.chry.namapembayarpremi.value='".$PERT->namapembayarpremi."';\n".
			 "window.opener.document.chry.nopembayarpremi.value='".$PERT->nopembayarpremi."';\n".
			 "window.opener.document.chry.rayonpenlama.value='".$kantor."';".
			 "window.opener.document.chry.nomorpenlama.value='".$PERT->nopenagih."';".
			 "window.opener.document.chry.namalama.value='".$PERT->namapenagih."';".	
			 "window.close();\n".
			 "";
}	

/*-----------------------------------------------------------------------------------------------*/
if ($prefix=='' && $noper=='') { //Cari Polis Diklik
	$id=strtoupper($id);
	if (is_null($id) || $id=='') {
	 $like='#;';
	} else {
	 if ($id=='all') {
	  $like='';
	 } else {
	  $like= "and b.namaklien1 like '$id%' ";
	 } 
	}

  $sql = "select a.prefixpertanggungan,a.nopertanggungan ".
				 "from $DBUser.tabel_100_klien b,$DBUser.tabel_200_pertanggungan a,".
				 "$DBUser.tabel_500_penagih c ".
				 "where c.kdrayonpenagih='$kantor' and a.nopenagih=c.nopenagih and ".
				 "a.kdpertanggungan='2' and ".
				 "a.notertanggung=b.noklien ".
				 $like.
				 "order by a.nopertanggungan ";
	//echo $sql;			 
  
	$DB->parse($sql);
	$DB->execute();
	$body="<body>";
	
} else { //nilai dientry
	$prefix=strtoupper($prefix);
 	$sql = "select a.prefixpertanggungan,decode(a.kdpertanggungan,'1','Proposal','Polis') jenis ".
			   "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_500_penagih b ".
			 	 "where b.nopenagih=a.nopenagih and b.kdrayonpenagih='$kantor' and ".
				 "a.nopertanggungan='$noper' and prefixpertanggungan='$prefix'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();

	 if (!$ari=$DB->nextrow()){ //bukan kombinasi pertanggungan yang benar
	  print ("<body bgcolor=#ccccff><div align=center><font face=Verdana size=3><b>Pertanggungan ".$prefix."-".$noper." Tidak Ada</b></font><br>");
   	print( "Masukkan Prefix Pertanggungan dan Nomor Pertanggungan Yang Benar ! <br>" );
  	print( "<a href=\"#\" onclick=\"javascript:window.close();\"><font size=\"2\" face=\"Verdana\">Close</font></a>\n" );
	  die;
	 } else {	
	  Klik($pempol,$kantor,$userid,$passwd,$prefix,$noper,&$htm);
		$body="<body onload=\"".$htm."\">";
   } 
}
	

?>

<html>
<head>
<title>Daftar Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript">
function Cari(theForm) {
	var a=theForm.namaklien.value;
	var p=theForm.pempol.value;
	var minLength = 3; 
	if (a.length < minLength) {
        alert('Nama minimal ' + minLength + ' karakter. Coba lagi!');
        return false;
  } else {
	 if (!a=='') {
	  window.location.replace('poppoliscrayon.php?id='+a+'&pempol='+p+'');
	  return true;
	 }
	} 
}
</script>
</head>
<?
echo $body;
?>
<div align=center>
<form name="porm" action="<? PHP_SELF; ?>">
<input type="hidden" name="pempol" value="<?echo $pempol;?>">
<table class="arial10"> 
  <tr class=arial10blk>
	 <td colspan="2" align="center">DAFTAR POLIS DENGAN RAYON PENAGIH <? echo $kantor; ?></td>
	</tr>
  <tr class="tblisi1">
	 <td align="center">Nama Tertanggung : </td>
	 <td> <input type="text" name="namaklien" onfocus="highlight(event)" size="20" class="c" onblur="return Cari(document.porm);"> <font size="1" face="Verdana" color="red">[Pencarian cukup lama]</td>
	</tr>
	</form>
</table>
<br>
<? //SortNama('poppoliscrayon.php');
?>
<table width="100%"  cellspacing="1" cellpadding="0" class="tblisi"> 
 <tr class="hijao">
  <td align=center colspan="2">Nomor</td>
  <td align=center colspan="3">N  A  M  A</td>
 </tr>
 <tr class="hijao">
  <td align=center width="13%">Baru</td>
  <td align=center width="12%">Lama</td>
  <td align=center width="25%">Tertanggung</td>
  <td align=center width="25%">Pemegang Polis</td>
  <td align=center width="25%">Pembayar Premi</td>
 </tr>
<?
  $i=0;
  while($arr=$DB->nextrow()) {
	include "../../includes/belang.php";
	$PER=New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	Klik($pempol,$kantor,$userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"],&$htm);

		$a="<td  class=arial10ungu><a href=\"#\" ".
		   "onclick=\"javascript:".
			 $htm.
			 "\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>".
			 "<td class=arial10ungu>".$PER->nopol."</td>".
			 "<td class=arial10ungu>".$PER->namatertanggung."</td>".
			 "<td class=arial10ungu>".$PER->namapemegangpolis."</td>".
			 "<td class=arial10ungu>".$PER->namapembayarpremi."</td>";
			 
		print($a);
		echo("</tr>");
		$i++;
	}
?>
</table>
<? //SortNama('poppoliscrayon.php');
?>
</form>
</div>
</body>
</html>
