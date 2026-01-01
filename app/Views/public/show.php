<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<article class="content-detail">

    <!-- JUDUL -->
    <header class="content-header">
        <h1 class="content-title">
            <?= esc($content['title']) ?>
        </h1>

        <!-- INFO BAR -->
        <div class="content-info">

            <div class="info-left">
                <span class="badge">
                    <?= esc($content['category_name']) ?>
                </span>
                <span class="region">
                    <?= esc(trim("{$content['district_name']}, {$content['city_name']}, {$content['province_name']}")) ?>
                </span>
            </div>

            <div class="info-right">
                <span class="author">
                    Ditulis oleh
                    <a href="/penulis/<?= esc($content['username']) ?>">
                        <?= esc($content['full_name'] ?? $content['username']) ?>
                    </a>
                </span>
                <span class="date">
                    <?= date('d M Y', strtotime($content['created_at'])) ?>
                </span>
            </div>

        </div>
    </header>

    <!-- HERO IMAGE -->
    <?php if (!empty($heroPhoto)): ?>
        <figure class="content-hero">
            <img src="<?= base_url($heroPhoto['path']) ?>" alt="<?= esc($content['title']) ?>">
        </figure>
    <?php endif ?>

    <!-- SUMMARY -->
    <?php if (!empty($content['summary'])): ?>
        <p class="content-summary">
            <?= esc($content['summary']) ?>
        </p>
    <?php endif ?>

    <!-- BODY -->
    <div class="content-body">
        <?= $content['content'] ?>
    </div>

    <footer class="content-footer">
        <a href="/cari">← Kembali ke pencarian</a>
    </footer>

</article>

<?= $this->endSection() ?>