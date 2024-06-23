<?php
require("connection.php");
include('includes/header.php');
include('includes/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Logic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <div class="container bg-white text-light p-3 rounded my-4 shadow">
        <div class="d-flex align-items-center justify-content-between mx-3">
            <h2>
                <a href="index.php" class="text-dark text-decoration-none">
                    <i class="bi bi-bar-chart-fill"></i> Contact Us
                </a>
            </h2>
        </div>
    </div>


    <div class="container mt-5 p-0 shadow">
        <table class="table table-hover text-center">
            <thead class="bg-white text-dark">
                <tr>
                    <th width="10%" scope="col" class="rounded-start">Sr. No.</th>
                    <th width="15%" scope="col">Name</th>
                    <th width="10%" scope="col">Email</th>
                    <th width="10%" scope="col">Subject</th>
                    <th width="35%" scope="col">Concern</th>
                    <th width="20%" scope="col" class="rounded-end">Action</th>
            </thead>
            <tbody class="bg-white">
                <?php
                $query = "SELECT * FROM `contactus`";
                $result = mysqli_query($con, $query);
                $i = 1;
                while ($fetch = mysqli_fetch_assoc($result)) {
                    echo <<<product
                        <tr class="align-middle">
                        <th scope="row" >$i</th>
                        <td>$fetch[name]</td>
                        <td>$fetch[email]</td>
                        <td>$fetch[subject]</td>
                        <td>$fetch[concern]</td>
                        <td>
                            <button onclick="confirm_rem($fetch[sno])" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>
                        </td>
                        </tr>
                    product;
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>



    <script>
        function confirm_rem(sno) {
            if (confirm("Are you sure, you want to delete item ?")) {
                window.location.href = "contact_crud.php?rem=" + sno;
            }
        }
    </script>
</body>

</html>