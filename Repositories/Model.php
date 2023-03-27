<?php
    class Model
{
    protected function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "das2";
        $this->con = new mysqli($server, $username, $password, $database);
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }
}