<?php
$errors = array();
if(isset($_POST['submit'])) {

    $StartDate= $_POST['StartDate'];
    $EndDate= $_POST['EndDate'];
    $StartTime= $_POST['StartTime'];
    $EndTime= $_POST['EndTime'];

    $Option1 = $_POST['Option_1'];
    $Option2 = $_POST['Option_2'];
    $Option3 = $_POST['Option_3'];
    $Option4 = $_POST['Option_4'];
    $Option5 = $_POST['Option_5'];
    $Option6 = $_POST['Option_6'];

    include 'server_connect.php';

    if ($StartDate != "" && $StartTime != "" && $EndDate !="" && $EndTime != "" )
    {
        $sql = "DELETE  FROM time_tb WHERE id = 1";
        if($conn->query($sql) == TRUE)
        {
            $sql = "INSERT INTO time_tb(id,StartDate,StartTime,EndDate,EndTime) VALUES(1,'$StartDate','$StartTime','$EndDate','$EndTime')";
            if($conn->query($sql) == TRUE)
            {

                $sql = "DELETE  FROM option_tb WHERE id > 0";
                $conn->query($sql);

                $sql = "DELETE  FROM check_tb WHERE id > 0";
                $conn->query($sql);

                echo $conn->error;

                if ($Option1 !=  "" )
                {
                    $sql = "INSERT INTO option_tb(Option,Votes) VALUES('$Option1',0)";
                    $conn->query($sql);

                    echo $conn->error;
                }

                if ($Option2 !=  "" )
                {
                    $sql = "INSERT INTO option_tb(Option,Votes) VALUES('$Option2',0)";
                    $conn->query($sql);
                }

                if ($Option3 !=  "" )
                {
                    $sql = "INSERT INTO option_tb(Option,Votes) VALUES('$Option3',0)";
                    $conn->query($sql);
                }

                if ($Option4 !=  "" )
                {
                    $sql = "INSERT INTO option_tb(Option,Votes) VALUES('$Option4',0)";
                    $conn->query($sql);
                }

                if ($Option5 !=  "" )
                {
                    $sql = "INSERT INTO option_tb(Option,Votes) VALUES('$Option5',0)";
                    $conn->query($sql);
                }

                if ($Option6 !=  "" )
                {
                    $sql = "INSERT INTO option_tb(Option,Votes) VALUES('$Option6',0)";
                    $conn->query($sql);
                }

                //echo '<p style="color: #9F6000;font-weight: bold;">New Vote Created</p>';
                array_push($errors, "New Vote Session is Created \n");

            }
            else{
                echo $conn->error;
                echo '<p style="color: #9F6000;font-weight: bold;">Some thing Wrong 2.</p>';
            }
        }else{
            echo '<p style="color: #9F6000;font-weight: bold;">Some thing Wrong.</p>';
        }
    }
    include 'server_disconnect.php';
}

//    Log Out
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Email']);
    header("location: index.php");
}
include 'server_connect.php';

//$query = "SELECT * FROM option_tb";
//$result = mysqli_query($db, $query);

$query1 = "SELECT * FROM option_tb";
$result = $conn->query($query1);


$query2 = 'SELECT SUM(Votes) FROM option_tb';
$sum = $conn->query($query2);
$row = mysqli_fetch_row($sum);
$sum = $row[0];

    //include 'authentication.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
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
                <li><a href="admin.php?logout='1'"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
        </div>
    </nav>

    <div id="result" class="container ">
        <div class="col-sm-8 col-sm-offset-2 jumbotron">
            <h2 id="h2">Votting Result</h2>

            <hr />
            <div class="well">
                <table id="data_tb" class="display" cellspacing="0" width="100%">
                    <thead>
                    <!-- Header Row -->
                        <tr>
                            <th>Candidate</th>
                            <th>Votes(%)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while( $rows = mysqli_fetch_array($result))   // mysqli *** Spelling is important
                    {
                        ?>
                        <tr>
                            <td><?php echo $rows['Option']; ?></td>
                            <td><?php
                                if ($sum != 0)
                                {
                                    echo ($rows['Votes']/$sum)*100;
                                }else {
                                    echo $rows['Votes'];
                                }


                            ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="createPool" class="container">
        <div class="col-sm-8 col-sm-offset-2 jumbotron">

            <h2>Setting Vote Event</h2>
            <br>
            <?php include "errors.php"?>
            <form class="form-horizontal" action="admin.php" method="post">

                <div class="form-group">
                    <label class="control-label col-sm-2">Start Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="StartDate" placeholder="Start Date" name="StartDate" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">StartTime</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="StartTime" placeholder="Start Time" name="StartTime" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2">End Time</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="EndDate" placeholder="Enter End Date" name="EndDate" required>
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-sm-2">End Time</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="EndTime" placeholder="Enter End Time" name="EndTime" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Option-1:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Option 1" name="Option_1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Option-2:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Option 2" name="Option_2" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Option-3:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Option 3" name="Option_3">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Option-4:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Option 4" name="Option_4">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Option-5:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Option 5" name="Option_5">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Option-6:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Option 6" name="Option_6">
                    </div>
                </div>
                <br>

                <div class="form-group col-sm-12 text-center">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
    <script>
        $(document).ready(function() {
            $('#data_tb').DataTable();
        } );
    </script>

</html>