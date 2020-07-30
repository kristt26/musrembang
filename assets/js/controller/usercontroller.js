angular.module('userctrl', ['userdata.service'])
    .controller('rencanaKerjaController', rencanaKerjaController)
    .controller('createdRenjaController', createdRenjaController);

function rencanaKerjaController($scope, RenjaService) {
    $scope.datas = [];
    $scope.model = {};
    RenjaService.get().then((x) => {
        $scope.datas = x;
    })
    $scope.simpan = () => {
        RenjaService.post($scope.model).then((x) => {
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
        RenjaService.delete(item.idRencanaBiaya).then((x) => {
            swal("Information!", "Berhasil dihapus", "success");
        })
    }
    $scope.validasi = () => {
        RenjaService.validasi($scope.model).then(x => {
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
        if (!$scope.model.idPeriodeRenker)
            $scope.model.idPeriodeRenker = $scope.datas.periode.idPeriodeRenker;
        var fd = new FormData();
        if($scope.myFile){
            var file = $scope.myFile;
            fd.append('file', file[0]);
        }
            
        for (var prop in $scope.model) {
            fd.append(prop, $scope.model[prop]);
        }
        RenjaService.post(fd).then((x) => {
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
        RenjaService.delete(item.idRencanaBiaya).then((x) => {
            swal("Information!", "Berhasil dihapus", "success");
        })
    }
    $scope.back = () => {
        $window.history.back();
    }
}