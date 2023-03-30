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

    public function getTimeSlot($doctor_id, $day_name)
    {
        $sql = "Select start_at,end_at,slot_duration from `doctor_availabilities` where doctor_id = $doctor_id and day = $day_name";
        $result = $this->con->query($sql);
        $slot = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $start = strtotime($row['start_at']);
                $end = strtotime($row['end_at']);
                $slot_duration = $row['slot_duration'] * 60;
                for ($time = $start; $time < $end; $time += $slot_duration) {
                    $slot[] = array(
                        "value" => $time,
                        "text" => date('h:i A', $time)
                    );
                }
            }

        }
        return $slot;

    }
}