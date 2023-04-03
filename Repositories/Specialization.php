<?php

class Specialization extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function getspecialization()
    {
        $sql = "SELECT * FROM `specializations`";
        return $this->con->query($sql);
    }

    public function all()
    {
        $rows = $this->getspecialization();
        $data = [];
        while ($row = $rows->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function save(array $data)
    {
        $sql = "INSERT INTO `specializations` (specialization) values ('" . $data['name'] . "')";
        return $this->con->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `specializations` where id = $id";
        return $this->con->query($sql);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM `specializations` where id = $id";
        return $this->con->query($sql)->fetch_assoc();
    }

    public function update($id, array $data)
    {
        $sql = "UPDATE `specializations` SET specialization = '" . $data['name'] . "' where id = $id";
        return $this->con->query($sql);
    }

}