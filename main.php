<?php
    session_start();
    if(isset($_GET['event']) && isset($_GET['eventCode'])){
        $_SESSION['event'] = $_GET['event'];
        $_SESSION['eventCode'] = $_GET['eventCode'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>All-in-One Attendance</title>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/custom.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- <link href="css/style.css" rel="stylesheet"> -->
    </head>

    <body>
        <!-- MODALS -->
        <!-- CREATE NEW EVENT -->
        <div class="modal fade" id="eventModal" role="dialog">
            <div class="modal-dialog">
                <form action="newEvent.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create New Event</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="eventName">Event Name:</label>
                                <input type="text" class="form-control" id="eventName" name="eventName"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>

        <!-- SET EVENT CODE -->
        <div class="modal fade" id="eventcodeModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Set Event Code</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="eventName">Event Code:</label>
                            <input type="text" class="form-control" id="eventCode" name="eventCode"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Set</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTUAL BODY -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">All-in-One</a>
            </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#eventcodeModal">Event Code</a></li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Event <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                            $conn = mysqli_connect("localhost", "root", "usbw", "events");
                            if($conn-> connect_error) {
                                die("Connection failed:". $conn-> connect_error);
                            }
                            
                            $sql = "SHOW TABLES FROM events";
                            $result = mysqli_query($conn,$sql);
                            
                            while ($row = mysqli_fetch_row($result)) {
                                echo "<li><a href='main.php?event={$row[0]}\n'>" . "{$row[0]}\n" . "</a></li>";
                            }
                        ?>
                        <li role="separator" class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#eventModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create New</a></li>
                    </ul>
                    </li>
                </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            <div class="page-header">
                <h1><?php echo $_SESSION['event'] ?> <small><?php echo $_SESSION['eventCode'] ?></small></h1>
            </div>
            <div class="row">
            <form action="register.php" method="post">
                <div class="container-fluid">
                    <div class="jumbotron">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit"> Enter</button>
                            </span>
                            <input type="text" class="form-control" name="barcode" placeholder="ID NUMBER" aria-describedby="basic-addon1" autofocus>
                            </form>
                        </div>
                        <table class="table" id="reg_table1" name="reg_table1">
                            <?php
                                $conn = mysqli_connect("localhost", "root", "usbw", "events");
                                if($conn-> connect_error) {
                                    die("Connection failed:". $conn-> connect_error);
                                }

                                $sql = "SELECT stud_id, firstname, lastname from {$_SESSION["event"]} WHERE id = (SELECT MAX(id) FROM {$_SESSION["event"]})";
                                $result = $conn-> query($sql);
                                
                                $row = $result-> fetch_assoc();
                                if($row > 0){
                                    echo "<h2>". $row["stud_id"] ."</h2>";
                                    echo "<h5>". $row["lastname"] . ", " . $row["firstname"] . "</h5>";
                                }
                                else{
                                    echo "<h2> Empty student record. </h2>";
                                }
                            ?>
                        </table>
                        <hr>
                        <div class="container-fluid">
                            <table class="table" id="reg_table2" name="reg_table2">
                            <div class="row">
                                <?php
                                    $conn = mysqli_connect("localhost", "root", "usbw", "events");
                                    if($conn-> connect_error) {
                                        die("Connection failed:". $conn-> connect_error);
                                    }

                                    $sql = "SELECT course, section from {$_SESSION["event"]} WHERE id = (SELECT MAX(id) FROM {$_SESSION["event"]})";
                                    $result = $conn-> query($sql);

                                    $row = $result-> fetch_assoc();
                                    if($row > 0){
                                        echo "<div class='col-lg-6'>". $row["course"] ."</div>";
                                        echo "<div class='col-lg-6'>". $row["section"] ."</div>";
                                    }
                                    else{
                                        echo "Empty student details.";
                                    }      
                                ?>
                            </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading"><center><b>Registration</b></center></div>
                        <div style="overflow-y: scroll; max-height: 300px">
                        <table class="table" id="reg_table" name="reg_table" >
                            <?php
                                $conn = mysqli_connect("localhost", "root", "usbw", "events");
                                if($conn-> connect_error) {
                                    die("Connection failed:". $conn-> connect_error);
                                }

                                $sql = "SELECT stud_id, firstname, lastname, course, section, time_in from {$_SESSION["event"]} WHERE id != (SELECT MAX(id) FROM {$_SESSION["event"]}) ORDER BY id DESC"; //LIMIT 0, 8
                                $result = $conn-> query($sql);

                                if($result-> num_rows > 0) {
                                    while($row = $result-> fetch_assoc()) {
                                        echo "<tr><td>". $row["stud_id"] ."</td><td>". $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["course"] . "</td><td>" . $row["section"] . "</td><td>" . $row["time_in"] . "</td></tr>";
                                    }
                                }
                                else {
                                    echo "<center><h2>Empty Student Records.</h2></center>";
                                }
                            ?>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
