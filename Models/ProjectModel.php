<?php
class ProjectModel extends Model
{
    public function deleteProjectFromDb()
    {
        $DBConfig = new DBConfig();
        $deleteProjectStatusQuery = "DELETE FROM `projecten` WHERE `projecten`.`project_id` = " . $_GET['projectDelete'];
        $deleteProjectStatusStatment = $DBConfig->connect()->prepare($deleteProjectStatusQuery);
        $deleteProjectStatusStatment->execute(array());
        return 'done';
    }

    public function newProject()
    {
        $projectnaam = $_POST['newProjectNaam'];
        $begindatum = $_POST['newBegindatum'];
        $einddatum = $_POST['newEinddatum'];
        $tijd = $_POST['newTijd'];
        $personen = $_POST['newPersonen'];
        $beschrijving = $_POST['newBeschrijving'];
        if ($begindatum > $einddatum) {
            echo "select juiste datum a.u.b";
        } else {
            $DBConfig = new DBConfig();
            $Query = "INSERT INTO `projecten`(`naam`, `begindatum`, `einddatum`, `tijd`, `personen`,`beschrijving`) VALUES ('" . $projectnaam . "', '" . $begindatum . "', '" . $einddatum . "', " . $tijd . ", '" . $personen . "', '" . $beschrijving . "')";
            $Statment = $DBConfig->connect()->prepare($Query);
            $Statment->execute();

            return "success";
        }
    }

    public function updateProject()
    {
        $projectId = $_POST['editProjectId'];
        $projectnaam = $_POST['editNaam'];
        $begindatum = $_POST['editBegindatum'];
        $einddatum = $_POST['editEinddatum'];
        $tijd = $_POST['editTijd'];
        $personen = $_POST['editPersonen'];
        $beschrijving = $_POST['editBeschrijving'];
        $DBConfig = new DBConfig();
        $editProjectStatusQuery = "UPDATE `projecten` SET `naam` = '" . $projectnaam . "', `begindatum` = '" . $begindatum . "', `einddatum` = '" . $einddatum . "', `tijd` = '" . $tijd . "', `personen` = '" . $personen . "', `beschrijving` = '" . $beschrijving . "' WHERE `projecten`.`project_id` = " . $projectId;
        $editProjectStatusStatment = $DBConfig->connect()->prepare($editProjectStatusQuery);
        $editProjectStatusStatment->execute(array());
        return 'done';

    }

}
