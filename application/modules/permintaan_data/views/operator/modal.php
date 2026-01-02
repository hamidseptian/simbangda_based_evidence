<form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('permintaan_data/simpan_upload_file/') ?>">
<div class="modal fade" id="modal_upload_file" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                     <b><?php echo $permintaan_data['judul'] ?></b>
                       
                    </div>
                    <div class="form-group">
                        <label for="masalah">File</label>
                        <input type="hidden" class="form-control" id="id_instansi" name="id_instansi" value="<?php echo $id_instansi ?>">
                        <input type="hidden" class="form-control" id="id_permintaan_data" name="id_permintaan_data"  value="<?php echo $id_permintaan_data ?>">
                        <input type="hidden" class="form-control" id="nama_instansi" name="nama_instansi"  value="<?php echo $nama_instansi ?>">
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







<form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('permintaan_data/simpanedit_upload_file/') ?>">
	<div class="modal fade" id="modal_upload_file_ulang" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Upload Ulang File</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                    <div class="form-group">
	                     <b><?php echo $permintaan_data['judul'] ?></b>
	                       
	                    </div>
	                    <div class="form-group">
	                        <label for="masalah">File</label>
	                        <input type="hidden" class="form-control" id="id_instansi" name="id_instansi" value="<?php echo $id_instansi ?>">
	                        <input type="hidden" class="form-control" id="id_permintaan_data" name="id_permintaan_data"  value="<?php echo $id_permintaan_data ?>">
	                        <input type="hidden" class="form-control" id="nama_instansi" name="nama_instansi"  value="<?php echo $nama_instansi ?>">

	                        <input type="hidden" class="form-control" id="file_lama" name="file_lama"  value="<?php echo $permintaan_data['file'] ?>">
	                        <input type="hidden" class="form-control" id="id_file" name="id_file"  value="<?php echo $permintaan_data['id_pelapor_permintaan_data'] ?>">

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







