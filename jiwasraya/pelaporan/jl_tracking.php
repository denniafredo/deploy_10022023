<? 
include "../../includes/session.php"; 
include "../../includes/database.php"; 
include "../../includes/kantor.php";

$DB=new database($userid, $passwd, $DBName);
$KTR=new Kantor($userid,$passwd,$kdkantor);
	
function DateSelector($inName, $useDate=0) 
{ 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  
      		// Tanggal
      		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 
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
  
  			
  			$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate); 
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
<title>Info Pelunasan Unit Link</title>
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

/*input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:2px; border: 1px #99cccc;}
*/
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
.actbutton {
  padding: 3px;
	width :60px;
}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
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
</head>
<body>

<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">

  <table>
	<tr>
    <td width="60">No. Polis</td>
		<td>:</td>
  	<td>
		 <input type="text" name="prefix" size="4" maxlength="2" onChange="javascript:this.value=this.value.toUpperCase();"> 
		 <input type="text" name="nopert" size="12" maxlength="9"> 
		</td>
	</tr>
	
	<tr>
    <td>Tanggal</td>
		<td>:</td>
  	<td>
  	  <? 
  		switch($jnstgl)
  		{
  		  case 't_entrsp': $tg1 = "selected"; break;
  			case 't_aksep':  $tg2 = "selected"; break;
  			case 't_tranferpp': $tg3 = "selected"; break;
				case 't_bp3': $tg4 = "selected"; break;
				case 't_tranfercms': $tg5 = "selected"; break;
				case 't_sendniaga': $tg6 = "selected"; break;
				case 't_confirmniaga': $tg7 = "selected"; break;
  			default : $tg1 = "selected"; break;
  		}
  		?>
  	  <select name="jnstgl">
    	  <option value="t_entrsp" <?=$tg1;?>>Enty SP</option>
    		<option value="t_aksep" <?=$tg2;?>>Akseptasi</option>
    		<option value="t_tranferpp" <?=$tg3;?>>Transfer PP</option>
  			<option value="t_bp3" <?=$tg4;?>>Entry BP3</option>
  			<option value="t_tranfercms" <?=$tg5;?>>Transfer di CMS</option>
  			<option value="t_sendniaga" <?=$tg16;?>>Send to Niaga</option>
  			<option value="t_confirmniaga" <?=$tg7;?>>Confirm Niaga (NAB)</option>
  		</select>
			dari <?=DateSelector("d"); ?> Sampai <?=DateSelector("s"); ?>
		</td>
 	</tr>
	
	<tr>
  	<td>Kantor</td>
		<td>:</td>
  	<td><select name="kdkantor">
    			<?
    			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
    			     		 "order by kdkantor";
    					$DB->parse($sqa);
    					$DB->execute();	
    					while ($arr=$DB->nextrow()) {
    					  echo "<option ";
        					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
        					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
    					}
    			?>
  				<option value="ALL"<?=(($_POST['kdkantor']=='ALL') ? ' selected' : '');?>>--ALL--</option>
   </select>
   </td>
 </tr>
 <tr>
   <td>Proses</td>
	 <td>:</td>
   <td>
	   <select name="jnsproses">
    	  <option value="nb" <?=$p1;?>>NB</option>
				<option value="ts" <?=$p2;?>>TopUp Sekaligus</option>
				<option value="tb" <?=$p3;?>>TopUp Berkala</option>
				<option value="rd" <?=$p4;?>>Redemption</option>
		 </select>
	 </td>
 </tr>
 
 <tr>
   <td colspan="2"> </td>
	 <td><input type="submit" name="submit" class="actbutton" value="Cari"</input></td>
 </tr>
</table>
</form>
</div>
<?
	$tglawal	=	$_POST['dthn'] . 
					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) .
					( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] );
	$tglakhir	=	$_POST['sthn'] . 
					( (strlen($_POST['sbln'])==1) ? '0'.$_POST['sbln'] : $_POST['sbln'] ) .
					( (strlen($_POST['stgl'])==1) ? '0'.$_POST['stgl'] : $_POST['stgl'] );
	//echo '<hr />'. $tglawal . ' - '.$tglakhir.'<hr />';

	$filterdate = "and to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' ";
	
	$filterkantor = "";
	if($kdkantor!="ALL")
	$filterkantor = "and c.kdrayonpenagih='$kdkantor' ";
?>
<b>DAFTAR POLIS JS LINK <?=$titletrans;?><br /> </b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
		<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Pemegang Polis</td>
    <td bgcolor="#89acd8" align="center">Tertanggung</td>
    <td bgcolor="#89acd8" align="center">Kd.Produk</td>
    <td bgcolor="#89acd8" align="center">Premi</td>
    <td bgcolor="#89acd8" align="center">Top-Up Sekaligus</td>
		<td bgcolor="#89acd8" align="center">Top-Up Berkala</td>
		<td bgcolor="#89acd8" align="center">Redemption</td>
    <td bgcolor="#89acd8" align="center">Tgl. SP</td>
    <td bgcolor="#89acd8" align="center">Tgl. Transfer</td>
		<td bgcolor="#89acd8" align="center">Tgl. CMS</td>
		<td bgcolor="#89acd8" align="center">Tgl. BP3</td>
		<td bgcolor="#89acd8" align="center">Tgl. Trans. Link</td>
		<td bgcolor="#89acd8" align="center">Tgl. Send Niaga</td>
		<td bgcolor="#89acd8" align="center">Tgl. Conf. Niaga</td>
  </tr>
  <?
	$sql = "select ".
              "a.prefixpertanggungan,a.nopertanggungan,a.nopol,a.premi1,".
              "a.kdproduk,to_char(a.tglsp,'DD/MM/YYYY') as tglsp,to_char(a.tglbp3,'DD/MM/YYYY') as tglbp3,".
              "to_char(a.tgltransfer,'DD/MM/YYYY') as tgltransfer ".
          "from ".
							"$DBUser.tabel_200_pertanggungan a ".
					"where ". 
              "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$nopert'";
	echo $sql."<br /><br />";
	$DB->parse($sql);
	$DB->execute();
	$i=1;
  while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td><?=$i;?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
    <td><?=$arr["KDREKENINGLAWAN"];?></td>
  </tr>
	<? 
	$i++;
	}
	?>
</table>
<br />
<hr size="1" />
<a href="index.php">Menu Pelaporan</a>

</body>
</html>