<?php

class GebruikersModel extends Model
{
    public function newUser()
    {
        $name = $_POST['newNaam'];
        $email = $_POST['newEmail'];
        $password = $_POST['newWachtwoord'];
        $beroep = $_POST['newBeroep'];
        $role = $_POST['newRole'];

        if ($this->checkEmail($email) == "error") {
            return "duplicMail";
        }

        $DBConfig = new DBConfig();
        $Query = "INSERT INTO `gebruiker`(`naam`, `email`, `wachtwoord`, `admin`, `beroep`) VALUES ('" . $name . "', '" . $email . "', '" . $password . "', " . $role . ", '" . $beroep . "')";
        $connection = $DBConfig->connect();
        $Statment = $connection->prepare($Query);
        $Statment->execute();
        $id = $connection->lastInsertId();

        $this->createBeschikbaarheid($id);

        return "success";
    }

    public function editUser()
    {
        $ID = $_POST['editID'];
        $name = $_POST['editName'];
        $email = $_POST['editEmail'];
        $beroep = $_POST['editBeroep'];
        $role = $_POST['editRole'];

        $DBConfig = new DBConfig();
        $Query = "UPDATE `gebruiker` SET `naam` = '" . $name . "', `email` = '" . $email . "',`admin` = '" . $role . "',`beroep` = '" . $beroep . "' WHERE `gebruiker_id` = " . $ID;
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute();

        return "success";
    }

    public function removeUser()
    {
        $ID = $_POST['removeID'];

        $DBConfig = new DBConfig();
        $Query = "DELETE FROM `gebruiker` WHERE gebruiker_id = ?";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array($ID));

        $this->removeBeschikbaarheid($ID);

        return "success";
    }

    private function checkEmail($mail)
    {
        $DBConfig = new DBConfig();
        $emailCheckingQuery = "SELECT email FROM gebruiker WHERE email=?";
        $emailCheckingStatment = $DBConfig->connect()->prepare($emailCheckingQuery);
        $emailCheckingStatment->execute(array($mail));
        $emailCheckingResult = $emailCheckingStatment->fetchAll(PDO::FETCH_ASSOC);

        if (count($emailCheckingResult) > 0) {
            return "error";
        }
        return "success";
    }

    private function createBeschikbaarheid($id)
    {
        $DBConfig = new DBConfig();
        $Query = "INSERT INTO `beschikbaarheid`(`gebruiker_id`, `ma`, `di`, `wo`, `do`, `vr`, `za`, `zo`) VALUES ('" . $id . "', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL')";
        $connection = $DBConfig->connect();
        $Statment = $connection->prepare($Query);
        $Statment->execute();
    }

    private function removeBeschikbaarheid($id)
    {
        $DBConfig = new DBConfig();
        $Query = "DELETE FROM `beschikbaarheid` WHERE gebruiker_id = ?";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array($id));
    }
}
