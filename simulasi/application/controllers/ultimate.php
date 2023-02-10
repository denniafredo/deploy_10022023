<?php

class Ultimate extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('modmaster');
 	}
	
	function hasil() {
		$noagen = $this->input->get('noagen');
		$noid = $this->input->get('noid');
		$buildid = $this->input->get('buildid');
		$pos = @api_curl("/pos/agen/$noagen/$noid/$buildid", 'GET')['message'];
		$data['pos'] = $pos;
		
		$this->load->view('hasil/ultimate', $data);
	}
	
	function cetak() {
        $buildid = $this->input->get('buildid');
		$pos = @api_curl("/pos/agen/null/null/$buildid", 'GET')['message'];
		$data['pos'] = $pos;
		
		$this->load->view('pdf/ultimate',$data);
	}
	
	function save_old() {
		$tahun = 1;
		$biayacoa = 27500;
		$persenalokasi = 95/100;
		$tmpir1 = 0;
		$tmpir2 = 0;
		$tmpis1 = 0;
		$tmpis2 = 0;
		$tmpit1 = 0;
		$tmpit2 = 0;
		$noagen = $this->input->post('noagen');
		$noidpp = $this->input->post('noktppemegangpolis');
		$sama = $this->input->post('tertanggungsamadenganpemegangpolis');
		$kdproduk = $this->input->post('kdproduk');
		$kdtarif = $this->input->post('kdtarif');
		$usiactt = $this->input->post('usiacalontertanggung');
		$periodetopup = $this->input->post('periodetopup');
		$uadasar = $this->input->post('uangasuransidasar');
		$resikopekerjaan = $this->input->post('resikopekerjaan');
		$resikopembagipekerjaan = $this->input->post('resikopembagipekerjaan');
		$resikohobi = $this->input->post('resikohobi');
		$resikopembagihobi = $this->input->post('resikopembagihobi');
		$premi = $this->input->post('premidasar');
		$topup = $this->input->post('topup');
		$persenalokasidana1 = $this->input->post('persentasealokasidana1');
		$persenalokasidana2 = $this->input->post('persentasealokasidana2');
		$investasirendah1 = $this->input->post('investasirendah1');
		$investasisedang1 = $this->input->post('investasisedang1');
		$investasitinggi1 = $this->input->post('investasitinggi1');
		$investasirendah2 = $this->input->post('investasirendah2');
		$investasisedang2 = $this->input->post('investasisedang2');
		$investasitinggi2 = $this->input->post('investasitinggi2');
		$kdpekerjaancalontertanggung = $sama ? $this->input->post('kdpekerjaanpemegangpolis') : $this->input->post('kdpekerjaancalontertanggung');
		$kdhobicalontertanggung = $sama ? $this->input->post('kdhobipemegangpolis') : $this->input->post('kdhobicalontertanggung');
		$namacalontertanggung = $sama ? $this->input->post('namapemegangpolis') : $this->input->post('namacalontertanggung');
		$kdjeniskelamincalontertanggung = $sama ? $this->input->post('kdjeniskelaminpemegangpolis') : $this->input->post('kdjeniskelamincalontertanggung');
		$tanggallahircalontertanggung = $sama ? $this->input->post('tanggallahirpemegangpolis') : $this->input->post('tanggallahircalontertanggung');
		$noktpcalontertanggung = $sama ? $noidpp : $this->input->post('noktpcalontertanggung');
		$merokokcalontertanggung = $sama ? $this->input->post('merokokpemegangpolis') : $this->input->post('merokoktertanggung');
		$kdhubungan = $this->input->post('kdhubungan') ? $this->input->post('kdhubungan') : '04';
		$produk = api_curl("/master/produk/$kdproduk", 'GET');
		$tarif = api_curl("/master/tarif?kdtarif=$kdtarif&kdproduk=$kdproduk&usiath=$usiactt", 'GET');
		
		// data klien
		$data['noagen'] = $noagen;
		$data['noklien'][] = 1;
		$data['kdpekerjaan'][] = $this->input->post('kdpekerjaanpemegangpolis');
		$data['kdhobi'][] = $this->input->post('kdhobipemegangpolis');
		$data['namaklien'][] = $this->input->post('namapemegangpolis');
		$data['kdjeniskelamin'][] = $this->input->post('kdjeniskelaminpemegangpolis');
		$data['tgllahir'][] = $this->input->post('tanggallahirpemegangpolis');
		$data['noid'][] = $noidpp;
		$data['merokok'][] = $this->input->post('merokokpemegangpolis');
		$data['tglrekamklien'][] = date('d-m-Y H:i:s');
		$data['noklien'][] = 2;
		$data['kdpekerjaan'][] = $kdpekerjaancalontertanggung;
		$data['kdhobi'][] = $kdhobicalontertanggung;
		$data['namaklien'][] = $namacalontertanggung;
		$data['kdjeniskelamin'][] = $kdjeniskelamincalontertanggung;
		$data['tgllahir'][] = $tanggallahircalontertanggung;
		$data['noid'][] = $noktpcalontertanggung;
		$data['merokok'][] = $merokokcalontertanggung;
		$data['tglrekamklien'][] = date('d-m-Y H:i:s');
		
		// data hitung
		$data['nocpp'] = 1;
		$data['noctthitung'] = 2;
		$data['kdproduk'] = $kdproduk;
		$data['kdcarabayar'] = $this->input->post('kdcarabayar');
		$data['premi'] = $premi;
		$data['topupsekaligus'] = $topup;
		$data['periodetopup'] = $periodetopup;
		$data['usiaproduktif'] = $this->input->post('usiaproduktif');
		$data['jua'] = $this->input->post('uangasuransi');
		$data['juamaksimal'] = !$produk['error'] && @$produk['message']['UAMAX'] > 0 ? $produk['message']['UAMAX'] : 0;
		$data['penghasilan'] = $this->input->post('penghasilansatutahun');
		$data['resikoawal'] = $this->input->post('resikoawalproposalctt');
		$data['totalresiko'] = $this->input->post('resikoawalproposalctt');
		$data['kdstatusmedical'] = $this->input->post('medical');
		$data['kdpaketmedical'] = $this->input->post('pemeriksaan');
		$data['tglrekamhitung'] = date('d-m-Y H:i:s');
		
		// data insurable
		$data['nocttinsurable'] = 2;
		$data['noklieninsurable'] = 1;
		$data['kdhubungan'] = $kdhubungan;
		
		// data extra resiko
		$data['noklienextraresiko'][] = 1;
		$data['kdpekerjaanextraresiko'][] = $this->input->post('kdpekerjaanpemegangpolis');
		$data['kdhobiextraresiko'][] = "";
		$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
		$pekerjaan = api_curl("/master/pekerjaan/".$this->input->post('kdpekerjaanpemegangpolis'), 'GET');
		$data['resiko'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PA'] : 0;
		$data['pembagi'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PEMBAGIPA'] : 0;
		$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		$data['noklienextraresiko'][] = 1;
		$data['kdpekerjaanextraresiko'][] = "";
		$data['kdhobiextraresiko'][] = $this->input->post('kdhobipemegangpolis');
		$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
		$hobi = api_curl("/master/hobi/".$this->input->post('kdhobipemegangpolis'), 'GET');
		$data['resiko'][] = !$hobi['error'] ? $hobi['message']['PA'] : 0;
		$data['pembagi'][] = !$hobi['error'] ? $hobi['message']['PEMBAGIPA'] : 0;
		$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		
		// jika tertanggung beda dengan pempol maka tambah data extra resiko
		if (!$sama) {
			$data['noklienextraresiko'][] = 2;
			$data['kdpekerjaanextraresiko'][] = $kdpekerjaancalontertanggung;
			$data['kdhobiextraresiko'][] = "";
			$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
			$pekerjaan = api_curl("/master/pekerjaan/$kdpekerjaancalontertanggung", 'GET');
			$data['resiko'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PA'] : 0;
			$data['pembagi'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PEMBAGIPA'] : 0;
			$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
			$data['noklienextraresiko'][] = 2;
			$data['kdpekerjaanextraresiko'][] = "";
			$data['kdhobiextraresiko'][] = $kdhobicalontertanggung;
			$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
			$hobi = api_curl("/master/hobi/$kdhobicalontertanggung", 'GET');
			$data['resiko'][] = !$hobi['error'] ? $hobi['message']['PA'] : 0;
			$data['pembagi'][] = !$hobi['error'] ? $hobi['message']['PEMBAGIPA'] : 0;
			$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		}
		
		// data rider
		$data['kdbenefit'][] = !$tarif['error'] ? $tarif['message']['KDBENEFIT'] : '';
		$data['biaya'][] = $this->input->post('biayauangasuransidasar');
		$data['manfaat'][] = $uadasar;
		
		// data opsi fund
		$data['kdfund'][] = $this->input->post('alokasidana1');
		$data['porsi'][] = $persenalokasidana1;
		$data['kdfund'][] = $this->input->post('alokasidana2');
		$data['porsi'][] = $persenalokasidana2;
		
		// data hasil investasi
		for ($i=$usiactt;$i<100;$i++) {
			$tarif = api_curl("/master/tarif?kdtarif=$kdtarif&kdproduk=$kdproduk&usiath=$i", 'GET');
			$biaya = $biayacoa + ($uadasar * (!$tarif['error'] ? $tarif['message']['TARIF'] : 0)/12/1000 * (1 + ($resikopekerjaan/$resikopembagipekerjaan) + ($resikohobi/$resikopembagihobi)));
			
			for ($bln=1;$bln<=12;$bln++) {
				// Ambil premi ditahun dan bulan pertama
				$premihasil = $i == $usiactt && $bln == 1 ? $premi : 0;
				// Ambil topup ditahun < periode topup dan bulan pertama
				$topuphasil = $i < ($usiactt+$periodetopup) && $bln == 1 ? $topup : 0;
				$alokasi = ($persenalokasi * $premihasil) + ($persenalokasi * $topuphasil);
			
				$ir1 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasirendah1),(1/12))) * ($persenalokasidana1/100)) : ($tmpir1 + ($alokasi-$biaya) * ($persenalokasidana1/100)) * (pow((1+$investasirendah1),(1/12)));
				$ir2 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasirendah2),(1/12))) * ($persenalokasidana2/100)) : ($tmpir2 + ($alokasi-$biaya) * ($persenalokasidana2/100)) * (pow((1+$investasirendah2),(1/12)));
				$is1 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasisedang1),(1/12))) * ($persenalokasidana1/100)) : ($tmpis1 + ($alokasi-$biaya) * ($persenalokasidana1/100)) * (pow((1+$investasisedang1),(1/12)));
				$is2 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasisedang2),(1/12))) * ($persenalokasidana2/100)) : ($tmpis2 + ($alokasi-$biaya) * ($persenalokasidana2/100)) * (pow((1+$investasisedang2),(1/12)));
				$it1 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasitinggi1),(1/12))) * ($persenalokasidana1/100)) : ($tmpit1 + ($alokasi-$biaya) * ($persenalokasidana1/100)) * (pow((1+$investasitinggi1),(1/12)));
				$it2 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasitinggi2),(1/12))) * ($persenalokasidana2/100)) : ($tmpit2 + ($alokasi-$biaya) * ($persenalokasidana2/100)) * (pow((1+$investasitinggi2),(1/12)));
				
				$tmpir1 = $ir1;
				$tmpir2 = $ir2;
				$tmpis1 = $is1;
				$tmpis2 = $is2;
				$tmpit1 = $it1;
				$tmpit2 = $it2;
			}
			
			$data['tahun'][] = $tahun;
			$data['premihasil'][] = $i == $usiactt ? $premi : 0;
			$data['topupsekaligushasil'][] = $i < ($usiactt+$periodetopup) ? $topup : 0;
			$data['topupberkalahasil'][] = 0;
			$data['investasirendah'][] = ($ir1+$ir2)/1000;
			$data['investasisedang'][] = ($is1+$is2)/1000;
			$data['investasitinggi'][] = ($it1+$it2)/1000;
			$data['investasiuarendah'][] = ($ir1+$ir2) < 0 ? 0 : ($uadasar + $ir1 + $ir2)/1000;
			$data['investasiuasedang'][] = ($is1+$is2) < 0 ? 0 : ($uadasar + $is1 + $is2)/1000;
			$data['investasiuatinggi'][] = ($it1+$it2) < 0 ? 0 : ($uadasar + $it1 + $it2)/1000;
			$data['usia'][] = $i;
			
			$tahun++;
		}
		
		$result = api_curl_tes("/pos/agen", 'POST', $data); exit;

		if ($result['error']) {
			echo "<script>alert('Gagal menyimpan data!');</script>";
			echo "Gagal Menyimpan Data, Error : $result[message]<br><br><a href='".str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=$noidpp'>Kembali</a>";
		} else {
			redirect(base_url("ultimate/hasil?noagen=$noagen&noid=$noidpp&buildid=".$result['message']['buildidserver']));
		}
	}
	
	function save() {
		$noagen = $this->input->post('noagen');
		$noidpp = $this->input->post('noktppemegangpolis');
		$sama = $this->input->post('tertanggungsamadenganpemegangpolis');
		$kdproduk = $this->input->post('kdproduk');
		$kdtarif = $this->input->post('kdtarif');
		$usiactt = $this->input->post('usiacalontertanggung');
		$periodetopup = $this->input->post('periodetopup');
		$uadasar = $this->input->post('uangasuransidasar');
		$resikopekerjaan = $this->input->post('resikopekerjaan');
		$resikopembagipekerjaan = $this->input->post('resikopembagipekerjaan');
		$resikohobi = $this->input->post('resikohobi');
		$resikopembagihobi = $this->input->post('resikopembagihobi');
		$premi = $this->input->post('premidasar');
		$topup = $this->input->post('topup');
		$persenalokasidana1 = $this->input->post('persentasealokasidana1');
		$persenalokasidana2 = $this->input->post('persentasealokasidana2');
		$investasirendah1 = $this->input->post('investasirendah1');
		$investasisedang1 = $this->input->post('investasisedang1');
		$investasitinggi1 = $this->input->post('investasitinggi1');
		$investasirendah2 = $this->input->post('investasirendah2');
		$investasisedang2 = $this->input->post('investasisedang2');
		$investasitinggi2 = $this->input->post('investasitinggi2');
		$kdpekerjaancalontertanggung = $sama ? $this->input->post('kdpekerjaanpemegangpolis') : $this->input->post('kdpekerjaancalontertanggung');
		$kdhobicalontertanggung = $sama ? $this->input->post('kdhobipemegangpolis') : $this->input->post('kdhobicalontertanggung');
		$namacalontertanggung = $sama ? $this->input->post('namapemegangpolis') : $this->input->post('namacalontertanggung');
		$kdjeniskelamincalontertanggung = $sama ? $this->input->post('kdjeniskelaminpemegangpolis') : $this->input->post('kdjeniskelamincalontertanggung');
		$tanggallahircalontertanggung = $sama ? $this->input->post('tanggallahirpemegangpolis') : $this->input->post('tanggallahircalontertanggung');
		$noktpcalontertanggung = $sama ? $noidpp : $this->input->post('noktpcalontertanggung');
		$merokokcalontertanggung = $sama ? $this->input->post('merokokpemegangpolis') : $this->input->post('merokoktertanggung');
		$kdhubungan = $this->input->post('kdhubungan') ? $this->input->post('kdhubungan') : '04';
		$produk = api_curl("/master/produk/$kdproduk", 'GET');
		$tarif = api_curl("/master/tarif?kdtarif=$kdtarif&kdproduk=$kdproduk&usiath=$usiactt", 'GET');
		
		// data klien
		$data['noagen'] = $noagen;
		$data['noklien'][] = 1;
		$data['kdpekerjaan'][] = $this->input->post('kdpekerjaanpemegangpolis');
		$data['kdhobi'][] = $this->input->post('kdhobipemegangpolis');
		$data['namaklien'][] = $this->input->post('namapemegangpolis');
		$data['kdjeniskelamin'][] = $this->input->post('kdjeniskelaminpemegangpolis');
		$data['tgllahir'][] = $this->input->post('tanggallahirpemegangpolis');
		$data['noid'][] = $noidpp;
		$data['merokok'][] = $this->input->post('merokokpemegangpolis');
		$data['tglrekamklien'][] = date('d-m-Y H:i:s');
		$data['noklien'][] = 2;
		$data['kdpekerjaan'][] = $kdpekerjaancalontertanggung;
		$data['kdhobi'][] = $kdhobicalontertanggung;
		$data['namaklien'][] = $namacalontertanggung;
		$data['kdjeniskelamin'][] = $kdjeniskelamincalontertanggung;
		$data['tgllahir'][] = $tanggallahircalontertanggung;
		$data['noid'][] = $noktpcalontertanggung;
		$data['merokok'][] = $merokokcalontertanggung;
		$data['tglrekamklien'][] = date('d-m-Y H:i:s');
		
		// data hitung
		$data['nocpp'] = 1;
		$data['noctthitung'] = 2;
		$data['kdproduk'] = $kdproduk;
		$data['kdcarabayar'] = $this->input->post('kdcarabayar');
		$data['premi'] = $premi;
		$data['topupsekaligus'] = $topup;
		$data['periodetopup'] = $periodetopup;
		$data['usiaproduktif'] = $this->input->post('usiaproduktif');
		$data['jua'] = $this->input->post('uangasuransi');
		$data['juamaksimal'] = !$produk['error'] && @$produk['message']['UAMAX'] > 0 ? $produk['message']['UAMAX'] : 0;
		$data['penghasilan'] = $this->input->post('penghasilansatutahun');
		$data['resikoawal'] = $this->input->post('resikoawalproposalctt');
		$data['totalresiko'] = $this->input->post('resikoawalproposalctt');
		$data['kdstatusmedical'] = $this->input->post('medical');
		$data['kdpaketmedical'] = $this->input->post('pemeriksaan');
		$data['tglrekamhitung'] = date('d-m-Y H:i:s');
		
		// data insurable
		$data['nocttinsurable'] = 2;
		$data['noklieninsurable'] = 1;
		$data['kdhubungan'] = $kdhubungan;
		
		// data extra resiko
		$data['noklienextraresiko'][] = 1;
		$data['kdpekerjaanextraresiko'][] = $this->input->post('kdpekerjaanpemegangpolis');
		$data['kdhobiextraresiko'][] = "";
		$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
		$pekerjaan = api_curl("/master/pekerjaan/".$this->input->post('kdpekerjaanpemegangpolis'), 'GET');
		$data['resiko'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PA'] : 0;
		$data['pembagi'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PEMBAGIPA'] : 0;
		//$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		$data['noklienextraresiko'][] = 1;
		$data['kdpekerjaanextraresiko'][] = "";
		$data['kdhobiextraresiko'][] = $this->input->post('kdhobipemegangpolis');
		$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
		$hobi = api_curl("/master/hobi/".$this->input->post('kdhobipemegangpolis'), 'GET');
		$data['resiko'][] = !$hobi['error'] ? $hobi['message']['PA'] : 0;
		$data['pembagi'][] = !$hobi['error'] ? $hobi['message']['PEMBAGIPA'] : 0;
		//$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		
		// jika tertanggung beda dengan pempol maka tambah data extra resiko
		if (!$sama) {
			$data['noklienextraresiko'][] = 2;
			$data['kdpekerjaanextraresiko'][] = $kdpekerjaancalontertanggung;
			$data['kdhobiextraresiko'][] = "";
			$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
			$pekerjaan = api_curl("/master/pekerjaan/$kdpekerjaancalontertanggung", 'GET');
			$data['resiko'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PA'] : 0;
			$data['pembagi'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PEMBAGIPA'] : 0;
			//$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
			$data['noklienextraresiko'][] = 2;
			$data['kdpekerjaanextraresiko'][] = "";
			$data['kdhobiextraresiko'][] = $kdhobicalontertanggung;
			$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_LIFE;
			$hobi = api_curl("/master/hobi/$kdhobicalontertanggung", 'GET');
			$data['resiko'][] = !$hobi['error'] ? $hobi['message']['PA'] : 0;
			$data['pembagi'][] = !$hobi['error'] ? $hobi['message']['PEMBAGIPA'] : 0;
			//$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		}
		
		// data rider
		$data['kdbenefit'][] = !$tarif['error'] ? $tarif['message']['KDBENEFIT'] : '';
		$data['biaya'][] = $this->input->post('biayauangasuransidasar');
		$data['manfaat'][] = $uadasar;
		
		// data opsi fund
		$data['kdfund'][] = $this->input->post('alokasidana1');
		$data['porsi'][] = $persenalokasidana1;
		$data['kdfund'][] = $this->input->post('alokasidana2');
		$data['porsi'][] = $persenalokasidana2;
		
		// data hasil investasi
		$data['usiactt'] = $usiactt;
		$data['kdtarif'] = $kdtarif;
		$data['uadasar'] = $uadasar;
		$data['resikopekerjaan'] = $resikopekerjaan;
		$data['resikopembagipekerjaan'] = $resikopembagipekerjaan;
		$data['resikohobi'] = $resikohobi;
		$data['resikopembagihobi'] = $resikopembagihobi;
		$data['investasirendah1'] = $investasirendah1;
		$data['investasirendah2'] = $investasirendah2;
		$data['investasisedang1'] = $investasisedang1;
		$data['investasisedang2'] = $investasisedang2;
		$data['investasitinggi1'] = $investasitinggi1;
		$data['investasitinggi2'] = $investasitinggi2;
		
		$result = api_curl("/pos/ultimate", 'POST', $data);

		if ($result['error']) {
			echo "<script>alert('Gagal menyimpan data!');</script>";
			echo "Gagal Menyimpan Data, Error : $result[message]<br><br><a href='".str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=$noidpp'>Kembali</a>";
		} else {
			redirect(base_url("ultimate/hasil?noagen=$noagen&noid=$noidpp&buildid=".$result['message']['buildidserver']));
		}
	}
}