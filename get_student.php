<?php
try {
    $host = $_SERVER['SERVER_NAME']; 
    if ($host === 'localhost') {
        $pdo = new PDO('mysql:host=localhost;dbname=zeit', 'root', '');
    } else {
        $pdo = new PDO('mysql:host=localhost;dbname=nsucms_cms', 'usernsucms_cms', 'Nsuraja83013@#');
    }
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_GET['grade_id'])) {
        $grade_id = $_GET['grade_id'];
        $sql = "SELECT * FROM tbl_students WHERE student_grade_id = :grade_id";
        $query = $pdo->prepare($sql);
        $query->execute([':grade_id' => $grade_id]);
        $attendanceData = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($attendanceData);
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
