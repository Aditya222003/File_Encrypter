<?php
session_start(); 
$usernamesql = $_SESSION['username'];
$_SESSION['username'] = $usernamesql;
if(empty($_SESSION["username"])) 
{
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fileshare</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel='stylesheet' href="background/style101.css">
	<link rel="stylesheet" href="background/style102.css">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <?php
  echo "Welcome , ".base64_decode($usernamesql)."","<br>";
  echo "<br>";
?> 
	
</head>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1">																
<style>
    .imgp{max-height:150px;max-width:150px;}
    div.gallery{margin:5px;border: 1px solid transparent;float:left;width:180px;height:220px;margin-bottom:15px;}div.gallery:hover{border: 1px solid #777;}div.gallery img{width:100%;}div.desc{padding:15px;text-align:center;}div.imgt{font-size:12px;}div.imgd{font-size:9px;}.contp1{overflow:hidden;text-overflow:ellipsis;max-height:1.5em;line-height:1.5em;}ul{list-style-type:none;margin:0;padding:0;overflow:hidden}li a{float:left;display:block;font-weight:700;color:#0000cd;background-color:#f2f2f2;text-align:center;padding:4px;text-transform:uppercase;text-decoration:none}
span{
  font-size: 20px;
  font-weight: bold;
}
.backg{
  background-color: #f2f2f2;
}
.sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 30%; /* Set the width of the sidebar */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  /* Black */
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 30px;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

input{
width: 85%;
height: 40px;
}
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

input{
  width: 60%;
  height: 40px;
}
.card{
  box-shadow:0 4px 8px 0 rgba(0,0,0,.2);
  border-radius:10px;
  width: 30%;
  left: 35%;
  top: 37%;
  position: absolute;
}
strong{
  font-size: 15px;
}  
		span{
			font-size: 20px;
		}
		center{
			margin-top: 10%;
		}
	</style>
	
	

<body>
<div class="topnav">
  <a class="active" href="dashboard.php">Dashboard</a>
  <a href="uploader.php">Upload</a>
  <a href="encrypt.php">Encryption</a>
  <a href="decrypt.php">Decryption</a>
  <a href="logout.php">LogOut</a>
</div>
<br><br>


<center>
<div class = 'card'>
  <form method="POST" action="upload.php" enctype="multipart/form-data">
      <span><br>Upload a File</span><br><br><br>
      <input type="file" name="uploadedFile" /><br><br>
    <input type="submit" name="uploadBtn" value="Upload" /><br><br>
  </form><br>
  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
 
if (isset($_POST['share_btn'])) {
  $userid = $_POST['userid'];
  $file_name = $_POST['file_name'];
  $file_pth = ''.$file_name;
  $sql5 = "INSERT INTO upload_files (username, file_upld) VALUES ('".$userid."','".$file_pth."')";
  mysqli_query($conn, $sql5);
}
  ?>

</center>
</body>
</html>
