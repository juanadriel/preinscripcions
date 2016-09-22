<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Llistat de Cursos</title>
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
			<h2>Llistat de cursos</h2>
			<div class="row">
                <form method="post" class="filtro form-inline">
                    <div class="form-group">
                        <label for="fcurso">Curs</label>
                        <input class="form-control" type="text" name="fcurso" value="<?php echo $fcurso;?>" placeholder="Curs"/>				
                    </div>

<!--
                    <div class="form-group">
                        <label for="farea">Àrea</label>
                        <input class="form-control" type="text" name="farea" value="<?php echo $farea;?>" placeholder="Àrea"/>				
                    </div>
-->
                    
                    <div class="form-group">
                        <label for="farea">Àrea</label>
                        <select id="farea" name="farea" class="form-control" value="<?php echo $farea;?>" placeholder="Àrea">
                                <option <?php if(!strcmp($farea,"")) echo "selected ='selected'";?> value="">Totes</option>
                                <option <?php if(!strcmp($farea,"Activitats físiques i espotives")) echo "selected ='selected'";?> value="Activitats físiques i espotives">Activitats físiques i espotives</option>
                                <option <?php if(!strcmp($farea,"Administració i gestió")) echo "selected ='selected'";?> value="Administració i gestió">Administració i gestió</option>
                                <option <?php if(!strcmp($farea,"Agrària")) echo "selected ='selected'";?> value="Agrària">Agrària</option>
                                <option <?php if(!strcmp($farea,"Arts gràfiques")) echo "selected ='selected'";?> value="Arts gràfiques">Arts gràfiques</option>
                                <option <?php if(!strcmp($farea,"Arts i artesania")) echo "selected ='selected'";?> value="Arts i artesania">Arts i artesania</option>
                                <option <?php if(!strcmp($farea,"Comerç i màrqueting")) echo "selected ='selected'";?> value="Comerç i màrqueting">Comerç i màrqueting</option>
                                <option <?php if(!strcmp($farea,"Edificació i obra civil")) echo "selected ='selected'";?> value="Edificació i obra civil">Edificació i obra civil</option>
                                <option <?php if(!strcmp($farea,"Electricitat i electrònica")) echo "selected ='selected'";?> value="Electricitat i electònica">Electricitat i electrònica</option>
                                <option <?php if(!strcmp($farea,"Energia i aigua")) echo "selected ='selected'";?> value="Energia i aigua">Energia i aigua</option>
                                <option <?php if(!strcmp($farea,"Fabricació mecànica")) echo "selected ='selected'";?> value="Fabricació mecànica">Fabricació mecànica</option>
                                <option <?php if(!strcmp($farea,"Informàtica i comunicacions")) echo "selected ='selected'";?> value="Informàtica i comunicacions">Informàtica i comunicacions</option>
                        </select>  
                    </div>		

                    <div class="form-group">
                        <label for="ftipologia">Tipologia:</label>
                        <select id="ftipologia" name="ftipologia" class="form-control" value="<?php echo $ftipologia;?>" placeholder="Tipologia">
                                <option <?php if(!strcmp($ftipologia,"")) echo "selected ='selected'";?> value="">Totes</option>
                                <option <?php if(!strcmp($ftipologia,"FOAP")) echo "selected ='selected'";?> value="FOAP">FOAP</option>
                                <option <?php if(!strcmp($ftipologia,"Formació Consorci")) echo "selected ='selected'";?> value="Formació Consorci">Formació Consorci</option>
                                <option <?php if(!strcmp($ftipologia,"Formació Bonificable")) echo "selected ='selected'";?> value="Formació Bonificable">Formació Bonificable</option>
                                <option <?php if(!strcmp($ftipologia,"Tallers")) echo "selected ='selected'";?> value="Tallers">Tallers</option>
                                <option <?php if(!strcmp($ftipologia,"Blocs Formatius")) echo "selected ='selected'";?> value="Blocs Formatius">Blocs Formatius</option>
                                <option <?php if(!strcmp($ftipologia,"Altres")) echo "selected ='selected'";?> value="Altres">Altres</option>
                        </select>  
                    </div>			


                    <div class="form-group">				
                        <Button class="btn btn-primary" name="filtrar" value="filtrar">Filtrar</Button>
                    </div>	
                </form>	
                <br/>		
            </div>
            
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
                       <?php if(!empty($usuario) && $usuario->admin){
                           echo '<th>Actiu</th>';
                           echo '<th>Opcions</th>';
                        }
                       ?>
                       <?php if(empty($usuario->admin))
                           echo '<th>Preinscripció</th>';
                        ?>		   

                     </tr>	
                    <?php                    
                    foreach($cursos as $curso){
                    	
                        ?>
                        <tr>
                            <td><?php echo $curso->nombre;?></td>	                    
                            <td><?php echo $curso->horas;?></td>
                            <td><?php echo $curso->inicio;?></td>                     
                            <td><?php echo $curso->tipologia;?></td>                     
                            <td><?php echo $curso->area_formativa;?></td>                     
                            <td><?php echo $curso->precio;?></td>                     
                            <?php if(!empty($usuario) && $usuario->admin){
                                echo "<td>$curso->activo</td>"; 
                                echo '<td><a href="index.php/curso/eliminar/'.$curso->id.'"><img class="botones" src="images/style/delete.png"></a><a href="index.php/curso/edit/'.$curso->id.'"><img class="botones" src="images/style/edit.png"></a>';
                            }?>
                            <?php if(empty($usuario->admin))
                                echo '<td><a href="index.php/curso/edit/'.$curso->id.'"><img class="botones" src="images/style/edit.png"></a></td>';    
                            }?>	
                        </tr>

                    </table>
                </div>
            </div>
		</section>
		
		<?php 
            Template::footer();
            Template::jquery();
        ?>
    </body>
</html>