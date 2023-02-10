<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
  include "../../includes/common.php";
  include "../../includes/monthselector.php";
  include "../../includes/pertanggungan.php";
    
  $DB=New Database($userid, $passwd, $DBName);
  $DB2 = New Database($userid, $passwd, $DBName); 
  $DB3 = New Database($userid, $passwd, $DBName); 

?>
  <link href="../jws.css" rel="stylesheet" type="text/css">
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
  <font face=verdana size=2><b>PROSES UNDERWRITING/APPROVAL (KP)</b><br>
    Kantor  : <?echo $kantor;?>
  </font>
  <hr size=1>
  
  <?
    function ShowFromDate($year_interval,$YearIntervalType) {
    GLOBAL $daydari,$monthdari,$yeardari;

    //MONTH
    echo "<select name=monthdari>\n";
    $i=1;
    $CurrMonth=date("m");
    while ($i <= 12)
    {
      switch($i)
      {
        case 1: $namabulandari = "JANUARI"; break;
        case 2: $namabulandari = "PEBRUARI"; break;
        case 3: $namabulandari = "MARET"; break;
        case 4: $namabulandari = "APRIL"; break;
        case 5: $namabulandari = "MEI"; break;
        case 6: $namabulandari = "JUNI"; break;
        case 7: $namabulandari = "JULI"; break;
        case 8: $namabulandari = "AGUSTUS"; break;
        case 9: $namabulandari = "SEPTEMBER"; break;
        case 10: $namabulandari = "OKTOBER"; break;
        case 11: $namabulandari = "NOVEMBER"; break;
        case 12: $namabulandari = "DESEMBER"; break;
        default : $namabulandari = $i;
      }

      If(IsSet($monthdari)) {
        If($monthdari == $i || ($i == substr($monthdari,1,1) && (substr($monthdari,0,1) == 0))) {
          $n = (strlen($i)==1) ? "0$i" : "$i";
          echo "<option value=$n selected>$namabulandari\n";
          $i++;
        }Else{
          If($i<10) {
            echo "<option value=0$i>$namabulandari\n";
          }Else {
            echo "<option value=$i>$namabulandari\n";
          }
          $i++;
        }
      }Else {
        If($i == $CurrMonth) {
          If($i<10) {
            echo "<option value=0$i selected>$namabulandari\n";
          }Else {
            echo "<option value=$i selected>$namabulandari\n";
          }
        }Else {
          If($i<10){
            echo "<option value=0$i>$namabulandari\n";
          }Else {
            echo "<option value=$i>$namabulandari\n";
          }
        }
        $i++;
      }
    }
    echo "</select>\n";
  
    //YEAR
    echo "<select name=yeardari>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
      $i=$CurrYear-$year_interval+1;
      while ($i <= $CurrYear)
      {
                If($i == $yeardari) {
                    echo "<option selected> $i\n";
                }ElseIf ($i == $CurrYear && !IsSet($yeardari)) {
                    echo "<option selected> $i\n";
                }Else {
                    echo "<option> $i\n";
                }
                $i++;
              }
          echo "</select>\n";
      }
      If($YearIntervalType == "Future") {
          $i=$CurrYear+$year_interval;
          while ($CurrYear < $i)
              {
                if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                  else echo "<option> $CurrYear\n";
                 $CurrYear++;
              }
          echo "</select>\n";
      }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
            {
                if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
                $i++;
            }
        echo "</select>\n";
    }
  }
  
  if(isset($monthdari))
  {
    $bulancaridari = $monthdari.$yeardari;
  }
  else
  {
    $monthdari=date("m");
    $yeardari=date("Y");
    $bulancaridari = $monthdari.$yeardari;
  }

  if ($kdbank=="MDR"){
    switch($periodedari)
    {
      case '1' : $tglstartdari="01"; $tglenddari="10"; $s1="selected"; break; 
      case '2' : $tglstartdari="11"; $tglenddari="20"; $s2="selected"; break;
      case '3' : $tglstartdari="21"; $tglenddari="31"; $s3="selected"; break;  
    }
  }
  else{
    switch($periodedari)
    {
      case '1' : $tglstartdari="01"; $tglenddari="13"; $s1="selected"; break; 
      case '2' : $tglstartdari="14"; $tglenddari="23"; $s2="selected"; break;
      case '3' : $tglstartdari="24"; $tglenddari="31"; $s3="selected"; break;  
    }
  }
  
  if(isset($periodedari))
  {
    $bulancaridari = $monthdari.$yeardari;
    $tglawaldari   = $periodedari."/".$monthdari."/".$yeardari;
  }
  else
  {
    $monthdari=date("m");
    $yeardari=date("Y");
    $bulancaridari = $monthdari.$yeardari;
    $tglawaldari   = $yeardari.$monthdari.'01';
  }
  
  switch($monthdari)
  {
    case '01': $namabulandari = "JANUARI"; break;
    case '02': $namabulandari = "PEBRUARI"; break;
    case '03': $namabulandari = "MARET"; break;
    case '04': $namabulandari = "APRIL"; break;
    case '05': $namabulandari = "MEI"; break;
    case '06': $namabulandari = "JUNI"; break;
    case '07': $namabulandari = "JULI"; break;
    case '08': $namabulandari = "AGUSTUS"; break;
    case '09': $namabulandari = "SEPTEMBER"; break;
    case '10': $namabulandari = "OKTOBER"; break;
    case '11': $namabulandari = "NOVEMBER"; break;
    case '12': $namabulandari = "DESEMBER"; break;
  }

  function ShowToDate($year_interval,$YearIntervalType) {
      GLOBAL $daysampai,$monthsampai,$yearsampai;

      //MONTH
      echo "<select name=monthsampai>\n";
      $i=1;
      $CurrMonth=date("m");
      while ($i <= 12)
      {
        switch($i)
        {
          case 1: $namabulansampai = "JANUARI"; break;
          case 2: $namabulansampai = "PEBRUARI"; break;
          case 3: $namabulansampai = "MARET"; break;
          case 4: $namabulansampai = "APRIL"; break;
          case 5: $namabulansampai = "MEI"; break;
          case 6: $namabulansampai = "JUNI"; break;
          case 7: $namabulansampai = "JULI"; break;
          case 8: $namabulansampai = "AGUSTUS"; break;
          case 9: $namabulansampai = "SEPTEMBER"; break;
          case 10: $namabulansampai = "OKTOBER"; break;
          case 11: $namabulansampai = "NOVEMBER"; break;
          case 12: $namabulansampai = "DESEMBER"; break;
          default : $namabulansampai = $i;
        }
         
          If(IsSet($monthsampai)) {
              If($monthsampai == $i || ($i == substr($monthsampai,1,1) && (substr($monthsampai,0,1) == 0))) {
                  $n = (strlen($i)==1) ? "0$i" : "$i";
          echo "<option value=$n selected>$namabulansampai\n";
                $i++;
              }Else{
            If($i<10) {
                    echo "<option value=0$i>$namabulansampai\n";
                  }Else {
                    echo "<option value=$i>$namabulansampai\n";
                  }
                  $i++;
              }
          }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                    echo "<option value=0$i selected>$namabulansampai\n";
                  }Else {
                      echo "<option value=$i selected>$namabulansampai\n";
                  }
              }Else {
                  If($i<10){
                      echo "<option value=0$i>$namabulansampai\n";
            }Else {
                      echo "<option value=$i>$namabulansampai\n";
                  }
              }
              $i++;
          }
    }
    echo "</select>\n";
      
    //YEAR
    echo "<select name=yearsampai>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
        {
            If($i == $yearsampai) {
                echo "<option selected> $i\n";
            }ElseIf ($i == $CurrYear && !IsSet($yearsampai)) {
                echo "<option selected> $i\n";
            }Else {
                echo "<option> $i\n";
            }
            $i++;
        }
        echo "</select>\n";
    }
    If($YearIntervalType == "Future") {
      $i=$CurrYear+$year_interval;
      while ($CurrYear < $i)
        {
            if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
            else echo "<option> $CurrYear\n";
            $CurrYear++;
        }
      echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
      $i=$CurrYear-$year_interval+1;
      while ($i < $CurrYear+$year_interval)
        {
            if ($i == $CurrYear) echo "<option selected> $i\n";
            else echo "<option> $i\n";
            $i++;
        }
      echo "</select>\n";
    }
  }
      
  if(isset($monthsampai))
  {
    $bulancarisampai = $monthsampai.$yearsampai;
  }
  else
  {
    $monthsampai=date("m");
    $yearsampai=date("Y");
    $bulancarisampai = $monthsampai.$yearsampai;
  }

  if(isset($periode))
  {
    $bulancari = $month.$year;
    $tglawal   = $year.$month.$tglstart;
    $tglakhir  = $year.$month.$tglend;
  }
  else
  {
    $month=date("m");
    $year=date("Y");
    $bulancari = $month.$year;
    $tglawal   = $year.$month.'01';
    $tglakhir  = $year.$month.'10';
  }
  if(isset($periodesampai))
  {
    $bulancarisampai = $monthsampai.$yearsampai;
    $tglakhirsampai  = $periodesampai."/".$monthsampai."/".$yearsampai;
  }
  else
  {
    $monthsampai=date("m");
    $yearsampai=date("Y");
    $bulancarisampai = $monthsampai.$yearsampai;
    $tglakhirsampai  = $yearsampai.$monthsampai.'10';
  } 
  switch($month)
  {
    case '01': $namabulan = "JANUARI"; break;
    case '02': $namabulan = "PEBRUARI"; break;
    case '03': $namabulan = "MARET"; break;
    case '04': $namabulan = "APRIL"; break;
    case '05': $namabulan = "MEI"; break;
    case '06': $namabulan = "JUNI"; break;
    case '07': $namabulan = "JULI"; break;
    case '08': $namabulan = "AGUSTUS"; break;
    case '09': $namabulan = "SEPTEMBER"; break;
    case '10': $namabulan = "OKTOBER"; break;
    case '11': $namabulan = "NOVEMBER"; break;
    case '12': $namabulan = "DESEMBER"; break;
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
  <body>
    <form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
      <a class="verdana10blk">Pilih Periode</a>
      <select name="periodedari">
        <?php
          for ($i = 1; $i <= 31; $i++) {
            if ($i < 10){
            ?><option value="<? echo '0'.$i;?>" ><? echo '0'.$i;?></option>
            <?php       
            }
            else{
            ?><option value="<?=$i;?>" ><?=$i;?></option>
            <?php

            }
          }
        ?>
      </select>
        <?  ShowFromDate(10,"Past"); ?>
        <a class="verdana10blk"> s/d Periode </a> 
      <select name="periodesampai">
        <?php
          for ($i = 1; $i <= 31; $i++) {
            if ($i < 10){
              ?><option value="<? echo '0'.$i;?>" ><? echo '0'.$i;?></option>
              <?php       
            }
            else{
              ?><option value="<?=$i;?>" ><?=$i;?></option>
              <?php
            }
          }
        ?>
      </select>
        <!--<a class="verdana10blk">Bulan</a>--> 
        <?  ShowToDate(10,"Past"); ?>
      <input type="submit" name="submit" value="Cari">
    </form>

    <? if ($submit){ ?>
      <hr size=1>
      <div align="center">
        <font color=003399 face=verdana size=3><b>Daftar Mutasi Proses Underwriting</b></font><br>        
        <table border="1" width="100%" cellspacing="1" cellpadding="2" style="font-family: 'verdana'; font-size: 12px">
          <tr bgcolor="#C2CAED" align="center" style="font-style: bold">
            <td>NO</td>
            <td>NOMOR POLIS</td>
            <td>STATUS</td>
            <td>KATEGORI</td>
            <td>KETERANGAN</td>
            <td>SUMBER</td>
            <td>USER</td>
            <td>TANGGAL</td>
          </tr>
          <? 
            $sql = "SELECT a.prefixpertanggungan, a.nopertanggungan, 
            			a.nopolbaru,
            		  	a.userrekam, 
                      to_char(a.tglrekam, 'DD/MM/YYYY hh24:mi') tglrekam, 
                      to_char(a.tglsendemail, 'DD/MM/YYYY hh24:mi') tglsendemail,
                      (SELECT to_char(tglunderwriting, 'DD/MM/YYYY hh24:mi') FROM $DBUser.TABEL_214_UNDERWRITING WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan 
                      --AND kdunderwriting = '1'
                      ) tglapprove,
                      (SELECT userupdated FROM $DBUser.TABEL_214_UNDERWRITING WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan 
                      --AND kdunderwriting = '1'
                      ) userapprove
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN a
                    WHERE a.kdstatusfile IN ('1', '5', '4', '6', '7', 'X', 'A') 
                      AND to_date(a.TGLREKAM) >= to_date('".$tglawaldari."', 'dd/mm/yyyy')
                      AND to_date(a.TGLREKAM) <= to_date('".$tglakhirsampai."', 'dd/mm/yyyy')
                    ORDER BY a.prefixpertanggungan, a.nopertanggungan
                  ";
            //echo $sql;
            $DB2->parse($sql);
            $DB2->execute();
            while ($arr=$DB2->nextrow()) {
              echo ("<tr>
                  <td align='center'>1</td>
                  <td>".$arr['NOPOLBARU']."</td>
                  <td>Entry SPAJ</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>".$arr['USERREKAM']."</td>
                  <td align='center'>".$arr['TGLREKAM']."</td>
                </tr>               
              ");
              $subsql="SELECT prefixpertanggungan, nopertanggungan, status, kategoripending, keterangan, sumberpending, userrekam, to_char(tglrekam, 'DD/MM/YYYY hh24:mi')tglrekam 
              			FROM $DBUser.TABEL_216_HISTORIS_MUTASI_UW
                        WHERE PREFIXPERTANGGUNGAN = '".$arr['PREFIXPERTANGGUNGAN']."'
                          AND NOPERTANGGUNGAN = '".$arr['NOPERTANGGUNGAN']."' 
                        ORDER BY TGLREKAM ASC ";
                  //echo $subsql;
              $DB3->parse($subsql);
              $DB3->execute();
              $i=2;
              while ($arry=$DB3->nextrow()) {
                echo ("<tr>
                    <td align='center'>".$i."</td>
                    <td>".$arr['NOPOLBARU']."</td>
                    <td>".$arry['STATUS']."</td>
                    <td>".$arry['KATEGORIPENDING']."</td>
                    <td>".$arry['KETERANGAN']."</td>
                    <td>".$arry['SUMBERPENDING']."</td>
                    <td>".$arry['USERREKAM']."</td>
                    <td align='center'>".$arry['TGLREKAM']."</td>
                  </tr>"
                );
                $i++;
              }
              $userapprove = $arr['USERAPPROVE'];
              $tglapprove = $arr['TGLAPPROVE'];
              if($tglapprove == ''){
                echo "";
              }else{
                echo ("
                  <tr>
                    <td align='center'>".$i."</td>
                    <td>".$arr['NOPOLBARU']."</td>
                    <td>Approved</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>".$userapprove."</td>
                    <td align='center'>".$tglapprove."</td>
                  </tr>
                ");
              }
            }
          ?>
        </table>
      </div>
    <? }
      echo "<hr size=1>";
    ?>
    <table width="100%" style="background-color: white">
      <tr>
        <td width="50%" align="left"><a href="../polisserv.php"><font face="Verdana" size="2">Menu Pemeliharaan Polis</font></a></td>
        <td width="50%" align="right"><a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a></td>
      </tr>
    </table>
  </body>
</html>