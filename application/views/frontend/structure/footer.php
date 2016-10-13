  <?php
            
            $query= $this->db->where('id','5');
            $query=$this->db->get('estructura');
            $facebook= $query->row();

			$query= $this->db->where('id','6');
            $query=$this->db->get('estructura');
            $twitter= $query->row();
            ?>

<div class="contenedor">
                <div class="col-xl-6"><a href="<?php print base_url();?>Quelatonic/Aviso">Aviso de Privacidad</a></div>
                <div class="col-xl-6">
                    <p>SÍGUENOS:</p>
                    <a href="<?php print $facebook->link1?>" target="blank"><span class="icon-facebook"></span></a>
                    <a href="<?php print $twitter->link1?>" target="blank"><span class="icon-twitter"></span></a>
                </div>
 </div>