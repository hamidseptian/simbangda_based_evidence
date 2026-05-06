<style type="text/css">
    th{
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="card-shadow-primary card-border mb-3 profile-responsive card">
                                    


                                    <ul class="list-group list-group-flush">
                                        <li class="bg-warm-flame list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading text-dark opacity-7">Pengecekan Data Realisasi Keuangan </div>
                                                    <div class="widget-heading text-dark opacity-7"><?php echo $tahap.' '.$tahun ?></div>
                                                            <div class="widget-subheading opacity-10">
                                                               <?php echo $nama_instansi ?>
                                                                
                                                            
                                                            </div>
                                                  
                                                </div>
                                                <div class="widget-content-right">
                                                        <div class="widget-chart-content">
                                                           
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        <li class="p-0 list-group-item">
                                            <div class="widget-content">
                                                <div class="row">
                                                    <div class="col-md-12 col-xl-12">
                                                        <b class="pl-1">Data realisasi keuangan</b>
                                                        <?php echo $this->session->flashdata('pesan') ?>
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="3">Bulan</th>
                                                                    <th colspan="14">Realisasi Keuangan</th>
                                                                    <th rowspan="3">Total</th>
                                                                    <th rowspan="3">Option</th>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="5">Belanja Operasi</th>
                                                                    <th colspan="6">Belanja Modal</th>
                                                                    <th >Belanja Tidak Terduga</th>
                                                                    <th colspan="2">Belanja Transfer</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Belanja Pegawai</th>
                                                                    <th>Belanja Barang Jasa</th>
                                                                    <th>Belanja Subsidi</th>
                                                                    <th>Belanja Hibah</th>
                                                                    <th>Belanja Bantuan Sosial</th>
                                                                    <th>Belanja Modal Tanah</th>
                                                                    <th>Belanja Modal Peralatan Dan Mesin</th>
                                                                    <th>Belanja Modal Gedung dan Bangunan</th>
                                                                    <th>Belanja Modal Jalan, Jaringan, dan Irigasi</th>
                                                                    <th>Belanja Modal dan Aset Tak Berwujud</th>
                                                                    <th>Belanja Modal dan Aset Tetap Lainnya</th>
                                                                    <th>Belanja Tidak Terduga</th>
                                                                    <th>Belanja Bagi Hasil</th>
                                                                    <th>Belanja Bantuan Keuangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $total_bo_bp = 0 ;
                                                                    $total_bo_bbj = 0 ;
                                                                    $total_bo_bs = 0 ;
                                                                    $total_bo_bh = 0 ;
                                                                    $total_bo_bbs = 0 ;
                                                                    $total_bm_bmt = 0 ;
                                                                    $total_bm_bmpm = 0 ;
                                                                    $total_bm_bmgb = 0 ;
                                                                    $total_bm_bmjji = 0 ;
                                                                    $total_bm_bmatb = 0 ;
                                                                    $total_bm_bmatl = 0 ;
                                                                    $total_btt = 0 ;
                                                                    $total_bt_bbh = 0 ;
                                                                    $total_bt_bbk = 0 ;
                                                                    $total_semua = 0 ;
                                                                foreach ($rk as $k => $v) { 
                                                                    $total_perbulan = $v['bo_bp'] + $v['bo_bbj'] + $v['bo_bs'] + $v['bo_bh'] + $v['bo_bbs'] + $v['bm_bmt'] + $v['bm_bmpm'] + $v['bm_bmgb'] + $v['bm_bmjji'] + $v['bm_bmatb'] + $v['bm_bmatl'] + $v['btt'] + $v['bt_bbh'] + $v['bt_bbk'];  

                                                                        $total_bo_bp += $v['bo_bp'];
                                                                        $total_bo_bbj += $v['bo_bbj'];
                                                                        $total_bo_bs += $v['bo_bs'];
                                                                        $total_bo_bh += $v['bo_bh'];
                                                                        $total_bo_bbs += $v['bo_bbs'];
                                                                        $total_bm_bmt += $v['bm_bmt'];
                                                                        $total_bm_bmpm += $v['bm_bmpm'];
                                                                        $total_bm_bmgb += $v['bm_bmgb'];
                                                                        $total_bm_bmjji += $v['bm_bmjji'];
                                                                        $total_bm_bmatb += $v['bm_bmatb'];
                                                                        $total_bm_bmatl += $v['bm_bmatl'];
                                                                        $total_btt += $v['btt'];
                                                                        $total_bt_bbh += $v['bt_bbh'];
                                                                        $total_bt_bbk += $v['bt_bbk'];
                                                                        $total_semua += $total_perbulan ; 
                                                                          ?>
                                                                    <tr>
                                                                        <td align="right"><?php echo bulan_global($v['bulan']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bo_bp']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bo_bbj']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bo_bs']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bo_bh']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bo_bbs']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bm_bmt']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bm_bmpm']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bm_bmgb']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bm_bmjji']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bm_bmatb']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bm_bmatl']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['btt']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bt_bbh']) ?></td>
                                                                        <td align="right"><?php echo number_format($v['bt_bbk']) ?></td>
                                                                        <td align="right"><?php echo number_format($total_perbulan) ?></td>
                                                                        <td><a href="<?php echo base_url('realisasi/hapus_rk_kk_perbulan/'.sbe_crypt($v['id_realisasi_fisik_keuangan_kab_kota'])) ?>?id_instansi=<?php echo $v['id_instansi'] ?>&tahun=<?php echo $v['tahun'] ?>&kode_tahap=<?php echo $v['kode_tahap'] ?>" onclick="return confirm('Hapus realisasi keuangan bulan <?php echo bulan_global($v['bulan']) ?>.?');">Hapus</a></td>
                                                                    
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td>Total</td>

                                                                        <td align="right"><?php echo number_format($total_bo_bp) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bo_bbj) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bo_bs) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bo_bh) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bo_bbs) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bm_bmt) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bm_bmpm) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bm_bmgb) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bm_bmjji) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bm_bmatb) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bm_bmatl) ?></td>
                                                                        <td align="right"><?php echo number_format($total_btt) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bt_bbh) ?></td>
                                                                        <td align="right"><?php echo number_format($total_bt_bbk) ?></td>
                                                                        <td align="right"><?php echo number_format($total_semua) ?></td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>

                                        
                                    </ul>
                                </div>



