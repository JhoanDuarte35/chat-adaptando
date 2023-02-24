<?php

	require_once __dir__."/../../../model/getData.php";
	$usuariosDatos=new GetDatos();
	date_default_timezone_set("America/Bogota");
	$momento=date("d/m/Y h:i:s A");

	if(isset($_POST["usr"])&&isset($_POST["pass"])){

		$result=$usuariosDatos->selectQuery("SELECT * FROM usuarios WHERE usuario='".$_POST["usr"]."'and password=md5('".$_POST["pass"]."') and estado=1");
		if(count($result)>0){

			if(!isset($_SESSION)){
				session_start();
			}

			$_SESSION["unique_id"]=$result[0]["cc_user"];
			$_SESSION["username"]=$result[0]["usuario"];
			$_SESSION["rol"]=$result[0]["rol"];

			if($result[0]["rol"]==1){
				$info=array('success'=>true, 'msg'=>"Usuario Correcto",'link'=>controlador::$rutaAPP."index.php?action=home");
				$result=$usuariosDatos->update_query("update usuarios set intentos=0 where usuario='".$_POST["usr"]."'");
			}elseif($result[0]["rol"]==2){
				$info=array('success'=>true, 'msg'=>"Usuario Correcto",'link'=>controlador::$rutaAPP."index.php?action=operarios");
				$result=$usuariosDatos->update_query("update usuarios set intentos=0 where usuario='".$_POST["usr"]."'");
			}else{
				$result=$usuariosDatos->update_query("update usuarios set estado=2 where usuario='".$_POST["usr"]."'");
				$result=$usuariosDatos->update_query("update usuarios set intentos=5 where usuario='".$_POST["usr"]."'");
				$info=array('success'=>false, 'msg'=>"Rol no valido contacte con soporte, USUARIO '".($_POST["usr"])."' BLOQUEADO ",'link'=>controlador::$rutaAPP."index.php/login");
				

			}
			// if($result[0]["rol"]==1 or $result[0]["rol"]==2){
				
			// }
		}else{
			$consultar=$usuariosDatos->selectQuery("select intentos from usuarios where usuario='".$_POST["usr"]."'");
			if (count($consultar)>0)
		{

			foreach ($consultar as $key => $value) {
				$intentos=$value["intentos"];
			}

			if ($intentos==0)
			{
				$result=$usuariosDatos->update_query("update usuarios set intentos=1 where usuario='".$_POST["usr"]."'");
				$info=array('success'=>false,'msg'=>"CONTRASEÑA INCORRECTA (INTENTOS DISPONIBLES:".(4).")");
			}elseif ($intentos==1) {
				$result=$usuariosDatos->update_query("update usuarios set intentos=2 where usuario='".$_POST["usr"]."'");
				$info=array('success'=>false,'msg'=>"CONTRASEÑA INCORRECTA (INTENTOS DISPONIBLES:".(3).")");
			}elseif ($intentos==2) {
				$result=$usuariosDatos->update_query("update usuarios set intentos=3 where usuario='".$_POST["usr"]."'");
				$info=array('success'=>false,'msg'=>"CONTRASEÑA INCORRECTA (INTENTOS DISPONIBLES:".(2).")");
			}elseif ($intentos==3) {
				$result=$usuariosDatos->update_query("update usuarios set intentos=4 where usuario='".$_POST["usr"]."'");
				$info=array('success'=>false,'msg'=>"CONTRASEÑA INCORRECTA (INTENTOS DISPONIBLES:".(1).")");
			}elseif ($intentos==4) {
				$result=$usuariosDatos->update_query("update usuarios set intentos=5 where usuario='".$_POST["usr"]."'");
				$info=array('success'=>false,'msg'=>"CONTRASEÑA INCORRECTA (INTENTOS DISPONIBLES:".(0).")");
			}elseif ($intentos==5) {
				$result=$usuariosDatos->update_query("update usuarios set estado=2 where usuario='".$_POST["usr"]."'");
				$info=array('success'=>false,'msg'=>"USUARIO '".($_POST["usr"])."' BLOQUEADO, CONTACTE CON EL ADMINISTRADOR.");
			}
		}else{
			$info=array('success'=>false,'msg'=>"USUARIO DESCONOCIDO");
		}
		}
	}else {
		$info=array('success'=>false,'msg'=>"No hay datos para comparar");
	}
	echo json_encode($info);

?>