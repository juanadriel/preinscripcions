<?php		
class Database{	
    //propiedad que almacenará la conexión establecida con la BDD (objeto mysqli)
	private static $conexion = null;	
	
	//método que establece o recupera la conexión.
	public static function get(){	
		//notifica los Warnings como errores.
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		//si no se había conectado antes...
		if(empty(self::$conexion)){	
			//recupera la configuración del sistema
			$cfg = Config::get(); 
			
			//conecta con la BDD y guarda el objeto mysqli en la propiedad estática $conexion
			self::$conexion = new mysqli($cfg->db_host, $cfg->db_user, $cfg->db_pass, $cfg->db_name);

			//establece el charset a UTF8
			self::$conexion->set_charset($cfg->db_charset);
		}
		return self::$conexion; //retornar la conexión
	}	
}
?>