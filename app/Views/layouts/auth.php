<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'CariDaerah') ?></title>
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
            --bg: #FAF7F2;
            --text: #2E2E2E;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
        }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* LEFT BRAND */
        .auth-brand {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            padding: 72px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
        }

        .brand img {
            height: 96px;
            width: auto;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-text strong {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            line-height: 1.2;
        }

        .brand-text span {
            font-size: 14px;
            opacity: .9;
        }

        .auth-brand p {
            font-size: 18px;
            max-width: 420px;
            line-height: 1.6;
            opacity: .95;
        }

        /* RIGHT FORM */
        .auth-form {
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 48px;
        }

        .card {
            width: 100%;
            max-width: 420px;
        }

        h2 {
            margin: 0 0 24px;
            color: var(--primary);
            font-size: 26px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 14px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
        }

        button {
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 999px;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            margin-top: 8px;
        }

        button:hover {
            background: var(--primary-dark);
        }

        .links {
            margin-top: 18px;
            text-align: center;
            font-size: 14px;
        }

        .links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .links a:hover {
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .auth-wrapper {
                grid-template-columns: 1fr;
            }

            .auth-brand {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        <!-- BRAND SIDE -->
        <aside class="auth-brand">
            <div class="brand">
                <img src="/assets/images/logo/logo.png" alt="CariDaerah">
                <div class="brand-text">
                    <strong>CariDaerah</strong>
                    <span>Cari Daerah, Kuliner & Wisata Lokal</span>
                </div>
            </div>

            <p>
                Cari dan bagikan cerita, kuliner, serta wisata daerah
                langsung dari warga setempat di seluruh Indonesia.
            </p>
        </aside>

        <!-- FORM SIDE -->
        <main class="auth-form">
            <?= $this->renderSection('content') ?>
        </main>

    </div>

</body>

</html>