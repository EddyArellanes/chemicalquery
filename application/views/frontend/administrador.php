<!DOCTYPE html>
<html>
<head>
	<title>Chemical Query</title>
	<meta charset="utf8">
	
  <?php $this->load->view('frontend/structure/head')?>
	<!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" -->

	<script>
		
		 $(document).ready(function(){
	    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	     $('.modal-trigger').leanModal();
       $('select').material_select(); 

	  
  });

	</script>

    

  

</head>
<body> 
 	<?php $this->load->view('frontend/structure/header')?>
  <?php $this->load->view('frontend/structure/mensajeConfirmacion')?>
	<div class="row">	
	     <div class="card col l12 m10 s12 offset-l0 offset-m1 offset-s0">
	     	<div class="card-action col l12 s12 blue-grey darken-5 white-text text-white">
	     		<h5 class="center col l6 m6 s12">	Administrador</h5>
	     		<a href="#insertUserModal" class="btn-floating waves-effect waves-light red modal-trigger"><i class="material-icons right">add</i></a>
          <div class="row">
            <div class="col l12 offset-l0 m12 offset-m0 s12 offset-s0">
              <a href="<?php print base_url();?>ChemicalQuery/Mensajes" ><button class="btn-large blue darken-5 waves-effect waves-blue">Mensajes:<!--<span style="position:inherit;left:3%" class="new badge"><?php print $messagesNotSeen?></span>--><b class="green darken-4"><?php print $messagesNotSeen?></b> nuevos</button></a>
            </div>
	     	</div>
       
        </div>
	     	<div class="card-content ">
	     		<table class=' col l12 m12 s12 responsive-table'>
			        <thead>
			          <tr>
			              <th data-field='usuario'>Nombre</th>
			              <th data-field='apellidos'>Apellidos</th>
                    <th data-field='usuario'>Usuario</th>
			              <th data-field='rfc'>No. de Cuenta</th>
			              <th data-field='ocupacion'>Ocupación</th>			              
			              <th data-field='permisos'>Permisos</th>
			              <th></th>

			          </tr>			         
        			</thead>
        			<tbody>
              <?php 
              $this->db->order_by('nombre','asc');
              $query=$this->db->get('usuarios');
              foreach ($query->result() as $row) {?>                              
                  <tr>
                    <td><?php print $row->nombre?></td>
                    <td><?php print $row->apellidos?></td>
                    <td><?php print $row->usuario?></td>
                    <td><?php print $row->numeroCuenta?></td>
                    <td><?php print $row->tipoCuenta?></td>
                    <!--Permisos-->
                    <td>
                    <?php if($row->permisos=="0"){?>
                      Usuario
                    <?php }else if($row->permisos=="1"){?>
                      Supervisor
                    <?php }else{?>
                      Administrador
                    <?php }?>
                      
                    </td>                    
                    <td></td>
                    <td>                      
                      <a id="<?php print $row->id?>" class="modal-trigger" href='#editUserModal'  onclick='check($(this).attr("id"))'>
                          <i class='tiny material-icons black-text'>mode_edit</i>
                        </a>
                      </td>
                      <td>
                      <a id="<?php print $row->id?>" class="" href='#deleteUserModal'  onclick='deleteUser($(this).attr("id"))'>
                          <i class='tiny material-icons black-text'>delete</i>
                        </a>
                      </td>
                  </tr>
              
        				
            			<?php }?>
        			</tbody>
        		</table>
	     	</div>
				  
			<div class="card-action col l12 s12">
	              <a href="<?php print base_url();?>ChemicalQuery/Inicio">Volver</a>
	        </div>
	   	 	
	  	</div>
  </div>


  <div id='insertUserModal' class='col l6 modal modal-fixed-footer'>
        <div class='modal-content'>
          <h4 class='black-text flow-text'>Insertar Usuario</h4>          
            <div class='row'>
                  <form class='col l12 m12 s12' id='insertForm' method="POST" onsubmit="return false" action="return false"  enctype="multipart/form-data">
                  <!--<form class='col l12 m12 s12' id='insertForm' method="POST" action="<?php print base_url();?>Functions/insertUser"  enctype="multipart/form-data">-->
                    <div class='row'>
                      <div class='input-field col l6 m6 s12'>
                        <input id='nameInput' name='nombre' type='text' class='validate black-text' required>
                        <label for='nameInput'>Nombre</label>
                      </div>
                      <div class='input-field col l6 m6 s12'>
                        <input id='lastNameInput' name='apellidos' type='text' class='validate black-text'>
                        <label for='lastNameInput'>Apellidos</label>
                    </div>
                       <div class='input-field col l6 m6 s12'>
                        <input id='nameInput' name='usuario' type='text' class='validate black-text' required>
                        <label for='nameInput'>Nombre de Usuario</label>
                      </div>
                      
                  </div>
                <div class='row'>
                  <div class='input-field col l6 m6 s12'>
                      <input id='rfcInput' name='numeroCuenta' type='number' class='validate black-text' required>
                      <label for='rfcInput'>Número de Cuenta</label>
                  </div>
                </div>
                <div class='row'>
                  <div class='col l6 m6 s12'>
                      <label for='ocupationInput'>Ocupación</label><br>
                      <input name="tipoCuenta" value="Estudiante" type="radio" id="radio1" />
                      <label for="radio1">Estudiante</label>
                      <input name="tipoCuenta"  value="Profesor" type="radio" id="radio2" />
                      <label for="radio2">Profesor</label>
                      
                  </div>
                </div>
                <!--<div class='row'>
                  <div class='input-field col s12'>
                      <input id='areaInput' name='areaValue' type='text' class='validate black-text' required>
                      <label for='areaInput'>Área</label>
                  </div>-->
                </div>
               <!-- <div class='row'>
                  <div class='input-field col s12'>
                      <input id='permisosInput' name='permisos' type='number' min='0' max='2' class='validate black-text' required maxlength="4">
                      <label for='permisosInput'>Permisos</label>
                  </div>
                </div>-->

                <div class="input-field col s12">
                  <select class="browser-default"  name="permisos">
                    <option value="" disabled selected>Permisos</option>
                    <option value="2">Administrador</option>
                    <option value="1">Supervisor</option>
                    <option value="0">Usuario</option>
                  </select>
                  
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                      <input id='contrasena' name='contrasena' type='password' class='validate black-text' required>
                      <label for='contrasenaInput'>Contraseña</label>
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                      <input id='contrasenaRepeat' name='contrasenaRepeat' type='password' class='validate black-text' required>
                      <label for='passwordInputRepeat'>Repite contraseña</label>
                  </div>
                </div>
                 <div class='row'>
                   <label class="black-text">Agregar Imagen</label>
                   <div class="file-field input-field col s12">                 
                      <div class="btn">
                        <span>File</span>
                        <input id="imagen" type="file" name="imagen">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" name="imagen" type="text">
                    </div>
                   </div>
                  </div>          
                <div class='row'>
                  <div class='input-field col s12'>
                    <button id="checkPasswordsInsert" class='waves-effect waves-green btn-flat green darken-4 white-text ''>Insertar</button>
                    <a href="#!" class='modal-action modal-close waves-effect waves-red btn-flat red darken-4 white-text ''>Cerrar</a>
                    <br>
                    
                  </div>  
                  <div class='input-field col s12'>              
                   <a id="errorContrasena" style="display:none;" class='waves-effect waves-red btn red darken-4 white-text '>Contraseñas no coinciden</a>
                  </div>
                </div>
        </form>
      </div>
    </div>
    </div>
  </div>

  <div id='editUserModal' class='col l6 modal modal-fixed-footer'>
        <div class='modal-content'>
          <h4 class='black-text flow-text' id="usuarioTitle">Editar Usuario: </h4>          
            <div class='row'>
                <form class='col l12 m12 s12' id='editForm' method="POST" onsubmit="return false" action="return false"  enctype="multipart/form-data">
                 <!--<form class='col l12 m12 s12' id='insertForm' method="POST" action="<?php print base_url();?>Functions/editUser">-->
                 <input type="hidden" name="imagenOld" id="imagenOld" value="">
                    <div class='row'>
                      <input type="hidden" id="idEdit" name="id" value="">
                      <div class='input-field col l6 m6 s12'>
                        <input id='nombreEdit' placeholder="Nombre" value="" name='nombre' type='text' class='validate black-text' required>
                        <label for='nombreEdit'>Nombre</label>
                      </div>
                      <div class='input-field col l6 m6 s12'>
                        <input id='apellidosEdit'  placeholder="Apellidos" value="" name='apellidos' type='text' class='validate black-text'>
                        <label for='apellidosEdit'>Apellidos</label>
                    </div>
                       <div class='input-field col l6 m6 s12'>
                        <input id='usuarioEdit'  placeholder="Nombre de Usuario" value="" name='usuario' type='text' class='validate black-text' required>
                        <label for='usuarioEdit'>Nombre de Usuario</label>
                      </div>
                      
                  </div>
                <div class='row'>
                  <div class='input-field col l6 m6 s12'>
                      <input id='numeroCuentaEdit' value="" placeholder="Número de Cuenta"  name='numeroCuenta' type='number' class='validate black-text' required>
                      <label for='numeroCuentaEdit'>Número de Cuenta</label>
                  </div>
                </div>
                <div class='row'>
                  <div class='col l6 m6 s12'>
                      <label for='ocupationInput'>Ocupación</label><br>
                      <input name="tipoCuenta" value="Estudiante" type="radio" id="radio1Edit" />
                      <label for="radio1Edit">Estudiante</label>
                      <input name="tipoCuenta" value="Profesor" type="radio" id="radio2Edit" />
                      <label for="radio2Edit">Profesor</label>
                      
                  </div>
                </div>
                <!--<div class='row'>
                  <div class='input-field col s12'>
                      <input id='areaInput' name='areaValue' type='text' class='validate black-text' required>
                      <label for='areaInput'>Área</label>
                  </div>-->
                </div>
                <!--<div class='row'>
                  <div class='input-field col s12'>
                      <input id='permisosEdit'  placeholder="Permisos"  name='permisos' type='number' min='0' max='2' class='validate black-text' required maxlength="4">
                      <label for='permisosEdit'>Permisos</label>
                  </div>
                </div>-->
                <div class="row">
                 <div class="input-field col s12">
                  <select class="browser-default"  name="permisos">
                    <option value="" disabled selected>Permisos</option>
                    <option value="2">Administrador</option>
                    <option value="1">Supervisor</option>
                    <option value="0">Usuario</option>
                  </select>
                  
                </div>
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                      <input id='contrasenaEdit'  placeholder="Contraseña"  name='contrasena' type='password' class='validate black-text'>
                      <label for='contrasenaEdit'>Nueva Contraseña</label>
                  </div>
                </div>
                <div class='row'>
                   <label class="black-text">Agregar Imagen</label>
                   <div class="file-field input-field col s12">                 
                      <img class="responsive-img" id="imagenEdit" src="" alt="">   
                      <div class="btn">
                        <span>File</span>
                        <input id="imagenEdit" type="file" name="imagen">
                      </div>
                      <div class="file-path-wrapper">
                        <input id="imagenText" class="file-path validate" name="imagen" type="text">
                    </div>
                   </div>
                  </div>                          
                <div class='row'>
                  <div class='input-field col s12'>
                    <button id="checkPasswordsEdit" class='waves-effect waves-green btn-flat green darken-4 white-text'>Guardar</button>
                    <a href="#!" class='modal-action modal-close waves-effect waves-red btn-flat red darken-4 white-text ''>Cerrar</a>
                    <br>
                    
                  </div>  
                  <div class='input-field col s12'>              
                   <a id="errorContrasenaEdit" style="display:none;" class='waves-effect waves-red btn red darken-4 white-text '>Contraseñas no coinciden</a>
                  </div>
                </div>
        </form>
      </div>
    </div>
    </div>
  </div>


  <div id='deleteUserModal' class="modal card col l4">
    <div class='modal-content'>
      <h4 class='black-text flow-text'>Eliminar Usuario</h4>
      <p class='black-text '>¿Estás seguro de que quieres eliminar este usuario??</p>
    </div>
    <div class='modal-footer'>
      <a href='#!' class='modal-action modal-close waves-effect btn-flat red darken-4 white-text'>Eliminar</a>
      <a href='#!' class='modal-action modal-close waves-effect waves-red btn-flat' data-dismiss='modal'>Cerrar</a>
    </div>
  </div>

  <div id='messages' class="modal card col l4">    
    <div class='modal-content'>
    <h4 class='black-text flow-text'>Mensajes</h4>     
      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header"><i class="material-icons">email</i>Eddy<span style="position:inherit;left:6%;font-size: 0.7rem" class="new badge"></span>
             <a href="#"><i  style="float:right" class="material-icons black-text">delete</i></a>       
          </div>
          <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
       </li>      
      </ul>

    </div>
    <div class='modal-footer'>      
      <a href='#!' class='modal-action modal-close waves-effect waves-red btn-flat' data-dismiss='modal'>Cerrar</a>
    </div>
  </div>
<script>
  $( "#checkPasswordsInsert" ).click(function() {    
      if($("#usuario").val()!="" && $("#nombre").val()!="" && $("#numeroCuenta").val()!="" && $("#contrasena").val()!="" && $("#permisos").val()!=""){
        if($("#contrasena").val()==$("#contrasenaRepeat").val()){
        
          insertUser();   
        }
        else{
           $('#errorContrasena').text('Las contraseñas no coinciden');    
        }


      }
      else{
           $('#errorContrasena').text('Llena todos los campos');    
           $("#errorContrasena").css("display", "block");
      }
          //alert("Contraseñas No coinciden");
          
        
  }); 
  $( "#checkPasswordsEdit" ).click(function() {
     if($("#usuarioEdit").val()!="" && $("#nombreEdit").val()!="" && $("#numeroCuentaEdit").val()!=""  && $("#permisos").val()!=""){            
      editUser();
      }
      else{
           $('#errorContrasenaEdit').text('Llena todos los campos');    
           $("#errorContrasenaEdit").css("display", "block");
      }

      
  }); 
 
  function insertUser(){
       /*Para agregar el file ya que Ajax por seguridad no permite tomar archivos
        XMLHttpRequest level 2 does support AJAX submittal of file inputs.*/
       var formData = new FormData($('#insertForm')[0]);
       formData.append('imagen', $('input[type=file]')[0].files[0]); 
       /*Petición Ajax*/
        $.ajax({
        url:"<?php print base_url();?>"+"Functions/insertUser",
        processData: false,
        contentType: false,
        type: 'POST',
        async: true,
        data:formData,
        success: function(json){        
          try{        
              var obj = jQuery.parseJSON(json);            

              if(obj['mensaje1']=="Hecho"){                       
              alert("Usuario Agregado con éxito");     
                setTimeout(function(){ location.reload();}, 1500);
              }
              else{
              console.log(obj['mensaje1']);              
              $('#errorContrasena').text(obj['mensaje1']);    
              $("#errorContrasena").css("display", "block");
              //$('#errorContrasena').text("Error");    
              }
          }
          catch(e) {     
            
             setTimeout(function(){ window.location="<?php print base_url();?>Functions/refreshFunction/"}, 1500);
          }       
         
          //$("#errorContrasena").html(data);
        }
      });
    }
   function check(id){
       $.ajax({
        url:"<?php print base_url();?>"+"Functions/checkUser/"+id,
        type: 'POST',
        async: true,        
        success: function(json){ 
          var obj = jQuery.parseJSON(json);
          //alert(obj['id']); 
          $("#idEdit").attr('value',obj['id']);
          $("#nombreEdit").attr('value',obj['nombre']);      
          $("#usuarioTitle").text("Editar Usuario: "+obj['usuario']);       
          $("#apellidosEdit").attr('value',obj['apellidos']);
          $("#usuarioEdit").attr('value',obj['usuario']);
          $("#numeroCuentaEdit").attr('value',obj['numeroCuenta']);
          $("#imagenEdit").attr('src','<?php print base_url();?>img/usuarios/'+obj['imagen']);
          $("#imagenEdit").attr('alt',obj['imagen']);
          $("#imagenText").attr('value',obj['imagen']);      
          $("#imagenOld").attr('value',obj['imagen']); 
          if(obj['tipoCuenta']=="Estudiante"){
            $("#radio1Edit").attr('checked',"");
          }
          else{
           $("#radio2Edit").attr('checked',""); 
          }
         
          $("#permisosEdit").attr('value',obj['permisos']);     
          /*
          if(obj['permisos']=="0"){
            permisos="Usuario";
          }
          if(obj['permisos']=="1"){
            permisos="Supervisor";
          }
          if(obj['permisos']=="2"){
            permisos="Administrador";
          }
          $("#permisosEdit").text(permisos);*/
          
          
          //$("#editUserModal").html(obj["nombre"]);
          //$("#editUserModal").html(obj["nombre"]);
           }
         });
     }  
  
   function editUser(){
       /*Para agregar el file ya que Ajax por seguridad no permite tomar archivos
       XMLHttpRequest level 2 does support AJAX submittal of file inputs.*/
       var formData = new FormData($('#editForm')[0]);
       formData.append('imagen', $('input[type=file]')[0].files[0]); 
       /*Petición Ajax*/
        $.ajax({
        url:"<?php print base_url();?>"+"Functions/editUser",
        processData: false,
        contentType: false,
        type: 'POST',
        async: true,
        data: formData,
        success: function(json){        
          try{        
              var obj = jQuery.parseJSON(json);                         
              if(obj['mensaje']=="Hecho"){  
               $('#editUserModal').modal('close');                   
                location.reload();
              }
              else{
              $("#errorContrasenaEdit").css("display", "block");
              $('#errorContrasenaEdit').text(obj['mensaje']);    
              //$('#errorContrasena').text("Error");    
              }


          }catch(e) {     
             $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                
                 setTimeout(function(){ window.location="<?php print base_url();?>Functions/refreshFunction/"}, 1500);
                 
            });
          }       
         
          //$("#errorContrasena").html(data);
        }
      });
    }
  function deleteUser(id){
       if(confirm("¿Deseas realmente eliminar este elemento?")){            
            window.location="<?php print base_url();?>Functions/deleteUser/"+id;
            
        }
        else{
            return false;
        }

  }
</script>
      
</body>
</html>