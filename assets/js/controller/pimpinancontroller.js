angular.module('ctrl', ['ngSanitize'])
  .controller('rencanaKerjaController', rencanaKerjaController)
  .controller('detailRencanaKerjaController', detailRencanaKerjaController)
  .controller('homeController', homeController)
  .controller('pegawaiController', pegawaiController)
  .controller('rwController', rwController)
  .controller('periodeController', periodeController)
  .controller('rtController', rtController)
  .controller('anggaranBiayaController', anggaranBiayaController)
  .controller('rencanaBiayaController', rencanaBiayaController)
  .controller('profileController', profileController)
  .controller('bidangController', bidangController)
  .controller('skpdController', skpdController);


function rencanaKerjaController($scope, RencanaKerjaService) {
  $scope.datas = [];
  $scope.model = {};
  $scope.Final = [];


  RencanaKerjaService.get().then(x => {
    $scope.datas = x;
    $scope.Final = $scope.datas.filter(x => x.status == 'Final');
    $scope.Disetujui = $scope.datas.filter(x => x.status == 'Disetujui');
    $scope.Tolak = $scope.datas.filter(x => x.status == 'Batal');
    $.LoadingOverlay("hide");
  })
  $scope.validasi = (item) => {
    item.setstatus = 'Disetujui'
    swal({
      title: "Anda Yakin?",
      text: "Akan Melakukan Pembatalan?",
      icon: "warning",

      buttons: true,
      dangerMode: false,
    })
      .then((value) => {
        if (value) {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          RencanaKerjaService.validasi(item).then(x => {
            $.LoadingOverlay("hide");
            swal("Information", "Validasi Berhasil", "success");
          })
        }
      });
  }
  $scope.kembalikan = (item) => {
    item.setstatus = 'Draf'
    swal({
      title: "Anda Yakin?",
      text: "Akan Melakukan Pembatalan?",
      icon: "warning",

      buttons: true,
      dangerMode: false,
    })
      .then((value) => {
        if (value) {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          RencanaKerjaService.validasi(item).then(x => {
            $.LoadingOverlay("hide");
            swal("Information", "Validasi Berhasil", "success");

          })
        }
      });
  }
  $scope.tolak = (item) => {
    item.setstatus = 'Batal'
    swal({
      title: "Anda Yakin?",
      text: "Akan Melakukan Pembatalan?",
      icon: "warning",

      buttons: true,
      dangerMode: false,
    })
      .then((value) => {
        if (value) {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          RencanaKerjaService.validasi(item).then(x => {
            $.LoadingOverlay("hide");
            swal("Information", "Validasi Berhasil", "success");

          })
        }
      });
  }
}

function detailRencanaKerjaController($scope, DetailRencanaKerjaService, $window) {
  $scope.datas = [];
  $scope.model = {};
  DetailRencanaKerjaService.get().then(param => {
    $scope.datas = param;
    $scope.model = $scope.datas.data
    $scope.bidangskpd = $scope.datas.bidangskpd.find(x => x.idbidangskpd == $scope.model.idbidangskpd);
    $scope.sumberanggaran = $scope.datas.sumberanggaran.find(x => x.idRencanaBiaya == $scope.model.idRencanaBiaya);
    $.LoadingOverlay("hide");
  })
  $scope.validasi = () => {
    $scope.model.setstatus = 'Disetujui'
    swal({
      title: "Anda Yakin?",
      text: "Akan Melakukan Pembatalan?",
      icon: "warning",
      buttons: true,
      dangerMode: false,
    })
      .then((value) => {
        if (value) {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          DetailRencanaKerjaService.validasi($scope.model).then(x => {
            $.LoadingOverlay("hide");
            swal({
              title: "Information",
              text: "Validasi Berhasil",
              icon: "success",
              // buttons: true,
            })
              .then((param) => {
                if (param) {
                  $window.history.back();
                }
              });
          })
        }
      });
  }
  $scope.kembalikan = () => {
    $scope.model.setstatus = 'Draf'
    swal({
      title: "Anda Yakin?",
      text: "Akan Melakukan Pembatalan?",
      icon: "warning",

      buttons: true,
      dangerMode: false,
    })
      .then((value) => {
        if (value) {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          DetailRencanaKerjaService.validasi($scope.model).then(x => {
            $.LoadingOverlay("hide");
            swal({
              title: "Information",
              text: "Proses pengembalian berkas berhasil",
              icon: "success",
            })
              .then((param) => {
                if (param) {
                  $window.history.back();
                }
              });
          })
        }
      });
  }
  $scope.tolak = (item) => {
    $scope.model.setstatus = 'Batal'
    swal({
      title: "Anda Yakin?",
      text: "Akan Melakukan Pembatalan?",
      icon: "warning",

      buttons: true,
      dangerMode: false,
    })
      .then((value) => {
        if (value) {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          DetailRencanaKerjaService.validasi($scope.model).then(x => {
            $.LoadingOverlay("hide");
            swal({
              title: "Information",
              text: "Proses pengembalian berkas berhasil",
              icon: "success",
            })
              .then((param) => {
                if (param) {
                  $window.history.back();
                }
              });

          })
        }
      });
  }
  $scope.back = () => {
    $window.history.back();
  }
}

function homeController($scope, HomeService, $window) {
  $scope.datas = [];
  $scope.model = {};
  $scope.TotalUsulan = 0;
  $scope.TotalDiterima = 0;
  $scope.TotalDitolak = 0;
  $scope.TotalAnggaranMasuk = 0;
  $scope.TotalAnggaranDiterima = 0;
  $scope.TotalAnggaranDiTolak = 0;
  
  HomeService.get().then((x) => {
    $scope.datas = x;
    var Label = [];
    var Data =[];
    $scope.datas.forEach(element => {
      Label.push('No.RW ' + element.norw);
      Data.push(element.kegiatan.length)
      $scope.TotalUsulan += element.kegiatan.length;
      var a = element.kegiatan.filter(x=>x.status=='Disetujui').length;
      $scope.TotalDiterima += a;
      var a = element.kegiatan.filter(x=>x.status=='Batal').length;
      $scope.TotalDitolak += a;
      if(element.kegiatan.length > 0){
        element.kegiatan. forEach(itemkegiatan =>{
          $scope.TotalAnggaranMasuk += parseFloat(itemkegiatan.nominal);
          $scope.TotalAnggaranDiterima += itemkegiatan.status=='Disetujui' ? parseFloat(itemkegiatan.nominal):0;
          $scope.TotalAnggaranDiTolak += itemkegiatan.status=='Batal' ? parseFloat(itemkegiatan.nominal):0;
          element.totalanggaran +=  itemkegiatan.status=='Disetujui' ? parseFloat(itemkegiatan.nominal):0;
        })
      }
    });
    var ctx = document.getElementById('myChart').getContext('2d');
    
    // var Data = [12, 19, 3, 5, 2, 3];
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: Label,
        datasets: [
          {
            label: 'Total Pengajuan',
            data: Data,
            backgroundColor: random_rgba(Data.length)
            // [
            // 	'rgba(255, 99, 132, 0.2)',
            // 	'rgba(54, 162, 235, 0.2)',
            // 	'rgba(255, 206, 86, 0.2)',
            // 	'rgba(75, 192, 192, 0.2)',
            // 	'rgba(153, 102, 255, 0.2)',
            // 	'rgba(255, 159, 64, 0.2)'
            // ],
            // borderColor: [
            // 	'rgba(255, 99, 132, 1)',
            // 	'rgba(54, 162, 235, 1)',
            // 	'rgba(255, 206, 86, 1)',
            // 	'rgba(75, 192, 192, 1)',
            // 	'rgba(153, 102, 255, 1)',
            // 	'rgba(255, 159, 64, 1)'
            // ],
            // borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Nomor RW'
            }
          }],
          yAxes: [
            {
              ticks: {
                beginAtZero: true
              },
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Jumlah Pengajuan'
              }
            }
          ]
        }
      }
    });
    var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
            $scope.TotalDiterima,
            $scope.TotalDitolak
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Usulan Diterima',
					'Usulan Ditolak'
				]
			},
			options: {
				responsive: true
			}
		};
    var diterima = document.getElementById('chart-diterima').getContext('2d');
    window.myPie = new Chart(diterima, config);
    $.LoadingOverlay("hide");
  })

  var random_rgba = (length) => {
    var color = [];
    for (let index = 0; index < length; index++) {
      var o = Math.round, r = Math.random, s = 255;
      color.push('rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + 0.7 + ')');
    }
    console.log(color);
    return color;
  }
}

function pegawaiController($scope, PegawaiService, $window) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  $scope.edit = true;
  PegawaiService.get().then((x) => {
    $scope.datas = x;
  })
  $scope.simpan = () => {
    PegawaiService.post($scope.model).then((x) => {
      $scope.model = {};
      swal("Information!", "Berhasil disimpan", "success");
    })
  }
  $scope.ubah = (item) => {
    $scope.model = angular.copy(item);
    $scope.edit = false;
  }
  $scope.clear = () => {
    $scope.model = {};
    $scope.edit = true;
  }
  $scope.delete = (item) => {
    PegawaiService.delete(item.idpegawai).then((x) => {
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function rwController($scope, RwService, $window) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  $scope.edit = true;
  RwService.get().then((x) => {
    $scope.datas = x;
  })
  $scope.simpan = () => {
    RwService.post($scope.model).then((x) => {
      $scope.model = {};
      $scope.edit = true;
      swal("Information!", "Proses Berhasil", "success");
    })
  }
  $scope.ubah = (item) => {
    $scope.model = angular.copy(item);
    $scope.edit = false;
  }
  $scope.clear = () => {
    $scope.model = {};
    $scope.edit = true;
  }
  $scope.delete = (item) => {
    RwService.delete(item.idrw).then((x) => {
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function periodeController($scope, periodeService, $window) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  periodeService.get().then((x) => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    $scope.datas = x;
    angular.forEach($scope.datas, x => {
      x.mulai = new Date(x.mulai);
      x.berakhir = new Date(x.berakhir);
      console.log(x.mulai.toLocaleDateString(undefined, options));
      console.log(x.mulai.toTimeString());
    })
  })
  $scope.simpan = () => {
    periodeService.post($scope.model).then((x) => {
      $scope.model = {};
      swal("Information!", "Berhasil disimpan", "success");
    })
  }
  $scope.ubah = (item) => {
    $scope.model = angular.copy(item);
  }
  $scope.clear = () => {
    $scope.model = {};
  }
  $scope.delete = (item) => {
    periodeService.delete(item.idPeriodeRenker).then((x) => {
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function rtController($scope, RtService, $window) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  $scope.edit = false;
  $scope.ShowJalan = false;
  $scope.jalan = [];
  $scope.rt = {};
  $scope.tombol = 'Simpan';
  $scope.tomboljalan = '';
  RtService.get().then((x) => {
    $scope.datas = x;
  })
  $scope.simpan = () => {
    $scope.model.idrw = angular.copy($scope.datas.rw.idrw);
    RtService.post($scope.model).then((x) => {
      $scope.model = {};
      $scope.edit = true;
      swal("Information!", "Proses Berhasil", "success");
    })
  }
  $scope.simpanJalan = () => {
    $scope.model.idrt = $scope.rt.idrt;
    RtService.postjalan($scope.model).then(x => {
      swal("Information!", "Proses Berhasil", "success");
      $scope.model = {};
    });
  }
  $scope.ubah = (item) => {
    $scope.model = angular.copy(item);
    $scope.edit = true;
    $scope.tombol = 'Ubah';
    $scope.tomboljalan = 'Ubah'
  }
  $scope.clear = () => {
    $scope.model = {};
    $scope.edit = false;
    $scope.tombol = 'Simpan';
  }
  $scope.clearjalan = () => {
    $scope.model = {};
    $scope.tomboljalan = 'Simpan'
  }
  $scope.detailjalan = (item) => {
    $scope.model = {};
    $scope.tomboljalan = 'Simpan'
    $scope.jalan = item.jalan;
    $scope.rt = item;
    $scope.ShowJalan = true;
  }
  $scope.back = () => {
    $window.history.back();
  }
}

function anggaranBiayaController($scope, $http, AnggaranBiayaService, helperServices, $window) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  $scope.daftarKegiatan = false;
  $scope.listKegiatan = {};
  $scope.rencanabiaya = [];
  $scope.tombol = "Simpan"
  $scope.periode = {};
  $scope.itemRencanaBiaya = {};
  AnggaranBiayaService.get().then((x) => {
    $scope.datas = x;
    $scope.datas.rencanabiaya.forEach(value => {
      if ($scope.datas.detailrencanabiaya.find(x => x.idRencanaBiaya == value.idRencanaBiaya) == undefined)
        $scope.rencanabiaya.push(value);
    })
  })

  $scope.simpan = () => {
    $scope.model.idRencanaBiaya = $scope.itemRencanaBiaya.idRencanaBiaya;
    $scope.model.NamaRencanaBiaya = $scope.itemRencanaBiaya.NamaRencanaBiaya;
    $scope.model.idPeriodeRenker = $scope.datas.periode.idPeriodeRenker;
    $scope.model.Tahun = $scope.periode.Tahun;
    AnggaranBiayaService.post($scope.model).then(x => {
      if ($scope.model.iddetailrencanabiaya)
        $scope.tombol = "Simpan"
      $scope.rencanabiaya = [];
      $scope.model = {};
      $scope.datas.rencanabiaya.forEach(value => {
        if ($scope.datas.detailrencanabiaya.find(x => x.idRencanaBiaya == value.idRencanaBiaya) == undefined)
          $scope.rencanabiaya.push(angular.copy(value));
      })
      swal("Information!", "Berhasil di ditambahkan", "success");
    })

  }

  $scope.ubah = (item) => {
    $scope.model = item;
    $scope.itemRencanaBiaya = $scope.datas.rencanabiaya.find(x => x.idRencanaBiaya == item.idRencanaBiaya)
    $scope.cetak = true;
    $scope.tombol = "Ubah"
  }

  $scope.clear = () => {
    $scope.model = {};
    $scope.model.jenis = [];
    $scope.tombol = "Simpan"
    $scope.cetak = false;
  }

  $scope.back = () => {
    $window.history.back();
  }

  $scope.hapus = () => {
    $http({
      method: 'post',
      url: '<?=base_url()?>admin/bidang/simpan',
      data: $scope.model
    }).then(response => {
      $scope.datas.push(response.data);
      console.log($scope.model.idbidang);
      if ($scope.model.idbidang == undefined) {
        swal("Information!", "Berhasil di ditambahkan", "success").then((value) => {

        });
      } else {
        swal("Information!", "Berhasil diubah", "success").then((value) => {

        });
      }
    }, error => {
      swal("Information!", "proses gagal", "error").then((value) => {

      });
    })
  }
}

function rencanaBiayaController($scope, RencanaBiayaService) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  RencanaBiayaService.get().then((x) => {
    $scope.datas = x;
  })
  $scope.simpan = () => {
    RencanaBiayaService.post($scope.model).then((x) => {
      $scope.model = {};
      swal("Information!", "Berhasil disimpan", "success");
    })
  }
  $scope.ubah = (item) => {
    $scope.model = angular.copy(item);
  }
  $scope.clear = () => {
    $scope.model = {};
  }
  $scope.delete = (item) => {
    RencanaBiayaService.delete(item.idRencanaBiaya).then((x) => {
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function profileController($scope, $http, ProfileService, helperServices) {
  $.LoadingOverlay("hide");
  $scope.model = {};
  $scope.img;
  ProfileService.get().then(data => {
    if (data.length !== 0)
      $scope.model = data;
    $scope.img = '<img class="card-img-top" src="' + helperServices.url + "/musrembang/assets/img/" + data.logo + '">';
  })
  $scope.simpan = () => {
    ProfileService.post($scope.model).then((x) => {
      swal("Information!", "Berhasil disimpan", "success");
    })
  }
  $scope.uploadFile = function () {
    ProfileService.upload($scope.files).then(x => {
      $scope.img = '<img class="card-img-top" src="' + helperServices.url + "/musrembang/assets/img/" + x.logo + '">';
      swal("Information!", "Logo Berhasil ditambahkan", "success");
    })
  }
}

function bidangController($scope, $http, BidangService) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  $scope.daftarKegiatan = false;
  $scope.listKegiatan = {};
  BidangService.get().then(x => {
    $scope.datas = x;
  })
  $scope.selected = (item) => {
    if (item) {
      item.berat = 0;
      item.jumlah = 0;
      item.bayar = 0;
      item.total = 0;
      $scope.model.jenis.push(angular.copy(item));
    }
  }
  $scope.simpan = () => {
    BidangService.post($scope.model).then((x) => {
      swal("Information!", "Berhasil di ditambahkan", "success")
    })
  }
  $scope.simpanKegiatan = () => {
    console.log($scope.model);
    $http({
      method: 'post',
      url: '<?=base_url()?>admin/kegiatan/simpan',
      data: $scope.model
    }).then(response => {
      $scope.listKegiatan.kegiatan.push(response.data)
      $('#addkegiatan').modal("hide");
      if ($scope.model.idKegiatan == undefined) {
        swal("Information!", "Berhasil di ditambahkan", "success").then((value) => {

        });
      } else {
        swal("Information!", "Berhasil diubah", "success").then((value) => {

        });
      }
    }, error => {
      swal("Information!", "proses gagal", "error").then((value) => {

      });
    })
  }
  $scope.showKegiatan = (item) => {
    $scope.listKegiatan = item
    $scope.daftarKegiatan = true;
    $scope.model.idbidang = item.idbidang;
    console.log($scope.listKegiatan);
  }
  $scope.ubah = (item) => {
    $scope.model = item;
    var cektanggal = typeof $scope.model.tgl_ambil;
    if (cektanggal == "string") {
      var tgl = $scope.model.tgl_ambil.split('-');
      $scope.model.tgl_ambil = new Date(tgl[0], tgl[1] - 1, tgl[2]);
    }
    angular.forEach(item.jenis, value => {
      value.berat = parseInt(value.berat);
      value.jumlah = parseInt(value.jumlah);
    })
    $scope.cetak = true;
    $scope.tombol = "Ubah"
  }

  $scope.clear = () => {
    $scope.model = {};
    $scope.model.jenis = [];
    $scope.tombol = "Simpan"
    $scope.cetak = false;
  }

  $scope.print = () => {
    $http({
      method: 'get',
      url: '<?= base_url()?>admin/profile/getprofile'
    }).then(params => {
      $scope.dataprint = params.data;
      setTimeout(function () {
        $('#data-print').printArea();
      }, 500);

    })

  }

  $scope.hapus = () => {
    $http({
      method: 'post',
      url: '<?=base_url()?>admin/bidang/simpan',
      data: $scope.model
    }).then(response => {
      $scope.datas.push(response.data);
      console.log($scope.model.idbidang);
      if ($scope.model.idbidang == undefined) {
        swal("Information!", "Berhasil di ditambahkan", "success").then((value) => {

        });
      } else {
        swal("Information!", "Berhasil diubah", "success").then((value) => {

        });
      }
    }, error => {
      swal("Information!", "proses gagal", "error").then((value) => {

      });
    })
  }
}

function skpdController($scope, SkpdService) {
  $.LoadingOverlay("hide");
  $scope.datas = [];
  $scope.model = {};
  SkpdService.get().then((x) => {
    $scope.datas = x;
  })
  $scope.simpan = () => {
    SkpdService.post($scope.model).then((x) => {
      $scope.model = {};
      swal("Information!", "Berhasil disimpan", "success");
    })
  }
  $scope.ubah = (item) => {
    $scope.model = item
  }
  $scope.clear = () => {
    $scope.model = {};
  }
  $scope.delete = (item) => {
    SkpdService.delete(item.idbidangskpd).then((x) => {
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}