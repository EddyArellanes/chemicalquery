<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ChemicalQuery extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->model('actualizar_model');
		$this->load->model('CrudModel');

		if(!$this->session->userdata('logueado')){
			redirect('','refresh');
		}
	}

	
	
	public function Inicio(){
		$this->load->view('frontend/inicio');
	}
	public function Administrador(){		
		if($this->session->userdata('permisos')=="2"){
			$messagesNotSeen['messagesNotSeen']=$this->CrudModel->countMessagesNotSeen();
			$this->load->view('frontend/administrador',$messagesNotSeen);			
		}
		else{
			redirect('ChemicalQuery/Inicio','refresh');
		}
	}
	public function Productos(){
		$allProducts['allProducts']= $this->CrudModel->allProducts();
		$this->load->view('frontend/productos',$allProducts);
	}
	public function Producto(){
		$this->load->view('frontend/producto');
	}
	public function Perfil(){
		$this->load->view('frontend/perfil');
	}
	public function Contacto(){
		$this->load->view('frontend/contacto');
	}
	public function Gracias(){		
		$this->load->view('frontend/gracias');
	}
	public function Mensajes(){		
		$messages['messages']=$this->CrudModel->getMessages();
		//Ya que han sido vistos, se cambian a vistos SOLUCIÓN TEMPORAL
		$this->CrudModel->statusMessagesOn();	
		//	
		$this->load->view('frontend/mensajes',$messages);
	}
	public function RecuperarPassword(){
		$this->load->view('frontend/RecuperarPassword');
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
	
}