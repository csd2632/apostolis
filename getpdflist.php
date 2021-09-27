<?php
session_start();
$id = $_SESSION["id"];
$servername = "localhost";
$dbname = "account";
$dbusername = "root";
$connection = new mysqli($servername, $dbusername, "", $dbname);

$sql = "select file_name from user_pdf where user_id = " . $id . ";";
$result = $connection->query($sql);
$data = $result->fetch_all();
$result_files = array();
// foreach ($data as &$filename) {
//     array_push($result_files, glob("./uploads/" . $filename[0]));
// }

// echo json_encode($result_files);
// // $allfiles = glob("./uploads/*.pdf");
// $filestosend =  array();

// foreach ($allfiles as &$file) {

//     if (in_array(basename($file) . PHP_EOL, $data)) {
//         array_push($filestosend, $file);
//     }
// }
// $uploadpath = './uploads/';
// $resultfiles = array();

echo json_encode($data);

// foreach ($filestosend as &$correctfile) {
//     array_push($resultfiles, file_get_contents($uploadpath . $correctfile, true));
//     echo $uploadpath . $correctfile;
// }


// echo json_encode($resultfiles);
