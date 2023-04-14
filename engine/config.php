<?php
//####################################################################

//    ########::'####:'########::'#######::
//    ##.... ##:. ##::... ##..::'##.... ##:
//    ##:::: ##:: ##::::: ##:::: ##:::: ##:
//    ########::: ##::::: ##:::: ##:::: ##:
//    ##.... ##:: ##::::: ##:::: ##:::: ##:
//    ##:::: ##:: ##::::: ##:::: ##:::: ##:
//    ########::'####:::: ##::::. #######::
//    
//                                       
//####################################################################

class Conexion extends mysqli {
	
	// Servidor
	private $host = 'localhost';
	// Usuario
	private $user = 'root';
	// Contrase�a
	private $pass = '';
	// Base de datos
	private $datab = 'chatphp';
	
	public function __construct() {
		
		parent::__construct($this->host, $this->user, $this->pass, $this->datab);
		
		if($this->connect_errno) {
			die('Error en la conexi�n: ' . $this->connect_error);
		} else {
		    $this->query("SET NAMES 'utf8';");
		}
		
	}
	
}

class datos {
	public function sitio($a) {
		
		$datoss = array(
		    // URL del sitio web con http://
			'www'    =>    'http://localhost:6404',
			// Nombre de tu sitio web
			'name'   =>    'Chat PHP'
		);
		
		return $datoss[$a];
		
	} 
}
?>