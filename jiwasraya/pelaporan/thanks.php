<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  
  $DB = new Database($userid, $passwd, $DBName);
	
 $sql  = "select a.noklien,a.namaklien1,a.tgllahir,a.alamattetap01,b.nosp,b.tglsp,".
         "b.kdproduk,b.juamainproduk,b.mulas,b.lamaasuransi_th,b.kdcarabayar,b.premi1,b.nobp3 ".
         "from $DBUser.tabel_100_klien a,$DBUser.tabel_200_pertanggungan b where b.nopertanggungan='000000085'";
	$DB->parse($sql);
	$DB->execute();
	if($arr=$DB->nextrow()) {
	  $noklien=$arr["NOKLIEN"];
		$namaklien=$arr["NAMAKLIEN1"];
		$tgllahir=$arr["TGLLAHIR"];
		$alamat=$arr["ALAMATTETAP01"];
		$nobp3=$arr["NOBP3"];
		$nosp=$arr["NOSP"];
		$tglsp=$arr["TGLSP"];
		$kdproduk=$arr["KDPRODUK"];
		$juamainproduk=$arr["JUAMAINPRODUK"];
		$mulas=$arr["MULAS"];
		$lamaasuransi=$arr["LAMAASURANSI_TH"];
		$kdcarabayar=$arr["KDCARABAYAR"];
		$premi=$arr["PREMI1"];
  }
?>
<html>
<head>
<title>Ucapan Terima Kasih</title>
</head>
<body>
<table border="0" width="100%">
  <tr>
    <td width="100%">
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="12%"><font face="Arial" size="2">Nomor</font></td>
          <td width="88%"><font face="Arial" size="2">: <? echo "$noklien";?></font></td>
        </tr>
        <tr>
          <td width="12%"><font face="Arial" size="2">&nbsp;&nbsp;</font></td>
          <td width="88%"></td>
        </tr>
        <tr>
          <td width="12%"><font face="Arial" size="2">Kepada Yth :</font></td>
          <td width="88%"></td>
        </tr>
        <tr>
          <td colspan="2"><font face="Arial" size="2"><b><? echo "$namaklien";?></b></font></td>
        </tr>
        <tr>
          <td colspan="2"><font face="Arial" size="2"><? echo "$alamat";?></font></td>
        </tr>
        <tr>
          <td colspan="2"	><font face="Arial" size="2"><? echo "$nosp, $tglsp";?></font></td>
        </tr>
        <tr>
          <td width="12%"><font face="Arial" size="2">Perihal</font></td>
          <td width="88%"><font face="Arial" size="2">: Ucapan Terima Kasih</font></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%"></td>
  </tr>
  <tr>
    <td width="100%"><font face="Arial" size="2">Dengan Hormat,<br>
      &nbsp; <br>
      Diberitahukan bahwa kami telah menerima Surat Permintaan Asuransi Jiwa
      dari Bapak/Ibu tertanggal <? echo "$tglsp";?> untuk itu kami sampaikan selamat atas
      keputusan yang tepat untuk bergabung bersama kami dan mengucapkan terima
      kasih yang sebesar-besarnya atas kepercayaan Bapak/Ibu. </font>
      <p><font face="Arial" size="2">Berkenaan dengan surat Asurasi Jiwa Bapak/Ibu,
      data yang kami catat adalah :<br>
      &nbsp; </font></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" width="100%" cellpadding="0">
        <tr>
          <td width="25%"><font face="Arial" size="2">Macam Asuransi</font></td>
          <td width="75%"><font face="Arial" size="2">: <? echo "$kdproduk";?></font></td>
        </tr>
        <tr>
          <td width="25%"><font face="Arial" size="2">Jumlah Uang Asuransi</font></td>
          <td width="75%"><font face="Arial" size="2">: <? echo "$juamainproduk";?></font></td>
        </tr>
        <tr>
          <td width="25%"><font face="Arial" size="2">Mulai Asuransi</font></td>
          <td width="75%"><font face="Arial" size="2">: <? echo "$mulas";?></font></td>
        </tr>
        <tr>
          <td width="25%"><font face="Arial" size="2">Masa Asuransi</font></td>
          <td width="75%"><font face="Arial" size="2">: <? echo "$lamaasuransi";?> tahun</font></td>
        </tr>
        <tr>
          <td width="25%"><font face="Arial" size="2">Tanggal Lahir</font></td>
          <td width="75%"><font face="Arial" size="2">: <? echo "$tgllahir";?></font></td>
        </tr>
        <tr>
          <td width="25%"><font face="Arial" size="2">Cara Pembayaran Premi</font></td>
          <td width="75%"><font face="Arial" size="2">: <? echo "$kdcarabayar";?></font></td>
        </tr>
        <tr>
          <td width="25%"><font face="Arial" size="2">Premi Sejumlah</font></td>
          <td width="75%"><font face="Arial" size="2">: <? echo "$premi";?></font></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%">&nbsp; <br>
      <font face="Arial" size="2">Telah kami terima, atas dasar kuitansi Bukti
      penerimaan premi pertama /Bukti Penerimaan Premi Sekaligus No. <? echo "$nobp3";?></font>
      <p><font face="Arial" size="2">Sudilah kiranya mencocokkan dengan data
      yang ada pada Bapak/Ibu. Seandainya terdapat data yang tidak sesuai atau
      belum diterima kuitansi sebagaimana dimaksud diatas, agar memberitahukan
      kepada kami melalui telepon/tertulis dengan alamat : </font></p>
      <p align="right"><font face="Arial" size="2">PT.ASURANSI JIWA IFG</font></p>
      <p><font face="Arial" size="2">Atas perhatian dan kepercayaan Bapak/Ibu
      kami sampaikan terima kasih.</font></p>
      <p><font face="Arial" size="2">Hormat kami,</font></p>
      <p>&nbsp;</p>
      <p><font face="Arial" size="2">($nama_kacab)<br>
      Kepala Cabang/Perwakilan</font></td>
  </tr>
</table>

</body>
</html>
