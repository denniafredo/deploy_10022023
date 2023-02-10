<?php 
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
  $DB=new Database($userid,$passwd,$DBName);
  
	function DateSelector($inName, $useDate=0) 
 	{ 
        $monthName = array(1=> "Januari",  "Pebruari",  "Maret", 
            "April",  "Mei",  "Juni",  "Juli",  "Agustus", 
            "September",  "Oktober",  "Nopember",  "Desember"); 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
			
        print("<select name=" . $inName .  "bln>\n"); 
        for($currentMonth = 1; $currentMonth <= 12; $currentMonth++) 
        { 
            print("<option value=\""); 
            print(intval($currentMonth)); 
            print("\""); 
            if(intval(date( "m", $useDate))==$currentMonth) 
            { 
                print(" selected"); 
            } 
            print(">" . $monthName[$currentMonth] .  "\n"); 
        } 
				print("<option value=ALL>ALL</option>");
        print("</select>"); 
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 5; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
        } 
        print("</select>"); 
  } 
?>
<html>
<head>
<title>Billing Booking</title>
</head>
<link href="../jwsclass.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
	<b>INFORMASI PELUNASAN PREMI KANTOR <?echo $kantor;?></b>
	<hr size=1>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Pelunasan Premi</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
  <?
	if($vbln==""){
							   $DB = New Database($userid,$passwd,$DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $blnsearch= "to_char(a.tglbooked,'MMYYYY')='$thisperiode' and ";
								 $blnsearchx=$thisperiode;
								 $jnscari="BL";
	} else if($vbln=="ALL"){ 
	    $thisperiode="$vthn";
			$blnsearch= "to_char(a.tglbooked,'YYYY')='$thisperiode' and ";
			$blnsearchx=$thisperiode;
			$jnscari="TH";
	} else {
    	$bln = substr(("0".$vbln),-2);
    	$thisperiode="$bln$vthn";
			$blnsearch= "to_char(a.tglbooked,'MMYYYY')='$thisperiode' and ";
 			$blnsearchx=$thisperiode;
			$jnscari="BL";
 }
	switch ($bln)	{
		          case "01": $bulan = "Januari"; break;
	            case "02": $bulan = "Pebruari"; break;
	            case "03": $bulan = "Maret"; break;
		          case "04": $bulan = "April"; break;
		          case "05": $bulan = "Mei"; break;
		          case "06": $bulan = "Juni"; break;
		          case "07": $bulan = "Juli"; break;
		          case "08": $bulan = "Agustus"; break;
		          case "09": $bulan = "September"; break;
		          case "10": $bulan = "Oktober"; break;
		          case "11": $bulan = "Nopember"; break;
		          case "12": $bulan = "Desember"; break;
           }				
 ?>
 <hr size=1>
 <b>Pelunasan Premi <?=$bulan." ".$vthn;?> Kantor <?=$kantor; ?></b>
 <br><br>
 <?php 
	 $sql = "select ".
          "z.nopenagih,".
          "x.lunas,".
          "y.belumlunas ".
        "from ".
          "$DBUser.tabel_500_penagih z,".
          "(select ".
                "c.nopenagih,".
          	    "count(a.nopertanggungan) lunas ".
           "from ".
              	"$DBUser.tabel_300_historis_premi a,".
              	"$DBUser.tabel_200_pertanggungan b,".
              	"$DBUser.tabel_500_penagih c ".
           "where ".
              	"a.prefixpertanggungan=b.prefixpertanggungan and ".
              	"a.nopertanggungan=b.nopertanggungan and ".
              	"b.nopenagih=c.nopenagih and ".
              	"c.kdrayonpenagih='$kantor' and ".
              	"b.kdstatusfile='1' and ".
              	"b.kdpertanggungan='2' and ".
              	"$blnsearch ".
								"a.tglbooked is not null and ".
              	"a.tglseatled is not null ".
           "group by c.nopenagih) x,".
           "(select ".
                "c.nopenagih,".
          			"count(a.nopertanggungan) belumlunas ".
           "from ".
              	"$DBUser.tabel_300_historis_premi a,".
              	"$DBUser.tabel_200_pertanggungan b,".
              	"$DBUser.tabel_500_penagih c ".
           "where ".
              	"a.prefixpertanggungan=b.prefixpertanggungan and ".
              	"a.nopertanggungan=b.nopertanggungan and ".
              	"b.nopenagih=c.nopenagih and ".
              	"c.kdrayonpenagih='$kantor' and ".
              	"b.kdstatusfile='1' and ".
              	"b.kdpertanggungan='2' and ".
              	"$blnsearch ".
								"a.tglbooked is not null and ".
              	"a.tglseatled is null ".
           "group by c.nopenagih) y ".
        "where ".
          "z.nopenagih=x.nopenagih(+) and ".
          "z.nopenagih=y.nopenagih(+) and ".
          "z.kdrayonpenagih='$kantor' ".
        "group by ".
          "z.nopenagih,x.lunas,".
          "y.belumlunas";
				$DB->parse($sql);
				$DB->execute();
				//echo $sql;
	?>
	<table width="600" border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1">
  <tr>
    <td rowspan="2" align="center" bgcolor="#B7D5E3">No.</td>
    <td rowspan="2" align="center" bgcolor="#B7D5E3">No.Penagih</td>
    <td rowspan="2" align="center" bgcolor="#B7D5E3">Nama Penagih</td>
    <td colspan="2" align="center" bgcolor="#B7D5E3">Jumlah Polis</td>
    <td rowspan="2" align="center" bgcolor="#B7D5E3">Jumlah Polis</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B7D5E3">Lunas</td>
    <td align="center" bgcolor="#B7D5E3">Belum</td>
  </tr>
	<?php
		    $i=1;
		    $pllunas=0;
				$plbelumlunas=0;
				$jmlpolis=0;
	      while ($res=$DB->nextrow()) {
  				$nopenagih 		= $res["NOPENAGIH"];
  				$pllunas	 	  = $res["LUNAS"]=="" ? 0 : $res["LUNAS"];
  				$plbelumlunas = $res["BELUMLUNAS"]=="" ? 0 : $res["BELUMLUNAS"];
					$pllunasshow 			= $res["LUNAS"]=="" ? 0 : "<a href=\"#\" onclick=\"NewWindow('infodetillunaspremi.php?blnsearch=$blnsearchx&nopenagih=$nopenagih&lunas=1&jnscari=$jnscari','detiltagihan',900,400,1)\">".$res["LUNAS"]."</a>";
					$plbelumlunasshow = $res["BELUMLUNAS"]=="" ? 0 : "<a href=\"#\" onclick=\"NewWindow('infodetillunaspremi.php?blnsearch=$blnsearchx&nopenagih=$nopenagih&lunas=0&jnscari=$jnscari','detiltagihan',900,400,1)\">".$res["BELUMLUNAS"]."</a>";
								 
					$jmlpolis			=	$pllunas + $plbelumlunas;
  				$KL = New Klien($userid,$passwd,$nopenagih);
  ?>
  <tr>
    <td align="left"><?=$i;?></td>
    <td align="left"><?=$nopenagih;?></td>
    <td align="left"><?=$KL->nama;?></td>
    <td align="right"><?=$pllunasshow;?></td>
    <td align="right"><?=$plbelumlunasshow;?></td>
    <td align="right"><?=$jmlpolis;?></td>
  </tr>
  <?php 
	 $totalpollunas+=$pllunas;
	 $totalpolbelumlunas+=$plbelumlunas;
	 $total+=$jmlpolis;
	 $i++;
	 }
	 ?>
  <tr>
    <td align="center" colspan="3" bgcolor="#DFDFDF">Jumlah</td>
    <td align="right" bgcolor="#DFDFDF"><?=$totalpollunas; ?></td>
    <td align="right" bgcolor="#DFDFDF"><?=$totalpolbelumlunas;?></td>
    <td align="right" bgcolor="#DFDFDF"><?=$total; ?></td>
  </tr>
</table>
<br><br>
<hr size="1">
<a href="index.php" class="verdana10blk">Main Menu</a>