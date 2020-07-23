<div class="row" ng-app="app" ng-controller="periodeController">
  <div class="col-md-4">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Periode</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group">
            <label for="Tahun" class="col-form-label">Tahun</label>
            <input type="text" class="form-control" ng-model="model.Tahun" id="Tahun" placeholder="Tahun Periode" required>
          </div>
          <div class="form-group">
            <label for="mulai" class="col-form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" ng-model="model.mulai" id="mulai" required>
          </div>
          <div class="form-group">
            <label for="berakhir" class="col-form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" ng-model="model.berakhir" id="berakhir" required>
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
              <th>Tanggal Mulai</th>
              <th>Tanggal Berakhir</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.Tahun}}</td>
              <td>{{item.mulai | date:'EEEE, d MMMM y'}}</td>
              <td>{{item.berakhir | date:'EEEE, d MMMM y'}}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <bottom class="btn btn-info btn-sm" ng-click="ubah(item)" style="margin: 0px 1px 0px 1px" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-info-circle"></i></bottom>
                  <bottom class="btn btn-warning btn-sm" ng-click="ubah(item)" style="margin: 0px 1px 0px 1px" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-edit"></i></bottom>
                  <a href="<?= base_url();?>admin/anggaranbiaya/index/{{item.idPeriodeRenker}}" class="btn btn-success btn-sm" style="margin: 0px 1px 0px 1px" data-toggle="tooltip" data-placement="top" title="Tambah Anggaran"><i class="fa fa-plus-circle"></i></a>
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
  
  $(document).ready(function () {
      $('bottom').tooltip();
    })
  angular.module('app', ['data.service'])
  .controller('periodeController', function($scope, periodeService){
    $scope.datas = [];
    $scope.model = {};
    periodeService.get().then((x)=>{
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      $scope.datas = x;
      angular.forEach($scope.datas, x=>{
        x.mulai = new Date(x.mulai);
        x.berakhir = new Date(x.berakhir);
        console.log(x.mulai.toLocaleDateString(undefined, options));
        console.log(x.mulai.toTimeString());
      })
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