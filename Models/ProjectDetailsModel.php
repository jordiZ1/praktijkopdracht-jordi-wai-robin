<?php
class ProjectDetailsModel extends Model
{
    public function checkProjectledenDb()
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM project_leden";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array());
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);
        $count = Count($Result);

        return "success";

    }

    public function meldenProject($projectId, $userId)
    {
        $DBConfig = new DBConfig();
        $Query = "INSERT INTO `project_leden` (`project_id`, `gebruiker_id`) VALUES ('" . $projectId . "', '" . $userId . "')";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute();

        return "success";
    }

    public function checkAanmeld($UserId)
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM project_leden WHERE project_leden.gebruiker_id=" . $UserId;
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array());
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($Result);
        return $Result;

    }

    public function deletProjectLedenFromDb($projectId, $id)
    {
        $DBConfig = new DBConfig();
        $deleteProjectStatusQuery = "DELETE FROM `project_leden` WHERE `project_leden`.`project_id` = " . $projectId . " AND project_leden.gebruiker_id =" . $id;
        $deleteProjectStatusStatment = $DBConfig->connect()->prepare($deleteProjectStatusQuery);
        $deleteProjectStatusStatment->execute(array());
        return 'done';
    }

    public function getUserFromDb()
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM gebruiker";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array());
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($Result);
        return $Result;

    }

    public function getProjectUserFromDb($projectId)
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM projecten, gebruiker, project_leden WHERE projecten.project_id = project_leden.project_id and gebruiker.gebruiker_id = project_leden.gebruiker_id AND project_leden.project_id =" . $projectId;
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array());
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);
        //print_r($Result);
        return $Result;

    }

}
