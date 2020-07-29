<div class="row" ng-app="appuser" ng-controller="rencanaKerjaController">
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
                      <a ng-show="item.status == 'Draf'" class="btn btn-primary" ng-click="showvalidasi(item)" title="Validasi" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-check"></i></a>
                      <a ng-show="item.status == 'Draf'" href="<?= base_url();?>user/renja/created/{{item.idRencanaKerja}}" class="btn btn-warning" ng-click="ubah(item)" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-edit"></i></a>
                      <bottom ng-show="item.status != 'Draf'" class="btn btn-warning disabled" title="Ubah" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-edit"></i></bottom>
                      <bottom ng-show="item.status == 'Draf'" class="btn btn-danger" ng-click="delete(item)" title="Hapus Pengajuan" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-trash-alt"></i></bottom>
                      <bottom ng-show="item.status != 'Draf'" class="btn btn-danger disabled" title="Hapus Pengajuan" data-toggle="tooltip" data-placement="left" tooltip><i class="fas fa-trash-alt"></i></bottom>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        
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