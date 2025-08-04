<?php

    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'kaoud_hotel';

    $conn = mysqli_connect($hname,$uname,$pass,$db);
    if (!$conn) {
        die("Can not connect to database".mysqli_connect_error());
    }


    function filteration($data) {
        foreach( $data as $key => $value ) {
            $data[$key] = trim($value);
            $data[$key] = stripslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
        }
        return $data;
    }

    function select($sql,$values,$datatypes) {
        $conn = $GLOBALS['conn'];

        if($stmt = mysqli_prepare($conn,$sql)) {
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else {
                die("Query cannot be executed - select");
            }
        }
        else {
            die("Query cannot be prepared - select");
        }
    }
?>