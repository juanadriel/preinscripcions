<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Alta de Cursos</title>
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
			<h2>Nou Curs</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off" class="form-horizontal" role="form">
				<div class="form-group">
                    <label for="nombre" class="col-md-2 control-label">Nom curs:</label>
                    <div class="col-md-8">
                        <input id="nombre" class="form-control" type="text" name="nombre" required="required" placeholder="Nom curs" alt="Nom Curs" maxlength="256"/>
                    </div>
				</div>				
				
				<div class="form-group">
                    <label for="horas" class="col-md-2 control-label">Hores:</label>
                    <div class="col-md-2">
                        <input id="horas" class="form-control" type="number" name="horas"  placeholder="Hores" alt="horas" min="0" max="999"/>
                    </div>
				</div>
				
				<div class="form-group">
                    <label for="inicio" class="col-md-2 control-label">Data d'inici:</label>
                    <div class="col-md-2">
                        <input id="inicio" class="form-control" type="text" name="inicio" placeholder="AAAA-MM-DD" alt="inicio" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[0-12])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
                    </div>
				</div>
				
				<div class="form-group">
                    <label for="tipologia" class="col-md-2 control-label">Tipologia:</label>
                    <div class="col-md-3">              
            			<select id="tipologia" name="tipologia" class="form-control">
                			<option value="FOAP">FOAP</option>
                			<option value="Formació Consorci">Formació Consorci</option>
                			<option value="Formació Bonificable">Formació Bonificable</option>
                			<option value="Tallers">Tallers</option>
                			<option value="Blocs Formatius">Blocs Formatius</option>
                			<option value="Altres">Altres</option>
            			</select>        
                    </div>
				</div>	
				
				
				
<!--
				<div class="form-group">
                    <label for="area_formativa" class="col-md-2 control-label">Àrea formativa:</label>
                    <div class="col-md-4">
                        <input id="area_formativa" class="form-control" type="text" name="area_formativa" placeholder="Àrea formativa" alt="Area formativa" maxlength="128"/>
                    </div>
				</div>
-->
				<div class="form-group">
                        <label for="area_formativa" class="col-md-2 control-label">Àrea formativa:</label>
                        <div class="col-md-3">
                            <select id="area_formativa" name="area_formativa" class="form-control">                                   
                            	<option value="Administració">Administració</option>
                                <option value="Habilitats interpersonals">Habilitats interpersonals</option>
                                <option value="Informàtica / Noves tecnologies">Informàtica / Noves tecnologies</option>
                                <option value="Sociosanitàries">Sociosanitàries</option>
                            </select>  
                        </div>
                    </div>		
				
				
				<div class="form-group">
                    <label for="precio" class="col-md-2 control-label">Preu:</label>
                    <div class="col-md-2">
                        <input id="precio" class="form-control" type="number" name="precio"  placeholder="Preu" alt="precio" min="0" max="9999"/>
                    </div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-2">Actiu:</label>                                
				    <div class="checkbox">                         
                         <input id="activo" class="form-control" type="checkbox" name="activo"  alt="actiu" value="1" checked ="checked">                        
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