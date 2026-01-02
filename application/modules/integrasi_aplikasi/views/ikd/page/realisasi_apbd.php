        <?php //var_dump($realisasi['cek']) ?>
        Realisasi Bulan <?php echo bulan_global($bulan).' '.$tahun ?>
        <table class='table table-striped table-bordered datatabel' style='margin-top:10px; font-size: 12px;border-collapse: collapse;' border="1">
               <thead>
               
                <tr>
                   <th rowspan="3">No</th>
                    <td rowspan="3">Kode Rekening</td>
                    <td rowspan="3">Nama Sub Kegiatan</td>
                    <td rowspan="3">Pagu</td>
                   <th colspan="17">Realisasi</th>
                   <th rowspan="3">Keterangan</th>
               </tr>
               <tr>
                <th colspan="5">Belanja Operasi</th>
                <th colspan="6" >Belanja Modal</th>
                <th >Belanja Tidak Terduga</th>
                <th colspan="3">Belanja Transfer</th>
                <th colspan="2">Total</th>
              
               </tr>
               <tr>
                  <td>Belanja Pegawai</td>
                  <td>Belanja Barang Jasa</td>
                  <td>Belanja Subsidi</td>
                  <td>Belanja Hibah</td>
                  <td>Total</td>
                  <td> Belanja Modal Tanah</td>
                  <td>Belanja Modal Peralatan Dan Mesin</td>
                  <td>Belanja Modal Gedung dan Bangunan</td>
                  <td>Belanja Modal Jalan, Jaringan, dan Irigasi</td>
                  <td>Belanja Modal dan Aset Tetap Lainnya </td>
                  <td>Total</td>
                  <td>Belanja Tidak Terduga</td>
                  <td> Belanja Bagi Hasil </td>
                  <td>Belanja Bantuan Keuangan</td>
                  <td>Total</td>
                  <td>Total Semua</td>
                  <td>%</td>






                  


               </tr>
             
               </thead>
               <tbody>
                     
                   <?php 
                   $kumpul_data_realisasi = [];
                   foreach ($realisasi['result']->data as $k => $v) { 


                    if ($v->id_instansi==$v->id_sub_instansi) {
                        $kategori = 'Sub Kegiatan Instansi';
                        $tambahan_kode_sub_kegiatan = '';
                        $jenis_sub_kegiatan = '';
                        $id_instansi_pembantu_teknis = '';
                        $keterangan  = '';
                        $kode_sub_kegiatan_disimpan = $v->kode_sub_kegiatan;
                      # code...
                    }else{
                        $kategori = 'Unit Pelaksana';
                        $tambahan_kode_sub_kegiatan = @$kumpul_ipt[$v->kode_sub_skpd]['kode_instansi_teknis'];
                        $jenis_sub_kegiatan = @$kumpul_ipt[$v->kode_sub_skpd]['jenis_teknis'];
                        $id_instansi_pembantu_teknis = @$kumpul_ipt[$v->kode_sub_skpd]['id_instansi_pembantu_teknis'];
                        $keterangan  = '<br>'.$jenis_sub_kegiatan.' - '.@$kumpul_ipt[$v->kode_sub_skpd]['nama_instansi_teknis'];
                        $kode_sub_kegiatan_disimpan = $v->kode_sub_kegiatan.'.'.$tambahan_kode_sub_kegiatan;

                    }

                    $bulan = $v->realisasi[0]->bulan ; 
                    $r_bo_bp = $v->realisasi[0]->bo_bp ; 
                    $r_bo_bbj = $v->realisasi[0]->bo_bbj ; 
                    $r_bo_bs = $v->realisasi[0]->bo_bs ; 
                    $r_bo_bh = $v->realisasi[0]->bo_bh ; 
                    $r_bm_bmt = $v->realisasi[0]->bm_bmt ; 
                    $r_bm_bmpm = $v->realisasi[0]->bm_bmpm ; 
                    $r_bm_bmgb = $v->realisasi[0]->bm_bmgb ; 
                    $r_bm_bmjji = $v->realisasi[0]->bm_bmjji ; 
                    $r_bm_bmatl = $v->realisasi[0]->bm_bmatl ; 
                    $r_btt = $v->realisasi[0]->btt ; 
                    $r_bt_bbh = $v->realisasi[0]->bt_bbh ; 
                    $r_bt_bbk = $v->realisasi[0]->bt_bbk ; 

                    $r_bo_all = $r_bo_bp + $r_bo_bbj + $r_bo_bs + $r_bo_bh;
                    $r_bm_all = $r_bm_bmt +$r_bm_bmpm +$r_bm_bmgb +$r_bm_bmjji +$r_bm_bmatl;
                    $r_btt_all = $r_btt;
                    $r_bt_all = $r_bt_bbh + $r_bt_bbk;
                    $r_total = $r_bo_all + $r_bm_all + $r_btt_all + $r_bt_all ; 
                    $persen_r_total = ($r_total / $v->pagu_sub_kegiatan) * 100;


                    $data_import = [
                      'kode_sub_kegiatan'=>$kode_sub_kegiatan_disimpan,
                      'kode_kegiatan'=>$v->kode_kegiatan,
                      'kode_program'=>$v->kode_program,
                      'kode_bidang_urusan'=>'',
                      'id_instansi'=>$id_instansi,
                      'kode_tahap'=>'2',
                      'bulan'=>$bulan,
                      'tahun'=>$v->tahun,
                      'bo_bp'=>$r_bo_bp,
                      'bo_bbj'=>$r_bo_bbj,
                      'bo_bs'=>$r_bo_bs,
                      'bo_bh'=>$r_bo_bh,
                      'bm_bmt'=>$r_bm_bmt,
                      'bm_bmpm'=>$r_bm_bmpm,
                      'bm_bmgb'=>$r_bm_bmgb,
                      'bm_bmjji'=>$r_bm_bmjji,
                      'bm_bmatl'=>$r_bm_bmatl,
                      'btt'=>$r_btt,
                      'bt_bbh'=>$r_bt_bbh,
                      'bt_bbk'=>$r_bt_bbk,
                      'created_on'=>id_user(),
                      'created_by'=>id_user(),
                      'input_by '=>'Integrasi IKD',
                    ];


                        $data_r_bo = [
                      
                        'bo_bp' =>$r_bo_bp,
                        'bo_bbj' =>$r_bo_bbj,
                        'bo_bs' =>$r_bo_bs,
                        'bo_bh' =>$r_bo_bh,
                        'bo_total' =>$r_bo_all,
                    ]; 

                        $data_r_bm = [
                      
                        'bm_bmt' =>$r_bm_bmt,
                        'bm_bmpm' =>$r_bm_bmpm,
                        'bm_bmgb' =>$r_bm_bmgb,
                        'bm_bmjji' =>$r_bm_bmjji,
                        'bm_bmatl' =>$r_bm_bmatl,
                        'bm_total' =>$r_bm_all,
                    ]; 

                        $data_r_bt = [
                      
                        'bt_bbh' =>$r_bt_bbh,
                        'bt_bbk' =>$r_bt_bbk,
                        'bt_total' =>$r_bt_all,
                    ]; 

                        $data_r_btt = [
                        'btt' =>$r_btt,
                        'btt_total' =>$r_btt,
                    ]; 




                        if (in_array($kode_sub_kegiatan_disimpan, $kumpul_realisasi)) {
                            $keterangan_input_realisasi = '<span class="badge badge-success">Telah diinputkan Manual Input<span>';

                        }else{
                            // if (in_array($v->kode_sub_kegiatan, $kumpul_kode_sub_kegiatan)) {
                            if (in_array($kode_sub_kegiatan_disimpan, $kumpul_ski)) {
                              if (in_array($kode_sub_kegiatan_disimpan, $kumpul_ask)) {
                                $keterangan_input_realisasi = '<span class="badge badge-info">Data Realisasi Bulan '.$bulan.' belum di inputkan<span>';
                                array_push($kumpul_data_realisasi, $data_import);

                              }else{
                                $keterangan_input_realisasi = '<span class="badge badge-warning">Pagu Sub Kegiatan belum di inputkan<span>';

                              }
                                // array_push($kumpul_import_target, $data_target);
                            }else{
                                $keterangan_input_realisasi = '<span class="badge badge-danger">Data Sub Kgiatan belum terdeteksi<span>';

                            }

                        }


                    ?>
                  <tr>
                         
                    <td><?php echo $k+1 ?></td>
                    <td><?php echo $kode_sub_kegiatan_disimpan ?></td>
                    <td><?php echo $v->nama_sub_kegiatan.$keterangan ?></td>
                    <td><?php echo number_format($v->pagu_sub_kegiatan) ?></td>
                    <td><?php echo number_format($r_bo_bp) ?></td>
                    <td><?php echo number_format($r_bo_bbj) ?></td>
                    <td><?php echo number_format($r_bo_bs) ?></td>
                    <td><?php echo number_format($r_bo_bh) ?></td>
                    <td><?php echo number_format($r_bo_all) ?></td>
                    <td><?php echo number_format($r_bm_bmt) ?></td>
                    <td><?php echo number_format($r_bm_bmpm) ?></td>
                    <td><?php echo number_format($r_bm_bmgb) ?></td>
                    <td><?php echo number_format($r_bm_bmjji) ?></td>
                    <td><?php echo number_format($r_bm_bmatl) ?></td>
                    <td><?php echo number_format($r_bm_all) ?></td>
                    <td><?php echo number_format($r_btt) ?></td>
                    <td><?php echo number_format($r_bt_bbh) ?></td>
                    <td><?php echo number_format($r_bt_bbk) ?></td>
                    <td><?php echo number_format($r_bt_all) ?></td>
                    <td><?php echo number_format($r_total) ?></td>
                    <td><?php echo round($persen_r_total,2) ?></td>
                    <td><?php echo $keterangan_input_realisasi ?></td>
                    <!-- <td align="right">
                      <a href="javascript:void(0)" onclick="ambil_data_realisasi(this, 'bo')" ><?php echo number_format($r_bo_all) ?></a>
                        <textarea style="display:none" id="data_bo"><?php echo json_encode($data_r_bo) ?></textarea>
                      </td>
                    <td align="right">
                      <a href="javascript:void(0)" onclick="ambil_data_realisasi(this, 'bm')" ><?php echo number_format($r_bm_all) ?></a>
                        <textarea style="display:none" id="data_bm"><?php echo json_encode($data_r_bm) ?></textarea>
                    </td>
                    <td align="right">
                      <a href="javascript:void(0)" onclick="ambil_data_realisasi(this, 'btt')" ><?php echo number_format($r_btt_all) ?></a>
                        <textarea style="display:none" id="data_btt"><?php echo json_encode($data_r_btt) ?></textarea>
                    </td>
                    <td align="right">
                        <textarea style="display:none" id="data_bt"><?php echo json_encode($data_r_bt) ?></textarea>
                    </td>
                    <td align="right"><?php echo number_format($r_total) ?></td>
                    <td align="right"><?php echo round($persen_r_total,2) ?></td> 
                      <a href="javascript:void(0)" onclick="ambil_data_realisasi(this, 'bt')" ><?php echo number_format($r_bt_all) ?></a>-->
                      </tr>
                   <?php } ?>
               </tbody>
           </table>    



           <textarea id="data_import_realisasi" style="display:none"><?php echo json_encode($kumpul_data_realisasi) ?></textarea>
          <a href="javascript:void(0);" class="btn btn-info btn-sm mt-3 mb-3"  onclick="import_realisasi_keuangan()" >Import Realisasi Keuangan Bulan  <?php echo bulan_global($bulan).' '.$tahun ?>
                    </a>
                    <?php echo json_encode($kumpul_data_realisasi) ?>