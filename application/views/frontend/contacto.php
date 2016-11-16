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
	 	<?php if(isset($done)){  ?>
	 	<div class="row">	
	 		<div class="card col l10 m10 s12 offset-l1 offset-m1 offset-s0  red darken-4 white-text">
	 			<p>Algo salió mal, inténtalo de nuevo!</p>
	 		</div>
	 	</div>
	 	<?php }?>
		<div class="row">	
		    <div class="card col l10 m10 s12 offset-l1 offset-m1 offset-s0">
		     	<div class="card-action col l12 s12 ">
		     		<h5 class="center">	Escríbenos un mensaje dejando tu opinión, dudas o si te gustaría ser un administrador del sistema.</h5>	     			     		
		     	</div>
		     	<div class="card-content ">
		     		<form class="col l12 m12 s12" action="<?php print base_url();?>Functions/sendMessage" method="POST">
		     			<div class="input-field col l12 m12 s12 ">
		     				 <input name="subject" class="input-field" placeholder="Asunto">
		     			</div>
		     			<div class="input-field col l12 m12 s12 ">
		     				 <textarea name="message" class="materialize-textarea"></textarea>
		     			</div>
		     			<button class="center btn blue white-text waves-effect waves-blue">Enviar</button>
		     		</form>
		     	</div>
				<div class="card-action col l12 s12">
		           
		        </div>	  
		  	</div>
	  	</div>
	  	
	 
	</body>
</html>