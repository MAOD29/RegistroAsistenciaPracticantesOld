<?php
require_once 'app/models/ModeloBase.php';
class Incidencia extends ModeloBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexincidencia($search, $startOfPaging, $amountOfThePaging)
    {
        $db = new ModeloBase();
        $sql = "SELECT practicantes.id,practicantes.name,incidencias.titulo,incidencias.date,incidencias.id as id_incidencia
        FROM incidencias
        left JOIN practicantes";

        if (empty($search)) {
            $sql .= " ON incidencias.id_practicante = practicantes.id LIMIT $startOfPaging,$amountOfThePaging";
        } else {
            $sql .= " ON incidencias.id_practicante = practicantes.id WHERE  practicantes.name LIKE  '$search%' OR practicantes.id =  {$search} LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
    }

    public function showincidencia($id)
    {
        $db = new ModeloBase();

        $sql = "SELECT practicantes.id,practicantes.name,practicantes.paterno,practicantes.materno,incidencias.titulo,incidencias.descripcion,incidencias.date,incidencias.id as id_incidencia
        FROM incidencias
        left JOIN practicantes
        ON incidencias.id_practicante = practicantes.id WHERE incidencias.id = $id ";

        return $db->show($sql);
    }

    public function storeincidencia($datos)
    {

        $db = new ModeloBase();
        $insert = $db->store('incidencias', $datos);
        if ($insert) {
            $_SESSION['mensaje'] = 'Registro exitoso';
        }
    }

    public function editincidencia($id)
    {
        $db = new ModeloBase();

        $sql = "SELECT practicantes.id,practicantes.name,practicantes.paterno,incidencias.titulo,incidencias.descripcion,incidencias.date,incidencias.id as id_incidencia
        FROM incidencias
        left JOIN practicantes
        ON incidencias.id_practicante = practicantes.id WHERE incidencias.id = $id ";

        return $db->show($sql);
    }
    public function updateincidencia($datos)
    {
        $db = new ModeloBase();
        $sql = "UPDATE incidencias SET titulo=:titulo, descripcion=:descripcion, date=:date WHERE id=:id;";

        $update = $db->update($sql, $datos);
        $update ? $_SESSION['mensaje'] = 'Actualización exitosa' : $_SESSION['mensaje'] = 'Error de actualización';
    }
    public function destroyincidencia($id)
    {
        $db = new ModeloBase();
        return $db->destroy('incidencias', $id);
    }
    public function paginationincidencia($search)
    {

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM incidencias";

        if (!empty($search)) {
            $sql = "SELECT COUNT(id) FROM incidencias  WHERE id_practicante = $search ";
        }
        $number_of_rows = $db->pagination($sql);
        if ($number_of_rows) {
            $section = ceil($number_of_rows / 5);
            return $section;
        }
    }
    public function search($id)
    {
        $db = new ModeloBase();
        return $db->edit('practicantes', $id);
    }
}
