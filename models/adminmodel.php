<?php
class AdminModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDashboardStats()
    {
        try {
            $conn = $this->db->connect();
            $stats = [];

            // Consultas básicas (estas funcionan igual en PostgreSQL)
            $stats['total_citas'] = $conn->query("SELECT COUNT(*) FROM Cita")->fetchColumn();
            $stats['citas_pendientes'] = $conn->query("SELECT COUNT(*) FROM Cita WHERE est_cita = 'pendiente'")->fetchColumn();
            $stats['citas_completadas'] = $conn->query("SELECT COUNT(*) FROM Cita WHERE est_cita = 'completada'")->fetchColumn();
            $stats['citas_canceladas'] = $conn->query("SELECT COUNT(*) FROM Cita WHERE est_cita = 'cancelada'")->fetchColumn();
            $stats['total_medicos'] = $conn->query("SELECT COUNT(*) FROM Medico WHERE est_med = 'activo'")->fetchColumn();
            $stats['total_pacientes'] = $conn->query("SELECT COUNT(*) FROM Paciente")->fetchColumn();

            // Consulta adaptada para PostgreSQL (CURDATE() -> CURRENT_DATE, INTERVAL diferente)
            $query = $conn->query("
                SELECT DATE(h.fecha) as fecha, COUNT(c.id_cita) as cantidad
                FROM Cita c
                JOIN Horario h ON h.id_horario = c.id_horario
                WHERE h.fecha >= CURRENT_DATE - INTERVAL '7 days'
                GROUP BY DATE(h.fecha)
                ORDER BY h.fecha ASC
            ");
            $stats['citas_por_dia'] = $query->fetchAll(PDO::FETCH_ASSOC);

            // Debug: Agregar logs para verificar los datos
            error_log("Total citas: " . $stats['total_citas']);
            error_log("Citas pendientes: " . $stats['citas_pendientes']);
            error_log("Citas por día: " . json_encode($stats['citas_por_dia']));

            return $stats;
        } catch (PDOException $e) {
            error_log("AdminModel::getDashboardStats -> " . $e->getMessage());
            return [
                'total_citas' => 0,
                'citas_pendientes' => 0,
                'citas_completadas' => 0,
                'citas_canceladas' => 0,
                'total_medicos' => 0,
                'total_pacientes' => 0,
                'citas_por_dia' => []
            ];
        }
    }
}