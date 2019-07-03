<?php
require_once 'ModeloBase.php';

class Usuario extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }
   
    public function login($user, $password) {
        $db = new ModeloBase();
        return $db->login($user,$password);
       
    }
    
    public function storeuser($datos){

        $db = new ModeloBase();
        $datos['id_rol'] = 2;
        $insert = $db->store('usuarios', $datos);
        if ($insert) $_SESSION['mensaje'] = 'Registro exitoso';
        
    }


    public function indexuser($search,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM usuarios LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM usuarios WHERE name LIKE  '$search%' LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
     
    }

    public function edituser($id){
        $db = new ModeloBase();
       return $db->edit('usuarios', $id);
      
    }
    public function destroyuser($id){
        $db = new ModeloBase();
       return $db->destroy('usuarios', $id);
      
    }
    public function updateuser($datos){
        $db = new ModeloBase();
        $sql = "UPDATE usuarios SET name=:name, department=:department, email=:email, phone=:phone, user=:user, password=:password WHERE id=:id;";

        return $db->update($sql,$datos);
    }
    public function paginationuser($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM usuarios";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(name) FROM usuarios  WHERE name LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 5);
        
        return $section;
         
    }
 
}

?>