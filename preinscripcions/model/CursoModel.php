<?php
	class CursoModel{
		//PROPIEDADES
		public $id, $nombre='', $horas=0, $inicio='', $tipologia='', $area_formativa='', $precio=0, $activo=1;		
			
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
            while ($curso = $resultados->fetch_object('CursoModel'))                
                $cursos[] = $curso;                   
            
            $resultados->free();
            //echo '<pre>';
            //print_r($cursos);
            //echo '</pre>';
            return $cursos;
			
		}
        
         //recuperar un curso a partir de un id
         public static function getCurso($id){
            //conectar con la bdd
            $conexion = Database::get();

            //preparar consulta
            $consulta = "SELECT * FROM cursos WHERE id=$id;";  
            $resultado = $conexion->query($consulta);  
            $curso = $resultado->fetch_object('CursoModel'); 
            $resultado->free();
            return $curso;
        }
	}
?>