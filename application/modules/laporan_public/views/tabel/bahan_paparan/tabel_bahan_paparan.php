<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?> - <?php echo $this->template->settings('app_name'); ?></title>
    <!-- Favico -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/sbe/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Alfikri" />
    <meta name="description" content="SIMBANGDA Based Evidence, simbangda based evidence, SIMBANGDA berbasis pembuktian, simbangda berbasis pembuktian, SIMBANGDA SUMBAR, simbangda sumbar, Sistem Informasi Manajemen Pembangunan Daerah, Sistem Informasi Manajemen Pembangunan Daerah Sumbar, Sumatera Barat" />
    <meta name="keywords" content="Simbangda based evidence, Sistem Informasi Manajemen Pembangunan Daerah, simbangda berbasis pembuktian, simbangda sumbar, Sumbar, Sumatera Barat, Pemprov Sumbar, Pemerintah Provinsi Sumatera Barat, Alfikri, Al, Fikri, alfikri, alfikri, alfikridotname" />
    <meta name="msapplication-tap-highlight" content="no">
    <!-- Bootstrap 4.3.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Architectui HTML FREE -->
    <link href="<?php echo base_url() ?>assets/architectui-html-pro/main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert2.min.css">
    <?php echo $extra_css; ?>
</head>



<div style="margin:15px">
    
<?php //  echo json_encode($eeeeeeeee) ?>
<?php 
  //   arsort($eeeeeeeee['keuangan']['diatas_rata_rata']['semua']);
  // echo json_encode($eeeeeeeee['keuangan']['diatas_rata_rata']['semua']);
   ?>

    <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="tabs-lg-alternate card-header">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item">
                                                    <a data-toggle="tab" href="#capaian_prov_sumbar" class="nav-link ">
                                                       <h5 class="card-title">Capaian Provinsi Sumatera Barat</h5>
                                                    </a></li>
                                                <li class="nav-item">
                                                    <a data-toggle="tab" href="#pdf_rekap_asisten" class="nav-link show">
                                                      <h5 class="card-title">Laporan Realisasi Semua OPD</h5>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a data-toggle="tab" href="#statistika_deviasi" class="nav-link  active show">
                                                         <h5 class="card-title">Grafik</h5>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a data-toggle="tab" href="#perengkingan_opd" class="nav-link show">
                                                      <h5 class="card-title">Perengkingan</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane " id="capaian_prov_sumbar" role="tabpanel">
                                                <div class="card-body">
                                                  <table class="table table-bordered">
                                                      <tr>
                                                          <th align="center">Sumber Dana</th>
                                                          <th align="center" colspan="3">Fisik</th>
                                                          <th align="center" colspan="3">Keuangan</th>
                                                      </tr>
                                                      <tr>
                                                          <th align="center" rowspan="2">APBD Provinsi</th>
                                                          <td>Target</td>
                                                          <td>Realisasi</td>
                                                          <td>Deviasi</td>
                                                          <td>Target</td>
                                                          <td>Realisasi</td>
                                                          <td>Deviasi</td>
                                                      </tr>
                                                      <tr>
                                                          <td><?php echo $capaian_provinsi_sumbar['tf'] ?></td>
                                                          <td><?php echo $capaian_provinsi_sumbar['rf'] ?></td>
                                                          <td><?php echo $capaian_provinsi_sumbar['df'] ?></td>
                                                          <td><?php echo $capaian_provinsi_sumbar['tk'] ?></td>
                                                          <td><?php echo $capaian_provinsi_sumbar['rk'] ?></td>
                                                          <td><?php echo $capaian_provinsi_sumbar['dk'] ?></td>
                                                      </tr>
                                                  </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane show" id="pdf_rekap_asisten" role="tabpanel">
                                                <div class="card-body">
                                                    <iframe src="<?php echo base_url() ?>laporan/pdf_laporan_rekap_asisten?bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun ?>&tahap=<?php echo $tahap ?>&kategori=Akumulasi" width="100%" height="600px"></iframe>
                                                </div>
                                            </div>
                                            <div class="tab-pane active show " id="statistika_deviasi" role="tabpanel">
                                                <br>
                                                <div class="mb-3 card">
                                                    <div class="card-header">
                                                        <ul class="nav nav-justified">
                                                            <li class="nav-item"><a data-toggle="tab" href="#grafik_fisik_tab" class="nav-link active bg-dark text-white show">Fisik</a></li>
                                                            <li class="nav-item"><a data-toggle="tab" href="#grafik_realisasi_keuangan_tab" class="nav-link bg-dark text-white">Keuangan</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="grafik_fisik_tab" role="tabpanel">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3 card">
                                                                        <div class="card-header">
                                                                           <label> Grafik realisasi fisik</label>
                                                                        <div class="btn-actions-pane-right">
                                                                            Ratarata Realisasi Fisik Provinsi : <b><?php echo round($ratarata_realisasi_fisik,2) ?></b>
                                                                        </div>
                                                                    </div>
                                                                        <div class="card-body">
                                                                            <div class="border">
                                                                                 <div class="card-header">
                                                                           <label> Realisasi fisik semua OPD</label>
                                                                    </div>
                                                                                <div id="grafik_realisasi_fisik"></div>
                                                                                    <div class="btn-actions-pane-right">
                                                                                        <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                            <button onclick="lihat_realisasi_fisik_lingkaran()" class="btn btn-outline-info btn-sm"> Diagram Lingkaran</button>
                                                                                            <button onclick="lihat_realisasi_fisik()" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi Fisik</button>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-4 border">
                                                                                    <div class="card-header">
                                                                                        <label>Realisasi fisik OPD Lingkup Asisten 1</label>
                                                                                    </div>
                                                                                <div id="grafik_realisasi_fisik_asisten_1"></div>
                                                                                <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                     <button onclick="lihat_realisasi_fisik_asisten_lingkaran(1)" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                    <button onclick="lihat_realisasi_fisik_asisten(1)" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi Fisik Asisten 1</button>  
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-md-4 border">
                                                                                    <div class="card-header">
                                                                                        <label>Realisasi fisik OPD Lingkup Asisten 2</label>
                                                                                    </div>
                                                                                    <div id="grafik_realisasi_fisik_asisten_2"></div>
                                                                                    <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                     <button onclick="lihat_realisasi_fisik_asisten_lingkaran(2)" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                    <button onclick="lihat_realisasi_fisik_asisten(2)" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi Fisik Asisten 2</button>
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-md-4 border">
                                                                                    <div class="card-header">
                                                                                        <label>Realisasi fisik OPD Lingkup Asisten 3</label>
                                                                                    </div>
                                                                                    <div id="grafik_realisasi_fisik_asisten_3"></div>
                                                                                    <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                     <button onclick="lihat_realisasi_fisik_asisten_lingkaran(3)" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                    <button onclick="lihat_realisasi_fisik_asisten(3)" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi Fisik Asisten 3</button>
                                                                                  </div>
                                                                                  
                                                                                </div>
                                                                               
                                                                            </div>              
                                                                                <hr>    
                                                                            <div class="border">   

                                                                                    <div class="card-header">
                                                                                        <label>Deviasi fisik OPD</label>
                                                                                    </div>
                                                                                <div id="grafik_deviasi_fisik_semua"></div>

                                                                                 <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                             <button onclick="lihat_deviasi_fisik_lingkaran()" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                        <button onclick="lihat_deviasi_fisik()" class="btn btn-outline-info btn-sm"> Lihat Data deviasi fisik</button>
                                                                                        </div>
                                                                                 <br>  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="grafik_realisasi_keuangan_tab" role="tabpanel">
                                                                  <div class="col-md-12">
                                                                    <div class="mb-3 card">
                                                                      <div class="card-header">
                                                                        <label> Grafik realisasi Keuangan</label>
                                                                        <div class="btn-actions-pane-right">
                                                                          Ratarata Realisasi Keuangan Provinsi : <b><?php echo round($ratarata_realisasi_keuangan,2) ?></b>
                                                                        </div>
                                                                      </div>
                                                                        <div class="card-body">
                                                                          <div class="border">
                                                                            <div class="card-header">
                                                                              <label> Realisasi Keuangan semua OPD</label>
                                                                            </div>
                                                                            <div id="grafik_realisasi_keuangan"></div>
                                                                            <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                     <button onclick="lihat_realisasi_keuangan_lingkaran()" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                              <button onclick="lihat_realisasi_keuangan()" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi keuangan</button>
                                                                            </div>
                                                                          </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-4 border">
                                                                                    
                                                                                  <div class="card-header">
                                                                                        <label>Grafik realisasi keuangan OPD Lingkup Asisten 1</label>
                                                                                    </div>
                                                                                <div id="grafik_realisasi_keuangan_asisten_1"></div>
                                                                                <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                             <button onclick="lihat_realisasi_keuangan_lingkaran_asisten(1)" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                      <button onclick="lihat_realisasi_keuangan_asisten(1)" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi keuangan Asisten 1</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4 border">
                                                                                    
                                                                                  <div class="card-header">
                                                                                        <label>Grafik realisasi keuangan OPD Lingkup Asisten 2</label>
                                                                                    </div>
                                                                                    <div id="grafik_realisasi_keuangan_asisten_2"></div>
                                                                                    <div role="group" class="btn-group-sm btn-group btn-block">

                                                                                     <button onclick="lihat_realisasi_keuangan_lingkaran_asisten(2)" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                      <button onclick="lihat_realisasi_keuangan_asisten(2)" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi keuangan Asisten 2</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4 border">
                                                                                  <div class="card-header">
                                                                                        <label>Grafik realisasi keuangan OPD Lingkup Asisten 3</label>
                                                                                    </div>
                                                                                    <div id="grafik_realisasi_keuangan_asisten_3"></div>
                                                                                    <div role="group" class="btn-group-sm btn-group btn-block">

                                                                                     <button onclick="lihat_realisasi_keuangan_lingkaran_asisten(3)" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                      <button onclick="lihat_realisasi_keuangan_asisten(3)" class="btn btn-outline-info btn-sm"> Lihat Data Realisasi keuangan Asisten 3</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                                  <hr>  
                                                                            <div class="border">   

                                                                                    <div class="card-header">
                                                                                        <label>Deviasi Keuangan OPD</label>
                                                                                    </div>
                                                                                <div id="grafik_deviasi_keuangan_semua"></div>

                                                                                 <div role="group" class="btn-group-sm btn-group btn-block">
                                                                                             <button onclick="lihat_deviasi_keuangan_lingkaran()" class="btn btn-outline-info btn-sm "> Diagram Lingkaran</button>
                                                                                        <button onclick="lihat_deviasi_keuangan()" class="btn btn-outline-info btn-sm"> Lihat Data deviasi keuangan</button>
                                                                                        </div>
                                                                                 <br>  
                                                                            </div>
                                                                        </div>
                                                                      </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="card-body">
























                            


                        </div>

                                            <div class="tab-pane show" id="perengkingan_opd" role="tabpanel">
                                                <div class="row">
                                                 <div class="col-md-6">
                                                    <div class="mb-3 card">
                                                        <div class="card-body">
                                                          Perengkingan Realisasi Fisik Tertinggi
                                                          <table class="table">
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>SKPD</th>
                                                                  <th>Capaian</th>
                                                              </tr>
                                                              <?php 
                                                              $no_fisik_tertinggi = 1;
                                                              foreach ($perengkingan_fisik_tertinggi as $k => $v) { ?>
                                                                    <tr>
                                                                        <td><?php echo $no_fisik_tertinggi++ ?></td>
                                                                        <td><?php echo $v->nama_instansi ?></td>
                                                                        <td><?php echo $v->realisasi_fisik ?></td>
                                                                    </tr>
                                                              <?php } ?>
                                                          </table>

                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="mb-3 card">
                                                        <div class="card-body">
                                                          Perengkingan Realisasi Fisik Terendah
                                                           <table class="table">
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>SKPD</th>
                                                                  <th>Capaian</th>
                                                              </tr>
                                                              <?php 
                                                              $no_fisik_terendah = 1;
                                                              foreach ($perengkingan_fisik_terendah as $k => $v) { ?>
                                                                    <tr>
                                                                        <td><?php echo $no_fisik_terendah++ ?></td>
                                                                        <td><?php echo $v->nama_instansi ?></td>
                                                                        <td><?php echo $v->realisasi_fisik ?></td>
                                                                    </tr>
                                                              <?php } ?>
                                                          </table>

                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="mb-3 card">
                                                        <div class="card-body">
                                                          Perengkingan Realisasi Keuangan Tertinggi
                                                              <table class="table">
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>SKPD</th>
                                                                  <th>Capaian</th>
                                                              </tr>
                                                              <?php 
                                                              $no_keuangan_tertinggi = 1;
                                                              foreach ($perengkingan_keuangan_tertinggi as $k => $v) { ?>
                                                                    <tr>
                                                                        <td><?php echo $no_keuangan_tertinggi++ ?></td>
                                                                        <td><?php echo $v->nama_instansi ?></td>
                                                                        <td><?php echo $v->realisasi_keuangan ?></td>
                                                                    </tr>
                                                              <?php } ?>
                                                          </table>

                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="mb-3 card">
                                                        <div class="card-body">
                                                          Perengkingan Realisasi Keuangan Terendah
                                                            <table class="table">
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>SKPD</th>
                                                                  <th>Capaian</th>
                                                              </tr>
                                                              <?php 
                                                              $no_keuangan_terendah = 1;
                                                              foreach ($perengkingan_keuangan_terendah as $k => $v) { ?>
                                                                    <tr>
                                                                        <td><?php echo $no_keuangan_terendah++ ?></td>
                                                                        <td><?php echo $v->nama_instansi ?></td>
                                                                        <td><?php echo $v->realisasi_keuangan ?></td>
                                                                    </tr>
                                                              <?php } ?>
                                                          </table>

                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                               
                            </div>
   

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Bootstrap 4.3.1 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/architectui-html-pro/assets/scripts/main.87c0748b313a1dda75f5.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery-ajax-progress/jquery.ajax-progress.js"></script>
    <script>
        function baseUrl(link = '') {
            let alamat = "<?php echo base_url(); ?>" + link;
            return alamat;
        }
    </script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/sbe/fungsi.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery_number/jquery.number.js"></script>
    <?php echo $extra_js; ?>
    <?php echo $extra_js_tambahan; ?>
    <?php echo $modal; ?>

<script type="text/javascript">

    // Make monochrome colors
// var pieColors = (function () {
//   var colors = [],
//     base = Highcharts.getOptions().colors[0],
//     i;

//   for (i = 0; i < 10; i += 1) {
//     // Start out with a darkened base color (negative brighten), and end
//     // up with a much brighter color
//     colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
//   }
//   return colors;
// }());

// Build the chart
Highcharts.chart('grafik_deviasi_fisik', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Share',
    data: [
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_fisik']['ungu'] ?>, 
            color: '#ff7cfd',
       },
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_fisik']['hijau'] ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_fisik']['kuning'] ?>, 
            color: '#fcf3cf',
       },
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_fisik']['merah'] ?>, 
            color: '#f8b2b2',
       },
    
    
    ]
  }]
});






Highcharts.chart('grafik_deviasi_keuangan', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Share',
    data: [
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_keuangan']['ungu'] ?>, 
            color: '#ff7cfd',
       },
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_keuangan']['hijau'] ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_keuangan']['kuning'] ?>, 
            color: '#fcf3cf',
       },
      { 
            name: '', y: <?php echo $grafik_deviasi['statistika_keuangan']['merah'] ?>, 
            color: '#f8b2b2',
       },
    
    
    ]
  }]
});





Highcharts.chart('grafik_realisasi_fisik_semua', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['semua'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['semua'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});






Highcharts.chart('grafik_lingkaran_realisasi_fisik_asisten_1', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['asisten_1'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['asisten_1'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});








Highcharts.chart('grafik_lingkaran_realisasi_fisik_asisten_2', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['asisten_2'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['asisten_2'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});





Highcharts.chart('grafik_lingkaran_realisasi_fisik_asisten_3', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['asisten_3'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['asisten_3'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});







Highcharts.chart('grafik_lingkaran_realisasi_keuangan_semua', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['semua'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['semua'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});















Highcharts.chart('grafik_lingkaran_realisasi_keuangan_asisten_1', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['asisten_1'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['asisten_1'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});











Highcharts.chart('grafik_lingkaran_realisasi_keuangan_asisten_2', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['asisten_2'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['asisten_2'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});









Highcharts.chart('grafik_lingkaran_realisasi_keuangan_asisten_3', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      // colors: pieColors,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
        distance: -50,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        }
      }
    }
  },
  series: [{
    name: 'Pencapaian',
    data: [
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['asisten_3'],2) ?>, 
            color: '#d5f5e3',
       },
      { 
            name: '', y: <?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['asisten_3'],2) ?>, 
            color: '#f8b2b2',
       },
     
    
    ]
  }]
});









// Create the chart
Highcharts.chart('grafik_realisasi_fisik', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Fisik'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
          rotation: 270,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Fisik",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_fisik as $key => $value) { 
        $urutan = $key+1;
        if ($value['rf']<$ratarata_realisasi_fisik) {
            $warna = '#f8b2b2';
        }else{
            $warna = '#d5f5e3';

        }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rf'] ?>,

          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});


// Create the chart
Highcharts.chart('grafik_realisasi_keuangan', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Keuangan'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,

          rotation: 270,
               y: -15,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Keuangan",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_keuangan as $key => $value) { 
        $urutan = $key+1;
        if ($value['rk']<$ratarata_realisasi_keuangan) {
            $warna = '#f8b2b2';
        }else{
            $warna = '#d5f5e3';

        }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rk'] ?>,
          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});



Highcharts.chart('grafik_deviasi_keuangan_semua', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },  

  yAxis: {
    title: {
      text: 'Deviasi Keuangan'
    }

  },      
    credits: {
        enabled: false
    },

  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,

          rotation: 270,
               y: -15,
        format: '{point.y:.2f}%'
      }
    }
  },

    
  series: [
    {
      name: "Deviasi Keuangan",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_deviasi_keuangan as $key => $value) { 
        $urutan = $key+1;
        
            if ($value['dk'] <-10) {
              $warna = '#f8b2b2'; 
            }
            elseif ($value['dk'] <-5  && $value['dk'] >=-10) {
              $warna = '#fcf3cf';
            }
            elseif ($value['dk'] <=0  && $value['dk'] >=-5) {
              $warna = '#d5f5e3';
            }else{
              $warna = '#ff7cfd';
            }       
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['dk'] ?>,
          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
});
Highcharts.chart('grafik_deviasi_fisik_semua', {
    chart: {
        type: 'column'

    },
    title: {
        text: 'Deviasi fisik OPD'
    },
    
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  }, 

  yAxis: {
    title: {
      text: 'Deviasi Fisik'
    }

  },       
    credits: {
        enabled: false
    },

  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,

          rotation: 270,
               y: -15,
        format: '{point.y:.2f}%'
      }
    }
  },

    
  series: [
    {
      name: "Realisasi fisik",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_deviasi_fisik as $key => $value) { 
        $urutan = $key+1;
        
            if ($value['df'] <-10) {
              $warna = '#f8b2b2'; 
            }
            elseif ($value['df'] <-5  && $value['df'] >=-10) {
              $warna = '#fcf3cf';
            }
            elseif ($value['df'] <=0  && $value['df'] >=-5) {
              $warna = '#d5f5e3';
            }else{
              $warna = '#ff7cfd';
            }       
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['df'] ?>,
          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
});


function lihat_realisasi_fisik(){
    $('#data_realisasi_fisik').modal('show');
}
function lihat_realisasi_fisik_lingkaran(){
    $('#data_realisasi_fisik_lingkaran_semua').modal('show');
}
function lihat_realisasi_fisik_asisten(asisten_ke){
    $('#data_realisasi_fisik_asisten_' + asisten_ke).modal('show');
}
function lihat_realisasi_fisik_asisten_lingkaran(asisten_ke){
    $('#data_realisasi_fisik_lingkaran_asisten_' + asisten_ke).modal('show');
}
function lihat_realisasi_keuangan_lingkaran_asisten(asisten_ke){
    $('#data_realisasi_keuangan_lingkaran_asisten_' + asisten_ke).modal('show');
}
function lihat_realisasi_keuangan_asisten(asisten_ke){
    $('#data_realisasi_keuangan_asisten_' + asisten_ke).modal('show');
}
function lihat_realisasi_keuangan(){
    $('#data_realisasi_keuangan').modal('show');
}

function lihat_realisasi_keuangan_lingkaran(){
    $('#data_realisasi_keuangan_lingkaran_semua').modal('show');
}

function lihat_deviasi_fisik(){
    $('#data_deviasi_fisik').modal('show');
}
function lihat_deviasi_fisik_lingkaran(){
    $('#data_deviasi_fisik_lingkaran').modal('show');
}
function lihat_deviasi_keuangan(){
    $('#data_deviasi_keuangan').modal('show');
}
function lihat_deviasi_keuangan_lingkaran(){
    $('#data_deviasi_keuangan_lingkaran').modal('show');
}











// grafik per asisten - fisik asiasten 1 
Highcharts.chart('grafik_realisasi_fisik_asisten_1', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Fisik'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
          rotation: 270,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Fisik",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_fisik_asisten['asisten_1'] as $key => $value) { 
        $urutan = $key+1;
           if ($value['rf']<$ratarata_realisasi_fisik) {
                $warna = '#f8b2b2';
            }else{
                $warna = '#d5f5e3';

            }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rf'] ?>,

          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});




// grafik per asisten - fisik asiasten 2 
Highcharts.chart('grafik_realisasi_fisik_asisten_2', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Fisik'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
          rotation: 270,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Fisik",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_fisik_asisten['asisten_2'] as $key => $value) { 
        $urutan = $key+1;
           if ($value['rf']<$ratarata_realisasi_fisik) {
                $warna = '#f8b2b2';
            }else{
                $warna = '#d5f5e3';

            }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rf'] ?>,

          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});



// grafik per asisten - fisik asiasten 3 
Highcharts.chart('grafik_realisasi_fisik_asisten_3', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Fisik'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
          rotation: 270,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Fisik",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_fisik_asisten['asisten_3'] as $key => $value) { 
        $urutan = $key+1;
           if ($value['rf']<$ratarata_realisasi_fisik) {
                $warna = '#f8b2b2';
            }else{
                $warna = '#d5f5e3';

            }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rf'] ?>,

          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});






// Create the chart
Highcharts.chart('grafik_realisasi_keuangan_asisten_1', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Keuangan'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,

          rotation: 270,
               y: -15,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Keuangan",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_keuangan_asisten['asisten_1'] as $key => $value) { 
        $urutan = $key+1;
        if ($value['rk']<$ratarata_realisasi_keuangan) {
            $warna = '#f8b2b2';
        }else{
            $warna = '#d5f5e3';

        }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rk'] ?>,
          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});



// Create the chart
Highcharts.chart('grafik_realisasi_keuangan_asisten_2', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Keuangan'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,

          rotation: 270,
               y: -15,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Keuangan",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_keuangan_asisten['asisten_2'] as $key => $value) { 
        $urutan = $key+1;
        if ($value['rk']<$ratarata_realisasi_keuangan) {
            $warna = '#f8b2b2';
        }else{
            $warna = '#d5f5e3';

        }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rk'] ?>,
          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});



// Create the chart
Highcharts.chart('grafik_realisasi_keuangan_asisten_3', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: ''
  },
  subtitle: {
    align: 'left',
    text: ''
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category',
    gridLineWidth: 1,
  },
  yAxis: {
    title: {
      text: 'Realisasi Keuangan'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,

          rotation: 270,
               y: -15,
        format: '{point.y:.2f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Realisasi Keuangan",
      colorByPoint: true,
      data: [
      <?php foreach ($grafik_realisasi_keuangan_asisten['asisten_3'] as $key => $value) { 
        $urutan = $key+1;
        if ($value['rk']<$ratarata_realisasi_keuangan) {
            $warna = '#f8b2b2';
        }else{
            $warna = '#d5f5e3';

        }
        ?>
          
        {
          name: "<?php echo $value['singkatan_skpd'] ?>",
          y: <?php echo $value['rk'] ?>,
          drilldown: "Chrome",
          color :'<?php echo $warna ?>'
        },
      <?php } ?>
       
      ]
    }
  ],
  
});







</script>