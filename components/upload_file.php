<?php
require 'connection.php';

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
    session_start();
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $overwrite = (isset($_POST['overwrite'])) ? $_POST['overwrite'] : 0;

    // sanitize file-name
    $newFileName = md5($fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('xlsx', 'doc', 'txt');

    if (in_array($fileExtension, $allowedfileExtensions)) {
      // directory in which the uploaded file will be moved
      $uploadFileDir = '../reports/';
      $dest_path = $uploadFileDir . $newFileName;
      $sql = "select  count(*) count from files where file_name = '$fileName' and route = '$dest_path' and report_id=$_POST[TypeReport]";
      $result = $conn->query($sql);
      if ($result->fetch_assoc()['count'] == 0 || $overwrite == 1) {
        if ($overwrite == 1) {
          $sql = "delete from files where file_name = '$fileName' and route = '$dest_path'";
          if (!$conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Error al Sobreescribir el archivo. Contácte al administrador.";
            $status = 500;
            header("Location: ../index.php?status=$status");
            return;
          }
          $conn->close();
        }
        //Inserción de Registro de Reporte
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $dest_path = substr($dest_path, 1);
          $sql = "INSERT INTO `files`(`date`, `upload_day`, `file_name`, `report_id`, `route`) VALUES ('$_POST[ActivityDate]',(select CURRENT_TIMESTAMP()),'$fileName',$_POST[TypeReport],'$dest_path')";
          if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = 'File is successfully uploaded.';
            $status = 200;
            header("Location: ../index.php?status=$status");
          } else {
            $_SESSION['message'] = 'There was some error moving the file to upload directory.';
            $status = 500;
            header("Location: ../index.php?status=$status");
          }
          $conn->close();
        } else {
          $_SESSION['message'] = 'There was some error moving the file to upload directory.';
          $status = 500;
          header("Location: ../index.php?status=$status");
        }
      } else {
        $_SESSION['message'] = 'There is a file with the same name already, to overwrite the existing file, please select the box "Overwrite"';
        $status = 500;
        header("Location: ../index.php?status=$status");
      }
    } else {
      $_SESSION['message'] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
      $status = 500;
      header("Location: ../index.php?status=$status");
    }
  } else {
    $_SESSION['message'] = 'There is some error in the file upload. Please check the following error.<br>';
    $_SESSION['message'] .= 'Error:' . $_FILES['uploadedFile']['error'];
    $status = 500;
    header("Location: ../index.php?status=$status");
  }
}
