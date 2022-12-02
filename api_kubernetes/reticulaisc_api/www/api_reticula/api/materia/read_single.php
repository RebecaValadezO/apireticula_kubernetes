<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '/var/www/html/api_reticula/config/Database.php';
  include_once '/var/www/html/api_reticula/models/Materia.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog materia object
  $materia = new Materia($db);

  // Get ID
  $materia->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get materia
  $materia->read_single();

  // Create array
  $materia_arr = array(
    'id' => $materia->id,
    'nombre' => $materia->nombre,
    'clave' => $materia->clave,
    'semestre' => $materia->semestre,
    'horas_teoria' => $materia->horas_teoria,
    'horas_practica' => $materia->horas_practica,
    'total_creditos' => $materia->total_creditos
  );

  // Make JSON
  print_r(json_encode($materia_arr));