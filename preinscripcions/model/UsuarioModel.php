<?php
	class UsuarioModel{
		//PROPIEDADES
		public $id, $dni='', $password='', $nombre='', $apellido1='', $apellido2='', $fecha_nacimiento='', $direccion='', $cp='', $poblacion='', $telf_movil='', $telf_fijo='', $email='', $nivel_estudios='', $nombre_titulacion='', $otros='', $observaciones='', $en_activo=0, $razon_social='', $puesto_trabajo='', $regimen=0, $activo=0, $clave_activacion='', $admin=0, $imagen='', $timestamp='';
		//public $preinscripciones = array();	
		//METODOS
		//guarda el usuario en la BDD
		public function guardar(){
            $clave_activacion = Upload::generar_nombre(32);
			
			$user_table = Config::get()->db_user_table;
			$consulta = "INSERT INTO $user_table(dni, password, admin, email, imagen, activo, clave_activacion, timestamp)
			VALUES ('$this->dni','$this->password',0,'$this->email', '$this->imagen', 0, '$clave_activacion', default);";
			return Database::get()->query($consulta);

		}
		
		//actualiza los datos del usuario en la BDD
		public function actualizar(){
			$user_table = Config::get()->db_user_table;
			$consulta = "UPDATE $user_table
							  SET password='$this->password', 
							  		nombre='$this->nombre', 
							  		email='$this->email', 
							  		imagen='$this->imagen',
                                    apellido1='$this->apellido1',
                                    apellido2='$this->apellido2',                                    
                                    fecha_nacimiento='$this->fecha_nacimiento',
                                    direccion='$this->direccion',
                                    cp='$this->cp',
                                    poblacion='$this->poblacion',
                                    telf_movil='$this->telf_movil',
                                    telf_fijo='$this->telf_fijo',
                                    nivel_estudios='$this->nivel_estudios',
                                    nombre_titulacion='$this->nombre_titulacion',
                                    otros='$this->otros',
                                    observaciones='$this->observaciones',
                                    en_activo=$this->en_activo,
                                    razon_social='$this->razon_social',
                                    puesto_trabajo='$this->puesto_trabajo',
                                    regimen=$this->regimen,
                                    activo=$this->activo
							  WHERE dni='$this->dni';";
			return Database::get()->query($consulta);
		}
		
		
		//elimina el usuario de la BDD
        public static function getPreinscripciones($id){            
            $conexion = Database::get();                        
            
            $consulta = "SELECT c.* FROM cursos c, preinscripciones p, usuarios u WHERE u.id = $id 
            			AND p.id_curso = c.id AND  u.id= p.id_usuario AND c.activo = 1 ORDER BY p.timestamp ASC;";
           
            $resultados = $conexion->query($consulta);   
            $cursos = array();
            while ($curso = $resultados->fetch_object('CursoModel'))
            	$cursos[] = $curso;
            
            $resultados->free();
			
            return $cursos;
            //return $portadas;
        }
        
		public function borrar(){
			$user_table = Config::get()->db_user_table;
			$consulta = "DELETE FROM $user_table WHERE dni='$this->dni';";
			return Database::get()->query($consulta);
		}
		//La siguiente funciÃ³n se deberÃ¡ modificar teniendo en cuenta el servidor actual.
		public function enviarCorreo(){
			

			        // Destinatario
            $para  = $this->email; 

            // título
            $titulo = 'Sisplau activi el seu usuari';

            // mensaje
            $mensaje = '
            <html>
            <head>
              <title>Activació usuari</title>
            </head>
            <body>
              <p>Et donem la benvinguda a actiuhumà.</p><br/>
              <p>Per completar el registre i activar el teu compte, fes clic al següent enllaç:</p>
              <p><a href="http://www.pruebasdavidgriego.esy.es/index.php/Usuario/activar/&clave='.$this->clave_activacion.'">http://www.pruebasdavidgriego.esy.es/index.php/Usuario/activar/&clave='.$this->clave_activacion.'</a></p>
              <p>O copia el siguiente link en la barra de direcciones de tu navegador:</p>
              <p>http://www.pruebasdavidgriego.esy.es/index.php/Usuario/activar/&clave='.$this->clave_activacion.'</p>
              <br/><br><p>Gràcies</p><br/><p>Actiuhumà</p>
              <a href="http://www.actiuhuma.org">http://www.actiuhuma.org</a>  
            </html>
            ';


            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Cabeceras adicionales
            $cabeceras .= 'To: '.$this->email. "\r\n";
            $cabeceras .= 'From: Recordatorio <davidgriego@pruebasdavidgriego.esy.es>' . "\r\n";
            $cabeceras .= 'Cc: ' . "\r\n";
            $cabeceras .= 'Bcc: ' . "\r\n";

            // Enviarlo
            mail($para, $titulo, $mensaje, $cabeceras);
		}
		
		
		//este mÃ©todo sirve para comprobar user y password (en la BDD)
		public static function validar($u, $p){
			$user_table = Config::get()->db_user_table;
			$consulta = "SELECT * FROM $user_table WHERE dni='$u' AND password='$p';";
			$resultado = Database::get()->query($consulta);
			
			//si hay algun usuario retornar true sino false
			$r = $resultado->num_rows;
			$resultado->free(); //libera el recurso resultset
			return $r;
		}
		public static function validarActivo($u, $p){
			$user_table = Config::get()->db_user_table;
			$consulta = "SELECT * FROM $user_table WHERE dni='$u' AND password='$p' AND activo>0;";
			$resultado = Database::get()->query($consulta);
			
			//si hay algun usuario retornar true sino false
			$r = $resultado->num_rows;
			$resultado->free(); //libera el recurso resultset
			return $r;
		}

		//este mÃ©todo deberÃ­a retornar un usuario creado con los datos 
		//de la BDD (o NULL si no existe), a partir de un nombre de usuario
		public static function getUsuario($u){
			$user_table = Config::get()->db_user_table;
			$consulta = "SELECT * FROM $user_table WHERE dni='$u';";
			$resultado = Database::get()->query($consulta);
			
			$us = $resultado->fetch_object('UsuarioModel');            
			$resultado->free();
			
			return $us;
		}	
	}
?>
