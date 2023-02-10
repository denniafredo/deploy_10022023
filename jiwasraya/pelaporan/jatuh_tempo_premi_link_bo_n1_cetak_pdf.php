<?
/*
var_dump($_POST);
foreach ($_POST['cetak'] as &$value) {
	
	$prefixpertanggungan = substr($value,0,2);
	$nopertanggungan = substr($value,2,9);
	$tglbooked = substr($value,-6);
	
	
	echo '<br><br>'.$value;
	echo '<br><br>'.$prefixpertanggungan;
	echo '<br><br>'.$nopertanggungan;
	echo '<br><br>'.$tglbooked;
}			
die;
*/

	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date.php";
	include "../../includes/kantor.php";	

	

	$useridx = 'jsadm';
	$passwdx = 'jsadmoke';
	$DEBE=New Database($useridx,$passwdx,"JSDB");
	$DEBEX=New Database($useridx,$passwdx,"JSDB");
	$DBq=New Database($useridx,$passwdx,"JSDB");	
	$DEBEP=New Database($useridx,$passwdx,"JSDB");
	$DEBEPD=New Database($useridx,$passwdx,"JSDB");
	$DEBEPUP=New Database($useridx,$passwdx,"JSDB");
	
	//$userawal = $userid;
	// inisiate this $prefixpertanggungan,$nopertanggungan,$tglcari,$kdkantor
	require_once('libs/fpdf/fpdf.php');

	$pdf = new FPDF('P','mm','A4');
	$kantor = $_POST["kdkantor"];
	$tglcari = $_POST["tglcari"];
	$tglcari_periode = $_POST["tglcari"];
	//echo $tglcari;
	//var_dump($_POST['cetak']);
	foreach ($_POST['cetak'] as &$value) {
			//echo '<br><br>'.$value;
			$prefixpertanggungan = substr($value,0,2);
			$nopertanggungan = substr($value,2,9);
			$tglcari = substr($value,-6);
			
			/*
			echo '<br><br>'.$value;
			echo '<br><br>'.$prefixpertanggungan;
			echo '<br><br>'.$nopertanggungan;
			die;
			*/
			
			//$userid = 'jsadm';
			//$passwd = 'jsadmoke';
			$PER=New Pertanggungan($useridx,$passwdx,$prefixpertanggungan,$nopertanggungan);
			$KLN=New Klien($useridx,$passwdx,$PER->nopemegangpolis);
			$KTR=New Kantor($useridx,$passwdx,$kantor);
			
			if ($carabayar=='B') {$cara=" and a.kdcarabayar in ('1','M') ";}
			elseif ($carabayar=='K') {$cara=" and a.kdcarabayar in ('2','Q') ";}
			elseif ($carabayar=='S') {$cara=" and a.kdcarabayar in ('3','H') ";}
			elseif ($carabayar=='T') {$cara=" and a.kdcarabayar in ('4','A') ";}
			elseif ($carabayar=='E') {$cara=" and a.kdcarabayar in ('E') ";}
			elseif ($carabayar=='J') {$cara=" and a.kdcarabayar in ('J') ";}
			
			$query="select prefixpertanggungan, nopertanggungan,  TO_CHAR(mulas, 'DD') tmulas, TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp FROM   
					$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
					WHERE   a.nopenagih=p.nopenagih
					/*AND p.KDRAYONPENAGIH='$kdkantor'*/
					AND a.kdpertanggungan = '2'
					AND a.kdstatusfile = '1'
					AND a.kdcarabayar <> 'X'
					/*AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3','JL4')*/
					AND MOD (
					MONTHS_BETWEEN (
					TO_DATE ('".$tglcari."', 'YYYYMM'),
					TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
					),
					DECODE (a.kdcarabayar,
					'1',
					1,
					'M',
					1,
					'2',
					3,
					'Q',
					3,
					'3',
					6,
					'H',
					6,
					'4',
					12,
					'A',
					12,
					'E',
					12,
					'J',
					12)
					) = 0  and a.PREFIXPERTANGGUNGAN = '$prefixpertanggungan'
					AND a.NOPERTANGGUNGAN = '$nopertanggungan'
					AND NOT EXISTS (
					SELECT   'X'
					FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
					WHERE       PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
					AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN
					AND TO_DATE ( '".$tglcari."'||TO_CHAR(SYSDATE, 'DD') , 'YYYYMMDD')
					BETWEEN TGLMULAI AND TGLSELESAI)";
			//echo $query;
			//echo '<br><br>';
			$DEBEX->parse($query);
			$DEBEX->execute();				
		while ($arr=$DEBEX->nextrow()) {			


			$sql = "SELECT ptg.prefixpertanggungan PREFIXPERTANGGUNGAN, 
					ptg.nopertanggungan NOPERTANGGUNGAN, 
					ptg.nopol,
					ptg.kdvaluta,
					(SELECT (namavaluta)
					FROM $DBUser.tabel_304_valuta
					WHERE kdvaluta = ptg.kdvaluta)
					NAMAVALUTA,
					norekeningdebet,
					case
					when (SELECT   (NAMAKLIEN1)
					FROM   $DBUser.TABEL_100_KLIEN
					WHERE   noklien = ptg.nopenagih) like '%AUTODEBET%' then substr(norekeningdebet,1,3)||'******'||substr(norekeningdebet,-3)
					end rek,
					ptg.notertanggung,decode(ptg.indexawal,0,1,ptg.indexawal) indexawal, to_char(sysdate,'dd/mm/yyyy') tgl,
					TO_CHAR(add_months(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD'),(SELECT GRACEPERIODE  
							 FROM $DBUser.TABEL_241_GRACE_PERIODE
							WHERE kdproduk = ptg.kdproduk)-2)-1,'DD/MM/YYYY') tglexp1,
					TO_CHAR(add_months(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD'),(SELECT GRACEPERIODE  
							 FROM $DBUser.TABEL_241_GRACE_PERIODE
							WHERE kdproduk = ptg.kdproduk)-2),'DD/MM/YYYY') tglbpo1,
					TO_CHAR(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD')+(SELECT   GRACEPERIODE*30
					FROM   $DBUser.TABEL_241_GRACE_PERIODE 
					WHERE   kdproduk = ptg.kdproduk),'DD/MM/YYYY') tglexp,
					TO_CHAR(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD')+(SELECT   GRACEPERIODE*30
					FROM   $DBUser.TABEL_241_GRACE_PERIODE 
					WHERE   kdproduk = ptg.kdproduk)+1,'DD/MM/YYYY') tglbpo,
					CASE
					WHEN (MONTHS_BETWEEN (TO_DATE ('$tglexp', 'DD/MM/YYYY'), MULAS) / 12) >=5
					THEN
					PREMI2
					ELSE
					PREMI1
					END
					PREMI,
					(SELECT STATUS
					FROM $DBUser.tabel_300_historis_premi
					WHERE     prefixpertanggungan = ptg.prefixpertanggungan
					   AND nopertanggungan = ptg.nopertanggungan
					   AND TO_CHAR (tglbooked, 'MMYYYY') = '".$tglcari."')
					STATUS,
					TO_CHAR(mulas,'DD/MM/YYYY') MULAS,to_char(sysdate,'dd/mm/yyyy') cetak,
					(select  SUM
                                 (PREMITAGIHAN  +
                                 NVL((select SUM(PREMITAGIHAN) 
                                 from $DBUser.tabel_300_historis_rider 
                                 where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' 
                                 and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' 
                                 AND to_char(tglBOOKED,'mm/yyyy') = to_char(A.tglbooked,'mm/yyyy')),0)) PREMITAGIHAN
                          from $DBUser.tabel_300_historis_premi A
                          where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' 
                          and nopertanggungan= '".$arr["NOPERTANGGUNGAN"]."' 
                          and tglseatled is null) PREMITAGIHAN,
					(SELECT   GRACEPERIODE*30
					FROM   $DBUser.TABEL_241_GRACE_PERIODE 
					WHERE   kdproduk = ptg.kdproduk) gp,
					(SELECT   (NAMAKLIEN1)
					FROM   $DBUser.TABEL_100_KLIEN
					WHERE   noklien = ptg.nopenagih) PENAGIH,
					(SELECT   NAMACARABAYAR
					FROM   $DBUser.TABEL_305_CARA_BAYAR
					WHERE   kdcarabayar = ptg.kdcarabayar) CARA,
					(SELECT   NAMAVALUTA
					FROM   $DBUser.TABEL_304_VALUTA
					WHERE   kdvaluta = ptg.kdvaluta) valuta,
					(SELECT   namaproduk
					FROM   $DBUser.TABEL_202_PRODUK 
					WHERE   kdproduk = ptg.kdproduk) produk,
					(SELECT  max(noaccount) from $DBUser.TABEL_100_KLIEN_ACCOUNT where jenis='VA' and kdbank='BNI'
					and prefixpertanggungan=ptg.prefixpertanggungan and nopertanggungan=ptg.nopertanggungan) virtual,
					(SELECT  kdmapping from $DBUser.TABEL_001_kantor where kdkantor=ptg.prefixpertanggungan) mapping,
					(SELECT namaklien1
					FROM $DBUser.tabel_100_klien kli
					WHERE kli.noklien = ptg.nopemegangpolis) PEMPOL,
					(SELECT alamattagih01||' '||alamattagih02
					FROM $DBUser.tabel_100_klien kli
					WHERE kli.noklien = ptg.nopemegangpolis) ALAMAT,
					(SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu')
					FROM $DBUser.tabel_100_klien kli
					WHERE kli.noklien = ptg.nopemegangpolis) anda,
					(SELECT namakotamadya
					FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
					WHERE kli.noklien = ptg.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
					(SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
					to_char(add_months((SELECT   min(TGLBOOKED)
						FROM   $DBUser.tabel_300_historis_premi
					   WHERE       prefixpertanggungan = ptg.prefixpertanggungan
							   AND nopertanggungan = ptg.nopertanggungan
							   AND TGLSEATLED is null),
					 (SELECT   GRACEPERIODE
									   FROM   $DBUser.TABEL_241_GRACE_PERIODE
									  WHERE   kdproduk = ptg.kdproduk))-1,'dd/mm/yyyy') due_date,
					 to_char(add_months((SELECT   min(TGLBOOKED)
						FROM   $DBUser.tabel_300_historis_premi
					   WHERE       prefixpertanggungan = ptg.prefixpertanggungan
							   AND nopertanggungan = ptg.nopertanggungan
							   AND TGLSEATLED is null),
					 (SELECT   GRACEPERIODE
									   FROM   $DBUser.TABEL_241_GRACE_PERIODE
							  WHERE   kdproduk = ptg.kdproduk)),'dd/mm/yyyy') lapse_date,
					ROUND(months_between(TO_DATE ('".$tglcari."', 'YYYYMM'),ptg.MULAS),0) lama_nunggak		  
					FROM $DBUser.tabel_200_pertanggungan ptg
					WHERE ptg.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."' AND ptg.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'";

			//echo $sql; 
			//echo '<br><br>';
			//die;
			$DEBE->parse($sql);
			$DEBE->execute();
			$row=$DEBE->nextrow();

			$queryxz = "insert into $DBUser.HIST_CETAK_PEMBERITAHUAN_JT (PERIODE,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,TGLCETAK,USERCETAK) values (TO_DATE ('".$tglcari_periode."', 'YYYYMM'),'".$arr["PREFIXPERTANGGUNGAN"]."','".$arr["NOPERTANGGUNGAN"]."',sysdate,'".$userid."')";
			//$queryxz = "select count(*) from $DBUser.HIST_CETAK_PEMBERITAHUAN_JT";
			$DEBEPUP->parse($queryxz);
			$DEBEPUP->execute();
			//echo $queryxz;
			//var_dump($DEBEPUP->execute());
			
			$querz = "select TO_CHAR(sysdate,'dd ')||BULAN_KATA(TO_CHAR(sysdate,'mm'))||TO_CHAR(sysdate,' yyyy') hariini,a.emailxlindo,a.email,a.emailopr,a.emailadlog, decode(a.kdjeniskantor,'1','KANTOR CABANG','2','KANTOR PERWAKILAN') jeniskantor, ".
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
			//echo $querz;
			//echo '<br><br>';
			$DBq->parse($querz);
			$DBq->execute();
			$rowq=$DBq->nextrow();		

			// PAGE 1
			$pdf->AddPage();

			// HEADER
			//$pdf->Image('img/logo-js.png', 170, 5);
			$pdf->ln();
			$pdf->SetLeftMargin(10);
			$image1 = "libs/logo_js.jpg";
			$pdf->Ln(5);
			$pdf->Image($image1, 18, 15, 50);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetLeftMargin(120);
			$pdf->Cell(70,4,'PT ASURANSI JIWA IFG',0,0,'R');
			$pdf->Ln();	
			$pdf->Cell(70,4,$rowq['NAMAKANTOR'],0,0,'R');
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(70,4,$rowq['ALAMAT01'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$rowq['ALAMAT02'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$rowq['KODEPOS'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$rowq['PHONE01'],0,0,'R');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(70,4,'www.ifg-life.co.id',0,0,'R');
			$pdf->Ln(5);	
			

			// HEADER
			$pdf->SetLeftMargin(10);
			$pdf->SetFont('Arial','',8);
			$pdf->SetFillColor(200,200,200);
			$pdf->Cell(190,4,ucwords($row["KOTA"]).', '.$row["TGL"],0,0,'R');
			$pdf->ln(10);
			$pdf->Cell(190,4,'Kepada Yth.',0,0,'L');
			$pdf->ln();
			$pdf->Cell(190,4,$row["ANDA"].' '.$row["PEMPOL"] ,0,0,'L');
			$pdf->ln();
			$pdf->Cell(190,4,$row["ALAMAT"],0,0,'L');
			$pdf->ln();
			$pdf->Cell(190,4,$row["KOTA"],0,0,'L');
			$pdf->ln(7);
			$pdf->Cell(190,4,'Dengan Hormat,',0,0,'L');
			$pdf->ln(7);
			$pdf->Cell(190,4,'Terima kasih atas kepercayaan '.$row["ANDA"].' kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi '.$row["ANDA"].' dan keluarga.',0,0,'L');
			$pdf->ln();
			$pdf->Cell(190,4,'Berikut kami informasikan data rincian Polis '.$row["ANDA"].':',0,0,'L');
			$pdf->ln(7);

			// DATA RINCIAN POLIS
			$pdf->SetFont('Arial','B',8);
			$pdf->SetFillColor(0,32,96);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(38,4,'Nomor Polis','LTR',0,'C',true);
			$pdf->Cell(38,4,'Lunas Terakhir','LTR',0,'C',true);
			$pdf->Cell(38,4,'Tagihan Baru','LTR',0,'C',true);
			$pdf->Cell(38,4,'Tanggal Cetak','LTR',0,'C',true);
			$pdf->Cell(38,4,'Batas Waktu Pembayaran','LTR',0,'C',true);
			$pdf->ln();
			$pdf->SetFont('Arial','I',8);
			$pdf->SetFillColor(0,32,96);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(38,4,'Policy Number','LBR',0,'C',true);
			$pdf->Cell(38,4,'Last Payment Date','LBR',0,'C',true);
			$pdf->Cell(38,4,'New Balance','LBR',0,'C',true);
			$pdf->Cell(38,4,'Statement Date','LBR',0,'C',true);
			$pdf->Cell(38,4,'Due Date','LBR',0,'C',true);
			$pdf->ln();
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(38,4,$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"],1,0,'C',true);
			$pdf->Cell(38,4,$row["LUNAS"],1,0,'C',true);
			
			if($row["KDVALUTA"]=='0'){
				$premitagihan=$row["PREMITAGIHAN"]/$row["INDEXAWAL"];			
			}else{
				$premitagihan=$row["PREMITAGIHAN"];			
			}
			$pdf->Cell(38,4,number_format($premitagihan,2),1,0,'C',true);
			$pdf->Cell(38,4,$row["CETAK"],1,0,'C',true);
			//$pdf->Cell(38,4,$row["TGLEXP1"],1,0,'C',true);
			if(($row["LAMA_NUNGGAK"] > 24) && ($row["PRODUK"] == 'JS PROMAPAN')){
				$pdf->Cell(38,4,"-",1,0,'C',true);	
			}else{
				$pdf->Cell(38,4,$row["DUE_DATE"],1,0,'C',true);
			}				
			
			$pdf->ln();
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(38,5,'','LTB',0,'C',true);
			$pdf->Cell(38,5,'','TB',0,'C',true);
			$pdf->Cell(38,5,'','TB',0,'C',true);
			$pdf->Cell(38,5,'','TB',0,'C',true);
			$pdf->Cell(38,5,'','RTB',0,'C',true);
			$pdf->ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->SetFillColor(0,32,96);
			$pdf->SetTextColor(255,255,255);		
			$pdf->Cell(38,4,'Tanggal Tagihan','LTR',0,'C',true);
			$pdf->Cell(38,4,'Keterangan','LTR',0,'C',true);
			$pdf->Cell(38,4,'Jumlah','LTR',0,'C',true);
			
			$y1 = $pdf->GetY();
			$x1 = $pdf->GetX();
			
			$pdf->Cell(76,4,'Informasi Pembayaran','LTR',0,'C',true);
			$pdf->ln();
			$pdf->SetFont('Arial','I',8);
			$pdf->SetFillColor(0,32,96);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(38,4,'Billing Date','LBR',0,'C',true);
			$pdf->Cell(38,4,'Description','LBR',0,'C',true);
			$pdf->Cell(38,4,'Amounts','LBR',0,'C',true);
			$pdf->Cell(76,4,'Payment Information','LBR',0,'C',true);
			$pdf->ln();
				if($row["PRODUK"] == 'JS PROMAPAN'){
					$queryhp="SELECT   TO_CHAR (min(tglbooked), 'dd/mm/yyyy') booked,
									   TO_CHAR (min(tglbooked), 'mm/yyyy') blnbooked,
									   TO_CHAR (max(tglbooked), 'dd/mm/yyyy') max_booked,
									   TO_CHAR (max(tglbooked), 'mm/yyyy') max_blnbooked,
									   sum(PREMITAGIHAN) PREMITAGIHAN
								FROM   $DBUser.tabel_300_historis_premi
							   WHERE       prefixpertanggungan = '".$row["PREFIXPERTANGGUNGAN"]."'
									   AND nopertanggungan = '".$row["NOPERTANGGUNGAN"]."'
									   AND tglseatled IS NULL";
					$querydetail="SELECT TO_CHAR (min(tglbooked), 'dd/mm/yyyy') booked,
								TO_CHAR (min(tglbooked), 'mm/yyyy') blnbooked,
								TO_CHAR (max(tglbooked), 'dd/mm/yyyy') max_booked,
								TO_CHAR (max(tglbooked), 'mm/yyyy') max_blnbooked,
								sum(PREMITAGIHAN) + NVL(
														SUM(
							                                (select PREMITAGIHAN 
							                                from $DBUser.tabel_300_historis_rider 
							                                where prefixpertanggungan=A.prefixpertanggungan 
							                                    AND nopertanggungan=A.nopertanggungan AND tglseatled IS NULL
																AND TO_DATE(TGLBOOKED, 'DD/MM/YYYY') < TO_DATE( 
																	(
																		SELECT TO_CHAR(MAX(TGLBOOKED), 'DD/MM/YYYY') 
																		FROM $DBUser.tabel_300_historis_premi 
																		WHERE prefixpertanggungan = A.prefixpertanggungan 
																			AND nopertanggungan = A.nopertanggungan
																			AND tglseatled IS NULL
																	)
							                                    ) 
							                                )
							                            ),
							                            0) PREMITAGIHAN
							FROM $DBUser.tabel_300_historis_premi A
							WHERE prefixpertanggungan = '".$row["PREFIXPERTANGGUNGAN"]."' 
								AND nopertanggungan = '".$row["NOPERTANGGUNGAN"]."'
								AND tglseatled IS NULL 
								AND to_date(tglbooked) < TO_DATE(( SELECT TO_CHAR(MAX(TGLBOOKED), 'DD/MM/YYYY') 
																	FROM $DBUser.tabel_300_historis_premi 
																	WHERE prefixpertanggungan = A.prefixpertanggungan 
																		AND nopertanggungan = A.nopertanggungan
																		AND tglseatled IS NULL), 'DD/MM/YYYY')
							UNION ALL
							SELECT TO_CHAR (min(tglbooked), 'dd/mm/yyyy') booked,
								TO_CHAR (min(tglbooked), 'mm/yyyy') blnbooked,
								'' max_booked,
								'' max_blnbooked,
								sum(PREMITAGIHAN) + NVL(
							                            SUM(
															(select PREMITAGIHAN 
															from $DBUser.tabel_300_historis_rider 
															where prefixpertanggungan=A.prefixpertanggungan 
																AND nopertanggungan=A.nopertanggungan 
																AND tglseatled IS NULL
																AND TO_CHAR(TGLBOOKED, 'DD/MM/YYYY') = 
																	(
																		SELECT TO_CHAR(MAX(TGLBOOKED), 'DD/MM/YYYY') 
																		FROM $DBUser.tabel_300_historis_premi 
																		WHERE prefixpertanggungan = A.prefixpertanggungan 
																			AND nopertanggungan = A.nopertanggungan
																			AND tglseatled IS NULL
							                                        ) 
							                                )
							                            ),
														0) PREMITAGIHAN
							FROM   $DBUser.tabel_300_historis_premi A
							WHERE prefixpertanggungan = '".$row["PREFIXPERTANGGUNGAN"]."'
								AND nopertanggungan = '".$row["NOPERTANGGUNGAN"]."'
								AND tglseatled IS NULL
								AND TO_CHAR(TGLBOOKED, 'DD/MM/YYYY') = (SELECT TO_CHAR(MAX(TGLBOOKED), 'DD/MM/YYYY') 
							                                            FROM $DBUser.tabel_300_historis_premi 
							                                            WHERE prefixpertanggungan = '".$row["PREFIXPERTANGGUNGAN"]."' 
							                                                AND nopertanggungan = '".$row["NOPERTANGGUNGAN"]."'
							                                                AND tglseatled IS NULL
																		)";									
				}else{
					$queryhpX="select to_char(tglbooked,'dd/mm/yyyy') booked, to_char(tglbooked,'mm/yyyy') blnbooked, PREMITAGIHAN from $DBUser.tabel_300_historis_premi where 
						prefixpertanggungan='".$row["PREFIXPERTANGGUNGAN"]."' and nopertanggungan= '".$row["NOPERTANGGUNGAN"]."' and tglseatled is null order by tglbooked";
					$queryhp="select to_char(tglbooked,'dd/mm/yyyy') booked, to_char(tglbooked,'mm/yyyy') blnbooked, 
								 PREMITAGIHAN  +
								 NVL((select SUM(PREMITAGIHAN) 
								 from $DBUser.tabel_300_historis_rider where prefixpertanggungan='".$row["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$row["NOPERTANGGUNGAN"]."' AND to_char(tglBOOKED,'mm/yyyy') = to_char(A.tglbooked,'mm/yyyy')),0) PREMITAGIHAN
						  from $DBUser.tabel_300_historis_premi A
						  where prefixpertanggungan='".$row["PREFIXPERTANGGUNGAN"]."' 
						  and nopertanggungan= '".$row["NOPERTANGGUNGAN"]."' 
						  and tglseatled is null order by tglbooked";	
				}
				$DEBEP->parse($queryhp);
				$DEBEP->execute();
				
				//echo $queryhp;	
				$totalpremi=0;		
				while ($hp=$DEBEP->nextrow()) {	
					if($row["KDVALUTA"]=='0'){
						$premitagihan=$hp["PREMITAGIHAN"]/$row["INDEXAWAL"];
						$totalpremi+=$hp["PREMITAGIHAN"]/$row["INDEXAWAL"];
					}else{
						$premitagihan=$hp["PREMITAGIHAN"];
						$totalpremi+=$hp["PREMITAGIHAN"];
					}

					/** TAMBAHAN DETAIL TAGIHAN UNTUK JENIS PROMAPAN **/
					if($row["PRODUK"] == 'JS PROMAPAN'){
						$DEBEPD->parse($querydetail);
						$DEBEPD->execute();
						while ($hpdetail=$DEBEPD->nextrow()){
							$maxbooked = $hpdetail['MAX_BOOKED'] != "" && $hpdetail['MAX_BOOKED'] != $hpdetail['BOOKED'] ? " s.d ".$hpdetail['MAX_BOOKED']." " : "";
							$maxketerangan = $hpdetail['MAX_BLNBOOKED'] != "" && $hpdetail['MAX_BLNBOOKED'] != $hpdetail['BLNBOOKED'] ? " s.d ".$hpdetail['MAX_BLNBOOKED']." " : "";
							$keterangan = $hpdetail['BLNBOOKED'] != "" ? " Premi ".$hpdetail['BLNBOOKED']." " : "";
							$premitagihan = $hpdetail['PREMITAGIHAN'] != "" ? " ".number_format($hpdetail["PREMITAGIHAN"],2,",",".")." " : "";
							$pdf->SetFont('Arial','',8);
							$pdf->SetFillColor(255,255,255);
							$pdf->SetTextColor(0,0,0);
							$pdf->Cell(38,4,$hpdetail["BOOKED"].$maxbooked,'L',0,'C',true);
							$pdf->Cell(38,4,$keterangan.$maxketerangan,'',0,'C',true);
							$pdf->Cell(29,4,$premitagihan,0,0,'R',true);
							$pdf->Cell(9,4,'',0,0,'R',true);
							$pdf->ln();
						}
					}else{
						
					}

					$pdf->SetFillColor(255,255,255);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','',8);
					if($row["PRODUK"] == 'JS PROMAPAN'){
						//$pdf->Cell(38,4,$hp["BOOKED"].' s.d. '.$hp["MAX_BOOKED"],'L',0,'C',true);
					}else{
						$pdf->Cell(38,4,$hp["BOOKED"],'L',0,'C',true);
					}		

					if ($hp["BLNBOOKED"] != '')
					{
						if($row["PRODUK"] == 'JS PROMAPAN'){	
							//$pdf->Cell(38,4,'Premi '.$hp["BLNBOOKED"].' s.d. '.$hp["MAX_BLNBOOKED"],0,0,'C',true);
						}else{
							$pdf->Cell(38,4,'premi bulan '.$hp["BLNBOOKED"],0,0,'C',true);
						}
					}
					else
					{
						$pdf->Cell(38,4,'',0,0,'C',true);
					}

					if($row["PRODUK"] == 'JS PROMAPAN'){

					}else{
						$pdf->Cell(38,4,number_format($hp["PREMITAGIHAN"],2,",","."),0,0,'C',true);
						$pdf->Cell(38,4,number_format($premitagihan,2,",","."),0,0,'C',true);
						$pdf->Cell(38,4,'','LR',0,'L',true);
						$pdf->SetFont('Arial','',6);
						$pdf->Cell(38,4,'','LR',0,'L',true);
					}
					$pdf->ln();

					// $pdf->Cell(38,4,number_format($premitagihan,2,",","."),0,0,'C',true);
					// $pdf->Cell(38,4,'','LR',0,'L',true);
					// $pdf->SetFont('Arial','',6);
					// $pdf->Cell(38,4,'','LR',0,'L',true);
					// $pdf->ln();
				}			
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(38,4,'','L',0,'C',true);
			//$pdf->Cell(38,4,'x',0,0,'C',true);
			//$pdf->Cell(38,4,'x',0,0,'C',true);
			$width = 0;
			$heigth = 8;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(38,4,'Valuta','LR',0,'L',true);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(38,4,$row["NAMAVALUTA"],'LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(1,4,'','L',0,'C',true);
			//$pdf->Cell(38,4,'x',0,0,'C',true);
			//$pdf->Cell(38,4,'x',0,0,'C',true);
			$width = 0;
			$heigth = 12;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(38,4,'Cara Pembayaran','LR',0,'L',true);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(38,4,$row["PENAGIH"],'LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(5,4,'','L',0,'C',true);
			//$pdf->Cell(38,4,'',0,0,'C',true);
			//$pdf->Cell(38,4,'',0,0,'C',true);
			$width = 0;
			$heigth = 16;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(38,4,'Rek. Pendebetan','LR',0,'L',true);
			$pdf->Cell(38,4,$row["REK"],'LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(5,4,'','L',0,'C',true);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','B',8);
			
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
			$width = 0;
			$heigth = 20;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(38,4,'Nomor Host-to-Host','LR',0,'L',true);
			$pdf->Cell(38,4,$row["MAPPING"].$row["NOPERTANGGUNGAN"],'LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->SetFillColor(0,32,96);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 24;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'Informasi Pembayaran','LTR',0,'C',true);
			$pdf->ln();
			$pdf->SetFont('Arial','I',8);
			$pdf->SetFillColor(0,32,96);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'x',0,0,'C');
			//$pdf->Cell(38,4,'x',0,0,'C');
			$width = 0;
			$heigth = 28;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'Payment Information','LBR',0,'C',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(38,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			if ($row["STATUS"]!= 'X')
			{
				$pdf->Cell(38,4,'TOTAL TAGIHAN',0,0,'C',true);
				$pdf->Cell(38,4,number_format($totalpremi,2,",","."),0,0,'C',true);
			}
			else
			{
				$pdf->Cell(38,4,'',0,0,'C',true);
				$pdf->Cell(38,4,'',0,0,'C',true);
			}
			$width = 0;
			$heigth = 32;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'Bagi Nasabah dengan cara bayar Autodebet, akan dilakukan','LTR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 36;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'pendebetan secara otomatis setiap bulannya.','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 40;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'Jadwal pendebetan mengikuti ketetapan sebagai berikut:','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 44;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'1. Mandiri : Tgl 5, 15, 25','LR',0,'L',true);
			
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 48;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'2. BNI : Tgl 7, 17, 27','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 52;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'3. BRI : Tgl 9, 19, 29','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 56;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'4. Credit Card : Tgl 22','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 60;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'5. BTN : Tgl 3, 13, 23 (*)','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 64;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'6. BPD Kalbar : Tgl 6, 16, 26 (*)','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 70;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 68;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'Jika tanggal pendebetan jatuh pada hari libur, pendebetan','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 72;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'akan dilakukan pada hari kerja berikutnya.','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(5,4,'','L',0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			//$pdf->Cell(38,4,'',0,0,'C');
			$width = 0;
			$heigth = 76;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'','LR',0,'L',true);
			$pdf->ln();
			$pdf->SetFont('Arial','B',7.8);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(38,4,'','LB',0,'C');
			$pdf->Cell(38,4,'','B',0,'C');
			$pdf->Cell(38,4,'','B',0,'C');
			$width = 0;
			$heigth = 80;
			$pdf->SetXY($x1 , $y1+$heigth);
			$pdf->Cell(76,4,'*Syarat dan ketentuan berlaku','LBR',0,'L',true);
			$pdf->ln(7);

			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
			if(($row["LAMA_NUNGGAK"] > 24) && ($row["PRODUK"] == 'JS PROMAPAN')){
				$pdf->Cell(190,3,'Untuk tetap menjaga Manfaat Asuransi sesuai ketentuan dalam Syarat-syarat Umum Polis Asuransi diharapkan '.$row["ANDA"].' dapat segera melakukan ',0,0,'L');
				$pdf->ln();
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(190,3,'pembayaran premi yang telah jatuh tempo tersebut.',0,0,'L');
				$pdf->ln();
				$pdf->SetFont('Arial','',8);
				//$pdf->Cell(190,3,'maka kondisi polis menjadi Lapse/Batal per '. $row["TGLBPO1"].'.',0,0,'L');
				//$pdf->Cell(190,3,'',0,0,'L');
			}else{
				$pdf->Cell(190,3,'Untuk tetap menjaga Manfaat Asuransi sesuai ketentuan dalam Syarat-syarat Umum Polis Asuransi diharapkan '.$row["ANDA"].' untuk melakukan pembayaran',0,0,'L');
				$pdf->ln();
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(190,3,'premi sampai dengan batas waktu yang ditetapkan. Dalam hal pembayaran premi belum dilunasi sampai dengan batas waktu yang telah ditentukan,',0,0,'L');
				$pdf->ln();
				$pdf->SetFont('Arial','',8);
				//$pdf->Cell(190,3,'maka kondisi polis menjadi Lapse/Batal per '. $row["TGLBPO1"].'.',0,0,'L');
				$pdf->Cell(190,3,'maka kondisi polis menjadi Lapse/Batal per '. $row["LAPSE_DATE"].'.',0,0,'L');
			}					
			$pdf->ln(7);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(190,3,'Dalam hal pembayaran Premi telah dilakukan oleh '.$row["ANDA"].' dan atau data Polis di atas tidak sesuai, serta jika ada informasi lain yang ingin '.$row["ANDA"].' ketahui,',0,0,'L');
			$pdf->ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(190,3,'mohon untuk dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau',0,0,'L');
			$pdf->ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(190,3,'email : customer_service@ifg-life.co.id, dengan melampirkan bukti pelunasan premi yang sah.',0,0,'L');
			$pdf->ln(7);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(190,3,'Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.',0,0,'L');
			$pdf->ln(7);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(190,3,'Hormat kami',0,0,'L');
			$pdf->ln(7);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(190,3,'PT ASURANSI JIWA IFG',0,0,'L');
			$pdf->ln(7);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetFillColor(160,160,164);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(190,3,'Info dan Promo Penting',1,0,'C',true);
			$pdf->ln();
			$pdf->SetFont('Arial','',7.7);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(63.3,3,'Gunakanlah kemudahan pembayaran tagihan','LTR',0,'L',true);
			
			$pdf->Cell(63.3,3,'Yth. Pemegang Polis PT Asuransi Jiwa IFG.','LTR',0,'L',true);
			$pdf->Cell(63.3,3,'Dapatkan Helm Exclusive dengan ','LTR',0,'L',true);
			$pdf->ln();
			$pdf->Cell(63.3,3,'premi melalui channel Host-to-Host Bank BNI, BRI, ','LR',0,'L',true);
			
			$pdf->Cell(63.3,3,'Lengkapi jaminan proteksi keluarga Anda ','LR',0,'L',true);
			$pdf->Cell(63.3,3,'membeli produk PT Asuransi Jiwa IFG. S&K berlaku. ','LR',0,'L',true);
			$pdf->ln();
			$pdf->Cell(63.3,3,'Mandiri, Kantor Pos, Indomaret, Alfamart dan ','LR',0,'L',true);
			
			$pdf->Cell(63.3,3,'dengan produk JS Pro Mapan. ','LR',0,'L',true);
			$pdf->Cell(63.3,3,'Info: CALL 1500151 ','LR',0,'L',true);
			$pdf->ln();
			$pdf->Cell(63.3,3,'Bimasakti','LR',0,'L',true);
			
			$pdf->Cell(63.3,3,'Info: CALL 1500151 ','LR',0,'L',true);
			$pdf->Cell(63.3,3,'','LR',0,'L',true);
			$pdf->ln();
			$pdf->Cell(63.3,3,'Info : http://goo.gl/mH77Fq','LBR',0,'L',true);
			
			$pdf->Cell(63.3,3,'','LBR',0,'L',true);
			$pdf->Cell(63.3,3,'','LBR',0,'L',true);
			$pdf->ln(7);


			$pdf->AliasNbPages('{totalPages}');
			$pdf->Cell(190, 3, "Halaman " . $pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
			
		}
		
	}	
	$pdf->Output();
?>
