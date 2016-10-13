<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C3N4DM1N16 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		
		$this->load->view('admin_contenido/index');
		$this->load->model('Usuario_model');

		$datos = array('usuario' => $this->input->post('usuario'),
					   'contrasena' => $this->input->post('contrasena'));
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean');    
        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|xss_clean');

        $next = true;

        if (null !==($this->input->post('ingresar'))){

	        if(empty($datos['usuario']) and empty($datos['contrasena'])){
        		$next = false;
	        	print "<script type=\"text/javascript\">alert('Debe ingresar su nombre de usuario y contraseña para continuar');</script>";
	        	$this->load->view('admin_contenido/index');
	        } elseif(empty($datos['usuario'])){
	        	$next = false;
	        	print "<script type=\"text/javascript\">alert('Debe ingresar su nombre de usuario para continuar');</script>";
	        	$this->load->view('admin_contenido/index');
	        } elseif(empty($datos['contrasena'])){
	        	$next = false;
	        	print "<script type=\"text/javascript\">alert('Debe ingresar su contraseña para continuar');</script>";
	        	$this->load->view('admin_contenido/index');
	        }

			if($next){
				if($this->form_validation->run() == FALSE){	
	        		$this->load->view('admin_contenido/index');
	        	} else {
	        		$this->Usuario_model->login($datos);
	        	}
			}
        }
	}
	
}