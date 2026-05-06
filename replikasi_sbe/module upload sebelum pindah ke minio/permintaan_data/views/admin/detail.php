<?php echo $this->session->flashdata('pesan') ?>
<div class="mb-3 card">
                                        <div class="card-header">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item"><a data-toggle="tab" href="#detail" class="nav-link ">Detail</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#form_perintaan" class="nav-link ">Form Permintaan</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#rekap" class="nav-link show active">Rekap</a></li>
                                                <li class="nav-item"><a onclick="edit_permintaan()" class="nav-link ">Edit</a></li>
                                                <li class="nav-item"><a  class="nav-link show" href="<?php echo base_url('permintaan_data/hapus/'.sbe_crypt($permintaan_data['id_permintaan_data'])) ?>" onclick="return confirm('Hapus permintaan data <?php echo $permintaan_data['judul'] ?>?')">Hapus</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane show" id="detail" role="tabpanel">


                                                    <div class="row">
                                                       <div class="col-md-6">
                                                        <h4>Detail Permintaan</h4>
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
                                                       <div class="col-md-6">
                                                       


                                                                        <div class="widget-content p-0">
                                                                            <div class="widget-content-wrapper">
                                                                                <div class="widget-content-left">
                                                                                    <div class="widget-heading"> <h4>Lampiran</h4></div>
                                                                                </div>
                                                                                <div class="widget-content-right">
                                                                                    <div role="group" class="btn-group-sm btn-group">
                                                                                        <a href="javascript:void(0)" onclick="tambah_lampiran()" class="btn btn-info btn-sm">Tambah Lampiran</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>



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
                                                                            <a href="<?php echo base_url('permintaan_data/download_lampiran/?id_permintaan_data='.$v['id_permintaan_data'].'&file='.$v['file'].'&format='.$v['nama_lampiran']) ?>" class=" btn btn-outline-info"  data-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                                                                            <button class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit" onclick="edit_lampiran('<?php echo $v['id_permintaan_data_lampiran'] ?>','<?php echo $v['id_permintaan_data'] ?>','<?php echo $v['nama_lampiran'] ?>','<?php echo $v['file'] ?>')"><i class="fa fa-edit"></i></button>
                                                                            <a href="<?php echo base_url('permintaan_data/hapus_lampiran/?id_permintaan_data='.$v['id_permintaan_data'].'&file='.$v['file'].'&id_lampiran='.$v['id_permintaan_data_lampiran'].'&nama_lampiran='.$v['nama_lampiran']) ?>" class=" btn btn-outline-info"  data-toggle="tooltip" title="Hapus" onclick="return confirm ('Hapus lampiran <?php echo $v['nama_lampiran'] ?>')"><i class="fa fa-trash"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                              <?php } ?>
                                                            
                                                           </table>
                                                       <?php } ?>
                                                           
                                                       </div>
                                                   </div>

                                         </div>
                                                <div class="tab-pane show" id="form_perintaan" role="tabpanel">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                        
                                                      <div class="widget-content p-0">
                                                          <div class="widget-content-wrapper">
                                                              <div class="widget-content-left">
                                                                  <div class="widget-heading"> 
                                                                    <h4>Form Permintaan</h4>
                                                                  </div>

                                                              </div>
                                                              <div class="widget-content-right">
                                                                  <div role="group" class="btn-group-sm btn-group">
                                                                      <a href="javascript:void(0)" onclick="tambah_lampiran()" class="btn btn-info btn-sm">Tambah Lampiran</a>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <?php foreach ($form as $key => $v) {
                                                      $id = $v['id_permintaan_data_tabel_permintaan'];


                                                       ?>
                                                       <div class="col-md-4">
                                                        <div class="card">
                                                          <div class="card-header">
                                                            <?php echo $v['tabel_data_yang_diminta'] ?>
                                                          </div>
                                                        </div>
                                                       </div>
                                                      <?php } ?>
                                                   </div>
                                         </div>
                                                <div class="tab-pane show active" id="rekap" role="tabpanel">
                                                  <?php 
                                                  if ($permintaan_data['id_group']==5) {
                                                    $this->load->view('permintaan_data/admin/list_opd');
                                                  }else{
                                                    $this->load->view('permintaan_data/admin/list_kota');
                                                  }
                                                   ?>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>



<script type="text/javascript">
  function tambah_lampiran(){
    $('#modal_tambah_lampiran').modal('show');
  }
  function edit_lampiran(id_permintaan_data_lampiran, id_permintaan_data,nama_lampiran, file){
    $('#modal_edit_lampiran').modal('show');
    $('#modal_edit_lampiran').find('#filelama').val(file);
    $('#modal_edit_lampiran').find('#id_lampiran').val(id_permintaan_data_lampiran);
    $('#modal_edit_lampiran').find('#id_permintaan_data').val(id_permintaan_data);
    $('#modal_edit_lampiran').find('#nama').val(nama_lampiran);
  }
</script>