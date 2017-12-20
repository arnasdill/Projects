<!DOCTYPE HMTL>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <title>Task</title>
    <link rel = "stylesheet" href = "bootstr/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "css/style.css">
</head>
<body>
    <center><h1>Welcome!</h1></center>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-6 specialDiv">
            <h1>Login</h1>
            <form action="/login.php" method="post" autocomplete="off">
              
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username"autocomplete="new-username" name="user" required><br>
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" autocomplete="new-password" name="pass" required><br>
                <input type="submit" value="Login" name="submit" />
            
            
            </form>
            </div>
            <div class = "col-md-6 specialDiv">
                <h1>Register</h1>
                <form action="/register.php" method="post" >
                    <label><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="user" autocomplete="new-username" required><br>
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pass" autocomplete="new-password" required><br>
                    <input type="checkbox" name="admin" value="admin"><b>Admin?</b>(check if you want admin rights)<br>
                    <input type="submit" value="Register" name="submit" /> 
                </form>
            </div>   
     </div>
    </div>
    
</body>
</html>