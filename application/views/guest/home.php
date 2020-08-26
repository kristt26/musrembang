<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en" ng-app="guestapp" ng-controller="guestController" ng-init="Init()">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="<?=base_url();?>assets/img/logo.png">
	<title><?=$title['header']?></title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/styleguest.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
		integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/plugins/angular-datatables/dist/css/angular-datatables.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/guest.css">

	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
	<script src="<?=base_url();?>assets/js/plugins/angular.min.js"></script>
	<script src="<?=base_url();?>assets/js/plugins/angular-sanitize.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<style type="text/css">
		.dashboard-stat {
			display: block;
			margin-bottom: 25px;
			overflow: hidden;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			-ms-border-radius: 4px;
			-o-border-radius: 4px;
			border-radius: 4px;
		}

		.dashboard-stat.grey {
			background-color: #E5E5E5;
		}

		.dashboard-stat:before,
		.dashboard-stat:after {
			content: " ";
			display: table;
		}

		.dashboard-stat .visual {
			width: 80px;
			height: 80px;
			display: block;
			float: left;
			padding-top: 10px;
			padding-left: 15px;
			margin-bottom: 15px;
			font-size: 35px;
			line-height: 35px;
		}

		.dashboard-stat .visual>i {
			margin-left: -35px;
			font-size: 110px;
			line-height: 110px;
		}

		.dashboard-stat.grey .visual>i {
			color: #333333;
			opacity: 0.1;
			filter: alpha(opacity=10);
		}

		.dashboard-stat .details {
			position: absolute;
			right: 15px;
			padding-right: 15px;
		}

		.dashboard-stat .details .number {
			padding-top: 10px;
			text-align: right;
			font-size: 50px;
			line-height: 50px;
			letter-spacing: -1px;
			margin-bottom: 0px;
			font-weight: 700;
		}

		.dashboard-stat.grey .details .number {
			color: #333333;
		}

		.dashboard-stat .details .desc {
			text-align: right;
			font-size: 16px;
			letter-spacing: 0px;
			font-weight: 300;
		}

		.dashboard-stat.grey .details .desc {
			color: #333333;
			opacity: 1;
			filter: alpha(opacity=100);
		}

		.dashboard-stat:after {
			clear: both;
		}

		.dashboard-stat.blue {
			background-color: #3598dc;
		}

		.dashboard-stat.red {
			background-color: #cb5a5e;
		}

		.dashboard-stat.green {
			background-color: #26a69a;
		}

		.dashboard-stat.purple {
			background-color: #8e5fa2;
		}

		.dashboard-stat.blue .details .number,
		.dashboard-stat.red .details .number,
		.dashboard-stat.green .details .number,
		.dashboard-stat.purple .details .number {
			color: #FFFFFF;
		}

		.dashboard-stat.blue .details .desc,
		.dashboard-stat.red .details .desc,
		.dashboard-stat.green .details .desc,
		.dashboard-stat.purple .details .desc {
			color: #FFFFFF;
			opacity: 1;
			filter: alpha(opacity=100);
		}

		.dashboard-stat.blue .visual>i,
		.dashboard-stat.red .visual>i,
		.dashboard-stat.green .visual>i,
		.dashboard-stat.purple .visual>i {
			color: #FFFFFF;
			opacity: 0.1;
			filter: alpha(opacity=10);
		}
	</style>
</head>

<body class="hold-transition layout-top-nav">
	<nav class="navbar navbar-default navbar-fixed-top animated slideInDown" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>
				<a href="" class="navbar-brand">
					<!-- <img src="https://e-musrenbang.samarindakota.go.id/img/logo-dark.png" alt="" class="sembunyi"> -->
					<h3 style="color:green">
						MUSRENBANG KELURAHAN<br />
						<!-- <span>Badan Perencanaan dan Pembangunan Daerah</span> -->
					</h3>
				</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-fw fa-home"></i> BERANDA</a>
						<div class="magic_line"></div>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
							aria-expanded="false"><i class="fa fa-fw fa-clone"></i> ARSIP<span class="caret"></span></a>
						<div class="magic_line"></div>
						<ul class="dropdown-menu">
							<?php foreach ($title['tahun'] as $value): ?>
							<li><a href="<?=base_url() . 'home/index/' . $value->idPeriodeRenker?>"><?=$value->Tahun?></a></li>
							<?php endforeach;?>
						</ul>
					</li>
					<li>
						<a href="<?=base_url('authorization')?>"><i class="fa fa-fw fa-user"></i> LOGIN</a>
						<div class="magic_line"></div>
					</li>
				</ul>
			</div>
		</div>
	</nav>


	<div class="wrapper" id="home">
		<div class="home-content">
			<div class="welcome animated bounceInLeft">
				<div class="welcome-desc">
					<img src="<?=base_url('assets/img/logo.png')?>" alt="" width="100" style="margin-bottom: 10px;">
					<p class="welcome-top">MUSRENBANG KELURAHAN HAMADI</p>
					<h1 class="anim--tahun"><span>Tahun</span> <span><?=$title['periode']->Tahun?></span></h1>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<br />
						<p>Informasi yang disajikan pada halaman ini adalah data usulan musrembang</p>
						<hr />
						<div class="row">
							<div class="col-lg-4 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<h3>{{TotalUsulan | number}}</h3>

										<p>Usulan Masuk</p>
										<div class="chip z-depth-4 shadow-demo">Rp. {{TotalAnggaranMasuk | number}}
										</div>
									</div>
									<div class="icon">
										<i class="fas fa-database"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-6">
								<div class="small-box bg-success">
									<div class="inner">
										<h3>{{TotalDiterima | number}}</h3>
										<p>Usulan Diterima</p>
										<div class="chip z-depth-4 shadow-demo">Rp. {{TotalAnggaranDiterima | number}}
										</div>
									</div>
									<div class="icon">
										<i class="fas fa-database"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-6">
								<div class="small-box bg-danger">
									<div class="inner">
										<h3>{{TotalDitolak | number}}</h3>

										<p>Usulan Ditolak</p>
										<div class="chip z-depth-4 shadow-demo">Rp. {{TotalAnggaranDiTolak | number}}
										</div>
									</div>
									<div class="icon">
										<i class="fas fa-database"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr />
						<div class="row">
							<div class="col-md-12">
								<div id="urusan" style="min-width: 310px; margin: 0 auto"></div>
								<hr />
								<br />

								<div class="table-responsive">
									<table class="table table-bordered">
										<thead style="background-color: 255, 99, 132, 0.8">
											<tr>
												<th class="text-center align-middle" style="width: 10px">No</th>
												<th class="text-center align-middle">RW</th>
												<th class="text-center align-middle">Jumlah RT</th>
												<th class="text-center align-middle">Total Usulan</th>
												<th class="text-center align-middle">Total Usulan Diterima</th>
												<th class="text-center align-middle">Total Usulan Ditolak</th>
												<th class="text-center align-middle">Total Anggaran<br>(Rp.)</th>
											</tr>
										</thead>
										<tbody>
											<tr ng-repeat="item in datas">
												<td>{{$index+1}}</td>
												<td>{{item.norw}}</td>
												<td>{{item.totalrt}}</td>
												<td>{{item.totalrencanakerja}}</td>
												<td>{{item.totaldisetujui}}</td>
												<td>{{item.totalbatal}}</td>
												<td class="text-right align-middle">{{item.totalanggaran | number}}
													<span class="hidden-sm">{{sumtotal(item.totalanggaran)}}</span></td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="6"><strong>Total</strong></td>
												<td class="text-right align-middle"><strong>{{total | number}}</strong>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
								<br /><br />
								<hr />
								<div id="serapan" style="height: 700px"></div>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr />
						<div class="row">
							<form>
								<div class="form-group">
									<label for="skpd" class="col-md-3 control-label">No RW</label>
									<div class="col-md-6">
										<select class="form-control"
											ng-options="item as ('RW '+ ' '+item.norw) for item in datas" ng-model="rw"
											ng-change="setModel(rw)">
											<option>-- Pilih RW --</option>
										</select>
									</div>
								</div>
							</form>
							<table id="example2" datatable="ng" class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="align-middle text-center" style="width: 10px">No</th>
										<th class="align-middle text-center">Bidang/Kegiatan</th>
										<th class="align-middle text-center">Lokasi</th>
										<th class="align-middle text-center">Volume/Satuan</th>
										<th class="align-middle text-center">Bidang SKPD</th>
										<th class="align-middle text-center">Status Usulan</th>
										<th class="align-middle text-center text-wrap">Usulan Anggaran<br>(Rp.)</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="ajuan in model.kegiatan">
										<td>{{$index+1}}</td>
										<td>{{ajuan.NamaKegiatan}}</td>
										<td>{{ajuan.jalan}}, RT. {{ajuan.nort}}</td>
										<td>{{ajuan.volume}} {{ajuan.satuan}}</td>
										<td>{{ajuan.NamaBidangSkpd}}</td>
										<td>{{ajuan.status}}</td>
										<td class="text-right">{{ajuan.nominal | currency:''}} <span
												class="d-none">{{convert(ajuan.nominal)}}</span></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="6" class="text-center">Total</td>
										<td class="text-right"><b>{{hasil | currency: ''}}</b></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>


			</div>
		</div>

		<div class="footer animated bawah slideInUp ">
			<div class="pull-right text-right hidden-xs">
				Hamadi, Jayapura Sel., Kota Jayapura, Papua<br>
				Telp. <strong>(0967) ....</strong> • Fax.<strong>(0967) ...</strong> •
				Email : <strong><a href="">.....</a></strong>
			</div>
			<div>
				&copy; 2020 - Kantor Kelurahan Hamadi <span
					class="hidden-xs">Kota Jayapura</span><br>
			</div>
		</div>

	</div>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
		integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
		crossorigin="anonymous"></script>
	<script src="<?=base_url()?>assets/js/guestapp.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/controller/guestcontroller.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/directives.js"></script>
	<script type="text/javascript"
		src="<?php echo base_url(); ?>assets/plugins/angular-datatables/dist/angular-datatables.min.js"></script>
	<script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript"
		src="<?php echo base_url(); ?>assets/js/plugins/input-mask/angular-input-masks-standalone.min.js"></script>
	<script type="text/javascript"
		src="<?php echo base_url(); ?>assets/bower_components/jquery-loading-overlay/dist/loadingoverlay.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
	<!-- <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
	<script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/angular-locale_id-id.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery.PrintArea.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/services/helper.services.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/services/guest.services.js"></script>
	<script>
		$("#example1").DataTable({
			"responsive": false,
			"autoWidth": true,
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
		$.LoadingOverlay("show", {
			image: "",
			fontawesome: "fas fa-cog fa-spin"
		});
	</script>
</body>

</html>