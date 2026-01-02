<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/

?>
<!-- Modal Master User-->
<form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('permintaan_data/simpan_permintaan_data/') ?>">
<div class="modal fade" id="modal-tambah-permintaan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Permintaan Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-group">
                        <label for="masalah">Permintaan Data Ke</label>
                        <select class="form-control" id="id_group" name="id_group">
                            <option value="5">Operator OPD Pemprov Sumbar</option>
                            <option value="7">Operator Kabupaten Kota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="masalah">Judul Permintaan</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="8" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="masalah">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>
                    <div class="form-group">
                        <label for="masalah">Judul File Download</label>
                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="pengirim">
                                                Nama OPD - 
                                            </div>
                                        </div>
                                        <input class="form-control" name="formatfile">
        
                                    </div>
                    </div>
            
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="clodemodal_add_bantuan">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Permintaan File</button>
               
            </div>
        </div>
    </div>
</div>
                </form>






<form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('permintaan_data/simpan_upload_lampiran/') ?>">
<div class="modal fade" id="modal_tambah_lampiran" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Lampran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                     <b><?php echo $permintaan_data['judul'] ?></b>
                       
                    </div>
                    <div class="form-group">
                        <label for="masalah">Nama Lampiran</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                     
                    </div>
                    
                    <div class="form-group">
                        <label for="masalah">File</label>
                        <input type="hidden" class="form-control" id="id_permintaan_data" name="id_permintaan_data"  value="<?php echo $id_permintaan_data ?>">
                        <div class="custom-file">
                                        <input type="file" name="upload_file" class="form-control">
                                        
                                    </div>
                    </div>
                    
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="clodemodal_add_bantuan">Close</button>
                <button type="submit" class="btn btn-primary">Upload File</button>
               
            </div>
        </div>
    </div>
</div>
                </form>





<form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('permintaan_data/simpanedit_upload_lampiran/') ?>">
<div class="modal fade" id="modal_edit_lampiran" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Lampran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                     <b><?php echo $permintaan_data['judul'] ?></b>
                       
                    </div>
                    <div class="form-group">
                        <label for="masalah">Nama Lampiran</label>
                        <input type="hidden" class="form-control" id="filelama" name="filelama">
                        <input type="hidden" class="form-control" id="id_lampiran" name="id_lampiran">
                        <input type="hidden" class="form-control" id="id_permintaan_data" name="id_permintaan_data">
                        <input type="text" class="form-control" id="nama" name="nama">
                     
                    </div>
                    
                    <div class="form-group">
                        <label for="masalah">File</label>
                        <input type="hidden" class="form-control" id="id_permintaan_data" name="id_permintaan_data"  value="<?php echo $id_permintaan_data ?>">
                        <div class="custom-file">
                                        <input type="file" name="upload_file" class="form-control">
                                        
                                    </div>
                    </div>
                    
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="clodemodal_add_bantuan">Close</button>
                <button type="submit" class="btn btn-primary">Upload File</button>
               
            </div>
        </div>
    </div>
</div>
                </form>



