<?php

class Specialization extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function getAllDataFromDatabase()
    {
        $sql = "SELECT * FROM specializations";
        return $this->con->query($sql);
    }

    public function all()
    {
        $rows = $this->getAllDataFromDatabase();
        $return_data = [];
        while ($row = $rows->fetch_assoc()) {
            $return_data[] = $row;
        }
        return $return_data;
    }

    public function save(array $data)
    {
        $sql = "INSERT into specializations (specialization) values ('" . $data["name"] . "')";
        return $this->con->query($sql);
    }


    public function delete_specialization($id)
    {
        $sql = "DELETE FROM specializations WHERE id = $id";
        return $this->con->query($sql);
    }


}