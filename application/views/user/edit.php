<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <?= form_open(); ?>
          <div class="card-header">

          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="">NIP :</label>
              <input type="text" name="nip" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" value="<?= $user['nip']; ?>" readonly>
              <div class="invalid-feedback">
                <?= form_error('nip') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="">Nama :</label>
              <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" value="<?= $user['nama']; ?>" readonly>
              <div class="invalid-feedback">
                <?= form_error('nama') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="">Role :</label>
              <select name="role_id" class="form-control">
                <?php foreach ($role as $s) : ?>
                  <option value="<?= $s['id']; ?>" <?= $s['id'] == $user['role_id'] ? 'selected' : ''; ?>><?= $s['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-info float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
            <a href="<?= base_url('user'); ?>" class="btn btn-secondary float-right"><i class="fa fa-undo"></i> Batal</a>
          </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>