<?php

$conn = new mysqli("localhost", "root", "123456789", "aaa");
//$conn = new mysqli("localhost", "hoskapho_rmah","oEy3WIk67Y","one_kph");  



/* check connection */

if ($conn->connect_errno) {

    printf("Connect failed: %s\n", $conn->connect_error);

    exit();
}

if (!$conn->set_charset("utf8")) {

    printf("Error loading character set utf8: %s\n", $conn->error);

    exit();
}
