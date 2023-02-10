<?
include "../../includes/session.php";
include "../../includes/common.php";
include "../../includes/database.php";
include "../../includes/dropdown_date.php";
include "../../includes/klien.php";
	include "../../includes/kantor.php";
	$DB=new database($userid, $passwd, $DBName);
	$KL=new Klien($userid,$passwd,$nopenagih);
	$KTR=new Kantor($userid,$passwd,$kantor);

function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Bulan				
        print("<select name=" . $inName .  "bln>\n"); 
        for($currentMonth = 3; $currentMonth <= 12;$currentMonth=$currentMonth+3) 
        { 
            switch($currentMonth)
            {
              case '1' : $namabulan ="JANUARI"; break ;
              case '2' : $namabulan ="FEBRUARI"; break ;
              case '3' : $namabulan ="MARET"; break ;
              case '4' : $namabulan ="APRIL"; break ;
              case '5' : $namabulan ="MEI"; break ;
              case '6' : $namabulan ="JUNI"; break ;
              case '7' : $namabulan ="JULI"; break ;
              case '8' : $namabulan ="AGUSTUS"; break ;
              case '9' : $namabulan ="SEPTEMBER"; break ;
              case '10' : $namabulan ="OKTOBER"; break ;
              case '11' : $namabulan ="NOVEMBER"; break ;
              case '12' : $namabulan ="DESEMBER"; break ;
            }
						
            print("<option value=\"$currentMonth\""); 
            if(date( "n", $useDate)==$currentMonth) 
            { 
                print(" selected"); 
            } 					
            print(">$namabulan\n"); 						
        } 
        print("</select>"); 

// Tahun				
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
				//print ("<option value=ALL>*</option>");
        print("</select>"); 
} 

?>

<html>

<head>
<title>Sisa Tagihan</title>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

form{
padding:0px;
margin:0px;
}
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

h4{
padding: 0 0 5px 0;
margin:0;
}

.jarak {
clear:both;
height:1px;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript">
	 function GantiCari(theForm) {
			var np=theForm.nopenagih.value;
      window.location.replace('tagihan_penagih.php?nopenagih='+np+'#awaledit');
   }
</script>
</head>


<? 
	if(!isset($mode)){
	?>
<body topmargin="10">
<? 
} else {
 ?>
 <body><!-- onload="window.print();window.close()">-->
<? 
}
 ?>
 
      <h4>DAFTAR AGING PREMI PER PENAGIH</h4>

	<? 
	if(!isset($mode)){
	?>
			 
	<form action="<?=$PHP_SELF;?>" name="cariwaktu" method="POST">
<table>			
<tr>
<td>			
			Penagih
</td>
<td>
			<select name="nopenagih">
			<option value="">-- pilih --</option>
			<? 
			$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
			$sql	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
      			 	"from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
      	     	"where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$kantor."' ".
      				 $pskg." ".
							 //"and nvl(a.penagihautodebet,'0')='0' ".
      				 " order by b.namaklien1";
			$DB->parse($sql);
      $DB->execute();
			while ($ro=$DB->nextrow())
  		{
			  echo "<option ";
  			if ($nopenagih==$ro["NOPENAGIH"]){ echo " selected"; $namapenagih=$ro["NAMAKLIEN1"]; }
  			echo " value=".$ro["NOPENAGIH"].">".$ro["NAMAKLIEN1"]."</option>";
			}
			?>
			</select>		
</td>

<td>			
			Periode
</td>
<td>			 
			<? DateSelector("d"); ?>
</td>

<td>
			Kelompok Piutang Premi
</td>
<td>		
			<select name="kdpiutang">
			<option value="">-- pilih --</option>
			<option value="A">A - Kelompok Piutang <= 4 Bulan</option>
			<option value="B">B - Kelompok Piutang >4 Bulan</option>
			</select>
</td>

<td>
			<input type="submit" name="cari" value="SUBMIT"/>
</td>
</tr>
</table>

			</form>
		  <hr size="1">
<? 
}
else 
{
?>

<b>
	Nama Penagih 			: (<?=$nopenagih;?>) <?=$ro["NAMAKLIEN1"];?> <br>
	Periode Laporan 		: <?=substr("0".$dbln,-2)."/".$dthn;?>	<br>
	Kelompok Piutang Premi 	: (<?=$kdpiutang;?>) <?=($kdpiutang=="A"?"Kelompok Piutang <= 4 Bulan":"Kelompok Piutang > 4 Bulan");?> <br>
</b>
<div class="jarak"></div>
<? 
}
?>
<? 
if(isset($cari))
{
?>			

			<b>
				Nama Penagih 			: (<?=$nopenagih;?>) <?=$namapenagih;?> <br>
				Periode Laporan 		: <?=substr("0".$dbln,-2)."/".$dthn; $periodelaporan=substr("0".$dbln,-2)."/".$dthn;?>	<br>
				Kelompok Piutang Premi 	: (<?=$kdpiutang;?>) <?=($kdpiutang=="A"?"Kelompok Piutang <= 4 Bulan":"Kelompok Piutang > 4 Bulan");?> <br>
			</b>

			<form action="<?=$PHP_SELF;?>" name="tambahdata" method="POST">
			<table border="1" style="border-collapse: collapse" width="100%" bordercolor="#666666" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#7dc2d9">
					<td rowspan="2" align="center">Jenis Kuitansi</td>
					<td rowspan="2" align="center">Kode Cabas</td>
					<td colspan="3" align="center">Valuta Asing (VA)</td>
					<td colspan="3" align="center">Valuta Rupiah Dengan Indeks (VRDI)</td>
					<td colspan="3" align="center">Valuta Rupiah Tanpa Indeks (VRTI)</td>
					<td rowspan="2" align="center">Action</td>
					<tr bgcolor="#7dc2d9">
						<td align="center">Polis</td>
						<td align="center">Kuitansi</td>
						<td align="center">Premi</td>
						<td align="center">Polis</td>
						<td align="center">Kuitansi</td>
						<td align="center">Premi</td>
						<td align="center">Polis</td>
						<td align="center">Kuitansi</td>
						<td align="center">Premi</td>
					</tr>
				</tr>				

			<tr>
				<td align="center">
						<select name="kdkuitansi">
						<option value="">-- pilih --</option>
						<option value="NB">NB</option>
						<option value="OB">OB</option>
						</select>				
				</td>
				<td align="center">
						<select name="kdcabas">
						<option value="">-- pilih --</option>
						<option value="KEM">KEM</option>
						<option value="END">END</option>
						<option value="KE0">KE0</option>
						<option value="SH0">SH0</option>
						<option value="AN0">AN0</option>
						<option value="LL0">LL0</option>
						</select>				
				</td>
				<td><input type=text size=12 name=va_pol value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=va_kuit value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=va_premi value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=vrdi_pol value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=vrdi_kuit value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=vrdi_premi value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=vrti_pol value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=vrti_kuit value=<?=$arr["XXX"];?>></td>
				<td><input type=text size=12 name=vrti_premi value=<?=$arr["XXX"];?>></td>
				<td><input type="submit" name="nadd" value="ADD"></td>
			</tr>				

		</table>
		</form>	
					
<? 
	}
?>

<?	
	if(!isset($mode)){
?>
	<a href="../mnupenagihan.php">Menu Sistem Penagihan</a>
<? 	} ?>		
</body>
</html>