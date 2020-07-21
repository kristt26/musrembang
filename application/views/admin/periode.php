<div class="row" ng-app="app" ng-controller="periodeController">
  <div class="col-md-4">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Periode</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group row">
            <label for="Tahun" class="col-sm-3 col-form-label">Tahun</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.Tahun" id="Tahun" placeholder="Tahun Periode" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="Status" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select class="form-control" id="Status" ng-model="model.Status">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
          </div>
        </div>
        <div class="card-footer justify-content-between">
          <input type="submit" class="btn btn-primary">
          <botton type="button" class="btn btn-default" ng-click="clear()">Clear</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Data Periode Rencana Kerja</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Tahun</th>
              <th>Status</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.Tahun}}</td>
              <td>{{item.Status}}</td>
              <td>
                <div class="tombol">
                  <bottom class="btn btn-default" ng-click="ubah(item)"><ion-icon name="create-outline"></ion-icon></bottom>
                  <bottom class="btn btn-danger" ng-click="delete(item)"><ion-icon name="trash-outline"></ion-icon></bottom>
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
  .controller('periodeController', function($scope, periodeService){
    $scope.datas = [];
    $scope.model = {};
    periodeService.get().then((x)=>{
      $scope.datas = x;
    })
    $scope.simpan = ()=>{
      periodeService.post($scope.model).then((x)=>{
        $scope.model = {};
        swal("Information!", "Berhasil disimpan", "success");
      })
    }
    $scope.ubah = (item)=>{
      $scope.model = angular.copy(item);
    }
    $scope.clear = () =>{
      $scope.model = {};
    }
    $scope.delete = (item)=>{
      periodeService.delete(item.idPeriodeRenker).then((x)=>{
        swal("Information!", "Berhasil dihapus", "success");
      })
    }
  })
</script>