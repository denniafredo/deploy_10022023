<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  include "../../includes/dropdown_date.php";
  
  $userid="jsadm";
  $passwd="jsadmoke";
  $DB=new database($userid, $passwd, $DBName);
  $DBD=new database($userid, $passwd, $DBName);
  
  function DateSelector($inName, $useDate=0) 
  {
    if($useDate == 0)
    {
      $useDate = Time();
    } 
    $selected = (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
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
  
    //Bulan 
      $selected = (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);     
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
      $selected = (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);     
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
    <title>Daftar Pemberitahuan Tagihan Pinjaman</title>
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
    input     {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:1px; }
    select      {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
    textarea    {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

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
    <b>DAFTAR PEMBERITAHUAN TAGIHAN GADAI<BR /> 
    BULAN <?=substr($tglcari,3,7);?> </b>
    <br />
    <br />
    <!-- <a class="myButton" href="#" onClick="window.open('./pop_bpo_dev.php?tglcari=<?=$tglcari;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
    CETAK JATUH TEMPO POLIS BPO </a>&nbsp;
    <a class="myButton" href="#" onClick="window.open('./daftar_jt_bpo_dl_dev.php?tglcari=<?=$tglcari;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
    DOWNLOAD JATUH TEMPO POLIS BPO</a> -->
    <br />
    <br />
    <table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
      <tr bgcolor="#89acd8" align="center">
        <td>No.</td>    
        <td>No. Polis</td>
        <td>Pemegang Polis</td>
        <td>Email</td>
        <td>No Telp.</td>
        <td>Tgl. Gadai</td>
        <td>Tgl. Booked</td>
        <td>Pokok Pinjaman</td>
        <td>Bunga Pinjaman</td>
        <td>Total Pinjaman</td>
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
    $carikantor = "AND d.kdrayonpenagih = '".$kantor."'";
  }

  $sql = "
          SELECT
                d.kdrayonpenagih,
                a.prefixpertanggungan,
                a.nopertanggungan,
                e.namaklien1 AS PEMEGANGPOLIS,
                to_char(f.tglgadai, 'DD/MM/YYYY') tglgadai,
                to_char(f.tglbooked, 'DD/MM/YYYY') tglbooked,
                e.alamattagih01||' '||e.alamattagih02 AS alamat,
                (SELECT namakotamadya
                    FROM $DBUser.TABEL_109_KOTAMADYA y
                    WHERE e.kdkotamadyatagih=y.kdkotamadya and noklien = c.nopemegangpolis) namakota, 
                NVL(e.emailtagih, e.emailtetap) email,
                NVL(e.phonetagih01, e.phonetetap01) nohp,
                CASE
                    WHEN a.kdvaluta = 3 THEN ((f.saldopinjaman + NVL(f.kapitalisasi, 0) + NVL(f.bunga, 0) - NVL(f.angsuranpokok, 0)) * (select kurs from tabel_999_kurs_transaksi where kdvaluta='3' and tglkursberlaku = (select max(tglkursberlaku) from tabel_999_kurs_transaksi where kdvaluta='3'))) 
                    WHEN a.kdvaluta != 3 THEN (f.saldopinjaman + NVL(f.kapitalisasi, 0) + NVL(f.bunga, 0) - NVL(f.angsuranpokok, 0))
                END AS AMOUNT,
                CASE
                    WHEN a.kdvaluta = 3 THEN ((f.saldopinjaman + NVL(f.kapitalisasi, 0) - NVL(f.angsuranpokok, 0)) * (select kurs from tabel_999_kurs_transaksi where kdvaluta='3' and tglkursberlaku = (select max(tglkursberlaku) from tabel_999_kurs_transaksi where kdvaluta='3'))) 
                    WHEN a.kdvaluta != 3 THEN (f.saldopinjaman + NVL(f.kapitalisasi, 0) - NVL(f.angsuranpokok, 0))
                END AS AMOUNTPOKOK,
                CASE
                    WHEN a.kdvaluta = 3 THEN ((NVL(f.bunga, 0)) * (select kurs from tabel_999_kurs_transaksi where kdvaluta='3' and tglkursberlaku = (select max(tglkursberlaku) from tabel_999_kurs_transaksi where kdvaluta='3'))) 
                    WHEN a.kdvaluta != 3 THEN (NVL(f.bunga, 0))
                END AS AMOUNTBUNGA
            FROM $DBUser.tabel_200_pertanggungan c, 
                $DBUser.tabel_700_gadai a, 
                $DBUser.tabel_500_penagih d, 
                $DBUser.tabel_999_kode_status b, 
                $DBUser.tabel_100_klien e,
                $DBUser.tabel_701_pelunasan_gadai f,
                $DBUser.tabel_001_kantor g
            WHERE 
                a.prefixpertanggungan=c.prefixpertanggungan 
                and a.nopertanggungan=c.nopertanggungan and c.nopenagih=d.nopenagih 
                and a.prefixpertanggungan = g.kdkantor
                and a.status=b.kdstatus and c.nopemegangpolis = e.noklien
                and a.prefixpertanggungan=f.prefixpertanggungan and a.nopertanggungan=f.nopertanggungan
                and a.tglgadai = (select max(tglgadai) from $DBUser.tabel_700_gadai where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and status='3' group by nopertanggungan)
                and a.tglgadai = f.tglgadai
                and b.jenisstatus='GADAI'
                and f.saldopinjaman > 0
                and a.status = '3'
                and c.kdstatusfile = '1'
                AND (c.lockmutasi !=  '11' or c.lockmutasi IS NULL) 
                ".$carikantor."
                AND TO_CHAR (f.tglbooked, 'MM/YYYY') = '".substr($tglcari,3,7)."'
                and f.tglrekam = (SELECT max(tglrekam) from $DBUser.tabel_701_pelunasan_gadai where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                AND tglgadai=a.tglgadai
                AND TO_CHAR (tglbooked, 'MM/YYYY') = '".substr($tglcari,3,7)."'
                 group by nopertanggungan)
          ORDER BY d.kdrayonpenagih, a.prefixpertanggungan, a.nopertanggungan";  
    //echo "<br />".$sql."<br />";
    $DB->parse($sql);
    $DB->execute();       
    $i = 1;
    while ($arr=$DB->nextrow()) {
    echo "<tr align='center' bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
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
                      TO_CHAR(a.TGL_KIRIM, 'DD/MM/YYYY')TGL_KIRIM, 
                      TO_CHAR(a.TGL_KIRIM_SMS, 'DD/MM/YYYY')TGL_KIRIM_SMS,
                      TO_CHAR(b.TGL_EVENT, 'MM')BULAN, 
                      TO_CHAR(b.TGL_EVENT, 'YYYY')TAHUN,
                      a.email,
                      a.no_hp 
                  FROM $DBUser.PENERIMA_EMAIL_BLAST a,
                      $DBUser.EMAIL_BLAST_EVENT_TESTING b
                  WHERE a.id_blast = b.id_blast
                      AND a.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."' 
                      AND a.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'
                      AND TO_CHAR(a.tglbooked, 'DD/MM/YYYY') = '".$arr["TGLBOOKED"]."'
                      AND b.jenis_blast = 'PEMBERITAHUAN_POSISI_GADAI'
                      AND b.id_blast = (SELECT MAX(id_blast) FROM $DBUser.EMAIL_BLAST_EVENT_TESTING WHERE jenis_blast = 'PEMBERITAHUAN_POSISI_GADAI' AND TO_CHAR(TGL_EVENT, 'DD/MM/YYYY') = '".$arr["TGLBOOKED"]."')
                ";  
          //echo $sqld;
          $DBD->parse($sqld);
          $DBD->execute();
          while ($arrd=$DBD->nextrow()) {
            $email_blast = $arrd["TGL_KIRIM"];
            $sms_blast = $arrd["TGL_KIRIM_SMS"];
            $bulan = $arrd['BULAN'];
            $tahun = $arrd['TAHUN'];
            $email = $arrd["EMAIL"];
            $no_hp = $arrd["NO_HP"];
          }
        ?>

        <td align="left"><?=$arr["PEMEGANGPOLIS"]?></td>
        <td><?=$email?></td>
        <td><?=$no_hp?></td>
        <td><?=$arr["TGLGADAI"]?></td>
        <td><?=$arr["TGLBOOKED"]?></td>
        <td align="right"><?php echo number_format($arr["AMOUNTPOKOK"],0,',','.');?></td>
        <td align="right"><?php echo number_format($arr["AMOUNTBUNGA"],0,',','.');?></td>
        <td align="right"><?php echo number_format($arr["AMOUNT"],0,',','.');?></td>
        <td align="left"><?=$arr["ALAMAT"]?></td>
        <td><?=$arr["NAMAKOTA"]?></td>
        <td><?=$email_blast;?></td>
        <td><?=$sms_blast;?></td>
        <?php
          if ($email_blast != "" || $sms_blast != ""){
            echo "<td> - </td>";
          }elseif ($email_blast === NULL || $sms_blast === NULL){
        ?>
          <td>
            <a href="../akunting/kartugadai_cetak.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>&year1=&month1=&month2=&year2=&tglgadai=<?=$arr["TGLGADAI"];?>" target="_blank">
              CETAK</a>
          </td>
        <?php  
          }else{
        ?>
            <td>
              <a href="email/pdf_gadai/<?=$tahun?>/<?=$bulan.$tahun;?>_SURAT_PEMBERITAHUAN_GADAI_<?=$arr["PREFIXPERTANGGUNGAN"];?><?=$arr["NOPERTANGGUNGAN"];?>.pdf" target="_blank">
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