<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  $DB=new database($userid, $passwd, $DBName);
			
  function DateSelector($inName, $useDate=0) 
  { 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 
					echo "<option value=all>--all--</option>";
          for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</select>"); 
  
     // Bulan	
  		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
          print("<select name=" . $inName .  "bln>\n"); 
          for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
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
  						if($selected==$currentMonth) 
              { 
                  print(" selected"); 
              } 					
              print(">$namabulan\n"); 						
          } 
          print("</select>"); 
  
  		// Tahun				
  		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate)+1; 
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
              if($selected==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
  						
          } 
  				print("</select>"); 
  } 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Daftar Jatuh Tempo BPO Polis</title>
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
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:1px; }
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}


    .myButton {
        
        -moz-box-shadow: -7px -5px 13px -3px #1564ad;
        -webkit-box-shadow: -7px -5px 13px -3px #1564ad;
        box-shadow: -7px -5px 13px -3px #1564ad;
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5));
        background:-moz-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-webkit-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-o-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-ms-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:linear-gradient(to bottom, #79bbff 5%, #378de5 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5',GradientType=0);
        
        background-color:#79bbff;
        
        -moz-border-radius:9px;
        -webkit-border-radius:9px;
        border-radius:9px;
        
        border:1px solid #337bc4;
        
        display:inline-block;
        color:#ffffff;
        font-family:Times New Roman;
        font-size:15px;
        font-weight:bold;
        padding:5px 15px;
        text-decoration:none;
        
        text-shadow:-5px 3px 11px #528ecc;
        
    }
    .myButton:hover {
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff));
        background:-moz-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-webkit-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-o-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-ms-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:linear-gradient(to bottom, #378de5 5%, #79bbff 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff',GradientType=0);
        
        background-color:#378de5;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }


#filterbox{
  border: solid 1px #c0c0c0;
	padding : 5px;
	width:100%;
	margin : 0 0 10px 0;
}
form{
  margin : 0;
	padding : 0;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>

<body topmargin="10">



<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
  <td colspan="11" bgcolor="#FFFFFF" align="center"><b>DAFTAR JATUH POLIS BPO<BR /> 
BULAN <?=substr($tglcari,3,7);?> </b></td>
  </tr>
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>    
		<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Pemegang Polis</td>
    <td bgcolor="#89acd8" align="center">Produk</td>
		<td bgcolor="#89acd8" align="center">Tgl. Mulas</td>
		<td bgcolor="#89acd8" align="center">Premi</td>
    <td bgcolor="#89acd8" align="center">Cara Bayar</td>
	<td bgcolor="#89acd8" align="center">Lunas Terakhir</td>
	<td bgcolor="#89acd8" align="center">Tertunggak</td>
	<td bgcolor="#89acd8" align="center">Mulai BPO</td>
		<td bgcolor="#89acd8" align="center">Agen Penutup</td>
	<td bgcolor="#89acd8" align="center">Tlp. Agen Penutup</td>
	<td bgcolor="#89acd8" align="center">Alamat</td>
	<td bgcolor="#89acd8" align="center">Kota</td>	
  </tr>
  <? 
  if ($kantor == 'KP'){
    $carikantor = "";
  }else{
    $carikantor = "AND c.kdrayonpenagih = '".$kantor."'";
  }
  
	$sql = "SELECT   c.kdrayonpenagih,
           b.prefixpertanggungan,
           b.nopertanggungan,
           d.namaproduk,
           b.kdproduk,
           (CASE   
            WHEN add_months(b.mulas,60)>sysdate then b.premi1             
            ELSE premi2
           END ) premi1,
           TO_CHAR (b.tglbpo, 'DD/MM/YYYY') tglbpo,
           b.userupdated,
           (select TO_CHAR (max(tglbooked), 'DD/MM/YYYY') 
           from $DBUser.tabel_300_historis_premi where prefixpertanggungan=b.prefixpertanggungan 
           and nopertanggungan=b.nopertanggungan and tglseatled is not null) lunasterakhir,
           (select sum(premitagihan) 
           from $DBUser.tabel_300_historis_premi where prefixpertanggungan=b.prefixpertanggungan 
           and nopertanggungan=b.nopertanggungan and tglseatled is null) tunggakan, 
		   (select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) agenpenutup,
		   (select no_ponsel from $DBUser.tabel_100_klien where noklien=b.noagen) tlpagenpenutup,          
           TO_CHAR (b.mulas, 'DD/MM/YYYY') mulas,
           (SELECT   namaklien1
              FROM   $DBUser.tabel_100_klien
             WHERE   noklien = b.nopemegangpolis)
              pemegangpolis,
              (SELECT   alamattagih01||' '||alamattagih02
              FROM   $DBUser.tabel_100_klien
             WHERE   noklien = b.nopemegangpolis) alamat,
             (SELECT   namakotamadya 
              FROM   $DBUser.tabel_100_klien x,$DBUser.TABEL_109_KOTAMADYA y 
             WHERE   x.kdkotamadyatagih=y.kdkotamadya and noklien = b.nopemegangpolis) namakota, 
           (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=b.kdcarabayar) carabayar
    FROM   $DBUser.tabel_200_pertanggungan b,
           $DBUser.tabel_500_penagih c,
           $DBUser.tabel_202_produk d
   WHERE   b.nopenagih = c.nopenagih
           AND b.kdstatusfile IN ('4')
           AND b.kdproduk = d.kdproduk
		   AND substr(b.kdproduk,1,2) not in ('JL')
           AND b.kdpertanggungan = '2'
           ".$carikantor."
           AND TO_CHAR (b.tglbpo, 'MM/YYYY') = '".substr($tglcari,3,7)."'
ORDER BY   c.kdrayonpenagih, b.mulas";	
	
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>    
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PEMEGANGPOLIS"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDPRODUK"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["MULAS"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["PREMI1"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["CARABAYAR"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["LUNASTERAKHIR"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TUNGGAKAN"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLBPO"];?></td>	
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["AGENPENUTUP"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TLPAGENPENUTUP"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["ALAMAT"];?></td>	
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKOTA"];?></td>
	
  </tr>
	<? 
	$i++;
	$jmltotal += $arr["PREMI"];
	}
	?>
	
</table>
</form>

<hr size=1>
</body>
</html>