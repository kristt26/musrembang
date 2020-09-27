<div class="row" ng-app="app" ng-controller="laporanController">
  <div class="col-md-12">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Data Musrembang</h3>
      </div>
      <div class="card-body">
        <div class="col-sm-6 d-flex justify-content-center" style="margin-bottom:25px">
          <label class="col-sm-3">Periode</label>
          <select class="form-control select2" ng-options="item as item.Tahun for item in periodes" ng-model="periode"
            ng-change="getData(periode.idPeriodeRenker)">
            <option></option>
          </select>
          <button id="cetak" class="btn btn-primary">Cetak</button>
        </div>
        <div id="print" style="width:100wh; overflow-x: auto;">
          <div class="screeen">
            <div class="col-md-12 row d-flex justify-content-between">
              <div><img src="<?= base_url('assets/img/logo.png');?>" width="90px"></div>
              <div class="text-center"><h5>DAFTAR KEGIATAN PEMBANGUNAN PRIORITAS RENCANA KERJA PEMBANGUNAN <br>KAMPUNG / KELURAHAN ( RKP KELURAHAN / KAMPUNG ) <br>TAHUN {{periode.Tahun}}</h5></div>
              <div>&nbsp;</div>
            </div>
            <hr><br><br>
          </div>

          <table class="table table-sm table-bordered">
          <thead>
              <tr>
                <th class="align-middle text-center" style="width: 10px">No</th>
                <th class="align-middle text-center"  colspan="2">Bidang/Kegiatan</th>
                <th class="align-middle text-center">RW</th>
                <th class="align-middle text-center">Lokasi</th>
                <th class="align-middle text-center">Volume/Satuan</th>
                <th class="align-middle text-center">Bidang SKPD</th>
                <th class="align-middle text-center text-wrap">Usulan Anggaran<br>(Rp.)</th>
              </tr>
            </thead>
            <tbody ng-repeat="kegiatan in datas">
              <tr>
                <td rowspan="{{kegiatan.rencanakerja.length+1}}">{{$index+1}}</td>
                <td colspan="2" rowspan="{{kegiatan.rencanakerja.length+1}}">{{kegiatan.NamaBidang}} - {{kegiatan.NamaKegiatan}}</td>
              </tr>
              <tr ng-repeat="ajuan in kegiatan.rencanakerja">
                <td>{{ajuan.norw}}</td>
                <td>{{ajuan.jalan}}, RT. {{ajuan.nort}}</td>
                <td>{{ajuan.volume}} {{ajuan.satuan}}</td>
                <td>{{ajuan.NamaBidangSkpd}}</td>
                <td class="text-right">{{ajuan.nominal | currency:''}} <span class="d-none">{{convert(ajuan.nominal)}}</span></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="7" class="text-center">Total</td>
                <td class="text-right"><b>{{hasil | currency: ''}}</b></td>
              </tr>
            </tfoot>
            
            <!-- <thead>
              <tr>
                <th class="align-middle text-center" style="width: 10px" rowspan="4">No</th>
                <th class="align-middle" rowspan="4" colspan="2">Bidang/<br>Kegiatan</th>
                <th class="align-middle" rowspan="4">RW</th>
                <th class="align-middle" rowspan="4">Lokasi</th>
                <th class="align-middle" rowspan="4">Volume/<br>Satuan</th>
                <th class="align-middle text-center text-wrap" colspan="5">RENCANA BIAYA YANG DIUSULKAN</th>
                <th rowspan="4" class="align-middle text-center">Bidang SKPD</th>
              </tr>
              <tr>
                <th colspan="2" class="align-middle text-center text-wrap">Anggaran Kampung / Kelurahan</th>
                <th rowspan="3" class="align-middle text-center text-wrap">Anggaran Distrik (APBD Kota)</th>
                <th rowspan="3" class="align-middle text-center text-wrap">Anggaran SKPD</th>
                <th rowspan="3" class="align-middle text-center text-wrap">Sumber Dana Lainnya</th>
              </tr>
              <tr>
                <th class="align-middle text-center text-wrap" colspan="2">APBD Kota (Optimalisasi)</th>
              </tr>
              <tr>
                <th class="align-middle text-center">Sharing Dana Prog. (Kota Tanpa Kumuh) KOTAKU</th>
                <th class="align-middle text-center">Biaya Penunjang Pemerintahan Kamp/Kel</th>
              </tr>
            </thead>
            <tbody ng-repeat="kegiatan in datas">
              <tr>
                <td rowspan="{{kegiatan.rencanakerja.length+1}}">{{$index+1}}</td>
                <td colspan="2" rowspan="{{kegiatan.rencanakerja.length+1}}">{{kegiatan.NamaKegiatan}}</td>
              </tr>
              <tr ng-repeat="ajuan in kegiatan.rencanakerja">
                <td>{{ajuan.norw}}</td>
                <td>{{ajuan.jalan}}, RT. {{ajuan.nort}}</td>
                <td>{{ajuan.volume}} {{ajuan.satuan}}</td>
                <td class="text-right">{{ajuan.nominal | currency:''}}</td>
                <td class="text-right">{{ajuan.nominal | currency:''}}</td>
                <td class="text-right">{{ajuan.nominal | currency:''}}</td>
                <td class="text-right">{{ajuan.nominal | currency:''}}</td>
                <td></td>
                <td>{{ajuan.NamaBidangSkpd}}</td>
              </tr>
            </tbody> -->
          </table>
          <div class="screeen pull-right">
            <br><br><br><br>
            <div class="d-flex justify-content-end screeen">
              <div class="col-md-4 text-center">
                <p>Jayapura, {{tanggal | date: 'd MMMM y'}}</p>
                <h4 style="margin-bottom: -1.5rem;"><u><b>KEPALA KELURAHAN HAMADI</b></u></h4><br><br><br><br>
                <h4 style="margin-bottom: -1.5rem;"><u><b>RAIMON FIDMAN KARETH, S.STP</b></u></h4><br>
                <h4>NIP. 19841114 200312 1 001</h4>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
<script>
  (function ($) {
    // fungsi dijalankan setelah seluruh dokumen ditampilkan
    $(document).ready(function (e) {

      // aksi ketika tombol cetak ditekan
      $("#cetak").bind("click", function (event) {
        // cetak data pada area <div id="#data-mahasiswa"></div>
        $('#print').printArea();
      });
    });
  })(jQuery);</script>