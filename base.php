<?php
  define('database', TRUE);
  require('../database.php');

 ?>

 <link rel='stylesheet' href='styleA.css'>
 <link href="https://fonts.googleapis.com/css?family=Crimson+Text|Work+Sans:400,700" rel="stylesheet">

<!--Navigation -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark" id='myNav'>
  <a class="navbar-brand Manifest" href="homepage"><font color=#f7cf16>Manifest</font><font color=white>Realities</font></a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Brand -->

  <!-- Links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav">
    <!-- Accounts -->
    <li class="nav-item">
    <div class="nav-item" id="navbar" style="<?php if(isset($_SESSION['username'])){echo 'display:block;';}
    else{echo 'display:none;';}?>">
      <a class="nav-link" href="accounts"><i class='fas fa-cog'></i> Account</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="friends"><i class="fas fa-users"></i> Friends</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="chatroom"><i class="fas fa-comments"></i> Chat Room</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="aboutus"><i class="fas fa-book"></i> About Us</a>
    </li>
  </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">

        <!-- Sign IN/OUT-->
        <button class="signIn" style="<?php if(isset($_SESSION['username'])){echo 'display:none;';}
        else{echo 'display:block;';}?>"onclick="display1();"id="sign"><i class="fas fa-user"></i> Sign In/Out</button>

        <!-- Welcome User-->
          <button class="signIn" style="<?php if(isset($_SESSION['username'])){echo 'display:block;';}
          else{echo 'display:none;';}?>" id="Welcome" onclick="display2();">
          <i class="fas fa-user"></i> <?php if(isset($_SESSION['username'])){echo  "Welcome,".$_SESSION['username'];}?></button>

          <script type="text/javascript">
              function display1(){
                document.getElementById('id01').style.display='block';
              }

              function display2(){
                document.getElementById('id02').style.display='block';
              }
          </script>
      </li>
    </ul>
  </div>
    <!-- Dropdown
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Dropdown link
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Link 1</a>
        <a class="dropdown-item" href="#">Link 2</a>
        <a class="dropdown-item" href="#">Link 3</a>
      </div>

    </li>-->
  </div>
</nav>
<!-- Form Sign In-->



<br>
<div class="model" id="id01">

  <form class="GlobalForm" method="post">
    <div class="container">
      <div class="avatar">
        <img src="Images/GirlPsy.png" alt="Avatar" class="avatar">
      </div>
      <label for="user"> <b>Username</b> </label>
      <input type="text" name="user" value="" placeholder="Enter Your User Name Here" required><br>
      <label for="user-password"><b>Password</b></label>
      <input type="password" name="userPassword" value="" placeholder="Enter your password here" required><br>
      <input type="submit" name="user-submit" value="Login"><br>
      <a class="signup" href="signup"  style="color:white;">
      <div>Create Account</div></a><br>
      <input type="checkbox" name="user-remember" value="">  Remember Me<br>
      <div class="last">
      <button class="cancel" type="button" onclick="document.getElementById('id01').style.display = 'none';">Cancel</button> <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
    </div>


  </form>


</div>
<div class="model" id="id02">
  <form class="GlobalForm" method="GET">
    <div class="container">
      <input class="log" type="submit" name="log" value="LogOut">
      <button style="width:100%;margin-bottom:10px;padding-top: 10px;
      padding-bottom: 10px;"onclick="document.getElementById('id02').style.display = 'none';" type="button" name="cancel" class="cancel"> Cancel</button>
    </div>
  </form>
</div>

<div class="MsgBox" id="msgB" style="<?php
if (isset($_SESSION['username']))echo "display:block;";
else{echo "display:none;";}
?>">
  <div class="flash">
    <i class="fas fa-angle-double-left"></i><br>
    <i class="far fa-comments"></i>
  </div>
  <h2><?php echo $_SESSION['username']; ?></h2>
  <hr>
  <!-- User Profile Picture Goes Here....-->
  <div class="profilePic"></div>
  <hr>
  <h2>My Friends</h2>
  <hr>
  <?php
      $userID = $_SESSION['username'];
      if (isset($_POST['accept'])) {
        if ($_POST['accept']=='1') {
          $query = "UPDATE `freinds` SET `pending` = '1' WHERE request_to = '$userID';";
          mysqli_query($conn,$query);
        }
      }
      // TODO: MAKE THIS MORE EFFICIENT
      $sql_members = "SELECT DISTINCT(`request_to`),request_by,pending FROM freinds where `request_by` = '$userID' AND `pending`='0'";
      $sql_members2 = "SELECT DISTINCT(`request_to`),request_by,pending FROM freinds where `request_to` = '$userID' AND `pending`='0'";
      $freinds = "SELECT  DISTINCT(`request_to`),request_by,pending FROM freinds where `request_to` = '$userID' AND `pending`='1'";
      $freinds2 = "SELECT  DISTINCT(`request_to`),request_by,pending FROM freinds where `request_by` = '$userID' AND `pending`='1'";

      $result = $conn->query($sql_members);
      $result2 = $conn->query($sql_members2);
      $result3 = $conn->query($freinds);
      $result4 = $conn->query($freinds2);

      if($result->num_rows >0){
          while ($row =$result->fetch_assoc()) {
            $button = 'Add Friend  <i class="fas fa-plus"></i>';
            if ($row['request_by'] == $userID && $row['pending']=='0') {
              echo '
              <div class=profilePicPending>
                <div class=user>
                  <h5>'.$row['request_to'].'</h5>
                </div>
              </div>
              <div class=pending>pending <i class="fas fa-clock" style="color:#f7cf16"></i></div>
                <br>
                <br>
                <hr>';
            }
          }
      }
      if ($result2->num_rows >0) {
        while ($row =$result2->fetch_assoc()) {
          if ($row['request_to'] == $userID && $row['pending']==0) {
              echo '
                <div class=profilePicPending>
                  <div class=user>
                    <h5>'.$row['request_by'].'</h5>
                  </div>
                </div>
                <table>
                  <tr>
                    <td>
                      <button class=Box onclick="accept();">Accept <i class="fas fa-check-circle" style="color:#00f1a1"></i></button>
                    </td>
                    <td>
                      <button class=Box onclick="reject();">Reject <i class="fa fa-times-circle" style="color:#f14100"></i></button>
                    </td>
                  </tr>
                </table>
                <br>
                <br>
                <hr>';
            }
          }
        }
      if($result3->num_rows >0){
        while ($row =$result3->fetch_assoc()) {
          if ($row['request_to'] == $userID && $row['pending']=='1') {
              echo '
                <div class=profilePicPending>
                  <div class=user>
                    <h5>'.$row['request_by'].'</h5>
                  </div>
                </div>';
            }
          }
      }
      if($result4->num_rows >0){
        while ($row =$result4->fetch_assoc()) {
          if ($row['request_by'] == $userID && $row['pending']=='1') {
            echo '
            <div class=profilePicPending>
              <div class=user>
                <h5>'.$row['request_to'].'</h5>
              </div>
            </div>';
          }
        }
    }
   ?>

</div>
<script>
// Get the modal
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }else if (event.target == modal2) {
        modal2.style.display = "none";

    }
}

</script>
<script>
   function pending(x,y){
     post('freinds',{member: x,memId:y});
     return "pending <i class='fas fa-clock' style='color:#f7cf16'></i>";
   }
   function accept(){
     post('freinds',{accept:'1'});
   }
   function reject(){
     post('freinds',{accept:'0'});
   }
   function post(path, params, method) {
       method = method || "post"; // Set method to post by default if not specified.

       // The rest of this code assumes you are not using a library.
       // It can be made less wordy if you use one.
       var form = document.createElement("form");
       form.setAttribute("method", method);
       form.setAttribute("action", path);

       for(var key in params) {
           if(params.hasOwnProperty(key)) {
               var hiddenField = document.createElement("input");
               hiddenField.setAttribute("type", "hidden");
               hiddenField.setAttribute("name", key);
               hiddenField.setAttribute("value", params[key]);

               form.appendChild(hiddenField);
           }
       }

       document.body.appendChild(form);
       form.submit();
   }
</script>

<!-- Logging Out-->
<?php
    if(isset($_GET['log'])) {
    session_destroy();
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION['id']);
    unset($_SESSION['first']);
    unset($_SESSION['last']);
    unset($_SESSION['email']);
    echo "<script> window.location.href ='homepage'</script>";
    exit;
    }
?>
