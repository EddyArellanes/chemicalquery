 <!--Mensaje de Confirmacion-->
 	<?php if(isset($message)){?>
     <div id="message" class="l4 m6 s12 green darken-5 center white-text" style="display:">
     <br>
     <?php print $message?>
      <br>
      <br>
      <br>
  </div>
  <script>     
        $("#message").fadeIn(1000);
        setTimeout(function(){ $("#message").fadeOut(500) }, 3000);
        ;
  </script>
  <?php }?>
  <!--Mensaje de Confirmación-->