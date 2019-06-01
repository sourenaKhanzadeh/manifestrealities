<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chat Room</title>
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
    <script>
    <?php
    if(!isset($_SESSION['id'])){
        echo "document.getElementById('id01').style.display='block'";

    }
     ?>
    </script>

</body>
<div class="chatBox">
  <form method="POST" id="chat-form" action="send.php">
    <div id="msg-box" name="chat-msg" rows="10">
        <?php
        $sql_chat = "SELECT * FROM chatroom";
        $result = $conn->query($sql_chat);
        $index = 0;
        if($result->num_rows >0){
            while ($row =$result->fetch_assoc()) {
              $index += 1;
              $sql_users = "SELECT username FROM allusers WHERE ID = ".$row['ID'];
              $result_user = $conn->query($sql_users);
              if ($index % 2 == 0) {
                echo '<div class="chat-left">
                <h5>'.$result_user->fetch_assoc()['username'].'</h5>
                <p>'.$row['msg'].'</p>
                <h6>'.$row['time'].'</h6>
                </div>';
                }else{
                echo '
                <div class="chat-left chat-red">
                <h5>'.$result_user->fetch_assoc()['username'].'</h5>
                <p>'.$row['msg'].'</p>
                <h6>'.$row['time'].'</h6>
                </div>';

              }
              echo '<br>';

          }
        }
         ?>
      </div>
    <textarea class="autoExpand" id="msg-txt" name="chat-txt" rows="1" placeholder="Place Text Here..."></textarea>
    <button class="chat-submit"type="button" name="send"
    onclick="
    let form = getElementById('chat-form');
    form.submit();
  ">
      <i class='fa fa-paper-plane'></i>  Send</button>

    <!-- Auto resize txtarea-->
    <script>
    $(document)
    .one('focus.autoExpand', 'textarea.autoExpand', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
    })
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
        this.rows = minRows + rows;
    });
    </script>

  </form>
  <!-- Sent data-->

  </div>

<footer>
  &copy Manifest Realities
</footer>
</html>
