<style type="text/css">
    table th, td { border: 1px solid #ddd; padding: 1px 1px; }
</style>

  
<div class="tabs-animation">
 <input type="hidden" class="form-control" id="id_instansi_grafik" value="<?php echo id_instansi() ?>">
    <div class="row">
        <div class="col-lg-12 col-xl-12">

<input type="hidden" name="" id="tipe_grafik" value="gabungan">






            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                             <div id="container"></div>
                            
                        </div>
                      
                    </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" rowspan="2"><center>Bulan / Keterangan</center></th>
                         
                            <th colspan="12" id="capt_tabel_grafik"></th>
                        </tr>
                        <tr>
                            
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
                      
                       
                        <tr id="tfisik">
                            <td rowspan="3" align="center">Fisik <?php echo $menerima_tkd ?></td>
                        </tr>
                        <tr id="rfisik">
                        </tr>
                        <tr id="dfisik">
                        </tr>
                          <tr id="tkeu">
                            <td rowspan="3" align="center">Keuangan</td>
                        </tr>
                        <tr id="rkeu">
                        </tr>
                        <tr id="dkeu">
                        </tr>
                    </tbody>
                </table>
                <div class="btn-group btn-block">
                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="grafik('Akumulasi' ,$('#tipe_grafik').val())"><i class="fa fa-plus"> </i> Grafik Akumulasi</button>
                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"  onclick="grafik('Bulanan' ,$('#tipe_grafik').val())"><i class="fa fa-calendar"> </i> Grafik Bulanan</button>
              
                                             

   <?php if ($menerima_tkd==1){ ?>

                                                <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-primary btn-shadow btn-outline-2x">Ganti Data
                                                </button>
                                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                                    <button type="button" tabindex="0" class="dropdown-item" onclick="grafik('Akumulasi', 'apbd')">APBD</button>
                                                    <button type="button" tabindex="0" class="dropdown-item" onclick="grafik('Akumulasi', 'tkd')">TKD</button>
                                                    <button type="button" tabindex="0" class="dropdown-item" onclick="grafik('Akumulasi', 'gabungan')">Gabungan</button>
                                                </div>
 <?php } ?>
                                             
                                          
  <?php if ($this->session->userdata('group_name') == 'OPERATOR') : ?>
                         <?php if (kunci_synch()['synchronize']==1) { ?>
                                                <button class="btn-icon btn-shadow btn-outline-2x btn btn-outline-info"  onclick="sync(<?php echo $this->session->userdata('id_instansi'); ?>)" id="tombol_sync"><i class="fa fa-indent"> </i> Synchronize / Refresh Grafik</button>
                                            <?php }else{ ?>
                                                <button class="btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" onclick="Swal.fire('Terkunci','<?php echo kunci_synch()['pesan'] ?>','error')"  style="width:150px"> Synchronize / Refresh Grafik</button>   

                                            <?php } ?>
                                           
                <?php endif; ?>
                                              

                                           
                </div>

                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="<?php echo base_url('assets/') ?>highchart/code/highcharts.js"></script>

<script type="text/javascript">
  

        var menerima_tkd = <?php echo $menerima_tkd; ?>;
        if (menerima_tkd==1) {
          var tipe = 'gabungan';
        }else{
          var tipe = 'apbd';

        }



    grafik('Akumulasi', tipe);
    function grafik(kategori, tipe){
        $('#tipe_grafik').val(tipe);
        var sumber_data = requestData(kategori, tipe);
        var angka_grafik = sumber_data.grafik
        console.log(angka_grafik)
        $('#capt_tabel_grafik').html(sumber_data.caption_data_grafik)


        Highcharts.chart('container', {
          chart: {
            zoomType: 'xy'
          },
          title: {
            text: 'Pencapaian Total SKPD'
          },
          subtitle: {
            text: sumber_data.caption_data_grafik + ' ' + kategori
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
                data: angka_grafik.tf,
                tooltip: {
                  valueSuffix: '%'
                }
              }, 
              {
                name: 'Target Keuangan',
                type: 'column',
                yAxis: 1,
                color: 'aqua',
                data: angka_grafik.tk,
                tooltip: {
                  valueSuffix: '%'
                }
              }, 
              {
                name: 'Realisasi Fisik',
                type: 'line',

                color: 'red',
                yAxis: 0,
                data: angka_grafik.rf,
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
                data: angka_grafik.rk,
                // color: '#caf3d5',
                tooltip: {
                  valueSuffix: '%'
                }
              }
          ]
        });




        $('#tfisik').html('<td rowspan="3" align="center">Fisik</td>');
        $('#rfisik').html('');
        $('#dfisik').html('');
        $('#tkeu').html('<td rowspan="3" align="center">Keuangan</td>');
        $('#rkeu').html('');
        $('#dkeu').html('');

        $('#tfisik').append('<td>Target</td>');
        $('#rfisik').append('<td>Realisasi</td>');
        $('#dfisik').append('<td>Deviasi</td>');
        $('#tkeu').append('<td>Target</td>');
        $('#rkeu').append('<td>Realisasi</td>');
        $('#dkeu').append('<td>Deviasi</td>');


        var ba = <?php echo bulan_aktif(); ?>;
        for (var i = 0; i < 12; i++) {
                var deviasi_fisik = angka_grafik.rf[i] - angka_grafik.tf[i];
                $('#tfisik').append('<td>' + angka_grafik.tf[i] + '</td>');

                var deviasi_keuangan = angka_grafik.rk[i] - angka_grafik.tk[i];
                $('#tkeu').append('<td>' + angka_grafik.tk[i] + '</td>');
                // $('#dkeu').append('<td>' + angka_grafik.cek[i] + '</td>');

                if (i<ba) {
                  $('#rkeu').append('<td>' + angka_grafik.rk[i] + '</td>');
                  $('#rfisik').append('<td>' + angka_grafik.rf[i] + '</td>');
                  $('#dkeu').append('<td>' + deviasi_keuangan.toFixed(2) + '</td>');
                  $('#dfisik').append('<td>' + deviasi_fisik.toFixed(2) + '</td>');

                }
      



        }
    
    }

// console.log(requestData('Akumulasi'));

    function requestData(kategori, tipe) {
        var rf = [];
        var rk = [];
        var ba = <?php echo bulan_aktif(); ?>;

        $.ajax({
            url: '<?php echo base_url('dashboard/show_chart'); ?>',
            type: "GET",
            data : {
                id_instansi : $('#id_instansi_grafik').val(),
                id_group : '<?php echo $this->session->userdata('id_group') ?>',
                kategori : kategori,
                tipe : tipe,
            },
            dataType: "json",

            async: false,
            success: function(data) {
                // console.log(data.grafik);
                // $('#cekdata').html(data.grafik);
                result = data;
                
            },
            // cache: false
        });

        return result;
    }


</script>