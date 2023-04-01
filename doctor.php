<?php include("layout/header.php") ?>

<div class="container">
    <a href="#" class="btn btn-primary mb-5" data-toggle="modal" data-target="#createdoctor">Create Doctor</a>
    <table class="table table-hover table-active table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Name</th>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">Specialization</th>
            <th scope="col" class="text-center">Number</th>
            <th scope="col" class="text-center">Degree</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody id="doctor_list">
        </tbody>
    </table>
</div>

<div class="modal " id="createdoctor" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title">Create Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createdoctor">
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
                        <!--                        <label for="name">Name</label>-->
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
            let result = results[i]
            html += `<tr>
<td>${result['id']}</td>
<td>${result['name']}</td>
<td>${result['email']}</td>
<td>${result['specialization']}</td>
<td>${result['phone_number']}</td>
<td>${result['degree']}</td>
<td><a href="#" class="btn btn-danger" data-id="${result['id']}">Delete</a></td>

</tr>`

        }
        return html
    }

    let loadData = () => {

        $.ajax({
            url: "api.php?action=get_doctor",
            method: "GET",
            success: (resp) => {
                $('#doctor_list').html(getHtml(resp));
            }

        })
    }
    loadData();
    $(document).on("click",".btn-danger",function (event){
        event.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            url: "api.php?action=delete_doctor&id=" + id,
            method: "POST",
            success:(resp) =>{
                loadData();
            }
        })

    })

        $.ajax({
            url: 'api.php?action=get_specialization',
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

<?php include("layout/footer.php") ?>
