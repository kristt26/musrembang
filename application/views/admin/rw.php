<div class="row" ng-app="app" ng-controller="rwController">
  <div class="col-md-3">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input RW</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group">
            <label for="norw" class="col-form-label col-form-label-sm">No. RW</label>
            <input type="text" class="form-control form-control-sm" ng-model="model.norw" placeholder="Nama norw" required>
          </div>
          <div class="form-group">
            <label for="pejabatrw" class="col-form-label col-form-label-sm">Pejabat</label>
            <input type="text" class="form-control form-control-sm" ng-model="model.pejabatrw" placeholder="Pejabat RW" required>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label col-form-label-sm">Email</label>
            <input type="email" class="form-control form-control-sm" ng-model="model.email" id="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="username" class="col-form-label col-form-label-sm">Username</label>
            <input type="text" class="form-control form-control-sm" ng-model="model.username" id="username" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label for="pass" class="col-form-label col-form-label-sm">Password</label>
            <input type="text" class="form-control form-control-sm" ng-model="model.password" id="pass" placeholder="Password" required>
          </div>
        </div>
        <div class="card-footer">
          <input type="submit" class="btn btn-primary prosess">
          <botton type="button" class="btn btn-default" ng-click="clear()">Clear</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-9" style="height:80vh;">
    <div class="card card-danger" style="height:100%;">
      <div class="card-header">
        <h3 class="card-title">Data RW</h3>
      </div>
      <div class="card-body" style="height: 100%; overflow-y:auto;">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>No. RW</th>
              <th>Pejabar RW</th>
              <th>Email</th>
              <th>Username</th>
              <th>Status</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.norw}}</td>
              <td>{{item.pejabatrw}}</td>
              <td>{{item.email}}</td>
              <td>{{item.username}}</td>
              <td>{{item.status}}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <!-- <bottom class="btn btn-primary btn-sm" ng-click="ubah(item)" style="margin: 0px 1px 0px 1px"><i class="fas fa-info-circle"></i></bottom> -->
                  <bottom class="btn btn-warning btn-sm" ng-click="ubah(item)" style="margin: 0px 1px 0px 1px"><i class="fas fa-edit"></i></bottom>
                  <bottom class="btn btn-danger btn-sm float-right" ng-click="delete(item)" style="margin: 0px 1px 0px 1px"><i class="fas fa-trash-alt"></i></bottom>
                  <a href="<?= base_url();?>admin/rt/index/{{item.idrw}}" class="btn btn-success btn-sm" style="margin: 0px 1px 0px 1px" data-toggle="tooltip" data-placement="top" title="Tambah Anggaran"><i class="fas fa-plus-circle"></i></a>
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
  .controller('rwController', function($scope, RwService){
    $scope.datas = [];
    $scope.model = {};
    $scope.edit = true;
    RwService.get().then((x)=>{
      $scope.datas = x;
    })
    $scope.simpan = ()=>{
      RwService.post($scope.model).then((x)=>{
        $scope.model = {};
        $scope.edit = true;
        swal("Information!", "Proses Berhasil", "success");
      })
    }
    $scope.ubah = (item)=>{
      $scope.model = angular.copy(item);
      $scope.edit = false;
    }
    $scope.clear = () =>{
      $scope.model = {};
      $scope.edit = true;
    }
    $scope.delete = (item)=>{
      RwService.delete(item.idrw).then((x)=>{
        swal("Information!", "Berhasil dihapus", "success");
      })
    }
  })
</script>