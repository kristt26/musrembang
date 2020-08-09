<div class="row" ng-app="app" ng-controller="homeController">
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{TotalUsulan | number}}</h3>

        <p>Usulan Masuk</p>
        <div class="chip z-depth-4 shadow-demo">Rp. {{TotalAnggaranMasuk | number}}</div>
      </div>
      <div class="icon">
        <i class="fas fa-database"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{TotalDiterima | number}}</h3>

        <p>Usulan Diterima</p>
        <div class="chip z-depth-4 shadow-demo">Rp. {{TotalAnggaranDiterima | number}}</div>
      </div>
      <div class="icon">
        <i class="fas fa-database"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{TotalDitolak | number}}</h3>

        <p>Usulan Ditolak</p>
        <div class="chip z-depth-4 shadow-demo">Rp. {{TotalAnggaranDiTolak | number}}</div>
      </div>
      <div class="icon">
        <i class="fas fa-database"></i>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Grafik Pengajuan Rencana per RW</h3>
      </div>
      <div class="card-body">
        <canvas id="myChart" class="chartjs" width="770" height="385"
          style="display: block; width: 770px; height: 385px;"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Grafik Usulan</h3>
      </div>
      <div class="card-body d-flex justify-content-center">
        <div id="canvas-holder"  style="width:50%">
          <canvas id="chart-diterima"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Rekapitulasi Rencana Kerja</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>RW</th>
              <th>RT</th>
              <th>Total Usulan</th>
              <th>Total Usulan Diterima</th>
              <th>Total Usulan Ditolak</th>
              <th>Total Anggaran</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas">
              <td>{{$index+1}}</td>
              <td>{{item.norw}}</td>
              <td>{{item.totalrt}}</td>
              <td>{{item.totalrencanakerja}}</td>
              <td>{{item.totaldisetujui}}</td>
              <td>{{item.totalbatal}}</td>
              <td>{{item.totalanggaran | number}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>