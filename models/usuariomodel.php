<?php
class UsuarioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        try {
            $query = $this->db->connect()->query("
                SELECT id_usuario, nom_usuario, ape_usuario, email_usuario, 
                       rol_usuario, est_usuario, fecha_creacion, ultimo_acceso
                FROM Usuario 
                ORDER BY fecha_creacion DESC
            ");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("UsuarioModel::getAll -> " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $query = $this->db->connect()->prepare("
                SELECT id_usuario, nom_usuario, ape_usuario, email_usuario, 
                       rol_usuario, est_usuario, fecha_creacion, ultimo_acceso
                FROM Usuario 
                WHERE id_usuario = :id
            ");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("UsuarioModel::getById -> " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            $query = $this->db->connect()->prepare("
                INSERT INTO Usuario (nom_usuario, ape_usuario, email_usuario, pass_usuario, rol_usuario, est_usuario) 
                VALUES (:nom_usuario, :ape_usuario, :email_usuario, :pass_usuario, :rol_usuario, :est_usuario)
            ");
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("UsuarioModel::create -> " . $e->getMessage());
            return false;
        }
    }

    public function update($data)
    {
        try {
            $sql = "UPDATE Usuario SET 
                    nom_usuario = :nom_usuario, 
                    ape_usuario = :ape_usuario, 
                    email_usuario = :email_usuario, 
                    rol_usuario = :rol_usuario, 
                    est_usuario = :est_usuario";

            if (isset($data['pass_usuario'])) {
                $sql .= ", pass_usuario = :pass_usuario";
            }

            $sql .= " WHERE id_usuario = :id_usuario";

            $query = $this->db->connect()->prepare($sql);
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("UsuarioModel::update -> " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = $this->db->connect()->prepare("
    UPDATE Sesion 
    SET activa = false 
    WHERE id_usuario = :id
"); 

            $query->execute(['id' => $id]);

            $query = $this->db->connect()->prepare("
                DELETE FROM Usuario 
                WHERE id_usuario = :id
            ");
            return $query->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("UsuarioModel::delete -> " . $e->getMessage());
            return false;
        }
    }

    public function emailExists($email, $excludeId = null)
    {
        try {
            $sql = "SELECT COUNT(*) FROM Usuario WHERE email_usuario = :email";
            $params = ['email' => $email];

            if ($excludeId) {
                $sql .= " AND id_usuario != :exclude_id";
                $params['exclude_id'] = $excludeId;
            }

            $query = $this->db->connect()->prepare($sql);
            $query->execute($params);
            return $query->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("UsuarioModel::emailExists -> " . $e->getMessage());
            return false;
        }
    }

    public function getStats()
    {
        try {
            $stats = [];

            $query = $this->db->connect()->query("SELECT COUNT(*) FROM Usuario");
            $stats['total'] = $query->fetchColumn();

            $query = $this->db->connect()->query("SELECT COUNT(*) FROM Usuario WHERE est_usuario = 'activo'");
            $stats['activos'] = $query->fetchColumn();

            $query = $this->db->connect()->query("
                SELECT rol_usuario, COUNT(*) as cantidad 
                FROM Usuario 
                GROUP BY rol_usuario
            ");
            $stats['por_rol'] = $query->fetchAll(PDO::FETCH_KEY_PAIR);

            $query = $this->db->connect()->query("
                SELECT CONCAT(nom_usuario, ' ', ape_usuario) as nombre, ultimo_acceso
                FROM Usuario 
                WHERE ultimo_acceso IS NOT NULL 
                ORDER BY ultimo_acceso DESC 
                LIMIT 5
            ");
            $stats['ultimos_accesos'] = $query->fetchAll(PDO::FETCH_ASSOC);

            return $stats;
        } catch (PDOException $e) {
            error_log("UsuarioModel::getStats -> " . $e->getMessage());
            return [];
        }
    }
}
