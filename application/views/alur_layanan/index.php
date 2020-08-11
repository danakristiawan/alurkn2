<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-header">
            <span class="text-lg"><i class="fa fa-folder-o"></i> &nbsp;Daftar Alur Layanan</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;
                  foreach ($jenis_layanan as $r) : $no++; ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r['nama']; ?></td>
                      <td>
                        <a href="<?= base_url('alur-layanan/detail/') . $r['id']; ?>" class="badge badge-success badge-sm"><i class="fa fa-search" data-toggle="tooltip" data-placement="bottom" title="Detail"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>