<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="card">
    <h2><?= isset($content) ? 'Edit Cerita' : 'Tulis Cerita Baru' ?></h2>

    <form method="post"
        action="<?= isset($content)
                    ? '/konten/update/' . $content['id']
                    : '/konten/store' ?>">

        <?= csrf_field() ?>

        <label>Judul Cerita</label>
        <input type="text" name="title"
            value="<?= $content['title'] ?? '' ?>" required>

        <label>Ringkasan</label>
        <textarea name="summary" rows="3"><?= $content['summary'] ?? '' ?></textarea>

        <label>Kategori</label>
        <select name="category_id" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= isset($content) && $content['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                    <?= $cat['name'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <label>Wilayah</label>
        <?= view('components/region-dropdown') ?>

        <label>Isi Cerita</label>
        <textarea id="editor" name="content" rows="10"><?= $content['content'] ?? '' ?></textarea>

        <button type="submit">
            <?= isset($content) ? 'Perbarui Cerita' : 'Simpan Cerita' ?>
        </button>
    </form>
</div>

<?= $this->endSection() ?>


<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'), {
        placeholder: 'Tulis cerita daerah di sini...'
    });
</script>