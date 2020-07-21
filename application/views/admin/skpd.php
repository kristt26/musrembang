<div class="row" ng-app="app" ng-controller="skpdController">
  <div class="col-md-4">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Bidang SKPD</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group row">
            <label for="NamaBidang" class="col-sm-3 col-form-label">Nama SKPD</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.NamaBidang" placeholder="Nama Bidang SKPD" required>
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
        <h3 class="card-title">Data Bidang SKPD</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama Bidang SKPD</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.NamaBidang}}</td>
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
  .controller('skpdController', function($scope, SkpdService){
    $scope.datas = [];
    $scope.model = {};
    SkpdService.get().then((x)=>{
      $scope.datas = x;
    })
    $scope.simpan = ()=>{
      SkpdService.post($scope.model).then((x)=>{
        $scope.model = {};
        swal("Information!", "Berhasil disimpan", "success");
      })
    }
    $scope.ubah = (item)=>{
      $scope.model = item
    }
    $scope.clear = () =>{
      $scope.model = {};
    }
    $scope.delete = (item)=>{
      SkpdService.delete(item.idbidangskpd).then((x)=>{
        swal("Information!", "Berhasil dihapus", "success");
      })
    }
  })
</script>