<?php
require 'database/db.php';
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $leadId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM leads WHERE id = ?");
    $stmt->execute([$leadId]);
    $lead = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$lead) {
        echo "Lead not found.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];
        if (empty($name) || empty($email) || empty($phone) || empty($status)) {
            echo "All fields are required.";
        } else {
            $updateStmt = $conn->prepare("UPDATE leads SET name = ?, email = ?, phone = ?, status = ?, last_updated = NOW() WHERE id = ?");
            $updateStmt->execute([$name, $email, $phone, $status, $leadId]);

            echo "Lead updated successfully!";
            header("Location: index.php"); 
            exit;
        }
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $leadId = $_GET['id'];
    $deleteStmt = $conn->prepare("DELETE FROM leads WHERE id = ?");
    $deleteStmt->execute([$leadId]);

    echo "Lead deleted successfully!";
    header("Location: index.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Lead</h1>
        <?php if (isset($lead)): ?>
            <form action="manage.php?action=edit&id=<?= $lead['id'] ?>" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $lead['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?= $lead['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" value="<?= $lead['phone'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" name="status" value="<?= $lead['status'] ?>" required>
                </div>
                <button type="submit" class="button">Update Lead</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
