<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loginModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function login($datos){
		$this->load->library('Password');
        $this->load->database('default', TRUE);

        $this->db->where('usuario',$datos['usuario']);
        $query_user = $this->db->get('usuarios');
        foreach ($query_user->result() as $row){
        	       $id = $row->id;
        	       $contrasena = $row->contrasena;
                   $permisos= $row->permisos;
        }

        if($query_user->num_rows()>0){
        	if($this->password->is_valid_password($datos['contrasena'], $contrasena)){
        		$usuario_data = array('idUser' => $id,
                                   'permisos'=>$permisos,
                                  'logueado' => TRUE);
				$this->session->set_userdata($usuario_data);

                
                redirect('ChemicalQuery/Inicio','refresh');
        	} else {
        		print "<script type=\"text/javascript\">alert('Contraseña Incorrecta');</script>";
        	}
        } else {
        	print "<script type=\"text/javascript\">alert('Usuario Incorrecto');</script>";
        }
	}

}

?>