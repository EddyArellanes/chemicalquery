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
 	
	<div class="row">	
	     <div class="card col s12 l12 m12 offset-0  offset-m0  offset-s0">
	     	<div class="card-action col l12 s12 teal darken-4 white-text text-white">
	     		  <h5 class="center col l4 m4 s12"> Productos</h5>
           <div class="input-field col l4 m4 s12">
            <select>
              <option>Categorías:</option>
              <option>Categoría 1</option>
              <option>Categoría 2</option>          
              <option>Categoría 3</option>
            </select>
            
          </div>
           <div class="input-field col l2 m12 s12">
            <i class="material-icons prefix">search</i>
            <input id="icon_prefix2" class="materialize-textarea">  
            <label for="icon_prefix2">Buscar</label>
          </div>
	     		<?php if($this->session->userdata('permisos')=='1' || $this->session->userdata('permisos')=='2'){?>
          <a href="#insertUserModal" class="btn-floating waves-effect waves-light red modal-trigger"><i class="material-icons right">add</i></a>
          <?php }?>
	     	</div>
	     	<div class="card-content ">
	     		<div class="row">
            <div class="col l4 s12 m12">
                  <div class="card">
                    <div class="card-image">
                      <img class="responsive-img" src="<?php print base_url();?>img/quimico.jpg">
                      <span class="card-title">Producto Químico
                        <?php if($this->session->userdata('permisos')=='1' || $this->session->userdata('permisos')=='2'){?>
                         <a id="#" class="modal-trigger" href='#editProduct'  onclick=''>
                              <i class='tiny material-icons white-text'>mode_edit</i>
                          </a>
                           <a id="#" class="modal-trigger" href='#deleteProduct'  onclick=''>
                              <i class='tiny material-icons white-text'>delete</i>
                           </a>
                        <?php }?>
                      </span>
                    </div>
                    <!--Collapsable-->
                     <ul class="collapsible" data-collapsible="accordion">
                      <li>
                        <div class="collapsible-header center"><i class="material-icons">info</i>Descripción</div>
                        <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                      </li>
                    </ul>
                    <!---->
                    <!--Tabs-->
                     <div >      
                      <h6 class="center">Propiedades</h6>
                     </div>  
                     <div class="mdl-tabs mdl-js-tabs">
                        <div class="mdl-tabs__tab-bar">
                           <a href="#tab1-panel" class="mdl-tabs__tab is-active">Físicas</a>
                           <a href="#tab2-panel" class="mdl-tabs__tab">Químicas</a>
                           <a href="#tab3-panel" class="mdl-tabs__tab">Termodinámicas</a>
                        </div>
                        <div class="mdl-tabs__panel is-active" id="tab1-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Peso: 1.7Kg</li>
                              <li class="collection-item">Textura: Gomosa</li>
                              <li class="collection-item">Color: Rojo</li>
                              <li class="collection-item">Medidas: 114x200</li>
                           </ul>
                        </div>
                        <div class="mdl-tabs__panel" id="tab2-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Peso Molecular: 0.123</li>
                              <li class="collection-item">Energia: 34e</li>
                              <li class="collection-item">Átomos: 14</li>
                              <li class="collection-item">Negatividad: 99</li>
                           </ul>
                        </div>
                        <div class="mdl-tabs__panel" id="tab3-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Yo no sé de eso joven :O</li>
                              
                              
                           </ul>
                        </div>
                    </div>
                    <!--Tabs-->
                    <div class="card-action">
                      
                    </div>
                  </div>
                </div>

              <div class="col l4 s12 m12">
                  <div class="card">
                    <div class="card-image">
                      <img class="responsive-img" src="<?php print base_url();?>img/quimico2.jpg">
                      <span class="card-title">Producto Químico
                        <?php if($this->session->userdata('permisos')=='1' || $this->session->userdata('permisos')=='2'){?>
                         <a id="#" class="modal-trigger" href='#editProduct'  onclick=''>
                              <i class='tiny material-icons white-text'>mode_edit</i>
                          </a>
                           <a id="#" class="modal-trigger" href='#deleteProduct'  onclick=''>
                              <i class='tiny material-icons white-text'>delete</i>
                           </a>
                        <?php }?>
                      </span>
                    </div>
                    <!--Collapsable-->
                     <ul class="collapsible" data-collapsible="accordion">
                      <li>
                        <div class="collapsible-header center"><i class="material-icons">info</i>Descripción</div>
                        <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                      </li>
                    </ul>
                    <!---->
                    <!--Tabs-->
                     <div >      
                      <h6 class="center">Propiedades</h6>
                     </div>  
                     <div class="mdl-tabs mdl-js-tabs">
                        <div class="mdl-tabs__tab-bar">
                           <a href="#tab1-panel" class="mdl-tabs__tab is-active">Físicas</a>
                           <a href="#tab2-panel" class="mdl-tabs__tab">Químicas</a>
                           <a href="#tab3-panel" class="mdl-tabs__tab">Termodinámicas</a>
                        </div>
                        <div class="mdl-tabs__panel is-active" id="tab1-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Peso: 1.7Kg</li>
                              <li class="collection-item">Textura: Gomosa</li>
                              <li class="collection-item">Color: Rojo</li>
                              <li class="collection-item">Medidas: 114x200</li>
                           </ul>
                        </div>
                        <div class="mdl-tabs__panel" id="tab2-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Peso Molecular: 0.123</li>
                              <li class="collection-item">Energia: 34e</li>
                              <li class="collection-item">Átomos: 14</li>
                              <li class="collection-item">Negatividad: 99</li>
                           </ul>
                        </div>
                        <div class="mdl-tabs__panel" id="tab3-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Yo no sé de eso joven :O</li>
                              
                              
                           </ul>
                        </div>
                    </div>
                    <!--Tabs-->
                   
                      
                   
                    <div class="card-action">
                      
                    </div>
                  </div>
                </div>

                <div class="col l4 s12 m12">
                  <div class="card">
                    <div class="card-image">
                      <img class="responsive-img" src="<?php print base_url();?>img/quimico.jpg">
                      <span class="card-title">Producto Químico
                        <?php if($this->session->userdata('permisos')=='1' || $this->session->userdata('permisos')=='2'){?>
                         <a id="#" class="modal-trigger" href='#editProduct'  onclick=''>
                              <i class='tiny material-icons white-text'>mode_edit</i>
                          </a>
                           <a id="#" class="modal-trigger" href='#deleteProduct'  onclick=''>
                              <i class='tiny material-icons white-text'>delete</i>
                           </a>
                        <?php }?>
                      </span>
                    </div>
                    <!--Collapsable-->
                     <ul class="collapsible" data-collapsible="accordion">
                      <li>
                        <div class="collapsible-header center"><i class="material-icons">info</i>Descripción</div>
                        <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                      </li>
                    </ul>
                    <!---->
                    <!--Tabs-->
                     <div >      
                      <h6 class="center">Propiedades</h6>
                     </div>  
                     <div class="mdl-tabs mdl-js-tabs">
                        <div class="mdl-tabs__tab-bar">
                           <a href="#tab1-panel" class="mdl-tabs__tab is-active">Físicas</a>
                           <a href="#tab2-panel" class="mdl-tabs__tab">Químicas</a>
                           <a href="#tab3-panel" class="mdl-tabs__tab">Termodinámicas</a>
                        </div>
                        <div class="mdl-tabs__panel is-active" id="tab1-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Peso: 1.7Kg</li>
                              <li class="collection-item">Textura: Gomosa</li>
                              <li class="collection-item">Color: Rojo</li>
                              <li class="collection-item">Medidas: 114x200</li>
                           </ul>
                        </div>
                        <div class="mdl-tabs__panel" id="tab2-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Peso Molecular: 0.123</li>
                              <li class="collection-item">Energia: 34e</li>
                              <li class="collection-item">Átomos: 14</li>
                              <li class="collection-item">Negatividad: 99</li>
                           </ul>
                        </div>
                        <div class="mdl-tabs__panel" id="tab3-panel">
                           <ul class="collection with-header">                              
                              <li class="collection-item">Yo no sé de eso joven :O</li>
                              
                              
                           </ul>
                        </div>
                    </div>
                    <!--Tabs-->
                   
                      
                   
                    <div class="card-action">
                      
                    </div>
                  </div>
                </div>


                   
                </div>
	     	</div>
				  
			<div class="card-action col l12 s12">
	              <a href="#"></a>
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