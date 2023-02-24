<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo controlador::$rutaAPP?>app/views/login/css/styles.css">
    <title>Login - Puntualmente</title>
    <script src="https://kit.fontawesome.com/bf7fc14a7d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="login">
        <form id="miform">
            <i class="fa-solid fa-right-to-bracket"></i>
            <h1>Bienvenido,</h1>
            <h1>Inicio de Sesión</h1>
            <!-- <label for="username">Nombre de Usuario</label> -->
            <input type="text" placeholder="Usuario" name="user" id="username" require>
            <!-- <label for="password">Contraseña</label> -->
            <input type="password" placeholder="Contraseña" name="pwd" id="pass" require>

            <input type="submit" value="Ingresar">
            <!-- <button>entrar</button> -->

            <div align="center" class="alert" id="mensaje"></div>
        </form>
    </div>

    <div id="dropDownSelect1"></div>

	<script src="<?php echo controlador::$rutaAPP?>app/views/login/jquery/jquery-3.2.1.min.js"></script>
    <!-- <script src="<?//php echo controlador::$rutaAPP?>app/views/js/main.js"></script> -->


    <script type="text/javascript">

        $(document).ready(function(){
            $("#miform").submit(function(event){
                event.preventDefault();
                $.ajax({
                    dataType:"json",
                    url:"<?php echo controlador::$rutaAPP?>index.php?action=validar",
                    type:"POST",
                    data:{usr:$("#username").val(),pass:$("#pass").val()},
                    success: function(data){
                        if(data.success==false){
                            $("#mensaje").show();
                            $("#mensaje").html(data.msg);
                            $('.log-status').addClass('wrong-entry');
                            $('.alert').fadeIn(700);
                        setTimeout( "$('.alert').fadeOut(1800);",1500 );
                        }else{
                            window.location=data.link;
                        }
                    },
                        error: function(response) {
                            $("#mensaje").show();
                            $("#mensaje").html(response.responseText);
                        }
                });
            });
            $('.form-control').keypress(function(){
                $('.log-status').removeClass('wrong-entry');
            });
        })

    </script>

</body>
</html>