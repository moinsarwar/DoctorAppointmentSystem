<?php
require("Repositories/Model.php");
require("Repositories/DoctorAppointment.php");
require("Repositories/DoctorAvailability.php");
require("Repositories/Doctor.php");
require("Repositories/Specialization.php");

$action = $_GET['action'];
function json($data)
{
    header("Content-Type: application/json");
    echo json_encode($data);
    die();
}

//Specialization CRUD
if ($action == "specialization") {
    $specialization = new Specialization();
    json($specialization->all());
} elseif ($action == "create_specialization") {
    $specialization = new Specialization();
    $specialization->save($_POST);
} elseif ($action == "delete_specialization") {
    $id = $_GET['id'];
    $specialization = new Specialization();
    $specialization->delete($id);
} elseif ($action == "get_specialization") {
    $id = $_GET['id'];
    $specialization = new Specialization();
    json($specialization->get($id));
} elseif ($action == "update_specialization") {
    $id = $_GET['id'];
    $specialization = new Specialization();
    $specialization->update($id, $_POST);
} //Doctor CRUD
else if ($action == "doctor") {
    $doctor = new Doctor();
    json($doctor->all());
} elseif ($action == "create_doctor") {
    $doctors = new Doctor();
    $doctors->save($_POST);
} else if ($action == "delete_doctor") {
    $id = $_GET['id'];
    $deleteDoctor = new Doctor();
    $deleteDoctor->deleteDoctor($id);
} // Doctor Availability CRUD
else if ($action == "doctor_availability") {
    $doctorAvailability = new DoctorAvailability();
    json($doctorAvailability->all());
} else if ($action == "get_doctor_by_specialization") {
    $specialization_id = $_GET['specialization_id'];
    $doctors = new DoctorAvailability();
    json($doctors->getDoctorsBySpecialization($specialization_id));
} else if ($action == "create_doctor_availability") {
    $doctoravailability = new DoctorAvailability();
    $doctoravailability->save($_POST);
} else if ($action == "delete_doctor_availability") {
    $id = $_GET['id'];
    $deleteDoctorAvailability = new DoctorAvailability();
    $deleteDoctorAvailability->deleteDoctorAvailability($id);
} // Doctor Appointment CRUD
else if ($action == "doctor_appointment") {
    $doctorAppointment = new DoctorAppointment();
    json($doctorAppointment->all());
} else if ($action == "create_doctor_appointment") {
    $appointment = new DoctorAppointment();
    $appointment->save($_POST);
} else if ($action == "delete_doctor_appointment") {
    $id = $_GET['id'];
    $deleteDoctorAppointment = new DoctorAppointment();
    $deleteDoctorAppointment->deleteDoctorAppointment($id);
}