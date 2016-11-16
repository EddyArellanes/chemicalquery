<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
	}
	public function index(){
		if($this->session->userdata('logueado')){
		redirect('ChemicalQuery/Inicio');	
		}
		else{
		$this->load->model('actualizar_model');
		$this->load->view('frontend/main');
		}
		
	}
}
