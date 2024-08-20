<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Batch Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .detail-section {
            margin-bottom: 30px;
        }

        .detail-section h2 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-item span {
            font-weight: bold;
            color: #555;
        }

        .btn-print {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        @media print {
            .btn-print {
                display: none;
            }

            .container {
                box-shadow: none;
                margin: 0;
            }
        }
    </style>
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

</html>