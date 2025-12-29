<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
        <a href="<?= base_url(); ?>admin/users/add" class="btn-primary">+ Tambah Pengguna</a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Grup</th>
                        <th>Email</th>
                        <th style="width: 60px;">Aktif</th>
                        <th style="width: 90px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $rw) {
                        if ($rw->id !== '1') {
                            $row = "row" . $rw->id;
                            echo $$row;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('div-modal') ?>

<form action="<?= base_url(); ?>admin/users/activate" method="post">
    <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Ya" untuk mengupdate User</div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <input type="hidden" name="active" class="active">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="<?= base_url(); ?>admin/users/changeGroup" method="post">
    <div class="modal fade" id="changeGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Grup</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group-item p-3">
                        <div class="row align-items-start">
                            <div class="col-md-4 mb-8pt mb-md-0">
                                <div class="media align-items-left">
                                    <div class="d-flex flex-column media-body media-middle">
                                        <span
                                            class="card-title">Grup</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-8pt mb-md-0">
                                <select name="group" class="form-control" data-toggle="select">
                                    <?php
                                    foreach ($groups as $key => $row) {
                                    ?>
                                        <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script type="text/javascript">
    $(document).ready(function() {
        // get Delete Page
        $('.btn-active-users').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const active = $(this).data('active');

            // Set data to Form Edit
            $('.id').val(id);
            $('.active').val(active);
            // Call Modal Edit
            $('#activateModal').modal('show');
        });

        $('.btn-change-group').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');

            // Set data to Form Edit
            $('.id').val(id);
            // Call Modal Edit
            $('#changeGroupModal').modal('show');
        });

    });
</script>

<?= $this->endSection() ?>