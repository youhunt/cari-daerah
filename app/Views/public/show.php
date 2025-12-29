<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<article class="content-detail">

    <h1><?= esc($content['title']) ?></h1>

    <p class="meta">
        <?= esc($content['category_name']) ?> ·
        <?= esc(trim(
            "{$content['district_name']}, {$content['city_name']},
             {$content['province_name']}"
        )) ?>
    </p>

    <p class="summary">
        <?= esc($content['summary']) ?>
    </p>

    <div class="content-body">
        <?= $content['content'] ?>
    </div>

</article>

<?= $this->endSection() ?>