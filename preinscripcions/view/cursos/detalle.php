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
			<h2>Preinscripcions del curs  <?php echo $curso->nombre?></h2>
			<div class="row quitarmargen">
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
                     </tr>	                    
                        <tr>
                            <td><?php echo $curso->nombre;?></td>	                    
                            <td><?php echo $curso->horas;?></td>
                            <td><?php echo $curso->inicio;?></td>                     
                            <td><?php echo $curso->tipologia;?></td>                     
                            <td><?php echo $curso->area_formativa;?></td>                     
                            <td><?php echo $curso->precio;?></td> 
                            <?php 
                            	$foto = ($curso->activo)?'abierto.png':'cerrado.png';
                            	echo '<td><img class="botones" src="images/style/'.$foto.'"></td>';
                            ?>                             
                        </tr>
                    </table>
                </div>
            </div>
            <h2>Preinscripcions del curs  <?php echo $curso->nombre?></h2>
			<div class="row quitarmargen">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr class="info">
							<th>Nom</th>
							<th>Cognoms</th>
							<th>DNI</th>
							<th>Poblacio</th>
							<th>Telf Mòbil</th>
							<th>Telf Fixe</th>
							<th>Email</th>
							<th>Situació</th>							
						</tr>						
						<?php 							
							foreach($curso->usupre as $usu){
								echo '<tr>';								
									echo "<td>$usu->nombre</td>";
									echo "<td>".$usu->apellido1.' '.$usu->apellido2."</td>";
									echo "<td>$usu->dni</td>";
									echo "<td>$usu->poblacion</td>";
									echo "<td>$usu->telf_movil</td>";
									echo "<td>$usu->telf_fijo</td>";
									echo "<td>$usu->email</td>";
									if($usu->en_activo)
										echo "<td>En Actiu</td>";
									else 
										echo "<td>A l'Atur</td>";
									//echo '<td>'.($usu->en_activo==1)?'En actiu':"A atur".'</td>';
								echo '</tr>';
							}	
						?>						
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