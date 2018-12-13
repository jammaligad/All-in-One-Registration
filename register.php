<?php
    session_start();
    echo $_SESSION["event"];
    echo $_SESSION["eventcode"];
    if (isset($_POST["barcode"]) && !empty($_POST["barcode"])){
        $conn = mysqli_connect("localhost", "root", "usbw", "events");
        if($conn-> connect_error) {
            die("Connection failed:". $conn-> connect_error);
        }
        else{
            $eventcode = $_POST["eventcode"];
            $barcode = $_POST["barcode"];
            $api_key = "https://winrest01.addu.edu.ph/eventAttendance/InquiryAPI/personQuery?eventcode=".$eventcode."&barCode=".$barcode;
            $response = file_get_contents($api_key);
            $newresponse = json_decode($response, true);

            // JSON DATA
            $scode = $newresponse['data']['Code'];
            $firstName = $newresponse['data']['FirstName'];
            $lastName = $newresponse['data']['LastName'];
            $course = $newresponse['data']['ProgrammeOrDept'];
            $section = $newresponse['data']['Section'];

            $register_student = mysqli_query($conn, 
            "INSERT INTO {$_SESSION["event"]}(stud_id, firstname, lastname, course, section, time_in) VALUES("
            .$scode.", '".$firstName."', '".$lastName."', '".$course."', '".$section."', now())");
        }
?>