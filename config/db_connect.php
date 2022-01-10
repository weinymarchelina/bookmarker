<?php 

    // Connect to the database by using MySQLi
    $conn = mysqli_connect('localhost', process.env.admin, process.env.pass, 'bookmarker');

    // check connection
    if(!$conn) {
        echo 'Connection error:' . mysqli_connect_error();
    }


?>