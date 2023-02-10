<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-family: TAHOMA;
	font-size: 14px;
}
-->
</style>
</head>

<body>
<hr size="1" />
<div align="center" class="style1">
	<?
	include "../../includes/cDatabase.php";
	
 		$query ="SELECT RIGHT(('0000000000'+CONVERT(VARCHAR,ID)),10) AS POLIS, CONVERT(CHAR,TGL_CTK,103) AS TANGGAL_CTK, CONVERT(CHAR,TGL_LNS,103) AS TANGGAL_LNS, CONVERT(CHAR,TGL_EXP,103) AS TANGGAL_EXP, CONVERT(CHAR,TGL_MULAS,103) AS TANGGAL_MULAS, DATEDIFF(YEAR,TGL_LAHIR, TGL_MULAS) AS USIA, CONVERT(CHAR,TGL_LAHIR,103) AS TANGGAL_LHR, CONVERT(CHAR,TGL_SPA,103) AS TANGGAL_SPAJ, CONVERT(CHAR,TGL_UPLOAD,103) AS TANGGAL_UPLOAD, ".
		"* FROM TB1_NASABAH WHERE ID='$id' ";
		//"AND CONVERT(CHAR, TGL_UPLOAD,103) BETWEEN '$tgls' AND '$tgle'";
		$result = mssql_query($query);
       //echo $query;		
        $row = mssql_fetch_array($result);
		?>
  <table cellspacing="1" cellpadding="1" border="0">
    <tbody>
      <tr>
        <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bordercolor="#99CCCC">
          <tbody>
            <tr>
              <td colspan="3" align="middle" bgcolor="#99CCFF"><div align="left"><strong>POLIS NO : HO-
                <?=$row["POLIS"];?>
              </strong> </div></td>
              <td bgcolor="#99CCFF"><div align="left">RAYON : XX</div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Direkam</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 
                <?=$row["TANGGAL_UPLOAD"];?>
              </div></td>
              <td bgcolor="#99CCFF"><div align="left">Update Terakhir</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 
                <?=$row["TANGGAL_UPLOAD"];?> 
                oleh SYSTEM</div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Nomor SPAJ</div></td>
              <td bgcolor="#99CCFF"><div align="left">: XXXXXX</div></td>
              <td bgcolor="#99CCFF"><div align="left">Tanggal SPAJ</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 
                <?=$row["TANGGAL_SPAJ"];?>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Nomor BP3</div></td>
              <td bgcolor="#99CCFF"><div align="left">: XXX</div></td>
              <td bgcolor="#99CCFF"><div align="left">Tanggal BP3</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 
                <?=$row["TANGGAL_MULAS"];?>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Status</div></td>
              <td bgcolor="#99CCFF"><div align="left"><strong>: 
                <?=$row["STATUS_APP"];?>
              </strong></div></td>
              <td bgcolor="#99CCFF"><div align="left">Keterangan</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td colspan="4" ><hr align="left" size="1" />              </td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Klien nomor</div></td>
              <td bgcolor="#99CCFF"><div align="left">: XXX</div></td>
              <td bgcolor="#99CCFF"><div align="left">Nama</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 
                <?=$row["NAMA"];?>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Tgl Lahir</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["TANGGAL_LHR"];?></div></td>
              <td bgcolor="#99CCFF"><div align="left">Jenis Kelamin / Marital Status</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["SEX"];?></div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Pekerjaan</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
              <td bgcolor="#99CCFF"><div align="left">Hobby</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Tinggi Badan</div></td>
              <td bgcolor="#99CCFF"><div align="left">:  cm</div></td>
              <td bgcolor="#99CCFF"><div align="left">Berat Badan</div></td>
              <td bgcolor="#99CCFF"><div align="left">:  kg</div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Alamat Tetap</div></td>
              <td colspan="3" bgcolor="#99CCFF"><div align="left">: <?=$row["ALAMAT"];?></div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Alamat Tagih</div></td>
              <td colspan="3" bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Phone Tagih</div></td>
              <td colspan="3" bgcolor="#99CCFF"><div align="left">: Phone Tetap : </div></td>
            </tr>
            <tr>
              <td colspan="4" ><hr align="left" size="1" />              </td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Nama Produk</div></td>
              <td colspan="3" bgcolor="#99CCFF"><div align="left">: <?=$row["PRODUK"];?></div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Status Medical</div></td>
              <td bgcolor="#99CCFF"><div align="left">: NON MEDICAL</div></td>
              <td bgcolor="#99CCFF"><div align="left">Mulai Asuransi</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["TANGGAL_MULAS"];?></div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Usia Masuk</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["USIA"];?></div></td>
              <td bgcolor="#99CCFF"><div align="left">Lama Asuransi</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 5 th, 0 bl</div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Tgl Ekspirasi</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["TANGGAL_EXP"];?></div></td>
              <td bgcolor="#99CCFF"><div align="left">Lama Pemb. Premi</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 0 th, 0 bl</div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left"></div></td>
              <td bgcolor="#99CCFF"><div align="left"></div></td>
              <td bgcolor="#99CCFF"><div align="left">Akhir Pemb. Premi</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">V a l u t a</div></td>
              <td bgcolor="#99CCFF"><div align="left">: RUPIAH</div></td>
              <td bgcolor="#99CCFF"><div align="left">Cara Bayar</div></td>
              <td bgcolor="#99CCFF"><div align="left">: SEKALIGUS</div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Index Awal</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 1</div></td>
              <td bgcolor="#99CCFF"><div align="left">Premi Sekaligus</div></td>
              <td bgcolor="#99CCFF"><div align="left">: Rp <?=number_format($row["JUMLAH_UA"]);?></div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">J U A Kecelakaan</div></td>
              <td bgcolor="#99CCFF"><div align="left">: Rp <?=number_format($row["U_ASURANSI"]);?></div></td>
              <td bgcolor="#99CCFF"><div align="left">Premi Stlh 5 Th</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Gadai Otomatis</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
              <td bgcolor="#99CCFF"><div align="left">Premi Standar</div></td>
              <td bgcolor="#99CCFF"><div align="left">: Rp </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Email</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
              <td bgcolor="#99CCFF"><div align="left">Resiko</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Konversi</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["TANGGAL_LNS"];?></div></td>
              <td bgcolor="#99CCFF"><div align="left">Polis Dicetak</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["TANGGAL_CTK"];?></div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Bayar Terakhir</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
              <td bgcolor="#99CCFF"><div align="left">Booking Berikutnya</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Auto Debet</div></td>
              <td bgcolor="#99CCFF"><div align="left">: Tidak </div></td>
              <td bgcolor="#99CCFF"><div align="left">Premi Top-up Berkala</div></td>
              <td bgcolor="#99CCFF"><div align="left">: 0.00 </div></td>
            </tr>
            <tr>
              <td colspan="4" bgcolor="#99CCFF"><hr align="left" size="1" />              </td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Pemegang Polis</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["NAMA"];?></div></td>
              <td bgcolor="#99CCFF"><div align="left">Penagih</div></td>
              <td bgcolor="#99CCFF"><div align="left">: </div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Pembayar Premi</div></td>
              <td bgcolor="#99CCFF"><div align="left">: <?=$row["NAMA"];?></div></td>
              <td bgcolor="#99CCFF"><div align="left">Agen</div></td>
              <td bgcolor="#99CCFF"><div align="left">: -</div></td>
            </tr>
            <tr>
              <td bgcolor="#99CCFF"><div align="left">Ahli Waris / Beneficiary</div></td>
              <td colspan="3" bgcolor="#99CCFF"><div align="left">:</div></td>
            </tr>
            <tr>
              <td colspan="4" bgcolor="#99CCFF"><div align="left">
                <table cellspacing="1" cellpadding="0" width="95%" align="center" border="0">
                  <tbody>
                    <tr>
                      <td><table cellspacing="1" cellpadding="0" width="100%" align="center" border="0">
                        <tbody>
                          <tr>
                            <td align="middle">No</td>
                              <td align="left">Nomor Klien</td>
                              <td align="left">Nama Klien</td>
                              <td align="left">Hubungan</td>
                            </tr>
                          <tr>
                            <td align="middle">1</td>
                              <td align="middle">-</td>
                              <td align="left"><?=$row["NAMA"];?></td>
                              <td align="left">DIRI TERTANGGUNG</td>
                            </tr>
                          <tr bgcolor="#e0e0e4">
                            <td align="middle">2</td>
                              <td align="middle">-</td>
                              <td align="left"><?=$row["AHLI_WARIS"];?></td>
                              <td align="left"><?=$row["STATUS_HUB"];?></td>
                            </tr>
                          </tbody>
                        </table></td>
                      </tr>
                    </tbody>
                </table>
              </div></td>
            </tr>
            <tr>
              <td colspan="4" ><hr align="left" size="1" />              </td>
            </tr>
            <tr>
              <td colspan="4" align="middle" ><div align="left"></div></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
