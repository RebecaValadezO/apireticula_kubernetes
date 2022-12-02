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

  // Blog materia query
  $result = $materia->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any materias
  if($num > 0) {
    // Materias array
    $materias_arr = array();
    // $materias_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $materia_item = array(
        'id' => $id,
        'nombre' => $nombre,
        'clave' => $clave,
        'semestre' => $semestre,
        'horas_teoria' => $horas_teoria,
        'horas_practica' => $horas_practica,
        'total_creditos' => $total_creditos
      );

      // Push to "data"
      array_push($materias_arr, $materia_item);
      // array_push($materias_arr['data'], $materia_item);
    }

    // Turn to JSON & output
    echo json_encode($materias_arr);

  } else {
    // No Materias
    echo json_encode(
      array('message' => 'No Materias Found')
    );
  }
