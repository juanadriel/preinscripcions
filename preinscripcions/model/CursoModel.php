<?php
	class CursoModel{
		//PROPIEDADES
		public $id, $nombre='', $horas=0, $inicio='', $tipologia='', $area_formativa='', $precio=0, $activo=1;		
		public $usupre = array();
		//METODOS
		//guarda el curso en la BDD
		public function guardar(){			
			$consulta = "INSERT INTO cursos(id, nombre, horas, inicio, tipologia, area_formativa, precio, activo)
			VALUES (default, '$this->nombre',$this->horas,'$this->inicio','$this->tipologia', '$this->area_formativa',$this->precio,$this->activo);";				
			return Database::get()->query($consulta);
		}
        
        //actualiza los datos del usuario en la BDD
		public function modificar(){
			
			$consulta = "UPDATE cursos
							  SET nombre='$this->nombre', 
							  		horas=$this->horas, 
							  		inicio='$this->inicio', 
							  		tipologia='$this->tipologia',
                                    area_formativa='$this->area_formativa',
                                    precio=$this->precio,
                                    activo=$this->activo
							  WHERE id='$this->id';";            
			return Database::get()->query($consulta);
		}
		
		//listado de todos los cursos con filtros
		public function getCursos($fcurso='',$farea='',$ftipologia=''){
			$consulta = "SELECT * FROM cursos WHERE nombre LIKE '%$fcurso%' AND 
						area_formativa LIKE '%$farea%' AND tipologia LIKE '%$ftipologia%' 
						ORDER BY area_formativa ASC, tipologia ASC, nombre ASC;";
            
            $resultados = Database::get()->query($consulta);   
            $cursos = array();//preparo el array para los resultados
            
            //a partir de los resultados, crear objetos 'CursoModel' y los añadimos en el array
            while ($curso = $resultados->fetch_object('CursoModel')){            	
            	//$curso->getUsuariosPre();
            	$cursos[] = $curso;            	
            }
                //$cursos[] = $curso;                   
            
            $resultados->free();
            //echo '<pre>';
            //print_r($cursos);
            //echo '</pre>';
            return $cursos;
			
		}
		public static function desinscribir($idc, $idu){
			$consulta = "DELETE FROM preinscripciones WHERE id_curso = $idc AND id_usuario = $idu;";
			$conexion = Database::get();
			$conexion->query($consulta);
			
			return $conexion->affected_rows;
					
		}
		//listado de un curso con sus preinscripciones
		public static function getCurso($id=0){
			$consulta = "SELECT * FROM cursos WHERE id=$id;";		
			$resultados = Database::get()->query($consulta);		
		
			//a partir de los resultados, crear objetos 'CursoModel' y los añadimos en el array
			$curso = $resultados->fetch_object('CursoModel');
			$curso->getUsuariosPre();				
			//$cursos[] = $curso;
		
			$resultados->free();
			//echo '<pre>';
			//print_r($curso);
			//echo '</pre>';
			return $curso;
				
		}
		private function getUsuariosPre(){
					
			//preparar consulta
			$consulta = "SELECT u.* FROM usuarios u, preinscripciones p, cursos c 
			WHERE u.id=p.id_usuario AND p.id_curso=c.id AND c.id=$this->id ORDER BY p.timestamp ASC;";
			
			$resultados = Database::get()->query($consulta);
			
			//$portadas = array();
			while($linea = $resultados->fetch_object('UsuarioModel'))
			{
				$this->usupre[] = $linea;
			}			
			$resultados->free();
			
			//return $portadas;
		}
        //borrar un curos
		public static function borrar($id){
			//conectar con la bdd
			$conexion = Database::get();
		
			//preparar consulta
			$consulta = "DELETE FROM cursos WHERE id=$id;";
			$conexion->query($consulta);
			return $conexion->affected_rows;
		}
         //preinscribirse en un curso
         public static function preinscribir($idc,$idu){
            //preparar consulta
            $consulta = "INSERT INTO preinscripciones (id_curso, id_usuario,timestamp) VALUES
            		($idc,$idu,default);"; 
           
            return Database::get()->query($consulta);
        }
	}
?>