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
                <label for="">Pertanyaan :</label>
                <textarea name="tanya" class="form-control <?= form_error('tanya') ? 'is-invalid' : '' ?>" cols="30" rows="10"><?= $tanya['tanya']; ?></textarea>
                <div class="invalid-feedback">
                  <?= form_error('tanya') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Jawaban :</label>
                <textarea name="jawab" class="form-control <?= form_error('jawab') ? 'is-invalid' : '' ?>" cols="30" rows="10"><?= $tanya['jawab']; ?></textarea>
                <div class="invalid-feedback">
                  <?= form_error('jawab') ?>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <a href="<?= base_url('tanya-piutang'); ?>" class="btn btn-secondary float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>