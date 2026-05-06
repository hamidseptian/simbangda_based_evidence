<div class="mb-3 card">
                                        <div class="card-header">
                                            Detail <?php echo $permintaan_data['judul'] ?> 
                                        </div>
                                        <div class="card-body">
                                           <div class="row">
                                               <div class="col-md-4">
                                                <h5>Detail Permintaan</h5>
                                                           <table class="table">
                                                               <tr>
                                                                   <td>Permintaan Data</td>
                                                                   <td>:</td>
                                                                   <td><?php echo $permintaan_data['judul'] ?></td>
                                                               </tr>
                                                               <tr>
                                                                   <td>Keterangan</td>
                                                                   <td>:</td>
                                                                   <td><?php echo $permintaan_data['keterangan'] ?></td>
                                                               </tr>
                                                               <tr>
                                                                   <td>Nama File Download</td>
                                                                   <td>:</td>
                                                                   <td><?php echo $permintaan_data['format_file'] ?></td>
                                                               </tr>
                                                               <tr>
                                                                   <td>Judul File</td>
                                                                   <td>:</td>
                                                                   <td><?php echo $permintaan_data['judul_file'] ?></td>
                                                               </tr>
                                                               <tr>
                                                                   <td>Deadline</td>
                                                                   <td>:</td>
                                                                   <td><?php echo $permintaan_data['deadline'] ?></td>
                                                               </tr>
                                                               <tr>
                                                                   <td>Status</td>
                                                                   <td>:</td>
                                                                   <td><?php echo $permintaan_data['status'] ?></td>
                                                               </tr>
                                                              
                                                           </table>

                                               </div>
                                               <div class="col-md-4">
                                                <h5>Lampiran</h5>
                                                <?php if (count($lampiran)==0) { ?>
                                                    <div class="alert alert-info">Tidak ada lampiran </div>
                                                <?php }else{ ?>
                                                   <table class="table">
                                                       <tr>
                                                           <td>NO</td>
                                                           <td>Nama Lampiran</td>
                                                           <td>Option</td>
                                                       </tr>
                                                      <?php foreach ($lampiran as $k => $v) { ?>
                                                        <tr>
                                                            <td><?php echo $k+1 ?></td>
                                                            <td><?php echo $v['nama_lampiran'] ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                  <a href="<?php echo base_url('permintaan_data/download_lampiran/?id_permintaan_data='.$v['id_permintaan_data'].'&file='.$v['file'].'&format='.$v['nama_lampiran']) ?>" class=" btn btn-outline-info"><i class="fa fa-download"></i></a>
                                                                  
                                                                </div>
                                                            </td>
                                                        </tr>
                                                      <?php } ?>
                                                    
                                                   </table>
                                               <?php } ?>
                                                   
                                               </div>
                                               <div class="col-md-4">

                                                <h5>Upload Data Permintaan</h5>
                                                   <table class="table">
                                                       <tr>
                                                           <td>OPD </td>
                                                           <td>:</td>
                                                           <td><?php echo $permintaan_data['nama_instansi'] ?></td>
                                                       </tr>
                                                       <?php if ($permintaan_data['file']=='') {  ?>
                                                       <tr>
                                                           <td>Status </td>
                                                           <td>:</td>
                                                           <td>
                                                            Belum Memberikan Data <br>    
                                                            <a href="javascript:void(0)" onclick="upload_file()" class="btn btn-info btn-sm">Upload File</a>
                                                        </td>
                                                       </tr>
                                                    
                                                   <?php  }else{ ?>
                                                       <tr>
                                                           <td>Status </td>
                                                           <td>:</td>
                                                           <td>Sudah Memberikan Data</td>
                                                       </tr>
                                                       <tr>
                                                           <td>Type File </td>
                                                           <td>:</td>
                                                           <td><?php  

                                                                $file = $permintaan_data['file'];
                                                                $pecah = explode('.', $file);
                                                                $extensi = end($pecah);
                                                                echo strtoupper($extensi);

                                                           ?></td>
                                                       </tr>
                                                       <tr>
                                                           <td>Tgl Upload</td>
                                                           <td>:</td>
                                                           <td><?php echo $permintaan_data['updated_at'] == '' ? 'Diupload Pada '.$permintaan_data['created_at'] :  'Diupload Upang Pada '.$permintaan_data['updated_at'] ?>
                                                           <br> 
                                                           <?php 
                                                               $format = $permintaan_data['singkatan_nama_instansi'].' - '.$permintaan_data['judul_file']

                                                            ?>
                                                            <div class="btn-group">
                                                              
                                                                <a href="javascript:void(0)" onclick="upload_file_ulang()" class="btn btn-outline-info btn-sm">Upload Ulang</a>
                                                                <a href="<?php echo base_url('permintaan_data/download_file/?id_permintaan_data='.$permintaan_data['id_permintaan_data'].'&file='.$permintaan_data['file'].'&format='.$format) ?>" class="btn-sm btn btn-outline-info">Download </a>
                                                            </div>


                                                           </td>
                                                       </tr>

                                                   <?php } ?>
                                                    
                                                   </table>
                                                   
                                               </div>
                                           </div>
                                        </div>
                                    </div>