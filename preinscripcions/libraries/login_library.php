<?php 
	class Login{
		//PROPIEDADES
		//propiedad estática que contiene el usuario 
		//actual identificado en el sistema
		private static $usuario = null;
		
		//METODOS
		//devuelve el usuario que está identificado en el sistema
		public static function getUsuario(){
			return self::$usuario;
		}
		
		//devuelve true si hay un usuario admin identificado
		public static function isAdmin(){
			return self::$usuario && self::$usuario->admin;
		}
						
		//Método que gestiona las operaciones de login-logout
		//Almacena en la variable estática Login::$usuario el 
		//usuario actual identificado en el sistema
		public static function comprobar(){
			
			//si piden hacer login, hacemos login
			if(!empty($_POST['login'])){

				$c = Database::get();
				$u = $c->real_escape_string($_POST['dni']);
				$p = MD5($c->real_escape_string($_POST['password']));
				
				self::log_in($u,$p);
			}
			
			//si piden hacer logout, hacemos logout
			if(!empty($_POST['logout'])) 
				self::log_out();
			
			//recupera la información de la var de sesión
			//para guardarla en la var Login::$usuario.
			self::$usuario = empty($_SESSION['dni'])? null : unserialize($_SESSION['dni']);		
		}
		
		//método que realiza la operación de login:
		//- Comprueba que user y password sean correctos
		//- Recupera los datos del usuario
		//- Crea la variable de sesión con los datos recuperado
		public static function log_in($u, $p){	
			if(!UsuarioModel::validar($u, $p))
					throw new Exception('Error en la identificacion');
			
			if(!UsuarioModel::validarActivo($u, $p))
					throw new Exception('Debe activar su registro mediante el enlace que se le envió a su cuenta de correo.');
			$_SESSION['dni'] = serialize(UsuarioModel::getUsuario($_POST['dni']));					
		}
		
		//método que finaliza la sesión
		//se usará cuando se hace logout o se da de baja el usuario activo
		public static function log_out(){
			session_unset(); 	//vacía el array $_SESSION
			session_destroy(); 	//destruye la sesión
			
			//pone a null la variable que indica el usuario
			//actual identificado en el sistema
			self::$usuario = null;
			
			//elimina la cookie de sesión
			$p = session_get_cookie_params();
			setcookie(session_name(),'',time()-1000,$p['path'],$p['domain'],$p['secure'],$p['httponly']);
		}
	}
?>