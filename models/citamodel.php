<?php

class CitaModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        try {
            $query = $this->db->connect()->query("SELECT * FROM Cita");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("CitaModel::getAll -> " . $e->getMessage());
            return [];
        }
    }

    public function getAllWithDetails()
    {
        $query = "
        SELECT c.*, 
               CONCAT(p.nom_pac, ' ', p.ape_pac) as nombre_paciente,
               CONCAT(m.nom_med, ' - ', h.fecha, ' ', h.hora) as detalle_horario,
               CONCAT('Consultorio ', con.nro_con, ' - ', con.ubicacion) as nombre_consultorio,
               s.desc_serv
        FROM Cita c
        JOIN Paciente p ON c.id_pac = p.id_pac
        JOIN Horario h ON c.id_horario = h.id_horario
        JOIN Medico m ON h.id_med = m.id_med
        JOIN Consultorio con ON c.id_con = con.id_con
        JOIN Servicio s ON c.id_serv = s.id_serv
        ORDER BY h.fecha DESC, h.hora DESC
    ";
        return $this->db->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id)
    {
        try {
            $query = $this->db->connect()->prepare("SELECT * FROM Cita WHERE id_cita = :id");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("CitaModel::getById -> " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            $query = $this->db->connect()->prepare("INSERT INTO Cita (id_pac, id_horario, id_con, id_serv, est_cita) VALUES (:id_pac, :id_horario, :id_con, :id_serv, :est_cita)");
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("CitaModel::create -> " . $e->getMessage());
            return false;
        }
    }

    public function getPacientes()
    {
        $query = $this->db->connect()->query("SELECT id_pac, CONCAT(nom_pac, ' ', ape_pac) AS nombre FROM Paciente");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHorarios()
    {
        $query = $this->db->connect()->query("
        SELECT h.id_horario, CONCAT(m.nom_med, ' - ', h.fecha, ' ', h.hora) AS detalle 
        FROM Horario h 
        JOIN Medico m ON m.id_med = h.id_med
        WHERE h.est_horario = 'disponible'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConsultorios()
    {
        $query = $this->db->connect()->query("SELECT id_con, CONCAT('Consultorio ', nro_con, ' - ', ubicacion) AS nombre FROM Consultorio");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServicios()
    {
        $query = $this->db->connect()->query("SELECT id_serv, desc_serv FROM Servicio WHERE est_serv = 'activo'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE Cita 
            SET id_pac = :id_pac, id_horario = :id_horario, id_con = :id_con, id_serv = :id_serv, est_cita = :est_cita 
            WHERE id_cita = :id_cita";
        $query = $this->db->connect()->prepare($sql);
        return $query->execute($data);
    }

    public function delete($id)
    {
        $query = $this->db->connect()->prepare("DELETE FROM Cita WHERE id_cita = :id");
        return $query->execute(['id' => $id]);
    }
}
