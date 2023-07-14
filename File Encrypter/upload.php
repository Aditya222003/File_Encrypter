<?php
session_start();
$usernamesql = $_SESSION['username'];
$_SESSION['username'] = $usernamesql;

$newFileName = $_SESSION['newFileName'];
$_SESSION['newFileName']=$newFileName;

$message = ''; 
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = $fileName;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'pdf', 'exe', 'vbs', 'rar', 'sh', 'der', '7z', 'iso', 'pptx', 'js', 'json', 'xlsx', 'docx', 'csv','mp4');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = '';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $uploadFileDir2 = ''.$newFileName;
		$uploadFileDir2=base64_encode($uploadFileDir2);
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fileshare";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        	die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO upload_files (username, file_upld) VALUES ('".$usernamesql."', '".$uploadFileDir2."')";
        if (mysqli_query($conn, $sql)) {
        	echo "New record created successfully";
        } else {
        	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $message ='File is successfully uploaded.';
        
        mysqli_close($conn);
      }      
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }  
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}


$_SESSION['message'] = $message;
header("Location: uploader.php");
?>