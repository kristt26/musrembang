
<div class="row" ng-app="app" ng-controller="detailRencanaKerjaController">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header clearfix">
        <h3 class="card-title">Detail Rencana Kerja</h3>
        <bottom class="btn btn-secondary btn-sm float-right" style="margin-bottom:12px;" ng-click="back()">
            <i class="fas fa-arrow-left"></i>Kembali
        </bottom>
      </div>
      <div class="card-body">
        <form ng-submit="simpan()">
          <div class="form-group row">
            <label for="kegiatan" class="col-sm-2 col-form-label col-form-label-sm">Kegiatan</label>
            <div class="col-sm-10">
              : {{model.NamaBidang}} | {{model.NamaKegiatan}}
            </div>
          </div>
          <div class="form-group row">
            <label for="lingkungan" class="col-sm-2 col-form-label col-form-label-sm">Lingkungan</label>
            <div class="col-sm-10">
              : {{model.nort}}
            </div>
          </div>
          <div class="form-group row">
            <label for="jalan" class="col-sm-2 col-form-label col-form-label-sm">Jalan</label>
            <div class="col-sm-10 clearfix">
              <div class="d-flex justify-content-between">
                : {{model.jalan}}
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="lingkungan" class="col-sm-2 col-form-label col-form-label-sm">Volume/Satuan</label>
            <div class="col-sm-10">
              : {{model.volume}} {{model.satuan}}
            </div>
          </div>
          <div class="form-group row">
            <label for="permasalahan" class="col-sm-2 col-form-label col-form-label-sm">Permasalahan</label>
            <div class="col-sm-10">
              : {{model.permasalahan}}
            </div>
          </div>
          <div class="form-group row">
            <label for="skalaprioritas" class="col-sm-2 col-form-label col-form-label-sm">Skala Prioritas</label>
            <div class="col-sm-10">
              : {{model.prioritas}}
            </div>
          </div>
          <div class="form-group row">
            <label for="file" class="col-sm-2 col-form-label col-form-label-sm">File Pendukung</label>
            <div class="col-sm-10">
                <a href="<?= base_url();?>assets/berkas/{{model.file}}" target="_blank" class="btn btn-info btn-sm btn-block" ng-click="ubah(item)" title="Download" data-toggle="tooltip" data-placement="left" tooltip>download File</a>
            </div>
          </div>
            <div class="card-header clearfix"  style="margin-bottom:12px;">
              <h3 class="card-title">Perencanaan Biaya</h3>
            </div>
          <div class="form-group row">
            <label for="rencanabiaya" class="col-sm-2 col-form-label col-form-label-sm">Rencana Biaya</label>
            <div class="col-sm-3">
              : {{model.nominal | currency: 'Rp. '}}
            </div>
          </div>
          <div class="form-group row">
            <label for="sumberanggaran" class="col-sm-2 col-form-label col-form-label-sm">Sumber Anggaran</label>
            <div class="col-sm-10">
              : {{model.NamaRencanaBiaya}}
            </div>
          </div>
          <div class="form-group row">
            <label for="bidangskpd" class="col-sm-2 col-form-label col-form-label-sm">Bidang SKPD</label>
            <div class="col-sm-10">
              : {{model.NamaBidangSkpd}}
            </div>
          </div>
          <hr>
        </form>
        <!-- <div class="col-md-12"> -->
          <button ng-show="model.status != 'Disetujui' && model.status != 'Batal'" type="button" class="btn btn-block bg-gradient-primary" ng-click="validasi()">Validasi</button>
          <button ng-show="model.status == 'Disetujui' && model.status != 'Batal'" type="button" class="btn btn-block bg-gradient-primary" disabled>Validasi</button>
          <button ng-show="model.status != 'Disetujui' && model.status != 'Batal'" type="button" class="btn btn-block bg-gradient-warning" ng-click="kembalikan()">Kembalikan</button>
          <button ng-show="model.status == 'Disetujui' && model.status != 'Batal'" type="button" class="btn btn-block bg-gradient-warning" disabled>Kembalikan</button>
          <button ng-show="model.status != 'Disetujui' && model.status != 'Batal'" type="button" class="btn btn-block bg-gradient-danger" ng-click="tolak()">Tolak</button>
          <button ng-show="model.status == 'Disetujui' && model.status != 'Batal'" type="button" class="btn btn-block bg-gradient-danger" disabled>Tolak</button>
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
