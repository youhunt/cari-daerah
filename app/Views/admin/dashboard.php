<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="grid-3">
    <div class="stat warning">
        <h2><?= $pending ?></h2>
        <p>Konten Draft</p>
    </div>

    <div class="stat danger">
        <h2><?= $flagged ?></h2>
        <p>Konten Flagged</p>
    </div>

    <div class="stat success">
        <h2><?= $published ?></h2>
        <p>Konten Published</p>
    </div>
</div>

<?= $this->endSection() ?>