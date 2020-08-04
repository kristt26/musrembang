<div class="row" ng-app="app" ng-controller="laporanController">
  <div class="col-md-12">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Data Musrembang</h3>
      </div>
      <div class="card-body">
        <div class="col-sm-6 d-flex justify-content-center" style="margin-bottom:25px">
          <label class="col-sm-3">Periode</label>
          <select class="form-control select2" ng-options = "item as item.Tahun for item in periodes" ng-model="periode" ng-change="getData(periode.idPeriodeRenker)">
            <option></option>
          </select>
          <button class="btn btn-primary">Cetak</button>
        </div>
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th class="align-middle text-center" style="width: 10px" rowspan ="4">No</th>
              <th class="align-middle" rowspan ="4" colspan="2">Bidang/Kegiatan</th>
              <th class="align-middle" rowspan ="4">RW</th>
              <th class="align-middle" rowspan ="4">Lokasi</th>
              <th class="align-middle" rowspan ="4">Volume/Satuan</th>
              <th class="align-middle text-center" colspan="5">RENCANA BIAYA YANG DIUSULKAN</th>
              <th rowspan="4" class="align-middle text-center">Bidang SKPD</th>
            </tr>
            <tr>
              <th colspan="2" class="align-middle text-center">Anggaran Kampung / Kelurahan</th>
              <th rowspan="3" class="align-middle text-center">Anggaran Distrik (APBD Kota)</th>
              <th rowspan="3" class="align-middle text-center">Anggaran SKPD</th>
              <th rowspan="3" class="align-middle text-center">Sumber Dana Lainnya</th>
            </tr>
            <tr>
              <th class="align-middle text-center" colspan="2">APBD Kota (Optimalisasi)</th>
            </tr>
            <tr>
              <th class="align-middle text-center">Sharing Dana Prog. (Kota Tanpa Kumuh) KOTAKU</th>
              <th class="align-middle text-center">Biaya Penunjang Pemerintahan Kamp/Kel</th>
            </tr>
          </thead>
          <tbody ng-repeat="kegiatan in datas">
            <tr >
              <td>{{$index+1}}</td>
              <td colspan="11">{{kegiatan.NamaKegiatan}}</td>
            </tr>
            <tr ng-repeat="ajuan in kegiatan.rencanakerja">
              <td></td>
              <td colspan="2"></td>
              <td>{{ajuan.norw}}</td>
              <td>{{ajuan.jalan}}, RT. {{ajuan.nort}}</td>
              <td>{{ajuan.volume}} {{ajuan.satuan}}</td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ajuan.nominal}}</td>
              <td></td>
              <td>{{ajuan.NamaBidangSkpd}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
