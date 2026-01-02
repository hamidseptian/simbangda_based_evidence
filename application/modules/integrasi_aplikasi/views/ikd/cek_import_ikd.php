<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>

		<div class="app-main__inner p-0">
                    <div class="app-inner-layout">
                        <div class="app-inner-layout__header bg-heavy-rain">
                            <div class="app-page-title">
                                <div class="page-title-wrapper">
                                    <div class="page-title-heading">
                                    	 <div class="widget-content-left">
                                                    <div class="widget-heading text-dark opacity-7">
														<h6 class="menu-header-subtitle" id="nama_skpd">Cek Import Aplikasi ikd - Simbangda</h6>
														<h5 class="menu-header-title" id="nama_helpdesk"><?php echo $nama_instansi ?></h5>
                                                    </div>
                                                    <div class="widget-subheading opacity-10">
                                                            <b>
                                                               Tahun : ???                                                         
                                                            </b>
                                                    </div>
                                                </div>
                                    </div>
                                    </div>
                            </div>                
                        </div>
                        <?php echo $this->session->flashdata('pesan') ?>
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__content card">
								<div class="mb-3 card">
									<div class="card-body">
                                        <div style="overflow-x: scroll">
                                            
										<h5 class="card-title">Data Paket Telah di Dimporkan</h5>
                                      			<table class="table data_tabel" id="list_paket_import_ikd">
													<thead>	
														<tr>	
															<th rowspan="2">No</th>
															<th rowspan="2">Kode Sub Kegiatan</th>
                                                            <th rowspan="2">Nama Sub Kegiatan</th>
                                                            <th rowspan="2">Pagu</th>
                                                            <th rowspan="2">Kategori</th>
                                                            <th rowspan="2">Target APBD</th>
                                                            <th colspan="2">Realisasi Keuangan</th>
															<th rowspan="2">Input By</th>
														</tr>
                                                        <tr>
                                                            <th>Rp</th>
                                                            <th>%</th>
                                                        </tr>
													</thead>
													<?php 
                                                    $no = 1;
                                                    $tahap = 2;
                                                    $bulan =bulan_aktif();
                                                    $tahun = 2025;
                                                    foreach ($sub_kegiatan as $k => $v) {
                                                        $id_instansi = $v['id_instansi'];
                                                        $krsk = $v['kode_rekening_sub_kegiatan'];
                                                        $q_realisasi = $this->db->query("SELECT 
                                                            sum( bo_bp) as  bo_bp,
                                                            sum(bo_bbj) as bo_bbj,
                                                            sum(bo_bs) as bo_bs,
                                                            sum(bo_bh) as bo_bh,
                                                            sum(bm_bmt) as bm_bmt,
                                                            sum(bm_bmpm) as bm_bmpm,
                                                            sum(bm_bmgb) as bm_bmgb,
                                                            sum(bm_bmjji) as bm_bmjji,
                                                            sum(bm_bmatl) as bm_bmatl,
                                                            sum(btt) as btt,
                                                            sum(bt_bbh) as bt_bbh,
                                                            sum(bt_bbk ) as bt_bbk 
                                                         from realisasi_keuangan where id_instansi = '$id_instansi' and tahun = $tahun and bulan <=$bulan and kode_tahap = '$tahap' and kode_sub_kegiatan ='$krsk'")->row_array();
                                                        $rk = $q_realisasi['bo_bp'] + $q_realisasi['bo_bbj'] + $q_realisasi['bo_bs'] + $q_realisasi['bo_bh'] + $q_realisasi['bm_bmt'] + $q_realisasi['bm_bmpm'] + $q_realisasi['bm_bmgb'] + $q_realisasi['bm_bmjji'] + $q_realisasi['bm_bmatl'] + $q_realisasi['btt'] + $q_realisasi['bt_bbh'] + $q_realisasi['bt_bbk'] ;

                                                        $persen_rk = $v['pagu'] == 0 ? 0 : $rk / $v['pagu'];
                                                        $persen_rk = $persen_rk * 100;

                                                        if ($v['kategori']=='Unit Pelaksana') {
                                                            $nama_sub_kegiatan = $v['nama_sub_kegiatan'].'<br>'.$v['jenis_sub_kegiatan'].' - '.$v['keterangan'];
                                                        }else{
                                                            $nama_sub_kegiatan = $v['nama_sub_kegiatan'];

                                                        }
                                                     ?>
                                                        <tr>    
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $v['kode_rekening_sub_kegiatan'] ?></td>
                                                            <td><?php echo $v['nama_sub_kegiatan'] ?></td>
                                                            <td>
                                                                <a href="javascript:void(0)" onclick="anggaran_sub_kegiatan_ikd('<?php echo $v['kode_rekening_sub_kegiatan'] ?>','<?php echo $v['id_instansi'] ?>','<?php echo $v['tahun'] ?>','<?php echo $v['kode_tahap'] ?>')"><?php echo number_format($v['pagu']) ?></a>
                                                            </td>
                                                            <td><?php echo $v['kategori'] ?></td>
                                                            <td><?php 
                                                                    if (in_array($v['kode_rekening_sub_kegiatan'], $kumpul_target)) {
                                                                        $ket_target = '<span class="badge badge-success">Sudah ada Target APBD<span>';
                                                                    

                                                                    }else{
                                                                        $ket_target = '<span class="badge badge-danger">Belum ada Target APBD<span>';

                                                                    }
                                                                    echo $ket_target;
         ?></td>
                                                            <td><?php echo number_format($rk) ?></td>
                                                            <td><?php echo round($persen_rk,2) ?></td>
                                                            <td><?php echo $v['input_by'] ?></td>
                                                           
                                                        </tr>
                                                    <?php } ?>
												</table>

                                        <!-- <a href="<?php echo base_url() ?>integrasi_aplikasi/preview_import_dan_auto_evidence?id_opd=<?php echo $id_opd ?>&tahun=<?php echo $tahun ?>" class="btn btn-info">Lihat Semua Paket Per Sub Kegiatan</a> -->
                                        <br><br>
                                        </div>
									</div>
								</div>
                            </div>
                         
                        </div>
                    </div>
                </div>


<script type="text/javascript">
    
$(document).ready( function () {
    $('.data_tabel').DataTable();
});
</script>