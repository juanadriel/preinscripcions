<?php
	//CONTROLADOR POR DEFECTO
	//Si el controlador frontal no recibe controlador ni operación,
	//invoca por defecto el método index() del controlador CursosController
	class Curso extends Controller{
		
		//Método por defecto
		//Carga la portada del sitio (vista portada.php)
		public function index(){
				//preparar los datos a pasar a la vista
				$datos = array('usuario'=>Login::getUsuario());
				
				//cargar la vista
				$this->load_view('view/portada.php', $datos);
		}
		//PROCEDIMIENTO PARA DAR DE ALTA UN NUEVO CURSO
		public function alta(){
			//tiene que ser admin para poder dar de alta un curso
			$u = Login::getUsuario();
			if(empty($u) || !$u->admin)
				throw new Exception('Debes estar identificado como administrador para poder crear un curso');
			
            //si no llegan los datos a guardar
			if(empty($_POST['guardar'])){				
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = $u;
				//$datos['max_image_size'] = Config::get()->user_image_max_size;
				$this->load_view('view/cursos/alta.php', $datos);
			
			//si llegan los datos por POST
			}else{
				//crear una instancia de Curso
				$c = new CursoModel();
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$c->nombre = $conexion->real_escape_string($_POST['nombre']);
				$c->horas = intval($_POST['horas']);
				$c->inicio = $conexion->real_escape_string($_POST['inicio']);
				$c->tipologia = $conexion->real_escape_string($_POST['tipologia']);				
				$c->area_formativa = $conexion->real_escape_string($_POST['area_formativa']);
				$c->precio = floatval($_POST['precio']);				
				$c->activo = isset($_POST['activo']) ? 1 : 0;
											
				//guardar el curso en BDD
				if(!$c->guardar())
					throw new Exception('No se pudo dar de alta el curso');
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = $u;
				$datos['mensaje'] = 'Operación de alta nuevo curso completada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}	
		
		//PROCEDIMIENTO PARA MODIFICAR UN CURSO
		public function edit($id){
            if(empty($id))
                throw new Exception('No se indico el curso a modificar');
            
            //tiene que ser admin
            $u = Login::getUsuario();
			if(empty($u) || !$u->admin)
				throw new Exception('Debes estar identificado como administrador para poder modificar un curso');			
            
            //si no llegan los datos a guardar
			if(empty($_POST['guardar'])){				
                //mostramos la vista del formulario	
                $curso = CursoModel::getCurso($id);
                //si no existe el curso, exception
                if(empty($curso))
                    throw new Exception('No existe el curso solicitado');

                //preparar los datos que se le pasaran a la vista 
                $datos = array();
                //usuario activo en el sistema
                $datos['usuario'] = $u;
                $datos['curso'] = $curso;
                //cargar la vista que muestra el listado
                $this->load_view('view/cursos/modificar.php',$datos); 	
                
            // si llegan los datos por post
            }else{
                $c = new CursoModel();
				$conexion = Database::get();				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
                $c->id = intval($id);
				$c->nombre = $conexion->real_escape_string($_POST['nombre']);
				$c->horas = intval($_POST['horas']);
				$c->inicio = $conexion->real_escape_string($_POST['inicio']);
				$c->tipologia = $conexion->real_escape_string($_POST['tipologia']);				
				$c->area_formativa = $conexion->real_escape_string($_POST['area_formativa']);
				$c->precio = floatval($_POST['precio']);			
                $c->activo = isset($_POST['activo']) ? 1 : 0;
                //guardar
                if (!$c->modificar())
                    throw new Exception('No se pudo guardar el curso');

                
                //mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Modificación OK';
				$this->load_view('view/exito.php', $datos);
            }
		}
		
		//PROCEDIMIENTO PARA DAR DE BAJA UN CURSO
		//solicita confirmación
		public function eliminar($id){				
			//comprobar que nos pasan la id
			if(empty($id))
				throw new Exception("No s'ha indicat el curs a eliminar");
			
				//comprobar si el usuario es administrador
				$u = Login::getUsuario();
				if(empty($u) || !$u->admin)
					throw new Exception ('Només per al administrador');
					else{
						//cargamos el modelo
						$this->load('model/CursoModel.php');
						
						CursoModel::borrar($id);
						//mostrar la vista de éxito
						$datos = array();
						$datos['usuario'] = Login::getUsuario();
						$datos['mensaje'] = 'Curs eliminat correctament';
						$this->load_view('view/exito.php', $datos);
					}
		}
		
		//PROCEDIMIENTO PARA LISTAR LOS CURSOS
		public function listar(){             
            $fcurso = empty($_POST['fcurso'])? '' : Database::get()->real_escape_string($_POST['fcurso']);
            $farea = empty($_POST['farea'])? '' : Database::get()->real_escape_string($_POST['farea']);
			$ftipologia = empty($_POST['ftipologia'])? '' : Database::get()->real_escape_string($_POST['ftipologia']);
            
            //preparar los datos que se le pasaran a la vista            
            $datos = array();
            //usuario activo en el sistema
            $datos['usuario'] = Login::getUsuario();
            $datos['fcurso'] = $fcurso;
            $datos['farea'] = $farea;
			$datos['ftipologia'] = $ftipologia;
            //listado de juegos
            $datos['cursos'] = CursoModel::getCursos($fcurso, $farea, $ftipologia);           
            
            //cargar la vista que muestra el listado
            $this->load_view('view/cursos/listar.php',$datos);            
        }
        //PROCEDIMIENTO PARA LISTAR LOS USUARIOS PREINSCRITOS EN EL CURSO
        public function ver($id){
        	//cargar la vista que muestra el listado        	
        	//preparar los datos que se le pasaran a la vista
        	$datos = array();
        	//usuario activo en el sistema
        	$datos['usuario'] = Login::getUsuario();
        	$datos['curso']=CursoModel::getCurso($id);
        	$this->load_view('view/cursos/detalle.php',$datos);
        }
        //procedimiento para preinscribir a los usuarios en un curso
        public function preinscribir($id){       	
        		$u = Login::getUsuario();
        		if($u->activo == 1)
        			throw new Exception("registre d'usuari incomplet, si vols inscriure't completa les dades d'usuari.");        			 
        		
        		if(!CursoModel::preinscribir($id,$u->id))
        			throw new Exception('Error al fer la preinscripció');
        			
        		$datos = array();
        		//usuario activo en el sistema
        		$datos['usuario'] = Login::getUsuario();        			
       			$datos['mensaje'] = 'Preinscripció realitzada amb éxit';
       			$this->load_view('view/exito.php', $datos);       	
        		
        }
        
        //PROCEDIMIENTO PARA DESINSCRIBIR A LOS USUARIOS DE UN CURSO
        
        public function desinscribir($cid){
        	$u = Login::getUsuario();
        	if($u == null)
        		throw new Exception("Has d'estar registrat per continuar.");
        	
        	if(!CursoModel::desinscribir($cid, $u->id))
        		throw new Exception("No s'ha pogut eliminar la preinscripció");
        	
        	$datos = array();
        	$datos['usuario'] = Login::getUsuario();
        	$datos['mensaje'] = 'Preinscripció eliminada correctament';
        	$this->load_view('view/exito.php', $datos);
        }
	}//fin clase
?>