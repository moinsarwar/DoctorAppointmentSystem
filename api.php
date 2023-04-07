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
}
elseif ($action == "update_specialization") {
    $id = $_GET['id'];
    $specialization = new Specialization();
    $specialization->update($id, $_POST);
}

//Doctor CRUD
else if ($action == "doctor") {
    $doctor = new Doctor();
    json($doctor->all());
} elseif ($action == "create_doctor") {
    $Doctor = new Doctor();
    $Doctor->save($_POST);
} else if ($action == "delete_doctor") {
    $id = $_GET['id'];
    $Doctor = new Doctor();
    $Doctor->deleteDoctor($id);
}
 elseif ($action == "get_doctor") {
    $id = $_GET['id'];
    $Doctor = new Doctor();
    json($Doctor->get($id));
}
elseif ($action == "update_doctor") {
    $id = $_GET['id'];
    $Doctor = new Doctor();
    $Doctor->update($id, $_POST);
}

// Doctor Availability CRUD
else if ($action == "doctor_availability") {
    $doctorAvailability = new DoctorAvailability();
    json($doctorAvailability->all());
} else if ($action == "get_doctor_by_specialization") {
    $specialization_id = $_GET['specialization_id'];
    $doctors = new DoctorAvailability();
    json($doctors->getDoctorsBySpecialization($specialization_id));
} else if ($action == "create_doctor_availability") {
    $doctorAvailability = new DoctorAvailability();
    $doctorAvailability->save($_POST);
} else if ($action == "delete_doctor_availability") {
    $id = $_GET['id'];
    $doctorAvailability = new DoctorAvailability();
    $doctorAvailability->deleteDoctorAvailability($id);
}
elseif ($action == "get_doctor_availability") {
    $id = $_GET['id'];
    $doctorAvailability = new DoctorAvailability();
    json($doctorAvailability->get($id));
}
elseif($action == "update_doctor_availability"){
    $id = $_GET['id'];
    $doctorAvailability = new DoctorAvailability();
    $doctorAvailability->update($id,$_POST);
}

// Doctor Appointment CRUD
else if ($action == "doctor_appointment") {
    $DoctorAppointment = new DoctorAppointment();
    json($DoctorAppointment->all());
} else if ($action == "create_doctor_appointment") {
    $DoctorAppointment = new DoctorAppointment();
    $DoctorAppointment->save($_POST);
} else if ($action == "delete_doctor_appointment") {
    $id = $_GET['id'];
    $DoctorAppointment = new DoctorAppointment();
    $DoctorAppointment->deleteDoctorAppointment($id);
}
elseif($action == "get_doctor_appointment"){
    $id = $_GET['id'];
    $DoctorAppointment = new DoctorAppointment();
    json($DoctorAppointment->get($id));
}
elseif($action == "update_doctor_appointment"){
    $id = $_GET['id'];
    $DoctorAppointment = new DoctorAppointment();
    $DoctorAppointment->update($id,$_POST);
}
elseIf($action == "get_doctor_time_slots"){
    $doctorID = $_GET['doctor_id'];
    $date = $_GET['date'];
    $slots = new DoctorAvailability();
    json($slots->gettimeSlot($doctorID,$date));
}