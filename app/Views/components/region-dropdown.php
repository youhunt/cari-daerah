<div class="form-grid-4">
    <input type="hidden" name="province_code" id="province_code" value="<?= esc($region['province_code'] ?? '') ?>" />
    <input type="hidden" name="city_code" id="city_code" value="<?= esc($region['city_code'] ?? '') ?>" />
    <input type="hidden" name="district_code" id="district_code" value="<?= esc($region['district_code'] ?? '') ?>" />
    <input type="hidden" name="village_code" id="village_code" value="<?= esc($region['village_code'] ?? '') ?>" />
    <div class="form-group">
        <label>Provinsi</label>
        <select id="province" required 
            data-selected="<?= esc($region['province_code'] ?? '') ?>">
            <option value="">-- Pilih Provinsi --</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kabupaten / Kota</label>
        <select id="city" disabled required 
            data-selected="<?= esc($region['city_code'] ?? '') ?>">
            <option value="">-- Pilih Kabupaten / Kota --</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kecamatan</label>
        <select id="district" disabled required
            data-selected="<?= esc($region['district_code'] ?? '') ?>">
            <option value="">-- Pilih Kecamatan --</option>
        </select>
    </div>

    <div class="form-group">
        <label>Desa / Kelurahan (Opsional)</label>
        <select id="village" disabled
            data-selected="<?= esc($region['village_code'] ?? '') ?>">
            <option value="">-- Pilih Desa --</option>
        </select>
    </div>

</div>