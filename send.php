<?php
session_start();
// My Database
$dbServerName = "localhost:3306";
$dbUser = "root";
$dbPassword = "So3859123456";
$dbName = "aj";

// Connection To MySql
$conn = mysqli_connect($dbServerName, $dbUser, $dbPassword, $dbName);

  if (isset($_POST['chat-txt']) && isset($_SESSION["id"])) {
    $chat = stripcslashes($_POST['chat-txt']);
    $chat = mysqli_real_escape_string($conn, $chat);
    $q = "INSERT INTO chatroom (ID, msg) VALUES ($_SESSION[id],'$chat')";
    $q = mysqli_query($conn, $q);

  }
  header("Location: chatroom");
?>
