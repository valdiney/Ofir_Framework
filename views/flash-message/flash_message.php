<?php if (Session::hasFlash('error')):?>
    <p class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php Session::getFlash('error');?>
    </p>
<?php elseif (Session::hasFlash('success')):?>
    <p class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php Session::getFlash('success');?>
    </p>
<?php endif; ?>