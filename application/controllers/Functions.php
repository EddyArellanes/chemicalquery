<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Functions extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->model('actualizar_model');
		
	}

	
	public function login(){
	    $this->load->view('frontend/main');
		$this->load->model('loginModel');

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
	        		$this->load->view('frontend/main');
	        	} else {
	        		$this->loginModel->login($datos);
	        	}
			}
        }
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('','refresh');
	}




	public function formContacto(){
		/*if($this->input->post('check')==""){

		 redirect("ImpulsoMexicano/Gracias", 'refresh');
		 }*/
		 

        $data['id'] = '47';
        $this->load->model('CrudModel');
        $info = $this->CrudModel->checkSchema($data);
        
        $correo = $info->link1;	
        //print $correo;

		$datos = array( 'nombre' => $this->input->post('nombre'),
						'direccion' => $this->input->post('direccion'),						
						'email' => $this->input->post('email'),
						'telefono' => $this->input->post('telefono'),						
					   	'mensaje' => $this->input->post('mensaje'),					   	
					   );
     
		
        

$message = "
Información de Contacto | Quelatonic
Asunto: Información
Nombre: ".$datos['nombre']."
Dirección: ".$datos['direccion']."
Télefono: ".$datos['telefono']."\n

Mensaje:\n
".$datos['mensaje']."\n
\n			
";
			
			//print_r($message);
			

        	$this->load->library('email');
			$this->email->from($datos['email'], $datos['nombre']);
			$this->email->to($correo);
			$this->email->subject('Contacto | Quelatonic');
			$this->email->message($message);
			if ($this->email->send())
			{
				//$this->load->view('pagina/inicio', $error);			
			$url=$this->config->base_url();  
        	redirect("Quelatonic/Gracias", 'refresh');
			} 
        
	}
	public function insertUser(){
		$formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/usuarios';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    		
    		if($this->input->post('nombre')!=""){
    			$data['nombre']=htmlspecialchars($this->input->post('nombre'));
    			//print_r($data);
    		}
    		if($this->input->post('apellidos')!=""){
    			$data['apellidos']=htmlspecialchars($this->input->post('apellidos'));
    			//print_r($data);
    		}
    		if($this->input->post('usuario')!=""){
    			$data['usuario']=htmlspecialchars($this->input->post('usuario'));
    			//print_r($data);
    		}
    		if($this->input->post('tipoCuenta')!=""){
    			$data['tipoCuenta']=htmlspecialchars($this->input->post('tipoCuenta'));
    			//print_r($data);
    		}
    		if($this->input->post('numeroCuenta')!=""){
    			$data['numeroCuenta']=htmlspecialchars($this->input->post('numeroCuenta'));
    			//print_r($data);
    		}
    		if($this->input->post('permisos')!=""){
    			$data['permisos']=htmlspecialchars($this->input->post('permisos'));
    			//print_r($data);
    		}
    		if($this->input->post('contrasena')!=""){
    			$data['contrasena']=htmlspecialchars($this->input->post('contrasena'));
    			//print_r($data);
    		}
    		if($this->input->post('contrasenaRepeat')!=""){
    			$data['contrasenaRepeat']=htmlspecialchars($this->input->post('contrasenaRepeat'));
    			//print_r($data);
    		}

    		
			error_reporting(E_ALL ^ E_NOTICE);
			
			
	    	
	    		/*if($_FILES['imagen']['name']!=''){
	    			
					//obtiene datos del form por post
					$value_input_file1 = $_FILES['imagen']['name'];

						if($this->load->library('upload', $config)){
						    if (!$this->upload->do_upload('imagen')) {
						        print ":c";
						        $error['falla'] = $this->upload->display_errors();
						    }
						    else{						   
						        $imageOld1 = $this->input->post('imagenOld1');

						        if (!empty($imageOld1)){// el value de la imagen, su nombre de archivo						        
						            $carpeta = 'img/categorias';						         
						                if(file_exists($carpeta.$imageOld1)){						                	
						                    unlink($carpeta.$imageOld1);

						                }
						                
						        }
						    }
						}

				    $imagen1 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
	    			$data['imagen']=$imagen1;
	    			
	    			
	    			
	    		}*/
	    	
	    		$this->CrudModel->insertUser($data);  
	    	
}
	}

	
}