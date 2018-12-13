<?php
    if (isset($_POST["eventName"]) && !empty($_POST["eventName"])){
        $conn = mysqli_connect("localhost", "root", "usbw", "events");
        if($conn-> connect_error) {
            die("Connection failed:". $conn-> connect_error);
        }
        else{
            $newEvent = $_POST["eventName"];
            $sql = "CREATE TABLE " . $newEvent . "(id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, stud_id VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, course VARCHAR(255) NOT NULL, section VARCHAR(255) NOT NULL, time_in DATETIME(6) NOT NULL);";
            mysqli_query($conn, $sql);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>