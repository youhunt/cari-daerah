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
    <meta property="og:url" content="<?= current_url() ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($title ?? '') ?>">
    <meta name="twitter:description" content="<?= esc($meta['description'] ?? '') ?>">
    <?php if (!empty($heroPhoto['path'] ?? null)): ?>
        <meta name="twitter:image" content="<?= base_url($heroPhoto['path']) ?>">
    <?php endif ?>
    <link rel="stylesheet" href="/assets/css/public.css">

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