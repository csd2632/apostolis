<?php
session_start();
$id = $_SESSION["id"];
$server_path = $_SERVER['DOCUMENT_ROOT'];
$rest_path = $_POST["path"];



$response = array(
    'status' => 0,
    'message' => 'Something went wrong please try again'
);

if (isset($_POST['id'])) $item_id = $_POST['id'];
else echo $response;


$servername = "localhost";
$dbname = "account";
$dbusername = "root";
$connection = new mysqli($servername, $dbusername, "", $dbname);

// $fetchsql = 'Select file_name from user_pdf u where u.id = ' . $item_id;

// $response_fetch = $connection->query($fetchsql);
// $file_to_delete = strval($response_fetch->fetch_all()[0][0]);
// $file_path = $server_path . '/' . $rest_path . $file_to_delete;
// $correct_path = str_replace('/', '\\', $file_path);
// echo 'this is the correct path : ' . $correct_path;

// echo 'this is the path : ' . $file_path;

// if (unlink('../uploads/' . $file_to_delete)) {
$sql = "delete from user_pdf where id = " . $item_id . " and user_id = " . $id . ";";
try {
    $result = $connection->query($sql);
} catch (Exception $e) {
    $response['message'] = $e;
    echo $response;
}
$response['message'] = 'The Item was deleted!';
// } else {
//     $response['message'] = 'File not found';
//     echo json_encode($response);
// }





// echo ($response);
