<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("NuSOAP");

        $this->nusoap_server = new soap_server();
        $this->nusoap_server->configureWSDL("server", "urn:server");

        $wsdl = $this->input->get('wsdl');
        if (isset($wsdl)) {
            $_SERVER['QUERY_STRING'] = "wsdl";
        } else {
            $_SERVER['QUERY_STRING'] = "";
        }
    }

    function changelanguage($lang) {
        if (strtolower($lang) == 'en') {
            $this->lang->load('message', 'english');
            $this->lang->load('email', 'english');
        } else {
            $this->lang->load('message', 'indonesia');
            $this->lang->load('email', 'indonesia');
        }
    }
}