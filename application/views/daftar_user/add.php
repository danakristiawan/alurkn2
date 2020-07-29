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
                <input type="text" name="nip" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" value="<?= set_value('nip'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('nip') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Nama :</label>
                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" value="<?= set_value('nama'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('nama') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Email :</label>
                <input type="email" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" value="<?= set_value('email'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('email') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Password :</label>
                <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" value="<?= set_value('password'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('password') ?>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <a href="<?= base_url('daftar-user'); ?>" class="btn btn-secondary float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>