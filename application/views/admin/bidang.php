<div class="row" ng-app="apps" ng-controller="bidangController">
  <div class="col-md-5">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Bidang</h3>
      </div>
      <form ng-submit="simpan()" enctype="multipart/form-data">
        <div class="card-body" style="height: 210px">
          <div class="form-group row kd_pemesanan" id="kd_pemesanan">
            <label for="id" class="col-sm-4 col-form-label">Kode Bidang</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" ng-model="model.KodeBidang" ng-focus="daftarKegiatan=false"
                required>
            </div>
          </div>
          <div class="form-group row">
            <label for="tgl_ambil" class="col-sm-4 col-form-label">Nama Bidang</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" ng-model="model.NamaBidang" ng-focus="daftarKegiatan=false"
                required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card card-danger" style="padding-bottom:10px" >
      <div class="card-header">
        <h3 class="card-title">Data Bidang</h3>
      </div>
      <div class="card-body" style="height: 270px; overflow-y:auto">
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Kode Bidang</th>
              <th>Nama Bidang</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody >
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.KodeBidang}}</td>
              <td>{{item.NamaBidang}}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <bottom class="btn btn-default" title="Edit Bidang" ng-click="ubah(item)">
                    <ion-icon name="create-outline"></ion-icon>
                  </bottom>
                  <bottom class="btn btn-info" title="Daftar Kegiatan" ng-click="showKegiatan(item);">
                    <ion-icon name="eye-outline"></ion-icon>
                  </bottom>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12" ng-if="daftarKegiatan">
    <div class="card card-danger">
      <div class="card-header justify-content-between">
        <h3 class="card-title">Data Kegiatan</h3>
        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addkegiatan"><i class="fas fa-plus"></i></a>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Kode Kegiatan</th>
              <th>Nama Kegiatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in listKegiatan.kegiatan">
              <td>{{$index+1}}</td>
              <td>{{item.KodeKegiatan}}</td>
              <td>{{item.NamaKegiatan}}</td>
              <td>
                <div class="tombol">
                  <bottom class="btn btn-default" title="Edit Kegiatan" ng-click="ubahKegiatan(item)">
                    <ion-icon name="create-outline"></ion-icon>
                  </bottom>
                  <bottom class="btn btn-info" title="Daftar Kegiatan" ng-click="delete(item)">
                    <ion-icon name="eye-outline"></ion-icon>
                  </bottom>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addkegiatan">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kegiatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form ng-submit="simpanKegiatan()" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group row">
              <label for="id" class="col-sm-4 col-form-label">Kode Kegiatan</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" ng-model="model.KodeKegiatan" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="tgl_ambil" class="col-sm-4 col-form-label">Nama Bidang</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" ng-model="model.NamaKegiatan" required>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
