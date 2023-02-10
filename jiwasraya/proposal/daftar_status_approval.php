<?
  include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/klien.php";
  include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";
  include "../../includes/kantor.php";

	$bln = (!$bl) ? $bln : '';
  $DB = new database($userid, $passwd, $DBName);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
  <head>
    <title>Informasi Status Approval Polis</title>
    <link href="../jws.css" rel="stylesheet" type="text/css">
    <? include "../../includes/hide.php";  ?>
    <script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
    <style type="text/css">
      <!-- 
      body{
       font-family: tahoma,verdana,geneva,sans-serif;
       font-size: 22px;
      }

      td{
       font-family: tahoma,verdana,geneva,sans-serif;
       font-size: 13px;
      }

      input     {font-family:tahoma,verdana,geneva,sans-serif; font-size: 12px; border-width: .2em;border-width: .2em;color:333333; border-radius:3px;padding:3px 12px;}
      select      {font-family:tahoma,verdana,geneva,sans-serif; font-size: 12px; border-style: groove; border-width: .2em;}
      textarea    {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

      a { color:#259dc5; text-decoration:none;}

      -->
    </style>

  </head>
  <body>
    <div align="left" style="display: block;">
      <form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
        <font face="Verdana" size="2"><b>INFORMASI STATUS APPROVAL POLIS</b></font>
        <hr size="1">
        <table cellpadding="3px" cellspacing="0" padding="10px 0 50px 0" border="0" align="left">
          <tr>
            <td align="left" class="arial10" width="45%">Periode (Mulai Asuransi)</td>
        		<td width="5%">:</td>
        		<td width="50%">
          		<select name="bl">
          		  <?
          			$bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember','SEMUA');
          			for ($i=1; $i<=13; $i++) {
          			   if ($i==$bl || $bulan[$i]==$bln) {
          				  print( "<option value=$i selected>".$bulan[$i]."</option>" );
          				 } else {
          				  print( "<option value=$i>".$bulan[$i]."</option>" );
          				 }	
          			}
          			?>
          		</select>
          		<select name="th">
          		  <?
          			$th=(!$th) ? substr($tanggal,-4) : $th;
          			$awalth = 2000;
          			for ($i=$awalth; $i<=substr($tanggal,-4); $i++) {
          			  if ($i==$th) {
          				  print( "<option value=$i selected>$i</option>" );
          				} else {
          				  print( "<option value=$i>$i</option>" );
          				}	
          			}
          			
          			?>
          		 </select>
        		</td>
        	</tr>
          <tr>
            <td align="left" class="arial10" width="45%">Status Approval</td>
        		<td width="5%">:</td>
        		<td width="50%">
        		  <select name="statusapproval">
		            <option value="0">ALL</option>
                <option value="1">Standar Non Medical</option>
                <option value="2">Standar Medical</option>
                <option value="3">Substandar Non Medical</option>
                <option value="4">Substandar Medical</option>
                <option value="X">Declined</option>
        		  </select>
        		</td>
        	</tr>
          <tr>
            <td align="left" class="arial10" width="45%">Kantor Agency Service Center</td>
            <td width="5%">:</td>
            <td width="50%">
              <select name="kdkantorcabang">
                <?php
                  $sql = "SELECT kdkantor || ' - ' || namakantor AS nmkantor, kdkantor
                          FROM $DBUser.TABEL_001_KANTOR WHERE kdjeniskantor = '2' AND kdkantor not IN ('KM', 'KN')
                          ORDER BY kdkantor ASC ";
                  $DB->parse($sql);
                  $DB->execute();
                  echo"<option value=''>ALL</option>";
                  while ($arr=$DB->nextrow()) {
                    echo "<option value='".$arr['KDKANTOR']."'>".$arr['NMKANTOR']."</option>";
                  }
                ?>                
              </select>
            </td>
          </tr>
        	<tr>
            <td colspan="2"></td>
        		<td><input name="cari" value="Cari" type="submit"></td>
        	</tr>
        </table>
      
        <table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%">
          <tr>
            <td class="tblhead" align="center"><b>DAFTAR STATUS APPROVAL PROPOSAL</b></td>
          </tr>
          <tr>
            <td class="tblisi" align="center">
              <table  width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="hijao" align="center">
                  <td>No</td>
                  <td>Nomor Polis</td>
                  <td>Nama Pemegang Polis</td>
                  <td>Nama Tertanggung</td>
                  <td>Produk</td>
                  <td>Tanggal Mulai Asuransi</td>
                  <td>Tanggal Approval</td>
                  <td>Status Approval</td>
                </tr>
                <?php
                    if(isset($_POST['cari'])){
                    if($bl<10){
                      $tglcari = "0".$bl."/".$th;
                    }else{
                      $tglcari = $bl."/".$th;
                    }
                    if($kdkantorcabang == ''){
                      $carikantor = "";
                    }else{
                      $carikantor = "AND a.prefixpertanggungan = '$kdkantorcabang' ";
                    }

                    if($statusapproval == '0'){
                      $caristatusapproval = "";
                    }else{
                      $caristatusapproval = "AND a.kdjenisapproval = '$statusapproval' ";
                    }

                    $sql = "SELECT a.prefixpertanggungan, b.nopertanggungan, b.nopolbaru, c.namaklien1 AS nama_cpp, d.namaklien1 AS nama_ctt, b.kdproduk, 
                              to_char(b.mulas,'DD/MM/YYYY') mulas,
                              CASE
                                WHEN KDJENISAPPROVAL = '1' THEN 'Standar Non Medical'
                                WHEN KDJENISAPPROVAL = '2' THEN 'Standar Medical'
                                WHEN KDJENISAPPROVAL = '3' THEN 'Substandar Non Medical'
                                WHEN KDJENISAPPROVAL = '4' THEN 'Substandar Medical'
                                WHEN KDJENISAPPROVAL = 'X' THEN 'Decine'
                              END KDJENISAPPROVAL,
                              to_char((select tglunderwriting from $DBUser.TABEL_214_UNDERWRITING where prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan),'DD/MM/YYYY') tglunderwriting
                            FROM $DBUser.TABEL_214_APPROVAL_PROPOSAL a,
                              $DBUser.TABEL_200_PERTANGGUNGAN b,
                              $DBUser.TABEL_100_KLIEN c,
                              $DBUser.TABEL_100_KLIEN d
                            WHERE
                              a.prefixpertanggungan = b.prefixpertanggungan AND a.nopertanggungan = b.nopertanggungan
                              AND b.nopemegangpolis = c.noklien
                              AND b.notertanggung = d.noklien
                              $carikantor
                              $caristatusapproval
                              AND to_char(b.mulas, 'MM/YYYY') = '$tglcari' 
                            ";
                    //echo $sql;
                    $DB->parse($sql);
                    $DB->execute();
                    $i=1;
                    while ($arry=$DB->nextrow()) {
                ?>
                      <tr align="center">
                        <td><?=$i;?></td>
                        <td><?=($arry['NOPOLBARU'] ? $arry['NOPOLBARU'] : "$arry[PREFIXPERTANGGUNGAN]-$arry[NOPERTANGGUNGAN]")?></td>
                        <td align="left"><?=$arry['NAMA_CPP'];?></td>
                        <td align="left"><?=$arry['NAMA_CTT'];?></td>
                        <td><?=$arry['KDPRODUK'];?></td>
                        <td><?=$arry['MULAS'];?></td>
                        <td><?=$arry['TGLUNDERWRITING'];?></td>
                        <td><?=$arry['KDJENISAPPROVAL'];?></td>
                      </tr>
                <?php
                    $i++;
                    }
                  }
                ?>
              </table>
            </td>
          </tr>
        </table>

        <table width="100%" style="background-color: white">
          <tr>
            <td width="50%" align="left"><a href="../polisserv.php"><font face="Verdana" size="2">Menu Pemeliharaan Polis</font></a></td>
            <td width="50%" align="right"><a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a></td>
          </tr>
        </table>
      </div>
  </body>
</html>