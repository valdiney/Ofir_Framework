
<section class="mensage_error">
   <?php if (Session::has_flash('success')):?>
    <p class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php Session::get_flash('success');?>
    </p>
    <?php endif; ?>
</sention>

<section class="conteiner">

	<h2><?php echo $title;?></h2>
	<br>
	<table class="table">

		<tr>
			<td><b>Login</b></td>
			<td><b>Data Cadastro</b></td>
			<td><b>Deletar</b></td>
		</tr>
    
    <?php foreach ($all_users as $itens):?>
		<tr>
			<td><?php echo $itens->login;?></td>
			<td><?php echo $itens->data;?></td>
			<td><a href=<?php Helper::link_to('home.delete', "id={$itens->id}");?>>Deletar</a></td>
		</tr>
	<?php endforeach;?>
		
	</table>

</section>