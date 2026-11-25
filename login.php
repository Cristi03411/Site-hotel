<?php
session_start();
require 'db.php'; 

$eroare = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $_POST['username'];
    $este_admin = isset($_POST['admin']);

    if ($este_admin) {
        $parola = $_POST['password'] ?? '';

        if ($nume === "Admin" && $parola === "adminul") {
            $_SESSION['username'] = "Admin";
            $_SESSION['role'] = "admin";
            header("Location: rezervari.php");
            exit();
        } else {
            $eroare = "Datele de admin sunt incorecte!";
        }
    } elseif (!empty($nume)) {
        $_SESSION['username'] = $nume;
        $_SESSION['role'] = "guest";

        
        $_SESSION['username'] = $nume;
$_SESSION['role'] = "guest";

header("Location: index.html"); 
exit();
    } else {
        $eroare = "Introduceți un nume.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="login.css" />
  <title>Login</title>
  <script>
    window.addEventListener("DOMContentLoaded", function () {
      const adminCheckbox = document.getElementById("admin");
      const passwordInput = document.querySelector('input[name="password"]');

      function togglePasswordField() {
        passwordInput.disabled = !adminCheckbox.checked;
        if (!adminCheckbox.checked) {
          passwordInput.value = '';
        }
      }

      adminCheckbox.addEventListener("change", togglePasswordField);
      togglePasswordField(); 
    });
  </script>
</head>
<body>
  <form method="POST">
    <div class="login-box">
      <div class="login-header">
        <header>Login</header>
      </div>

      <div class="input-box">
        <input type="text" name="username" class="input-field" placeholder="Your name" autocomplete="off" required />
      </div>

      <div class="input-box">
        <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" />
      </div>

      <div class="forgot">
        <section>
          <input type="checkbox" name="admin" id="admin" <?php echo isset($_POST['admin']) ? 'checked' : ''; ?> />
          <label for="admin">I am an admin</label>
        </section>
      </div>

      <div class="input-submit">
        <button type="submit" class="submit-btn" id="submit"></button>
        <label for="submit">Autentificare</label>
      </div>

      <div class="sign-up-link">
        <p>You do not have an accound? Continue as Guest</p>
      </div>

      <?php if (!empty($eroare)) echo "<p class='error-message'>$eroare</p>"; ?>
    </div>
  </form>
</body>
</html>

