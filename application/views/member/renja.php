<div class="row" ng-app="app" ng-controller="rencanaBiayaController">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ajuan Rencana Kerja</h3>
      </div>
      <div class="card-body">
          <bottom class="btn btn-success" ng-click="ubah(item)" style="margin-bottom:12px;">
            <i class="fas fa-plus-circle"></i>Tambah
          </bottom>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Bidang</th>
              <th>Kegiatan</th>
              <th>RW</th>
              <th>Lokasi</th>
              <th>Target</th>
              <th>Volume</th>
              <th>Satuan</th>
              <th>File</th>
              <th style="width: 190px">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.NamaBidang}}</td>
              <td>{{item.NamaKegiatan}}</td>
              <td>RW. {{item.norw}}</td>
              <td>{{item.lokasi}}</td>
              <td>{{item.target}}</td>
              <td>{{item.volume}}</td>
              <td>{{item.satuan}}</td>
              <td>{{item.file}}</td>
              <td>
                <div class="noborder-radius text-center">
                  <bottom class="btn btn-warning" ng-click="ubah(item)">
                    <ion-icon name="create-outline"></ion-icon>
                  </bottom>
                  <bottom class="btn btn-danger" ng-click="delete(item)">
                    <ion-icon name="trash-outline"></ion-icon>
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
  angular.module('app', ['data.service'])
    .controller('rencanaBiayaController', function ($scope, RencanaBiayaService) {
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
    })
</script>
