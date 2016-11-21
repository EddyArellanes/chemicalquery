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
	     
  });

	</script>

    

  

</head>
<body> 
 	<?php $this->load->view('frontend/structure/header')?>
	<div class="row">	
	     <div class="card col l10 m10 s12 offset-l1 offset-m1 offset-s0">
	     	<div class="card-action col l12 s12 blue-grey darken-5 white-text text-white">
	     		<h5 class="center">	Bienvenido!</h5>	     		
          <p>Navega por el sitio en busca de los productos de Ingeniería en Alimentos que te interesan, si tienes alguna duda o sugerencias, no lo pienses dos veces y pasa a nuestra sección de contacto.</p>
	     	</div>
	     	<div class="card-content ">
	     		
	     	</div>
				  
			<div class="card-action col l12 s12">
	           
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
      <a href='#!' class='modal-action modal-close waves-effect waves-red btn-flat' data-dismiss='modal'>Cerrar</a>
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
              <form class='col l9 s12' id='insertForm' method='POST' action='php/InsertFunction.php'>
                <div class='row'>
                  <div class='input-field col s6'>
                    <input id='nameInput' name='nameValue' type='text' class='validate black-text' required>
                    <label for='nameInput'>Nombre</label>
                  </div>
                  <div class='input-field col s6'>
                    <input id='lastNameInput' name='lastNameValue' type='text' class='validate black-text' required>
                    <label for='lastNameInput'>Apellidos</label>
                </div>
              </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='rfcInput' name='rfcValue' type='text' class='validate black-text' required>
                  <label for='rfcInput'>Rfc</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='ocupationInput' name='occupationValue' type='text' class='validate black-text' required>
                  <label for='ocupationInput'>Ocupación</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='areaInput' name='areaValue' type='text' class='validate black-text' required>
                  <label for='areaInput'>Área</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='permisosInput' name='permissionsValue' type='number' min='0' max='2' class='validate black-text' required>
                  <label for='permisosInput'>Permisos</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='passwordInput' name='newPasswordValue' type='password' class='validate black-text' required>
                  <label for='passwordInput'>Password</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <input id='passwordInputRepeat' name='newPasswordRepeatValue' type='password' class='validate black-text' required>
                  <label for='passwordInputRepeat'>Repite el Password</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <a href='#!' class='modal-action modal-close waves-effect waves-green btn-flat green darken-4 white-text ''>Enviar</a>
              </div>                
            </div>
        </form>
      </div>
    </div>
    <div class='modal-footer'>
      <a href='#' class='modal-action modal-close waves-effect waves-red btn-flat' data-dismiss='modal'>Cerrar</a>
      
    </div>
  </div>


        
</body>
</html>