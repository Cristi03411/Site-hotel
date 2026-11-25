<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Acces interzis.";
    exit();
}

require 'db.php';
$result = $conn->query("SELECT * FROM rezervari");
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rezervări</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: auto; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; text-align: center; }
        body { font-family: Arial, sans-serif; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Lista Rezervărilor</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Camera</th>
            <th>Check-in</th>
            <th>Check-out</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['nume']) ?></td>
            <td><?= htmlspecialchars($row['camera']) ?></td>
            <td><?= htmlspecialchars($row['check_in']) ?></td>
            <td><?= htmlspecialchars($row['check_out']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
