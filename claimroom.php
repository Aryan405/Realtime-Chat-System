<?php

include("connection.php");
$room = $_POST['room'];

if(strlen($room)>15 or strlen($room)<2)
{
    $mssg = " Please choose Room Name beween 2 to 15 characters";

    echo '<script language = "javascript">';
    echo 'alert(" '.$mssg.' ");';
    echo 'window.location = "http://localhost/ChatSystem/";';
    echo '</script>';
}

$query = "SELECT * FROM chat WHERE roomname = '{$room}'";
$result = mysqli_query($conn , $query);

if($result){
    if(mysqli_num_rows($result)>0)
    {
        $mssg = "Room already created !! Create another one";

    echo '<script language = "javascript">';
    echo 'alert(" '.$mssg.' ");';
    echo 'window.location = "http://localhost/ChatSystem/";';
    echo '</script>';
    }

    else
    {
        $query = "INSERT INTO chat(roomname , ctime) VALUES ('$room' , CURRENT_TIMESTAMP)";

        if(mysqli_query($conn , $query))
        {
            $mssg = "Your Room is ready";

    echo '<script language = "javascript">';
    echo 'alert(" '.$mssg.' ");';
    echo 'window.location = "http://localhost/ChatSystem/rooms.php?roomname='.$room.'";';
    echo '</script>';
        }
    }
}

else{
    echo "ERROR !!".mysqli_error($conn);
}

?>