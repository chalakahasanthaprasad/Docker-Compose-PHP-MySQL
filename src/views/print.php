<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/src/views/login.php'>Login here</a>";
    } else {

        if (isset($_SESSION['batch_data'])) {
            $batch_data = $_SESSION['batch_data'];
            $batch_code = $batch_data['batch_code'];
            $course_id = $batch_data['course_id'];
            $faculty_id = $batch_data['faculty_id'];
            $center_id = $batch_data['center_id'];
            $student_count = $batch_data['student_count'];
            $batch_year = $batch_data['batch_year'];
            $estart_date = $batch_data['estart_date'];
            $eend_date = $batch_data['eend_date'];
        } else {
            echo "No batch data available.";
            exit;
        }

        ?>

        <head>
            <link rel="stylesheet" href="../../assets/css/print.css">
        </head>

        <body>

            <div class="container">
                <h1>Batch Details</h1>

                <div class="detail-section">
                    <h2>Batch Information</h2>
                    <div class="detail-item"><span>Batch Code:</span> <?php echo $batch_code; ?></div>
                    <div class="detail-item"><span>Course ID:</span> <?php echo $course_id; ?></div>
                    <div class="detail-item"><span>Faculty ID:</span> <?php echo $faculty_id; ?></div>
                    <div class="detail-item"><span>Center ID:</span> <?php echo $center_id; ?></div>
                    <div class="detail-item"><span>Student Count:</span> <?php echo $student_count; ?></div>
                    <div class="detail-item"><span>Batch Year:</span> <?php echo $batch_year; ?></div>
                    <div class="detail-item"><span>Enrollment Start Date:</span> <?php echo $estart_date; ?></div>
                    <div class="detail-item"><span>Enrollment End Date:</span> <?php echo $eend_date; ?></div>
                </div>

                <button class="btn-print" onclick="window.print()">Print or Save as PDF</button>
            </div>

        </body>

        <?php
    }
}
?>


<?php include '../../includes/footer.php';


?>