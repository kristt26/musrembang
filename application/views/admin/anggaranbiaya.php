<div class="row" ng-app="app" ng-controller="anggaranBiayaController">
<div class="col-md-12">
  <bottom class="btn btn-secondary btn-sm float-right" style="margin-bottom:12px;" ng-click="back()">
    <i class="fas fa-arrow-left"></i>Kembali
  </bottom>
</div>
  <div class="col-md-4">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Anggaran Biaya</h3>
        
      </div>
      <form ng-submit="simpan()" enctype="multipart/form-data">
        <div class="card-body" style="height: 210px">
          <div class="form-group" id="kd_pemesanan">
            <label for="id" class="col-form-label">Anggaran<sup style="color:red;">*</sup></label>
            <div ng-show="tombol=='Simpan'">
              <select class="form-control select2" ng-options="item as item.NamaRencanaBiaya for item in rencanabiaya" style="width: 100%;" ng-model="itemRencanaBiaya" required>
                <option></option>
              </select>
            </div>
            <input ng-show="tombol=='Ubah'" type="text" class="form-control" ng-model="model.NamaRencanaBiaya" disabled>
          </div>
          <div class="form-group">
            <label for="tgl_ambil" class="col-form-label">Nilai Anggaran<sup style="color:red;">*</sup></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp. </span>
              </div>
              <input type="text" class="form-control text-right" ng-model="model.nominal" ui-number-mask="0" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">{{tombol}}</button>
          <button type="button" class="btn btn-default">Batal</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-danger" style="padding-bottom:10px" >
      <div class="card-header">
        <h3 class="card-title">Data Anggaran Periode Tahun {{datas.periode.Tahun}} </h3>
      </div>
      <div class="card-body" style="height: 270px; overflow-y:auto">
        <table class="table table-sm table-bordered" >
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Anggaran</th>
              <th>Besar Anggaran</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody >
            <tr ng-repeat="item in datas.detailrencanabiaya">
              <td>{{$index+1}}</td>
              <td>{{item.NamaRencanaBiaya}}</td>
              <td class="text-right">{{item.nominal | currency:''}}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <bottom class="btn btn-default" title="Edit Bidang" ng-click="ubah(item)">
                    <ion-icon name="create-outline"></ion-icon>
                  </bottom>
                  <!-- <bottom class="btn btn-info" title="Daftar Kegiatan" ng-click="showKegiatan(item);">
                    <ion-icon name="eye-outline"></ion-icon>
                  </bottom> -->
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12" ng-if="daftarKegiatan">
    <div class="card card-danger">
      <div class="card-header justify-content-between">
        <h3 class="card-title">Data Bidang</h3>
        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addkegiatan"><i class="fas fa-plus"></i></a>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px" class="text-center">No</th>
              <th class="text-center">Kode Kegiatan</th>
              <th class="text-center">Nama Kegiatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in listKegiatan.kegiatan">
              <td>{{$index+1}}</td>
              <td>{{item.KodeKegiatan}}</td>
              <td>{{item.NamaKegiatan}}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <bottom class="btn btn-default" title="Edit Kegiatan" ng-click="ubahKegiatan(item)">
                    <ion-icon name="create-outline"></ion-icon>
                  </bottom>
                  <bottom class="btn btn-info" title="Daftar Kegiatan" ng-click="delete(item)">
                    <ion-icon name="eye-outline"></ion-icon>
                  </bottom>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  angular.module('app', ['data.service', 'helper.service', 'ui.utils.masks'])
  .directive('format', ['$filter', function ($filter) {
      return {
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
          if (!ctrl) return;

          ctrl.$formatters.unshift(function (a) {
            return $filter(attrs.format)(ctrl.$modelValue, attrs.format == 'currency' ? ' ' : null)
          });

          elem.bind('blur', function (event) {
            var plainNumber = elem.val().replace(/[^\d|\-+|\.+]/g, '');
            elem.val($filter(attrs.format)(plainNumber));
          });
        }
      };
    }])
    .controller('anggaranBiayaController', function ($scope, $http, AnggaranBiayaService, helperServices, $window) {
      $scope.datas = [];
      $scope.model = {};
      $scope.daftarKegiatan = false;
      $scope.listKegiatan = {};
      $scope.rencanabiaya = [];
      $scope.tombol = "Simpan"
      $scope.periode = {};
      $scope.itemRencanaBiaya = {};
      AnggaranBiayaService.get().then((x)=>{
        $scope.datas = x;
        $scope.datas.rencanabiaya.forEach(value=>{
          if($scope.datas.detailrencanabiaya.find(x=>x.idRencanaBiaya ==value.idRencanaBiaya)== undefined)
            $scope.rencanabiaya.push(value);
        })
      })

      $scope.simpan = () => {
        $scope.model.idRencanaBiaya = $scope.itemRencanaBiaya.idRencanaBiaya;
        $scope.model.NamaRencanaBiaya = $scope.itemRencanaBiaya.NamaRencanaBiaya;
        $scope.model.idPeriodeRenker = $scope.datas.periode.idPeriodeRenker;
        $scope.model.Tahun = $scope.periode.Tahun;
        AnggaranBiayaService.post($scope.model).then(x=>{
          if($scope.model.iddetailrencanabiaya)
            $scope.tombol = "Simpan"
          $scope.rencanabiaya=[];
          $scope.model = {};
          $scope.datas.rencanabiaya.forEach(value=>{
          if($scope.datas.detailrencanabiaya.find(x=>x.idRencanaBiaya ==value.idRencanaBiaya)== undefined)
            $scope.rencanabiaya.push(angular.copy(value));
          })
          swal("Information!", "Berhasil di ditambahkan", "success");
        })

      }
      
      $scope.ubah = (item) => {
        $scope.model = item;
        $scope.itemRencanaBiaya = $scope.datas.rencanabiaya.find(x=>x.idRencanaBiaya ==item.idRencanaBiaya)
        $scope.cetak = true;
        $scope.tombol = "Ubah"
      }

      $scope.clear = () => {
        $scope.model = {};
        $scope.model.jenis = [];
        $scope.tombol = "Simpan"
        $scope.cetak = false;
      }

      $scope.back = ()=>{
        $window.history.back();
      }

      $scope.hapus = ()=>{
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
    })
</script>