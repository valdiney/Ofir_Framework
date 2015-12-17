<?php if (Session::has_flash('error')):?>
    <p class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php Session::get_flash('error');?>
    </p>
<?php elseif (Session::has_flash('success')):?>
    <p class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php Session::get_flash('success');?>
    </p>
<?php endif; ?>