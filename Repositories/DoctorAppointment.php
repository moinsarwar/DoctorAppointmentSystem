<?php

class DoctorAppointment extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function getDoctoraAppointment()
    {
        $sql = "SELECT doctor_appointment.id,doctor_appointment.patient_name,doctor_appointment.patient_phone,doctor_appointment.day,doctor_appointment.appointment_time,doctors.name,specializations.specialization FROM `doctor_appointment`  INNER JOIN doctors ON doctor_appointment.doctor_id = doctors.id INNER JOIN specializations ON doctor_appointment.specialization_id = specializations.id";
        return $this->con->query($sql);
    }

    public function all()
    {
        $rows = $this->getDoctoraAppointment();
        $doctorappointment = [];
        while ($row = $rows->fetch_assoc()) {
            $doctorappointment[] = $row;
        }
        return $doctorappointment;
    }

    public function save(array $data)
    {
        $sql = "insert into `doctor_appointment`(patient_name,patient_phone,doctor_id,specialization_id,day,appointment_time) values ('" . $data['patient_name'] . "','" . $data['patient_phone'] . "','" . $data['doctor_id'] . "','" . $data['specialization_id'] . "','" . $data['day'] . "','" . $data['appointment_time'] . "')";
        return $this->con->query($sql);
    }
    public function deleteDoctorAppointment($id){
        $sql = "DELETE FROM `doctor_appointment` where id = $id";
        return $this->con->query($sql);
    }


}