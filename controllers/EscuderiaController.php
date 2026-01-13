<?php
require_once 'config/Database.php';
require_once 'models/Escuderia.php';

class EscuderiaController {
    public $db;
    public $escuderia;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->escuderia = new Escuderia($this->db);
    }

    public function index() {
        $stmt = $this->escuderia->read();
        $escuderias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/listar.php';
    }

    public function create() {
        if ($_POST) {
            $this->escuderia->nombre = $_POST['nombre'];
            $this->escuderia->sede = $_POST['sede'];
            $this->escuderia->director = $_POST['director'];
            $this->escuderia->motor = $_POST['motor'];
            $this->escuderia->campeonatos = $_POST['campeonatos'];
            $this->escuderia->fundacion = $_POST['fundacion'];

            if ($this->escuderia->create()) {
                header("Location: index.php?mensaje=creado&nombre=" . urlencode($_POST['nombre']));
            } else {
                echo "Error al crear la escudería.";
            }
        }
        include 'views/crear.php';
    }

    public function edit($id) {
        $this->escuderia->id = $id;
        $this->escuderia->readOne();

        if ($_POST) {
            $this->escuderia->nombre = $_POST['nombre'];
            $this->escuderia->sede = $_POST['sede'];
            $this->escuderia->director = $_POST['director'];
            $this->escuderia->motor = $_POST['motor'];
            $this->escuderia->campeonatos = $_POST['campeonatos'];
            $this->escuderia->fundacion = $_POST['fundacion'];

            if ($this->escuderia->update()) {
                header("Location: index.php?mensaje=modificado&nombre=" . urlencode($_POST['nombre']));
            } else {
                echo "Error al actualizar.";
            }
        }
        
        $datosEscuderia = $this->escuderia; 
        include 'views/editar.php';
    }

    public function delete($id) {
        $this->escuderia->id = $id;
        
        $this->escuderia->readOne();
        $nombreEliminado = $this->escuderia->nombre;

        if ($this->escuderia->delete()) {
            header("Location: index.php?mensaje=eliminado&nombre=" . urlencode($nombreEliminado));
        } else {
            echo "No se pudo eliminar.";
        }
    }
}
?>