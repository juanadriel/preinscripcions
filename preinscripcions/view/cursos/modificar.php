<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Modificar Curs</title>
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
			<h2>Modificar Curs: <?php echo $curso->nombre;?></h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off" class="form-horizontal" role="form">
				<div class="form-group">
                    <label for="nombre" class="col-md-2 control-label">Nom curs:</label>
                    <div class="col-md-8">
                        <input id="nombre" class="form-control" type="text" name="nombre" required="required" placeholder="Nom curs" alt="Nom Curs" maxlength="256" value="<?php  echo $curso->nombre;?>" />
                    </div>
				</div>				
				
				<div class="form-group">
                    <label for="horas" class="col-md-2 control-label">Hores:</label>
                    <div class="col-md-2">
                        <input id="horas" class="form-control" type="number" name="horas"  placeholder="Hores" alt="horas" min="0" max="999" value="<?php echo $curso->horas;?>"/>
                    </div>
				</div>
				
				<div class="form-group">
                    <label for="inicio" class="col-md-2 control-label">Data d'inici:</label>
                    <div class="col-md-2">
                        <input id="inicio" class="form-control" type="text" name="inicio" placeholder="AAAA-MM-DD" alt="inicio" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[0-12])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="<?php echo $curso->inicio;?>"/>
                    </div>
				</div>
				
				<div class="form-group">
                    <label for="tipologia" class="col-md-2 control-label">Tipologia:</label>
                    <div class="col-md-3">              
            			<select id="tipologia" name="tipologia" class="form-control">                			
                			<option <?php if(!strcmp($curso->tipologia,"")) echo "selected ='selected'";?> value=""></option>
                			<option <?php if(!strcmp($curso->tipologia,"FOAP")) echo "selected ='selected'";?> value="FOAP">FOAP</option>
                			<option <?php if(!strcmp($curso->tipologia,"Formació Consorci")) echo "selected ='selected'";?> value="Formació Consorci">Formació Consorci</option>
                			<option <?php if(!strcmp($curso->tipologia,"Formació Bonificable")) echo "selected ='selected'";?> value="Formació Bonificable">Formació Bonificable</option>
                			<option <?php if(!strcmp($curso->tipologia,"Tallers")) echo "selected ='selected'";?> value="Tallers">Tallers</option>
                			<option <?php if(!strcmp($curso->tipologia,"Blocs Formatius")) echo "selected ='selected'";?> value="Blocs Formatius">Blocs Formatius</option>
                			<option <?php if(!strcmp($curso->tipologia,"Altres")) echo "selected ='selected'";?> value="Altres">Altres</option>
            			</select>        
                    </div>
				</div>	
				
				<div class="form-group">
                    <label for="area_formativa" class="col-md-2 control-label">Àrea formativa:</label>
                    <div class="col-md-3">              
            			<select id="area_formativa" name="area_formativa" class="form-control">                			
                			<option <?php if(!strcmp($curso->area_formativa,"")) echo "selected ='selected'";?> value=""></option>
                			<option <?php if(!strcmp($curso->area_formativa,"Activitats físiques i esportives")) echo "selected ='selected'";?> value="Activitats físiques i esportives">Activitats físiques i esportives</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Administració i gestió")) echo "selected ='selected'";?> value="Administració i gestió">Administració i gestió</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Agrària")) echo "selected ='selected'";?> value="Agrària">Agrària</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Arts gràfiques")) echo "selected ='selected'";?> value="Arts gràfiques">Arts gràfiques</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Arts i artesania")) echo "selected ='selected'";?> value="Arts i artesania">Arts i artesania</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Comerç i màrqueting")) echo "selected ='selected'";?> value="Comerç i màrqueting">Comerç i màrqueting</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Edificació i obra civil")) echo "selected ='selected'";?> value="Edificació i obra civil">Edificació i obra civil</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Electricitat i electrònica")) echo "selected ='selected'";?> value="Electricitat i electrònica">Electricitat i electrònica</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Energia i aigua")) echo "selected ='selected'";?> value="Energia i aigua">Energia i aigua</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Fabricació mecànica")) echo "selected ='selected'";?> value="Fabricació mecànica">Fabricació mecànica</option>
                			<option <?php if(!strcmp($curso->area_formativa,"Informàtica i comunicacions")) echo "selected ='selected'";?> value="Informàtica i comunicacions">Informàtica i comunicacions</option>
            			</select>        
                    </div>
				</div>	
				
				<div class="form-group">
                    <label for="precio" class="col-md-2 control-label">Preu:</label>
                    <div class="col-md-2">
                        <input id="precio" class="form-control" type="number" name="precio"  placeholder="Preu" alt="precio" min="0" max="9999" value="<?php echo $curso->precio;?>"/>
                    </div>
				</div>
				
				<div class="form-group">                    
				    <div class="checkbox col-md-2 col-md-offset-2">
                          <label for="activo" class="negrita"><input id="activo" name="activo"  alt="actiu" type="checkbox" value="<?php echo $curso->activo;?>" <?php if($curso->activo) echo "checked ='checked'";?>>Actiu</label>
                    </div>  
                </div>
				 				
					
				<div class="form-group">
					<div class="col-md-4 col-md-offset-2">
						<button class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
					</div>	
				</div>				
			</form>
		</section>
		
		<?php 
            Template::footer();
            Template::jquery();
        ?>
    </body>
</html>