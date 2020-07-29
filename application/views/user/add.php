<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <?= form_open(); ?>

          <div class="card-header">
            <form action="" method="post" autocomplete="off">
              <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan nama atau nip.." aria-label="Cari nama pegawai.." aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i> Cari</button>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th>nip</th>
                  <th>Nama</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user as $r) : ?>
                  <tr>
                    <td><?= $r['nip']; ?></td>
                    <td><?= $r['nama']; ?></td>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" <?= check_nip($r['nip']); ?> data-nip="<?= $r['nip']; ?>" data-nama="<?= $r['nama']; ?>">
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <a href="<?= base_url('user'); ?>" class="btn btn-info float-right"><i class="nav-icon fa fa-arrow-left"></i> Kembali</a>
          </div>

          </form>
        </div>
      </div>
    </div>

  </div>
</section>