<div class="row g-3">
    <div class="col-md-3">
        <label>Provinsi</label>
        <select id="provinsi" class="form-control">
            <option value="">-- Pilih Provinsi --</option>
        </select>
    </div>

    <div class="col-md-3">
        <label>Kabupaten / Kota</label>
        <select id="kabupaten" class="form-control" disabled>
            <option value="">-- Pilih Kabupaten --</option>
        </select>
    </div>

    <div class="col-md-3">
        <label>Kecamatan</label>
        <select id="kecamatan" class="form-control" disabled>
            <option value="">-- Pilih Kecamatan --</option>
        </select>
    </div>

    <div class="col-md-3">
        <label>Desa / Kelurahan</label>
        <select id="desa" class="form-control" disabled>
            <option value="">-- Pilih Desa (Opsional) --</option>
        </select>
    </div>
</div>

<!-- hidden input untuk submit -->
<input type="hidden" name="province_code" id="province_code">
<input type="hidden" name="province_name" id="province_name">

<input type="hidden" name="city_code" id="city_code">
<input type="hidden" name="city_name" id="city_name">

<input type="hidden" name="district_code" id="district_code">
<input type="hidden" name="district_name" id="district_name">

<input type="hidden" name="village_code" id="village_code">
<input type="hidden" name="village_name" id="village_name">