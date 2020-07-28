<div class="row" ng-app="app" ng-controller="rencanaKerjaController">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ajuan Rencana Kerja</h3>
      </div>
      <div class="card-body">
          <a href="<?= base_url();?>user/renja/created" class="btn btn-success" ng-click="ubah(item)" style="margin-bottom:12px;" title="Tambah data pengajuan baru" data-toggle="tooltip" data-placement="right" tooltip>
            <i class="fas fa-plus-circle"></i>Tambah
          </a>
          <div style="width:100wh; overflow-x: auto;">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Bidang</th>
                  <th>Kegiatan</th>
                  <th>RW</th>
                  <th>Permasalahan</th>
                  <th>Prioritas</th>
                  <th>Volume</th>
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
                  <td>{{item.permasalahan}}</td>
                  <td>{{item.prioritas}}</td>
                  <td>{{item.volume}} {{item.satuan}}</td>
                  <td><a href="<?= base_url();?>assets/berkas/{{item.file}}" target="_blank">file</a></td>
                  <td>
                    <div class="noborder-radius text-center">
                      <a ng-show="item.status == 'Draf'" class="btn btn-primary" ng-click="validasi(item)" title="Validasi" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-check"></i></a>
                      <a href="<?= base_url();?>user/renja/created/{{item.idRencanaKerja}}" class="btn btn-warning" ng-click="ubah(item)" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-edit"></i></a>
                      <bottom class="btn btn-danger" ng-click="delete(item)" title="Hapus Pengajuan" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-trash-alt"></i></bottom>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        
      </div>
    </div>
  </div>
</div>
<script>
  angular.module('app', ['userdata.service'])
  .directive('tooltip', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                element.hover(function(){
                    // on mouseenter
                    element.tooltip('show');
                }, function(){
                    // on mouseleave
                    element.tooltip('hide');
                });
            }
        };
    })
    .controller('rencanaKerjaController', function ($scope, RenjaService) {
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
    })
</script>
