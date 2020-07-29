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
  <div class="content-wrapper">
    <div class="container">
      <section class="features-overview">
        <div class="content-header">
          <h2>Frequently Ask Question (FAQ)</h2>
          <h6 class="section-subtitle text-muted">Daftar Pertanyaan Seputar Pengelolaan Barang Milik Negara, Pelayanan Lelang dan Pengurusan Piutang Negara</h6>
        </div>
        <div class="content-body">
          <div class="row">
            <div class="col">
              <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Pengelolaan Barang Milik Negara
                      </button>
                    </h2>
                  </div>
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Pertanyaan</th>
                              <th>Jawaban</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1;
                            foreach ($tanya1 as $r) : ?>
                              <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $r['tanya']; ?></td>
                                <td><?= $r['jawab']; ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Pelayanan Lelang
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Pertanyaan</th>
                              <th>Jawaban</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1;
                            foreach ($tanya2 as $s) : ?>
                              <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $s['tanya']; ?></td>
                                <td><?= $s['jawab']; ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Pengurusan Piutang Negara
                      </button>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Pertanyaan</th>
                              <th>Jawaban</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1;
                            foreach ($tanya3 as $t) : ?>
                              <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $t['tanya']; ?></td>
                                <td><?= $t['jawab']; ?></td>
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