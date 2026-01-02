
        <div class="row">
            <?php foreach ($ba as $k => $v) { ?>
            <div class="col-md-4">
               <div class="main-card mb-3 card">
                                        <div class="card-header"><?php echo $v['kegiatan'] ?></div>
                                        <div class="card-body">
                                           Jadwal : <?php echo $v['tgl_mulai_pelaksanaan'].' s.d. '.$v['tgl_akhir_pelaksanaan'] ?> <br>
                                           Lokasi :  <?php echo $v['lokasi'] ?>
                                        </div>
                                        <div class="d-block text-right card-footer">
                                            <a class="btn btn-success btn-sm" href="<?php echo base_url('berita_acara/detail_setting/'.sbe_crypt($v['id_setting_berita_acara'])) ?>">Detail</a>
                                        </div>
                                    </div>  
            </div>
            <?php } ?>
        </div>
