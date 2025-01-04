<?php
require 'database/db.php';
$query = $conn->query("SELECT * FROM leads");
$leads = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Lead Management System</h1>
    <a href="import.php" class="button">Import Leads</a>
    <a href="export.php" class="button">Export Leads</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($leads as $lead): ?>
            <tr>
                <td><?= $lead['id'] ?></td>
                <td><?= $lead['name'] ?></td>
                <td><?= $lead['email'] ?></td>
                <td><?= $lead['phone'] ?></td>
                <td><?= $lead['status'] ?></td>
                <td><?= $lead['date_added'] ?></td>
                <td><?= $lead['last_updated'] ?></td>
                <td>
                    <a href="manage.php?action=edit&id=<?= $lead['id'] ?>" class="button">Edit</a>
                    <a href="manage.php?action=delete&id=<?= $lead['id'] ?>" class="button" style="background-color: red;">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
