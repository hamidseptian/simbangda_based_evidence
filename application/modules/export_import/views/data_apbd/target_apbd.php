




<div class="row">

    <div class="col-md-12 col-lg-12">
          

          <div class="mb-3 card">
                                        <div class="card-header-tab card-header">
                                            <div class="card-header-title">
                                                UPLOAD Target SKPD <br>
                                                Periode <?php echo pilihan_nama_tahapan($kode_tahap).' '.$tahun ?>
                                            </div>
                                         <!--    <ul class="nav">
                                                <li class="nav-item"><a data-toggle="tab" href="#mentah" class="nav-link active show">Data Mentah</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#ski" class="nav-link">Sub Kegiatan Instansi</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#ask" class="nav-link">Telah dikelompokan berdasarkan Anggaran</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#sd" class="nav-link ">Telah dikelompokan berdasarkan Sumber Dana</a></li>
                                            </ul> -->
                                        </div>
                                        <div class="card-body">
                                            <a href="<?php echo base_url('export_import/template_target_sipd') ?>">Harap gunakan template ini</a> <br> 
                                            Pada template bagian kolom tidak boleh diubah <br>  
                                            ambil data rencana ke aliran kas kemudian di convert ke excel, setelah di convert pilih bagian sub kegiatan saja dan pindahkan ke template ini <br> 
                                            upload data yang sudah di inputkan sesuai template disini   
                                            <hr>

                                            <form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('export_import/export_sipd_target_apbd/') ?>">
                                                <div class="form-group">
                                                    <label>OPD</label>
                                                    <select class="form-control" name="id_instansi" id="id_instansi">
                                                        <?php foreach ($instansi as $k => $v) { ?>
                                                            <option value="<?php echo $v['id_instansi'] ?>"><?php echo $v['nama_instansi'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                 <!-- <div class="input-group"> -->
                                                    <div class="form-group">
                                                        <label>File Excel </label> <br>
                                                        <input type="hidden" name="tahun" class="" value="<?php echo $tahun ?>">
                                                        <input type="hidden" name="tahap" class="" value="<?php echo $kode_tahap ?>">
                                                        <input type="file" name="upload_file" class="" required>
                                                    </div>
                                                        <!-- <button class="btn btn-info btn-block">Upload Target SIPD</button> -->
                                                <!-- </div> -->
                                            </form>    
                                        </div>
                                    </div>




    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
<!-- Script -->
<script>
    $(document).ready(function() {
        show_select2();
    });

    function show_select2() {
        $('#id_instansi').select2({
            placeholder: "Pilih OPD",
            allowClear: false,
            width: 'style',
            theme: 'bootstrap4'
        });
    }
</script>