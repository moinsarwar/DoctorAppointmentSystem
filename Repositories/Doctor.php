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

}