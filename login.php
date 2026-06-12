<?php
// --- Simulasi proses login ---
$error_login = "";
$success_login = "";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
 
    // Data user dummy (simulasi database)
    $users_db = [
        ['email' => 'user@hollandbakery.com', 'password' => 'roti123', 'nama' => 'Budi Santoso'],
    ];
 
    $found = false;
    foreach ($users_db as $u) {
        if ($u['email'] === $email && $u['password'] === $password) {
            $found = true;
            $success_login = "Selamat datang kembali, <strong>" . htmlspecialchars($u['nama']) . "</strong>! 🎉";
            break;
        }
    }
 
    if (!$found) {
        $error_login = "Email atau kata sandi salah. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk – Holland Bakery</title>
    <style>
        :root {
            --primary:   #ff6f00;
            --primary-d: #e65100;
            --secondary: #fdd835;
            --bg:        #fffbf0;
            --text:      #2b2b2b;
            --muted:     #777;
            --border:    #e8e0d0;
            --white:     #ffffff;
            --error:     #d32f2f;
            --success:   #2e7d32;
            --radius:    12px;
        }
 
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
 
        /* ── NAV ─────────────────────────────────────────── */
        header {
            background: var(--white);
            box-shadow: 0 2px 5px rgba(0,0,0,.08);
            position: sticky; top: 0; z-index: 100;
        }
        nav {
            max-width: 1200px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 24px;
        }
        .logo { font-size: 22px; font-weight: 800; color: var(--primary); text-decoration: none; }
        .nav-links a {
            text-decoration: none; color: var(--text); margin-left: 20px;
            font-weight: 600; font-size: .95rem; transition: color .2s;
        }
        .nav-links a:hover { color: var(--primary); }
        .nav-links a.active { color: var(--primary); border-bottom: 2px solid var(--primary); }
 
        /* ── LAYOUT UTAMA ────────────────────────────────── */
        .page-wrap {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: calc(100vh - 57px);
        }
 
        /* Panel kiri – ilustrasi / branding */
        .panel-left {
            background:
                linear-gradient(135deg, rgba(255,111,0,.85) 0%, rgba(230,81,0,.9) 100%),
                url('https://images.unsplash.com/photo-1509440159596-0249088772ff?w=900&q=80') center/cover no-repeat;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 60px 50px; color: var(--white); text-align: center;
        }
        .panel-left .brand-icon { font-size: 64px; margin-bottom: 20px; }
        .panel-left h2 { font-size: 2rem; font-weight: 800; line-height: 1.2; margin-bottom: 14px; }
        .panel-left p  { font-size: 1rem; opacity: .88; max-width: 320px; line-height: 1.6; }
        .panel-left .tagline {
            margin-top: 40px; background: rgba(255,255,255,.15);
            border-radius: 50px; padding: 10px 22px;
            font-size: .85rem; letter-spacing: .5px; font-weight: 600;
        }
 
        /* Panel kanan – form */
        .panel-right {
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 60px 40px;
        }
        .form-box {
            width: 100%; max-width: 420px;
        }
 
        .form-box h1 { font-size: 1.75rem; font-weight: 800; margin-bottom: 6px; }
        .form-box .subtitle { color: var(--muted); font-size: .95rem; margin-bottom: 32px; }
 
        /* Alert */
        .alert {
            padding: 12px 16px; border-radius: 8px;
            margin-bottom: 20px; font-size: .9rem; font-weight: 600;
        }
        .alert-error   { background: #fdecea; color: var(--error); border-left: 4px solid var(--error); }
        .alert-success { background: #e8f5e9; color: var(--success); border-left: 4px solid var(--success); }
 
        /* Input group */
        .input-group { margin-bottom: 20px; }
        .input-group label {
            display: block; font-size: .85rem; font-weight: 700;
            margin-bottom: 7px; color: var(--text);
        }
        .input-group input {
            width: 100%; padding: 12px 16px;
            border: 1.5px solid var(--border); border-radius: var(--radius);
            font-size: .95rem; background: var(--white); color: var(--text);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255,111,0,.15);
        }
 
        .forgot { text-align: right; margin-top: -12px; margin-bottom: 20px; }
        .forgot a { font-size: .82rem; color: var(--primary); text-decoration: none; font-weight: 600; }
        .forgot a:hover { text-decoration: underline; }
 
        /* Tombol utama */
        .btn-primary {
            width: 100%; padding: 13px;
            background: var(--primary); color: var(--white);
            border: none; border-radius: 50px;
            font-size: 1rem; font-weight: 700; cursor: pointer;
            transition: background .2s, transform .15s;
        }
        .btn-primary:hover { background: var(--primary-d); transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }
 
        /* Divider */
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 28px 0; color: var(--muted); font-size: .85rem;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }
 
        /* Link ke daftar */
        .register-link {
            text-align: center; font-size: .92rem; color: var(--muted);
        }
        .register-link a {
            color: var(--primary); font-weight: 700; text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }
 
        /* Demo hint */
        .demo-hint {
            margin-top: 24px; padding: 12px 16px;
            background: #fff8e1; border-radius: 8px;
            font-size: .8rem; color: #6d4c41; border: 1px dashed var(--secondary);
        }
        .demo-hint strong { color: var(--primary-d); }
 
        /* ── FOOTER ──────────────────────────────────────── */
        footer {
            background: #333; color: #ccc;
            text-align: center; padding: 18px;
            font-size: .85rem;
        }
 
        /* ── RESPONSIVE ──────────────────────────────────── */
        @media (max-width: 768px) {
            .page-wrap { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 40px 24px; }
        }
    </style>
</head>
<body>
 
<!-- Header -->
<header>
    <nav>
        <a href="bakery.php" class="logo">HOLLAND BAKERY 🍞</a>
        <div class="nav-links">
            <a href="bakery.php">Beranda</a>
            <a href="index.php#menu">Menu</a>
            <a href="login.php" class="active">Masuk</a>
            <a href="daftar.php">Daftar</a>
        </div>
    </nav>
</header>
 
<!-- Konten Utama -->
<div class="page-wrap">
 
    <!-- Panel Kiri -->
    <div class="panel-left">
        <div class="brand-icon">🥐</div>
        <h2>Selamat Datang di Holland Bakery</h2>
        <p>Nikmati roti segar setiap hari. Masuk untuk melihat pesanan, menyimpan favorit, dan mendapat penawaran eksklusif.</p>
        <div class="tagline">Baked with love since 1978 ✨</div>
    </div>
 
    <!-- Panel Kanan -->
    <div class="panel-right">
        <div class="form-box">
            <h1>Masuk</h1>
            <p class="subtitle">Belum punya akun? <a href="daftar.php" style="color:var(--primary);font-weight:700;">Daftar sekarang →</a></p>
 
            <?php if ($error_login): ?>
                <div class="alert alert-error">⚠️ <?= $error_login ?></div>
            <?php endif; ?>
 
            <?php if ($success_login): ?>
                <div class="alert alert-success">✅ <?= $success_login ?></div>
            <?php endif; ?>
 
            <form method="POST" action="login.php">
                <input type="hidden" name="action" value="login">
 
                <div class="input-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email" id="email" name="email"
                        placeholder="nama@email.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        required
                    >
                </div>
 
                <div class="input-group">
                    <label for="password">Kata Sandi</label>
                    <input
                        type="password" id="password" name="password"
                        placeholder="Masukkan kata sandi"
                        required
                    >
                </div>
 
                <div class="forgot"><a href="#">Lupa kata sandi?</a></div>
 
                <button type="submit" class="btn-primary">Masuk ke Akun</button>
            </form>
 
            <div class="divider">atau</div>
 
            <div class="register-link">
                Belum punya akun? <a href="daftar.php">Daftar gratis</a>
            </div>
 
            <!-- Hint demo -->
            <div class="demo-hint">
                🧪 <strong>Demo:</strong> Gunakan email <strong>user@gmail.com</strong>
                dan kata sandi <strong>12345678</strong> untuk mencoba login.
            </div>
        </div>
    </div>
 
</div>
 
<footer>
    <p>&copy; 2023 Holland Bakery. All Rights Reserved. &nbsp;|&nbsp; Jl. Bread Street No. 123, Jakarta</p>
</footer>
 
</body>
</html>