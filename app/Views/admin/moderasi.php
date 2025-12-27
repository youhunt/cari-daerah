<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="card">
    <h3>Moderasi Konten</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contents as $c): ?>
                <tr>
                    <td><?= esc($c['title']) ?></td>
                    <td>
                        <span class="badge <?= $c['status'] ?>">
                            <?= $c['status'] ?>
                        </span>
                    </td>
                    <td>
                        <form method="post" action="/admin/moderasi/update/<?= $c['id'] ?>">
                            <?= csrf_field() ?>
                            <select name="status">
                                <option value="published">Publish</option>
                                <option value="verified">Verify</option>
                                <option value="archived">Archive</option>
                            </select>
                            <button>Simpan</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>