<div class="row" ng-app="apps" ng-controller="pegawaiController">
  <div class="col-md-3">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Pegawai</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body">
          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.nama" placeholder="Nama pegawai" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="kontak" class="col-sm-3 col-form-label">No Hp.</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.kontak" placeholder="No Hp." required>
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
              <textarea class="form-control" ng-model="model.alamat" id="alamat" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="model.jabatan" id="jabatan" placeholder="Jabatan"
                required>
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
        <h3 class="card-title">Data Pegawai</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama</th>
              <th>Kontak</th>
              <th>Alamat</th>
              <th>Jabatan</th>
              <th>Email</th>
              <th>Status</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.nama}}</td>
              <td>{{item.kontak}}</td>
              <td>{{item.alamat}}</td>
              <td>{{item.jabatan}}</td>
              <td>{{item.email}}</td>
              <td>{{item.status}}</td>
              <td>
                <div class="tombol">
                  <bottom class="btn btn-default" ng-click="ubah(item)">
                    <ion-icon name="create-outline"></ion-icon>
                  </bottom>
                  <bottom class="btn btn-danger" ng-click="delete(item)">
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