<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('logueado')){
			redirect('','refresh');
		}
		
		
		$this->load->model('CrudModel');
		$this->load->model('actualizar_model');
		
		$this->load->library('pagination');
		$this->load->library('session');

		$this->load->helper('url');

		//$this->config->config['base_url'];
	}
/*CONSTANTES DE ADMINISTRADOR*/
	public function logout(){
		$this->session->sess_destroy();
		redirect('C3N4DM1N16/index','refresh');
	}

	public function home(){
		$dato['id_log'] = $this->session->userdata('id_log');
		$data = $this->actualizar_model->consulta_logo_sitio_where($dato);
		$this->load->view('admin_contenido/home',$data);
	}

	public function menu_secciones(){
		$dato['id_log'] = $this->session->userdata('id_log');
		$data = $this->actualizar_model->consulta_logo_sitio_where($dato);
		$this->load->view('admin_contenido/menu_secciones', $data);
	}

	public function redesSociales(){
		$this->load->view('admin_contenido/redesSociales');
	}

	public function menu_inicio(){
		$this->load->view('admin_contenido/menu_inicio');
	}
	public function menu_subseccion1(){
		$this->load->view('admin_contenido/menu_subseccion1');
	}
	public function menu_subseccion2(){
		$this->load->view('admin_contenido/menu_subseccion2');
	}

	/*    DE PÁGINA TROPHY                  */
	public function menu_nosotros(){
		$this->load->view('admin_contenido/menu_nosotros');
	}
	public function menu_productos(){
		$this->load->view('admin_contenido/menu_productos');
	}
	public function menu_productos_subseccion1(){
		$this->load->view('admin_contenido/menu_productos_subseccion1');
	}
	public function menu_productos_subseccion2(){
		$this->load->view('admin_contenido/menu_productos_subseccion2');
	}
	public function menu_contacto(){
		$this->load->view('admin_contenido/menu_contacto');
	}
	public function menu_ofertas(){
		$this->load->view('admin_contenido/menu_ofertas');
	}
	public function menu_ofertas_subseccion(){
		$this->load->view('admin_contenido/menu_ofertas_subseccion');
	}
	public function menu_clientes(){
		$this->load->view('admin_contenido/menu_clientes');
	}
	public function menu_clientes_subseccion(){
		$this->load->view('admin_contenido/menu_clientes_subseccion');
	}
	public function menu_noticias(){
		$this->load->view('admin_contenido/menu_noticias');
	}
/*---------------------------------------------------------------------------------------------------------------------
/*                                                                   CRUD MENU V1.6                  */
/*---------------------------------------------------------------------------------------------------------------------*/
	public function CrudMenu(){
			$this->load->view('admin_contenido/crud/crudMenu');
	}
	public function CrudNew(){
			$this->load->view('admin_contenido/crud/crudNew');
	}
	public function CrudUpdate(){
			$this->load->view('admin_contenido/crud/crudUpdate');
	}

	public function insertSchema(){		
		if($this->input->post('orden')==""){
			$orden = 'o0';
		}
		else{
			$orden = 'o'.$this->input->post('orden');
		}
		if($this->input->post('titulo')==""){
			$titulo = 't0';
		}
		else{
			$titulo = 't'.$this->input->post('titulo');
		}
		if($this->input->post('mceeditor')==""){
			$mceEditor = 'mce0';
		}
		else{
			$mceEditor = 'mce'.$this->input->post('mceeditor');
		}
		if($this->input->post('galeria')==""){
			$galeria = 'g0';
		}
		else{
			$galeria = 'g'.$this->input->post('galeria');
		}
		if($this->input->post('eliminable')==""){
			$eliminable = 'e0';
		}
		else{
			$eliminable = 'e'.$this->input->post('eliminable');
		}
		$subtitulos = 's'.$this->input->post('subtitulos');
		$parrafos = 'd'.$this->input->post('parrafos');
		$imagenes='i'.$this->input->post('imagenes');
		$metas='m'.$this->input->post('imagenes');
		$links='l'.$this->input->post('links');		

		$schema=$orden.$titulo.$subtitulos.$parrafos.$mceEditor.$imagenes.$metas.$links.$galeria.$eliminable;

		$seccion=$this->input->post('seccion');
		$subseccion=$this->input->post('subseccion');

		$this->CrudModel->insertSchema($schema,$seccion,$subseccion);
	}

	public function checkSchema(){
		$dato['id'] = $this->uri->segment(3);
		$data['data'] = $this->CrudModel->checkSchema($dato);
		$this->load->view('admin_contenido/crud/crudUpdate', $data);
	}

	public function updateSchema(){	
		

		if($this->input->post('orden')==""){
			$orden = 'o0';
		}
		else{
			$orden = 'o'.$this->input->post('orden');
		}
		if($this->input->post('titulo')==""){
			$titulo = 't0';
		}
		else{
			$titulo = 't'.$this->input->post('titulo');
		}
		if($this->input->post('mceeditor')==""){
			$mceEditor = 'mce0';
		}
		else{
			$mceEditor = 'mce'.$this->input->post('mceeditor');
		}
		if($this->input->post('galeria')==""){
			$galeria = 'g0';
		}
		else{
			$galeria = 'g'.$this->input->post('galeria');
		}
		if($this->input->post('eliminable')==""){
			$eliminable = 'e0';
		}
		else{
			$eliminable = 'e'.$this->input->post('eliminable');
		}
		
		$id=$this->input->post('id');		
		$subtitulos = 's'.$this->input->post('subtitulos');
		$parrafos = 'd'.$this->input->post('parrafos');		
		$imagenes='i'.$this->input->post('imagenes');
		$metas='m'.$this->input->post('imagenes');
		$links='l'.$this->input->post('links');						
		$schema=$orden.$titulo.$subtitulos.$parrafos.$mceEditor.$imagenes.$metas.$links.$galeria.$eliminable;

		$seccion=$this->input->post('seccion');
		$subseccion=$this->input->post('subseccion');
		if($this->input->post('medidas')!=""){
    			$medidas=$this->input->post('medidas');
    			$this->CrudModel->updateSchema($id,$schema,$seccion,$subseccion,$medidas);
    	}
    	else{	
		$this->CrudModel->updateSchema($id,$schema,$seccion,$subseccion);
		}
	}

	public function deleteSchema(){  		 
		 $id = $this->uri->segment(3);
    	 $this->CrudModel->deleteSchema($id);    
    }
/*-----------------------------------------------------------------------------------------------------------*/
    public function check(){
		$dato['id'] = $this->uri->segment(3);		
		$data['data'] = $this->CrudModel->checkSchema($dato);
		$data['title'] = $this->uri->segment(4);		
		$this->load->view('admin_contenido/crud/update', $data);
	}
	//Distinta forma de ver las cajas
	 public function checkNoOrder(){
		$dato['id'] = $this->uri->segment(3);		
		$data['data'] = $this->CrudModel->checkSchema($dato);
		$data['title'] = $this->uri->segment(4);		
		$this->load->view('admin_contenido/crud/updateNoOrder', $data);
	}

	public function update(){
		
    	 $formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
        $this->load->helper('path');		
		$config['upload_path'] = './img/'.$this->input->post('seccion');
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        $schema= $this->input->post('schema');
        $array = str_split($schema);
    	$ordenBool= $array[1];
        $tituloBool= $array[3];
        $subtituloBool= $array[5];
        $parrafoBool= $array[7];
        $mceEditorBool= $array[11];
        $imagenBool=$array[13];                  
        $linkBool=$array[17];


    	$data=[];
    		
    	 if($ordenBool=='1'){ 
    			$data['orden']=htmlspecialchars($this->input->post('orden'));

    			//print_r($data);
    	}
    	if($tituloBool=='1'){ 
    			$data['titulo']=htmlspecialchars($this->input->post('titulo'));
    			
    	}
    	if($this->input->post('subseccion')!=""){
    			//$data['subseccion']="si";
    		$data['subseccion']=htmlspecialchars($this->input->post('subseccion'));
    			//print_r($data);
    	}
    	if($subtituloBool=='1' || $subtituloBool=='2' || $subtituloBool=='3' || $subtituloBool=='4' || $subtituloBool=='5'
                        || $subtituloBool=='6'){
    		$data['subtitulo1']=htmlspecialchars($this->input->post('subtitulo1'));
    	}

    	if($subtituloBool=='2' || $subtituloBool=='3' || $subtituloBool=='4' || $subtituloBool=='5'
                        || $subtituloBool=='6'){
    		$data['subtitulo2']=htmlspecialchars($this->input->post('subtitulo2'));
    			
    	}
    	if($subtituloBool=='3' || $subtituloBool=='4' || $subtituloBool=='5'
                            || $subtituloBool=='6'){
    		$data['subtitulo3']=htmlspecialchars($this->input->post('subtitulo3'));
    			
    	}
    	 if($subtituloBool=='4' || $subtituloBool=='5'
                            || $subtituloBool=='6'){ 
    		$data['subtitulo4']=htmlspecialchars($this->input->post('subtitulo4'));
    			
    	}
        if($subtituloBool=='5'
                            || $subtituloBool=='6'){
    		$data['subtitulo5']=htmlspecialchars($this->input->post('subtitulo5'));
    			
    	}
    	if($subtituloBool=='6'){
    		$data['subtitulo6']=htmlspecialchars($this->input->post('subtitulo6'));
    			
    	}
    	if($parrafoBool=='1' || $parrafoBool=='2' || $parrafoBool=='3' || $parrafoBool=='4' || $parrafoBool=='5'|| $parrafoBool=='6'){
    		if($mceEditorBool!=="1"){
    		$data['parrafo1']=htmlspecialchars($this->input->post('parrafo1'));
    	    }
    	    else{
    	    $data['parrafo1']=$this->input->post('parrafo1');	
    	    }
    			
    	}
    		
    	if($parrafoBool=='2' || $parrafoBool=='3' || $parrafoBool=='4' || $parrafoBool=='5'|| $parrafoBool=='6'){
    		if($mceEditorBool!=="1"){
    		$data['parrafo2']=htmlspecialchars($this->input->post('parrafo2'));
    		}
    		else{
    	    $data['parrafo2']=$this->input->post('parrafo12');	
    	    }
    			
    	}
    	
   		 if($parrafoBool=='3' || $parrafoBool=='4' || $parrafoBool=='5'|| $parrafoBool=='6'){ 
   		 	if($mceEditorBool!=="1"){
    		$data['parrafo3']=htmlspecialchars($this->input->post('parrafo3'));
    		}
    		else{
    	    $data['parrafo3']=$this->input->post('parrafo3');	
    	    }
    			
    	}
    	if($parrafoBool=='4' || $parrafoBool=='5'|| $parrafoBool=='6'){ 
    		if($mceEditorBool!=="1"){
    		$data['parrafo4']=htmlspecialchars($this->input->post('parrafo4'));
    		}
    		else{
    	    $data['parrafo4']=$this->input->post('parrafo4');	
    	    }
    			
    	}
    	if($parrafoBool=='5'|| $parrafoBool=='6'){ 
    		if($mceEditorBool!=="1"){
    		$data['parrafo5']=htmlspecialchars($this->input->post('parrafo5'));
    		}
    		else{
    	    $data['parrafo5']=$this->input->post('parrafo5');	
    	    }
    			
    	}
    	if($parrafoBool=='6'){
    		if($mceEditorBool!=="1"){
    		$data['parrafo6']=htmlspecialchars($this->input->post('parrafo6'));
    		}
    		else{
    	    $data['parrafo6']=$this->input->post('parrafo6');	
    	    }
    			
    	}    	
    	if($linkBool=='1' || $linkBool=='2' || $linkBool=='3' || $linkBool=='4' || $linkBool=='5'|| $linkBool=='6'){
    		$data['link1']=htmlspecialchars($this->input->post('link1'));
    			
    	}
		if($linkBool=='2' || $linkBool=='3' || $linkBool=='4' || $linkBool=='5'|| $linkBool=='6'){
    		$data['link2']=htmlspecialchars($this->input->post('link2'));
    			
    	}
    	if($linkBool=='3' || $linkBool=='4' || $linkBool=='5'|| $linkBool=='6'){
    		$data['link3']=htmlspecialchars($this->input->post('link13'));
    			
    	}
    	if($linkBool=='4' || $linkBool=='5'|| $linkBool=='6'){
    		$data['link4']=htmlspecialchars($this->input->post('link4'));
    			
    	}
    	if($linkBool=='5'|| $linkBool=='6'){
    		$data['link5']=htmlspecialchars($this->input->post('link5'));
    			
    	}
    	if($linkBool=='6'){
    		$data['link6']=htmlspecialchars($this->input->post('link6'));
    			
    	}    				
    	
    			
			error_reporting(E_ALL ^ E_NOTICE);
			if($imagenBool=='1' || $imagenBool=='2' || $imagenBool=='3' || $imagenBool=='4' || $imagenBool=='5' || $imagenBool=='6'){ 
				$data['meta1']=$this->input->post('meta1');
	    		if($_FILES['imagen1']['name']!=''){
	    			
					//obtiene datos del form por post
					$value_input_file1 = $_FILES['imagen1']['name'];

						if($this->load->library('upload', $config)){
						    if (!$this->upload->do_upload('imagen1')) {
						        //si hay error
						        $error['falla'] = $this->upload->display_errors();
						    }
						    else{						   
						        $imageOld1 = $this->input->post('imagenOld1');

						        if (!empty($imageOld1)){// el value de la imagen, su nombre de archivo						        
						            $carpeta = $_SERVER['DOCUMENT_ROOT'].$page.'img/'.$this->input->post('seccion')."/";						         
						                if(file_exists($carpeta.$imageOld1)){						                	
						                    unlink($carpeta.$imageOld1);

						                }
						                
						        }
						    }
						}
				    $imagen1 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen1']['name']);
	    			$data['imagen1']=$imagen1;
	    			
	    			
	    			
	    		}
	    	}
	    	if($imagenBool=='2' || $imagenBool=='3' || $imagenBool=='4' || $imagenBool=='5' || $imagenBool=='6'){ 
	    		$data['meta2']=$this->input->post('meta2');
	    		if($_FILES['imagen2']['name']!=''){
	    			
					//obtiene datos del form por post
					$value_input_file2 = $_FILES['imagen2']['name'];

						if($this->load->library('upload', $config)){
						    if (!$this->upload->do_upload('imagen2')) {
						        //si hay error
						        $error['falla'] = $this->upload->display_errors();
						    }
						    else{
						        $imagenOld = $this->input->post('imagen2');
						        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
						            $carpeta = './img/'.$this->input->post('seccion');
						                if(file_exists($carpeta.$imageOld)){
						                    unlink($carpeta.$imageOld);
						                }
						        }
						    }
						}
					$imagen2 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen2']['name']);
	    			$data['imagen2']=$imagen2;
	    			
	    		}
	    	}
	    	if($imagenBool=='3' || $imagenBool=='4' || $imagenBool=='5' || $imagenBool=='6'){ 
	    		$data['meta3']=$this->input->post('meta3');
	    		if($_FILES['imagen3']['name']!=''){
	    			
					//obtiene datos del form por post
					$value_input_file3 = $_FILES['imagen3']['name'];

						if($this->load->library('upload', $config)){
						    if (!$this->upload->do_upload('imagen3')) {
						        //si hay error
						        $error['falla'] = $this->upload->display_errors();
						    }
						    else{
						        $imagenOld = $this->input->post('imagen3');
						        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
						            $carpeta = './img/'.$this->input->post('seccion');
						                if(file_exists($carpeta.$imageOld)){
						                    unlink($carpeta.$imageOld);
						                }
						        }
						    }
						}
					$imagen3 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen3']['name']);
	    			$data['imagen3']=$imagen3;
	    			
	    		}
	    	}
	    	if($imagenBool=='4' || $imagenBool=='5' || $imagenBool=='6'){ 
	    		$data['meta4']=$this->input->post('meta4');
	    		if($_FILES['imagen4']['name']!=''){
	    			
					//obtiene datos del form por post
					$value_input_file4 = $_FILES['imagen4']['name'];

						if($this->load->library('upload', $config)){
						    if (!$this->upload->do_upload('imagen4')) {
						        //si hay error
						        $error['falla'] = $this->upload->display_errors();
						    }
						    else{
						        $imagenOld = $this->input->post('imagen4');
						        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
						            $carpeta = './img/'.$this->input->post('seccion');
						                if(file_exists($carpeta.$imageOld)){
						                    unlink($carpeta.$imageOld);
						                }
						        }
						    }
						}
					$imagen4 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen4']['name']);
	    			$data['imagen4']=$imagen4;
	    			
	    		}
	    	}
	    	if($imagenBool=='5' || $imagenBool=='6'){ 
	    		$data['meta5']=$this->input->post('meta5');
	    		if($_FILES['imagen5']['name']!=''){
	    			
					//obtiene datos del form por post
					$value_input_file5 = $_FILES['imagen5']['name'];

						if($this->load->library('upload', $config)){
						    if (!$this->upload->do_upload('imagen5')) {
						        //si hay error
						        $error['falla'] = $this->upload->display_errors();
						    }
						    else{
						        $imagenOld = $this->input->post('imagen5');
						        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
						            $carpeta = './img/'.$this->input->post('seccion');
						                if(file_exists($carpeta.$imageOld)){
						                    unlink($carpeta.$imageOld);
						                }
						        }
						    }
						}
					$imagen5 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen5']['name']);
	    			$data['imagen5']=$imagen5;
	    			
	    		}
	    	}
	    	if($$imagenBool=='6'){ 
	    		$data['meta6']=$this->input->post('meta6');
	    		if($_FILES['imagen6']['name']!=''){
	    			
					//obtiene datos del form por post
					$value_input_file6 = $_FILES['imagen6']['name'];

						if($this->load->library('upload', $config)){
						    if (!$this->upload->do_upload('imagen6')) {
						        //si hay error
						        $error['falla'] = $this->upload->display_errors();
						    }
						    else{
						        $imagenOld = $this->input->post('imagen6');
						        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
						            $carpeta = './img/'.$this->input->post('seccion');
						                if(file_exists($carpeta.$imageOld)){
						                    unlink($carpeta.$imageOld);
						                }
						        }
						    }
						}
					$imagen6 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen6']['name']);
	    			$data['imagen6']=$imagen6;
	    			
	    		}
	    	}
    		
    		$data['id']=$this->input->post('id');
    		$data['seccion']=$this->input->post('seccion');
    		
    		//print_r($this->session->userdata('previousPage'));    	
    		$this->CrudModel->update($data);
    		/*	    	  
	    $data = array(	
	    			'id'=> $this->input->post('id'),									
					'orden'=> $this->input->post('orden'),	
					'titulo' => $this->input->post('titulo'),			
					'subtitulo1'=> $this->input->post('subtitulo1'),
					'subtitulo2'=> $this->input->post('subtitulo2'),
					'subtitulo3'=> $this->input->post('subtitulo3'),
					'subtitulo4'=> $this->input->post('subtitulo4'),
					'subtitulo5'=> $this->input->post('subtitulo5'),
					'subtitulo6'=> $this->input->post('subtitulo6'),
					'parrafo1'=> $this->input->post('parrafo1'),		
					'parrafo2'=> $this->input->post('parrafo2'),		
					'parrafo3'=> $this->input->post('parrafo3'),
					'parrafo4'=> $this->input->post('parrafo4'),
					'parrafo5'=> $this->input->post('parrafo5'),
					'parrafo6'=> $this->input->post('parrafo6'),		
					'imagen1' => $value_input_file1,	          		
					'imagen2' => $value_input_file2,	          		
					'imagen3' => $value_input_file3,	          		
					'imagen4' => $value_input_file4,	          		
					'imagen5' => $value_input_file5,	          		
					'imagen6' => $value_input_file6,	          		
					'meta1' => $this->input->post('meta1'),				
					'meta2' => $this->input->post('meta2'),		
					'meta3' => $this->input->post('meta3'),		
					'meta4' => $this->input->post('meta4'),		
					'meta5' => $this->input->post('meta5'),		
					'meta6' => $this->input->post('meta6'),		
					'link1' => $this->input->post('link1'),		
					'link2' => $this->input->post('link2'),		
					'link3' => $this->input->post('link3'),		
					'link4' => $this->input->post('link4'),		
					'link5' => $this->input->post('link5'),		
					'link6' => $this->input->post('link6'),		
					);
	         
	          //print_r($data);
	        */
	     
	    
	}
	
	
	public function newSubSeccion(){				
		$this->load->view('admin_contenido/crud/newSubSeccion');
	}
	public function newSubSeccionNoOrder(){				
		$this->load->view('admin_contenido/crud/newSubSeccionNoOrder');
	}
	public function insertSubSeccion(){				

    	$formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/'.$this->input->post('seccion');
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    		if($this->input->post('seccion')!=""){
    			$data['seccion']=htmlspecialchars($this->input->post('seccion'));
    			//print_r($data);
    		}
    		if($this->input->post('subseccion')!=""){
    			$data['subseccion']=htmlspecialchars($this->input->post('subseccion'));
    			//print_r($data);
    		}

    		if($this->input->post('esquema')!=""){
    			$data['esquema']=htmlspecialchars($this->input->post('esquema'));
    			//print_r($data);
    		}
    		if($this->input->post('medidas')!=""){
    			$data['medidas']=htmlspecialchars($this->input->post('medidas'));
    			//print_r($data);
    		}        		
    		
    		if($this->input->post('orden')!=""){
    			$data['orden']=htmlspecialchars($this->input->post('orden'));
    			//print_r($data);
    		}
    		if($this->input->post('titulo')!=""){
    			$data['titulo']=htmlspecialchars($this->input->post('titulo'));
    			
    		}
    		if($this->input->post('subtitulo1')!=""){
    			$data['subtitulo1']=htmlspecialchars($this->input->post('subtitulo1'));
    			
    		}
    		if($this->input->post('subtitulo2')!=""){
    			$data['subtitulo2']=htmlspecialchars($this->input->post('subtitulo2'));
    			
    		}
    		if($this->input->post('subtitulo3')!=""){
    			$data['subtitulo3']=htmlspecialchars($this->input->post('subtitulo3'));
    			
    		}
    		if($this->input->post('subtitulo4')!=""){
    			$data['subtitulo4']=htmlspecialchars($this->input->post('subtitulo4'));
    			
    		}
    		if($this->input->post('subtitulo5')!=""){
    			$data['subtitulo5']=htmlspecialchars($this->input->post('subtitulo5'));
    			
    		}
    		if($this->input->post('subtitulo6')!=""){
    			$data['subtitulo6']=htmlspecialchars($this->input->post('subtitulo6'));
    			
    		}
    		if($this->input->post('parrafo1')!=""){
    			$data['parrafo1']=htmlspecialchars($this->input->post('parrafo1'));
    			
    		}
    		
    		if($this->input->post('parrafo2')!=""){
    			$data['parrafo2']=htmlspecialchars($this->input->post('parrafo2'));
    			
    		}
    		if($this->input->post('parrafo3')!=""){
    			$data['parrafo3']=htmlspecialchars($this->input->post('parrafo3'));
    			
    		}
    		if($this->input->post('parrafo4')!=""){
    			$data['parrafo4']=htmlspecialchars($this->input->post('parrafo4'));
    			
    		}
    		if($this->input->post('parrafo5')!=""){
    			$data['parrafo5']=htmlspecialchars($this->input->post('parrafo5'));
    			
    		}
    		if($this->input->post('parrafo6')!=""){
    			$data['parrafo6']=htmlspecialchars($this->input->post('parrafo6'));
    			
    		}    	

    		if($this->input->post('meta1')!=""){
    			$data['meta1']=htmlspecialchars($this->input->post('meta1'));
    			
    		}
    		if($this->input->post('meta2')!=""){
    			$data['meta2']=htmlspecialchars($this->input->post('meta2'));
    			
    		}
    		if($this->input->post('meta3')!=""){
    			$data['meta3']=htmlspecialchars($this->input->post('meta3'));
    			
    		}
    		if($this->input->post('meta4')!=""){
    			$data['meta4']=htmlspecialchars($this->input->post('meta4'));
    			
    		}
    		if($this->input->post('meta5')!=""){
    			$data['meta5']=htmlspecialchars($this->input->post('meta5'));
    			
    		}
    		if($this->input->post('meta6')!=""){
    			$data['meta6']=htmlspecialchars($this->input->post('meta6'));
    			
    		}
    		if($this->input->post('link1')!=""){
    			$data['link1']=htmlspecialchars($this->input->post('link1'));
    			
    		}
    		if($this->input->post('link2')!=""){
    			$data['link2']=htmlspecialchars($this->input->post('link2'));
    			
    		}
    		if($this->input->post('link3')!=""){
    			$data['link3']=htmlspecialchars($this->input->post('link3'));
    			
    		}
    		if($this->input->post('link4')!=""){
    			$data['link4']=htmlspecialchars($this->input->post('link4'));
    			
    		}
    		if($this->input->post('link5')!=""){
    			$data['link5']=htmlspecialchars($this->input->post('link5'));
    			
    		}
    		if($this->input->post('link6')!=""){
    			$data['link6']=htmlspecialchars($this->input->post('link6'));
    			
    		}
    			
			error_reporting(E_ALL ^ E_NOTICE);
    		if($_FILES['imagen1']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file1 = $_FILES['imagen1']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen1')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld1 = $value_input_file1;
					        if (!empty($imageOld1)){// el value de la imagen, su nombre de archivo
					            $carpeta = './img/'.$this->input->post('seccion');
					                if(file_exists($carpeta.$imageOld1)){
					                    unlink($carpeta.$imageOld1);
					                }
					        }
					    }
					}
			    $imagen1 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen1']['name']);
    			$data['imagen1']=$imagen1;
    			
   
    			
    		}
    		if(isset($_FILES['imagen2']['name'])){
    			
				//obtiene datos del form por post
				$value_input_file2 = $_FILES['imagen2']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen2')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagen2');
					        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
					            $carpeta = './img/'.$this->input->post('seccion');
					                if(file_exists($carpeta.$imageOld)){
					                    unlink($carpeta.$imageOld);
					                }
					        }
					    }
					}
				$imagen2 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen2']['name']);
    			$data['imagen2']=$imagen2;
    		}
    		if($_FILES['imagen3']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file3 = $_FILES['imagen3']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen3')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagen3');
					        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
					            $carpeta = './img/'.$this->input->post('seccion');
					                if(file_exists($carpeta.$imageOld)){
					                    unlink($carpeta.$imageOld);
					                }
					        }
					    }
					}
				$imagen3 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen3']['name']);
    			$data['imagen3']=$imagen3;
    		}
    		if($_FILES['imagen4']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file4 = $_FILES['imagen4']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen4')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagen4');
					        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
					            $carpeta = './img/'.$this->input->post('seccion');
					                if(file_exists($carpeta.$imageOld)){
					                    unlink($carpeta.$imageOld);
					                }
					        }
					    }
					}
				$imagen4 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen4']['name']);
    			$data['imagen4']=$imagen4;
    		}
    		if($_FILES['imagen5']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file5 = $_FILES['imagen5']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen5')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagen5');
					        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
					            $carpeta = './img/'.$this->input->post('seccion');
					                if(file_exists($carpeta.$imageOld)){
					                    unlink($carpeta.$imageOld);
					                }
					        }
					    }
					}
				$imagen5 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen5']['name']);
    			$data['imagen5']=$imagen5;
    		}
    		if($_FILES['imagen6']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file6 = $_FILES['imagen6']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen6')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagen6');
					        if (!empty($imageOld)){// el value de la imagen, su nombre de archivo
					            $carpeta = './img/'.$this->input->post('seccion');
					                if(file_exists($carpeta.$imageOld)){
					                    unlink($carpeta.$imageOld);
					                }
					        }
					    }
					}
				$imagen6 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen6']['name']);
    			$data['imagen6']=$imagen6;
    		}
				
    		
    		
    		//print_r($data);
    		$this->CrudModel->insertSubSeccion($data);

	}


/*--------------------------------------------------CRUD GALERÍA--------------------------------------------------------------------------------------------------*/	
	public function Gallery(){
		$this->load->view('admin_contenido/crud/gallery');
	}
	public function GalleryNew(){
		$this->load->view('admin_contenido/crud/galleryNew');
	}
	public function checkGallery(){
		$dato['id'] = $this->uri->segment(4);	
    	$data['data'] = $this->CrudModel->checkGallery($dato);    		
		$this->load->view('admin_contenido/crud/galleryUpdate',$data);
	}
	public function insertGallery(){
		
    	$formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/galeria';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    		$data['idSeccion']=$this->input->post('idSeccion');

    		if($this->input->post('orden')!=""){
    		$data['orden']=htmlspecialchars($this->input->post('orden'));
    		//print_r($data);
    		}
    		if($this->input->post('titulo')!=""){
    		$data['titulo']=htmlspecialchars($this->input->post('titulo'));
    		
    		}
    		if($this->input->post('meta')!=""){
    		$data['meta']=htmlspecialchars($this->input->post('meta'));
    		
    		}
    		/*PROXIMAMENTE :p)
    		if($this->input->post('esquema')!=""){
    			$data['esquema']=$this->input->post('esquema');
    			//print_r($data);
    		}    		
    		
    	
    		if($this->input->post('subtitulo1')!=""){
    			$data['subtitulo1']=$this->input->post('subtitulo1');
    		
    		if($this->input->post('parrafo1')!=""){
    			$data['parrafo1']=$this->input->post('parrafo1');
    			
    		}*/
    		
    		
    	
    			
			error_reporting(E_ALL ^ E_NOTICE);
    		if($_FILES['imagen']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file = $_FILES['imagen']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    
					}
			    $imagen = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
    			$data['imagen']=$imagen;
    		}
    		
    		//print_r($this->session->userdata('previousGallery'));
    		$this->CrudModel->insertGallery($data);
	}

	
	public function updateGallery(){
		$formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/galeria';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];
			$data['id']=$this->input->post('id');
    		$data['idSeccion']=htmlspecialchars($this->input->post('idSeccion'));

    		if($this->input->post('orden')!=""){
    		$data['orden']=htmlspecialchars($this->input->post('orden'));
    		//print_r($data);
    		}
    		if($this->input->post('titulo')!=""){
    		$data['titulo']=htmlspecialchars($this->input->post('titulo'));
    		
    		}
    		if($this->input->post('meta')!=""){
    		$data['meta']=htmlspecialchars($this->input->post('meta'));
    		
    		}
    		
    			
			error_reporting(E_ALL ^ E_NOTICE);
    		if($_FILES['imagen']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file = $_FILES['imagen']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagenOld');
					        if (!empty( $imagenOld )){// el value de la imagen, su nombre de archivo
					            $carpeta = 'img/galeria/';
					                if(file_exists($carpeta.$imagenOld)){
					                    unlink($carpeta.$imagenOld);
					                }
					        }
					    }
					}
			    $imagen = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
    			$data['imagen']=$imagen;
    		}
    		
    		//print_r($data);
    		$this->CrudModel->updateGallery($data);
	}
	public function deleteGallery(){  		 
		$data['idSeccion'] = $this->uri->segment(3);
		$data['id'] = $this->uri->segment(4);		 		 
		$this->CrudModel->deleteGallery($data);    
    }



public function newCategory(){
	$this->load->view('admin_contenido/crud/newCategory');
}
public function checkCategory(){
		$dato['id'] = $this->uri->segment(3);		
		$data['data'] = $this->CrudModel->checkCategory($dato);
		$this->load->view('admin_contenido/crud/updateCategory', $data);
}
public function insertCategory(){
	 $formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/categorias';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    		if($this->input->post('orden')!=""){
    			$data['orden']=htmlspecialchars($this->input->post('orden'));
    			//print_r($data);
    		}
    		if($this->input->post('nombreCategoria')!=""){
    			$data['nombreCategoria']=htmlspecialchars($this->input->post('nombreCategoria'));
    			//print_r($data);
    		}

    		if($this->input->post('subcategoria')!=""){
    			$subcategoria=1;
    			$data['subcategoria']=$subcategoria;
    			//print_r($data);
    		}
    		if($this->input->post('metaDescripcion')!=""){
    			$data['metaDescripcion']=htmlspecialchars($this->input->post('metaDescripcion'));
    			//print_r($data);
    		}  
    		if($this->input->post('metaTitulo')!=""){
    			$data['metaTitulo']=htmlspecialchars($this->input->post('metaTitulo'));
    			//print_r($data);
    		}    	
			error_reporting(E_ALL ^ E_NOTICE);
			
			
	    	
	    		if($_FILES['imagen']['name']!=''){
	    			
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
	    			
	    			
	    			
	    		}
	    	
	    		$this->CrudModel->insertCategory($data);  
	    	
}
public function updateCategory(){
	 $formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/categorias';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    			$data['id']=htmlspecialchars($this->input->post('id'));
    			$data['orden']=htmlspecialchars($this->input->post('orden'));
    			//print_r($data);		  		
    			$data['nombreCategoria']=htmlspecialchars($this->input->post('nombreCategoria'));
    			//print_r($data);    	
    			$data['metaDescripcion']=htmlspecialchars($this->input->post('metaDescripcion'));
    			//print_r($data);    		
    			$data['metaTitulo']=htmlspecialchars($this->input->post('metaTitulo'));
    			//print_r($data);
    		  	
			error_reporting(E_ALL ^ E_NOTICE);
			
			
	    	
	    		if($_FILES['imagen']['name']!=''){
	    			
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
						            $carpeta = 'img/categorias/';						         
						                if(file_exists($carpeta.$imageOld1)){						                	
						                    unlink($carpeta.$imageOld1);

						                }
						                
						        }
						    }
						}

				    $imagen1 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
	    			$data['imagen']=$imagen1;
	    			
	    			
	    			
	    		}
	    	
	    		$this->CrudModel->updateCategory($data);  
	    	
}
public function deleteCategory(){  		 
		 $id = $this->uri->segment(3);
    	 $this->CrudModel->deleteCategory($id);    
    }
/*---------------------------------------------------------------------*/
public function newSubCategory(){
	$this->load->view('admin_contenido/crud/newSubCategory');
}
public function checkSubCategory(){
		$dato['id'] = $this->uri->segment(3);		
		$data['data'] = $this->CrudModel->checkSubCategory($dato);
		$this->load->view('admin_contenido/crud/updateSubCategory', $data);
}
public function insertSubCategory(){
	 $formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/subcategorias';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    		if($this->input->post('orden')!=""){
    			$data['orden']=htmlspecialchars($this->input->post('orden'));
    			//print_r($data);
    		}
    		if($this->input->post('nombreSubCategoria')!=""){
    			$data['nombreSubCategoria']=htmlspecialchars($this->input->post('nombreSubCategoria'));
    			$data['categoriaId']=htmlspecialchars($this->input->post('categoriaId'));
    			//print_r($data);
    		}

    		
    		if($this->input->post('metaDescripcion')!=""){
    			$data['metaDescripcion']=htmlspecialchars($this->input->post('metaDescripcion'));
    			//print_r($data);
    		}  
    		if($this->input->post('metaTitulo')!=""){
    			$data['metaTitulo']=htmlspecialchars($this->input->post('metaTitulo'));
    			//print_r($data);
    		}    	
			error_reporting(E_ALL ^ E_NOTICE);
			if($_FILES['imagen']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file = $_FILES['imagen']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagenOld');
					        if (!empty( $imagenOld )){// el value de la imagen, su nombre de archivo
					            $carpeta = 'img/subcategorias/';
					                if(file_exists($carpeta.$imagenOld)){
					                    unlink($carpeta.$imagenOld);
					                }
					        }
					    }
					}
			    $imagen = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
    			$data['imagen']=$imagen;
    		}
			
	    		


	    	$this->CrudModel->insertSubCategory($data);  
	    	
}
public function updateSubCategory(){
	 $formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/subcategorias';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    			$data['id']=htmlspecialchars($this->input->post('id'));
    			$data['orden']=htmlspecialchars($this->input->post('orden'));
    			//print_r($data);		  		
    			$data['nombreSubCategoria']=htmlspecialchars($this->input->post('nombreSubCategoria'));
    			//print_r($data);    	
    			$data['metaDescripcion']=htmlspecialchars($this->input->post('metaDescripcion'));
    			//print_r($data);    		
    			$data['metaTitulo']=htmlspecialchars($this->input->post('metaTitulo'));
    			//print_r($data);
    		  	
			error_reporting(E_ALL ^ E_NOTICE);
			
			
	    	
	    		if($_FILES['imagen']['name']!=''){
	    			
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
						            $carpeta = 'img/subcategorias/';						         
						                if(file_exists($carpeta.$imageOld1)){						                	
						                    unlink($carpeta.$imageOld1);

						                }
						                
						        }
						    }
						}

				    $imagen1 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
	    			$data['imagen']=$imagen1;
	    			
	    			
	    			
	    		}
	    	
	    		$this->CrudModel->updateSubCategory($data);  
	    	
}
public function deleteSubCategory(){  		 
		 $id = $this->uri->segment(3);
    	 $this->CrudModel->deleteSubCategory($id);    
}

public function newProduct(){
	$this->load->view('admin_contenido/crud/newProduct');
}
public function checkProduct(){
		$dato['id'] = $this->uri->segment(3);		
		$data['data'] = $this->CrudModel->checkProduct($dato);
		$this->load->view('admin_contenido/crud/updateProduct', $data);
}
public function insertProduct(){
	 $formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/productos';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    		if($this->input->post('orden')!=""){
    			$data['orden']=htmlspecialchars($this->input->post('orden'));
    			//print_r($data);
    		}
    		if($this->input->post('nombreProducto')!=""){
    			$data['nombreProducto']=htmlspecialchars($this->input->post('nombreProducto'));
    			$data['categoriaId']=htmlspecialchars($this->input->post('categoriaId'));
    			$data['subcategoriaId']=htmlspecialchars($this->input->post('subCategoriaId'));
    			//print_r($data);
    		}
    		if($this->input->post('descripcion')!=""){
    			$data['descripcion']=$this->input->post('descripcion');
    			
    		}
    		if($this->input->post('nombreAtributo')!=""){
    			$data['nombreAtributo']=htmlspecialchars($this->input->post('nombreAtributo'));
    			
    		}
    		if($this->input->post('atributos')!=""){
    			$data['atributos']=htmlspecialchars($this->input->post('atributos'));
    			
    		}
    		if($this->input->post('metaDescripcion')!=""){
    			$data['metaDescripcion']=htmlspecialchars($this->input->post('metaDescripcion'));
    			//print_r($data);
    		}  
    		if($this->input->post('metaTitulo')!=""){
    			$data['metaTitulo']=htmlspecialchars($this->input->post('metaTitulo'));
    			//print_r($data);
    		}    	
			error_reporting(E_ALL ^ E_NOTICE);
			if($_FILES['imagen']['name']!=''){
    			
				//obtiene datos del form por post
				$value_input_file = $_FILES['imagen']['name'];

					if($this->load->library('upload', $config)){
					    if (!$this->upload->do_upload('imagen')) {
					        //si hay error
					        $error['falla'] = $this->upload->display_errors();
					    }
					    else{
					        $imagenOld = $this->input->post('imagenOld');
					        if (!empty( $imagenOld )){// el value de la imagen, su nombre de archivo
					            $carpeta = 'img/productos/';
					                if(file_exists($carpeta.$imagenOld)){
					                    unlink($carpeta.$imagenOld);
					                }
					        }
					    }
					}
			    $imagen = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
    			$data['imagen']=$imagen;
    		}
			
	    		

    		//print_r($data);
	    	$this->CrudModel->insertProduct($data);  
	    	
}
public function updateProduct(){
	 $formatoUrl = array(
                        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
                         'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ñ' => 'N', ' ' => '_', '/' => '.',
                         '!'=>'.', ','=>'.','&'=>'.'
                      );
                       
    	$this->load->helper('path');		
		$config['upload_path'] = './img/productos';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes
    	
    	
    		
    		$data=[];

    			$data['id']=htmlspecialchars($this->input->post('id'));
    			$data['orden']=htmlspecialchars($this->input->post('orden'));
    			//print_r($data);		  		    			
    			$data['nombreProducto']=htmlspecialchars($this->input->post('nombreProducto'));
    			$data['descripcion']=$this->input->post('descripcion');    	
    			$data['nombreAtributo']=htmlspecialchars($this->input->post('nombreAtributo'));	
    			$data['atributos']=htmlspecialchars($this->input->post('atributos'));        			
    			$data['metaDescripcion']=htmlspecialchars($this->input->post('metaDescripcion'));    			
    			$data['metaTitulo']=htmlspecialchars($this->input->post('metaTitulo'));    			
    		  	
			error_reporting(E_ALL ^ E_NOTICE);
			
			
	    	
	    		if($_FILES['imagen']['name']!=''){
	    			
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
						            $carpeta = 'img/productos/';						         
						                if(file_exists($carpeta.$imageOld1)){						                	
						                    unlink($carpeta.$imageOld1);

						                }
						                
						        }
						    }
						}

				    $imagen1 = str_replace(array_keys($formatoUrl), array_values($formatoUrl), $_FILES['imagen']['name']);
	    			$data['imagen']=$imagen1;
	    			
	    			
	    			
	    		}
	    	
	    		$this->CrudModel->updateProduct($data);  
	    	
}
public function deleteProduct(){  		 
		 $id = $this->uri->segment(3);
    	 $this->CrudModel->deleteProduct($id);    
}








































/*-----------------------------------------------------OLDS-------------------------------------------------*/
	public function posicionamientoMenu(){
		$dato['id_log'] = $this->session->userdata('id_log');
		$data['consulta_logo_sitio_where'] = $this->actualizar_model->consulta_logo_sitio_where($dato);
		$this->load->view('admin_contenido/posicionamiento-menu', $data);
	}
	public function conf_sitio(){
		$dato['id_log'] = $this->session->userdata('id_log');
		$data['consulta_logo_sitio_where'] = $this->actualizar_model->consulta_logo_sitio_where($dato);
		$this->load->view('admin_contenido/conf-sitio', $data);
	}
/* -------------------------------------------- CONFIGURACIÓN DEL SITIO FAVICON --------------------------------------------------- */
	public function favicon(){
		$dato['id_favi'] = $this->uri->segment(3);
		$data['consulta_favi_where'] = $this->actualizar_model->consulta_favi_where($dato); // i
		$this->load->view('admin_contenido/conf_sitio/favicon', $data);
	}
	public function actualizarFavicon(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/home','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/conf_sitio/';
        $config['allowed_types'] = "ico|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$imagen_old = $this->input->post('nombre_favi');
					
					if (!empty($imagen_old)){
						$carpeta = './img/conf_sitio/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

					$data = array(
					'id_logo' => $this->input->post('id_logo'),
					'archivo' => $value_input_file
					);
					$this->actualizar_model->update_favi($data);	
				}
			}
		} else {
					print "<script type=\"text/javascript\">alert('Falto cargar el favicon');</script>";
					$this->load->view('admin_contenido/favicon');
				}
		}
	}
/* -------------------------------------------- CONFIGURACIÓN DEL SITIO LOGO --------------------------------------------------- */
	public function logo(){
		$dato['id_logo'] = $this->uri->segment(3);
		$data['consulta_logo_where'] = $this->actualizar_model->consulta_logo_where($dato); // i
		$this->load->view('admin_contenido/conf_sitio/logotipo', $data);
	}
	public function actualizarLogo(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/home','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/conf_sitio/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$imagen_old = $this->input->post('nombre_logo');
					if (!empty($imagen_old)){
						$carpeta = './img/conf_sitio/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

					$data = array(
					'id_logo' => $this->input->post('id_logo'),
					'archivo' => $value_input_file,
					'meta_tit' => $this->input->post('meta_desc'),
					'meta_pal' => $this->input->post('meta_pal')
					);
					$this->actualizar_model->update_logo($data);
				}
			}
		} else {
					$data = array(
					'id_logo' => $this->input->post('id_logo'),
					'meta_tit' => $this->input->post('meta_desc'),
					'meta_pal' => $this->input->post('meta_pal')
					);
					$this->actualizar_model->update_logo2($data);
				}
		}
	}


/* ---------------------------------------------------- S E O ---------------------------------------------------------- */

	public function seoMenu(){
		$dato['id_log'] = $this->session->userdata('id_log');
		$data['consulta_logo_sitio_where'] = $this->actualizar_model->consulta_logo_sitio_where($dato);
		$this->load->view('admin_contenido/seo-menu',$data);
	}
	public function seoMetas(){
		$dato['id_meta'] = $this->uri->segment(3);
		$data['consulta_metas_where'] = $this->actualizar_model->consulta_metas_where($dato);
		$this->load->view('admin_contenido/seo-metas',$data);
	}
	public function seoSecciones(){
		$dato['id_log'] = $this->session->userdata('id_log');
		$data['consulta_logo_sitio_where'] = $this->actualizar_model->consulta_logo_sitio_where($dato);
		$this->load->view('admin_contenido/seo-secciones',$data);
	}
	public function actualizarMetas(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/seoMenu','refresh');
		}else{

			$data = array(
			'id_meta' => $this->input->post('id_meta'),
			'titulo' => $this->input->post('meta_titulo'),
			'descripcion' => $this->input->post('meta_desc'),
			'palabras' => $this->input->post('meta_palabras')
			);
			$this->actualizar_model->update_metas($data);
		}
	}

/* ---------------------------------------------------- S E M ---------------------------------------------------------- */

	public function sem(){
		$data['consulta_sem_where'] = $this->actualizar_model->consulta_sem_where(1);
		$this->load->view('admin_contenido/sem',$data);
	}
	public function actualizarSem(){
		if (null !==($this->input->post('cancelar'))){
			redirect('admin_contenido/home','refresh');
		}else{

			$data = array(
			'id_tag' => $this->input->post('id_tag'),
			'meta_tag' => $this->input->post('meta_tag')
			);
			$this->actualizar_model->update_sem($data);
		}
	}

}