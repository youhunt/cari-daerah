<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="card" style="max-width:600px">

    <h2>Edit Profil Pengguna</h2>

    <p class="muted">
        Username: <strong><?= esc($user->username) ?></strong><br>
        Email: <?= esc($user->email) ?>
    </p>

    <form method="post" action="/admin/users/profile/save" class="content-form">
        <?= csrf_field() ?>
        <input type="hidden" name="user_id" value="<?= $user->id ?>">

        <div class="form-group">
            <label>Nama Lengkap (ditampilkan di konten)</label>
            <input type="text"
                name="full_name"
                value="<?= esc($profile['full_name'] ?? '') ?>"
                placeholder="Contoh: Yunan Diaurrohman Putra Irawan">
        </div>  

        <div class="form-group">
            <label>Trust Level</label>
            <select name="trust_level">
                <?php
                $level = $profile['trust_level'] ?? 'new';
                ?>
                <option value="new" <?= $level === 'new' ? 'selected' : '' ?>>New</option>
                <option value="active" <?= $level === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="trusted" <?= $level === 'trusted' ? 'selected' : '' ?>>Trusted</option>
            </select>
        </div>

        <button class="btn-primary">Simpan Profil</button>
    </form>

</div>

<?= $this->endSection() ?>
