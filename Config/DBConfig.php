<?php

class DBConfig
{
    // definieer Database Host, Gebruiker, Wachtwoord en Databasemaa,
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "mollenhof";

    public function connect()
    {
        //definieer soort database
        $dataSoortName = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        //maak database connectie
        $pdo = new PDO($dataSoortName, $this->user, $this->pwd);
        //set fetchmodus
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}