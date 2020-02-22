<?php if (getenv('APP_ENV')==='production') { ?>

    <h1>An error has been occured!</h1>
    <h2>Contact the admin.</h2>

<?php } else { ?>

    <h1>An error has been occured!</h1>
    <h2><?php echo $message;?></h2>

<?php } ?>
