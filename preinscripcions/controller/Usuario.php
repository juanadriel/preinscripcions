<?php
	//CONTROLADOR USUARIO 
	// implementa las operaciones que puede realizar el usuario
	class Usuario extends Controller{

		//PROCEDIMIENTO PARA REGISTRAR UN USUARIO
		public function registro(){

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
				
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['max_image_size'] = Config::get()->user_image_max_size;
				$this->load_view('view/usuarios/registro.php', $datos);
			
			//si llegan los datos por POST
			}else{
				//crear una instancia de Usuario
				$u = new UsuarioModel();
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$u->dni = $conexion->real_escape_string($_POST['dni']);
				$u->password = MD5($conexion->real_escape_string($_POST['password']));				
				$u->email = $conexion->real_escape_string($_POST['email']);
				$u->imagen = Config::get()->default_user_image;
				
				//recuperar y guardar la imagen (solamente si ha sido enviada)
				if($_FILES['imagen']['error']!=4){
					//el directorio y el tam_maximo se configuran en el fichero config.php
					$dir = Config::get()->user_image_directory;
					$tam = Config::get()->user_image_max_size;
					
					$upload = new Upload($_FILES['imagen'], $dir, $tam);
					$u->imagen = $upload->upload_image();
				}
								
				//guardar el usuario en BDD
				if(!$u->guardar())
					throw new Exception('No se pudo registrar el usuario');
                
                $u2= UsuarioModel::getUsuario($u->dni);                 
				$u2->enviarCorreo();
				//mostrar la vista de éxito
				$datos = array();
                $datos['mensaje'] = "asdf";
				$datos['usuario'] = $u2;
				$this->load_view('view/exito.php', $datos);
			}
		}

		public function activar(){
			
			if(empty($_GET['clave']))
				throw new Exception("Ho sentim, codi d'activació inexistent.");
            $conexion = Database::get();

			$clave = $conexion->real_escape_string($_GET['clave']);
			$sql = "SELECT * FROM usuarios WHERE clave_activacion='".$clave."';";
            
            $resultado = Database::get()->query($sql);
            $val_usuario = $resultado->fetch_object('UsuarioModel');
            $datos = array ();
            $datos['mensaje'] = "Operació d'activació completada amb éxit";
            $datos['usuario'] = Login::getUsuario();
            
            if($val_usuario->activo > 0){
                
				$this->load_view('view/exito.php', $datos);
            }else{
                if($resultado->num_rows==0) {
                    throw new Exception("Ho sentim, codi d'activació inexistent.");
                }else{

                    Database::get()->query("UPDATE usuarios SET activo = 1 , clave_activacion = '' WHERE id = $val_usuario->id;");

                    $this->load_view('view/exito.php', $datos);
                }
            }
		}	

		//PROCEDIMIENTO PARA MODIFICAR UN USUARIO
		public function modificacion(){
			//si no hay usuario identificado... error
			$u = Login::getUsuario();
			if(!Login::getUsuario())
				throw new Exception('Debes estar identificado para poder modificar tus datos');
			if(!$u->activo)	
				throw new Exception('Debe activar su registro mediante el enlace que se le envió a su cuenta de correo.');
		
			//si no llegan los datos a modificar
			if(empty($_POST['modificar'])){
				
				//mostramos la vista del formulario
				$u = Login::getUsuario();
				$datos = array();
				$datos['usuario'] = $u;
				$datos['preinscripciones'] = UsuarioModel::getPreinscripciones($u->id);
				$datos['max_image_size'] = Config::get()->user_image_max_size;
				$this->load_view('view/usuarios/modificacion.php', $datos);
					
				//si llegan los datos por POST
			}else{
				//recuperar los datos actuales del usuario
				$u = Login::getUsuario();
				$conexion = Database::get();
				
				//comprueba que el usuario se valide correctamente
				$p = MD5($conexion->real_escape_string($_POST['password']));
				if($u->password != $p)
					throw new Exception('El password no coincide, no se puede procesar la modificación');
								
				//recupera el nuevo password (si se desea cambiar)
				if(!empty($_POST['newpassword']))
					$u->password = MD5($conexion->real_escape_string($_POST['newpassword']));
				
				//recupera el nuevo nombre y el nuevo email
				$u->nombre = $conexion->real_escape_string($_POST['nombre']);
				$u->email = $conexion->real_escape_string($_POST['email']);
                $u->dni = $conexion->real_escape_string($_POST['dni']);                
                $u->apellido1 = $conexion->real_escape_string($_POST['apellido1']);
                $u->apellido2 = $conexion->real_escape_string($_POST['apellido2']);
                $u->fecha_nacimiento = $conexion->real_escape_string($_POST['fecha_nacimiento']);                
                $u->direccion = $conexion->real_escape_string($_POST['direccion']);
                $u->cp = $conexion->real_escape_string($_POST['cp']);
                $u->poblacion = $conexion->real_escape_string($_POST['poblacion']);                
                $u->telf_movil = $conexion->real_escape_string($_POST['telf_movil']);
                $u->telf_fijo = $conexion->real_escape_string($_POST['telf_fijo']);
                $u->nivel_estudios = empty($_POST['nivel_estudios'])?'':$conexion->real_escape_string($_POST['nivel_estudios']);             
                $u->nombre_titulacion = $conexion->real_escape_string($_POST['nombre_titulacion']);
                $u->otros = $conexion->real_escape_string($_POST['otros']);
                $u->observaciones = $conexion->real_escape_string($_POST['observaciones']);                
                $u->en_activo = $conexion->real_escape_string($_POST['en_activo']);
                $u->razon_social = $conexion->real_escape_string($_POST['razon_social']);
                $u->puesto_trabajo = $conexion->real_escape_string($_POST['puesto_trabajo']);                
                $u->regimen = empty($_POST['nivel_estudios'])?'':$conexion->real_escape_string($_POST['regimen']);
                $u->activo = 2;

						
				//TRATAMIENTO DE LA NUEVA IMAGEN DE PERFIL (si se indicó)
				if($_FILES['imagen']['error']!=4){
					//el directorio y el tam_maximo se configuran en el fichero config.php
					$dir = Config::get()->user_image_directory;
					$tam = Config::get()->user_image_max_size;
					
					//prepara la carga de nueva imagen
					$upload = new Upload($_FILES['imagen'], $dir, $tam);
					
					//guarda la imagen antigua en una var para borrarla 
					//después si todo ha funcionado correctamente
					$old_img = $u->imagen;
					
					//sube la nueva imagen
					$u->imagen = $upload->upload_image();
				}
				
				//modificar el usuario en BDD
				if(!$u->actualizar())
					throw new Exception('No se pudo modificar');
		
				//borrado de la imagen antigua (si se cambió)
				//hay que evitar que se borre la imagen por defecto
				if(!empty($old_img) && $old_img!= Config::get()->default_user_image)
					@unlink($old_img);
						
				//hace de nuevo "login" para actualizar los datos del usuario
				//desde la BDD a la variable de sesión.
				Login::log_in($u->dni, $u->password);
					
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Modificación OK';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		
		//PROCEDIMIENTO PARA DAR DE BAJA UN USUARIO
		//solicita confirmación
		public function baja(){		
			//recuperar usuario
			$u = Login::getUsuario();
			
			//asegurarse que el usuario está identificado
			if(!$u) throw new Exception('Debes estar identificado para poder darte de baja');
			
			//si no nos están enviando la conformación de baja
			if(empty($_POST['confirmar'])){	
				//carga el formulario de confirmación
				$datos = array();
				$datos['usuario'] = $u;
				$this->load_view('view/usuarios/baja.php', $datos);
		
			//si nos están enviando la confirmación de baja
			}else{
				//validar password
				$p = MD5(Database::get()->real_escape_string($_POST['password']));
				if($u->password != $p) 
					throw new Exception('El password no coincide, no se puede procesar la baja');
				
				//de borrar el usuario actual en la BDD
				if(!$u->borrar())
					throw new Exception('No se pudo dar de baja');
						
				//borra la imagen (solamente en caso que no sea imagen por defecto)
				if($u->imagen!=Config::get()->default_user_image)
					@unlink($u->imagen); 
			
				//cierra la sesion
				Login::log_out();
					
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = null;
				$datos['mensaje'] = 'Eliminado OK';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
	}
?>