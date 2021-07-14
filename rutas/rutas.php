<?php

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

if (isset($_GET["page"]) && is_numeric($_GET["page"])) {

	$alumnos = new ControladorAlumno();
	$alumnos -> index($_GET["page"]);

}else{

	if (count(array_filter($arrayRutas)) == 0) {

		/*============================================
		Cuando no se hace ninguna petición a la API
		============================================*/
			$json = array(
			"detalle" => "no encontrado"
		);
			echo json_encode($json, true);
			return;
		
		}else{

		/*====================================================
		 Cuando pasamos solo un índice en el array $arrayRutas
		======================================================*/

			if (count(array_filter($arrayRutas)) == 1) {

				/*============================================
				Cuando se hace peticiones desde alumnoss
				============================================*/

				if (array_filter($arrayRutas)[1] == "registro") {

					/*============================================
					Peticiones GET
					============================================*/

					if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
						
						$alumnos = new ControladorAlumno();
						$alumnos -> index(null);

					
				}
					/*============================================
					Peticiones POST
					============================================*/

					else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

						/*============================================
						Capturar datos
						============================================*/

						$datos = array( "NUM_CONTROL"=>$_POST["NUM_CONTROL"],
										"ID_LOCALIDAD"=>$_POST["ID_LOCALIDAD"],
										"ID_ROL"=>$_POST["ID_ROL"],
										"NOMBRE"=>$_POST["NOMBRE"],
										"APELLIDO_PATERNO"=>$_POST["APELLIDO_PATERNO"],
										"APELLIDO_MATERNO"=>$_POST["APELLIDO_MATERNO"],
										"EMAIL"=>$_POST["EMAIL"],
										"TELEFONO"=>$_POST["TELEFONO"],
										"FECHA_NACIMIENTO"=>$_POST["FECHA_NACIMIENTO"],
										"SEXO"=>$_POST["SEXO"],
										"CALLE"=>$_POST["CALLE"],
										"NUM_EXTERIOR"=>$_POST["NUM_EXTERIOR"],
										"NUM_INTERIOR"=>$_POST["NUM_INTERIOR"],
										"COLONIA"=>$_POST["COLONIA"],
										"PASSWORD"=>$_POST["PASSWORD"],
										"ESTATUS"=>$_POST["ESTATUS"],
										"SEMESTRE"=>$_POST["SEMESTRE"],
										"ID_CARRERA"=>$_POST["ID_CARRERA"],

										);

						$agregarRegistro = new ControladorAlumno();
						$agregarRegistro -> create($datos);

						echo '<pre>'; print_r($_SERVER["REQUEST_METHOD"]); echo '</pre>';
						
						return;

					}else{
						$json = array(
							"detalle" => "no encontrado 2" 
						);

						echo json_encode($json, true);
						return;
					}

				}else{
					$json = array(
						"detalle" => "no encontrado 3" 
					);

					echo json_encode($json, true);
					return;
				}
			}else{

			/*==============================================
			Cuando se hace peticiones desde un solo registro
			================================================*/

			if (array_filter($arrayRutas)[1] == "registro" && is_numeric(array_filter($arrayRutas)[2])) {

				/*============================================
								Peticiones GET
				============================================*/

				if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
					
					$alumnos = new ControladorAlumno();
					$alumnos -> show(array_filter($arrayRutas)[2]);
				}
				/*============================================
								Peticiones PUT
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "PUT") {

					/*============================================
								Capturar datos
					============================================*/

					$datos = array();
					
					parse_str(file_get_contents('php://input'), $datos);

					$editarRegistro = new ControladorAlumno();
					$editarRegistro -> update(array_filter($arrayRutas)[2], $datos);
				}
				/*============================================
								Peticiones DELETE
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "DELETE") {
					
					$borrarRegistro = new ControladorAlumno();
					$borrarRegistro -> delete(array_filter($arrayRutas)[2]);

				}else{
					$json = array(
						"detalle" => "no encontrado 4" 
					);

					echo json_encode($json, true);
					return;
				}
			
			}else{
				$json = array(
					"detalle" => "no encontrado 5" 
				);
				echo json_encode($json, true);
				return;
			}
		}
	}
}