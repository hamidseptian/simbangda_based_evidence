<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
   
                   <div id="grafik_infografis_batang"></div>


 
<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr><th colspan="2">
                                                    <center>Bulan / Keterangan</center>
                                                </th>
                                                <th>Jan</th>
                                                <th>Feb</th>
                                                <th>Mar</th>
                                                <th>Apr</th>
                                                <th>Mei</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Agu</th>
                                                <th>Sep</th>
                                                <th>Okt</th>
                                                <th>Nov</th>
                                                <th>Des</th>
                                            </tr>
                                        </thead>
                                            <tbody>


                                                <tr id="tfisik"><td rowspan="3" align="center">Fisik</td><td>Target</td><td>3.71</td><td>10.56</td><td>20.03</td><td>28.84</td><td>35.75</td><td>45.29</td><td>56.15</td><td>63.96</td><td>72.53</td><td>80.92</td><td>88.47</td><td>97.4</td></tr>
                                                <tr id="rfisik"><td>Realisasi</td><td>3.73</td><td>15.47</td><td>25.6</td><td>33.13</td><td>38.23</td><td>49.89</td><td>53.83</td><td>59.1</td><td></td><td></td><td></td><td></td></tr>
                                                <tr id="dfisik"><td>Deviasi</td><td>0.02</td><td>4.91</td><td>5.57</td><td>4.29</td><td>2.48</td><td>4.6</td><td>-2.32</td><td>-4.86</td><td></td><td></td><td></td><td></td></tr>
                                                <tr id="tkeu"><td rowspan="3" align="center">Keuangan</td><td>Target</td><td>3.34</td><td>7.77</td><td>15.58</td><td>25.77</td><td>31.3</td><td>41.2</td><td>56</td><td>63.73</td><td>74.23</td><td>80.53</td><td>89.98</td><td>99.83</td></tr>
                                                <tr id="rkeu"><td>Realisasi</td><td>2.84</td><td>7</td><td>14.73</td><td>20.95</td><td>28.58</td><td>38.66</td><td>44.75</td><td>54.61</td><td></td><td></td><td></td><td></td></tr>
                                                <tr id="dkeu"><td>Deviasi</td><td>-0.5</td><td>-0.77</td><td>-0.85</td><td>-4.82</td><td>-2.72</td><td>-2.54</td><td>-11.25</td><td>-9.12</td><td></td><td></td><td></td><td></td></tr>
                                            </tbody>
                                        </table>

<script>
    
        Highcharts.chart('grafik_infografis_batang', {
          chart: {
            zoomType: 'xy'
          },
          title: {
            text: 'Pencapaian Total SKPD'
          },
          subtitle: {
            text: 'Berdasarkan Akumulasi' ,
          },
          xAxis: [{
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
              'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

    gridLineWidth: 1, // garis vertikal
    gridLineColor: '#e0e0e0',
    tickInterval: 1,
            crosshair: true
          }],
          yAxis: [{ // Primary yAxis

            labels: {
              format: '{value}%',
              style: {
                color: Highcharts.getOptions().colors[1]
              }
            },
            title: {
              text: 'Fisik',
              style: {
                color: Highcharts.getOptions().colors[1]
              }
            },

    gridLineWidth: 1, // garis horizontal
    gridLineColor: '#e0e0e0'
          }, { 
            // Secondary yAxis

            opposite: true,
            title: {
              text: 'Keuangan',
              style: {
                color: Highcharts.getOptions().colors[0]
              }
            },
            labels: {
              format: '{value}%',
              style: {
                color: Highcharts.getOptions().colors[0]
              }
            },
          }],
          tooltip: {
            shared: true
          },
          legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || // theme
              'rgba(255,255,255,0.25)'
          },
          series: [
              {
                name: 'Target Fisik',
                type: 'column',
                yAxis: 0,
                color: 'pink',
                data: [3.71, 10.56, 20.03, 28.84,35.75, 45.29, 56.15, 63.96,72.53, 80.92, 88.47, 97.40],
                tooltip: {
                  valueSuffix: '%'
                }
              }, 
              {
                name: 'Target Keuangan',
                type: 'column',
                yAxis: 1,
                color: 'aqua',
                data: [ 3.73, 15.47, 25.60, 33.13,38.23, 49.89, 53.83, 59.10,null, null, null, null],
                tooltip: {
                  valueSuffix: '%'
                }
              }, 
              {
                name: 'Realisasi Fisik',
                type: 'line',

                color: 'red',
                yAxis: 0,
                data: [3.34, 7.77, 15.58, 25.77,31.30, 41.20, 56.00, 63.73,74.23, 80.53, 89.98, 99.83],
                // color: '#caf3d5',
                tooltip: {
                  valueSuffix: '%'
                }
              },
              {
                name: 'Realisasi Keuangan',
                type: 'line',

                 color: 'blue',

                yAxis: 1,
                data: [ 2.84, 7.00, 14.73, 20.95,28.58, 38.66, 44.75, 54.61,null, null, null, null],
                // color: '#caf3d5',
                tooltip: {
                  valueSuffix: '%'
                }
              }
          ]
        });
</script>