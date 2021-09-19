<?php
session_start();
$id = $_SESSION["id"];
$servername = "localhost";
$dbname = "account";
$dbusername = "root";
$connection = new mysqli($servername, $dbusername, "", $dbname);


$result = 1;

$sql = "Select number from test_table where id=1";
$result = $connection->query($sql);
$finalResult = $result->fetch_array()[0] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div><text><?php echo $finalResult ?></text></div>
</body>

</html>