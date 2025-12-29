<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h2>Konten Saya</h2>
    <p class="muted">Daftar cerita yang sudah kamu buat.</p>
</div>

<div class="card">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <strong>Total: <?= count($contents) ?> konten</strong>
        <a href="/konten/create" class="btn-primary">+ Tulis Cerita</a>
    </div>

    <?php if (empty($contents)): ?>
        <p class="muted">Belum ada konten.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Wilayah</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contents as $row): ?>
                    <tr>
                        <td>
                            <strong><?= esc($row['title']) ?></strong><br>
                            <small class="muted"><?= esc($row['summary']) ?></small>
                        </td>
                        <td><?= esc($row['category_name'] ?? '-') ?></td>
                        <td><?= esc($row['region_name'] ?? '-') ?></td>
                        <td><?= ucfirst($row['status']) ?></td>
                        <td>
                            <a href="/konten/edit/<?= $row['id'] ?>">Edit</a> |
                            <a href="/konten/delete/<?= $row['id'] ?>"
                               onclick="return confirm('Hapus konten ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>

</div>

<?= $this->endSection() ?>
