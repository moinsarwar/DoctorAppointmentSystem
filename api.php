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
else if ($action == "delete_specialization"){
    $id = $_GET['id'];
    $delete = new Specialization();
    $delete->delete_specialization($id);
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
else if ($action == "delete_doctor"){
    $id = $_GET['id'];
    $deleteDoctor = new Doctor();
    $deleteDoctor->delete_dotor($id);
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
else if ($action == "delete_doctor_availability"){
    $id = $_GET['id'];
    $deleteDoctorAvailability = new DoctorAvailability();
    $deleteDoctorAvailability->deleteDoctorAvailability($id);
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
else if($action == "delete_doctor_appointment"){
    $id = $_GET['id'];
    $deleteDoctorAppointment = new DoctorAppointment();
    $deleteDoctorAppointment->deleteDoctorAppointment($id);
}

