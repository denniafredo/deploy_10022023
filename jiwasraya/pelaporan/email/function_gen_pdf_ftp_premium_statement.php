 <?

	//include "../../includes/database.php";
	//include "../../includes/session.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";	
	
	//$prefixpertanggungan="AC";
	//$nopertanggungan="001226250";
	function gen_pdf($prefixpertanggungan,$nopertanggungan,$tglcari,$kdkantor,$image_promo){
		$userid = "jsadm";
		$passwd = "jsadmoke";		
		$DB=New database($userid, $passwd, $DBName);
		$DBXY=New database($userid, $passwd, $DBName);
		$DBN=New database($userid, $passwd, $DBName);
		$DBY=New database($userid, $passwd, $DBName);
		$DBx=New database($userid, $passwd, $DBName);
		
		require_once('../libs/fpdf/fpdf.php');
		
		$pdf = new FPDF('P','mm','A4');
		
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		/*
		$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
		$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];
		$kdkantor = $rowxx['RAYONPENAGIHAN'];
		$tglbooked = $rowxx['TGL_BOOKED'];
		$email = $rowxx['EMAIL'];
		*/
		//echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$tglcari.'<br>';
		
			$ttltagih=0;
			$ttldebet=0;
			$ttlmtr=0;
			$ttldiskon=0;
		
		$sqln="SELECT TO_CHAR(TANGGAL,'DD/MM/YYYY') TANGGAL, NOMOR FROM $DBUser.TABEL_999_SURAT_MATERAI WHERE TANGGAL=(SELECT MAX(TANGGAL) FROM $DBUser.TABEL_999_SURAT_MATERAI)";
			$DBN->parse($sqln);
			$DBN->execute();		
			$nomor=$DBN->nextrow();
						//echo $sqlcari;
			$tglmtr=$nomor["TANGGAL"];
			$nomtr=$nomor["NOMOR"];
			
			$sqlcari="select count(*) as JUMLAH from $DBUser.tabel_300_historis_rider where prefixpertanggungan||nopertanggungan='".$prefixpertanggungan.$nopertanggungan."' ".
					"and tglbayar BETWEEN to_date('".$tglcari."','YYYYMM') AND LAST_DAY(to_date('".$tglcari."','YYYYMM'))";
			$DBXY->parse($sqlcari);
			$DBXY->execute();		
			$cari=$DBXY->nextrow();
			//echo $sqlcari.'<BR><BR>';
			//echo $cari["JUMLAH"];
			//die;

			
			$queryx = "
						  SELECT   b.kdproduk,b.prefixpertanggungan || b.nopertanggungan AS nopol,
								   b.nopol AS nopollama,
								   (SELECT   namaklien1
										FROM   $DBUser.tabel_100_klien kli
									   WHERE   kli.noklien = b.notertanggung)
										TERTANGGUNG,
								   DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
								   e.namaklien1,
								   c.kdrayonpenagih,
								   ltrim(e.alamattagih01) alamattagih01,
								   ltrim(e.alamattagih02) alamattagih02,
								   (SELECT   TO_CHAR (MAX (tglseatled), 'mm/yyyy')
									  FROM   $DBUser.tabel_300_historis_premi
									 WHERE       prefixpertanggungan = b.prefixpertanggungan
											 AND nopertanggungan = b.nopertanggungan
											 AND tglseatled <= LAST_DAY(TO_DATE ('$tglcari', 'YYYYMM')))
									  tglbokees,
								   e.kodepostagih,
								   g.NAMABANK,
								   (SELECT   MAX (k.NAMAKOTAMADYA)
									  FROM   $DBUser.TABEL_109_KOTAMADYA k
									 WHERE   k.KDKOTAMADYA = e.KDKOTAMADYATAGIH)
									  AS kodya,
								   (SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu')
									  FROM $DBUser.tabel_100_klien kli
									 WHERE kli.noklien = B.nopemegangpolis) anda,
								   TO_CHAR(sysdate,'yyyymm') period_pst 
							FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
								   $DBUser.TABEL_200_PERTANGGUNGAN b,
								   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
								   $DBUser.TABEL_500_PENAGIH c,
								   $DBUser.TABEL_100_KLIEN e,
								   $DBUser.TABEL_001_KANTOR f,
								   $DBUser.TABEL_399_BANK g
						   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
								   AND b.nopertanggungan = d.nopertanggungan
								   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
								   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
								   AND TO_CHAR (a.tglbooked, 'mmyyyy') =
										 TO_CHAR (d.tglbooked, 'mmyyyy')
								   AND d.tglseatled BETWEEN TO_DATE ('$tglcari', 'YYYYMM')
														AND  last_day(TO_DATE ('$tglcari', 'YYYYMM'))
								   AND b.nopenagih = c.nopenagih
								   AND e.noklien = b.nopemegangpolis
								   AND c.kdrayonpenagih = f.kdkantor
								   AND f.kdkantor = '$kdkantor'
								   AND b.autodebet = '1'
								   AND b.kdbank = g.kdbank
								   /*AND b.kdcarabayar = '1'*/
								   and b.nopertanggungan = '$nopertanggungan'
						GROUP BY   b.prefixpertanggungan,
								   b.nopertanggungan,
								   b.nopol,
								   b.kdvaluta,
								   B.nopemegangpolis,
								   e.namaklien1,
								   b.notertanggung,
								   e.alamattagih01,
								   e.alamattagih02,
								   e.kodepostagih,
								   g.namabank,
								   c.kdrayonpenagih,
								   e.KDKOTAMADYATAGIH,
								   b.kdproduk";	
			
			
			//echo $queryx.'<br><br>';//die;
			if ($cari["JUMLAH"] == 0) 
			{
				//echo 'NO RIDER <br><br>';
				$queryy = "							
							  SELECT   b.kdproduk,TO_CHAR (SYSDATE, 'DD/MM/YYYY') cetak,
									   b.prefixpertanggungan || b.nopertanggungan AS nopol,
									   b.nopol AS nopollama,
									   TO_CHAR (d.tglbooked, 'DD/MM/YYYY') tglbooked,
									   TO_CHAR (d.tglseatled, 'DD/MM/YYYY') tglseat,
									   DECODE (d.tglseatled, NULL, d.premitagihan, '0') AS tunggakan,
									   TO_CHAR (a.tglrekam, 'DD/MM/YYYY') tglpendebetan,
									   DECODE (
										  b.kdvaluta,
										  '1',
										  d.premitagihan,
										  '0',
										  ROUND (
											 ROUND (d.premitagihan / b.indexawal, 2)
											 * ROUND (
												  (SELECT   kurs
													 FROM   $DBUser.TABEL_999_kurs_transaksi x
													WHERE   x.kdvaluta = b.kdvaluta
															AND x.tglkursberlaku =
																  (SELECT   MAX (y.tglkursberlaku)
																	 FROM   $DBUser.TABEL_999_kurs_transaksi y
																	WHERE   x.kdvaluta = y.kdvaluta
																			AND y.tglkursberlaku <=
																				  a.tglrekam)),
												  2
											   ),
											 2
										  ),
										  d.premitagihan
										  * (SELECT   kurs
											   FROM   $DBUser.TABEL_999_kurs_transaksi x
											  WHERE   x.kdvaluta = b.kdvaluta
													  AND x.tglkursberlaku =
															(SELECT   MAX (y.tglkursberlaku)
															   FROM   $DBUser.TABEL_999_kurs_transaksi y
															  WHERE   x.kdvaluta = y.kdvaluta
																	  AND y.tglkursberlaku <= a.tglrekam))
									   )
										  premitagihannya,
									   TO_NUMBER (a.jumlahtagihan) / 100 AS jmltagihanpremi,
									   decode(to_char(a.tglbooked,'MM/YYYY'),to_char(a.tglrekam,'MM/YYYY'),DECODE(b.KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK),0,1)*
													   decode(b.kdvaluta,'1',d.premitagihan,'0',
																ROUND(d.premitagihan/b.indexawal,2) * ROUND((SELECT kurs 
																					   FROM $DBUser.TABEL_999_kurs_transaksi x 
																					WHERE x.kdvaluta = b.kdvaluta
																				   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																												FROM $DBUser.TABEL_999_kurs_transaksi y
																										   WHERE x.kdvaluta = y.kdvaluta 
																											 AND y.tglkursberlaku <= a.tglrekam)),2),
																d.premitagihan * (SELECT kurs 
																					   FROM $DBUser.TABEL_999_kurs_transaksi x 
																					WHERE x.kdvaluta = b.kdvaluta
																				   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																												FROM $DBUser.TABEL_999_kurs_transaksi y
																										   WHERE x.kdvaluta = y.kdvaluta 
																											 AND y.tglkursberlaku <= a.tglrekam))) /100,'0') discount,
									   d.status,
									   (SELECT   kurs
										  FROM   $DBUser.TABEL_999_kurs_transaksi x
										 WHERE   x.kdvaluta = b.kdvaluta
												 AND x.tglkursberlaku =
													   (SELECT   MAX (y.tglkursberlaku)
														  FROM   $DBUser.TABEL_999_kurs_transaksi y
														 WHERE   x.kdvaluta = y.kdvaluta
																 AND y.tglkursberlaku <= a.tglrekam))
										  kursrekam,
									   b.kdvaluta,
									   d.premitagihan AS premiasli,
									   d.premitagihan,
									   b.indexawal,
									   DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
									   (SELECT decode(substr(b.kdproduk,1,4),'JL4B',0,nilaimeterai)nilaimeterai FROM $DBUser.TABEL_999_batas_materai 
															  /*WHERE TO_NUMBER(a.jumlahtagihan)/100 BETWEEN batasbawahpremi AND batasataspremi ) AS materai,*/
															  WHERE (d.premitagihan) BETWEEN batasbawahpremi AND batasataspremi ) AS materai,
													 (SELECT nilaimeterai FROM $DBUser.TABEL_999_batas_materai                             
														  WHERE (d.premitagihan ) BETWEEN batasbawahpremi AND batasataspremi ) AS materaijl4b, 
									   e.namaklien1,
									   e.alamattagih01,
									   e.alamattagih02,
									   e.kodepostagih,
									   (SELECT   k.NAMAKOTAMADYA
										  FROM   $DBUser.TABEL_109_KOTAMADYA k
										 WHERE   k.KDKOTAMADYA = e.KDKOTAMADYATAGIH)
										  AS kodya,
									   f.NAMAKANTOR,
									   f.ALAMAT01,
									   f.ALAMAT02,
									   f.PHONE01,
									   f.PHONE02,
									   f.PHONE03,
									   f.PHONE04,
									   f.WEBSITE,
									   (SELECT   NAMABANK
										  FROM   $DBUser.TABEL_399_BANK
										 WHERE   KDBANK = B.KDBANK)
										  NAMA_BANK,
									   (SELECT   NAMABANK
										  FROM   $DBUser.TABEL_399_NICK_BANK
										 WHERE   KDBANK = B.KDBANK)
										  NICK_NAMA_BANK
								FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
									   $DBUser.TABEL_200_PERTANGGUNGAN b,
									   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
									   $DBUser.TABEL_500_PENAGIH c,
									   $DBUser.TABEL_100_KLIEN e,
									   $DBUser.TABEL_001_KANTOR f
							   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
									   AND b.nopertanggungan = d.nopertanggungan
									   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
									   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
									   AND TO_CHAR (a.tglbooked, 'mmyyyy') =
											 TO_CHAR (d.tglbooked, 'mmyyyy')
									   AND d.tglseatled BETWEEN TO_DATE ('$tglcari', 'YYYYMM')
															AND  LAST_DAY (TO_DATE ('$tglcari', 'YYYYMM'))
									   AND b.nopenagih = c.nopenagih
									   AND e.noklien = b.nopembayarpremi
									   AND c.kdrayonpenagih = f.kdkantor
									   AND f.kdkantor = '$kdkantor'
									   AND b.autodebet = '1'
									   AND a.nopolis = '".$prefixpertanggungan.$nopertanggungan."'
							ORDER BY   nopol, d.tglbooked";	
			//echo $queryy.'<br><br>';
			}else{
				//echo 'RIDER <br><br>';
				$queryy = "
						   SELECT   TO_CHAR (SYSDATE, 'DD/MM/YYYY') cetak,
									   b.prefixpertanggungan || b.nopertanggungan AS nopol,
									   b.nopol AS nopollama,
									   TO_CHAR (a.tglbooked, 'DD/MM/YYYY') tglbooked,
									   TO_CHAR (d.tglseatled, 'DD/MM/YYYY') tglseat,
									   c.kdrayonpenagih,
									   (SELECT   TO_CHAR (MAX (tglseatled), 'mm/yyyy')
										  FROM   $DBUser.tabel_300_historis_premi
										 WHERE       prefixpertanggungan = b.prefixpertanggungan
												 AND nopertanggungan = b.nopertanggungan
												 AND tglseatled <= LAST_DAY(TO_DATE ('$tglcari', 'YYYYMM')))
										  tglbokees,
									   DECODE (d.tglseatled,
											   NULL, (d.premitagihan + NVL (g.premitagihan, 0)),
											   '0')
										  AS tunggakan,
									   TO_CHAR (a.tglrekam, 'DD/MM/YYYY') tglpendebetan,
									   DECODE (
										  b.kdvaluta,
										  '1',
										  (d.premitagihan + NVL (g.premitagihan, 0)),
										  '0',
										  ROUND (
											 ROUND (
												(d.premitagihan + NVL (g.premitagihan, 0)) / b.indexawal,
												2
											 )
											 * ROUND (
												  (SELECT   kurs
													 FROM   $DBUser.TABEL_999_kurs_transaksi x
													WHERE   x.kdvaluta = b.kdvaluta
															AND x.tglkursberlaku =
																  (SELECT   MAX (y.tglkursberlaku)
																	 FROM   $DBUser.TABEL_999_kurs_transaksi y
																	WHERE   x.kdvaluta = y.kdvaluta
																			AND y.tglkursberlaku <=
																				  a.tglrekam)),
												  2
											   ),
											 2
										  ),
										  (d.premitagihan + NVL (g.premitagihan, 0))
										  * (SELECT   kurs
											   FROM   $DBUser.TABEL_999_kurs_transaksi x
											  WHERE   x.kdvaluta = b.kdvaluta
													  AND x.tglkursberlaku =
															(SELECT   MAX (y.tglkursberlaku)
															   FROM   $DBUser.TABEL_999_kurs_transaksi y
															  WHERE   x.kdvaluta = y.kdvaluta
																	  AND y.tglkursberlaku <= a.tglrekam))
									   )
										  premitagihannya,
									   TO_NUMBER (a.jumlahtagihan) / 100 AS jmltagihanpremi,
									              decode(to_char(a.tglbooked,'MM/YYYY'),to_char(a.tglrekam,'MM/YYYY'),DECODE(b.KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK),0,1)*
                           decode(b.kdvaluta,'1',d.premitagihan,'0',
                                    ROUND(d.premitagihan/b.indexawal,2) * ROUND((SELECT kurs 
                                                           FROM $DBUser.TABEL_999_kurs_transaksi x 
                                                        WHERE x.kdvaluta = b.kdvaluta
                                                       AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
                                                                                    FROM $DBUser.TABEL_999_kurs_transaksi y
                                                                               WHERE x.kdvaluta = y.kdvaluta 
                                                                                 AND y.tglkursberlaku <= a.tglrekam)),2),
                                    d.premitagihan * (SELECT kurs 
                                                           FROM $DBUser.TABEL_999_kurs_transaksi x 
                                                        WHERE x.kdvaluta = b.kdvaluta
                                                       AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
                                                                                    FROM $DBUser.TABEL_999_kurs_transaksi y
                                                                               WHERE x.kdvaluta = y.kdvaluta 
                                                                                 AND y.tglkursberlaku <= a.tglrekam))) /100,'0') discount,
									   d.status,
									   (SELECT   kurs
										  FROM   $DBUser.TABEL_999_kurs_transaksi x
										 WHERE   x.kdvaluta = b.kdvaluta
												 AND x.tglkursberlaku =
													   (SELECT   MAX (y.tglkursberlaku)
														  FROM   $DBUser.TABEL_999_kurs_transaksi y
														 WHERE   x.kdvaluta = y.kdvaluta
																 AND y.tglkursberlaku <= a.tglrekam))
										  kursrekam,
									   b.kdvaluta,
									   (d.premitagihan + NVL (g.premitagihan, 0)) AS premiasli,
									   (d.premitagihan + NVL (g.premitagihan, 0)) AS premitagihan,
									   b.indexawal,
									   DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
									   (SELECT decode(substr(b.kdproduk,1,4),'JL4B',0,nilaimeterai)nilaimeterai FROM $DBUser.TABEL_999_batas_materai 
												  /*WHERE TO_NUMBER(a.jumlahtagihan)/100 BETWEEN batasbawahpremi AND batasataspremi ) AS materai,*/
												  WHERE (d.premitagihan) BETWEEN batasbawahpremi AND batasataspremi ) AS materai,
									   (SELECT nilaimeterai FROM $DBUser.TABEL_999_batas_materai                             
											  WHERE (d.premitagihan ) BETWEEN batasbawahpremi AND batasataspremi ) AS materaijl4b,
									   e.namaklien1,
									   e.alamattagih01,
									   e.alamattagih02,
									   e.kodepostagih,
									   (SELECT   k.NAMAKOTAMADYA
										  FROM   $DBUser.TABEL_109_KOTAMADYA k
										 WHERE   k.KDKOTAMADYA = e.KDKOTAMADYATAGIH)
										  AS kodya,
									   f.NAMAKANTOR,
									   f.ALAMAT01,
									   f.ALAMAT02,
									   f.PHONE01,
									   f.PHONE02,
									   f.PHONE03,
									   f.PHONE04,
									   f.WEBSITE,
									   (SELECT   NAMABANK
										  FROM   $DBUser.TABEL_399_BANK
										 WHERE   KDBANK = B.KDBANK)
										  NAMA_BANK,
									   (SELECT   NAMABANK
										  FROM   $DBUser.TABEL_399_NICK_BANK
										 WHERE   KDBANK = B.KDBANK)
										  NICK_NAMA_BANK
								FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
									   $DBUser.TABEL_300_HISTORIS_RIDER g,
									   $DBUser.TABEL_200_PERTANGGUNGAN b,
									   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
									   $DBUser.TABEL_500_PENAGIH c,
									   $DBUser.TABEL_100_KLIEN e,
									   $DBUser.TABEL_001_KANTOR f
							   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
									   AND b.nopertanggungan = d.nopertanggungan
									   AND g.prefixpertanggungan = d.prefixpertanggungan
									   AND g.nopertanggungan = d.nopertanggungan
									   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
									   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
									   AND TO_CHAR (a.tglbooked, 'mmyyyy') =
											 TO_CHAR (d.tglbooked, 'mmyyyy')
									   AND TO_CHAR (g.tglbooked, 'mmyyyy') =
											 TO_CHAR (d.tglbooked, 'mmyyyy')/*AND d.tglbooked BETWEEN to_date('01/08/2016','DD/MM/YYYY') AND to_date('31/08/2016','DD/MM/YYYY')*/
									   AND d.tglseatled BETWEEN TO_DATE (
																   '$tglcari',
																   'YYYYMM'
																)
															AND  LAST_DAY(TO_DATE (
																	'$tglcari',
																	'YYYYMM'
																 ))
									   AND b.nopenagih = c.nopenagih
									   AND e.noklien = b.nopembayarpremi
									   AND c.kdrayonpenagih = f.kdkantor
									   AND f.kdkantor = '$kdkantor'
									   AND b.autodebet = '1'
									   AND a.nopolis = '".$prefixpertanggungan.$nopertanggungan."'
							ORDER BY   nopol, d.tglbooked";	
														
			}
			//echo $queryy.'<br><br>';//die;
			
			$query = "select TO_CHAR(sysdate,'dd ')||BULAN_KATA(TO_CHAR(sysdate,'mm'))||TO_CHAR(sysdate,' yyyy') hariini,a.emailxlindo,a.email,a.emailopr,a.emailadlog, decode(a.kdjeniskantor,'1','KANTOR CABANG','2','KANTOR PERWAKILAN') jeniskantor, ".
					 "a.kdkantorinduk, a.namakantor, a.kdkantorinduk, a.alamat01,a.alamat02,a.kodepos,a.phone01,a.phone02,a.phone03,a.phone04, ".
					 "(select namakantor from $DBUser.tabel_001_kantor where kdkantor=a.kdkantorinduk) as namakantorinduk,".
					 "b.namakotamadya,c.namapropinsi,
					  (SELECT NAMAPEJABAT
					   FROM $DBUser.TABEL_002_PEJABAT A
					   WHERE KDKANTOR = '$kdkantor' 
					   AND KDORGANISASI = '163') KASIADLOG,                 
					  (SELECT NAMAPEJABAT
					   FROM $DBUser.TABEL_002_PEJABAT A
					   WHERE KDKANTOR = '$kdkantor' 
					   AND KDORGANISASI = '161') KASIOPS	
					 ".
					 "from $DBUser.tabel_001_kantor a, ".
					 "$DBUser.tabel_109_kotamadya b,$DBUser.tabel_108_propinsi c ".
					 "where a.kdkantor='$kdkantor' and ".
					 "a.kdkotamadya=b.kdkotamadya(+) and ".
					 "a.propinsi=c.kdpropinsi(+)";
					 "e.namajabatan like (select  from $DBUser.tabel_001_kantor ".
					 "where kdkantor='$kdkantor') ";
			//echo $queryx;
			//echo $query.'<br><br>';
			$DB->parse($query);
			$DB->execute();
			$row=$DB->nextrow();
			
			//$db->Parse($query);
			//$db->Execute();
			//$i = 1;
			//$row = oci_fetch_array($db->get_statement());
			
			
			$DBx->parse($queryx);
			$DBx->execute();
			$rowx=$DBx->nextrow();
			
			
			//$db->Parse($queryx);
			//$db->Execute();
			//$i = 1;
			//$rowx = oci_fetch_array($db->get_statement());
			//echo 'ini kantor '.$row['NAMAKANTOR'];
			//**** ini isi
			$pdf->SetLeftMargin(25);
			$image1 = "../libs/logo_js.jpg";
			$pdf->Ln(10);
			$pdf->Image($image1, 18, 15, 50);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetLeftMargin(120);
			$pdf->Cell(70,4,'PT ASURANSI JIWA IFG',0,0,'R');
			$pdf->Ln();	
			$pdf->Cell(70,4,$row['NAMAKANTOR'],0,0,'R');
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(70,4,$row['ALAMAT01'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$row['ALAMAT02'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$row['KODEPOS'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$row['PHONE01'],0,0,'R');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(70,4,'www.ifg-life.co.id',0,0,'R');
			$pdf->Ln(20);	
			
			$tertanggung = $rowx["TERTANGGUNG"];
			//$pdf->Image($image1, 20, 6, 50);
			//$pdf->Cell(70,4,$row['NAMAKOTAMADYA'].', '.$row['HARIINI'],0,0,'R');
			$pdf->SetLeftMargin(20);
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(95,4,'Kepada Yth.',0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();		
			$pdf->Cell(95,4,$rowx["ANDA"].' '.$rowx["NAMAKLIEN1"],0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(95,4,$rowx["ALAMATTAGIH01"],0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(95,4,$rowx["ALAMATTAGIH02"],0,0,'L');
			$pdf->Ln();
			$pdf->Cell(95,4,$rowx["KODYA"],0,0,'L');
			$pdf->Ln();			
			$pdf->Cell(95,4,$rowx["KODEPOSTAGIH"],0,0,'L');
			
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(30,4,'NOMOR POLIS ANDA',1,0,'L');
			$pdf->Cell(15,4,'RAYON',1,0,'C');
			$pdf->Cell(15,4,'PERIODE',1,0,'L');
			
			$pdf->Ln();
			$pdf->Cell(30,4,$rowx["NOPOL"],1,0,'C');
			$pdf->Cell(15,4,$rowx["KDRAYONPENAGIH"],1,0,'C');
			$pdf->Cell(15,4,$rowx["TGLBOKEES"],1,0,'L');
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->Cell(70,4,'AUTODEBET '.$rowx["NAMABANK"],0,0,'L');
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->Cell(47+35+50+35,4,'LEMBAR PREMIUM STATEMENT',0,0,'C');
			$pdf->Ln();
			//$pdf->Cell(38,4,'Nomor Polis','LTR',0,'C',true);
			$pdf->Cell(47,4,'TGL. JT.TEMPO TAGIHAN PREMI','LTR',0,'C');
			$pdf->Cell(35,4,'TANGGAL TRANSAKSI',1,0,'C');
			$pdf->Cell(50,4,'KETERANGAN',1,0,'C');
			$pdf->Cell(35,4,'JUMLAH',1,0,'C');
			$pdf->Ln();
			$DBY->parse($queryy);
			$DBY->execute();	
			while ($rowy=$DBY->nextrow()) {
				$pdf->Cell(47,4,$rowy["TGLBOOKED"],1,0,'C');
				$pdf->Cell(35,4,'',1,0,'C');
				$pdf->Cell(50,4,'Tagihan Premi',1,0,'L');
				$pdf->Cell(35,4,number_format($rowy["PREMITAGIHANNYA"],2,',','.'),1,0,'R');
				$pdf->Ln();
				$pdf->Cell(47,4,'',1,0,'C');
				$pdf->Cell(35,4,$rowy["TGLPENDEBETAN"],1,0,'C');
				$pdf->Cell(50,4,'Lunas Premi Autodebet',1,0,'L');
				$pdf->Cell(35,4,number_format($rowy["JMLTAGIHANPREMI"]-$rowy["MATERAI"],2,',','.'),1,0,'R');
				$pdf->Ln();
				$pdf->Cell(47,4,'',1,0,'C');
				$pdf->Cell(35,4,$rowy["TGLPENDEBETAN"],1,0,'C');
				$pdf->Cell(50,4,'Bea Meterai Lunas',1,0,'L');
				$pdf->Cell(35,4,number_format($rowy["MATERAI"],2,',','.'),1,0,'R');
				$pdf->Ln();
				$pdf->Cell(47,4,'',1,0,'C');
				$pdf->Cell(35,4,$rowy["TGLPENDEBETAN"],1,0,'C');
				$pdf->Cell(50,4,'Discount Premi',1,0,'L');
				//$pdf->Cell(35,4,number_format($rowy["PREMITAGIHANNYA"]-($rowy["JMLTAGIHANPREMI"]-$rowy["MATERAI"]),2,',','.'),1,0,'R');
				
				$pdf->Cell(35,4,number_format($rowy["DISCOUNT"],2,',','.'),1,0,'R');				
				$pdf->Ln();
				
				//$diskon = $rowy["PREMITAGIHANNYA"]-($rowy["JMLTAGIHANPREMI"]-$rowy["MATERAI"]);
				$diskon=$rowy["DISCOUNT"];
				$ttltagih=$ttltagih+$rowy["PREMITAGIHANNYA"];		
				$ttldebet=$ttldebet + ($rowy["JMLTAGIHANPREMI"]-$rowy["MATERAI"]);
				
				if(substr($rowx["KDPRODUK"],0,4)=="JL4B"){
					$ttlmtrjl4b=$ttlmtr +( $rowy["MATERAIJL4B"]);
					$ttlmtr=$ttlmtr +( $rowy["MATERAI"]);
				}
				else{					
					$ttlmtr=$ttlmtr +( $rowy["MATERAI"]);
				  //$ttldiskon=$ttldiskon +( $arx["DISCOUNT"]);
				  $ttldiskon=$ttldiskon+$diskon;
				  $tglcetak=$rowy["CETAK"];
				  //echo $ttldiskon;
				}
			    //$ttlmtr=$ttlmtr +( $rowy["MATERAI"]);		
				
				//$ttldiskon=$ttldiskon+$diskon;
				//$ttldiskon=$rowy["PREMITAGIHANNYA"]-$rowy["JMLTAGIHANPREMI"]-$rowy["MATERAI"];
				$tglcetak=$rowy["CETAK"];
			}
			
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(47+35+50+35,4,'RINGKASAN AUTODEBET',0,0,'C');
			$pdf->Ln();
			$x1 = $pdf->GetX();
			$y1 = $pdf->GetY();
			$lgMC=42;
			$pdf->MultiCell($lgMC,12,'JUMLAH',1,'C');	
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC+100,12,'Discount premi sebesar 1% tidak berlaku untuk produk JS Link, Siharta, Arthadana dan premi yang tertunggak',1,'L'); //--> iki	
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC+125,4,'Premium Statement ini adalah bukti pembayaran yang sah dan tidak memerlukan tanda tangan karena diproses secara otomatis',1,'L'); //--> iki	
			$y2 = $pdf->GetY();
			$yH = $y2 - $y1;
				
			$pdf->SetXY($x1 + $lgMC, $y2 - $yH);	
			$lgMC=25;
			$x1 = $pdf->GetX();
			$y1 = $pdf->GetY();	
			$pdf->MultiCell($lgMC,8,'TAGIHAN PREMI',1,'C');
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC,4,number_format($ttltagih,2,',','.'),1,'C'); //--> iki	
			$y2 = $pdf->GetY();
			$yH = $y2 - $y1;
			
			$pdf->SetXY($x1 + $lgMC, $y2 - $yH);		
			$x1 = $pdf->GetX();
			$y1 = $pdf->GetY();	
			$pdf->MultiCell($lgMC,4,'LUNAS PREMI AUTODEBET',1,'C');
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC,4,number_format($ttldebet,2,',','.'),1,'C'); //--> iki	
			$y2 = $pdf->GetY();
			$yH = $y2 - $y1;
			
			$pdf->SetXY($x1 + $lgMC, $y2 - $yH);	
			$x1 = $pdf->GetX();
			$y1 = $pdf->GetY();	
			$lgMC=25;
			$pdf->MultiCell($lgMC,4,'BEA MATERAI LUNAS',1,'C');
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			
			$pdf->MultiCell($lgMC,4,number_format($ttlmtr,2,',','.'),1,'C'); 			
			
			//$pdf->MultiCell($lgMC,4,number_format($ttlmtr,2,',','.'),1,'C'); //--> iki	
			
			$y2 = $pdf->GetY();
			$yH = $y2 - $y1;
			
			$pdf->SetXY($x1 + $lgMC, $y2 - $yH);	
			$x1 = $pdf->GetX();
			$y1 = $pdf->GetY();
			$pdf->MultiCell($lgMC,4,'DISCOUNT PREMI 1%',1,'C');
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC,4,number_format($ttldiskon,2,',','.'),1,'C'); //--> iki	
			$y2 = $pdf->GetY();
			$yH = $y2 - $y1;
			
			$pdf->SetXY($x1 + $lgMC, $y2 - $yH);	
			$x1 = $pdf->GetX();
			$y1 = $pdf->GetY();	
			$pdf->MultiCell($lgMC,4,'PREMI TERTUNGGAK',1,'C');	
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC,4,'',1,'C'); //--> iki	
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC,4,'TOTAL LUNAS AUTODEBET',1,'C'); //--> iki
			$y2 = $pdf->GetY();                      //--> iki
			$yH = $y2 - $y1;                        //--> iki
			$pdf->SetXY($x1, $y2);	               //--> iki	
			$pdf->MultiCell($lgMC,4,number_format($ttldebet+$ttlmtr,2,',','.'),1,'C'); //--> iki
			$x1 = $pdf->GetX();
			$yH = $y2 - $y1;
			//$pdf->SetXY($x1 + $lgMC, $y2 - $yH);	
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(40,4,'BEA MATERAI LUNAS',1,0,'C');
			$pdf->Cell(87,4,'',0,0,'C');
			$pdf->Cell(40,4,'TANGGAL CETAK',1,0,'C');
			$pdf->Ln();
			
			
			if(substr($rowx["KDPRODUK"],0,4)=="JL4B"){
				//echo number_format($ttlmtrjl4b,2,',','.');				
				$pdf->Cell(40,4,number_format($ttlmtrjl4b,2,',','.'),1,0,'C');
				//$pdf->Cell(40,4,'JL4B',1,0,'C');
			}
			else{
			    //echo number_format($ttlmtr,2,',','.');
				$pdf->Cell(40,4,number_format($ttlmtr,2,',','.'),1,0,'C');
				//$pdf->Cell(40,4,'NON JL4B',1,0,'C');
			}
			
			$pdf->Cell(87,4,'',0,0,'C');
			$pdf->Cell(40,4,$tglcetak,1,0,'C');
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFont('Arial','',4.5);
			$pdf->Cell(40,2,'IJIN PEMBUBUHAN TANDA BEA METERAI LUNAS',0,0,'L');
			$pdf->Ln();
			$pdf->Cell(40,2,'DENGAN SISTEM KOMPUTERISASI',0,0,'L');
			$pdf->Ln();
			$pdf->Cell(40,2,'NOMOR : '.$nomtr,0,0,'L');
			$pdf->Ln();
			$pdf->Cell(40,2,'TANGGAL : '.$tglmtr,0,0,'L');
			$pdf->Ln();
			$pdf->Cell(40,2,'Dari : DIREKTUR JENDERAL PAJAK',0,0,'L');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(10,4,chr(127),0,0,'R');
			$pdf->MultiCell(150,3,'Untuk keperluan pengiriman premium statement, jika ada perubahan alamat diharapkan dapat menginformasikan kepada Call Center PT Asuransi Jiwa IFG',0,'L');
			$pdf->Ln();
			$pdf->Cell(10,4,chr(127),0,0,'R');
			$pdf->MultiCell(150,3,'Keterangan lebih lanjut tentang pelunasan premi hubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151, atau kirimkan surat ke : Customer Service, Jl. Ir. H. Juanda No. 34 Jakarta, E-mail : asuransi@ifg-life.co.id',0,'L');
			$pdf->Ln();
			$image1 = "content_blast/".$image_promo;
			$pdf->Ln();
			$y1 = $pdf->GetY();
			$x1 = $pdf->GetX();		
			$pdf->Image($image1, $x1, $y1, 170);
			//** akhir isi pengajuan
			
		// OUTPUT
		$pdf->Output('pdf/'.$tglcari.'_PST_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf');//
		//$pdf->Output();
		//die;
		//echo 'disini';
		$ftp_server = "192.168.2.94";
		$ftp_username = "ftpuser";
		$ftp_userpass = "JS#34-ftp!";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

		$file = 'pdf/'.$tglcari.'_PST_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';
		$namafile = 'DOKUMEN_NOTIFIKASI_EMAIL/'.$tglcari.'_PST_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';
		// upload file
		//if (ftp_put($ftp_conn, $namafile, $file, FTP_ASCII))
		if (ftp_put($ftp_conn, $namafile, $file, FTP_BINARY, 0))
		  {
		  echo "Successfully uploaded $file.";
		  }
		else
		  {
		  echo "Error uploading $file.";
		  }

		// close connection
		ftp_close($ftp_conn);
		
	}	
	?>