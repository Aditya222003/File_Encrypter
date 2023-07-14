
<?php

session_start(); 
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
</head>
<body>
<style type='text/css'>
input{
  width: 60%;
  height: 40px;
}
.card{
  box-shadow:0 4px 8px 0 rgba(0,0,0,.2);
  border-radius:10px;
  width: 30%;
  left: 35%;
  top: 20%;
  position: absolute;
}
strong{
  font-size: 15px;
}

@supports (-webkit-appearance: none) or (-moz-appearance: none) {
  input[type=checkbox],
input[type=radio] {
    --active: #275efe;
    --active-inner: #fff;
    --focus: 2px rgba(39, 94, 254, 0.3);
    --border: #bbc1e1;
    --border-hover: #275efe;
    --background: #fff;
    --disabled: #f6f8ff;
    --disabled-inner: #e1e6f9;
    -webkit-appearance: none;
    -moz-appearance: none;
    height: 21px;
    outline: none;
    display: inline-block;
    vertical-align: top;
    position: relative;
    margin: 0;
    cursor: pointer;
    border: 1px solid var(--bc, var(--border));
    background: var(--b, var(--background));
    transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
  }
  input[type=checkbox]:after,
input[type=radio]:after {
    content: "";
    display: block;
    left: 0;
    top: 0;
    position: absolute;
    transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
  }
  input[type=checkbox]:checked,
input[type=radio]:checked {
    --b: var(--active);
    --bc: var(--active);
    --d-o: 0.3s;
    --d-t: 0.6s;
    --d-t-e: cubic-bezier(0.2, 0.85, 0.32, 1.2);
  }
  input[type=checkbox]:disabled,
input[type=radio]:disabled {
    --b: var(--disabled);
    cursor: not-allowed;
    opacity: 0.9;
  }
  input[type=checkbox]:disabled:checked,
input[type=radio]:disabled:checked {
    --b: var(--disabled-inner);
    --bc: var(--border);
  }
  input[type=checkbox]:disabled + label,
input[type=radio]:disabled + label {
    cursor: not-allowed;
  }
  input[type=checkbox]:hover:not(:checked):not(:disabled),
input[type=radio]:hover:not(:checked):not(:disabled) {
    --bc: var(--border-hover);
  }
  input[type=checkbox]:focus,
input[type=radio]:focus {
    box-shadow: 0 0 0 var(--focus);
  }
  
  
  
  
  
  
  input[type=checkbox],
input[type=radio] {
    width: 21px;
  }

 























	
  
  
  
  
  
  
  
  
  
  
  input[type=checkbox]:not(.switch):after {
    width: 5px;
    height: 9px;
    border: 2px solid var(--active-inner);
    border-top: 0;
    border-left: 0;
    left: 7px;
    top: 4px;
    transform: rotate(var(--r, 20deg));
  }















ul {
  margin: 12px;
  padding: 0;
  list-style: none;
  width: 100%;
  max-width: 320px;
}




</style>
<center>
<div class = 'card'>
  <br><b>Login Here<b><br><br>
	<form action='index.php' method='post'>
		<input type='text' name='username' placeholder='Username' required ><br><br>
	    <input type='password' name='password' placeholder='Password' id="myInput" required><br><br>
		<ul>
  <li>
    <input type="checkbox" onclick="myFunction2()">
    <label for="c1">Show Password</label>
  </li>
</ul>
	    <input type='submit' name='submit_btn' value='Sign In'>
		
	</form><br>
<strong>Don't have an account? <a href='signup.php'>Sign Up</a></strong><br>
<script>
function myFunction2() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}</script>
<?php

error_reporting(E_ERROR | E_PARSE);
$usernamesql = $_POST["username"];
$usernamesql = base64_encode($usernamesql);
$passwordsql = $_POST["password"];
$passwordsql = base64_encode($passwordsql);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fileshare";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(isset($_POST['submit_btn'])){
	$sql2 = "SELECT password FROM login_details WHERE username = '".$usernamesql."'";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
   	while($row = $result->fetch_assoc()) {
   		$fres = $row['password'];
   		if($fres == $passwordsql){
   			$_SESSION['username'] = $usernamesql;
   			header("Location: dashboard.php");
       		}
       		else {
				echo "<font color='red'>"."Incorrect username or password"."</font>";
		echo "<script>
alert('Incorrect username or Password');
</script>";
       		}
   	}
}
}
echo "</div>

";
?>
</center> 
</body>
</html>