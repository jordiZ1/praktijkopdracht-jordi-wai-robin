<?php

class Vrij_vragenModel
{
    public function getVrijeDagen()
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM vrije_dagen WHERE `gebruiker_id` = ?";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array($_SESSION['UID']['gebruiker_id']));
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);

        if (count($Result) > 0) {
            return $Result;
        }
        return "empty";
    }

    public function getAdminVrijeDagen()
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM vrije_dagen, gebruiker WHERE gebruiker.gebruiker_id = vrije_dagen.gebruiker_id ORDER BY vrije_dagen.dag ASC";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute();
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);

        if (count($Result) > 0) {
            return $Result;
        }
        return "empty";
    }

    public function newVrijeDag()
    {
        $id = $_SESSION['UID']['gebruiker_id'];
        $dag = $_POST['newDagDate'];
        $beschrijving = $_POST['newDagBes'];

        $DBConfig = new DBConfig();
        $Query = "INSERT INTO `vrije_dagen`(`gebruiker_id`, `dag`, `beschrijving`) VALUES (?, ?, ?)";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array(
            $id,
            $dag,
            $beschrijving
        ));

        return "success";
    }

    public function removeVrijeDag()
    {
        $id = $_POST['vrij_aanvraag_id'];

        $DBConfig = new DBConfig();
        $Query = "DELETE FROM `vrije_dagen` WHERE `vrij_aanvraag_id` = ?";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array($id));

        return 'success';
    }
}
