<div class="row" ng-app="apps" ng-controller="rtController">
    <div class="col-md-12">
    <bottom class="btn btn-secondary btn-sm float-right" style="margin-bottom:12px;" ng-click="back()">
        <i class="fas fa-arrow-left"></i>Kembali
    </bottom>
    </div>
  <div class="col-md-4">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input RT</h3>
      </div>
      <form ng-submit="simpan()">
        <div class="card-body" style="height: 270px;">
          <div class="form-group">
            <label for="nort" class="col-form-label col-form-label-sm">No. RT</label>
            <input type="text" class="form-control form-control-sm" ng-model="model.nort" placeholder="No RT" ng-disabled="ShowJalan || edit" required>
          </div>
          <div class="form-group">
            <label for="pejabatrt" class="col-form-label col-form-label-sm">Pejabat</label>
            <input type="text" class="form-control form-control-sm" ng-model="model.pejabatrt" placeholder="Pejabat RT" ng-disabled="ShowJalan" required>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label col-form-label-sm">Email</label>
            <input type="email" class="form-control form-control-sm" ng-model="model.email" id="email" placeholder="Email" ng-disabled="ShowJalan" required>
          </div>
        </div>
        <div class="card-footer">
          <input type="submit" class="btn btn-primary prosess">
          <botton type="button" class="btn btn-default" ng-click="clear()">Clear</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Data RT pada RW. {{datas.rw.norw}}</h3>
      </div>
      <div class="card-body" style="height: 330px; overflow-y:auto;">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>No. RT</th>
              <th>Pejabar RT</th>
              <th>Email</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas.rt">
              <td>{{$index+1}}</td>
              <td>{{item.nort}}</td>
              <td>{{item.pejabatrt}}</td>
              <td>{{item.email}}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <bottom class="btn btn-primary btn-sm" ng-click="detailjalan(item);" style="margin: 0px 1px 0px 1px"><i class="fas fa-info-circle"></i></bottom>
                  <bottom class="btn btn-warning btn-sm" ng-click="ubah(item)" style="margin: 0px 1px 0px 1px"><i class="fas fa-edit"></i></bottom>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4" ng-show="ShowJalan">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Input Jalan</h3>
      </div>
      <form ng-submit="simpanJalan()">
        <div class="card-body" style="height:190px;">
          <div class="form-group">
            <label for="jalan" class="col-form-label col-form-label-sm">Jalan</label>
            <input type="text" class="form-control form-control-sm" ng-model="model.jalan" placeholder="Nama Jalan" required>
          </div>
        </div>
        <div class="card-footer">
          <input type="submit" class="btn btn-primary prosess" value="{{tomboljalan}}">
          <botton type="button" class="btn btn-default" ng-click="clearjalan()">Clear</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8" ng-show="ShowJalan">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Data Jalan RT. {{rt.nort}}</h3>
      </div>
      <div class="card-body" style="height: 250px; overflow-y:auto;">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Jalan</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in jalan">
              <td>{{$index+1}}</td>
              <td>{{item.jalan}}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <!-- <bottom class="btn btn-primary btn-sm" ng-click="ubah(item)" style="margin: 0px 1px 0px 1px"><i class="fas fa-info-circle"></i></bottom> -->
                  <bottom class="btn btn-warning btn-sm" ng-click="ubah(item)" style="margin: 0px 1px 0px 1px"><i class="fas fa-edit"></i></bottom>
                  <bottom class="btn btn-danger btn-sm float-right" ng-click="delete(item)" style="margin: 0px 1px 0px 1px"><i class="fas fa-trash-alt"></i></bottom>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
