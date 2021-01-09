<?php 
namespace Model;
/**
*
*/
class Citas {

	private $con;
	private $cve_cita;
	private $cve_persona;
	private $cve_empresa;
	private $fecha;
	private $hora;
	private $nota;
	private $activo;

	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarCita() {
		$sql = "INSERT INTO citas (cve_persona, cve_empresa, fecha, hora,nota ,activo) VALUES ('$this->cve_persona', '$this->cve_empresa', '$this->fecha','$this->hora','$this->nota', b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verCitas(){
		$sql="SELECT * FROM citas AS c, personas AS per WHERE c.cve_persona=per.cve_persona AND c.activo=b'1'";
		return $this->con->query($sql);
	}

	public function verCitasCliente(){
		$sql="SELECT * FROM citas AS c, personas AS per WHERE c.cve_persona=per.cve_persona AND c.cve_persona='$this->cve_persona'";
		return $this->con->query($sql);
	}

	public function verCitasHoy(){
		$sql="SELECT * FROM citas WHERE DATE_FORMAT(fecha,'%Y-%m-%d')=CURDATE()";
		return $this->con->query($sql);
	}

	public function eliminarCita($id) {
		$sql = "UPDATE citas SET activo=b'0' WHERE cve_cita=$id";
		$this->con->query($sql);
	}

}
?>
