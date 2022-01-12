<?php

class Dispatcher
{
    public function __construct()
    {
        //kijk of url is veranderd
        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        //trim URL zodat extra (/) worden weggehaald.
        $url = rtrim($url, "/");
        //zet URL in een array.

        $url = explode("/", $url);

        //kijkt of index 0 van de array naar index.php wijst.
        //als url[0] index is bouw index en stop uitvoer code.
        if ($url[0] == "index.php") {
            require_once "Controllers/Controller.php";
            $controller = new Controller();
            $controller->render("Index");
            return false;
        }
        //laad benodigde bestand als 0 niet naar index wijst

        $file = "Controllers/" . ucfirst($url[0]) . "Controller.php";
        if (file_exists($file)) {
            //als het bestand bestaat, laad het bestand in.
            require_once $file;
        } else {
            //bestand bestaat niet. dus return een error.
            $controller = new Controller();
            $this->setStatusCode(404);
            $controller->render("404");
            return false;
        }

        // zet waardes to lower case
        $url[0] = strtolower($url[0]);

        //model laden
        switch ($url[0]) {
            case "login":
                $controller = new LoginController;
                break;
            case "test":
                $controller = new TestController;
                break;
            case "kalender":
                $controller = new KalenderController;
                break;
            case "gebruikers":
                $controller = new GebruikersController;
                break;
            case "project":
                $controller = new ProjectController;
                break;
            case "beschikbaarheid":
                $controller = new BeschikbaarheidController;
                break;
            case "project":
                $controller = new ProjectController;
                break;
            case "projectdetails":
                $controller = new ProjectDetailsController;
                break;
            case "vrij_vragen":
                $controller = new Vrij_vragenController;
                break;
        }

        $controller->loadModel(ucfirst($url[0]));
        //methods roepen
        $controller->renderView();

    }

    protected function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}