<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 */

$pilihan_bulan = [
    1=>'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'                                   
];

                             ?>
<!-- Modal Dokumen Realisasi -->
<div class="modal fade" id="modal_tambah_ba" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_edit_ba">
                    <div class="form-group" >
                        <input type="hidden" class="form-control" id="id_setting_ba" name="id_setting_ba">
                        <label for="kode">Kegiatan</label>
                        <textarea class="form-control" id="keg" name="keg" rows="5"></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket" rows="5"></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi">
                    </div>
                    <div class="form-group" >
                        <label for="kode">Jadwal Pelaksanaan</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" id="tgl_awal" class="form-control" name="tgl_awal">
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="tgl_akhir" class="form-control" name="tgl_akhir">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Data Diambil</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tahapan APBD</label>
                               <select name="tahap" id="tahap" class="form-control" >
                                    <?php foreach ($nama_tahap as $k_t => $v) { ?>
                                        <option value="<?php echo $k_t ?>" <?php if($k_t==tahapan_apbd()){echo "selected";} ?>><?php echo $v ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" >
                                    <?php foreach ($config as $k => $v) { ?>
                                        <option value="<?php echo $v['tahun_anggaran'] ?>" <?php if($v['tahun_anggaran']==tahun_anggaran()){echo "selected";} ?>><?php echo $v['tahun_anggaran'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                   
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpan_setting_ba()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dokumen Realisasi -->
<div class="modal fade" id="modal_edit_ba" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_edit_ba">
                    <div class="form-group" >
                        <input type="hidden" class="form-control" id="id_setting_ba" name="id_setting_ba">
                        <label for="kode">Kegiatan</label>
                        <textarea class="form-control" id="keg" name="keg" rows="5"></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket" rows="5"></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi">
                    </div>
                    <div class="form-group" >
                        <label for="kode">Jadwal Pelaksanaan</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" id="tgl_awal" class="form-control" name="tgl_awal">
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="tgl_akhir" class="form-control" name="tgl_akhir">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Data Diambil</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tahapan APBD</label>
                               <select name="tahap" id="tahap" class="form-control" >
                                    <?php foreach ($nama_tahap as $k_t => $v) { ?>
                                        <option value="<?php echo $k_t ?>" <?php if($k_t==tahapan_apbd()){echo "selected";} ?>><?php echo $v ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" >
                                    <?php foreach ($config as $k => $v) { ?>
                                        <option value="<?php echo $v['tahun_anggaran'] ?>" <?php if($v['tahun_anggaran']==tahun_anggaran()){echo "selected";} ?>><?php echo $v['tahun_anggaran'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                   
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpandit_setting_ba()">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_ganti_jadwal_ba" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Jadwal Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_edit_ba">
                    <div class="form-group" >
                        <input type="hidden" class="form-control" id="id_instansi" name="id_instansi">
                        <input type="hidden" class="form-control" id="id_user" name="id_user">
                        <input type="hidden" class="form-control" id="helpdesk" name="helpdesk">
                        <input type="hidden" class="form-control" id="pimpinan" name="pimpinan">
                        <input type="hidden" class="form-control" id="id_setting_ba" name="id_setting_ba" value="<?php echo $ba['id_setting_berita_acara'] ?>">
                        <label for="kode">OPD</label>
                        <input readonly="" class="form-control" id="opd" name="opd">
                    </div>
                    <div class="form-group" >
                        <label for="kode">Jadwal</label>
                        <select class="form-control" id="tgl" name="tgl">
                           <?php foreach ($daftarTanggal as $k => $v) { 
                             $hari = date('N', strtotime($v));
                             $nama_hari = nama_hari($hari);
                            ?>
                              <option value="<?php echo $v ?>"><?php echo $nama_hari.', '.$v ?></option>
                           <?php } ?>
                        </select>
                    </div>
                    
                   
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpandit_jadwal_instansi()">Simpan</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modal_catatan_helpdesk" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_catatan">
                    <div class="form-group" >
                        <input type="hidden" class="form-control" id="id_isi_ba" name="id_isi_ba">
                        <table class="table">
                            <tr>
                                <td>OPD</td>
                                <td id="opd"></td>
                            </tr>
                            <tr>
                                <td>Helpdesk</td>
                                <td id="helpdesk"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Catatan</label>
                        <textarea class="form-control" rows="6" name="catatan" id="catatan"></textarea>
                    </div>
                    
                    <div class="form-group" >
                        <label for="kode">Solusi</label>
                        <textarea class="form-control" rows="6" name="solusi" id="solusi"></textarea>
                    </div>
                    
                   
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpandit_catatan_helpdesk()">Simpan</button>
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="modal_ganti_jadwal_ba_asisten" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Jadwal Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_edit_ba">
                    <div class="form-group" >
                        <input type="hidden" class="form-control" id="id_setting_ba" name="id_setting_ba" value="<?php echo $ba['id_setting_berita_acara'] ?>">
                        <label for="kode">ASISTEN</label>
                        <select class="form-control" id="asisten" name="asisten">
                           <?php
                           $asisten = [204 =>'ASISTEN PEMERINTAHAN DAN KESRA','ASISTEN PEREKONOMIAN DAN PEMBANGUNAN','ASISTEN ADMINISTRASI UMUM'];
                            foreach ($asisten as $k => $v) { 
                             
                            ?>
                              <option value="<?php echo $k ?>"><?php echo $v ?></option>
                           <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label for="kode">Jadwal</label>
                        <select class="form-control" id="tgl" name="tgl">
                           <?php foreach ($daftarTanggal as $k => $v) { 
                             $hari = date('N', strtotime($v));
                             $nama_hari = nama_hari($hari);
                            ?>
                              <option value="<?php echo $v ?>"><?php echo $nama_hari.', '.$v ?></option>
                           <?php } ?>
                        </select>
                    </div>
                    
                   
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpandit_jadwal_asisten()">Simpan</button>
            </div>
        </div>
    </div>
</div>



