<?php
require("Repositories/Model.php");
require ('Repositories/DoctorAppointment.php');
require ('Repositories/DoctorAvailability.php');
require("Repositories/Specialization.php");
require('Repositories/Doctor.php');

$action = $_GET['action'];

function json($data)
{
    header("Content-Type: application/json");
    echo json_encode($data);
    die();
}

if ($action == "get_specialization") {
    $specializationRepo = new Specialization();
    json($specializationRepo->all());
}
else if ($action == "get_doctor") {
    $doctors = new Doctor();
    json($doctors->all());
}else if ($action == "get_doctor_availability"){
    $doctoravailability = new DoctorAvailability();
    json($doctoravailability->all());
}else if ($action == "get_doctor_appointment"){
    $doctorAppointment = new DoctorAppointment();
    json($doctorAppointment->all());
}
