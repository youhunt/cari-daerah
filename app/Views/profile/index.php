<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<h2>Profil Saya</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif ?>

<form method="post" action="/profile/update" style="max-width:420px">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text"
               name="full_name"
               class="form-control"
               value="<?= esc($profile['full_name'] ?? '') ?>"
               required>
    </div>

    <button class="btn btn-primary">
        Simpan Profil
    </button>
</form>

<?= $this->endSection() ?>
