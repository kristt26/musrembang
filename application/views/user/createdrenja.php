
<div class="row" ng-app="app" ng-controller="createdRenjaController">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header clearfix">
        <h3 class="card-title">Tambah Rencana Kerja</h3>
        <bottom class="btn btn-secondary btn-sm float-right" style="margin-bottom:12px;" ng-click="back()">
            <i class="fas fa-arrow-left"></i>Kembali
        </bottom>
      </div>
      <div class="card-body">
        <form ng-submit="simpan()">
          <div class="form-group row">
            <label for="kegiatan" class="col-sm-2 col-form-label col-form-label-sm">Kegiatan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select ng-disabled="model.status != 'Draf'" class="form-control form-control-sm select2" ng-options="item as (item.NamaBidang + ' | ' + item.NamaKegiatan) for item in datas.kegiatan" style="width: 100%;" ng-model="kegiatan" ng-change="model.idKegiatan=kegiatan.idKegiatan; model.NamaKegiatan = kegiatan.NamaKegiatan; model.KodeKegiatan = kegiatan.KodeKegiatan; model.idbidang = kegiatan.idbidang; model.NamaBidang = kegiatan.NamaBidang; model.KodeBidang= kegiatan.KodeBidang;">
                <option></option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="lingkungan" class="col-sm-2 col-form-label col-form-label-sm">Lingkungan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select ng-disabled="model.status != 'Draf'" class="form-control form-control-sm select2" ng-options="item as item.nort for item in datas.lingkungan" style="width: 100%;" ng-model="lingkungan" ng-change="model.nort = lingkungan.nort; model.idrt = lingkungan.idrt;">
                <option></option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jalan" class="col-sm-2 col-form-label col-form-label-sm">Jalan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10 clearfix">
              <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-between" style="width: 85%;">
                  <select ng-disabled="model.status != 'Draf'" class="form-control form-control-sm select2" ng-options="item as item.jalan for item in lingkungan.jalan" style="width: 100%;" ng-model="jalan" ng-change="model.idjalan=jalan.idjalan; model.jalan = jalan.jalan">
                  <option></option>
                  </select>
                </div>
                <div class="d-flex" style="width:82px;">
                  <bottom class="btn btn-success btn-sm float-right" ng-click="back()">
                    <i class="fas fa-plus-circle"></i>Tambah
                  </bottom>
                </div>
              </div>
              <small class="form-text text-muted">Jika ada jalan yang belum terdaftar pada sistem silahkan klik tombol tambah</small>
              <div class="form-group row d-flex justify-content-between" style="margin-top:17px">
                <div class="col-sm-5 row d-flex justify-content-between">
                  <label for="volume" class="col-sm-4 col-form-label col-form-label-sm">Volume<sup style="color: red;">*</sup></label>
                  <div class="col-sm-7 text-right">
                    <input ng-disabled="model.status != 'Draf'" type="number" class="form-control form-control-sm" ng-model="model.volume">
                  </div>
                </div>
                <div class="col-sm-2 row"></div>
                <div class="col-sm-5 row d-flex justify-content-between">
                  <label for="satuan" class="col-sm-4 col-form-label col-form-label-sm">Satuan<sup style="color: red;">*</sup></label>
                  <div class="col-sm-7  text-right">
                    <input ng-disabled="model.status != 'Draf'" type="text" class="form-control form-control-sm" ng-model="model.satuan">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="permasalahan" class="col-sm-2 col-form-label col-form-label-sm">Permasalahan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <textarea ng-disabled="model.status != 'Draf'" class="form-control form-control-sm" ng-model="model.permasalahan" id="permasalahan" rows="4"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="skalaprioritas" class="col-sm-2 col-form-label col-form-label-sm">Skala Prioritas<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select ng-disabled="model.status != 'Draf'" class="form-control form-control-sm select2" ng-options="item for item in service.priotitas" ng-model="model.prioritas" id="skalaprioritas"></select>
            </div>
          </div>
          <div class="form-group row">
            <label for="file" class="col-sm-2 col-form-label col-form-label-sm">File Pendukung<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <div class="form-group inputDnD">
                <!-- <label class="sr-only" for="inputFile">File Upload</label> -->
                <input ng-disabled="model.status != 'Draf'" type="file" class="form-control-file form-control-sm text-secondary font-weight-bold" id="inputFile" file-model = "myFile" accept="image/*, application/pdf" data-title="{{fileTitle}}" onchange="angular.element(this).scope().ChangeFile(this)">
              </div>
            </div>
          </div>
          <!-- <div class="card card-default"> -->
            <div class="card-header clearfix"  style="margin-bottom:12px;">
              <h3 class="card-title">Perencanaan Biaya</h3>
            </div>
          <!-- </div> -->
          <div class="form-group row">
            <label for="rencanabiaya" class="col-sm-2 col-form-label col-form-label-sm">Rencana Biaya<sup style="color: red;">*</sup></label>
            <div class="col-sm-3">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input ng-disabled="model.status != 'Draf'" type="text" class="form-control text-right" id="rencanabiaya" ng-model="model.nominal" ui-number-mask="0">
                  <div class="input-group-append">
                    <span class="input-group-text">,00</span>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="sumberanggaran" class="col-sm-2 col-form-label col-form-label-sm">Sumber Anggaran<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select ng-disabled="model.status != 'Draf'" class="form-control form-control-sm select2" ng-options="item as item.NamaRencanaBiaya for item in datas.sumberanggaran" style="width:100%;" ng-model="sumberanggaran" id="sumberanggaran" ng-change="model.nominal1 = sumberanggaran.nominal1; model.idRencanaBiaya = sumberanggaran.idRencanaBiaya; model.NamaRencanaBiaya = sumberanggaran.NamaRencanaBiaya; model.iddetailrencanabiaya = sumberanggaran.iddetailrencanabiaya;"></select>
            </div>
          </div>
          <div class="form-group row">
            <label for="bidangskpd" class="col-sm-2 col-form-label col-form-label-sm">Bidang SKPD<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select ng-disabled="model.status != 'Draf'" class="form-control form-control-sm select2" ng-options="item as item.NamaBidangSkpd for item in datas.bidangskpd" style="width:100%;" ng-model="bidangskpd" id="bidangskpd" ng-change="model.idbidangskpd = bidangskpd.idbidangskpd; model.NamaBidangSkpd = bidangskpd.NamaBidangSkpd;"></select>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-sm-10">
              <button ng-show="model.status == 'Draf'" type="submit" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Simpan</button>
              <button ng-show="model.status != 'Draf'" type="submit" class="btn btn-info btn-sm" disabled><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
        </form>
        <!-- <div class="col-md-12"> -->
          <button ng-show="model.status == 'Draf'" type="button" class="btn btn-block bg-gradient-primary" ng-click="showvalidasi()">Validasi</button>
          <button ng-show="model.status != 'Draf'" type="button" class="btn btn-block bg-gradient-primary" disabled>Validasi</button>
        <!-- </div> -->
      </div>
    </div>
  </div>
  <div class="modal fade" id="waning-validasi">
    <div class="modal-dialog">
      <div class="modal-content bg-primary">
        <div class="list-group">
          <div class="list-group-item bg-blue" style="font-size:24px; color: red;">
            Peringatan !!!
          </div>
          <div class="list-group-item text-center">
            <p style="color:black;  font-size:18px">Data yang telah di validasi tidak dapat dilakukan perubahan</p>
            <p style="color:black; font-size:20px">Yakin akan melakukan validasi?</p>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-outline-light" ng-click="validasi()">Validasi</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  angular.module('app', ['userdata.service', 'helper.service', 'ui.utils.masks'])
    .directive('fileModel', function ($parse) {
            return {
               restrict: 'A',
               link: function(scope, element, attrs) {
                  var model = $parse(attrs.fileModel);
                  var modelSetter = model.assign;
                  
                  element.bind('change', function() {
                     scope.$apply(function() {
                        modelSetter(scope, element[0].files[0]);
                     });
                  });
               }
            };
         })
    .controller('createdRenjaController', function ($scope, RenjaService, $window, helperServices) {
      $scope.datas = [];
      $scope.service = helperServices;
      $scope.kegiatans = [];
      $scope.model = {};
      $scope.jalans = [];
      $scope.fileTitle = "Drag and drop a file";
      $scope.ChangeFile = (x)=>{
        $scope.fileTitle = x.files[0].name;
      }
      RenjaService.getKegiatan().then((x) => {
        $scope.datas = x;
        if(x.data){
          $scope.model = x.data;
          $scope.datas.data.volume = parseInt($scope.datas.data.volume);
          $scope.kegiatan = $scope.datas.kegiatan.find(x=>x.idKegiatan==$scope.datas.data.idKegiatan);
          $scope.lingkungan = $scope.datas.lingkungan.find(x=>x.idrt==$scope.datas.data.idrt);
          $scope.sumberanggaran = $scope.datas.sumberanggaran.find(x=>x.iddetailrencanabiaya==$scope.datas.data.iddetailrencanabiaya);
          $scope.bidangskpd = $scope.datas.bidangskpd.find(x=>x.idbidangskpd==$scope.datas.data.idbidangskpd);
          $scope.jalan = $scope.lingkungan.jalan.find(x=>x.idjalan==$scope.datas.data.idjalan);
        }
      })
      $scope.simpan = () => {
        if(!$scope.model.idPeriodeRenker)
          $scope.model.idPeriodeRenker = '<?= $periode->idPeriodeRenker;?>';
        var file = $scope.myFile;
        var fd = new FormData();
        fd.append('file', file);
        for (var prop in $scope.model) {
          fd.append(prop, $scope.model[prop]);
        }
        RenjaService.post(fd).then((x) => {
          // $scope.model = {};
          swal("Information!", "Berhasil disimpan", "success");
        })
      }
      $scope.validasi= ()=>{
        RenjaService.validasi($scope.model).then(x=>{
          $window.history.back();
        })
      }
      $scope.showvalidasi = ()=>{
        if(isEmpty($scope.model))
          swal("Information!", "Tidak ada data yang divalidasi", "error");
        else{
          $('#waning-validasi').modal('show');
        }
      }
      function isEmpty(obj) {
          for(var key in obj) {
              if(obj.hasOwnProperty(key))
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
      $scope.back = ()=>{
        $window.history.back();
      }
    })
</script>
