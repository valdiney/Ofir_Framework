<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php Helper::css('css.bootstrap');?>
	<?php Helper::css('css.style');?>

	<title>Teste</title>
</head>
<body>
    <!--Include the content into the layout-->
    <?php require_once($this->content);?>
  
    <?php Helper::script('js.jquery');?>
    <?php Helper::script('js.bootstrap');?>
</body>
</html>