<?php

include("connection.php");
$roomname = $_GET['roomname'];

$query = "SELECT * FROM chat WHERE roomname = '$roomname'";

$result = mysqli_query($conn , $query);

if ($result) {
    if (mysqli_num_rows($result) == 0) {
        $mssg = "This Room doesn't exist !!";

        echo '<script language = "javascript">';
        echo 'alert(" '.$mssg.' ");';
        echo 'window.location = "http://localhost/ChatSystem/";';
        echo '</script>';
    }
}

else
{
    echo "Error !!".mysqli_error($conn);
}




?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="CSS/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

#submitmssg{
  position: absolute;
  left: 260px;
  border: 3px solid green;
  bottom: 100px;
}

#resetmssg{
  position: absolute;
  right: 260px;
  /* width: 200px;
  height: 120px; */
  border: 3px solid green;
  bottom: 100px;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyclass{
    overflow-y: scroll;
    height: 300px;
}
</style>
</head>
<body>

<h2>Chat Messages for 
<?php
echo $roomname;
?></h2>

<div class="container">
<div class="anyclass">
  
  
</div>
</div>

<br>
<input type="text" class="form-control" name="usermssg" id="usermssg" placeholder="Type your messages here !! ">
<br>

<div class="btn">
<button class="btn btn-success" name="submitmssg" id="submitmssg">SEND</button>

<button class="btn btn-success" name="resetmssg" id="resetmssg">Reset</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>


<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
  </script>

    <script type="text/javascript">

    // Code for fetching data from database

    setInterval(runfunction , 1000);

    function runfunction() {
      
      $.post("fetchmssg.php" , {room: '<?php echo $roomname ?>'},
      function(data , status) {
        document.getElementsByClassName('anyclass')[0].innerHTML = data;
        
      }
      
      )
      }


    // Get the input field
var input = document.getElementById("usermssg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmssg").click();
  }
});

  $("#submitmssg").click(function()
  {
     var clientmssg = $("#usermssg").val();

    $.post("postmssg.php" , {text:clientmssg, room:'<?php echo $roomname ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'},
    
    function (data , status) {
        document.getElementsByClassName('anyclass')[0].innerHTML = data;

        
    });

    $("#usermssg").val("");

    return false;



  });
</script>

</body>
</html>
