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
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <!-- Styles -->
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
            <a href="/profile">Profil Saya</a>
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
                <strong><?= esc(user_display_name()) ?></strong>
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