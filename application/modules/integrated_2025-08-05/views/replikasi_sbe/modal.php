<div class="modal fade" id="modal_detail_rfk_replikasi" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                	<input type="hidden" name="pengelompokan" id="pengelompokan">
                    <input type="hidden" name="kode_sub_kegiatan" id="kode_sub_kegiatan" class="kode_sub_kegiatan">
                    <input type="hidden" name="kode_kegiatan" id="kode_kegiatan">
                    <input type="hidden" name="kode_program" id="kode_program">
                    <input type="hidden" name="kode_bidang_urusan" id="kode_bidang_urusan">
                    <input type="hidden" name="tahap" id="tahap">
                    <input type="hidden" name="tahun" id="tahun">
                    <input type="hidden" name="pergeseran_ke" id="pergeseran_ke">
                    <input type="hidden" name="pagu_berubah" id="pagu_berubah">
                    <input type="hidden" name="berubah_pada_pergeseran_ke" id="berubah_pada_pergeseran_ke">
                        
					<div class="form-group">
                        <table class="table">
                            <tr>
                                <td>SKPD</td> 
                                <td>:</td>  
                                <td class="skpd"></td>
                            </tr>  
                            <tr>
                                <td>Nama SKPD Pada Replikasi</td> 
                                <td>:</td>  
                                <td class="skpd_replikasi"></td>
                            </tr>  
                         
                            <tr>
                                <td>Tahapan APBD</td> 
                                <td>:</td>  
                                <td class="tahapan_apbd"></td>
                            </tr>  
                            <tr>
                                <td>Pagu</td> 
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
                                    <u for="">Belanja Pegawai</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td>
                                    <u for="">Belanja Modal Tanah</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td>
                                    <u for="">Belanja Tidak Terduga</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                 <td>
                                    <u for="">Belanja Bagi Hasil</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <u for="">Belanja Barang Jasa</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td>
                                    <u for="">Belanja Modal Peralatan Dan Mesin</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td></td>
                                 <td>
                                    <u for="">Belanja Bantuan Keuangan</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <u for="">Belanja Subsidi</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td>
                                    <u for="">Belanja Modal Gedung dan Bangunan</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <u for="">Belanja Hibah</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td>
                                    <u for="">Belanja Modal Jalan, Jaringan, dan Irigasi</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <u for="">Belanja Modal dan Aset Tetap Lainnya</u> <br>
                                    Akumulasi : ??? <br>
                                    Bulanan : ??? <br>
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
                <button type="button" class="btn btn-primary" id="btn_save_anggaran_sub_kegiatan" onclick="save_anggaran_sub_kegiatan()">Import</button>
                <!-- <button type="button" class="btn btn-info" id="btn_save_anggaran_sub_kegiatan_pergeseran" onclick="save_anggaran_sub_kegiatan_pergeseran()">Simpan Anggaran Pergeseran</button> -->
                
            </div>
        </div>
    </div>
</div>

