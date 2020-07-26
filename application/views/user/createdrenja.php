
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
              <select class="form-control form-control-sm select2" ng-options="item as (item.NamaBidang + ' | ' + item.NamaKegiatan) for item in datas.kegiatan" style="width: 100%;" ng-model="kegiatan" ng-change="model.idKegiatan=kegiatan.idKegiatan; model.NamaKegiatan = kegiatan.NamaKegiatan; model.KodeKegiatan = kegiatan.KodeKegiatan; model.idbidang = kegiatan.idbidang; model.NamaBidang = kegiatan.NamaBidang; model.KodeBidang= kegiatan.KodeBidang;">
                <option></option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="lingkungan" class="col-sm-2 col-form-label col-form-label-sm">Lingkungan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item as item.nort for item in datas.lingkungan" style="width: 100%;" ng-model="lingkungan" ng-change="model.nort = lingkungan.nort; model.idrt = lingkungan.idrt;">
                <option></option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jalan" class="col-sm-2 col-form-label col-form-label-sm">Jalan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10 clearfix">
              <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-between" style="width: 85%;">
                  <select class="form-control form-control-sm select2" ng-options="item as item.jalan for item in lingkungan.jalan" style="width: 100%;" ng-model="jalan" ng-change="model.idjalan=jalan.idjalan; model.jalan = jalan.jalan">
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
                    <input type="number" class="form-control form-control-sm" ng-model="model.volume">
                  </div>
                </div>
                <div class="col-sm-2 row"></div>
                <div class="col-sm-5 row d-flex justify-content-between">
                  <label for="satuan" class="col-sm-4 col-form-label col-form-label-sm">Satuan<sup style="color: red;">*</sup></label>
                  <div class="col-sm-7  text-right">
                    <input type="text" class="form-control form-control-sm" ng-model="model.satuan">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="permasalahan" class="col-sm-2 col-form-label col-form-label-sm">Permasalahan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <textarea class="form-control form-control-sm" ng-model="model.permasalahan" id="permasalahan" rows="4"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="skalaprioritas" class="col-sm-2 col-form-label col-form-label-sm">Skala Prioritas<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item for item in service.priotitas" ng-model="model.prioritas" id="skalaprioritas"></select>
            </div>
          </div>
          <div class="form-group row">
            <label for="file" class="col-sm-2 col-form-label col-form-label-sm">File Pendukung<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <div class="form-group inputDnD">
                <!-- <label class="sr-only" for="inputFile">File Upload</label> -->
                <input type="file" class="form-control-file form-control-sm text-secondary font-weight-bold" id="inputFile" file-model = "myFile" accept="image/*" data-title="Drag and drop a file">
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
                  <input type="text" class="form-control text-right" id="rencanabiaya" ng-model="model.nominal">
                  <div class="input-group-append">
                    <span class="input-group-text">,00</span>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="sumberanggaran" class="col-sm-2 col-form-label col-form-label-sm">Sumber Anggaran<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item as item.NamaRencanaBiaya for item in datas.sumberanggaran" style="width:100%;" ng-model="sumberanggaran" id="sumberanggaran" ng-change="model.nominal1 = sumberanggaran.nominal1; model.idRencanaBiaya = sumberanggaran.idRencanaBiaya; model.NamaRencanaBiaya = sumberanggaran.NamaRencanaBiaya; model.iddetailrencanabiaya = sumberanggaran.iddetailrencanabiaya;"></select>
            </div>
          </div>
          <div class="form-group row">
            <label for="bidangskpd" class="col-sm-2 col-form-label col-form-label-sm">Bidang SKPD<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item as item.NamaBidangSkpd for item in datas.bidangskpd" style="width:100%;" ng-model="bidangskpd" id="bidangskpd" ng-change="model.idbidangskpd = bidangskpd.idbidangskpd; model.NamaBidangSkpd = bidangskpd.NamaBidangSkpd;"></select>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  angular.module('app', ['userdata.service', 'helper.service'])
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
      RenjaService.getKegiatan().then((x) => {
        $scope.datas = x;
      })
      $scope.simpan = () => {
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
