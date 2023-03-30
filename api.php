<?php
include("Repositories/Model.php");
include ('Repositories/DoctorAppointment.php');
include ('Repositories/DoctorAvailability.php');
include("Repositories/Specialization.php");
include('Repositories/Doctor.php');

$action = $_GET['action'];

function json($data)
{
    header("Content-Type: application/json");
    echo json_encode($data);
    die() ;
}
//Specialization Crud
if ($action == "get_specialization") {
    $specializationRepo = new Specialization();
    json($specializationRepo->all());
}
else if ( $action == "create_specialization") {
    $specialization = new Specialization();
    $specialization->save($_POST);
}
//Doctor Crud
else if ($action == "get_doctor") {
    $doctors = new Doctor();
    json($doctors->all());
}
else if($action == "create_doctor"){
    $doctors = new Doctor();
    $doctors->save($_POST);
}
// Doctor Availability Crud
else if ($action == "get_doctor_availability"){
    $doctoravailability = new DoctorAvailability();
    json($doctoravailability->all());
}
else if ($action == "get_doctor_by_specialization") {
    $specialization_id = $_GET['specialization_id'];
    $doctors = new DoctorAvailability();
    json($doctors->getDoctorsBySpecialization($specialization_id));
}
else if ($action == "create_doctor_availability"){
    $doctoravailability = new DoctorAvailability();
    $doctoravailability->save($_POST);
}
// Doctor Appointment Crud
else if ($action == "get_doctor_appointment"){
    $doctorAppointment = new DoctorAppointment();
    json($doctorAppointment->all());
}
else if ($action == "create_doctor_appointment"){
    $appointment = new DoctorAppointment();
    $appointment->save($_POST);
}

else if($action == "get_time_slots"){
    $doctor_id = $_GET['doctor_id'];
    $date = $_GET['date'];
    $day_name = date('l',strtotime($date));
    $slots = new DoctorAppointment();
    json($slots->getTimeSlot($doctor_id,$day_name));
}
