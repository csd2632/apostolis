<?php
$uploadDir = 'uploads/';
$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);
$servername = "localhost";
$dbname = "account";
$dbusername = "root";
$connection = new mysqli($servername, $dbusername, "", $dbname);

if (isset($_POST['id']) || isset($_POST['file'])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $uploadStatus = 1;
        $uploadedFile = '';
        if (!empty($_FILES["file"]["name"])) {

            // File path config 
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $uploadedFile = $fileName;
            } else {
                $uploadStatus = 0;
                $response['message'] = 'Sorry, there was an error uploading your file.';
            }
        }
        if ($uploadStatus == 1) {
            $sql = "insert into user_pdf(user_id,file_name) values(" . $id . ",'" . $uploadedFile . "')";
            try {
                $result = $connection->query($sql);
                $response['status'] = 1;
                $response['message'] = 'Form data submitted successfully!';
            } catch (Exception) {
                $response['status'] = 0;
                $response['message'] = 'dberror!';
            }
        }
    } else {
        $response['message'] = 'Please fill all the mandatory fields (name and email).';
    }
}



// Return response 
echo json_encode($response);
