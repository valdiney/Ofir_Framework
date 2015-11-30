<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<style>
	body {
		background:#cae5ee;
		font-family:DengXian;
	}

	.description {
		width:500px;
		padding:10px;
		border:1px solid silver;
		border-radius:3px;
		display:block;
		text-align:center;
		margin:auto;
		background:white;
		color:#333333;
	}

	.pre {
		width:500px;
		height:auto;
		pading:0;
		margin:auto;
		border-radius:3px;
		margin-top:10px;
	}
	</style>

	<title><?php echo $data['page_title'];?></title>
</head>
<body>

  <!--Include the content into the layout-->
  <?php require_once($this->content);?>

</body>
</html>