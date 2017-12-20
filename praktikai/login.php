<!Doctype html>
<html>
<head>
     <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <title>Login info</title>
    <link rel = "stylesheet" href = "bootstr/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "css/style.css">
</head>
<body>  
<center>
<?php
if(isset($_POST["submit"])){
if(!empty($_POST['user']) && !empty($_POST['pass'])) {
	$user=$_POST['user'];
	$pass=$_POST['pass'];
		$servername = "mysql.hostinger.lt";
		$username = "u949282972_adun";
		$password = "kompasxx";
		$dbname = "u949282972_users";
		$conn = new mysqli($servername, $username, $password, $dbname);

	$query=mysqli_query($conn, "SELECT * FROM Users WHERE username='".$user."' AND password='".$pass."'");
	$numrows=mysqli_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysqli_fetch_assoc($query))
	{
	$dbusername=$row['username'];
	$dbpassword=$row['password'];
    $dbrank = $row['rank'];
	}

	if($user == $dbusername && $pass == $dbpassword)
	{
	session_start();
	$_SESSION['sess_user']=$user;
        if($dbrank != 'user'){
           header("Location: admin.php"); 
        }
        else{
          header("Location: user.php");   
        }
	
	}
	} else {
	echo "Invalid username or password!";
	}

} else {
	echo "All fields are required!";
}
  
}
?>
<br>

    <form action="/index.php">
    <input type="submit" value="Go to main Page" />
    </form>
</center>
 </body>
</html>