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

	   function insert(){

      var password= $("#contrasena").value
      var passwordRepeat= $("#contrasenaRepeat").value
      if(password==passwordRepeat){
      insertUser();
      }
      else{
        alert("Contraseñas no coinciden");
      }
    }

    function insertUser(){
      $.ajax({
      url:'<?php print base_url();?>Functions/insertUser',
      type: 'POST',
      async: true,
      data: $("#insertForm").serialize(),
      success: function(data){
        //location.href='Admin.php';
      }
    });
    }
  });

	</script>

    

  

</head>
<body> 
 	<?php $this->load->view('frontend/structure/header')?>
	<div class="row">	
	     <div class="card col l12 m10 s12 offset-l0 offset-m1 offset-s0">
	     	<div class="card-action col l12 s12 blue-grey darken-5 white-text text-white">
	     		<h5 class="center col l6 m6 s12">	Administrador</h5>
	     		<a href="#insertUserModal" class="btn-floating waves-effect waves-light red modal-trigger"><i class="material-icons right">add</i></a>
	     	</div>
	     	<div class="card-content ">
	     		<table class=' col l12 m12 s12 responsive-table'>
			        <thead>
			          <tr>
			              <th data-field='usuario'>Nombre</th>
			              <th data-field='apellidos'>Apellidos</th>
			              <th data-field='rfc'>No. de Cuenta</th>
			              <th data-field='ocupacion'>Ocupación</th>
			              <th data-field='area'>Área</th>
			              <th data-field='permisos'>Permisos</th>
			              <th></th>

			          </tr>			         
        			</thead>
        			<tbody>
        				<tr>
            				<td>Luis</td>
            				<td>Alberto Martínez</td>
            				<td>413046912</td>
            				<td>Estudiante</td>
            				<td>Química</td>
            				<td>2</td>
            				<td></td>
            				<td>            					
            					<a id="#" class="modal-trigger" href='#editUserModal'  onclick=''>
                					<i class='tiny material-icons black-text'>mode_edit</i>
                				</a>
                			</td>
                			<td>
            					<a id="#" class="modal-trigger" href='#deleteUserModal'  onclick=''>
                					<i class='tiny material-icons black-text'>delete</i>
                				</a>
                			</td>
            			</tr>
            			<tr>
            				<td>Deivid</td>
            				<td>Silvia López</td>
            				<td>413046452</td>
            				<td>Profesor</td>
            				<td>Química</td>
            				<td>4</td>
            				<td></td>
            				<td>            					            					            			
            					<a id="#" class="modal-trigger" href='#editUserModal'  onclick=''>
                					<i class='tiny material-icons black-text'>mode_edit</i>
                				</a>
                			</td>
                			<td>
            					<a id="#" class="modal-trigger" href='#deleteUserModal'  onclick=''>
                					<i class='tiny material-icons black-text'>delete</i>
                				</a>
                			</td>
            			</tr>
        			</tbody>
        		</table>
	     	</div>
				  
			<div class="card-action col l12 s12">
	              <a href="<?php print base_url();?>ChemicalQuery/Inicio">Volver</a>
	        </div>
	   	 	
	  	</div>
  </div>


  <div id='editUserModal' class="modal card col l4">
        <div class='modal-content col l12'>
          <h4 class='black-text center flow-text'>Editar Usuario</h4>          
            <div class='row'>
	              <form class='col l12 s12'>
	                <div class='row'>
		                  <div class='input-field col s12'>
		                    <input id='nameInput' type='text' class='validate black-text'>
		                    <label for='nameInput'>Nombre</label>	                 
	              	</div>
	              	 <div class='row'>	                  
		                  <div class='input-field col s12'>
		                    <input id='lastNameInput' type='text' class='validate black-text'>
		                    <label for='lastNameInput'>Apellidos</label>
		                  </div>
		                
	              	</div>
	            	<div class='row'>
		              <div class='input-field col s12'>
		                  <input id='rfcInput' type='text' class='validate black-text'>
		                  <label for='rfcInput'>Rfc</label>
		              </div>
	            	</div>
	           		<div class='row'>
		              <div class='input-field col s12'>
		                  <input id='ocupationInput' type='text' class='validateblack-text'>
		                  <label for='ocupationInput'>Ocupación</label>
		              </div>
	           		</div>
	            	<div class='row'>
		              <div class='input-field col s12'>
		                  <input id='areaInput' type='text' class='validate black-text'>
		                  <label for='areaInput'>Área</label>
		              </div>
	            	</div>
	            	<div class='row'>
		              <div class='input-field col s12'>
		                  <input id='permisosInput' type='number' min='0' max='2' class='validate black-text'>
		                  <label for='permisosInput'>Permisos</label>
		              </div>
	            	</div>
	            	<div class='row'>
		              <div class='input-field col s12'>
		                  <input id='passwordInput' type='password' class='validate black-text'>
		                  <label for='passwordInput'>Password</label>
		              </div>
	            	</div>
	        	</form>
      		</div>
    	</div>
    </div>
    <div class='modal-footer'>
      <a href='#!' class='modal-action modal-close waves-effect waves-green btn-flat green darken-4 white-text ''>Enviar</a>
      <a href='<?php print base_url();?>'' class='modal-action modal-close waves-effect waves-red btn-flat' data-dismiss='modal'>Volver</a>
    </div>
  </div>

  
 <div id='deleteUserModal' class="modal card col l4">
    <div class='modal-content'>
      <h4 class='black-text flow-text'>Eliminar Usuario</h4>
      <p class='black-text '>¿Estás seguro de que quieres eliminar este usuario??</p>
    </div>
    <div class='modal-footer'>
      <a href='#!' class='modal-action modal-close waves-effect btn-flat red darken-4 white-text' onclick='deleteFunction();'>Eliminar</a>
      <a href='#!' class='modal-action modal-close waves-effect waves-red btn-flat' data-dismiss='modal'>Cerrar</a>
    </div>
  </div>

  <div id='insertUserModal' class='col l6 modal modal-fixed-footer'>
        <div class='modal-content'>
          <h4 class='black-text flow-text'>Insertar Usuario</h4>          
            <div class='row'>
              <form class='col l12 m12 s12' id='insertForm' method='POST' action='<?php print base_url();?>Functions/InsertUser.php'>
                <div class='row'>
                  <div class='input-field col l6 m6 s12'>
                    <input id='nameInput' name='nombre' type='text' class='validate black-text' required>
                    <label for='nameInput'>Nombre</label>
                  </div>
                  <div class='input-field col l6 m6 s12'>
                    <input id='lastNameInput' name='apellidos' type='text' class='validate black-text' required>
                    <label for='lastNameInput'>Apellidos</label>
                </div>
                   <div class='input-field col l6 m6 s12'>
                    <input id='nameInput' name='nombreUsuario' type='text' class='validate black-text' required>
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
                  <input name="tipoCuenta" type="radio" id="radio2" />
                  <label for="radio2" value="Profesor">Profesor</label>
                  
              </div>
            </div>
            <!--<div class='row'>
              <div class='input-field col s12'>
                  <input id='areaInput' name='areaValue' type='text' class='validate black-text' required>
                  <label for='areaInput'>Área</label>
              </div>-->
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='permisosInput' name='permisos' type='number' min='0' max='2' class='validate black-text' required maxlength="4">
                  <label for='permisosInput'>Permisos</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='passwordInput' name='contrasena' type='password' class='validate black-text' required>
                  <label for='passwordInput'>Password</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='passwordInputRepeat' name='contrasenaRepeat' type='password' class='validate black-text' required>
                  <label for='passwordInputRepeat'>Repite el Password</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input type="submit" onclick="insert();" class='waves-effect waves-green btn-flat green darken-4 white-text ''>
                <a href="#!" class='modal-action modal-close waves-effect waves-red btn-flat red darken-4 white-text ''>Cerrar</a>
              </div>                
            </div>
        </form>
      </div>
    </div>
    
  </div>


        
</body>
</html>