<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <title>Register info</title>
    <link rel = "stylesheet" href = "bootstr/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "css/style.css">
</head>
<body>
    <center>
 <?php
if(isset($_POST["submit"])){

if(!empty($_POST['user']) && !empty($_POST['pass'])) {
	$user=$_POST['user'];
    $rank = "user";
        $servername = "mysql.hostinger.lt";
		$username = "u949282972_adun";
		$password = "kompasxx";
		$dbname = "u949282972_users";
      	$conn = new mysqli($servername, $username, $password, $dbname);
		// Create connection
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
    if(isset($_POST['admin'])){
        $rank = "admin";
    }
	$query=mysqli_query($conn,"SELECT * FROM Users WHERE username='".$user."'");
	$numrows=mysqli_num_rows($query);
	if($numrows==0)
	{
	$sql="INSERT INTO Users(username,password,rank) VALUES('$user','$pass','$rank')";

	$result=mysqli_query($conn, $sql);
	if($result){
	echo "Account Successfully Created";

	} else {
	echo "Failure!";
	}

	} else {
	echo "That username already exists! Please try again with another.";
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
