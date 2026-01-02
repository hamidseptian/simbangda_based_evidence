


<form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('permintaan_data/simpanedit_permintaan_data/') ?>">
<div class="modal fade" id="modal-edit-permintaan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Permintaan Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-group">
                        <label for="masalah">Permintaan Data Ke</label>
                        <select class="form-control" id="id_group" name="id_group">
                            <option value="5" <?php if($permintaan_data['id_group']=='5'){echo "selected";} ?>>Operator OPD Pemprov Sumbar</option>
                            <option value="7" <?php if($permintaan_data['id_group']=='7'){echo "selected";} ?>>Operator Kabupaten Kota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="masalah">Judul Permintaan</label>
                        <input type="hidden" class="form-control" id="id_permintaan_data" name="id_permintaan_data" required value="<?php echo $permintaan_data['id_permintaan_data'] ?>">
                        <input type="text" class="form-control" id="judul" name="judul" required value="<?php echo $permintaan_data['judul'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="8" required><?php echo $permintaan_data['keterangan'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="masalah">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" required value="<?php echo $permintaan_data['deadline'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="masalah">Judul File Download</label>
                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="pengirim">
                                                Nama OPD - 
                                            </div>
                                        </div>
                                        <input class="form-control" name="formatfile" value="<?php echo $permintaan_data['judul_file'] ?>">
        
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
