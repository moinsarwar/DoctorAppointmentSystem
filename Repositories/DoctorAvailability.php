<?php

class DoctorAvailability extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    private function doctorAvailabbility(){
        $sql = "SELECT doctor_availabilities.id, doctor_availabilities.day,doctor_availabilities.start_at,doctor_availabilities.end_at,doctors.name
    as doctor_id,specializations.specialization as specialization_id FROM `doctor_availabilities` 
        LEFT JOIN specializations ON doctor_availabilities.specialization_id = specializations.id 
        LEFT JOIN doctors ON doctor_availabilities.doctor_id = doctors.id";
        return $this->con->query($sql);
    }

    public function all(){
        $rows = $this->doctorAvailabbility();
        $data = [];
        while ($row = $rows->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    public function save(array $data){
        $sql = "insert into `doctor_availabilities` (doctor_id,specialization_id,day,start_at,end_at) values ('".$data['name']."','".$data['specialization']."','".$data['day']."','".$data['start_at']."','".$data['end_at']."')";
        return $this->con->query($sql);
    }

    public function getDoctorsBySpecialization($specialization_id)
    {
        $sql = "SELECT * FROM `doctors` where specialization_id = $specialization_id";
        $resulSet = $this->con->query($sql);
        $doctor = [];
        while ($row = $resulSet->fetch_assoc()) {
            $doctor[] = $row;
        }
        return $doctor;
    }
    public function deleteDoctorAvailability($id){
        $sql = "DELETE FROM `doctor_availabilities` where id = $id";
        return $this->con->query($sql);
    }
}