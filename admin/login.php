<?php
session_start();
include_once '../config/config.php';

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = false;
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['admin_id'] = $row['id_user'];
            $_SESSION['admin_nama'] = $row['nama_lengkap'];

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SDN Dukuhbenda 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="login-body">

<div class="container">
    <div class="login-card mx-auto text-center">
        <img src="../assets/img/logo.png" alt="Logo">
        <h4 class="fw-bold mb-1" style="color: #1e3d59;">Panel Admin</h4>
        <p class="text-muted small mb-4">SDN Dukuhbenda 02</p>

        <?php if ($error) : ?>
            <div class="alert alert-danger py-2 small">Username atau password salah!</div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Username</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-login"><i class="fas fa-user"></i></span>
                    <input type="text" name="username" class="form-control form-control-login border-start-0" placeholder="Username" required>
                </div>
            </div>
            <div class="mb-4 text-start">
                <label class="form-label small fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-login"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control form-control-login border-start-0" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" name="login" class="btn btn-login w-100 mb-3">MASUK SEKARANG</button>
            <a href="../index.php" class="text-decoration-none small text-muted"><i class="fas fa-arrow-left me-1"></i> Kembali ke Website</a>
        </form>
    </div>
</div>

</body>
</html>