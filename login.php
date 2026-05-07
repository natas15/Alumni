<?php
session_start();
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<!-- Log in formulier en een link naar de registratiepagina -->

<body>
    <?php include_once 'includes/nav.php'; ?>

    <div class="login-container">

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <h1>Inloggen</h1>
            <label class="auth-label" for="email">Email:</label>
            <input class="auth-input" type="email" id="email" name="email" maxlength="50" required>

            <label class="auth-label" for="wachtwoord">Wachtwoord:</label>
            <input class="auth-input" type="password" id="wachtwoord" name="wachtwoord" required>

            <button type="submit" class="auth-button">Inloggen</button>
            <p>Heeft u nog geen account? <a href="register.php">Registreer hier</a></p>
        </form>
    </div>
</body>

</html>