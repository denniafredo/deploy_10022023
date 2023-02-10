<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu {
	private $ci;
	
	function __construct() {
		$this->ci = &get_instance();
	}
	
	function l_menu() { 
		$data = array();
		$kdrole = $this->ci->session->KDJABATANAGEN == '27' ? '0' : $this->ci->session->KDROLE;
		
		$q = $this->ci->db
			->query("SELECT a.KDMENU, IDPARENT, MENU, URL, ICON, a.NOURUT 
					 FROM JAIM_902_MENU a 
					 INNER JOIN JAIM_904_ROLE_MENU b ON a.KDMENU = b.KDMENU 
					 INNER JOIN JAIM_901_ROLE c ON b.KDROLE = c.KDROLE AND a.KDKATEGORI = c.KDKATEGORI 
					 WHERE KDSTATUS = 1 AND b.KDROLE = $kdrole 
					 	 AND STATUS = 1 
					 ORDER BY a.NOURUT");
			
		if ($q->num_rows() > 0) {
			// variabel ref penampung
			$refs = array();
			
			// variable list penampung
			$list = array();
			
			foreach ($q->result_array() as $result) {
				$thisref			 = &$refs[$result['KDMENU']];
				$thisref['KDMENU']	 = $result['KDMENU'];
				$thisref['IDPARENT'] = $result['IDPARENT'];
				$thisref['MENU']	 = $result['MENU'];
				$thisref['URL']		 = $result['URL'];
				$thisref['ICON']	 = $result['ICON'];
								
				// jika id_parent bernilai null
				if ($result['IDPARENT'] == NULL) {
					$list[$result['KDMENU']] = &$thisref;
				}
				else {
					$refs[$result['IDPARENT']]['CHILDREN'][$result['KDMENU']] = &$thisref;
				}

				$data = $list;
			}
		}
		
		$q->free_result();
		
		return $data;
	}
}
