<?php

class ControladorAlumno{

	/*=============================
	MOSTRAR TODOS LOS REGISTROS
	=============================*/

	public function index($page){


		if ($page != null) {
			
			/*============================================
				  Mostrar registros con paginación
			============================================*/

			$cantidad = 10;
			$desde = ($page-1)*$cantidad;

			$alumnos = ModeloAlumno::index("alumnos", $cantidad, $desde);

				}else{

					/*============================================
					Mostrar todos los registros
					============================================*/

					$alumnos = ModeloAlumno::index("alumnos", null, null);
				}
				if (!empty($alumnos)) {	

					$json = array(
						"status"=>200,
						"total_registros"=>count($alumnos),
						"detalle"=> $alumnos
					);

					echo json_encode($json, true);
					return;
				
				}else{
						$json = array(
							"status"=>200,
							"total_registros"=>0,
							"detalle"=> "No hay ningún registro"
						);
						echo json_encode($json, true);
						return;
				}
	}
	/*============================================
	Crear un registro
	============================================*/

	public function create($datos){
		
		/*============================================
		Validar Nombre
		============================================*/

		foreach ($datos as $key => $valueDatos) {
			if (isset($ValueDatos) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo nombre".$key
				);
				echo json_encode($json, true);
				return;
			}
		}

		/*============================================
		Validar que el nombre no esté repetido
		============================================*/

		$alumnos = ModeloAlumno::index("alumnos", null, null);
		foreach ($alumnos as $key => $value) {
			
			if ($value->NUM_CONTROL == $datos["NUM_CONTROL"]) {

				$json = array(
					"status"=>404,
					"detalle"=>"El nombre ya existe en la base de datos"
				);

				echo json_encode($json, true);
				return;
			}
			
		}

		/*============================================
		Llevar datos al modelo
		============================================*/

		$datos = array( "NUM_CONTROL"=>$datos["NUM_CONTROL"],
				          "ID_LOCALIDAD"=>$datos["ID_LOCALIDAD"],
				          "ID_ROL"=>$datos["ID_ROL"],
				          "NOMBRE"=>$datos["NOMBRE"],
				          "APELLIDO_PATERNO"=>$datos["APELLIDO_PATERNO"],
				          "APELLIDO_MATERNO"=>$datos["APELLIDO_MATERNO"],
	          			  "EMAIL"=>$datos["EMAIL"],
				          "TELEFONO"=>$datos["TELEFONO"],
				          "FECHA_NACIMIENTO"=>$datos["FECHA_NACIMIENTO"],
	   			          "SEXO"=>$datos["SEXO"],
	   			          "CALLE"=>$datos["CALLE"],
				          "NUM_EXTERIOR"=>$datos["NUM_EXTERIOR"],
			    	      "NUM_INTERIOR"=>$datos["NUM_INTERIOR"],
				          "COLONIA"=>$datos["COLONIA"],
				          "PASSWORD"=>$datos["PASSWORD"],
				          "ESTATUS"=>$datos["ESTATUS"],
				          "SEMESTRE"=>$datos["SEMESTRE"],
				          "ID_CARRERA"=>$datos["ID_CARRERA"]
			          

		);

		$create = ModeloAlumno::create("alumnos", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($create == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Su registro ha sido guardado"
				);

				echo json_encode($json, true);
				return;
			}
	}
	/*============================================
	Mostrando un solo registro
	============================================*/

	public function show($id){
			
		/*============================================
		Mostrar todos los registro
		============================================*/

		$alumnos = ModeloAlumno::show("alumnos", $id);

		if (!empty($alumnos)) {

			$json = array(
				"status"=>200,
				"detalle"=> $alumnos
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún registro"
			);

			echo json_encode($json, true);
			return;
		}

	}
	/*============================================
	Editar un Registro
	============================================*/

	public function update($id, $datos){

		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo nombre".$key
				);

				echo json_encode($json, true);
				return;
			}

			/*============================================
			Llevar datos al modelo
			============================================*/

			$datos = array( "NUM_CONTROL"=>$id,	
			          		 "ID_LOCALIDAD"=>$datos["ID_LOCALIDAD"],
			          		 "ID_ROL"=>$datos["ID_ROL"],
					         "NOMBRE"=>$datos["NOMBRE"],
					         "APELLIDO_PATERNO"=>$datos["APELLIDO_PATERNO"],
					         "APELLIDO_MATERNO"=>$datos["APELLIDO_MATERNO"],
					         "EMAIL"=>$datos["EMAIL"],
					         "TELEFONO"=>$datos["TELEFONO"],
					         "FECHA_NACIMIENTO"=>$datos["FECHA_NACIMIENTO"],
			                 "SEXO"=>$datos["SEXO"],
					         "CALLE"=>$datos["CALLE"],
					         "NUM_EXTERIOR"=>$datos["NUM_EXTERIOR"],
					         "NUM_INTERIOR"=>$datos["NUM_INTERIOR"],
					         "COLONIA"=>$datos["COLONIA"],
					         "PASSWORD"=>$datos["PASSWORD"],
					         "ESTATUS"=>$datos["ESTATUS"],
					         "SEMESTRE"=>$datos["SEMESTRE"],
					         "ID_CARRERA"=>$datos["ID_CARRERA"]							
				      );

			$update = ModeloAlumno::update("alumnos", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($update == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Su registro ha sido actualizado"
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
	/*============================================
	Borrar Registro
	============================================*/

	public function delete($id){

		/*============================================
		Llevar datos al modelo
		============================================*/

		$delete = ModeloAlumno::delete("alumnos", $id);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($delete == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Se ha borrado con éxito"
			);

			echo json_encode($json, true);
			return;
		}
	}
}