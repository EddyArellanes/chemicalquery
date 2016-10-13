<!DOCTYPE html>
<html>
<head>

	<?php $this->load->view('frontend/structure/head');?>


</head>
<body>
	<?php $this->load->view('frontend/structure/header');?>
 	<div class="row"></div>
	<div class="row">	
	     <div class="card col s12 l5 m8 offset-l3  offset-m2">
	     	<div class="card-header"><h5 class="center">Inicia Sesión</h5></div>
	     	<div class="card-content ">
			    <form method="post" action="<?php print base_url();?>Functions/login">
				      <div class="row">		      				      		
					        <div class="input-field col l12 m12 s12 ">
					          <i class="material-icons prefix">account_circle</i>			         
					          <input id="user" name="usuario" type="text" class="validate" required>
					          <label for="user">Usuario</label>
					        </div>	       
				      </div>
				     
				      <div class="row">
				        <div class="input-field col l12 m12 s12">
				         <i class="material-icons prefix">vpn_key</i>
				          <input id="password" name="contrasena" type="password" class="validate" required>
					      <label for="password">Password</label>
				        </div>
				      </div>
				      <div class="row">
				        <div class="input-field col s6">
				          <input id="send" type="submit" name="ingresar" class="btn blue darken-5" value="Iniciar Sesión">		          
				        </div>
				      </div>
			    </form>
		    <div class="card-action">
              <a href="#">Olvide mi password</a>
            </div>
	    </div>
	  	</div>
  </div>
        
</body>
</html>