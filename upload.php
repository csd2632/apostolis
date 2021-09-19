<?php
session_start();
$blob = $_POST['pdf'];
$id = $_SESSION["id"];
$servername = "localhost";
$dbname = "account";
$dbusername = "root";
$connection = new mysqli($servername, $dbusername, "", $dbname);


$result = 1;

$sql = "insert into user_pdf(user_id,pdf_file,pdf_name) values(" . $id . "," . $blob . ",otidipote)";
try {
    $result = $connection->query($sql);
$finalResult = $result->fetch_array()[0] ?? '';
echo true;
} catch (\Throwable $th) {
    echo false;
}
