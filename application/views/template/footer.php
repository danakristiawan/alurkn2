</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div></div>
  <div class="text-right mr-2">
    &copy; 2020 Istiqamah Rani. All rights reserved.
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  // $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $('.datepicker').datepicker();
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  });
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

  $('.form-check-input').on('click', function() {
    const nip = $(this).data('nip');
    const nama = $(this).data('nama');
    $.ajax({
      url: "<?= base_url('user/adduser'); ?>",
      type: 'post',
      data: {
        nip: nip,
        nama: nama
      },
      success: function() {
        // document.location.href = "<?= base_url('daftar/add/'); ?>" + tahunId;
      }
    });
  });

  $('.form-check-petugas').on('click', function() {
    let kegiatan_id = $(this).data('kegiatan_id');
    let sk_id = $(this).data('sk_id');
    let nip = $(this).data('nip');
    let nama = $(this).data('nama');
    let jabatan = $(this).data('jabatan');
    let gol = $(this).data('gol');
    let alamat = $(this).data('alamat');
    $.ajax({
      url: "<?= base_url('kegiatan/addpetugas'); ?>",
      type: 'post',
      data: {
        kegiatan_id: kegiatan_id,
        sk_id: sk_id,
        nip: nip,
        nama: nama,
        jabatan: jabatan,
        gol: gol,
        alamat: alamat
      },
      success: function() {
        // console.log(data);
      }
    });
  });
</script>
</body>


</html>