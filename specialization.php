<?php include("layout/header.php") ?>


<div class="container">
    <a href="#" class="btn btn-primary mb-5" data-toggle="modal" data-target="#createSpecialization">Create
        Specialization</a>
    <table class="table table-hover table-active table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Specializations</th>
            <th scope="col" class="text-center">Actions</th>

        </tr>
        </thead>
        <tbody id="spec_list">


        </tbody>
    </table>
</div>


<div class="modal" id="createSpecialization" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content  bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title">Create Specialization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createSpecialization">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name of Specialization</label>
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Please enter the name of specialization" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function getHtml(results) {
        debugger
        let html = "";
        for (var i = 0; i < results.length; i++) {
            let result = results[i];
            html += `<tr>
            <td>${result['id']}</td>
            <td>${result['specialization']}</td>
            <td><a href="" class="btn btn-danger">Delete</a></td>
            </tr>`;
        }
        return html;
    }

    let loadData = () => {
        $.ajax({
            url: "api.php?action=get_specialization",
            method: "GET",
            success: (resp) => {
                $('#spec_list').html(getHtml(resp));
            }
        })
    }
    loadData();


    $("#createSpecialization").on("submit", (event) => {
        event.preventDefault();
        let name = $("#name").val();
        $.ajax({
            url: "api.php?action=create_specialization",
            method: "POST",
            data: {
                name: name
            },
            success: (resp) => {
                loadData();
                $("#createSpecialization").modal('hide');
                $("#createSpecialization").find("input").val("");

            }
        })

    });
</script>


<?php include("layout/footer.php") ?>

