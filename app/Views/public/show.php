<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<article class="content-detail">

    <header class="content-header">
        <div class="content-info">

            <div class="info-left">
                <span class="badge"><?= esc($content['category_name']) ?></span>
                <span class="region">
                    <?= esc(
                        trim("{$content['district_name']}, {$content['city_name']}, {$content['province_name']}")
                    ) ?>
                </span>
            </div>

            <div class="info-right">
                <span class="author">
                    ✍️ <?= esc($content['full_name'] ?? $content['username']) ?>
                </span>
                <span class="date">
                    <?= date('d M Y', strtotime($content['created_at'])) ?>
                </span>
            </div>

        </div>

        <h1><?= esc($content['title']) ?></h1>

        <?php if (!empty($heroPhoto)): ?>
            <img src="<?= base_url($heroPhoto['path']) ?>"
                style="width:100%;border-radius:16px;margin-bottom:32px">
        <?php endif ?>

        <p class="content-summary">
            <?= esc($content['summary']) ?>
        </p>
    </header>

    <div class="content-body">
        <?= $content['content'] ?>
    </div>

    <div style="margin-top:48px">
        <a href="/cari">← Kembali ke pencarian</a>
    </div>

</article>

<?= $this->endSection() ?>
