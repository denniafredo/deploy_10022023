<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  include "../../includes/dropdown_date.php";
  $DB=new database($userid, $passwd, $DBName);
  $DBD=new database($userid, $passwd, $DBName);
			
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

  <? 
    if($act=="print"){
  ?>
  <body onLoad="window.print();window.close()">
  <?
  } else {
  ?>
  <body topmargin="10">

    <div id="filterbox">
    <form name="getpremi" action="<?=$PHP_SELF;?>" method="post">
      <table>
        <tr>
          <td>
            Tanggal Mutasi <?=ShowFromDateNoDay(5,"Future");?> <? //echo DateSelector("d"); ?> 
          </td>
          <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
       </tr>
      </table>
    <!--</form>-->

    </div>
  <? 
  }
  ?>
  <?
    if(!isset($month))
    {
    //  $tglcari = date('Ymd');
      //$tglcari = date('Ym');
      $tglcari = date('d/m/Y');
    }
    else
    {
      //$tglcari = $year.$month;
      $tglcari = "01/".$month."/".$year;
    } 
    ?>
    <b>DAFTAR JATUH TEMPO POLIS BPO<BR /> 
    BULAN <?=substr($tglcari,3,7);?> </b>
    <?
    if ($HTTP_POST_VARS['check']) {
      	
      	$box=$HTTP_POST_VARS['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				echo "No Data Updated !";
				}
				else
				{
    				foreach ($box as $dear) {
    				$sqa="update $DBUser.tabel_223_transaksi_switchfund set status='1',tglaksep=sysdate,useraksep='".$userid.
					"' WHERE nopertanggungan='$dear' ".
					"and to_char(tglpengajuan,'DD/MM/YYYY')='$tglcari'";
					$DB->parse($sqa);
      				$DB->execute();	
					//echo $sqa;				
        			}						
						}
				}
				?>
    <br />
    <br />
    <a class="myButton" href="#" onClick="window.open('./pop_bpo_dev.php?tglcari=<?=$tglcari;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		CETAK JATUH TEMPO POLIS BPO </a>&nbsp;
    <a class="myButton" href="#" onClick="window.open('./daftar_jt_bpo_dl_dev.php?tglcari=<?=$tglcari;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		DOWNLOAD JATUH TEMPO POLIS BPO</a>
    <br />
    <br />
		<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
      <tr bgcolor="#89acd8" align="center">
        <td>No.</td>    
    		<td>No. Polis</td>
        <td>Pemegang Polis</td>
        <td>Email</td>
        <td>No Telp.</td>
        <td>Produk</td>
    		<td>Tgl. Mulas</td>
    		<td>Premi</td>
        <td>Cara Bayar</td>
      	<td>Lunas Terakhir</td>
      	<td>Tertunggak</td>
      	<td>Mulai BPO</td>
      	<td>Agen Penutup</td>
      	<td>Tlp. Agen Penutup</td>
      	<td>Alamat</td>
      	<td>Kota</td>
        <td>Email Blast</td>
        <td>SMS Blast</td>
      	<td>Cetak</td>
      </tr>
    <? 
  
  if ($kantor == 'KP'){
    $carikantor = "";
  }else{
    $carikantor = "AND c.kdrayonpenagih = '".$kantor."'";
  }

	$sql = "
          SELECT c.kdrayonpenagih,
            b.prefixpertanggungan,
            b.nopertanggungan,
            d.namaproduk,
            b.kdproduk,
            (CASE   
              WHEN add_months(b.mulas,60)>sysdate then b.premi1             
              ELSE premi2
            END) premi1,
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
            (SELECT namaklien1
              FROM $DBUser.tabel_100_klien
              WHERE noklien = b.nopemegangpolis)
                pemegangpolis,
            -- (SELECT NVL(EMAILTAGIH,EMAILTETAP) EMAIL
            --   FROM $DBUser.tabel_100_klien
            --   WHERE noklien = b.nopemegangpolis)
            --     email,
            -- (SELECT NVL(NO_PONSEL, nvl(PHONETAGIH01,nvl(PHONETAGIH02,nvl(PHONETETAP01,PHONETETAP02)))) PHONE
            --   FROM $DBUser.tabel_100_klien
            --   WHERE noklien = b.nopemegangpolis)
            --     phone,
            (SELECT alamattagih01||' '||alamattagih02
              FROM $DBUser.tabel_100_klien
              WHERE noklien = b.nopemegangpolis) alamat,
            (SELECT namakotamadya 
              FROM $DBUser.tabel_100_klien x,$DBUser.TABEL_109_KOTAMADYA y 
              WHERE x.kdkotamadyatagih=y.kdkotamadya and noklien = b.nopemegangpolis) namakota, 
            (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=b.kdcarabayar) carabayar
          FROM  $DBUser.tabel_200_pertanggungan b,
                $DBUser.tabel_500_penagih c,
                $DBUser.tabel_202_produk d
          WHERE b.nopenagih = c.nopenagih
                AND b.kdstatusfile IN ('4')
                AND b.kdproduk = d.kdproduk
		            AND substr(b.kdproduk,1,2) not in ('JL')
                AND b.kdpertanggungan = '2'
                AND (b.lockmutasi !=  '11' or b.lockmutasi IS NULL) 
                ".$carikantor."
                AND TO_CHAR (b.tglbpo, 'MM/YYYY') = '".substr($tglcari,3,7)."'
          ORDER BY c.kdrayonpenagih, b.mulas";	
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr align = 'center' bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
        <td><?=$i;?></td>    
    		<td>
    		  <a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
    		  <?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a>
        </td>

        <?php
          $sqld = " 
                  SELECT b.id_blast,
                      b.jenis_blast,
                      NVL(TO_CHAR(a.TGL_KIRIM, 'DD/MM/YYYY'), TO_CHAR(a.TGL_KIRIM2, 'DD/MM/YYYY')) TGL_KIRIM, 
                      TO_CHAR(a.TGL_KIRIM_SMS, 'DD/MM/YYYY')TGL_KIRIM_SMS,
                      NVL(a.email, a.email2) EMAIL,
                      a.no_hp 
                  FROM $DBUser.PENERIMA_EMAIL_BLAST a,
                      $DBUser.EMAIL_BLAST_EVENT_TESTING b
                  WHERE a.id_blast = b.id_blast
                      AND a.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."' 
                      AND a.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'
                      AND TO_CHAR(a.tglbooked, 'DD/MM/YYYY') = '".$arr["TGLBPO"]."'
                      AND b.jenis_blast = 'PEMBERITAHUAN_POLIS_BPO'
                      AND b.id_blast = (SELECT MAX(id_blast) FROM $DBUser.EMAIL_BLAST_EVENT_TESTING WHERE jenis_blast = 'PEMBERITAHUAN_POLIS_BPO' AND TO_CHAR(TGL_EVENT, 'DD/MM/YYYY') = '".$arr["TGLBPO"]."')
                ";  
          //echo $sqld;
          $DBD->parse($sqld);
          $DBD->execute();
          while ($arrd=$DBD->nextrow()) {
            $email_blast = $arrd["TGL_KIRIM"];
            $sms_blast = $arrd["TGL_KIRIM_SMS"];
            $email = $arrd["EMAIL"];
            $no_hp = $arrd["NO_HP"];
          }
        ?>

        <td align="left"><?=$arr["PEMEGANGPOLIS"];?></td>
        <td><?=$email;?></td>
        <td><?=$no_hp;?></td>
    		<td><?=$arr["KDPRODUK"];?></td>
        <td><?=$arr["MULAS"];?></td>
      	<td align="right"><?php echo number_format($arr["PREMI1"],0,',','.');?></td>
      	<td><?=$arr["CARABAYAR"];?></td>
      	<td><?=$arr["LUNASTERAKHIR"];?></td>
      	<td align="right"><?php echo number_format($arr["TUNGGAKAN"],0,',','.');?></td>
      	<td><?=$arr["TGLBPO"];?></td>	
      	<td align="left"><?=$arr["AGENPENUTUP"];?></td>
      	<td><?=$arr["TLPAGENPENUTUP"];?></td>
      	<td align="left"><?=$arr["ALAMAT"];?></td>	
      	<td><?=$arr["NAMAKOTA"];?></td>
        <td><?=$email_blast;?></td>
        <td><?=$sms_blast;?></td>
        <?php
          if ($email_blast != "" || $sms_blast != ""){
            echo "<td> - </td>";
          }else{
        ?>
            <td>
              <a href="#" onClick="window.open('cetakjatuhtempobpo.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
              CETAK</a>
            </td>        
        <?php
          }
        ?>

      </tr>
    	<? 
    	$i++;
    	$jmltotal += $arr["PREMI"];
    	}
    	?>
	
    </table>
  </form>
  <? 
  if($act=="print"){

  } else {
    echo "<hr size=1>";
    echo "<a class=verdana10blk href=\"../mainmenu.php\">Menu Pelaporan</a>";
  }
  ?>
  </body>
</html>