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

    public function createAccount($username, $password) {
        $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        return $stmt->execute();
    }

    public function resetPassword($username, $password) {
        if ($this->exists($username)) {
            $sql = "UPDATE admin SET password = ? WHERE username = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ss", $password, $username);
            return $stmt->execute();
        }
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
