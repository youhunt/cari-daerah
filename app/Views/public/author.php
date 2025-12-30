<h1><?= esc($author['full_name']) ?></h1>
<p class="muted">@<?= esc($author['username']) ?></p>

<hr>

<?php foreach ($contents as $row): ?>
    <div class="card">
        <h3>
            <a href="/cari/<?= esc($row['slug']) ?>">
                <?= esc($row['title']) ?>
            </a>
        </h3>
        <p><?= esc($row['summary']) ?></p>
    </div>
<?php endforeach ?>
