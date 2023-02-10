<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/login.php/welcome
     *	- or -
     * 		http://example.com/login.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /login.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
            //$this->load->view('welcome_message');
    $this->template->title = 'Welcome!';

    $this->template->content->view('welcome_message');

    $this->template->footer = 'Made with Twitter Bootstrap';

    $this->template->descryption = 'Ini deskripsi';

    $this->template->publish();
    }

    public function tes_server() {
        echo "Testing server jaim";
    }
    
    public function tes() {
        $this->load->view('test');
    }
}
