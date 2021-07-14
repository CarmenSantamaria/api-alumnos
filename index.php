<?php

require_once "controladores/rutas.controlador.php";
require_once "controladores/alumno.controlador.php";

require_once "modelos/alumno.modelo.php";

$rutas =  new ControladorRutas();
$rutas -> index();