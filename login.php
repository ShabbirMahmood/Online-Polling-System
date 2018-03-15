<?php
$errors = array();
session_start();
include 'server_connect.php';
// If Login button is pressed
if(isset($_POST['login'])) {
    $Email= $_POST["Email"];
    $Password = $_POST["Password"];

    if(empty($Email)) {
        array_push($errors, "Email address is required");
    }
    if(empty($Password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        // $password = md5($password);
        $query = "SELECT * FROM admin_tb WHERE Email='$Email' AND Password='$Password'";
        //$results = mysqli_query($db, $query);   // Retrive data from database
        $result = $conn->query($query);
        $flag = mysqli_num_rows($result);


        if ( $flag == 1) { // If the query selects only one row then log in
            header('location: admin.php');
            $_SESSION['Email'] = $Email;
        }else {
            array_push($errors, "Wrong Email or Password");
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<!--Nav Bar-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Online Registration</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Admin</a></li>
        </ul>
    </div>
</nav>
<br>
<br>
<!--Form-->
<div class="container col-sm-8 col-sm-offset-2 jumbotron">
    <h1>Admin Login Form</h1>
    <br>
    <form method = "post" action="login.php">
        <div class="form-group">
            <?php include('errors.php') ?>
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="Email" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="Password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary"  name="login" >Log In</button>
    </form>
</div>


</body>
</html>
