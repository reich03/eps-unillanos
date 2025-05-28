<?php
class MainModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function getCitaById($id_cita)
    {
        try {
            $query = "
                SELECT c.*,
                       p.nom_pac, p.ape_pac, p.dni_pac, p.fec_pac,
                       m.nom_med, m.contacto_med,
                       e.nom_esp,
                       h.fecha, h.hora,
                       con.nro_con, con.ubicacion,
                       s.desc_serv, s.costo_serv,
                       CONCAT(p.nom_pac, ' ', p.ape_pac) as nombre_completo_paciente,
                       CONCAT('Consultorio ', con.nro_con, ' - ', con.ubicacion) as consultorio_completo,
                       CONCAT(m.nom_med, ' - ', e.nom_esp) as medico_especialidad
                FROM Cita c
                JOIN Paciente p ON c.id_pac = p.id_pac
                JOIN Horario h ON c.id_horario = h.id_horario
                JOIN Medico m ON h.id_med = m.id_med
                JOIN Especialidad e ON m.id_esp = e.id_esp
                JOIN Consultorio con ON c.id_con = con.id_con
                JOIN Servicio s ON c.id_serv = s.id_serv
                WHERE c.id_cita = :id_cita
            ";
            
            $stmt = $this->db->connect()->prepare($query);
            $stmt->execute(['id_cita' => $id_cita]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("MainModel::getCitaById -> " . $e->getMessage());
            return null;
        }
    }
    
    public function getCitasByPacienteDni($dni_paciente)
    {
        try {
            $query = "
                SELECT c.*,
                       p.nom_pac, p.ape_pac, p.dni_pac,
                       m.nom_med,
                       e.nom_esp,
                       h.fecha, h.hora,
                       con.nro_con, con.ubicacion,
                       s.desc_serv, s.costo_serv,
                       CONCAT(p.nom_pac, ' ', p.ape_pac) as nombre_completo_paciente,
                       CONCAT('Consultorio ', con.nro_con, ' - ', con.ubicacion) as consultorio_completo,
                       CONCAT(m.nom_med, ' - ', e.nom_esp) as medico_especialidad
                FROM Cita c
                JOIN Paciente p ON c.id_pac = p.id_pac
                JOIN Horario h ON c.id_horario = h.id_horario
                JOIN Medico m ON h.id_med = m.id_med
                JOIN Especialidad e ON m.id_esp = e.id_esp
                JOIN Consultorio con ON c.id_con = con.id_con
                JOIN Servicio s ON c.id_serv = s.id_serv
                WHERE p.dni_pac = :dni_paciente
                ORDER BY h.fecha DESC, h.hora DESC
            ";
            
            $stmt = $this->db->connect()->prepare($query);
            $stmt->execute(['dni_paciente' => $dni_paciente]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("MainModel::getCitasByPacienteDni -> " . $e->getMessage());
            return [];
        }
    }
    
    public function getEstadisticasGenerales()
    {
        try {
            $query = "
                SELECT 
                    (SELECT COUNT(*) FROM Cita) as total_citas,
                    (SELECT COUNT(*) FROM Cita WHERE est_cita = 'pendiente') as citas_pendientes,
                    (SELECT COUNT(*) FROM Cita WHERE est_cita = 'completada') as citas_completadas,
                    (SELECT COUNT(*) FROM Cita WHERE est_cita = 'cancelada') as citas_canceladas,
                    (SELECT COUNT(*) FROM Medico WHERE est_med = 'activo') as medicos_activos,
                    (SELECT COUNT(*) FROM Especialidad WHERE est_esp = 'activa') as especialidades_activas
            ";
            
            $stmt = $this->db->connect()->query($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("MainModel::getEstadisticasGenerales -> " . $e->getMessage());
            return null;
        }
    }
}