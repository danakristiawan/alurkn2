<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-header">
            <span class="text-lg"><i class="fa fa-folder-o"></i> &nbsp;Detail Permohonan</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Proses</th>
                    <th>Tanggal</th>
                    <th>Petugas</th>
                    <th>Catatan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;
                  foreach ($proses as $r) : $no++; ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r['nama']; ?></td>
                      <td><?= hari($r['date_created']) . ', ' . tanggal($r['date_created']); ?></td>
                      <td><?= $r['nama_peg'] . ' (' . $r['jabatan_peg'] . ' )'; ?></td>
                      <td><?= $r['catatan']; ?></td>
                      <td><?= $r['status'] == 1 ? '<span class="badge badge-success">sudah diproses</span>' : '<span class="badge badge-danger">belum diproses</span>'; ?></td>
                    </tr>
                  <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>