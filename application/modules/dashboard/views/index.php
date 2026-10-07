<?php 
    $penginputan = ['Di Kunci','Sesuai Jadwal','Bebas'];
    $id_group = $this->session->userdata('id_group');
    $id_kedudukan = $this->session->userdata('id_kedudukan');
    $nama_kedudukan = $this->session->userdata('kedudukan');
   
    if ($id_group==5) {
        if ($id_kedudukan=='') {
            $group_name = $this->session->userdata('group_name'). ' - UTAMA';
        }else{
            $group_name = $this->session->userdata('group_name') .' - '.$nama_kedudukan;
        }
    }else{
        $group_name = $this->session->userdata('group_name');
    }
 ?>

<style type="text/css">
    th, td{
        text-align: center;
    }
</style>



        <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-alternate">
                                           
                                            <div class="menu-header-content btn-pane-right">
                                                <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                                    <div class="avatar-icon rounded"><img src="<?php echo base_url() ?>assets/sbe/image/user.jpg" alt="Image"></div>
                                                </div>
                                                <div>
                                                    <p>Selamat datang di aplikasi Simbangda Based Evidence V.4! <?php echo $index_bulan ?> </p>
                                                    <h6 class="menu-header-subtitle"><?php echo $this->session->userdata('full_name'); ?> | <?php  echo $group_name; ?></h6>
                                                    <h5 class="menu-header-title"><b><?php echo $this->session->userdata('nama_instansi'); ?></b></h5>

                                                </div>
                                                <div class="menu-header-btn-pane">
                                                    
                                                    <a href="https://www.youtube.com/watch?v=oCn5w8mXkso&list=PLvwi65vqBASYmZitwkq8ffCIYcWaZtmHt" target="_blank" class="btn-wide btn-hover-shine  btn btn-info">Lihat Tutorial Penggunaan Aplikasi</a>  

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              
                                </div>






<div class="tabs-animation">
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                                                        <div class="card mb-3 widget-content bg-night-fade">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Tahapan APBD</b></div>
                                                                    <div class="widget-heading">
                                                                        <?php echo nama_tahapan(); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-cash"></i></div>
                                                                </div>

                                                               



                                                            </div>
                                                        </div>
                        </div>
                        <div class="col-md-12">
                            

                                                        <div class="card mb-3 widget-content bg-arielle-smile">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Tahun Anggaran</b></div>
                                                                    <div class="widget-heading"><?php echo tahun_anggaran(); ?></div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-cash"></i></div>
                                                                </div>
                                                           
                                                            </div>
                                                        </div>

                        </div>
                        <div class="col-md-12">
                            

                                                        <div class="card mb-3 widget-content bg-happy-green">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Penginputan</b></div>
                                                                    <div class="widget-heading">
                                                                        <?php echo @$penginputan[$config['penginputan']] ?>
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-file"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>


                        </div>
                        <div class="col-md-12">
                            

                                                        <div class="card mb-3 widget-content bg-arielle-smile">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Bulan Pelaporan</b></div>
                                                                    <div class="widget-heading">
                                                                        <?php echo konversi_bulan(bulan_aktif()) . ' ' . tahun_anggaran(); ?>
                                                                    </div>
                                                                </div>
                                                                 <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-file"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>


                        </div>
                    </div>
                   
                    
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <?php if ($num_grafik>0) { 
                        $this->load->view('dashboard/grafik_pagu'); ?>

                    <?php }else{ ?>
                        <div class="alert alert-info">Grafik tidak daat di tampilkan <br>Silahkan lakukan synchronize untuk menampilkan grafik <br>Pastikan data APBD sudah terisi  <br>    
            </div>
                           <?php if ($this->session->userdata('group_name') == 'OPERATOR') : ?>
                         <?php if (kunci_synch()['synchronize']==1) { ?>
                                                <button class="btn-icon btn-shadow btn-outline-2x btn btn-block btn-outline-info"  onclick="sync(<?php echo $this->session->userdata('id_instansi'); ?>)" id="tombol_sync"><i class="fa fa-indent"> </i> Synchronize / Refresh Grafik</button>
                                            <?php }else{ ?>
                                                <button class="btn-icon btn-shadow btn-outline-2x btn btn-block btn-outline-danger" onclick="Swal.fire('Terkunci','<?php echo kunci_synch()['pesan'] ?>','error')"  style="width:150px"> Synchronize / Refresh Grafik</button>   

                                            <?php } ?>
                <?php endif; ?>


                    <?php } ?>
                    
                </div>
            </div>
        </div>
     
       
        
    </div>
</div>

<?php if ($num_grafik>0) { 
    $this->load->view('dashboard/grafik_apbd');
   
   ?>




<?php   } ?>
