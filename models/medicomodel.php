<?php

class MedicoModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT m.*, e.nom_esp 
                FROM Medico m 
                JOIN Especialidad e ON m.id_esp = e.id_esp";
        return $this->db->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $query = $this->db->connect()->prepare(
                "INSERT INTO Medico (nom_med, id_esp, contacto_med, est_med) 
                 VALUES (:nom_med, :id_esp, :contacto_med, :est_med)"
            );
            return $query->execute($data);
        } catch (PDOException $e) {
            error_log("MedicoModel::create -> " . $e->getMessage());
            return false;
        }
    }

    public function getEspecialidades()
    {
        return $this->db->connect()->query("SELECT id_esp, nom_esp FROM Especialidad")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM Medico WHERE id_med = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE Medico SET nom_med = :nom_med, id_esp = :id_esp, contacto_med = :contacto_med, est_med = :est_med 
            WHERE id_med = :id_med";
        $query = $this->db->connect()->prepare($sql);
        return $query->execute($data);
    }

    public function delete($id)
    {
        $query = $this->db->connect()->prepare("DELETE FROM Medico WHERE id_med = :id");
        return $query->execute(['id' => $id]);
    }
}
