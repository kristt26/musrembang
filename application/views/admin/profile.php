<div class="row" ng-app="app" ng-controller="profileController">
  <div class="col-md-2">
    <div class="card text-center">
      <center>
        <div ng-bind-html='img' style="width:50%">

        </div>
        <!-- <img class="card-img-top" src="<?= base_url()?>assets/img/{{model.logo}}" alt=""> -->
      </center>

      <div class="card-body">
        <div class="form-group">
          <input type="file" class="form-control-file" name="" id="" placeholder="" file-model="files"
            aria-describedby="fileHelpId">
          <small id="fileHelpId" class="form-text text-muted">Upload Logo Kelurahan</small>
          <button class="btn btn-primary" ng-click="uploadFile()">Upload</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-10">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Data Profile</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group row">
            <label for="NamaKelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" ng-model="model.NamaKelurahan" id="NamaKelurahan"
                placeholder="Nama Kelurahan">
            </div>
          </div>
          <div class="form-group row">
            <label for="Kontak" class="col-sm-2 col-form-label">No Telp</label>
            <div class="col-sm-10">
              <input type="text" ng-model="model.Kontak" class="form-control" id="Kontak">
            </div>
          </div>
          <div class="form-group row">
            <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <textarea type="text" ng-model="model.Alamat" id="Alamat" class="form-control"
                aria-describedby="helpId"></textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  angular.module('app', ['ngSanitize', 'directives', 'data.service'])
    .controller('profileController', function ($scope, $http, ProfileService) {
      $scope.model = {};
      $scope.img;
      ProfileService.get().then(data => {
        if (data.length !== 0)
          $scope.model = data;
        $scope.img = '<img class="card-img-top" src="<?= base_url()?>assets/img/' + data.logo + '">';
      })
      $scope.simpan = () => {
        ProfileService.post($scope.model).then((x) => {
          swal("Information!", "Berhasil disimpan", "success");
        })
      }
      $scope.uploadFile = function () {
        ProfileService.upload($scope.files).then(x => {
          var a = '<img class="card-img-top" src="<?= base_url()?>assets/img/${x}">';
          $scope.img = '<img class="card-img-top" src="<?= base_url()?>assets/img/' + x.logo + '">';
          swal("Information!", "Logo Berhasil ditambahkan", "success");
        })
      }
    })
</script>