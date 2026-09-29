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
    <div id="container"></div>
<figure class="highcharts-figure">
    <p class="highcharts-description">
        In Highcharts, pie charts can also feature an empty center, they are
        often referred to as donut charts.
    </p>
</figure>













<script type="text/javascript">
    Highcharts.chart('container', {
    chart: {
        type: 'pie',
        custom: {},
        events: {
            render() {
                const chart = this,
                    series = chart.series[0];
                let customLabel = chart.options.chart.custom.label;

                if (!customLabel) {
                  customLabel = chart.options.chart.custom.label =
    chart.renderer.label(
        'Total Realisasi Keuangan<br/>' +
        '<strong>Rp. 6,495,480,791,071</strong><br>' + 
        '<strong>50%</strong>'
    )
    .css({
        color: 'var(--highcharts-neutral-color-100, #000)',
        textAnchor: 'middle',
        fontSize: '6px'
    })
    .add();
                }

                const x = series.center[0] + chart.plotLeft,
                    y = series.center[1] + chart.plotTop -
                    (customLabel.attr('height') / 2);

                customLabel.attr({
                    x,
                    y
                });
                // Set font size based on chart diameter
                customLabel.css({
                    fontSize: `${series.center[2] / 22}px`
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
        text: 'PERBANDINGAN RATA-RATA Realisasi (%)'
    },
    subtitle: {
        text: 'Source: <a href="https://www.ssb.no/transport-og-reiseliv/faktaside/bil-og-transport">SSB</a>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 8,
            dataLabels: [{
                enabled: true,
                distance: 20,
                format: '{point.name}'
            }, {
                enabled: true,
                backgroundColor: 'contrast',
                distance: -18,
                format: '{point.percentage:.0f}%',
                style: {
                    fontSize: '0.9em'
                }
            }],
            showInLegend: true
        }
    },
    series: [{
        name: 'pAGU',
        colorByPoint: true,
        size: '100%',
        innerSize: '85%',


dataLabels: [{
    enabled: true,
    distance: 25,
    format: '{point.name}',
    connectorWidth: 1,
    allowOverlap: false,
    style: {
        fontSize: '14px',
        fontWeight: 'bold'
    }
}, {
    enabled: true,
    distance: 25,
    format: '{point.percentage:.0f}%',
    backgroundColor: 'contrast'
}],


        data: [{
            name: 'P-BO',
            y: 23.9,
        color: 'blue'
        }, {
            name: 'P-BP',
            y: 12.6
        }, {
            name: 'P-BTT',
            y: 37.0
        }, {
            name: 'P-BT',
            y: 26.4
        }]
    },
    {
        name: 'Registrations',
        colorByPoint: true,
        size: '85%',
        innerSize: '75%',


 
dataLabels: [{
    enabled: true,
    distance: 10,
    format: '{point.name}',
    connectorWidth: 1,
    allowOverlap: false,
    style: {
        fontSize: '14px',
        fontWeight: 'bold'
    }
}],


        data: [{
            name: 'R-BO',
            y: 23.9
        }, {
            name: 'R-BP',
            y: 12.6
        }, {
            name: 'R-BTT',
            y: 37.0
        }, {
            name: 'R-BT',
            y: 26.4
        }]
    }
    ]
});


</script>