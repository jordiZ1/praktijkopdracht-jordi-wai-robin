<?php

class Model
{
    public function getUsersFromDB()
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM gebruiker";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array());
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);

        if ($Result > 0) {
            return $Result;
        }
        return "empty";
    }

    public function getProjectFromDb()
    {

        $DBConfig = new DBConfig();
        $getProjectQuery = "SELECT * FROM projecten";
        $getProjectStatment = $DBConfig->connect()->prepare($getProjectQuery);
        $getProjectStatment->execute(array());
        $getProjectResult = $getProjectStatment->fetchAll(PDO::FETCH_ASSOC);

        if ($getProjectResult > 0) {
            return $getProjectResult;
        }
        return "empty";

    }

    public function getProjectOneFromDb($projectid)
    {

        $DBConfig = new DBConfig();
        $getProjectQuery = "SELECT * FROM projecten where project_id=" . $projectid;
        $getProjectStatment = $DBConfig->connect()->prepare($getProjectQuery);
        $getProjectStatment->execute(array());
        $getProjectResult = $getProjectStatment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($getProjectResult);
        if ($getProjectResult > 0) {
            return $getProjectResult;
        }
        return "empty";

    }

    public function getProjectLedenFromDb()
    {
        $DBConfig = new DBConfig();
        $getProjectLedenQuery = "SELECT * FROM projecten, gebruiker, project_leden WHERE projecten.project_id = project_leden.project_id and gebruiker.gebruiker_id = project_leden.gebruiker_id";
        $getProjectLedenStatment = $DBConfig->connect()->prepare($getProjectLedenQuery);
        $getProjectLedenStatment->execute(array());
        $getProjectLedenResult = $getProjectLedenStatment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($getProjectLedenResult);
        if ($getProjectLedenResult > 0) {
            return $getProjectLedenResult;
        } else {
            return "no";
        }
    }

    public function getProjectDagenFromDb()
    {
        $DBConfig = new DBConfig();
        $getProjectQuery = "SELECT * FROM projecten,project_dagen WHERE projecten.project_id = project_dagen.project_id";
        $getProjectStatment = $DBConfig->connect()->prepare($getProjectQuery);
        $getProjectStatment->execute(array());
        $getProjectResult = $getProjectStatment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($getProjectResult);
        if (count($getProjectResult) > 0) {
            return $getProjectResult;
        }
        return "empty";
    }

    public function getInplanDatumFromDb()
    {
        $DBConfig = new DBConfig();
        $getInplanProjectQuery = "SELECT * FROM `project_dagen` GROUP BY `project_dagen`.`datum` ORDER BY `project_dagen`.`datum` ASC";
        $getInplanProjectStatment = $DBConfig->connect()->prepare($getInplanProjectQuery);
        $getInplanProjectStatment->execute(array());
        $getInplanProjectResult = $getInplanProjectStatment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($getInplanProjectResult);
        if ($getInplanProjectResult > 0) {
            return $getInplanProjectResult;
        }
        return "empty";
    }

    public function getOneInplanProjectFromDb($datum, $id)
    {

        $DBConfig = new DBConfig();
        $getProjectQuery = "SELECT * FROM project_dagen where datum='" . $datum . "' AND project_id =" . $id;
        //print_r($getProjectQuery);
        $getProjectStatment = $DBConfig->connect()->prepare($getProjectQuery);
        $getProjectStatment->execute(array());
        $getProjectResult = $getProjectStatment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($getProjectResult);
        $v = count($getProjectResult);
        //echo $v;
        if ($v > 0) {
            return $getProjectResult;
        } else if ($v == 0) {
            return "empty";
        }

    }
}