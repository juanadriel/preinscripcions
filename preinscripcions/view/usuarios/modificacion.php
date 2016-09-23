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
			
			<ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Dades de registre</a></li>
                <li><a data-toggle="tab" href="#menu1">Dades personals</a></li>
                <li><a data-toggle="tab" href="#menu2">Estudis reglats</a></li>
                <li><a data-toggle="tab" href="#menu3">Situació laboral</a></li>
                <li><a data-toggle="tab" href="#menu4">Preincripcions</a></li>
            </ul>
            
            
               
                <form class="tab-content form-horizontal container" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
                   
                    <div id="home" class="tab-pane fade in active">
                       
                        <h3>Dades de registre:</h3>
                        <div class=row>
	                        <figure class="col-md-2">
	                            <img class="imagenactual img-thumbnail" src="<?php echo $usuario->imagen;?>" 
	                                alt="<?php echo  $usuario->dni;?>" />
	                        </figure>
	                        <div class="col-md-10">
	
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
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade ">
                       
                        <h3>Dades personals:</h3>
                        
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
                    
                    <div id="menu2" class="tab-pane fade ">
                       
                        <h3>Estudis reglats:</h3>
                        
                         <div class="form-group">
                            <label for="nivel_estudios" class="col-md-2 control-label">Nivell d'estudis</label>
                            <div class="col-md-6"> 
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
                    <div id="menu3" class="tab-pane fade ">
                       
                        <h3>Situació laboral:</h3>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Situació laboral</label>
                            <div class="col-md-6 ">
                            	<div class="radio">
	                                En actiu<input id="en_activo"  type="radio" name="en_activo" value="1" <?php if($usuario->en_activo ==1) echo 'checked';?> />
	                                A l'atur<input id="atur" type="radio" name="en_activo" value="0" <?php if($usuario->en_activo ==0) echo 'checked';?> />
                                </div>
                            </div>
                    
                        </div>
                
                        <div class="form-group">
                            <label for="razon_social" class="col-md-2 control-label">Raó social</label>
                            <div class="col-md-6">
                                <input id="razon_social" class="form-control" type="text" name="razon_social" placeholder="Raó social" value="<?php echo $usuario->razon_social;?>" maxlength="128"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="puesto_trabajo" class="col-md-2 control-label">Lloc de traball</label>
                            <div class="col-md-6">
                                <input id="puesto_trabajo" class="form-control" type="text" name="puesto_trabajo" placeholder="Lloc de traball" value="<?php echo $usuario->puesto_trabajo;?>" maxlength="256"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="regimen" class="col-md-2 control-label">Règim</label>
                            <div class="col-md-6">
                                <select id="regimen" class="form-control" name="regimen" >
                                    <option <?php if($usuario->regimen ==0) echo 'selected="selected"';?> value="0">A l'atur</option>
                                    <option <?php if($usuario->regimen ==1) echo 'selected="selected"';?> value="1">Règim general</option>
                                    <option <?php if($usuario->regimen ==2) echo 'selected="selected"';?> value="2">Autònom</option>
                                    <option <?php if($usuario->regimen ==3) echo 'selected="selected"';?> value="3">Administració pública</option>            
                                </select>
                            </div>
                        </div>

                        <label>Nueva imagen:</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_image_size;?>" />		
                        <input type="file" accept="image/*" name="imagen" />
                        <span class="mini">max <?php echo intval($max_image_size/1024);?>kb</span><br />
                                           
                    </div>
                    <div id="menu4" class="tab-pane fade">
                    <h2>Este es el bueno</h2>
                    	<div class="row">
			                <div class="table-responsive">
			                    <table class="table table-striped table-bordered table-hover">
				                    <tr class="info">	               
				                       <th>Nom</th>
				                       <th>Hores</th>
				                       <th>Data Inici</th>
				                       <th>Tipologia</th>	               
				                       <th>Àrea Formativa</th>
				                       <th>Preu</th>
				                       <th>Desinscriure's</th>
				                     </tr>	
							        <?php 
							        	
										foreach($preinscripciones as $preinscripcion){           	
							         ?>
			                        <tr>
			                            <td><?php echo $preinscripcion->nombre;?></td>	                    
			                            <td><?php echo $preinscripcion->horas;?></td>
			                            <td><?php echo $preinscripcion->inicio;?></td>                     
			                            <td><?php echo $preinscripcion->tipologia;?></td>                     
			                            <td><?php echo $preinscripcion->area_formativa;?></td>                     
			                            <td><?php echo $preinscripcion->precio;?></td>
			                            <td><?php echo '<a href="index.php/curso/desinscribir/'.$preinscripcion->id.'"><img class="botones" src="images/style/delete.png"></a>'?>                    
		                            <?php			                    		
			                    		}			                    
		                    		?>	
			                        </tr>
			
			                    </table>
			                </div>
			            </div>
                    </div>
                    <label></label>
                        <input type="submit" name="modificar" value="modificar"/><br/>
                </form>
             
				
		</section>
		
		<?php 
            Template::footer();
            Template::jquery();
        ?>
    </body>
</html>