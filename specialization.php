<?php include("layout/header.php"); ?>

<div class="container">
    <a href="#" class="btn btn-primary mb-5" id="cr" data-toggle="modal" data-target="#createSpecialization">Create
        Specialization</a>
    <table class="table  table-bordered">
        <thead class="bg-warning ">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Specializations</th>
            <th scope="col" class="text-center">Actions</th>

        </tr>
        </thead>
        <tbody id="spec_list" class="bg-success text-light">


        </tbody>
    </table>
</div>
<div class="modal mt-5 pt-5" id="createSpecialization" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content  bg-dark text-light">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark">Create Specialization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createSpecialization" class="bg-warning text-dark">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name of Specialization</label>
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Please enter the name of specialization" required>
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
        let html = "";
        for (var i = 0; i < results.length; i++) {
            let result = results[i];
            html += `<tr>
            <td>${result['id']}</td>
            <td>${result['specialization']}</td>
            <td><a href="" class="btn text-light btn-danger delete" data-id="${result['id']}">Delete</a></td>
</tr>`;
        }
        return html;
    }

    let loadData = () => {
        $.ajax({
            url: "api.php?action=specialization",
            method: "GET",
            success: (resp) => {
                $('#spec_list').html(getHtml(resp));
            }
        })
    }
    $(document).on("click",".delete",function (event){
        event.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url:"api.php?action=delete_specialization&id=" + id,
            method:"POST",
            success:(resp) =>{
                loadData();
            }
        })


    })
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

