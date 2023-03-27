<?php include("layout/header.php") ?>

<div class="container">
    <a href="#" class="btn btn-primary mb-5">Create Doctor Availability</a>
    <table class="table table-hover table-active table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Patient Name</th>
            <th scope="col" class="text-center">Patient Mobile Number</th>
            <th scope="col" class="text-center">Doctor Name</th>
            <th scope="col" class="text-center">Specialization</th>
            <th scope="col" class="text-center">Date</th>
            <th scope="col" class="text-center">Appointment Time</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody id="doctor_appointment_list">
        </tbody>
    </table>
</div>

<script>
    function getHtml(results) {
        debugger
        let html = '';
        for (var i = 0; i < results.length; i++) {
            let reuslt = results[i]
            html += `<tr>
<td>${reuslt['id']}</td>
<td>${reuslt['patient_name']}</td>
<td>${reuslt['patient_phone']}</td>
<td>${reuslt['name']}</td>
<td>${reuslt['specialization']}</td>
<td>${reuslt['day']}</td>
<td>${reuslt['appointment_time']}</td>
            <td><a href="" class="btn btn-danger">Delete</a></td>

</tr>`

        }
        return html
    }

    $.ajax({
        url: "api.php?action=get_doctor_appointment",
        method: "GET",
        success: (resp) => {
            $('#doctor_appointment_list').html(getHtml(resp));
        }

    })
</script>

<?php include("layout/footer.php") ?>
