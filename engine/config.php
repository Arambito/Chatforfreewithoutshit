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
	private $user = 'u546362297_root';
	// Contrase�a
	private $pass = 'a7nKoE80xq4Si5Q&';
	// Base de datos
	private $datab = 'u546362297_chatphp';
	
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
			'www'    =>    'https://chatforfreewithoutshit.com',
			// Nombre de tu sitio web
			'name'   =>    'ChatWoutShit'
		);
		
		return $datoss[$a];
		
	} 
}
?>