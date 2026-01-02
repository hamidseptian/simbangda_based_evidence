

        <div class="row">
            <div class="col-md-12">
                <?php echo $this->session->flashdata('pesan'); ?>
           
               <div class="main-card mb-3 card">
                                        <div class="card-header"><?php echo $ba['kegiatan'] ?></div>
                                        <div class="card-body">
                                          <div class="row">
                                            <div class="col-md-4">
                                               <table class="table table-striped">
                                                <tr>
                                                    <td>Nama Kegiatan</td>
                                                    <td><?php echo  $ba['kegiatan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Keterangan</td>
                                                    <td><?php echo  $ba['keterangan'] ?></td>
                                                </tr>
                                            
                                            </table>
                                            </div>
                                            <div class="col-md-4">
                                               <table class="table table-striped">
                                                <tr>
                                                    <td>Jadwal Pelaksanaan</td>
                                                    <td><?php echo  $ba['tgl_mulai_pelaksanaan'] .' sampai '. $ba['tgl_akhir_pelaksanaan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Lokasi Pelaksanaan</td>
                                                    <td><?php echo  $ba['lokasi'] ?></td>
                                                </tr>
                                               
                                               
                                            </table></div>
                                            <div class="col-md-4">
                                               <table class="table table-striped">
                                             
                                                <tr>
                                                    <td>Data yang diambil</td>
                                                    <td><?php echo  pilihan_nama_tahapan($ba['kode_tahap']).' '.$ba['tahun'] ?></td>
                                                </tr>
                                               
                                            </table></div>
                                          </div>
                                         
                                        </div>
                                        <div class="d-block text-right card-footer">
                                          <?php  if ($id_group==2) { ?>
                                            <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="edit_berita_acara('<?php echo $ba['id_setting_berita_acara'] ?>')">Edit</a>
                                            <a class="btn btn-success btn-sm" href="<?php echo base_url('berita_acara/preview_berita_acara/?id_periode='.sbe_crypt($ba['id_setting_berita_acara'])) ?>">Prevew Berita Acara</a>
                                          <?php } ?>
                                        </div>
                                    </div>  
            </div>
            <div class="col-md-12">
               <div class="main-card mb-3 card">
                                        <div class="card-header">Setting Jadwal
                                          <div class="btn-actions-pane-right actions-icon-btn">
                                            <?php 
                                            if ($id_group==2) { ?>
                                              <a class="btn btn-success btn-sm" href="<?php echo base_url('berita_acara/rekap_berita_acara/?id_periode='.sbe_crypt($ba['id_setting_berita_acara'])) ?>" target="_blank">Rekap Berita Acara</a>
                                              <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="setting_jadwal_asisten('<?php echo $ba['id_setting_berita_acara'] ?>')">Atur jadwal per Asisten</a>
                                            <?php } ?>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                        
                                            <div class="table-responsive">
                                                <table id="table-instansi" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%">No</th>
                                                            <th style="text-align: center;">SKPD</th>
                                                            <th style="text-align: center;">Pimpinan</th>
                                                            <th style="text-align: center;">Helpdesk</th>
                                                            <th style="text-align: center;">Jadwal</th>
                                                            <th style="text-align: center;">Catatan</th>
                                                            <th style="text-align: center;">Solusi</th>
                                                            <th style="text-align: center;">Synchronize</th>
                                                            <th style="text-align: center;">Status</th>
                                                            <th style="text-align: center;"  width="10%">Option</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                        </div>
                                    
                                    </div>  
            </div>
        </div>