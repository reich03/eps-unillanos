<?php
class AuthModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener usuario por email
    public function getUserByEmail($email)
    {
        try {
            $query = $this->db->connect()->prepare("
                SELECT * FROM Usuario 
                WHERE email_usuario = :email
            ");
            $query->execute(['email' => $email]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("AuthModel::getUserByEmail -> " . $e->getMessage());
            return null;
        }
    }

    // Crear sesión
    public function createSession($data)
    {
        try {
            $query = $this->db->connect()->prepare("
                INSERT INTO Sesion (id_usuario, token_sesion, fecha_expiracion, ip_address, user_agent) 
                VALUES (:id_usuario, :token_sesion, :fecha_expiracion, :ip_address, :user_agent)
            ");
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("AuthModel::createSession -> " . $e->getMessage());
            return false;
        }
    }

    public function validateSession($token, $userId)
    {
        try {
            $query = $this->db->connect()->prepare("
            SELECT s.*, u.est_usuario 
            FROM Sesion s
            JOIN Usuario u ON s.id_usuario = u.id_usuario
            WHERE s.token_sesion = :token 
            AND s.id_usuario = :user_id 
            AND s.activa = TRUE
            AND s.fecha_expiracion > NOW()
            AND u.est_usuario = 'activo'
        ");
            $query->execute(['token' => $token, 'user_id' => $userId]);
            return $query->fetch(PDO::FETCH_ASSOC) !== false;
        } catch (PDOException $e) {
            error_log("AuthModel::validateSession -> " . $e->getMessage());
            return false;
        }
    }

    public function destroySession($token)
    {
        try {
            $query = $this->db->connect()->prepare("
                UPDATE Sesion 
                SET activa = 0 
                WHERE token_sesion = :token
            ");
            return $query->execute(['token' => $token]);
        } catch (PDOException $e) {
            error_log("AuthModel::destroySession -> " . $e->getMessage());
            return false;
        }
    }

    public function cleanExpiredSessions()
    {
        try {
            $query = $this->db->connect()->prepare("
                UPDATE Sesion 
                SET activa = 0 
                WHERE fecha_expiracion < NOW()
            ");
            return $query->execute();
        } catch (PDOException $e) {
            error_log("AuthModel::cleanExpiredSessions -> " . $e->getMessage());
            return false;
        }
    }

    public function getUserActiveSessions($userId)
    {
        try {
            $query = $this->db->connect()->prepare("
                SELECT * FROM Sesion 
                WHERE id_usuario = :user_id 
                AND activa = 1 
                AND fecha_expiracion > NOW()
                ORDER BY fecha_inicio DESC
            ");
            $query->execute(['user_id' => $userId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("AuthModel::getUserActiveSessions -> " . $e->getMessage());
            return [];
        }
    }
}
