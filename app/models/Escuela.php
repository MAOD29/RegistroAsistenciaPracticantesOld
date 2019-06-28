<?php
require_once 'ModeloBase.php';
class Escuela extends ModeloBase
{
    public function __construct(){
        parent::__construct();
    }
    public function indexescuela($sql) {

        $db = new ModeloBase();
        return  $db->index($sql);
     
    }

    public function paginationescuela($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM escuelas";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(name) FROM escuelas  WHERE name LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 5);
        
        return $section;
         
    }
    public function storeescuela($datos){

        $db = new ModeloBase();
		$insertar = $db->store('escuelas', $datos);
		if ($insertar) {
			$_SESSION['mensaje'] = 'Registro exitoso';
        }
        
    }
    
    public function editescuela($id){
        $db = new ModeloBase();
        return $db->edit('escuelas', $id);
      
    }
    public function updateescuela($datos){
        $db = new ModeloBase();
        $sql = "UPDATE escuelas SET name=:name, direccion=:direccion, email=:email, phone=:phone, encargado=:encargado  WHERE id=:id;";

        return $db->update($sql,$datos);
    }
    public function destroyescuela($id){
        $db = new ModeloBase();
       return $db->destroy('escuelas', $id);
      
    }
}
