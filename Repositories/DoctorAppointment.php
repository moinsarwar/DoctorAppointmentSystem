<?php

class DoctorAppointment extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDoctoraAppointment(){
        $sql = "SELECT doctor_appointment.id,doctor_appointment.patient_name,doctor_appointment.patient_phone,doctor_appointment.day,doctor_appointment.appointment_time,doctors.name,specializations.specialization FROM `doctor_appointment`  INNER JOIN doctors ON doctor_appointment.doctor_id = doctors.id INNER JOIN specializations ON doctor_appointment.specialization_id = specializations.id";
        return $this->con->query($sql);
    }
    public function all(){
        $rows = $this->getDoctoraAppointment();
        $doctorappointment = [];
        while ($row = $rows->fetch_assoc()){
            $doctorappointment[] = $row;
        }
        return $doctorappointment;
    }

}