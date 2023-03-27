<?php

class Doctor extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDoctors()
    {
        $sql = "SELECT doctors.id,doctors.name,doctors.email,doctors.phone_number,doctors.degree,specializations.specialization  from `doctors` INNER JOIN specializations ON doctors.specialization_id = specializations.id";
        return $this->con->query($sql);
    }

    public function all()
    {
        $rows = $this->getDoctors();
        $doctor = [];
        while ($row = $rows->fetch_assoc()) {
            $doctor[] = $row;
        }
        return $doctor;
    }

}