<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db.php';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$_POST['email'], $_POST['password']]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['user'] = $user['email'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<form method="post">
    <input name="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<?php if (!empty($error)) echo "<p>$error</p>"; ?>