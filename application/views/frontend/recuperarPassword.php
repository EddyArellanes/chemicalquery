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
  <?php $this->load->view('frontend/structure/header');
   $this->db->where('contrasenaRecover',$this->uri->segment(3));
    $query= $this->db->get('usuarios');
  if(null!=$this->uri->segment(3) && $query->num_rows()>0){?>
       
      <div class="row">
         <div class="card col l6 offset-l3 m12 s12">
          <h4>Escribe tu nueva contraseña</h4>
          <form id="recuperarContrasenaForm" method="POST" onsubmit="return false" action="<?php print base_url();?>Functions/renewPassword/<?php print $this->uri->segment(3)?>" >
           <div class='row'>
                  <div class='input-field col s12'>
                      <input id='contrasena' name='contrasena' type='password' class='validate black-text' required>
                      <label for='contrasena'>Contraseña</label>
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col s12'>
                      <input id='contrasenaRepeat' name='contrasenaRepeat' type='password' class='validate black-text' required>
                      <label for='contrasenaRepeat'>Repite contraseña</label>
                  </div>
                  <button id="checkPasswords" class='waves-effect waves-green btn-flat green darken-4 white-text ''>Enviar</button>
                   <br><a id="errorContrasena" style="display:none;" class='waves-effect waves-red btn red darken-4 white-text '>Contraseñas no coinciden</a>
                </div>
          </form>
         </div>
      </div>



    
    <?php }else{?>
    <div class="row">
        <div class="col l6 offset-l3 m12 s12">
          <h3>¿Olvidaste tu Contraseña?</h3>
          <p>Escribe tu usuario y correo a donde se enviará el link para cambiar tu contraseña:</p>
          <form method="post" action="<?php print base_url();?>Functions/recoverPassword">
             <div class='row'>
                <div class='input-field col l12 m12 s12'>
                        <input id='usuario' name='usuario' type='text' class='validate black-text' required>
                        <label for='usuario'>Usuario</label>
                </div>
                <div class='input-field col l12 m12 s12'>
                        <input id='email' name='email' type='email' class='validate black-text' required>
                        <label for='email'>Correo Electrónico</label>
                </div>
                 <button id="checkPasswordsInsert" class='waves-effect waves-green btn-flat green darken-4 white-text ''>Enviar</button>
          </form>
        </div>
      </div>
  <?php }?>

<script>
  $( "#checkPasswords" ).click(function(){
      if($("#contrasena").val()!="" && $("#contrasena").val()!=""){
        if($("#contrasena").val()==$("#contrasenaRepeat").val()){
        $( "#recuperarContrasenaForm" ).removeAttr("onsubmit");
        //onsubmit="return false"
         $( "#recuperarContrasenaForm" ).submit();
        }
        else{
          //alert("Contraseñas No coinciden");
          $("#errorContrasena").css("display", "block");
        }
      }
      else{
        console.log("Error");
      }
     
  }); 

</script>
      
</body>
</html>