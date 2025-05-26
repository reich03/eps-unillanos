<?php

class ConsultorioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT c.*, e.nom_esp 
                FROM Consultorio c
                JOIN Especialidad e ON c.id_esp = e.id_esp";
        return $this->db->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO Consultorio (nro_con, id_esp, ubicacion) 
                VALUES (:nro_con, :id_esp, :ubicacion)";
        $query = $this->db->connect()->prepare($sql);
        return $query->execute($data);
    }

    public function getEspecialidades()
    {
        return $this->db->connect()->query("SELECT id_esp, nom_esp FROM Especialidad")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM Consultorio WHERE id_con = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE Consultorio SET nro_con = :nro_con, id_esp = :id_esp, ubicacion = :ubicacion 
            WHERE id_con = :id_con";
        $query = $this->db->connect()->prepare($sql);
        return $query->execute($data);
    }

    public function delete($id)
    {
        $query = $this->db->connect()->prepare("DELETE FROM Consultorio WHERE id_con = :id");
        return $query->execute(['id' => $id]);
    }
}
