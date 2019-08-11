<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class LoginController extends ControladorBase {
	public $options;
	public $identification_type;
	public $identification_number;
	public $user;
	
    public function __construct() {
        parent::__construct();
		if(isset($_SESSION['user']) && get_called_class() != 'LoginController'){
			@header("Location: /");
			exit();
		}
    }
	
    public function index(){
		$this->viewSystemInTemplate(
			"login", array(
				"options" => $this->options,
				"title" => "Bienvenid@",
				"subtitle" => "",
				"description" => "Por favor ingrese sus datos para acceder al portal."
			)
		);
    }
	
    public function login(){
		$this->viewSystemInTemplate(
			"password", array(
				"options" => $this->options,
				"title" => "Hola {$this->user->names}",
				"user" => $this->user,
				"subtitle" => "",
				"description" => "Por favor ingrese su contraseña para acceder."
			)
		);
	}
	
    public function error($title = "Error", $message = ""){
		if ($message == "" && isset($_GET['message'])) { $message = base64_decode($_GET['message']); }
		$this->viewSystemInTemplate(
			"loginError", array(
				"options" => $this->options,
				"title" => $title,
				"subtitle" => "",
				"description" => "Los datos estan incorrectos intenta nuevamente."
			)
		);
    }
	
	public function searchUserLogin($identification_type, $identification_number){
		$usuario = $this->user = new Usuario();
		
		if($identification_type != null && $identification_number != null){ $usuario->getByUsername("{$this->identification_type}:{$this->identification_number}"); };
		
		if($usuario->isUser()){ return true; } 
		else { return false; }
	}
}