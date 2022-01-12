<?php

include_once 'mail/SendEmail.php';

class LoginController extends Controller
{
    public function renderview()
    {
        $this->renderLogin('Login');
    }

    public function login()
    {
        $status = $this->model->login();

        if ($status == 'noUser' || $status == 'password') {
            echo "email or password is wrong";
        } else {
            echo "<script>location.href='" . BASE_URL . "'</script>";
        }
    }

    public function forgetpw()
    {
        $check = $this->model->checkUser();

        if ($check != 'noUser') {
            $email = $_POST['resetEmail'];
            $id = $check['gebruiker_id'];
            $code = random_int(0000, 9999);
            $_SESSION['resetPW'] = array("code" => $code, "gebruiker_id" => $id);
            $this->sendCode($email, $code);
        } else {
            echo "geen account gevonden";
        }
    }

    public function resetpw()
    {
        if ($_POST['resetCode'] == $_SESSION['resetPW']['code']) {
            if ($_POST['resetPassword'] == $_POST['resetPasswordCheck']) {
                $status = $this->model->changepw();
                if ($status == 'success') {
                    unset($_SESSION['resetPW']);
                    echo "<script>location.href='" . BASE_URL . "login'</script>";
                } else {
                    echo "Er is iets fout gegaan";
                }
            } else {
                echo "De ingevulde wachtwoorden zijn niet gelijk aan elkaar";
            }
        } else {
            echo "Ongeldig reset code";
        }
    }

    private function sendCode($email, $code)
    {
        $mailObject = new SendEmail;

        $values = array(
            "{{CODE}}" => $code
        );

        $sendMail = $mailObject->createMail($email, "Wachtwoord resetten", "reset", $values);

        if ($sendMail == 'success') {
            echo "<script>location.href = '" . BASE_URL . "login?page=wachtwoord-resetten'</script>";
        } else {
            echo "er ging iets fout";
        }
    }
}
