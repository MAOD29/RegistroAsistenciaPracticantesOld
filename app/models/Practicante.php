<?php
require_once 'ModeloBase.php';
class Practicante extends ModeloBase
{
    public function __construct(){
        parent::__construct();
    }
    public function indexpracticante($sql) {

        $db = new ModeloBase();
        return  $db->index($sql);
     
    }

    public function paginationpracticante($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM practicantes";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(name) FROM practicantes  WHERE name LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 5);
        
        return $section;
         
    }
}
