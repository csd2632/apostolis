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
                        <li class="nav-item mx-1"><button class="btn btn-info navbar-btn" id="printPdfButton">Print Screen</button></li>
                        <a id="logoutLink" href="upload.php">click me baby one more time</a>

                    </ul>
                </div>
            </nav>
        </div>
        <br>
        <br>
        <br>
        <div class="card" style="padding: top 100px;">
            <div class="card-header">
                <h1>
                    profile
                </h1>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <h1>
                        profile
                        <?php

                        echo '<div id="loginError" class="alert alert-danger"><text> this is the user id :' . $id . 'and the username :' . $username . '</text></div>';


                        ?>
                    </h1>

                </div>
                <div class="card-text">
                    <div class="row">
                        <div class="col-4">
                            <h1>1</h1>
                        </div>
                        <div class="col-4">
                            <h1>2</h1>
                        </div>
                        <div class="col-4">
                            <h1>3</h1>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <input type="file" id="pdf-upload" />
       <button id="upload-button">upload</button>




    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="data.js"></script>
    <script src="./func/mapped_img.js"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
    <script src="./func/templates.js"></script>
    <script src="./profile.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>


</html>