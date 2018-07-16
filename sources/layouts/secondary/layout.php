<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php Helper::css('css.bootstrap');?>
    <?php Helper::css('css.style');?>
    <title><?php echo $title;?></title>
    <base href="<?php echo BASE; ?>">
</head>
<body>

    <?php Helper::script('js.jquery');?>
    <?php Helper::script('js.bootstrap');?>

    <!--Include the content into the layout-->
    <?php require_once($this->content);?>

    <footer class="text-center">
        <em>I'm a secondary layout.</em>
    </footer>

</body>
</html>
