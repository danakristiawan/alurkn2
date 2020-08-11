<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <span class="text-lg"><i class="fa fa-folder-o"></i> &nbsp;Daftar Permohonan Yang Akan Diproses</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Asal</th>
                    <th>Perihal</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;
                  foreach ($permohonan as $r) : $no++; ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r['nomor']; ?></td>
                      <td><?= tanggal($r['tanggal']); ?></td>
                      <td><?= $r['asal']; ?></td>
                      <td><?= $r['perihal']; ?></td>
                      <td><?= $r['nama_jenis']; ?></td>
                      <td>
                        <a href="<?= base_url('proses-permohonan/proses/') . $r['permohonan_id'] . '/' . $r['id']; ?>" class="badge badge-warning badge-sm"><i class="fa fa-check" data-toggle="tooltip" data-placement="bottom" title="Proses"></i> Proses</a>
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