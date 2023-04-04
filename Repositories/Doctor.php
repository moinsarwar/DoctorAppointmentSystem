<?php

class Doctor extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    private function doctors(){
        $sql = "SELECT doctors.id,doctors.name,doctors.email,doctors.phone_number,
       doctors.degree,specializations.specialization AS specialization_id FROM `doctors` INNER JOIN specializations ON 
           doctors.specialization_id = specializations.id";
        return $this->con->query($sql);
    }
    public function all(){
        $doctors = $this->doctors();
        $data = [];
        while ($doctor = $doctors->fetch_assoc()){
            $data[] = $doctor;
        }
        return $data;
    }

    public function save(array $data){
        $sql = "INSERT INTO `doctors` (name,email,phone_number,degree,specialization_id) values ('".$data["name"]."','".$data['email']."','".$data['number']."','".$data['degree']."','".$data['specialization']."')";
        return $this->con->query($sql);
    }
    public function deleteDoctor($id){
        $sql = "DELETE FROM `doctors` where id = $id";
        return $this->con->query($sql);
    }
    public function get($id){
        $sql = "SELECT * FROM `doctors` where id = $id";
        $result = $this->con->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    public function update($id, array $data)
    {
        $sql = "UPDATE `doctors` SET name = '" . $data['name'] . "',phone_number = '".$data['phone_number']."',
        degree = '".$data['degree']."',email = '".$data['email']."',
        specialization_id = '".$data['specialization_id']."' where id = $id";
        return $this->con->query($sql);
    }

}