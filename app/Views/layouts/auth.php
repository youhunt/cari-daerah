<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'CeritaDaerah') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #FAF7F2;
            display: flex;
            min-height: 100vh;
        }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
        }

        .auth-brand {
            background: linear-gradient(135deg, #8B5E34, #2F5D50);
            color: #fff;
            padding: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-brand h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            margin-bottom: 16px;
        }

        .auth-brand p {
            font-size: 18px;
            opacity: .9;
        }

        .auth-form {
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .card {
            width: 100%;
            max-width: 420px;
        }

        h2 {
            margin-bottom: 24px;
            color: #8B5E34;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        button {
            width: 100%;
            background: #8B5E34;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
        }

        button:hover {
            background: #734a29;
        }

        .links {
            margin-top: 16px;
            text-align: center;
            font-size: 14px;
        }

        .links a {
            color: #8B5E34;
        }

        @media(max-width: 900px) {
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
        <div class="auth-brand">
            <h1>CeritaDaerah</h1>
            <p>Masuk dan bagikan cerita tentang daerahmu kepada Indonesia.</p>
        </div>

        <div class="auth-form">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

</body>

</html>