<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Functions extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->model('CrudModel');
		include('classes/functions.php');
	}

	
	public function login(){
	    $this->load->view('frontend/main');
		$this->load->model('LoginModel');

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
	        		$this->LoginModel->login($datos);
	        	}
			}
        }
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('','refresh');
	}




	public function insertUser(){
		$formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/usuarios/';
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
    			$password=htmlspecialchars($this->input->post('contrasena'));
                $data['contrasenaToValidate']=$password;
    			$passwordEncrypt=crypt_pass($password);
    			$data['contrasena']=$passwordEncrypt;
    			//print_r($data);
    		}
    		if (!empty($_FILES['imagen']['name'])){
			 	$config['filename']= str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
			 		    	
				if($this->load->library('upload', $config)){
					if (!$this->upload->do_upload('imagen')){
						//si hay error
						print "<script type=\"text/javascript\">alert('Tipo de archivo incorrecto');</script>";
						//redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						echo "subida";
						$data['imagen']=$config['filename'];
    				
					}  
				}
			}
			
	    	$this->CrudModel->insertUser($data);  	
	}
	public function checkUser(){
		$data['id']=$this->uri->segment(3);
		$data = $this->CrudModel->checkUser($data);		
		echo json_encode($data) ; 		
		
	}
	public function editUser(){
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

    		$data['id']=htmlspecialchars($this->input->post('id'));
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
    			$password=htmlspecialchars($this->input->post('contrasena'));
                $data['contrasenaToValidate']=$password;
    			$passwordEncrypt=crypt_pass($password);
    			$data['contrasena']=$passwordEncrypt;
    			//print_r($data);
    		}
	    	if (!empty($_FILES['imagen']['name'])){
			 	$config['filename']= str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
			 	$imagenOld = $this->input->post('imagenOld');
			 	if (!empty($imagenOld)){
					$carpeta = './img/usuarios/';
				       if(file_exists($carpeta.$imagenOld)){
				            unlink($carpeta.$imagenOld);
				        }
				}
				if($this->load->library('upload', $config)){
					if (!$this->upload->do_upload('imagen')){
						//si hay error
						print "<script type=\"text/javascript\">alert('Tipo de archivo incorrecto');</script>";
						//redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						echo "subida";
						$data['imagen']=$config['filename'];
    				
					}  
				}
			}
	    		$this->CrudModel->editUser($data);  	
	}


	public function deleteUser(){  		 
		 $id = $this->uri->segment(3);
    	 $this->CrudModel->deleteUser($id);    
    }
    public function editProfile(){
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

            $data['id']=htmlspecialchars($this->input->post('id'));
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
                $password=htmlspecialchars($this->input->post('contrasena'));
                $data['contrasenaToValidate']=$password;
                $passwordEncrypt=crypt_pass($password);
                $data['contrasena']=$passwordEncrypt;
                //print_r($data);
            }
            if (!empty($_FILES['imagen']['name'])){
                $config['filename']= str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
                $imagenOld = $this->input->post('imagenOld');
                if (!empty($imagenOld)){
                    $carpeta = './img/usuarios/';
                       if(file_exists($carpeta.$imagenOld)){
                            unlink($carpeta.$imagenOld);
                        }
                }
                if($this->load->library('upload', $config)){
                    if (!$this->upload->do_upload('imagen')){
                        //si hay error
                        print "<script type=\"text/javascript\">alert('Tipo de archivo incorrecto');</script>";
                        //redirect($_SERVER['HTTP_REFERER']);
                    }
                    else{
                        echo "subida";
                        $data['imagen']=$config['filename'];
                    
                    }  
                }
            }
                $this->CrudModel->editUser($data);      
    }
    public function insertProduct(){
		$formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/productos/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    		
    		if($this->input->post('nombre')!=""){
    			$data['nombre']=htmlspecialchars($this->input->post('nombre'));
    			//print_r($data);
    		}
    		if($this->input->post('categoria')!=""){
    			$data['categoria']=htmlspecialchars($this->input->post('categoria'));
    			//print_r($data);
    		}
    		if($this->input->post('descripcion')!=""){
    			$data['descripcion']=$this->input->post('descripcion');
    			//print_r($data);
    		}
    		if($this->input->post('fisicas')!=""){
    			$data['fisicas']=$this->input->post('fisicas');
    			//print_r($data);
    		}
    		if($this->input->post('quimicas')!=""){
    			$data['quimicas']=$this->input->post('quimicas');
    			//print_r($data);
    		}
    		if($this->input->post('termodinamicas')!=""){
    			$data['termodinamicas']=$this->input->post('termodinamicas');
    			//print_r($data);
    		}
    		if (!empty($_FILES['imagen']['name'])){
			 	$config['filename']= str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
			 		    	
				if($this->load->library('upload', $config)){
					if (!$this->upload->do_upload('imagen')){
						//si hay error
						print "<script type=\"text/javascript\">alert('Tipo de archivo incorrecto');</script>";
						//redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						echo "subida";
						$data['imagen']=$config['filename'];
    				
					}  
				}
			}
    		//print_r($data);
	    	$this->CrudModel->insertProduct($data);  	
	}
	public function checkProduct(){
		$data['id']=$this->uri->segment(3);
		$data = $this->CrudModel->checkProduct($data);		
		echo json_encode($data) ; 		
		
	}
	public function updateProduct(){	
		$formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );	

    	$this->load->helper('path');		
		$config['upload_path'] = './img/productos/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		$data=[];

    		$data['id']=htmlspecialchars($this->input->post('id'));
    			if($this->input->post('nombre')!=""){
    			$data['nombre']=htmlspecialchars($this->input->post('nombre'));
    			//print_r($data);
    		}
    		if($this->input->post('categoria')!=""){
    			$data['categoria']=htmlspecialchars($this->input->post('categoria'));
    			//print_r($data);
    		}
    		if($this->input->post('descripcion')!=""){
    			$data['descripcion']=$this->input->post('descripcion');
    			//print_r($data);
    		}
    		if($this->input->post('fisicas')!=""){
    			$data['fisicas']=$this->input->post('fisicas');
    			//print_r($data);
    		}
    		if($this->input->post('quimicas')!=""){
    			$data['quimicas']=$this->input->post('quimicas');
    			//print_r($data);
    		}
    		if($this->input->post('termodinamicas')!=""){
    			$data['termodinamicas']=$this->input->post('termodinamicas');
    			//print_r($data);
    		}
	    	if (!empty($_FILES['imagen']['name'])){
                $config['filename']= str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
                $imagenOld = $this->input->post('imagenOld');
                if (!empty($imagenOld)){
                    $carpeta = './img/productos/';
                       if(file_exists($carpeta.$imagenOld)){
                            unlink($carpeta.$imagenOld);
                        }
                }
                if($this->load->library('upload', $config)){
                    if (!$this->upload->do_upload('imagen')){
                        //si hay error
                        print "<script type=\"text/javascript\">alert('Tipo de archivo incorrecto');</script>";
                        //redirect($_SERVER['HTTP_REFERER']);
                    }
                    else{
                        echo "subida";
                        $data['imagen']=$config['filename'];
                    
                    }  
                }
            }
	    	$this->CrudModel->updateProduct($data);  	
	}
	public function deleteProduct(){  		 
		$id = $this->uri->segment(3);
    	$this->CrudModel->deleteProduct($id);    
    }
    public function searchProduct(){  		 
		$search = $this->input->post('search');
		redirect($this->config->config['base_url']."ChemicalQuery/Productos/Buscar/".$search);
    	
    }
     public function categoryProduct(){  		 
		$categoria = $this->input->post('categoria');
		redirect($this->config->config['base_url']."ChemicalQuery/Productos/Categoria/".$categoria);
    	
    }
    public function recoverPassword(){
        $data['usuario']=htmlspecialchars($this->input->post('usuario'));
        $email= htmlspecialchars($this->input->post('email'));        
        $this->CrudModel->recoverPassword($data,$email);
        //Mandar Correo:
        $dataEmail = array( 'usuario' => xss_clean($this->input->post('usuario')),
                            'email' => xss_clean($this->input->post('email'))
                       );
        $linkPassword=$this->CrudModel->getLinkRecover($dataEmail);
        
        if($linkPassword==""){
            $recovered['error']="Este usuario no existe, revise de nuevo por favor";            
            $this->load->view('frontend/recuperarGracias',$recovered);
        }
        else{
        $linkPassword= $linkPassword->row();
        $message = "
        ChemicalQuery | Recuperar Contraseña        
        Usuario: ".$dataEmail['usuario']."        
        Correo: ".$dataEmail['email']."\n

        Mensaje:\n
        Hola ".$dataEmail['usuario']." Hemos recibido tu petición de cambiar tu contraseña, accede a este link o bien copialo y pégalo en la barra de direcciones para acceder a cambiar tu contraseña.\n
        <br><a href='".$this->config->config['base_url']."RecuperarPassword/Recuperar/".$linkPassword->contrasenaRecover."'>Recuperar Contraseña</a>
        \n          
        ";
        $this->load->library('email');
        /*
          $config['charset'] = 'utf-8';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.mailgun.org';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'postmaster@app79725467bb7b41e8949b65d4c2779a21.mailgun.org';
        $config['smtp_pass'] = 'a606278137fbbeb3f49db320b0a62e70';
        $config['smtp_timeout'] = '4';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;*/
       $this->email->initialize(array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.sendgrid.net',
          'smtp_user' => 'app57891491@heroku.com',
          'smtp_pass' => 'gycicl8t6751',
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
        ));
        $this->email->from($dataEmail['email'],$dataEmail['usuario']);
        $this->email->to($dataEmail['email']);
        $this->email->subject('ChemicalQuery | Recuperar Contraseña');
        $this->email->message($message);
       
            if ($this->email->send()){                                
                
               redirect('RecuperarPassword/RecuperarGracias','refresh');
                }
            else{
                $recovered['error']="No se pudo mandar el cambio de contraseña, revise que correo sea válido";
               
                  
                  show_error($this->email->print_debugger());
                  print "Error";
                //$this->load->view('frontend/recuperarGracias',$recovered);
            } 
        }
        
    }
    public function renewPassword(){
        $data['contrasenaRecover']= $this->uri->segment(3);
        $password=xss_clean($this->input->post('contrasena'));
        $data['contrasena']=crypt_pass($password);
        $this->CrudModel->renewPassword($data);
        $recovered['recovered']="Su contraseña ha sido restablecida, intente iniciar sesión ahora";
        $this->load->view('frontend/recuperarGracias',$recovered);
    }
    public function sendMessage(){
        $data['asunto']= xss_clean($this->input->post('subject'));
        $data['mensaje']= xss_clean($this->input->post('message'));
        $data['usuario']= $this->session->userdata('usuario');
        $result['done']=$this->CrudModel->sendMessage($data);
        if($result['done']==1){
        redirect($this->config->config['base_url']."ChemicalQuery/Gracias/");    
        }
        else{
        $this->load->view('frontend/contacto',$result);
        }
        
    }
    public function deleteMessage(){
        $data['id']=xss_clean($this->uri->segment("3"));
        $this->CrudModel->deleteMessage($data);
        redirect($this->config->config['base_url']."ChemicalQuery/Mensajes");    

    }

}