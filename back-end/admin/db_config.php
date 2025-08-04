<?php

    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'kaoud_hotel';

    $conn = mysqli_connect($hname,$uname,$pass,$db);
    if (!$conn) {
        die("Can not connect to database".mysqli_connect_error());
    }


?>