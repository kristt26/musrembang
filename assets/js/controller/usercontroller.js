angular.module('userctrl', ['userdata.service'])
    .controller('rencanaKerjaController', rencanaKerjaController)
    .controller('createdRenjaController', createdRenjaController)
    .controller('homeController', homeController);

function rencanaKerjaController($scope, RenjaService) {
    $scope.datas = [];
    $scope.model = {};
    RenjaService.get().then((x) => {
        $scope.datas = x;
        $.LoadingOverlay("hide");
    })
    $scope.simpan = () => {
        $.LoadingOverlay("show", {
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
        });
        RenjaService.post($scope.model).then((x) => {
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
        RenjaService.delete(item.idRencanaBiaya).then((x) => {
            $.LoadingOverlay("hide");
            swal("Information!", "Berhasil dihapus", "success");
        })
    }
    $scope.validasi = () => {
        $.LoadingOverlay("show", {
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
        });
        RenjaService.validasi($scope.model).then(x => {
            $.LoadingOverlay("hide");
            swal("Information!", "Data di validasi", "success");
        })
    }
    $scope.showvalidasi = (item) => {
        $scope.model = item;
        $('#waning-validasi').modal('show');
    }
}

function createdRenjaController($scope, RenjaService, $window, helperServices) {
    $scope.datas = [];
    $scope.service = helperServices;
    $scope.kegiatans = [];
    $scope.model = {};
    $scope.jalans = [];
    $scope.fileTitle = "Drag and drop a file";
    $scope.ChangeFile = (x) => {
        $scope.fileTitle = x.files[0].name;
    }
    RenjaService.getKegiatan().then((x) => {
        $scope.datas = x;
        if (x.data) {
            $scope.model = x.data;
            $scope.datas.data.volume = parseInt($scope.datas.data.volume);
            $scope.kegiatan = $scope.datas.kegiatan.find(x => x.idKegiatan == $scope.datas.data.idKegiatan);
            $scope.lingkungan = $scope.datas.lingkungan.find(x => x.idrt == $scope.datas.data.idrt);
            $scope.sumberanggaran = $scope.datas.sumberanggaran.find(x => x.iddetailrencanabiaya == $scope.datas.data.iddetailrencanabiaya);
            $scope.bidangskpd = $scope.datas.bidangskpd.find(x => x.idbidangskpd == $scope.datas.data.idbidangskpd);
            $scope.jalan = $scope.lingkungan.jalan.find(x => x.idjalan == $scope.datas.data.idjalan);
        }
    })
    $scope.simpan = () => {
        $.LoadingOverlay("show", {
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
        });
        if (!$scope.model.idPeriodeRenker)
            $scope.model.idPeriodeRenker = $scope.datas.periode.idPeriodeRenker;
        var fd = new FormData();
        if ($scope.myFile) {
            var file = $scope.myFile;
            fd.append('file', file[0]);
        }

        for (var prop in $scope.model) {
            fd.append(prop, $scope.model[prop]);
        }
        RenjaService.post(fd).then((x) => {
            $.LoadingOverlay("hide");
            // $scope.model = {};
            swal({
                title: "Information",
                text: "Validasi Berhasil",
                icon: "success",
                // buttons: true,
            })
                .then((param) => {
                    if (param) {
                        $window.location.reload();
                    }
                });
        })
    }
    $scope.validasi = () => {
        $.LoadingOverlay("show", {
            background: "rgba(0, 0, 0, 0.9)",
            image: "./assets/img/preloader.gif",
            imageAnimation: 'none'
        });
        RenjaService.validasi($scope.model).then(x => {
            $window.history.back();
        })
    }
    $scope.showvalidasi = () => {
        if (isEmpty($scope.model))
            swal("Information!", "Tidak ada data yang divalidasi", "error");
        else {
            $('#waning-validasi').modal('show');
        }
    }
    function isEmpty(obj) {
        for (var key in obj) {
            if (obj.hasOwnProperty(key))
                return false;
        }
        return true;
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
        RenjaService.delete(item.idRencanaBiaya).then((x) => {
            $.LoadingOverlay("hide");
            swal("Information!", "Berhasil dihapus", "success");
        })
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

    $scope.back = () => {
        $window.history.back();
    }

}