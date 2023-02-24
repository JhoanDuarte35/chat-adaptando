<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once(__dir__."/../../model/config.php");
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM mensajes LEFT JOIN usuarios ON usuarios.cc_user = mensajes.id_emisor
                WHERE (id_emisor = {$outgoing_id} AND id_receptor = {$incoming_id})
                OR (id_emisor = {$incoming_id} AND id_receptor = {$outgoing_id}) ORDER BY id_msj";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['id_emisor'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msj'] . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="app/views/images/1676636707img2.jpeg" alt="">
                                <div class="details">
                                    <p>' . $row['msj'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
    }
    echo $output;
} else {
    header('Location: '.controlador::$rutaAPP.'index.php');
}
