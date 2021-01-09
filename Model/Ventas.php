<?php 
namespace Model;
/**
*
*/
class Ventas {

	private $con;
	private $cve_venta;
	private $cve_servicio;
	private $cve_mascota;
	private $fecha;
	private $observaciones;
	private $total;


	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarMascotasServicios($cve_venta,$cve_mascota,$cve_servicio) {
		$sql = "INSERT INTO mascotas_servicios (cve_venta, cve_mascota,cve_servicio) VALUES ($cve_venta, $cve_mascota, $cve_servicio)";
		$this->con->query($sql);
	}

	public function guardarVenta() {
		$sql = "INSERT INTO ventas (fecha,observaciones,total) VALUES (NOW(), '$this->observaciones', '$this->total')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verVentasHoy(){
		$sql="SELECT * FROM ventas AS v,mascotas_servicios AS ms WHERE ms.cve_venta=v.cve_venta AND DATE_FORMAT(v.fecha,'%Y-%m-%d')=CURDATE() GROUP BY v.cve_venta";
		return $this->con->query($sql);
	}
	public function verVentasFecha(){
		$sql="SELECT * FROM ventas AS v,mascotas_servicios AS ms WHERE ms.cve_venta=v.cve_venta AND DATE_FORMAT(v.fecha,'%Y-%m-%d')='$this->fecha'";
		return $this->con->query($sql);
	}

	public function verDetalleVenta(){
		$sql="SELECT * FROM ventas AS v,mascotas_servicios AS ms, servicios AS s WHERE ms.cve_venta=v.cve_venta AND ms.cve_servicio=s.cve_servicio AND v.cve_venta='$this->cve_venta'";
		return $this->con->query($sql);
	}

}
?>
