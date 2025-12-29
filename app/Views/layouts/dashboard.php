<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Dashboard · CariDaerah') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="/assets/favicon/favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="/assets/favicon/favicon.svg">
    <link rel="apple-touch-icon" href="/assets/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <meta name="theme-color" content="#C40000">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        :root {
            --primary: #C40000;
            --primary-dark: #8B0000;
            --bg: #F5F5F5;
            --card: #FFFFFF;
            --text: #2E2E2E;
            --muted: #777;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: var(--card);
            border-right: 1px solid #eee;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 32px;
        }

        .sidebar-brand img {
            height: 36px;
        }

        .sidebar-brand span {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            color: var(--text);
            font-weight: 500;
            margin-bottom: 6px;
            text-decoration: none;
        }

        .sidebar nav a.active,
        .sidebar nav a:hover {
            background: rgba(196, 0, 0, 0.08);
            color: var(--primary);
        }

        .sidebar hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 16px 0;
        }

        /* MAIN */
        .main {
            flex: 1;
            padding: 32px;
        }

        .header {
            background: var(--card);
            padding: 18px 24px;
            border-radius: 14px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .user {
            display: flex;
            flex-direction: column;
        }

        .header .user strong {
            font-size: 14px;
        }

        .header .user span {
            font-size: 12px;
            color: var(--muted);
        }

        .card {
            background: var(--card);
            border-radius: 16px;
            padding: 24px;
        }

        /* GRID & STATS */
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat {
            padding: 24px;
            border-radius: 16px;
            background: var(--card);
            border-left: 5px solid var(--primary);
        }

        .stat h2 {
            margin: 0;
            font-size: 32px;
            color: var(--primary);
        }

        .stat p {
            margin: 6px 0 0;
            color: var(--muted);
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
            font-size: 14px;
        }

        th {
            color: var(--muted);
            font-weight: 600;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 999px;
            background: var(--primary);
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        .page-header {
            margin-bottom: 24px;
        }

        .muted {
            color: #777;
            margin-top: 4px;
        }

        .content-form {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-weight: 500;
            font-size: 14px;
        }

        input,
        textarea,
        select {
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 16px;
        }

        .ck-editor {
            width: 100%;
        }

        .ck-editor__editable {
            min-height: 420px;
        }

        #sidebar-menu a.active {
            background: #8B0000;
            color: #fff;
            border-radius: 8px;
        }

        .breadcrumb {
            margin-bottom: 16px;
            font-size: 14px;
            color: #777;
        }

        .breadcrumb a {
            color: #8B0000;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .active {
            color: #333;
            font-weight: 500;
        }

        .breadcrumb .sep {
            margin: 0 6px;
            color: #aaa;
        }


        /* RESPONSIVE */
        @media (max-width: 900px) {
            .form-grid-2 {
                grid-template-columns: 1fr;
            }
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                display: none;
            }

            .grid-3 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="/assets/images/logo/logo.png" alt="CariDaerah">
            <span>CariDaerah</span>
        </div>

        <nav id="sidebar-menu">
            <a href="/dashboard">Dashboard</a>
            <a href="/konten">Konten Saya</a>

            <?php if (in_groups('administrator')): ?>
                <hr>
                <a href="/admin/moderasi">Moderasi</a>
                <a href="/admin/users">Pengguna</a>
            <?php endif ?>

            <hr>
            <a href="/logout">Keluar</a>
        </nav>


    </aside>

    <!-- MAIN -->
    <main class="main">

        <header class="header">
            <div class="user">
                <strong><?= esc(user()->username) ?></strong>
                <span><?= implode(', ', user()->getRoles()) ?></span>
            </div>
            <div class="date">
                <?= date('l, d M Y') ?>
            </div>
        </header>
        <?php if (!empty($breadcrumb)): ?>
            <nav class="breadcrumb">
                <?php foreach ($breadcrumb as $i => $item): ?>
                    <?php if ($item['url']): ?>
                        <a href="<?= $item['url'] ?>">
                            <?= esc($item['label']) ?>
                        </a>
                    <?php else: ?>
                        <span class="active"><?= esc($item['label']) ?></span>
                    <?php endif ?>

                    <?php if ($i < count($breadcrumb) - 1): ?>
                        <span class="sep">›</span>
                    <?php endif ?>
                <?php endforeach ?>
            </nav>
        <?php endif ?>

        <?= $this->renderSection('content') ?>

    </main>
    <?= $this->renderSection('div-modal') ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?= $this->renderSection('scripts') ?>

    <script>
        (function() {
            const currentPath = window.location.pathname.replace(/\/$/, '');

            document.querySelectorAll('#sidebar-menu a').forEach(link => {
                const linkPath = link.getAttribute('href').replace(/\/$/, '');

                if (
                    currentPath === linkPath ||
                    (linkPath !== '/' && currentPath.startsWith(linkPath))
                ) {
                    link.classList.add('active');
                }
            });
        })();
    </script>


</body>

</html>