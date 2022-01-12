<?php

class LoginModel
{
    public function login()
    {
        $DBConfig = new DBConfig();
        $loginQuery = "SELECT * FROM gebruiker WHERE email =?";
        $loginStatment = $DBConfig->connect()->prepare($loginQuery);
        $loginStatment->execute(array($_POST['loginEmail']));
        $loginResult = $loginStatment->fetchAll(PDO::FETCH_ASSOC);

        if (count($loginResult) == 1) {
            if (password_verify($_POST["loginPassword"], $loginResult[0]['wachtwoord'])) {
                $_SESSION["UID"] = $loginResult[0];
                echo "succes";
                return 'sus';
            } else if ($_POST["loginPassword"] == $loginResult[0]['wachtwoord']) {
                $_SESSION["UID"] = $loginResult[0];
                echo "succes";
                return 'sus';
            } else {
                echo "passwod";
                return 'password';
            }
        } else {
            echo "user";
            return 'noUser';
        }
    }

    public function checkUser()
    {
        $DBConfig = new DBConfig();
        $Query = "SELECT * FROM gebruiker WHERE email =?";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array($_POST['resetEmail']));
        $Result = $Statment->fetchAll(PDO::FETCH_ASSOC);

        if(count($Result) == 1) {
            return $Result[0];
        }
        return 'noUser';
    }

    public function changepw()
    {
        $DBConfig = new DBConfig();
        $Query = "UPDATE `gebruiker` SET `wachtwoord`=? WHERE `gebruiker_id`= ?";
        $Statment = $DBConfig->connect()->prepare($Query);
        $Statment->execute(array($_POST['resetPassword'], $_SESSION['resetPW']['gebruiker_id']));

        return 'success';
    }
}
