<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'CariDaerah') ?></title>
    <!-- Favicon -->
    <link rel="icon" href="/assets/favicon/favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="/assets/favicon/favicon.svg">
    <link rel="apple-touch-icon" href="/assets/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <meta name="theme-color" content="#C40000">

    <meta name="description"
          content="<?= esc($meta['description'] ?? 'Cari daerah, kuliner, dan wisata Indonesia') ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <link rel="canonical" href="<?= current_url() ?>">
    <meta property="og:title" content="<?= esc($title ?? '') ?>">
    <meta property="og:description" content="<?= esc($meta['description'] ?? '') ?>">
    <meta property="og:type" content="article">
    <?php if (!empty($heroPhoto['path'] ?? null)): ?>
        <meta property="og:image" content="<?= base_url($heroPhoto['path']) ?>">
    <?php endif ?>

    <style>
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
            margin: 24px 0 16px;
            background: #fff;
            padding: 16px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,.05);
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
            box-shadow: 0 10px 30px rgba(0,0,0,.05);
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

        .meta {
            font-size: 13px;
            color: #777;
            margin-bottom: 12px;
        }

        .badge {
            background: #8B0000;
            color: #fff;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        /* DETAIL PAGE */
        .content-detail {
            max-width: 720px;
            margin: 0 auto;
        }

        .content-header h1 {
            font-size: 36px;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .content-summary {
            font-size: 18px;
            line-height: 1.6;
            color: #444;
            margin-bottom: 32px;
        }

        .content-body {
            font-size: 17px;
            line-height: 1.8;
        }

        .content-body p {
            margin-bottom: 20px;
        }

        .content-body img {
            max-width: 100%;
            border-radius: 12px;
            margin: 24px 0;
        }

        /* FOOTER */
        .site-footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 24px 0;
        }

        .muted {
            color: #666;
        }

        .content-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 16px;
            font-size: 14px;
            color: #666;
        }

        .info-left,
        .info-right {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .info-left .badge {
            align-self: flex-start;
        }

        .info-left .region {
            font-size: 13px;
            color: #555;
        }

        .info-right {
            text-align: right;
        }

        .info-right .author {
            font-weight: 600;
            color: #333;
        }

        .info-right .date {
            font-size: 12px;
            color: #888;
        }

        @media (max-width: 640px) {
            .content-info {
                flex-direction: column;
                gap: 8px;
            }

            .info-right {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<header class="site-header">
    <div class="container header-wrap">
        <a href="/" class="brand">
            <img src="/assets/images/logo/logo.png" alt="CariDaerah">
        </a>

        <nav>
            <a href="/cari" class="active">Cari</a>
            <?php if (function_exists('logged_in') && logged_in()): ?>
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
    © <?= date('Y') ?> CariDaerah · Dari Daerah untuk Indonesia
</footer>

</body>
</html>
