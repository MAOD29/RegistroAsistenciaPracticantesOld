<?php
require_once 'ModeloBase.php';
class Practicante extends ModeloBase
{
    public function __construct(){
        parent::__construct();
    }
    public function indexstudent($search,$startOfPaging,$amountOfThePaging) {

        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM practicantes LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM practicantes WHERE name LIKE  '$search%' LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
     
    }
    public function storestudent($datos){

        $db = new ModeloBase();
        $insert = $db->store('practicantes', $datos);
        
        if ($insert) {
            $_SESSION['mensaje'] = 'Registro exitoso';
        }
        
    }
    public function showstudent($id){
        $db = new ModeloBase();
        return $db->edit('practicantes', $id);
    }
    public function editstudent($id){
        $db = new ModeloBase();
        return $db->edit('practicantes', $id);
      
    }
    public function updatestudent($datos){
        $db = new ModeloBase();

        $sql = "UPDATE practicantes SET name=:name, paterno=:paterno, materno=:materno, email=:email, phone=:phone,address=:address, img_perfil=:img_perfil,birth=:birth,id_adviser=:id_adviser,id_school=:id_school,horas_totales=:horas_totales  WHERE id=:id;";

        $update = $db->update($sql,$datos);
        $update ? $_SESSION['mensaje'] = "actualizacion correcta" : $_SESSION['mensaje'] = "actualizacion fallida";
    }
    public function destroystudent($id){
        $db = new ModeloBase();
       return $db->destroy('practicantes', $id);
      
    }

    public function paginationstudent($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM practicantes";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(name) FROM practicantes  WHERE name LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 5);
        
        return $section;
         
    }
    public function getAll($table){
        $sql = "SELECT id,name from $table";
        $db = new ModeloBase();
        return $db->index($sql);
    }
}
