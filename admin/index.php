
<?php
session_start();
require_once __DIR__ . '/includes/config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if ($email && $password) {
        $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            // Check password using password_verify for hashed passwords
            if (password_verify($password, $row['password']) || $password === $row['password']) {
                $_SESSION['admin_id'] = $row['id'];
                header('Location: dashboard');
                exit;
            } else {
                $error = 'Invalid password.';
            }
        } else {
            $error = 'User not found.';
        }
    } else {
        $error = 'Please enter email and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; }
        .login-container { max-width: 400px; margin: 100px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 40px 30px; }
        .login-title { font-size: 1.7rem; font-weight: 600; margin-bottom: 25px; color: #232f3e; text-align: center; }
        .error { color: #c0392b; margin-bottom: 18px; text-align: center; }
        .admin-form input { width: 100%; padding: 10px 12px; margin-bottom: 18px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 1rem; background: #f9f9f9; }
        .admin-btn { background: #232f3e; color: #fff; border: none; padding: 10px 22px; border-radius: 4px; font-size: 1rem; cursor: pointer; width: 100%; }
        .admin-btn:hover { background: #1a2226; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-title">Admin Login</div>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" class="admin-form">
            <input type="email" name="email" placeholder="Email" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="admin-btn">Login</button>
        </form>
    </div>
</body>
</html>
