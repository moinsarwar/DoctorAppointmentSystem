<?php

class DoctorAvailability extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function doctorAvailabbility()
    {
        $sql = "SELECT doctor_availabilities.id, doctor_availabilities.day,doctor_availabilities.start_at,doctor_availabilities.end_at,doctors.name
    as doctor_id,specializations.specialization as specialization_id FROM `doctor_availabilities` 
        LEFT JOIN specializations ON doctor_availabilities.specialization_id = specializations.id 
        LEFT JOIN doctors ON doctor_availabilities.doctor_id = doctors.id";
        return $this->con->query($sql);
    }

    public function all()
    {
        $rows = $this->doctorAvailabbility();
        $data = [];
        while ($row = $rows->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function save(array $data)
    {
        $sql = "insert into `doctor_availabilities` (doctor_id,specialization_id,day,start_at,end_at) values ('" . $data['name'] . "','" . $data['specialization'] . "','" . $data['day'] . "','" . $data['start_at'] . "','" . $data['end_at'] . "')";
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

    public function deleteDoctorAvailability($id)
    {
        $sql = "DELETE FROM `doctor_availabilities` where id = $id";
        return $this->con->query($sql);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM `doctor_availabilities` WHERE id = $id";
        return $this->con->query($sql)->fetch_assoc();
    }

    public function update($id, array $data)
    {
        $sql = "UPDATE `doctor_availabilities` SET doctor_id = '" . $data['name'] . "',specialization_id = '" . $data['specialization'] . "',
        day = '" . $data['day'] . "',start_at = '" . $data['start_at'] . "',end_at = '" . $data['end_at'] . "' where id = $id ";
        return $this->con->query($sql);
    }

    public function gettimeSlot($doctorID, $date)
    {
        $yearFirstDate = date('Y-m-d', strtotime($date));
        $day = date('l', strtotime($date));
        $sql = "SELECT * FROM `doctor_availabilities` where doctor_id = $doctorID and day = '$day'";
        $resultset = $this->con->query($sql);
        $data = [];
        while ($row = $resultset->fetch_assoc()) {
            $startAt = strtotime($row['start_at']);
            $endAt = strtotime($row['end_at']);
            $slotDuration = $row['slot_duration'] * 60;
            for ($startTime = $startAt; $startTime < $endAt; $startTime += $slotDuration) {
                $slot_time = (date('G:i', $startTime));
                $check_sql = "select id from `doctor_appointment` where doctor_id = $doctorID and day = '$yearFirstDate' and appointment_time = '$slot_time'";
                $check_result = $this->con->query($check_sql);
                if ($check_result && mysqli_num_rows($check_result) == 0) {

                    $data[] = [
                        "text" => date('g:i A', $startTime),
                        "value" => date('H:i:s', $startTime)

                    ];
                }
            }
        }
        return $data;
    }

}