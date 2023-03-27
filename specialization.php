<?php include("layout/header.php") ?>


<div class="container">
    <a href="#" class="btn btn-primary mb-5">Create Specialization</a>
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
    $.ajax({
        url: "api.php?action=get_specialization",
        method: "GET",
        success: (resp) => {
            $('#spec_list').html(getHtml(resp));
        }
    })
</script>


<?php include("layout/footer.php") ?>

