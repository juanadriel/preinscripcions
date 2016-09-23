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
                                <option <?php if(!strcmp($farea,"Administració")) echo "selected ='selected'";?> value="Administració">Administració</option>
                                <option <?php if(!strcmp($farea,"Habilitats interpersonals")) echo "selected ='selected'";?> value="Habilitats interpersonals">Habilitats interpersonals</option>
                                <option <?php if(!strcmp($farea,"Informàtica / Noves tecnologies")) echo "selected ='selected'";?> value="Informàtica / Noves tecnologies">Informàtica / Noves tecnologies</option>
                                <option <?php if(!strcmp($farea,"Sociosanitàries")) echo "selected ='selected'";?> value="Sociosanitàries">Sociosanitàries</option>
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
                       <th>Actiu</th>
                       <?php if(!empty($usuario) && $usuario->admin){                          
                           echo '<th>Opcions</th>';
                        }
                       ?>
                       <?php if(empty($usuario->admin) && !empty($usuario))
                       
                           echo '<th>Preinscripció</th>';
                        ?>		   

                     </tr>	
                    <?php 
                    foreach($cursos as $curso){
                        ?>
                        <tr>
                            <td class="<?php echo ($curso->activo)?'success':'danger';?>"><?php echo $curso->nombre;?></td>	                    
                            <td class="<?php echo ($curso->activo)?'success':'danger';?>"><?php echo $curso->horas;?></td>
                            <td class="<?php echo ($curso->activo)?'success':'danger';?>"><?php echo $curso->inicio;?></td>                     
                            <td class="<?php echo ($curso->activo)?'success':'danger';?>"><?php echo $curso->tipologia;?></td>                     
                            <td class="<?php echo ($curso->activo)?'success':'danger';?>"><?php echo $curso->area_formativa;?></td>                    
                            <td class="<?php echo ($curso->activo)?'success':'danger';?>"><?php echo $curso->precio;?></td>  
                            <?php 
                            	$foto = ($curso->activo)?'abierto.png':'cerrado.png';                            	
                            	echo '<td><img class="botones" src="images/style/'.$foto.'"></td>';
                            ?>  
                            <?php if(!empty($usuario) && $usuario->admin){
                                echo '<td><a href="index.php/curso/eliminar/'.$curso->id.'"><img class="botones" src="images/style/delete.png"></a><a href="index.php/curso/edit/'.$curso->id.'"><img class="botones" src="images/style/edit.png"></a>
								<a href="index.php/curso/ver/'.$curso->id.'"><img class="botones" src="images/style/ver.png"></a>';                                
                            }?>
                            <?php if(empty($usuario->admin) && !empty($usuario))
                                echo '<td><a href="index.php/curso/preinscribir/'.$curso->id.'"><img class="botones" src="images/style/edit.png"></a></td>';    
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