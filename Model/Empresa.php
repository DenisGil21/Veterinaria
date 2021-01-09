<?php 
namespace Model;
/**
*
*/
class Empresa {

	private $con;
	private $cve_empresa;
	private $nombre;
	private $direccion;
	private $telefono;

	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function verEmpresa(){
		$sql="SELECT * FROM empresa";
		return $this->con->query($sql);
	}

	public function editarEmpresa($id) {
		$sql = "UPDATE empresa SET nombre='$this->nombre', direccion='$this->direccion', telefono='$this->telefono' WHERE cve_empresa=$id";
		$this->con->query($sql);
	}

}
?>
