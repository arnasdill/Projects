<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <title>User panel</title>
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
             <h1> Set that task is done.</h1>  
        <form action = "" method = "post">
        <label><b>Select task you would like to match as finished:</b></label>
        <select name="setFinished">
            <?php 
            $query=mysqli_query($conn, "SELECT name FROM Uzduotys WHERE user = '$user'");
            while($row=mysqli_fetch_assoc($query))
            {
            $name = $row['name'];
            echo "<option value=\"$name\">" . $row['name'] . "</option>";
            }
            ?>
        </select><br>
        <br>
        <input type="submit" value="Set" name="submitForFinishing" />  
        </form>
         <?php
            if(isset($_POST['setFinished']) && isset($_POST['submitForFinishing'])){
                $taskName = $_POST['setFinished'];
                $sql = "UPDATE Uzduotys SET progress = 'DONE' WHERE name = '$taskName' AND user = '$user' "; 
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "Task sucessfully updated!";
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
          <div class = "col-md-6 specialDiv">
             <h1> Show my tasks.</h1>  
        <form action = "" method = "post">
        <label><b>Select what you would like to see:</b></label>
        <select name="tasks">
            <option value="Show all">Show all</option>
            <option value="Show in progress">Show in progress</option>
            <option value="Show done">Show done</option>
            ?>
        </select><br>
        <br>
        <input type="submit" value="Show" name="submitForShowing" />  
        </form>
            <table cellspacing="10">
            <tr>
                <th>TASK NAME</th>
                <th>TASK STATUS</th> 

             </tr>
        <?php
            if(isset($_POST['tasks']) && isset($_POST['submitForShowing'])){
                $choosen = $_POST['tasks'];
                switch ($choosen) {
                    case "Show all":
                    $taskName = $_POST['setFinished'];
                    $query=mysqli_query($conn, "SELECT name,progress FROM Uzduotys WHERE user = '$user'");
                    while($row=mysqli_fetch_assoc($query))
                    {
                        $name = $row['name'];
                        $status = $row['progress'];
                    echo "<tr><td>".$name."</td><td> ".$status."</td></tr>";
                    }
                        break;
                    case "Show in progress":
                    $taskName = $_POST['setFinished'];
                    $query=mysqli_query($conn, "SELECT name,progress FROM Uzduotys WHERE user = '$user' AND progress = 'IN PROGRESS'");
                    while($row=mysqli_fetch_assoc($query))
                    {
                        $name = $row['name'];
                        $status = $row['progress'];
                    echo "<tr><td>".$name."</td><td> ".$status."</td></tr>";
                    }
                        break;
                  case "Show done":
                    $taskName = $_POST['setFinished'];
                    $query=mysqli_query($conn, "SELECT name,progress FROM Uzduotys WHERE user = '$user' AND progress = 'DONE'");
                    
                    while($row=mysqli_fetch_assoc($query))
                    {
                        $name = $row['name'];
                        $status = $row['progress'];
                    echo "<tr><td>".$name."</td><td> ".$status."</td></tr>";
                    }
                        break;
                }        
            }        
        ?>   
              </table> 
            </div>
        </div>
    
    </div>
</body>
</html>