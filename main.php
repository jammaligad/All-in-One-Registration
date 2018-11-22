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
                <a class="navbar-brand" href="#">A-I-O</a>
            </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Event <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Event 1</a></li>
                        <li><a href="#">Event 2</a></li>
                        <li><a href="#">Event 3</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create New</a></li>
                    </ul>
                    </li>
                </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            <div class="page-header">
                <h1>Event 1 <small>Description</small></h1>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="jumbotron">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">#</span>
                            <input type="text" class="form-control" placeholder="ID NUMBER" aria-describedby="basic-addon1" autofocus>
                        </div>
                        <table class="table" id="reg_table1" name="reg_table1">
                            <?php
                                $conn = mysqli_connect("localhost", "root", "usbw", "itweek");
                                if($conn-> connect_error) {
                                    die("Connection failed:". $conn-> connect_error);
                                }

                                $sql = "SELECT stud_id, firstname, lastname from thursday1_am WHERE id = (SELECT MAX(id) FROM thursday1_am)";
                                $result = $conn-> query($sql);

                                $row = $result-> fetch_assoc();
                                        echo "<h2>". $row["stud_id"] ."</h2>";
                                        echo "<h5>". $row["lastname"] . ", " . $row["firstname"] . "</h5>";
                            ?>
                        </table>
                        <hr>
                        <div class="container-fluid">
                            <table class="table" id="reg_table2" name="reg_table2">
                            <div class="row">
                                <?php
                                    $conn = mysqli_connect("localhost", "root", "usbw", "itweek");
                                    if($conn-> connect_error) {
                                        die("Connection failed:". $conn-> connect_error);
                                    }

                                    $sql = "SELECT course, section from thursday1_am WHERE id = (SELECT MAX(id) FROM thursday1_am)";
                                    $result = $conn-> query($sql);

                                    $row = $result-> fetch_assoc();
                                            echo "<div class='col-lg-6'>". $row["course"] ."</div>";
                                            echo "<div class='col-lg-6'>". $row["section"] ."</div>";
                                ?>
                            </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="jumbotron">
                        <h2>REGISTRATION</h2>
                        <table class="table" id="reg_table" name="reg_table">
                            <?php
                                $conn = mysqli_connect("localhost", "root", "usbw", "itweek");
                                if($conn-> connect_error) {
                                    die("Connection failed:". $conn-> connect_error);
                                }

                                $sql = "SELECT stud_id, firstname, lastname, course, section, time_in from thursday1_am WHERE id != (SELECT MAX(id) FROM thursday1_am) ORDER BY id DESC LIMIT 0, 4";
                                $result = $conn-> query($sql);

                                if($result-> num_rows > 0) {
                                    while($row = $result-> fetch_assoc()) {
                                        echo "<tr><td>". $row["stud_id"] ."</td><td>". $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["course"] . "</td><td>" . $row["section"] . "</td><td>" . $row["time_in"] . "</td></tr>";
                                    }
                                }
                                else {
                                    echo "0 Result";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
