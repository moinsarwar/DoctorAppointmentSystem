<?php include('layout/header.php'); ?>
<div class="container">
    <a href="#" class="btn btn-primary mb-5" data-toggle="modal" data-target="#createdoctor">Create Doctor</a>
    <table class="table  table-bordered">
        <thead class="bg-warning">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Doctor Name</th>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">Specialization</th>
            <th scope="col" class="text-center">Mobile Number</th>
            <th scope="col" class="text-center">Degree</th>
            <th scope="col" class="text-center">Action</th>

        </tr>
        </thead>
        <tbody id="doctor_list" class="bg-success text-light">


        </tbody>
    </table>
</div>

<div class="modal mt-5 pt-5  " id="createdoctor" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark">Create Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createdoctor" class="bg-warning text-dark">
                <div class="modal-body">
                    <div class="form-group">
                        <!--                        <label for="name">Name</label>-->
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <!--                        <label for="name">Name</label>-->
                        <input type="text" id="email" name="email" class="form-control"
                               placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <select id="specialization" name="specialization" class="form-control" required>
                            <option value="">Select Specialization...!</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <input type="text" id="number" name="number" class="form-control"
                               placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <!--                        <label for="name">Name</label>-->
                        <input type="text" id="degree" name="degree" class="form-control"
                               placeholder="Degree" required>
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
        for (var i = 0; i < results.length; i++) {
            let result = results[i]

            html += `<tr>
    <td>${result['id']}</td>
    <td>${result['name']}</td>
    <td>${result['email']}</td>
    <td>${result['specialization_id']}</td>
    <td>${result['phone_number']}</td>
    <td>${result['degree']}</td>
            <td><a href="" class="btn text-light btn-danger delete" data-id="${result['id']}" >Delete</a></td>

</tr>`
        }
        return html
    }

    let loadData = () =>{
        $.ajax({
            url: "api.php?action=doctor",
            method: "Get",
            success: (resp) => {
                $('#doctor_list').html(getHtml(resp));
            }
        })
    }
    loadData();
    $.ajax({
        url: 'api.php?action=specialization',
        method: 'GET',
        success: function (specializations) {
            let options = '<option value="">Select Specialization</option>';
            for (var i = 0; i < specializations.length; i++) {
                let specialization = specializations[i];
                options += `<option value="${specialization['id']}">${specialization['specialization']}</option>`;
            }
            $('#specialization').html(options);
        }
    });
    $(document).on("click",(".delete"), function (event){
        event.preventDefault();
        debugger
        let id = $(this).data('id');
        $.ajax({
            url: "api.php?action=delete_doctor&id=" + id,
            method: "POST",
            success:(resp) =>{
                loadData()
            }
        })
    })

    $('#createdoctor').on("submit", (event) => {
        event.preventDefault();
        let name = $("#name").val();
        let email = $('#email').val();
        let degree = $('#degree').val();
        let specialization = $('#specialization').val();
        let number = $('#number').val();
        $.ajax({
            url: "api.php?action=create_doctor",
            method: "POST",
            data: {
                name: name,
                email: email,
                degree: degree,
                specialization: specialization,
                number: number,
            },
            success: (resp) => {
                $("#createdoctor").modal('hide');
                $("#createdoctor").find("input").val("");
                loadData();
            }
        })
    });

</script>
