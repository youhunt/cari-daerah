<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<h1>Cari Daerah, Kuliner & Wisata</h1>
<p class="muted">
    Temukan cerita lokal, kuliner khas, dan wisata daerah langsung dari warga setempat.
</p>

<form method="get" class="search-box">
    <input type="text" name="q"
           placeholder="Cari kuliner, wisata, budaya..."
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

<p class="muted">📍 Konten dari berbagai daerah di Indonesia · Ditulis oleh warga lokal</p>

<?php if (empty($contents)): ?>
    <div class="card">
        <p>Tidak ada hasil ditemukan.</p>
    </div>
<?php endif ?>

<?php helper('text'); ?>
<?php foreach ($contents as $row): ?>
    <article class="card">
        <h2>
            <a href="/cari/cerita/<?= esc($row['slug']) ?>">
                <?= esc($row['title']) ?>
            </a>
        </h2>

        <p class="meta">
            <span class="badge"><?= esc($row['category_name']) ?></span>
            · <?= esc($row['city_name']) ?>, <?= esc($row['province_name']) ?>
        </p>

        <p><?= esc(word_limiter($row['summary'], 30)) ?></p>

        <a href="/cari/cerita/<?= esc($row['slug']) ?>">
            Baca selengkapnya →
        </a>
    </article>
<?php endforeach ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
