<?php
	class Template{	
		
		//PONE EL HEADER DE LA PAGINA
		public static function header($usuario){
			?>
			<div class="container">	
				<br/>	
				<header>
					<h1>Actiu huma</h1>
					<?php
						self::menu($usuario);
					?>										
				</header>
			</div>
			<?php
		}
		public static function boots(){
			?>
			<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
			<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">			
			<?php
		}
		public static function jquery(){
			?>
				<script src="js/jquery.js"></script>
				<script src="js/bootstrap.min.js"></script>
			<?php
		}
		
		//PONE EL FORMULARIO DE LOGIN
		public static function login(){
			?>			
				<form method="post" id="login" class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" name="dni" class="form-control" placeholder="User"/>
						<input type="password" name="password" class="form-control" placeholder="Password"/>
						<button name="login" value="Login" class="btn btn-primary">Login</button>
					</div>
				</form>
			
			<?php 
		}
		
		//PONE LA INFO DEL USUARIO IDENTIFICADO Y EL FORMULARIOD E LOGOUT
		public static function logout($usuario){
			?>			
			<form method="post" id="logout" class="navbar-form navbar-right">
				<div class="form-group">
					<a href="index.php?controlador=Usuario&operacion=modificacion" title="modificar datos">
						<?php echo !empty($usuario->nombre)?$usuario->nombre:'Usuario';?></a>					
					<button name="logout" value="logout" class="btn btn-primary">Logout</button>
				</div>	
			</form>
			<?php 
		}
		
		
		//PONE EL MENU DE LA PAGINA
		public static function menu($usuario){
			?>
			<nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
							<span class="sr-only">Menú</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- <a href="#" class="navbar-brand">David</a>-->
					</div>
					<div class="collapse navbar-collapse" id="navbar-1">
						<ul class="nav navbar-nav">
			                <li><a href="index.php">Inicio</a></li>			                
			                <?php if(empty($usuario->admin)){
                             echo '<li><a href="index.php/Usuario/registro">Registrarse</a></li>';
			                 echo '<li><a href="index.php/Curso/listar">Llistat de Cursos</a></li>';
                            }?>
                            <?php if(!empty($usuario) && $usuario->admin){?>
			                 <li class="dropdown">
							 	<a data-toggle="dropdown" class="dropdown-toggle" href="#">Cursos <b class="caret"></b></a>
								<ul role="menu" class="dropdown-menu">
									<li><a href="index.php/Curso/alta">Nou Curs</a></li>
									<li><a href="index.php/Curso/listar">Llistat de Cursos</a></li>									
								</ul>
							 </li>										                
		                <?php 
		            	}?>	
				    	</ul>
				    	<?php
				    	if(!$usuario) Template::login();
						else Template::logout($usuario);
						?>                        
					</div>
					
				   
			    </div>
		    </nav>
			<?php 
		}
		
		//PONE EL PIE DE PAGINA
		public static function footer(){
			?>
			<footer>
				<div class="container">
					<div class="row">
						<div class="col-xs-6">
							<p>&copy;2016 Kriticon Valley All Rights Reserved - Developed by DarthVid Studio 2016</p>
						</div>
					</div>
				</div>	
			</footer>
			<?php
		}
		
	}
?>