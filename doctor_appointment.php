<?php include("layout/header.php") ?>

<div class="container">
    <a href="#" class="btn btn-primary mb-5 data-toggle=" data-toggle="modal" data-target="#doctorappointmentModal">Create
        Doctor Appointment</a>
    <table class="table table-hover table-active table-bordered">
        <thead class="bg-warning">
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
        <tbody id="doctor_appointment_list" class="bg-success text-light">
        </tbody>
    </table>
</div>


<div class="modal pt-5 mt-5  " id="doctorappointmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h5 class="modal-title">Create Doctor Availability</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createappointment" class="bg-warning">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="patient_name" name="patient_name" class="form-control"
                               placeholder="Patient Name" required>
                    </div>
                    <div class="form-group">

                        <input type="text" id="patient_number" name="patient_number" class="form-control"
                               placeholder="Patient Mobile Number" required>
                    </div>
                    <div class="form-group">

                        <select id="specialization" name="specialization" class="form-control" required>
                            <option value="">Select Specialization...!</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="name" name="name" class="form-control" required>
                            <option value="">Select Doctor...!</option>
                        </select>
                        <input type="hidden" id="id">

                    </div>
                    <div class="form-group">
                        <input type="date" id="day" name="date" class="form-control"
                               placeholder="Date" required>
                    </div>
                    <div class="form-group">
                        <select id="appointment_time" name="appointment_time" class="form-control" required>
                            <option value="">Select Time...!</option>
                            <option value="4:30:00">4:30:00</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    function getHtml(results) {
        let html = '';
        for (let i = 0; i < results.length; i++) {
            let result = results[i]
            html += `<tr>
<td>${result['id']}</td>
<td>${result['patient_name']}</td>
<td>${result['patient_phone']}</td>
<td>${result['doctor_id']}</td>
<td>${result['specialization_id']}</td>
<td>${result['day']}</td>
<td>${result['appointment_time']}</td>
            <td>
                <a href="" class="btn btn-danger delete" data-id="${result['id']}">Delete</a>
                <a href="" class="btn btn-info edit" data-id="${result['id']}">Edit</a>
            </td>

</tr>`

        }
        return html
    }
    let loadData = () => {
        $.ajax({
            url: "api.php?action=doctor_appointment",
            method: "GET",
            success: (resp) => {
                $('#doctor_appointment_list').html(getHtml(resp));
            }

        })
    }
    loadData();

    $(document).on("click",".delete",function (event){
        event.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url:"api.php?action=delete_doctor_appointment&id=" + id,
            method:"POST",
            success:(resp) =>{
                loadData();
            }
        })
    })

    $.ajax({
        url: 'api.php?action=specialization',
        method: 'GET',
        success: function (specializations) {

            let options = '<option value="">Select Specialization...!</option>';
            for (var i = 0; i < specializations.length; i++) {
                let specialization = specializations[i];
                options += `<option value="${specialization['id']}">${specialization['specialization']}</option>`;
            }
            $('#specialization').html(options);
        }
    });
    $('#specialization').change(function () {
        let specializationValue = $('#specialization').val()
        $.ajax({
            url: "api.php?action=get_doctor_by_specialization&specialization_id=" + specializationValue,
            method: "GET",
            success: (resp) => {
                $('#name').empty();
                let html = document.getElementById('name');
                let element = document.createElement('option')
                element.text = 'Select Doctor...!'
                element.value = ''
                html.add(element)
                for (let i = 0; i < resp.length; i++) {
                    let data = resp[i]
                    let element = document.createElement('option')
                    element.text = data.name
                    element.value = data.id
                    html.add(element)
                }
            }
        })
    });
    let isEditMode = false;
    $(document).on("click",".edit",function (event){
        event.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "api.php?action=get_doctor_appointment&id=" + id,
            method:"GET",
            success:(resp) => {
                isEditMode = true;
                $("#id").val(resp.id)
                $("#patient_name").val(resp.patient_name)
                $("#patient_number").val(resp.patient_phone)
                $("#specialization").val(resp.specialization_id)
                $("#name").val(resp.doctor_id)
                $("#day").val(resp.day)
                $("#appointment_time").val(resp.appointment_time)

                $("#doctorappointmentModal").modal();
            }
        })
    })
    $('#createappointment').on('submit', (event) => {
        if(!isEditMode){
            event.preventDefault();
            let patient_name = $('#patient_name').val();
            let patient_phone = $("#patient_number").val();
            let doctor_id = $("#name").val();
            let specialization_id = $("#specialization").val();
            let day = $("#day").val();
            let appointment_time = $("#appointment_time").val();

            $.ajax({
                url: "api.php?action=create_doctor_appointment",
                method: "POST",
                data: {
                    patient_name: patient_name,
                    patient_phone: patient_phone,
                    doctor_id: doctor_id,
                    specialization_id: specialization_id,
                    day: day,
                    appointment_time: appointment_time
                },
                success: (resp) => {
                    loadData();
                    window.location.reload();
                }
            })
        }
        else{
            debugger
            let id = $("#id").val();
            $.ajax({
                url: "api.php?action=update_doctor_appointment&id=" + id,
                method:"POST",
                data:{
                    patient_name: $('#patient_name').val(),
                    patient_phone: $("#patient_number").val(),
                    doctor_id: $("#name").val(),
                    specialization_id: $("#specialization").val(),
                    day: $("#day").val(),
                    appointment_time: $("#appointment_time").val(),
                },
                success:(resp) => {

                }

            })

        }
    })

</script>

<?php include("layout/footer.php") ?>
