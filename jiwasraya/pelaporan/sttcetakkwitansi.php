<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
	$DB = new Database($userid, $passwd, $DBName);
  echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "<body>";
?>

	<script language="javascript">
  var win= null;
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
	<?
	echo "<a class=\"verdana10blk\"><b>DAFTAR STATUS CETAK KWITANSI KANTOR $kantor </b></a>";
  echo "<hr size=1>";

  ?>
	<table>
	<form name="porm" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Billing & Booking bulan</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td><font face="Verdana" size="2">Nomor Penagih</font></td>
  <td><input type="text" class="a" name="nopenagih" size="10" maxlength="10" readonly>
						<a href="#" onclick="NewWindow('../proposal/pnglist.php?a=porm','popuppage','420','300','yes')"><img src="../img/jswindow.gif" border="0" alt="cari daftar agen"></a>		</td>
  <td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<hr size=1>
	<?
	
					$bln = substr(("0".$vbln),-2);
	        $thisperiode="$bln$vthn";
		      $periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
								 
					switch ($bln)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
					 
				if(!$nopenagih){
				    $getnopenagih ="";
				} else {
				    $getnopenagih ="a.nopenagih='$nopenagih' and ";
						$sqlz="select namaklien1 from $DBUser.tabel_100_klien where noklien='$nopenagih'";
						$DB->parse($sqlz);
		        $DB->execute();
						$arz=$DB->nextrow();
						$namapenagih=$arz["NAMAKLIEN1"];
						$penagih="Panagih $namapenagih";
				}
	echo "<div align=center>";
	$DBN = new Database($userid, $passwd, $DBName);

  $sqla="select n.jmlbelumcetak,y.jmlsudahcetak ".
      	"from ".
      			"(select ".
      						 "count(a.notertanggung) jmlbelumcetak  ".
      			"from ".
      					 	 "$DBUser.tabel_300_historis_premi c,".
      						 "$DBUser.tabel_200_pertanggungan a,".
      						 "$DBUser.tabel_500_penagih e ".
      			"where ".
      						 "a.nopenagih=e.nopenagih and ".
      						 "a.prefixpertanggungan=c.prefixpertanggungan and ".
      						 "a.nopertanggungan=c.nopertanggungan and ".
      						 "c.tglseatled is NULL and ".
      						 "c.billstatus is NULL and ".
      						 "SUBSTR(c.kdkuitansi,1,2)='OB' and ".
      						 "c.tglbooked =to_date('$thisperiode','MMYYYY') and ".
      						 "a.kdpertanggungan='2' and ".
									 "$getnopenagih ".
      						 "e.kdrayonpenagih='$kantor' and ".
      						 "c.status='0')n,".					 
      			"(select ".
      						 "count(a.notertanggung) jmlsudahcetak ".
      			"from ".
      					 	 "$DBUser.tabel_300_historis_premi c,".
      						 "$DBUser.tabel_200_pertanggungan a,".
      						 "$DBUser.tabel_500_penagih e ".
      			"where ".
      						 "a.nopenagih=e.nopenagih and ".
      						 "a.prefixpertanggungan=c.prefixpertanggungan and ".
      						 "a.nopertanggungan=c.nopertanggungan and ".
      						 "c.tglseatled is NULL and ".
      						 "c.billstatus is NULL and ".
      						 "SUBSTR(c.kdkuitansi,1,2)='OB' and ".
      						 "c.tglbooked =to_date('$thisperiode','MMYYYY') and ".
      						 "a.kdpertanggungan='2' and ".
									 "$getnopenagih ".
      						 "e.kdrayonpenagih='$kantor' and ".
      						 "c.status='1')y ";
						 //echo $sqla;
		$DBN->parse($sqla);
		$DBN->execute();
		$ara=$DBN->nextrow();
		$jmlbelumcetak = $ara["JMLBELUMCETAK"];
		$jmlsudahcetak = $ara["JMLSUDAHCETAK"];
		
		echo "<a class=\"verdana10blk\"><b>DAFTAR STATUS CETAK KWITANSI PENAGIH $namapenagih <br>".
				 "Billing Booking Bulan $bln $vthn Kantor $kantor</b></a>";
    $jml=$jmlbelumcetak + $jmlsudahcetak;
		?>
		<br><br>
    <table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
      <tr>
        <td width="33%" bgcolor="#99CCFF" align="center">SUDAH TERCETAK</td>
        <td width="33%" bgcolor="#99CCFF" align="center">BELUM TERCETAK</td>
        <td width="34%" bgcolor="#99CCFF" align="center">JUMLAH</td>
      </tr>
      <tr>
        <td width="33%" align="center"><?="<a href=statuskwitansibillbook.php?nopenagih=$nopenagih&status=1&thisperiode=$thisperiode>".$jmlsudahcetak."</a>";?></td>
        <td width="33%" align="center"><?="<a href=statuskwitansibillbook.php?nopenagih=$nopenagih&status=0&thisperiode=$thisperiode>".$jmlbelumcetak."</a>";?></td>
        <td width="34%" align="center"><?=$jml;?></td>
      </tr>
    </table>
		</div>
		<?
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Sistem Informasi</a>";
?>
&nbsp;&nbsp;&nbsp;
</body>