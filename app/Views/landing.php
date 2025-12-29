<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>CariDaerah – Cari Daerah, Kuliner & Wisata Lokal Indonesia</title>
    <meta name="description" content="CariDaerah membantu kamu cari daerah, kuliner khas, wisata lokal, dan cerita daerah di seluruh Indonesia langsung dari warga setempat.">

    <meta name="keywords" content="cari daerah, cari kuliner, cari wisata, informasi daerah, kuliner lokal, wisata lokal Indonesia">

    <meta name="robots" content="index, follow">
    <meta name="author" content="CariDaerah">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="/assets/favicon/favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="/assets/favicon/favicon.svg">
    <link rel="apple-touch-icon" href="/assets/favicon/apple-touch-icon.png">

    <!-- Web App / PWA -->
    <link rel="manifest" href="/assets/favicon/site.webmanifest">

    <!-- Optional but recommended -->
    <meta name="theme-color" content="#C40000">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #8B5E34;
            --secondary: #D9B382;
            --accent: #2F5D50;
            --bg: #FAF7F2;
            --text: #2E2E2E;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        /* NAVBAR */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(250, 247, 242, 0.95);
            backdrop-filter: blur(6px);
            padding: 18px 0;
        }

        .nav-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: .5px;
        }

        .logo img {
            height: 54px;
            width: auto;
            display: block;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand span {
            font-weight: 600;
            font-size: 18px;
            color: #8B0000;
            /* merah tua */
        }

        .nav-links a {
            margin-left: 24px;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        /* HERO */
        .hero {
            padding: 110px 0 90px;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            max-width: 720px;
            margin: 0 auto 32px;
            font-size: 18px;
            color: #555;
        }

        .hero-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 500;
            transition: .3s;
        }

        .btn-primary:hover {
            background: #704727;
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 10px 28px;
            border-radius: 30px;
            font-weight: 500;
            transition: .3s;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: #fff;
        }

        /* SECTION */
        section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-title h2 {
            font-size: 36px;
        }

        .section-title p {
            margin-top: 12px;
            color: #666;
        }

        /* CATEGORY */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }


        .category-card {
            background: #fff;
            border-radius: 20px;
            padding: 32px 24px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
            transition: transform .3s;
        }

        .category-card:hover {
            transform: translateY(-6px);
        }

        .category-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 16px;
        }

        .category-icon img {
            width: 172px;
            height: auto;
            transition: transform .3s ease;
        }

        .category-card:hover .category-icon img {
            transform: translateY(-6px) scale(1.05);
        }

        /* WHY */
        .why-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            text-align: center;
        }

        .why-item {
            padding: 24px;
            background: #fff;
            border-radius: 20px;
            padding: 32px 24px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
            transition: transform .3s;
        }

        .why-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 16px;
        }

        .why-icon img {
            width: 250px;
            height: auto;
            transition: transform .3s ease;
        }

        .why-item:hover .why-icon img {
            transform: translateY(-6px) scale(1.05);
        }

        /* CTA */
        .cta {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 26px;
            padding: 70px 30px;
            text-align: center;
            color: #fff;
        }

        .cta h2 {
            color: #fff;
            font-size: 36px;
            margin-bottom: 12px;
        }

        .cta p {
            max-width: 600px;
            margin: 0 auto 28px;
            color: #eee;
        }

        .cta .btn-primary {
            background: #fff;
            color: var(--primary);
        }

        /* FOOTER */
        footer {
            padding: 40px 0;
            text-align: center;
            color: #777;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 900px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .category-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container nav-wrap">
            <div class="logo brand">
                <img src="/assets/images/logo/logo.png" alt="CariDaerah">
                <span>CariDaerah</span>
            </div>
            <nav class="nav-links">
                <a href="/">Beranda</a>
                <a href="/cari">Cari</a>
                <a href="/tentang">Tentang</a>

                <?php if (logged_in()): ?>
                    <a href="/dashboard" class="btn-primary">Dashboard</a>
                <?php else: ?>
                    <a href="/login">Masuk</a>
                <?php endif ?>
            </nav>

        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Cari Daerah, Kuliner, dan Wisata di Seluruh Indonesia</h1>
            <p>
                CariDaerah membantu kamu menemukan <strong>kuliner khas</strong>,
                <strong>wisata lokal</strong>, dan <strong>cerita daerah</strong>
                langsung dari warga setempat di berbagai wilayah Indonesia.
            </p>

            <div class="hero-actions">
                <?php if (logged_in()): ?>
                    <a href="/dashboard" class="btn-primary">Ke Dashboard</a>
                <?php else: ?>
                    <a href="/cerita" class="btn-primary">Jelajahi Cerita</a>
                    <a href="/register" class="btn-outline">Jadi Kontributor</a>
                <?php endif ?>
            </div>
        </div>
    </section>

    <!-- CATEGORY -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Apa yang Bisa Kamu Cari di CariDaerah?</h2>
                <p>
                    Temukan informasi lokal, rekomendasi, dan cerita daerah
                    yang membantu kamu mengenal suatu wilayah lebih dekat.
                </p>
            </div>

            <div class="category-grid">

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/images/categories/kategori_01_kuliner.png" alt="Kuliner">
                    </div>
                    <h3>Kuliner</h3>
                    <p>Cari kuliner khas daerah, makanan tradisional, dan rekomendasi tempat makan lokal.</p>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/images/categories/kategori_02_wisata.png" alt="Wisata">
                    </div>
                    <h3>Wisata</h3>
                    <p>Cari wisata alam, budaya, dan destinasi menarik dari berbagai daerah di Indonesia.</p>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/images/categories/kategori_03_adat.png" alt="Adat & Budaya">
                    </div>
                    <h3>Adat & Budaya</h3>
                    <p>Cari informasi adat istiadat, tradisi, dan kearifan lokal tiap daerah.</p>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/images/categories/kategori_04_sejarah.png" alt="Sejarah">
                    </div>
                    <h3>Sejarah</h3>
                    <p>Cari sejarah lokal, asal-usul daerah, dan cerita masa lalu yang jarang diketahui.</p>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/images/categories/kategori_05_event.png" alt="Event">
                    </div>
                    <h3>Event</h3>
                    <p>Cari event daerah, perayaan daerah, festival, dan agenda lokal yang sedang berlangsung.</p>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/images/categories/kategori_06_info.png" alt="Informasi Umum">
                    </div>
                    <h3>Informasi Umum</h3>
                    <p>Cari informasi penting seputar wilayah, fasilitas, dan kehidupan lokal.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- WHY -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Kenapa CariDaerah?</h2>
            </div>

            <div class="why-grid">

                <div class="why-item">
                    <div class="why-icon">
                        <img src="/assets/images/why/why_01.png" alt="Dari Warga Lokal">
                    </div>
                    <h3>Dari Warga Lokal</h3>
                    <p>
                        Informasi dan cerita ditulis langsung oleh warga yang tinggal
                        dan mengenal daerahnya.
                    </p>
                </div>

                <div class="why-item">
                    <div class="why-icon">
                        <img src="/assets/images/why/why_02.png" alt="Berbasis Wilayah">
                    </div>
                    <h3>Berbasis Wilayah</h3>
                    <p>
                        Data terstruktur dari provinsi hingga desa, memudahkan kamu
                        mencari daerah secara spesifik.
                    </p>
                </div>

                <div class="why-item">
                    <div class="why-icon">
                        <img src="/assets/images/why/why_03.png" alt="Terbuka dan Kolaboratif">
                    </div>
                    <h3>Terbuka & Kolaboratif</h3>
                    <p>
                        Siapa pun bisa berbagi cerita, rekomendasi kuliner,
                        dan informasi wisata daerah.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section>
        <div class="container">
            <div class="cta">
                <h2>Punya Cerita atau Rekomendasi Daerahmu?</h2>
                <p>
                    Bagikan cerita, kuliner, atau wisata daerahmu di CariDaerah
                    dan bantu orang lain menemukan keunikan wilayahmu.
                </p>

                <a href="/register" class="btn-primary">Mulai Berkontribusi</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            © <?= date('Y') ?> CariDaerah · Dari Daerah untuk Indonesia
        </div>
    </footer>

</body>

</html>