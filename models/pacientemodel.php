<?php

class PacienteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        try {
            $query = $this->db->connect()->query("SELECT * FROM Paciente");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PacienteModel::getAll -> " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $query = $this->db->connect()->prepare("SELECT * FROM Paciente WHERE id_pac = :id");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PacienteModel::getById -> " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            $query = $this->db->connect()->prepare("INSERT INTO Paciente (nom_pac, ape_pac, dni_pac, fec_pac, est_pac) VALUES (:nom_pac, :ape_pac, :dni_pac, :fec_pac, :est_pac)");
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("PacienteModel::create -> " . $e->getMessage());
            return false;
        }
    }

    public function update($data)
    {
        try {
            $query = $this->db->connect()->prepare("UPDATE Paciente SET nom_pac = :nom_pac, ape_pac = :ape_pac, dni_pac = :dni_pac, fec_pac = :fec_pac, est_pac = :est_pac WHERE id_pac = :id_pac");
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("PacienteModel::update -> " . $e->getMessage());
            return false;
        }
    }

    public function delete($id, &$errorMessage = null)
    {
        try {
            $check = $this->db->connect()->prepare("
            SELECT COUNT(*) FROM Cita 
            WHERE id_pac = :id AND est_cita = 'pendiente'
        ");
            $check->execute(['id' => $id]);
            $count = $check->fetchColumn();

            if ($count > 0) {
                $errorMessage = "No se puede eliminar el paciente porque tiene citas pendientes";
                return false;
            }

            $query = $this->db->connect()->prepare("DELETE FROM Cita WHERE id_pac = :id");
            $query->execute(['id' => $id]);

            $query = $this->db->connect()->prepare("DELETE FROM Paciente WHERE id_pac = :id");
            return $query->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("PacienteModel::delete -> " . $e->getMessage());
            $errorMessage = "Error en la base de datos al eliminar paciente";
            return false;
        }
    }
}
