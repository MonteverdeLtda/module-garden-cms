<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Picture extends EntidadBase {
    private $id;
    private $name;
    private $size;
    private $data;
    private $type;
    private $created;
    private $updated;
     
    public function __construct($params) {
        $table = TBL_PICTURES;
        parent::__construct($table);
		$this->id = (isset($params->id)) ? $params->id : 0;
		$this->name = (isset($params->name)) ? $params->name : "";
		$this->size = (isset($params->size)) ? $params->size : 0;
		$this->data = (isset($params->data)) ? $params->data : "";
		$this->type = (isset($params->type)) ? $params->type : "";
		$this->created = (isset($params->created)) ? $params->created : "";
		$this->updated = (isset($params->updated)) ? $params->updated : "";
		
    }
	
	public function __toString(){
		return ($this->getName());
	}
	
	public function getId(){
		return ($this->id == null) ? 0 : (int) $this->id;
	}
	
	public function getName(){
		return ($this->name);
	}
	
	public function getType(){
		return ($this->type);
	}
	
	public function getData(){
		return ($this->data);
	}
}