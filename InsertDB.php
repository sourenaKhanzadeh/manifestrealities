<?php
include 'database.php';

// Get Data
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['user_pass'];
$confirm = $_POST['conf_user_pass'];

setcookie('confirm', $confirm , time() + 1);

// Query
$sql = "INSERT INTO `allusers` (`First Name`, `Last Name`, `Email`, `username`, `PASSWORD`)VALUES ('$first', '$last', '$email', '$username', '$password');";

if ($confirm == $password && isset($first) && isset($last) && isset($email) && isset($username)) {

  //sessions
  if ($row["username"] == $username && $row["PASSWORD"] == $password && $row["First Name"] == $first && $row["Last Name"] == $last && $row["Email"] == $email) {
      $_SESSION['first'] = $row["First Name"];
      $_SESSION['last'] = $row["Last Name"];
      $_SESSION['email'] = $row["Email"];
      $_SESSION['username'] = $row["username"];
      $_SESSION['password'] = $row["PASSWORD"];
}

  // inject
  mysqli_query($conn, $sql);

  // go back to index page
  header("Location: index.php?signup=success");

}else{
  header("Location: SignUp.php?signup=failure");
}


?>
