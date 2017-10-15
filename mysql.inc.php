<?php
  $servername = "your_server_name";
  $database = "your_database_name";
  $username = "your_username_here";
  $password = "your_password_here";

  // Create connection

  $conn = mysqli_connect($servername, $username, $password, $database);

  // Check connection

  if (!$conn) {

      die("Connection failed: " . mysqli_connect_error());

  }

?>
