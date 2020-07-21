<div class="row" ng-app="app" ng-controller="rencanaBiayaController">
  <div class="col-md-4">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Rencana Biaya</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group row">
            <label for="NamaRencanaBiaya" class="col-sm-3 col-form-label">Rencana Biaya</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.NamaRencanaBiaya" placeholder="Nama Rencana Biaya" required>
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
        <h3 class="card-title">Data Rencana Biaya</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Rencana Biaya</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.NamaRencanaBiaya}}</td>
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
  .controller('rencanaBiayaController', function($scope, RencanaBiayaService){
    $scope.datas = [];
    $scope.model = {};
    RencanaBiayaService.get().then((x)=>{
      $scope.datas = x;
    })
    $scope.simpan = ()=>{
      RencanaBiayaService.post($scope.model).then((x)=>{
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
      RencanaBiayaService.delete(item.idRencanaBiaya).then((x)=>{
        swal("Information!", "Berhasil dihapus", "success");
      })
    }
  })
</script>