<?php include("layout/header.php") ?>

<div class="container">
    <a href="#" class="btn btn-primary mb-5" data-toggle="modal" data-target="#createdoctoravailability">Create Doctor
        Availability</a>
    <table class="table table-hover table-active table-bordered">
        <thead class="thead-dark">
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
        <tbody id="doctor_availability_list">
        </tbody>
    </table>
</div>


<div class="modal " id="createdoctoravailability" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title">Create Doctor Availability</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createavailability">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    function getHtml(results) {
        let html = '';
        for (var i = 0; i < results.length; i++) {
            let reuslt = results[i]
            html += `<tr>
<td>${reuslt['id']}</td>
<td>${reuslt['name']}</td>
<td>${reuslt['specialization']}</td>
<td>${reuslt['day']}</td>
<td>${reuslt['start_at']}</td>
<td>${reuslt['end_at']}</td>
            <td><a href="" class="btn btn-danger">Delete</a></td>

</tr>`

        }
        return html
    }

    let loadData = () => {
        $.ajax({
            url: "api.php?action=get_doctor_availability",
            method: "GET",
            success: (resp) => {
                $('#doctor_availability_list').html(getHtml(resp));
            }

        })
    }
    loadData();
    $.ajax({
        url: 'api.php?action=get_specialization',
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

    $('#createavailability').on('submit', (event) => {
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

                loadData();
                $("#createdoctoravailability").modal('hide');
                $("#createavailability").find("input").val("");
            }
        })

    });


</script>

<?php include("layout/footer.php") ?>
