<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manifest Realities</title>
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
    <div class="model" style="display:block;">
      <form action="InsertDB.php" method="POST" class="GlobalForm">
        <div class="container">
          <div class="avatar">
            <img src="Images/GirlPsy.png" alt="Avatar" class="avatar">
          </div>
          <label for="first_name">First Name</label>
          <input type="text" name="first_name" value="" placeholder="Enter First Name" required>
          <label for="last_name">Last Name</label>
          <input type="text" name="last_name" value="" placeholder="Enter Last Name" required>
          <label for="email">Email</label>
          <input type="email" name="email" value="" placeholder="Enter Email" style="width:100%;" required>
          <label for="username">Username</label>
          <input type="text" name="username" value="" placeholder="Enter User Name." required>
          <label for="user_pass">Password</label>
          <input type="password" name="user_pass" value="" placeholder="Enter Password" required>
          <label for="conf_user_pass">Confirm Password</label>
          <input type="password" name="conf_user_pass" value="" placeholder="Confirm Password" required>
          <input type="submit" name="user-submit" value="submit" style="margin-bottom:10px;"><br>
          <button type="button" name="cancel" class="cancel" onclick="homePage()" style="width:100%;margin-bottom:20px;padding-top: 10px;
          padding-bottom: 10px;">cancel</button>
          <script type="text/javascript">
          function homePage(){
            window.location.assign("homepage");
          }
          </script>
          <?php
          if(isset($_COOKIE['confirm'])){

            echo "<div class='alert alert-danger'><strong>failure,</strong> Either The Password don't Match Or You Are Missing A Field</div>";
          }
          ?>
        </div>

      </form>



    </div>
</body>

<footer>
  &copy ManifestRealities
</footer>
</html>
