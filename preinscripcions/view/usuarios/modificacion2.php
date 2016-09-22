<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Modificación de datos de usuario</title>
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
			<a class="derecha" href="index.php?controlador=Usuario&operacion=baja">Donarse de baixa</a>
			
			<h2>Formulari de modificació de dades</h2>
			
            <div class="container">
              <h2>Probando tabs dinámicas para preinscripciones</h2>
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">aqui el registro básico</a></li>
                <li><a data-toggle="tab" href="#menu1">parte 1 del cuestionario</a></li>
                <li><a data-toggle="tab" href="#menu2">parte 2 del cuestionario</a></li>
                <li><a data-toggle="tab" href="#menu3">Mis preinscripciones</a></li>
              </ul>

              <div class="tab-content">
                  <form class="tab-content form-horizontal container" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
                   
                        <div id="home" class="tab-pane fade in active">
                            <h3>HOME</h3>
                      
                            <figure>
                           
                              <img class="imagenactual" src="<?php echo $usuario->imagen;?>" 
                              alt="<?php echo  $usuario->dni;?>" />
                            </figure>

                            <div class="form-group">
                              <label for="dni" class="col-md-2 control-label">Usuari(dni):</label>
                              <div class="col-md-6">
                                  <input id="dni" class="form-control" type="text" name="dni" required="required" readonly="readonly" value="<?php echo $usuario->dni;?>" />
                              </div>
                            </div>
                          
                            <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Correu electrònic:</label>
                            <div class="col-md-6">
                                <input id="email" class="form-control" type="email" name="email" required="required" value="<?php echo $usuario->email;?>" maxlength="128"/>
                            </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-2 control-label">Password actual:</label>
                                <div class="col-md-6">
                                    <input id="password" class="form-control" type="password" name="password" required="required" autocomplete="off" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password2" class="col-md-2 control-label">Nou password:</label>
                                <div class="col-md-6">
                                    <input id="password2" class="form-control" type="password" name="newpassword" pattern=".{4,32}" title="4 a 32 caracteres" maxlength="32"/>
                                    <span class="mini">Deixar en blanc per no modificar l'actual</span>
                                </div>
                            </div> 

                        </div>
                        
                        <div id="menu1" class="tab-pane fade">
                            <h3>Menu 1</h3>
                          
                            <div class="form-group">
                                <label for="nombre" class="col-md-2 control-label">Nom:</label>
                                <div class="col-md-6">
                                    <input id="nombre" class="form-control" type="text" name="nombre" required="required" placeholder="nom" value="<?php echo $usuario->nombre;?>" maxlength="64"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="apellido1" class="col-md-2 control-label">Primer cognom</label>
                                <div class="col-md-6">
                                    <input id="apellido1" class="form-control" type="text" name="apellido1" required="required"  placeholder="cognom1" value="<?php echo $usuario->apellido1;?>" maxlength="64"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="apellido2" class="col-md-2 control-label">Segon cognom</label>
                                <div class="col-md-6">
                                    <input id="apellido2" class="form-control" type="text" name="apellido2" required="required" placeholder="cognom2" value="<?php echo $usuario->apellido2;?>" maxlength="64"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fechanacimiento" class="col-md-2 control-label">data naixament</label>
                                <div class="col-md-6">
                                    <input id="fechanacimiento" class="form-control" type="text" name="fecha_nacimiento" required="required" placeholder="AAAA-MM-DD" value="<?php echo $usuario->fecha_nacimiento;?>" maxlength="64" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="direccion" class="col-md-2 control-label">Direcció</label>
                                <div class="col-md-6">
                                    <input id="direccion" class="form-control" type="text" placeholder="C/direccio" name="direccion" required="required" value="<?php echo $usuario->direccion;?>" maxlength="512"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cp" class="col-md-2 control-label">Codi postal</label>
                                <div class="col-md-6">
                                    <input id="cp" class="form-control" type="text" name="cp" required="required" placeholder="12345" value="<?php echo $usuario->cp;?>" maxlength="64"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="poblacion" class="col-md-2 control-label">Població</label>
                                <div class="col-md-6">
                                    <input id="poblacion" class="form-control" type="text" name="poblacion" required="required" placeholder="població" value="<?php echo $usuario->poblacion;?>" maxlength="64"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telf_movil" class="col-md-2 control-label">Telèfon mòbil</label>
                                <div class="col-md-6">
                                    <input id="telf_movil" class="form-control" type="text" name="telf_movil" required="required" placeholder="123456789" value="<?php echo $usuario->telf_movil;?>" maxlength="16"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telf_fijo" class="col-md-2 control-label">Telèfon fix</label>
                                <div class="col-md-6">
                                    <input id="telf_fijo" class="form-control" type="text" name="telf_fijo" required="required" placeholder="123456789" value="<?php echo $usuario->telf_fijo;?>" maxlength="16"/>
                                </div>
                            </div>
                          

                        </div>
                        
                        <div id="menu2" class="tab-pane fade">
                          <h3>Menu 2</h3>

                              <div class="form-group">
                                <label for="nivel_estudios" class="col-md-2 control-label">Nivell d'estudis</label>
                                <div class="col-md-6"> <?php echo $usuario->nivel_estudios;?>
                                    <select id="nivel_estudios" class="form-control" name="nivel_estudios">
                                        <option <?php if(strcmp($usuario->nivel_estudios, 'Sense estudis') ==0) echo 'selected="selected"';?> value="Sense estudis">Sense estudis</option>
                                        <option <?php if(strcmp($usuario->nivel_estudios, 'Graduat escolar/ESO') ==0) echo 'selected="selected"';?> value="Graduat escolar/ESO">Graduat escolar/ESO</option>
                                        <option <?php if(strcmp($usuario->nivel_estudios, 'Batxillerat') ==0) echo 'selected="selected"';?> value="Batxillerat">Batxillerat</option>
                                        <option <?php if(strcmp($usuario->nivel_estudios, 'FP1/CF Grau mitjà') ==0) echo 'selected="selected"';?> value="FP1/CF Grau mitjà">FP1/CF Grau mitjà</option>
                                        <option <?php if(strcmp($usuario->nivel_estudios, 'FP2/CF Grau superior') ==0) echo 'selected="selected"';?> value="FP2/CF Grau superior">FP2/CF Grau superior</option>
                                        <option <?php if(strcmp($usuario->nivel_estudios, 'Diplomatura/Llicenciatura/Grau') ==0) echo 'selected="selected"';?> value="Diplomatura/Llicenciatura/Grau">Diplomatura/Llicenciatura/Grau</option>
                                        <option <?php if(strcmp($usuario->nivel_estudios, 'Altres') ==0) echo 'selected="selected"';?> value="Altres">Altres</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre_titulacion" class="col-md-2 control-label">Nom de la titulació</label>
                                <div class="col-md-6">
                                    <input id="nombre_titulacion" class="form-control" type="text" name="nombre_titulacion" placeholder="Nom de la titulació" value="<?php echo $usuario->nombre_titulacion;?>" maxlength="128"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="otros" class="col-md-2 control-label">Altres</label>
                                <div class="col-md-6">
                                    <input id="otros" class="form-control" type="text" name="otros" placeholder="Altres" value="<?php echo $usuario->otros;?>" maxlength="256"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="observaciones" class="col-md-2 control-label">Observacions</label>
                                <div class="col-md-6">
                                    <textarea id="observaciones" class="form-control" name="observaciones" placeholder="Observacions" ><?php echo $usuario->observaciones;?></textarea>
                                </div>
                            </div>
                   
                              

                        </div>
                        <div id="menu3" class="tab-pane fade">
                          <h3>Menu 3</h3>

                              <input type="text" name="final" value="final1">
                              <input type="submit" name="pruebatabs" value="pruebatabs"/>

                        </div>
                    </form>
                </div>
            </div>

				
		</section>
		
		<?php 
            Template::footer();
            Template::jquery();
        ?>
    </body>
</html>