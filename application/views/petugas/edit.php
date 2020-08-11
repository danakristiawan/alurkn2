<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <form action="" method="post" autocomplete="off">
            <div class="card-header">

            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="">NIP :</label>
                <input type="text" name="nip" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" value="<?= $petugas['nip']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('nip') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Nama :</label>
                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" value="<?= $petugas['nama']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('nama') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Jabatan :</label>
                <input type="text" name="jabatan" class="form-control <?= form_error('jabatan') ? 'is-invalid' : '' ?>" value="<?= $petugas['jabatan']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('jabatan') ?>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <a href="<?= base_url('petugas'); ?>" class="btn btn-secondary float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>