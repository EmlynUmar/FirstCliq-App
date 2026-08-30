<?php
/**
 * Tester Account Creator for AGDATASUB
 * Run this file in your browser (e.g. http://localhost/AGDATASUB/C-Panel/mobile/create_tester.php)
 * to automatically register a tester account in your local database.
 */

// Database configuration (extracted from Model.php)
$host = "localhost";
$dbName = "dataflex_ag";
$username = "dataflex_ag";
$password = "@@080@@aZ-1";

// Tester credentials
$phone = "08012345678";
$pass_raw = "password123";
$pin = "1234";
$fname = "Tester";
$lname = "Account";
$email = "tester@agdatasub.com";
$state = "Lagos";

// Password hashing logic matching Account.php
$md5_hash = md5($pass_raw);
$sha1_hash = sha1($md5_hash);
$password_hash = substr($sha1_hash, 3, 10);

// API Key & verification code generation
$apiKey = substr(str_shuffle("0123456789ABCDEFGHIJklmnopqrstvwxyzAbAcAdAeAfAgAhBaBbBcBdC1C23C3C4C5C6C7C8C9xix2x3"), 0, 60).time();
$verCode = mt_rand(2000, 9000);

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester Account Creator</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: #0a1628;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 32px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            backdrop-filter: blur(8px);
        }
        h2 { margin-top: 0; color: #0a84ff; }
        .details {
            background: rgba(255, 255, 255, 0.05);
            padding: 16px;
            border-radius: 8px;
            text-align: left;
            margin: 20px 0;
            font-size: 14px;
        }
        .btn {
            background: #0a84ff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .btn:hover { background: #0070e3; }
        .error { color: #ff453a; }
        .success { color: #30d158; }
    </style>
</head>
<body>
    <div class="card">';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if table exists
    $stmt = $pdo->prepare("SELECT sId FROM subscribers WHERE sPhone = :phone");
    $stmt->execute([':phone' => $phone]);
    $user = $stmt->fetch();
    
    if ($user) {
        // Reset password, PIN, status and pre-load wallet balance
        $update = $pdo->prepare("UPDATE subscribers SET sPass = :pass, sPin = :pin, sRegStatus = 0, sWallet = 10000.00 WHERE sPhone = :phone");
        $update->execute([
            ':pass' => $password_hash,
            ':pin' => $pin,
            ':phone' => $phone
        ]);
        
        echo '<h2 class="success">Account Reset Successfully!</h2>';
        echo '<p>A tester account already existed and its credentials have been updated.</p>';
    } else {
        // Insert new subscriber with 10,000 wallet balance
        $insert = $pdo->prepare("INSERT INTO subscribers (
            sFname, sLname, sEmail, sPhone, sPass, sState, sType, sApiKey, sReferal, sPin, sVerCode, sRegStatus, sWallet, sRefWallet
        ) VALUES (
            :fname, :lname, :email, :phone, :pass, :state, '1', :apikey, '', :pin, :vercode, 0, 10000.00, 0.00
        )");
        
        $insert->execute([
            ':fname' => $fname,
            ':lname' => $lname,
            ':email' => $email,
            ':phone' => $phone,
            ':pass' => $password_hash,
            ':state' => $state,
            ':apikey' => $apiKey,
            ':pin' => $pin,
            ':vercode' => $verCode
        ]);
        
        echo '<h2 class="success">Account Created Successfully!</h2>';
        echo '<p>Your new tester account has been registered in the database.</p>';
    }
    
    echo '<div class="details">
        <strong>Login Credentials:</strong><br>
        • Phone: ' . $phone . '<br>
        • Password: ' . $pass_raw . '<br>
        • Transaction PIN: ' . $pin . '<br>
        • Wallet Balance: ₦10,000.00
    </div>';
    echo '<a href="../mobile/" class="btn">Proceed to Login</a>';

} catch (PDOException $e) {
    echo '<h2 class="error">Database Connection Error</h2>';
    echo '<p>Could not connect to the local database. Please ensure your Laragon MySQL server is running.</p>';
    echo '<div class="details" style="color: #ff453a;">' . htmlspecialchars($e->getMessage()) . '</div>';
    echo '<button onclick="window.location.reload();" class="btn">Retry Connection</button>';
}

echo '</div>
</body>
</html>';
?>
