<?php

class Specialization extends Model
{
    public function __construct() {
        parent::__construct();
    }

    private function getAllDataFromDatabase()
    {
        $sql = "SELECT * FROM specializations";
        return $this->con->query($sql);
    }

    public function all() {
        $rows = $this->getAllDataFromDatabase();
        $return_data = [];
        while ($row = $rows->fetch_assoc()) {
            $return_data[] = $row;
        }
        return $return_data;
    }

}