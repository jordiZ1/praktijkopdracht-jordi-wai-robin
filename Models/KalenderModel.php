<?php

class KalenderModel extends Model
{
    public function selectProjectForInplannner()
    {
        $projectId = $_POST['inplannenProject'];
        $_SESSION['project'] = $projectId;
        //print_r($_SESSION['project']);

        return 'done';

    }

    public function addInplanProjectToDb($projectId, $datum, $begin_tijd, $eind_tijd)
    {
        $DBConfig = new DBConfig();
        $Query = "INSERT INTO `project_dagen` (`project_id`, `datum`,`begin_tijd`,`eind_tijd`) VALUES ('" . $projectId . "', '" . $datum . "', '" . $begin_tijd . "', '" . $eind_tijd . "')";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute();

        return "success";
    }

    public function editProjectForInplannner()
    {
        $edit = $_POST['editDatum'];
        $_SESSION['editDatum'] = $edit;
        //print_r($_SESSION['editDatum']);
        $editProjectId = $_POST['editProject'];
        $_SESSION['editProject'] = $editProjectId;
        //print_r($_SESSION['editProject']);

        return 'done';
    }

    public function editProjectTimeToDb($beginTime, $endTime, $id)
    {
        $DBConfig = new DBConfig();
        $editProjectStatusQuery = "UPDATE `project_dagen` SET `begin_tijd` = '" . $beginTime . "', `eind_tijd` = '" . $endTime . "' WHERE `project_dagen`.`id` = " . $id;
        //print_r($editProjectStatusQuery);
        $editProjectStatusStatment = $DBConfig->connect()->prepare($editProjectStatusQuery);
        $editProjectStatusStatment->execute(array());
        return 'done';
    }

    public function deletePlanFromDb($id)
    {
        $DBConfig = new DBConfig();
        $deleteProjectStatusQuery = "DELETE FROM `project_dagen` WHERE `project_dagen`.`id` = " . $id;
        //print_r($deleteProjectStatusQuery);
        $deleteProjectStatusStatment = $DBConfig->connect()->prepare($deleteProjectStatusQuery);
        $deleteProjectStatusStatment->execute(array());
        return 'done';
    }

}
