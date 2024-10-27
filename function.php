<?php
//Create Database Conection-------------------
function dbConn() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "ceymedpms";

    $conn = new mysqli($server, $username, $password, $db);

    if ($conn->connect_error) {
        die("Database Error : " . $conn->connect_error);
    } else {
        return $conn;
    }
}

//End Database Conection-----------------------
//Data Clean------------------------------------------
function dataClean($data = null) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

//End Data Clean

function validateNIC($nic) {
    // Determine the length of the NIC
    $length = strlen($nic);

    // Check for old NIC format
    if ($length == 10) {
        $firstPart = substr($nic, 0, 9);
        $lastChar = substr($nic, -1);

        // Check if the first part is numeric and the last character is 'V' or 'X'
        if (ctype_digit($firstPart) && ($lastChar == 'V' || $lastChar == 'X')) {
            return "Valid old NIC format.";
        } else {
            return "Invalid NIC format.";
        }
    }
    // Check for new NIC format
    elseif ($length == 12) {
        // Check if all characters are numeric
        if (ctype_digit($nic)) {
            return "Valid new NIC format.";
        } else {
            return "Invalid NIC format.";
        }
    } else {
        return "Invalid NIC format.";
    }
}

function validateMobileNumber($mobile) {
    // Remove leading and trailing whitespace
    $mobile = trim($mobile);

    // Check if the number starts with +94 followed by 9 digits
    if (substr($mobile, 0, 3) === '+94' && strlen($mobile) === 12 && ctype_digit(substr($mobile, 3))) {
        return "Valid mobile number.";
    } else {
        return "Invalid mobile number.";
    }
}
