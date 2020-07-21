<div class="row" ng-app="app" ng-controller="rwController">
  <div class="col-md-3">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input RW</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group row">
            <label for="norw" class="col-sm-3 col-form-label">No. RW</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.norw" placeholder="Nama norw" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="pejabatrw" class="col-sm-3 col-form-label">Pejabat</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.pejabatrw" placeholder="Pejabat RW" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" ng-model="model.email" id="email" placeholder="Email" required>
            </div>
          </div>
          <div class="form-group row" ng-if="edit">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.username" id="username" placeholder="Username" required>
            </div>
          </div>
          <div class="form-group row" ng-if="edit">
            <label for="pass" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.password" id="pass" placeholder="Password" required>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <input type="submit" class="btn btn-primary prosess">
          <botton type="button" class="btn btn-default" ng-click="clear()">Clear</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-9">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Data RW</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
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
                <div class="tombol">
                  <bottom class="btn btn-default" ng-click="ubah(item)">
                    <ion-icon name="create-outline"></ion-icon>
                  </bottom>
                  <bottom class="btn btn-danger float-right" ng-click="delete(item)">
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