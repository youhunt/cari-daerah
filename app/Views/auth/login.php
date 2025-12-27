<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="card">
	<h2>Masuk</h2>
	<?= view('Myth\Auth\Views\_message_block') ?>

	<form action="<?= route_to('login') ?>" method="post">
		<?= csrf_field() ?>

		<input type="text" name="login" placeholder="Email atau Username" required>
		<input type="password" name="password" placeholder="Password" required>

		<button type="submit">Masuk</button>
	</form>

	<div class="links">
		<p><a href="<?= route_to('register') ?>">Daftar akun baru</a></p>
		<p><a href="<?= route_to('forgot') ?>">Lupa password?</a></p>
	</div>
</div>

<?= $this->endSection() ?>