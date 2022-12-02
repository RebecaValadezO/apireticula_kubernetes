<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '/var/www/html/api_reticula/config/Database.php';
  include_once '/var/www/html/api_reticula/models/Materia.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog materia object
  $materia = new Materia($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $materia->nombre = $data->nombre;
  $materia->clave = $data->clave;
  $materia->semestre = $data->semestre;
  $materia->horas_teoria = $data->horas_teoria;
  $materia->horas_practica = $data->horas_practica;
  $materia->total_creditos = $data->total_creditos;

  // Create materia
  if($materia->create()) {
    echo json_encode(
      array('message' => 'Materia Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Materia Not Created')
    );
  }

