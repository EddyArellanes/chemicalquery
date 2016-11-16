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
		    <div class="card col l12 m12 s12">
		     	<div class="card-action col l12 s12 ">
		     		<ul class="collapsible" data-collapsible="accordion">
		     			<?php 
		     			foreach($messages->result() as $row){?>
				        <li>
				          <div class="collapsible-header" onclick="messageStatusOn();"><i class="material-icons">email</i><?php print $row->usuario?>|Asunto:<?php print $row->asunto?>

				          	<!--NEW BADGE DESACTIVADO POR AHORA
				          	<span style="position:inherit;left:6%;font-size: 0.7rem" class="new badge"></span>-->
				             <a href="#" onclick="deleteUser($(this).attr('id'))" id=<?php print $row->id?>><i style="float:right" class="material-icons black-text">delete</i></a>       
				          </div>
				          <div class="collapsible-body"><p><?php print $row->mensaje?></p></div>
				       	</li> 
				       <?php }?>     
				     </ul>	     		
		     	</div>
		     	<div class="card-content ">
		     		<div class="col l12 offset-l4 m12 offset-m4 s12 offset-s4">
	  					<a href="<?php print base_url();?>ChemicalQuery/Contacto"><button class="center btn blue waves-effect waves-blue">Volver</button></a>
	  				</div>
		     	</div>
				<div class="card-action col l12 s12">
		           
		        </div>	  
		  	</div>
	  	</div>
	  
	  	
	 
	</body>
	<script>
		function deleteUser(id){
	       if(confirm("¿Deseas realmente eliminar este elemento?")){
	            window.location="<?php print base_url();?>Functions/deleteMessage/"+id;           
	        }
	        else{
	            return false;
	        }
		 }
	</script>
</html>