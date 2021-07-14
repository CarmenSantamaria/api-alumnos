<?php

require_once "conexion.php";

class ModeloAlumno{

	/*============================================
	Mostrar todos los Registros
	============================================*/

	static public function index($tabla, $cantidad, $desde){

		if ($cantidad != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT $tabla.NUM_CONTROL, $tabla.ID_LOCALIDAD, $tabla.ID_ROL, $tabla.NOMBRE, $tabla.APELLIDO_PATERNO,
			$tabla.APELLIDO_MATERNO, $tabla.EMAIL, $tabla.TELEFONO, $tabla.FECHA_NACIMIENTO, $tabla.SEXO, $tabla.CALLE,
			$tabla.NUM_EXTERIOR, $tabla.NUM_INTERIOR, $tabla.COLONIA, $tabla.PASSWORD, $tabla.ESTATUS, $tabla.SEMESTRE, $tabla.ID_CARRERA  FROM
			$tabla LIMIT $desde, $cantidad");

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.NUM_CONTROL, $tabla.ID_LOCALIDAD, $tabla.ID_ROL, $tabla.NOMBRE, $tabla.APELLIDO_PATERNO,
			$tabla.APELLIDO_MATERNO, $tabla.EMAIL, $tabla.TELEFONO, $tabla.FECHA_NACIMIENTO, $tabla.SEXO, $tabla.CALLE,
			$tabla.NUM_EXTERIOR, $tabla.NUM_INTERIOR, $tabla.COLONIA, $tabla.PASSWORD, $tabla.ESTATUS, $tabla.SEMESTRE, $tabla.ID_CARRERA  FROM $tabla");

		}

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
				Crear Registro 
	============================================*/

	static public function create($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(NUM_CONTROL,ID_LOCALIDAD,ID_ROL,NOMBRE,APELLIDO_PATERNO,APELLIDO_MATERNO,
															EMAIL,TELEFONO,FECHA_NACIMIENTO,SEXO,CALLE,NUM_EXTERIOR,NUM_INTERIOR,COLONIA,
															PASSWORD,ESTATUS,SEMESTRE,ID_CARRERA) VALUES (:NUM_CONTROL, :ID_LOCALIDAD,:ID_ROL, :NOMBRE, :APELLIDO_PATERNO, :APELLIDO_MATERNO, :EMAIL, :TELEFONO, :FECHA_NACIMIENTO, :SEXO, :CALLE, :NUM_EXTERIOR, :NUM_INTERIOR, :COLONIA, :PASSWORD, :ESTATUS, :SEMESTRE, :ID_CARRERA)");

		$stmt -> bindParam(":NUM_CONTROL", $datos["NUM_CONTROL"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_LOCALIDAD", $datos["ID_LOCALIDAD"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_ROL", $datos["ID_ROL"], PDO::PARAM_STR);
		$stmt -> bindParam(":NOMBRE", $datos["NOMBRE"], PDO::PARAM_STR);
		$stmt -> bindParam(":APELLIDO_PATERNO", $datos["APELLIDO_PATERNO"], PDO::PARAM_STR);
		$stmt -> bindParam(":APELLIDO_MATERNO", $datos["APELLIDO_MATERNO"], PDO::PARAM_STR);
		$stmt -> bindParam(":EMAIL", $datos["EMAIL"], PDO::PARAM_STR);
		$stmt -> bindParam(":TELEFONO", $datos["TELEFONO"], PDO::PARAM_STR);
		$stmt -> bindParam(":FECHA_NACIMIENTO", $datos["FECHA_NACIMIENTO"], PDO::PARAM_STR);
		$stmt -> bindParam(":SEXO", $datos["SEXO"], PDO::PARAM_STR);
		$stmt -> bindParam(":CALLE", $datos["CALLE"], PDO::PARAM_STR);
		$stmt -> bindParam(":NUM_EXTERIOR", $datos["NUM_EXTERIOR"], PDO::PARAM_STR);
		$stmt -> bindParam(":NUM_INTERIOR", $datos["NUM_INTERIOR"], PDO::PARAM_STR);
		$stmt -> bindParam(":COLONIA", $datos["COLONIA"], PDO::PARAM_STR);
		$stmt -> bindParam(":PASSWORD", $datos["PASSWORD"], PDO::PARAM_STR);
		$stmt -> bindParam(":ESTATUS", $datos["ESTATUS"], PDO::PARAM_STR);
		$stmt -> bindParam(":SEMESTRE", $datos["SEMESTRE"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_CARRERA", $datos["ID_CARRERA"], PDO::PARAM_STR);
		
		
		if ($stmt -> execute()) {
				
			return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

			$stmt-> close();
			$stmt= null;

	}
	/*============================================
	Mostrar un solo registro
	============================================*/

	static public function show($tabla, $id){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla.NUM_CONTROL, $tabla.ID_LOCALIDAD,$tabla.ID_ROL, $tabla.NOMBRE, $tabla.APELLIDO_PATERNO,
			$tabla.APELLIDO_MATERNO, $tabla.EMAIL, $tabla.TELEFONO, $tabla.FECHA_NACIMIENTO, $tabla.SEXO, $tabla.CALLE,
			$tabla.NUM_EXTERIOR, $tabla.NUM_INTERIOR,$tabla.COLONIA, $tabla.PASSWORD, $tabla.ESTATUS, $tabla.SEMESTRE, $tabla.ID_CARRERA FROM $tabla WHERE $tabla.NUM_CONTROL = :NUM_CONTROL");
		
		$stmt -> bindParam(":NUM_CONTROL", $id, PDO::PARAM_STR);

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Actualizacion de un registro
	============================================*/

	static public function update($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET NUM_CONTROL = :NUM_CONTROL, ID_LOCALIDAD = :ID_LOCALIDAD, ID_ROL = :ID_ROL, NOMBRE = :NOMBRE, APELLIDO_PATERNO = :APELLIDO_PATERNO, APELLIDO_MATERNO = :APELLIDO_MATERNO, EMAIL = :EMAIL, TELEFONO = :TELEFONO, FECHA_NACIMIENTO = :FECHA_NACIMIENTO, SEXO = :SEXO, CALLE = :CALLE, NUM_EXTERIOR = :NUM_EXTERIOR, NUM_INTERIOR = :NUM_INTERIOR, COLONIA = :COLONIA, PASSWORD = :PASSWORD, ESTATUS = :ESTATUS, SEMESTRE = :SEMESTRE, ID_CARRERA = :ID_CARRERA  WHERE NUM_CONTROL = :NUM_CONTROL");

		
		$stmt -> bindParam(":NUM_CONTROL", $datos["NUM_CONTROL"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_LOCALIDAD", $datos["ID_LOCALIDAD"], PDO::PARAM_INT);
		$stmt -> bindParam(":ID_ROL", $datos["ID_ROL"], PDO::PARAM_INT);
		$stmt -> bindParam(":NOMBRE", $datos["NOMBRE"], PDO::PARAM_STR);
		$stmt -> bindParam(":APELLIDO_PATERNO", $datos["APELLIDO_PATERNO"], PDO::PARAM_STR);
		$stmt -> bindParam(":APELLIDO_MATERNO", $datos["APELLIDO_MATERNO"], PDO::PARAM_STR);
		$stmt -> bindParam(":EMAIL", $datos["EMAIL"], PDO::PARAM_STR);
		$stmt -> bindParam(":TELEFONO", $datos["TELEFONO"], PDO::PARAM_STR);
		$stmt -> bindParam(":FECHA_NACIMIENTO", $datos["FECHA_NACIMIENTO"], PDO::PARAM_STR);
		$stmt -> bindParam(":SEXO", $datos["SEXO"], PDO::PARAM_STR);
		$stmt -> bindParam(":CALLE", $datos["CALLE"], PDO::PARAM_STR);
		$stmt -> bindParam(":NUM_EXTERIOR", $datos["NUM_EXTERIOR"], PDO::PARAM_STR);
		$stmt -> bindParam(":NUM_INTERIOR", $datos["NUM_INTERIOR"], PDO::PARAM_STR);
		$stmt -> bindParam(":COLONIA", $datos["COLONIA"], PDO::PARAM_STR);
		$stmt -> bindParam(":PASSWORD", $datos["PASSWORD"], PDO::PARAM_STR);
		$stmt -> bindParam(":ESTATUS", $datos["ESTATUS"], PDO::PARAM_STR);
		$stmt -> bindParam(":SEMESTRE", $datos["SEMESTRE"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_CARRERA", $datos["ID_CARRERA"], PDO::PARAM_INT);

			if ($stmt -> execute()) {
				
				return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

			$stmt-> close();
			$stmt= null;

	}
	/*============================================
	Borrar registro
	============================================*/

	static public function delete($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE NUM_CONTROL = : NUM_CONTROL");

		$stmt -> bindParam(":NUM_CONTROL", $id, PDO::PARAM_STR);
		

			if ($stmt -> execute()) {
				
				return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

		$stmt-> close();
		$stmt= null;

	}
}