<?php include("layout/header.php") ?>

<div class="container">
    <a href="#" class="btn btn-primary mb-5" data-toggle="modal" data-target="#doctoravailabilityModal">Create Doctor
        Availability</a>
    <table class="table table-hover table-active table-bordered">
        <thead class="bg-warning">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Name</th>
            <th scope="col" class="text-center">Specialization</th>
            <th scope="col" class="text-center">Day</th>
            <th scope="col" class="text-center">Start At</th>
            <th scope="col" class="text-center">End At</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody id="doctor_availability_list" class="bg-success text-light">
        </tbody>
    </table>
</div>


<div class="modal mt-5 pt-5 " id="doctoravailabilityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark">Create Doctor Availability</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createavailability" class="bg-warning">
                <div class="modal-body">

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
                        <select id="day" name="day" class="form-control" required>
                            <option value="">Select Day...!</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="time" id="start_at" name="start_at" class="form-control"
                               placeholder="Start At" required>
                    </div>
                    <div class="form-group">
                        <input type="time" id="end_at" name="end_at" class="form-control"
                               placeholder="End At" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn" class="btn btn-success">Save changes</button>
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
<td>${result['doctor_id']}</td>
<td>${result['specialization_id']}</td>
<td>${result['day']}</td>
<td>${result['start_at']}</td>
<td>${result['end_at']}</td>
            <td><a href="" class="btn btn-danger delete" data-id="${result['id']}">Delete</a>
                <a href="" class="btn btn-info edit" data-id="${result['id']}">Edit</a>
            </td>

</tr>`

        }
        return html
    }

    let loadData = () => {
        $.ajax({
            url: "api.php?action=doctor_availability",
            method: "GET",
            success: (resp) => {
                $('#doctor_availability_list').html(getHtml(resp));
            }

        })
    }
    loadData();
    $(document).on("click",".delete",  function (event){
        event.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "api.php?action=delete_doctor_availability&id=" + id,
            method:"POST",
            success:(resp) =>{
                loadData();
            }
        })
    });
    $.ajax({
        url: 'api.php?action=specialization',
        method: 'GET',
        success: function (specializations) {

            let options = '<option value="">Select Specialization...!</option>';
            for (let i = 0; i < specializations.length; i++) {
                let specialization = specializations[i];
                options += `<option value="${specialization['id']}">${specialization['specialization']}</option>`;
            }
            $('#specialization').html(options);
        }
    });



    $('#specialization').change(function (){
        let specializationValue = $('#specialization').val()
        $.ajax({
            url: "api.php?action=get_doctor_by_specialization&specialization_id=" + specializationValue,
            method:"GET",
            success:(resp) =>{
                $('#name').empty();
                let html = document.getElementById('name');
                let element = document.createElement('option')
                element.text = 'Select Doctor...!'
                element.value = ''
                html.add(element)
                for (let i = 0;i < resp.length;i++){
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
    $(document).on("click", ".edit", function (event) {
        event.preventDefault();

        let id = $(this).data('id');
        $.ajax({
            url: "api.php?action=get_doctor_availability&id=" + id,
            method: "GET",
            success: (resp) => {
                isEditMode = true;
                $('#id').val(resp.id);
                $("#name").val(resp.doctor_id);
                $("#specialization").val(resp.specialization_id);
                $("#day").val(resp.day);
                $("#start_at").val(resp.start_at);
                $("#end_at").val(resp.end_at);
                $("#doctoravailabilityModal").modal();

            }
        })
    })
    loadData();

    $('#createavailability').on('submit', (event) => {
        if(!isEditMode){
            event.preventDefault();
            let name = $('#name').val();
            let specialization = $('#specialization').val();
            let day = $('#day').val();
            let start_at = $('#start_at').val();
            let end_at = $('#end_at').val();
            $.ajax({
                url: "api.php?action=create_doctor_availability",
                method: "POST",
                data: {
                    name: name,
                    specialization: specialization,
                    day: day,
                    start_at: start_at,
                    end_at: end_at,
                },
                success: (resp) => {
                    window.location.reload();
                    loadData();
                }
            })
        }else{
            let id = $("#id").val();
            $.ajax({
                url: "api.php?action=update_doctor_availability&id=" + id,
                data : {
                    name: $("#name").val(),
                    specialization:$("#specialization").val(),
                    day:$("#day").val(),
                    start_at:$("#start_at").val(),
                    end_at:$("#end_at").val(),
                },
                method: "POST",
                success: (resp) => {
                    window.location.reload();
                    loadData();
                    isEditMode = false;
                }
            })
        }
    });


</script>

<?php include("layout/footer.php") ?>
