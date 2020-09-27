<div class="row" ng-app="app" ng-controller="rencanaKerjaController">
  <div class="col-md-12">
    <div class="card card-danger card-tabs">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" data-target="#custom-tabs-one-home" href=""
              role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">DIAJUKAN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" data-target="#custom-tabs-one-profile" href=""
              role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">DIVALIDASI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" data-target="#custom-tabs-one-tolak" href=""
              role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">DITOLAK</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" data-target="#custom-tabs-one-laporan" href=""
              role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">CETAK LAPORAN</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
          <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
            aria-labelledby="custom-tabs-one-home-tab" style="width:100wh; overflow-x: auto;">
            <table datatable="ng" class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th style="width: 4%">No</th>
                  <th>Bidang</th>
                  <th>Kegiatan</th>
                  <th>RW</th>
                  <th>Permasalahan</th>
                  <th>Prioritas</th>
                  <th style="width: 20%">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="item in Usulan">
                  <td>{{$index+1}}</td>
                  <td>{{item.NamaBidang}}</td>
                  <td>{{item.NamaKegiatan}}</td>
                  <td>RW. {{item.norw}}</td>
                  <td>{{item.permasalahan}}</td>
                  <td>{{item.prioritas}}</td>
                  <td>
                    <div class="noborder-radius text-center">
                      <a ng-show="item.status == 'Usulan'" class="btn btn-primary btn-sm" ng-click="validasi(item)" title="Validasi" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-check"></i></a>
                      <a href="<?=base_url();?>admin/rencanakerja/detail/{{item.idRencanaKerja}}" class="btn btn-success btn-sm" ng-click="ubah(item)" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-info-circle"></i></a>
                      <bottom class="btn btn-warning btn-sm" ng-click="showMessage(item, 'Dikembalikan')" title="Kembalikan pengajuan" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-arrow-left"></i></bottom>
                      <a href="<?=base_url();?>assets/berkas/{{item.file}}" target="_blank" class="btn btn-info btn-sm" ng-click="ubah(item)" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-book"></i></a>
                      <bottom class="btn btn-danger btn-sm" ng-click="showMessage(item, 'Batal')" title="Kembalikan pengajuan" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-minus-circle"></i></bottom>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
            aria-labelledby="custom-tabs-one-profile-tab" style="width:100wh; overflow-x: auto;">
            <table datatable="ng" class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Bidang</th>
                  <th>Kegiatan</th>
                  <th>RW</th>
                  <th>Permasalahan</th>
                  <th>Prioritas</th>
                  <th style="width: 190px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="item in Final">
                  <td>{{$index+1}}</td>
                  <td>{{item.NamaBidang}}</td>
                  <td>{{item.NamaKegiatan}}</td>
                  <td>RW. {{item.norw}}</td>
                  <td>{{item.permasalahan}}</td>
                  <td>{{item.prioritas}}</td>
                  <td>
                    <div class="noborder-radius text-center">
                      <a ng-show="item.status == 'Usulan'" class="btn btn-primary btn-sm" ng-click="validasi(item)" title="Validasi" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-check"></i></a>
                      <a href="<?=base_url();?>admin/rencanakerja/detail/{{item.idRencanaKerja}}" class="btn btn-primary btn-sm" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-info-circle"></i></a>
                      <a href="<?=base_url();?>assets/berkas/{{item.file}}" target="_blank" class="btn btn-info btn-sm" ng-click="ubah(item)" title="Download" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-book"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="custom-tabs-one-tolak" role="tabpanel"
            aria-labelledby="custom-tabs-one-profile-tab" style="width:100wh; overflow-x: auto;">
            <table datatable="ng" class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Bidang</th>
                  <th>Kegiatan</th>
                  <th>RW</th>
                  <th>Permasalahan</th>
                  <th>Prioritas</th>
                  <th style="width: 190px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="item in Tolak">
                  <td>{{$index+1}}</td>
                  <td>{{item.NamaBidang}}</td>
                  <td>{{item.NamaKegiatan}}</td>
                  <td>RW. {{item.norw}}</td>
                  <td>{{item.permasalahan}}</td>
                  <td>{{item.prioritas}}</td>
                  <td>
                    <div class="noborder-radius text-center">
                      <a ng-show="item.status == 'Usulan'" class="btn btn-primary btn-sm" ng-click="validasi(item)" title="Validasi" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-check"></i></a>
                      <a href="<?=base_url();?>admin/rencanakerja/detail/{{item.idRencanaKerja}}" class="btn btn-primary btn-sm" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-info-circle"></i></a>
                      <a href="<?=base_url();?>assets/berkas/{{item.file}}" target="_blank" class="btn btn-info btn-sm" ng-click="ubah(item)" title="Download" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-book"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="custom-tabs-one-laporan" role="tabpanel"
            aria-labelledby="custom-tabs-one-profile-tab" style="width:100wh; overflow-x: auto;">
            <table datatable="ng" class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Bidang</th>
                  <th>Kegiatan</th>
                  <th>RW</th>
                  <th>Permasalahan</th>
                  <th>Prioritas</th>
                  <th style="width: 190px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="item in Laporan">
                  <td>{{$index+1}}</td>
                  <td>{{item.NamaBidang}}</td>
                  <td>{{item.NamaKegiatan}}</td>
                  <td>RW. {{item.norw}}</td>
                  <td>{{item.permasalahan}}</td>
                  <td>{{item.prioritas}}</td>
                  <td>
                    <div class="noborder-radius text-center">
                      <a ng-show="item.status == 'Usulan'" class="btn btn-primary btn-sm" ng-click="validasi(item)" title="Validasi" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-check"></i></a>
                      <a href="<?=base_url();?>admin/rencanakerja/detail/{{item.idRencanaKerja}}" class="btn btn-primary btn-sm" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-info-circle"></i></a>
                      <a href="<?=base_url();?>assets/berkas/{{item.file}}" target="_blank" class="btn btn-info btn-sm" ng-click="ubah(item)" title="Download" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-book"></i></a>
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
  <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{boxTitle}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Pesan</label>
            <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Help text</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button ng-if="model.setstatus=='Dikembalikan'" type="button" class="btn btn-warning btn-sm" ng-click="kembalikan(model)">Kembalikan</button>
          <button ng-if="model.setstatus=='Batal'" type="button" class="btn btn-danger btn-sm" ng-click="tolak(model)">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
</div>