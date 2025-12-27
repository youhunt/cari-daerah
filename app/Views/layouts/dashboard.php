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

        <nav>
            <a href="/dashboard" class="active">Dashboard</a>
            <a href="/konten">Konten Saya</a>
            <a href="/konten/create">Tulis Konten</a>

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
                <span><?= implode(', ', user()->getGroups()) ?></span>
            </div>
            <div class="date">
                <?= date('l, d M Y') ?>
            </div>
        </header>

        <?= $this->renderSection('content') ?>

    </main>

</body>

</html>