
<?php
session_start(); 
$usernamesql = $_SESSION['username'];
$_SESSION['username'] = $usernamesql;
   session_destroy();
   echo "<script>
alert('Logout Successfully...!!!');
</script>";
?>


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
  top: 40%;
  position: absolute;
}
strong{
  font-size: 15px;
}
</style>
<div class = 'card'>
<strong>Logout Successfully...!! <a href='index.php'>Login here</a></strong>
</div>
</html>