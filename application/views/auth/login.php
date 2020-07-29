<div class="login-box">
  <div class="login-logo">
    <?= $judul; ?>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <?= $this->session->flashdata('message'); ?>

      <form action="<?= base_url('auth'); ?>" method="post" autocomplete="off">
        <div class="form-group has-feedback">
          <label>NIP :</label>
          <input type="text" name="nip" class="form-control <?= form_error('nip') ? 'is-invalid' : ''; ?>" placeholder="NIP" value="<?= set_value('nip'); ?>">
          <?= form_error('nip', '<small class="text-danger pl-0">', '</small>'); ?>
        </div>
        <div class="form-group has-feedback">
          <label>Password :</label>
          <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>" placeholder="Password">
          <?= form_error('password', '<small class="text-danger pl-0">', '</small>'); ?>
        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <p class="mb-1">
        <a href="<?= base_url('auth/forgot'); ?>">Lupa password</a>
      </p>
      <p class="mb-0">
        <a href="<?= base_url('auth/registration'); ?>" class="text-center">Registrasi</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->