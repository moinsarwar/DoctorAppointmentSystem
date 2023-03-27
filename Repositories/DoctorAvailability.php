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

}