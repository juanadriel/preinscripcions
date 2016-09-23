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
			<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr class="info">
							<th>Nom</th>
							<th>Cognoms</th>
							<th>DNI</th>
							<th>Població<th>
							<th>Telf Mòbil</th>
							<th>Telf Fixe</th>
							<th>Email</th>
							<th>Situació</th>							
						</tr>
						<pre>
							<?php print_r($curso);?>
						</pre>
						<?php 							
							foreach($curso->usupre as $usu){
								echo '<tr>';								
									
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
