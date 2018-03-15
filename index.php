<?php
$errors = array();
if(isset($_POST['submit'])) {

    $Option = $_POST['option'];
    $Roll  =$_POST['roll'];

    $length = strlen($Roll);

    if ($length < 8 || $length >8) {
        array_push($errors, "Invalid Roll Number(Roll Must be 8 Digit) \n");
    }
    if ($length == 8 && ($Roll[4] != '5' || $Roll[5] != '4')) {
        array_push($errors, "Your department must have to be CSE(Roll Mismatch Error) \n");
    }

    include "server_connect.php";


    $sql1 = "SELECT * FROM time_tb WHERE id=1 ";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $StartDate = $row1['StartDate'];
    $EndDate =  $row1['EndDate'];
    $today = date("Y-m-d");

    //echo $StartDate;

    if(($StartDate > $today)  || ($EndDate < $today)) {
        array_push($errors, "Date is expired to cast votes");
        array_push($errors, "Start Date- $StartDate & End Date- $EndDate");
    }



    $StartTime = $row1['StartTime'];
    $EndTime = $row1['EndTime'];

    $time  = date("H:i:s");
    $timestamp = strtotime($time) + 5*60*60;
    $today_time = date('H:i:s', $timestamp);

//    echo $StartTime;
//    echo $EndTime;
//    echo $today_time;

    if(($StartTime > $today_time)  || ($EndTime < $today_time)) {
        array_push($errors, "Time is expired to cast votes");
        array_push($errors, "Start Time- $StartTime & End Time- $EndTime");
    }

    if(count($errors) == 0) {


        $sql2 = "SELECT * FROM check_tb WHERE Checked='$Roll' ";
        $result = $conn->query($sql2);
        if($result->num_rows > 0){
            //echo '<p style="color: green;font-weight: bold;">Warning! Your vote has been received already.</p>';
            array_push($errors, "Warning! Your vote has been received already.");
        }
        else {

            $sql = "INSERT INTO check_tb (Checked) VALUES('$Roll')";
            $conn->query($sql);

            $sql = "SELECT * FROM option_tb WHERE id = '$Option'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            $vote = $row['Votes'];
            $vote ++;

            $sql = "UPDATE option_tb SET Votes = '$vote' WHERE id= '$Option'";
            $conn->query($sql);


            //echo '<p style="color: green;font-weight: bold;">You vote is received successfully.</p>';
            array_push($errors,"You vote is received successfully.");
            include "server_disconnect.php";
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--    Datatable CDN-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<!--Nav Bar-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Online CR Election</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Admin Login</a></li>
    </div>
</nav>

<br>
<br>
<div id="createPool" class="container">
    <div class="col-sm-8 col-sm-offset-2 jumbotron">
       <h2>Choose Your Candidate </h2>
        <br>
        <?php include "errors.php"?>

        <form class="form-horizontal" action="index.php" method="post">

            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Roll</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pwd" placeholder="Enter Your Roll" name="roll" required>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="sel1">Options</label>
                <div class="col-sm-10">
                    <select class="form-control" id="sel1" name="option">

                        <?php
                            include "server_connect.php";
                            $sql ="SELECT * FROM option_tb";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                               echo '<option value="'.$row['id'].'">'.$row['Option'].'</option>';

                            }
                            include "server_disconnect.php";
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                </div>
            </div>
        </form>

    </div>

</div>



</body>


</html>