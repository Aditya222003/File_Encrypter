<!DOCTYPE html>
<html>
<?php
session_start(); 
$usernamesql = $_SESSION['username'];
$_SESSION['username'] = $usernamesql;
if(empty($_SESSION["username"])) 
{
	header("Location: index.php");
}
?>
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
<style type='text/css'>

.backg{
  background-color: #f2f2f2;
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
<form name='form' method='post' ">
  <br><b>Encryption<b>
    <br>
  <form method="POST" action="encrypt.php" enctype="multipart/form-data">
  <br>
  <span></span>
  </form>
  
  
<form>
  Select FileName:
  <select id="mySelect">
    <option >-- Select File --</option>
    <?php
        include "dbConn.php";  // Using database connection file here
        $records = mysqli_query($db, "SELECT file_upld From upload_files where username='$usernamesql'");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". base64_decode($data['file_upld']) ."'>" .base64_decode($data['file_upld']) ."</option>";  // displaying data in option menu
        }
    ?> 


</select>

<?php mysqli_close($db);  // close connection ?>
</form>
  
<br><br><input type="text" name="fname" id="fname" placeholder =" Select File Name" readonly ><br/>
<br>
<input type="password" name="fpass" id="fpass" placeholder ="Enter File Password" required><br/><br>
<input type="submit" name="submit" value="Submit" > <br><br>

<script>
var select = document.getElementById('mySelect');
var input = document.getElementById('fname');
select.onchange = function() {
    input.value = select.value;
}
</script>

</div>

<?php



if((isset($_POST['fname'])) && !empty($_POST['fname']))
{
	if((isset($_POST['fpass'])) && !empty($_POST['fpass']))
	{
	function my_encrypt($data, $key) 
	{
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
	}
	
	
	$fname='';
	$fpass='';
	$fname = $_POST['fname'];
    $fpass = $_POST['fpass'];

	$msg = file_get_contents($fname);
	$key = $fpass;
	$msg_encrypted = my_encrypt($msg, $key);
	$file = fopen($fname, 'wb');
	fwrite($file, $msg_encrypted);
	fclose($file);
	echo "<script>
alert('File Encypted Successfully...!!!');
window.location.href='dashboard.php';
</script>";


}}


?>

</center>
</body>
</html>