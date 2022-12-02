<?php 
  class Materia {
    // DB stuff
    private $conn;
    private $table = 'materias';

    // Materia Properties
    public $id;
    public $nombre;
    public $clave;
    public $semestre;
    public $horas_teoria;
    public $horas_practica;
    public $total_creditos;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Materias
    public function read() {
      // Create query
      $query = 'SELECT * FROM `materias`;';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Materia
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM `materias` WHERE id = ?;';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id= $row['id'];
          $this->nombre= $row['nombre'];
          $this->clave= $row['clave'];
          $this->semestre = $row['semestre'];
          $this->horas_teoria = $row['horas_teoria'];
          $this->horas_practica = $row['horas_practica'];
          $this->total_creditos = $row['total_creditos'];
    }

    // Create Materia
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET nombre = :nombre, clave = :clave, 
                        semestre = :semestre, horas_teoria = :horas_teoria, 
                        horas_practica = :horas_practica, total_creditos = :total_creditos ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->nombre = htmlspecialchars(strip_tags($this->nombre));
          $this->clave = htmlspecialchars(strip_tags($this->clave));
          $this->semestre = htmlspecialchars(strip_tags($this->semestre));
          $this->horas_teoria = htmlspecialchars(strip_tags($this->horas_teoria));
          $this->horas_practica = htmlspecialchars(strip_tags($this->horas_practica));
          $this->total_creditos = htmlspecialchars(strip_tags($this->total_creditos));

          // Bind data
          $stmt->bindParam(':nombre', $this->nombre);
          $stmt->bindParam(':clave', $this->clave);
          $stmt->bindParam(':semestre', $this->semestre);
          $stmt->bindParam(':horas_teoria', $this->horas_teoria);
          $stmt->bindParam(':horas_practica', $this->horas_practica);
          $stmt->bindParam(':total_creditos', $this->total_creditos);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Materia
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET nombre = :nombre, clave = :clave, 
                                semestre = :semestre, horas_teoria = :horas_teoria, 
                                horas_practica = :horas_practica, total_creditos = :total_creditos 
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->nombre = htmlspecialchars(strip_tags($this->nombre));
          $this->clave = htmlspecialchars(strip_tags($this->clave));
          $this->semestre = htmlspecialchars(strip_tags($this->semestre));
          $this->horas_teoria = htmlspecialchars(strip_tags($this->horas_teoria));
          $this->horas_practica = htmlspecialchars(strip_tags($this->horas_practica));
          $this->total_creditos = htmlspecialchars(strip_tags($this->total_creditos));

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':nombre', $this->nombre);
          $stmt->bindParam(':clave', $this->clave);
          $stmt->bindParam(':semestre', $this->semestre);
          $stmt->bindParam(':horas_teoria', $this->horas_teoria);
          $stmt->bindParam(':horas_practica', $this->horas_practica);
          $stmt->bindParam(':total_creditos', $this->total_creditos);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Materia
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }