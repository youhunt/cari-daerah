<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="card">

    <div class="page-header">
        <h2><?= isset($content) ? 'Edit Cerita' : 'Tulis Cerita Baru' ?></h2>
        <p class="muted">
            Bagikan cerita, kuliner, atau wisata dari daerahmu.
        </p>
    </div>

    <form method="post" enctype="multipart/form-data"
        action="<?= isset($content)
                    ? '/konten/update/' . $content['id']
                    : '/konten/store' ?>"
        class="content-form" >

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

        <!-- FOTO UTAMA -->
        <div class="form-group">
            <label>Foto Utama</label>
            <input type="file" name="hero_image" accept="image/*">

            <?php if (!empty($heroPhoto)): ?>
                <div style="margin:12px 0">
                    <img src="<?= base_url($heroPhoto['path']) ?>"
                        style="max-width:200px;border-radius:8px">
                </div>
            <?php endif ?>
        </div>

        <!-- ISI CERITA -->
        <div class="form-group">
            <label>Isi Cerita</label>
            <textarea id="editor"
                name="content"
                rows="12"
                placeholder="Tulis cerita daerah di sini..."><?= esc($content['content'] ?? '') ?></textarea>
        </div>

        <!-- META INFO -->
        <!-- <div class="form-group">
            <label>Info Tambahan (Opsional)</label>
            <textarea name="meta[info]" rows="3"
                placeholder="Contoh: Parkir luas, cocok untuk keluarga">
            </textarea>
        </div> -->

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
            extraPlugins: [ MyCustomUploadAdapterPlugin ],
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link',
                'bulletedList', 'numberedList', '|',
                'blockQuote', 'undo', 'redo'
            ]
        })
        .catch(error => console.error(error));

    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file.then(file => {
            const data = new FormData();
            data.append('upload', file);

            return fetch('/upload/ckeditor', {
                method: 'POST',
                body: data
            })
            .then(res => res.json())
            .then(res => ({ default: res.url }));
            });
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository')
        .createUploadAdapter = loader => new MyUploadAdapter(loader);
    }

    // REGION DROPDOWN LOGIC
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

        document.getElementById('province_code').value = province.value;

        fetch(`/ajax/kabupaten/${e.target.value}`)
            .then(res => res.json())
            .then(data => populate(city, data, 'id', 'description'));
    });

    // KABUPATEN → KECAMATAN
    city.addEventListener('change', e => {
        resetSelect(district, '-- Pilih Kecamatan --');
        resetSelect(village, '-- Pilih Desa --');

        if (!e.target.value) return;

        document.getElementById('city_code').value = city.value;

        fetch(`/ajax/kecamatan/${e.target.value}`)
            .then(res => res.json())
            .then(data => populate(district, data, 'id', 'description'));
    });

    // KECAMATAN → DESA
    district.addEventListener('change', e => {
        resetSelect(village, '-- Pilih Desa --');

        if (!e.target.value) return;

        document.getElementById('district_code').value = district.value;

        fetch(`/ajax/desa/${e.target.value}`)
            .then(res => res.json())
            .then(data => populate(village, data, 'id', 'description'));
    });

    document.addEventListener('DOMContentLoaded', async () => {

        const province = document.getElementById('province');
        const city     = document.getElementById('city');
        const district = document.getElementById('district');
        const village  = document.getElementById('village');

        const selectedProvince  = province.dataset.selected;
        const selectedCity      = city.dataset.selected;
        const selectedDistrict  = district.dataset.selected;
        const selectedVillage   = village.dataset.selected;

        if (selectedProvince) {
            await loadProvince(selectedProvince);
            await loadCity(selectedProvince, selectedCity);
            await loadDistrict(selectedCity, selectedDistrict);
            await loadVillage(selectedDistrict, selectedVillage);
        }
    });

    function loadCity(provinceCode, selected = null) {
        return fetch(`/ajax/kabupaten/${provinceCode}`)
            .then(res => res.json())
            .then(data => {
                city.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.text  = item.description;
                    if (selected == item.id) opt.selected = true;
                    city.appendChild(opt);
                });
            });
    }
    function loadDistrict(cityCode, selected = null) {
        return fetch(`/ajax/kecamatan/${cityCode}`)
            .then(res => res.json())
            .then(data => {
                district.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.text  = item.description;
                    if (selected == item.id) opt.selected = true;
                    district.appendChild(opt);
                });
            });
    }
    function loadVillage(districtCode, selected = null) {
        return fetch(`/ajax/desa/${districtCode}`)
            .then(res => res.json())
            .then(data => {
                village.innerHTML = '<option value="">-- Pilih Desa --</option>';
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.text  = item.description;
                    if (selected == item.id) opt.selected = true;
                    village.appendChild(opt);
                });
            });
    }
    function loadProvince(selected = null) {
        return fetch('/ajax/provinsi')
            .then(res => res.json())
            .then(data => {
                province.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.text  = item.description;
                    if (selected == item.id) opt.selected = true;
                    province.appendChild(opt);
                });
            });
    }

</script>

<?= $this->endSection() ?>