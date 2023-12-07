<?php

print_r($_FILES);
$uploadDir =  __DIR__ . '/vendor/uploads/';


if (isset($_FILES)) {

  if ($_FILES['file1']) {
    $file = $_FILES['file1'];
  }
  if ($_FILES['file2']) {
    $file = $_FILES['file2'];
  }
  if ($_FILES['file3']) {
    $file = $_FILES['file3'];
  }
  if ($_FILES['file4']) {
    $file = $_FILES['file4'];
  }

  $fileName = basename($file['name']);
  $fileName = generateNewFileName($fileName);
  $uploadedFile = $uploadDir . $fileName ;

  echo $uploadedFile;

  $response = array();


  if (move_uploaded_file($file['tmp_name'], $uploadedFile)) {
    $response['success'] = true;
    $response['message'] = 'File has been uploaded successfully.';
  } else {
    $response['success'] = false;
    $response['message'] = 'Error uploading file.';
  }

  echo json_encode($response);


};



?>
