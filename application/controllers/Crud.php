<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('logueado')){
			redirect('','refresh');
		}
		
		
	
		$this->load->model('banners_model');
		$this->load->model('actualizar_model');
		//$this->load->model('Productos_model');
		$this->load->library('pagination');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('ConnectWithAdminIsGood/index','refresh');
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
	public function menu_inicio(){
		$this->load->view('admin_contenido/menu_inicio');
	}
	public function menu_inicio_iconos(){
		$this->load->view('admin_contenido/menu_inicio_iconos');
	}
	public function menu_header(){
		$this->load->view('admin_contenido/menu_header');
	}
	public function menu_footer(){
		$this->load->view('admin_contenido/menu_footer');
	}
	
	public function menu_nosotros(){
		$this->load->view('admin_contenido/menu_nosotros');
	}
	public function menu_productosyservicios(){
		$this->load->view('admin_contenido/menu_productosyservicios');
	}
	public function menu_servicios(){
		$this->load->view('admin_contenido/menu_servicios');
	}
	public function menu_serviciosSeccion(){
		$this->load->view('admin_contenido/menu_serviciosSeccion');
	}
	public function menu_productos(){
		$this->load->view('admin_contenido/menu_productos');
	}
	public function menu_marcas(){
		$this->load->view('admin_contenido/menu_marcas');
	}
	public function menu_noticias(){
		$this->load->view('admin_contenido/menu_noticias');
	}
	public function menu_bolsa(){
		$this->load->view('admin_contenido/menu_bolsa');
	}
	public function menu_bolsa_vacantes(){
		$this->load->view('admin_contenido/menu_bolsa_vacantes');
	}
	public function menu_contacto(){
		$this->load->view('admin_contenido/menu_contacto');
	}
	public function menu_aviso(){
		$this->load->view('admin_contenido/menu_aviso');
	}
	public function menu_test(){
		$this->load->view('admin_contenido/menu_test');
	}
	public function CrudMenu(){
		$this->load->view('admin_contenido/CRUD/crudMenu');
	}
	public function CrudNew(){
		$this->load->view('admin_contenido/CRUD/crudNew');
	}
	public function CrudUpdate(){
		$this->load->view('admin_contenido/CRUD/crudUpdate');
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

		$this->actualizar_model->insertSchema($schema,$seccion,$subseccion);
	}
	public function checkSchema(){
		$dato['id'] = $this->uri->segment(3);
		$data['data'] = $this->actualizar_model->checkSchema($dato);
		$this->load->view('admin_contenido/CRUD/crudUpdate', $data);
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
			
		$this->actualizar_model->updateSchema($id,$schema,$seccion,$subseccion);
	}
	public function deleteSchema(){  		 
		 $id = $this->uri->segment(4);
		 $seccion = $this->uri->segment(3);
		 print $id."\n";
		 print $seccion;
    	 $this->actualizar_model->deleteContent($id,$seccion);    
    }

    public function check(){
		$dato['id'] = $this->uri->segment(3);
		$data['data'] = $this->actualizar_model->checkSchema($dato);
		$this->load->view('admin_contenido/CRUD/update', $data);
	}
	public function update(){
		 if (null !==($this->input->post('cancelar'))){
      		redirect('Administrador/menu_'.$this->input->post('seccion'),'refresh');
    	 }

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
    		
    		if($this->input->post('orden')!=""){
    			$data['orden']=$this->input->post('orden');
    			//print_r($data);
    		}
    		if($this->input->post('titulo')!=""){
    			$data['titulo']=$this->input->post('titulo');
    			
    		}
    		if($this->input->post('subtitulo1')!=""){
    			$data['subtitulo1']=$this->input->post('subtitulo1');
    			
    		}
    		if($this->input->post('subtitulo2')!=""){
    			$data['subtitulo2']=$this->input->post('subtitulo2');
    			
    		}
    		if($this->input->post('subtitulo3')!=""){
    			$data['subtitulo3']=$this->input->post('subtitulo3');
    			
    		}
    		if($this->input->post('subtitulo4')!=""){
    			$data['subtitulo4']=$this->input->post('subtitulo4');
    			
    		}
    		if($this->input->post('subtitulo5')!=""){
    			$data['subtitulo5']=$this->input->post('subtitulo5');
    			
    		}
    		if($this->input->post('subtitulo6')!=""){
    			$data['subtitulo6']=$this->input->post('subtitulo6');
    			
    		}
    		if($this->input->post('parrafo1')!=""){
    			$data['parrafo1']=$this->input->post('parrafo1');
    			
    		}
    		
    		if($this->input->post('parrafo2')!=""){
    			$data['parrafo2']=$this->input->post('parrafo2');
    			
    		}
    		if($this->input->post('parrafo3')!=""){
    			$data['parrafo3']=$this->input->post('parrafo3');
    			
    		}
    		if($this->input->post('parrafo4')!=""){
    			$data['parrafo4']=$this->input->post('parrafo4');
    			
    		}
    		if($this->input->post('parrafo5')!=""){
    			$data['parrafo5']=$this->input->post('parrafo5');
    			
    		}
    		if($this->input->post('parrafo6')!=""){
    			$data['parrafo6']=$this->input->post('parrafo6');
    			
    		}    	

    		if($this->input->post('meta1')!=""){
    			$data['meta1']=$this->input->post('meta1');
    			
    		}
    		if($this->input->post('meta2')!=""){
    			$data['meta2']=$this->input->post('meta2');
    			
    		}
    		if($this->input->post('meta3')!=""){
    			$data['meta3']=$this->input->post('meta3');
    			
    		}
    		if($this->input->post('meta4')!=""){
    			$data['meta4']=$this->input->post('meta4');
    			
    		}
    		if($this->input->post('meta5')!=""){
    			$data['meta5']=$this->input->post('meta5');
    			
    		}
    		if($this->input->post('meta6')!=""){
    			$data['meta6']=$this->input->post('meta6');
    			
    		}
    		if($this->input->post('link1')!=""){
    			$data['link1']=$this->input->post('link1');
    			
    		}
    		if($this->input->post('link2')!=""){
    			$data['link2']=$this->input->post('link2');
    			
    		}
    		if($this->input->post('link3')!=""){
    			$data['link3']=$this->input->post('link3');
    			
    		}
    		if($this->input->post('link4')!=""){
    			$data['link4']=$this->input->post('link4');
    			
    		}
    		if($this->input->post('link5')!=""){
    			$data['link5']=$this->input->post('link5');
    			
    		}
    		if($this->input->post('link6')!=""){
    			$data['link6']=$this->input->post('link6');
    			
    		}
    		
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
    		
    		$data['id']=$this->input->post('id');
    		$data['seccion']=$this->input->post('seccion');
    		
    		//print_r($data);
    		$this->actualizar_model->update($data);
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
	          
	          print_r($data);
	          //$this->actualizar_model->update($data);
	     */   
	    
	}






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
/* ---------------------------------------------------- BANNER ---------------------------------------------------------- */
	public function bannerMenu(){
		$this->load->view('admin_contenido/bannerMenu');
	}
	public function bannerGoup(){
		$this->load->view('admin_contenido/bannerGoup');
	}
	public function bannerUpload(){
		$dato['id_banner'] = $this->uri->segment(3);
		$data['consulta_banner_where'] = $this->banners_model->consulta_banner_where($dato);
		$this->load->view('admin_contenido/bannerUpload', $data);
	}
	public function bannerDelate(){
		$dato['id_banner'] = $this->uri->segment(3);
		
		$this->banners_model->delete_banner_where($dato);
		$this->load->view('admin_contenido/bannerMenu');
	}
	public function insertarBanner(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/bannerMenu','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/banner/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$data = array(
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_palabras' => $this->input->post('meta_palabras'),
					'url' => $this->input->post('url'),
					'orden' => $this->input->post('orden')
					);
					$this->banners_model->insertar_banner($data);
				}
			}
		} else {
					print "<script type=\"text/javascript\">alert('Falto cargar la imagen');</script>";
					$this->load->view('admin_contenido/bannerGoup');
				}
		}
	}
	public function actualizarBanner(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/bannerMenu','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/banner/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){

				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nombre_banner');
					$carpeta = './img/banner/';
			        if(file_exists($carpeta.$imagen_old))
			        {
			            unlink($carpeta.$imagen_old);
			        }

					$data = array(
					'id_banner' => $this->input->post('id_banner'),
					'archivo' => $value_input_file,
					'meta_desc' => $this->input->post('meta_desc'),
					'meta_pal' => $this->input->post('meta_pal'),
					'url' => $this->input->post('url'),
					'orden' => $this->input->post('orden')
					);
					$this->banners_model->update_campos($data);
				}
			}
		} else {
					$data = array(
					'id_banner' => $this->input->post('id_banner'),
					'meta_desc' => $this->input->post('meta_desc'),
					'meta_pal' => $this->input->post('meta_pal'),
					'url' => $this->input->post('url'),
					'orden' => $this->input->post('orden')
					);
					$this->banners_model->update_campos2($data);
				}
		}
	}

/* ---------------------------------------------------- BLOQUES HOME ---------------------------------------------------------- */
	public function metegoup(){
		$this->load->view('admin_contenido/menus/mete-goup');
	}
	public function metemenu(){
		$this->load->view('admin_contenido/menus/mete-menu');
	}
	public function gallery(){
		$this->load->view('admin_contenido/menus/gallery');
	}
	public function galleryNew(){
		$this->load->view('admin_contenido/menus/galleryNew');
	}
	public function galleryModify(){
		$this->load->view('admin_contenido/menus/galleryModify');
	}
	public function newProduct(){
		$this->load->view('admin_contenido/menus/newProduct');
	}
	public function insertProduct(){
		if (null !==($this->input->post('cancelar'))){
			$this->load->view('admin_contenido/menu_productos');
			
		}else{
		$this->load->helper('path');
		$input_file  = 'imagen';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/productos/';
        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
        $config['max_size'] = "2097152"; //2 megabytes

         if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$imagen_old = $this->input->post('nom_imagen');
					if (!empty($imagen_old)){
						$carpeta = './img/servicios_categorias/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

			
				}
			}
		}
		$data = array(					
					'titulo' => $this->input->post('titulo'),
					'imagen' => $value_input_file,									
					'metaDescripcion' => $this->input->post('metaDescripcion'),					
					);
					
					$this->productos_model->insertProducts($data);
		}
	}

	public function Meteconsulta(){
		$dato['id'] = $this->uri->segment(3);
		$data['consulta_mete'] = $this->actualizar_model->consultmete($dato);
		$this->load->view('admin_contenido/menus/mete-upload', $data);
	}
	public function MeteDelete(){
		$dato['id'] = $this->uri->segment(3);
		$this->actualizar_model->delete_mete($dato);
		$this->load->view('admin_contenido/menus/mete-menu');
	}
	public function meteinsert(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/metemenu','refresh');
		}else{
			$data = array(
			'tipo' => $this->input->post('tipo'),
			'bloque' => $this->input->post('bloque'),
			'seccion' => $this->input->post('seccion'),
			'medida' => $this->input->post('medida')
			);
			$this->actualizar_model->insertarcampos($data);
		}
	}
	public function MeteUpdate(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/metemenu','refresh');
		}else{
			$data = array(
			'id' => $this->input->post('id'),
			'tipo' => $this->input->post('tipo'),
			'bloque' => $this->input->post('bloque'),
			'seccion' => $this->input->post('seccion'),
			'medida' => $this->input->post('medida')
			);
			$this->actualizar_model->update_campos($data);
		}
	}
////////////////////////////////////////////----------- BLOQUES -----------/////////////////////////////////////////////
	public function updateService(){
		$dato['id'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->checkServices($dato); //tsi
		$this->load->view('admin_contenido/bloques/updateService', $data);
	}
		public function updateServiceSend(){
		if (null !==($this->input->post('cancelar'))){
			$this->load->view('admin_contenido/menu_servicios_categorias');
			//redirect('administrador/menu_.'$sec,'refresh');
		}else{

		$this->load->helper('path');
		$input_file  = 'imagen';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/servicios_categorias/';
        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
        $config['max_size'] = "2097152"; //2 megabytes


        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nom_imagen');
					if (!empty($imagen_old)){
						$carpeta = './img/servicios_categorias/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

			
				}
			}
		}  
		 
            $this->db->where('id', $this->input->post('idFieldss'));
            $query = $this->db->get('servicios');
            $info=$query->row();
            if (empty($value_input_file)) {
            	$value_input_file=$info->imagen;
            }           
       
					$data = array(
					'id' => $this->input->post('idFieldss'),
					'titulo' => $this->input->post('titulo'),
					'imagen' => $value_input_file,					
					'subtitulo1' => $this->input->post('subtitulo1'),
					'descripcion' => $this->input->post('descripcion'),					
					'seccion' => $this->input->post('seccion'),
					'metaTitulo' => $this->input->post('metaTitulo'),
					'metaDescripcion' => $this->input->post('metaDescripcion'),
					'metaPalabras' => $this->input->post('metaPalabras'),
					
					);
					//print_r($data);
					
					$this->actualizar_model->updateService($data);
				
		}
	}
	public function deleteService(){
		$id = $this->uri->segment(3);
		$this->actualizar_model->deleteService($id);		
	}
	public function con(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato); //tsi
		$this->load->view('admin_contenido/bloques/update-con', $data);
	}


	public function actualizarSeccionesConImagen(){
		$sec = $this->input->post('seccion');
		if (null !==($this->input->post('cancelar'))){
			$this->load->view('admin_contenido/menu_'.$sec);
			//redirect('administrador/menu_.'$sec,'refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/'.$sec.'/';
        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
        $config['max_size'] = "2097152"; //2 megabytes

        
        //print_r($titul); 

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nom_imagen');
					if (!empty($imagen_old)){
						$carpeta = './img/'.$sec.'/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion1' => $this->input->post('descripcion1'),
					'descripcion2' => $this->input->post('descripcion2'),
					'url' => $this->input->post('url'),
					'archivo' => $value_input_file,
					'orden' => $this->input->post('orden'),
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc')
					
					);
					$this->actualizar_model->update_secciones($data);
				}
			}
		} else {
					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion1' => $this->input->post('descripcion1'),
					'descripcion2' => $this->input->post('descripcion2'),
					'url' => $this->input->post('url'),
					'orden' => $this->input->post('orden'),
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'meta_tit2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2')
					);
					//print_r($data);
					$this->actualizar_model->update_secciones2($data);
				}
		}
	}


	public function sin(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato); //tsi
		$this->load->view('admin_contenido/bloques/update-sin', $data);
	}
	public function actualizarSeccionesSinImagen(){
		$secc = $this->input->post('seccion');
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/menu_'.$secc,'refresh');
		}else{

			$data = array(
			'id_secciones' => $this->input->post('id_secciones'),
			'seccion' => $this->input->post('seccion'),
			'titulo' => $this->input->post('titulo'),
			'orden' => $this->input->post('orden'),
			'subtitulo' => $this->input->post('subtitulo'),
			'descripcion1' => $this->input->post('descripcion1'),
			'descripcion2' => $this->input->post('descripcion2'),
			'url' => $this->input->post('url'),
			'meta_tit' => $this->input->post('meta_titulo'),
			'meta_desc' => $this->input->post('meta_desc')
			);
			$this->actualizar_model->update_secciones1($data);
		}
	}


	public function con2(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato); //tsi
		$this->load->view('admin_contenido/bloques/update-con2', $data);
	}
	public function actualizarSeccionesCon2Imagenes(){
		$sec = $this->input->post('seccion');
		if (null !==($this->input->post('cancelar'))){
			$this->load->view('admin_contenido/menu_'.$sec);
			//redirect('administrador/menu_.'$sec,'refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		$input_file2 = 'archivo2';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$value_input_file2 = $_FILES[''.$input_file2.'']['name'];
		$config['upload_path'] = './img/'.$sec.'/';
        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file) and !empty($value_input_file2)){
		//print_r($value_input_file.'<br>'); 
        //print_r($value_input_file2); 
		
			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file) || !$this->upload->do_upload($input_file2)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nom_imagen');
					if (!empty($imagen_old)){
						$carpeta = './img/'.$sec.'/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

			    	$imagen_old2 = $this->input->post('nom_imagen2');
					if (!empty($imagen_old2)){
						$carpeta = './img/'.$sec.'/';
				        if(file_exists($carpeta.$imagen_old2))
				        {
				            unlink($carpeta.$imagen_old2);
				        }
			    	}

					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion1' => $this->input->post('descripcion1'),
					'descripcion2' => $this->input->post('descripcion2'),
					'descripcion3' => $this->input->post('descripcion3'),
					'url' => $this->input->post('url'),
					'archivo' => $value_input_file,
					'archivo2' => $value_input_file2,
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'meta_tit2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2')
					);
					$this->actualizar_model->update_2_img1($data);
				}
			} 
		}
		else if (!empty($value_input_file) and empty($value_input_file2)){
		//print_r($value_input_file.'<br>'); 
        //print_r($value_input_file2); 
		
			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nom_imagen');
					if (!empty($imagen_old)){
						$carpeta = './img/'.$sec.'/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion1' => $this->input->post('descripcion1'),
					'descripcion2' => $this->input->post('descripcion2'),
					'url' => $this->input->post('url'),
					'archivo' => $value_input_file,
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'meta_tit2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2')
					);
					$this->actualizar_model->update_2_img2($data);
					
				}
			} 
		} 
		else if (empty($value_input_file) and !empty($value_input_file2)){
		//print_r($value_input_file.'<br>'); 
        //print_r($value_input_file2); 
		
			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file2)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
			    	$imagen_old2 = $this->input->post('nom_imagen2');
					if (!empty($imagen_old2)){
						$carpeta = './img/'.$sec.'/';
				        if(file_exists($carpeta.$imagen_old2))
				        {
				            unlink($carpeta.$imagen_old2);
				        }
			    	}

					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion1' => $this->input->post('descripcion1'),
					'descripcion2' => $this->input->post('descripcion2'),
					'url' => $this->input->post('url'),
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'archivo2' => $value_input_file2,
					'meta_tit2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2')
					);
					$this->actualizar_model->update_2_img3($data);
				}
			} 
		} else {
					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion1' => $this->input->post('descripcion1'),
					'descripcion2' => $this->input->post('descripcion2'),
					'url' => $this->input->post('url'),
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'meta_tit2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2')
					);
					//print_r($data);
					$this->actualizar_model->update_secciones2($data);
				}
		}
	}
////////////////////////////////////////////----------- BLOQUES -----------/////////////////////////////////////////////
	
	
	public function uhead(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato); // t cabecera de la pagina
		$this->load->view('admin_contenido/conf_sitio/update-head', $data);
	}
	public function ufoot(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato); // tsd pie de la pagina
		$this->load->view('admin_contenido/conf_sitio/update-foot', $data);
	}
	public function redes(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato); // redes
		$this->load->view('admin_contenido/conf_sitio/update-redes', $data);
	}
	public function aviso(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato); // td para aviso de privacidad
		$this->load->view('admin_contenido/conf_sitio/update-aviso', $data);
	}

	public function actualizarPlantilla(){
		$this->input->post('id_secciones');
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/home','refresh');
		}else{
			if($this->input->post('titulo')=="")
			{
				$this->db->where('id','60');
                $query = $this->db->get('estructura_home');
				$facebook= $query->row();
				$data = array(
			'id_secciones' => $this->input->post('id_secciones'),
			'id_sitio' => $this->input->post('id_sitio'),
			'titulo' => $facebook->titulo,
			'subtitulo' => $this->input->post('subtitulo'),
			'descripcion1' => $this->input->post('descripcion1'),
			'descripcion2' => $this->input->post('descripcion2'),
			'url' => $this->input->post('url')
			);
			$this->actualizar_model->update_plantilla($data);
			}
			$data = array(
			'id_secciones' => $this->input->post('id_secciones'),
			'id_sitio' => $this->input->post('id_sitio'),
			'titulo' => $this->input->post('titulo'),
			'subtitulo' => $this->input->post('subtitulo'),
			'descripcion1' => $this->input->post('descripcion1'),
			'descripcion2' => $this->input->post('descripcion2'),
			'url' => $this->input->post('url')
			);
			$this->actualizar_model->update_plantilla($data);
		}
	}
		
	
	

	public function actualizarSeccionesConImagen2(){
		$this->input->post('id_secciones');
		if (null !==($this->input->post('cancelar'))){
			redirect('admin/menu_servicios','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/servicios/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nom_imagen');
					if (!empty($imagen_old)){
						$carpeta = './img/servicios/';
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
			    	}

					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'archivo' => $value_input_file,
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion' => $this->input->post('descripcion'),
					'descripcion2' => $this->input->post('descripcion2'),
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'url' => $this->input->post('url')
					);
					$this->actualizar_model->update_secciones_serv($data);
				}
			}
		} else {
					$data = array(
					'id_secciones' => $this->input->post('id_secciones'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion' => $this->input->post('descripcion'),
					'descripcion2' => $this->input->post('descripcion2'),
					'meta_tit' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'url' => $this->input->post('url')
					);
					$this->actualizar_model->update_secciones_serv2($data);
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

/* ---------------------------------------------------- LEGALES ---------------------------------------------------------- */

	public function legales(){
		$dato = array(
		'archivo' => $this->uri->segment(3),
		'id_sitio' => $this->session->userdata('id_sitio')
		);
		$data['consulta_legales_where'] = $this->actualizar_model->consulta_legales_where($dato);
		$this->load->view('admin_contenido/legales',$data);
	}
	public function legalesUpdate(){
		if (null !==($this->input->post('cancelar'))){
			redirect('admin_contenido/home','refresh');
		}else{

			$data = array(
			'id_legales' => $this->input->post('id_legales'),
			'titulo' => $this->input->post('titulo'),
			'descripcion' => $this->input->post('descripcion')
			);
			$this->actualizar_model->update_legales($data);
		}
	}

/* ---------------------------------------------------- MENU 1 ---------------------------------------------------------- */

	public function menu1(){
		$this->load->view('admin_contenido/menus/tiu-menu');
	}
	public function Menu1Goup(){
		$this->load->view('admin_contenido/menus/tiu-goup');
	}
	public function Menu1Upload(){
		$dato['id_menus'] = $this->uri->segment(3);
		$data['consulta_menus'] = $this->actualizar_model->consulta_menus2($dato);
		$this->load->view('admin_contenido/menus/tiu-upload',$data);
	}
	
	public function Menu1Delate(){
		$dato['id_menus'] = $this->uri->segment(3);
		$this->actualizar_model->delete_menus($dato);
		$this->load->view('admin_contenido/menus/tiu-menu');
	}
	public function Menu1insert(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu1','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_uno/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$data = array(
					'archivo' => $value_input_file,
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion' => $this->input->post('descripcion'),
					'descripcion2' => $this->input->post('descripcion2'),
					'descripcion3' => $this->input->post('descripcion3'),
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'seccion' => '1',
					'orden' => $this->input->post('orden')
					);
					$this->actualizar_model->menu1_insertar($data);
				}
			}
		} else {
					print "<script type=\"text/javascript\">alert('Falto cargar la imagen');</script>";
					redirect('administrador/Menu1Goup','refresh');
					//$this->load->view('admin_contenido/admin/Menu1Goup');
				}
		}
	}

	public function Menu1Update(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu1','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_uno/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){

				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nombre_imagen');
					$carpeta = './img/menu_uno/';
			        if(file_exists($carpeta.$imagen_old))
			        {
			            unlink($carpeta.$imagen_old);
			        }

					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'archivo' => $value_input_file,
					'titulo' => $this->input->post('titulo'),
					'descripcion' => $this->input->post('descripcion'),
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'orden' => $this->input->post('orden')
					);
					$this->actualizar_model->update_menu1($data);
				}
			}
		} else {
					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'orden' => $this->input->post('orden'),
					'titulo' => $this->input->post('titulo'),
					'descripcion' => $this->input->post('descripcion'),
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc')					
					);
					$this->actualizar_model->update_menu12($data);
				}
		}
	}

	public function Menu1Otros(){
		$dato['id_menus'] = $this->uri->segment(3);
		$data['consulta_menus'] = $this->actualizar_model->consulta_menus2($dato);
		$this->load->view('admin_contenido/menus/tiu-otros',$data);
	}

	public function Menu1UpdateOtros(){
		
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu1','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_otros/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){

				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nombre_imagen');
					$carpeta = './img/menu_otros/';
			        if(!empty($imagen_old)){
				        if(file_exists($carpeta.$imagen_old))
				        {
				            unlink($carpeta.$imagen_old);
				        }
				    }

					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'archivo2' => $value_input_file,
					'meta_titulo2' => $this->input->post('meta_titulo'),
					'meta_desc2' => $this->input->post('meta_desc')
					);
					$this->actualizar_model->update_menu_otros1($data);
				}
			}
		} else {
					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'meta_titulo2' => $this->input->post('meta_titulo'),
					'meta_desc2' => $this->input->post('meta_desc')					
					);
					$this->actualizar_model->update_menu_otros12($data);
				} 
		} 
	}

/* ---------------------------------------------------- MENU 2 ---------------------------------------------------------- */

	public function menu2(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato);
		$this->load->view('admin_contenido/menus/ti-menu', $data);
	}
	public function Menu2Goup(){
		$dato['id_campo'] = $this->uri->segment(3);
		$data['consulta_sec_where'] = $this->actualizar_model->consulta_sec_where($dato);
		$this->load->view('admin_contenido/menus/ti-goup', $data);
	}
	public function Menu2Upload(){
		$dato['id_menus'] = $this->uri->segment(4);
		$data['consulta_menus'] = $this->actualizar_model->consulta_menus($dato);
		$this->load->view('admin_contenido/menus/ti-upload',$data);
	}
	public function Menu2Delate(){
		$dato['id_secc'] = $this->uri->segment(5);
		$dato['id_menus'] = $this->uri->segment(4);
		$dato['carp'] = $this->uri->segment(3);
		$this->actualizar_model->delete_menus2($dato);
		redirect('administrador/Menu2/'.$dato['id_secc'],'refresh');
		//$this->load->view('admin_contenido/menus/ti-menu');
	}
	public function Menu2insert(){
		$id = $this->input->post('id_1');
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu2/'.$id,'refresh');
		}else{

		//$nom1 = $this->input->post('secc');
		//$nom2 = $this->input->post('id_1');
		//$carp = $nom1.$nom2;
		
		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		//$config['upload_path'] = './img/'.$carp.'/';
		$config['upload_path'] = './img/galeria/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$data = array(
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'seccion' => $this->input->post('id_1'),
					'orden' => $this->input->post('orden')
					);
					$this->actualizar_model->menu2_insertar($data);
				}
			}
		} else {
					print "<script type=\"text/javascript\">alert('Falto cargar la imagen');</script>";
					$this->load->view('admin_contenido/admin/Menu2Goup');
				}
		}
	}

	public function Menu2Update(){
		$id = $this->input->post('id_secc');
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu2/'.$id,'refresh');
		}else{

		//$carp = $this->input->post('carp');
		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/galeria/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){

				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nombre_imagen');
					$carpeta = './img/'.$carp.'/';
			        if(file_exists($carpeta.$imagen_old))
			        {
			            unlink($carpeta.$imagen_old);
			        }

					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'id_secc' => $this->input->post('id_secc'),
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'orden' => $this->input->post('orden')
					);
					$this->actualizar_model->update_menu2($data);
				}
			}
		} else {
					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'id_secc' => $this->input->post('id_secc'),
					'orden' => $this->input->post('orden'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc')					
					);
					$this->actualizar_model->update_menu22($data);
				}
		}
	}

/* ---------------------------------------------------- MENU 3 ---------------------------------------------------------- */

	public function menu3(){
		$this->load->view('admin_contenido/menus/tdi-menu');
	}
	public function Menu3Goup(){
		$this->load->view('admin_contenido/menus/tdi-goup');
	}
	public function Menu3Upload(){
		$dato['id_menus'] = $this->uri->segment(3);
		$data['consulta_menus'] = $this->actualizar_model->consulta_menus($dato);
		$this->load->view('admin_contenido/menus/tdi-upload',$data);
	}
	public function Menu3Delate(){
		$dato['id_menus'] = $this->uri->segment(3);
		$this->actualizar_model->delete_menus3($dato);
		$this->load->view('admin_contenido/menus/tdi-menu');
	}
	public function Menu3insert(){
		$id_secc = $this->input->post('id_secc');
		echo $id_secc;

		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu3/'.$id_secc,'refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_tres/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$data = array(
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion' => $this->input->post('descripcion'),
					'descripcion2' => $this->input->post('descripcion2'),
					'meta_titulo2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2'),
					'id_secc' => $this->input->post('id_secc'),
					'orden' => $this->input->post('orden')
					);
					$this->actualizar_model->menu3_insertar($data);
				}
			}
		} else {
					print "<script type=\"text/javascript\">alert('Falto cargar la imagen');</script>";
					$this->load->view('admin_contenido/admin/menu_servicios');
				}
		}
	}

	public function Menu3Update(){
		$id_secc = $this->input->post('id_secc');

		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu3/'.$id_secc,'refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_tres/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){

				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nombre_imagen');
					$carpeta = './img/menu_tres/';
			        if(file_exists($carpeta.$imagen_old))
			        {
			            unlink($carpeta.$imagen_old);
			        }

					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion' => $this->input->post('descripcion'),
					'descripcion2' => $this->input->post('descripcion2'),
					'meta_titulo2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2'),
					'orden' => $this->input->post('orden'),
					'id_secc' => $this->input->post('id_secc')
					);
					$this->actualizar_model->update_menu3($data);
				}
			}
		} else {
					$data = array(
					'id_menus' => $this->input->post('id_menus'),
					'orden' => $this->input->post('orden'),
					'titulo' => $this->input->post('titulo'),
					'subtitulo' => $this->input->post('subtitulo'),
					'descripcion' => $this->input->post('descripcion'),
					'descripcion2' => $this->input->post('descripcion2'),
					'meta_titulo2' => $this->input->post('meta_titulo2'),
					'meta_desc2' => $this->input->post('meta_desc2'),
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'id_secc' => $this->input->post('id_secc')
					);
					$this->actualizar_model->update_menu32($data);
				}
		}
	}

/* ---------------------------------------------------- ASIGNA LOGOS ---------------------------------------------------------- */
	public function AsignaLogos(){
		$this->load->view('admin_contenido/menus/asigna-logos');
	}
	public function AsignarLogo(){
		$dato['id_logo'] = $this->uri->segment(3);
		$dato['id_servicio'] = $this->uri->segment(4);
		$dato['id_seccion'] = $this->uri->segment(5);
		$this->actualizar_model->inserta_asignado($dato);
	}
	public function QuitarLogo(){
		$dato['id_logo'] = $this->uri->segment(3);
		$dato['id_servicio'] = $this->uri->segment(4);
		$dato['id_seccion'] = $this->uri->segment(5);
		$this->actualizar_model->delete_asignado($dato);
	}
/* ---------------------------------------------------- ASIGNA LOGOS ---------------------------------------------------------- */
/* ---------------------------------------------------- ASIGNA CAT ---------------------------------------------------------- */
	public function AsignaCats(){
		$this->load->view('admin_contenido/menus/asigna-cat');
	}
	public function AsignarCat(){
		$dato['id_cat'] = $this->uri->segment(3);
		$dato['id_prod'] = $this->uri->segment(4);
		$this->actualizar_model->inserta_asig_cat($dato);
	}
	public function QuitarCat(){
		$dato['id_cat'] = $this->uri->segment(3);
		$dato['id_prod'] = $this->uri->segment(4);
		$this->actualizar_model->delete_asig_cat($dato);
	}
/* ---------------------------------------------------- ASIGNA CAT ---------------------------------------------------------- */
/* ---------------------------------------------------- ASIGNA ACCESORIOS ---------------------------------------------------------- */
	public function AsignaAcces(){
		$this->load->view('admin_contenido/menus/asigna-acces');
	}
	public function AsignarAcce(){
		$dato['id_acc'] = $this->uri->segment(3);
		$dato['id_prod'] = $this->uri->segment(4);
		$this->actualizar_model->inserta_asig_acces($dato);
	}
	public function QuitarAcce(){
		$dato['id_acc'] = $this->uri->segment(3);
		$dato['id_prod'] = $this->uri->segment(4);
		$this->actualizar_model->delete_asig_acces($dato);
	}
/* ---------------------------------------------------- ASIGNA ACCESORIOS ---------------------------------------------------------- */

/* ---------------------------------------------------- MENU 4 ---------------------------------------------------------- */

	public function menu4(){
		$this->load->view('admin_contenido/menus/td-menu');
	}
	public function Menu4Goup(){
		$this->load->view('admin_contenido/menus/td-goup');
	}
	public function Menu4Upload(){
		$dato['id'] = $this->uri->segment(3);
		$data['consulta_menus'] = $this->actualizar_model->consulta_videos($dato);
		$this->load->view('admin_contenido/menus/td-upload',$data);
	}
	public function Menu4Delate(){
		$dato['id'] = $this->uri->segment(3);
		$this->actualizar_model->delete_menus4($dato);
		//$this->load->view('admin_contenido/menus/td-menu');
	}
	public function Menu4insert(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu4','refresh');
		}else{
			$data = array(
				'orden' => $this->input->post('orden'),
				'titulo' => $this->input->post('titulo'),
				'url' => $this->input->post('url')
			);
			$this->actualizar_model->menu4_insertar($data);
		}
	}

	public function Menu4Update(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Menu4','refresh');
		}else{
			$data = array(
			'id' => $this->input->post('id'),
			'orden' => $this->input->post('orden'),
			'titulo' => $this->input->post('titulo'),
			'url' => $this->input->post('url')
			);
			$this->actualizar_model->update_menu4($data);
		}
	}

/* ---------------------------------------------------- CATEGORÍAS ---------------------------------------------------------- */

	public function Category(){
		$this->load->view('admin_contenido/menus/cat-menu');
	}
	public function CatGoup(){
		$this->load->view('admin_contenido/menus/cat-goup');
	}

	public function CatUpload(){
		$dato['id'] = $this->uri->segment(3);
		$data['consulta_menus'] = $this->actualizar_model->consulta_categorias($dato);
		$this->load->view('admin_contenido/menus/cat-upload',$data);
	}
	public function catDelate(){
		$dato['id'] = $this->uri->segment(3);
		$this->actualizar_model->delete_cat($dato);
		//$this->load->view('admin_contenido/menus/cat-menu');
	}
	public function Catinsert(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Category','refresh');
		}else{
			$data = array('orden' => $this->input->post('orden'),'titulo' => $this->input->post('titulo'));
			$this->actualizar_model->cat_insertar($data);
		}
	}
	public function CatUpdate(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Category','refresh');
		}else{
			$data = array(
			'id' => $this->input->post('id'),
			'orden' => $this->input->post('orden'),
			'titulo' => $this->input->post('titulo')
			);
			$this->actualizar_model->update_cat($data);
		}
	}
/* ---------------------------------------------------- PRODUCTOS ---------------------------------------------------------- */

	public function Products(){
		$this->load->view('admin_contenido/menus/pro-menu');
	}
	public function ProductGoup(){
		$this->load->view('admin_contenido/menus/pro-goup');
	}
	public function ProductUpload(){
		$dato['id'] = $this->uri->segment(3);
		$data['consulta_menus'] = $this->actualizar_model->consulta_product($dato);
		$this->load->view('admin_contenido/menus/pro-upload',$data);
	}
	public function ProductDelate(){
		$dato['id'] = $this->uri->segment(3);
		$this->actualizar_model->delete_product($dato);
		//$this->load->view('admin_contenido/menus/tdi-menu');
	}
	public function Productinsert(){
		
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Products','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_productos/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$data = array(
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'titulo' => $this->input->post('titulo'),
					'descripcion' => $this->input->post('descripcion')
					//'orden' => $this->input->post('orden')
					);
					$this->actualizar_model->product_insertar($data);
				}
			}
		} else {
					print "<script type=\"text/javascript\">alert('Falto cargar la imagen');</script>";
					$this->load->view('admin_contenido/menus/pro-menu');
				}
		}
	}
	public function ProductUpdate(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Products','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_productos/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){

				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nombre_imagen');
					$carpeta = './img/menu_productos/';
			        if(file_exists($carpeta.$imagen_old))
			        {
			            unlink($carpeta.$imagen_old);
			        }

					$data = array(
					'id' => $this->input->post('id'),
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'titulo' => $this->input->post('titulo'),
					'descripcion' => $this->input->post('descripcion')
					);
					$this->actualizar_model->update_product1($data);
				}
			}
		} else {
					$data = array(
					'id' => $this->input->post('id'),
					'titulo' => $this->input->post('titulo'),
					'descripcion' => $this->input->post('descripcion'),
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc')
					);
					$this->actualizar_model->update_product2($data);
				}
		}
	}

/* ---------------------------------------------------- PRODUCTOS ---------------------------------------------------------- */
/* ---------------------------------------------------- ACCESORIOS ---------------------------------------------------------- */

	public function Accesorios(){
		$this->load->view('admin_contenido/menus/di-menu');
	}
	public function AccesGoup(){
		$this->load->view('admin_contenido/menus/di-goup');
	}
	
	public function AccesUpload(){
		$dato['id'] = $this->uri->segment(3);
		$data['consulta_menus'] = $this->actualizar_model->consulta_acces($dato);
		$this->load->view('admin_contenido/menus/di-upload',$data);
	}
	
	public function AccesDelate(){
		$dato['id'] = $this->uri->segment(3);
		$this->actualizar_model->delete_acces($dato);
		//$this->load->view('admin_contenido/menus/tdi-menu');
	}

	public function Accesinsert(){
		
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Accesorios','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_acces/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					$data = array(
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'descripcion' => $this->input->post('descripcion')
					//'orden' => $this->input->post('orden')
					);
					$this->actualizar_model->acces_insertar($data);
				}
			}
		} else {
					print "<script type=\"text/javascript\">alert('Falto cargar la imagen');</script>";
					$this->load->view('admin_contenido/menus/di-menu');
				}
		}
	}
	
	public function AccesUpdate(){
		if (null !==($this->input->post('cancelar'))){
			redirect('administrador/Accesorios','refresh');
		}else{

		$this->load->helper('path');
		$input_file = 'archivo';
		//obtiene datos del form por post
		$value_input_file = $_FILES[''.$input_file.'']['name'];
		$config['upload_path'] = './img/menu_acces/';
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "2097152"; //2 megabytes

        if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){

				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} else {
					
					$imagen_old = $this->input->post('nombre_imagen');
					$carpeta = './img/menu_acces/';
			        if(file_exists($carpeta.$imagen_old))
			        {
			            unlink($carpeta.$imagen_old);
			        }

					$data = array(
					'id' => $this->input->post('id'),
					'archivo' => $value_input_file,
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc'),
					'descripcion' => $this->input->post('descripcion')
					);
					$this->actualizar_model->update_acces1($data);
				}
			}
		} else {
					$data = array(
					'id' => $this->input->post('id'),
					'descripcion' => $this->input->post('descripcion'),
					'meta_titulo' => $this->input->post('meta_titulo'),
					'meta_desc' => $this->input->post('meta_desc')
					);
					$this->actualizar_model->update_acces2($data);
				}
		}
	}

/* ---------------------------------------------------- ACCESORIOS ---------------------------------------------------------- */

///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function form_contacto(){

        $id_cont = '317';
        $this->load->model('actualizar_model');
        $info = $this->actualizar_model->consulta_pagina($id_cont);
        
        $correo = $info['url'];

		$datos = array('nombre' => $this->input->post('nombre'),
					   	'telefono' => $this->input->post('telefono'),
					   	'email' => $this->input->post('email'),
					   	'mensaje' => $this->input->post('mensaje')
					   );
//print_r($datos);
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('telefono', 'Teléfono','trim|required|xss_clean|is_numeric');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE){	
        	
        	//guarda el error generado y lo muestra
        	$error['falla'] = validation_errors();

        	//print_r ($error);
        	$this->load->view('frontend/contacto', $error);

        } else {

        	$message = "
			Información de Contacto | Percapital
			
			Nombre: ".$datos['nombre']."\n
			Télefono: ".$datos['telefono']."\n
			Correo electrónico: ".$datos['email']."\n
			Asunto: ".$datos['mensaje']."\n
			";
			
			//print_r($message);
			
			$ir = $correo;

        	$this->load->library('email');
			$this->email->from('atencionaclientes@percapital.com.mx', 'Percapital');
			$this->email->to($ir);
			$this->email->subject('Contacto | Percapital');
			$this->email->message($message);
			if ($this->email->send())
			{
				//$this->load->view('pagina/inicio', $error);
        	redirect('Percapital/Gracias', 'refresh');
			} 
        }
	}

	public function form_clientes(){

		$datos = array('ticket' => $this->input->post('ticket'),
					   	'quejas' => $this->input->post('quejas'),
					   	'mantenimiento' => $this->input->post('mantenimiento'),
					   	'pedidos' => $this->input->post('pedidos'),
					   	'corre' => $this->input->post('correo')
					   );
		print_r($datos);

//print_r($datos);
        $this->form_validation->set_rules('ticket', 'Ticket', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quejas', 'Quejas','trim|required|xss_clean');
        $this->form_validation->set_rules('mantenimiento', 'Mantenimiento', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pedidos', 'Pedidos', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE){	
        	
        	//guarda el error generado y lo muestra
        	$error['falla'] = validation_errors();

        	//print_r ($error);
        	$this->load->view('interiores/contacto', $error);

        } else {

        	$message = "
			Información de Cliente | Grupo Modelo
			
			Ticket: ".$datos['ticket']."\n
			Quejas: ".$datos['quejas']."\n
			Mantenimiento: ".$datos['mantenimiento']."\n
			Pedidos: ".$datos['pedidos']."\n
			";
			
			//print_r($message);
			
			$ir = $datos['corre'];

        	$this->load->library('email');
			$this->email->from('lbernardo@centralinteractiva.com.mx', 'Grupo Modelo');
			$this->email->to($ir);
			$this->email->subject('Clientes | Grupo Modelo');
			$this->email->message($message);
			if ($this->email->send())
			{
				//$this->load->view('pagina/inicio', $error);
        	redirect('Cerveceria/GraciasClientes', 'refresh');
			} 
        }
	}

///////////////////////////////////////////////////////////////////////////////////////////////

	public function newContent(){ 
	 	$dato= $this->uri->segment(3); 
		$this->load->view('admin_contenido/menus/newContent');
	}
	public function insertContent(){
			if (null !==($this->input->post('cancelar'))){
			redirect('Administrador/menu_'.$this->input->post('seccion'),'refresh');
			
		}else{
		$this->load->helper('path');
		$input_file  = 'imagen';
		$input_file2  = 'imagen2';

		$input_file3  = 'imagenSeccion1';
		$input_file4  = 'imagenSeccion2';
		$input_file5  = 'imagenSeccion3';

		$value_input_file = $_FILES[''.$input_file.'']['name'];		
		$value_input_file2 = $_FILES[''.$input_file2.'']['name'];
		$value_input_file3 = $_FILES[''.$input_file3.'']['name'];
	
		
		$value_input_file4 = $_FILES[''.$input_file4.'']['name'];
		$value_input_file5 = $_FILES[''.$input_file5.'']['name'];


		$config['upload_path'] = './img/'.$this->input->post('seccion');
		//$config['upload_path'] = './img/simulador';
		
		
        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
        $config['max_size'] = "2097152"; //2 megabytes

         if (!empty($value_input_file)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}
		 if (!empty($value_input_file2)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file2)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}	
		 if (!empty($value_input_file3)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file3)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}	
		 if (!empty($value_input_file4)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file4)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}	
		 if (!empty($value_input_file5)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file5)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}	
		$data = array(					
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),				
					'subtitulo'=> $this->input->post('subtitulo'),
					'subtitulo2'=> $this->input->post('subtitulo2'),
					'descripcion1'=> $this->input->post('descripcion1'),
					'descripcion2'=> $this->input->post('descripcion2'),
					'descripcion3'=> $this->input->post('descripcion3'),
					'orden'=> $this->input->post('orden'),
					'archivo' => $value_input_file,	          			
					'archivo2' => $value_input_file2,	          	
					'imagen1' => $value_input_file3,	          			
					'imagen2' => $value_input_file4,	          			
					'imagen3' => $value_input_file5,	          					
					'meta_desc' => $this->input->post('meta_desc'),							
					'meta_desc2' => $this->input->post('meta_desc2'),					
					'metaImagen1' => $this->input->post('metaImagen1'),					
					'metaImagen2' => $this->input->post('metaImagen2'),									
					'metaImagen3' => $this->input->post('metaImagen3'),					
					);
					//print_r($data);
					$this->actualizar_model->insertContent($data);
		}
	
	}
	public function checkContent(){
		$dato['id'] = $this->uri->segment(4);
		$dato['seccion'] = $this->uri->segment(3);
    	$data['consulta_sec_where'] = $this->actualizar_model->checkContent($dato); //tsi
   		 $this->load->view('admin_contenido/bloques/updateContent', $data);
	}
	
	public function updateContent(){
    	 if (null !==($this->input->post('cancelar'))){
      	redirect('Administrador/menu_'.$this->input->post('seccion'),'refresh');
    	}
    	else{

	    	$this->load->helper('path');
	    	$input_file  = 'imagen';
			$input_file2  = 'imagen2';

			$input_file3  = 'imagenSeccion1';
			$input_file4  = 'imagenSeccion2';
			$input_file5  = 'imagenSeccion3';

			$value_input_file = $_FILES[''.$input_file.'']['name'];		
			$value_input_file2 = $_FILES[''.$input_file2.'']['name'];

			$value_input_file3 = $_FILES[''.$input_file3.'']['name'];
			$value_input_file4 = $_FILES[''.$input_file4.'']['name'];
			$value_input_file5 = $_FILES[''.$input_file5.'']['name'];

		
			
	   		$config['upload_path'] = './img/'.$this->input->post('seccion');
	        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
	        $config['max_size'] = "2097152"; //2 megabytes


	        if (!empty($value_input_file)){

	      		if($this->load->library('upload', $config)){
	        		if (!$this->upload->do_upload($input_file)) {
	          			//si hay error
	          			$error['falla'] = $this->upload->display_errors();
	        		}
	        		else{
	          
	          			$imagen_old = $this->input->post('nom_imagen');
	          			if (!empty($imagen_old)){
	            		$carpeta = './img/'.$this->input->post('seccion');
	                		if(file_exists($carpeta.$imagen_old)){
	                    	unlink($carpeta.$imagen_old);
	                		}
	            		}
	        		}
	      		}
	    	}  
	    	 if (!empty($value_input_file2)){

	      		if($this->load->library('upload', $config)){
	        		if (!$this->upload->do_upload($input_file2)) {
	          			//si hay error
	          			$error['falla'] = $this->upload->display_errors();
	        		}
	        		else{
	          
	          			$imagen_old = $this->input->post('nom_imagen');
	          			if (!empty($imagen_old)){
	            		$carpeta = './img/'.$this->input->post('seccion');
	                		if(file_exists($carpeta.$imagen_old)){
	                    	unlink($carpeta.$imagen_old);
	                		}
	            		}
	        		}
	      		}
	    	}
	    	if (!empty($value_input_file3)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file3)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}	
		 if (!empty($value_input_file4)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file4)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}	
		 if (!empty($value_input_file5)){

			if($this->load->library('upload', $config)){
				if (!$this->upload->do_upload($input_file5)) {
					//si hay error
					$error['falla'] = $this->upload->display_errors();
				} 
        		else {
						$imagen_old = $this->input->post('nom_imagen');
						if (!empty($imagen_old)){
							$carpeta = './img/'.$this->input->post('seccion');
					        if(file_exists($carpeta.$imagen_old)){
					            unlink($carpeta.$imagen_old);
					        }
			    		}
			
					}
			}
		}	  
	     
	            $this->db->where('id', $this->input->post('id'));
	            $query = $this->db->get($this->input->post('seccion'));
	            $info=$query->row();

	            if ($value_input_file=='') {
            	$value_input_file=$info->archivo;
           		 }
            
    
            	 if($value_input_file2==''){
            	$value_input_file2=$info->archivo2;
           		 }        
	       		 if($value_input_file3==''){
            	$value_input_file3=$info->imagen1;
           		 }     
           		  if($value_input_file4==''){
            	$value_input_file4=$info->imagen2;
           		 }     
           		  if($value_input_file5==''){
            	$value_input_file5=$info->imagen3;
           		 }     
           		    
	    $data = array(	
	    			'id'=> $this->input->post('id'),				
					'seccion' => $this->input->post('seccion'),
					'titulo' => $this->input->post('titulo'),				
					'subtitulo'=> $this->input->post('subtitulo'),
					'subtitulo2'=> $this->input->post('subtitulo2'),
					'descripcion1'=> $this->input->post('descripcion1'),
					'descripcion2'=> $this->input->post('descripcion2'),
					'descripcion3'=> $this->input->post('descripcion3'),
					'orden'=> $this->input->post('orden'),
					'archivo' => $value_input_file,	          			
					'archivo2' => $value_input_file2,	          	
					'imagen1' => $value_input_file3,	          			
					'imagen2' => $value_input_file4,	          			
					'imagen3' => $value_input_file5,	          					
					'meta_desc' => $this->input->post('meta_desc'),							
					'meta_desc2' => $this->input->post('meta_desc2'),					
					'metaImagen1' => $this->input->post('metaImagen1'),					
					'metaImagen2' => $this->input->post('metaImagen2'),									
					'metaImagen3' => $this->input->post('metaImagen3'),					
					);
	          
	          //print_r($data);
	          $this->actualizar_model->updateContent($data);
	        
	    }
  	}
	public function deleteContent(){  		 
		 $id = $this->uri->segment(4);
		 $seccion = $this->uri->segment(3);
    	 $this->actualizar_model->deleteContent($id,$seccion);    
    }
    public function checkGallery(){
		$dato['id'] = $this->uri->segment(4);
		$dato['seccion'] = $this->uri->segment(3);
    	$data['consulta_sec_where'] = $this->actualizar_model->checkGallery($dato); //tsi
   		$this->load->view('admin_contenido/menus/ti-menu', $data);
	}
	public function NewCategoriaVacante(){ 
	 	$dato= $this->uri->segment(3); 
		$this->load->view('admin_contenido/menus/newCategoriaVacante');
	}
	public function insertBolsaCategory(){
		if (null !==($this->input->post('cancelar'))){
			redirect('Administrador/menu_'.$this->input->post('seccion'),'refresh');
			
		}else{
			$data = array(					
					 'titulo' => $this->input->post('titulo'),									
					 'orden'=> $this->input->post('orden'),
					 'tipo'=>'sin',
					 'bloque'=>'blokt',
					 'seccion'=>'bolsaCategorias'					
					);
					//print_r($data);
					$this->actualizar_model->insertBolsaCategory($data);
		}
	}
	public function editBolsaCategory(){
		if (null !==($this->input->post('cancelar'))){
			redirect('Administrador/menu_'.$this->input->post('seccion'),'refresh');
			
		}else{
			$data = array(					
					 'titulo' => $this->input->post('titulo'),									
					 'orden'=> $this->input->post('orden'),
					 'tipo'=>'sin',
					 'bloque'=>'blokt',
					 'seccion'=>'bolsaCategorias'					
					);
					//print_r($data);
					$this->actualizar_model->edittBolsaCategory($data);
		}
	}
	
}