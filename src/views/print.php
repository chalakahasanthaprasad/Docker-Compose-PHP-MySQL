<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
} else {
    $now = time();
    require_once('../controllers/BatchController.php');

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/src/views/login.php'>Login here</a>";
    } else {
        ?>

        <div class="container">
            <h1>Batch Details</h1>

            <div class="detail-section">
                <h2>Batch Information</h2>

                <div class="detail-item"><span>Batch Code:</span> <?php echo htmlspecialchars($batch_code_v2); ?></div>
                <div class="detail-item"><span>Course ID:</span> <?php echo htmlspecialchars($course_id); ?></div>
                <div class="detail-item"><span>Faculty ID:</span> <?php echo htmlspecialchars($faculty_id); ?></div>
                <div class="detail-item"><span>Center ID:</span> <?php echo htmlspecialchars($center_id); ?></div>
                <div class="detail-item"><span>Student Count:</span> <?php echo htmlspecialchars($student_count); ?></div>
                <div class="detail-item"><span>Batch Year:</span> <?php echo htmlspecialchars($batch_year); ?></div>
                <div class="detail-item"><span>Enrollment Start Date:</span> <?php echo htmlspecialchars($estart_date); ?>
                </div>
                <div class="detail-item"><span>Enrollment End Date:</span> <?php echo htmlspecialchars($eend_date); ?></div>
            </div>

            <button class="btn-print" onclick="window.print()">Print or Save as PDF</button>
        </div>

        <?php
    }
}
?>


<?php include '../../includes/footer.php';


?>