<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="card">

    <div class="page-header">
        <h2><?= isset($content) ? 'Edit Cerita' : 'Tulis Cerita Baru' ?></h2>
        <p class="muted">
            Bagikan cerita, kuliner, atau wisata dari daerahmu.
        </p>
    </div>

    <form method="post"
        action="<?= isset($content)
                    ? '/konten/update/' . $content['id']
                    : '/konten/store' ?>"
        class="content-form">

        <?= csrf_field() ?>

        <!-- WILAYAH -->
        <div class="form-group">
            <h3>Wilayah</h3>
            <?= view('components/region-dropdown') ?>
        </div>

        <!-- JUDUL + RINGKASAN -->
        <div class="form-group">
            <label>Judul Cerita</label>
            <input type="text"
                name="title"
                placeholder="Contoh: Soto Legendaris di Pasar Lama"
                value="<?= esc($content['title'] ?? '') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Ringkasan</label>
            <textarea name="summary"
                rows="3"
                placeholder="Ringkasan singkat untuk preview & SEO"><?= esc($content['summary'] ?? '') ?></textarea>
        </div>

        <!-- KATEGORI -->
        <div class="form-group">
            <label>Kategori</label>
            <select name="category_id" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                        <?= isset($content) && $content['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                        <?= esc($cat['name']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- ISI CERITA -->
        <div class="form-group">
            <label>Isi Cerita</label>
            <textarea id="editor"
                name="content"
                rows="12"
                placeholder="Tulis cerita daerah di sini..."><?= esc($content['content'] ?? '') ?></textarea>
        </div>

        <!-- ACTION -->
        <div class="form-actions">
            <a href="/konten" class="btn-outline">Batal</a>

            <button type="submit" class="btn-primary">
                <?= isset($content) ? 'Perbarui Cerita' : 'Simpan Cerita' ?>
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            placeholder: 'Tulis cerita daerah di sini...',
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link',
                'bulletedList', 'numberedList', '|',
                'blockQuote', 'undo', 'redo'
            ]
        })
        .catch(error => console.error(error));

    const province = document.getElementById('province');
    const city = document.getElementById('city');
    const district = document.getElementById('district');
    const village = document.getElementById('village');

    function resetSelect(select, placeholder) {
        select.innerHTML = `<option value="">${placeholder}</option>`;
        select.disabled = true;
    }

    function populate(select, data, key, label) {
        resetSelect(select, select.options[0].text);
        data.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item[key];
            opt.textContent = item[label];
            select.appendChild(opt);
        });
        select.disabled = false;
    }

    // LOAD PROVINSI
    fetch('/ajax/provinsi')
        .then(res => res.json())
        .then(data => populate(province, data, 'id', 'description'));

    // PROVINSI → KABUPATEN
    province.addEventListener('change', e => {
        resetSelect(city, '-- Pilih Kabupaten / Kota --');
        resetSelect(district, '-- Pilih Kecamatan --');
        resetSelect(village, '-- Pilih Desa --');

        if (!e.target.value) return;

        fetch(`/ajax/kabupaten/${e.target.value}`)
            .then(res => res.json())
            .then(data => populate(city, data, 'id', 'description'));
    });

    // KABUPATEN → KECAMATAN
    city.addEventListener('change', e => {
        resetSelect(district, '-- Pilih Kecamatan --');
        resetSelect(village, '-- Pilih Desa --');

        if (!e.target.value) return;

        fetch(`/ajax/kecamatan/${e.target.value}`)
            .then(res => res.json())
            .then(data => populate(district, data, 'id', 'description'));
    });

    // KECAMATAN → DESA
    district.addEventListener('change', e => {
        resetSelect(village, '-- Pilih Desa --');

        if (!e.target.value) return;

        fetch(`/ajax/desa/${e.target.value}`)
            .then(res => res.json())
            .then(data => populate(village, data, 'id', 'description'));
    });
</script>

<?= $this->endSection() ?>