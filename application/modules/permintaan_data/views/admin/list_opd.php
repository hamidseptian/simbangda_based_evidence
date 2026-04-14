  <div class="row">
                                                        <?php foreach ($data_file_permintaan as $k => $v_asisten) { ?>
                                                        <div class="col-md-4">
                                                            <div class="main-card mb-3 card">

                                        <div class="card-header">
                                            Asisten <?php echo $k ?>
                                        </div>



                                                                <ul class="list-group list-group-flush">
                                                                    <?php foreach ($v_asisten as $k_instansi => $v_instansi) { ?>
                                                                    <li class="list-group-item">
                                                                        <div class="widget-content p-0">
                                                                            <div class="widget-content-wrapper">
                                                                                <div class="widget-content-left">
                                                                                    <div class="widget-heading"><?php echo $v_instansi['nama_instansi'] ?></div>
                                                                                    <div class="widget-subheading">
                                                                                        <span class="<?php echo $v_instansi['badge'] ?>"><?php echo $v_instansi['keterangan'] ?>   </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="widget-content-right">
                                                                                    <div role="group" class="btn-group-sm btn-group">
                                                                                        <?php  if($v_instansi['status']=='Sudah Upload'){ ?>
                                                                                        <a href="<?php echo base_url('permintaan_data/download_file/?id_permintaan_data='.$v_instansi['id_permintaan_data'].'&file='.$v_instansi['file'].'&format='.$v_instansi['file_disimpan']) ?>" class="btn-shadow btn btn-outline-info"><i class="fa fa-download"></i></a>
                                                                                    <?php   } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php   } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                                <a href="<?php echo base_url('permintaan_data/print/'.sbe_crypt($id_permintaan_data)) ?>" class="btn btn-block btn-info btn-sm" target="_blank">Print</a>
                                                    </div>