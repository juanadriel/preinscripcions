<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Baja de usuarios</title>
		<?php 
            Template::boots();
        ?>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header($usuario);
		?>
		
		<section id="content">
			<h2>Formulario de baja de usuario</h2>
			<p>Por favor, confirma tu solicitud de baja introduciendo el password asociado a tu cuenta.</p>
		
			<form method="post" autocomplete="off">
				<label>User(dni):</label>
				<input type="text" readonly="readonly" value="<?php echo $usuario->dni;?>" /><br/>
				
				<label>Password:</label>
				<input type="password" name="password" required="required"/><br/>
				
				<label></label>
				<input type="submit" name="confirmar" value="Confirmar"/><br/>
			</form>
		</section>
		
		<?php 
            Template::footer();
            Template::jquery();
        ?>
    </body>
</html>