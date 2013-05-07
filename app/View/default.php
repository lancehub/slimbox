<!DOCTYPE html>
<html>
	<head>
		<title>Project Name</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include_css('bootstrap.min'); ?>
	</head>
	<body>
		<?php include_element('nav.php'); ?>
		<div class="container">
			<?php include_template($template); ?>
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<?php include_js('bootstrap.min'); ?>
	</body>
</html>