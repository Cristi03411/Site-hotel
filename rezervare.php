<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    echo "Trebuie să fii autentificat pentru a face o rezervare.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $_SESSION['username'];
    $camera = $_POST['room'] ?? '';
    $check_in = $_POST['checkin'] ?? '';
    $check_out = $_POST['checkout'] ?? '';

    if (!empty($nume) && !empty($camera) && !empty($check_in) && !empty($check_out)) {
        $stmt = $conn->prepare("INSERT INTO rezervari (nume, camera, check_in, check_out) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nume, $camera, $check_in, $check_out);

        if ($stmt->execute()) {
            echo "Rezervare salvată cu succes!<br>";
            echo "<a href='index.html'>Înapoi la pagina principală</a>";
        } else {
            echo "Eroare la salvare: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<strong>Toate câmpurile sunt obligatorii!</strong>";
    }

    $conn->close();
} else {
    echo "Acces invalid.";
}
