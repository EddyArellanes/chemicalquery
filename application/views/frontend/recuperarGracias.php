<!DOCTYPE html>
<html>
  <head>
    <title>Chemical Query</title>
    <meta charset="utf8">
    
    <?php $this->load->view('frontend/structure/head')?>
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" -->

  </head>
  <body>   
    <?php $this->load->view('frontend/structure/header')?>  
    <div class="row">
        <?php if(isset($error)){?> 
        <div class="card col l10 m10 s12 offset-l1 offset-m1 offset-s0 red darken-3 white-text">
        <?php }else{?>
        <div class="card col l10 m10 s12 offset-l1 offset-m1 offset-s0 green darken-3 white-text">
        <?php }?>

          <div class="card-action col l12 s12 ">
          <?php if(isset($recovered)){?>
           <h5 class="center"> <?php print $recovered;?></h5>
           <?php }if(isset($error)){?>
            <h5 class="center"> <?php print $error;?></h5>
          <?php }if(!isset($recovered) && !isset($error)){?>                    
             <h5 class="center">Revisa tu Bandeja de entrada donde recibirás un link para cambiar tu contraseña</h5>
          <?php }?>
          </div>
          <div class="card-content ">
            <div class="col l12 offset-l4 m12 offset-m4 s12 offset-s4">
              <a href="<?php print base_url();?>"><button class="center btn blue waves-effect waves-blue">Volver</button></a>
            </div>
          </div>
        <div class="card-action col l12 s12">
               
            </div>    
        </div>
      </div>
    
      
   
  </body>
</html>