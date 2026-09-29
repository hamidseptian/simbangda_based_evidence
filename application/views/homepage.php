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

    <link href="<?php echo base_url() ?>assets/datatables/dataTables.min.css" rel="stylesheet">
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
                                        <a href="<?php echo base_url('dashboard') ?>"><?php echo $this->session->userdata('full_name'); ?></a>
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
            background-image: url('assets/sbe/image/bg1_ok.png');
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
        <!-- <?php //$this->load->view('beranda/grafik') ?> -->
        <?php $this->load->view('beranda/infografis') ?>
        <?php $this->load->view('beranda/kab_kota') ?>
      
        



        <?php  
echo $modal; }
else if ($class=='auth' && $method=='index') { ?>

        <?php 
        echo $contents; 
        echo $modal; 
        ?>

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



                                <a href="https://biroadmpemb.sumbarprov.go.id/" class="navbar-brand">
                                    <img class="img-fluid"
                                        src="<?php echo base_url('assets/sbe/') ?>logo_biro.png"
                                        alt="" width="100%">
                                </a> <br><br>
                               <img class="img-fluid" src="<?php echo base_url('assets/sbe/bagde_pse.png') ?>" width="100%">
                              
                              
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
                            <div class="col-lg-3 col-md-6 mb-5">
                                <h4 class="font-weight-bold mb-4">Link Terkait</h4>
                                <div class="d-flex flex-wrap m-n1">
                                    <div class="grid-menu grid-menu-2col">





                                        <ul class="list-group list-group-flush">

                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">SP4N Lapor</div>
                                                            <div class="widget-subheading"><a
                                                                    href="https://lapor.go.id/"
                                                                    target="_blank">https://lapor.go.id/</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">SIRANDAI SUMBAR</div>
                                                            <div class="widget-subheading"><a
                                                                    href="https://sirandai-dev.sumbarprov.go.id/"
                                                                    target="_blank">https://sirandai-dev.sumbarprov.go.id//</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                          

                                        </ul>


                                    </div>
                                </div>

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

    <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery/jquery.4.0.0.js"></script>

    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/architectui-html-pro/assets/scripts/main.87c0748b313a1dda75f5.js"></script>


        <script>
            // console.log($);
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

        <?php echo $extra_js; $this->load->view('auth/survei/index') ?>
</body>

</html>