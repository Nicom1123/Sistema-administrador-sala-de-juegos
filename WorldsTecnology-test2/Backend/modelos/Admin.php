<?php
class Admin {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function authenticate($username, $password) {
        $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows === 1;
    }

    public function createAccount($username, $password, $code) {
        // Verificar si el username ya existe
        $checkSql = "SELECT COUNT(*) AS count FROM admin WHERE username = ?";
        $checkStmt = $this->mysqli->prepare($checkSql);
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        $row = $result->fetch_assoc();
    
        if ($row['count'] > 0) {
            // Si el username ya existe, retornar false
            return false;
        }
    

    
        // Insertar la nueva cuenta
        $sql = "INSERT INTO admin (username, password, code) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $code);
        return $stmt->execute();
    }
    
    
    public function resetPassword($username, $password, $code) {
        // Verificar si la cuenta existe
        if ($this->exists($username)) {
            // Verificar si el código de seguridad coincide
            $sql = "SELECT code FROM admin WHERE username = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
    
            if ($row && $row['code'] === $code) {
                // Actualizar la contraseña
                $updateSql = "UPDATE admin SET password = ? WHERE username = ?";
                $updateStmt = $this->mysqli->prepare($updateSql);
                $updateStmt->bind_param("ss", $password, $username);
                return $updateStmt->execute();
            } else {
                // Código de seguridad incorrecto
                return false;
            }
        }
        // Cuenta no encontrada
        return false;
    }
    

    public function exists($username) {
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>
