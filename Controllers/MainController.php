<?php

//Autoload de functie genaamd myAutoLoader
spl_autoload_register('myAutoloader');

function myAutoloader($className)
{
    //Maakt een variable genaamd path naar het pad van wat geladen moet worden
    $path = 'Controllers/';
    //Geeft aan dat het om php bestanden gaat
    $extension = '.php';
    //Maakt nieuwe variable met de path + naam bestand + plus de extensions wat hier terug wordt aangegeven
    $fileName = $path . $className . $extension;

    //Deze if statement zorgt ervoor dat wanneer het bestand niet bestaat een false wordt teruggegeven.
    if (!file_exists($fileName)) {
        return false;
    }

    include_once $path . $className . $extension;
}
