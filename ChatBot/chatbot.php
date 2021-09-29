  <?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mono = $_POST['mono'];

    //connecting database to store student information
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mjassistance";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Die if connection was not successful
    if (!$conn) {
      die("Sorry we failed to connect: " . mysqli_connect_error());
    } else {
      $sql = "INSERT INTO `studentinfo` (`id`, `name`, `email`, `mono`) VALUES (NULL, '$name', '$email', '$mono')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        // echo '<script type="text/javascript">',
        // 'jsfunction();',
        // '</script>';
        // echo "Success";
        //here after succesfull student data insertion, opening chatbot

      } else {
        // echo "The data has not been inserted succssfully beacause of this error ---> " . mysqli_error($conn);
        echo "fail";
      }
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8" />
    <!-- Somehow I got an error, so I comment the title, just uncomment to show -->
    <title>MJ Assistance</title>
    <link rel="stylesheet" href="stylebot.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <input type="checkbox" id="click" />
    <label for="click">
      <i class="fab fa-facebook-messenger"></i>
      <i class="fas fa-times"></i>
    </label>

    <!-- Start First Screen -->
    <div class="wrapper" id="chatfirstpage">
      <div class="head-text">MJ Assistance - Online</div>
      <div class="chat-box">
        <div class="desc-text">
          Please fill out the form below to start chatting with MJ Assistance.
        </div>
        <form action="index.php" method="POST">
          <div class="field">
            <input type="text" id="name" name="name" placeholder="Your Name" required />
          </div>
          <div class="field">
            <input type="email" id="email" name="email" placeholder="Email Address" required />
          </div>
          <div class="field">
            <input type="text" id="mono" name="mono" placeholder="Mobile Number" required />
          </div>

          <div class="field">
            <button type="submit" id="startchat" name="startchat" onclick="showhide();">
              Start Chat
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- End First Screen -->

    <!-- Start Second Screen -->
    <div class="wrapper2 wrapper hide" id="chatbody">
      <div class="title">MJ Assistance - Online</div>
      <div class="form">
        <div class="bot-inbox inbox">
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <div class="msg-header">
            <p>Hello there, how can I help you?</p>
          </div>
        </div>
      </div>
      <div class="typing-field">
        <div class="input-data">
          <input id="data" type="text" placeholder="Type something here.." required>
          <button id="send-btn">Send</button>
        </div>
      </div>
    </div>
    <!-- End Second Screen -->

    <script>
      $(document).ready(function() {
        $("#send-btn").on("click", function() {
          $value = $("#data").val();
          $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value + '</p></div></div>';
          $(".form").append($msg);
          $("#data").val('');

          // start ajax code
          $.ajax({
            url: 'message.php',
            type: 'POST',
            data: 'text=' + $value,
            success: function(result) {
              $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>' + result + '</p></div></div>';
              $(".form").append($replay);
              // when chat goes down the scroll bar automatically comes to the bottom
              $(".form").scrollTop($(".form")[0].scrollHeight);
            }
          });
        });
      });
    </script>
    <script>
      function showhide() {
        x = document.getElementById("chatfirstpage");
        y = document.getElementById("chatbody");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
          y.style.display = "block"
        }
      }

      function jsfunction() {

      }

      // document.getElementById("chat-first-page").addClass('hide');
      // document.getElementById("chat-body").removeClass('hide');
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>

  </html>