<?php 
namespace Model;
/**
*
*/
class Horarios {

	private $con;
	private $cve_horario;
	private $cve_empresa;
	private $turno;
	private $hora_entrada;
	private $hora_salida;


	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarHorario() {
		$sql = "INSERT INTO horarios (cve_empresa, turno, hora_entrada, hora_salida, activo) VALUES ('$this->cve_empresa', '$this->turno', '$this->hora_entrada','$this->hora_salida', b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verHorarios(){
		$sql="SELECT * FROM horarios AS h, empresa AS em WHERE h.cve_empresa=em.cve_empresa AND h.activo=b'1'";
		return $this->con->query($sql);
	}

	public function verHorasTurno(){
		$sql="SELECT * FROM horarios WHERE activo=b'1' AND cve_horario='$this->cve_horario'";
		return $this->con->query($sql);
	}

	public function verHorasOcupadas($fecha){
		$sql= "SELECT c.hora FROM citas AS c, empresa AS em WHERE c.cve_empresa=em.cve_empresa AND c.fecha='$fecha'";
		return $this->con->query($sql);
	}

	public function editarHorario($id) {
		$sql = "UPDATE horarios SET turno='$this->turno', hora_entrada='$this->hora_entrada', hora_salida='$this->hora_salida' WHERE cve_horario=$id";
		$this->con->query($sql);
	}

	public function eliminarHorario($id) {
		$sql = "UPDATE horarios SET activo=b'0' WHERE cve_horario=$id";
		$this->con->query($sql);
	}

}
?>
