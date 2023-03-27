<?php include("layout/header.php") ?>

<div class="container">
    <a href="#" class="btn btn-primary mb-5">Create Specialization</a>
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

<script>
    function getHtml(results) {
        debugger
        let html = '';
        for (var i = 0; i < results.length; i++) {
            let reuslt = results[i]
            html += `<tr>
<td>${reuslt['id']}</td>
<td>${reuslt['name']}</td>
<td>${reuslt['email']}</td>
<td>${reuslt['specialization']}</td>
<td>${reuslt['phone_number']}</td>
<td>${reuslt['degree']}</td>
            <td><a href="" class="btn btn-danger">Delete</a></td>

</tr>`

        }
        return html
    }

    $.ajax({
        url: "api.php?action=get_doctor",
        method: "GET",
        success: (resp) => {
            $('#doctor_list').html(getHtml(resp));
        }

    })
</script>

<?php include("layout/footer.php") ?>
