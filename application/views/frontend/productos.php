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
       <div class="card col s12 l12 m12 offset-0  offset-m0  offset-s0">
        <div class="card-action col l12 s12 teal darken-4 white-text text-white">
           <a style="color:white;" href="<?php print base_url();?>ChemicalQuery/Productos"><h5 class="center col l4 m4 s12"> Productos</h5></a>
           <div class="input-field col l4 m4 s12">
           <form method="POST" action="<?php print base_url();?>Functions/categoryProduct/Categorias">
            <select name="categoria" onchange="this.form.submit()">
              <?php              
              $this->db->order_by('nombre','asc');
              $this->db->distinct();
              $this->db->group_by('categoria');
              $query=$this->db->get('productos');
              foreach ($query->result() as $row) {
              
              ?>
              <option><?php print $row->categoria?></option>              
              <?php }?>
            </select>
            </form>
            
          </div>
           <div class="input-field col l2 m12 s12">
            <form method="POST" action="<?php print base_url();?>Functions/searchProduct/Busqueda">
              <i class="material-icons prefix">search</i>             
              <input id='search' name='search' type='text' class='validate white-text' required>
              <label for="search">Buscar</label>
            </form>
          </div>
          <?php if($this->session->userdata('permisos')=='1' || $this->session->userdata('permisos')=='2'){?>
          <a href="#insertProductModal" onclick="insert()" class="btn-floating waves-effect waves-light red modal-trigger"><i class="material-icons right">add</i></a>
          <?php }?>
        </div>
        <div class="card-content ">
          <div class="row">
            <?php                 
                if($this->uri->segment(3)=="Categorias"){
                $products=$category;

                }
                elseif($this->uri->segment(3)=="Busqueda"){
                   if(isset($product)){
                    $products= $product;                                    
                    }                  
                    if(isset($empty) && $empty=="Vacio"){
                        $action=true;
                    ?>                   
                      <div class="col l12 s12 m12">
                           <div class="card">
                            <h3 class="center">NINGÚN PRODUCTO ENCONTRADO</h3>
                            </div>
                       </div>
                    <?php }

                  }
                  elseif($this->uri->segment(2)=="insertProduct" || $this->uri->segment(2)=="updateProduct" || $this->uri->segment(2)=="deleteProduct" || $this->uri->segment(3)==""){
                    $products=$allProducts;
                  }?>
                <?php if(isset($products)){
                      foreach ($products->result() as $row) {
                ?>

            
            <div class="col l4 s12 m6">
               
                  <div class="card">
                    <div class="card-image">
                    <?php if($row->imagen!="" && file_exists(FCPATH."img/productos/$row->imagen")){?>
                       <script>
                     
                      </script>
                      <a href="<?php print base_url();?>ChemicalQuery/Producto/<?php print $row->id?>"><img class="responsive-img" src="<?php print base_url();?>img/productos/<?php print $row->imagen?>"></a>
                    <?php }else{?>
                       <a href="<?php print base_url();?>ChemicalQuery/Producto/<?php print $row->id?>"> <img class="responsive-img" src="<?php print base_url();?>img/noimg.png"></a>

                    <?php }?>
                      <span id="title" class="card-title black-text"><?php print $row->nombre?>
                        <?php if($this->session->userdata('permisos')=='1' || $this->session->userdata('permisos')=='2'){?>
                        <a id="<?php print $row->id?>" class="modal-trigger" href='#editProductModal'  onclick='check($(this).attr("id"))'>
                          <i id="editButton" class='tiny material-icons black-text'>mode_edit</i>
                        </a>
                       <a id="<?php print $row->id?>" class="" href='#'  onclick='deleteProduct($(this).attr("id"))'>
                          <i id="deleteButton" class='tiny material-icons black-text'>delete</i>
                        </a>
                        <?php }?>
                      </span>
                    </div>
                    <!--Collapsable-->
                     <ul class="collapsible" data-collapsible="accordion">
                      <li>
                        <div class="collapsible-header center"><i class="material-icons">info</i>Descripción</div>
                        <div class="collapsible-body"><?php print $row->descripcion?></div>
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
                           <?php print $row->fisicas?>
                        </div>
                        <div class="mdl-tabs__panel" id="tab2-panel">
                          <?php print $row->quimicas?>
                        </div>
                        <div class="mdl-tabs__panel" id="tab3-panel">
                           <?php print $row->termodinamicas?>
                        </div>
                    </div>
                    <!--Tabs-->
                    <div class="card-action">
                      
                    </div>
                  </div>
                </div>
                <?php } }?>
            


                   
                </div>
        </div>
          
      <div class="card-action col l12 s12">
                <a href="#"></a>
          </div>
        
      </div>
  </div>
  <!--FORMULARIOS-->
  <div id='insertProductModal' class='col l6 modal modal-fixed-footer'>
        <div class='modal-content'>
          <h4 class='black-text flow-text'>Insertar Producto</h4>          
            <div class='row'>
              <form class='col l12 m12 s12' id='insertProducts' method="POST" action="<?php print base_url();?>Functions/insertProduct" enctype="multipart/form-data" >
                    <div class='input-field col s12'>
                      <input id='nombre' name='nombre' type='text' class='validate black-text' required>
                      <label for='nombre'>Nombre</label>
                    </div>
                    <div class='input-field col s12'>
                      <input id='categoria' name='categoria' type='text' class='validate black-text' required>
                      <label for='categoria'>Categoría</label>
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                      <p >Descripción</p>
                      <textarea id='descripcion' name='descripcion' type='text' class='mceEditor validate black-text'></textarea>
                  
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                     <p>Propiedades Físicas</p>
                      <textarea id='fisicas' name='fisicas' type='text' class='mceEditor validate black-text'></textarea>
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                     <p>Propiedades Químicas</p>
                      <textarea id='quimicas' name='quimicas' type='text' class='mceEditor validate black-text' ></textarea>
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                     <p>Propiedades Termodinámicas</p>
                      <textarea id='termodinamicas' name='termodinamicas' type='text' class='mceEditor validate black-text'></textarea>
                  </div>
                </div>
                <div class='row'>
                 <label class="black-text">Agregar Imagen</label>
                  <div class="file-field input-field col s12">
                     
                       <div class="btn">
                          <span>File</span>
                          <input type="file" id="imagen" name="imagen">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" name="imagen" type="text">
                        </div>
                  </div>
                </div>           
                <div class='row'>
                  <div class='input-field col s12'>
                    <button id="insertProduct" class='waves-effect waves-green btn-flat green darken-4 white-text ' onclick="inserProuduct();">Insertar</button>
                  </div>                
                </div>
                <div class="row">
                   <div class='input-field col s12'>              
                       <a id="errores" style="display:none;" class='waves-effect waves-red btn red darken-4 white-text '></a>
                      </div>
                </div>
           </form>
      </div>
    </div>
  </div>
  <div id='editProductModal' class='col l6 modal modal-fixed-footer'>
        <div class='modal-content'>
          <h4 class='black-text flow-text' id="productoTitle">Editar Producto</h4>          
            <div class='row'>
              <form class='col l9 s12' method='POST'  action="<?php print base_url();?>Functions/updateProduct" enctype="multipart/form-data">
               <input type="hidden" name="imagenOld" id="imagenOld" value="">
               <input type="hidden" name="id" id="idEdit" value="">
                <div class='row'>
                  <div class='input-field col s12'>
                    <p>Nombre</p>
                    <input id='nombreEdit' name='nombre' type='text' value="" class='validate black-text' required>
                    
                  </div>
                  <div class='input-field col s12'>
                    <p>Categoría</p>
                    <input id='categoriaEdit' name='categoria' type='text' value="" class='validate black-text'>
                    
                </div>
              </div>
            <div class='row'>
              <div class='input-field col s12'>
                  <p >Descripción</p>
                  <textarea id='descripcionEdit'  class='mceEditor validate black-text' name='descripcion' type='text'></textarea>
              
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                 <p>Propiedades Físicas</p>
                  <textarea id='fisicasEdit' name='fisicas' type='text' class='validate black-text'></textarea>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                 <p>Propiedades Químicas</p>
                  <textarea id='quimicasEdit' name='quimicas' type='text' class='validate black-text'></textarea>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                 <p>Propiedades Termodinámicas</p>
                  <textarea id='termodinamicasEdit'  name='termodinamicas' type='text' class='validate black-text'></textarea>
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
                <button class='waves-effect waves-green btn-flat green darken-4 white-text'>Guardar</button>
              </div>                
            </div>
             <div class="row">
               <div class='input-field col s12'>              
                   <a id="errores" style="display:none;" class='waves-effect waves-red btn red darken-4 white-text '></a>
                  </div>
            </div>
        </form>
      </div>
    </div>  
  </div>
<script>
   function insert(){
       tinymce.init({selector:'textarea#descripcion'});
       tinymce.init({selector:'textarea#fisicas'});
       tinymce.init({selector:'textarea#quimicas'});
       tinymce.init({selector:'textarea#termodinamicas'});
    }
    function check(id){  
      
//       tinyMCE.execCommand("mceRepaint",);
     /*  tinymce.execCommand('mceRemoveEditor',true,'fisicasEdit');
       tinymce.execCommand('mceRemoveEditor',true,'quimicasEdit');
       tinymce.execCommand('mceRemoveEditor',true,'termodinamicasEdit');*/
      
       
       $.ajax({
        url:"<?php print base_url();?>"+"Functions/checkProduct/"+id,
        type: 'POST',
        async: true,        
        success: function(json){ 
          var obj = jQuery.parseJSON(json);
           tinymce.remove();         
          //alert(obj['id']); 
          $("#productoTitle").text("Editar Usuario: "+obj['nombre']);      
          $("#idEdit").attr('value',obj['id']);
          $("#nombreEdit").attr('value',obj['nombre']);               
          $("#categoriaEdit").attr('value',obj['categoria']);
          //$("#descripcionEdit").attr('value',obj['descripcion']);
          /*Editores Castrosos*/
         
          //$("#descripcionEdit").text(obj['descripcion']);          
          //tinymce.execCommand('mceAddEditor',true,'descripcionEdit');         

          tinymce.init({selector:'textarea#descripcionEdit'});
          tinymce.activeEditor.setContent(obj['descripcion']);
          
          tinymce.init({selector:'textarea#fisicasEdit'});
          tinymce.activeEditor.setContent(obj['fisicas']);

          tinymce.init({selector:'textarea#quimicasEdit'});
          tinymce.activeEditor.setContent(obj['quimicas']);          

          tinymce.init({selector:'textarea#termodinamicasEdit'});
          tinymce.activeEditor.setContent(obj['termodinamicas']);

          $("#imagenEdit").attr('src','<?php print base_url();?>img/productos/'+obj['imagen']);
          $("#imagenEdit").attr('alt',obj['imagen']);
          $("#imagenText").attr('value',obj['imagen']);      
          $("#imagenOld").attr('value',obj['imagen']); 
          //$("#editUserModal").html(obj["nombre"]);
          //$("#editUserModal").html(obj["nombre"]);
          
           }
         });
         
     }  
     function deleteProduct(id){
       if(confirm("¿Deseas realmente eliminar este elemento?")){
            window.location="<?php print base_url();?>Functions/deleteProduct/"+id;           
        }
        else{
            return false;
        }

  }


</script>
        
</body>
</html>