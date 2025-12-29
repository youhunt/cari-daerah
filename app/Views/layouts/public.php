<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'CariDaerah') ?></title>

    <meta name="description"
        content="<?= esc($meta['description'] ?? 'Cari daerah, kuliner, dan wisata Indonesia') ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO basic -->
    <link rel="canonical" href="<?= current_url() ?>">

    <!-- Open Graph (share) -->
    <meta property="og:title" content="<?= esc($title ?? '') ?>">
    <meta property="og:description" content="<?= esc($meta['description'] ?? '') ?>">
    <meta property="og:type" content="article">

    <style type="text/css">
        body {
            font-family: 'Inter', system-ui, sans-serif;
            margin: 0;
            background: #fafafa;
            color: #222;
        }

        .container {
            max-width: 980px;
            margin: auto;
            padding: 24px;
        }

        /* HEADER */
        .site-header {
            background: #fff;
            border-bottom: 1px solid #eee;
        }

        .header-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-weight: 700;
            font-size: 20px;
            text-decoration: none;
            color: #8B0000;
        }

        .brand img {
            height: 46px;
        }

        nav a {
            margin-left: 16px;
            text-decoration: none;
            color: #555;
        }

        nav a.active,
        nav a:hover {
            color: #8B0000;
        }

        /* SEARCH */
        .search-box {
            display: flex;
            gap: 12px;
            margin: 24px 0 32px;
        }

        .search-box input,
        .search-box select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .search-box input {
            flex: 1;
        }

        .search-box button {
            padding: 12px 20px;
            background: #8B0000;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        /* CARD */
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .card h2 {
            margin: 0 0 8px;
            font-size: 22px;
        }

        .card h2 a {
            text-decoration: none;
            color: #222;
        }

        .card h2 a:hover {
            color: #8B0000;
        }

        .card .meta {
            font-size: 13px;
            color: #777;
            margin-bottom: 12px;
        }

        /* FOOTER */
        .site-footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 24px 0;
        }
    </style>

</head>

<body>

    <header class="site-header">
        <div class="container header-wrap">
            <a href="/" class="brand"><img src="/assets/images/logo/logo.png" class="brand" alt="CariDaerah"></a>
            <h3>Daerah, Kuliner & Wisata</h3>
            <nav>
                <a href="/cari" class="active">Cari</a>
                <?php if (logged_in()): ?>
                    <a href="/dashboard">Dashboard</a>
                <?php else: ?>
                    <a href="/login">Masuk</a>
                <?php endif ?>
            </nav>
        </div>
    </header>

    <main class="container">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="site-footer">
        © <?= date('Y') ?> CariDaerah
    </footer>

</body>

</html>