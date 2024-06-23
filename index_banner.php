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
                    <i class="bi bi-bar-chart-fill"></i> Banner
                </a>
            </h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addproduct">
                <i class="bi bi-plus-lg"></i> Add
            </button>
        </div>
    </div>


    <div class="container mt-5 p-0 shadow">
        <table class="table table-hover text-center">
            <thead class="bg-white text-dark">
                <tr>
                    <th width="10%" scope="col" class="rounded-start">Sr. No.</th>
                    <th width="15%" scope="col">Image</th>
                    <th width="10%" scope="col">Title</th>
                    <th width="35%" scope="col">Description</th>
                    <th width="20%" scope="col" class="rounded-end">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                $query = "SELECT * FROM `banner`";
                $result = mysqli_query($con, $query);
                $i = 1;
                $fetch_src = FETCH_SRC;
                while ($fetch = mysqli_fetch_assoc($result)) {
                    echo <<<product
                        <tr class="align-middle">
                        <th scope="row" >$i</th>
                        <td><img src="$fetch_src$fetch[image]" width="150px"></td>
                        <td>$fetch[title]</td>
                        <td>$fetch[description]</td>
                        <td>
                            <a href="?edit=$fetch[Id]" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
                            <button onclick="confirm_rem($fetch[Id])" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>
                        </td>
                        </tr>

                    product;
                    $i++;
                }


                ?>

            </tbody>
        </table>
    </div>

    <!-- Add Product -->
    <div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud_banner.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add</h5>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" name="desc" required></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text">Image</label>
                            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.svg" required>
                        </div>
                    </div>
                    <div class="modal-footer mb-3">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancle</button>
                        <button type="submit" class="btn btn-success" name="addproduct">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit Product -->
    <div class="modal fade" id="editproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud_banner.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit</h5>
                    </div>
                    <div class="modal-body">
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" class="form-control" name="title" id="edittitle" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" name="desc" id="editdesc" required></textarea>
                        </div>
                        <img src="" id="editimg" width="100%" class="mb-3"><br>
                        <div class="input-group mb-3">
                            <label class="input-group-text">Image</label>
                            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.svg">
                        </div>
                        <input type="hidden" name="editpid" id="editpid">
                        <div class="modal-footer mb-3">
                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-success" name="editproduct">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php

    if (isset($_GET['edit']) && $_GET['edit'] > 0) {
        $query = "SELECT * FROM `banner` WHERE `Id`='$_GET[edit]'";
        $result = mysqli_query($con, $query);
        $fetch = mysqli_fetch_assoc($result);
        echo "
        <script>
            var editproduct = new bootstrap.Modal(document.getElementById('editproduct'), {
            keyboard: false
            });
            editproduct.show()
            document.querySelector('#edittitle').value=`$fetch[title]`;
            document.querySelector('#editdesc').value=`$fetch[description]`;
            document.querySelector('#editimg').src=`$fetch_src$fetch[image]`;
            document.querySelector('#editpid').value=`$_GET[edit]`;
        </script>
        ";
    }

    include('includes/footer.php');
    ?>

    <script>
        function confirm_rem(Id) {
            if (confirm("Are you sure, you want to delete item ?")) {
                window.location.href = "crud_banner.php?rem=" + Id;
            }
        }
    </script>
</body>

</html>