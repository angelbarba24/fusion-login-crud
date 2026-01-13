<?php
require_once __DIR__ . '/../config/Database.php'; 

class Usuario
{
    private $PDO;
    private $tabla_nombre = "usuarios";

    public function __construct()
    {
        // Creo la conexión
        $database = new Database();                    
        $this->PDO = $database->getConnection();       
    }

    // Método para validar las credenciales
    public function login($idusuario, $password)      
    {                                                 
        // Busco al usuario en la BD
        $query = "SELECT * FROM " . $this->tabla_nombre . " WHERE idusuario = ? LIMIT 0,1";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindParam(1, $idusuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verifico que la contraseña coincida con el hash
            if (password_verify($password, $row['password'])) {
                return $row; // Login correcto
            }
        }
        return false; // Login fallido
    }
}
?>