<?php 
namespace Model;
/**
*
*/
class Mascotas {

	private $con;
	private $cve_mascota;
	private $cve_persona;
	private $cve_raza;
	private $imagen;
	private $nombre;
	private $nacimiento;
	private $sexo;
	private $fecha;


	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarMascota() {
		$sql = "INSERT INTO mascotas (cve_raza, cve_persona, imagen, nombre, nacimiento,sexo, activo) VALUES ('$this->cve_raza', '$this->cve_persona','$this->imagen', '$this->nombre','$this->nacimiento',b'$this->sexo', b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verMascotas(){
		$sql="SELECT ma.imagen,ma.cve_persona,ma.cve_mascota,es.cve_especie,ra.cve_raza,ma.nombre AS mascota,ra.nombre AS raza, ma.nacimiento,ma.sexo FROM mascotas AS ma, personas AS per, razas AS ra, especies AS es WHERE ma.cve_persona=per.cve_persona AND ma.cve_raza=ra.cve_raza AND ra.cve_especie=es.cve_especie AND ma.activo=b'1' AND ma.cve_persona='$this->cve_persona'";
		return $this->con->query($sql);
	}

	public function verMascotasGeneral(){
		$sql="SELECT * FROM mascotas";
		return $this->con->query($sql);
	}

	public function verMascota(){
		$sql="SELECT ma.imagen,ma.cve_persona,ma.cve_mascota,es.cve_especie,ra.cve_raza,ma.nombre AS mascota,ra.nombre AS raza, ma.nacimiento,ma.sexo FROM mascotas AS ma, personas AS per, razas AS ra, especies AS es WHERE ma.cve_persona=per.cve_persona AND ma.cve_raza=ra.cve_raza AND ra.cve_especie=es.cve_especie AND ma.activo=b'1' AND ma.cve_mascota='$this->cve_mascota'";
		return $this->con->query($sql);
	}

	public function verHistorialMascota(){
		$sql="SELECT m.nombre AS mascota,m.sexo,m.imagen,s.nombre, v.fecha FROM ventas AS v, mascotas_servicios AS ms, mascotas AS m, servicios AS s WHERE v.cve_venta=ms.cve_venta AND ms.cve_mascota=m.cve_mascota AND ms.cve_servicio=s.cve_servicio AND m.cve_mascota='$this->cve_mascota' AND DATE_FORMAT(v.fecha,'%Y-%m-%d')=CURDATE()";
		return $this->con->query($sql);
	}

	public function verHistorialFecha(){
		$sql="SELECT m.nombre AS mascota,m.sexo,m.imagen,s.nombre, v.fecha FROM ventas AS v, mascotas_servicios AS ms, mascotas AS m, servicios AS s WHERE v.cve_venta=ms.cve_venta AND ms.cve_mascota=m.cve_mascota AND ms.cve_servicio=s.cve_servicio AND m.cve_mascota='$this->cve_mascota' AND DATE_FORMAT(v.fecha,'%Y-%m-%d')='$this->fecha'";
		return $this->con->query($sql);
	}

	public function editarMascota($id) {
		$sql = "UPDATE mascotas SET cve_raza='$this->cve_raza', nombre='$this->nombre', nacimiento='$this->nacimiento', sexo=b'$this->sexo' WHERE cve_mascota=$id";
		$this->con->query($sql);
	}

	public function editarImagen($id) {
		$sql = "UPDATE mascotas SET imagen='$this->imagen' WHERE cve_mascota=$id";
		$this->con->query($sql);
	}

	public function eliminarMascota($id) {
		$sql = "UPDATE mascotas SET activo=b'0' WHERE cve_mascota=$id";
		$this->con->query($sql);
	}

}
?>
