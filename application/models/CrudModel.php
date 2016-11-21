<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CrudModel extends CI_Model {

  public function __construct()
  {
    parent::__construct();
        $db_admin = $this->load->database('default', TRUE);
        $this->load->library('session');

        
  }

/*                                                CRUD MODEL V 0.7                                 */
  public function allProducts(){
    $this->db->order_by('nombre','asc');
    $query=$this->db->get('productos');
    return $query;

  }
  public function findCategory($category){
    $this->db->order_by('nombre','asc');
    $this->db->where('categoria',$category);
    $query= $this->db->get('productos');
    return $query;
  }
  public function findProduct($product){    
    $this->db->like('nombre',$product,null);
    $this->db->order_by('nombre','asc');
    $query=$this->db->get('productos');

    if($query->num_rows()>0){
      return $query;
    }
    else{
      $this->db->like('nombre',$product);
      $this->db->order_by('nombre','asc');
      $query=$this->db->get('productos');

      if($query->num_rows()>0){
        return $query;
      }
      //Búsqueda por Descripción
      else{
        $this->db->where("MATCH (descripcion) AGAINST ('".$product."' IN NATURAL LANGUAGE MODE)",NULL,FALSE);
        $this->db->order_by('nombre','asc');
        $query=$this->db->get('productos');
        if($query->num_rows()>0){
            return $query;
        }
        //Búsqueda por Propiedades Físicas
        else{
          $this->db->where("MATCH (fisicas) AGAINST ('".$product."' IN NATURAL LANGUAGE MODE)",NULL,FALSE);
          $this->db->order_by('nombre','asc');
          $query=$this->db->get('productos');
          if($query->num_rows()>0){
              return $query;
          }
          //Búsqueda por Propiedades Quimicas
          else{
            $this->db->where("MATCH (quimicas) AGAINST ('".$product."' IN NATURAL LANGUAGE MODE)",NULL,FALSE);
            $this->db->order_by('nombre','asc');
            $query=$this->db->get('productos');
            if($query->num_rows()>0){
              return $query;
            }
            //Búsqueda por Propiedades Termodinámicas
            else{
              $this->db->where("MATCH (termodinamicas) AGAINST ('".$product."' IN NATURAL LANGUAGE MODE)",NULL,FALSE);
              $this->db->order_by('nombre','asc');
              $query=$this->db->get('productos');
              if($query->num_rows()>0){
                return $query;
              }
            }//Termodinámicas
          }//Quimicas
        }//Fisicas
      }//Descripción
    }//Nombre con Wildcards    

  }
  public function insertUser($data,$passwordToValidate){
      /*Valida Password*/
      if(strlen($passwordToValidate['contrasenaToValidate']) < 6){
        $error = "La contraseña debe tener al menos 6 caracteres";
        $mensaje['mensaje1']=$error;            
        }
      /*elseif(strlen($passwordToValidate['contrasenaToValidate']) > 16){
          $error = "La clave no puede tener más de 16 caracteres";
       }*/
       elseif (!preg_match('`[a-z]`',$passwordToValidate['contrasenaToValidate'])){
          $error = "La clave debe tener al menos una letra minúscula";
           $mensaje['mensaje1']=$error;    
        
       }
       elseif (!preg_match('`[A-Z]`',$passwordToValidate['contrasenaToValidate'])){
          $error = "La clave debe tener al menos una letra mayúscula";
          $mensaje['mensaje1']=$error;    
        
       }
       elseif (!preg_match('`[0-9]`',$passwordToValidate['contrasenaToValidate'])){
          $error = "La clave debe tener al menos un caracter numérico";
        
       }
       else{
        $error="";
       }
      if($error==""){
    
        /*Toma Numero de cuenta y numero de cuenta donde exista alguno con los datos mandados*/
        $this->db->where('numeroCuenta',$data['numeroCuenta']);           
        $query=$this->db->get('usuarios');                        
        $this->db->where('usuario',$data['usuario']);           
        $query2=$this->db->get('usuarios');  
        /*Si existe numero de cuenta devolvera por json a el html error*/
           if($query->num_rows() != 0){
              $mensaje['mensaje1']="Error, Número de cuenta ya existe";
              echo json_encode ($mensaje) ; 
              //print $mensaje['mensaje1'];
           }
        /*Si existe usuario devolvera por json a el html error*/         
           else if($query2->num_rows() != 0){          
              $mensaje['mensaje1']="Elige otro Nombre de Usuario ese ya existe";           
              echo json_encode ($mensaje) ;
              //print $mensaje['mensaje1'];          
           }
        /*Si pasa las validaciones entonces hacemos el Upload y devuelve un Mensaje que accionará un reload en la página*/
          else{
            $this->db->insert('usuarios', $data);  
            $mensaje['mensaje1']="Hecho";                         
            $this->session->set_userdata('message', "Usuario añadido correctamente");                       
          }
      }
      else{                              

          echo json_encode ($mensaje);            
      }
  }
  public function checkUser($dato){
      $this->db->where('id',$dato['id']);
      $query = $this->db->get('usuarios');        
      if($query->num_rows() > 0 ){
        return $query->row();
  }
  
       
  }
  public function editUser($data){
    if(isset($data['contrasenaToValidate'])){
      /*Valida Password*/
      if(strlen($data['contrasenaToValidate']) < 6){
        $error = "La contraseña debe tener al menos 6 caracteres";
        $mensaje['mensaje']=$error;            
      }
      /*elseif(strlen($data['contrasenaToValidate']) > 16){
          $error = "La clave no puede tener más de 16 caracteres";
       }*/
       elseif (!preg_match('`[a-z]`',$data['contrasenaToValidate'])){
          $error = "La clave debe tener al menos una letra minúscula";
           $mensaje['mensaje']=$error;    
        
       }
       elseif (!preg_match('`[A-Z]`',$data['contrasenaToValidate'])){
          $error = "La clave debe tener al menos una letra mayúscula";
          $mensaje['mensaje']=$error;    
        
       }
       elseif (!preg_match('`[0-9]`',$data['contrasenaToValidate'])){
          $error = "La clave debe tener al menos un caracter numérico";
        
       }
       else{
        $error="";
       }
      if($error==""){


        $this->db->where('id',$data['id']);           
        $query0=$this->db->get('usuarios');                        
        $own=$query0->row();

        $this->db->where('numeroCuenta',$data['numeroCuenta']);           
        $query1=$this->db->get('usuarios');                        
        $cuenta=$query1->row();
        $this->db->where('usuario',$data['usuario']);           
        $query2=$this->db->get('usuarios');  
        $usuario=$query2->row();
        $flag1=0;
        $flag2=0;

        
          if($own->numeroCuenta==$data['numeroCuenta']){          
            $flag1=1;
           }
          if($flag1!=1 && $query1->num_rows() > 0){
            $mensaje['mensaje']="Error, Número de cuenta ya existe";
            echo json_encode ($mensaje) ; 
            //print $mensaje['mensaje1'];  
           }
           if($flag1!=1 && $query1->num_rows() <= 0){
            $flag1=1;
            //print $mensaje['mensaje1'];  
           }                  
           if($own->usuario==$data['usuario']){
            $flag2=1;
           }
           if($flag2!=1 && $query2->num_rows() > 0){          
            $mensaje['mensaje']="Elige otro Nombre de Usuario ese ya existe";           
            echo json_encode ($mensaje) ;
            //print $mensaje['mensaje1'];          
           }
            if($flag2!=1 && $query2->num_rows() <= 0){
            $flag2=1;
            //print $mensaje['mensaje1'];  
           }     

          if($flag1==1 && $flag2==1){
            $this->db->where('id',$data['id']);   
            $this->db->update('usuarios', $data);  
            $mensaje['mensaje']="Hecho";
             $mensaje['mensaje2']="Usuario Actualizado con éxito";
            $this->db->where('id',$data['id']); 
            $query=$this->db->get('usuarios');
            $user=$query->row();

            //Actualizar la sesión :v
            if($this->session->userdata('idUser')==$data['id']){
              $usuario_data = array(     'idUser' => $user->id,
                                         'permisos'=>$user->permisos,
                                         'usuario'=>$user->usuario,
                                         'imagen'=>$user->imagen,
                                         'logueado' => TRUE);
              $this->session->set_userdata($usuario_data);
            }
            echo json_encode ($mensaje) ;
            //echo json_encode ($mensaje) ;              
          }
         
      }
      else{                              
          echo json_encode ($mensaje);            
      }
    }else{
      $this->db->where('id',$data['id']);           
        $query0=$this->db->get('usuarios');                        
        $own=$query0->row();

        $this->db->where('numeroCuenta',$data['numeroCuenta']);           
        $query1=$this->db->get('usuarios');                        
        $cuenta=$query1->row();
        $this->db->where('usuario',$data['usuario']);           
        $query2=$this->db->get('usuarios');  
        $usuario=$query2->row();
        $flag1=0;
        $flag2=0;

        
          if($own->numeroCuenta==$data['numeroCuenta']){          
            $flag1=1;
           }
          if($flag1!=1 && $query1->num_rows() > 0){
            $mensaje['mensaje']="Error, Número de cuenta ya existe";
            echo json_encode ($mensaje) ; 
            //print $mensaje['mensaje1'];  
           }
           if($flag1!=1 && $query1->num_rows() <= 0){
            $flag1=1;
            //print $mensaje['mensaje1'];  
           }                  
           if($own->usuario==$data['usuario']){
            $flag2=1;
           }
           if($flag2!=1 && $query2->num_rows() > 0){          
            $mensaje['mensaje']="Elige otro Nombre de Usuario ese ya existe";           
            echo json_encode ($mensaje) ;
            //print $mensaje['mensaje1'];          
           }
            if($flag2!=1 && $query2->num_rows() <= 0){
            $flag2=1;
            //print $mensaje['mensaje1'];  
           }     

          if($flag1==1 && $flag2==1){
            $this->db->where('id',$data['id']);   
            $this->db->update('usuarios', $data);  
            $mensaje['mensaje']="Hecho";
            $this->session->set_userdata('message', "Usuario actualizado correctamente");                       
            $this->db->where('id',$data['id']); 
            $query=$this->db->get('usuarios');
            $user=$query->row();

            //Actualizar la sesión :v
            if($this->session->userdata('idUser')==$data['id']){
              $usuario_data = array(     'idUser' => $user->id,
                                         'permisos'=>$user->permisos,
                                         'usuario'=>$user->usuario,
                                         'imagen'=>$user->imagen,
                                         'logueado' => TRUE);
              $this->session->set_userdata($usuario_data);
            }
            echo json_encode ($mensaje) ;
            //echo json_encode ($mensaje) ;              
          }

    }
}
  public function deleteUser($id){
      /*Busca el id mandado y donde esté el usuario rescata 
      sus datos y borra la imagen si es que existe*/
      $this->db->where('id', $id);
      $query= $this->db->get('usuarios');
      $data= $query->row();
      if (file_exists('img/usuarios/'.$data->imagen)) {
      unlink('img/usuarios/'.$data->imagen);
      }
      /*Ya borrada si existía la imagen borramos el usuario y volvemos a la página anterior*/
      $this->db->where('id', $id);
      $this->db->delete('usuarios');
      $this->session->set_userdata('message', "Usuario eliminado correctamente");                       
      redirect($_SERVER['HTTP_REFERER']);
    }
  public function insertProduct($data){
     if($this->db->insert('productos', $data)){
        //print_r($this->session->userdata('previousGallery'));
        $this->session->set_flashdata('Producto Insertado');
        //redirect( 'create-profile/successful' );
        $message="Producto insertado correctamente";
        return $message;
       }
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
  
  }
  public function checkProduct($dato){
      $this->db->where('id',$dato['id']);
      $query = $this->db->get('productos');        
      if($query->num_rows() > 0 ){
        return $query->row();
      }
  }
public function updateProduct($data){
       $this->db->where('id', $data['id']);     
       
       if($this->db->update('productos', $data)){                      
           $message="Producto actualizado correctamente";
           return $message;
       }                
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
}
public function deleteProduct($id){
      $this->db->where('id', $id);      
      $query= $this->db->get('productos');
      $data= $query->row();

      if (!empty($data->imagen) && file_exists('img/productos/'.$data->imagen)) {
      unlink('img/productos/'.$data->imagen);
      }
    

      $this->db->where('id', $id);
      $this->db->delete('productos');
          
       $message="Producto eliminado correctamente";
       return $message;
    }
/*public function checkUser($data){
      $this->db->where('id',$data['id']);
      $query = $this->db->get('usuarios');              
      if($query->num_rows() > 0 ){
        return $query->row();
        //echo json_encode ($query) ; 
      }
  }*/
public function recoverPassword($data){
  $this->db->where('usuario',$data['usuario']);
  $query=$this->db->get('usuarios');
  if($query->num_rows()>0){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $data['contrasenaRecover']=substr(str_shuffle($characters), 0,20 );
  $this->db->where('usuario',$data['usuario']);
  $this->db->update('usuarios',$data); 
  }
}
public function getLinkRecover($data){
  $this->db->where('usuario',$data['usuario']);
  $query=$this->db->get('usuarios');
  if($query->num_rows()>0){
  return $query;  
  }

  
}
public function renewPassword($data){
  $update=array('contrasena'=>$data['contrasena'],
                'contrasenaRecover'=>""
                );
  $this->db->where('contrasenaRecover ',$data['contrasenaRecover']);
  $data['contrasenaRecover']="";
  

  if($this->db->update('usuarios',$update)){
   
  }
  else{
    print "Fracaso";
  }
}  
  
public function sendMessage($data){
  if($query=$this->db->insert('mensajes',$data)){
    $done= true;
  }
  else{
    $done= false;
  }
  return $done;

} 
public function getMessages(){
  $this->db->order_by('fecha','desc');
  $messages= $this->db->get('mensajes');  
  return $messages;
} 
public function countMessagesNotSeen(){
  $this->db->where('visto','0');
  $query=$this->db->get('mensajes');
  $result=$query->num_rows();
  return $result;
}
public function statusMessagesOn(){
  $data=array('visto'=>1
              );
  $this->db->update('mensajes',$data);
}   
public function deleteMessage($data){
 $this->db->where('id',$data['id']);
 $this->db->delete('mensajes');
}         
     
public function insertSchema($schema,$seccion,$subseccion){
       $this->db->set('esquema', $schema);
       $this->db->set('seccion', $seccion);
       $this->db->set('subseccion', $subseccion);
       $this->db->insert('estructura');       
       if($this->db->affected_rows()>0){
        redirect(''.$config['base_url'].'administrador/CrudMenu');
       }
       else{
        redirect(''.$config['base_url'].'administrador/CrudMenu');
       }
}
public function checkSchema($dato){
      $this->db->where('id',$dato['id']);
      $query = $this->db->get('estructura');        
      if($query->num_rows() > 0 ){
        return $query->row();
      }
  }
public function updateSchema($id,$schema,$seccion,$subseccion,$medidas){
        $data = array('esquema' => $schema,                      
                      'seccion' => $seccion,
                      'subseccion' => $subseccion,
                      'medidas' => $medidas);

       $this->db->where('id', $id);
       $this->db->update('estructura', $data);
       if($this->db->affected_rows()>0){
        print "exito";
        redirect(''.$config['base_url'].'administrador/CrudMenu');
       }
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "fracaso";
       }
}
public function deleteSchema($id){
      $this->db->where('id', $id);      
      $query= $this->db->get('estructura');
      $data= $query->row();

      if (file_exists('img/'.$data->seccion.'/'.$data->imagen1)) {
      unlink('img/'.$data->seccion.'/'.$data->imagen1);
      }
      if (file_exists('img/'.$data->seccion.'/'.$data->imagen2)) {
      unlink('img/'.$data->seccion.'/'.$data->imagen2);
      }
      if (file_exists('img/'.$data->seccion.'/'.$data->imagen3)) {
      unlink('img/'.$data->seccion.'/'.$data->imagen3);
      }
      if (file_exists('img/'.$data->seccion.'/'.$data->imagen4)) {
      unlink('img/'.$data->seccion.'/'.$data->imagen4);
      }
      if (file_exists('img/'.$data->seccion.'/'.$data->imagen5)) {
      unlink('img/'.$data->seccion.'/'.$data->imagen5);
      }
      if (file_exists('img/'.$data->seccion.'/'.$data->imagen6)) {
      unlink('img/'.$data->seccion.'/'.$data->imagen6);
      }
      $this->db->where('id', $id);
      $this->db->delete('estructura');
      //$this->db->where('subseccion', $seccion);
      //$this->db->delete('estructura');
     
          $previousPage = $this->session->userdata('previousPage');    
          //redirect(''.$previousPage,'refresh');
    }

public function checkSeccions($dato){
      $this->db->where('seccion',$dato['seccion']);
      $query = $this->db->get('estructura');        
      if($query->num_rows() > 0 ){
        return $query->row();
      }
  }
public function update($data){
       $this->db->where('id', $data['id']);     
       
       if($this->db->update('estructura', $data)){            
           $previousPage = $this->session->userdata('previousPage');
           //print_r($data);          
           redirect(''.$previousPage,'refresh');   
       }      
          
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
}
        /*
        $update = array('orden' => $data['orden'],
                        'titulo' => $data['titulo'],
                        'subtitulo1' => $data['subtitulo1'],
                        'subtitulo2' => $data['subtitulo2'],
                        'subtitulo3' => $data['subtitulo3'],
                        'subtitulo4' => $data['subtitulo4'],
                        'subtitulo5' => $data['subtitulo5'],
                        'subtitulo6' => $data['subtitulo6'],
                        'parrafo1' => $data['parrafo1'],
                        'parrafo2' => $data['parrafo2'],
                        'parrafo3' => $data['parrafo3'],
                        'parrafo4' => $data['parrafo4'],
                        'parrafo5' => $data['parrafo5'],
                        'parrafo6' => $data['parrafo6'],
                        'imagen1' => $data['imagen1'],
                        'imagen2' => $data['imagen2'],
                        'imagen3' => $data['imagen3'],
                        'imagen4' => $data['imagen4'],
                        'imagen5' => $data['imagen5'],
                        'imagen6' => $data['imagen6'],
                        'meta1' => $data['meta1'],
                        'meta2' => $data['meta2'],
                        'meta3' => $data['meta3'],
                        'meta4' => $data['meta4'],
                        'meta5' => $data['meta5'],
                        'meta6' => $data['meta6'],
                        'link1' => $data['link1'],
                        'link2' => $data['link2'],
                        'link3' => $data['link3'],
                        'link4' => $data['link4'],
                        'link5' => $data['link5'],
                        'link6' => $data['link6']);

        */
  public function insertSubSeccion($data){    
       if($this->db->insert('estructura', $data)){

           $previousPage = $this->session->userdata('previousPage');          
           redirect(''.$previousPage,'refresh');   
       }
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
  }



/*   --------------------------------------------   CRUD Gallery   ---------------------------------------                */          

public function checkGallery($data){
      $this->db->where('id',$data['id']);
      $query = $this->db->get('galeria');        
        if($query->num_rows() > 0 ){
         return $query->row();
      }
}
public function insertGallery($data){
     if($this->db->insert('galeria', $data)){
        //print_r($this->session->userdata('previousGallery'));
        $previousPage = $this->session->userdata('previousGallery');        
        redirect(''.$previousPage,'refresh');     
       }
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
  
}
 public function updateGallery($data){
       $this->db->where('id', $data['id']);     
       
       if($this->db->update('galeria', $data)){
       $previousPage = $this->session->userdata('previousGallery');
       redirect(''.$previousPage,'refresh');    
       }      
          
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
  }
  public function deleteGallery($data){
      $this->db->where('id', $data['id']);
      $query = $this->db->get('galeria');
      $dataG= $query->row();
      $this->db->where('id', $data['id']);
      $this->db->delete('galeria');

      unlink('img/galeria/'.$dataG->imagen);
       $previousPage = $this->session->userdata('previousGallery');
       redirect(''.$previousPage,'refresh');     
    }
/*
----------------------------------------------------------------------------------------TROPHY
*/
public function insertCategory($data){
     if($this->db->insert('categorias', $data)){
        //print_r($this->session->userdata('previousGallery'));
        $previousPage = $this->session->userdata('previousPage');        
        redirect(''.$previousPage,'refresh');     
       }
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
  
}
public function checkCategory($dato){
      $this->db->where('id',$dato['id']);
      $query = $this->db->get('categorias');        
      if($query->num_rows() > 0 ){
        return $query->row();
      }
  }
public function updateCategory($data){
       $this->db->where('id', $data['id']);     
       
       if($this->db->update('categorias', $data)){            
           $previousPage = $this->session->userdata('previousPage');     
           //print_r($data);
           redirect(''.$previousPage,'refresh');   
       }      
          
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
}

public function deleteCategory($id){
      $this->db->where('id', $id);      
      $query= $this->db->get('categorias');
      $data= $query->row();

      if (!empty($data->imagen) && file_exists('img/categorias/'.$data->imagen)) {
      unlink('img/categorias/'.$data->imagen);
      }

      $this->db->where('categoriaId', $id);      
      $query= $this->db->get('subcategorias');
      foreach ($query->result() as $row){
        if (!empty($data->imagen) && file_exists('img/subcategorias/'.$row->imagen)) {
        unlink('img/subcategorias/'.$row->imagen);
        }

      }
      $this->db->where('categoriaId', $id);      
      $query= $this->db->get('productos');
      foreach ($query->result() as $row){
        if (!empty($data->imagen) && file_exists('img/productos/'.$row->imagen)) {
        unlink('img/productos/'.$row->imagen);
        }

      }
      

      $this->db->where('categoriaId', $id);
      $this->db->delete('subcategorias');

      $this->db->where('categoriaId', $id);
      $this->db->delete('productos');

      $this->db->where('id', $id);
      $this->db->delete('categorias');
      //$this->db->where('subseccion', $seccion);
      //$this->db->delete('estructura');
     
      $previousPage = $this->session->userdata('previousPage');    
     // redirect(''.$previousPage,'refresh');
    }



public function insertSubCategory($data){
     if($this->db->insert('subcategorias', $data)){
        //print_r($this->session->userdata('previousGallery'));
        $previousPage = $this->session->userdata('previousPage');        
        redirect(''.$previousPage,'refresh');     
       }
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
  
}
public function checkSubCategory($dato){
      $this->db->where('id',$dato['id']);
      $query = $this->db->get('subcategorias');        
      if($query->num_rows() > 0 ){
        return $query->row();
      }
  }

public function updateSubCategory($data){
       $this->db->where('id', $data['id']);     
       
       if($this->db->update('subcategorias', $data)){            
           $previousPage = $this->session->userdata('previousPage');     
           //print_r($data);
           redirect(''.$previousPage,'refresh');   
       }      
          
       else{
        //redirect(''.$config['base_url'].'administrador/CrudMenu');
        print "Fracaso";
       }
}
public function deleteSubCategory($id){
      $this->db->where('id', $id);      
      $query= $this->db->get('subcategorias');
      $data= $query->row();

      if (!empty($data->imagen) && file_exists('img/subcategorias/'.$data->imagen)) {
      unlink('img/subcategorias/'.$data->imagen);
      }
     $this->db->where('subcategoriaId', $id);      
      $query= $this->db->get('productos');
      foreach ($query->result() as $row){
        if (!empty($data->imagen) && file_exists('img/productos/'.$row->imagen)) {
        unlink('img/productos/'.$row->imagen);
        }

      }
      $this->db->where('subcategoriaId', $id);
      $this->db->delete('productos');

      $this->db->where('id', $id);
      $this->db->delete('subcategorias');
      //$this->db->where('subseccion', $seccion);
      //$this->db->delete('estructura');
     
      $previousPage = $this->session->userdata('previousPage');    
      //redirect(''.$previousPage,'refresh');
    }







/*   --------------------------------------------   OLDS   ---------------------------------------                */      
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
      error_reporting(E_ALL ^ E_NOTICE);
       redirect('administrador/menu_bolsa_vacantes2/'.$idPadre.'/'.$seccion,'refresh');
    }
}

?>