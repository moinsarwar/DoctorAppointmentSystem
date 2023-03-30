<?php

class DoctorAvailability extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDoctorAvailability(){
        $sql = "SELECT doctor_availabilities.id,specializations.specialization,doctor_availabilities.day,doctor_availabilities.start_at,doctor_availabilities.end_at,doctors.name FROM `doctor_availabilities` INNER JOIN doctors ON doctor_availabilities.doctor_id = doctors.id INNER JOIN specializations ON doctor_availabilities.specialization_id = specializations.id";
        return $this->con->query($sql);
    }
    public function all(){
        $rows = $this->getDoctorAvailability();
        $doctoravailability = [];
        while ($row  = $rows->fetch_assoc()){
            $doctoravailability[] = $row;

        }
        return $doctoravailability;
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

}