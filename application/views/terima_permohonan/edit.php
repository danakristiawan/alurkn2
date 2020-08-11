<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <form action="" method="post" autocomplete="off">
            <div class="card-header">

            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-9">
                  <div class="form-group">
                    <label for="">Nomor :</label>
                    <input type="text" name="nomor" class="form-control <?= form_error('nomor') ? 'is-invalid' : '' ?>" value="<?= $permohonan['nomor']; ?>">
                    <div class="invalid-feedback">
                      <?= form_error('nomor') ?>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="">Tanggal :</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input class="form-control <?= form_error('tanggal') ? 'is-invalid' : '' ?>" data-date-format="dd-mm-yyyy" data-provide="datepicker" name="tanggal" value="<?= date('d-m-Y', $permohonan['tanggal']); ?>">
                      <div class="invalid-feedback">
                        <?= form_error('tanggal') ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Asal :</label>
                <input type="text" name="asal" class="form-control <?= form_error('asal') ? 'is-invalid' : '' ?>" value="<?= $permohonan['asal']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('asal') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Perihal :</label>
                <textarea name="perihal" class="form-control <?= form_error('perihal') ? 'is-invalid' : '' ?>" cols="30" rows="3"><?= $permohonan['perihal']; ?></textarea>
                <div class="invalid-feedback">
                  <?= form_error('perihal') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Jenis Permohonan :</label>
                <select name="jenis_id" class="form-control">
                  <?php foreach ($jenis as $j) : ?>
                    <option value="<?= $j['id']; ?>" <?= $j['id'] == $permohonan['jenis_id'] ? 'selected' : ''; ?>><?= $j['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <a href="<?= base_url('contoh'); ?>" class="btn btn-secondary float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>