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
            $course_name = $batch_data['course_name'];
            $faculty_id = $batch_data['faculty_id'];
            $faculty_name = $batch_data['faculty_name'];
            $center_id = $batch_data['center_id'];
            $center_name = $batch_data['center_name'];
            $course_type = $batch_data['course_type'];
            $batch_year = $batch_data['batch_year'];
            $estart_date = $batch_data['estart_date'];
            $eend_date = $batch_data['eend_date'];
        } else {
            echo "No batch data available.";
            exit;
        }

        ?>

        <head>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../../assets/css/print.css">
        </head>

        <body>

            <div class="container">
                <h1>Batch Details</h1>

                <div class="detail-section">
                    <h2>Batch Information</h2>
                    <div class="detail-item"><span>Batch Code:</span> <?php echo $batch_code; ?></div>
                    <div class="detail-item"><span>Course Name:</span> <?php echo $course_name; ?></div>
                    <div class="detail-item"><span>Faculty Name:</span> <?php echo $faculty_name; ?></div>
                    <div class="detail-item"><span>Center Name:</span> <?php echo $center_name; ?></div>
                    <div class="detail-item"><span>Course Type:</span> <?php echo $course_type; ?></div>
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