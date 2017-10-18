<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	
	public function index(){
		session_destroy();
		$this->load->view('contenido');
		$this->load->view('login/login');
	}
	
	
	
}

?>