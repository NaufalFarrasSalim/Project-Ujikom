<?php
// --- Simulasi proses pendaftaran ---
$errors  = [];
$success = false;
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'daftar') {
    $nama     = trim($_POST['nama']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $telepon  = trim($_POST['telepon']  ?? '');
    $password = $_POST['password']      ?? '';
    $konfirmasi = $_POST['konfirmasi']  ?? '';
    $setuju   = isset($_POST['setuju']);
 
    // Validasi
    if (empty($nama))     $errors['nama']     = "Nama lengkap wajib diisi.";
    if (empty($email))    $errors['email']    = "Email wajib diisi.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format email tidak valid.";
    if (empty($telepon))  $errors['telepon']  = "Nomor telepon wajib diisi.";
    if (strlen($password) < 6) $errors['password'] = "Kata sandi minimal 6 karakter.";
    if ($password !== $konfirmasi) $errors['konfirmasi'] = "Kata sandi dan konfirmasi tidak cocok.";
    if (!$setuju) $errors['setuju'] = "Anda harus menyetujui syarat & ketentuan.";
 
    if (empty($errors)) {
        // Di sini biasanya INSERT ke database
        $success = true;
    }
}
 
function old($field, $default = '') {
    return htmlspecialchars($_POST[$field] ?? $default);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun – Holland Bakery</title>
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
        header { background: var(--white); box-shadow: 0 2px 5px rgba(0,0,0,.08); position: sticky; top: 0; z-index: 100; }
        nav { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 15px 24px; }
        .logo { font-size: 22px; font-weight: 800; color: var(--primary); text-decoration: none; }
        .nav-links a { text-decoration: none; color: var(--text); margin-left: 20px; font-weight: 600; font-size: .95rem; transition: color .2s; }
        .nav-links a:hover { color: var(--primary); }
        .nav-links a.active { color: var(--primary); border-bottom: 2px solid var(--primary); }
 
        /* ── LAYOUT ──────────────────────────────────────── */
        .page-wrap {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: calc(100vh - 57px);
        }
 
        /* Panel kiri */
        .panel-left {
            background:
                linear-gradient(135deg, rgba(255,111,0,.88) 0%, rgba(230,81,0,.92) 100%),
                url('https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=900&q=80') center/cover no-repeat;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 60px 50px; color: var(--white); text-align: center;
        }
        .panel-left .brand-icon { font-size: 64px; margin-bottom: 20px; }
        .panel-left h2 { font-size: 2rem; font-weight: 800; line-height: 1.2; margin-bottom: 14px; }
        .panel-left p  { font-size: 1rem; opacity: .88; max-width: 320px; line-height: 1.6; }
 
        /* Benefit list */
        .benefit-list { margin-top: 36px; text-align: left; width: 100%; max-width: 300px; }
        .benefit-item { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; font-size: .95rem; }
        .benefit-item .icon { font-size: 1.4rem; }
 
        /* Panel kanan */
        .panel-right {
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 50px 40px;
            overflow-y: auto;
        }
        .form-box { width: 100%; max-width: 440px; }
        .form-box h1 { font-size: 1.75rem; font-weight: 800; margin-bottom: 6px; }
        .form-box .subtitle { color: var(--muted); font-size: .95rem; margin-bottom: 28px; }
 
        /* Alert sukses */
        .alert-success {
            padding: 16px; border-radius: var(--radius);
            background: #e8f5e9; color: var(--success);
            border-left: 4px solid var(--success);
            margin-bottom: 20px; font-weight: 600;
            line-height: 1.6;
        }
 
        /* Input group */
        .input-group { margin-bottom: 18px; }
        .input-group label { display: block; font-size: .85rem; font-weight: 700; margin-bottom: 7px; }
        .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
 
        .input-group input[type="text"],
        .input-group input[type="email"],
        .input-group input[type="tel"],
        .input-group input[type="password"] {
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
        .input-group input.is-error { border-color: var(--error); }
        .field-error { font-size: .78rem; color: var(--error); margin-top: 5px; font-weight: 600; }
 
        /* Password strength */
        .strength-bar { height: 4px; border-radius: 4px; background: var(--border); margin-top: 8px; overflow: hidden; }
        .strength-fill { height: 100%; width: 0; border-radius: 4px; transition: width .4s, background .4s; }
 
        /* Checkbox */
        .check-group { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 22px; }
        .check-group input[type="checkbox"] { margin-top: 3px; accent-color: var(--primary); width: 16px; height: 16px; flex-shrink: 0; }
        .check-group label { font-size: .87rem; color: var(--muted); line-height: 1.5; }
        .check-group label a { color: var(--primary); text-decoration: none; font-weight: 700; }
        .check-group label a:hover { text-decoration: underline; }
 
        /* Tombol */
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
        .divider { display: flex; align-items: center; gap: 12px; margin: 24px 0; color: var(--muted); font-size: .85rem; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
 
        .login-link { text-align: center; font-size: .92rem; color: var(--muted); }
        .login-link a { color: var(--primary); font-weight: 700; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }
 
        /* Footer */
        footer { background: #333; color: #ccc; text-align: center; padding: 18px; font-size: .85rem; }
 
        /* Responsive */
        @media (max-width: 768px) {
            .page-wrap { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 40px 20px; }
            .input-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
 
<header>
    <nav>
        <a href="bakery.php" class="logo">HOLLAND BAKERY 🍞</a>
        <div class="nav-links">
            <a href="bakery.php">Beranda</a>
            <a href="index.php#menu">Menu</a>
            <a href="login.php">Masuk</a>
            <a href="daftar.php" class="active">Daftar</a>
        </div>
    </nav>
</header>
 
<div class="page-wrap">
 
    <!-- Panel Kiri -->
    <div class="panel-left">
        <div class="brand-icon">🍰</div>
        <h2>Bergabung dengan Keluarga Holland Bakery</h2>
        <p>Daftar gratis dan nikmati berbagai keuntungan sebagai anggota setia kami.</p>
 
        <div class="benefit-list">
            <div class="benefit-item"><span class="icon">🎁</span> Diskon 10% untuk pembelian pertama</div>
            <div class="benefit-item"><span class="icon">📦</span> Lacak pesanan secara real-time</div>
            <div class="benefit-item"><span class="icon">⭐</span> Kumpulkan poin reward setiap transaksi</div>
            <div class="benefit-item"><span class="icon">🔔</span> Notifikasi promo eksklusif member</div>
        </div>
    </div>
 
    <!-- Panel Kanan -->
    <div class="panel-right">
        <div class="form-box">
            <h1>Buat Akun Baru</h1>
            <p class="subtitle">Sudah punya akun? <a href="login.php" style="color:var(--primary);font-weight:700;">Masuk di sini →</a></p>
 
            <?php if ($success): ?>
                <div class="alert-success">
                    🎉 <strong>Pendaftaran berhasil!</strong><br>
                    Akun Anda telah dibuat. <a href="login.php" style="color:var(--success);">Masuk sekarang →</a>
                </div>
            <?php endif; ?>
 
            <?php if (!$success): ?>
            <form method="POST" action="daftar.php" id="formDaftar">
                <input type="hidden" name="action" value="daftar">
 
                <!-- Nama -->
                <div class="input-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama"
                           placeholder="Contoh: Budi Santoso"
                           value="<?= old('nama') ?>"
                           class="<?= isset($errors['nama']) ? 'is-error' : '' ?>">
                    <?php if (isset($errors['nama'])): ?>
                        <div class="field-error">⚠ <?= $errors['nama'] ?></div>
                    <?php endif; ?>
                </div>
 
                <!-- Email & Telepon -->
                <div class="input-row">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                               placeholder="nama@email.com"
                               value="<?= old('email') ?>"
                               class="<?= isset($errors['email']) ? 'is-error' : '' ?>">
                        <?php if (isset($errors['email'])): ?>
                            <div class="field-error">⚠ <?= $errors['email'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="input-group">
                        <label for="telepon">No. Telepon</label>
                        <input type="tel" id="telepon" name="telepon"
                               placeholder="08xxxxxxxxxx"
                               inputmode="numeric"
                               value="<?= old('telepon') ?>"
                               class="<?= isset($errors['telepon']) ? 'is-error' : '' ?>">
                        <?php if (isset($errors['telepon'])): ?>
                            <div class="field-error">⚠ <?= $errors['telepon'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
 
                <!-- Password -->
                <div class="input-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password"
                           placeholder="Minimal 6 karakter"
                           class="<?= isset($errors['password']) ? 'is-error' : '' ?>"
                           oninput="cekKekuatan(this.value)">
                    <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                    <?php if (isset($errors['password'])): ?>
                        <div class="field-error">⚠ <?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>
 
                <!-- Konfirmasi Password -->
                <div class="input-group">
                    <label for="konfirmasi">Konfirmasi Kata Sandi</label>
                    <input type="password" id="konfirmasi" name="konfirmasi"
                           placeholder="Ulangi kata sandi"
                           class="<?= isset($errors['konfirmasi']) ? 'is-error' : '' ?>">
                    <?php if (isset($errors['konfirmasi'])): ?>
                        <div class="field-error">⚠ <?= $errors['konfirmasi'] ?></div>
                    <?php endif; ?>
                </div>
 
                <!-- Checkbox S&K -->
                <div class="check-group">
                    <input type="checkbox" id="setuju" name="setuju"
                           <?= isset($_POST['setuju']) ? 'checked' : '' ?>>
                    <label for="setuju">
                        Saya setuju dengan <a href="#">Syarat & Ketentuan</a> serta
                        <a href="#">Kebijakan Privasi</a> Holland Bakery.
                    </label>
                </div>
                <?php if (isset($errors['setuju'])): ?>
                    <div class="field-error" style="margin-top:-16px;margin-bottom:16px;">⚠ <?= $errors['setuju'] ?></div>
                <?php endif; ?>
 
                <button type="submit" class="btn-primary">Buat Akun Sekarang</button>
            </form>
            <?php endif; ?>
 
            <div class="divider">atau</div>
            <div class="login-link">Sudah punya akun? <a href="login.php">Masuk</a></div>
        </div>
    </div>
 
</div>
 
<footer>
    <p>&copy; 2023 Holland Bakery. All Rights Reserved. &nbsp;|&nbsp; Jl. Bread Street No. 123, Jakarta</p>
</footer>
 
<script>
// Indikator kekuatan password
function cekKekuatan(val) {
    const bar = document.getElementById('strengthFill');
    let kekuatan = 0;
    if (val.length >= 6)  kekuatan++;
    if (val.length >= 10) kekuatan++;
    if (/[A-Z]/.test(val)) kekuatan++;
    if (/[0-9]/.test(val)) kekuatan++;
    if (/[^A-Za-z0-9]/.test(val)) kekuatan++;
 
    const peta = [
        { w: '0%',   bg: 'transparent' },
        { w: '25%',  bg: '#ef5350' },
        { w: '50%',  bg: '#000000' },
        { w: '75%',  bg: '#ffee58' },
        { w: '90%',  bg: '#66bb6a' },
        { w: '100%', bg: '#2e7d32' },
    ];
    bar.style.width      = peta[kekuatan].w;
    bar.style.background = peta[kekuatan].bg;
}
</script>
 
</body>
</html>