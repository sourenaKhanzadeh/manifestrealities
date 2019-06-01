<!DOCTYPE html>
<html>
<head>
  <title>Freinds</title>
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
    <div class="memberL">
      <?php
      if (isset($_SESSION['username'])) {
        $userID = $_SESSION['username'];
      }else{
        echo "<script> window.location.href ='signup'</script>";
      }
        $sql_members = "SELECT * FROM allusers;";

        $result = $conn->query($sql_members);
        if($result->num_rows >0){
            while ($row =$result->fetch_assoc()) {
              $button = 'Add Friend  <i class="fas fa-plus"></i>';
              echo '
              <div class=profilePic>
                <div class=user>
                  <h5>'.$row['username'].'</h5>
                </div>
              </div>';

              echo  '<button class=add onclick="this.innerHTML = ';
              echo "pending('".$row['username']."','".$row['ID']."');";
              echo '">'.$button.'</button>
                <br>
                <hr>';
              echo "<p id='".$row['username']."'></p>";
              if (isset($_POST['member'])) {
                $mem = stripcslashes($_POST['member']);
                $mem = mysqli_real_escape_string($conn,$mem);
                $memID = stripcslashes($_POST['memId']);
                $memID = mysqli_real_escape_string($conn,$memID);
                $userID = stripcslashes($_SESSION['id']);
                $userID = mysqli_real_escape_string($conn,$userID);
                $username = stripcslashes($_SESSION['username']);
                $username = mysqli_real_escape_string($conn,$username);

                $query = "INSERT INTO `freinds` (`request_by`,`request_to`)VALUES ('$username', '$mem');";
                // inject
                mysqli_query($conn, $query);

              }
            }
          }
       ?>

    </div>
</body>

<footer>
  &copy Manifest Realities
</footer>
</html>
