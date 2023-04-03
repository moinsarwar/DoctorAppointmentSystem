<?php

class Model
{
    protected function __construct()
    {
        $host = 'localhost';
        $user = 'root';
        $pswd = '';
        $db = 'das2';
        $this->con = new mysqli($host, $user, $pswd, $db);
        if ($this->con->connect_error) {
            die("Connection Failed:" . $this->con->connect_error);
        }
    }

}