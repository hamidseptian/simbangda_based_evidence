
<script src="<?php echo base_url('assets/') ?>highchart/code/highcharts.js"></script>

                     <input type="hidden" class="form-control" id="id_instansi_grafik" value="<?php echo id_instansi() ?>">
                    <div id="pagu_dan_realisasi" name="pagu_dan_realisasi"></div>



                    
<script type="text/javascript">
  

  Highcharts.chart('pagu_dan_realisasi', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Anggaran SKPD'
    },
    subtitle: {
        text: '<b>Total Pagu : <?php echo number_format($pagu_total) ?><br>Total Realisasi : <?php echo number_format($realisasi_total).' ('.round($persen_realisasi_total,2).'%)' ?></b>'
    },
    xAxis: {
        categories: ['Belanja Operasi', 'Belanja Modal', 'Belanja Tidak Terduga', 'Belanja Transfer'],
        title: {
            text: null
        },

    gridLineWidth: 1, // garis vertikal
    gridLineColor: 'pink',
    tickInterval: 1


    },
    yAxis: {
      min: 0,
      title: {
          text: 'Dalam Rupiah',
          align: 'high'
      },
      labels: {
        formatter: function () {
            if (this.value >= 1000000000000) {
                return 'Rp ' + (this.value / 1000000000000) + ' T';
            }
            else if (this.value >= 1000000000) {
                return 'Rp ' + (this.value / 1000000000) + ' M';
            } else if (this.value >= 1000000) {
                return 'Rp ' + (this.value / 1000000) + ' Jt';
            }
            return 'Rp ' + this.value;
        }
    },

    gridLineWidth: 1, // garis horizontal
    gridLineColor: 'pink'
  },
    tooltip: {
        valueSuffix: ' Rupiah '
    },
    plotOptions: {
        bar: {
            borderRadius: '50%',
            dataLabels: {
                enabled: true
            },
            groupPadding: 0.1
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'bottom',// posisi vertikal (bawah)
            x: -10,
        y: -100,
        floating: true,
        borderWidth: 1,
        backgroundColor: 'var(--highcharts-background-color, #ffffff)',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Pagu',
        data: [<?php echo $pagu_bo ?>, <?php echo $pagu_bm ?>, <?php echo $pagu_btt ?>, <?php echo $pagu_bt ?>],

          color: 'aqua',
    }, {
        name: 'Realisasi',
        data: [<?php echo $realisasi_bo ?>, <?php echo $realisasi_bm ?>, <?php echo $realisasi_btt ?>, <?php echo $realisasi_bt ?>],
          color: 'blue',
    }
    ]
});



</script>