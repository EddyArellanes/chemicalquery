<script>
    
    $( document ).ready(function(){
        $(".button-collapse").sideNav();
    });
</script>
<nav>
    <div class="nav-wrapper teal darken-2">
    
      <ul id="nav-mobile" class="right">
     
      </ul>
    </div>
 </nav>

  <nav>
    <div class="nav-wrapper teal darken-2">
      <?php if(!$this->session->userdata('logueado')){?>   
      <a href="<?php print base_url();?>ChemicalQuery/Inicio" class="brand-logo " style="top:-50%;">Quemical Query</a>
      <?php }else{?>
      <a href="<?php print base_url();?>ChemicalQuery/Inicio" class="brand-logo " style="top:-50%;">Quemical Query</a>
      <?php }?>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <?php if($this->session->userdata('logueado')){?>
        <li><a href="<?php print base_url();?>ChemicalQuery/Productos">Productos</a></li>
        <?php if($this->session->userdata('permisos')=='2'){?>
             <li><a href="<?php print base_url();?>ChemicalQuery/Administrador">Administrador</a></li>
        <?php }?>
        <li><a href="<?php print base_url();?>ChemicalQuery/Contacto">Contacto</a></li>
           <!--Revisar datos de Usuario-->   
        <?php if(null!=$this->session->userdata('imagen')){?>
        <li><a href="<?php print base_url();?>ChemicalQuery/Perfil"><img style="border-radius:10%;min-width:25px;max-width:25px;max-height:25px;" class="responsive-img" src="<?php print base_url();?>img/usuarios/<?php print $this->session->userdata('imagen')?>">
        <?php }else{?>
         <li><a href="<?php print base_url();?>ChemicalQuery/Perfil"><img  style="border-radius:10%;min-width:25px;max-width:25px;max-height:25px;" class="responsive-img" src="<?php print base_url();?>img/noimg.png">
          <?php }?>
        <?php print $this->session->userdata('usuario')?></a></li>
        <!--Revisar datos de Usuario FIN-->  
        <a class="btn  red darken-4" href="<?php print base_url();?>Functions/logout">Salir</a>
        
      <?php }?> 
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <?php if($this->session->userdata('logueado')){?>
         <li><a href="<?php print base_url();?>ChemicalQuery/Inicio">Inicio</a></li>
         <li><a href="<?php print base_url();?>ChemicalQuery/Productos">Productos</a></li>
        <?php if($this->session->userdata('permisos')=='2'){?>
        <li><a href="<?php print base_url();?>ChemicalQuery/Administrador">Administrador</a></li>
        <?php }?>
        <li><a href="<?php print base_url();?>ChemicalQuery/Contacto">Contacto</a></li>
           <!--Revisar datos de Usuario-->   
        <?php if(null!=$this->session->userdata('imagen')){?>
        <li><a href="<?php print base_url();?>ChemicalQuery/Perfil"><img style="border-radius:10%;min-width:25px;max-width:25px;max-height:25px;"class="responsive-img" src="<?php print base_url();?>img/usuarios/<?php print $this->session->userdata('imagen')?>">
        <?php }else{?>
         <li><a href="<?php print base_url();?>ChemicalQuery/Perfil"><img style="border-radius:10%;min-width:25px;max-width:25px;max-height:25px;" class="responsive-img" src="<?php print base_url();?>img/noimg.png">
          <?php }?>
        <?php print $this->session->userdata('usuario')?></a></li>
        <!--Revisar datos de Usuario FIN-->  
        <li><a href="<?php print base_url();?>Functions/logout"><i class="material-icons">trending_flat</i>Salir</a></li>
      <?php }?> 
      </ul>
    </div>
  </nav>
          