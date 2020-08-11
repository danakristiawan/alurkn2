<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <span class="text-lg"><i class="fa fa-folder-o"></i> &nbsp;Daftar Penerimaan Permohonan</span>
            <a href="<?= base_url('terima-permohonan/add'); ?>" class="btn btn-sm btn-primary float-right" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fa fa-plus"></i></a>
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
                        <a href="<?= base_url('terima-permohonan/edit/') . $r['id']; ?>" class="badge badge-success badge-sm"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah"></i></a>
                        <a href="<?= base_url('terima-permohonan/delete/') . $r['id']; ?>" class="badge badge-danger badge-sm" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Hapus"></i></a>
                        <a href="<?= base_url('terima-permohonan/proses/') . $r['jenis_id'] . '/' . $r['id']; ?>" class="badge badge-warning badge-sm"><i class="fa fa-check" data-toggle="tooltip" data-placement="bottom" title="Proses"></i> Proses</a>
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