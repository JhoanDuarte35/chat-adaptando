<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM mensajes WHERE (id_receptor = {$row['cc_user']}
                OR id_emisor = {$row['cc_user']}) AND (id_emisor = {$outgoing_id} 
                OR id_receptor = {$outgoing_id}) ORDER BY id_msj DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msj'] : $result = "No hay mensajes disponibles";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['id_emisor'])) {
        ($outgoing_id == $row2['id_emisor']) ? $you = "Tu: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "0") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['cc_user']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="/chat-prueba/index.php?action=chat?user_id=' . $row['cc_user'] . '">
                    <div class="content">
                    <img src="app/views/images/1676636707img2.jpeg" alt="">
                    <div class="details">
                        <span>' . $row['nombre'] . " " . $row['apellido'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
