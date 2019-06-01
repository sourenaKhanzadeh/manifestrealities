<!DOCTYPE html>
<html>
<head>
  <title>Accounts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="Images/Logo.png">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include 'base.php'; ?>
    <div class="alert alert-danger" style="text-align:center;display:none;"id="failure">
      <strong>Failed</strong>, Password and Confirmation Password Do Not Match.
    </div>
    <div class="alert alert-success" style="text-align:center;display:none;"id="success">
      <strong>success</strong>, Changes Saved.
    </div>
    <form method="POST" class="myform">
      <div class="AccountProfile">
        <div class="AccountProfilePic">

        </div>
        <label for="chat-txt">Bio</label>
        <textarea class="autoExpand AccountBio" id="msg-txt" name="chat-txt" rows="4" placeholder="Place Text Here..."></textarea>

      </div>
      <label for="first">First Name</label>
      <input type="text" name="first" value="<?php echo $_SESSION['first'];?>" required>
      <label for="last">Last Name</label>
      <input type="text" name="last" value="<?php echo $_SESSION['last'];?>"required>
      <label for="email">Email Address</label>
      <input type="text" name="email" value="<?php echo $_SESSION['email'];?>"required>
      <label for="username">Username</label>
      <input type="text" name="username" value="<?php echo $_SESSION['username'];?>"required><br>
      <label for="user-password">Password</label>
      <input type="password" name="user-password" value="<?php echo $_SESSION['password'];?>"required><br>
      <label for="confirm">Confirm Password</label>
      <input type="password" name="confirm" value=""required>
      <input type="submit" name="user-submit" value="Save Changes">
    </form>
    <?php
    // Get Data
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $first = $_POST['first'];
      $last = $_POST['last'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['user-password'];
      $confirm = $_POST['confirm'];

      $user = $_SESSION['username'];
      $pass = $_SESSION['id'];
      // query
      $sql = "UPDATE `allusers` SET `Email` = '$email', `First Name` = '$first', `Last Name` = '$last', `username` = '$username', `PASSWORD` = '$password'  WHERE `allusers`.`ID` = '$pass' ;";
      $bio = "INSERT INTO `allusers` (`ID`, `First Name`, `Last Name`, `Email`, `username`, `PASSWORD`, `Bio`) VALUES ('heloo kitty');";
      //inject code
      if($password == $confirm){
        mysqli_query($conn, $sql);
        echo "<script>document.getElementById('success').style.display='block';</script>";
      }else{
        echo "<script>document.getElementById('failure').style.display='block';</script>";
      }

    }
    ?>
</body>

<footer>
  &copy ManifestRealities
</footer>
</html>
