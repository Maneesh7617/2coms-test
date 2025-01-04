<?php
require 'database/db.php';

$query = $conn->query("SELECT * FROM leads");
$leads = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="leads.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Status', 'Date Added', 'Last Updated']);

foreach ($leads as $lead) {
    fputcsv($output, $lead);
}
fclose($output);
exit;
?>
