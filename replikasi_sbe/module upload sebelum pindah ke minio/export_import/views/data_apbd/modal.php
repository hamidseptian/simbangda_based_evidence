<form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('export_import/export_sipd_data_apbd/') ?>">
    <div class="modal fade" id="export_sipd" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Import SIPD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Anggaran</label>
                        <select class="form-control" name="tahun">
                            <?php foreach ($tahun as $k => $v) { ?>
                                <option value="<?php echo $v['tahun']; ?>"><?php echo $v['tahun']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahapan APBD</label>
                        <select class="form-control" name="kode_tahap">
                            <option value="2">APBD AWAL</option>
                            <option value="3">APBD PERGESERAN</option>
                            <option value="4">APBD PERUBAHAN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File Excel dari SIPD</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="upload_file" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Upload</button>
                </div>
            </div>
        </div>
    </div>
</form>




