<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<h2>Dashboard</h2>
<p class="muted">Selamat datang di CariDaerah.</p>

<div class="grid-3">

    <div class="stat">
        <h2><?= $totalContent ?? 0 ?></h2>
        <p>Konten Saya</p>
    </div>

    <div class="stat">
        <h2><?= $published ?? 0 ?></h2>
        <p>Published</p>
    </div>

    <?php if (in_groups('administrator')): ?>
        <div class="stat">
            <h2><?= $pending ?? 0 ?></h2>
            <p>Menunggu Moderasi</p>
        </div>
    <?php endif ?>

</div>

<?php if (in_groups('administrator')): ?>
    <div class="card" style="margin-top:24px;">
        <h3>Menu Admin</h3>
        <ul>
            <li><a href="/admin/moderasi">Moderasi Konten</a></li>
            <li><a href="/admin/users">Manajemen Pengguna</a></li>
        </ul>
    </div>
<?php endif ?>

<?= $this->endSection() ?>
