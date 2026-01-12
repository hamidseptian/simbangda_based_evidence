<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 */
?>


<form id="form-update-evidence">
<div class="mb-3 card">
    <div class="card-body">




        <div class="row">
                    <div class="col-md-6">
                        <b>Data APBD</b>
                          <input type="hidden" id="id_realisasi_fisik" name="id_realisasi_fisik" value="<?php echo sbe_crypt($r_fisik->id_realisasi_fisik); ?>">
                                <input type="hidden" id="id_paket_pekerjaan" name="id_paket_pekerjaan" value="<?php echo $r_fisik->id_paket_pekerjaan; ?>">
                                <input type="hidden" id="id_paket_pekerjaan" name="id_vol_pelaksanaan_pekerjaan" value="<?php echo $r_fisik->id_vol_pelaksanaan_pekerjaan; ?>">
                                <input type="hidden" id="dokumen" name="dokumen" value="<?php echo $r_fisik->dokumen; ?>">
                                <input type="hidden" id="pelaksanaan" name="pelaksanaan" value="<?php echo $r_fisik->pelaksanaan_ke; ?>">

                            <input type="hidden" class="form-control" id="filelama" name="filelama" readonly="true" value="<?php echo $r_fisik->file_dokumen; ?>">

                         <table width="100%" class="table">
                                    <tbody><tr>
                                        <td valign="top">SKPD</td>
                                        <td valign="top">:</td>
                                        <td valign="top"><?php echo $r_fisik->nama_instansi ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Tahun</td>
                                        <td valign="top">:</td>
                                        <td valign="top"><?php echo $r_fisik->tahun; ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Kode Rekening</td>
                                        <td valign="top">:</td>
                                        <td valign="top"><?php echo $r_fisik->kode_rekening_sub_kegiatan; ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Program</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo nama_program($r_fisik->kode_rekening_program) ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Kegiatan</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo nama_kegiatan($r_fisik->kode_rekening_kegiatan) ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Sub Kegiatan</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo $r_fisik->nama_sub_kegiatan; ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">PPTK</td>
                                        <td valign="top">:</td>
                                         <td valign="top">
                                           <?php 

                if ($pptk->num_rows() ==0) {
                    echo  '<span class="text-danger">PPTK Belum ditentukan</span>';
                    # code...
                }else if($pptk->num_rows()==1){
                    echo  @$pptk->row_array()['full_name'];

                }else{
                    $list_pptk = $pptk->result_array();
                    $shoe_pptk = '<ol>';
                    foreach ($list_pptk as $k_pptk => $v_pptk) {
                    $shoe_pptk .= '<li>'.$v_pptk['full_name'].'</li>';
                        # code...
                    }
                    $shoe_pptk .= '<ol>';
                    echo  $shoe_pptk;
                }





 ?>
                                        </td>
                                    </tr>
                            </tbody></table>

                    </div>
                    <div class="col-md-6">
                        <b>Paket Pekerjaan</b>
                         <table width="100%" class="table">
                                <tbody><tr>
                                        <td valign="top">Nama Paket Pekerjaan</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo $r_fisik->nama_paket; ?> </td>
                                    </tr>
                                <tr>
                                        <td valign="top">Jenis Paket</td>
                                        <td valign="top">:</td>
                                        <td valign="top"><?php echo $r_fisik->jenis_paket; ?> </td>
                                    </tr>
                                <tr>
                                        <td valign="top">Metode</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo $r_fisik->metode; ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Dokumen</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo $r_fisik->dokumen; ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Status</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo $r_fisik->status; ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Masalah</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo $r_fisik->masalah; ?> </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Solusi</td>
                                        <td valign="top">:</td>
                                        <td valign="top"> <?php echo $r_fisik->solusi; ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label><b>Upload ulang file <?php echo $r_fisik->dokumen; ?></b></label>
                                             <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="upload-file" name="berkas" aria-describedby="inputGroupFileAddon04" onchange="get_file_name(this)" placeholder="pfd">
                                                    <label class="custom-file-label" id="label-upload" for="upload-file">Choose File</label>
                                                </div>
                                                <?php if (jadwal_rfk()['aktif']==0) { ?>
                                                     <div class="input-group-append">
                                                    <button class="btn btn-danger" type="button" id="btn-upload-upload-file" onclick="upload_berakhir()">Upload</button>
                                                </div>
                                                <?php }else{ ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" id="btn-upload-upload-file" onclick="do_upload()">Upload</button>
                                                </div>
                                            <?php } ?>
                                            </div>

                                        </td>


                                    </tr>
                                  
                            </tbody></table>

                    </div>
                 
                </div>








        
    </div>
    </div>
                </form>