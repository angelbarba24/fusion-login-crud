<?php
class Escuderia {
    private $conn;
    private $table_name = "escuderias";

    public $id;
    public $nombre;
    public $sede;
    public $director;
    public $motor;
    public $campeonatos;
    public $fundacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, sede=:sede, director=:director, motor=:motor, campeonatos=:campeonatos, fundacion=:fundacion";
        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->sede = htmlspecialchars(strip_tags($this->sede));
        $this->director = htmlspecialchars(strip_tags($this->director));
        $this->motor = htmlspecialchars(strip_tags($this->motor));
        $this->campeonatos = htmlspecialchars(strip_tags($this->campeonatos));
        $this->fundacion = htmlspecialchars(strip_tags($this->fundacion));

        // Bind
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":sede", $this->sede);
        $stmt->bindParam(":director", $this->director);
        $stmt->bindParam(":motor", $this->motor);
        $stmt->bindParam(":campeonatos", $this->campeonatos);
        $stmt->bindParam(":fundacion", $this->fundacion);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nombre = $row['nombre'];
            $this->sede = $row['sede'];
            $this->director = $row['director'];
            $this->motor = $row['motor'];
            $this->campeonatos = $row['campeonatos'];
            $this->fundacion = $row['fundacion'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, sede=:sede, director=:director, motor=:motor, campeonatos=:campeonatos, fundacion=:fundacion WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->sede = htmlspecialchars(strip_tags($this->sede));
        $this->director = htmlspecialchars(strip_tags($this->director));
        $this->motor = htmlspecialchars(strip_tags($this->motor));
        $this->campeonatos = htmlspecialchars(strip_tags($this->campeonatos));
        $this->fundacion = htmlspecialchars(strip_tags($this->fundacion));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":sede", $this->sede);
        $stmt->bindParam(":director", $this->director);
        $stmt->bindParam(":motor", $this->motor);
        $stmt->bindParam(":campeonatos", $this->campeonatos);
        $stmt->bindParam(":fundacion", $this->fundacion);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>