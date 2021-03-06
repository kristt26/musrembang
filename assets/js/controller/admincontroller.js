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
  .controller('skpdController', skpdController)
  .controller('laporanController', laporanController);


function rencanaKerjaController($scope, RencanaKerjaService) {
  $scope.datas = [];
  $scope.model = {};
  $scope.Final = [];


  RencanaKerjaService.get().then(x => {
    $scope.datas = x;
    $scope.Final = $scope.datas.filter(x => x.status == 'Final');
    $scope.Usulan = $scope.datas.filter(x => x.status == 'Usulan');
    $scope.Tolak = $scope.datas.filter(x => x.status == 'Batal');
    $scope.Laporan = $scope.datas.filter(x => x.status == 'Disetujui');
    $.LoadingOverlay("hide");
  })
  $scope.validasi = (item) => {
    item.setstatus = 'Final'
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
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
          });
          RencanaKerjaService.validasi(item).then(x => {
            $.LoadingOverlay("hide");
            swal("Information", "Validasi Berhasil", "success");
          })
        }
      });
  }
  $scope.showMessage = (item, set)=>{
    item.setstatus = set;
    $scope.model = item;
    $scope.boxTitle = set=="Batal" ? "Alasan Pembatalan": "Alasan Dikembalikan";
    $("#message").modal('show');
  }
  $scope.kembalikan = (item) => {
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
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
          });
          RencanaKerjaService.validasi(item).then(x => {
            $.LoadingOverlay("hide");
            swal("Information", "Validasi Berhasil", "success");

          })
        }
      });
  }
  $scope.tolak = (item) => {
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
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
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
    $scope.model.setstatus = 'Final'
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
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
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
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
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
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
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
    var Data = [];
    $scope.datas.forEach(element => {
      Label.push('No.RW ' + element.norw);
      Data.push(element.kegiatan.length)
      $scope.TotalUsulan += element.kegiatan.length;
      var a = element.kegiatan.filter(x => x.status == 'Disetujui').length;
      $scope.TotalDiterima += a;
      var a = element.kegiatan.filter(x => x.status == 'Batal').length;
      $scope.TotalDitolak += a;
      if (element.kegiatan.length > 0) {
        element.kegiatan.forEach(itemkegiatan => {
          $scope.TotalAnggaranMasuk += parseFloat(itemkegiatan.nominal);
          $scope.TotalAnggaranDiterima += itemkegiatan.status == 'Disetujui' ? parseFloat(itemkegiatan.nominal) : 0;
          $scope.TotalAnggaranDiTolak += itemkegiatan.status == 'Batal' ? parseFloat(itemkegiatan.nominal) : 0;
          element.totalanggaran += itemkegiatan.status == 'Disetujui' ? parseFloat(itemkegiatan.nominal) : 0;
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
    $scope.colortable = window.chartColors.red;
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
    // console.log(color);
    return color;
  }

  $scope.back = () => {
    $window.history.back();
  }

}

function pegawaiController($scope, PegawaiService, $window) {
  $scope.datas = [];
  $scope.model = {};
  $scope.edit = true;
  PegawaiService.get().then((x) => {
    $scope.datas = x;
    $.LoadingOverlay("hide");
  })
  $scope.simpan = () => {
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    PegawaiService.post($scope.model).then((x) => {
      $scope.model = {};
      $.LoadingOverlay("hide");
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
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    PegawaiService.delete(item.idpegawai).then((x) => {
      $.LoadingOverlay("hide");
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function rwController($scope, RwService, $window) {
  $scope.datas = [];
  $scope.model = {};
  $scope.edit = true;
  RwService.get().then((x) => {
    $scope.datas = x;
    $.LoadingOverlay("hide");
  })
  $scope.simpan = () => {
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    RwService.post($scope.model).then((x) => {
      $scope.model = {};
      // $scope.edit = true;
      $.LoadingOverlay("hide");
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
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    RwService.delete(item.idrw).then((x) => {
      $.LoadingOverlay("hide");
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function periodeController($scope, periodeService, $window) {

  $scope.datas = [];
  $scope.model = {};
  periodeService.get().then((x) => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    $scope.datas = x;
    angular.forEach($scope.datas, x => {
      x.mulai = new Date(x.mulai);
      x.berakhir = new Date(x.berakhir);
      // console.log(x.mulai.toLocaleDateString(undefined, options));
      // console.log(x.mulai.toTimeString());
    })
    $.LoadingOverlay("hide");
  })
  $scope.simpan = () => {
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    periodeService.post($scope.model).then((x) => {
      $scope.model = {};
      $.LoadingOverlay("hide");
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
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    periodeService.delete(item.idPeriodeRenker).then((x) => {
      $.LoadingOverlay("hide");
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function rtController($scope, RtService, $window) {
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
    $.LoadingOverlay("hide");
  })
  $scope.simpan = () => {
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    $scope.model.idrw = angular.copy($scope.datas.rw.idrw);
    RtService.post($scope.model).then((x) => {
      $scope.model = {};
      $scope.edit = true;
      $.LoadingOverlay("hide");
      swal("Information!", "Proses Berhasil", "success");
    })
  }
  $scope.simpanJalan = () => {
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    $scope.model.idrt = $scope.rt.idrt;
    RtService.postjalan($scope.model).then(x => {
      $.LoadingOverlay("hide");
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
    $.LoadingOverlay("hide");
  })

  $scope.simpan = () => {
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
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
      $.LoadingOverlay("hide");
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
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.9)",
      image: "./assets/img/preloader.gif",
      imageAnimation: 'none'
    });
    $http({
      method: 'post',
      url: '<?=base_url()?>admin/bidang/simpan',
      data: $scope.model
    }).then(response => {
      $scope.datas.push(response.data);
      console.log($scope.model.idbidang);
      if ($scope.model.idbidang == undefined) {
        $.LoadingOverlay("hide");
        swal("Information!", "Berhasil di ditambahkan", "success").then((value) => {

        });
      } else {
        $.LoadingOverlay("hide");
        swal("Information!", "Berhasil diubah", "success").then((value) => {

        });
      }
    }, error => {
      $.LoadingOverlay("hide");
      swal("Information!", "proses gagal", "error").then((value) => {

      });
    })
  }
}

function rencanaBiayaController($scope, RencanaBiayaService) {

  $scope.datas = [];
  $scope.model = {};
  RencanaBiayaService.get().then((x) => {
    $scope.datas = x;
    $.LoadingOverlay("hide");
  })
  $scope.simpan = () => {
    $.LoadingOverlay("show");
    RencanaBiayaService.post($scope.model).then((x) => {
      $scope.model = {};
      swal("Information!", "Berhasil disimpan", "success");
      $.LoadingOverlay("hide");
    })
  }
  $scope.ubah = (item) => {
    $scope.model = angular.copy(item);
  }
  $scope.clear = () => {
    $scope.model = {};
  }
  $scope.delete = (item) => {
    $.LoadingOverlay("show");
    RencanaBiayaService.delete(item.idRencanaBiaya).then((x) => {
      $.LoadingOverlay("hide");
      swal("Information!", "Berhasil dihapus", "success");
    })
  }
}

function profileController($scope, $http, ProfileService, helperServices) {
  $scope.model = {};
  $scope.img;
  ProfileService.get().then(data => {
    if (data.length !== 0)
      $scope.model = data;
    $scope.img = '<img class="card-img-top" src="' + helperServices.url + "/assets/img/" + data.logo + '">';
    $.LoadingOverlay("hide");
  })
  $scope.simpan = () => {
    ProfileService.post($scope.model).then((x) => {
      swal("Information!", "Berhasil disimpan", "success");
    })
  }
  $scope.uploadFile = function () {
    ProfileService.upload($scope.files).then(x => {
      $scope.img = '<img class="card-img-top" src="' + helperServices.url + "/assets/img/" + x.logo + '">';
      swal("Information!", "Logo Berhasil ditambahkan", "success");
    })
  }
}

function bidangController($scope, $http, BidangService, helperServices) {
  $scope.datas = [];
  $scope.model = {};
  $scope.daftarKegiatan = false;
  $scope.listKegiatan = {};
  BidangService.get().then(x => {
    $scope.datas = x;
    $.LoadingOverlay("hide");
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
    $.LoadingOverlay("show");
    console.log($scope.model);
    $http({
      method: 'post',
      url: helperServices.url + '/admin/kegiatan/simpan',
      data: $scope.model
    }).then(response => {

      $('#addkegiatan').modal("hide");
      $.LoadingOverlay("hide");
      if ($scope.model.idKegiatan == undefined) {
        $scope.listKegiatan.kegiatan.push(response.data);
        swal("Information!", "Berhasil di ditambahkan", "success").then((value) => {

        });
      } else {
        swal("Information!", "Berhasil diubah", "success").then((value) => {

        });
      }
    }, error => {
      $.LoadingOverlay("hide");
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
  $scope.ubahKegiatan = (item) => {
    $scope.model = item;
    $('#addkegiatan').modal("show");
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
  $scope.datas = [];
  $scope.model = {};
  SkpdService.get().then((x) => {
    $scope.datas = x;
    $.LoadingOverlay("hide");
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

function laporanController($scope, LaporanService, helperServices) {
  $scope.idIndex;
  $scope.datas = [];
  $scope.periodes = [];
  $scope.model = {};
  $scope.idKegiatans
  $scope.hasil = 0;
  $scope.tanggal = new Date();
  $scope.convert = (item) => {
    $scope.hasil += parseFloat(item);
  }
  LaporanService.get().then((x) => {
    $scope.periodes = x;
    $.LoadingOverlay("hide");
  });
  $scope.getData = (idPeridoeRenker) => {
    $.LoadingOverlay("show");
    LaporanService.getLaporan(idPeridoeRenker).then((x) => {
      $scope.datas = x.filter(x => x.rencanakerja.length != 0);
      $.LoadingOverlay("hide");
    })
  }
  $scope.romanize = (number) => {
    return helperServices.romanize(number);
  };
  // $scope.Cetak = () => {
  //   $(document).ready(function (e) {
  //     // aksi ketika tombol cetak ditekan
  //     $("#cetak").bind("click", function (event) {
  //       // cetak data pada area <div id="#data-mahasiswa"></div>
  //       $('#print').printArea();
  //     });
  //   });
  // }
}