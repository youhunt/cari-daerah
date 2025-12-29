<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<h1>Cari Daerah, Kuliner & Wisata</h1>
<p class="muted">Temukan cerita lokal dari seluruh Indonesia.</p>

<form method="get" class="search-box">
    <input type="text" name="q" placeholder="Cari kuliner, wisata, budaya..."
        value="<?= esc($_GET['q'] ?? '') ?>">

    <select name="kategori">
        <option value="">Semua Kategori</option>
        <option value="kuliner">Kuliner</option>
        <option value="wisata">Wisata</option>
        <option value="budaya">Budaya</option>
        <option value="event">Event</option>
    </select>

    <button type="submit">Cari</button>
</form>

<?php foreach ($contents as $row): ?>
    <article class="card">
        <h2>
            <a href="/cari/cerita/<?= esc($row['slug']) ?>">
                <?= esc($row['title']) ?>
            </a>
        </h2>

        <p class="meta">
            <?= esc($row['category_name']) ?> ·
            <?= esc($row['city_name']) ?>,
            <?= esc($row['province_name']) ?>
        </p>

        <p><?= esc($row['summary']) ?></p>

        <a href="/cari/cerita/<?= esc($row['slug']) ?>">
            Baca selengkapnya →
        </a>
    </article>
<?php endforeach ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>