angular.module('guest', ['guest.service'])
    .controller('guestController', guestController);

function guestController($scope, HomeService) {
    $scope.model={};
    $scope.total = 0;
    $scope.hasil = 0;
    $scope.datas = [];
    $scope.TotalUsulan = 0;
    $scope.TotalDiterima = 0;
    $scope.TotalDitolak = 0;
    $scope.TotalAnggaranMasuk = 0;
    $scope.TotalAnggaranDiterima = 0;
    $scope.TotalAnggaranDiTolak = 0;
    $scope.sumtotal = (item)=>{
        $scope.total += parseFloat(item);
    }
    $scope.convert = (item)=>{
        $scope.hasil += parseFloat(item);
    }
    HomeService.get().then(x => {
        $scope.datas = x;
        var Labelb = [];
        var DataB = [];
        var Label = {};
        var Datap = [];
        $scope.datas.forEach(element => {
            Label.name = 'RW ' + element.norw;
            Label.y = element.kegiatan.length;
            Datap.push(angular.copy(Label));
            Labelb.push('RW ' + element.norw);
            DataB.push(element.kegiatan.reduce(function (total, currentValue) {
                return total + parseFloat(currentValue.nominal);
            }, 0))
            $scope.TotalUsulan += element.kegiatan.length;
            var a = element.kegiatan.filter(x => x.status == 'Disetujui').length;
            $scope.TotalDiterima += a;
            var a = element.kegiatan.filter(x => x.status == 'Batal').length;
            $scope.TotalDitolak += a;
            if (element.kegiatan.length > 0) {
                element.kegiatan.forEach(itemkegiatan => {
                    $scope.TotalAnggaranMasuk += parseFloat(itemkegiatan.nominal);
                    $scope.TotalAnggaranDiterima += itemkegiatan.status == 'Disetujui' ? parseFloat(itemkegiatan.nominal) : 0;
                    $scope.TotalAnggaranDiTolak += itemkegiatan.status == 'Batal' ? parseFloat(itemkegiatan.nominal) : 0;
                    element.totalanggaran += itemkegiatan.status == 'Disetujui' ? parseFloat(itemkegiatan.nominal) : 0;
                })
            }
        });
        Highcharts.chart('urusan', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Statistik <b>Berdasarkan Jumlah Usulan</b>'
            },
            tooltip: {
                // pointFormat: 'Total Usulan: <b>{this.point}</b>'
                formatter: function () {
                    return ' ' +
                        'Total: <b>' + this.point.y + ' Usulan</b>';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: Datap
            }]
        });
        Highcharts.setOptions({
            lang: {
                thousandsSep: '.'
            }
        });
        var chart = Highcharts.chart('serapan', {
            title: {
                text: 'Grafik Serapan Anggaran per RW'
            },
            xAxis: {
                categories: Labelb
            },
            yAxis: {
                title: {
                    text: 'Persentase Realisasi Anggaran (%)'
                }
            },
            tooltip: {
                //pointFormat: "Value: {point.y:,.0f}"
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                name: 'Rp',
                data: DataB,
                showInLegend: false
            }]
        });
        $.LoadingOverlay("hide");
    })
    $scope.setModel = (item)=>{
        $scope.hasil = 0;
        item.kegiatan.forEach(element=>{
            $scope.hasil+= parseFloat(element.nominal);
        })
        $scope.model = item;
        console.log(item);
    }
}