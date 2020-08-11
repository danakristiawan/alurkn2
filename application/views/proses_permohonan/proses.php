<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <form action="" method="post" autocomplete="off">
            <div class="card-header">
              <div class="alert alert-warning" role="alert">
                Apakah Anda yakin akan memproses permohonan ini?
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="">Catatan :</label>
                <textarea name="catatan" class="form-control <?= form_error('catatan') ? 'is-invalid' : '' ?>" cols="30" rows="3"><?= set_value('catatan'); ?></textarea>
                <div class="invalid-feedback">
                  <?= form_error('catatan') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Permohonan Diteruskan kepada :</label>
                <select name="nip" class="form-control">
                  <?php foreach ($petugas as $j) : ?>
                    <option value="<?= $j['nip']; ?>"><?= $j['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right ml-2"><i class="fa fa-save"></i> Ya, Proses Permohonan</button>
              <a href="<?= base_url('terima-permohonan'); ?>" class="btn btn-secondary float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>