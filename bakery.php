<?php
$produk = [
    [
        "nama" => "Croissant Butter",
        "harga" => "Rp 27.000",
        "gambar" => "https://tedboycnd-cdhwdbg6ard6f4cp.z01.azurefd.net/images/thumbs/0009553_butter-croissant.png", 
        "deskripsi" => "Kue kering mentega asli importing."
    ],
    [
        "nama" => "Berry Cheesecake",
        "harga" => "Rp 35.000",
        "gambar" => "https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=500&q=80",
        "deskripsi" => "Kue cheesecake dengan topping buah segar."
    ],
    [
        "nama" => "Artisan Bread",
        "harga" => "Rp 20.000",
        "gambar" => "https://images.unsplash.com/photo-1509440159596-0249088772ff?w=500&q=80",
        "deskripsi" => "Roti artisan gandum."
    ],
    [
        "nama" => "Choco Donut",
        "harga" => "Rp 7.500",
        "gambar" => "https://kreamz.in/wp-content/uploads/2023/12/chocolaste-donut.webp",
        "deskripsi" => "Donat Jerman dengan cokelat premium."
    ],
    [
        "nama" => "Fruit Tart",
        "harga" => "Rp 25.000",
        "gambar" => "https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80",
        "deskripsi" => "Tartbuah dengan cream vanilla lembut."
    ],
    [
        "nama" => "Croissant Almond",
        "harga" => "Rp 27.500",
        "gambar" => "https://badbatchbaking.com/wp-content/uploads/2024/12/easy-almond-croissant-recipe-20.jpg",
        "deskripsi" => "Croissant taburan almond panggang."
    ],
];
?>
 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holland Bakery - Lezatnya Roti Segar</title>
    <style>
        :root {
            --primary: #727072;
            --secondary: #535352;
            --text: #333;
            --bg: #fffbf0;
        }
 
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg);
            color: var(--text);
        }
 
        /* ── NAVIGASI ─────────────────────────────────── */
        header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
 
        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }
 
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary);
            text-decoration: none;
        }
 
        /* Grup kiri: link navigasi biasa */
        .menu {
            display: flex;
            align-items: center;
            gap: 4px;
        }
 
        .menu a {
            text-decoration: none;
            color: var(--text);
            padding: 8px 14px;
            font-weight: 600;
            border-radius: 6px;
            transition: color 0.2s, background 0.2s;
        }
 
        .menu a:hover {
            color: var(--primary);
            background: #fff3e0;
        }
 
        /* Grup kanan: tombol Login & Daftar */
        .nav-auth {
            display: flex;
            align-items: center;
            gap: 10px;
        }
 
        /* Tombol Masuk – outline */
        .btn-masuk {
            text-decoration: none;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: background 0.2s, color 0.2s;
        }
 
        .btn-masuk:hover {
            background: var(--primary);
            color: white;
        }
 
        /* Tombol Daftar – solid */
        .btn-daftar {
            text-decoration: none;
            color: white;
            background: var(--primary);
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: background 0.2s, transform 0.15s;
        }
 
        .btn-daftar:hover {
            background: #e65100;
            transform: translateY(-1px);
        }
 
        /* ── HERO ─────────────────────────────────────── */
        .hero {
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                              url('https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1600&q=80');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
 
        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
 
        .btn-pesan {
            background-color: var(--primary);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: transform 0.2s;
        }
 
        .btn-pesan:hover {
            transform: scale(1.05);
            background-color: #e65100;
        }
 
        /* ── PRODUK ───────────────────────────────────── */
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }
 
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: var(--primary);
            font-size: 2rem;
        }
 
        .grid-produk {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
 
        .card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
 
        .card:hover { transform: translateY(-5px); }
 
        .card-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
 
        .card-body { padding: 20px; }
 
        .card-title {
            font-size: 1.2rem;
            margin: 0 0 10px 0;
            font-weight: bold;
        }
 
        .card-price {
            color: var(--primary);
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: block;
        }
 
        .card-desc {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.4;
        }
 
        /* ── FOOTER ───────────────────────────────────── */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
 
        /* ── RESPONSIVE ───────────────────────────────── */
        @media (max-width: 768px) {
            nav { flex-wrap: wrap; gap: 10px; }
            .menu { display: none; } /* sembunyikan link tengah di HP */
            .nav-auth { margin-left: auto; }
            .hero-content h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
 
    <!-- Header / Navigasi -->
    <header>
        <nav>
            <!-- Logo -->
            <a href="index.php" class="logo">HOLLAND BAKERY </a>
 
            <!-- Menu Tengah -->
            <div class="menu">
                <a href="index.php">Beranda</a>
                <a href="#menu">Menu</a>
                <a href="#">Tentang Kami</a>
            </div>
 
            <!-- Tombol Login & Daftar -->
            <div class="nav-auth">
                <a href="login.php" class="btn-masuk">Masuk</a>
                <a href="daftar.php" class="btn-daftar">Daftar</a>
            </div>
        </nav>
    </header>
 
    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <h1>Lezatnya Roti Segar Setiap Hari</h1>
            <p>Baked with love and premium ingredients.</p>
            <br>
            <a href="#menu" class="btn-pesan">Lihat Menu</a>
        </div>
    </section>
 
    <!-- Produk -->
    <section id="menu" class="container">
        <h2 class="section-title">Pilihan Menu Kami</h2>
 
        <div class="grid-produk">
            <?php foreach($produk as $item): ?>
                <div class="card">
                    <img src="<?php echo $item['gambar']; ?>"
                         alt="<?php echo $item['nama']; ?>"
                         class="card-img">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $item['nama']; ?></h3>
                        <span class="card-price"><?php echo $item['harga']; ?></span>
                        <p class="card-desc"><?php echo $item['deskripsi']; ?></p>
                        <a href="login.php"
                           style="color:var(--primary); text-decoration:none; font-weight:bold;">
                            Tambah ke Keranjang &rarr;
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
 
    <!-- Footer -->
    <footer>
        <p>+628123456789<p>
        <p>&copy; 2023 Holland Bakery Clone. All Rights Reserved.</p>
        <p>Jl. Bread Street No. 123, Jakarta</p>
    </footer>
 
</body>
</html>