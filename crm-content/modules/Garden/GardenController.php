<?php 
Class GardenController extends ControladorBase {
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->viewInTemplate("index", array(
			"title" => "Catálogo"
		));
	}
	
	public function garden_fields(){
		$this->viewInTemplate("fields", array(
			"title" => "Catálogo - Fields"
		));
	}
}