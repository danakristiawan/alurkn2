<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-header">
            <span class="text-lg"><i class="fa fa-folder-o"></i> &nbsp;Daftar Surat Keputusan</span>
            <a href="<?= base_url('kegiatan/sk-add/') . $kegiatan_id; ?>" class="btn btn-sm btn-primary float-right" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fa fa-plus"></i></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor</th>
                    <th>Uraian</th>
                    <th>Tanggal</th>
                    <th>File</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;
                  foreach ($sk as $r) : $no++; ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><a href="<?= base_url('kegiatan/petugas-index/') . $kegiatan_id . '/'  . $r['id']; ?>"><?= $r['nomor']; ?></a></td>
                      <td><?= $r['nama']; ?></td>
                      <td><?= date('d-m-Y', $r['tanggal']); ?></td>
                      <td>
                        <a href="<?= base_url('kegiatan/sk-cetak/') . $kegiatan_id . '/' . $r['id']; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="SK"><i class="fa fa-file-pdf-o"></i></a>
                        <a href="<?= base_url('kegiatan/spj-cetak/') . $kegiatan_id . '/' . $r['id']; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="SPJ"><i class="fa fa-file-pdf-o ml-2"></i></a>
                      </td>
                      <td>
                        <a href="<?= base_url('kegiatan/sk-edit/') . $kegiatan_id . '/' . $r['id']; ?>" class="badge badge-success badge-sm"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah"></i></a>
                        <a href="<?= base_url('kegiatan/sk-delete/') . $kegiatan_id . '/'  . $r['id']; ?>" class="badge badge-danger badge-sm" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Hapus"></i></a>
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