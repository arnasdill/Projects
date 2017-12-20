<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <title>Admin panel</title>
    <link rel = "stylesheet" href = "bootstr/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "css/style.css">    
</head>
<body>
    <?php
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
    }
?>
<?php
     session_start();
   if (isset($_SESSION['sess_user'])){
    $user = $_SESSION['sess_user'];
    $query=mysqli_query($conn, "SELECT * FROM Users WHERE username='".$user."'");
	$numrows=mysqli_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysqli_fetch_assoc($query))
	{
	$dbusername=$row['username'];
	$dbpassword=$row['password'];
    $dbrank = $row['rank'];
    }
   echo " <center><h1>Hello, <strong>".$user."</strong> !<br></h1></center> <br>";
   echo " <center><h2>Your permissions: ".$dbrank." !<br></h2></center>";     
    }
   }
?>
<div class = "container">
    <div class = "row">
        <div class = "col-md-6 specialDiv">
            <h1>Create task.</h1>
          <form  method="post" autocomplete="off">
                <label><b>Task title:</b></label>
                <input type="text" placeholder="Enter task title" name="task"><br>
                <input type="submit" value="Create" name="submitTask" />
            </form>
            <?php
            if(isset($_POST["submitTask"])){
                if(isset($_POST["task"])){
                    $task = $_POST["task"];
                    $sql1 = mysqli_query($conn,"SELECT  name FROM Uzduotys WHERE name = '$task'");
                    $numrows=mysqli_num_rows($sql1);
                    if($numrows==0)
                    {
                    $sql = "INSERT INTO Uzduotys(name) VALUES('$task')"; 
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "Task Successfully Created";
                        unset($_POST);  
                     
                        echo "<meta http-equiv='refresh' content='0'>";
                    } 
                    
                    else {
                            echo "Failure!";
                            unset($_POST); 
                        }
                    }
               else echo "Task with that name already created!";
                    
            }
                 else{
                    echo "missing task name!";
                    unset($_POST); 
                }  
            }
            
            ?>
        </div>
        <div class = "col-md-6 specialDiv">
        <h1> Set task for user.</h1>  
        <form action = "" method = "post">
        <label><b>Select user:</b></label>
        <select name="userForTask">
            <?php 
            $query=mysqli_query($conn, "SELECT username FROM Users WHERE rank = 'user'");
            while($row=mysqli_fetch_assoc($query))
            {
            $name = $row['username'];
            echo "<option value=\"$name\">" . $row['username'] . "</option>";
            }
            ?>
        </select><br>
        <label><b>Select task:</b></label>
        <select name="taskForUser">
            <?php 
            $query=mysqli_query($conn, "SELECT name FROM Uzduotys");
            while($row=mysqli_fetch_assoc($query))
            {
                $name = $row['name'];
            echo "<option value=\"$name\">" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Set task" name="submitUserTask" />  
        </form>
        <?php
            if(isset($_POST['userForTask']) && isset($_POST['taskForUser']) && isset($_POST['submitUserTask'])){
                $uname = $_POST['userForTask'];
                $taskName = $_POST['taskForUser'];
                $sql = "UPDATE Uzduotys SET user = '$uname', progress = 'IN PROGRESS' WHERE name = '$taskName' "; 
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "Task sucessfully set!";
                    unset($_POST); 
                   
                    echo "<meta http-equiv='refresh' content='0'>";
                    } 
                    else {
                            echo "Failure!";
                            unset($_POST); 
                        }
            }
        ?>
        </div>
    </div>
     <div class = "row ">
        <div class = "col-md-6 specialDiv">
            <h1>Update task.</h1>
          <form   method="post">
                <label><b>Enter new task title:</b></label>
                <input type="text" placeholder="Enter task title" name="taskEditField"><br>
                   <label><b>Select task to edit:</b></label>
                <select name="taskToEdit">
                    <?php 
                    $query=mysqli_query($conn, "SELECT name FROM Uzduotys");
                    while($row=mysqli_fetch_assoc($query))
                    {
                        $name = $row['name'];
                    echo "<option value=\"$name\">" . $row['name'] . "</option>";
                    }
                    ?>
                </select><br>
              <input type="submit" value="Edit" name="submitTaskToEdit" />
            </form>
            <?php
            if(isset($_POST["submitTaskToEdit"])){
                if(isset($_POST["taskEditField"])){
                    $task = $_POST["taskEditField"];
                    $taskEditField = $_POST["taskToEdit"];
                    $sql = "UPDATE Uzduotys SET name = '$task' WHERE name = '$taskEditField'"; 
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "Task Successfully edited";
                        unset($_POST);   
                      
                        echo "<meta http-equiv='refresh' content='0'>";
                    }   
                    else {
                            echo "Failure!";
                            unset($_POST); 
                        }
                    }
                 else{
                    echo "missing task name!";
                    unset($_POST); 
                }  
            }
            ?>
         </div>
           <div class = "col-md-6 specialDiv">
            <h1>Delete task.</h1>
          <form   method="post">
                   <label><b>Select task to delete:</b></label>
                <select name="taskToDelete">
                    <?php 
                    $query=mysqli_query($conn, "SELECT name FROM Uzduotys");
                    while($row=mysqli_fetch_assoc($query))
                    {
                        $name = $row['name'];
                    echo "<option value=\"$name\">" . $row['name'] . "</option>";
                    }
                    ?>
                </select><br>  
              <input type="submit" value="Delete" name="submitTaskToDelete" />
            </form>
            <?php
            if(isset($_POST["submitTaskToDelete"])){
                if(isset($_POST["taskToDelete"])){
                    $task = $_POST["taskToDelete"];
                    $sql = "DELETE FROM Uzduotys WHERE name ='$task';"; 
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "Task Successfully deleted";
                        unset($_POST);    
                      
                        echo "<meta http-equiv='refresh' content='0'>";
                    }   
                    else {
                            echo "Failure!";
                            unset($_POST); 
                        }
                    }
                 else{
                    echo "missing task to delete name!";
                    unset($_POST); 
                }  
            }
            ?>
         </div>
    </div>
    <br><br><br>
    <center><form action="/index.php">
    <input type="submit" value="Go to main page" />
</form></center>
</div>
</body>
</html>