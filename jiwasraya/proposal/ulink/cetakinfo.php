<?
 include "./includes/database.php";
 include "./includes/session.php";
 include "./includes/klien.php";
 include "./includes/pertanggungan.php";
 include "./includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);	
 
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 
// $sql = "select * from $DBUser.TABEL_UL_SPAJ_TEMP a, $DBUser.tabel_100_klien b
//         where a.nopemegangpolis=b.noklien and nosp='$sp'";
 $sql = "select to_char(sysdate,'dd/mm/yyyy') tgl,a.* from $DBUser.TABEL_UL_SPAJ_TEMP a
         where nosp='$sp'";

		//echo $sql;

 $DB->parse($sql);
 $DB->execute();
 $row=$DB->nextrow();
 
?>
<title>Konfirmasi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">


<style type="text/css">
<!--
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style5 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.style7 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style8 {font-size: 10px}
.style10 {font-family: Arial}
.style11 {font-size: 12px}
-->
</style>
<body onLoad="alert('Untuk menghilangkan header dan footer, Klik File>Page Setup, Kosongkan kolom header dan footer!');">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
  <tr>
        <td height="27" class="style5"></td>
        <td colspan="2" class="style5"></td>
      </tr>
      <tr>
        <td height="27" class="style5"></td>
        <td colspan="2" class="style5"></td>
      </tr>
  <tr>
    <td width="100%" style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1"><table width="100%" border="0" cellspacing="0" cellpadding="3">
       <tr>
        <td width="3%" height="27" class="style5">&nbsp;</td>
        <td width="59%" class="style5"><img src="./images/LogoJS.png"  height="140" width="180"></td>
        <td width="38%" class="style5"><div align="right" class="style8"><b><span class="style10">PT ASURANSI JIWA IFG</br>
              <?=$KTR->namakantor.'</b></br>'.$KTR->alamat01.'</br>'.$KTR->alamat02.'</br>'.$KTR->phone01;?>
              </br>
              <b>www.ifg-life.co.id</b>
          </span></div></td>
       </tr>
      <tr>
        <td height="27" class="style5"></td>
        <td colspan="2" class="style5"></td>
      </tr>
      <tr>
        <td height="27" class="style5">&nbsp;</td>
        <td colspan="2" class="style5"></td>
      </tr>
      <tr>
        <td height="27" class="style5">&nbsp;</td>
        <td colspan="2" class="style5"><div align="right"><?=ucwords(strtolower($KTR->kotamadya)).', '.$row["TGL"];?> </div></td>
      </tr>
    </table>
    <div align="justify" class="style5">      
        <p>Kepada Yth.<br>
          Bapak/Ibu.<?=$row["NAMAPEMPOL"];?>
          <br>
        <table width="300">
          <tr><td width="300"> 
          <?=$row["ALAMAT"];?>
          </td></tr></table>
          <br>
          <?=$row["KOTA"];?>
          <br>
          <br>
          <br>
          </font></p>
        <p class="style5">Dengan hormat, </p>
    </div>
    <p align="justify" class="style5">Kami mengucapkan terima kasih atas kepercayaan Bapak/Ibu yang telah bergabung bersama PT Asuransi Jiwa IFG melalui Produk Asuransi.</p>
    <p align="justify" class="style5">Bersama ini kami informasikan bahwa kami telah menerima SPAJ No.<?=$row["NOSP"];?>, Proposal Penawaran / POS dan Copy Kartu Identitas an. <?=$row["NAMAPEMPOL"];?> yang selanjutnya akan kami proses lebih lanjut.</p>
    <p align="justify" class="style5">Kami berbahagia melayani Bapak/Ibu dan terimakasih atas kepercayaan serta kerjasama selama ini.</p>
    <p align="justify" class="style5">Hormat kami, <br>
      PT ASURANSI JIWA IFG<br>
       <?=$KTR->namakantor;?><br><br><br><br><br>
	   <?=$KTR->branchmanager;?>
	   <br><?=$KTR->jabatanmanager;?>
      
    </p>
    
    <p align="justify" class="style2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p>    </td>
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>