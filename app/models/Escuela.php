<?php
require_once 'ModeloBase.php';
class Escuela extends ModeloBase
{
    public function __construct(){
        parent::__construct();
    }

    public function indexschool($search,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM escuelas LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM escuelas WHERE name LIKE  '$search%' LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
     
    }

  
    public function storeschool($datos){

        $db = new ModeloBase();
		$insert = $db->store('escuelas', $datos);
		if ($insert) {
			$_SESSION['mensaje'] = 'Registro exitoso';
        }
        
    }
    
    public function editschool($id){
        $db = new ModeloBase();
        return $db->edit('escuelas', $id);
      
    }
    public function updateschool($datos){
        $db = new ModeloBase();
        $sql = "UPDATE escuelas SET name=:name, direccion=:direccion, email=:email, phone=:phone, encargado=:encargado  WHERE id=:id;";

        $update = $db->update($sql,$datos);
        $update ? $_SESSION['mensaje'] = 'Actualización exitosa' : $_SESSION['mensaje'] = 'Error de actualización' ;
    }
    public function destroyschool($id){
        $db = new ModeloBase();
       return $db->destroy('escuelas', $id);
      
    }
    public function paginationschool($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM escuelas";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(name) FROM escuelas  WHERE name LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 5);
        
        return $section;
         
    }
    
}
