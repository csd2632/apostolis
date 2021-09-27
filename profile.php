<?php
session_start();
$username = $_SESSION["username"];
$id = $_SESSION["id"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/theus/chart.css/v1.0.0/dist/chart.css" />
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container-fluid">
        <div class="mb-10">
            <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
                <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                    <ul class="navbar-nav mr-auto">
                        <a id="logoutLink" href="logout.php" hidden></a>
                        <li class="nav-item mx-1"><button class="btn btn-danger navbar-btn" onclick="logOut()">Έξοδος</button></li>
                        <li class="nav-item mx-1"><button class="btn btn-warning navbar-btn" onclick="Impressionism()">Impressionism</button></li>
                        <li class="nav-item mx-1"><button class="btn btn-success navbar-btn" onclick="Surrealism()">Surrealism</button></li>
                        <a id="logoutLink" href="upload.php" hidden></a>

                    </ul>
                </div>
            </nav>
        </div>
        <br>
        <br>
        <br>
        <div class="card" style="padding: top 100px;">
            <div class="card-header d-flex justify-content-center">
                <h1>
                    PROFILE
                </h1>
            </div>
            <div class="card-body">
                <div class="card-title d-flex justify-content-center">
                    <h2>

                        <?php

                        echo $username;


                        ?>
                    </h2>

                </div>
                <div class="card-text">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <form id="fupForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="id" name="id" hidden value="<?php echo $id ?>">
                                </div>
                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" class="form-control" id="file" name="file" required />
                                </div>
                                <input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT" />
                            </form>
                        </div>
                        <div id="pdfList" class="col-4">

                        </div>
                    </div>
                </div>

            </div>
        </div>







    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="data.js"></script>
    <script src="./func/mapped_img.js"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
    <script src="./func/templates.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./profile.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>


</html>