<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualizar_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
        $db_admin = $this->load->database('default', TRUE);
	}
    public function insertServices($data)
    {
       $this->db->set('titulo', $data['titulo']);
       $this->db->set('seccion', $data['seccion']);
       $this->db->insert('servicios');
        if($this->db->affected_rows() > 0)
        {
          redirect('administrador/menu_servicios','refresh');
      }
    }
  public function consultmete($dato)
    {
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('estructura_home');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
  public function insertarcampos($datos){
      $this->db->set('tipo', $datos['tipo']);
      $this->db->set('bloque', $datos['bloque']);
      $this->db->set('seccion', $datos['seccion']);
      $this->db->set('medida', $datos['medida']);
      $this->db->insert('estructura_home');
      if($this->db->affected_rows() > 0)
      {
          redirect('administrador/MeteMenu','refresh');
      }
  }
  public function update_campos($datos)
    {
        $data = array('tipo' => $datos['tipo'],
                      'bloque' => $datos['bloque'],
                      'seccion' => $datos['seccion'],
                      'medida' => $datos['medida']);

        $this->db->where('id', $datos['id']);
        $this->db->update('estructura_home', $data);

        redirect('administrador/MeteMenu','refresh');
    }
    
    public function delete_campos($dato)
    {
        $this->db->where('id',$dato['id']);
        return $this->db->delete('estructura_home');

        redirect('administrador/MeteMenu','refresh');
    }


    public function consulta_logo_sitio_where($dato)
    {
        //$db_admin->where('sitio',$dato['id_sitio']);
        //$query = $db_admin->get('configuracion_sitio');
        
        $this->db->where('sitio',$dato['id_log']);
        $query = $this->db->get('configuracion_sitio');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
                $info['archivo'] = $row->archivo;
                $info['meta_titulo'] = $row->meta_titulo;
                $info['meta_palabras'] = $row->meta_palabras;
            }
        }
        return $info;
        //$query = $this->db->get_where('secciones',array('id_secciones' => $id));
        /*
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
        */
    }
    public function consulta_bloques_where($dato)
    {
        $this->db->where('sitio',$dato['id_sitio']);
		$query = $this->db->get('estructura_home');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function consulta_bloques($id_cont)
    {
        $this->db->where('id',$id_cont);
        $query = $this->db->get('estructura_home');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
              $info['bloque'] = $row->bloque;
              $info['seccion'] = $row->seccion;
              $info['medida'] = $row->medida;
            }
        }
        return $info;
        //print_r($info);
    }
    public function consulta_favi_where($dato)
    {
        $this->db->where('id',$dato['id_favi']);
        $query = $this->db->get('configuracion_sitio');
        //$query = $this->db->get_where('secciones',array('id_secciones' => $id));
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function consulta_logo_where($dato)
    {
        $this->db->where('id',$dato['id_logo']);
        $query = $this->db->get('configuracion_sitio');
        //$query = $this->db->get_where('secciones',array('id_secciones' => $id));
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
  	public function consulta_sec_where($dato)
    {
        $this->db->where('id',$dato['id_campo']);
        $query = $this->db->get('estructura_home');
        //$query = $this->db->get_where('secciones',array('id_secciones' => $id));
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function checkServices($dato)
    {
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('servicios');
        //$query = $this->db->get_where('secciones',array('id_secciones' => $id));
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function consulta_metas_where($dato)
    {
        $this->db->where('id_seo',$dato['id_meta']);
        $query = $this->db->get('seo');
        //$query = $this->db->get_where('metas',array('id_meta' => $id));
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function consulta_seo_where()
    {
        $this->db->select('id_seo, seccion');
        $query = $this->db->get('seo');
        //$query = $this->db->get_where('modulos',array('id_modulo' => $id));
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function consulta_sem_where()
    {
        $this->db->select('*');
        $query = $this->db->get('sem');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function update_favi($datos)
    {
        $data = array('archivo' => $datos['archivo']);

        $this->db->where('id', $datos['id_logo']);
        $this->db->update('configuracion_sitio', $data);

        redirect('administrador/home','refresh');
    }
    public function update_logo($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'meta_titulo' => $datos['meta_tit'],
                      'meta_palabras' => $datos['meta_pal']);

        $this->db->where('id', $datos['id_logo']);
        $this->db->update('configuracion_sitio', $data);

        redirect('administrador/home','refresh');
    }
    public function update_logo2($datos)
    {
        $data = array('meta_titulo' => $datos['meta_tit'],
                      'meta_palabras' => $datos['meta_pal']);

        $this->db->where('id', $datos['id_logo']);
        $this->db->update('configuracion_sitio', $data);

        redirect('administrador/home','refresh');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function update_plantilla($datos)
    {
      $data = array(
                    'titulo' => $datos['titulo'],
                    'subtitulo' => $datos['subtitulo'],
                    'descripcion1' => $datos['descripcion1'],
                    'descripcion2' => $datos['descripcion2'],
                    'url' => $datos['url']);

    $this->db->where('id', $datos['id_secciones']);
    $this->db->update('estructura_home', $data);

    redirect('administrador/home','refresh');
    }

    public function updateService($datos)
    {
    	$data = array(  'id' => $datos['id'],
                      'titulo' => $datos['titulo'],
              		    'imagen' => $datos['imagen'],              
                      'subtitulo1' => $datos['subtitulo1'],
                      'descripcion' => $datos['descripcion'],              		  
                      'seccion' => $datos['seccion'],
                      'metaTitulo' =>  $datos['metaTitulo'],                      
                      'metaDescripcion' => $datos['metaDescripcion'],
                      'metaPalabras' =>  $datos['metaPalabras']);
		$this->db->where('id', $datos['id']);
    //print_r($data);
		$this->db->update('servicios', $data);
    redirect('administrador/menu_servicios/'.$datos['id'],'refresh');
    }
    public function deleteService($id){
      $this->db->where('id', $id);
      $this->db->delete('servicios');
      redirect('administrador/menu_servicios');
    }
     
    
     public function updateElevatorNoImage($datos)
    {
      $data = array(  'id' => $datos['id'],
                      'elevatorName' => $datos['elevatorName'],
                      'title' => $datos['title'],
                      'subtitle' => $datos['subtitle'],
                      'text' => $datos['text'],
                      /*'tinyImage1' => $datos['tiny1'],
                      'tinyImage2' => $datos['tiny2'],
                      'tinyImage3' => $datos['tiny3'],
                      'tinyImage4' => $datos['tiny4'],
                      'tinyImage5' => $datos['tiny5'],
                      'tinyImage6' => $datos['tiny6'],*/
                      'metaTitle' =>  $datos['metaTitle'],
                      'metaDescription' => $datos['metaDescription']);
    $this->db->where('id', $datos['id']);
    print_r($data);
    //$this->db->update('elevadores', $data);
    //redirect('administrador/menu_agregarElevadores/'.$datos['id'],'refresh');
    }
     public function update_secciones($datos)
    {
      $data = array('archivo' => $datos['archivo'],
                    'titulo' => $datos['titulo'],
                    'subtitulo' => $datos['subtitulo'],
                    'descripcion1' => $datos['descripcion1'],
                    'descripcion2' => $datos['descripcion2'],
                    'url' => $datos['url'],
                    'orden' => $datos['orden'],
                    'meta_titulo' => $datos['meta_tit'],
                    'meta_desc' => $datos['meta_desc']);

    $this->db->where('id', $datos['id_secciones']);
    $this->db->update('estructura_home', $data);

        redirect('administrador/menu_'.$datos['seccion'],'refresh');
    }
    public function update_secciones1($datos)
    {
        $data = array(
                    'titulo' => $datos['titulo'],
                    'subtitulo' => $datos['subtitulo'],
                    'orden' => $datos['orden'],
                    'descripcion1' => $datos['descripcion1'],
                    'descripcion2' => $datos['descripcion2'],
                    'url' => $datos['url'],
                    'meta_titulo' => $datos['meta_tit'],
                    'meta_desc' => $datos['meta_desc']);

        $this->db->where('id', $datos['id_secciones']);
        $this->db->update('estructura_home', $data);

        redirect('administrador/menu_'.$datos['seccion'],'refresh');
    }
    public function update_secciones2($datos)
    {
    	$data = array(
                    'titulo' => $datos['titulo'],
                    'subtitulo' => $datos['subtitulo'],
                    'descripcion1' => $datos['descripcion1'],
                    'descripcion2' => $datos['descripcion2'],
                    'url' => $datos['url'],
                    'orden' => $datos['orden'],
                    'meta_titulo' => $datos['meta_tit'],
                    'meta_desc' => $datos['meta_desc'],
                    'meta_titulo2' => $datos['meta_tit2'],
                    'meta_desc2' => $datos['meta_desc2']);

		$this->db->where('id', $datos['id_secciones']);
		$this->db->update('estructura_home', $data);

        redirect('administrador/menu_'.$datos['seccion'],'refresh');
    }


    public function update_2_img1($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'archivo2' => $datos['archivo2'],
                      'titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'descripcion1' => $datos['descripcion1'],
                      'descripcion2' => $datos['descripcion2'],
                      'descripcion3' => $datos['descripcion3'],
                      'url' => $datos['url'],
                      'meta_titulo' => $datos['meta_tit'],
                      'meta_desc' => $datos['meta_desc'],
                      'meta_titulo2' => $datos['meta_tit2'],
                      'meta_desc2' => $datos['meta_desc2']);

        $this->db->where('id', $datos['id_secciones']);
        $this->db->update('estructura_home', $data);

        redirect('administrador/menu_'.$datos['seccion'],'refresh');
    }

    public function update_2_img2($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'descripcion1' => $datos['descripcion1'],
                    'descripcion2' => $datos['descripcion2'],
                      'url' => $datos['url'],
                      'meta_titulo' => $datos['meta_tit'],
                      'meta_desc' => $datos['meta_desc'],
                      'meta_titulo2' => $datos['meta_tit2'],
                      'meta_desc2' => $datos['meta_desc2']);

        $this->db->where('id', $datos['id_secciones']);
        $this->db->update('estructura_home', $data);

        redirect('administrador/menu_'.$datos['seccion'],'refresh');
    }

    public function update_2_img3($datos)
    {
        $data = array('archivo2' => $datos['archivo2'],
                      'titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'descripcion1' => $datos['descripcion1'],
                    'descripcion2' => $datos['descripcion2'],
                      'url' => $datos['url'],
                      'meta_titulo' => $datos['meta_tit'],
                      'meta_desc' => $datos['meta_desc'],
                      'meta_titulo2' => $datos['meta_tit2'],
                      'meta_desc2' => $datos['meta_desc2']);

        $this->db->where('id', $datos['id_secciones']);
        $this->db->update('estructura_home', $data);

        redirect('administrador/menu_'.$datos['seccion'],'refresh');
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    

    public function update_metas($datos)
    {
      $data = array('titulo' => $datos['titulo'],
                    'descripcion' => $datos['descripcion'],
                    'palabras' => $datos['palabras']);

    $this->db->where('id_seo', $datos['id_meta']);
    $this->db->update('seo', $data);

        redirect('administrador/seoMenu','refresh');
    }

    public function update_sem($datos)
    {
      $data = array('tag' => $datos['meta_tag']);

      $this->db->where('id_sem', $datos['id_tag']);
      $this->db->update('sem', $data);

        redirect('admin/sem','refresh');
    }

    public function consulta_legales_where($dato)
    {
        $this->db->where('archivo',$dato['archivo']);
        $this->db->where('sitio',$dato['id_sitio']);
        $query = $this->db->get('configuracion_sitio');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }else{
            $this->db->set('sitio', $dato['id_sitio']);
            $this->db->set('archivo', $dato['archivo']);
            $this->db->insert('configuracion_sitio');
            if($this->db->affected_rows() > 0)
            {
                $this->db->where('archivo',$dato['archivo']);
                $this->db->where('sitio',$dato['id_sitio']);
                $query = $this->db->get('configuracion_sitio');
                if($query->num_rows() > 0 )
                {
                    return $query->row();
                }else{
                    redirect('admin/home','refresh');
                }
            }
        }
    }
    public function update_legales($datos)
    {
      $data = array('meta_titulo' => $datos['titulo'],
                    'meta_palabras' => $datos['descripcion']);

        $this->db->where('id', $datos['id_legales']);
        $this->db->update('configuracion_sitio', $data);

        redirect('admin/home','refresh');
    }

    public function menu1_insertar($datos){
        $this->db->set('orden', $datos['orden']);
        $this->db->set('titulo', $datos['titulo']);
        $this->db->set('subtitulo', $datos['subtitulo']);
        $this->db->set('descripcion', $datos['descripcion']);
        $this->db->set('descripcion2', $datos['descripcion2']);
        $this->db->set('descripcion3', $datos['descripcion3']);
        $this->db->set('seccion', $datos['seccion']);
        $this->db->set('archivo', $datos['archivo']);
        $this->db->set('meta_titulo', $datos['meta_titulo']);
        $this->db->set('meta_desc', $datos['meta_desc']);
        $this->db->insert('menus2');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/Menu1','refresh');
        }
    }
    public function consulta_menus($dato)
    {
        $this->db->where('id_menus',$dato['id_menus']);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function consulta_menus2($dato)
    {
        $this->db->where('id_menus',$dato['id_menus']);
        $query = $this->db->get('menus2');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function update_menu1($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'orden' => $datos['orden'],
                      'titulo' => $datos['titulo'],
                      'descripcion' => $datos['descripcion'],
                      'meta_titulo' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus2', $data);

        redirect('administrador/Menu1','refresh');
    }
    public function update_menu12($datos)
    {
        $data = array(
                      'orden' => $datos['orden'],
                      'titulo' => $datos['titulo'],
                      'descripcion' => $datos['descripcion'],
                      'meta_titulo' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus2', $data);

        redirect('administrador/Menu1','refresh');
    }
    public function update_menu_otros1($datos)
    {
        $data = array('archivo2' => $datos['archivo2'],
                      'meta_titulo2' => $datos['meta_titulo2'],
                      'meta_desc2' => $datos['meta_desc2']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus2', $data);

        redirect('administrador/Menu1','refresh');
    }
    public function update_menu_otros12($datos)
    {
        $data = array(
                      'meta_titulo2' => $datos['meta_titulo2'],
                      'meta_desc2' => $datos['meta_desc2']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus2', $data);

        redirect('administrador/Menu1','refresh');
    }
    public function delete_menus($dato)
    {
        $this->db->where('id_menus',$dato['id_menus']);
        $query = $this->db->get('menus2');
        if($query->num_rows() > 0){
            foreach ($query->result() as $row)
            {
                $nombre_banner = $row->archivo;
            }
        
        $nombre_banner = $row->archivo;

        $carpeta = './img/menu_uno/';

        if(file_exists($carpeta.$nombre_banner))
        {
            unlink($carpeta.$nombre_banner);
        }

        $this->db->where('id_menus',$dato['id_menus']);
        return $this->db->delete('menus2');

        }

        redirect('administrador/Menu1','refresh');
    }

    public function menu2_insertar($datos){
        $this->db->set('orden', $datos['orden']);
        $this->db->set('titulo', $datos['titulo']);
        $this->db->set('subtitulo', $datos['subtitulo']);
        $this->db->set('seccion', $datos['seccion']);
        $this->db->set('archivo', $datos['archivo']);
        $this->db->set('meta_titulo', $datos['meta_titulo']);
        $this->db->set('meta_desc', $datos['meta_desc']);
        $this->db->insert('menus');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/Menu2/'.$datos['seccion'],'refresh');
        }
    }
    public function update_menu2($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'orden' => $datos['orden'],
                      'meta_titulo' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus', $data);

        redirect('administrador/Menu2/'.$datos['id_secc'],'refresh');
    }
    public function update_menu22($datos)
    {
        $data = array('titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'orden' => $datos['orden'],
                      'meta_titulo' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus', $data);

        redirect('administrador/Menu2/'.$datos['id_secc'],'refresh');
    }
    public function delete_menus2($dato)
    {
        $this->db->where('id_menus',$dato['id_menus']);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0){
            foreach ($query->result() as $row)
            {
                $nombre_banner = $row->archivo;
                $id_secc= $row->seccion;
            }
        
        $nombre_banner = $row->archivo;
        $carpeta = './img/menu_uno/';
        $carpeta = './img/'.$dato['carp'].'/';
        $car= $carpeta.$nombre_banner;

        if(file_exists($carpeta.$nombre_banner))
        {
            unlink($carpeta.$nombre_banner);
        }

        $this->db->where('id_menus',$dato['id_menus']);
        return $this->db->delete('menus');

        //redirect('administrador/Menu2/'.$id_secc,'refresh');
        }
        
    }

    public function menu3_insertar($datos){
        $this->db->set('orden', $datos['orden']);
        $this->db->set('titulo', $datos['titulo']);
        $this->db->set('subtitulo', $datos['subtitulo']);
        $this->db->set('descripcion', $datos['descripcion']);
        $this->db->set('descripcion2', $datos['descripcion2']);
        $this->db->set('seccion', $datos['id_secc']);
        $this->db->set('archivo', $datos['archivo']);
        $this->db->set('meta_titulo', $datos['meta_titulo']);
        $this->db->set('meta_desc', $datos['meta_desc']);
        $this->db->set('meta_titulo2', $datos['meta_titulo2']);
        $this->db->set('meta_desc2', $datos['meta_desc2']);
        $this->db->insert('menus');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/Menu3/'.$datos['id_secc'],'refresh');
        }
    }
    public function update_menu3($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'descripcion' => $datos['descripcion'],
                      'descripcion2' => $datos['descripcion2'],
                      'orden' => $datos['orden'],
                      'meta_titulo' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc'],
                      'meta_titulo2' => $datos['meta_titulo2'],
                      'meta_desc2' => $datos['meta_desc2']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus', $data);

        redirect('administrador/Menu3/'.$datos['id_secc'],'refresh');
    }
    public function update_menu32($datos)
    {
        $data = array('titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'descripcion' => $datos['descripcion'],
                      'descripcion2' => $datos['descripcion2'],
                      'orden' => $datos['orden'],
                      'meta_titulo' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc'],
                      'meta_titulo2' => $datos['meta_titulo2'],
                      'meta_desc2' => $datos['meta_desc2']);

        $this->db->where('id_menus', $datos['id_menus']);
        $this->db->update('menus', $data);

        redirect('administrador/Menu3/'.$datos['id_secc'],'refresh');
    }
    public function delete_menus3($dato)
    {
        $this->db->where('id_menus',$dato['id_menus']);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0){
            foreach ($query->result() as $row)
            {
                $nombre_banner = $row->archivo;
                $id_secc = $row->seccion;
            }
        
        $nombre_banner = $row->archivo;
        $carpeta = './img/menu_tres/';
        //echo $id_cat;
        if(file_exists($carpeta.$nombre_banner))
        {
            unlink($carpeta.$nombre_banner);
        }

        $this->db->where('id_menus',$dato['id_menus']);
        $this->db->delete('menus');
        }
        redirect('administrador/Menu3/'.$id_secc,'refresh');
    }

/* ---------------------------------------------------- ASIGNA LOGOS ---------------------------------------------------------- */

    public function inserta_asignado($datos){
        $this->db->set('id_logo', $datos['id_logo']);
        $this->db->set('id_servicio', $datos['id_servicio']);
        $this->db->set('id_seccion', $datos['id_seccion']);
        $this->db->insert('asigna_logos');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/AsignaLogos/'.$datos['id_servicio'].'/'.$datos['id_seccion'],'refresh');
        }
    }
    public function delete_asignado($datos)
    {
        $this->db->where('id_logo', $datos['id_logo']);
        $this->db->where('id_servicio', $datos['id_servicio']);
        $this->db->where('id_seccion', $datos['id_seccion']);
        //$this->db->where('id',$dato['id']);
        $this->db->delete('asigna_logos');
        redirect('administrador/AsignaLogos/'.$datos['id_servicio'].'/'.$datos['id_seccion'],'refresh');
    }
/* ---------------------------------------------------- ASIGNA LOGOS ---------------------------------------------------------- */

/* ---------------------------------------------------- ASIGNA CATEGORIAS ---------------------------------------------------------- */

    public function inserta_asig_cat($datos){
        $this->db->set('id_categoria', $datos['id_cat']);
        $this->db->set('id_producto', $datos['id_prod']);
        $this->db->insert('asigna_categoria');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/AsignaCats/'.$datos['id_prod'],'refresh');
        }
    }
    public function delete_asig_cat($datos)
    {
        $this->db->where('id_categoria', $datos['id_cat']);
        $this->db->where('id_producto', $datos['id_prod']);
        $this->db->delete('asigna_categoria');
        redirect('administrador/AsignaCats/'.$datos['id_prod'] ,'refresh');
    }
/* ---------------------------------------------------- ASIGNA CATEGORIAS ---------------------------------------------------------- */

/* ---------------------------------------------------- ASIGNA ACCESORIOS ---------------------------------------------------------- */

    public function inserta_asig_acces($datos){
        $this->db->set('id_accesorio', $datos['id_acc']);
        $this->db->set('id_producto', $datos['id_prod']);
        $this->db->insert('asigna_accesorios');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/AsignaAcces/'.$datos['id_prod'],'refresh');
        }
    }
    public function delete_asig_acces($datos)
    {
        $this->db->where('id_accesorio', $datos['id_acc']);
        $this->db->where('id_producto', $datos['id_prod']);
        $this->db->delete('asigna_accesorios');
        redirect('administrador/AsignaAcces/'.$datos['id_prod'] ,'refresh');
    }
/* ---------------------------------------------------- ASIGNA ACCESORIOS ---------------------------------------------------------- */
    

    public function consulta_videos($dato)
    {
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('videos');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function menu4_insertar($datos){
        $this->db->set('orden', $datos['orden']);
        $this->db->set('titulo', $datos['titulo']);
        $this->db->set('url', $datos['url']);
        $this->db->insert('videos');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/Menu4','refresh');
        }
    }
    public function update_menu4($datos)
    {
        $data = array(
                      'titulo' => $datos['titulo'],
                      'url' => $datos['url'],
                      'orden' => $datos['orden']);

        $this->db->where('id', $datos['id']);
        $this->db->update('videos', $data);
        redirect('administrador/Menu4','refresh');
    }
    
    public function delete_menus4($dato)
    {
        $this->db->where('id',$dato['id']);
        $this->db->delete('videos');
        redirect('administrador/Menu4','refresh');
    }

    // ************************************************ CATEGORIAS **********************************************************

    public function cat_insertar($datos){
        $this->db->set('orden', $datos['orden']);
        $this->db->set('titulo', $datos['titulo']);
        $this->db->insert('categorias');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/Category','refresh');
        }
    }
    public function consulta_categorias($dato)
    {
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('categorias');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    public function update_cat($datos)
    {
        $data = array('titulo' => $datos['titulo'],'orden' => $datos['orden']);
        $this->db->where('id', $datos['id']);
        $this->db->update('categorias', $data);
        redirect('administrador/Category','refresh');
    }
    
    public function delete_cat($dato)
    {
        $this->db->where('id',$dato['id']);
        $this->db->delete('categorias');
        redirect('administrador/Category','refresh');
    }

    // ************************************************ CATEGORIAS **********************************************************
    // ************************************************ PRODUCTOS **********************************************************

    public function product_insertar($datos){
        $this->db->set('titulo', $datos['titulo']);
        $this->db->set('descripcion', $datos['descripcion']);
        $this->db->set('archivo', $datos['archivo']);
        $this->db->set('meta_tit', $datos['meta_titulo']);
        $this->db->set('meta_desc', $datos['meta_desc']);
        $this->db->insert('productos');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/Products','refresh');
        }
    }
    public function consulta_product($dato)
    {
        $this->db->where('id_menus',$dato['id']);
        $query = $this->db->get('menus2');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    
    public function update_product1($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'titulo' => $datos['titulo'],
                      'descripcion' => $datos['descripcion'],
                      'meta_tit' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id', $datos['id']);
        $this->db->update('productos', $data);

        redirect('administrador/Products','refresh');
    }
    public function update_product2($datos)
    {
        $data = array('titulo' => $datos['titulo'],
                      'descripcion' => $datos['descripcion'],
                      'meta_tit' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id', $datos['id']);
        $this->db->update('productos', $data);

        redirect('administrador/Products','refresh');
    }
    public function delete_product($dato)
    {
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('productos');
        if($query->num_rows() > 0){
            foreach ($query->result() as $row)
            {
                $nombre_banner = $row->archivo;
            }

        $nombre_banner = $row->archivo;
        $carpeta = './img/menu_productos/';
        
        if(file_exists($carpeta.$nombre_banner))
        {
            unlink($carpeta.$nombre_banner);
        }

        $this->db->where('id',$dato['id']);
        $this->db->delete('productos');
        redirect('administrador/Products','refresh');
        }
    }
    
// ************************************************ PRODUCTOS **********************************************************
// ************************************************ ACCESORIOS **********************************************************

    public function acces_insertar($datos){
        $this->db->set('descripcion', $datos['descripcion']);
        $this->db->set('archivo', $datos['archivo']);
        $this->db->set('meta_tit', $datos['meta_titulo']);
        $this->db->set('meta_desc', $datos['meta_desc']);
        $this->db->insert('accesorios');
        if($this->db->affected_rows() > 0)
        {
            redirect('administrador/Accesorios','refresh');
        }
    }
    
    public function consulta_acces($dato)
    {
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('accesorios');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
    
    public function update_acces1($datos)
    {
        $data = array('archivo' => $datos['archivo'],
                      'descripcion' => $datos['descripcion'],
                      'meta_tit' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id', $datos['id']);
        $this->db->update('accesorios', $data);

        redirect('administrador/Accesorios','refresh');
    }
    public function update_acces2($datos)
    {
        $data = array('descripcion' => $datos['descripcion'],
                      'meta_tit' => $datos['meta_titulo'],
                      'meta_desc' => $datos['meta_desc']);

        $this->db->where('id', $datos['id']);
        $this->db->update('accesorios', $data);

        redirect('administrador/Accesorios','refresh');
    }
    
    public function delete_acces($dato)
    {
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('accesorios');
        if($query->num_rows() > 0){
            foreach ($query->result() as $row)
            {
                $nombre_banner = $row->archivo;
            }

        $nombre_banner = $row->archivo;
        $carpeta = './img/menu_acces/';
        
        if(file_exists($carpeta.$nombre_banner))
        {
            unlink($carpeta.$nombre_banner);
        }

        $this->db->where('id',$dato['id']);
        $this->db->delete('accesorios');
        redirect('administrador/Accesorios','refresh');
        }
    }
    
// ************************************************ ACCESORIOS **********************************************************

    /////////////////////////////// PAGINA /////////////////////////////////////

    public function consulta_pagina($id_cont)
    {        
        $this->db->where('id',$id_cont);
        $query = $this->db->get('estructura_home');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
              $info['titulo'] = $row->titulo;
              $info['subtitulo'] = $row->subtitulo;
              $info['descripcion1'] = $row->descripcion1;
              $info['descripcion2'] = $row->descripcion2;
              $info['url'] = $row->url;
              $info['meta_titulo'] = $row->meta_titulo;
              $info['meta_desc'] = $row->meta_desc;
              $info['archivo'] = $row->archivo;
              $info['meta_titulo2'] = $row->meta_titulo2;
              $info['meta_desc2'] = $row->meta_desc2;
              $info['archivo2'] = $row->archivo2;
            }
        }
        return $info;
    }

    /////////////////////////////// NOTICIAS /////////////////////////////////////

    public function consulta_noti($id_cont)
    {
        $this->db->where('id_menus',$id_cont);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }
/*
    public function consulta_noti($id_cont)
    {        
        $this->db->where('id_menus',$id_cont);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
              $infer['titulo'] = $row->titulo;
              //$infer['descripcion1'] = $row->descripcion;
              $infer['meta_titulo'] = $row->meta_titulo;
              $infer['meta_desc'] = $row->meta_desc;
              $infer['archivo'] = $row->archivo;
            }
        }
        //return $inf;
        print_r($infer);
    }
*/
    /////////////////////////////// PAGINA /////////////////////////////////////

    public function consulta_seo($id_seo)
    {        
        $this->db->where('id_seo',$id_seo);
        $query = $this->db->get('seo');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
              $info['titulo'] = $row->titulo;
              $info['descripcion'] = $row->descripcion;
              $info['palabras'] = $row->palabras;
              $info['sitio'] = $row->sitio;
            }
        }
        return $info;
    }

    /////////////////////////////// FAVICON /////////////////////////////////////

    public function consulta_fav($id_cont)
    {        
        $this->db->where('id',$id_cont);
        $query = $this->db->get('configuracion_sitio');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
              $info['archivo'] = $row->archivo;
            }
        }
        return $info;
    }

    /////////////////////////////// LOGOTIPO /////////////////////////////////////

    public function logopagina($id_cont)
    {        
        $this->db->where('id',$id_cont);
        $query = $this->db->get('configuracion_sitio');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
              $info['archivo'] = $row->archivo;
              $info['meta_titulo'] = $row->meta_titulo;
              $info['meta_palabras'] = $row->meta_palabras;
            }
        }
        return $info;
    }

    /////////////////////////////// BOLSA DE TRABADO /////////////////////////////////////

    public function consulta_bolsa()
    {
        $this->db->where('seccion','9');
        $this->db->Limit(1);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }

    public function consulta_bolsa2($id_cont)
    {
        $this->db->where('id_menus',$id_cont);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
    }


    public function consulta_titulo_cat($id_cont)
    {        
        $this->db->where('id_menus',$id_cont);
        $query = $this->db->get('menus');
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row){
              $info['titulo'] = $row->titulo;
            }
        }
        return $info;
    }

      /////////////////////////////// NEWS /////////////////////////////////////
 
   public function insertContent($data){
       $this->db->set('orden', $data['orden']);
       $this->db->set('titulo', $data['titulo']);
       $this->db->set('subtitulo', $data['subtitulo']);
       $this->db->set('subtitulo2', $data['subtitulo2']);
       $this->db->set('descripcion1', $data['descripcion1']);
       $this->db->set('descripcion2', $data['descripcion2']);
       $this->db->set('descripcion3', $data['descripcion3']);
       $this->db->set('archivo', $data['archivo']);
       $this->db->set('archivo2', $data['archivo2']);
       $this->db->set('imagen1', $data['imagen1']);
       $this->db->set('imagen2', $data['imagen2']);
       $this->db->set('imagen3', $data['imagen3']);
       $this->db->set('meta_desc', $data['meta_desc']);
       $this->db->set('meta_desc2', $data['meta_desc2']);
       $this->db->set('metaImagen1', $data['metaImagen1']);
       $this->db->set('metaImagen2', $data['metaImagen2']);
       $this->db->set('metaImagen3', $data['metaImagen3']);
       $this->db->set('seccion', $data['seccion']);
       $this->db->set('tipo', 'con2');
       $this->db->set('bloque', 'bloktsd');
       $this->db->insert($data['seccion']);
        if($this->db->affected_rows() > 0){
          redirect('administrador/menu_'.$data['seccion'],'refresh');
        }
    }
  public function checkContent($dato){
      $this->db->where('id',$dato['id']);
      $query = $this->db->get($dato['seccion']);        
      if($query->num_rows() > 0 ){
        return $query->row();
      }
  }
  public function updateContent($datos)
    {
      $data = array(  'id' => $datos['id'],
                      'seccion' => $datos['seccion'],
                      'titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'subtitulo2' => $datos['subtitulo2'],
                      'descripcion1' => $datos['descripcion1'],
                      'descripcion2' => $datos['descripcion2'],
                      'descripcion3' => $datos['descripcion3'],
                      'orden' => $datos['orden'],
                      'archivo' => $datos['archivo'],                                    
                      'archivo2' => $datos['archivo2'],   
                      'imagen1' => $datos['imagen1'],
                      'imagen2' => $datos['imagen2'],
                      'imagen3' => $datos['imagen3'],
                      'meta_desc' =>  $datos['meta_desc'],
                      'meta_desc2' =>  $datos['meta_desc2'],
                      'metaImagen1' =>  $datos['metaImagen1'],
                      'metaImagen2' =>  $datos['metaImagen2'],
                      'metaImagen3' =>  $datos['metaImagen3']);
    $this->db->where('id', $datos['id']);
    $this->db->update($datos['seccion'], $data);
     redirect('administrador/menu_'.$data['seccion'],'refresh');
    }  
   
  public function deleteContent($id,$seccion){
      $this->db->where('id', $id);
      $query = $this->db->get($seccion); 
      $this->db->where('id', $id);
      $this->db->delete($seccion);
     
      $data= $query->row();
       redirect('administrador/menu_'.$data->seccion,'refresh');
    }

  public function checkGallery($dato){
      $this->db->where('id',$dato['id']);
      $query = $this->db->get('estructura_home');  
        if($query->num_rows() < 0 ){
          $data= array(
            'id'=>$dato['id'],
            'tipo'=>'menu2');
            $this->db->insert('estructura_home', $data);
            redirect("administrador/menu_producto");
      }      
      else{
        redirect("administrador/menu2/".$dato['id']);
        return $query->row();
      }
  }



  public function insertBolsaCategory($data){
       $this->db->set('orden', $data['orden']);
       $this->db->set('titulo', $data['titulo']);
       $this->db->set('subtitulo', $data['subtitulo']);
       $this->db->set('descripcion1', $data['descripcion1']);
       $this->db->set('seccion', $data['seccion']);
       $this->db->set('tipo', 'tipo');
       $this->db->set('bloque', 'bloque');
       $this->db->insert('estructura_home');
        if($this->db->affected_rows() > 0){
          redirect('administrador/menu_bolsa_vacantes','refresh');
        }
    }
     public function insertBolsaSubCategory($data){
       $this->db->set('subcategoria', $data['subcategoria']);
       $this->db->set('orden', $data['orden']);
       $this->db->set('titulo', $data['titulo']);
       $this->db->set('descripcion1', $data['descripcion1']);      
       $this->db->set('tipo', 'tipo');
       $this->db->set('bloque', 'bloque');
       $this->db->insert('estructura_home');
        if($this->db->affected_rows() > 0){
          redirect('administrador/menu_bolsa_vacantes2/'.$data['subcategoria'].'/'.$data['titulo2'],'refresh');
        }
    }
    public function checkBolsaCategory($dato){
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('estructura_home');        
        if($query->num_rows() > 0 ){
        return $query->row();
      }
    }
     public function checkBolsaSubCategory($dato){
        $this->db->where('id',$dato['id']);
        $query = $this->db->get('estructura_home');        
        if($query->num_rows() > 0 ){
        return $query->row();
      }
    }
     public function  editBolsaCategory($datos){
         $data = array('id' => $datos['id'],                     
                      'titulo' => $datos['titulo'],
                      'subtitulo' => $datos['subtitulo'],
                      'descripcion1' => $datos['descripcion1'],
                      'orden' => $datos['orden']);                     
    $this->db->where('id', $datos['id']);
    $this->db->update('estructura_home', $data);
     redirect('administrador/menu_bolsa_vacantes','refresh');
    }
    public function  editBolsaSubCategory($datos){
         $data = array('id' => $datos['id'],        
                      'orden' => $datos['orden'],                
                      'titulo' => $datos['titulo'],                      
                      'descripcion1' => $datos['descripcion1']);
                                       
    $this->db->where('id', $datos['id']);
    $this->db->update('estructura_home', $data);
    redirect('administrador/menu_bolsa_vacantes2/'.$datos['idPadre'].'/'.$datos['seccionName'],'refresh');
    }
      public function deleteBolsaCategory($id){
      $this->db->where('subcategoria', $id);     
      $this->db->delete('estructura_home');
      $this->db->where('id', $id);           
      $this->db->delete('estructura_home');     
      
       redirect('administrador/menu_bolsa_vacantes','refresh');
    }
     public function deleteBolsaSubCategory($id,$seccion,$idPadre){
      $this->db->where('id', $id);     
      $this->db->delete('estructura_home');      
      
       redirect('administrador/menu_bolsa_vacantes2/'.$idPadre.'/'.$seccion,'refresh');
    }
}

?>