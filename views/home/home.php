
<p class="description">
	Welcome to Ofir, this is a project development of the PHP-Framework, 
	develop of the students to students. 
	what do you think about help me to develop this project?
</p>

   <div class="description">
	  <?php foreach ($usuarios as $items):?>
       <p><?php echo $items->login;?></p>
    <?php endforeach;?>
   </div>

   <div class="description">
	  <?php foreach ($clientes as $items):?>
       <p><?php echo $items->login;?></p>
    <?php endforeach;?>
   </div>