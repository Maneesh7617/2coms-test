<?php
require 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
    $fileName = $_FILES['excel_file']['tmp_name'];
    $fileOriginalName = $_FILES['excel_file']['name'];
    $fileExtension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
    if ($fileExtension !== 'csv') {
        echo "Invalid file format. Please upload a CSV file.";
        exit;
    }
    $file = fopen($fileName, 'r');
    $success = 0;
    $failed = 0;
    fgetcsv($file);

    // Read the CSV file
    while (($row = fgetcsv($file, 1000, ",")) !== false) {
        if (count($row) < 4) {
            continue;
        }
        $name = $row[0];
        $email = $row[1];
        $phone = $row[2];
        $status = $row[3];

        if (empty($name) || empty($email) || empty($phone) || empty($status)) {
            $failed++;
            continue;
        }

        try {
            $stmt = $conn->prepare("INSERT INTO leads (name, email, phone, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $status]);
            $success++;
        } catch (PDOException $e) {
            $failed++;
        }
    }

    fclose($file);
    echo "Import completed: $success success, $failed failed.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Import Leads</h1>
        <form action="import.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="excel_file" required>
            <button type="submit" class="button">Upload</button>
        </form>
    </div>
</body>

</html>
