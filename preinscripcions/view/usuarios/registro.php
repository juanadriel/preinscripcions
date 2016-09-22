<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
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
			<h2>Formulari de registre</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off" class="form-horizontal" role="form">
				<div class="form-group">
                    <label for="dni" class="col-md-2 control-label">User(dni):</label>
                    <div class="col-md-6">
                        <input id="dni" class="form-control" type="text" name="dni" pattern="[xyzXYZ0-9][0-9]{7}[A-Za-z]" required="required" placeholder="dni" alt="dni"/>
                    </div>
				</div>
				
				
				<div class="form-group">
                    <label for="email" class="col-md-2 control-label">Correu electrònic:</label>
                    <div class="col-md-6">
                        <input id="email" class="form-control" type="email" name="email" required="required" placeholder="email" alt="email"/>
                    </div>
				</div>
				
				<div class="form-group">
                    <label for="password" class="col-md-2 control-label">Password:</label>
                    <div class="col-md-6">
                        <input id="password" class="form-control" type="password" name="password" required="required" 
					pattern=".{4,16}" title="4 a 16 caracteres" placeholder="password" alt="password"/>
                    </div>
				</div>
				
				<div class="form-group">
                    <label for="password2" class="col-md-2 control-label">Confirmar password:</label>
                    <div class="col-md-6">
                        <input id="password2" class="form-control" type="password" name="password2" required="required" 
					pattern=".{4,16}" title="4 a 16 caracteres" placeholder="password" alt="password"/>
                    </div>
				</div>
				
				<div class="form-group">
                    <label for="imagen" class="col-md-2 control-label">Imatge:</label>
           º             <div class="col-md-6">
                        <input id="password2" class="form-control" type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_image_size;?>"/>
                        <input id="password2" class="form-control" type="file" accept="image/*" name="imagen" />
                    </div>
				</div>
				
				<label>Imagen:</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_image_size;?>" />		
				<input type="file" accept="image/*" name="imagen" />
				<span>max <?php echo intval($max_image_size/1024);?>kb</span><br />
				
				<label></label>
				<input type="submit" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php 
            Template::footer();
            Template::jquery();
        ?>
    </body>
</html>