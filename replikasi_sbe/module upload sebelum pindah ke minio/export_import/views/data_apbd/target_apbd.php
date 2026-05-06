

<div class="row">
                            <div class="col-lg-6 col-xl-3">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Periode</div>
                                            <h5 class="text-info"><b>??</b></h5>
                                            <small>??</small>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-2">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Program</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success"> ???? </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-2">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total kegiatan</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-primary"> ???? </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-2">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Sub Kegiatan</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-warning"> ???? </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Pagu</div>
                                            <h5 class="text-info"> ?? </h5>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>



<div class="row">

    <div class="col-md-12 col-lg-12">
          

          <div class="mb-3 card">
                                        <div class="card-header-tab card-header">
                                            <div class="card-header-title">
                                                Data APBD SKPD <br>
                                                Nama INstansi
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
                                            <form id="form-export-program" method="post" enctype="multipart/form-data" action="<?php echo base_url('export_import/export_sipd_target_apbd/') ?>">
                                                 <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="hidden" name="id_instansi" class="" value="<?php echo $id_instansi ?>">
                                                        <input type="hidden" name="tahun" class="" value="<?php echo $tahun ?>">
                                                        <input type="hidden" name="tahap" class="" value="<?php echo $kode_tahap ?>">
                                                        <input type="file" name="upload_file" class="" required>
                                                    </div>
                                                        <button class="btn btn-info btn-block">Upload Target SIPD</button>
                                                </div>
                                            </form>    
                                        </div>
                                    </div>




    </div>


</div>
