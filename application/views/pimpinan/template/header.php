<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?=base_url();?>assets/img/logo.png">
  <title><?= $title['header']?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/angular-datatables/dist/css/angular-datatables.min.css">
  <script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url();?>assets/js/plugins/angular.min.js"></script>
  <script src="<?= base_url();?>assets/js/plugins/angular-sanitize.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/chart.js/dist/Chart.min.css"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/chart.js/dist/Chart.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/chart.js/dist/utils.js"></script>
  
  <style>
    .print-header {
    display: none;
    }

    .print-body {
        display: none;
    }

    @media print {
        .print-header {
            display: block;
            text-align: center;
        }
        .print-body {
            display: block;
            text-align: left;
        }
        @page { size: landscape; }
    }
    .center {
      margin: 0;
      position: absolute;
      align-items: center;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
  </style>
  
</head>
<body class="hold-transition sidebar-mini">
  <?php
  $a = $this->session->userdata('akses');
  if(!$this->session->userdata('akses') || $this->session->userdata('akses')!='pimpinan'){
    $this->session->set_flashdata('pesan', 'Anda tidak memiliki akses, error');
    $this->session->sess_destroy();
    redirect('authorization');
  }
  ?>
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url()?>authorization/logout" role="button">
            <b>LOGOUT</b>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="<?= base_url();?>assets/index3.html" class="brand-link">
        <img src="<?= base_url();?>assets/img/<?= $title['profile']->logo;?>" alt="AdminLTE Logo"
          class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Musrenbang</span>
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?= $title['profile']->NamaKelurahan;?></a>
            <a href=""><i class="fa fa-circle text-success"></i><?= $this->session->userdata('nama');?></a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url()?>pimpinan/home" class="nav-link <?= $title['header']=='Home' ? 'active': '' ?>">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url()?>pimpinan/rencanakerja" class="nav-link <?= $title['header']=='Rencana Kerja' ? 'active': '' ?>">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                  Rencana Kerja
                </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3>MUSRENBANG TAHUN <?= $title['periode']->Tahun;?></h3>
              <p>Berlangsung dari tanggal <?= date('d M Y', strtotime($title['periode']->mulai));?> sampai <?= date('d M Y',strtotime($title['periode']->berakhir));?></p>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><?= $title['dash'];?></li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="data-flush" data-flash="<?= $this->session->flashdata('pesan');?>"></div>