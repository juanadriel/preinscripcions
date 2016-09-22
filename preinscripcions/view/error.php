<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>ERROR</title>
		<?php 
            Template::boots();
        ?>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header($usuario);
		?>
		
		<section id="content" class="container">
			<h2>Error</h2>
			<?php echo '<p>'.$mensaje.'</p>'; ?>
		</section>
		
		<?php 
            Template::footer();
            Template::jquery();
        ?>
    </body>   
</html>