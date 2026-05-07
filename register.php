<?php
session_start();
require 'db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $voornaam   = trim($_POST['voornaam'] ?? '');
    $achternaam = trim($_POST['achternaam'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $wachtwoord = $_POST['wachtwoord'] ?? '';
    $confirm    = $_POST['confirm_wachtwoord'] ?? '';

    // ── Lege velden ──────────────────────────────────────────────────────────
    if (
        empty($voornaam) || empty($achternaam) || empty($email) || empty($wachtwoord)
    ) {
        $error = "Vul alle velden in.";

        // ── Voornaam / Achternaam: alleen letters, spaties en koppeltekens, max 50 ─
    } elseif (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\s\-]{1,50}$/', $voornaam)) {
        $error = "Voornaam mag alleen letters bevatten (max. 50 tekens).";
    } elseif (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\s\-]{1,50}$/', $achternaam)) {
        $error = "Achternaam mag alleen letters bevatten (max. 50 tekens).";

        // ── E-mailadres ───────────────────────────────────────────────────────────
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
        $error = "Ongeldig e-mailadres (max. 100 tekens).";
        // ── Wachtwoord ────────────────────────────────────────────────────────────
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,72}$/', $wachtwoord)) {
        $error = "Wachtwoord moet minimaal 8 tekens bevatten met minstens één letter en één cijfer.";
    } elseif ($wachtwoord !== $confirm) {
        $error = "Wachtwoorden komen niet overeen.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT leerling_id FROM leerlingen WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $error = "Dit e-mailadres is al geregistreerd.";
            } else {
                $hashed = password_hash($wachtwoord, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("
                    INSERT INTO leerlingen (voornaam, achternaam, email, wachtwoord)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([$voornaam, $achternaam, $email, $hashed]);

                $success = "Account succesvol aangemaakt!";
            }
        } catch (PDOException $e) {
            $error = "Database fout: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'includes/nav.php'; ?>

    <div class="register-container">

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-card">
                <p class="success"><?= htmlspecialchars($success) ?></p>
                <a class="success-link" href="login.php">Ga naar login</a>
            </div>
        <?php else: ?>

        <form method="POST" class="auth-form" novalidate>
            <h1 class="auth-title">Registreren</h1>

            <!-- Voornaam -->
            <label class="auth-label" for="voornaam">Voornaam:</label>
            <input id="voornaam" class="auth-input" type="text"
                   name="voornaam" maxlength="50" required
                   value="<?= htmlspecialchars($_POST['voornaam'] ?? '') ?>">

            <!-- Achternaam -->
            <label class="auth-label" for="achternaam">Achternaam:</label>
            <input id="achternaam" class="auth-input" type="text"
                   name="achternaam" maxlength="50" required
                   value="<?= htmlspecialchars($_POST['achternaam'] ?? '') ?>">

            <!-- E-mail -->
            <label class="auth-label" for="email">E-mailadres:</label>
            <input id="email" class="auth-input" type="email"
                   name="email" maxlength="50" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

                <!-- Wachtwoord -->
                <label class="auth-label" for="wachtwoord">Wachtwoord:</label>
                <input id="wachtwoord" class="auth-input" type="password"
                    name="wachtwoord" maxlength="72" required>
                <small class="password-req length-req">• Minimaal 8 tekens</small>
                <small class="password-req number-req">• Minimaal 1 cijfer</small>

                <!-- Bevestig wachtwoord -->
                <label class="auth-label" for="confirm_wachtwoord">Bevestig wachtwoord:</label>
                <input id="confirm_wachtwoord" class="auth-input" type="password"
                    name="confirm_wachtwoord" maxlength="72" required>
                <small class="password-req match-req">• Wachtwoorden komen overeen</small>

                <button type="submit" class="auth-button">Registreren</button>
                <p>Heb je al een account? <a href="login.php">Login</a></p>
            </form>

        <?php endif; ?>
    </div>
</body>

</html>