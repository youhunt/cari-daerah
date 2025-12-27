<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Dashboard · CeritaDaerah') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #F4F4F4;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #2F5D50;
            color: #fff;
            min-height: 100vh;
            padding: 24px;
        }

        .sidebar h2 {
            font-family: 'Playfair Display', serif;
            margin-bottom: 32px;
        }

        .sidebar a {
            display: block;
            padding: 12px 10px;
            border-radius: 8px;
            margin-bottom: 6px;
            color: #fff;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, .15);
        }

        /* MAIN */
        .main {
            flex: 1;
            padding: 32px;
        }

        .header {
            background: #fff;
            padding: 18px 24px;
            border-radius: 14px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            background: #fff;
            padding: 28px;
            border-radius: 16px;
        }

        /* FORM */
        label {
            display: block;
            margin-top: 16px;
            font-weight: 500;
        }

        input,
        textarea,
        select {
            width: 100%;
            margin-top: 6px;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-family: inherit;
        }

        textarea {
            resize: vertical;
        }

        button {
            margin-top: 24px;
            background: #8B5E34;
            color: #fff;
            border: none;
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 500;
            cursor: pointer;
        }

        button:hover {
            background: #704727;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>CeritaDaerah</h2>

        <a href="/dashboard">Dashboard</a>
        <a href="/konten">Konten Saya</a>
        <a href="/konten/create">Tulis Cerita</a>

        <?php if (in_groups('administrator')): ?>
            <hr>
            <a href="/admin/dashboard">Admin Dashboard</a>
            <a href="/admin/moderasi">Moderasi</a>
        <?php endif ?>

        <hr>
        <a href="/logout">Keluar</a>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <div class="header">
            <div>
                <strong><?= user()->username ?></strong><br>
                <small><?= implode(', ', user()->getGroups()) ?></small>
            </div>
            <div><?= date('l, d M Y') ?></div>
        </div>

        <!-- INI ISI HALAMAN -->
        <?= $this->renderSection('content') ?>

    </main>

</body>

</html>