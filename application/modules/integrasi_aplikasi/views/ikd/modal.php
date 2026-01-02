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



<div class="modal fade" id="view_anggaran_ski" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <form id="form_anggaran_sub_kegiatan">
                        
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <td>Kategori </td> 
                                <td>:</td>  
                                <td class="kategori"></td>
                            </tr>  
                            <tr>
                                <td>Kode Sub Kegiatan </td> 
                                <td>:</td>  
                                <td class="kode_sub_kegiatan"></td>
                            </tr>   
                            <tr>
                                <td>Nama Sub Kegiatan </td> 
                                <td>:</td>  
                                <td class="nama_sub_kegiatan"></td>
                            </tr>  
                            <tr>
                                <td>Tahapan APBD</td> 
                                <td>:</td>  
                                <td class="tahapan_apbd"></td>
                            </tr>  
                            <tr>
                                <td>Pagu Aktif Saat Ini</td> 
                                <td>:</td>  
                                <td class="pagu_tahapan_apbd"></td>
                            </tr>   
                        </table>
                    </div>
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <td><input type="checkbox" name="rea_bo" class="" id="rea_bo" onclick="ceklis_realisasi('rea_bo')" disabled> <b>Belanja Operasi</b></td>
                                <td><input type="checkbox" name="rea_bm" class="" id="rea_bm" onclick="ceklis_realisasi('rea_bm')" disabled> <b>Belanja Modal</b></td>
                                <td><input type="checkbox" name="rea_btt" class="" id="rea_btt" onclick="ceklis_realisasi('rea_btt')" disabled> <b>Belanja Tidak Terduga</b></td>
                                <td><input type="checkbox" name="rea_bt" class="" id="rea_bt" onclick="ceklis_realisasi('rea_bt')" disabled> <b>Belanja Transfer</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Pegawai</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bp" name="bo_bp" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Tanah</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmt" name="bm_bmt" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Tidak Terduga</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="btt" name="btt" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                 <td>
                                    <label for="">Belanja Bagi Hasil</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bt_bbh" name="bt_bbh" onblur="if(value==''){value='0'}" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Barang Jasa</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bbj" name="bo_bbj" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Peralatan Dan Mesin</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmpm" name="bm_bmpm" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                 <td>
                                    <label for="">Belanja Bantuan Keuangan</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bt_bbk" name="bt_bbk" onblur="if(value==''){value='0'}" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Subsidi</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bs" name="bo_bs" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Gedung dan Bangunan</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmgb" name="bm_bmgb" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Hibah</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bh" name="bo_bh" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Jalan, Jaringan, dan Irigasi</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmjji" name="bm_bmjji" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="">Belanja Modal dan Aset Tetap Lainnya</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmatl" name="bm_bmatl" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-info" id="btn_save_anggaran_sub_kegiatan_pergeseran" onclick="save_anggaran_sub_kegiatan_pergeseran()">Simpan Anggaran Pergeseran</button> -->
                
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="view_anggaran_ski_belum_import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <form id="form_anggaran_sub_kegiatan">
                        
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <td>Kategori </td> 
                                <td>:</td>  
                                <td class="kategori"></td>
                            </tr>   
                            <tr>
                                <td>Nama Sub Kegiatan </td> 
                                <td>:</td>  
                                <td class="nama_sub_kegiatan"></td>
                            </tr>  
                            <tr>
                                <td>Tahapan APBD</td> 
                                <td>:</td>  
                                <td class="tahapan_apbd"></td>
                            </tr>  
                            <tr>
                                <td>Pagu Aktif Saat Ini</td> 
                                <td>:</td>  
                                <td class="pagu_tahapan_apbd"></td>
                            </tr>   
                        </table>
                    </div>
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <td><input type="checkbox" name="rea_bo" class="" id="rea_bo" onclick="ceklis_realisasi('rea_bo')" disabled> <b>Belanja Operasi</b></td>
                                <td><input type="checkbox" name="rea_bm" class="" id="rea_bm" onclick="ceklis_realisasi('rea_bm')" disabled> <b>Belanja Modal</b></td>
                                <td><input type="checkbox" name="rea_btt" class="" id="rea_btt" onclick="ceklis_realisasi('rea_btt')" disabled> <b>Belanja Tidak Terduga</b></td>
                                <td><input type="checkbox" name="rea_bt" class="" id="rea_bt" onclick="ceklis_realisasi('rea_bt')" disabled> <b>Belanja Transfer</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Pegawai</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bp" name="bo_bp" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Tanah</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmt" name="bm_bmt" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Tidak Terduga</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="btt" name="btt" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                 <td>
                                    <label for="">Belanja Bagi Hasil</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bt_bbh" name="bt_bbh" onblur="if(value==''){value='0'}" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Barang Jasa</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bbj" name="bo_bbj" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Peralatan Dan Mesin</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmpm" name="bm_bmpm" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                 <td>
                                    <label for="">Belanja Bantuan Keuangan</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bt_bbk" name="bt_bbk" onblur="if(value==''){value='0'}" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Subsidi</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bs" name="bo_bs" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Gedung dan Bangunan</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmgb" name="bm_bmgb" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Belanja Hibah</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bo_bh" name="bo_bh" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td>
                                    <label for="">Belanja Modal Jalan, Jaringan, dan Irigasi</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmjji" name="bm_bmjji" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="">Belanja Modal dan Aset Tetap Lainnya</label>
                                     <input readonly type="text" class="form-control currency" style="text-align: right;" id="bm_bmatl" name="bm_bmatl" onblur="if(value==''){value='0'}" value="0">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-info" id="btn_save_anggaran_sub_kegiatan_pergeseran" onclick="save_anggaran_sub_kegiatan_pergeseran()">Simpan Anggaran Pergeseran</button> -->
                
            </div>
        </div>
    </div>
</div>





<!-- Modal Target Fisik dan Keuangan -->
<div class="modal fade" id="view_target" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data-target">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <table class="table">
                                <tr>
                                    <td>Kode</td>
                                    <td>:</td>
                                    <td class="kode_sub_kegiatan"></td>
                                </tr>
                                <tr>
                                    <td>Sub Kegiatan</td>
                                    <td>:</td>
                                    <td id="nama_sub_kegiatan"></td>
                                </tr>
                                <tr>
                                    <td>Tahapan</td>
                                    <td>:</td>
                                    <td id="nama_tahapan"></td>
                                </tr>
                                <tr>
                                    <td>Pagu</td>
                                    <td>:</td>
                                    <td id="pagu_sub_kegiatan"></td>
                                </tr>
                            </table>
                       
                        </div>
                        <table class="table tablr-striped table-bordered" id="table-target" border=1>
                            <thead>
                                <tr>
                                    <th rowspan="4" width="1%">No</th>
                                    <th rowspan="4">Bulan</th>
                                    <th colspan="6" style="text-align: center;" >
                                        Target
                                    </th>
                                  
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="2">Fisik</th>
                                    <th colspan="4">Keu</th>
                                </tr>
                                <tr>    
                                  
                                    <th colspan="2">%</th>
                                    <th colspan="2">RP</th>
                                </tr>
                                <tr>
                                    <th>Bulanan</th>
                                    <th>Akumulasi</th>
                                    <th>Bulanan</th>
                                    <th>Akumulasi</th>
                                    <th>Bulanan</th>
                                    <th>Akumulasi</th>
                                </tr>
                              

                            </thead>
                            <tbody id="target-apbd">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modal-realisasi-keuangan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Realisasi Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <table class="table">
                                <tr>
                                    <td>Kode</td>
                                    <td>:</td>
                                    <td id="td_kode_sub_kegiatan"></td>
                                </tr>
                                <tr>
                                    <td>Sub Kegiatan</td>
                                    <td>:</td>
                                    <td id="nama_sub_kegiatan"></td>
                                </tr>
                                <tr>
                                    <td>Tahapan</td>
                                    <td>:</td>
                                    <td id="nama_tahapan"></td>
                                </tr>
                                <tr>
                                    <td>Pagu</td>
                                    <td>:</td>
                                    <td id="pagu_sub_kegiatan"></td>
                                </tr>
                            </table>
                          
                        </div>
           
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            Realisasi Bulan Sebelumnya (Sudah Impost)
                            <table class="table table-bordered">
                                <tr>
                                    <td rowspan="4">Belanja Operasi</td>
                                    <td>Belanja Pegawai</td>
                                    <td rowspan="4">Total</td>
                                </tr>
                                <tr>
                                    <td>Belanja Barang Jasa</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Subsidi</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Hibah</td>
                                   
                                </tr>

                                <tr>
                                    <td rowspan="5">Belanja Modal</td>
                                    <td> Belanja Modal Tanah</td>
                                    <td rowspan="5">Total</td>
                                </tr>
                                <tr>
                                    <td>Belanja Modal Peralatan Dan Mesin</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal Gedung dan Bangunan</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal Jalan, Jaringan, dan Irigasi</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal dan Aset Tetap Lainnya </td>
                                   
                                </tr>
                               
                                <tr>
                                    <td colspan="3">Belanja Tidak Terduga</td>
                                   
                                </tr>
                                   <tr>
                                    <td rowspan="2">Belanja Transfer</td>
                                    <td> Belanja Bagi Hasil </td>
                                    <td rowspan="2">Total</td>
                                </tr>
                                <tr>
                                    <td>Belanja Bantuan Keuangan</td>
                                   
                                </tr>
                            </table>
                          
                        </div>
           
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            Realisasi Bulan Ini
                            <table class="table table-bordered">
                                <tr>
                                    <td rowspan="4">Belanja Operasi</td>
                                    <td>Belanja Pegawai</td>
                                    <td rowspan="4">Total <br><span id="bulan_ini_bo_total"></span></td>
                                </tr>
                                <tr>
                                    <td>Belanja Barang Jasa <br><span id="bulan_ini_bo_bbj"></span></td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Subsidi <br><span id="bulan_ini_bo_bs"></span></td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Hibah <br><span id="bulan_ini_bo_bh"></span></td>
                                   
                                </tr>

                                <tr>
                                    <td rowspan="5">Belanja Modal</td>
                                    <td> Belanja Modal Tanah <br><span id="bulan_ini_bm_bmt"></span></td>
                                    <td rowspan="5">Total <br><span id="bulan_ini_bm_total"></span></td>
                                </tr>
                                <tr>
                                    <td>Belanja Modal Peralatan Dan Mesin <br><span id="bulan_ini_bm_bmpm"></span></td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal Gedung dan Bangunan <br><span id="bulan_ini_bm_bmgb"></span></td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal Jalan, Jaringan, dan Irigasi <br><span id="bulan_ini_bm_bmjji"></span></td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal dan Aset Tetap Lainnya  <br><span id="bulan_ini_bm_bmatl"></span></td>
                                   
                                </tr>
                               
                                <tr>
                                    <td colspan="3">Belanja Tidak Terduga <br><span id="bulan_ini_btt"></span></td>
                                   
                                </tr>
                                   <tr>
                                    <td rowspan="2">Belanja Transfer</td>
                                    <td> Belanja Bagi Hasil   <br><span id="bulan_ini_bt_bbh"></span></td>
                                    <td rowspan="2">Total  <br><span id="bulan_ini_bt_total"></span></td>
                                </tr>
                                <tr>
                                    <td>Belanja Bantuan Keuangan  <br><span id="bulan_ini_bt_bbk"></span></td>
                                   
                                </tr>
                            </table>
                          
                        </div>
           
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            Realisasi Sampai Bulan Ini
                            <table class="table table-bordered">
                                <tr>
                                    <td rowspan="4">Belanja Operasi</td>
                                    <td>Belanja Pegawai</td>
                                    <td rowspan="4">Total</td>
                                </tr>
                                <tr>
                                    <td>Belanja Barang Jasa</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Subsidi</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Hibah</td>
                                   
                                </tr>

                                <tr>
                                    <td rowspan="5">Belanja Modal</td>
                                    <td> Belanja Modal Tanah</td>
                                    <td rowspan="5">Total</td>
                                </tr>
                                <tr>
                                    <td>Belanja Modal Peralatan Dan Mesin</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal Gedung dan Bangunan</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal Jalan, Jaringan, dan Irigasi</td>
                                   
                                </tr>
                                <tr>
                                    <td>Belanja Modal dan Aset Tetap Lainnya </td>
                                   
                                </tr>
                               
                                <tr>
                                    <td colspan="3">Belanja Tidak Terduga</td>
                                   
                                </tr>
                                   <tr>
                                    <td rowspan="2">Belanja Transfer</td>
                                    <td> Belanja Bagi Hasil </td>
                                    <td rowspan="2">Total</td>
                                </tr>
                                <tr>
                                    <td>Belanja Bantuan Keuangan</td>
                                   
                                </tr>
                            </table>
                          
                        </div>
           
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




   <script type="text/javascript">
$(document).ready( function () {
    $('.datatable_1').DataTable();
} );
   </script>

