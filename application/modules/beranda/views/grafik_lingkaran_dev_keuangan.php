<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<style type="text/css">
   

.highcharts-figure {
    min-width: 320px;
    max-width: 660px;
    margin: 1em auto;
}

.highcharts-description {
    background: light-dark(#f2f6f2, #323232);
    border-radius: 0 4px 4px 0;
    border-left: 2px solid light-dark(#1d6aff, #fff);
    font-size: 0.8rem;
    font-style: italic;
    padding: 8px 16px;
    margin: 2em 10px 1em;
}

</style>
    <div id="graik_dev_keuangan"></div>








<script type="text/javascript">
    Highcharts.chart('graik_dev_keuangan', {
    chart: {
        type: 'pie',
        custom: {},
        events: {
            render: function () {
                const chart = this;
                const series = chart.series[0];

                let customLabel = chart.options.chart.custom.label;

                // Membuat label hanya sekali
                if (!customLabel) {
                    customLabel = chart.options.chart.custom.label =
                        chart.renderer.label(
                            `
                            <div style="
                                width: 200px;
                                text-align: center;
                                color: #333;
                                font-family: Arial, sans-serif;
                            ">
                                <div style="
                                    font-size: 13px;
                                    font-weight: bold;
                                    margin-bottom: 2px;
                                ">
                                    Statistika Deviasi KEUANGAN
                                </div>

                                <table style="
                                    width: 100%;
                                    border-collapse: collapse;
                                    font-size: 9px;
                                    background: #fff;
                                ">
                                    <thead>
                                        <tr style="background: #eaf2f8;">
                                            <th style="border: 1px solid #bbb; padding: 2px;">
                                                Warna
                                            </th>
                                            <th style="border: 1px solid #bbb; padding: 2px;">
                                                Ket Deviasi
                                            </th>
                                            <th style="border: 1px solid #bbb; padding: 2px;">
                                                Jumlah
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <span style="color: #f8b2b2;">&#9632;</span>
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                (≥ -10%)
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <?php echo $deviasi_opd['keuangan']['opd_merah'] ?>  OPD
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <span style="color: #fcf3cf;">&#9632;</span>
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                (≥ -5 s.d -10%)
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <?php echo $deviasi_opd['keuangan']['opd_kuning'] ?> OPD
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <span style="color: #d5f5e3;">&#9632;</span>
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                (≥ -5%)
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <?php echo $deviasi_opd['keuangan']['opd_hijau'] ?> OPD
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <span style="color: #ff7cfd;">&#9632;</span>
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                (Melebihi Target)
                                            </td>
                                            <td style="border: 1px solid #bbb; padding: 2px;">
                                                <?php echo $deviasi_opd['keuangan']['opd_ungu'] ?> OPD
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            `,
                            0,
                            0,
                            undefined,
                            undefined,
                            undefined,
                            true
                        ).add();
                }

                // Memposisikan tabel tepat di tengah donut
                const box = customLabel.getBBox();

                const x = chart.plotLeft +
                    series.center[0] - box.width / 2;

                const y = chart.plotTop +
                    series.center[1] - box.height / 2;

                customLabel.attr({
                    x: x,
                    y: y
                });
            }
        }
    },

    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },

    title: {
        text: 'ANALISIS DEVIASI REALISASI KEUANGAN TERHADAP TARGET'
    },

    subtitle: {
        text: ''
    },

    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
    },

    legend: {
        enabled: false
    },

        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                borderRadius: 3,
                showInLegend: false
            },
            pie: {
                dataLabels: [{
                    // Label di luar lingkaran
                    enabled: true,
                    distance: 7,
                    format: '{point.name}',
                    connectorWidth: 1,
                    allowOverlap: false,
                    style: {
                        fontSize: '12px',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    }
                }, {
                    // Label di dalam lingkaran
                    enabled: true,
                    distance: -35,
                    format: '{point.percentage:.2f}%',
                    backgroundColor: 'contrast',
                    style: {
                        fontSize: '11px',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    }
                }]
            }
        },

    series: [{
        name: 'Pagu',
        colorByPoint: true,
        size: '100%',
        innerSize: '85%',

        data: [{
            name: '> -10%',
            y: <?php echo $deviasi_opd['keuangan']['opd_merah'] ?> ,
            color: '#f8b2b2'
        }, {
            name: '-5 s/d -10%',
            y: <?php echo $deviasi_opd['keuangan']['opd_kuning'] ?>,
            color: '#fcf3cf'
        }, {
            name: '< -5%',
            y: <?php echo $deviasi_opd['keuangan']['opd_hijau'] ?>,
            color: '#d5f5e3'
        }, {
            name: '+',
            y: <?php echo $deviasi_opd['keuangan']['opd_ungu'] ?>,
            color: '#ff7cfd'
        }]
    }]
});


</script>
