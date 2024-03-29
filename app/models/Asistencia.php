<?php
require_once "app/models/Practicante.php";
class Asistencia extends ModeloBase
{
    public function __construct(){
        parent::__construct();
    }

    public function indexasistencia($search, $dateInicio, $dateEnd,$startOfPaging,$amountOfThePaging) {

        $sql = "SELECT practicantes.id,practicantes.name,asistencias.fecha,asistencias.hora_entrada, asistencias.hora_salida, asistencias.horast,asistencias.id as id_asistencia
        FROM asistencias
        left JOIN practicantes";


        if(empty($search)){
            $sql .= "
            ON asistencias.id_practicante = practicantes.id LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql .= "
            ON asistencias.id_practicante = practicantes.id WHERE asistencias.fecha 
            BETWEEN $dateInicio AND $dateEnd AND practicantes.id = $search LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $this->index($sql);
     
    }

    public function storeasistencia($datos){
        
        $insert = $this->store('asistencias', $datos);
        if ($insert) {
            $_SESSION['mensaje'] = 'Bienvenido que tenga un buen día';
        }

    }
    public function editasistencia($id){
        $db = new ModeloBase();
      
        $sql = "SELECT asistencias.id,practicantes.name,asistencias.fecha,asistencias.hora_entrada, asistencias.hora_salida,practicantes.id as id_practicante
        FROM asistencias
        left JOIN practicantes
        ON asistencias.id_practicante = practicantes.id  Where asistencias.id = $id ";

        return $db->show($sql);
      
    }
    public function updateasistencia($asistencia,$datos){
      
        $salida =  new DateTime($datos['hora_entrada']);
        $entrada = new DateTime($asistencia['hora_entrada']);
        $horast = $salida->diff($entrada);

        $datosUpdate['id'] = $asistencia['id'];
        $datosUpdate['hora_salida'] = $datos['hora_entrada'];
        $datosUpdate['horast'] = $horast->format('%H');

        $db = new ModeloBase();
        $sql = "UPDATE asistencias SET hora_salida=:hora_salida, horast=:horast WHERE id=:id";
        $db->update($sql, $datosUpdate);

       if($db){
            $_SESSION['mensaje'] = 'Buen trabajo que disfrutes tu día';
       }else{
             $_SESSION['exist'] = 'no se puede actualizar';
       } 
    }
    public function destroyasistencia($id){
        $db = new ModeloBase();
       return $db->destroy('asistencias', $id);
      
    }
    public function paginationasistencia($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM asistencias";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(id) FROM asistencias  WHERE id_practicante = $search ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 5);
        
        return $section;
         
    }
    public function storeorupdate($datos){
        #refactor this
        $id = $datos['id_practicante'];
        $fecha=str_replace('-', '',$datos['fecha']);
        $db = new ModeloBase();
        $sql  = "SELECT practicantes.name,practicantes.paterno,practicantes.materno,practicantes.img_perfil,usuarios.department
        FROM practicantes
        left JOIN usuarios
        ON practicantes.id_adviser = usuarios.id WHERE practicantes.id = $id";
        
        $searchPracticante = $db->show($sql);

        if(empty($searchPracticante)){
            $_SESSION['exist'] = 'el codigo del practicante no existe';
            return false;
        }

        $sqlupdate= "SELECT id, hora_entrada From asistencias where fecha = $fecha AND id_practicante = $id";
        
        $asistencia = $db->show($sqlupdate);

        if($asistencia){
            $this->updateasistencia($asistencia,$datos);
            return $searchPracticante;
        }else{
            $this->storeasistencia($datos);
            return $searchPracticante;
        }

    }

    public function updatea($datosUpdate){
        $status = false;
        $db = new ModeloBase(); 
        
        $sql = "UPDATE asistencias SET hora_entrada=:hora_entrada,hora_salida=:hora_salida, horast=:horast WHERE id=:id";
        $sqlhoras = "UPDATE practicantes SET horas_actuales=:horas_actuales WHERE id=:id;";
        if($db->update($sql, $datosUpdate)){ 
            $_SESSION['mensaje'] = "Actualizacion correcta";
        }else{
            $_SESSION['mensaje'] = "error en actualizacion de nueva hora de entra o salida";
        }
       
 
    }
    
    
}
