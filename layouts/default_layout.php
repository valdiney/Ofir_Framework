<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php Helper::css('css.style');?>

	<title><?php echo $data['page_title'];?></title>
</head>
<body>

  <!--Include the content into the layout-->
  <?php require_once($this->content);?>
  
</body>
</html>