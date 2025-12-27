<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="card">
    <h2>Daftar Akun</h2>
    <?= view('Myth\Auth\Views\_message_block') ?>

    <form action="<?= route_to('register') ?>" method="post">
        <?= csrf_field() ?>

        <!-- FULL NAME -->
        <input type="text"
            name="fullname"
            placeholder="Nama Lengkap"
            value="<?= old('fullname') ?>"
            required>

        <!-- USERNAME -->
        <input type="text"
            name="username"
            placeholder="Username"
            value="<?= old('username') ?>"
            required>

        <!-- EMAIL -->
        <input type="email"
            name="email"
            placeholder="Email"
            value="<?= old('email') ?>"
            required>

        <!-- PASSWORD -->
        <input type="password"
            name="password"
            placeholder="Password"
            required>

        <input type="password"
            name="pass_confirm"
            placeholder="Ulangi Password"
            required>

        <button type="submit">Daftar</button>
    </form>

    <div class="links">
        <p>Sudah punya akun?
            <a href="<?= route_to('login') ?>">Masuk di sini</a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>