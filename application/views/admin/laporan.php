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
          <a ng-show="periode.idPeriodeRenker" id="cetak" class="btn btn-primary" target="_blank">Cetak</a>
          <!-- <a ng-show="periode.idPeriodeRenker" id="cetak" href="<?=base_url('admin/laporan/print/')?>{{periode.idPeriodeRenker}}" class="btn btn-primary" target="_blank">Cetak</a> -->
        </div>
        <div id="print" style="width:100wh; overflow-x: auto;">
          <table class="table table-sm table-bordered">
          <thead>
              <tr>
                <th class="align-middle text-center" style="width: 10px" rowspan="4">No</th>
                <th class="align-middle text-center"  colspan="2" rowspan="4">Bidang/Program/Jenis Kegiatan</th>
                <th class="align-middle text-center" rowspan="4">Target/Valume<br>(M/Km/Unit/Buah)</th>
                <th class="align-middle text-center" rowspan="4">Lokasi <br>(RT/RW/Jalan)</th>
                <th class="align-middle text-center" colspan="5">Rencana Biaya Yang Diusulkan</th>
                <th class="align-middle text-center" rowspan="4">Keterangan<br>(Kelompok Bidang SKPD)</th>
              </tr>
              <tr>
                <th class="align-middle text-center" colspan="2">Anggaran Kampung/Kelurahan</th>
                <th class="align-middle text-center" rowspan="3">Anggaran Distrik<br>(APBD Kota)</th>
                <th class="align-middle text-center" rowspan="3">Anggaran SKPD</th>
                <th class="align-middle text-center" rowspan="3">Sumber Dana Lainnya</th>
              </tr>
              <tr>
                <th class="align-middle text-center" colspan="2">APBD Kota Optimalisasi</th>
              </tr>
              <tr>
                <th class="align-middle text-center">Sharing Dana Prog. Kota Tanpa Kumuh(KOTAK)</th>
                <th class="align-middle text-center">Biaya Penunjang Pemerintahan Kamp./Kel.</th>
              </tr>
              <tr>
                <th>1</th>
                <th colspan="2">2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
              </tr>
            </thead>
            <tbody>
              <?php
$total1 = 0;
$total2 = 0;
$total3 = 0;
$total4 = 0;
$total5 = 0;
foreach ($data as $key => $value): $jumlah1 = 0;
    $jumlah2 = 0;
    $jumlah3 = 0;
    $jumlah4 = 0;
    $jumlah5 = 0?>
																			                <tr>
																			                  <td rowspan="<?=$value->rows + 1?>"><strong><?=$this->mylib->numberToRomanRepresentation($key + 1)?></strong></td>
																			                  <td colspan="10"><strong><?=$value->NamaBidang?></strong></td>
																			                </tr>
																			                <?php $nomor = 0;foreach ($value->kegiatan as $key1 => $kegiatan): ?>
																								                <?php foreach ($kegiatan->renja as $key2 => $renja): $nomor += 1?>
																																																																							                <tr>
																																																																							                  <td style="width: 25px"><?=$nomor?></td>
																																																																							                  <td><?=$kegiatan->NamaKegiatan?></td>
																																																																							                  <td><?=$renja->volume . ' ' . $renja->satuan?></td>
																																																																							                  <td><?=$renja->nort . '/' . $renja->norw . '-' . $renja->jalan?></td>
																																																																							                  <td class="text-right"><?=$renja->NamaBidangSkpd == 'Sharing Dana Prog. Kota Tanpa Kumuh(KOTAK)' ? number_format($renja->nominal, 2) : ""?></td>
																																																																							                  <td class="text-right"><?=$renja->NamaBidangSkpd == 'Biaya Penunjang Pemerintahan Kamp./Kel.' ? number_format($renja->nominal, 2) : ""?></td>
																																																																							                  <td class="text-right"><?=$renja->NamaBidangSkpd == 'Anggaran Distrik (APBD Kota)' ? number_format($renja->nominal, 2) : ""?></td>
																																																																							                  <td class="text-right"><?=substr($renja->NamaBidangSkpd, 0, 4) == 'SKPD' ? number_format($renja->nominal, 2) : ""?></td>
																																																																							                  <td class="text-right"><?=$renja->NamaBidangSkpd == 'Sumber Dana Lainnya' ? number_format($renja->nominal, 2) : ""?></td>
																																															                                                                  <td class="text-right"><?=$renja->NamaBidangSkpd?></td>
																																																																							                </tr>
																																																																							    <?php $renja->NamaBidangSkpd == 'Sharing Dana Prog. Kota Tanpa Kumuh(KOTAK)' ? $jumlah1 += $renja->nominal : $renja->NamaBidangSkpd == 'Biaya Penunjang Pemerintahan Kamp./Kel.' ? $jumlah2 += $renja->nominal : $renja->NamaBidangSkpd == 'Anggaran Distrik (APBD Kota)' ? $jumlah3 += $renja->nominal : substr($renja->NamaBidangSkpd, 0, 4) == 'SKPD' ? $jumlah4 += $renja->nominal : $jumlah5 += $renja->nominal;endforeach;?>
																																	    <?php endforeach;?>
                <tr>
                  <td colspan="5">Jumlah</td>
                  <td class="text-right"><?=number_format($jumlah1, 2)?></td>
                  <td class="text-right"><?=number_format($jumlah2, 2)?></td>
                  <td class="text-right"><?=number_format($jumlah3, 2)?></td>
                  <td class="text-right"><?=number_format($jumlah4, 2)?></td>
                  <td class="text-right"><?=number_format($jumlah5, 2)?></td>
                  <td></td>
                </tr>
								    <?php $total1 += $jumlah1;
$total2 += $jumlah2;
$total3 += $jumlah3;
$total4 += $jumlah4;
$total5 += $jumlah5;endforeach;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" class="text-center"><strong>Total</strong></td>
                <td class="text-right"><b><?=number_format($total1, 2)?></b></td>
                <td class="text-right"><b><?=number_format($total2, 2)?></b></td>
                <td class="text-right"><b><?=number_format($total3, 2)?></b></td>
                <td class="text-right"><b><?=number_format($total4, 2)?></b></td>
                <td class="text-right"><b><?=number_format($total5, 2)?></b></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
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
