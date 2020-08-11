<!DOCTYPE html>
<html lang="en">

<head>
  <title>Alurkn</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?= base_url('assets/theme/landing/images/alurkn.png'); ?>" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url('assets/theme/landing/vendors/owl-carousel/css/owl.carousel.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/theme/landing/vendors/owl-carousel/css/owl.theme.default.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/theme/landing/vendors/mdi/css/materialdesignicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/theme/landing/vendors/aos/css/aos.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/theme/landing/css/style.min.css'); ?>">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <style>
    ul.timeline {
      list-style-type: none;
      position: relative;
    }

    ul.timeline:before {
      content: ' ';
      background: #d4d9df;
      display: inline-block;
      position: absolute;
      left: 29px;
      width: 2px;
      height: 100%;
      z-index: 400;
    }

    ul.timeline>li {
      margin: 20px 0;
      padding-left: 20px;
    }

    ul.timeline>li:before {
      content: ' ';
      background: white;
      display: inline-block;
      position: absolute;
      border-radius: 50%;
      border: 3px solid #22c0e8;
      left: 20px;
      width: 20px;
      height: 20px;
      z-index: 400;
    }
  </style>
</head>

<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100">
  <header id="header-section">
    <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" id="navbar">
      <div class="container">
        <div class="navbar-brand-wrapper d-flex w-100">
          <img src="<?= base_url('assets/theme/landing/images/alurkn.png'); ?>" alt="" width="40" height="40">
          <h3 class="ml-2 mt-1">Alur KN</h3>
          <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="mdi mdi-menu navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse navbar-menu-wrapper" id="navbarSupportedContent">
          <ul class="navbar-nav align-items-lg-center align-items-start ml-auto">
            <li class="d-flex align-items-center justify-content-between pl-4 pl-lg-0">
              <div class="navbar-collapse-logo">
                <img src="<?= base_url('assets/theme/landing/images/alurkn.png'); ?>" alt="" width="40" height="40" class="mt-0 pt-0">
                <span style="font-size: 25px;">Alur KN</span>
              </div>
              <button class="navbar-toggler close-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="mdi mdi-close navbar-toggler-icon pl-0"></span>
              </button>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?>#header-section">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?>#bmn">BMN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?>#lelang">Lelang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?>#piutang">Piutang</a>
            </li>
            <li class="nav-item btn-contact-us pl-4 pl-lg-0">
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper pt-0">
    <div class="container">
      <section class="features-overview">
        <div class="content-header">
          <h2>Telusuri Permohonan Saya (Tracking System)</h2>
          <h6 class="section-subtitle text-muted">Informasi seputar proses permohonan yang sedang berjalan di KPKNL Jakarta 1</h6>
          <div class="input-group mt-3 col-md-4 offset-md-4">
            <form action="" method="post" autocomplete="off">
              <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="nomor register.." aria-label="Cari nama pegawai.." aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i> Cari</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="content-body">
          <div class="row">
            <?php if ($permohonan) :  ?>
              <div class="col-md-6 offset-md-3">
                <h5>Proses Terbaru..</h5>
                <ul class="timeline">
                  <?php foreach ($permohonan as $r) :  ?>
                    <li>
                      <span><?= hari($r['date_created']); ?>, <?= tanggal($r['date_created']); ?></span>
                      <span class="float-right"><?= jam($r['date_created']); ?> WIB</span>
                      <p class="mb-0"><?= $r['nama']; ?></p>
                      <p class="mb-0 text-muted"><?= $r['nama_peg']; ?> (<?= $r['jabatan_peg']; ?>)</p>
                      <p class="text-muted"><?= $r['catatan']; ?></p>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php else :  ?>
              <div class="col mb-5 text-center text-muted">
                belum ada data ................
              </div>
            <?php endif;  ?>
          </div>
        </div>
      </section>
      <footer class="border-top">
        <p class="text-center text-muted pt-4">Copyright © 2020<a href="<?= base_url('auth'); ?>" class="px-1">Yenny.</a>All rights reserved.</p>
      </footer>
    </div>
  </div>
  <script src="<?= base_url('assets/theme/landing/vendors/jquery/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('assets/theme/landing/vendors/bootstrap/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/theme/landing/vendors/owl-carousel/js/owl.carousel.min.js'); ?>"></script>
  <script src="<?= base_url('assets/theme/landing/vendors/aos/js/aos.js'); ?>"></script>
  <script src="<?= base_url('assets/theme/landing/js/landingpage.js'); ?>"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>