<?php 
class PicturesModel extends ModeloBase {
    private $table;
     
    public function __construct(){
        $this->table = TBL_PICTURES;
        parent::__construct($this->table);
    }
     
    //Metodos de consulta
    public function getUnPicture(){
        $query = "SELECT * FROM " . TBL_PICTURES . " LIMIT 1";
        $usuario = $this->ejecutarSql($query);
        return ($usuario);
    }
	
    public function getAll(){
        $p = parent::getAll();
		$a = array();
		foreach($p as $b){
			$a[] = new Picture($b);
		}
		return $a;
    }
	
    public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
        $p = parent::getById($id);
		return (isset($p[0])) ? new Picture($p[0]) : new Picture();
    }
	
	
	/*
    public function getByTypeDocAndDoc($type_identification, $identification_number){
        $query = $this->db->query("SELECT * FROM $this->table WHERE type_identification IN ('{$type_identification}') AND identification_number IN ('{$identification_number}')");
		
		$resultSet = array();
		if(count($query->fetch_object()) > 0){
			
			while($row = $query->fetch_object()) {
			   $resultSet[]=$row;
			}
		}
			 
        return $resultSet;
    }*/
}