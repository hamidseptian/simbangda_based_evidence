<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Selamat datang - <?php echo $this->template->settings('app_name'); ?></title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/sbe/favicon.ico" type="image/x-icon">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/css/base.min.css">

    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <!--Header START-->
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <img src="<?php echo base_url() ?>/assets/sbe/image/logo_sbe.png" alt="" width="150px">

            </div>
            <div class="app-header__mobile-menu">



                <div class="dropdown d-inline-block">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                        class="mb-2 mr-2" style="border:none;background:none"><span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span></button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">


                        <div class="scroll-area-xs">
                            <div class="scrollbar-container">
                                <h6 tabindex="-1" class="dropdown-header">Key Figures</h6>
                                <button type="button" tabindex="0" class="dropdown-item">Service Calendar</button>
                                <button type="button" tabindex="0" class="dropdown-item">Knowledge Base</button>
                                <button type="button" tabindex="0" class="dropdown-item">Accounts</button>
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <button type="button" tabindex="0" class="dropdown-item">Products</button>
                                <button type="button" tabindex="0" class="dropdown-item">Rollup Queries</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">

                    <ul class="header-megamenu nav" style="display:none">


                        <li class="dropdown nav-item">
                            <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
                                <i class="nav-link-icon fa fa-file"></i>
                                RFK
                                <i class="fa fa-angle-down ml-2 opacity-5"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-success">
                                        <div class="menu-header-image opacity-1"
                                            style="background-image: url('<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/images/dropdown-header/abstract3.jpg');">
                                        </div>
                                        <div class="menu-header-content text-left">
                                            <h5 class="menu-header-title">Overview</h5>
                                            <h6 class="menu-header-subtitle">Unlimited options</h6>
                                            <div class="menu-header-btn-pane">
                                                <button class="mr-2 btn btn-dark btn-sm">Settings</button>
                                                <button class="btn-icon btn-icon-only btn btn-warning btn-sm">
                                                    <i class="pe-7s-config btn-icon-wrapper"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-file-empty"> </i>Graphic Design</button>
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-file-empty"> </i>App Development</button>
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-file-empty"> </i>Icon Design</button>
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-file-empty"> </i>Miscellaneous</button>
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-file-empty"> </i>Frontend Dev</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="app-header-right">

                    <div class="header-dots">





                        <div class="dropdown mr-3">
                            <div class="widget-content p-0">
                                <div class="widget-subheading">
                                    Tahun Anggaran
                                </div>
                                <div class="widget-heading">
                                    <b> <?php echo tahun_anggaran() ?></b>
                                </div>
                            </div>


                        </div>
                        <div class="dropdown">
                            <div class="widget-content p-0">
                                <div class="widget-subheading">
                                    Tahapan APBD
                                </div>
                                <div class="widget-heading">
                                    <b> <?php echo  pilihan_nama_tahapan(tahapan_apbd()) ?></b>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="">
                                        <?php   if ($this->session->userdata('session_name')!='SBE_LOGIN') { ?>
                                        <a href="<?php echo base_url() ?>auth/" class="btn btn-info btn-sm ">Login</a>
                                        <?php   }else{ ?>
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <img width="42" class="rounded-circle"
                                                src="<?php echo base_url(); ?>assets/sbe/image/user.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <?php   }        ?>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2"
                                                        style="background-image: url('../assets/images/dropdown-header/city3.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    <img width="42" class="rounded-circle"
                                                                        src="<?php echo base_url(); ?>assets/sbe/image/user.jpg"
                                                                        alt="">
                                                                </div>
                                                                <?php   if ($this->session->userdata('session_name')!='SBE_LOGIN') { ?>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Belum Login
                                                                    </div>
                                                                    <div class="widget-subheading opacity-8">Anda berada
                                                                        di halaman publik <br> Silahkan lakukan login
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                    <a href="<?php echo base_url() ?>auth"
                                                                        class="btn-shadow btn-shine btn btn-focus">Login
                                                                    </a>
                                                                </div>
                                                                <?php }else{ ?>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">
                                                                        <?php echo $this->session->userdata('full_name'); ?>
                                                                    </div>
                                                                    <div class="widget-subheading opacity-8">
                                                                        <?php echo $this->session->userdata('group_name'); ?>
                                                                    </div>
                                                                    <div class="widget-subheading opacity-8">
                                                                        <?php echo $this->session->userdata('nama_instansi'); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                    <a href="<?php echo base_url() ?>auth/logout"
                                                                        class="btn-shadow btn-shine btn btn-focus">Logout
                                                                    </a>
                                                                </div>
                                                                <?php   } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-area-xs" style="height: 80px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Activity
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="<?php echo base_url() ?>dashboard"
                                                                class="nav-link">Ke Halaman User
                                                                [<?php echo $this->session->userdata('group_name') ?>]
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mb-0 nav-item"></li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <?php   if ($this->session->userdata('session_name')!='SBE_LOGIN') { ?>
                                    <!-- <a href="<?php echo base_url() ?>auth/" class="btn btn-info btn-sm">Login</a> -->
                                    <?php   }else{ ?>

                                    <div class="widget-heading">
                                        <?php echo $this->session->userdata('full_name'); ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?php echo $this->session->userdata('group_name'); ?>
                                    </div>
                                    <?php   } ?>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right header-user-info ml-3">
                                                <button type="button" class="btn-shadow p-1 btn btn-info btn-sm">
                                                    <i class="fa text-white fa-clock pr-1 pl-1"></i>
                                                </button>
                                            </div>
                                            <div class="widget-content-left  ml-3 header-user-info">
                                                <div class="widget-subheading">
                                                    <?php 
                                              $hari = ['','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu'];
                                              ?>
                                                    <?php echo $hari[date('w')].', '.intval(date('d')).' '.bulan_global(date('n')).' '.date('Y') ?>
                                                </div>
                                                <div class="widget-heading">
                                                    <span id="jam"></span> :
                                                    <span id="menit"></span> :
                                                    <span id="detik"></span>
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
        </div>
        <!--Header END-->




        <!--THEME OPTIONS START-->
        <!--THEME OPTIONS END-->









        <style>
        .lb {
            background-color: white;
            background-image: url('assets/sbe/image/bg1_ok.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;

        }
        </style>








        <?php if ($class=='beranda' && $method=='index') {?>
        <div class="row app-main ">
            <div class="p-5 lb " style="width: 100%;  display: inline-block;">
                <div class="text-center"> <br> <br> <br>
                    <p>
                        Selamat datang di
                    </p>
                    <h3>SIMBANGDA BASED EVIDENCE</h3> <br>
                    <!-- <a href="<?php echo base_url() ?>auth" class="btn btn-info btn-sm">Masuk ke Aplikasi</a> -->
                </div>
            </div>
        </div>
        <hr>
        <div class="col-lg-12 col-md-6 ">
            <div class="card">

                <div class="card-header">
                    Realisasi Belanja OPD <?php echo $nama_tahap ?> tahun <?php echo $tahun_anggaran ?>
                </div>
                <div class="card-body">

                    <div class="tabs-animation">
                        <input type="hidden" class="form-control" id="id_instansi_grafik"
                            value="<?php echo id_instansi() ?>">
                        <div class="row">
                            <div class="col-lg-12 col-xl-6">
                                <div class="main-card card">
                                    <div class="card-body">
                                        <div id="pagu" name="pagu"></div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="main-card card">
                                    <div class="card-body">
                                        <div id="terealisasi" name="terealisasi"></div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tabs-animation">
                        <input type="hidden" class="form-control" id="id_instansi_grafik"
                            value="<?php echo id_instansi() ?>">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="main-card mt-3 card">
                                    <div class="card-body">
                                        <div id="grafik_realisasi_skpd"></div>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <th colspan="2">
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
                                            </thead>
                                            <tbody>


                                                <tr id="tfisik">
                                                    <td rowspan="3" align="center">Fisik</td>
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
                                            <button type="button"
                                                class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"
                                                onclick="grafik('Akumulasi')"><i class="fa fa-signal"> </i> Grafik
                                                Akumulasi</button>
                                            <button type="button"
                                                class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"
                                                onclick="grafik('Bulanan')"><i class="fa fa-signal"> </i> Grafik
                                                Bulanan</button>
                                            <button type="button"
                                                class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"
                                                onclick="data_per_opd()"><i class="fa fa-building"> </i> Lihat Per
                                                OPD</button>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
            </div>
        </div>
        <hr>
        <div class="col-lg-12 col-md-6">
            <div class="card">

                <div class="card-header">
                    Realisasi Belanja Kabupaten Kota <?php echo $nama_tahap ?> tahun <?php echo $tahun_anggaran ?>
                </div>
                <div class="card-body">

                    <div class="tabs-animation">
                        <input type="hidden" class="form-control" id="id_instansi_grafik"
                            value="<?php echo id_instansi() ?>">
                        <div class="row">
                            <?php 
        $id_provinsi    = 13;

        $model_realisasi_gabungan          = $this->realisasi_gabungan_per_kab_kota;


  $no=0;
    $hitung_realisasi_bo =0;
  $hitung_realisasi_bm =0;
  $hitung_realisasi_btt =0;
  $hitung_realisasi_bt =0;

  $total_pagu_bo_semua = 0;
  $total_pagu_bm_semua = 0;
  $total_pagu_btt_semua = 0;
  $total_pagu_bt_semua = 0;

  $total_rk_bo_semua = 0;
  $total_rk_bm_semua = 0;
  $total_rk_btt_semua = 0;
  $total_rk_bt_semua = 0;

  $total_rf_bo_semua = 0;
  $total_rf_bm_semua = 0;
  $total_rf_btt_semua = 0;
  $total_rf_bt_semua = 0;
  $total_rf_semua = 0;

  $jumlah_kab_kota = 0;
        $list_kota = $this->db->query("SELECT ckk.id_kota, k.nama_kota, ckk.logo from config_kab_kota ckk 
                    left join kota k on ckk.id_kota = k.id_kota")->result();
                    foreach ($list_kota as $k => $v) { 

  $jumlah_kab_kota ++;
                          $id_kota = $v->id_kota;
    $pagu = $model_realisasi_gabungan->pagu_kota($id_kota, $tahap, $tahun);
    $pagu_bo = $pagu->total_pagu_bo=='' ? 0 : $pagu->total_pagu_bo;
    $pagu_bm = $pagu->total_pagu_bm=='' ? 0 : $pagu->total_pagu_bm;
    $pagu_btt = $pagu->total_pagu_btt=='' ? 0 : $pagu->total_pagu_btt;
    $pagu_bt = $pagu->total_pagu_bt=='' ? 0 : $pagu->total_pagu_bt;




    $total_pagu_bo_semua += $pagu_bo ;
    $total_pagu_bm_semua += $pagu_bm ;
    $total_pagu_btt_semua += $pagu_btt ;
    $total_pagu_bt_semua += $pagu_bt ;
    $pagu_total = $pagu_bo + $pagu_bm + $pagu_btt + $pagu_bt ;






              $realisasi_dipilih = $model_realisasi_gabungan->cek_realisasi_dipilih($tahap, $tahun, $id_kota)->row_array();

              if ($realisasi_dipilih['realisasikan_bo']>0) {
                $hitung_realisasi_bo +=1;
              }
              if ($realisasi_dipilih['realisasikan_bm']>0) {
                $hitung_realisasi_bm +=1;
              }
              if ($realisasi_dipilih['realisasikan_btt']>0) {
                $hitung_realisasi_btt +=1;
              }
              if ($realisasi_dipilih['realisasikan_bt']>0) {
                $hitung_realisasi_bt +=1;
              }


  $realisasi_bo = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bo')->row_array()['realisasi_bo'];
  $realisasi_bm = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bm')->row_array()['realisasi_bm'];
  $realisasi_btt = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_btt')->row_array()['realisasi_btt'];
  $realisasi_bt = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bt')->row_array()['realisasi_bt'];
  // fusuk
  $realisasi_bo_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bo')->row_array()['realisasi_bo_rf'];
  $realisasi_bm_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bm')->row_array()['realisasi_bm_rf'];
  $realisasi_btt_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_btt')->row_array()['realisasi_btt_rf'];
  $realisasi_bt_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bt')->row_array()['realisasi_bt_rf'];
  $realisasi_rf_total = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_rf_total')->row_array()['realisasi_rt_total'];


  $pembagi_bo  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_bo')->row_array()['banyak_realisasikan_bo'];
  $pembagi_bm  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_bm')->row_array()['banyak_realisasikan_bm'];
  $pembagi_btt  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_btt')->row_array()['banyak_realisasikan_btt'];
  $pembagi_bt  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_bt')->row_array()['banyak_realisasikan_bt'];

  $pembagi_rf_total = $model_realisasi_gabungan->total_skpd_kab_kota($id_kota)->num_rows();


  $jumlah_realisasi_bo = $realisasi_bo =='' ? 0 : $realisasi_bo;
  $jumlah_realisasi_bm = $realisasi_bm =='' ? 0 : $realisasi_bm;
  $jumlah_realisasi_btt = $realisasi_btt =='' ? 0 : $realisasi_btt;
  $jumlah_realisasi_bt = $realisasi_bt =='' ? 0 : $realisasi_bt;
  // fisik

@$ratarata_bo_rf = ($realisasi_bo_rf > 0 && $pagu_bo) ? ($realisasi_bo_rf / $pembagi_bo) : 0 ;
@$ratarata_bm_rf = ($realisasi_bm_rf > 0 && $pagu_bm) ? ($realisasi_bm_rf / $pembagi_bm) : 0 ;
@$ratarata_btt_rf = ($realisasi_btt_rf > 0 && $pagu_btt) ? ($realisasi_btt_rf / $pembagi_btt) : 0 ;
@$ratarata_bt_rf = ($realisasi_bt_rf > 0 && $pagu_bt) ? ($realisasi_bt_rf / $pembagi_bt) : 0 ;
@$ratarata_rf_total = ($realisasi_rf_total > 0 && $pagu_total) ? ($realisasi_rf_total  / $pembagi_rf_total) : 0 ;


  $jumlah_realisasi_bo_rf = $realisasi_bo_rf =='' ? 0 : round($ratarata_bo_rf, 2);
  $jumlah_realisasi_bm_rf = $realisasi_bm_rf =='' ? 0 : round($ratarata_bm_rf, 2);
  $jumlah_realisasi_btt_rf = $realisasi_btt_rf =='' ? 0 : round($ratarata_btt_rf, 2);
  $jumlah_realisasi_bt_rf = $realisasi_bt_rf =='' ? 0 : round($ratarata_bt_rf, 2);
  $jumlah_realisasi_rf_total = $realisasi_rf_total =='' ? 0 : round($ratarata_rf_total, 2);





$nilai_rk_kota_bo  =  $realisasi_dipilih['realisasikan_bo']==0 ? 0 : $jumlah_realisasi_bo;
               $nilai_rk_kota_bm  =  $realisasi_dipilih['realisasikan_bm']==0 ? 0 : $jumlah_realisasi_bm;
               $nilai_rk_kota_btt  =  $realisasi_dipilih['realisasikan_btt']==0 ? 0 : $jumlah_realisasi_btt;
               $nilai_rk_kota_bt  =  $realisasi_dipilih['realisasikan_bt']==0 ? 0 : $jumlah_realisasi_bt;

               // $nilai_rk_kota_total = $nilai_rk_kota_bo +$nilai_rk_kota_bm +$nilai_rk_kota_btt +$nilai_rk_kota_bt ;
               $nilai_rf_kota_total =  $jumlah_realisasi_rf_total;
               // $nilai_rf_kota_total = $jumlah_realisasi_bo_rf + $jumlah_realisasi_bm_rf + $jumlah_realisasi_btt_rf + $jumlah_realisasi_bt_rf;
               $pembagi_nilai_rf_total = $realisasi_dipilih['realisasikan_bo'] + $realisasi_dipilih['realisasikan_bm'] + $realisasi_dipilih['realisasikan_btt'] + $realisasi_dipilih['realisasikan_bt'];
               @$show_nilai_rf_kota_total = $nilai_rf_kota_total ;// $pembagi_nilai_rf_total ;
               // @$show_nilai_rf_kota_total = $nilai_rf_kota_total / $pembagi_nilai_rf_total ;


              @$persen_rk_kota_bo = ($nilai_rk_kota_bo / $pagu_bo ) * 100; 
              @$persen_rk_kota_bm = ($nilai_rk_kota_bm / $pagu_bm ) * 100; 
              @$persen_rk_kota_btt = ($nilai_rk_kota_btt / $pagu_btt ) * 100; 
              @$persen_rk_kota_bt = ($nilai_rk_kota_bt / $pagu_bt ) * 100; 

              $show_persen_rk_kota_bo = $persen_rk_kota_bo >0 ? $persen_rk_kota_bo : 0 ;
              $show_persen_rk_kota_bm = $persen_rk_kota_bm >0 ? $persen_rk_kota_bm : 0 ;
              $show_persen_rk_kota_btt = $persen_rk_kota_btt >0 ? $persen_rk_kota_btt : 0 ;
              $show_persen_rk_kota_bt = $persen_rk_kota_bt >0 ? $persen_rk_kota_bt : 0 ;


              // $show_persen_rk_kota_bo = $show_persen_rk_kota_bo == INF ? 0 : $show_persen_rk_kota_bo;
              // $show_persen_rk_kota_bm = $show_persen_rk_kota_bm == INF ? 0 : $show_persen_rk_kota_bm;
              // $show_persen_rk_kota_btt = $show_persen_rk_kota_btt == INF ? 0 : $show_persen_rk_kota_btt;
              // $show_persen_rk_kota_bt = $show_persen_rk_kota_bt == INF ? 0 : $show_persen_rk_kota_bt;
              $show_persen_rk_kota_bo = $show_persen_rk_kota_bo == INF ? 0 : $show_persen_rk_kota_bo;
              $show_persen_rk_kota_bm = $show_persen_rk_kota_bm == INF ? 0 : $show_persen_rk_kota_bm;
              $show_persen_rk_kota_btt = $show_persen_rk_kota_btt == INF ? 0 : $show_persen_rk_kota_btt;
              $show_persen_rk_kota_bt = $show_persen_rk_kota_bt == INF ? 0 : $show_persen_rk_kota_bt;
               @$persen_rk_kota_bo  =  $realisasi_dipilih['realisasikan_bo']==0 ? '-' : $show_persen_rk_kota_bo;
               @$persen_rk_kota_bm  =  $realisasi_dipilih['realisasikan_bm']==0 ? '-' : $show_persen_rk_kota_bm;
               @$persen_rk_kota_btt  =  $realisasi_dipilih['realisasikan_btt']==0 ? '-' : $show_persen_rk_kota_btt;
               @$persen_rk_kota_bt  =  $realisasi_dipilih['realisasikan_bt']==0 ? '-' : $show_persen_rk_kota_bt;
               @$persen_rk_kota_total  =  $nilai_rk_kota_total / $v->pagu_total; 



$total_rk_bo_semua += $jumlah_realisasi_bo;
$total_rk_bm_semua += $jumlah_realisasi_bm;
$total_rk_btt_semua += $jumlah_realisasi_btt;
$total_rk_bt_semua += $jumlah_realisasi_bt;

$total_rf_bo_semua += $jumlah_realisasi_bo_rf;
$total_rf_bm_semua += $jumlah_realisasi_bm_rf;
$total_rf_btt_semua += $jumlah_realisasi_btt_rf;
$total_rf_bt_semua += $jumlah_realisasi_bt_rf;
$total_rf_semua += $jumlah_realisasi_rf_total ;



  $tampil_nilai_rk_kota_bo  =  $realisasi_dipilih['realisasikan_bo']==0 ? '-' : number_format($jumlah_realisasi_bo);
  $tampil_nilai_rk_kota_bm  =  $realisasi_dipilih['realisasikan_bm']==0 ? '-' : number_format($jumlah_realisasi_bm);
  $tampil_nilai_rk_kota_btt  =  $realisasi_dipilih['realisasikan_btt']==0 ? '-' : number_format($jumlah_realisasi_btt);
  $tampil_nilai_rk_kota_bt  =  $realisasi_dipilih['realisasikan_bt']==0 ? '-' : number_format($jumlah_realisasi_bt);
  // fisik
  $tampil_nilai_rk_kota_bo_rf  =  $realisasi_dipilih['realisasikan_bo']==0 ? '-' : $jumlah_realisasi_bo_rf;
  $tampil_nilai_rk_kota_bm_rf  =  $realisasi_dipilih['realisasikan_bm']==0 ? '-' : $jumlah_realisasi_bm_rf;
  $tampil_nilai_rk_kota_btt_rf  =  $realisasi_dipilih['realisasikan_btt']==0 ? '-' : $jumlah_realisasi_btt_rf;
  $tampil_nilai_rk_kota_bt_rf  =  $realisasi_dipilih['realisasikan_bt']==0 ? '-' : $jumlah_realisasi_bt_rf;

  $banyak_skpd_kab_kota = $this->db->query("SELECT * from master_instansi_kab_kota where id_kota='$id_kota'")->num_rows();
  @$persen_rf_total = $nilai_rf_kota_total /  $banyak_skpd_kab_kota ;
  // $nilai_rf_kota_ratarata = $persen_rf_total > 0 ? $persen_rf_total : 0 ;

  $pembagi_fisik_bo_total = $pagu_bo == 0 ? 0 : 1;
  $pembagi_fisik_bm_total = $pagu_bm == 0 ? 0 : 1;
  $pembagi_fisik_btt_total = $pagu_btt == 0 ? 0 : 1;
  $pembagi_fisik_bt_total = $pagu_bt == 0 ? 0 : 1;

  $pembagi_fisik_total = $pembagi_fisik_bo_total + $pembagi_fisik_bm_total + $pembagi_fisik_btt_total + $pembagi_fisik_bt_total;
  $nilai_rf_total = $jumlah_realisasi_bo_rf + $jumlah_realisasi_bm_rf + $jumlah_realisasi_btt_rf + $jumlah_realisasi_bt_rf;
  @$persen_rf_total = $nilai_rf_total /  $pembagi_fisik_total ;
  $nilai_rf_kota_ratarata =  $realisasi_rf_total > 0 ? $jumlah_realisasi_rf_total : 0 ;


  $nilai_rk_kota_total = $nilai_rk_kota_bo +$nilai_rk_kota_bm +$nilai_rk_kota_btt +$nilai_rk_kota_bt ; 
  @$persen_rk_instansi_total  =  $nilai_rk_instansi_total / $pagu_total; 
  @$persen_rk_total = (($nilai_rk_kota_total / $pagu_total) * 100);
  $show_persen_rk_total = $persen_rk_total >0 ? $persen_rk_total : 0;



  $banyak_skpd_kab_kota = $this->db->query("SELECT * from master_instansi_kab_kota where id_kota='$id_kota'")->num_rows();
  @$persen_rf_total = $nilai_rf_kota_total /  $banyak_skpd_kab_kota ;
  // $nilai_rf_kota_ratarata = $persen_rf_total > 0 ? $persen_rf_total : 0 ;

  $pembagi_fisik_bo_total = $pagu_bo == 0 ? 0 : 1;
  $pembagi_fisik_bm_total = $pagu_bm == 0 ? 0 : 1;
  $pembagi_fisik_btt_total = $pagu_btt == 0 ? 0 : 1;
  $pembagi_fisik_bt_total = $pagu_bt == 0 ? 0 : 1;

  $pembagi_fisik_total = $pembagi_fisik_bo_total + $pembagi_fisik_bm_total + $pembagi_fisik_btt_total + $pembagi_fisik_bt_total;
  $nilai_rf_total = $jumlah_realisasi_bo_rf + $jumlah_realisasi_bm_rf + $jumlah_realisasi_btt_rf + $jumlah_realisasi_bt_rf;
  @$persen_rf_total = $nilai_rf_total /  $pembagi_fisik_total ;
  $nilai_rf_kota_ratarata =  $realisasi_rf_total > 0 ? $jumlah_realisasi_rf_total : 0 ;


  $nilai_rk_kota_total = $nilai_rk_kota_bo +$nilai_rk_kota_bm +$nilai_rk_kota_btt +$nilai_rk_kota_bt ; 
  @$persen_rk_instansi_total  =  $nilai_rk_instansi_total / $pagu_total; 
  @$persen_rk_total = (($nilai_rk_kota_total / $pagu_total) * 100);
  $show_persen_rk_total = $persen_rk_total >0 ? $persen_rk_total : 0;

    ?>

                            <div class="col-lg-3 col-xl-3">
                                <div class="main-card mb-3 card ">
                                    <div class="card-body border border-secondary">
                                        <div class="row">
                                            <div class="col-md-4"><img
                                                    src="<?php echo base_url('assets/logo_kab_kota/'.$v->logo) ?>"
                                                    width="100%" height="130px"></div>
                                            <div class="col-md-8">
                                                <h5 class="card-title"><?php echo $v->nama_kota ?></h5>
                                                <table class="table">
                                                    <tr>
                                                        <td>Pagu</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($pagu_total) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Keuangan</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($nilai_rk_kota_total) ?>
                                                            <br>[<?php echo round($show_persen_rk_total,2) ?>%]
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Fisik</td>
                                                        <td>:</td>
                                                        <td><?php echo round($nilai_rf_kota_ratarata,2) ?>%</td>
                                                    </tr>
                                                </table>
                                                <a href="javascript:void(0)" class="btn btn-info btn-sm"
                                                    onclick="data_kab_kota_detail('<?php echo $v->id_kota ?>', '<?php echo htmlspecialchars($v->nama_kota, ENT_QUOTES) ?>', '<?php echo $v->logo ?>')">
                                                    Read More
                                                </a>



                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            <?php } 

        $show_total_rk_bo_semua =  $total_pagu_bo_semua > 0 ? $total_rk_bo_semua : 0;
    $show_total_rk_bm_semua =  $total_pagu_bm_semua > 0 ? $total_rk_bm_semua : 0;
    $show_total_rk_btt_semua =  $total_pagu_btt_semua > 0 ? $total_rk_btt_semua : 0;
    $show_total_rk_bt_semua =  $total_pagu_bt_semua > 0 ? $total_rk_bt_semua : 0;


    $total_pagu_semuanya = $total_pagu_bo_semua + $total_pagu_bm_semua + $total_pagu_btt_semua + $total_pagu_bt_semua;
    $total_rk_semuanya = $total_rk_bo_semua + $total_rk_bm_semua + $total_rk_btt_semua + $total_rk_bt_semua;


    @$persen_total_rk_bo_semua = ($total_rk_bo_semua / $total_pagu_bo_semua) * 100 ;
    @$persen_total_rk_bm_semua = ($total_rk_bm_semua / $total_pagu_bm_semua) * 100 ;
    @$persen_total_rk_btt_semua = ($total_rk_btt_semua / $total_pagu_btt_semua) * 100 ;
    @$persen_total_rk_bt_semua = ($total_rk_bt_semua / $total_pagu_bt_semua) * 100 ;
    @$persen_total_rk_semuanya = ($total_rk_semuanya / $total_pagu_semuanya) * 100 ;

    $show_persen_rk_bo_semua =  $total_pagu_bo_semua > 0 ? $persen_total_rk_bo_semua : 0;
    $show_persen_rk_bm_semua =  $total_pagu_bm_semua > 0 ? $persen_total_rk_bm_semua : 0;
    $show_persen_rk_btt_semua =  $total_pagu_btt_semua > 0 ? $persen_total_rk_btt_semua : 0;
    $show_persen_rk_bt_semua =  $total_pagu_bt_semua > 0 ? $persen_total_rk_bt_semua : 0;
    $show_persen_rk_semuanya =  $total_pagu_semuanya > 0 ? $persen_total_rk_semuanya : 0;


@$show_total_bo_rf_semua = $total_rf_bo_semua / $hitung_realisasi_bo ; 
@$show_total_bm_rf_semua = $total_rf_bm_semua / $hitung_realisasi_bm ; 
@$show_total_btt_rf_semua = $total_rf_btt_semua / $hitung_realisasi_btt ; 
@$show_total_bt_rf_semua = $total_rf_bt_semua / $hitung_realisasi_bt ; 

$total_rf_semuannya = $show_total_bo_rf_semua + $show_total_bm_rf_semua + $show_total_btt_rf_semua + $show_total_bt_rf_semua;
$show_total_rf_semuanya = $total_rf_semua / $jumlah_kab_kota;



?>

                            <div class="col-lg-3 col-xl-3">
                                <div class="main-card mb-3 card ">
                                    <div class="card-body border border-secondary">
                                        <div class="row">
                                            <div class="col-md-4"><img
                                                    src="<?php echo base_url('assets/sbe/image/logo.png') ?>"
                                                    width="100%" height="130px"></div>
                                            <div class="col-md-8">
                                                <h5 class="card-title">Total</h5>
                                                <table class="table">
                                                    <tr>
                                                        <td>Pagu</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($total_pagu_semuanya); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Keuangan</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($total_rk_semuanya) ?>
                                                            <br>[<?php echo round($show_persen_rk_semuanya,2); ?>%]
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Fisik</td>
                                                        <td>:</td>
                                                        <td><?php echo round($show_total_rf_semuanya,2) ?>%</td>
                                                    </tr>
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





        <?php  
echo $modal; }
else if ($class=='auth' && $method=='index') {?>

        <?php echo $contents; ?>

        <?php   }else{ ?>


        <div class="app-main">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">

                            <div><?php echo $title ?>
                                <div class="page-title-subheading"><?php echo $description ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $contents; ?>
            </div>
        </div>
        <?php  } ?>








        <div class="row mt-3">

            <div class="col-md-12" style="bottom:0">


                <div class="card">

                    <div class="card-body">


                        <div class="row  justify-content-center">
                            <div class="col-lg-3 col-md-6 mb-5">
                                <a href="index.html" class="navbar-brand">

                                    <img class="img-fluid"
                                        src="https://biroadmpembangunan.sumbarprov.go.id/assets/gambar/logo_biro.png"
                                        alt="">
                                </a> <br><br>
                                <audio
                                    src="https://biroadmpembangunan.sumbarprov.go.id/assets/music/marssumbar.mp3"></audio>

                                <p>Jl. Jend. Sudirman No.51, Padang Pasir, Kec. Padang Barat, Kota Padang, Sumatera
                                    Barat 25129</p>
                                <div class="d-flex justify-content-start mt-4">
                                    <a class="btn btn-outline-secondary text-center mr-2 px-0"
                                        style="width: 38px; height: 38px;"
                                        href="https://biroadmpembangunan.sumbarprov.go.id/" target="_blank"><i
                                            class="fa fa-globe"></i></a>
                                    <a class="btn btn-outline-secondary text-center mr-2 px-0"
                                        style="width: 38px; height: 38px;"
                                        href="https://www.facebook.com/biroadmpembangunan.sumbarprov" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-secondary text-center mr-2 px-0"
                                        style="width: 38px; height: 38px;"
                                        href="mailto:biroadmpembangunan.sumbarprov@gmail.com" target="_blank"><i
                                            class="fa fa-envelope"></i></a>
                                    <a class="btn btn-outline-secondary text-center mr-2 px-0"
                                        style="width: 38px; height: 38px;"
                                        href="https://www.instagram.com/biroadpemb_prov.sumbar/" target="_blank"><i
                                            class="fab fa-instagram"></i></a>
                                    <a class="btn btn-outline-secondary text-center mr-2 px-0"
                                        style="width: 38px; height: 38px;" href="#" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-5">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2840949598635!2d100.35777017560198!3d-0.9376228353457584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b950c9c87f35%3A0x203f97613e262574!2sBiro%20Administrasi%20Pembangunan!5e0!3m2!1sid!2sid!4v1713859623223!5m2!1sid!2sid"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-5">
                                <h4 class="font-weight-bold mb-4">Statistika User</h4>
                                <div class="d-flex flex-wrap m-n1">
                                    <div class="grid-menu grid-menu-2col">


                                        <?php   
$ip    = $this->input->ip_address(); // Mendapatkan IP user
$date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
$waktu = time(); //
$timeinsert = date("Y-m-d H:i:s");
  // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
$s = $this->db->query("SELECT ip FROM visitor WHERE ip='".$ip."' AND date='".$date."'")->num_rows();
$ss = isset($s)?($s):0;
// Kalau belum ada, simpan data user tersebut ke database
if($ss == 0){
    $this->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('".$ip."','".$date."','1','".$waktu."','".$timeinsert."')");
}
// Jika sudah ada, update
else{
    $this->db->query("UPDATE visitor SET hits=hits+1, last_hits='".$timeinsert."' , online='".$waktu."' WHERE ip='".$ip."' AND date='".$date."'");
}
$pengunjunghariini  = $this->db->query("SELECT ip FROM visitor WHERE date='".$date."' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung
$dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row(); 
$totalpengunjung = isset($dbpengunjung->hits)?($dbpengunjung->hits):0; // hitung total pengunjung
$bataswaktu = time() - 300;
$q_pengunjungonline  = $this->db->query("SELECT ip,keterangan FROM visitor WHERE online > '".$bataswaktu."'"); // hitung pengunjung online
$pengunjungonline  = $q_pengunjungonline->num_rows(); 
$pengunjunglogin = 0;
foreach ($q_pengunjungonline->row_array() as $k => $v) {
    if (@$v['keterangan']=='Login') {
        # code...
        $pengunjunglogin++;
    }
    # code...
}
?>



                                        <div class="no-gutters row">
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark"><i
                                                        class="text-dark opacity-7 btn-icon-wrapper mb-2">
                                                        <?php echo  $pengunjungonline ?></i>User Online
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger"><i
                                                        class="text-danger opacity-7 btn-icon-wrapper mb-2">
                                                        <?php echo  $pengunjunglogin ?> </i>User Login
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success"><i
                                                        class="text-success opacity-7 btn-icon-wrapper mb-2">
                                                        <?php echo  $pengunjunghariini ?> </i>Today
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-focus"><i
                                                        class="text-focus opacity-7 btn-icon-wrapper mb-2">
                                                        <?php echo  $totalpengunjung ?> </i>All User
                                                </button>
                                            </div>
                                        </div>



                                    </div>
                                </div>

                            </div>



                            <div class="col-lg-3 col-md-6 mb-5">
                                <h4 class="font-weight-bold mb-4">Integrasi Dengan</h4>
                                <div class="d-flex flex-wrap m-n1">
                                    <div class="grid-menu grid-menu-2col">





                                        <ul class="list-group list-group-flush">

                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Dashboard Pembangunan</div>
                                                            <div class="widget-subheading"><a
                                                                    href="https://dashboard.sumbarprov.go.id/"
                                                                    target="_blank">https://dashboard.sumbarprov.go.id/</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Sipedal</div>
                                                            <div class="widget-subheading"><a
                                                                    href="https://sipedal.sumbarprov.go.id/"
                                                                    target="_blank">https://sipedal.sumbarprov.go.id/</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>

                                        </ul>


                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-12 col-md-6 justify-content-center text-center  ">

                                Copyright &copy 2024
                                <div class="dots-separator"></div>
                                <b style="margin-right:5px">Biro Administrasi Pembangunan</b> Sekretariat Daerah
                                Provinsi Sumatera Barat
                                <!-- <div class="dots-separator"></div> -->


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>





















































        <!--SCRIPTS INCLUDES-->

        <!--CORE-->

        <script src="<?php echo base_url(); ?>assets/admin_lte/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/metismenu"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/app.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/demo.js"></script>

        <!--CHARTS-->

        <!--Apex Charts-->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/charts/apex-charts.js">
        </script>

        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/charts/apex-charts.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/charts/apex-series.js">
        </script>

        <!--Sparklines-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/charts/charts-sparklines.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/charts/charts-sparklines.js">
        </script>

        <!--Chart.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/charts/chartsjs-utils.js">
        </script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/charts/chartjs.js">
        </script>

        <!--FORMS-->

        <!--Clipboard-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/clipboard.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/clipboard.js">
        </script>

        <!--Datepickers-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/datepicker.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/daterangepicker.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/moment.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/datepicker.js">
        </script>

        <!--Multiselect-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/bootstrap-multiselect.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/input-select.js">
        </script>

        <!--Form Validation-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/form-validation.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/form-validation.js">
        </script>

        <!--Form Wizard-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/form-wizard.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/form-wizard.js">
        </script>

        <!--Input Mask-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/input-mask.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/input-mask.js">
        </script>

        <!--RangeSlider-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/wnumb.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/range-slider.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/range-slider.js">
        </script>

        <!--Textarea Autosize-->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/textarea-autosize.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/form-components/textarea-autosize.js">
        </script>

        <!--Toggle Switch -->
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/form-components/toggle-switch.js">
        </script>


        <!--COMPONENTS-->

        <!--BlockUI -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/blockui.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/blockui.js">
        </script>

        <!--Calendar -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/calendar.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/calendar.js">
        </script>

        <!--Slick Carousel -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/carousel-slider.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/carousel-slider.js">
        </script>

        <!--Circle Progress -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/circle-progress.js">
        </script>
        <script
            src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/circle-progress.js">
        </script>

        <!--CountUp -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/count-up.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/count-up.js">
        </script>

        <!--Cropper -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/cropper.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/image-crop.js">
        </script>

        <!--Maps -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/gmaps.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/jvectormap.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/maps-word-map.js">
        </script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/maps.js"></script>

        <!--Guided Tours -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/guided-tours.js">
        </script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/guided-tours.js">
        </script>

        <!--Ladda Loading Buttons -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/ladda-loading.js">
        </script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/spin.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/ladda-loading.js">
        </script>

        <!--Rating -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/rating.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/rating.js">
        </script>

        <!--Perfect Scrollbar -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/scrollbar.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/scrollbar.js">
        </script>

        <!--Toastr-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous">
        </script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/toastr.js">
        </script>

        <!--SweetAlert2-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/sweet-alerts.js">
        </script>

        <!--Tree View -->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/treeview.js"></script>
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/treeview.js">
        </script>


        <!--Bootstrap Tables-->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/vendors/tables.js"></script>

        <!--Tables Init-->
        <script src="<?php echo base_url() ?>/assets/architectui-html-pro/assets_new/js/scripts-init/tables.js">
        </script>




        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>



        <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();
        }

        function baseUrl(link = '') {
            let alamat = "<?php echo base_url(); ?>" + link;
            return alamat;
        }
        </script>

        <?php echo $extra_js; ?>
</body>

</html>