<?php

class HorarioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT h.*, m.nom_med 
                FROM Horario h 
                JOIN Medico m ON h.id_med = m.id_med";
        return $this->db->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $sql = "INSERT INTO Horario (id_med, fecha, hora, est_horario) 
                    VALUES (:id_med, :fecha, :hora, :est_horario)";
            $query = $this->db->connect()->prepare($sql);
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("HorarioModel::create -> " . $e->getMessage());
            return false;
        }
    }

    public function getMedicos()
    {
        return $this->db->connect()->query("SELECT id_med, nom_med FROM Medico WHERE est_med = 'activo'")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM Horario WHERE id_horario = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE Horario SET id_med = :id_med, fecha = :fecha, hora = :hora, est_horario = :est_horario
            WHERE id_horario = :id_horario";
        $query = $this->db->connect()->prepare($sql);
        return $query->execute($data);
    }

    public function delete($id)
    {
        $query = $this->db->connect()->prepare("DELETE FROM Horario WHERE id_horario = :id");
        return $query->execute(['id' => $id]);
    }

    public function checkConflicts($medicoId, $fecha, $hora, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM Horario 
            WHERE id_med = :medico_id 
            AND fecha = :fecha 
            AND hora = :hora";

        if ($excludeId) {
            $sql .= " AND id_horario != :exclude_id";
        }

        $query = $this->db->connect()->prepare($sql);
        $params = [
            'medico_id' => $medicoId,
            'fecha' => $fecha,
            'hora' => $hora
        ];

        if ($excludeId) {
            $params['exclude_id'] = $excludeId;
        }

        $query->execute($params);
        return $query->fetchColumn() > 0;
    }

    public function getAllWithMedicoInfo()
    {
        $sql = "SELECT h.*, m.nom_med, e.nom_esp 
            FROM Horario h 
            JOIN Medico m ON h.id_med = m.id_med 
            JOIN Especialidad e ON m.id_esp = e.id_esp 
            ORDER BY h.fecha DESC, h.hora ASC";

        return $this->db->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatistics()
    {
        $conn = $this->db->connect();
        $today = date('Y-m-d');

        return [
            'total' => $conn->query("SELECT COUNT(*) FROM Horario")->fetchColumn(),
            'disponibles' => $conn->query("SELECT COUNT(*) FROM Horario WHERE est_horario = 'disponible'")->fetchColumn(),
            'ocupados' => $conn->query("SELECT COUNT(*) FROM Horario WHERE est_horario = 'ocupado'")->fetchColumn(),
            'hoy' => $conn->query("SELECT COUNT(*) FROM Horario WHERE fecha = '$today'")->fetchColumn()
        ];
    }
}
