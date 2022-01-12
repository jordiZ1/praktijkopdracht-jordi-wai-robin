<?php

class BeschikbaarheidModel extends Model
{
    public function getBeschikbaarheid($id)
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM beschikbaarheid WHERE `gebruiker_id` = ?";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array($id));
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);

        if (count($Result) == 1) {
            return $Result[0];
        }
        return "empty";
    }

    public function getAdminBeschikbaarheid()
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM gebruiker, beschikbaarheid WHERE beschikbaarheid.gebruiker_id = gebruiker.gebruiker_id";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute();
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);

        if (count($Result) > 0) {
            return $Result;
        }
        return "empty";
    }

    public function updateBeschikbaarheid()
    {
        $id = $_POST['editID'];

        $ma = (isset($_POST['checkMa'])) ? $_POST['newStartMa'] . "-" . $_POST['newEndMa'] : "NULL";
        $di = (isset($_POST['checkDi'])) ? $_POST['newStartDi'] . "-" . $_POST['newEndDi'] : "NULL";
        $wo = (isset($_POST['checkWo'])) ? $_POST['newStartWo'] . "-" . $_POST['newEndWo'] : "NULL";
        $do = (isset($_POST['checkDo'])) ? $_POST['newStartDo'] . "-" . $_POST['newEndDo'] : "NULL";
        $vr = (isset($_POST['checkVr'])) ? $_POST['newStartVr'] . "-" . $_POST['newEndVr'] : "NULL";
        $za = (isset($_POST['checkZa'])) ? $_POST['newStartZa'] . "-" . $_POST['newEndZa'] : "NULL";
        $zo = (isset($_POST['checkZo'])) ? $_POST['newStartZo'] . "-" . $_POST['newEndZo'] : "NULL";

        $DBConfig = new DBConfig();
        $Query = "UPDATE `beschikbaarheid` SET `ma`=:ma, `di`=:di, `wo`=:wo, `do`=:do, `vr`=:vr, `za`=:za, `zo`=:zo WHERE `gebruiker_id` = :id";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array(
            ':ma' => $ma,
            ':di' => $di,
            ':wo' => $wo,
            ':do' => $do,
            ':vr' => $vr,
            ':za' => $za,
            ':zo' => $zo,
            ':id' => $id
        ));

        return 'success';
    }
}
