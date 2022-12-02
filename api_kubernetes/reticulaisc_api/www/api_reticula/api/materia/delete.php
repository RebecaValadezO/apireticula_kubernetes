<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Set ID to update
  $materia->id = $data->id;

  // Delete materia
  if($materia->delete()) {
    echo json_encode(
      array('message' => 'Materia Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Materia Not Deleted')
    );
  }

