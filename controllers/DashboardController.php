<?php
require_once BASE_PATH . '/controllers/BaseCrudController.php';
require_once BASE_PATH . '/models/MatriculaModel.php';
require_once BASE_PATH . '/models/MateriaModel.php';
require_once BASE_PATH . '/models/DocenteModel.php';
require_once BASE_PATH . '/models/AlumnoModel.php';

class DashboardController extends BaseCrudController
{
    private $matriculaModel;
    private $materiaModel;
    private $docenteModel;
    private $alumnoModel;

    public function __construct()
    {
        $this->matriculaModel = new MatriculaModel();
        $this->materiaModel = new MateriaModel();
        $this->docenteModel = new DocenteModel();
        $this->alumnoModel = new AlumnoModel();
    }

    public function index()
    {
        $this->requireAuth();
        $this->view('dashboard/index', array());
    }

    // JSON endpoints
    public function matriculasByMateria()
    {
        $this->requireAuth();
        $sql = "SELECT mt.nombre AS label, COUNT(*) AS value FROM matriculas m INNER JOIN materias mt ON mt.id = m.materia_id GROUP BY mt.id ORDER BY value DESC";
        $rows = $this->matriculaModel->pdo->query($sql)->fetchAll();
        $labels = array(); $data = array();
        foreach ($rows as $r) { $labels[] = $r['label']; $data[] = (int)$r['value']; }
        header('Content-Type: application/json');
        echo json_encode(array('labels' => $labels, 'data' => $data));
        exit;
    }

    public function alumnosByDocente()
    {
        $this->requireAuth();
        $sql = "SELECT d.nombre || ' ' || d.apellido AS label, COUNT(DISTINCT m.alumno_id) AS value FROM matriculas m INNER JOIN docentes d ON d.id = m.docente_id GROUP BY d.id ORDER BY value DESC";
        // SQLite style || may not work on MySQL; use CONCAT for MySQL
        $sql = "SELECT CONCAT(d.nombre, ' ', d.apellido) AS label, COUNT(DISTINCT m.alumno_id) AS value FROM matriculas m INNER JOIN docentes d ON d.id = m.docente_id GROUP BY d.id ORDER BY value DESC";
        $rows = $this->matriculaModel->pdo->query($sql)->fetchAll();
        $labels = array(); $data = array();
        foreach ($rows as $r) { $labels[] = $r['label']; $data[] = (int)$r['value']; }
        header('Content-Type: application/json');
        echo json_encode(array('labels' => $labels, 'data' => $data));
        exit;
    }

    public function creditsByMateria()
    {
        $this->requireAuth();
        $sql = "SELECT mt.nombre AS label, COALESCE(SUM(mt.creditos),0) AS value FROM materias mt LEFT JOIN matriculas m ON m.materia_id = mt.id GROUP BY mt.id ORDER BY value DESC";
        $rows = $this->matriculaModel->pdo->query($sql)->fetchAll();
        $labels = array(); $data = array();
        foreach ($rows as $r) { $labels[] = $r['label']; $data[] = (int)$r['value']; }
        header('Content-Type: application/json');
        echo json_encode(array('labels' => $labels, 'data' => $data));
        exit;
    }

    public function matriculasRecent()
    {
        $this->requireAuth();
        // últimos 30 días
        $sql = "SELECT DATE(fecha_matricula) AS day, COUNT(*) AS value FROM matriculas WHERE fecha_matricula >= DATE_SUB(CURDATE(), INTERVAL 29 DAY) GROUP BY day ORDER BY day ASC";
        $rows = $this->matriculaModel->pdo->query($sql)->fetchAll();
        $labels = array(); $data = array();
        foreach ($rows as $r) { $labels[] = $r['day']; $data[] = (int)$r['value']; }
        header('Content-Type: application/json');
        echo json_encode(array('labels' => $labels, 'data' => $data));
        exit;
    }
}
