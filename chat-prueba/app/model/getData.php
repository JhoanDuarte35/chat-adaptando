<?php

include_once(__dir__."/db.class.php");

class GetDatos extends DataBase{

    public function selectQuery($query){
        
        $datos=array();
        if(!$this->isConnected){
            $this->conectar();
        }

        $consulta=$this->consultar($query);

        if($this->numero_filas($consulta)){
            while($arreglo=$consulta->fetch_assoc()){
                $datos[]=$arreglo;
            }
        }
        return $datos;
    }

	public function insert_query($query) {
		if (!$this->isConnected) {
			$this->conectar();
		}
		$consulta=$this->consultar($query);
		return $this->getLastInsert();
	}

	public function update_query($query) {
		if (!$this->isConnected) {
			$this->conectar();
		}
		$consulta=$this->consultar($query);
		return true;
	}

	public function delete_query($query) {
		if (!$this->isConnected) {
			$this->conectar();
		}
		$consulta=$this->consultar($query);
		return true;
	}

}

?>