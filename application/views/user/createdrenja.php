
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
        <form>
          <div class="form-group row">
            <label for="kegiatan" class="col-sm-2 col-form-label col-form-label-sm">Kegiatan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item as (item.NamaBidang + ' | ' + item.NamaKegiatan) for item in kegiatans" style="width: 100%;" ng-model="kegiatan" ng-change="model.idKegiatan=kegiatan.idKegiatan">
                <option></option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="lingkungan" class="col-sm-2 col-form-label col-form-label-sm">Lingkungan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item as item.nort for item in lingkungans" style="width: 100%;" ng-model="lingkungan" ng-change="model.idKegiatan=kegiatan.idKegiatan">
                <option></option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jalan" class="col-sm-2 col-form-label col-form-label-sm">Jalan<sup style="color: red;">*</sup></label>
            <div class="col-sm-10 clearfix">
              <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-between" style="width: 85%;">
                  <select class="form-control form-control-sm select2" ng-options="item as item.nort for item in jalans" style="width: 100%;" ng-model="jalan" ng-change="model.idjalan=jalan.idjalan">
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
                <input type="file" class="form-control-file form-control-sm text-secondary font-weight-bold" id="inputFile" accept="image/*" data-title="Drag and drop a file">
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
                  <input type="text" class="form-control text-right" id="rencanabiaya">
                  <div class="input-group-append">
                    <span class="input-group-text">,00</span>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="sumberanggaran" class="col-sm-2 col-form-label col-form-label-sm">Sumber Anggaran<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item for item in datas.sumberanggaran" style="width:100%;" ng-model="sumberanggaran" id="sumberanggaran"></select>
            </div>
          </div>
          <div class="form-group row">
            <label for="bidangskpd" class="col-sm-2 col-form-label col-form-label-sm">Bidang SKPD<sup style="color: red;">*</sup></label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm select2" ng-options="item for item in datas.bidangskpd" style="width:100%;" ng-model="bidangskpd" id="bidangskpd"></select>
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
  function readUrl(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
    var imgData = e.target.result;
    var imgName = input.files[0].name;
    input.setAttribute("data-title", imgName);
    console.log(e.target.result);
  };
  reader.readAsDataURL(input.files[0]);
}
}
  angular.module('app', ['userdata.service', 'helper.service'])
    .controller('createdRenjaController', function ($scope, RenjaService, $window, helperServices) {
      $scope.datas = [];
      $scope.service = helperServices;
      $scope.kegiatans = [];
      $scope.model = {};
      RenjaService.getKegaitan().then((x) => {
        $scope.kegiatans = x;
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
      $scope.back = ()=>{
        $window.history.back();
      }
    })
</script>
