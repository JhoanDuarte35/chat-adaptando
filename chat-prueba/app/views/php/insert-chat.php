<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once(__dir__."/../../model/config.php");
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO mensajes (id_receptor, id_emisor, msj)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header('Location: '.controlador::$rutaAPP.'index.php');
    }


    
?>