<?php
class Controller
{
    public function loadModel($name)
    {
        //Automatische functie require alle models
        $path = "Models/" . $name . "Model.php";
        if (file_exists($path)) {
            require "Models/Model.php";
            require "Models/" . $name . "Model.php";
            $modelName = $name . "Model";
            $this->model = new $modelName();
        }
    }

    public function render($name, $noInclude = false)
    { //Rendered alle views
        if ($noInclude == true) { //Deze if statement controleert of er al een view is. Zo niet pakt ie de juiste view aan de hand van de naam.
            require "Views/" . $name . ".php";
        } else { //Hier voert ie hetzelfde uit maar required het de header en footer ook
            require "Views/Header.php";
            require "Views/Navbar.php";
            require "Views/" . $name . ".php";
            require "Views/Footer.php";
        }
    }

    public function renderLogin($name)
    {
        //Hier wordt de login pagina geladen zonder navbar
        require "Views/LoginHeader.php";
        require "Views/" . $name . ".php";
        require "Views/LoginFooter.php";
    }

    public function checkLoggedIn()
    {
        if (!isset($_SESSION["UID"])) {
            echo "<script>location.href='" . BASE_URL . "login'</script>";
        }
    }

    public function checkAdmin()
    {
        if ($_SESSION["UID"]["admin"] != 1) {
            echo "<script>alert('only for admin')</script>";
            echo "<script>location.href='" . BASE_URL . "'</script>";
        }
    }

    protected function createMessage($type, $message)
    {
        echo '<script> createMessage("' . $type . '", "' . $message . '") </script>';
    }
}
