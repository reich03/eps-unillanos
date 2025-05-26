<?php

class ServicioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->connect()->query("SELECT * FROM Servicio")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO Servicio (desc_serv, costo_serv, est_serv) 
                VALUES (:desc_serv, :costo_serv, :est_serv)";
        $query = $this->db->connect()->prepare($sql);
        return $query->execute($data);
    }

    public function getById($id)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM Servicio WHERE id_serv = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE Servicio SET desc_serv = :desc_serv, costo_serv = :costo_serv, est_serv = :est_serv 
            WHERE id_serv = :id_serv";
        $query = $this->db->connect()->prepare($sql);
        return $query->execute($data);
    }

    public function delete($id)
    {
        $query = $this->db->connect()->prepare("DELETE FROM Servicio WHERE id_serv = :id");
        return $query->execute(['id' => $id]);
    }
}
