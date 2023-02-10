<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spajonline extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('spajonline_model');
    }
	 
	function index() {
        check_session_user();
		
		$username = $this->session->USERNAME;
		$log = $this->spajonline_model->postLog_SPAJ($username);

		$token = $this->spajonline_model->get_token(strtoupper($this->session->USERNAME),strtoupper($this->session->PASSWORD));
		
		$data['token'] = $token;
		$data['idagen'] = $this->session->USERNAME;
	   
		$this->load->view('spajonline/dashboard',$data);
    }
	
	function blank() {
		check_session_user();
		
		echo "eSPAJ IFG Life ";
		echo "<font style='color:#fafafa;'>".$_SERVER['SERVER_ADDR']."</font>";
		echo "<hr />";
		echo "<br />";
		echo "Id Anda: ".$this->session->USERNAME;
		echo "<br /><br /><hr />"; ?>
		
		<script>
			var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

			// Firefox 1.0+
			var isFirefox = typeof InstallTrigger !== 'undefined';

			// Safari 3.0+ "[object HTMLElementConstructor]" 
			var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

			// Internet Explorer 6-11
			var isIE = /*@cc_on!@*/false || !!document.documentMode;

			// Edge 20+
			var isEdge = !isIE && !!window.StyleMedia;

			// Chrome 1 - 71
			var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);

			// Blink engine detection
			var isBlink = (isChrome || isOpera) && !!window.CSS;

			pbrows = "Chrome";
			aler = "<br /><br />";
			if(isEdge) pbrows = "Edge";
			if(isFirefox) pbrows = "Firefox";
			if(isSafari) pbrows = "Safari";
			if(isIE) pbrows = "Internet Explorer";
			if(isOpera) pbrows = "Opera (new)";
			
			var isChromeMobile = false;

			if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
			  isChromeMobile = true;
			}

			if(isChrome || isChromeMobile || isBlink){
				console.log("User browser is based on Chromium!");
			}else{
				aler += "<h3>Direkomendasikan agar menggunakan <a href='https://www.google.com/chrome/'>Google Chrome</a> untuk penggunaan eSPAJ.</h3>"
			}
			
			document.body.innerHTML += ""+aler+"<br /><br/>";
		</script>
		
		<?php
	}
	
	function cetak() {
		$buildid = $this->input->get('bid');
		
		$prospek = $this->spajonline_model->get_spaj($buildid);
		
		if ($prospek) {
			
			if ($prospek['STATUS'] >= 2) {
				$this->load->library('fpdf/FPDF');
				$json = file_get_contents(base_url("mobileapi/spaj_bridge/spaj_files/$prospek[KODEAGEN]/incoming/spaj_$prospek[GUID].json"));
				$data['spaj']  = json_decode($json, true);
				$data['spaj']['spaj'] = $prospek;
				$data['spaj']['nospaj'] = $prospek['NOSPAJ'];
				$data['spaj']['provinsi'] = @api_curl("/master/provinsi", 'GET')['message'];
				$data['spaj']['kota'] = @api_curl("/master/kota", 'GET')['message'];
				$data['spaj']['pekerjaan'] = @api_curl("/master/pekerjaan", 'GET')['message'];
				$data['spaj']['hobi'] = @api_curl("/master/hobi", 'GET')['message'];

				$this->load->view('spajonline/cetak', $data);
			} else {
				echo "<script>alert('Data SPAJ telah direject atau dihapus tanggal $prospek[TANGGALUPDATE] oleh $prospek[NAMAUSER]');</script>";
			}
		} else {
			echo "<script>alert('Data SPAJ tidak ditemukan');</script>";
		}
	}
	
	function test() {
		echo "contoh : ";
		echo date('d-m-Y', strtotime('1972-06-30T00:00:00.000Z'));
	}
}