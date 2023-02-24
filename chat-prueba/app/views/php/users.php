<?php
    session_start();
    include_once(__dir__."/../../model/config.php");
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM usuarios WHERE NOT cc_user = {$outgoing_id} ORDER BY id_user DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once(__dir__."/data.php");
    }
    echo $output;
?>