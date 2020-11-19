<?php
    $con = mysqli_connect("localhost", "root", "", "login");
    if($con) {
        // echo "Connection established";
    }

    function validate($input) {
        $input = htmlspecialchars($input);
        $input = stripslashes($input);
        $input = trim($input);

        return $input;
    }

?>